<?php

namespace App\Services\Scrapers;

use App\Services\Scrapers\BaseScraper;

class QuayThuScraper extends BaseScraper
{
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;

        $this->path = 'quay-thu-' . $type;
        $this->template = 'pages.quay_thu';
        $this->selector = config('url_mappings.default_scrape.main_selector');
    }

    protected function getSourceUrl(): string
    {
        return config('url_mappings.default_scrape.source_url');
    }

    protected function processResponse($content): array
    {
        switch ($this->type)
        {
            case 'xsmb':
                $typeName = 'Xổ số miền Bắc';
                break;
            case 'xsmn':
                $typeName = 'Xổ số miền Nam';
                break;
            case 'xsmt':
                $typeName = 'Xổ số miền Trung';
                break;
            default:
                throw new \Exception('Invalid type');
        }

        return [
            'content' => $content,
            'template' => $this->template,
            'metadata' => $this->metadata,
            'data' => [
                'type' => $this->type,
                'typeName' => $typeName
            ]
        ];
    }
}
