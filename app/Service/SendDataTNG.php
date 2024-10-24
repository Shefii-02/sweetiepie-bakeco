<?php
namespace App\Service;
use App\Models\User;
use App\Models\Order;
use App\Models\Item;
use App\Models\Store;
use App\Models\OrderFeedback;
use App\Models\Contact;

trait SendDataTNG{

      public function SendDataTrait(){
        $unsentCustomers = User::whereNull('sent_at')->get();
        $unsentOrders = Order::with('basket','orderItems','address')->whereHas('basket')->whereHas('address')->where('status',1)->whereNull('sent_at')->get();
        $unsentOrderFeedback = OrderFeedback::whereNull('sent_at')->get();
        // dd($unsentOrders);
        foreach ($unsentCustomers as $customer) {
            $apiDomain = env('TNG_API_DOMAIN'); 
            
            $url = $apiDomain."/api/website/new-customer";
           
            $user  = $customer;
            
            $post = [
                     'id'           => $user->id,
                     'first_name'   => $user->firstname,
                     'name'         => $user->name,
                     'last_name'    => $user->lastname,
                     'email'        => $user->email,
                     'password'     => $user->password,
                     'address'      => $user->address,
                     'postalcode'   => $user->postalcode,
                     'city'         => $user->city,
                     'province'     => $user->province,
                     'country'      => $user->country,
                     'phone'        => $user->phone,
                     'dob'          => $user->birthday
                    ];
            $result__api = CurlSendPostRequest($url,$post);
            $isDataSent = json_decode($result__api);
       
            if($isDataSent){
                if ($isDataSent->status == 'Success') {
                    // Update the order's sent_at field
                    User::where('id',$customer->id)->update(['sent_at' => now()]);
                }
            }
        }
        
        
        ///////////////////////////////////ORDER DATA PUSH//////////////////////////////////////////////////////////
        foreach ($unsentOrders as $order) {
    
            //orderdata  using get 
            
            $basket = $order->basket;
            $b_add  = $order->address()->where('type','billing')->first();
            $s_add  = $order->address()->where('type','delivery')->first();
            
            
            if($basket->order_type == 'pickup'){
                $store = Store::where('id',$basket->pickup_id)->first();
            }
            else{
                $store = Store::where('shipping',1)->first() ?? '';
            }
            

            $basketDetails = array();
            
            $basketDetails['user_id']            = $basket->user_id;
            $basketDetails['coupon']             = $basket->coupon_id;
            $basketDetails['discount']           = '';
            $basketDetails['order_type']         = $basket->order_type;
            $basketDetails['shipping_location']  = $basket->shipping_location;
            $basketDetails['pickup_id']          = $basket->pickup_id;
            $basketDetails['serve_date']         = $basket->serve_date;
            $basketDetails['serve_time']         = $basket->serve_time;
            $basketDetails['postal']             = $basket->postal;
            $basketDetails['city']               = $basket->city;
            $basketDetails['remarks']            = $basket->remarks; 
            $basketDetails['make_gift']          = $basket->make_gift; 
            $basketDetails['card_msg']           = $basket->card_msg; 
            $basketDetails['affiliate_id']       = $basket->affiliate_id; 
            $basketDetails['marketing_campaign_id']       = $basket->marketing_campaign_id; 
            
            
            
            $storeDetials = array();
            
            $storeDetials['store_id'] = $store->master_id ?? '';
            $storeDetials['employee_id'] = '';
            
            $billing_address = array();
            $billing_address['first_name']   = $b_add->firstname;
            $billing_address['last_name']   = $b_add->lastname;
            $billing_address['address']     = $b_add->address;
            $billing_address['phone']       = $b_add->phone;
            $billing_address['email']       = $b_add->email;
            $billing_address['city']        = $b_add->city;
            $billing_address['postalcode']  = $b_add->postalcode;
            $billing_address['province']    = $b_add->province;
              

            $shipping_address = array();
            if($basket->order_type == 'delivery'){
                $shipping_address['first_name']  = $s_add->firstname;
                $shipping_address['last_name']  = $s_add->lastname;
                $shipping_address['address']    = $s_add->address;
                $shipping_address['phone']      = $s_add->phone;
                $shipping_address['email']      = $s_add->email;
                $shipping_address['city']       = $s_add->city;
                $shipping_address['postalcode'] = $s_add->postalcode;
                $shipping_address['province']   = $s_add->province;
            }
          
         
            $order_detials = array();
            $order_detials['orderno']           = $order->id;
            $order_detials['invoice_id']        = $order->invoice_id;
            $order_detials['paymeny_id']        = $order->paymeny_id;
            $order_detials['sub_total']         = $order->subtotal;
            $order_detials['grand_total']       = $order->grandtotal;
            $order_detials['shipping_charge']   = $order->shipping_charge;
            $order_detials['coupon']            = $order->coupon;
            $order_detials['payment_status']    = $order->payment_status ?? 0;
            $order_detials['reference_num']     = $order->reference_num ?? 0;
            $order_detials['transaction_id']    = $order->transaction_id ?? 0;
            $order_detials['remark']            = $order->remarks;
            $order_detials['discount']          = $order->discount;
            $order_detials['tax']               = $order->taxamount;
            $order_detials['tax_rate']          = env('TAX_RATE', 13);
            $order_detials['tip']               = "";
            $order_detials['paid_amount']       = "0";
            $order_detials['balance_amount']    = $order->grandtotal;
            $order_detials['order_type']        = $basket->order_type;
            $order_detials['billed_at']         = $order->billed_at;
            $order_detials['ipaddress']         = $order->ipaddress;
            $order_detials['payment_method']    = $order->payment_method ?? '0';
            $order_detials['card_type']         = $order->card_type ?? null;
            $order_detials['paid_cash']         = $order->grandtotal;
            $order_detials['paid_card']         = "";
            $order_detials['status']            = 0;
            $order_detials['card_msg']          = $order->card_msg;
            $order_detials['email']             = $order->email;
            $order_detials['affiliate_id']      = $order->affiliate_id;
            
            
       
            $order_items = array();
            
            $item_s = Item::where('basket_id',$basket->id)->get();
            
            $odr = 0;
            foreach($item_s as $item_val){
                $order_items[$odr]['product_sku']           = $item_val->product_sku;
                $order_items[$odr]['product_name']          = $item_val->product_name;
                $order_items[$odr]['variation']             = $item_val->variation;
                $order_items[$odr]['quantity']              = $item_val->quantity ?? 1;
                $order_items[$odr]['weight']                = $item_val->weight ?? null;
                $order_items[$odr]['box_quantity']          = $item_val->box_quantity ?? null;
                $order_items[$odr]['item_price']            = $item_val->item_price ?? null;
                $order_items[$odr]['price_name']            = '0';
                $order_items[$odr]['price_amount']          = $item_val->price_amount;
                $order_items[$odr]['price_id']              = 0;
                $order_items[$odr]['picture']               = url('images/products/'.$item_val->picture);
                $order_items[$odr]['shipping_charge']       = '';
                $order_items[$odr]['delivery_type']         = '';
                $order_items[$odr]['delivery_date']         = '';
                $order_items[$odr]['delivery_city']         = '';
                $order_items[$odr]['tax']                   = '';
                $order_items[$odr]['discount']              = "";
                $order_items[$odr]['pre_order']             = $item_val->pre_order;
                $order_items[$odr]['customized_product']    = $item_val->customized_product;
                $order_items[$odr]['customized_flavor']     = $item_val->customized_flavor;
                $order_items[$odr]['customized_color']      = $item_val->customized_color;
                $order_items[$odr]['customized_message']    = $item_val->customized_message;
                $order_items[$odr]['customized_border_color']= $item_val->customized_border_color;
                $order_items[$odr]['customized_text_color'] = $item_val->customized_text_color;
                $order_items[$odr]['case_name'] = $item_val->case_name;
                $order_items[$odr]['case_id'] = $item_val->case_id;
                
                
                $order_items[$odr]['special_price_from']        = $item_val->special_price_from;
                $order_items[$odr]['special_price_to']          = $item_val->special_price_to;
                $order_items[$odr]['actual_price']             = $item_val->actual_price;
                $order_items[$odr]['has_special_price']         = $item_val->has_special_price;
              
             
                $odr = $odr+1;
            }
            
            $orderInfo['billingAddress']    = $billing_address;
            $orderInfo['shippingAddress']   = $shipping_address;
            $orderInfo['billEmail']         = $billing_address['email'];
            
            $apiDomain = env('TNG_API_DOMAIN'); 
            
            $url = $apiDomain."/api/website/order-store";
     
            
            $post = ['basketDetails'=> $basketDetails,
                     'storeDetials' => $storeDetials,
                     'orderInfo'    => $orderInfo,
                     'orderDetails' => $order_detials,
                     'orderItems'   => $order_items
                    ];
                    
            $result__api = CurlSendPostRequest($url,$post);
            $isDataSent = json_decode($result__api);
          
            if($isDataSent){
                if ($isDataSent->status == 'Success') {
                    // Update the order's sent_at field
                    Order::where('id',$order->id)->update(['sent_at' => now()]);
                }
            }
            
        }
        //////////////////////////////////////ORDER FEEDBACK///////////////////////////////////////////////////////////////////
        foreach($unsentOrderFeedback as $feedbacks){
            $apiDomain = env('TNG_API_DOMAIN'); 
            $url = $apiDomain."/api/website/order-feedback";
            $post = [
                     'id'           => $feedbacks->id,
                     'invoice_id'   => $feedbacks->invoice_id,
                     'rating'       => $feedbacks->rating,
                     'comments'    => $feedbacks->comments
                    ];
            $result__api = CurlSendPostRequest($url,$post);
            $isDataSent = json_decode($result__api);
      
            if($isDataSent){
                if ($isDataSent->status == 'Success') {
                    // Update the order's sent_at field
                    OrderFeedback::where('id',$feedbacks->id)->update(['sent_at' => now()]);
                }
            }
        }
        
        $listContacts = Contact::whereNull('sent_at')->get();
        
        foreach($listContacts as $contacts){
            $apiDomain = env('TNG_API_DOMAIN'); 
            $url = $apiDomain."/api/website/contact-details";
            $post = [
                        'id'         => $contacts->id,
                        'firstname'  => $contacts->firstname,
                        'lastname'   => $contacts->lastname,
                        'email'      => $contacts->email,
                        'phone'      => $contacts->phone,
                        'subject'    => $contacts->subject,
                        'message'    => $contacts->message
                    ];
            $result__api = CurlSendPostRequest($url,$post);
            $isDataSent = json_decode($result__api);
      
            if($isDataSent){
                if ($isDataSent->status == 'Success') {
                    Contact::where('id',$contacts->id)->update(['sent_at' => now()]);
                }
            }
        }
        
        if($unsentCustomers->count() > 0||$unsentOrders->count() > 0 || $unsentOrderFeedback->count() > 0){
        //   \Log::info("SendDataTrait Cron is working fine!");
        }
        return 0;
      }
        
}