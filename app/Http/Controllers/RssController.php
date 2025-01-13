<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class RssController extends Controller
{
    public function index()
    {
        $items = Cache::remember('rss_feed', 60, function () {
            return DB::table('sitemaps')
                ->whereNotNull('last_modified')
                ->where('is_index', false)
                ->orderBy('last_modified', 'desc')
                ->limit(100)
                ->get();
        });

        return response()
            ->view('feeds.rss', [
                'items' => $items,
                'title' => setting('site_name'),
                'description' => setting('site_description'),
                'language' => 'vi-VN',
                'lastBuildDate' => $items->first()?->last_modified ?? now(),
            ])
            ->header('Content-Type', 'application/xml');
    }

    public function category($category)
    {
        $items = Cache::remember("rss_feed_{$category}", 60, function () use ($category) {
            return DB::table('sitemaps')
                ->whereNotNull('last_modified')
                ->where('is_index', false)
                ->where('url', 'like', "%/{$category}/%")
                ->orderBy('last_modified', 'desc')
                ->limit(50)
                ->get();
        });

        return response()
            ->view('feeds.rss', [
                'items' => $items,
                'title' => setting('site_name') . " - {$category}",
                'description' => setting('site_description'),
                'language' => 'vi-VN',
                'lastBuildDate' => $items->first()?->last_modified ?? now(),
            ])
            ->header('Content-Type', 'application/xml');
    }
}
