<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

class HourBasedOrderReminder extends Command
{
    protected $signature = 'hourbasedorder:cron';
    protected $description = 'Send Hourly based order reminders';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $currentTime = now();
        // Check if the current time is within the allowed range (9:00 AM to 5:00 PM)
        if ($currentTime->hour >= 9 && $currentTime->hour <= 17) {
            $apiDomain = env('TNG_API_DOMAIN'); 
            $action_url= $apiDomain."/api/website/hourly-orders-reminder";
            $post   = [];
            $result = CurlSendPostRequest($action_url,$post);
         
            if ($result) {
                $result = json_decode($result);  
                if ($result->success) {
                    if (!empty($result->data)) {
                      
                        $orders = $result->data;
                        foreach ($orders as $singleOrder) {
                            try {
                                // Assuming you have defined the Mail class and the HourBasedOrderReminderNotification class correctly
                                \Mail::to(env('ORDER_REMINDER'))->send(new \App\Mail\HourBasedOrderReminderNotification($singleOrder));
                            } catch (\Exception $e) {
                                // Handle exceptions if necessary
                                 \Log::info($e);
                            }
                        }
                        
                         \Log::info("hourly Order Reminder " . now());
                    } else {
                        \Log::info("No hourly orders found.");
                    }
                } else {
                    \Log::error("Error in API response: " . $result->message);
                }
            } else {
                \Log::error("Failed to retrieve data from hourly-orders-reminder API");
            }
        } 
    }

    
}
