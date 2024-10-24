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
use App\Models\Item;
use App\Models\ProductVariation;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Collection;

class FundraiserController extends Controller
{
    public function index(){
        
        $showId = [196,197,173];

        $products = Product::with('product_variation', 'product_variation.variationkey', 'variationList')
                            ->whereIn('id', $showId)
                            ->get();
        $basketItems = collect();         
        if (session()->has('session_string')) {
                $session_string = session('session_string');
                $basket = Basket::with('items')->where('session',$session_string)->where('status',0)->first();
                if($basket){
                    $basketItems = Item::where('basket_id',$basket->id)->get();
                }
        }
      
        return view('fundraiser.index',compact('products','basketItems'));
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
        
        $store = Store::where('store_code','Colville')->first();
        session(['identity_place'   => $store->name,
                    'pickup_id'         => $store->id,
                    'postalcode'        => $store->postal,
                    'city'              => $store->city,
                    'shipping_location' => $store->address]);
                        
        session(['ordertype' => 'pickup','session_string' => $randomString]);
            
        $basket = Basket::with('items')->where('session',$randomString)->where('status',0)->first();
        
        return view('fundraiser.choose-date')->withBasket($basket)->with('postvars',serialize($request->all()))->withStore($store);;


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
                    $basket->affiliate_id       =   1;
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