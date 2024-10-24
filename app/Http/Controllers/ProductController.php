<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariation;
use App\Models\ProductShipping;
use App\Models\VariationKey;
use App\Models\Option;
use App\Models\Basket;
use App\Models\Item;
use App\Models\City;
use App\Models\Store;
use App\Models\MenuCategory;
use App\Models\MenucategoryProducts;
use App\Models\SuggestedProduct;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;


use App\Models\Specialization;
use URL;

class ProductController extends Controller
{
    //all category menu loading
        public function category(Request $request,$slug = NULL){
            
        $title = "Menu";

             $base64Data = $request->query('redirect_to');
    
            if ($base64Data) {
                
                $data = unserialize(base64_decode(request()->redirect_to));
            
                   if(isset($data['billing']['email']) && isset($data['billing']['firstname']) && isset($data['billing']['lastname']) && isset($data['billing']['phone'])) {   
                       
                        session(['billing_firstname'=> $data['billing']['firstname'] ?? '','billing_lastname' => $data['billing']['lastname'] ?? '',
                                 'billing_address'  => $data['billing']['address'] ?? '','billing_postalcode' => $data['billing']['postalcode'] ?? '',
                                 'billing_city'     => $data['billing']['city'] ?? '','billing_province'      => $data['billing']['province'] ?? '',
                                 'billing_country'  => $data['billing']['country'] ?? '','billing_phone'      => $data['billing']['phone'] ?? '',
                                 'billing_email'    => $data['billing']['email'] ?? '','billing_type'         => $data['billing']['type'] ?? '']);
                                 
                       
                   }
                   
                   if(isset($data['shipping']['email']) && isset($data['shipping']['firstname']) && isset($data['shipping']['lastname']) && isset($data['shipping']['phone'])) {   
                       
                        session(['shipping_firstname'=> $data['shipping']['firstname'] ?? '','shipping_lastname' => $data['shipping']['lastname'] ?? '',
                                 'shipping_address'  => $data['shipping']['address'] ?? '','shipping_postalcode' => $data['shipping']['postalcode'] ?? '',
                                 'shipping_city'     => $data['shipping']['city'] ?? '','shipping_province'      => $data['shipping']['province'] ?? '',
                                 'shipping_country'  => $data['shipping']['country'] ?? '','shipping_phone'      => $data['shipping']['phone'] ?? '',
                                 'shipping_email'    => $data['shipping']['email'] ?? '','shipping_type'         => $data['shipping']['type'] ?? '']);
                                 
                   }
                   
                    
                   
                   
                   
                   if(isset($data['serve']['serve_date'])){
                      
                            $randomString = Str::random(45);
                            session([  'delivery_store_id'=> $data['serve']['store_id'] ?? '',
                                        'delivery_serve_date' => $data['serve']['serve_date'] ?? '',
                                        'delivery_serve_time'  => $data['serve']['serve_time'] ?? '',
                                        'ordertype'  => $data['serve']['ordertype'] ?? '',
                                        'session_string' => $randomString
                                        ]);
                                       
                            if($data['serve']['ordertype'] == 'pickup'){ 
                            $store = Store::where('id',$data['serve']['store_id'])->first();
                                if($store){
                                    session(['identity_place'   => $store->name,
                                            'pickup_id'         => $store->id,
                                            'postalcode'        => $store->postal,
                                            'city'              => $store->city,
                                            'shipping_location' => $store->address]);  
                                }
                            }
                            else{
                                session(['identity_place'=> $data['serve']['city'] ?? '',
                                        'postalcode'     => $data['serve']['postalcode'] ?? '',
                                        'city'           => $data['serve']['city'] ?? '',
                                        'shipping_location' =>$data['serve']['shipping_location'] ?? '']);  
                                }
                    }
                   
                    if (session()->has('session_string')) {
                        $session_string = session('session_string');
                        $basket = Basket::where('session',$session_string)->where('status',0)->first();
                        if($basket){
                            Item::where('basket_id',$basket->id)->delete();
                            $basket->pickup_id   = session('pickup_id') ?? '';
                            $basket->order_type  =session('ordertype') ?? 'pickup';
                            $basket->email  = session('billing_email') ?? ''; 
                        }
                    }
                   
    
            }
    
        
            $categories = MenuCategory::with('product_list','product_list.product_single')->orderBy('display_order')->where('status',1)->get();
            return view('frontend.category',compact('categories','title'));
        }
    
    //catgeory menu single listing
        public function category_single(Request $request,$slug = NULL){
            

            //filter section data
            $categories = MenuCategory::where('slug',$slug)->first() ?? abort(404);
        $title = $categories->name;
           
            $type_list = MenucategoryProducts::where('category_id', $categories->id)
                        ->leftJoin('products', 'products.master_id', 'menucategory_products.product_id')
                        ->leftJoin('variation_keys', 'variation_keys.product_id', 'products.id')
                        ->leftJoin('product_variations', 'product_variations.product_id', 'products.id')
                        ->where('product_variations.sku', '<>', '')
                        ->where('variation_keys.type', 'type')->get();
                        
            $type_list = $type_list->map(function ($item) {
                $item->value = ucfirst($item->value);
                return $item;
            });
                  
                        
            $size_list = MenucategoryProducts::where('category_id', $categories->id)->select(DB::raw('CAST(value AS UNSIGNED) AS new_value'))
                        ->leftJoin('products', 'products.master_id', 'menucategory_products.product_id')
                        ->leftJoin('variation_keys', 'variation_keys.product_id', 'products.id')
                        ->leftJoin('product_variations', 'product_variations.product_id', 'products.id')
                        ->where('product_variations.sku', '<>', '')
                        ->where('variation_keys.type', 'size')->groupBy('new_value')->get();
                  
            $size_list = $size_list->map(function ($item) {
                $item->new_value = ucfirst($item->new_value);
                return $item;
            });
                 
            $specialization_list = MenucategoryProducts::where('category_id', $categories->id)
                                    ->leftJoin('products', 'products.master_id', 'menucategory_products.product_id')
                                    ->leftJoin('product_specializations', 'product_specializations.product_id', 'products.id')
                                    ->leftJoin('product_variations', 'product_variations.product_id', 'products.id')
                                    ->leftJoin('specializations', 'specializations.id', 'product_specializations.specialization_id')
                                    ->where('product_variations.sku', '<>', '')
                                    ->where('product_specializations.specialization_id','<>','')
                                    ->select('specializations.*')
                                    ->get();
                                    
            //end
            
            //basket items retrieve
            
            
            $this->CartRefresh();
            
            $items = array();
            $session_string = session('session_string');
            $basket = Basket::where('session',$session_string)->where('status',0)->first();
            if($basket){
                $items = Item::where('basket_id',$basket->id)->get();
            }
            
            // regular product depend on menu cateory based 
            $products =    Product::with('menucategory_products','category_products','product_variation','images','product_city','variationList','specializations','thumbImages')
                						->whereHas('product_variation',function($query) {
                                            $query->where('sku','<>','');
                						})
                						->whereHas('menucategory_products',function($query) use($categories) {
                							$query->where('category_id',$categories->id);
                						})
                						->where('regular','1')
                						->where('online','1');
                				
                						
            // data check filter condition based 
            if($request->has('type') && $request->type != '')
            {
                $type = explode(',',$request->type);
                $products = $products->whereHas('variationList',function($query) use($type) {
                                            $query->where('type','type');
                                            $query->whereIn('value',$type);
                                            });
            }
            if($request->has('size') && $request->size != '')
            {
                $size = explode(',',$request->size);
                $products = $products->whereHas('variationList',function($query) use($size) {
                                            $query->where('type','size');
                                            // $query->whereIn('value',$size);
                                            $query->whereIn(DB::raw("CAST(value AS DECIMAL(10, 2))"), $size);
                                            });
            }
            if($request->has('specialization') && $request->specialization != '')
            {
                $spec                   = $request->specialization;
                $specialization         = explode(',',$spec);
                $specialization_ids     = Specialization::whereIn('slug',$specialization)->pluck('id');
                $products               = $products->whereHas('specializations',function($query) use($specialization_ids) {
                                            $query->whereIn('specialization_id',$specialization_ids);
                                            });
            }
            //End
  	
            //check select order_type based method allowed city products
            if($basket){		
                if($basket->order_type == 'pickup'){
                    $order_type_not = 'delivery';
                }
                else
                {
                    $order_type_not = 'pickup';
                    $city_id = City::whereName($basket->city)->pluck('master_id')->first();
                   
                    $products = $products->whereHas('product_city',function($query) use($city_id) {
                                        $query->where('city_id',$city_id);});
                }
                
                $products = $products->where('product_type','<>',$order_type_not);
            }
             
            //End
                  $now = now();
                $products = $products->where(function($e) use ($now){
                    $e->where(function ($query) use ($now) {
                                        $query->where('seasonal_availability', 1) // Check if seasonal_availability is 1
                                            ->where('seasonal_show_start', '<=', $now)
                                            ->where('seasonal_show_end', '>=', $now);
                                    })
                                    ->orWhere('seasonal_availability', '!=', 1);
                })->get();
          
                return view('frontend.product-listing',compact('products','categories','items','specialization_list','type_list','size_list','title'));				
        }
        
        public function gift_cards(Request $request){
            $items = array();
            $session_string = session('session_string');
            $basket = Basket::where('session',$session_string)->where('status',0)->first();
        
            if($basket){
                $items = Item::where('basket_id',$basket->id)->get();
            }
  
            $products =     Product::with('category_products','product_variation','images','product_city')
                						->whereHas('product_variation',function($query) {
                                            $query->where('sku','<>','');
                						})
                						->where('gift_card','1')
                						->where('online','1')
                						->OrderBy('display_order');
            
            $products = $products->get();
            return view('frontend.gift',compact('products','items'));					
        }
        
        public function product_single($slug,Request $request){
            
            $products = Product::with('product_variation','product_variation.variationkey','variationList')->where('slug',$slug)->first() ?? abort(404);
        
                						
            $session_string = session('session_string');						
            $basket_items = Basket::where('session',$session_string)->where('status',0)->first();

            if($basket_items){		
                if($basket_items->order_type == 'pickup'){
                    $order_type_not = 'delivery';
                }
                else
                {
                    $order_type_not = 'pickup'; 
                    $city_id = City::whereName($basket_items->city)->pluck('master_id')->first();
                    
                }
                
            }  
           						
                	
                	
            $suggested_products = SuggestedProduct::with('products','products.thumbImages')->where('suggested_products.product_id',$products->id)
                                                    ->orderBy('suggested_products.id','asc')
                                                    ->get();


            $this->CartRefresh();
            
            $items = array();
            if($basket_items){
                $items = Item::where('basket_id',$basket_items->id)->get();
            }
            
            
            
             $items_val = [];
            foreach ($products->product_variation as $key => $item) {
                $items_val[] =  [
                    "item_id" => $item->sku,
                    "item_name" => $products->name,
                    "affiliation" =>  $basket_items ? $basket_items->city ?? "" : '',
                    "index" => $key,
                    "item_brand" => "Sweetiepie",
                    "item_category" => "Products",
                    "item_variant" => $item->variation_name,
                    "location_id" => "Toronto",
                    "price" => $item->price,
                    "quantity" => 1 
                ];
            }
      
            $ViewData = [
                            "currency" => "CAD",
                            "value" => $products->product_variation->pluck('price')->first(),
                            "items" =>  $items_val
                        ];
    
            return view('frontend.single-product',compact('products','suggested_products','basket_items','items','ViewData'));
        }
        
        public function nutrition_product_single($slug,Request $request){
            
            $products = Product::with('product_variation','product_variation.variationkey','variationList')->where('slug',$slug)->first() ?? abort(404);
                	
            return $request->ajax() ? response()->json([
                'success' => true,
                'html' => view('frontend.single-product-nutrition-contents',compact('products'))->render(),
            ]) : view('frontend.single-product-nutrition',compact('products'));
        }
        
        
        public function check_available_city(Request $request){
            $city = $request->city;
            $city_details = City::where('name',$city)->where('status',1)->first();
            
            // $availableCities = ['Scarborough', 'Toronto', 'Etobicoke', 'North York', 'East York', 'Mississauga', 'Vaughan', 'Woodbridge'];
            
            // if (in_array($city, $availableCities)) {
            if($city_details){
                return 1;
            }else{
                return 0;
            }
            
        }
        
        public function showDetails($id) {
            $product = Product::with(['images','product_variation'=>function($q){
                    $q->orderBy('id','ASC');
                },'product_variation.variation_images'=>function($q){
                    $q->with('images_list');
                }])->where('slug',$id)->first();
                
            // dd($product->variation_images);
            
            $options = [];
            
            $variationkeys = VariationKey::with(['product_variation'])->where('product_id',$product->id)->orderBy('type','ASC')->orderBy('id','ASC')->get();

            foreach($variationkeys as $index=>$row) {
                if(!isset([$row->type][$row->value])) {
                    foreach($row->product_variation as $pv) {
                        $options[$row->type][$row->value][] = $pv->id;
                    }
                }
            }
            
            $vari_images= ProductVariation::leftJoin('variation_images','variation_images.variation_id','product_variations.id')
                                            ->leftJoin('product_images','product_images.id','variation_images.picture_id')
                                            ->where('product_variations.product_id',$product->id)
                                            ->select('product_images.type','variation_images.variation_id','variation_images.id','product_images.picture')
                                            ->get();
        
            
            $variation_images =  $vari_images->groupBy('variation_id');
                  
            // return view('frontend.product-detail',compact('options','product','variation_images'));
            return view('frontend.sample-product',compact('options','product','variation_images'));
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
