@extends('layouts.frontend')
@section('styles')
    <style>
        
        .round-checkbox {
  position: relative;
}   

.round-checkbox label,
.round-radio label {
  background-color: #fff;
  border: 1px solid #ccc;
  border-radius: 50%;
  cursor: pointer;
  height: 28px;
  right: 0;
  position: absolute;
  top: 20px;
  z-index: 9;
  width: 28px;
}

.round-radio label {
  top: -5px !important;
}

.round-checkbox label:after,
.round-radio label:after {
  border: 2px solid #fff;
  border-top: none;
  border-right: none;
  content: "";
  height: 6px;
  left: 7px;
  opacity: 0;
  position: absolute;
  top: 8px;
  transform: rotate(-45deg);
  width: 12px;
}

.round-checkbox input[type="checkbox"],
.round-radio input[type="radio"] {
  visibility: hidden;
}

.round-checkbox input[type="checkbox"]:checked + label,
.round-radio input[type="radio"]:checked + label {
  background-color: #66bb6a;
  border-color: #66bb6a;
}

.round-checkbox input[type="checkbox"]:checked + label:after,
.round-radio input[type="radio"]:checked + label:after {
  opacity: 1;
}

.child_div,
.third_section {
  display: none;
  position: absolute;
  width: 100%;
  left: 0;        
  
}

input[type="radio"]:checked + label {
  border-color: #66bb6a !important;
}
        
        /*///////////////////////////////////////////////////////////////////*/
        

        
        .child_div::before {
          content: "";
          position: absolute;
          color: var(--bs-warning-bg-subtle) !imporatnt;
          /*left: 50%;*/
          top:-20px;
          transform: translateX(-50%);
          border-width: 10px;
          border-style: solid;
              border-color: transparent transparent #f5f5f5 transparent;
            border-top-color: #dee2e6; /* Set the desired border color */
        }
        
        .product__variations .option_vals:nth-child(2) .child_div::before {
            left: 15% !important;
        }
        
        .product__variations .option_vals:nth-child(4) .child_div::before {
            right: 15% !important;
        }
        
        /*.bg-danger-subtle,.show_variations.active .card.vari_type{*/
        /*   background: #f993c38c !important;*/
        /*}*/
        
        
        
        .line-limited{
            overflow: hidden;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                    margin-bottom: 0;
                                    padding-bottom:0;
        }
        
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
@endsection
@section('contents')
    
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 >{{titleText($products->name)}}</h1>
                </div>
            </div>
        </div>
    </section>

@php
$basket = GetBasket();
@endphp
<section class="product-detail-slider" style="padding: 60px 0;">
    <div class="container">

        <div class="row">
            <!-- card left -->

            <div class="col-12 col-md-6">
                <div class="slider-for "> <!--  img-showcase -->
                @if($products->picture)
                    <div>
                        <img class="w-100" src="{{asset('images/products/'.$products->picture)}}" alt="cookie image">
                    </div>
                @endif
                 @foreach($products->images as $key1 => $img_item)
                    <div>
                        <img class="w-100" src="{{asset('images/products/'.$img_item->picture)}}" alt="cookie image">
                    </div>
                 @endforeach
                </div>
                <div class="slider-nav "> <!--  img-showcase -->
                @if($products->picture)
                    <div>
                        <img class="w-100" src="{{asset('images/products/'.$products->picture)}}" alt="cookie image">
                    </div>
                @endif
                @foreach($products->images as $key1 => $img_item)
                    <div>
                        <img class="w-100" src="{{asset('images/products/'.$img_item->picture)}}" alt="cookie image">
                    </div>
                @endforeach
                    
                </div>
            </div>

            <!-- card right -->
            <div class="col-12 col-md-6" style="background: #fafafa; border-radius: 10px;">
                <div class="product-content" >
                    <h2 class="product-title">{{titleText($products->name)}}</h2>
                    @php
                         $pdct_details = $products->product_variation->where('product_id',$products->id)->first();
                    @endphp
                       @if($products->has_variation == 0)
                    <div class="product-price">
                        <h4 class="new-price"><span style="font-weight: 800;font-size: 40px;" id="product_price">${{$pdct_details->price }}</span></h4>
                    </div>
                    @endif
                    <div class="product-detail line-limited"> 
                        @empty($products->description)
                            {!! $dummy_text = dummy_text($products->name) !!}
                        @else
                            {!! $products->description !!}
                        @endif
                    </div>
                        
                    <div style="margin-bottom: 1rem;" class="text-end">
                        <a style="padding: 5px;margin-bottom: 1rem;font-weight: 600;color: #000" href="#read-more">Read more</a>
                    </div>
                    @if($basket_items)
                        @if( $products->product_type == 'both' || $products->product_type == $basket_items->order_type)
                            <div class="product__variations">
                                @if(count($products->option)>0 && ($products->has_variation == 1))
                                    @php
                                        $options = $products->option->pluck('name')->unique()->toArray();
                                        if(in_array('size', $options))
                                            $first_option = 'size';
                                        elseif(in_array('type', $options))
                                            $first_option = 'type';
                                        else
                                            $first_option = 'color';
                                        
                                    @endphp
                                    <!--//mutiple variation-->
                                   <div class="product__variations">
                        
                                        <!--//mutiple variation-->
                                        <div class="row" style="position: relative;">
                                            <h5 class="mb-2">Select {{titleText($first_option)}}</h5>
                                            @foreach($products->option->where('name',$first_option) as $key1=> $size_items)
                                                <div class="col-lg-4 text-center option_vals cursor-pointer">
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
                                                    @if($products->option->where('name',$second_option)->count() == 0)
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
                                                    @endif
                                             
                                                    <div class="round-checkbox  mb-2">
                                                        <input type="checkbox" @if($products->option->where('name',$second_option)->count() == 0) data-price="{{$variation_data->price}}" data-id="{{$variation_data->variation_id}}" @endif data-option="{{$size_items->id}}" @if($key1 == 0) checked @endif class="vari_checkbox" id="checkbox_option_rounded_{{$size_items->id}}">
                                                        <label for="checkbox_option_rounded_{{$size_items->id}}" ></label>
                                                    </div>
                                                    <div data-option="{{$size_items->id}}" id="show_variations_{{$size_items->id}}" class="show_variations @if($key1 == 0) active @endif">
                                                        <div class="card position-relative bg-light vari_type" >
                                                            <div class="row">
                                                                <div class="col-md-12 position-relative">
                                                                    <img src="{{imageExisted('/assets/images/icon-img/'.$size_items->value.'.png')}}">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <p class="card-price fw-bold">{{$size_items->value}} </p>
                                                                    
                                                                    <div class=" child_qnty mt-2 mb-2" @if($key1 == 0) style="display:block" @else style="display:none"  @endif  > 
                                                                        <div class="form-group mt-4 d-flex"> 
                                                                            <!--<span class="ps-2 pe-2 border cursor-pointer" onclick="document.getElementById('customInput{{$size_items->id}}').stepDown(1)">-</span>-->
                                                                            <input type="number"  inputmode="numeric" class="form-control p-0 text-center customQty" id="customInput{{$size_items->id}}" min="0"   value="1"  placeholder="Qty">
                                                                            <!--<span class="ps-2 pe-2 border cursor-pointer" onclick="document.getElementById('customInput{{$size_items->id}}').stepUp(1)">+</span>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        @if($products->option->where('name',$second_option)->count() > 0)
                                                            <div id="child_div_{{$size_items->id}}" class="border border-theme border-light-subtle rounded mt-3 child_div p-4" @if($key1 == 0) style="display:block" @endif>
                                                                <h5 class="mb-2 text-start">Select {{titleText($second_option)}}</h5>
                                                                <div class="row">
                                                                    @php
                                                                        $ii = 0;
                                                                        $third_option ='';
                                                                        if($second_option == 'type'){
                                                                            if(in_array('color', $options))
                                                                        	    $third_option = 'color';
                                                                            else
                                                                                $third_option = '';
                                                                        }
                                                                   @endphp
                                                                @foreach($products->option->where('name',$second_option) as $key2=> $type_items)
                                                                
                                                                   
                                                                    @if($products->option->where('name',$second_option)->count() == 0)
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
                                                                            <div class="col-lg-4 text-center child_div_type">
                                                                                <div class="card position-relative bg-light second_section" data-childId="child_div_{{$type_items->id}}">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 position-relative">
                                                                                            <img src="{{imageExisted('/assets/images/icon-img/'.$variation_data->value.'.png')}}">
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <p class="card-price fw-bold">{{$variation_data->value}} </p>
                                                                                            @if($third_option == '')
                                                                                            <small>{{getPrice($variation_data->price)}} </small>
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="round-radio ">
                                                                                            <input type="radio" data-childId="child_div_{{$type_items->id}}" class="option__type" @if($third_option == '')  data-price="{{$variation_data->price}}" data-id="{{$variation_data->variation_id}}" @endif  name="vari_type_{{$key1}}" @if($ii == 0) checked @endif id="radio_rounded_{{$key1}}_{{$key2}}">
                                                                                            <label for="radio_rounded_{{$key1}}_{{$key2}}" ></label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                @if($products->option->where('name',$third_option)->count() > 0)
                                                                                    <div id="child_div_{{$type_items->id}}" class="third_section rounded mt-3  p-4" @if($ii == 0) style="display:block" @endif>
                                                                                        <h5 class="mb-2 text-start">Select {{titleText($third_option)}}</h5>
                                                                                        <div class="row"> 
                                                                                     
                                                                                            @php
                                                                                                $jj = 0;
                                                                                            @endphp
                                                                                            @foreach($products->option->where('name',$third_option) as $key3=> $color_items)
                                                                                                 @php
                                                                                                    $vari_ids2       = $products->variationList->where('value',$type_items->value)->pluck('variation_id');
                                                                                                    $commonIds = $vari_ids2->intersect($vari_ids);
                                                                                                
                                                                                                    $variation_data2 =  App\Models\VariationKey::leftJoin('product_variations','variation_keys.variation_id','product_variations.id')
                                                                                                                        ->where(function($query){
                                                                                                                             return $query
                                                                                                                                    ->where('product_variations.sku', '<>','')
                                                                                                                                    ->orWhere('product_variations.sku', '<>',NULL);
                                                                                                 						})
                                                                                                                        ->where('product_variations.product_id',$products->id)
                                                                                                                        ->where('value',$color_items->value)
                                                                                                                        ->whereIn('variation_id',$commonIds)
                                                                                                                        ->first(); 
                                                                                                @endphp 
                                                                                                @if($variation_data2)
                                                                                                    
                                                                                                             <div class="col text-center">
                                                                                                                <div class="card position-relative bg-light" >
                                                                                                                    <div class="row">
                                                                                                                        <div class="col-md-12 position-relative">
                                                                                                                            <img src="/assets/images/9.png">
                                                                                                                        </div>
                                                                                                                        <div class="col-md-12">
                                                                                                                            <p class="card-price fw-bold">{{$variation_data2->value}} </p>
                                                                                                                            <small>{{getPrice($variation_data2->price)}} </small>
                                                                                                                        </div>
                                                                                                                        <div class="round-radio ">
                                                                                                                            <input type="radio" class="option__type_child" data-price="{{$variation_data2->price}}" data-id="{{$variation_data2->variation_id}}"  name="vari_type_{{$key1}}_{{$key2}}" @if($jj == 0) checked @endif id="radio_rounded_{{$key1}}_{{$key2}}_{{$key3}}">
                                                                                                                            <label for="radio_rounded_{{$key1}}_{{$key2}}_{{$key3}}" ></label>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                   
                                                                                                @php 
                                                                                                    $jj = $jj + 1;
                                                                                                @endphp 
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                            @php 
                                                                                $ii = $ii + 1;
                                                                            @endphp
                                                                    @endif
                                                                @endforeach   
                                                               </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
        
                            <div class="purchase-info" id="read-more" @if(isset($options)) @if(count($options)>2) style="margin-top: 500px;" @elseif(count($options)>1) style="margin-top: 250px;"  @endif @endif>
                                <div class="row">
                                    <div class="col-lg-9" >
                                        @if($products->has_variation)
                                            <p class="fw-bold mt-3 ms-1">Total Qty: <span class="ttl_qty">0</span></p>
                                        @endif
                                        @if($basket_items)
                                            @if($products->has_variation == 0)
                                            <input type="number"  inputmode="numeric" min="1" value="1"class="quantity" > 
                                            @endif
                                            <button  type="button" data-price="{{$pdct_details->price}}" data-pid="{{$pdct_details->id}}"  class="btn add-cart-btn"  >
                                                Add to Cart <i class="bi bi-cart"></i>
                                            </button>
                                        @else
                                            @if(!$basket_items)
                                            <div class="purchase-info" id="read-more">
                                                @if($products->has_variation == 0)
                                                <input type="number"  inputmode="numeric" min="1" value="1" class="quantity" style="margin-bottom: 0rem !important; border-radius:0 !important;"> 
                                                @endif
                                                <button type="button" class="btn mt-3" data-bs-toggle="modal" data-bs-target="#order-btn" data-pid="{{$pdct_details->id }}" data-price="{{$pdct_details->price }}" >
                                                    Add to Cart <i class="bi bi-cart"></i>
                                                </button>
                                            </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-12 bg-danger-subtle bg-opacity-50 p-4 rounded mt-2 mb-2  d-flex flex-column">
                                <h2 class="text-danger  fw-bolder">Oops!</h2>
                                <h6 class="text-dark fw-bolder">
                                    This item of Sweetie Pie is currently not available for {{$basket_items->order_type ?? ''}}
                                </h6>    
                                <h6 class="text-dark">
                                    We are working on getting your favorite item to your area soon.
                                </h6>
                                
                                <div class="form-group mt-2">
                                    <button class="btn btn-dark rounded" data-bs-target="#DeliveryModalToggle" data-bs-toggle="modal" >@if($basket_items->order_type == 'delivery') {{'Update'}} @else {{'Switch to' }} @endif Delivery City </button>
                                    <button class="btn btn-dark rounded" data-bs-target="#PickupModalToggle" data-bs-toggle="modal" >@if($basket_items->order_type == 'pickup') {{'Update'}} @else {{'Switch to' }} @endif Pickup</button>
                                </div>
                            </div>
                        @endif
                    @endif
                    
                        <div class="product-detail" >  
                        @empty($products->description)
                            {!! $dummy_text !!}
                        @else
                            <h2 style="font-weight: 700; font-size: 22px;">About product:</h2>
                            <p>  {!! $products->description !!} </p>
                        @endif
                           
                    </div>
                    @if($products->nutrition_picture == 'dummy.png' || $products->nutrition_picture == '')
                    @else
                        <div class="product-detail mt-2">
                            <h2 style="font-weight: 700; font-size: 22px;">Nutrition Info:</h2>
                            <img class="w-100" src="{{asset('images/products/'.$products->nutrition_picture)}}" alt="">
                        </div>
                    @endif
                </div>
            </div>


        </div>
    </div>



</section>
    <section class="related-products">
        <div class="container">
            <div class="row">
                @if($related_products->count() > 0)
                    <div class="col-12">
                        <h1>Suggested Product</h1>
                    </div>
                    @foreach($related_products->take(4) as $rel_products)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="for-card text-center   border-0  rounded">
                                <a  @if(checkBasket() == false )  data-bs-toggle="modal" data-bs-target="#order-btn" data-href="{{url('product/'.$rel_products->slug)}}" data-pid="{{$rel_products->id}}" class="order_now bg-transparent text-decoration-none" @else href="{{url('product/'.$rel_products->slug)}}" class="bg-transparent text-decoration-none" @endif   >
                                    <img src="{{asset('images/products/'.$rel_products->picture_small)}}" alt="">
                                    <h4 class="fw-bolder text-dark mt-2">{{titleText($rel_products->name)}}</h4>
                                    <p class="text-center h3 fw-bold text-theme">{{min_price($rel_products->id)}}</p>
                                </a>
                                @if($rel_products->nutrition_picture == 'dummy.png' || $rel_products->nutrition_picture == '')
                                @else
                                    <div class="nutrient_details">
                                        <a href="#" class="nutrientinfo" data-pic="{{asset('images/products/'.$rel_products->nutrition_picture)}}">
                                           <i class="bi bi-card-checklist text-dark"></i>
                                        </a>
                                    </div>
                                @endif
        
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>


     
@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>

   <script>
        const imgs = document.querySelectorAll('.img-select a');
        const imgBtns = [...imgs];
        let imgId = 1;

        imgBtns.forEach((imgItem) => {
            imgItem.addEventListener('click', (event) => {
                event.preventDefault();
                imgId = imgItem.dataset.id;
                slideImage();
            });
        });

        function slideImage() {
            const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

            document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
        }

        window.addEventListener('resize', slideImage);
      
        $('#ChangeDeliveryModalToggle').on('hidden.bs.modal', function () {
                window.location.href = '';
        });
        
      ////////////////////////////////////////////////////////////////////////////////////////////////////////////
       @if($products->has_variation == 0)
    $('body').on('click', '.add-cart-btn', function() {
        var price    = $(this).attr('data-price');
        var pdct_id  = $(this).attr('data-pid');
        var quantity = $('.quantity').val();
        $.ajax({
            url: '{{url('basket/add')}}',
            type: 'GET',
            data: { price: price, pdct_id: pdct_id, quantity: quantity },
            success: function(response) {
                if(response.result == 1){
                    $('.cart-icon .cart-count').html(response.cart_count);
                    Swal.fire({
                        icon: 'success',
                        html: '<h1 class="main-h1"> Thank you </h1>' + '<h2 class="main-h2"> Chocolate Chip Cookie - Box of Six has been added to the cart </h2>',
                        showCancelButton: true,
                        confirmButtonText: 'Go to Cart',
                        cancelButtonText: 'Continue Shopping',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/cart';
                        } else {
                            window.location.href = '/category';
                        }
                    });
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
                    var qty = parseInt($showVariations.find('.customQty').val());
                    var price = parseFloat($showVariations.find('.option__type:checked').data('price'));
                    var pdct_id = parseInt($showVariations.find('.option__type:checked').data('id'));
                    cartItems.push({ price: price, pdct_id: pdct_id, quantity: qty });
                });

                console.log(cartItems);
            @else
                $('.vari_checkbox:checked').each(function() {
                    var $checkbox = $(this);
                    var $showVariations = $checkbox.closest('.option_vals').find('.show_variations');
                    var qty = parseInt($showVariations.find('.customQty').val());
                    var price = parseFloat($checkbox.data('price'));
                    var pdct_id = parseInt($checkbox.data('id'));
                    cartItems.push({ price: price, pdct_id: pdct_id, quantity: qty });
                });

                console.log(cartItems);
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

                $.ajax({
                    url: '{{url('basket/add')}}',
                    type: 'GET',
                    data: { price: price, pdct_id: pdct_id, quantity: quantity },
                    success: function(response) {
                        if (response.result == 1) {
                            $('.cart-icon .cart-count').html(response.cart_count);
                        } else {
                            alert('Error');
                        }
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
                        window.location.href = '/category';
                    }
                });
            }
        }

        // Start sending the cart data
        sendCartData();
    });
@endif


        
    //////////////////////////////////////////////////////////////////////////////////////////////////////    
        
        
   $('body').on('click mouseenter', '.show_variations', function(event) {
        var $this           = $(this);
        var $childDiv       = $this.find('.child_div');
        var $childDivchild  = $this.find('.child_div_child');
        var $childQnty      = $this.find('.child_qnty');
        var optionId        = $this.data('option');
        
        $('.child_div').not($childDiv).hide();
        $('.child_div_child').not($childDivchild).hide();
        $('.child_qnty').not($childQnty).hide();
        
        if (event.type === 'click' && $(event.target).closest('.child_div').length > 0) {
            $this.addClass('active');
            $('#checkbox_option_rounded_' + optionId).prop('checked', true);
            // Clicked inside child_div, do not toggle
            return;
        }
        
        if (event.type === 'click') {
            $this.addClass('active');
            $('#checkbox_option_rounded_' + optionId).prop('checked', true);
        }
         
        $childDiv.show();
        $childQnty.show();
        $childDivchild.show();
        calculateItems()
        
    });
    
    $(document).on('mouseleave', '.product__variations', function(event) {
        var $relatedTarget = $(event.relatedTarget);
        var $container = $(this);
    
        if (!$container.is($relatedTarget) && !$container.has($relatedTarget).length) {
            var firstChecked = $container.find('.vari_checkbox:checked').last();
            if (firstChecked.length > 0) {
                 var optionId = firstChecked.attr('data-option');
    
                $('.child_div').hide();
                $('.show_variations').find('.child_qnty').hide();
                $('#show_variations_'+optionId).addClass("active");
                $('#show_variations_'+optionId).find('.child_qnty').show();
                $('#child_div_'+optionId).show();
            }
        }
        calculateItems()
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
                $('.show_variations').find('.child_qnty').hide();
                $('#show_variations_'+option_id).addClass("active");
                $('#show_variations_'+option_id).find('.child_qnty').show();
                $('#child_div_'+option_id).show();
                $(this).find('.third_section').show();
                
            }
            else
            {  
                $('#show_variations_'+option_id).removeClass('active');  
            }
        }
        else
        {
            $(this).prop('checked', true);
            $('.child_div').hide();
            $('.show_variations').find('.child_qnty').hide();
            $('#show_variations_'+option_id).addClass("active");
            $('#show_variations_'+option_id).find('.child_qnty').show();
            $('#child_div_'+option_id).show();
        }
        calculateItems()
    });
    
    $(document).on('click', '.child_div_type', function() {
        $(this).find('.round-radio input[type="radio"]').prop('checked', true);
        calculateItems()
    });
    
    
         calculateItems()
    function calculateItems(){
        var checkedCount = $('.vari_checkbox:checked').length;
        var totalQty = 0;
        var totalPrice = 0;
          //total qty numbers
        $('.vari_checkbox:checked').each(function() {
            var $checkbox = $(this);
            var $showVariations = $checkbox.closest('.option_vals').find('.show_variations');
            var qty = parseInt($showVariations.find('.customQty').val());
            var price = parseFloat($showVariations.find('.option__type:checked').data('price'));
    
            totalQty += qty;
          //total price each qty * price
          
            totalPrice += qty * price;
        });
    
    
          //total checkbox checked
        $('.ttl_item').text(checkedCount);
        $('.ttl_qty').text(totalQty);
        $('.ttl_price').text(totalPrice);
    
    }
     
    //////////////////////////////////////////////////////////////////////////////////////////////        
    </script>
@if(!$basket_items)
<script>
//   $(document).ready(function() {
//     $('#order-btn').attr('data-bs-backdrop', 'static')
//         .attr('data-bs-keyboard', 'false')
//         .modal('show');
//     $('#order-btn .close_button').hide();    
        
//   });
</script>
@endif

@endsection
