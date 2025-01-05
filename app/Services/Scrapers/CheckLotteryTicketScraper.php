<?php

namespace App\Services\Scrapers;

class CheckLotteryTicketScraper extends BaseScraper
{
    public function __construct()
    {
        $this->path = 'do-ve-so';
        $this->template = 'pages.check_lottery_ticket';
        $this->selector = config('url_mappings.default_scrape.main_selector');
        $this->defaultParams = [
            'search_date' => now()->format('d-m-Y'),
            'province_id' => 22,
            'search_number' => ''
        ];
    }

    protected function getSourceUrl(): string
    {
        return config('url_mappings.default_scrape.source_url');
    }

    protected function processResponse($content): array
    {
        return [
            'content' => $content,
            'template' => $this->template
        ];
    }
}
