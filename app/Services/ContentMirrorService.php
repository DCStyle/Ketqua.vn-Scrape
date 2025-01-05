<?php

namespace App\Services;

use App\Exceptions\TooManyRequestsException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\DomCrawler\Crawler;

class ContentMirrorService
{
    private $urlMappings;
    private $sourceDomain;

    private $userAgents = [
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/91.0.4472.124',
        'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) Safari/537.36',
        'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:89.0) Gecko/20100101 Firefox/89.0'
    ];

    public function __construct()
    {
        $config = config('url_mappings');
        $this->urlMappings = collect($config['paths']);
        $this->sourceDomain = $config['source_domain'];
    }

    public function makeRequest(string $path, array $params, string $template, string $selector, string $sourceUrl, string $method = 'POST'): ?array
    {
        if (!$this->checkRateLimit()) {
            throw new TooManyRequestsException();
        }

        $cacheKey = $this->generateCacheKey($path, $params);

        if (!(bool)setting('cache_enabled')) {
            return $this->fetchAndProcessContent($path, $params, $template, $selector, $sourceUrl, $method);
        }

        return Cache::remember($cacheKey, setting('cache_lifetime', 5) * 60, function () use ($path, $params, $template, $selector, $sourceUrl, $method) {
            return $this->fetchAndProcessContent($path, $params, $template, $selector, $sourceUrl, $method);
        });
    }

    private function fetchAndProcessContent(string $path, array $params, string $template, string $selector, string $sourceUrl, string $method): ?array
    {
        try {
            $response = $this->sendRequest($sourceUrl . '/' . $path, $params, $method);

            if (!$response->successful()) {
                throw new \Exception("Failed to fetch content: {$response->status()}");
            }

            $content = $this->extractContent($response->body(), $selector);

            return [
                'content' => $this->processContent($content),
                'template' => $template
            ];
        } catch (\Exception $e) {
            Log::error("Request failed for {$path}: " . $e->getMessage());
            return null;
        }
    }

    public function getContent(string $path): ?array
    {
        $customMapping = $this->urlMappings->first(function ($mapping) use ($path) {
            return isset($mapping['our_paths'][$path]);
        });

        if ($customMapping) {
            return [
                'content' => null,
                'template' => $customMapping['our_paths'][$path]
            ];
        }

        $defaultConfig = config('url_mappings.default_scrape');
        return $this->makeRequest(
            $path,
            [],
            $defaultConfig['template'],
            $defaultConfig['main_selector'],
            $defaultConfig['source_url'],
            'GET'
        );
    }

    private function checkRateLimit(): bool
    {
        return RateLimiter::attempt('scraping', 60, function() { return true; });
    }

    private function generateCacheKey(string $path, array $params): string
    {
        return 'page_' . md5($path . serialize($params));
    }

    private function sendRequest(string $url, array $params, string $method): \Illuminate\Http\Client\Response
    {
        return Http::timeout(30)
            ->withHeaders([
                'User-Agent' => $this->getRandomUserAgent()
            ])
            ->send($method, rtrim($url, '/'), ['form_params' => $params]);
    }

    private function extractContent(string $html, string $selector): string
    {
        $crawler = new Crawler($html);
        return $crawler->filter($selector)->html();
    }

    private function processContent($content)
    {
        $ourDomain = rtrim(env('APP_URL'), '/');

        $crawler = new Crawler($content);

        // Remove only the lottery checking form
        $crawler->filter('.br-10.table-shadow.overflow-hidden.m-b-15.bg-white')->each(function ($node) {
            try {
                $link = $node->filter('h3 a');
                if ($link->count() > 0 && trim($link->text()) === 'Dò Vé Số') {
                    $node->getNode(0)->parentNode->removeChild($node->getNode(0));
                }
            } catch (\Exception $e) {
                // Skip nodes that don't match our structure
            }
        });

        // Remove existing click handlers
        $crawler->filter('[onclick="loadMoreResults(this);"]')->each(function ($node) {
            $node->getNode(0)->parentNode->removeChild($node->getNode(0));
        });

        $content = $crawler->html();

        // Fix URLs in order
        $content = preg_replace(
            [
                '#href="https?://' . preg_quote($this->sourceDomain, '#') . '/#',
                '#href="https?://' . preg_quote($ourDomain, '#') . '/#',
                '#(href|src)="/#'
            ],
            [
                'href="/',
                'href="/',
                '$1="/'
            ],
            $content
        );

        // Replace all root URLs with our domain
        $content = str_replace($this->sourceDomain, url($ourDomain), $content);

        return $content;
    }

    private function getRandomUserAgent()
    {
        return $this->userAgents[array_rand($this->userAgents)];
    }

    private function getCustomContent($mapping)
    {
        return view($mapping['template'])->render();
    }

    private function getScrapedContent($mapping, $path)
    {
        $cacheEnabled = setting('cache_enabled');

        if ($cacheEnabled) {
            return Cache::remember('page_' . md5($path), setting('cache_lifetime'), function() use ($mapping, $path) {
                return $this->scrapeContent($mapping, $path);
            });
        } else {
            return $this->scrapeContent($mapping, $path);
        }
    }

    private function scrapeContent($mapping, $path)
    {
        if (! RateLimiter::attempt('scraping', 60, function() { })) {
            throw new TooManyRequestsException();
        }

        try {
            $sourceUrl = $mapping['source_url'] . $path;
            $response = Http::withHeaders([
                'User-Agent' => $this->getRandomUserAgent()
            ])->get($sourceUrl);

            if (!$response->successful()) {
                throw new \Exception("Failed to fetch content: {$response->status()}");
            }

            $crawler = new Crawler($response->body());
            $content = $crawler->filter($mapping['main_selector'])->html();
            return $this->processContent($content);
        } catch (\Exception $e) {
            Log::error("Scraping failed for {$path}: " . $e->getMessage());
            return Cache::get('page_' . md5($path));
        }
    }
}
