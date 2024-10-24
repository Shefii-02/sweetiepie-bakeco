<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

use SparkPost\SparkPost;
use GuzzleHttp\Client;
use Http\Adapter\Guzzle7\Client as GuzzleAdapter;
// use Nyholm\Psr7\Factory\Psr17Factory;
// use Http\Message\MessageFactory\DiactorosMessageFactory;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderInvoiceMail;

use Illuminate\Support\Facades\Queue;
use App\Jobs\SendDataJob;
use Validator;

class ApiController extends Controller
{
    
  
        
    public function DeliveryWebhook(Request $request){
    
        $jsonData = $request->json()->all();
        
           
        if (is_array($jsonData) && !empty($jsonData)) {
            
            foreach ($jsonData as $item) {
                if (isset($item['msys']['message_event']['transmission_id'])) {
                    $messageId = $item['msys']['message_event']['transmission_id'];
                    $rcpt_to   = $item['msys']['message_event']['rcpt_to'];
                    $timestamp = $item['msys']['message_event']['timestamp'];

                    Order::where('store_email_send_message_id', $messageId)->update(['store_email_send' => 1]);
                    Order::where('customer_email_send_message_id', $messageId)->update(['customer_email_send' => 1]);
                    Order::where('additional_email_id', $messageId)->update(['additional_email_status' => 1]);
                    
                    // Log::info('Email Deliveried Successfully 111 '.$rcpt_to .' : '.$messageId.' => '.$timestamp);
                
                

                      
                    return response()->json(['success' => true]);
                }
            }
        }

        return response()->json(['error' => 'Invalid data'], 400);
        
    }

}
