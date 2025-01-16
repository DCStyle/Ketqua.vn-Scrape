<?php

namespace App\Services\Scrapers;

class CheckLotteryTicketScraper extends BaseScraper
{
    public function __construct()
    {
        $this->path = 'do-ve-so';
        $this->template = 'pages.check_lottery_ticket';
        $this->selector = config('url_mappings.default_scrape.main_selector');
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
            'metadata' => $this->metadata
        ];
    }
}
