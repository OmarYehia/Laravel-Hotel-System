<?php

namespace App\Console;

use App\Models\Client;
use App\Notifications\LoginReminder;
use Carbon\Carbon;
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
        
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $allClients = Client::all();
            foreach ($allClients as $client) {
                $currentTime = Carbon::now();
                $lastLogin = $client->last_login_date;
                $difference = $currentTime->diffInDays($lastLogin);

                // If the client hasn't loggedin in 30 days
                if ($difference >= 30) {
                    $client->notify(new LoginReminder($client->name));
                }
            }
        })->daily();
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
