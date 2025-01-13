<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SitemapController extends Controller
{
    public function index()
    {
        $mainSitemaps = DB::table('sitemaps')
            ->whereNull('parent_path')
            ->get()
            ->map(fn($item) => $this->formatUrl($item));

        return response()->view('sitemaps.urlset', [
            'urls' => $mainSitemaps
        ])->header('Content-Type', 'text/xml');
    }

    public function show($path)
    {
        // Add .xml to path if it doesn't have
        if (!preg_match('/\.xml$/', $path)) {
            $path .= '.xml';
        }

        $config = config('url_mappings');
        $sourceDomain = $config['source_domain'];

        // Handle result index sitemap
        if ($path === 'results.xml') {
            $urls = DB::table('sitemaps')
                ->where('parent_path', 'results.xml')
                // Where url is not end with results.xml
                ->where('url', 'not like', '%results.xml')
                ->get()
                ->map(fn($item) => $this->formatSitemapUrl($item));

            return response()->view('sitemaps.sitemapindex', [
                'urls' => $urls
            ])->header('Content-Type', 'text/xml');
        }

        // Handle yearly result sitemaps
        if (preg_match('/result-(\d{4})\.xml/', $path, $matches)) {
            $year = $matches[1];

            $query = DB::table('sitemaps')
                ->where('parent_path', $path)
                ->whereYear('last_modified', $year)
                ->orderBy('url');

            $totalUrls = $query->count();
            $urls = $query
                ->get()
                ->map(fn($item) => $this->formatUrl($item));

            return response()->view('sitemaps.urlset', [
                'urls' => $urls
            ])->header('Content-Type', 'text/xml');
        }

        // Handle other sitemaps
        $urls = DB::table('sitemaps')
            ->where('parent_path', $path)
            ->orderBy('url')
            ->get()
            ->map(fn($item) => $this->formatUrl($item));

        return response()->view('sitemaps.urlset', [
            'urls' => $urls
        ])->header('Content-Type', 'text/xml');
    }

    private function formatUrl($item)
    {
        $sourceDomain = config('url_mappings.source_domain');
        return [
            'loc' => str_replace($sourceDomain, request()->getHost(), $item->url),
            'lastmod' => $item->last_modified ?? now()->format('c'),
            'changefreq' => $item->changefreq ?? 'daily',
            'priority' => $item->priority ?? '0.5'
        ];
    }

    private function formatSitemapUrl($item)
    {
        $sourceDomain = config('url_mappings.source_domain');
        return [
            'loc' => str_replace($sourceDomain, request()->getHost(), $item->url),
            'lastmod' => $item->last_modified ?? now()->format('c')
        ];
    }
}
