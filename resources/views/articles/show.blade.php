@extends('layouts.app')

@section('seo')
    {!! seo($article->getDynamicSEOData()) !!}
@endsection

@section('content')
    <div class="articles-wrapper">
        <div class="row p-b-50 layout-margin mt-4">
            <div class="col-md-8 col-lg-9 layout-padding">
                <article class="article-detail">
                    <!-- Featured Image -->
                    @if($article->image)
                        <div class="featured-image mb-4">
                            <img src="{{ Storage::url($article->image) }}"
                                 alt="{{ $article->title }}">
                        </div>
                    @endif

                    <!-- Article Header -->
                    <header class="article-header">
                        <div class="article-meta mb-2">
                       <span class="meta-item">
                           <i class="fas fa-calendar"></i>
                           {{ $article->created_at->format('M d, Y') }}
                       </span>
                            <span class="meta-item">
                           <i class="fas fa-clock"></i>
                           {{ $article->readTime() }}
                       </span>
                        </div>
                        <h1 class="article-title">{{ $article->title }}</h1>
                    </header>

                    <!-- Article Content -->
                    <div class="article-content">
                        {!! $article->content !!}
                    </div>

                    <!-- Article Footer -->
                    <footer class="article-footer">
                        <div class="share-buttons">
                            <span class="share-label">Share this article</span>
                            <div class="social-buttons">
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}"
                                   target="_blank"
                                   class="social-button twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                   target="_blank"
                                   class="social-button facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </div>
                        </div>
                    </footer>

                    <!-- Related Articles -->
                    @include('articles.related_articles', ['relatedArticles' => $relatedArticles])
                </article>
            </div>

            @include('partials.sidebar')
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/article.css') }}" />

    @if($article->is_prediction)
        <link rel="stylesheet" href="{{ asset('css/article_prediction.css') }}" />
    @endif
@endpush
