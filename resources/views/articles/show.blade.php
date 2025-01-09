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

    <style>
        .article-detail {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 5px 30px rgba(0,0,0,0.05);
            overflow: hidden;
            padding: 0;
        }

        .featured-image {
            width: 100%;
            height: 400px;
            margin-bottom: 0;
        }

        .featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-header {
            padding: 2rem 3rem;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .meta-item {
            color: #6c757d;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .article-title {
            font-size: 2.5rem;
            font-weight: 800;
            line-height: 1.3;
            color: #2d3436;
            margin: 1rem 0;
        }

        .article-content {
            padding: 0 3rem;
            font-size: 1.15rem;
            line-height: 1.8;
            color: #4a4a4a;
        }

        .article-footer {
            padding: 2rem 3rem;
            margin-top: 3rem;
            background: #f8f9fa;
            border-top: 1px solid #eee;
        }

        .share-buttons {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .share-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: #2d3436;
        }

        .social-buttons {
            display: flex;
            gap: 1rem;
        }

        .social-button {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .social-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            color: #fff;
        }

        .social-button.twitter {
            background: #1DA1F2;
        }

        .social-button.facebook {
            background: #4267B2;
        }

        @media (max-width: 768px) {
            .featured-image {
                height: 300px;
            }

            .article-header {
                padding: 1.5rem;
            }

            .article-title {
                font-size: 1.8rem;
            }

            .article-content {
                padding: 0 1.5rem;
                font-size: 1.1rem;
            }

            .article-footer {
                padding: 1.5rem;
            }

            .social-button {
                width: 40px;
                height: 40px;
            }
        }
    </style>
@endsection
