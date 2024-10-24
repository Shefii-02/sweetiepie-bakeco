@extends('layouts.frontend')
    @section('styles')
        <style>
        .element-error::after {
            width:100% !important;
        }
        #loader-overlay {
            position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.7);
          display: flex;
          justify-content: center;
          align-items: center;
          z-index: 9999;
        }
        
        .loader {
          border: 6px solid #f3f3f3;
          border-top: 6px solid #3498db;
          border-radius: 50%;
          width: 50px;
          height: 50px;
          animation: spin 2s linear infinite;
        }
        
        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }
    
    
        .hidden-div::before {
            left: 20% !important;
            top: -20px !important;
        }
        
        @media only screen and (max-width: 768px) {
            .hidden-div {
                left: 0px !important;
                transform: translateX(-5%) !important;
            }
        }
    </style>
       
    @endsection

@section('contents')
 
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Cart</h1>
                </div>
            </div>
        </div>
    </section>
     @php
        $totalAmount = 0;
    @endphp
    
    @if(isset($items) && $items->count() > 0)
                @php
                    $hasPreOrderProduct = $items->first(function ($item, $key) {
                        return $item['pre_order'] === 1;
                    });
             
                @endphp
                
                @if($hasPreOrderProduct)
                    @php        
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
                        sort($temp_array);
                        $start_date =  reset($temp_array);
                        $end_date   = end($temp_array);
                    @endphp
                @endif
    <section class="cart-bale page_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                        <table class="table table-bordered">
                            <thead class="ir-table">
                                <tr>
                                    <th scope="col" >Product</th>
                                    <th scope="col" >Price</th>
                                    <th scope="col" >Quantity</th>
                                    <th scope="col" >Total</th>
                                    <th scope="col" ></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $listing)
                                
                                    @if($listing->product_variation)
                                   
                                        @php
                                            if($listing->has_special_price == 1){
                                                $checkSpecialPrice    = $listing->product->has_special_price == 1 && $listing->product->special_price_from <= date('Y-m-d') && $listing->product->special_price_to >= date('Y-m-d');   
                                                if(!$checkSpecialPrice && $listing->product->has_special_price == 1)
                                                {
                                                    \App\Models\Item::where('id',$listing->id)
                                                                    ->update(['has_special_price' => 0,
                                                                             'price_amount' => $listing->product_variation->price,
                                                                             'special_price_from' => null,
                                                                             'special_price_to' =>null]);
                                                }
                                            }else{
                                                $checkSpecialPrice = false;
                                            }
                                                
                                            $listing->refresh();
                                            $price = $listing->price_amount;
                                                
                                        @endphp
                                        
                                        <tr class="cart-item position-relative" data-pname="{{$listing->product_name}}" data-psku="{{$listing->product_sku}}" data-pid="{{$listing->product_variation_id}}"  data-price="{{$price}}">
                                        <th scope="row" data-pname="{{$listing->product_name}}" data-psku="{{$listing->product_sku}}" data-pid="{{$listing->product_variation_id}}"  data-price="{{$price}}">
                                            <div class="t-h">
                                                <img src="{{asset('images/products/'.$listing->picture)}}" onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';" width="100" alt="">
                                                <div class="product-detail-cart d-flex flex-column">
                                                    <p class="mb-0">{{$listing->product_name}}<br>
                                                    <small>{{$listing->variation}}</small></p>
                                                    @if($listing->customized_product == 1)
                                                        <div class="customized_details fw-normal p-0 mt-1">
                                                             <small class="hover-container"><span class="bi bi-info-circle cursor-pointer"> Customization Details</span>
                                                                <div class="hidden-div fw-normal mb-5 p-3 rounded shadow-lg">
                                                                    <div class="d-flex flex-column">
                                                                        <small>Flavor: {{$listing->customized_flavor}}</small>
                                                                        <small>Border Color: {{$listing->customized_border_color}}</small>
                                                                        <small>Text Color: {{$listing->customized_text_color}}</small>
                                                                        <small>Message: {{$listing->customized_message}}</small>
                                                                    </div>
                                                                </div>
                                                            </small>
                                                        </div>
                                                    @endif
                                                    @if($checkSpecialPrice)
                                                        @php
                                                            if($listing->product->discount_type == 'percentage')
                                                            {
                                                                $discountPercentage = (($listing->actual_price - $listing->price_amount) / $listing->actual_price * 100);
                                                                $roundedPercentage = number_format($discountPercentage, 1);
                                                                $firstDecimal = substr($roundedPercentage, -1, 1);
                                                                
                                                                if ($firstDecimal > 0) {
                                                                    $discountType = getPrice($listing->actual_price - $listing->price_amount) . " OFF";
                                                                } else {
                                                                    $discountType = intval($roundedPercentage) . '% OFF';
                                                                }
                                                            }
                                                            else{
                                                                $discountType = getPrice($listing->actual_price - $listing->price_amount)." OFF";
                                                            }
                                                        @endphp
                                                       <small class="text-body-tertiary"> <span class="fw-bold text-theme">{{getPrice($price)}}</span> (<strike>{{getPrice($listing->actual_price)}}</strike>) <span class="text-danger">{{$discountType}}</span></small> 
                                                    @endif
                                                </div>
                                            </div>
                                        </th>
                                       
                                        
                                        <td data-pname="{{$listing->product_name}}" data-psku="{{$listing->product_sku}}" data-pid="{{$listing->product_variation_id}}"  data-price="{{$price}}">
                                           
                                            <div class="price">
                                                {{getPrice($price)}}
                                                
                                            </div>
                                            <input class="item-amount" type="hidden" value="{{$price}}">
                                        </td>
                                        <td data-pname="{{$listing->product_name}}" data-psku="{{$listing->product_sku}}" data-pid="{{$listing->product_variation_id}}"  data-price="{{$price}}">
                                            <div class="quantity">
                                                <div class="qty-input">
                                                    <button class="qty-count qty-count--minus" data-action="minus"
                                                        type="button">-</button>
                                                    <input class="product-qty item-quantity" data-pname="{{$listing->product_name}}" data-psku="{{$listing->product_sku}}" data-pid="{{$listing->product_variation_id}}"  data-price="{{$price}}" type="number" name="product-qty" min="0" 
                                                        value="{{$listing->quantity}}">
                                                    <button class="qty-count qty-count--add" data-action="add"
                                                        type="button">+</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-pname="{{$listing->product_name}}" data-psku="{{$listing->product_sku}}" data-pid="{{$listing->product_variation_id}}"  data-price="{{$price}}">
                                            <div class="Item_total">
                                                {{getPrice($price * $listing->quantity)}}
                                            </div>
                                        </td>
                                        <td >
                                            <div class="item_remove cursor-pointer" data-preorder="{{$listing->pre_order}}" data-pname="{{$listing->product_name}}" data-psku="{{$listing->product_sku}}" data-pid="{{$listing->product_variation_id}}"  data-price="{{$price}}">
                                                <i class="bi bi-x-circle-fill"></i>
                                            </div>
                                        </td>
                                    </tr>
                                        @php
                                            $subtotal = $price * $listing->quantity;
                                            $totalAmount += $subtotal;
                                        @endphp
                                    @else
                                          @php \App\Models\Item::where('id',$listing->id)->delete(); @endphp
                                    @endif
                                    
                                @endforeach
                            </tbody>
                        </table>
                        <div class="t-price pt-2">
                            <div class="row">
                                <div class="col-12">
                                    <h3 id="total-amount">Total: {{getPrice($totalAmount)}}</h3>
                                </div> 
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
  

    
    <section class="allergies pb-3 pb-md-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 mb-3 mb-md-0">
                    <p>
                       Allergies? Let us know so we can be super careful! Please note, however, that we cannot substitute any of the ingredients in our pies and baked goods.
                    </p>
                    <textarea class="a-textarea" name="remark" id="remark" form="goto_checkout">{{$basket->remarks}}</textarea>
                </div>
                <div class="col-12 col-md-6">
                    
                    @php
                    $basket_date = '';
                    if($basket->serve_date != ''  && date('Y-m-d',strtotime($basket->serve_date))> date('Y-m-d')){
                        if(($hasPreOrderProduct) && $end_date > $basket->serve_date){
                            $basket_date = $basket->serve_date;
                        }
                        else
                        {
                            $basket_date = $basket->serve_date;
                        }
                    }   
                    @endphp
                    
                    @if($basket->order_type == 'pickup')
                  
                        @php
                         $pickup_store          = App\Models\Store::with('store_timing', 'holidaytiming', 'holidaytiming.holiday')->where('status',1)->where('id', $basket->pickup_id)->first();
                            
                        @endphp
                        <p class="ir-p mb-1">Please enter pickup details below</p>
                            @if($pickup_store)
                        <form action="{{url('cart/get_addons')}}" method="POST" id="goto_checkout"  data-callback="addon_complete"  data-classes="goto_checkout" class="row" novalidate>
                            @csrf() 
                            <div class="form-group col-lg-12 mb-2" >
                                 @if($basket->special_campaign == 0 || session()->has('afflicate_id'))
                                <label class="text-dark mb-2">Location : </label> 
                                <span data-bs-toggle="modal" data-bs-target="#PickupModalToggle" data-href="" class="order_now cursor-pointer text-theme">   Change?</span>
                                @endif    <br>
                            
                                <label>Pickup From :</label> <a href="{{$pickup_store->map_link ?? ''}}" target="new_map" class="text-dark text-decoration-none "> 
                                    <label class="fw-semibold cursor-pointer"><span style="font-weight: 800;"> {{$pickup_store->name}}</span>
                                                            {{$pickup_store->address}},
                                                            {{$pickup_store->postal_code}}, 
                                                            {{$pickup_store->city}}, 
                                                            {{$pickup_store->province}}.
                                    </label>
                                </a>
                                <input type="hidden" readonly name="pickup_location" id="pickup_location"  value="{{$pickup_store->id}}">
                               
                            </div>
                            @if($basket->special_campaign == 0 || session()->has('afflicate_id'))
                            <div class="col-lg-6  mb-2">
                                 <div class="input-group form-group ">
                                    <span class="form-control date-input cursor-pointer"  id="date-dropdown-toggle" >{{$basket->serve_date != '' && date('Y-m-d',strtotime($basket->serve_date)) >= date('Y-m-d')  ? date('F d, Y',strtotime($basket->serve_date)) : ''}}</span>
                                    <input type="hidden" id="date-dropdown-toggle-value" form="goto_checkout" value="{{$basket_date}}"
                                     name="pickup_date" class="shipping_date_hidden">
                                    <span class="input-group-text" id="calendar-icon">
                                        <i class="bi bi-calendar-check-fill"></i>
                                    </span>
                                </div>
                                
                            </div>
                            <div class="col-lg-6 mb-2" >
                                <div class="form-group ">
                                    
                                        <select name="pickup_time"  class="form-select"   id="pickup_time" required>
                                           
                                        </select>
                                    <span class="text-danger time_exceeded"></span>
                                </div>
                            </div>
                            @else
                                <input  form="goto_checkout" type="hidden" value="{{$basket->serve_date}}" name="pickup_date" id="date-dropdown-toggle-value">
                                  <input  form="goto_checkout"  type="hidden" value="{{$basket->serve_time}}" name="pickup_time" id="pickup_time">
                                    <span>Pickup date & time : <span class="fw-bold">{{$basket->serve_date != '' && date('Y-m-d',strtotime($basket->serve_date)) >= date('Y-m-d')  ? date('F d, Y',strtotime($basket->serve_date)) : ''}} & {{date('h:i a',strtotime($basket->serve_time))}}</span></span>
                            @endif
                           
                        </form>
                                
                                
                                @if($hasPreOrderProduct)
                                    {!!  ShippingRulePickupBasedCalender($basket->pickup_id,$basket->order_type,$start_date,$end_date,) !!}
                                    <!---------------------------------------LIMITRD PICKUP---------------------------------------------------------------------------------------->
                                    {{--    {!! showPreOrderPickupCalender($start_date,$end_date,session('pickup_id')) !!} --}}
                                    <!------------------------------------------------------------------------------------------------------------------------------------->
                                @else 
                               
                                    {!!  ShippingRulePickupBasedCalender($basket->pickup_id,$basket->order_type) !!}
                                    <!---------------------------------------PICKUP---------------------------------------------------------------------------------------->
                                    {{--    {!! showPickupCalender($basket->pickup_id,$basket->order_type) !!} --}}
                                    <!------------------------------------------------------------------------------------------------------------------------------------->
                                @endif
                                
                    @else
                        <span class="text-danger fw-bold">Currently store is not available</span>
                    @endif
                    @else
                        <p class="ir-p">Please enter delivery details below</p>
                        <form action="{{url('cart/get_addons')}}" id="goto_checkout" method="POST" data-callback="addon_complete" data-classes="goto_checkout" class="row" novalidate>
                            @csrf()
                             <div class="form-group col-lg-12 mb-2" >
                                <label class="text-dark mb-2">Delivery to :   </label>
                                <label class="fw-semibold p-2">{{$basket->city}}</label>
                                <span data-bs-toggle="modal" data-bs-target="#DeliveryModalToggle" data-href="" class="order_now cursor-pointer text-theme">   (Change?)</span>
                            </div>
                            <div class="col-lg-12  mb-2">
                                 <div class="input-group form-group ">
                                    <span class="form-control date-input cursor-pointer"  id="date-dropdown-toggle" >{{$basket->serve_date != ''  && date('Y-m-d',strtotime($basket->serve_date)) > date('Y-m-d') ? date('F d, Y',strtotime($basket->serve_date)) : ''}}</span>
                                    <input type="hidden" id="date-dropdown-toggle-value" value="{{$basket_date}}" name="pickup_date" form="goto_checkout">
                                    <span class="input-group-text" id="calendar-icon">
                                        <i class="bi bi-calendar-check-fill"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        @if($hasPreOrderProduct)
                            <!-------------------------------------DELIEVRY------------------------------------------------------------------------------------------------>
                                    {!! ShippingRuleDeliveryBasedCalender($basket->pickup_id,$basket->order_type,$start_date,$end_date) !!}
                              {{--  {!! showPreOrderDeliveryCalender($start_date,$end_date,session('pickup_id')) !!} --}}
                            <!------------------------------------------------------------------------------------------------------------------------------------->
                        @else
                            {!! ShippingRuleDeliveryBasedCalender($basket->pickup_id,$basket->order_type) !!}
                            <!-------------------------------------LIMITRD DELIEVRY------------------------------------------------------------------------------------------------>
                             {{--   {!! showDeiveryCalender($basket->pickup_id,$basket->order_type) !!}  --}}
                            <!------------------------------------------------------------------------------------------------------------------------------------->
                        @endif
                    @endif
                        
                    @if(($basket->order_type == 'pickup' && $pickup_store) || $basket->order_type != 'pickup')
                        <div class="for-checkout mt-2">
                            <form action="{{url('cart/continue')}}" class="validated, not-ajax" id="cart_continue" method="POST">
                                @csrf()
                                <input type="hidden" id="ctn_serve_date" name="serve_date">
                                <input type="hidden" id="ctn_remark" name="remark" >
                            </form>
                            <input type="submit" form="cart_continue" class="btn btn-sm secondary-btn  continue_shopping_btn" value="Continue Shopping">
                            <input type="submit" form="goto_checkout" class="  btn-sm primary-btn checkout_btn btn " value="Checkout">
                        </div>
                    @endif
                </div>
  
                <div class="col-12 pt-3">
                    <p>Your order will be ready for pickup on your chosen date. Our pies and baked goods are made to order. This means they're always tasty and fresh for you, but also means that online orders cannot be changed or cancelled with less than 36 hours notice. Orders not picked-up by the end of day of the specified pick-up date will be released for sale or donated to charity, without a refund. Please don't hesitate to give us a call if you have any questions. Click here to find the store closest to you.
                    </p>
                </div>
            </div>
        </div>
    </section>
    @else
   <section class="page_section">
        <div class="d-flex justify-content-center align-items-center for-vertical-height">
        <div class="col-md-6">
            <div class=""></div>
            <div class=" bg-white p-5">
                <div class="text-center">
                    <h1 class="ir-h1">    
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                          <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z"/>
                        </svg>  Your cart is empty !</h1>
                        <p>Please add an item to the cart</p>
                        <a href="/products" class="btn  btn-sm primary-btn">Continue shopping</a>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <h3></h3>
    </div>
   </section>
    @endif
    
 
    
    <!-- Modal -->
<div class="modal fade" id="addon_products" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addon_productslabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addon_productslabel">Addons to your order</h5>
                <div class="text-end">
                    <h4 class=" text-primary-emphasis fw-bolder">Grand Total : <span class="addon_grandtotal">{{getPrice($totalAmount)}}</span></h4>
                </div>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body" id="addon__products">
                        
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="  btn btn-sm secondary-btn " data-bs-dismiss="modal">Close</a>
                <a href="/checkout" class="btn  btn-sm primary-btn">Go to Checkout</a>
            </div>

        </div>
    </div>
</div>

@endsection

@section('scripts')
   
    <script>
        var QtyInput = (function () {
            var $qtyInputs = $(".qty-input");
    
            if (!$qtyInputs.length) {
                return;
            }
    
            var $inputs = $qtyInputs.find(".product-qty");
            var $countBtn = $qtyInputs.find(".qty-count");
            var qtyMin = parseInt($inputs.attr("min"));
            var qtyMax = parseInt($inputs.attr("max"));
    
            $inputs.change(function () {
                var $this = $(this);
                var $minusBtn   = $this.siblings(".qty-count--minus");
                var $addBtn     = $this.siblings(".qty-count--add");
                var qty         = parseInt($this.val());
    
                if (isNaN(qty) || qty <= qtyMin) {
                    $this.val(qtyMin);
                    $minusBtn.attr("disabled", true);
                } else {
                    $minusBtn.attr("disabled", false);
    
                    if (qty >= qtyMax) {
                        $this.val(qtyMax);
                        $addBtn.attr('disabled', true);
                    } else {
                        $this.val(qty);
                        $addBtn.attr('disabled', false);
                    }
                }
            });
    
            $countBtn.click(function () {
                var operator = this.dataset.action;
                var $this = $(this);
                var $input = $this.siblings(".product-qty");
                var qty = parseInt($input.val());
    
                if (operator == "add") {
                    qty += 1;
                    if (qty >= qtyMin + 1) {
                        $this.siblings(".qty-count--minus").attr("disabled", false);
                    }
    
                    if (qty >= qtyMax) {
                        $this.attr("disabled", true);
                    }
                } else {
                    qty = qty <= qtyMin ? qtyMin : (qty -= 1);
    
                    if (qty == qtyMin) {
                        $this.attr("disabled", true);
                    }
    
                    if (qty < qtyMax) {
                        $this.siblings(".qty-count--add").attr("disabled", false);
                    }
                }
    
                $input.val(qty);
                $('.item-quantity').trigger('change');
            });
        })();
        
        
        
        $(window).on("load", function () {
          $("#loader-overlay").fadeOut("slow");
        });

        $('body').on('change','.item-quantity', async function() {
            
            var item = $(this).closest('.cart-item');
            var quantity = $(this).val();
            var product_sku = $(this).data('psku');
            var product_id  = $(this).data('pid');
            var product_price = $(this).data('price');
           
            await update_products(product_sku,product_id,product_price,quantity);
           
                var price = parseFloat(item.find('.item-amount').val());
                var amount = price * quantity;
                
                item.find('.Item_total').text('$'+amount.toFixed(2));
                 if(quantity <= 0){
                    item.remove();
                      
                    if ($('.cart-item').length === 0) {
                  
                       location.reload();
                    }
                 }
                var totalAmount = 0;
                $('.Item_total').each(function() {
                    totalAmount += parseFloat($(this).text().replace('$', ''));
                });
                $('#total-amount').text('Total: $' + totalAmount.toFixed(2));
                $('.addon_grandtotal').text('$' + totalAmount.toFixed(2))
            
        });
        
        
        $('body').on('click','.item_remove', async function() {
            var item            = $(this).closest('.cart-item');
            var quantity        = $(this).val();
            var product_sku     = $(this).data('psku');
            var product_id      = $(this).data('pid');
            var product_price   = $(this).data('price');
            var preorder        = $(this).data('preorder')
            
            item.remove();
            
            await update_products(product_sku,product_id,product_price,0);
       
            var totalAmount = 0;
            
            $('.Item_total').each(function() {
                totalAmount += parseFloat($(this).text().replace('$', ''));
            });
            
            $('#total-amount').text('Total: $' + totalAmount.toFixed(2));
            $('.addon_grandtotal').text('$' + totalAmount.toFixed(2));
            
            if ($('.cart-item').length === 0 || preorder == 1) {
                location.reload();
            }
            
            
        });




        $('body').on('submit','#cart_continue', function(e) {
            var pickup_date      = $('#date-dropdown-toggle-value').val();
            var remark           = $('#remark').val();
            $('#ctn_serve_date').val(pickup_date);
            $('#ctn_remark').val(remark);
        });

        $('body').on('submit','.goto_checkout', function(e) {
            
            var pickup_location  = $('#pickup_location').val();
            var pickup_date      = $('#date-dropdown-toggle-value').val();
            var pickup_time      = $('#pickup_time').val();
            var remark           = $('#remark').val();
            e.preventDefault();
            
                $.ajax({
                    url: '/cart/get_addons', 
                    method: 'GET',
                    data:{pickup_location : pickup_location,pickup_date : pickup_date,pickup_time : pickup_time,remark : remark},
                    success: function(response) {
                        // success
                        if(response['success'] == 0){
                            window.location="/checkout";
                 
                        }
                        else{
                            $('#addon_products').modal('show')
                            $('#addon__products').html(response['html'])
                        }
                        
                    },
                    error: function(xhr, status, error) {
                           alertJsFunction(status, 'error');
                        //  alert('something went wrong please try again')
                    }
                });
        });


        const body = $('body');
       async function update_products(product_sku,product_id,product_price,quantity) {
            body.append(`<div class="product-loading"><i class="bi bi-arrow-clockwise"></i></div>`);
            await $.ajax({
                url: '/cart/productadd', 
                method: 'GET', 
                dataType: 'json',
                data: {'product_sku': product_sku,'product_id': product_id,'quantity': quantity,'price'   : product_price},
                success: function(response) {
                    
                    $('.cart-icon .cart-count').html(response.cart_count)
                    body.find('.product-loading').remove();
                    
                    
                    var addToCartData = response.addToCartData;
                    console.log(addToCartData);
                    if(quantity > 0){
                        gtag("event", "add_to_cart", addToCartData);
                    }
                    else{
                        gtag("event", "remove_from_cart", addToCartData);
                    }
                },
                error: function(xhr, status, error) {
                    
                           alertJsFunction(status, 'error');
                    //  alert('something went wrong please try again')
                    // body.find('.product-loading').remove();
                }
            });
            return true;
        }
        
   
   
       
        $('body').on('click', '.addon-pdct-btn', function() {
 
            var price    = $(this).attr('data-price');
            var pdct_id  = $(this).attr('data-pid');
            var parent_id  = $(this).attr('data-parent_id');
            var isChecked = $(this).is(":checked");
            if (isChecked) {
                var quantity = 1;
            }
            else
            {
                var quantity = 0;
            }
            
            $.ajax({
                url: `{{url('basket/add')}}`,
                type: 'GET',
                data: { price: price,pdct_id: pdct_id,quantity : quantity,parent_id:parent_id},
                success: function(response) {
                    if (isChecked) {
                        $(".alert__msg_"+pdct_id).html(`<span class="bg-success fw-bold p-1">Item Added</span>`)
                        var GtotalAmount  = parseFloat($('.addon_grandtotal').text().replace('$', ''));
                        GtotalAmount = GtotalAmount + parseFloat(price)
                        $('.addon_grandtotal').text('$' + GtotalAmount.toFixed(2))
                        
                    }
                    else
                    {
                        $(".alert__msg_"+pdct_id).html(`<span class="bg-danger fw-bold p-1">Item Removed</span>`)
                        var GtotalAmount  = parseFloat($('.addon_grandtotal').text().replace('$', ''));
                        GtotalAmount = GtotalAmount - parseFloat(price)
                        $('.addon_grandtotal').text('$' + GtotalAmount.toFixed(2))
                    }
                    
                }
            });
        });
   

    </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <script>
        function addon_complete($form, response){
                   
            $form.addClass($form.attr('data-classes'));
            $form.submit();
        }
        
  
        $(document).ready(function() {               
            // Toggle calendar dropdown on button click
          
            $('body').on('click','#date-dropdown-toggle', function() {
                $('#calendar-dropdown').toggleClass('d-none');
            });
            
             $(document).click(function(event) {
                var target = $(event.target);
                if (!target.closest('#calendar-dropdown').length && !target.is('#date-dropdown-toggle')) {
                  $('#calendar-dropdown').addClass('d-none');
                  $('.month-1').addClass('d-none');
                  $(".show-more-dates").text('More dates');
                }
              });

            $('body').on('click','.valid_date', function(e) {
                e.preventDefault();
                var selectedDate     =  $(this).data('date');
                var availableTime_on =  $(this).data('start');
                var availableTime_to =  $(this).data('end');
              
                $('.month-1').addClass('d-none');$(".show-more-dates").text('More dates');
                
                 // Format the date using Moment.js
                var formattedDate = moment(selectedDate).format('MMMM D, YYYY');
        
                $('.date-input').text(formattedDate);
                
                $('#date-dropdown-toggle-value').val(selectedDate);
                $('#calendar-dropdown').addClass('d-none');
                
                pickuptimeListing(availableTime_on,availableTime_to)
              
            });
            
            if($('#date-dropdown-toggle-value').val() == ''){
         
               $('.valid_date:first').click();
            }
            else
            {
               
                        var dateBase = $('.shipping_date_hidden').val();
                        $('.valid_date').each(function() {
                            var selectedDate     =  $(this).data('date');
                            if( selectedDate == dateBase){
                                var availableTime_on =  $(this).data('start');
                                var availableTime_to =  $(this).data('end');
                                pickuptimeListing(availableTime_on,availableTime_to);
                            }
                        });
                    
            }
            
            
        
            $(".show-more-dates").click(function(e) {

                $('.month-1').toggleClass('d-none');
                e.preventDefault();
    
               
                var text = $(this).text();
    
               if (text === 'Less dates') { 
                    $(this).text('More dates'); 
                } else {
                    $(this).text('Less dates'); 
                }

            })
              
              
            function convert12HourTo24Hour(time12Hour) {
                return moment(time12Hour, 'hh:mm A').format('HH:mm');
            }
            
            function pickuptimeListing(startTime, endTime) {
            
                var interval = 15; // 15 minutes
                var options = '';
            
                // Parse the start and end times using Moment.js
                var startDate = moment(startTime, 'HH:mm');
                var endDate = moment(endTime, 'HH:mm');
                
                if(startDate <= endDate){
                    while (startDate <= endDate) {
                        var time12Hour = startDate.format('hh:mm A'); // Format as 12-hour time with AM/PM
                        var time24Hour = convert12HourTo24Hour(time12Hour); // Convert to 24-hour format
                
                        options += '<option value="' + time24Hour + '">' + time12Hour + '</option>';
                
                        // Increment time by 15 minutes
                        startDate.add(interval, 'minutes');
                    }
                }
                else
                {
                    $('.time_exceeded').html('Time exceeded please choose another date');
                }
                
                
            
                $('#pickup_time').html(options);
                
                @if(isset($basket))
                    @if($basket->serve_time != NULL)
                        var time = moment(`{{$basket->serve_time}}`, 'HH:mm').format('HH:mm');
                        $('#pickup_time').val(time)     
                    @endif
                @endif
            }


            
        });
        
        
        
        $(document).ready(function() {
            $('.hover-container').mousemove(function(e) {
                const x = e.pageX - $(this).offset().left;
                const y = e.pageY - $(this).offset().top;
        
                $(this).find('.hidden-div').css({
                  display: 'block',
                });
            });
        
            $('.hover-container').mouseleave(function() {
                $(this).find('.hidden-div').css('display', 'none');
            });
        });

    </script>
@endsection
