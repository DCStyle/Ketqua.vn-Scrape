<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class Article extends Model
{
    use HasSEO;

    protected $fillable = [
        'title', 'slug', 'content', 'image', 'is_published', 'meta_title', 'meta_description'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            // Prepare slug before saving
            $slug = Str::slug($article->title);

            // Check if slug already exists
            $count = Article::where('slug', 'like', $slug . '%')->count();
            if ($count > 0) {
                // Check if slug already exists using a while loop
                $i = 1;
                while (Article::where('slug', $slug)->exists()) {
                    $slug = Str::slug($article->title . '-' . $i);
                    $i++;
                }
            }

            $article->slug = $slug;
        });
    }

    protected static function booted()
    {
        static::deleting(function($article) {
            $article->images->each(function($image) {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            });
        });
    }

    public function exceprt($length = 200)
    {
        return Str::limit(strip_tags(html_entity_decode($this->content)), $length);
    }

    public function readTime()
    {
        $wordCount = str_word_count(strip_tags(html_entity_decode($this->content)));
        $minutes = floor($wordCount / 200);
        $seconds = floor($wordCount % 200 / (200 / 60));
        $time = '';
        if ($minutes) {
            $time .= $minutes . ' phút';
        }
        if ($seconds) {
            $time .= ' ' . $seconds . ' giây';
        }
        return $time;
    }

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->meta_title && $this->meta_title !== '' ? $this->meta_title : $this->title,
            description: $this->meta_description && $this->meta_description !== '' ? $this->meta_description : $this->exceprt(),
            image: Storage::url($this->image)
        );
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
