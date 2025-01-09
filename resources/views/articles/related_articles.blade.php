<div class="related-articles mt-5">
    <h3 class="related-title">Tin liên quan</h3>

    @foreach($relatedArticles as $article)
        <div class="related-card">
            <div class="related-image">
                <img src="{{ $article->image ? Storage::url($article->image) : 'https://placehold.co/200' }}" alt="{{ $article->title }}">
            </div>
            <div class="related-content">
                <h4 class="related-heading">
                    <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                </h4>
                <p class="related-excerpt">{{ $article->exceprt() }}</p>
            </div>
        </div>
    @endforeach
</div>

<style>
    .related-articles {
        padding: 3rem 1rem 0;
        border-top: 1px solid #eee;
    }

    .related-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 2rem;
    }

    .related-card {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #eee;
    }

    .related-card:last-child {
        border-bottom: none;
    }

    .related-image {
        flex: 0 0 200px;
        height: 140px;
    }

    .related-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .related-content {
        flex: 1;
    }

    .related-heading {
        font-size: 1.2rem;
        margin: 0 0 0.8rem;
        line-height: 1.4;
    }

    .related-heading a {
        color: #2d3436;
        text-decoration: none;
        transition: color 0.3s;
    }

    .related-heading a:hover {
        color: #0056b3;
    }

    .related-excerpt {
        color: #666;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0;
    }

    @media (max-width: 768px) {
        .related-card {
            flex-direction: column;
            gap: 1rem;
        }

        .related-image {
            flex: 0 0 auto;
            height: 200px;
        }
    }
</style>
