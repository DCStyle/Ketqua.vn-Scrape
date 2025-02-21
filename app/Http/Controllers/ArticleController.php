<?php

namespace App\Http\Controllers;

use App\Models\Article;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class ArticleController extends Controller
{
    public function index()
    {
        // Get latest paginated articles
        $latestArticles = Article::latest()
            ->where('is_published', 1)
            ->where('is_prediction', false)
            ->paginate(10);

        $customMetadata = $this->getMetadata();
        $SEOData = new SEOData(
            $customMetadata['title'] ?? null,
            $customMetadata['description'] ?? null
        );

        return view('articles.index', compact('latestArticles', 'SEOData'));
    }

    public function prediction($type)
    {
        if (!in_array($type, ['xsmb', 'xsmt', 'xsmn'])) {
            abort(404);
        }

        // Get latest paginated prediction articles
        $latestArticles = Article::latest()
            ->where('is_published', 1)
            ->where('is_prediction', true)
            ->where('prediction_type', $type)
            ->paginate(10);

        $customMetadata = $this->getMetadata();
        $SEOData = new SEOData(
            $customMetadata['title'] ?? null,
            $customMetadata['description'] ?? null
        );

        return view('articles.prediction', compact('latestArticles', 'SEOData'));
    }

    public function show(Article $article)
    {
        // If no slug, redirect to the article list
        if (!$article->slug) {
            return redirect()->route('articles.index');
        }

        // Check if article is published
        if (!$article->is_published) {
            abort(404);
        }

        // Get related articles
        $relatedArticles = Article::where('id', '!=', $article->id);

        if ($article->is_prediction) {
            $relatedArticles = $relatedArticles
                ->where('is_prediction', 1)
                ->where('prediction_type', $article->prediction_type);
        } else {
            $relatedArticles = $relatedArticles->where('is_prediction', 0);
        }

        $relatedArticles = $relatedArticles->where('is_published', 1)
            ->latest()
            ->limit(5)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }
}
