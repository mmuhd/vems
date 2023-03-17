<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Rent;
use App\Noticelog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
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
       
        // Run this task every day at 9:00 AM
        $schedule->call(function () {
            // Get the current date and time
            $now = Carbon::now();

            // Get the tenants who have rent due in the next month or week
            $rents = Rent::where('deedEnd', '>=', $now)
                             ->where('deedEnd', '<=', $now->addMonths(1))
                             ->orWhere('deedEnd', '<=', $now->addWeeks(1))
                             ->get();

            // Send an SMS reminder to each rent
            if (!empty($rents)) {
                    foreach ($rents as $rent) {
                    $recipients = $rent->cellNo;
                    $url = 'https://api.ebulksms.com:8080/sendsms'; 
                    $username = Config::get('ebulksms.username');
                    $apikey = Config::get('ebulksms.apiKey');
                    $flash = false; 
                    $sendername =  Config::get('ebulksms.sender');
                    $messagetext = 'Your rent is due soon. Please come and renew it.';
                    $se = $this->sendWithHttp ($url, $username, $apikey, $flash, $sendername, $messagetext, $recipients);
                    //Noticelog::create($se);
                    Log::info($se);
                    Log::info($url);
                    Log::info($username);
                }
            }                 
            
        })->dailyAt('1:52');;
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }

    public function sendWithHttp($url, $username, $apikey, $flash, $sendername, $messagetext, $recipients) {
        $query_str = http_build_query(array('username' => $username, 'apikey' => $apikey, 'sender' => $sendername, 'messagetext' => $messagetext, 'flash' => $flash, 'recipients' => $recipients));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "{$url}?{$query_str}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
        //return file_get_contents("{$url}?{$query_str}");
    }
}
