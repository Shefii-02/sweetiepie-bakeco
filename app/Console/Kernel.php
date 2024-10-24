<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    
     protected $commands = [
        Commands\SendDataCron::class,
        Commands\SendEmailStatusCron::class,
        Commands\HourBasedOrderReminder::class,
        Commands\DailyAllOrderReminder::class
    ];


    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('senddata:cron')
                 ->everyMinute();
        $schedule->command('sendemailstatus:cron')
                 ->everyMinute();
        $schedule->command('dailyallorder:cron')
                ->hourly();
        $schedule->command('hourbasedorder:cron')
                ->hourly();
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
