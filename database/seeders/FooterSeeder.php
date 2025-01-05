<?php

namespace Database\Seeders;

use App\Models\FooterColumn;
use App\Models\FooterColumnItem;
use App\Models\FooterSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks and clear existing data
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        FooterColumnItem::truncate();
        FooterColumn::truncate();
        FooterSetting::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create columns
        $columns = [
            [
                'title' => 'Kết quả xổ số',
                'items' => [
                    ['label' => 'Xổ số miền Bắc', 'url' => '/xsmb'],
                    ['label' => 'Xổ số miền Trung', 'url' => '/xsmt'],
                    ['label' => 'Xổ số miền Nam', 'url' => '/xsmn'],
                    ['label' => 'Xổ số Vietlott', 'url' => '/xo-so-vietlott'],
                    ['label' => 'Xổ số Điện toán', 'url' => '/xsdt'],
                    ['label' => 'Trực tiếp xổ số miền Bắc', 'url' => '/xsmb/truc-tiep'],
                    ['label' => 'Ketqua.net', 'url' => '/ket-qua-net'],
                    ['label' => 'Rồng bạch kim', 'url' => '/rong-bach-kim'],
                ]
            ],
            [
                'title' => 'Tiện ích',
                'items' => [
                    ['label' => 'Sổ kết quả', 'url' => '/so-ket-qua'],
                    ['label' => 'Sổ kết quả 30 ngày', 'url' => '/so-ket-qua-30-ngay'],
                    ['label' => 'Quay thử xổ số', 'url' => '/quay-thu-xo-so-hom-nay'],
                    ['label' => 'Dò vé số', 'url' => '/do-ve-so'],
                    ['label' => 'Lịch mở thưởng', 'url' => '/lich-mo-thuong'],
                    ['label' => 'Liên hệ', 'url' => '/lien-he'],
                ]
            ],
            [
                'title' => 'Soi cầu',
                'items' => [
                    ['label' => 'Soi cầu loto', 'url' => '/soi-cau/loto'],
                    ['label' => 'Soi cầu loto theo thứ', 'url' => '/soi-cau/loto-theo-thu'],
                    ['label' => 'Soi cầu loto bạch thủ', 'url' => '/soi-cau/bach-thu'],
                    ['label' => 'Soi cầu loto bạch thủ theo thứ', 'url' => '/soi-cau/loto-bach-thu-theo-thu'],
                    ['label' => 'Soi cầu giải đặc biệt', 'url' => '/soi-cau/giai-dac-biet'],
                    ['label' => 'Soi cầu giải đặc biệt thứ', 'url' => '/soi-cau/giai-dac-biet-theo-thu'],
                    ['label' => 'Soi cầu 2 nháy', 'url' => '/soi-cau/an-hai-nhay'],
                    ['label' => 'Soi cầu loại loto', 'url' => '/soi-cau/loai-loto'],
                    ['label' => 'Soi cầu loại loto bạch thủ', 'url' => '/soi-cau/loai-loto-bach-thu'],
                ]
            ],
            [
                'title' => 'Thống kê',
                'items' => [
                    ['label' => 'Thống kê loto gan', 'url' => '/thong-ke/loto-gan'],
                    ['label' => 'Thống kê chu kỳ dàn loto', 'url' => '/thong-ke/chu-ky-dan-loto'],
                    ['label' => 'Thống kê nhanh', 'url' => '/thong-ke/ket-qua-xo-so'],
                    ['label' => 'Thống kê đầu đuôi loto', 'url' => '/thong-ke/dau-duoi-loto'],
                    ['label' => 'Thống kê tần suất loto', 'url' => '/thong-ke/tan-suat-loto'],
                    ['label' => 'Thống kê chu kỳ dàn đặc biệt', 'url' => '/thong-ke/chu-ky-dac-biet'],
                    ['label' => 'Tìm càng loto', 'url' => '/thong-ke/cang-loto'],
                    ['label' => 'Thống kê theo tổng', 'url' => '/thong-ke/theo-tong'],
                    ['label' => 'Thống kê quan trọng', 'url' => '/thong-ke/quan-trong'],
                ]
            ]
        ];

        foreach ($columns as $index => $columnData) {
            $column = FooterColumn::create([
                'title' => $columnData['title'],
                'order' => $index + 1
            ]);

            foreach ($columnData['items'] as $itemIndex => $item) {
                FooterColumnItem::create([
                    'footer_column_id' => $column->id,
                    'label' => $item['label'],
                    'url' => $item['url'],
                    'order' => $itemIndex + 1
                ]);
            }
        }

        // Create footer settings
        $settings = [
            'site_name' => 'Ketqua.vn',
            'site_description' => 'Trang kết quả xổ số hàng đầu Việt Nam',
            'email' => 'contact@ketqua.vn',
            'address' => 'Số 7A Lê Đức Thọ, Phường Mai Dịch, Quận Cầu Giấy, Hà Nội',
            'responsible_person' => 'Ông Nguyễn Văn Long',
            'copyright' => 'Copyright © 2014 Ketqua.vn, All Rights Reserved',
            'social_facebook' => 'https://www.facebook.com/#',
            'social_telegram' => 'https://t.me/#',
            'social_zalo' => 'https://zalo.me/#'
        ];

        foreach ($settings as $key => $value) {
            FooterSetting::create([
                'key' => $key,
                'value' => $value
            ]);
        }
    }
}
