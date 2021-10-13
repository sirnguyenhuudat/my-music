<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\MonthlyAlbumCommand',
        'App\Console\Commands\MonthlyTrackCommand',
        'App\Console\Commands\WeeklyAlbumCommand',
        'App\Console\Commands\WeeklyTrackCommand',
        'App\console\Commands\HappyBirthdayCommand',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('track:update_month_view')->monthlyOn(1, '0:00')->timezone('Asia/Ho_Chi_Minh');
        $schedule->command('track:update_week_view')->weeklyOn(1, '0:30')->timezone('Asia/Ho_Chi_Minh');
        $schedule->command('album:update_month_view')->monthlyOn(1, '1:00')->timezone('Asia/Ho_Chi_Minh');
        $schedule->command('album:update_week_view')->weeklyOn(1, '1:30')->timezone('Asia/Ho_Chi_Minh');
        $schedule->command('user:send_mail')->dailyAt('2:00')->timezone('Asia/Ho_Chi_Minh');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
