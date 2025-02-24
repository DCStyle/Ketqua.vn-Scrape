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
                        <!-- Breadcrumb -->
                        <nav aria-label="breadcrumb" class="mb-2">
                            <ol class="breadcrumb mb-0 txt-sub-content" itemscope itemtype="https://schema.org/BreadcrumbList">
                                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                    <a class="text-decoration-none" itemprop="item"
                                       href="{{ config('url') }}"
                                       title="Kết quả">
                                        <span itemprop="name">Kết quả</span>
                                        <meta itemprop="position" content="1">
                                    </a>
                                </li>

                                @if($isPrediction)
                                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                        <a class="text-decoration-none" itemprop="item" href="{{ route('articles.prediction', ['type' => $article->prediction_type]) }}" title="{{ $predictionTypeTitle }}">
                                            <span itemprop="name">{{ $predictionTypeTitle }}</span>
                                            <meta itemprop="position" content="2">
                                        </a>
                                    </li>
                                @else
                                    <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                        <a class="text-decoration-none" itemprop="item" href="{{ route('articles.index') }}" title="Tin tức">
                                            <span itemprop="name">Tin tức</span>
                                            <meta itemprop="position" content="2">
                                        </a>
                                    </li>
                                @endif

                                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                                    <span itemprop="name">{{ $article->title }}</span>
                                    <meta itemprop="position" content="3">
                                </li>
                            </ol>
                        </nav>

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

                        <h1 class="article-title">
                            {{ $article->title }}
                        </h1>
                    </header>

                    <!-- Article Content -->
                    <div class="article-content">
                        {!! $article->content !!}
                    </div>

                    <!-- Article Author -->
                    <div class="article-author px-4">
                        <div class="d-flex justify-content-end">
                            <h4 class="author-name text-sm text-gray-600">
                                {{ $article->user->name }}
                            </h4>
                        </div>
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
