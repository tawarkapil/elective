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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        // $schedule->command('custmembership:expire')->everyMinute()
        // ->appendOutputTo(storage_path().'/logs/laravel_output.log');

        $schedule->command('custmembership:expire')->dailyAt('22:00');
        $schedule->command('fetchRSS:feeds')->dailyAt('01:00');
        //$schedule->command('fetchOldRSS:feeds')->dailyAt('23:45');
        $schedule->command('badWord:deducation')->dailyAt('02:00');
        $schedule->command('remove:wantedfiles')->dailyAt('23:00');
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
