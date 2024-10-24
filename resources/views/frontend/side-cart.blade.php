@if(count($items)>0)
           
            <div class="for-count-item">
                <div id="cart-button" class="float-button cursor-pointer">
                    <span class="cart-count justify-content-center">{{getCartCount()}}</span>
                    <span class="cart-icon"><i class="bi bi-cart-check"></i></span>
                </div>
                <div id="cart" class="cart-panel">
                    <button id="close-button" class="border-0"><i class="bi bi-x-circle"></i></button>
                    <h3 class="cart-title">Cart</h3>
                    <div class="side-cart-product">
                        @foreach($items as $listing)
                         @if($listing->product_variation)
                            <div class="cart-item ps-1 pe-1">
                                <div class="cart-item-image position-relative">
                                    <img onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';" src="{{asset('images/products/'.$listing->picture)}}" width="100" alt="{{$listing->product_name}}" class="rounded-start-circle">
                                    <span class="item-count-addon">{{$listing->quantity}}</span>
                                </div>
                                <div class="cart-item-details ps-2">
                                    <h4 class="p_name cart-item-title">{{$listing->product_name}}</h4>
                                    @if($listing->variation)
                                        <small>{{$listing->variation}}</small>
                                    @endif
                                      <br>
                                    @php
                                        if($listing->has_special_price == 1){
                                            $checkSpecialPrice    = $listing->product->has_special_price == 1 && $listing->product->special_price_from <= date('Y-m-d') && $listing->product->special_price_to >= date('Y-m-d');   
                                            
                                            if(!$checkSpecialPrice && $listing->product->has_special_price == 1)
                                            {
                                                \App\Models\Item::where('id',$listing->id)->update(['has_special_price' => 0,'price_amount' => $listing->product->price,'special_price_from' => null,'special_price_to' =>null]);
                                            }
                                            $listing->refresh();
                                        }
                                        else{
                                            $checkSpecialPrice = false;
                                        }
                                        $price = $listing->price_amount;
                                            
                                    @endphp
                                        
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
                                      
                                       <span class="cart-item-price Item_total"> <span class="fw-bold text-theme">{{getPrice($price)}}</span> (<strike>{{getPrice($listing->actual_price)}}</strike>) <span class="text-danger">{{$discountType}}</span></small> <br>
                                    @endif
                                    <span class="cart-item-price Item_total fw-bold d-none">{{getPrice($listing->price_amount * $listing->quantity)}}</span>
                                </div>
                                <button class="delete-btn" data-pname="{{$listing->product_name}}" data-psku="{{$listing->product_sku}}" data-pid="{{$listing->product_variation_id}}"  data-price="{{$listing->price_amount}}"><i class="bi bi-trash"></i></button>
                            </div>
                            @php
                                $subtotal = $listing->price_amount * $listing->quantity;
                                $totalAmount += $subtotal;
                            @endphp
                        @else
                              @php \App\Models\Item::where('id',$listing->id)->delete(); @endphp
                        @endif
                     
                    @endforeach
                    </div>
                    
                    <div class="subtotal text-end" id="total-amount">
                        <span>Subtotal:</span> <span>{{getPrice($totalAmount)}}</span>
                         
                    </div>
                    <div class="sub-checkout">
                        <span><a class=" text-dark" href="/cart">View Cart</a></span>
                    </div>
                </div> 
            </div>
        @endif