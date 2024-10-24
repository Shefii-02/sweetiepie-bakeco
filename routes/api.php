<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Mail\{OrderInvoiceMail, OrderStoreUpdatedMail};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


   
    Route::group(['middleware' => 'api'], function ($router) {
        
        Route::get('hook-url','FrontendController@hook_url');

        // Route::get('hook-url',function(){
        //    
        //     // $apiDomain = env('TNG_API_DOMAIN'); 
        //     // $url = $apiDomain.'/api/website/action-activity';
        //     // $post = [];
            
        //     // try{
        //     //     $data = CurlSendPostRequest($url,$post);
        //     //     $data_check = json_decode($data);
               
        //     //         if(count($data_check->data) > 0){
        //     //             action_activity_getdata($data);
        //     //             return response()->json(['success' => true,'message' => 'Successfully Updated'], 200);
        //     //         }
        //     //         else
        //     //         {
        //     //           return response()->json(['success' => true,'message' => 'No more data for updation'], 200);
        //     //         }

        //     //     return response()->json(['success' => false,'message' => 'Somthing Wrong Data'], 500);
        //     // }
        //     // catch(Exception $e){
        //     //     print_r($e);
        //     //     die();
        //     // }
            
        // });
        
        Route::get('order-email/{invoiceId}', function ($invoiceId) {
            $order_details = App\Models\Order::orderBy('id', 'DESC')->where('invoice_id', $invoiceId)->first();
            return view('emails.order-invoice', compact('order_details'));
        });
       
        Route::any('order-delivery/{invoiceId}', function ($invoiceId,Request $request) {
            $order_details = App\Models\Order::with('basket','orderItems','address')->where('invoice_id',$invoiceId)->first();
        
            if ($request->emailList != '') {
                $emailList = explode(',', trim($request->emailList));

                foreach ($emailList as $email) {
                
                    try {
                        \Mail::to(trim($email))->send(new OrderInvoiceMail($order_details));
                    } catch (\Exception $e) {
                        // Handle the exception, for example, log the error:
                        \Log::error('Email sending failed: ' . $e->getMessage());
                        return false;
                    }
                }
                
                return true;
            } else {
                return false;
            }
        });
        
        Route::any('order-store-change/{invoiceId}', function ($invoiceId,Request $request) {
            $request->validate([
                'store_id' => 'required',
            ]);
            $store = \App\Models\Store::whereMasterId($request->store_id)->firstOrfail();
            $order_details = App\Models\Order::with('basket','orderItems','address')->where('invoice_id',$invoiceId)->first();
            $basket = $oldB = $order_details->basket;
            $basket->pickup_id = $store->id;
            $basket->shipping_location = $store->address;
            $basket->city = $store->city;
            $basket->sel_place = $store->name;
            \Log::error("API worked");
            try {
                $basket->save();
                \Mail::to($basket->email ? : $basket->user->email)->send(new OrderStoreUpdatedMail($order_details));
            } catch (\Exception $e) {
                dd($e);
            }
        });
        
    });
    
    
    
    
    Route::post('delivery-webhook','API\ApiController@DeliveryWebhook');
    
    
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

