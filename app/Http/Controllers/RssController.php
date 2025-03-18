<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RssController extends Controller
{
    /**
     * Cache duration in seconds (30 minutes)
     */
    private const CACHE_DURATION = 1800;

    /**
     * Source website domain
     */
    private const SOURCE_DOMAIN = 'xosodaiphat.com';

    /**
     * Display the main RSS feed
     *
     * @return Response
     */
    public function index()
    {
        $items = Article::orderBy('created_at', 'desc')
            ->limit(15)
            ->get();

        $lastBuildDate = $items->first()
            ? Carbon::parse($items->first()->last_modified)->setTimezone('Asia/Ho_Chi_Minh')
            : Carbon::now('Asia/Ho_Chi_Minh');

        return response()
            ->view('feeds.index', [
                'items' => $items,
                'title' => setting('site_name'),
                'description' => setting('site_description'),
                'language' => 'vi-VN',
                'lastBuildDate' => $lastBuildDate->toW3cString(),
            ])
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Display the RSS feed for a specific category
     *
     * @param string $category Category name
     * @return Response
     */
    public function category($category)
    {
        $items = Cache::remember("rss_feed_{$category}", self::CACHE_DURATION, function () use ($category) {
            return DB::table('sitemaps')
                ->whereNotNull('last_modified')
                ->where('is_index', false)
                ->where('parent_path', 'posts.xml')
                ->where('url', 'like', "%/{$category}/%")
                ->orderBy('last_modified', 'desc')
                ->limit(50)
                ->get();
        });

        $lastBuildDate = $items->first()
            ? Carbon::parse($items->first()->last_modified)->setTimezone('Asia/Ho_Chi_Minh')
            : Carbon::now('Asia/Ho_Chi_Minh');

        return response()
            ->view('feeds.index', [
                'items' => $items,
                'title' => setting('site_name') . " - {$category}",
                'description' => setting('site_description'),
                'language' => 'vi-VN',
                'lastBuildDate' => $lastBuildDate->toW3cString(),
            ])
            ->header('Content-Type', 'application/xml');
    }

    /**
     * Mirror RSS feed from source website
     *
     * @param string|null $path Feed path
     * @return Response
     */
    public function rss($path = null)
    {
        if ($path === null) {
            return response()->view('feeds.rss');
        }

        // Ensure path ends with .rss
        if (!preg_match('/\.rss$/', $path)) {
            $path .= '.rss';
        }

        // Handle special redirects
        if (in_array($path, ['tintuc.rss', 'tin-tuc.rss'])) {
            return redirect('/feed');
        }

        // Generate cache key and fetch content
        $cacheKey = 'rss_feed_' . str_replace(['/', '.'], ['_', '_'], $path);
        $content = $this->fetchAndCacheContent($path, $cacheKey);

        // Handle fetch failure
        if ($content === null) {
            return $this->generateErrorResponse();
        }

        // Transform content
        $appUrl = url('/');
        $content = $this->replaceDomainReferences($content, $appUrl);
        $content = $this->transformUrlPaths($content, $appUrl);

        // Return the transformed content
        return response($content)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }

    /**
     * Fetch and cache content from source website
     *
     * @param string $path Feed path
     * @param string $cacheKey Cache key
     * @return string|null
     */
    private function fetchAndCacheContent(string $path, string $cacheKey): ?string
    {
        return Cache::remember($cacheKey, self::CACHE_DURATION, function () use ($path) {
            $sourceUrl = "https://" . self::SOURCE_DOMAIN . "/{$path}";

            try {
                $response = $this->sendProxyRequest($sourceUrl);

                if ($response->successful()) {
                    return $response->body();
                }

                Log::error("Error fetching RSS feed: HTTP status {$response->status()} for URL {$sourceUrl}");
                return null;
            } catch (\Exception $e) {
                Log::error("Exception fetching RSS feed from {$sourceUrl}: " . $e->getMessage());
                return null;
            }
        });
    }

    /**
     * Send request through proxy service
     *
     * @param string $url Target URL
     * @param array $params Additional parameters (default: empty array)
     * @param string $method HTTP method (default: GET)
     * @return \Illuminate\Http\Client\Response
     */
    private function sendProxyRequest(string $url, array $params = [], string $method = 'GET'): \Illuminate\Http\Client\Response
    {
        $proxyUrl = 'https://caykeongot.com/proxy';
        $encodedUrl = base64_encode(rtrim($url, '/'));

        return Http::timeout(300)->get($proxyUrl . '?url=' . $encodedUrl);
    }

    /**
     * Replace domain references in content
     *
     * @param string $content XML content
     * @param string $appUrl Application URL
     * @return string
     */
    private function replaceDomainReferences(string $content, string $appUrl): string
    {
        $appHost = parse_url($appUrl, PHP_URL_HOST);
        $sourceDomain = self::SOURCE_DOMAIN;

        $replacements = [
            "https://{$sourceDomain}" => $appUrl,
            "http://{$sourceDomain}" => $appUrl,
            $sourceDomain => $appHost,
            "www.{$sourceDomain}" => $appHost,
            "https://www.{$sourceDomain}" => $appUrl,
            "http://www.{$sourceDomain}" => $appUrl
        ];

        foreach ($replacements as $search => $replace) {
            $content = str_replace($search, $replace, $content);
        }

        return $content;
    }

    /**
     * Transform URL paths in content
     *
     * @param string $content XML content
     * @param string $appUrl Application URL
     * @return string
     */
    private function transformUrlPaths(string $content, string $appUrl): string
    {
        // Transform main region URLs
        $content = preg_replace(
            [
                '|' . preg_quote($appUrl) . '/xsmb-(\d{2}-\d{2}-\d{4})\.html|',
                '|' . preg_quote($appUrl) . '/xsmn-(\d{2}-\d{2}-\d{4})\.html|',
                '|' . preg_quote($appUrl) . '/xsmt-(\d{2}-\d{2}-\d{4})\.html|'
            ],
            [
                $appUrl . '/xsmb/$1',
                $appUrl . '/xsmn/$1',
                $appUrl . '/xsmt/$1'
            ],
            $content
        );

        // Transform Southern region province URLs
        $content = $this->transformRegionProvinceUrls($content, $appUrl, $this->getSouthernRegionMappings());

        // Transform Central region province URLs
        $content = $this->transformRegionProvinceUrls($content, $appUrl, $this->getCentralRegionMappings());

        return $content;
    }

    /**
     * Transform region-specific province URLs
     *
     * @param string $content XML content
     * @param string $appUrl Application URL
     * @param array $mappings Province code mappings
     * @return string
     */
    private function transformRegionProvinceUrls(string $content, string $appUrl, array $mappings): string
    {
        foreach ($mappings as $code => $path) {
            $content = preg_replace(
                '|' . preg_quote($appUrl) . '/' . $code . '-(\d{2}-\d{2}-\d{4})\.html|',
                $appUrl . '/' . $path . '/$1',
                $content
            );
        }

        return $content;
    }

    /**
     * Get Southern region province mappings
     *
     * @return array
     */
    private function getSouthernRegionMappings(): array
    {
        return [
            'xsag' => 'xsmn/kqxs-an-giang',
            'xsbd' => 'xsmn/kqxs-binh-duong',
            'xsbl' => 'xsmn/kqxs-bac-lieu',
            'xsbp' => 'xsmn/kqxs-binh-phuoc',
            'xsbth' => 'xsmn/kqxs-binh-thuan',
            'xsbtr' => 'xsmn/kqxs-ben-tre',
            'xscm' => 'xsmn/kqxs-ca-mau',
            'xsct' => 'xsmn/kqxs-can-tho',
            'xsdl' => 'xsmn/kqxs-da-lat',
            'xsdn' => 'xsmn/kqxs-dong-nai',
            'xsdt' => 'xsmn/kqxs-dong-thap',
            'xshcm' => 'xsmn/kqxs-ho-chi-minh',
            'xshg' => 'xsmn/kqxs-hau-giang',
            'xskg' => 'xsmn/kqxs-kien-giang',
            'xsla' => 'xsmn/kqxs-long-an',
            'xsst' => 'xsmn/kqxs-soc-trang',
            'xstg' => 'xsmn/kqxs-tien-giang',
            'xstn' => 'xsmn/kqxs-tay-ninh',
            'xstv' => 'xsmn/kqxs-tra-vinh',
            'xsvl' => 'xsmn/kqxs-vinh-long',
            'xsvt' => 'xsmn/kqxs-vung-tau'
        ];
    }

    /**
     * Get Central region province mappings
     *
     * @return array
     */
    private function getCentralRegionMappings(): array
    {
        return [
            'xsbdi' => 'xsmt/kqxs-binh-dinh',
            'xsdlk' => 'xsmt/kqxs-dak-lak',
            'xsdna' => 'xsmt/kqxs-da-nang',
            'xsdno' => 'xsmt/kqxs-dak-nong',
            'xsgl' => 'xsmt/kqxs-gia-lai',
            'xskh' => 'xsmt/kqxs-khanh-hoa',
            'xskt' => 'xsmt/kqxs-kon-tum',
            'xsnt' => 'xsmt/kqxs-ninh-thuan',
            'xspy' => 'xsmt/kqxs-phu-yen',
            'xsqb' => 'xsmt/kqxs-quang-binh',
            'xsqna' => 'xsmt/kqxs-quang-nam',
            'xsqng' => 'xsmt/kqxs-quang-ngai',
            'xsqt' => 'xsmt/kqxs-quang-tri',
            'xstth' => 'xsmt/kqxs-hue'
        ];
    }

    /**
     * Generate error response for unavailable feeds
     *
     * @return Response
     */
    private function generateErrorResponse(): Response
    {
        $errorXml = '<?xml version="1.0" encoding="UTF-8"?>' .
            '<rss version="2.0">' .
            '<channel>' .
            '<title>Error</title>' .
            '<description>Feed not available</description>' .
            '</channel>' .
            '</rss>';

        return response($errorXml, 404)
            ->header('Content-Type', 'application/xml; charset=utf-8');
    }
}
