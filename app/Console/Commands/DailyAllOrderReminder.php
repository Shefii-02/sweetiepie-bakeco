<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class DailyAllOrderReminder extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailyallorder:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily all order reminders';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){
      
        if (date('Hi') == 900) {
            $apiDomain = env('TNG_API_DOMAIN'); 
            $action_url= $apiDomain."/api/website/daily-orders-reminder";
            $post   = [];
            $result = CurlSendPostRequest($action_url,$post);
      
            
                if ($result) {
                    $result = json_decode($result);  
                    if ($result->success) {
                        $orders =  $result->data;
                        
                        if (!empty($orders)) {                  
                            try {
                                \Mail::to(env('ORDER_REMINDER'))->send(new \App\Mail\DailyAllOrderReminderNotification($orders));
                                \Log::info("Daily All Order Reminder Sent " . now());
                            } catch(\Exception $e) {
                                \Log::error("Error sending daily order reminder: " . $e->getMessage());
                            }
                        } else {
                            \Log::info("Daily All Order Reminder is Zero " . now());
                        }
                    } else {
                        \Log::error("Error in API response: " . $result->message);
                    }
                } else {
                    \Log::error("Failed to retrieve data from daily-orders-reminder API");
                }
            return 0;
        }
    }
}
