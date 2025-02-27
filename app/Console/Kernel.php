<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     */
    protected $commands = [
        Commands\CrawlPredictionArticles::class
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('sitemap:crawl')
            ->dailyAt('00:00')
            ->withoutOverlapping()
            ->runInBackground()
            ->emailOutputOnFailure(env('ADMIN_EMAIL'));

        $schedule->command('crawl:predictions')
            ->hourly()
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/crawler.log'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
