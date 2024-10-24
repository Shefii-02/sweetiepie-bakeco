<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Basket;
use App\Models\Store;
use App\Models\Province;
use App\Models\Tax;
use App\Models\TaxValue;
use App\Models\Shipping;
use App\Models\Item;
use App\Models\ProductVariation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Collection;

//fairbank fundraiser controller

class FundraiserFairbankController extends Controller
{
    public function index(){
        
        if(time() >= strtotime('2024-03-04 00:00:00') ) 
        {
            die('page expired');
        }
        
        $showId = [2395,2396]; // coookie cake variation id
        $showId1 = [2404,2416,2406,2418,2408,2400,2412,2414,2402]; // cookies only
     
        
        $products = Product::with([
                        'product_variation' => function ($query) use ($showId) {
                            $query->whereIn('id', $showId);
                        },
                        'product_variation.variationkey', 
                        'variationList'
                    ])->get();
       

    $products1 = Product::with([
                        'product_variation' => function ($query) use ($showId1) {
                            $query->whereIn('id', $showId1);
                        },
                        'product_variation.variationkey', 
                        'variationList'
                    ])->get();
        
        $basketItems = collect();         
        if (session()->has('session_string')) {
                $session_string = session('session_string');
                $basket = Basket::with('items')->where('session',$session_string)->where('status',0)->first();
                if($basket){
                    $basketItems = Item::where('basket_id',$basket->id)->get();
                }
        }
         
        session(['afflicate_id' => 3]);

        return view('fundraiser.fairbank.index',compact('products','basketItems','products1'));
    }
    
    
    public function readyTopickup(Request $request)
    {        
        
            // Custom validation rules
            $rules = [
                'quantity' => ['required', 'array'],
            ];
        
            // Dynamic rules for each element in the 'quantity' array
            foreach ($request->input('quantity', []) as $key => $value) {
                $rules["quantity.{$key}"] = ['required', 'integer'];
            }
        
            // Custom error messages
            $messages = [
                'quantity.required' => 'Please add at least one quantity.',
                'quantity.array' => 'Invalid quantity data format.',
                'quantity.*.required' => 'Please add at least one quantity.',
                'quantity.*.integer' => 'Quantity must be a number.',
            ];
        
            // Validate the request data
            $validator = \Validator::make($request->all(), $rules, $messages);
        
            // Check if validation fails
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        
       
        
        if (session()->has('session_string')) {
            $randomString =session('session_string');
        }
        else
        {
            $randomString = Str::random(45);
        }
        
        $store = Store::with('store_timing')->where('store_code','Colville')->first();
        
        session(['identity_place'   => $store->name,
                    'pickup_id'         => $store->id,
                    'postalcode'        => $store->postal,
                    'city'              => $store->city,
                    'shipping_location' => $store->address]);
                        
        session(['ordertype' => 'pickup','session_string' => $randomString]);
            
        $basket = Basket::with('items')->where('session',$randomString)->where('status',0)->first();
        
        
        $shipping   = Shipping::where('order_type', 'pickup')->first();
        
        
        $quantities = $request->input('quantity');
        $prepTime  = 0;
        
        
        foreach ($quantities ?? [] as $productVariationId => $quantity) {
            if($quantity > 0){
                // $productVariation = ProductVariation::with('products','productShipping','productShipping.shipping','products.category_products')->findOrFail($productVariationId);
                // if($productVariation->productShipping){
                //     foreach ($productVariation->productShipping ?? [] as $method) {
                //         if($method->shipping){
                //             $temp = $method->shipping->preperation_time;
                //             if($temp > $prepTime){
                //                 $prepTime = $temp;
                //             }
                //         }
                //     }
                // }
                
                if($productVariationId == 2395 || $productVariationId == 2396){
                    $temp = 48;
                }
                else{
                    $temp = 3;
                }
                
                if($temp > $prepTime){
                    $prepTime = $temp;
                }
                
            }
        }
        
        $preparetime = $prepTime * 3600;
        $inDays = intval($preparetime / 86400);
        
        $store_time_open = '08:00';
        $store_close = '20:00';
        
        $dates = ['2024-02-12', '2024-02-13', '2024-02-14', '2024-02-16', '2024-02-21', '2024-02-29'];
        
        $currentTime = strtotime(date('H:i'));
       
        $today =  strtotime(date('Y-m-d'));
        
        if($inDays > 0){
            $available_after = date('Y-m-d', strtotime("+".$inDays." day"));
        }
        
        
        
        foreach ($dates as $day) {
            $dateTime = strtotime($day);
            
            // $openTime = strtotime($store_time_open)+$preparetime;
            
            $openTime = strtotime($store_time_open . ' +'.$prepTime.' hours');

            
            $closeTime = strtotime($store_close);
        
                if ($today > $dateTime) {
                    $availableDateTime[$day]['available'] = false;
                    $availableDateTime[$day]['open'] = date('H:i', $openTime);
                    $availableDateTime[$day]['close'] = date('H:i', $closeTime);
                }
                else if ($today == $dateTime) {
                    $startTime = $currentTime + $preparetime;
                
                    if($openTime > $currentTime &&  $currentTime < $closeTime){
                        $availableDateTime[$day]['available'] = true;
                    }
                    else if ($startTime < $closeTime) {
                        $availableDateTime[$day]['available'] = true;
                    }
                    else{
                        $availableDateTime[$day]['available'] = false;
                    }
                    $startTime = roundTimeToNearestInterval($startTime, 900);
                    $availableDateTime[$day]['open'] = date('H:i', $startTime);
                    $availableDateTime[$day]['close'] = date('H:i', $closeTime);
                } else {
               
                    $availableDateTime[$day]['available'] = true;
                    $availableDateTime[$day]['open'] = date('H:i', $openTime);
                    $availableDateTime[$day]['close'] = date('H:i', $closeTime);
                }
                
                if($inDays > 0){
                    if(strtotime($available_after) > $dateTime){
                        $availableDateTime[$day]['available'] = false;
                    }
                    else{
                        $availableDateTime[$day]['open'] = date('H:i', strtotime($store_time_open . ' +3 hours'));
                    }
                }
            
        }
        
        return view('fundraiser.fairbank.choose-date')->withBasket($basket)->with('postvars',serialize($request->all()))->withStore($store)->withShipping($shipping)->withAvailableDateTime($availableDateTime);


    }
    public function addCart(Request $request){
        
        
       $delivery_date = $request->pickup_date;
       $delivery_time = $request->pickup_time;
       $postvars = unserialize($request->postvars);
       
       $store = Store::where('store_code','Colville')->first();
       
       if(isset($postvars['quantity']) && count($postvars['quantity'])) {
           
            if (session()->has('session_string')) {
                $session_string = session('session_string');
                $basket = Basket::where('session',$session_string)->where('status',0)->first();
                //if basket not created then create a new one
                    if(!$basket){
                        $basket                 =   new Basket();
                    }  
                    else{
                        Item::where('basket_id',$basket->id)->delete();
                    }
                
                    $basket->session            =   $session_string;
                    $basket->pickup_id          =   session('pickup_id');
                    $basket->shipping_location  =   session('shipping_location');
                    $basket->sel_place          =   session('identity_place');
                    $basket->postal             =   session('postalcode');
                    $basket->city               =   session('city');
                    $basket->order_type         =   session('ordertype');
                    $basket->email              =   $request->b_email;
                    $basket->affiliate_id       =   3;
                    $basket->serve_date         =   $delivery_date;
                    $basket->serve_time         =   $delivery_time;
                    $basket->special_campaign   =   1;
                    $basket->save();
                }
                
            }
            else{
                die('Sorry no pickup points available');
            }
          
            foreach($postvars['quantity'] as $key=>$val) {
                
                $pdct_vari          = ProductVariation::with('products')->where('id',$key)->first();
                $tax_id = $pdct_vari->products[0]->tax_id ?? '';
            
                if($tax_id == NULL || $tax_id == ''){
                    $taxvalue = 0;
                }
                else
                {
                    $province = Province::where('code','ON')->pluck('master_id')->first();
                    $tax = Tax::whereMasterId($tax_id)->first() ?? '0';
                  
                    if($tax){
                        $taxvalue = TaxValue::where('tax_id',$tax->id)->where('province_id',$province)->pluck('tax_percentage')->first() ?? '0';   
                    }
                    if(!$tax){
                        $taxvalue = 0;
                    }
                }
             
                // $taxvalue = 13;
                
                if($pdct_vari){
                    $items = Item::where('product_sku',$pdct_vari->sku)->where('basket_id',$basket->id)->first();
                    if(!$items && $val >= 1){
                    	$items                  = new Item();
                    	$items->basket_id       = $basket->id;
                    	$items->tax_percentage  = $taxvalue;
                    	$items->product_variation_id= $pdct_vari->id;
                    	$items->product_id      = $pdct_vari->product_id;
                    	$items->product_sku     = $pdct_vari->sku;
                    	$items->product_name    = $pdct_vari->products[0]->name;
                    	$items->variation       = $pdct_vari->variation_name;
                    	$items->price_amount    = $pdct_vari->price;	
                    	$items->picture	        = product_thumbImage($pdct_vari->product_id) ?? '';
                	    $items->quantity	    = $val;
                	    $items->pre_order       = $pdct_vari->products[0]->seasonal_availability ?? 0;
                	    

                    }
                    elseif($items){
                            $items->quantity        = $val;
                        
                    }
                    
                
                	try{
                	        if($items && $val >= 1){
                    	        $items->save();
                            }
                            elseif($items)
                            {
                                $items->delete();
                            }
                	}
                	catch(\Exceprion $e){
                        
                	}
                }
                else
                {
                    die('item not found..retry');
                }
            }
            return redirect('checkout');
            exit;
        
    }
    
    
    
}