<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Run the notification sender daily to check for upcoming and today's celebrations
        $schedule->command('notifications:send-anniversary')
                 ->dailyAt('03:40')
                 ->appendOutputTo(storage_path('logs/anniversary-notifications.log'))
                 ->withoutOverlapping();
        
        // Also run a backup check in the evening to catch any missed notifications
        $schedule->command('notifications:send-anniversary')
                 ->dailyAt('15:00')
                 ->appendOutputTo(storage_path('logs/anniversary-notifications-evening.log'))
                 ->withoutOverlapping();
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
