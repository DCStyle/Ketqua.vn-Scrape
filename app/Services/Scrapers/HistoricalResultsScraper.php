<?php

namespace App\Services\Scrapers;

use Illuminate\Support\Carbon;

class HistoricalResultsScraper extends BaseScraper
{
    private $days;
    private $fromDate;
    private $toDate;

    public function __construct(int $days)
    {
        $this->days = $days;
        $this->template = 'pages.historical_results';
        $this->selector = config('url_mappings.default_scrape.main_selector');

        if ($this->days < 30) {
            $this->path = "so-ket-qua";
        } else {
            $this->path = "so-ket-qua-{$days}-ngay";
        }

        // Calculate default date range
        $this->toDate = now();
        $this->fromDate = now()->subDays($days - 1);

        $this->defaultParams = [
            'from_date' => $this->fromDate->format('d-m-Y'),
            'to_date' => $this->toDate->format('d-m-Y')
        ];
    }

    public function handle($params = []): ?array
    {
        if (!empty($params['from_date'])) {
            $this->fromDate = Carbon::createFromFormat('d-m-Y', $params['from_date']);
        }
        if (!empty($params['to_date'])) {
            $this->toDate = Carbon::createFromFormat('d-m-Y', $params['to_date']);
        }

        return parent::handle($params);
    }

    protected function getSourceUrl(): string
    {
        return config('url_mappings.default_scrape.source_url');
    }

    protected function processResponse($content): array
    {
        return [
            'content' => $content,
            'template' => $this->template,
            'metadata' => $this->metadata,
            'data' => [
                'days' => $this->days,
                'fromDate' => $this->fromDate->format('d-m-Y'),
                'toDate' => $this->toDate->format('d-m-Y')
            ]
        ];
    }
}
