<?php

namespace App\Services\Scrapers;

use App\Services\Scrapers\BaseScraper;

class SoiCauScraper extends BaseScraper
{
    private $type;
    private $isByWeekDays = false;
    private $isSpecial = false;
    private $isTriangle = false;

    public function __construct(string $type)
    {
        $this->type = $type;

        if (in_array($type, ['loto-theo-thu', 'giai-dac-biet-theo-thu'])) {
            $this->isByWeekDays = true;
        }

        if (in_array($type, ['giai-dac-biet', 'giai-dac-biet-theo-thu'])) {
            $this->isSpecial = true;
        }

        if ($type === 'tam-giac') {
            $this->isTriangle = true;
        }

        $this->path = 'soi-cau/' . $type;
        $this->template = 'pages.soi_cau';
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
            case 'loto':
                $typeName = 'Lô tô';
                $getSoiCauFunction = 'getSoiCauLoto(this, 1);';
                break;
            case 'loto-theo-thu':
                $typeName = 'Lô tô theo thứ';
                $getSoiCauFunction = 'getSoiCauLoto(this, 1);';
                break;
            case 'bach-thu':
                $typeName = 'Lô tô Bạch thủ';
                $getSoiCauFunction = 'getSoiCauLoto(this, 3);';
                break;
            case 'loto-bach-thu-theo-thu':
                $typeName = 'Lô tô Bạch thủ theo thứ';
                $getSoiCauFunction = 'getSoiCauLoto(this, 7);';
                break;
            case 'giai-dac-biet':
                $typeName = 'Giải đặc biệt';
                $getSoiCauFunction = 'getSoiCauDB(this);';
                break;
            case 'giai-dac-biet-theo-thu':
                $typeName = 'Giải đặc biệt theo thứ';
                $getSoiCauFunction = 'getSoiCauDBT(this);';
                break;
            case 'an-hai-nhay':
                $typeName = 'Ăn hai nháy';
                $getSoiCauFunction = 'getSoiCauLoto(this, 2);';
                break;
            case 'tam-giac':
                $typeName = 'Tam giác';
                $getSoiCauFunction = 'getCauTamGiac(this);';
                break;
            case 'loai-loto':
                $typeName = 'Loại lô tô';
                $getSoiCauFunction = 'getSoiCauLoto(this, 4);';
                break;
            case 'loai-loto-bach-thu':
                $typeName = 'Loại lô tô Bạch thủ';
                $getSoiCauFunction = 'getSoiCauLoto(this, 5);';
                break;
            default:
                $typeName = '';
                $getSoiCauFunction = null;
                break;
        }

        return [
            'content' => $content,
            'template' => $this->template,
            'metadata' => $this->metadata,
            'data' => [
                'type' => $this->type,
                'getSoiCauFunction' => $getSoiCauFunction,
                'typeName' => $typeName,
                'isByWeekDays' => $this->isByWeekDays,
                'isSpecial' => $this->isSpecial,
                'isTriangle' => $this->isTriangle
            ]
        ];
    }
}
