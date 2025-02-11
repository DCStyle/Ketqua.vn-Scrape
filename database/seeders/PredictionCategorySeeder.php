<?php

namespace Database\Seeders;

use App\Models\PredictionCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class PredictionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'xsmb' => 'Dự đoán XSMB',
            'xsmt' => 'Dự đoán XSMT',
            'xsmn' => 'Dự đoán XSMN',
        ];

        foreach ($types as $type => $name) {
            PredictionCategory::create([
                'name' => $name,
                'type' => $type,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
