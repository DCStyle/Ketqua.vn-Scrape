<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
    <channel>
        <title>{{ $title }}</title>
        <link>{{ url('/') }}</link>
        <description>{{ $description }}</description>
        <language>{{ $language }}</language>
        <pubDate>{{ \Carbon\Carbon::parse($lastBuildDate)->toRssString() }}</pubDate>
        <lastBuildDate>{{ \Carbon\Carbon::parse($lastBuildDate)->toRssString() }}</lastBuildDate>
        <atom:link href="{{ url()->full() }}" rel="self" type="application/rss+xml" />

        @foreach($items as $item)
            <item>
                <title>{{ basename($item->url) }}</title>
                <link>{{ url(str_replace(config('url_mappings.source_domain'), request()->getHost(), $item->url)) }}</link>
                <guid>{{ url(str_replace(config('url_mappings.source_domain'), request()->getHost(), $item->url)) }}</guid>
                <pubDate>{{ \Carbon\Carbon::parse($item->last_modified)->toRssString() }}</pubDate>
            </item>
        @endforeach
    </channel>
</rss>
