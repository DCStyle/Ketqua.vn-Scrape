<?php

namespace App\Console\Commands;

use App\Models\Article;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CrawlPredictionArticles extends Command
{
    protected $signature = 'crawl:predictions {region?}';
    protected $description = 'Crawl lottery prediction articles from xosothantai.mobi';

    protected $client;

    /**
     * Now using xosothantai.mobi as our baseUrl and sourceDomain.
     */
    protected $baseUrl = 'https://xosothantai.mobi';
    protected $targetDomain = 'kqxshn.org';
    protected $sourceDomain = 'xosothantai.mobi';

    /**
     * Updated region URLs:
     *  - xsmb → /du-doan-xsmb-c228.html
     *  - xsmt → /du-doan-xsmt-c224.html
     *  - xsmn → /du-doan-xsmn-c226.html
     */
    protected $regions = [
        'xsmb' => [
            'url' => '/du-doan-xsmb-c228.html',
            'type' => 'xsmb',
            'display' => 'XSMB'
        ],
        'xsmt' => [
            'url' => '/du-doan-xsmt-c224.html',
            'type' => 'xsmt',
            'display' => 'XSMT'
        ],
        'xsmn' => [
            'url' => '/du-doan-xsmn-c226.html',
            'type' => 'xsmn',
            'display' => 'XSMN'
        ]
    ];

    public function __construct()
    {
        parent::__construct();
        $this->client = new Client([
            'verify' => false,
            'timeout' => 30,
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) '
                    . 'AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 '
                    . 'Safari/537.36'
            ]
        ]);
    }

    public function handle()
    {
        $requestedRegion = $this->argument('region');
        $regionsToProcess = $requestedRegion
            ? array_filter(
                $this->regions,
                fn($key) => $key === $requestedRegion,
                ARRAY_FILTER_USE_KEY
            )
            : $this->regions;

        foreach ($regionsToProcess as $regionKey => $region) {
            $this->info("Starting to crawl {$region['display']} prediction articles...");
            $this->crawlRegion($regionKey, $region);
            $this->info("Finished crawling {$region['display']} prediction articles");

            // Add delay between regions
            if (count($regionsToProcess) > 1) {
                sleep(5);
            }
        }

        return 0;
    }

    /**
     * Updated to:
     *  1) Use #article-content instead of .the-article-content
     *  2) Collect only <p>, <h1>, <h2>, <h3>, <table.th_picture>
     *  3) Skip <p><strong>Bài viết cũ hơn:</strong></p> + its next <p>
     *  4) Remove all <a>...</a>, keeping only text
     */
    protected function getArticleContent($url): string
    {
        try {
            $response = $this->client->get($url);
            $html = $response->getBody()->getContents();

            $crawler = new Crawler($html);

            // Target the container #article-content
            $articleContent = $crawler->filter('#article-content');
            if (!$articleContent->count()) {
                // If there's no such container, bail out
                return '';
            }

            // 4) Remove links from the DOM so that we only keep text.
            $articleContent->filter('a')->each(function (Crawler $link) {
                // Replace the <a> node with a text node containing its text content
                $link->getNode(0)->parentNode->replaceChild(
                    $link->getNode(0)->ownerDocument->createTextNode($link->text()),
                    $link->getNode(0)
                );
            });

            // 2) Grab only <p>, <h1>, <h2>, <h3>, <table.th_picture> within #article-content
            $contentNodes = $articleContent->filter('p, h1, h2, h3, table.th_picture');

            $content = [];
            $skipNextParagraph = false;

            $contentNodes->each(function (Crawler $node) use (&$content, &$skipNextParagraph) {
                // Convert the node to HTML
                $nodeHtml = $node->outerHtml();
                $nodeText = trim($node->text());

                // 3) Skip <p><strong>Bài viết cũ hơn:</strong></p> and its NEXT <p>
                //    If we see that text, we set a flag to skip the next <p>.
                if (Str::lower($nodeText) === 'bài viết cũ hơn:') {
                    // This is the <p><strong>Bài viết cũ hơn:</strong></p>
                    // so do not add it, and skip the next <p> as well
                    $skipNextParagraph = true;
                    return; // do not push this one into $content
                }

                // If the previous node triggered skip, and this node is a <p>, skip it
                // (You can refine this check if you only want to skip *exactly* a <p>).
                if ($skipNextParagraph && $node->nodeName() === 'p') {
                    $skipNextParagraph = false; // skip it only once
                    return;
                }

                // Add this element only if it has some non-empty text
                if (!empty(strip_tags($nodeHtml))) {
                    $content[] = $nodeHtml;
                }
            });

            // Join everything into a single HTML string
            $htmlContent = implode("\n", $content);

            // Replace domain occurrences if needed (same logic as before)
            $htmlContent = $this->replaceDomains($htmlContent);

            // Return the final article content
            return $htmlContent;
        } catch (\Exception $e) {
            Log::error("Error getting article content", [
                'url' => $url,
                'error' => $e->getMessage()
            ]);
            return '';
        }
    }

    /**
     * Replace only visible text occurrences of $this->sourceDomain
     * with $this->targetDomain, ignoring all attributes like src/href.
     */
    protected function replaceDomains($content): string
    {
        // Using a regex that finds text between closing and opening tags
        // > TEXT <
        // and applying a callback that replaces the domain only there.
        $content = preg_replace_callback('/>([^<]+)</u', function ($matches) {
            $text = $matches[1];

            // Replace the domain in visible text only
            $replaced = str_replace($this->sourceDomain, $this->targetDomain, $text);

            $replaced = str_replace('Xosothantai.mobi', $this->targetDomain, $replaced);

            // Return the text in between angle brackets exactly as captured
            return ">$replaced<";
        }, $content);

        return $content;
    }

    protected function addToSitemap($article)
    {
        $articleUrl = url("https://{$this->targetDomain}/tin-tuc/{$article->slug}");

        // Remove the article from sitemap first if it exists
        if (DB::table('sitemaps')->where('url', $articleUrl)->exists()) {
            $this->removeFromSitemap($article);
        }

        // Then insert new record
        DB::table('sitemaps')->insert([
            'url' => $articleUrl,
            'parent_path' => $article->is_prediction ? 'predictions.xml' : 'posts.xml',
            'last_modified' => now()->format('Y-m-d H:i:s'),
            'level' => 1,
            'is_index' => false,
            'priority' => '0.8',
            'changefreq' => 'daily',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    private function removeFromSitemap($article)
    {
        DB::table('sitemaps')
            ->where([
                'url' => url("https://{$this->targetDomain}/tin-tuc/{$article->slug}"),
                'parent_path' => $article->is_prediction ? 'predictions.xml' : 'posts.xml'
            ])
            ->delete();
    }

    protected function generateSlugFromTitle($title, $regionKey): string
    {
        // Remove any HTML tags and decode entities
        $title = strip_tags($title);
        $title = html_entity_decode($title);

        // Extract the date from the title using regex
        if (preg_match('/(\d{2})[\/\-](\d{2})[\/\-](\d{4})/', $title, $matches)) {
            $day = $matches[1];
            $month = $matches[2];
            $year = $matches[3];

            // Create the slug in the format: du-doan-xsmb-01-02-2025
            $slug = "du-doan-" . strtolower($regionKey) . "-{$day}-{$month}-{$year}";
            return $slug;
        }

        // Fallback to a safe slug if no date is found
        return Str::slug($title);
    }

    /**
     * Main region crawler logic
     */
    protected function crawlRegion($regionKey, $region)
    {
        try {
            // 1. Fetch the region URL
            $response = $this->client->get($this->baseUrl . $region['url']);
            $html = $response->getBody()->getContents();

            $crawler = new Crawler($html);

            // 2. Adjust the selector as needed to find your article list items
            //    For example, "#article-list li". If your structure is different, update accordingly.
            $articles = $crawler->filter('#article-list li')->each(function (Crawler $node) {
                return $node;
            });

            if (empty($articles)) {
                $this->info("No articles found for {$region['display']}");
                return;
            }

            // 3. Take only the first article (most recent)
            $articleNode = $articles[0];

            try {
                // --- TITLE & LINK ---
                // 4. Extract title and link. Adjust selector to your structure (e.g. 'h3 a').
                $titleElement = $articleNode->filter('h3 a');
                $title = $titleElement->text();
                $link = $titleElement->attr('href');

                $title = trim(preg_replace('/\s+/', ' ', $title));
                $title = str_replace($this->sourceDomain, $this->targetDomain, $title);

                // --- GENERATE SLUG ---
                $slug = $this->generateSlugFromTitle($title, $regionKey);

                // 5. Check if this article already exists
                if (Article::where('title', $title)->orWhere('slug', $slug)->exists()) {
                    $this->info("Latest article already exists: $title");
                    return;
                }

                // --- GET CONTENT ---
                $content = $this->getArticleContent($link);
                if (empty($content)) {
                    $this->warn("Empty content for article: $title");
                    return;
                }

                // --- CREATE ARTICLE ---
                $article = Article::create([
                    'title'           => $title,
                    'content'         => $content,
                    'is_published'    => true,
                    'is_prediction'   => true,
                    'prediction_type' => $regionKey,
                    'image'           => null
                ]);

                // Update slug if needed
                $article->update(['slug' => $slug]);

                // Add to sitemap
                $this->addToSitemap($article);

                $this->info("Created new article: $title");
                $this->info("Generated slug: $slug");

            } catch (\Exception $e) {
                $this->error("Error processing article: " . $e->getMessage());
                Log::error("Crawler error processing article", [
                    'error'  => $e->getMessage(),
                    'trace'  => $e->getTraceAsString(),
                    'region' => $regionKey
                ]);
            }
        } catch (\Exception $e) {
            $this->error("Fatal error processing {$region['display']}: " . $e->getMessage());
            Log::error("Crawler fatal error", [
                'error'  => $e->getMessage(),
                'trace'  => $e->getTraceAsString(),
                'region' => $regionKey
            ]);
        }
    }
}
