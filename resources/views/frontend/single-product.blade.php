@extends('layouts.frontend')
@section('styles')
    <style>
        .product-detail.d-block.d-md-none p{
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            line-clamp: 1;
            -webkit-box-orient: vertical;
        }
        .read-more-link,
        .show-less-link {
            cursor: pointer;
            color: blue;
        }
        
   .page_product-listing .position-absolute{
          bottom: 20px;
      }
      .page_product-listing .position-absolute a{
          background: var(--primary);
          border-color: var(--primary);
      }
      @media(max-width: 767px){
          .page_product-listing .position-absolute{
              left: 10px;
              position: relative !important;
              bottom: 5px!important;
          }
      }
      
      .product-detail table{
          border : 1px solid #DDD !important;
      }
      
      .product-detail td{
          border : 1px solid #DDD !important;
      }
     
    </style>
@endsection
@section('contents')
    @php
        $totalAmount = 0;
    @endphp
    
    @if(isset($items) && count($items) > 0)
        @php
            $hasPreOrderProduct = $items->first(function ($item, $key) {
                return $item['pre_order'] === 1;
            });
            
            $hasProductItems =  $items->filter(function ($item, $key) {
                                        return $item['pre_order'] === 1;
                                });
                                
            $cartDate_range = [];
            $temp_array = [];
            $CartItemCount = 0;
        @endphp
  
        @foreach($hasProductItems as $key=> $liting)
            @php 
                $cartItemDate_range = [];
                $current_date = $liting->product->seasonal_date_start;
                while ($current_date <= $liting->product->seasonal_date_end) {
                    if($CartItemCount == 0){
                        $temp_array[] = $current_date;
                    }
                    $cartItemDate_range[] = $current_date;
                    $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
                }
                
                $CartCommonRange = array_intersect($temp_array, $cartItemDate_range);
                $temp_array = $CartCommonRange;
                $CartItemCount = $CartItemCount+1;
            @endphp
        @endforeach

        @php 
                $cartDate_range =  $temp_array;
                $itemDaterange = [];
                $current_date_item = $products->seasonal_date_start;
                while ($current_date_item <= $products->seasonal_date_end) {
                    $itemDaterange[] = $current_date_item;
                    $current_date_item = date('Y-m-d', strtotime($current_date_item . ' +1 day'));
                }
                $commonValue = array_intersect($cartDate_range, $itemDaterange);
                sort($commonValue);
                $product_startDate =  reset($commonValue);
                $product_endDate   = end($commonValue);
        @endphp
        
    @endif
    
     
    
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 position-relative page_product-listing">
                    <h1 >{!!titleTextSingle($products->name)!!}</h1>
                      <div class="position-absolute">
                        <a href="{{url('menu')}}" class="btn btn-dark btn-sm text-light"><i class="bi bi-arrow-left"></i> Back to Menu</a>
                      </div>
                </div>
               
            </div>
        </div>
    </section>
    
    <section class="product-detail-slider position-relative product-listing page_section">
        <div class="container">
            <div class="row">
                <!-- card left -->
    
                <div class="col-12 col-md-6 position-relative productImageStick">
                    @php
                        $images = product_images($products->id);
                    @endphp
                    @foreach($images as $key => $variaion_slider)
                        <div class="for-sticky-p-s prdct_img"  data-category="{{$key}}">
                            <div class="slider-for"> 
                                <!--  img-showcase -->  @php $x = 0; @endphp 
                               @foreach($variaion_slider as $vari_images)
                                <div>
                                    <img class="w-100 h-auto cursor-pointer " src="{{asset('images/products/'.$vari_images)}}" onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';" alt="{{$products->name}}">
                                </div>
                               @endforeach
                            </div>
                            <div class="slider-nav ">
                                  <!--  img-showcase --> @php $x = 0; @endphp   
                                   @foreach($variaion_slider as $vari_images)
                                    <div >
                                        <img class="w-100 h-auto cursor-pointer " src="{{asset('images/products/'.$vari_images)}}" onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';" alt="{{$products->name}}">
                                    </div>
                                   @endforeach
                            </div>
                        </div>
                    @endforeach
                    
                </div>
    
                <!-- card right -->
                <div class="col-12 col-md-6 p-d-bg">
                    <div class="product-content" >
                <!--////////////////////////////////////Product Name/////////////////////////////////////////-->  
                       
                        <h2 class="product-title">{!! titleText($products->name) !!}</h2>
                        @php
                            $pdct_details = $products->product_variation->where('product_id',$products->id)->first();
                            $orginalPrice = max_price($products->id);
                           
                            $checkSpecialPrice = $products->has_special_price == 1 && $products->special_price_from <= date('Y-m-d') && $products->special_price_to >= date('Y-m-d');
                            
                            
                            if($checkSpecialPrice){
                                $spPrice = max_price_special($products->id);              
                                if($products->discount_type == 'percentage')
                                {
                                
                                    $discountPercentage = (($orginalPrice - $spPrice) / $orginalPrice * 100);
                                    $roundedPercentage = number_format($discountPercentage, 1);
                                    $firstDecimal = substr($roundedPercentage, -1, 1);
                                    
                                    if ($firstDecimal > 0) {
                                        $discountType = getPrice($orginalPrice - $spPrice) . " OFF";
                                    } else {
                                        $discountType = intval($roundedPercentage) . '% OFF';
                                    }
                                                                
                                }
                                else{
                                    $discountType = getPrice($orginalPrice - $spPrice)." OFF";
                                }
                                
                                
                                $PriceVal =  getPrice($spPrice) .'<small class="text-body-tertiary h3"> (<strike>'.getPrice($orginalPrice).'</strike>) <span class="text-danger">'.$discountType.'</span></small>';
                                $has_special_price = 1;
                            }
                            else{
                                $PriceVal = getPrice($orginalPrice);
                                $has_special_price = 0;
                                $discountType = '';
                                
                            }
                        @endphp
                            

                <!--////////////////////////////////////Product Price/////////////////////////////////////////-->  
                        @auth
                        <div class="product-price">
                            <h4 class="new-price"><span id="product_price">{!! $PriceVal !!}</span></h4>
                        </div>
                        @endauth
                        <!--////////////////////////////////////Product description/////////////////////////////////////////-->                  
                        @if($products->description != '' || $products->has_customization)
                        <div class="product-detail d-none d-md-block" > 
                            {!! $products->description !!}
                        </div>
                        <div class="product-detail d-block d-md-none " > 
                            {!! $products->description !!}
                             <a class="read-more-link">Read More</a>
                             <a class="show-less-link" style="display: none;">Show Less</a>
                        </div>
                        
                                                            
                        @endif
    
                <!--//////////////////////////////////// Product Type check Online/Instore/Both /////////////////////////////////////////--> 
                    @auth
                        @if($products->mark_stock_status == 0)
                            @if(session()->has('ordertype'))
                                @if( $products->product_type == 'both' || $products->product_type == session('ordertype'))
                                    <div class="product__variations">
                                        @if(count($products->option)>0 && ($products->has_variation == 1))
                                            @php
                                                $options = $products->option->pluck('type')->unique()->toArray();
                                                if(in_array('size', $options))
                                                    $first_option = 'size';
                                                elseif(in_array('type', $options))
                                                    $first_option = 'type';
                                                else
                                                    $first_option = 'color';
                                            @endphp
                                           <div class="product__variations @if($products->has_customization) d-none @endif">
                                                <div class="row position-relative d-flex align-items-center w-100" >
                                                    <div class="col-3">
                                                            <h5 class="mb-0 mt-3">Select {{titleText($first_option)}}</h5>
                                                    </div>
                                                    <div class="col-9">
                                                        <div class="row" >
                                                            @php
                                                                $key1 =0;
                                                               // dd($products->option->groupBy('variation_id'));
                                                            @endphp
                                                            
                                                            {{-- @foreach($products->option->where('type',$first_option) as $size_items)  --}}
                                                            @php
                                                                $uniq_types = $products->option()->where('type',$first_option)->get();
                                                            @endphp
                                                            
                                                            @foreach($uniq_types->unique('value') as $size_items)
                                                    <!--/////////// Show First Option ////////////////////-->  
                                                                <div class="col-6 col-lg-4 text-center option_vals cursor-pointer">
                                                                    @php
                                                                        if($first_option == 'size')
                                                                            if(in_array('type', $options))
                                                                        	    $second_option = 'type';
                                                                        	else
                                                                        	    $second_option = 'color';
                                                                        elseif($first_option == 'type')
                                                                            if(in_array('color', $options))
                                                                        	    $second_option = 'color';
                                                                        else
                                                                                $second_option = '';
                                                                    @endphp
                                                                   
                                                                      @if ($products->option->where('type', $second_option)->count() == 0)
                                                                            @php
                                                                                $variation_data = App\Models\VariationKey::leftJoin('product_variations', 'variation_keys.variation_id', 'product_variations.id')
                                                                                    ->where(function ($query) {
                                                                                        return $query->where('product_variations.sku', '<>', '')->orWhere('product_variations.sku', '<>', null);
                                                                                    })
                                                                                    ->where('value', $size_items->value)
                                                                                    ->where('product_variations.product_id', $products->id)
                                                                                    ->first();
                                                                            @endphp
                                                                        @endif
                                                             
                                                                    <div class="round-checkbox  mb-2"> 
                                                                        <input type="radio" name="single_selection" @if($products->option->where('type',$second_option)->count() == 0 && ($variation_data))  data-vname="{{$variation_data->variation}}" data-price="{{$variation_data->price}}" data-specialprice="{{$variation_data->special_price}}" data-id="{{$variation_data->variation_id}}" @endif data-option="{{$size_items->id}}" @if($key1 == 0) checked @endif class="vari_checkbox" id="checkbox_option_rounded_{{$size_items->id}}">
                                                                        <label for="checkbox_option_rounded_{{$size_items->id}}" ></label>
                                                                    </div>
                                                                    <div data-option="{{$size_items->id}}" id="show_variations_{{$size_items->id}}" class="show_variations @if($key1 == 0) active @endif">
                                                                        <div class="card position-relative bg-white vari_type border-0 justify-content-center" >
                                                                            <div class="row">
                                                                                <div class="col-md-12 position-relative">
                                                                                    <img src="{{imageExisted('/assets/images/icon-img/'.$size_items->value.'.png')}}">
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <p class="card-price fw-bold">{{$size_items->value}} </p>
                                                                                    @if($products->option->where('type',$second_option)->count() == 0 && ($variation_data))
                                                                                        <small class="d-none">{{getPrice($variation_data->price)}} </small>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                    <!--/////////// Show Only  Two Option Time ////////////////////-->  
                                                                        @if($products->option->where('type',$second_option)->count() > 0)
                                                                            <div id="child_div_{{$size_items->id}}" class=" rounded mt-3 child_div pt-4" @if($key1 == 0) style="display:block" @endif>
                                                                                
                                                                                <div class="row d-flex align-items-center w-100 m-0">
                                                                                     <div class="col-3">
                                                                                         <div class="row">
                                                                                            <h5 class=" text-start">Select {{titleText($second_option)}}</h5>
                                                                                             
                                                                                         </div>
                                                                                    </div>
                                                                                    <div class="col-9 p-0">
                                                                                        <div class="row flex-row-reverse11 justify-content-end11 w-100 m-0" >
                                                                                            @php
                                                                                                    $ii = 0;
                                                                                                    $third_option ='';
                                                                                                    if($second_option == 'type'){
                                                                                                        if(in_array('color', $options))
                                                                                                    	    $third_option = 'color';
                                                                                                        else
                                                                                                            $third_option = '';
                                                                                                    }
                                                                                                    $key2 = 0
                                                                                               @endphp
                                                                                        @php
                                                                                            // $uniq_values = $products->option()->where('type',$second_option)->get();
                                                                                            $firstOption_Vids = $products->option()->where('type',$first_option)->where('value',$size_items->value)->pluck('variation_id')->toArray();
                                                                                            $uniq_values = $products->option()->where('type',$second_option)->whereIn('variation_id',$firstOption_Vids)->get();
                                                                                           
                                                                                        @endphp
                                                                                            @foreach($uniq_values as $type_items)
                                                                                                @if($products->option->where('type',$second_option)->count() == 0)
                                                                                                    @php
                                                                                                        $variation_data = App\Models\VariationKey::leftJoin('product_variations','variation_keys.variation_id','product_variations.id')
                                                                                                                                            ->where(function($query){
                                                                                                                                                 return $query
                                                                                                                                                        ->where('product_variations.sku', '<>','')
                                                                                                                                                        ->orWhere('product_variations.sku', '<>',NULL);
                                                                                                                     						})
                                                                                                                     						->where('value',$size_items->value)
                                                                                                                                            ->where('product_variations.product_id',$products->id)
                                                                                                                                            ->first(); 
                                                                                                    @endphp
                                                                                                @else
                                                                                
                                                                                                   @php
                                                                                                       $vari_ids = $products->variationList->where('value',$size_items->value)->pluck('variation_id');
                                                                                                       $variation_data = App\Models\VariationKey::leftJoin('product_variations','variation_keys.variation_id','product_variations.id')
                                                                                                                                                ->where(function($query){
                                                                                                                                                     return $query
                                                                                                                                                            ->where('product_variations.sku', '<>','')
                                                                                                                                                            ->orWhere('product_variations.sku', '<>',NULL);
                                                                                                                         						})
                                                                                                                                                ->where('product_variations.product_id',$products->id)
                                                                                                                                                ->where('value',$type_items->value)
                                                                                                                                                ->whereIn('variation_id',$vari_ids)
                                                                                                                                                ->first(); 
                                                                                                   
                                                                                                    @endphp
                                                                                                @endif
                                                                                                @if($variation_data)
                                                                                                        <div class="col-6 col-md-6 col-lg-4 text-center child_div_type {{$variation_data->value}}">
                                                                                                            <div class="card position-relative bg-white second_section border-0" data-childId="child_div_{{$type_items->id}}">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-12 position-relative">
                                                                                                                        <img src="{{imageExisted('/assets/images/icon-img/'.$variation_data->value.'.png')}}">
                                                                                                                    </div>
                                                                                                                    <div class="col-md-12">
                                                                                                                        <p class="card-price fw-bold">{{$variation_data->value}} </p>
                                                                                                                        @if($third_option == '')
                                                                                                                        <small class="d-none">{{getPrice($variation_data->price)}} </small>
                                                                                                                        @endif
                                                                                                                    </div>
                                                                                                                    <div class="round-radio ">
                                                                                                                        <input type="radio" data-childId="child_div_{{$type_items->id}}"  class="option__type" @if($third_option == '') data-vname="{{$variation_data->variation}}"  data-price="{{$variation_data->price}}" data-specialprice="{{$variation_data->special_price}}" data-id="{{$variation_data->variation_id}}" @endif  name="vari_type_{{$key1}}" @if($key1 == 0 && $ii == 0) checked @endif  id="radio_rounded_{{$key1}}_{{$key2}}">
                                                                                                                        <label for="radio_rounded_{{$key1}}_{{$key2}}" ></label>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        @php 
                                                                                                            $ii = $ii + 1;
                                                                                                        @endphp
                                                                                                @endif
                                                                                                @php
                                                                                                    $key2 = $key2 +1;
                                                                                                @endphp
                                                                                            @endforeach  
                                                                                        </div>
                                                                                    </div>
                                                                                     
                                                                               </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @php
                                                                    $key1= $key1 +1;
                                                                @endphp
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                   
                                    <div class="purchase-info" id="read-more" @if(isset($options)) @if(count($options)>2) style="margin-top: 500px;" @elseif(count($options)>1) style="margin-top: 130px;"  @endif @endif>
                                        <div class="row">
                                            <div class="col-lg-12 mt-5" >
                                                
                                                
                                                     @if($products->has_customization) 
                                                        <div class="card position-relative bg-white border-0 justify-content-center  mb-4 mt-3">
                                                            <div class="row card-body">
                                                                <div class="col-lg-12">
                                                                    <div class="mt-2">
                                                                        <label for="cookie-flavor" class="mb-2 fw-semibold">Select a Available Flavor</label> 
                                                                        @php
                                                                             $uniq_values = $products->option()->where('type','type')->get();     
                                                                        @endphp 
                                                                        <select class="form-control" style="appearance: auto !important;" name="cookie-flavor" id="cookie-flavor">
                                                                            @foreach($uniq_values as $item_)
                                                                                <option data-description="{{$item_->product_variation()->pluck('description')->first()}}" data-ingredients="{{$item_->product_variation()->pluck('ingredients')->first()}}" value="{{$item_->value}}" >{{$item_->value}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div> 
                                                                <div class="col-lg-12"> 
                                                                    <div class="mt-2">
                                                                        <label class="mb-2 fw-semibold">Cookie Message (Limit to 4-5 Words)</label>
                                                                        <textarea class="form-control"  name="cookie-message" id="cookie-message" row="2" style="appearance: none !important;max-height:30px;overflow:hidden"></textarea>
                                                                        <span class="wordCountMessage text-danger"></span> 
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-lg-6">
                                                                    <div class="mt-2">
                                                                        <label for="cookie-border_color" class="mb-2 fw-semibold">Preferred Colour for Border</label>
                                                                         <select class="form-control" style="appearance: auto !important;" name="cookie-border_color" id="cookie-border_color">=
                                                                           @php
                                                                                if($products->customization_color_one != ''){
                                                                                    $color1 = explode(',',$products->customization_color_one);
                                                                                }
                                                                           @endphp
                                                                           @foreach($color1 as $item_clr1) 
                                                                                <option @if('No preference' == $item_clr1) selected @endif>{{$item_clr1}}</option>
                                                                           @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mt-2">
                                                                        <label for="cookie-text_color" class="mb-2 fw-semibold">Preferred Colour for Text</label>
                                                                         <select class="form-control" style="appearance: auto !important;" name="cookie-text_color" id="cookie-text_color">
                                                                            @php
                                                                                if($products->customization_color_two != ''){
                                                                                    $color2 = explode(',',$products->customization_color_two);
                                                                                }
                                                                            @endphp
                                                                            @foreach($color2 as $item_clr2) 
                                                                                <option @if('No preference' == $item_clr1) selected @endif>{{$item_clr2}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                
                                                            </div>
                                                            
                                                        </div>
                                                    @endif
                
                
                
                                                    @php
                                                        
                                                       
                                                        $add_to_cart = '<div class="for-s-f">
                                                                            <input type="number" inputmode="numeric" min="1" value="1" class="quantity">
                                                                            <button type="button" data-hasspecial="'.$has_special_price.'"  data-specialprice="'.$pdct_details->special_price.'"  data-price="'.$pdct_details->price.'" data-pid="'.$pdct_details->id.'" class="btn add-cart-btn">
                                                                                ADD TO CART
                                                                            </button>
                                                                        </div>';
                                                    @endphp
                                                        
                                                    @if ($products->seasonal_availability == 1)
                                                        <div class="card position-relative bg-white border-0 justify-content-center  mb-4">
                                                            <div class="card-body text-center">
                                                                @if(isset($items) && count($items) > 0 && count($commonValue) <= 0 && $hasPreOrderProduct)
                                                                        <strong class="text text-danger pt-3">
                                                                            Sorry, this product is not available for the currently selected date & time. You can place a separate order for this item.
                                                                        </strong>
                                                                @else
                                                                        <span class=" fw-bold text-dark">
                                                                            This is a limited edition item and is available between <br>
                                                                            <span class="text-theme">
                                                                                {{date('d M Y',strtotime($products->seasonal_date_start))}}
                                                                            </span>
                                                                            and 
                                                                            <span class="text-theme">
                                                                                {{date('d M Y',strtotime($products->seasonal_date_end))}}.
                                                                            </span>
                                                                            <br>
                                                                            @if ($products->seasonal_availability == 1 && isset($items) && count($items) > 0 && is_object($hasPreOrderProduct))
                                                                                <span class="fw-bold text-danger">
                                                                                    But some other items in your cart have different availability dates
                                                                                </span><br>
                                                                                <span class="fw-bold text-danger"> The {{ session('ordertype') ?? 'pickup'}} date needs to be adjusted accordingly.</span>
                                                                            @elseif((isset($items) && count($items) > 0) && !is_object($hasPreOrderProduct))
                                                                                <span class="fw-bold text-danger"> The {{ session('ordertype') ?? 'pickup'}} date needs to be adjusted accordingly.</span>
                                                                            @endif
                                                                        </span>
                                                                 @endif
                                                            </div>
                                                        </div>
                                                    @endif
                                                @if ($products->seasonal_availability == 1)
                                                    @if (isset($items) && count($items) > 0 && session()->has('ordertype'))
                                                            @if (count($commonValue) > 0)
                                                                {!! $add_to_cart !!}
                                                            @elseif(!is_object($hasPreOrderProduct))
                                                             {!! $add_to_cart !!}
                                                            @endif
                                                    @else
                                                        @if (session()->has('ordertype'))
                                                            {!! $add_to_cart !!}
                                                        @endif
                                                    @endif
                                                @else
                                                    @if (session()->has('ordertype'))
                                                        {!! $add_to_cart !!}
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    
                                @else
                                    <div class="col-lg-12 bg-danger-subtle bg-opacity-50 p-4 rounded mt-2 mb-2  d-flex flex-column">
                                        <h2 class="text-danger  fw-bolder">Oops!</h2>
                                        <h6 class="text-dark fw-bolder">
                                            This item  currently not available
                                        </h6>    
                                        <h6 class="text-dark">
                                            We are working on getting your favorite item to your area soon.
                                        </h6>
                                        
                                        <div class="form-group mt-2">
                                             @if($products->product_type == 'delivery' || $products->product_type == 'both')
                                            <button class="btn btn-dark text-light rounded" data-bs-target="#DeliveryModalToggle" data-bs-toggle="modal" >@if(session('ordertype') == 'delivery') {{'Update'}} @else {{'Switch to' }} @endif Delivery City </button>
                                            @endif
                                             @if($products->product_type == 'pickup' || $products->product_type == 'both')
                                            <button class="btn btn-dark text-light rounded" data-bs-target="#PickupModalToggle" data-bs-toggle="modal" >@if(session('ordertype') == 'pickup') {{'Update'}} @else {{'Switch to' }} @endif Pickup</button>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @else
                            <div class="product-price mt-3">
                                <span style="font-size:150%;font-weight:400;color:#ff0000;">Out of Stock</span>
                            </div>
                        @endif
                        @else
                        <div class="mt-5">
                            <a href="{{ url('/sign-in') }}" class="primary-btn border-0 text-white text-decoration-none">Sign in</a>
                            <a href="{{ url('/sign-up') }}" class="primary-btn border-0 text-white text-decoration-none">Sign up</a>
                        </div>
                        @endauth
                        <div class="col-lg-12 nutritional-facts-tab">
                                @php
                                $nutritional_facts = product_nutritional_facts_all($products->id);
                                @endphp
                            @if($products->baking_info != '' || ($products->contents != '' || $products->has_customization) || $nutritional_facts->count() > 0)
                            <ul class="nav custom-tab nav-fill" id="myTab" role="tablist">
                                @if($products->baking_info != '')
                                
                                <li class="nav-item" role="presentation">
                                  <a class="text-decoration-none nav-link single-tab active " id="baking-instructions-tab" data-bs-toggle="tab" data-bs-target="#baking-instructions" type="button" role="tab" aria-controls="contact" aria-selected="false">Baking Instructions</a>
                                </li>
                                @endif
                                @if($products->contents != '' || $products->has_customization)
                                <li class="nav-item" role="presentation">
                                  <a class="text-decoration-none nav-link single-tab @if($products->baking_info == '') active @endif" id="ingredients-tab" data-bs-toggle="tab" data-bs-target="#ingredients" type="button" role="tab" aria-controls="home" aria-selected="true">Ingredients</a>
                                </li>
                                @endif
                                
                                @if($nutritional_facts->count() > 0)
                                <li class="nav-item " role="presentation">
                                  <a class="text-decoration-none nav-link single-tab  @if($products->contents == '' && $products->baking_info == '') active  @endif" id="nutritional-facts-tab" data-bs-toggle="tab" data-bs-target="#nutritional-facts" type="button" role="tab" aria-controls="profile" aria-selected="false">Nutritional Facts</a>
                                </li>
                                @endif
                            </ul>
                            
                            <div class="tab-content" id="myTabContent">
                                 @if($products->baking_info != '') 
                                <div class="tab-pane fade  @if($products->baking_info != '')  show active @endif" id="baking-instructions" role="tabpanel" aria-labelledby="baking-instructions-tab">
                                   {!! $products->baking_info !!}
                                </div>
                                @endif
                                @if($products->contents != '' || $products->has_customization)
                                    <div class="tab-pane fade  @if($products->baking_info == '')  show active @endif" id="ingredients" role="tabpanel" aria-labelledby="ingredients-tab">
                                        
                                            <div class="product-detail" > 
                                                {!! ucwords($products->contents) !!}
                                            </div>
                                    </div>
                                @endif
                                @if($nutritional_facts->count() > 0)
                                    <div class="tab-pane fade @if($products->contents == '' && $products->baking_info == '')  show active @endif" id="nutritional-facts" role="tabpanel" aria-labelledby="nutritional-facts-tab">
                                        <div class="product-detail mt-2 mb-4">
                                                @foreach($nutritional_facts as $key=>$n_facts)
                                                    @if($n_facts->picture == 'dummy.png' || $n_facts->picture == '')
                                                    @else
                                                        <img class="w-100 nutr-img nutr-{{$n_facts->variation_id}}"  style="display:none" src="{{asset('images/products/'.$n_facts->picture)}}" alt="">
                                                    @endif
                                                    
                                                @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @endif
                        
                        
                    </div>
                </div>
    
    
            </div>
            </div>
        </div>
        
        @include('frontend.side-cart')
            
    </section>
    <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    <!--                        // Suggested Products Show-->
    <!--////////////////////////////////////////////////////////////////////////////////////////////// -->
    <section class="related-products">
        <div class="container">
            <div class="row justify-content-center">
                @if($suggested_products->count() > 0) 
                    <div class="col-12">
                        <h1 class="text-center text-md-left mb-lg-4">Suggested Products</h1>
                    </div>
                    @foreach($suggested_products as $rel_products)
                        @if($rel_products->products)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <a href="{{url('product/'.$rel_products->products->slug)}}" class="cursor-pointer text-decoration-none">
                                    <div class="card border-0 rounded card-product-listing">
                                        <div class="d-flex align-items-center  position-relative">
                                            <img class="w-100 h-auto {{ $rel_products->products->mark_stock_status == 1 ? 'product-image out-of-stock' : ''}}" src="{!! ($rel_products->thumbImages->count()) != '' ? asset('images/products/' . $rel_products->thumbImages->first()->picture) : asset('/assets/images/dummy-product.jpg') !!}" onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';" alt="" >
                                            <div class="stock-overlay">
                                                <p class="stock-text-overlay">Out of Stock</p>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                           <h4 class="mb-0 fw-bold text-dark singleLinetext-d" >{!! capitalText($rel_products->products->name) !!}</h4>
                                        </div>
                                    </div>         
                                </a>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </section>
     
@endsection

@section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

   <script>
   
     $(document).ready(function () {
        $('.read-more-link').click(function () {
            const description = $(this).prev('p');
            description.css('webkit-line-clamp', 'unset');
            $(this).hide();
            $(this).siblings('.show-less-link').show();
        });

        $('.show-less-link').click(function () {
            const description = $(this).prevAll('p');
            description.css('webkit-line-clamp', '1');
            $(this).hide();
            $(this).siblings('.read-more-link').show();
        });
    });
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
                            // without location choosed 
    //////////////////////////////////////////////////////////////////////////////////////////////////////
  
        $(window).load(function() {
            @if(session()->has('session_string'))
            @else
                    $('#order-btn').attr('data-bs-backdrop', 'static')
                        .attr('data-bs-keyboard', 'false')
                        .modal('show');
                    $('.modal').attr('data-bs-backdrop', 'static')
                        .attr('data-bs-keyboard', 'false');
                    $('.modal .close_button').hide();  
                    
          
            @endif
        });    
                            // image slider
    ////////////////////////////////////////////////////////////////////////////////////////////// 
       
      
        $('#ChangeDeliveryModalToggle').on('hidden.bs.modal', function () {
                window.location.href = '';
        });
        
      /////////////////////////////////////////////////////////////////////////////////////////////////////////
                            // add to cart
    ////////////////////////////////////////////////////////////////////////////////////////////// 
        

        
       @if($products->has_variation == 0)
            $('body').on('click', '.add-cart-btn', function() {
                var price    = $(this).attr('data-price');
                var pdct_id  = $(this).attr('data-pid');
                var quantity = $('.quantity').val();
                
                    @if($products->has_customization)
                        var flavor      = $('#cookie-flavor').val();
                        var color       = '';
                        var message     = $('#cookie-message').val();
                        var border_color= $('#cookie-border_color').val();
                        var text_color  = $('#cookie-text_color').val();
                        var customized  = 1;
                    @else
                        var flavor      = '';
                        var color       = '';
                        var message     = '';
                        var border_color= '';
                        var text_color  = '';
                        var customized  = 0;
                    @endif
                
                $.ajax({
                    url: '{{url('basket/add')}}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    type: 'POST',
                    data: { price: price, pdct_id: pdct_id, quantity: quantity,flavor :flavor, color :color, message :message, border_color :border_color, text_color :text_color,customized : customized},
                    success: function(response) {
                      
                        if(response.result == 1){
                            $('.cart-icon .cart-count').html(response.cart_count);
                            Swal.fire({
                                icon: 'success',
                                html: '<h1 class="main-h1"> Thank you </h1>' + '<h2 class="main-h2"> Chocolate Chip Cookie - Box of Six has been added to the cart </h2>',
                                showCancelButton: true,
                                
                                cancelButtonText: 'Continue Shopping',
                                confirmButtonText: 'Go to Cart',
                                allowOutsideClick: false
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = '/cart';
                                } else {
                                    window.location.href = '/menu';
                                }
                            });
                            
                            
                            var addToCartData = response.addToCartData;
                            console.log(addToCartData);
                            gtag("event", "add_to_cart", addToCartData);
                            
                        }
                        else {
                            alert('Error');
                        }
                    }
                });
                
            });
    @else
        $('body').on('click', '.add-cart-btn', function() {
            var cartItems = [];
            @if(count($products->option)>0 && isset($options) )
              @if(count($options) == 2)
                    $('.vari_checkbox:checked').each(function() {
                        var $checkbox = $(this);
                        var $showVariations = $checkbox.closest('.option_vals').find('.show_variations');
                        // var qty = parseInt($showVariations.find('.customQty').val());
                        var qty = $('.quantity').val();
                        var price = parseFloat($showVariations.find('.option__type:checked').data('price'));
                        var pdct_id = parseInt($showVariations.find('.option__type:checked').data('id'));
                        cartItems.push({ price: price, pdct_id: pdct_id, quantity: qty });
                    });
    
                @else
                    $('.vari_checkbox:checked').each(function() {
                        var $checkbox = $(this);
                        var $showVariations = $checkbox.closest('.option_vals').find('.show_variations');
                        // var qty = parseInt($showVariations.find('.customQty').val());
                         var qty = $('.quantity').val();
                        var price = parseFloat($checkbox.data('price'));
                        var pdct_id = parseInt($checkbox.data('id'));
                        cartItems.push({ price: price, pdct_id: pdct_id, quantity: qty });
                    });
    
                @endif
            @endif
    
            // Loop through the cart items array
            var index = 0;
            function sendCartData() {
                if (index < cartItems.length) {
                    var cartItem = cartItems[index];
                    var price = cartItem.price;
                    var pdct_id = cartItem.pdct_id;
                    var quantity = cartItem.quantity;
    
                    @if($products->has_customization)
                        var flavor      = $('#cookie-flavor').val();
                        var color       = '';
                        var message     = $('#cookie-message').val();
                        var border_color= $('#cookie-border_color').val();
                        var text_color  = $('#cookie-text_color').val();
                        var customized  = 1;
                    @else
                        var flavor      = '';
                        var color       = '';
                        var message     = '';
                        var border_color= '';
                        var text_color  = '';
                        var customized  = 0;
                    @endif
                                        
                    $.ajax({
                        url: '{{url('basket/add')}}',
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        data: { price: price, pdct_id: pdct_id, quantity: quantity,flavor :flavor, color :color, message :message, border_color :border_color, text_color :text_color,customized : customized},
                        success: function(response) {
                            if (response.result == 1) {
                                $('.cart-icon .cart-count').html(response.cart_count);
                            } else {
                                alert('Error');
                            }
                                 
                            var addToCartData = response.addToCartData;
                
                            gtag("event", "add_to_cart", addToCartData);
                            
                            index++;
                            sendCartData(); // Call the function recursively to process the next cart item
                        }
                    });
                } else {
                    // All cart items have been processed
                    Swal.fire({
                        icon: 'success',
                        text: 'Product(s) have been added to your cart.',
                        showCancelButton: true,
                        confirmButtonText: 'Go to Cart',
                        cancelButtonText: 'Continue Shopping',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/cart';
                        } else {
                            window.location.href = '/menu';
                        }
                    });
                }
            }
    
            // Start sending the cart data
            sendCartData();
        });
    @endif


     /////////////////////////////////////////////////////////////////////////////////////////////////////////
                            //variation child div showing
    //////////////////////////////////////////////////////////////////////////////////////////////       
  
        
       $('body').on('click change input', '.show_variations', function(event) {
            var $this           = $(this);
            var $childDiv       = $this.find('.child_div');
            var $childDivchild  = $this.find('.child_div_child');
            var $childQnty      = $this.find('.child_qnty');
            var $childCusQnty   = $this.find('.child_qnty .customQty');
            var optionId        = $this.data('option');
            $('.show_variations').removeClass("active");
            $this.addClass('active');
            $('.child_div').not($childDiv).hide();
            $('.child_div_child').not($childDivchild).hide();
           
            if (event.type === 'click' && $(event.target).closest('.child_div').length > 0 ) {
              
                $('#checkbox_option_rounded_' + optionId).prop('checked', true);
                        if($childCusQnty.val() == 0)
                            $childCusQnty.val(1)
                      
                // Clicked inside child_div, do not toggle
                return;
            }
            
            if (event.type === 'click') {
                $this.addClass('active');
                $('#checkbox_option_rounded_' + optionId).prop('checked', true);
            }
            
               
                if ($childCusQnty.val() > 0)
                {
                    $('#checkbox_option_rounded_' + optionId).prop('checked', true);
                }
                else
                { 
                    $('#checkbox_option_rounded_' + optionId).removeAttr('checked');
                    var checkedCount = $('.vari_checkbox:checked').length;
                    if(checkedCount == 0){
                        $('#checkbox_option_rounded_' + optionId).prop('checked', true);
                        $childCusQnty.val(1)
                    }
                }
            
            if ($('#checkbox_option_rounded_' + optionId).is(':checked')) {
                var ChildcheckedCount = $('#child_div_' + optionId).find('.option__type:checked').length;
                if(ChildcheckedCount == 0){
                    $('#child_div_' + optionId).find('.option__type:first').prop('checked', true);
                }
            } else {
                $('#child_div_' + optionId).find('.option__type:first').removeAttr('checked');
            }
               
            $childDiv.show();
            $childQnty.show();
            $childDivchild.show();
            // calculateItems()
            
        });
        
     
          
        $('body').on('click mouseenter', '.second_section', function(event) {
            var $this = $(this);
            $('.third_section').hide();
            var child_id = $this.data('childid');
            $('#'+child_id).show();
        });
        
    
        $('body').on('click', '.vari_checkbox', function(event) {
            var option_id = $(this).data('option');
            var isChecked = $(this).is(':checked');
    
            var checkedCount = $('.vari_checkbox:checked').length;
    
            if(checkedCount != 0){
                if (isChecked) {
                    $('.child_div').hide();
                    $('.show_variations').removeClass("active")
                    $('#show_variations_'+option_id).addClass("active");
                    $('#child_div_'+option_id).show();
                    $(this).find('.third_section').show();
                    $('#show_variations_'+option_id).find('.customQty').val(1);
                    
                }
                else
                {  
                    $('#show_variations_'+option_id).removeClass('active');  
                    $('#show_variations_'+option_id).find('.customQty').val(0);
                }
                
                 if ($('#checkbox_option_rounded_' + option_id).is(':checked')) {
                    var ChildcheckedCount = $('#child_div_' + option_id).find('.option__type:checked').length;
                    if(ChildcheckedCount == 0){
                        $('#child_div_' + option_id).find('.option__type:first').prop('checked', true);
                    }
                } else {
                    $('#child_div_' + option_id).find('.option__type').removeAttr('checked');
                }
            }
            else
            {
                $(this).prop('checked', true);
                $('.child_div').hide();
                $('.show_variations').removeClass("active")
                $('#show_variations_'+option_id).addClass("active");
                $('#child_div_'+option_id).show(); 
                $('#show_variations_'+option_id).find('.customQty').val(1);
            }
        });
        
        $(document).on('click', '.child_div_type', function() {
    
            $(this).find('.round-radio input[type="radio"]').prop('checked', true);
    
        });
        
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
                            // Onchange variation click Price Change
    //////////////////////////////////////////////////////////////////////////////////////////////       

     
        
        $('body').on('change click', 'input[name="single_selection"],.show_variations,.option__type', async function () {
            
        //   child_div_type
        
            @if(count($products->option) > 0 && isset($options))
                @if(count($options) == 2)
                    var $showVariations = $('.vari_checkbox:checked').closest('.option_vals').find('.show_variations');
                    var price   = parseFloat($showVariations.find('.option__type:checked').data('price'));
                    var vari_id = $showVariations.find('.option__type:checked').data('id');
                    var special_price =  parseFloat($showVariations.find('.option__type:checked').data('specialprice'));
                @else
                    var price   = parseFloat($('.vari_checkbox:checked').data('price'));
                    var vari_id = $('.vari_checkbox:checked').data('id');
                    var special_price =  parseFloat($('.vari_checkbox:checked').data('specialprice'));
                @endif
            @endif
            
            
            @if($checkSpecialPrice)
            
                @if($products->discount_type == 'percentage')
                    var PriceVal = "$" + special_price.toFixed(2) +' <small class="text-body-tertiary h3">(<strike>$'+ price.toFixed(2) +'</strike>) <span class="text-danger">'+ ((price - special_price)/price*100).toFixed(0) +'% OFF</span></small>';
                @else
                    var PriceVal = "$" + special_price.toFixed(2) +' <small class="text-body-tertiary h3">(<strike>$'+ price.toFixed(2) +'</strike>) <span class="text-danger">'+ '$'+((price - special_price).toFixed(2)) +' OFF</span></small>';
                @endif
                              
            @else
                var PriceVal = "$" + price.toFixed(2);
            @endif
            
            $('#product_price').html(PriceVal);
            
            
            
            
            $('.nutr-img').hide();
            if($('.prdct_img').length >1){
               await $('.prdct_img').each(function() {
                    var category_id  = $(this).attr('data-category');
                     if(vari_id == category_id){
                         $(this).show();
                       loadSlider(true);
                       $('.nutr-'+category_id).show(); 
                       
                     }
                     else
                     {
                         $(this).hide();  
                     }
                });
            }
            else
            {
                $('.prdct_img').show();
                $('.nutr-img').show()
            }

      
        }); 
        
        if($('.prdct_img').length == 0){
            $('.productImageStick').html('<img src="/assets/images/dummy-product.jpg" class="w-100">')
            $('.nutr-img').show()
        }
        
        else if($('.prdct_img').length >1){
             @if(count($products->option) > 0 && isset($options))
                var cat_id = '';
                    @if(count($options) == 2)
                    var $showVariations = $('.vari_checkbox:checked').closest('.option_vals').find('.show_variations');
                    var cat_id = $showVariations.find('.option__type:checked').data('id');
                      $('.nutr-'+cat_id).show();
                   
                    @else
                        var cat_id = $('.vari_checkbox:checked').data('id');
                        
                       $('.nutr-'+cat_id).show();
                    @endif
                   
                         $('.prdct_img').each(function() {
                            var category_id  = $(this).attr('data-category');
                             if(cat_id == category_id){
                                 $(this).show();
                            
                               loadSlider(true);
                               $('.nutr-'+cat_id).show(); 
                               
                             }
                             else
                             {
                                 $(this).hide();  
                             }
                        });
                @else
                    $('.prdct_img').hide();
                    $('.nutr-img').hide()
                    $(".prdct_img:first").show()
                    $(".nutr-img:first").show()
                @endif
            }
            else
            {
                $('.prdct_img').show();
                $('.nutr-img').show()
            }
        
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
     
    </script>
     <script>
           
           
    $(document).ready(function() {
        
        
        $('body').on('input','#cookie-message', function () {
         
            const textArea = $(this);
            const text = $(this).val().trim();
            const wordCountMessage = $(".wordCountMessage");
            const words = text.split(/\s+/);
            const wordCount = words.length;
       
            if (wordCount > 5) {
                textArea.val(text.split(/\s+/).slice(0, 5).join(" "));
                wordCountMessage.text("Only possible to show 4-5 words.");
            } else {
                wordCountMessage.text("");
            }
            
        });
                

        if (window.innerWidth <= 1919) {
          const cartPanel = $("#cart");
          const cartButton = $("#cart-button, #cart-button *");
          const closeButton = $("#close-button");
          
          
    
          cartButton.on("click", function() {
            cartPanel.css("right", "0");
            cartButton.css("display", "none"); // Hide the cart button
          });
          
          
          closeButton.on("click", function() {
            cartPanel.css("right", "-300px");
            cartButton.css("display", "flex"); // Show the cart button
          });
    
        //   Event listener for clicks on the document
          $(document).on("click", function(event) {
            // Check if the clicked element is outside the cart panel and cart button
            if (!cartPanel.is(event.target) && !cartButton.is(event.target) ) {
              // Hide the cart panel and show the cart button
              cartPanel.css("right", "-300px");
              cartButton.css("display", "flex");
            }
          });
        } else {
          // If screen size is larger than 1920px, show the cart panel and hide the cart button
          $("#cart").css("right", "0");
          $("#cart-button").css("display", "none");
        }
        
        $(".delete-btn").click(async function() {
            
                var item = $(this).closest('.cart-item');
                var quantity = $(this).val();
                var product_sku = $(this).data('psku');
                var product_id  = $(this).data('pid');
                var product_price = $(this).data('price');
                var preorder        = $(this).data('preorder')
                
                await update_products(product_sku,product_id,product_price,0);
                var totalAmount = 0;
                      $(this).closest(".cart-item").remove();
                $('.Item_total').each(function() {
                    totalAmount += parseFloat($(this).text().replace('$', ''));
                });
                
                $('#total-amount').text('Total: $' + totalAmount.toFixed(2));
          
          
                if ($('.cart-item').length === 0 || preorder == 1) {
                    // All items have been deleted, refresh the page
                    location.reload();
                }
            });
            
            
              const body = $('body');
        function update_products(product_sku,product_id,product_price,quantity) {
            body.append(`<div class="product-loading"><i class="bi bi-arrow-clockwise"></i></div>`);
            $.ajax({
                url: '/cart/productadd', 
                method: 'GET', 
                dataType: 'json',
                data: {'product_sku': product_sku,'product_id': product_id,'quantity': quantity,'price'   : product_price},
                success: function(response) {
                    $('.cart-icon .cart-count,.float-button .cart-count').html(response.cart_count)
                    body.find('.product-loading').remove();
                },
                error: function(xhr, status, error) {
                     alert('something went wrong please try again')
                    // body.find('.product-loading').remove();
                }
            });
        }
        
        
                                                
        @if($products->has_customization) 
            updateDescriptionAndIngredients();
    
            // Handle the change event of the select element
            $('#cookie-flavor').on('change', function() {
                updateDescriptionAndIngredients();
            });
    
            function updateDescriptionAndIngredients() {
                var selectedOption = $('#cookie-flavor option:selected');
                var description = selectedOption.data('description');
                var ingredients = selectedOption.data('ingredients');
                // Update the placeholders with the selected option's data
                $('.product-detail').html(description);
                $('#ingredients .product-detail').html(ingredients);
            }
        @endif
        
    });
   
    </script>
    
    <script>
        gtag("event", "view_item", {!! json_encode($ViewData) !!});
    </script>
  
@endsection
