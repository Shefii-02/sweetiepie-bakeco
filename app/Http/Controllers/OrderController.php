<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Basket;
use App\Models\Item;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Response;
use App\Models\Store;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\Address;
use App\Models\OrderPayment;
use App\Models\TaxValue;
use App\Models\Tax;
use App\Models\City;
use App\Models\Province;
use App\Models\Coupon;
use App\Models\Myaddress;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendDataJob;
use Carbon\Carbon;
use Mail;
use App\Mail\OrderInvoiceMail;
use App\Mail\OrderNotification;
use App\Http\Requests\CheckoutFormRequest;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\CartFormRequest;

use App\Models\Subscribe;
use App\Mail\SignupMail;
use Illuminate\Support\Facades\DB;

    
use App\Library\Moneris\mpgTransaction;
use App\Library\Moneris\CofInfo;
use App\Library\Moneris\mpgRequest;
use App\Library\Moneris\mpgHttpsPost;
use App\Library\Moneris\mpgCvdInfo;



use CraigPaul\Moneris\Moneris;
use App\Libraries\MonerisReceipt;


use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    
    use \App\Service\SendDataTNG;
    public function create_sessions(Request $request){
        if($request->ordertype == 'delivery'){
             $validator = Validator::make($request->all(), [
                'ordertype' => 'bail|required',
                'city'  => 'bail|required',
                'street_address'=> 'bail|required',
            ]);
        }
        else
        {
             $validator = Validator::make($request->all(), [
                'ordertype' => 'bail|required',
                'pickup_store'  => 'bail|required',
            ]);
        }
        
         if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }
        
        //create a session data
        try{
            
            //unique session inside check  other waise create new one 
            if (session()->has('session_string')) {
                $randomString =session('session_string');
            }
            else
            {
                $randomString = Str::random(45);
            }
            
            
            if($request->ordertype == 'pickup'){
                $store = Store::where('id',$request->pickup_store)->first() ?? abort(404);
                session(['identity_place'   => $store->name,
                        'pickup_id'         => $store->id,
                        'postalcode'        => $store->postal,
                        'city'              => $store->city,
                        'province'          => '',
                        'shipping_location' => $store->address]);
            }
            else if($request->ordertype == 'delivery'){
               session(['identity_place'    => $request->city,
                        'pickup_id'         => NULL,
                        'postalcode'        => $request->postal,
                        'city'              => $request->city,
                        'province'          => $request->province,
                        'shipping_location' => $request->street_address,
                        'autocomplete'      => $request->autocomplete]);
            }
            else{
               die('Invalid Request');
            }
            
            session(['ordertype' => $request->ordertype,'session_string' => $randomString]);
            
            //already basket order type check and clear cart Items
            if (session()->has('session_string')) {
                $session_string = session('session_string');
                $basket = Basket::where('session',$session_string)->where('status',0)->first();
                if($basket){
                    if($request->ordertype <> $basket->order_type){
                        Item::where('basket_id',$basket->id)->delete();
                        $basket->special_campaign == 0;
                        $basket->serve_date = null;
                        $basket->serve_time =null;
                    }
                    
                    $basket->pickup_id   = session('pickup_id');
                    $basket->shipping_location = session('shipping_location');
                    $basket->sel_place   = session('identity_place');
                    $basket->postal      =session('postalcode');
                    $basket->city        =session('city');
                    $basket->order_type  =session('ordertype');
                    
                    $basket->email  = session('billing_email') ?? ''; 
                    $basket->save();
                }
            }
            //end
            if($request->has('redirect') && $request->redirect != ''){
                return redirect($request->redirect);
            }
            else{
             return redirect()->back(); 
            }
        }
        catch(\Exception $e)
        {
            // dd($e);
        }
    //end
    }
    
    

    public function addToBasket(Request $request){
        $response = array();
        $response['result'] = 0;
        $response['cart_count'] = 0;
        $response['addToCartData'] = '';
        if (session()->has('session_string')) {
            $randomString =session('session_string');
        }
        else
        {
            $randomString = Str::random(45);
            session(['session_string' => $randomString]);
        }
            if ($randomString) {
                $session_string = session('session_string');
                $basket = Basket::where('session',$session_string)->where('status',0)->first();
                //if basket not created then create a new one
                if(!$basket){
                    $basket = new Basket();
                    $basket->session = $session_string;
                    $basket->pickup_id   = session('pickup_id');
                    $basket->shipping_location = session('shipping_location');
                    $basket->sel_place    = session('identity_place');
                    $basket->postal       = session('postalcode');
                    $basket->city         = session('city');
                    $basket->order_type   = session('ordertype') ?? 'delivery';
                    $basket->affiliate_id = session()->has('afflicate_id') ? session('afflicate_id') : null;
                    $basket->special_campaign = session()->has('afflicate_id') ? 1 : 0;
                    $basket->email  = session('billing_email') ?? '';   
                    $basket->save();

                }
                else{
                    $basket->affiliate_id = session()->has('afflicate_id') ? session('afflicate_id') : null;
                    $basket->special_campaign = session()->has('afflicate_id') ? 1 : 0;
                    if($basket->email == '' || $basket->email == NULL){
                        $basket->email  = session('billing_email') ?? '';
                    }
                    $basket->save();
                }
                
                $pdct_vari          = ProductVariation::with('products')->where('id',$request->pdct_id)->first();
                $product = \App\Models\Product::find($pdct_vari->product_id);
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
             
                $taxvalue = env('TAX_RATE', 13);
                
                if($pdct_vari){
                    // $items = Item::where('product_sku',$pdct_vari->sku)->where('basket_id',$basket->id)->first();
                    // if(!$items){
                        $case = $request->case_id ? $product->cases()->where('id', $request->case_id)->first() : $product->cases()->first();
                        $case = $case ? : $product->cases()->first();
                    	$items                  = new Item();
                    	$items->basket_id       = $basket->id;
                    	$items->tax_percentage  = $taxvalue;
                    	$items->product_variation_id= $pdct_vari->id;
                    	$items->product_id      = $pdct_vari->product_id;
                    	$items->product_sku     = $pdct_vari->sku;
                    	$items->product_name    = $pdct_vari->products[0]->name;
                    	$items->variation       = $pdct_vari->variation_name;
                        $items->item_price      = $pdct_vari->price;	
                    	
                        $items->weight          = $pdct_vari->weight;
                        //$items->box_quantity    = $pdct_vari->box_quantity;
                        $items->box_quantity =  $case ? $case->quantity : 1;
                        $items->case_name = $case->name ?? null;
                        $items->case_id = $case->master_id ?? null;
                        $items->price_amount    = $pdct_vari->price * $items->box_quantity;	
                    	$items->picture	        = product_thumbImage($pdct_vari->product_id) ?? '';
                	    $items->quantity	    = $request->quantity;
                	    $items->pre_order       = $pdct_vari->products[0]->seasonal_availability ?? 0;
                	    
                	    if($pdct_vari->products[0]->has_customization){
                        	    $items->customized_flavor   = $request->flavor;
                                $items->customized_color    = $request->color;
                                $items->customized_message  = $request->message;
                                $items->customized_border_color = $request->border_color;
                                $items->customized_text_color = $request->text_color;
                                $items->customized_product  = 1;
                	    }
                	    
                	    if($pdct_vari->products[0]->has_special_price == 1 && $pdct_vari->products[0]->special_price_from <= date('Y-m-d') && $pdct_vari->products[0]->special_price_to >= date('Y-m-d'))
                	    {
                	        	$items->special_price_from	    = $pdct_vari->products[0]->special_price_from;
                	        	$items->special_price_to	    = $pdct_vari->products[0]->special_price_to;
                	        	$items->has_special_price	    = 1;
                	        	$items->price_amount            = $pdct_vari->special_price;
                	        	$items->actual_price	        = $pdct_vari->price;
                	    }

                    // }
                    // else
                    // {
                    //     $items->quantity        = $items->quantity + $request->quantity;
                    // }
                    
                    if($request->has('parent_id')){
                        $items->parent              = $request->parent_id;
                    }
                
                	try{
                	       //if($request->quantity >= 1){
                    	        $items->save();
                            // }
                            // else
                            // {
                            //     $items->delete();
                            // }
                        
                        $itemsCounts = Item::where('basket_id',$basket->id)->count();
                        if($itemsCounts == 0){
                            $basket->special_campaign = 0;
                            $basket->serve_date = NULL;
                            $basket->serve_time = NULL;
                            $basket->save();
                        }
                        
                            
                        $response['result'] = 1;
                        $response['cart_count'] = $itemsCounts;
                	}
                	catch(Exceprion $e){
                        $response['cart_count'] = Item::where('basket_id',$basket->id)->count();
                	}
                }
                else
                {
                    $response['cart_count']     = Item::where('basket_id',$basket->id)->count();
                }
                
                
                
                $items_val[] = [      "item_id"     => $items->product_sku,
                                      "item_name"   => $items->product_name,
                                      "affiliation" => $basket ? $basket->city ?? "" : '',
                                      "index"       => 0,
                                      "item_brand"  => "Sweetiepie",
                                       "item_variant" => $items->variation,
                                      "location_id" => "Toronto",
                                      "price"       => $items->price_amount,
                                      "quantity"    => $items->quantity
                                ];
           
                $response['addToCartData'] = [
                            "currency" => "CAD",
                            "value" => $items->price_amount,
                            "items" =>  $items_val
                        ];
                        
                return  response()->json($response);
            }
            else
            {
                die('Invalid Request');
            }
          
    }
    
    public function cart(Request $request){
        $stores = Store::get();
        $session_string = session('session_string');

        $this->CartRefresh();
            
        $basket = Basket::where('session',$session_string)->where('status',0)->first();
        
        if($basket){
            $items = Item::with('addon_products','product')->where('basket_id',$basket->id)->get();
            return view('frontend.cart',compact('items','stores','basket'));
        }
        else{
         return view('frontend.cart');
        }
    }
    
    public function productadd(Request $request){
        $response = array();
        $response['result'] = 0;
        $response['cart_count'] = 0;
        $response['addToCartData'] = '';
        
        if(session()->has('session_string')) {
            $session_string = session('session_string');;
            $basket = Basket::where('session',$session_string)->where('status',0)->first();
     
            if($basket){
                $pdct_vari        = ProductVariation::where('id',$request->product_id)->first();
                if($pdct_vari){
                    $psku  = $pdct_vari->sku;
                }
                else
                {
                    $psku = $request->product_sku;
                }
                // $items            = Item::where('product_sku',$psku)->where('basket_id',$basket->id)->first();
                $items            = Item::where('id',$request->item_id)->where('basket_id',$basket->id)->first();
                $items->quantity =  $request->quantity;
                try{
                    if($request->quantity >= 1){
            	        $items->save();
                    }
                    else
                    {
                        $items->delete();
                    }
                    
                    $itemsCounts = Item::where('basket_id',$basket->id)->count();
                   
                    if($itemsCounts == 0){
                        $basket->special_campaign = 0;
                        $basket->serve_date = NULL;
                        $basket->serve_time = NULL;
                        $basket->save();
                    }
                    $response['result'] = 1;
                    $response['cart_count'] = $itemsCounts;
                     
                    
                    $items_val[] = [    "item_id"     => $items->product_sku,
                                        "item_name"   => $items->product_name,
                                        "affiliation" => $basket ? $basket->city ?? "" : '',
                                        "index"       => 0,
                                        "item_brand"  => "Sweetiepie",
                                        "item_variant" => $items->variation,
                                        "location_id" => "Toronto",
                                        "price"       => $items->price_amount,
                                        "quantity"    => $items->quantity
                                    ];
           
                    $response['addToCartData'] = [
                                                    "currency" => "CAD",
                                                    "value" => $items->price_amount,
                                                    "items" =>  $items_val
                                                ]; 
                     
                     
                    return  response()->json($response);
            	}
            	catch(Exceprion $e){
            	    $response['cart_count'] = Item::where('basket_id',$basket->id)->count();
                    return  response()->json($response);
            	}
            }
        }
        
       
        return  response()->json($response);
    }
    
    public function get_addons(CartFormRequest $request)
    {
        $session_string = session('session_string');
        $basket = Basket::where('session', $session_string)->where('status', 0)->first();
    
        if (!$basket) {
            return response()->json(['success' => false, 'message' => 'Invalid Attempt']);
        }
        
        $basket->serve_date = $request->pickup_date;
        $basket->serve_time = $request->pickup_time ?? null; // If not provided for delivery
        $basket->remarks = $request->remark;
        $basket->save();
    
        $items = Item::with('addon_products')->where('basket_id', $basket->id)->get();
    
        $addon_pdct_count = 0;
        foreach ($items as $item) {
            if (!$item->addon_products->isEmpty()) {
                $addon_pdct_count++;
            }
        }
    
        if ($addon_pdct_count != 0) {
            return response()->json([
                'success' => true,
                'html' => view('frontend.addon_products')->withItems($items)->withBasket($basket)->render(),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'html' => '',
            ]);
        }
    }


    public function cart_continue(Request $request){
        $session_string = session('session_string');;
        $basket = Basket::where('session',$session_string)->where('status',0)->first();
        if($basket && $basket->special_campaign == 0){
            $basket->serve_date = $request->serve_date;
            $basket->remarks = $request->remark;
            $basket->save();
        }
        
        return redirect('/menu');
    }
    
    
    public function checkout(Request $request){
        
        
            $this->CartRefresh();
            
        if(session()->has('session_string') ) {
            
           
        $session_string = session('session_string');
            
            $basket = Basket::where('session',$session_string)->where('status',0)->first();
            
            if($basket){
                if($request->all() != null && $basket->special_campaign == 0){
                    if($basket->order_type == 'pickup'){
                        $basket->serve_date = $request->pickup_date;
                        $basket->serve_time = $request->pickup_time;
                    }
                    else{
                        $basket->serve_date = $request->shipping_date;
                    }
                    $basket->remarks = $request->remark;
                }
                
                $basket->save();
                $items = Item::with('parentItem')
                            ->where('basket_id', $basket->id)
                            ->where(function ($query) {
                                $query->whereNull('parent')
                                    ->orWhere('parent', '=', 0); // Add this line to include items with parent = 0 if applicable
                            })
                            ->get();
                            
                if($items->count() > 0){
                    $shiiping_method = Shipping::where('order_type',$basket->order_type)->first();
                    $cities     = City::get();
                    $province   = Province::get();
                    $greetingCardproducts   =   Product::with('product_variation','images','product_city','variationList','specializations')
                                						->whereHas('product_variation',function($query) {
                                                            $query->where('sku','<>','');
                                						})
                                						->where('greeting_card','1')
                                						->get();
                  
					if (($basket->order_type == 'pickup' && $basket->serve_date != '' && $basket->serve_time != '') || ($basket->order_type == 'delivery' && $basket->serve_date != '')) {
                        return view('frontend.checkout', compact('items', 'shiiping_method', 'basket', 'cities', 'province', 'greetingCardproducts'));
                    } else {
                        return redirect('/cart');
                    }

                    
                }
                else
                {
                        return redirect('/cart');
                }
            }
            
        }
          return redirect('/cart');

    }
    
    //check and apply Discount coupon code
    
    public function gift_code_apply(Request $request){
        $date_now                = date('Y-m-d h:i:s');
        $response                = array();
        $response['result']      = 0;
        $response['msg']         = '';
        $response['value']       = 0;
        $response['value_type']  = 0;
        $response['coupon_id']   = 0;
        $response['coupon_code'] = 0;
        
        $session_string = session('session_string');;
        $basket = Basket::where('session',$session_string)->where('status',0)->first() ?? abort(404);


        $coupon_details = Coupon::where('availability','<>','in-store')->where('code',$request->gift_code)->where('start_time','<=',$date_now)->where('end_time','>=',$date_now)->first();
        if($coupon_details && $coupon_details->value_type){
            if($coupon_details->value_type == 'percentage'){
                $value = intval($coupon_details->value). '% OFF';
            }
            else
            {
                $value = '$'.$coupon_details->value. ' OFF';
            }
            
            $response['msg']      = '<span class="text-success">Coupon "'.$request->gift_code.'" Applied '.$value.'</span>';
            $response['value']       = $coupon_details->value;
            $response['coupon_id']   = $coupon_details->id;
            $response['coupon_code'] = $coupon_details->code;
            $response['value_type']  = $coupon_details->value_type; 
            $response['result']      = 1;
            
            $basket->coupon_id = $coupon_details->id;
            $basket->save();
            return  response()->json($response);
        }
        else
        {
            $response['msg']      = '<span class="text-danger">Invalid Coupon "'.$request->gift_code.'</span>';
            $response['result']      = 0;
            $response['value']       = 0;
            $response['value_type']  = ''; 
            
            $basket->coupon_id = NULL;
            $basket->save();
            return  response()->json($response);
        }
        
    }
    
    
    //end
    
    public function place_order(CheckoutRequest $request){
        if(session()->has('session_string') ){
         
            $session_string = session('session_string');
    
            $basket = Basket::where('session',$session_string)->where('status',0)->first() ?? abort(404);

            if((env('SANDBOX_PAYMENT', false))){
                if(($request->nameOnCard == 'Card Test') &&  ($request->cardNumber == 4111111111111111)){
                }
                else{
                    return redirect('/checkout')->withErrors([1])->withInput($request->input())->with('error','Payment Failed. Only accepted Test cards');
                }
            }
            
       
            if($basket->order_type == 'pickup'){
                $store = Store::where('id',$basket->pickup_id)->first();
            }
            else{
                $store = Store::where('shipping',1)->first() ?? '';
                
                
                if($request->has('make_gift_checkbox')){
                    $basket->make_gift   = $request->has('make_gift_checkbox') ? 1 : 0;
                    $basket->card_msg    = $request->card_msg;
                    $basket->save();
                }
                
            }

            // if(!auth()->check()){

            $selectedShipping = Myaddress::where('id',$request->address_id)->first();
            
            $shipping_add['firstname']   = $selectedShipping->firstname ?? $request->s_firstname;
            $shipping_add['lastname']    = $selectedShipping->lastname ?? $request->s_lastname;
            $shipping_add['address']     = $selectedShipping->address ?? $request->s_address; 
            $shipping_add['postalcode']  = $selectedShipping->postalcode ?? $request->s_postal; 
            $shipping_add['city']        = $selectedShipping->city ?? $request->s_city;  
            $shipping_add['province']    = $selectedShipping->province ?? $request->s_province;

                $shipping_add['phone']       = $selectedShipping ? auth()->user()->phone : $request->s_phone; 
                $shipping_add['email']       = $selectedShipping ? auth()->user()->email : $request->s_email;  
            
            
            
            ////////////////////////////////////////////////////////////
            // if($request->has('same_billing')){
                $billing_data = array();

                $sameBilling = $request->has('billing_address_add');

                $billing_data['firstname']   = $sameBilling ? $shipping_add['firstname'] : $request->b_firstname;
                $billing_data['lastname']    = $sameBilling ? $shipping_add['lastname'] : $request->b_lastname;
                $billing_data['address']     = $sameBilling ? $shipping_add['address'] : $request->b_address; 
                $billing_data['postalcode']  = $sameBilling ? $shipping_add['postalcode'] : $request->b_postal; 
                $billing_data['city']        = $sameBilling ? $shipping_add['city']   : $request->b_city;  
                $billing_data['province']    = $sameBilling ? $shipping_add['province'] : $request->b_province;
                $billing_data['phone']       = $sameBilling ? $shipping_add['phone']   : $request->b_phone;  
                $billing_data['email']    = $sameBilling ? $shipping_add['email'] : $request->b_email;
                
                $billing_add = json_decode(json_encode($billing_data));
                $shipping_add = json_decode(json_encode($shipping_add)); // convert array to collection
                
                //dd($billing_add, $shipping_add, $request);
            // }
            //////////////////////////////////////////////////////Sign up///////////////////////////////////////
            // if($request->has('clickedSignup')){
            //     if($user = $this->userSignup($billing_add)) {
                    
            //         Auth::login($user);
                    
            //         if($basket) {
            //             $basket = Basket::where('id',$basket->id)->first();
            //             $basket->user_id    =  $user->id;
            //             $basket->email      =  $user->email;
            //             $basket->save();
            //         }
            //     }
            // }
        // }    
        
        // dd($shipping_add, $billing_add)
        
            if($basket){
           
                  
            //calculation_part
            
            $calculations  = $this->GrandTotalCalculation($basket);
            
            $calculations = json_decode($calculations);
            
            $totalAmount = $calculations->subTotal;
            $tax_amount  = $calculations->TotalTax;
            $discount    = $calculations->Discount;
            $couponCode  = $calculations->DiscountCode;
            $ship_charge = $calculations->ShippingCharge;
            $ship_tax    = $calculations->shippingTax;
            $grand       = $calculations->grandTotal;
            
            DB::beginTransaction();
            
            try{
                Address::where('basket_id',$basket->id)->delete();
                
                //existing customer address details
                // if(auth()->check()){
                    // $billing_add  = Myaddress::where('id',$request->billing_address)->first();
                    // if(!$billing_add){
                    //     $billing_add = Myaddress::where('user_id',auth()->user()->id)->first();
                    // }
                    
                    $this->storeAddress($billing_add,$basket->id,'billing');
                    
                    // if($basket->order_type == 'delivery'){
                        // if(!$request->has('same_billing')){
                        //     $this->storeAddress($billing_add,$basket->id,'delivery');
                        // }
                        // else
                        // {
                            // $shipping_add = Myaddress::where('id',$request->shipping_address ?? $request->billing_address)->first();
                            // // dd($shipping_add, $request->shipping_address, $request->all());
                            // if(!$shipping_add && $shipping_data){
                            //     $shipping_add = $shipping_data;
                            // }
                            $this->storeAddress($shipping_add,$basket->id,'delivery');
                        // }
                    // }
                    $basket->remarks = $request->notes;
                    $basket->email = auth()->check() ? auth()->user()->email : $billing_add->email;
                    $basket->user_id = auth()->user()->id;
                    $basket->save();
                // }
                // else
                // {
                // //gust customer address details
                    
                //     $this->storeAddress($billing_add,$basket->id,'billing');
                
                //     if($basket->order_type == 'delivery'){
                //         // if(!$request->has('same_billing')){
                //         //     $this->storeAddress($billing_add,$basket->id,'delivery');
                //         // }
                //         // else
                //         // {
                //             $this->storeAddress($shipping_data,$basket->id,'delivery');
                //         // }
                //     }
                // }
                
                //promotional_mails store
                // if($request->has('promotional_mails')){
                //     $already = Subscribe::where('email',$billing_add->email)->first();
                //     if(!$already && isset($billing_add->email)){
                        
                //         $new = new Subscribe();
                //         $new->email = $billing_add->email;
                //         $new->save();
                //     }
                    
                //     // $apiDomain = env('TNG_API_DOMAIN'); 
                //     // $url = $apiDomain."/api/website/new-subscriber";
                //     // $post = ['email'        => auth()->check() ? auth()->user()->email : $billing_add->email];
                //     // $result__api = CurlSendPostRequest($url,$post);
                //     // $result__api = json_decode($result__api);
                // }
            
            
            ///////////////////////////////////////////////////Payment Integration////////////////////////////////////////////////////////////////////////////
            $now = \DateTime::createFromFormat('U.u', microtime(true));
            $paymeny_id = 'SPB'.$now->format("YmdHis").rand(0,10);
            // $pay = $this->makePayment($paymeny_id,$grand,$basket,$request);
          
            // $refNum = $pay->getReferenceNum();
            // $txnNum = $pay->getTxnNumber();
            // $resCod = $pay->getResponseCode();
            // $receipt = new MonerisReceipt($pay->receipt());
            // $txnNum = $receipt->read('transaction');
            // $refNum = $receipt->read('reference');
            // $resCod = $pay->status;
            
            
            // // 
            // if( ($resCod< 50 && strlen($refNum) > 5 && strlen($txnNum) > 5 && is_numeric($resCod)) || env('SANDBOX_PAYMENT', false))
            // {
             $pay = $this->makePayment($paymeny_id,$grand,$basket,$request);
          
            $refNum = $pay->getReferenceNum();
            $txnNum = $pay->getTxnNumber();
            $resCod = $pay->getResponseCode();
            // 
            if( ($pay->getResponseCode() < 50 && strlen($refNum) > 5 && strlen($txnNum) > 5 && is_numeric($resCod)) || env('SANDBOX_PAYMENT', false))
            {
                
                $order              = new Order();
                $order->basket_id   = $basket->id;
                $order->subtotal    = $totalAmount;
                $order->taxamount   = $tax_amount;
                $order->discount    = $discount;
                $order->coupon      = $couponCode;
                $order->shipping_charge = floatval($ship_charge);
                $order->grandtotal  = $grand;
                $order->user_id     = auth()->check() ? auth()->user()->id:NULL;
                $order->ipaddress   = request()->ip();
                $order->email       = auth()->check() ? auth()->user()->email : $billing_add->email;
                $order->status      = 0;
                $s_add = [];
                $order->payment_method = 'credit_card';
                $order->card_type   = $this->identifyCreditCard($request->cardNumber);
                
                $order->reference_num = $refNum;
                $order->transaction_id = $txnNum;
                $order->payment_status = 1;
                $order->status  = 1;
                $order->billed_at  = date('Y-m-d H:i:s');
                $inv_id = $this->invoiceNumberGenerate();
                $order->invoice_id  = $inv_id;
                $order->paymeny_id  = $paymeny_id;
                $order->affiliate_id = $basket->affiliate_id;
                $order->save();
        
                $basket->open   = 0;
                $basket->page = 'thankyou';
                $basket->save();
                
                if($basket->discount > 0 && $basket->coupon)
                {
                    Discount::whereName($basket->coupon)->increment('usage');
                }
          
                    if($order->status == 1){
                        
                        Address::where('basket_id',$basket->id)->update(['order_id' => $order->id]);
                        
                   
                        $basket->status = '1';
                        $basket->marketing_campaign_id = session()->has('campId') ? session('campId') : null;
                        $basket->save();
                        
                    }
                   
                    $invoice_id = $order->invoice_id;
                
                    DB::commit();

                    
                  
                        try{ 
                            $this->SendDataTrait();
                            // Dispatch the SendDataJob to the queue
                            // SendDataJob::dispatch()->delay(now()->addSeconds(10)); // Delayed dispatch
                        
                        }
                        catch(\Exception $e){
                            
                        }
                    
                    if($order->status == 1){
                        $randomString = Str::random(45);
                        session(['session_string' => $randomString]);
                    }
                    
                   if($basket->special_campaign == 1){
                       session()->flush();
                   }
                    
                    $string = base64_encode(serialize(array('order_id'=>$order->id, 'basket_id'=>$basket->id)));
                    
                    return redirect('/account/orders/'.$order->id.'?success=true')->with('new', true);
              
                }
                else 
                {
                    $message_text = $pay->getMessage();
                    Address::where('basket_id',$basket->id)->delete();
                    return redirect('/checkout')->withInput($request->input())->with('error','Payment Failed'.'<br><span style="color:red;font-size:16px;font-weight:700;">'.$message_text.'-'.$pay->getResponseCode().'<span>');//
                }
      
            }
            catch(\Exception $e){
                // dd($e);
                DB::rollback();
                Address::where('basket_id',$basket->id)->delete();
            }
        }
            else
            {
                return redirect('/');
            }
                 
        }
        else
        {
            return redirect('/');
        }

         
    }
    
    public function thankyou(Request $request){
         $base64Data = $request->query('order');
    
            if (!$base64Data) {
                abort(404);
            }
    
        
        $data = unserialize(base64_decode(request()->order)) ;

        if(!is_array($data) && isset($data['order_id'])) { abort(404); }
        
        //$basket = Basket::where('session',$request->processing_id)->first() ?? abort(404);
        $order  = Order::with(['basket'=>function($q) { $q->with('items'); }])->where('id',$data['order_id'])->first() ?? abort(404);
        $googlecode = $this->googleCodeThankyou($order);
        $invoice_id = $order->invoice_id;
        return view('frontend.thanks',compact('invoice_id','googlecode'));
    
    }
    
    // function googleCodeThankyou($order)
    // {
    //     if($basket = $order->basket){
    //         //Google code
    //         $temptot = $order->grandtotal ?? 0;
    //         $ggtrans = 'pageTracker._addTrans(';
    //         $ggtrans .= '"'.$order->id.'",';
    //         $ggtrans .= '"Sweetiepie",';
    //         $ggtrans .= '"'.$temptot.'",';
    //         $ggtrans .= '"'.$order->taxamount.'",';                           
    //         $ggtrans .= '"'.$order->shipping_charge.'",';
    //         $ggtrans .= '"Toronto",';
    //         $ggtrans .= '"Ontario",';
    //         $ggtrans .= '"Canada");';
            
    //         $ggitems = '';
    
    //         foreach($basket->items as $item)
    //         {   
    //             $ggitems .= 'pageTracker._addItem(';
    //             $ggitems .= '"'.$basket->id.'",';
    //             $ggitems .= '"'.$item->product_sku.'",';
    //             $ggitems .= '"'.$item->product_name.'",';
    //             $ggitems .= '"'.$item->variation.'",';
    //             $ggitems .= '"'.number_format($item->price_amount/100,2).'",1';
    //             $ggitems .= ');'."\n";
    //         }
    
    //         $googlecode = $ggtrans . "\n\n" . $ggitems; 
    //     }
    //     else
    //     {
    //         $googlecode = '';
    //     }
            
    //     return $googlecode;
            
    // }
    
    function googleCodeThankyou($order)
        {
            if ($basket = $order->basket) {
                $items = [];
                foreach ($basket->items as $key => $item) {
                    $items[] =  [
                        "item_id" => $item->product_sku,
                        "item_name" => $item->product_name,
                        "affiliation" => $basket ? $basket->city ?? "" : '',
                        "coupon" => "",
                        "index" => $key,
                        "item_brand" => "Sweetiepie",
                        "item_category" => "Products",
                        "item_variant" => $item->variation,
                        "location_id" => "Toronto",
                        "price" => $item->price_amount,
                        "quantity" => $item->quantity // Corrected from $item->$key
                    ];
                }
        
                $purchaseData = [
                    "transaction_id" => $order->invoice_id,
                    "value" => $order->grandtotal ?? 0,
                    "tax" => $order->taxamount,
                    "shipping" => $order->shipping_charge,
                    "currency" => "CAD",
                    "coupon" => "",
                    "items" => $items // Removed the wrapping array []
                ];
        
            }
            else
            {
                $purchaseData = '';
            }
            
            return $purchaseData;
            
        }

    
    
    function showThanks($order_id=0) {
        
        $order = Order::find($order_id) or abort(404);
        $basket_id = $order->basket_id;
        
        $basket = Basket::with('items')->whereId($basket_id)->first();
            if($basket){
                //Google code
                $temptot = $order->grandtotal ?? 0;
                $ggtrans = 'pageTracker._addTrans(';
                $ggtrans .= '"'.$basket_id.'",';
                $ggtrans .= '"Sweetiepie",';
                $ggtrans .= '"'.$temptot.'",';
                $ggtrans .= '"'.$basket->taxamount.'",';                           
                $ggtrans .= '"'.$basket->shipping_charge.'",';
                $ggtrans .= '"Toronto",';
                $ggtrans .= '"Ontario",';
                $ggtrans .= '"Canada");';
                
                $ggitems = '';
        
                foreach($basket->items as $item)
                {   
                    $ggitems .= 'pageTracker._addItem(';
                    $ggitems .= '"'.$basket_id.'",';
                    $ggitems .= '"'.$item->product_sku.'",';
                    $ggitems .= '"'.$item->product_name.'",';
                    $ggitems .= '"'.$item->variation.'",';
                    $ggitems .= '"'.number_format($item->price_amount/100,2).'",1';
                    $ggitems .= ');'."\n";
                }
        
                $googlecode = $ggtrans . "\n\n" . $ggitems; 
            }
            else
            {
                $googlecode = '';
            }
        $invoice_id = $order->invoice_id;
        
        return view('frontend.thanks',compact('invoice_id','googlecode'));
        
    }
    
    
    public function storeAddress($data,$basket_id,$type){
        $address = $data;
        try{
            $save_add              = new Address();
            $save_add->order_id    = 0;
            $save_add->firstname   = $address->firstname;
            $save_add->lastname    = $address->lastname;
            $save_add->address     = $address->address;
            $save_add->postalcode  = $address->postalcode;
            $save_add->city        = $address->city; 
            $save_add->province    = $address->province;  
            $save_add->country     = 'CA';
            $save_add->phone       = auth()->check() ? auth()->user()->phone : $address->phone;
            $save_add->email       = auth()->check() ? auth()->user()->email : $address->email;
            $save_add->type        = $type;
            $save_add->user_id     = auth()->check() ? auth()->user()->id : 0;
            $save_add->basket_id   = $basket_id;
            $save_add->save();
            return 1;
        }
        catch(\Exception $e){
            // dd($e);
            return 0;
        }
    }
    
    public function userSignup($billing){
        $userCheck = User::where('email',$billing->email)->first();
        
        if(!$userCheck){
            $user               = new User();  
    		$user->email 		= $billing->email;
    		$user->firstname 	= $billing->firstname;
    		$user->lastname 	= $billing->lastname;
    		$user->name         = $billing->firstname. ' ' . $billing->lastname;
    		$user->address  	= $billing->address;
    		$user->postalcode 	= $billing->postalcode;
    		$user->city 	 	= $billing->city;
    		$user->province 	= $billing->province;
    		$user->country  	= 'canada';
    		$user->phone    	= $billing->phone;
    		$user->province 	= $billing->province;
    		$user->birthday 	= '';
    		$user->password     = Hash::make($billing->password);
    		$user->status 	 	= 1;
    		
    		try{
        		$user->save();
        		
        		$myadd              = new Myaddress();
        		$myadd->user_id	    = $user->id;
        		$myadd->firstname   = $user->firstname;
        		$myadd->lastname    = $user->lastname;
        		$myadd->address     = $user->address;
        		$myadd->postalcode  = $user->postalcode;
        		$myadd->city        = $user->city;
        		$myadd->province    = $user->province;
        		$myadd->country      = 'canada';
        		$myadd->base        = '1';
        		$myadd->save();
                
    		    try{
        	        Mail::to($user->email)->send(new SignupMail($user));
    		    }
    		    catch(\Exception $e){
    		        
    		    }
            
    		    return $user;
    		}
    		catch(\Exception $e){
    		 
    		}
    		
    		return false;
        }
        else
        {
            return false;
        }
    
    }
    function makePayment($paymeny_id,$grand_total,$basket, Request $request) 
    {
            $store_id='gwca049783';
            $api_token='HlZvxtFTjW1WOobrS9wj';
            
            if(env('SANDBOX_PAYMENT', false)){
                $store_id = 'store3'; //'monca06152';
                $api_token = 'yesguy'; //'CfYSX9fhTgM8v1vPXd8Q';
            }
            
    
            /*if(($request->has('cardtest') && $request->cardtest == 'yes') || $_SERVER['REMOTE_ADDR'] == '127.0.0.1')
            {
                $store_id='store5';
                $api_token='yesguy';
            }*/
            
            $exp_dates = explode('/',$request->expirationDate);
           
            $cvv = $request->securityCode;
            $expiry_year = $exp_dates[1]; 
            $expiry_month = sprintf("%02d", $exp_dates[0]); // Format the month as a two-digit number
            $date = $expiry_year . $expiry_month;
    
            $customername   = $request->nameOnCard;
            $type           = 'purchase';
            $cust_id        = $customername . ' | ' . $basket->email;
            $order_id       = $paymeny_id;
            $amount         = number_format($grand_total,2);
            $pan            = $request->cardNumber;
            $expiry_date    = $date;
            $crypt          = '7';
            $dynamic_descriptor='MySweetiePie Order';
            $status_check   = 'false';
    
            $txnArray=array('type'=>$type,
                            'order_id'=>$order_id,
                            'cust_id'=>$cust_id,
                            'amount'=>$amount,
                            'pan'=>$pan,
                            'expdate'=>$expiry_date,
                            'crypt_type'=>$crypt,
                            'dynamic_descriptor'=>$dynamic_descriptor
                           );
    
            $mpgTxn = new mpgTransaction($txnArray);
            $mpgRequest = new mpgRequest($mpgTxn);
            $mpgRequest->setProcCountryCode("CA");
    
            //if(($request->has('cardtest') && $request->cardtest == 'yes') || $_SERVER['REMOTE_ADDR'] == '127.0.0.1')
            if(env('SANDBOX_PAYMENT', false)){
                $mpgRequest->setTestMode(true);
            }
           // $mpgRequest->setTestMode(true);
            
    
            $mpgHttpPost  = new mpgHttpsPost($store_id,$api_token,$mpgRequest);
            $mpgResponse = $mpgHttpPost->getMpgResponse();
            
    
            return $mpgResponse;
     
    }
    // function makePayment($paymeny_id,$grand_total,$basket, Request $request) 
    // {
    //         $store_id='gwca049783';
    //         $api_token='HlZvxtFTjW1WOobrS9wj';
            
    //         $params = [
    //           'environment' => Moneris::ENV_LIVE, // default: Moneris::ENV_LIVE  ENV_TESTING
    //           'avs' => false, // default: false
    //           'cvd' => true, // default: false
    //           'cof' => false, // default: false
    //         ];
            
           
    //         /*if(($request->has('cardtest') && $request->cardtest == 'yes') || $_SERVER['REMOTE_ADDR'] == '127.0.0.1')
    //         {*/
    //             // $store_id='store5';
    //             // $api_token='yesguy';
    //         /*}*/
            
    //         $exp_dates = explode('/',$request->expirationDate);
           
    //         $cvv = $request->securityCode;
    //         $expiry_year = $exp_dates[1]; 
    //         $expiry_month = sprintf("%02d", $exp_dates[0]); // Format the month as a two-digit number
    //         $date = $expiry_year . $expiry_month;
    
    //         $customername   = $request->nameOnCard;
    //         $type           = 'purchase';
    //         $cust_id        = $customername . ' | ' . $basket->email;
    //         $order_id       = $paymeny_id;
    //         $amount         = number_format($grand_total,2);
    //         $pan            = $request->cardNumber;
    //         $expiry_date    = $date;
    //         $crypt          = '7';
    //         $dynamic_descriptor='MySweetiePie Order';
    //         $status_check   = 'false';
    
    //         // $txnArray=array(
    //         //                 'type'=> $type,
    //         //                 'order_id'=>$order_id,
    //         //                 'cust_id'=>$cust_id,
    //         //                 'amount'=>$amount, 
    //         //                 'pan'=>$pan,
    //         //                 'expdate'=>$expiry_date,
    //         //                 'crypt_type'=>$crypt,
    //         //                 'dynamic_descriptor'=>$dynamic_descriptor
    //         //               );
              
        
           

    //             $gateway = Moneris::create($store_id, $api_token, $params);            
       
    //             // $response = $gateway->purchase($params);


    //             $tnxvalues = [
    //                         'cvd' => $cvv,
    //                         'order_id'=>$order_id,
    //                         'amount'=>$amount, 
    //                         'credit_card'=>$pan,
    //                         'expiry_monthp'=>$expiry_month,
    //                         'expdate'=>'20'.$expiry_month,
    //                         'expiry_year'=>$expiry_year,
    //                     ];
    //             $response = $gateway->verify($tnxvalues);
           
    //             if($response->successful){
    //                  $response = $gateway->purchase($tnxvalues);
                     
    //             }
                
    //             return $response;
                

    //         // $mpgTxn = new mpgTransaction($txnArray);
    //         // $mpgRequest = new mpgRequest($mpgTxn);
    //         // $mpgRequest->setProcCountryCode("CA");
    
    //         //if(($request->has('cardtest') && $request->cardtest == 'yes') || $_SERVER['REMOTE_ADDR'] == '127.0.0.1')
                
    //       // $mpgRequest->setTestMode(true);
            
    
    //         // $mpgHttpPost  = new mpgHttpsPost($store_id,$api_token,$mpgRequest);
    //         // $mpgResponse = $mpgHttpPost->getMpgResponse();
            
    
    //         // return $mpgResponse;
     
    // }
    
    function invoiceNumberGenerate(){
        $ordercount = Order::where('created_at','>=',date('Y-m-d 00:00:00'))->where('created_at','<=',date('Y-m-d 23:59:59'))->count();
        return 'SPB'.date('ymd').sprintf('%04d', $ordercount+1);
    }
    
    //push api to tng
    
    public function sendData()
    {
        $this->SendDataTrait();
        
    }
    
    public function CheckOutCalculation(){
        
        $session_string = session('session_string');;
        $basket = Basket::where('session',$session_string)->where('status',0)->first() ?? abort(404); 
        $calculations  = $this->GrandTotalCalculation($basket);
        return view('frontend.checkout-calculation',compact('calculations','basket'))->render();
    }
    
    
    function GrandTotalCalculation($basket){
        $Calculation = getGrandCalculation($basket);
            
        return json_encode($Calculation);
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function pickupTime(Request $request){
        if (session()->has('session_string')) {
            $session_string = session('session_string');
            $basket = Basket::where('session', $session_string)->where('status', 0)->firstOrFail();
        } else {
            abort(404);
        }
        
        $options ="";
        
        $shipping = Shipping::where('order_type', 'pickup')->firstOrFail();
        $store = Store::with('store_timing', 'holidaytiming', 'holidaytiming.holiday')->findOrFail($basket->pickup_id);
        $preparetime = $shipping->preperation_time ? $shipping->preperation_time : env('PREPARATION_TIME');
        
        $currentDate = Carbon::parse($request->Pickupdate);
        $isToday = $currentDate->isToday();
    
        $store_workingday = $store->store_timing->where('day', $currentDate->format('w'))->first();
        
          
        if ($store_workingday) {
            $availableTime_on = strtotime($store_workingday->open) + $preparetime * 3600;
            $availableTime_to = strtotime($store_workingday->close) - $preparetime * 3600;
        
            if ($isToday) {
                // Check if the date is today and adjust available times if necessary.
                $currentTime = time();
                $availableTime_on = $currentTime > $availableTime_on ? ($currentTime + ($preparetime * 3600)) : ($availableTime_on + ($preparetime * 3600));
            }
        
            $startTime = $availableTime_on;
            $endTime = $availableTime_to;
            $interval = 15 * 60; // 15 minutes in seconds
        if($startTime <= $endTime ){
            for ($time = $startTime; $time <= $endTime; $time += $interval) {
                $formattedTime = date('h:i a', $time);
                $storedTime = date('H:i', $time);
                $selected = $storedTime === $basket->serve_time ? 'selected' : '';
        
                $options .="<option value=\"$storedTime\" $selected>$formattedTime</option>";
            }
        }
        else{
            $options .='<option value="">Time Closed</option>';

        }
        
        } else {
            // Handle the case when there are no working hours available for the selected day.
            $options .='<option value="">No working hours available for this day.</option>';
        }

        
        return $options;
    }

    
    function sendOrderConfirmation($order_invoice_id) {
        
        // $sendto = env('MAIL_TO_COPY');
        $sendto = "developer@indigitalgroup.ca";
        $order_details = Order::with('basket','orderItems','address')->where('invoice_id',$order_invoice_id)->first();
        
        if(!$order_details)
            die('Unable to find the order!');

        
        if($billing = $order_details->address->where('type','billing')->first())
            // $to = $billing->email;
            $to = 'shefii.indigital@gmail.com';
        else
            die("Order doesn't have an email address");
        
        try {
            Mail::to($to)->bcc($sendto)->send(new OrderInvoiceMail($order_details));
            Mail::to($to)->bcc($sendto)->send(new OrderNotification($order_details));
            
        }
        catch(\Exception $e) {
            
        }
        
        return view('emails.order-invoice',compact('order_details'));
        exit;

    }
    
    
    function identifyCreditCard($cardNumber) {
        $cardTypes = array(
            'visa_card'              => '/^4[0-9]{12}(?:[0-9]{3})?$/',
            'master_card'        => '/^5[1-5][0-9]{14}$/',
            'american_expres'  => '/^3[47][0-9]{13}$/',
            'discover_card'          => '/^6(?:011|5[0-9]{2})[0-9]{12}$/',
        );
    
        foreach ($cardTypes as $type => $pattern) {
            if (preg_match($pattern, $cardNumber)) {
                return $type;
            }
        }
    
        return null;
    }
        
        
    function CartRefresh(){
        if (session()->has('session_string')) {
            $session_string = session('session_string');
            $basket = Basket::where('session',$session_string)->where('status',0)->first();
            if($basket){
                $items = Item::where('basket_id',$basket->id)->get();
                if($items){
                    foreach($items as $listing){
                        if($listing->product_variation){
                            if($listing->has_special_price == 1){
                                $checkSpecialPrice    = $listing->product->has_special_price == 1 && $listing->product->special_price_from <= date('Y-m-d') && $listing->product->special_price_to >= date('Y-m-d');   
                                if(!$checkSpecialPrice && $listing->product->has_special_price == 1)
                                {
                                    Item::where('id',$listing->id)->update(['has_special_price' => 0,'price_amount' => $listing->product->price,'special_price_from' => null,'special_price_to' =>null]);
                                }
                            }
                        }
                        else{
                           Item::where('id',$listing->id)->delete(); 
                        }
                        
                    }
                }
            }
        }
    }


}
