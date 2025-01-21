<?xml version="1.0" encoding="UTF-8" ?>
<rss xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:webfeeds="http://webfeeds.org/rss/1.0" xmlns:media="http://search.yahoo.com/mrss/" version="2.0">
    <channel>
        <title>{{ $title }}</title>
        <link>{{ route('rss.index') }}</link>
        <description>{{ "<![CDATA[ " . $description . " ]]>" }}</description>
        <atom:link href="{{ route('articles.index') }}" rel="self" type="application/rss+xml"/>
        <webfeeds:logo>{{ setting('site_og_image') ? asset(Storage::url(setting('site_og_image'))) : 'https://placehold.co/126' }}</webfeeds:logo>
        <image>
            <url>{{ setting('site_og_image') ? asset(Storage::url(setting('site_og_image'))) : 'https://placehold.co/126' }}</url>
            <title>{{ $title }}</title>
            <link>{{ route('rss.index') }}</link>
        </image>
        <language>{{ $language }}</language>
        <lastBuildDate>{{ $lastBuildDate }}</lastBuildDate>
    </channel>
</rss>
