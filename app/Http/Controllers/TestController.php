<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

use SparkPost\SparkPost;
use GuzzleHttp\Client;
use Http\Adapter\Guzzle7\Client as GuzzleAdapter;
use Nyholm\Psr7\Factory\Psr17Factory;
use Http\Message\MessageFactory\DiactorosMessageFactory;
use Illuminate\Support\Facades\Log;
use App\Mail\OrderInvoiceMail;

use Validator;

class TestController extends Controller
{
    
    protected $apiKey;
    protected $apiEndpoint;

    public function __construct()
    {
        // $this->apiKey = '0dde93728cde4c5a37154415a14c89884e175947';
        // $this->apiKey = 'm6f4JQkVsmQYgsyBFrWZunMio1nvS7oIp2O3';
        $this->apiKey = '466adc43b257ebeb900e96563d6ca9778add5da3';
        $this->apiEndpoint = 'https://api.sparkpost.com/api/v1/';
    }
    
    
    public function failedapiEmail(){
        $client = new Client([
            'headers' => [
                'Authorization' => $this->apiKey,
                'Content-Type' => 'application/json',
            ],
        ]);
        
       
          $response = $client->get($this->apiEndpoint . 'suppression-list');

            // Decode the response JSON
            $suppressions = json_decode($response->getBody(), true);
        dd($suppressions);
    }
    
      
    public function sendApiEmail($invoice_id,$email='developer@indigitalgroup.ca')
    {
        list($name,$domain) = explode('@',$email);
        $order_details = Order::with('basket','orderItems','address')
                             ->whereHas('basket')
                             ->whereHas('address')
                             ->where('status',1)
                             ->where('store_email_send',0)
                             ->orderBy('id', 'DESC')->first();
            // $template = new OrderInvoiceMail($order_details);
            // $template = $template->render();
        // $template = view('emails.order-invoice', compact('order_details'))->render();

        // Create PSR-17 factories
        $psr17Factory = new Psr17Factory();

        // Create Guzzle Adapter
        $httpClient = new GuzzleAdapter(new \GuzzleHttp\Client());

        // Use the factories and adapter
        $sparky = new SparkPost($httpClient, [
            'key' => $this->apiKey,
            'async' => false,
            'httpClient' => $httpClient,
            'options' => [
                'message_factory' => new DiactorosMessageFactory(),
            ],
        ]);
  // 
        try {
            $response = $sparky->transmissions->post([
                'content' => [
                    'from' => [
                        'name' => 'Sweetie Pie',
                        'email' => 'orders@sweetiepiebakeco.ca',
                    ],
                    'subject' => 'Mysweetie Pie Thanks for ordering',
                    'html' => $template,
                    "text" => "Hello! This is a message is Computer generated email. Any other related inquiries please contact us our team"
                ],
                'recipients' => [
                    [
                        'address' => [
                            'name' => $name,
                            'email' => ucfirst($email),
                        ],
                    ],
                ],
                
            ]);
        } catch (\Exception $error) {
            dd($error);
        }
        

            dd($response);
        
        
    }
    
    
    
    
    // public function sendApiEmail($invoice_id,$email='developer@indigitalgroup.ca')
    // {
    //             // $url = "https://nest.messagebird.com/workspaces/ba806138-c1a2-4054-9ea8-6064dc46be8d/channels/ac6719a0-f5f3-4214-bb32-e6ec2227cfe3/messages";
    
                
    //             // $data = array(
    //             //     "subject" => "A great message!",
    //             //     "to" => array(
    //             //         array(
    //             //             "name" => "Irshad Ser INdigital",
    //             //             "address" => "irshad.indigital@gmail.com",
    //             //         ),
    //             //         array(
    //             //             "name" => "Shefii",
    //             //             "address" => "shefii.indigital@gmail.com",
    //             //         )
    //             //     ),
    //             //     "from" => array(
    //             //         "name" => "MYSWEETIE PIE",
    //             //         "address" => "orders@sweetiepiebakeco.ca"
    //             //     ),
    //             //     "content" => array(
    //             //         "html" => "Hello! This is a test message. <b>Best from {{location}}!</b><br><a href=\"{{visit_us}}\">Visit us!</a>",
    //             //         "text" => "Hello! This is a test message. Best from {{location}}! Visit us: {{visit_us}}"
    //             //     ),
    //             // );
                
    //             // $dataString = json_encode($data);
                
    //             // $ch = curl_init($url);
    //             // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    //             // curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
    //             // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //             // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //             //     "Authorization: AccessKey $this->apiKey",
    //             //     "Content-Type: application/json",
    //             // ));
                
    //             // $response = curl_exec($ch);
                
    //             // if (curl_errno($ch)) {
    //             //     echo 'Error:' . curl_error($ch);
    //             // }
                
    //             // curl_close($ch);
                
    //             // dd($response);


        
    //         $url = "https://nest.messagebird.com/workspaces/ba806138-c1a2-4054-9ea8-6064dc46be8d/channels/ac6719a0-f5f3-4214-bb32-e6ec2227cfe3/messages";
    //         $accessKey = "m6f4JQkVsmQYgsyBFrWZunMio1nvS7oIp2O3";
            
    //         $data = array(
    //             "receiver" => array(
    //                 "contacts" => array(
    //                     array(
    //                         "identifierValue" => "shefii.indigital@gmail.com"
    //                     ),
    //                     array(
    //                         "identifierValue" => "developer@indigitalgroup.ca"
    //                     )
    //                 ),
                    
    //             ),
    //             // "cc" => array(
    //             //         array(
    //             //             "identifierValue" => "developer@indigitalgroup.ca"
    //             //         )
    //             //     ),
    //             //     "bcc" => array(
    //             //         array(
    //             //             "identifierValue" => "irshad.indigital@gmail.com"
    //             //         )
    //             //     ),
    //             "body" => array(
    //                 "type" => "html",
    //                 "html" => array(
    //                     "text" => "Single text message",
    //                     "html" => "<p style=\"\">Single html message</p><p style=\"\"></p><p style=\"\">",
    //                     "metadata" => array(
    //                         "subject" => "Here is an Email with an attachment",
    //                         "headers" => array(
    //                             "reply-to" => "irshad.indigital@gmail.comaddress",
    //                             "cc" => "bijuys@gmail.com"
                                
    //                         ),
    //                         "emailFrom" => array(
    //                             "username" => "orders",
    //                             "displayName" => "Mysweetiepie",
    //                         )
    //                     )
    //                 )
    //             )
    //         );
            
    //         $dataString = json_encode($data);
            
    //         $ch = curl_init($url);
    //         curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    //         curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
    //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //         curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //             "Authorization: AccessKey $accessKey",
    //             "Content-Type: application/json",
    //         ));
            
    //         $response = curl_exec($ch);
            
    //         if (curl_errno($ch)) {
    //             echo 'Error:' . curl_error($ch);
    //         }
            
    //         curl_close($ch);
            
    //         dd($response);
            




        
    //     $order_details = Order::orderBy('id', 'DESC')->where('invoice_id', $invoice_id)->first();
    //     $template = view('emails.order-notification', compact('order_details'))->render();

    //     // Create PSR-17 factories
    //     $psr17Factory = new Psr17Factory();

    //     // Create Guzzle Adapter
    //     $httpClient = new GuzzleAdapter(new \GuzzleHttp\Client());

    //     // Use the factories and adapter
    //     $sparky = new SparkPost($httpClient, [
    //         'key' => $this->apiKey,
    //         'async' => false,
    //         'httpClient' => $httpClient,
    //         'options' => [
    //             'message_factory' => new DiactorosMessageFactory(),
    //         ],
    //     ]);

    //     try {
    //         $response = $sparky->transmissions->post([
    //             'content' => [
    //                 'from' => [
    //                     'name' => 'Developer Team',
    //                     'email' => 'orders@sweetiepiebakeco.ca',
    //                 ],
                    
    //                 'subject' => 'Your Order has received',
    //                 'html' => $template,
    //                 'text' => 'Congratulations, {{name}}!! You just sent your very first mailing!',
    //             ],
    //             'substitution_data' => ['name' => 'YOUR_FIRST_NAME'],
    //             'recipients' => [
    //                 [
    //                     'address' => [
    //                         'name' => 'Developer',
    //                         'email' => $email,
    //                     ],
    //                 ],
    //             ],
    //             // 'cc' => [
    //             //     [
    //             //         'address' => [
    //             //             'name' => 'ROHITH',
    //             //             'email' => 'rohithr.indigital@gmail.com',
    //             //         ],
    //             //     ],
    //             // ],
    //             // 'bcc' => [
    //             //     [
    //             //         'address' => [
    //             //             'name' => 'Developer',
    //             //             'email' => 'developer@indigitalgroup.ca',
    //             //         ],
    //             //     ],
    //             //     [
    //             //         'address' => [
    //             //             'name' => 'Shefii',
    //             //             'email' => 'shefii.indigital@gmail.com',
    //             //         ],
    //             //     ],
    //             // ],
    //         ]);
    //     } catch (\Exception $error) {
    //         dd($error);
    //     }
        

    //         dd($response);
        
    //     // print($response->getStatusCode());
    //     // $results = $response->getBody()['results'];
    //     // dd($results);
    // }
    
    
    
     
    
    public function sendEmailDelivery($messageId)
    {
        
        $client = new Client([
            'headers' => [
                'Authorization' => $this->apiKey,
                'Content-Type' => 'application/json',
            ],
        ]);
      
        $response = $client->get($this->apiEndpoint . 'metrics/deliverability/' . $messageId);
        
        if ($response->getStatusCode() == 200) {
            // Successful response, email was sent
            $data = json_decode($response->getBody(), true);
            dd($data['results']);   
            // Check the delivery status from the response
            return $data['results']['deliverability'][0]['status'];
        } else {
            // Unsuccessful response, email may not have been sent
            return 'Error: ' . $response->getBody();
        }
        
    }
    
    public function BounceWebhook(Request $request){
        // $client = new Client([
        //     'headers' => [
        //         'Authorization' => $this->apiKey,
        //         'Content-Type' => 'application/json',
        //     ],
        // ]);
       

        // $webhookData = $request->all();
        
        

        // // // Convert the webhook data to HTML
        // // $html = '<html><body><h1>Webhook Data</h1><ul>';
        // // foreach ($webhookData as $key => $value) {
        // //     $html .= '<li><strong>' . htmlspecialchars($key) . ':</strong> ' . htmlspecialchars($value) . '</li>';
        // // }
        // // $html .= '</ul></body></html>';
        
        
        // $response = $client->post($this->apiEndpoint . 'transmissions', [
        //     'json' => [
        //         'options' => [
        //             'sandbox' => false,
        //         ],
        //         'content' => [
        //             'name' => 'Developer Team',
        //             'from' => 'developer@sweetiepiebakeco.indigitalapi.com',
        //             'subject' => "BOUNCED EMAILS EMAIL TESTING",
        //              'html' => '$template',
        //         ],
        //         'recipients' => [
        //             'address' => [
        //                     'name' => 'Shefii',
        //                     'email' => 'shefii.indigital@gmail.com',
        //                 ],
        //         ],
        //     ],
        // ]);
        
        
    }
    
    public function DeliveryWebhook(Request $request){
    
           $jsonData = $request->json()->all();
     
            $psr17Factory = new Psr17Factory();

            $httpClient = new GuzzleAdapter(new \GuzzleHttp\Client());
    
            $sparky = new SparkPost($httpClient, [
                'key' => $this->apiKey,
                'async' => false,
                'httpClient' => $httpClient,
                'options' => [
                    'message_factory' => new DiactorosMessageFactory(),
                ],
            ]);
                        
        if (is_array($jsonData) && !empty($jsonData)) {
            
            foreach ($jsonData as $item) {
                if (isset($item['msys']['message_event']['message_id'])) {
                    $messageId = $item['msys']['message_event']['message_id'];
                    $rcpt_to   = $item['msys']['message_event']['rcpt_to'];
                    $timestamp = $item['msys']['message_event']['timestamp'];


                Log::info('Email Deliveried Successfully'.$rcpt_to .' : '.$messageId.' => '.$timestamp);
                        // try {
                        //     $response = $sparky->transmissions->post([
                        //         'content' => [
                        //             'from' => [
                        //                 'name' => 'Developer Team',
                        //                 'email' => 'developer@sweetiepiebakeco.indigitalapi.com',
                        //             ],
                                    
                        //             'subject' => 'Email Deliveried Successfully',
                        //             'html' => "<html><head></head><body>".$rcpt_to ." : ".$messageId." => ".$timestamp ."</body></html>",
                        //         ],
                        //         'recipients' => [
                        //             [
                        //                 'address' => [
                        //                     'name' => 'Developer',
                        //                     'email' => 'shefii.indigital@gmail.com',
                        //                 ],
                        //             ],
                        //         ],
                              
                        //     ]);
                        // } catch (\Exception $error) {
                        //     dd($error);
                        // }
        
                    return response()->json(['success' => true]);
                }
            }
        }

        return response()->json(['error' => 'Invalid data'], 400);
        
    }
    
    public function validateEmail(Request $request){
        $validator = Validator::make($request->all(), [
                        'email' => 'email:rfc'
                    ]);
                    
        if ($validator->fails()) {
         dd($validator->errors()->all());   
        }
        else{
            dd(true);
        }
    }
    
    
    public function sendEmail($invoice_id,$recipient)
    {
        $order_details = Order::orderBy('id', 'DESC')->where('invoice_id', $invoice_id)->first();
        // $template = view('emails.order-notification', compact('order_details'))->render();
         $template = new OrderInvoiceMail($order_details);
        $template = $template->render();
            
        $client = new Client([
            'headers' => [
                'Authorization' => $this->apiKey,
                'Content-Type' => 'application/json',
            ],
        ]);

        $response = $client->post($this->apiEndpoint . 'transmissions', [
            'json' => [
                'options' => [
                    'sandbox' => false,
                ],
                'content' => [
                    'name' => 'Developer Team',
                    'from' => 'developer@sweetiepiebakeco.ca',
                    'subject' => "API EMAIL TESTING",
                    'html' => $template,
                ],
                'recipients' => [
                    ['address' => ['email' => $recipient]],
                ],
                'cc' => [
                    [
                        'address' => [
                            'name' => 'ROHITH',
                            'email' => 'rohithr.indigital@gmail.com',
                        ],
                    ],
                ],
                'bcc' => [
                    [
                        'address' => [
                            'name' => 'Developer',
                            'email' => 'developer@indigitalgroup.ca',
                        ],
                    ],
                    [
                        'address' => [
                            'name' => 'Shefii',
                            'email' => 'shefii.indigital@gmail.com',
                        ],
                    ],
                ],
            ],
        ]);
        dd($response);
        
        // Decode the response JSON
        $responseData = json_decode($response->getBody(), true);

        // Check if the response contains a message ID
        if (isset($responseData['results']['id'])) {
            // Return the message ID
            return $responseData['results']['id'];
        } else {
            // Return null or handle the case where the message ID is not present in the response
            return null;
        }
    }

}
