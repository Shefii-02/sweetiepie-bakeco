<?php
namespace App\Service;
use App\Models\User;
use App\Models\Order;
use App\Models\Item;
use App\Models\Store;
use App\Models\Basket;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderInvoiceMail;
use App\Mail\OrderNotification;
use DB;

use SparkPost\SparkPost;
use GuzzleHttp\Client;
use Http\Adapter\Guzzle7\Client as GuzzleAdapter;
use Nyholm\Psr7\Factory\Psr17Factory;
use Http\Message\MessageFactory\DiactorosMessageFactory;
use Illuminate\Support\Facades\Log;

trait SendOrderEmail{

    public function SendEmailTrait(){
           $apiKey = env('SparkPost_Key');
           
           $apiEndpoint = 'https://api.sparkpost.com/api/v1/';
           
        $unsentCusEmails = Order::with('basket','orderItems','address')
                             ->whereHas('basket')
                             ->whereHas('address')
                             ->where('status',1)
                             ->where('customer_email_send',0)
                             ->whereNull('customer_email_send_message_id')
                             ->get();
                             
                             
        $unsentStoreEmails = Order::with('basket','orderItems','address')
                             ->whereHas('basket')
                             ->whereHas('address')
                             ->where('status',1)
                             ->where('store_email_send',0)
                             ->whereNull('store_email_send_message_id')
                             ->get();
                             
                foreach($unsentCusEmails as $order_details){
                    //order Confirmation mail
                    $sendto = env('MAIL_TO_COPY');
                    
                    // $template = view('emails.order-invoice', compact('order_details'))->render();
                    $template = new OrderInvoiceMail($order_details);
                    $template = $template->render();
            
            
                    $client = new Client([
                        'headers' => [
                            'Authorization' => $apiKey,
                            'Content-Type' => 'application/json',
                        ],
                    ]);
                    
                    
                    
        
                    try{
                        $response = $client->post($apiEndpoint . 'transmissions', [
                            'json' => [
                                'options' => [
                                    'sandbox' => false,
                                ],
                                'content' => [
                                    'name' => 'Sweetie Pie Bake Co',
                                    'from' => env('EMAIL_FROM'),
                                    'subject' => "Thank you for Your Order",
                                    'html' => $template,
                                ],
                                'recipients' => [
                                    ['address' => ['email' => $order_details->email]],
                                ],
                                // 'bcc' => [
                                //     [
                                //         'address' => [
                                //             'name' => 'MYSWEETIEPIE ADMIN',
                                //             'email' => $sendto,
                                //         ],
                                //     ],
                                // ],
                            ],
                        ]);
                        
                        $responseData = json_decode($response->getBody(), true);
                        
    
                        if (isset($responseData['results']['id'])) {
                            $message_id = $responseData['results']['id'];
                            //  \Log::info("Customer Message id is  ".$message_id);
                             Order::where('id', $order_details->id)->update(['customer_email_send_message_id' => $message_id]);
                        } else {
                   
                            // \Log::info("Customer Email Message id is  NULL");
                        }
             
                    
                    }
                    catch(\Exception $e){
                          \Log::info($e);
                    }
                }
                
                
                
                
                foreach($unsentStoreEmails as $order_details){
                            //order notification
                    $cc_mailId = [];
                    $all_ordersSend= env('MAIL_TO_ORDER') ?? env('MAIL_FROM_ADDRESS'); 
                   
                        if(env('APP_URL') == 'https://www.sweetiepiebakeco.ca'){
                            $cc_mailId[] = env('MAIL_TO_COPY');
                        }
                        
                        if(count($cc_mailId) <= 0){
                            $cc_mailId[] = env('MAIL_TO_DEV'); 
                        }
                        
                        // $template = view('emails.order-notification', compact('order_details'))->render(); 
                        $template = new OrderNotification($order_details);
                        $template = $template->render();
                    
                        $client = new Client([
                            'headers' => [
                                'Authorization' => $apiKey,
                                'Content-Type' => 'application/json',
                            ],
                        ]);
                        
                    try{
                        $response = $client->post($apiEndpoint . 'transmissions', [
                            'json' => [
                                'options' => [
                                    'sandbox' => false,
                                ],
                                'content' => [
                                    'name' => 'Sweetie Pie Bake Co',
                                    'from' => env('EMAIL_FROM'),
                                    'subject' => "Received New Order",
                                    'html' => $template,
                                ],
                                'recipients' => [
                                    ['address' => ['email' => $all_ordersSend]],
                                ],
                               
                            ],
                        ]);
                        
                        
                        
                        $responseData = json_decode($response->getBody(), true);
    
                        if (isset($responseData['results']['id'])) {
                            $message_id = $responseData['results']['id'];
                            //  \Log::info("Store Message id is  ".$message_id);
                             Order::where('id', $order_details->id)->update(['store_email_send_message_id' => $message_id]);
                        } else {
                   
                            // \Log::info("Store Email Message id is  NULL");
                        }
             
             
             
                        foreach($cc_mailId as $store_email_fwd){
                                $client = new Client([
                                    'headers' => [
                                        'Authorization' => $apiKey,
                                        'Content-Type' => 'application/json',
                                    ],
                                ]);
                                $response = $client->post($apiEndpoint . 'transmissions', [
                                    'json' => [
                                        'options' => [
                                            'sandbox' => false,
                                        ],
                                        'content' => [
                                            'name' => 'Sweetie Pie Bake Co',
                                            'from' => env('EMAIL_FROM'),
                                            'subject' => "Received New Order",
                                            'html' => $template,
                                        ],
                                        'recipients' => [
                                            ['address' => ['email' => $store_email_fwd]],
                                        ],
                                    ],
                                ]);
                           
                        }
                    }
                    catch(\Exception $e){
                          \Log::info($e);
                    }
                        
                    
                }
                
        if($unsentCusEmails->count() > 0 || $unsentStoreEmails->count() > 0){
            
              \Log::info("SendEmailTrait Cron is working fine!");  
        }    
             return 0;
      }
}