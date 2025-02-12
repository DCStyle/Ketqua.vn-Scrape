<?php

namespace App\Console\Commands;

use App\Models\Article;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Log;

class CrawlPredictionArticles extends Command
{
    protected $signature = 'crawl:predictions {region?}';
    protected $description = 'Crawl lottery prediction articles from dubaoketqua.net';

    protected $client;
    protected $baseUrl = 'https://dubaoketqua.net';
    protected $targetDomain = 'kqxshn.org';
    protected $sourceDomain = 'dubaoketqua.net';

    protected $regions = [
        'xsmb' => [
            'url' => '/du-doan-xsmb',
            'type' => 'xsmb',
            'display' => 'XSMB'
        ],
        'xsmt' => [
            'url' => '/du-doan-xsmt',
            'type' => 'xsmt',
            'display' => 'XSMT'
        ],
        'xsmn' => [
            'url' => '/du-doan-xsmn',
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
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
            ]
        ]);
    }

    public function handle()
    {
        $requestedRegion = $this->argument('region');
        $regionsToProcess = $requestedRegion ?
            array_filter($this->regions, fn($key) => $key === $requestedRegion, ARRAY_FILTER_USE_KEY) :
            $this->regions;

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

    protected function getArticleContent($url): string
    {
        try {
            $response = $this->client->get($url);
            $html = $response->getBody()->getContents();

            $crawler = new Crawler($html);
            $content = [];

            // Get the article content container
            $articleContent = $crawler->filter('.the-article-content');

            // Process headings (h2, h3)
            $headings = $articleContent->filter('h2, h3')->each(function (Crawler $node) {
                return $node->outerHtml();
            });
            $content = array_merge($content, $headings);

            // Process paragraphs without class
            $paragraphs = $articleContent->filter('p:not([class])')->each(function (Crawler $node) {
                return $node->outerHtml();
            });
            $content = array_merge($content, $paragraphs);

            // Process specific div classes
            $divs = $articleContent->filter('div.box, div.table_dudoan_wrapper, div.pascal')->each(function (Crawler $node) {
                return $node->outerHtml();
            });
            $content = array_merge($content, $divs);

            // Filter out empty elements and join
            $content = array_filter($content, function($element) {
                return !empty(trim(strip_tags($element)));
            });

            // Convert array to HTML string
            $htmlContent = implode("\n", $content);

            // Replace source domain with target domain in URLs and text
            $htmlContent = $this->replaceDomains($htmlContent);

            // Add special handling for <br> tags
            $htmlContent = str_replace(['<br>', '<br/>', '<br />'], "\n", $htmlContent);

            return $htmlContent;

        } catch (\Exception $e) {
            Log::error("Error getting article content", [
                'url' => $url,
                'error' => $e->getMessage()
            ]);
            return '';
        }
    }

    protected function replaceDomains($content): string
    {
        // Replace in URLs (href and src attributes)
        $patterns = [
            '/(href=[\'"](https?:\/\/)?)' . preg_quote($this->sourceDomain, '/') . '/i',
            '/(src=[\'"](https?:\/\/)?)' . preg_quote($this->sourceDomain, '/') . '/i',
            '/(' . preg_quote($this->sourceDomain, '/') . ')/i'
        ];

        foreach ($patterns as $pattern) {
            $content = preg_replace($pattern, '${1}' . $this->targetDomain, $content);
        }

        // Replace in text content
        $content = str_replace($this->sourceDomain . $this->targetDomain, $this->targetDomain, $content);
        $content = str_replace($this->sourceDomain, $this->targetDomain, $content);

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
        return \Str::slug($title);
    }

    protected function crawlRegion($regionKey, $region)
    {
        try {
            // Get the main page content
            $response = $this->client->get($this->baseUrl . $region['url'] . '?page=1');
            $html = $response->getBody()->getContents();

            // Create a new Crawler instance
            $crawler = new Crawler($html);

            // Get only the first (latest) article element
            $articles = $crawler->filter('#article-list li')->each(function (Crawler $node) {
                return $node;
            });

            if (empty($articles)) {
                $this->info("No articles found for {$region['display']}");
                return;
            }

            // Take only the first article (most recent)
            $article = $articles[0];

            try {
                // Extract title and link
                $titleElement = $article->filter('h3 a');
                $title = $titleElement->text();
                $link = $titleElement->attr('href');

                // Clean up the title and replace domain in title if present
                $title = trim(preg_replace('/\s+/', ' ', $title));
                $title = str_replace($this->sourceDomain, $this->targetDomain, $title);

                // Generate the custom slug
                $slug = $this->generateSlugFromTitle($title, $regionKey);

                // Check if article already exists (now checking by slug too)
                if (Article::where('title', $title)->orWhere('slug', $slug)->exists()) {
                    $this->info("Latest article already exists: $title");
                    return;
                }

                // Get article content
                $content = $this->getArticleContent($link);

                if (empty($content)) {
                    $this->warn("Empty content for article: $title");
                    return;
                }

                // Create new article
                $article = Article::create([
                    'title' => $title,
                    'content' => $content,
                    'is_published' => true,
                    'is_prediction' => true,
                    'prediction_type' => $regionKey
                ]);

                // Update the slug
                $article->update(['slug' => $slug]);

                // Add the article to sitemap
                $this->addToSitemap($article);

                $this->info("Created new article: $title");
                $this->info("Generated slug: $slug");

            } catch (\Exception $e) {
                $this->error("Error processing article: " . $e->getMessage());
                Log::error("Crawler error processing article", [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                    'region' => $regionKey
                ]);
            }

        } catch (\Exception $e) {
            $this->error("Fatal error processing {$region['display']}: " . $e->getMessage());
            Log::error("Crawler fatal error", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'region' => $regionKey
            ]);
        }
    }
}
