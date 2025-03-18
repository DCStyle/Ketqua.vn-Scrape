<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SitemapGoogleNewsController extends Controller
{
    public function index()
    {
        $items = Article::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($article) {
                return [
                    'title' => $article->title,
                    'link' => route('articles.show', $article->slug),
                    'image' => Str::startsWith($article->image, 'http') ? $article->image : Storage::url($article->image),
                    'published' => \Illuminate\Support\Carbon::parse($article->created_at)
                        ->setTimezone('Asia/Ho_Chi_Minh')
                        ->toW3cString(),
                    'lastModified' => \Illuminate\Support\Carbon::parse($article->updated_at)
                        ->setTimezone('Asia/Ho_Chi_Minh')
                        ->toW3cString(),
                ];
            });

        return response()
            ->view('sitemaps.google-news', [
                'siteName' => url('/'),
                'items' => $items,
                'language' => 'vi',
                'location' => 'Việt Nam',
            ])
            ->header('Content-Type', 'application/xml');
    }
}
