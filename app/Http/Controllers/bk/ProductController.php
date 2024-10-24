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
use URL;

class ProductController extends Controller
{
    //
        public function products_list(){
            
        }
        
        public function category(Request $request,$slug = NULL){
            
            $categories = Category::get();
            
            $items = array();
            
            $session_string = $request->cookie('session_string');

            $basket = Basket::where('session',$session_string)->where('status',0)->first();
        
            if($basket){
                $items = Item::where('basket_id',$basket->id)->get();
            }
            
            if($slug != NULL){
                
                $category = Category::whereSlug($slug)->first() ?? abort(404);
                // with('children')where('parent_id','<>',null)
        
          
                
                $products =    Product::with('category_products','product_variation','images','shipping_method')
                                            ->whereHas('category_products',function($query) use($category) {
                    							$query->where('category_id',$category->master_id);
                    						})
                    						->whereHas('product_variation',function($query) {
                                                $query->where('sku','<>','');
                    						})
                    						->where('availability','<>','in-store')->get();
                    						
                return view('frontend.category',compact('products','category','categories','items'));
            }
            elseif($request->has('filter') && $request->filter != '')
            {
            
                $val = $request->filter;
                $multi_category = explode(',',$val);
                $category_ids   = Category::whereIn('slug',$multi_category)->pluck('master_id');
                
                $products   =   Product::with('category_products','product_variation','images','shipping_method')
                                        ->whereHas('category_products',function($query) use($category_ids) {
                							$query->wherein('category_id',$category_ids);
                						})
                						->whereHas('product_variation',function($query) {
                                            $query->where('sku','<>','');
                						})
                						->where('availability','<>','in-store')->get();
             
                return view('frontend.category',compact('products','categories','items'));
            }
            else
            {
                $products =    Product::with('category_products','product_variation','images','shipping_method')
                    						->whereHas('product_variation',function($query) {
                                                $query->where('sku','<>','');
                    						})
                    						->where('availability','<>','in-store')->get();
                return view('frontend.category',compact('products','categories','items'));
            }
                					
        }
        
        public function product_single($slug,Request $request){
            
            if($request->pid==null){
              
                // $products = Product::with('category_products','product_variation','images','shipping_method')
                //                         ->whereHas('product_variation',function($query) {
                //                             $query->where('sku','<>','');
                // 						 })
                // 						->where('slug',$slug)
                // 						->where('availability','<>','in-store')->first() ?? abort(404);
                
                $products = ProductVariation::leftJoin('products','products.id','product_variations.product_id')
                                ->where('products.slug',$slug)
                				->where('products.availability','<>','in-store')
                				->where('sku','<>','')
                				->select('product_variations.*')
                				->first() ?? abort(404);						
                						
                $prv_url = URL::current();
                                  
                return redirect($prv_url.'?pid='.$products->id);
            }
            else
            {  
                $pid = $request->pid;
           
                $products =    Product::with('category_products','product_variation','images','shipping_method','option')
                						 ->whereHas('product_variation',function($query) use($pid) {
                							$query->where('id',$pid);
                							$query->where('sku','<>','');
                						 })
                						->where('availability','<>','in-store')->first() ?? abort(404);
                $vari_key = VariationKey::where('variation_id',$pid)->get();
            }
            
       
            $related_products =    Product::with('category_products','product_variation','images','shipping_method')
                                        ->whereHas('product_variation',function($query) {
                                            $query->where('sku','<>','');
                						 })
                						->where('availability','<>','in-store')->get();
            
            $related_products = $related_products->random(4);
            
            return view('frontend.single-product',compact('products','related_products','vari_key'));
        }
        
        
        public function get_product_variation(Request $request){
           
            $product_id =   Product::where('products.slug',$request->product)->pluck('id')->first();
           
                    						
             $vari_ids =    VariationKey::with('product_variation')
                                        ->whereHas('product_variation',function($query){
                                            $query->where('sku','<>','');$query->where('sku','<>',NULL);
                 						}) 
                                        ->where('product_id',$product_id)
                						->where('type',$request->type)
                                        ->where('value',$request->value)
                                        ->pluck('variation_id');
            
            $result = "";
            
            $products_option = Option::where('product_id',$product_id)->get();
          
            if(count($products_option)>0){
                $options= $products_option->unique('name');

                foreach($options as $optn){
                   
                     if($optn->name == 'color' && $request->type == 'size'){
                       
                        foreach($products_option->where('name','color') as $key2=> $color_items){
                            
                                if(VariationKey::whereIn('variation_id', $vari_ids)->where('type','color')->where('value',$color_items->value)->exists()){
                                    $result .=  '<li><input data-type="'.$color_items->name.'"
                                    data-replace="';
                                    if($options->contains('name', 'type')){
                                      $result .=  'option_type_ul';
                                    }
                                    $result .= '" data-value="'.$color_items->value.'" class="option_select_color" value="'.$color_items->value.'"  type="radio" name="variation_color" id="cb5'.$key2.'" />
                                        <label for="cb5'.$key2.'">
                                            <img src="'.asset('assets/images/baked.webp').'" />
                                            <p style="margin: 0; text-align: center;">'.$color_items->value.'</p>
                                        </label>
                                    </li>';
                                }
                                else{
                                   $result .=  '<li>
                                                 <label for="cb3" style="cursor:not-allowed"><img src="'.asset('assets/images/soldout.png').'" />
                                                     <p style="margin: 0; text-align: center;">'.$color_items->value.'</p>
                                                 </label>
                                                </li>';
                                                
                                    
                                }  
                        
                          }
                                            
                        break;
                    }          
                    elseif($optn->name == 'type' && ($request->type == 'color' || $request->type == 'size')){
                
                        foreach($products_option->where('name','type') as $key2=> $type_items){
                            
                                if(VariationKey::whereIn('variation_id', $vari_ids)->where('type','type')->where('value',$type_items->value)->exists()){
                                    $result .=  '<li><input data-type="'.$type_items->name.'"
                                    data-replace="';
                                    if($options->contains('name', 'type')){
                                      $result .=  'option_type_ul';
                                    }
                                    $result .= '" data-value="'.$type_items->value.'" class="option_select_type" value="'.$type_items->value.'"  type="radio" name="variation_type" id="cb5'.$key2.'" />
                                        <label for="cb5'.$key2.'">
                                            <img src="'.asset('assets/images/baked.webp').'" />
                                            <p style="margin: 0; text-align: center;">'.$type_items->value.'</p>
                                        </label>
                                    </li>';
                                }
                                else{
                                   $result .=  '<li>
                                                 <label for="cb3" style="cursor:not-allowed"><img src="'.asset('assets/images/soldout.png').'" />
                                                     <p style="margin: 0; text-align: center;">'.$type_items->value.'</p>
                                                 </label>
                                                </li>';
                                                
                                    
                                }  
                        
                          }
                                            
                        break;
                        
                    }
                }
            }   						
        
            return $result;        						
        }
        
        public function variation_id_get(Request $request){
            $product_id =   Product::where('products.slug',$request->slug)->pluck('id')->first();
         
            $vari_id_size = array();
            
                $vari_ids = VariationKey::with('product_variation')
                                        ->whereHas('product_variation',function($query){
                                            $query->where('sku','<>','');$query->where('sku','<>',NULL);
                 						})
                                        ->where('product_id',$product_id)->get();  
                            
                if(($request->size != 'undefined')){
                   $vari_id_size = $vari_ids->where('value',$request->size)->pluck('variation_id');
                   if(($request->color == 'undefined') && ($request->type == 'undefined')){
                            $variation_data = VariationKey::with('product_variation')
                                            ->whereHas('product_variation',function($query){
                                                $query->where('sku','<>','');$query->where('sku','<>',NULL);
                     						})
                                            ->where('product_id',$product_id)->where('value',$request->color)
                                            ->whereIn('variation_id',$vari_id_size)->first(); 
                   }
                }
                
                
                
                
                if(($request->color != 'undefined')){
                  
                    if($vari_id_size){
                        if(($request->type == 'undefined')){
                            $variation_data = VariationKey::with('product_variation')
                                            ->whereHas('product_variation',function($query){
                                                $query->where('sku','<>','');$query->where('sku','<>',NULL);
                     						})
                                            ->where('product_id',$product_id)->where('value',$request->color)
                                            ->whereIn('variation_id',$vari_id_size)->first(); 
                        }
                    }
                    else
                    {
                            $vari_ids__color = $vari_ids->where('value',$request->color)->pluck('variation_id');
                            if(($request->type == 'undefined')){
                                 $variation_data = VariationKey::with('product_variation')
                                            ->whereHas('product_variation',function($query){
                                                $query->where('sku','<>','');$query->where('sku','<>',NULL);
                     						})
                                            ->where('product_id',$product_id)->where('value',$request->color)
                                            ->whereIn('variation_id',$vari_ids__color)->fisrt(); 
                            }
                    }
                }
                
                 if(($request->type != 'undefined')){
                    if($vari_id_size){
                            $variation_data = VariationKey::with('product_variation')
                                            ->whereHas('product_variation',function($query){
                                                $query->where('sku','<>','');$query->where('sku','<>',NULL);
                     						})
                                            ->where('product_id',$product_id)->where('value',$request->type)
                                            ->whereIn('variation_id',$vari_id_size)->first(); 
                        
                        
                    }
                    else
                    {
                            $vari_ids__color = $vari_ids->where('value',$request->color)->pluck('variation_id');
                         
                                 $variation_data = VariationKey::with('product_variation')
                                            ->whereHas('product_variation',function($query){
                                                $query->where('sku','<>','');$query->where('sku','<>',NULL);
                     						})
                                            ->where('product_id',$product_id)->where('value',$request->type)
                                            ->whereIn('variation_id',$vari_ids__color)->first(); 
                            
                    }
                }
                
                $vari_collection = array();
                if($variation_data){
                    $vari_collection['price'] = $variation_data->product_variation[0]->price;
                    $vari_collection['pdct_id'] = $variation_data->product_variation[0]->id;
                }
            return  response()->json($vari_collection);

        }
        
        
        
     
        
        
}
