<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($urls as $url)
        <url>
            <loc>{{ $url['loc'] }}</loc>
            <lastmod>{{ $url['lastmod'] }}</lastmod>
            <changefreq>{{ $url['changefreq'] }}</changefreq>
            <priority>{{ $url['priority'] }}</priority>
        </url>
    @endforeach

    @isset($hasMore)
        @if($hasMore)
            <url>
                <loc>{{ request()->url() . '?page=' . $nextPage }}</loc>
                <changefreq>daily</changefreq>
                <priority>0.8</priority>
            </url>
        @endif
    @endisset
</urlset>