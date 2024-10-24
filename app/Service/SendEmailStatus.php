<?php
namespace App\Service;
use App\Models\Order;

use Illuminate\Support\Facades\Log;

trait SendEmailStatus{

    public function SendEmailStatusTrait(){
        
        $unsentTNGEmails = Order::where('status',1)->where('tng_email_status',0)->where('customer_email_send',1)->orderBy('id','desc')->take(50)->get();
                             
                     
        foreach($unsentTNGEmails as $order_details){   
            $apiDomain = env('TNG_API_DOMAIN'); 
            $url = $apiDomain."/api/website/order-email-status";
          
            $post = [
                     'id'                   => $order_details->id,
                     'invoice_id'           => $order_details->invoice_id,
                     'email'                => $order_details->email,
                     'store_email_send'     => $order_details->store_email_send,
                     'customer_email_send'  => $order_details->customer_email_send,
                     
                    ];
            $result__api = CurlSendPostRequest($url,$post);
            $isDataSent = json_decode($result__api);
       
            if($isDataSent){
                if ($isDataSent->status == 'Success') {
                        Order::where('id', $order_details->id)->update(['tng_email_status' => 1]);
        
                }
            }
            
        }
       
        if($unsentTNGEmails->count() >0){
        //  \Log::info("Send Email Status Cron is working fine!");  
        }
    }
    
}