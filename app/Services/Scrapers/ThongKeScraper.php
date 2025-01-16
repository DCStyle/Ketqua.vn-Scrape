<?php

namespace App\Services\Scrapers;

class ThongKeScraper extends BaseScraper
{
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;

        $this->path = 'thong-ke/' . $type;
        $this->template = 'pages.thong_ke';
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
            case 'loto-gan':
                $typeName = 'Lô tô gan';
                $getThongKeFunction = 'TKLTG(this);';
                break;
            case 'chu-ky-dan-loto':
                $typeName = 'Chu kỳ dàn lô tô';
                $getThongKeFunction = 'TKCKDLT(this);';
                break;
            case 'ket-qua-xo-so':
                $typeName = 'Nhanh';
                $getThongKeFunction = 'TKN(this);';
                break;
            case 'dau-duoi-loto':
                $typeName = 'Đầu đuôi lô tô';
                $getThongKeFunction = 'TKDDLT(this);';
                break;
            case 'tan-suat-loto':
                $typeName = 'Tần suất lô tô';
                $getThongKeFunction = 'TKTSLT(this);';
                break;
            case 'chu-ky-dan-dac-biet':
                $typeName = 'Chu kỳ dàn đặc biệt';
                $getThongKeFunction = 'TKCKDDB(this);';
                break;
            case 'cang-loto':
                $typeName = 'Càng lô tô';
                $getThongKeFunction = 'TC(this);';
                break;
            case 'theo-tong':
                $typeName = 'Theo tổng';
                $getThongKeFunction = 'TKTT(this);';
                break;
            case 'quan-trong':
                $typeName = 'Quan trọng';
                $getThongKeFunction = 'TKQT(this);';
                break;
            case 'dai-nhat':
                $typeName = 'Dài nhất';
                $getThongKeFunction = 'TKDN(this);';
                break;
            case 'chu-ky-gan-theo-tinh':
                $typeName = 'Chu kỳ gan theo tỉnh';
                $getThongKeFunction = 'TKCKGTT(this);';
                break;
            case 'tan-so-nhip-loto':
                $typeName = 'Tần số nhịp lô tô';
                $getThongKeFunction = 'TSNLT(this);';
                break;
            case 'dac-biet-tuan':
                $typeName = 'Đặc biệt tuần';
                $getThongKeFunction = 'BDBT(this);';
                break;
            case 'dac-biet-thang':
                $typeName = 'Đặc biệt tháng';
                $getThongKeFunction = 'BDBTH(this);';
                break;
        }

        return [
            'content' => $content,
            'template' => $this->template,
            'metadata' => $this->metadata,
            'data' => [
                'type' => $this->type,
                'typeName' => $typeName,
                'getThongKeFunction' => $getThongKeFunction,
            ]
        ];
    }
}
