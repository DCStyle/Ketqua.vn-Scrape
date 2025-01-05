<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $mainMenus = [
            ['title' => 'Trang chủ', 'url' => '/', 'order' => 1],
            [
                'title' => 'XSMB',
                'url' => '/xsmb',
                'order' => 2,
                'children' => [
                    ['title' => 'XSMB Thứ 2', 'url' => '/xsmb/thu-2', 'order' => 1],
                    ['title' => 'XSMB Thứ 3', 'url' => '/xsmb/thu-3', 'order' => 2],
                    ['title' => 'XSMB Thứ 4', 'url' => '/xsmb/thu-4', 'order' => 3],
                    ['title' => 'XSMB Thứ 5', 'url' => '/xsmb/thu-5', 'order' => 4],
                    ['title' => 'XSMB Thứ 6', 'url' => '/xsmb/thu-6', 'order' => 5],
                    ['title' => 'XSMB Thứ 7', 'url' => '/xsmb/thu-7', 'order' => 6],
                    ['title' => 'XSMB Chủ Nhật', 'url' => '/xsmb/chu-nhat', 'order' => 7],
                ]
            ],
            [
                'title' => 'XSMT',
                'url' => '/xsmt',
                'order' => 3,
                'children' => [
                    ['title' => 'XSMT Thứ 2', 'url' => '/xsmt/thu-2', 'order' => 1],
                    ['title' => 'XSMT Thứ 3', 'url' => '/xsmt/thu-3', 'order' => 2],
                    ['title' => 'XSMT Thứ 4', 'url' => '/xsmt/thu-4', 'order' => 3],
                    ['title' => 'XSMT Thứ 5', 'url' => '/xsmt/thu-5', 'order' => 4],
                    ['title' => 'XSMT Thứ 6', 'url' => '/xsmt/thu-6', 'order' => 5],
                    ['title' => 'XSMT Thứ 7', 'url' => '/xsmt/thu-7', 'order' => 6],
                    ['title' => 'XSMT Chủ Nhật', 'url' => '/xsmt/chu-nhat', 'order' => 7],
                ]
            ],
            [
                'title' => 'XSMN',
                'url' => '/xsmn',
                'order' => 4,
                'children' => [
                    ['title' => 'XSMN Thứ 2', 'url' => '/xsmn/thu-2', 'order' => 1],
                    ['title' => 'XSMN Thứ 3', 'url' => '/xsmn/thu-3', 'order' => 2],
                    ['title' => 'XSMN Thứ 4', 'url' => '/xsmn/thu-4', 'order' => 3],
                    ['title' => 'XSMN Thứ 5', 'url' => '/xsmn/thu-5', 'order' => 4],
                    ['title' => 'XSMN Thứ 6', 'url' => '/xsmn/thu-6', 'order' => 5],
                    ['title' => 'XSMN Thứ 7', 'url' => '/xsmn/thu-7', 'order' => 6],
                    ['title' => 'XSMN Chủ Nhật', 'url' => '/xsmn/chu-nhat', 'order' => 7],
                ]
            ],
            [
                'title' => 'Vietlott',
                'url' => '/xo-so-vietlott',
                'order' => 5,
                'children' => [
                    ['title' => 'Mega 6/45', 'url' => '/xo-so-vietlott/mega-645', 'order' => 1],
                    ['title' => 'Power 6/55', 'url' => '/xo-so-vietlott/power-655', 'order' => 2],
                    ['title' => 'Max 3D', 'url' => '/xo-so-vietlott/max-3d', 'order' => 3],
                    ['title' => 'Max 3D Pro', 'url' => '/xo-so-vietlott/max-3d-pro', 'order' => 4],
                ]
            ],
            [
                'title' => 'Sổ kết quả',
                'url' => '/so-ket-qua',
                'order' => 6,
                'children' => [
                    ['title' => 'Sổ kết quả 30 ngày', 'url' => '/so-ket-qua-30-ngay', 'order' => 1],
                    ['title' => 'Sổ kết quả 60 ngày', 'url' => '/so-ket-qua-60-ngay', 'order' => 2],
                    ['title' => 'Sổ kết quả 90 ngày', 'url' => '/so-ket-qua-90-ngay', 'order' => 3],
                    ['title' => 'Sổ kết quả 100 ngày', 'url' => '/so-ket-qua-100-ngay', 'order' => 4],
                    ['title' => 'Sổ kết quả 200 ngày', 'url' => '/so-ket-qua-200-ngay', 'order' => 5],
                    ['title' => 'Sổ kết quả 300 ngày', 'url' => '/so-ket-qua-300-ngay', 'order' => 6],
                    ['title' => 'Sổ kết quả 500 ngày', 'url' => '/so-ket-qua-500-ngay', 'order' => 7],
                ]
            ],
            ['title' => 'Soi cầu', 'url' => '/soi-cau', 'order' => 7],
            ['title' => 'Thống kê', 'url' => '/thong-ke', 'order' => 8],
            ['title' => 'Dò vé số', 'url' => '/do-ve-so', 'order' => 9],
            [
                'title' => 'Quay thử',
                'url' => '/quay-thu-xo-so-hom-nay',
                'order' => 10,
                'children' => [
                    ['title' => 'Quay thử XSMB', 'url' => '/quay-thu-xsmb', 'order' => 1],
                    ['title' => 'Quay thử XSMN', 'url' => '/quay-thu-xsmn', 'order' => 2],
                    ['title' => 'Quay thử XSMT', 'url' => '/quay-thu-xsmt', 'order' => 3],
                ]
            ],
            ['title' => 'Lịch mở thưởng', 'url' => '/lich-mo-thuong', 'order' => 11],
            ['title' => 'Liên hệ', 'url' => '/lien-he', 'order' => 12],
        ];

        foreach ($mainMenus as $menu) {
            $children = $menu['children'] ?? null;
            unset($menu['children']);

            $parentMenu = Menu::create($menu);

            if ($children) {
                foreach ($children as $child) {
                    $child['parent_id'] = $parentMenu->id;
                    Menu::create($child);
                }
            }
        }
    }
}
