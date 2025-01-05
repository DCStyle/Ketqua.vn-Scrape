@extends('layouts.app')

@section('content')
    <div class="lottery-container">
        {!! $content !!}
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const refreshInterval = {{ setting('cache_lifetime', 5) }} * 60 * 1000; // Convert to milliseconds

            function refreshContent() {
                fetch(window.location.href)
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        document.querySelector('.lottery-container').innerHTML = doc.querySelector('.lottery-container').innerHTML;
                    })
                    .catch(error => console.error('Error refreshing content:', error));
            }

            setInterval(refreshContent, refreshInterval);
        });
    </script>
@endpush
