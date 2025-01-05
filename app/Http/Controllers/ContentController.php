<?php

namespace App\Http\Controllers;

use App\Services\ContentMirrorService;
use App\Services\Scrapers\BaseScraper;
use App\Services\Scrapers\CheckLotteryTicketScraper;
use App\Services\Scrapers\DefaultScraper;
use App\Services\Scrapers\HistoricalResultsScraper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ContentController extends Controller
{
    private ContentMirrorService $mirrorService;
    protected array $scrapers = [
        'do-ve-so' => CheckLotteryTicketScraper::class,
    ];

    protected function initializeScrapers(): array
    {
        $durations = [30, 90, 100, 200, 300, 500];

        foreach ($durations as $days) {
            $this->scrapers["so-ket-qua-{$days}-ngay"] = function() use ($days) {
                return new HistoricalResultsScraper($days);
            };
        }

        $this->scrapers['so-ket-qua'] = function() {
            return new HistoricalResultsScraper(10);
        };

        return $this->scrapers;
    }

    public function __construct(ContentMirrorService $mirrorService)
    {
        $this->mirrorService = $mirrorService;
        $this->scrapers = $this->initializeScrapers();
    }

    public function show(Request $request, string $path = ''): View
    {
        $result = $this->handlePath($request, $path);

        if (!$result) {
            abort(404);
        }

        if ((bool) setting('cache_enabled')) {
            // Track cache metrics
            Cache::put('last_cached_url', $path, now()->addDay());
            Cache::put('last_cache_time', now(), now()->addDay());
        }

        return $this->createResponse($result);
    }

    private function handlePath(Request $request, string $path): ?array
    {
        // Normalize path by removing leading slash
        $path = ltrim($path, '/');

        // Check custom paths first
        $urlMappings = config('url_mappings.paths');
        foreach ($urlMappings as $mapping) {
            if (isset($mapping['our_paths'][$path]) || isset($mapping['our_paths']["/$path"])) {
                return [
                    'content' => null,
                    'template' => $mapping['our_paths'][$path] ?? $mapping['our_paths']["/$path"]
                ];
            }
        }

        if (isset($this->scrapers[$path])) {
            return $this->handleScraper($request, $path);
        }

        // Use DefaultScraper for unspecified paths
        $scraper = new DefaultScraper($path);
        return $scraper->handle($request->isMethod('post') ? $request->all() : []);
    }

    private function handleScraper(Request $request, string $path): ?array
    {
        $scraperFactory = $this->scrapers[$path];

        /** @var BaseScraper $scraper */
        $scraper = is_callable($scraperFactory) ? $scraperFactory() : app($scraperFactory);

        $params = $request->isMethod('post') ? $request->all() : [];
        return $scraper->handle($params);
    }

    private function createResponse(array $result): View
    {
        $data = array_merge([
            'content' => $result['content']
        ], $result['data'] ?? []);

        return view($result['template'], $data)->withHeaders([
            'X-Robots-Tag' => 'noindex, nofollow',
            'Cache-Control' => 'public, max-age=300'
        ]);
    }
}
