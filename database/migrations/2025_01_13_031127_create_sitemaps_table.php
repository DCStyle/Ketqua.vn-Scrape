<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sitemaps', function (Blueprint $table) {
            $table->id();
            $table->string('url', 1000);
            $table->string('parent_path', 255)->nullable()->index();
            $table->timestamp('last_modified')->nullable();
            $table->integer('level')->default(0)->index();
            $table->boolean('is_index')->default(false);
            $table->string('priority', 10)->nullable();
            $table->string('changefreq', 20)->nullable();
            $table->timestamps();

            $table->index('url');
        });

        // Add default sitemap
        $urls = [
            'https://ketqua.vn/pages.xml',
            'https://ketqua.vn/posts.xml',
            'https://ketqua.vn/predictions.xml',
            'https://ketqua.vn/results.xml'
        ];

        foreach ($urls as $url) {
            DB::table('sitemaps')->insert([
                'url' => $url,
                'is_index' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Add default sitemap with parent_path = 'results.xml'
        $urls = [
            'https://ketqua.vn/result-2005.xml',
            'https://ketqua.vn/result-2006.xml',
            'https://ketqua.vn/result-2007.xml',
            'https://ketqua.vn/result-2008.xml',
            'https://ketqua.vn/result-2009.xml',
            'https://ketqua.vn/result-2010.xml',
            'https://ketqua.vn/result-2011.xml',
            'https://ketqua.vn/result-2012.xml',
            'https://ketqua.vn/result-2013.xml',
            'https://ketqua.vn/result-2014.xml',
            'https://ketqua.vn/result-2015.xml',
            'https://ketqua.vn/result-2016.xml',
            'https://ketqua.vn/result-2017.xml',
            'https://ketqua.vn/result-2018.xml',
            'https://ketqua.vn/result-2019.xml',
            'https://ketqua.vn/result-2020.xml',
            'https://ketqua.vn/result-2021.xml',
            'https://ketqua.vn/result-2022.xml',
            'https://ketqua.vn/result-2023.xml',
            'https://ketqua.vn/result-2024.xml',
            'https://ketqua.vn/result-2025.xml',
        ];

        foreach ($urls as $url) {
            DB::table('sitemaps')->insert([
                'url' => $url,
                'level' => 1,
                'parent_path' => 'results.xml',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sitemaps');
    }
};
