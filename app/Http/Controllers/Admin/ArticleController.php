<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $article = new Article();

        return view('admin.articles.add_edit', compact('article'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        $article = Article::create($validated);

        $this->attachContentImages($article, $validated['content']);

        if ($article->is_published) {
            $this->addToSitemap($article);
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article created successfully');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.add_edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
            'is_published' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string'
        ]);

        if ($request->hasFile('image')) {
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        $wasPublished = $article->is_published;
        $article->update($validated);

        $this->attachContentImages($article, $validated['content']);

        if (!$wasPublished && $article->is_published) {
            $this->addToSitemap($article);
        } elseif ($wasPublished && !$article->is_published) {
            $this->removeFromSitemap($article);
        }

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article updated successfully');
    }

    public function destroy(Article $article)
    {
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article deleted successfully');
    }

    private function attachContentImages($article, $content)
    {
        preg_match_all('/<img[^>]+src="([^">]+)"/', $content, $matches);

        if (!empty($matches[1])) {
            foreach ($matches[1] as $src) {
                $path = str_replace(asset('storage/'), '', $src);
                Image::where('path', $path)
                    ->whereNull('imageable_type')
                    ->update([
                        'imageable_type' => Article::class,
                        'imageable_id' => $article->id
                    ]);
            }
        }
    }

    private function addToSitemap($article)
    {
        $sourceDomain = 'https://' . config('url_mappings.source_domain');
        $articleUrl = url("{$sourceDomain}/tin-tuc/{$article->slug}");

        if (!DB::table('sitemaps')->where('url', $articleUrl)->exists()) {
            DB::table('sitemaps')->insert([
                'url' => $articleUrl,
                'parent_path' => 'posts.xml',
                'last_modified' => now()->toW3cString(),
                'level' => 1,
                'is_index' => false,
                'priority' => '0.8',
                'changefreq' => 'daily',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            DB::table('sitemaps')
                ->where('url', $articleUrl)
                ->update([
                    'last_modified' => now()->toW3cString(),
                    'updated_at' => now()
                ]);
        }
    }

    private function removeFromSitemap($article)
    {
        $sourceDomain = 'https://' . config('url_mappings.source_domain');
        DB::table('sitemaps')
            ->where([
                'url' => url("{$sourceDomain}/tin-tuc/{$article->slug}"),
                'parent_path' => 'posts.xml'
            ])
            ->delete();
    }
}
