@extends('layouts.app')

@section('seo')
    {!! seo($SEOData) !!}
@endsection

@section('content')
    <div class="articles-wrapper">
        <nav aria-label="breadcrumb" class="mt-2 mb-2">
            <ol class="breadcrumb mb-0 txt-sub-content" itemscope="" itemtype="https://schema.org/BreadcrumbList">
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                    <a class="text-decoration-none" itemprop="item" href="https://kqxshn.org" title="Kết quả">
                        <span itemprop="name">Kết quả</span>
                        <meta itemprop="position" content="1">
                    </a>
                </li>
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem">
                    <a class="text-decoration-none" itemprop="item" href="/du-doan-xsmb" title="{{ $typeTitle }}">
                        <span itemprop="name">{{ $typeTitle }}</span>
                        <meta itemprop="position" content="2">
                    </a>
                </li>
            </ol>
        </nav>

        <div class="row p-b-50 layout-margin mt-4">
            <div class="col-md-8 col-lg-9 layout-padding">
                @foreach($latestArticles as $article)
                    <article class="card article-card mb-4" data-aos="fade-up">
                        <div class="row g-0">
                            <div class="col-md-4 article-image-wrapper">
                                <img src="{{ $article->getThumbnail() }}"
                                     alt="{{ $article->title }}"
                                     class="article-image"
                                >
                                <span class="reading-time">
                                    <i class="fas fa-clock"></i>
                                    {{ $article->readTime() }}
                                </span>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="article-meta mb-2">
                                   <span class="date">
                                       <i class="fas fa-calendar"></i>
                                       {{ $article->created_at->format('M d, Y') }}
                                   </span>
                                    </div>
                                    <h2 class="article-title">
                                        <a href="{{ route('articles.show', $article->slug) }}">
                                            {{ $article->title }}
                                        </a>
                                    </h2>
                                    <p class="article-excerpt">
                                        {{ $article->exceprt() }}
                                    </p>
                                    <a href="{{ route('articles.show', $article->slug) }}" class="read-more">
                                        Đọc tiếp
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach

                <div class="pagination-wrapper">
                    {{ $latestArticles->links() }}
                </div>
            </div>

            @include('partials.sidebar')
        </div>
    </div>

    <style>
        .article-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 250px; /* Set fixed height for card */
        }

        .row.g-0 {
            height: 100%;
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .article-image-wrapper {
            position: relative;
            height: 100%;
            overflow: hidden;
        }

        .article-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .article-card:hover .article-image {
            transform: scale(1.05);
        }

        .reading-time {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255,255,255,0.9);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            color: #333;
            backdrop-filter: blur(5px);
        }

        .article-title {
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .article-title a {
            color: #2d3436;
            text-decoration: none;
            transition: color 0.3s;
        }

        .article-title a:hover {
            color: #0056b3;
        }

        .article-meta {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .article-excerpt {
            color: #666;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #0056b3;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
        }

        .read-more:hover {
            gap: 0.8rem;
            color: #003d82;
        }

        .pagination-wrapper {
            margin-top: 3rem;
            display: flex;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .article-card {
                height: auto; /* Allow flexible height on mobile */
            }

            .article-image-wrapper {
                height: 200px;
            }

            .article-title {
                font-size: 1.2rem;
            }
        }
    </style>
@endsection
