@if(isset($error) && $error)
    <?xml version="1.0" encoding="UTF-8" ?>
    <rss xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:webfeeds="http://webfeeds.org/rss/1.0" xmlns:media="http://search.yahoo.com/mrss/" version="2.0">
        <channel>
            <title>Error</title>
            <description>{{ $message }}</description>
        </channel>
    </rss>
@else
    {!! $content !!}
@endif
