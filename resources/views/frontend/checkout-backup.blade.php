
@extends('layouts.only-logo')
@section('styles')

@endsection
@php
    $basket = GetBasket();
@endphp
                    
@section('contents')
    <section class="product-listing-banner checkoutbanner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="">Checkout</h1>
                </div>
            </div>
        </div>
    </section>

       
   <section class="page_section checkout-overlay">
    <div class="container-lg">
        <div class="main-content checkout-main-content">
        @if (auth()->check() || !empty($basket->email))
        @else
            <div class="overlay"></div>
        @endif
        <div class="row billing">

            <div class="col-md-8">

                <form action="{{ url('place-order') }}" method="POST" id="place__order" novalidate>
                    @if (auth()->check() || !empty($basket->email))
                        @csrf()
                    @else
                    @endif
                    <div class="card">
                        <div class="card-header " id="billingHeading">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="mb-0">Billing Address</h2>
                                </div>
                            </div>
                        </div>
                        <div id="billingCollapse" class="collapse show" aria-labelledby="billingHeading"
                            data-parent="#billingAccordion">
                            <div class="card-body">
                                @if (auth()->check())
                                    <div class="card">
                                        <h5 class="card-header">My Address</h5>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush">
                                                @php
                                                    $nonBase = 0;
                                                @endphp

                                                @foreach (App\Models\Myaddress::whereUserId(auth()->user()->id)->orderBy('base','DESC')->get() as $item)
                                                @php
                                                    if($item->base == 1 && $nonBase == 0){
                                                        $defaultChecked = true;
                                                        $nonBase = 1;
                                                    }
                                                 @endphp
                                                    <li class="list-group-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input BillingAdress" type="radio"
                                                                name="billing_address" value="{{ $item->id }}"
                                                                id="BillingRadioaddress{{ $item->id }}" @if($item->base == 1) checked @endif >
                                                            <p class="form-check-label"
                                                                for="BillingRadioaddress{{ $item->id }}">
                                                                <small
                                                                    class="fw-bolder h6">{{ $item->firstname . ' ' . $item->lastname }}</small>
                                                                <small
                                                                    class="fw-bolder h6">{{ $item->address }}, {{ $item->postalcode . ', ' . $item->city }}, {{ $item->province . ', ' . $item->country }}</small>
                                                            </p> 
                                                        </div>
                                                    </li>
                                                @endforeach
                                                <li class="list-group-item"><a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#newAddressModal"><i class="fa fa-plus"></i> Add
                                                        a new address</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <div class="row address-form">
                                        <div class="col-lg-6 form-group mb-3">
                                            <label for="">First name</label>
                                            <input class="form-control" autocomplete="off" type="text" value="{{old('b_firstname')}}"
                                                id="b_firstname" name="b_firstname" placeholder="" required>
                                        </div>
                                        <div class="col-lg-6 form-group mb-3">
                                            <label for="">Last name</label>
                                            <input class="form-control" autocomplete="off" type="text"  value="{{old('b_lastname')}}"
                                                name="b_lastname" id="b_lastname" placeholder="">
                                        </div>

                                        <div class="col-lg-6 form-group mb-3">
                                            <label for="">Email</label>
                                            <input
                                                class="form-control"
                                                type="email"
                                                id="b_email"
                                                name="b_email"
                                                placeholder="Enter your email"
                                                value="{{ old('b_email') ?? ($basket ? $basket->email : '') }}"
                                                required
                                                autocomplete="off"
                                            >

                                        </div>

                                        <div class="col-lg-6 form-group mb-3">
                                            <label for="">Phone Number</label>
                                            <input class="form-control phone_field" autocomplete="off" type="text"  value="{{old('b_phone')}}"
                                                name="b_phone" id="b_phone" placeholder="" maxlength="14" required>
                                        </div>
                                        <div class="col-lg-6 form-group mb-3">
                                            <label for="">Address</label>
                                            <input class="form-control address_fill" autocomplete="off" type="text"  value="{{old('b_address')}}"
                                                name="b_address" id="b_address" placeholder="" required>
                                        </div>
                                        <div class="col-lg-6 form-group mb-3">
                                            <label for="">Postal Code</label>
                                            <input class="form-control postalCode_fill" autocomplete="off" type="text"  value="{{old('b_postal')}}"
                                                name="b_postal" id="b_postal" placeholder="" maxlength="7" required>
                                        </div>
                                        <div class="col-lg-6 form-group mb-3">
                                            <label for="">City</label>
                                            <input class="form-control city_fill" autocomplete="off" type="text" name="b_city"   value="{{old('b_city')}}"
                                                id="b_city" placeholder="" required>
                                        </div>
                                        <div class="col-lg-6 form-group mb-3">
                                            <label>Province</label>
                                            <select name="b_province" class="form-control province_fill" id="b_province">
                                                    @foreach ($province as $province_items)
                                                        <option value="{{ $province_items->name }}" @if(old('b_province') == $province_items->code) selected @endif>
                                                            {{ $province_items->name }}
                                                        </option>
                                                    @endforeach

                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if ($basket->order_type != 'pickup')
                            <div class="col-lg-12 ps-3 mb-3">
                                <input type="checkbox" id="same-address-checkbox" name="same_billing" value="1"
                                    onchange="toggleShippingAddress()">
                                <label for="same-address-checkbox">Use an alternate address for delivery</label>
                            </div>

                            <div id="shipping-address-div" style="display: none;">
                                <div class="card-header " id="shippingHeading">
                                    <div class="row">
                                        <h2 class="col-6">Delivery Address</h2>
                                    </div>
                                </div>
                                <div id="shippingCollapse" class="collapse show" aria-labelledby="shippingHeading"
                                    data-parent="#shippingAccordion">
                                    <div class="card-body">
                                        @if (auth()->check())
                                            <div class="card">

                                                <div class="card-body">
                                                    <ul class="list-group list-group-flush">
                                                        @foreach (App\Models\Myaddress::whereUserId(auth()->user()->id)->get() as $item)
                                                            <li class="list-group-item">
                                                                <div class="form-check">
                                                                    <input class="form-check-input shippingAddress" type="radio"
                                                                        name="shipping_address"
                                                                        value="{{ $item->id }}"
                                                                        id="shippingRadioaddress{{ $item->id }}"
                                                                        checked>
                                                                    <label class="form-check-label"
                                                                        for="shippingRadioaddress{{ $item->id }}">
                                                                        <small
                                                                            class="fw-bolder h6">{{ $item->firstname . ' ' . $item->lastname }}</small>
                                                                        <small
                                                                            class="fw-bolder h6">{{ $item->address }}, {{ $item->postalcode . ', ' . $item->city }}, {{ $item->province . ', ' . $item->country }}</small>
                                                                    </label>
                                                                </div>
                                                            </li>
                                                        @endforeach
                                                        <li class="list-group-item"><a href="#"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#newAddressModal"><i
                                                                    class="fa fa-plus"></i> Add a new address</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @else
                                            <div class="row address-form">
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label for="">First name</label>
                                                    <input class="form-control" autocomplete="off" type="text"   value="{{old('s_firstname')}}"
                                                        id="s_firstname" name="s_firstname" placeholder="">
                                                </div>
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label for="">Last name</label>
                                                    <input class="form-control" autocomplete="off" type="text"   value="{{old('s_lastname')}}"
                                                        name="s_lastname" id="s_lastname" placeholder="">
                                                </div>

                                                <div class="col-lg-6 form-group mb-3">
                                                    <label for="">Email</label>
                                                    <input class="form-control" autocomplete="off"   value="{{old('s_email')}}"
                                                        type="email"name="s_email" id="s_email" placeholder="" >
                                                </div>

                                                <div class="col-lg-6 form-group mb-3">
                                                    <label for="">Phone Number</label>
                                                    <input class="form-control phone_field" autocomplete="off"   value="{{old('s_phone')}}"
                                                        type="text" name="s_phone" id="s_phone" minlength="10"
                                                        maxlength="10" placeholder="">
                                                </div>
                                                <div class="col-lg-6 form-group mb-3">
                                                    <label for="">Address</label>
                                                    <input class="form-control address_fill" autocomplete="off" type="text"   value="{{old('s_address')}}"
                                                        name="s_address" id="s_address" placeholder="">
                                                </div>

                                                <div class="col-lg-6 form-group mb-3">
                                                    <label for="">Postal Code</label>
                                                    <input class="form-control postalCode_fill" autocomplete="off" type="text"   value="{{old('s_postal')}}"
                                                        name="s_postal" id="s_postal" maxlength="7"
                                                        placeholder="">
                                                </div>

                                                <div class="col-lg-6 form-group mb-3">
                                                    <label for="">City</label>
                                                    <input class="form-control city_fill" autocomplete="off" type="text"   value="{{old('s_city')}}"
                                                        name="s_city" id="s_city" placeholder="">

                                                </div>

                                                <div class="col-lg-6 form-group mb-3">
                                                    <label>Province</label>
                                                    <select name="s_province" class="form-control province_fill" id="s_province">
                                                       @foreach ($province as $province_items)
                                                            <option value="{{ $province_items->name }}" @if(old('s_province') == $province_items->code) selected @endif>
                                                                {{ $province_items->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @endif
                    </div>

                    @if ($basket->order_type == 'pickup')
                    @else
                        @if ($greetingCardproducts->count() > 0)
                            <div class="card mt-3">
                                <div class="card-header" id="giftBox">
                                    <div class="row">
                                        <div class="col-lg-12">
                                             <h2 class="text-left mb-2"><label for="make-gift-checkbox" class="">This is a gift <input type="checkbox" data-bs-toggle="collapse" data-bs-target="#giftBoxDiv" id="make-gift-checkbox" name="make_gift_checkbox" onchange="toggleShippingAddress()"></label></h2>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div id="giftBoxDiv" class="collapse" aria-labelledby="paymentHeading"
                                    data-parent="#giftBoxAccordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group mb-2">
                                                <label for="nameOnCard mb-2" class=" fw-bolder">Enhance your gift with a personalized greeting card</label>
                                                <div class="row">
                                                    @foreach ($greetingCardproducts as $key => $greeting)
                                                        @if ($greeting->product_variation)
                                                            @php
                                                                $greeting_details = $greeting->product_variation->first();
                                                            @endphp
                                                            <div class="col-md-6">
                                                                <div class="for-gift-bag d-flex align-items-center">
                                                                    <div class="gift-bag">
                                                                        <input type="checkbox"
                                                                            id="greeting_card_checkbox{{ $key }}"
                                                                            name="greeting_card[]"
                                                                            class="greeting_card"
                                                                            data-image="{{ asset('images/products/' . product_thumbImage($greeting->id)) }}"
                                                                            data-sku="{{ $greeting_details->sku }}"
                                                                            data-price="{{ $greeting_details->price }}"
                                                                            data-id="{{ $greeting_details->id }}"
                                                                            data-name="{{ $greeting->name }}"
                                                                            value="{{ $greeting_details->sku }}">
                                                                    </div>
                                                                    <div class="gift-box">
                                                                        <img style="width:100px;"
                                                                            onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';"
                                                                            src="{{ asset('images/products/' . product_thumbImage($greeting->id)) }}"
                                                                            alt="Image">
                                                                    </div>
                                                                    <label
                                                                        for="greeting_card_checkbox{{ $key }}">{{ $greeting->name }}
                                                                        <br> ${{ $greeting_details->price }}</label>

                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="cardNumber mb-2" class=" fw-bolder">Customize your card's message</label>
                                                <textarea class="form-control" name="card_msg" autocomplete="off" placeholder="" rows="4">{{old('card_msg')}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($shiiping_method)
                            <input type="hidden" name="shipping_method" value="{{ $shiiping_method->id }}">
                        @endif
                    @endif
                    <div class="card mt-3">
                        <div class="card-header" id="paymentHeading">
                            <h2 class="text-left mb-0">Credit Card Information</h2>
                        </div>
                        <div id="paymentCollapse" class="collapse show" aria-labelledby="paymentHeading"
                            data-parent="#paymentAccordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group mb-2">
                                        <small for="cardNumber mb-2">Card Number</small>
                                        <input type="text" class="form-control" minlength="14" name="cardNumber"   value="{{old('cardNumber')}}"
                                            autocomplete="off" required id="cardNumber" oninput="validateCardNo()"
                                            placeholder="">
                                        <span class="text-danger card-validate" style="display:none"></span>
                                    </div>
                                    <div class="form-group mb-2">
                                        <small for="nameOnCard mb-2">Name on Card</small>
                                        <input type="text" class="form-control" name="nameOnCard"   value="{{old('nameOnCard')}}"
                                            autocomplete="off" required id="nameOnCard" oninput="ValidatecardName()"
                                            placeholder="">
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <small for="expirationDate mb-2">Card Expiry</small>
                                        <input type="text" class="form-control" name="expirationDate"   value="{{old('expirationDate')}}"
                                            autocomplete="off" required id="expirationDate" placeholder="MM/YY"
                                            oninput="validateExpiryDate()">
                                            <span class="error-texting text-danger"></span>
                                    </div>
                                    <div class="form-group col-md-6 mb-2">
                                        <small for="securityCode mb-2">Security Code</small>
                                        <input type="text" class="form-control" name="securityCode"   value="{{old('securityCode')}}"
                                            autocomplete="off" maxlength="3" required id="securityCode"
                                            placeholder="CVV">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
            <div class="col-md-4 ps-md-0">
                @if (isset($items) && $items->count() > 0)
                    <div class="cart-purchased mt-3 mt-md-0">
                        <h2 class="fw-bolder">Order Summary</h2>
                        <hr>
                        @php
                            $totalAmount = 0;
                            $totalTax = 0;
                        @endphp
                        @foreach ($items as $listing)
                            <div class="products-checkout col-12 mb-3 products-cart">
                                <div class="p-c">
                                    <img src="{{ asset('images/products/' . $listing->picture) }}" class="h-100" alt="">
                                    <div class="i-content" style="padding-left: 5px">
                                        <p class="f-h">{{ $listing->product_name }}</p>
                                        <p>Qty: {{ $listing->quantity }} </p>
                                    </div>
                                </div>
                                <div class="val">
                                    <p>{{ getPrice($listing->price_amount * $listing->quantity) }}</p>
                                </div>
                                @php
                                    $subtotal = $listing->price_amount * $listing->quantity;
                                    $totalAmount += $subtotal;
                                    
                                    $productAmount = $listing->price_amount * $listing->quantity;
                                    $taxRatePercentage = $listing->tax_percentage;
                                    
                                    $taxAmount = ($productAmount * $taxRatePercentage) / 100;
                                    $totalTax = $totalTax + $taxAmount;
                                @endphp
                                <input type="hidden" class="p_tax_amount" value="{{ $taxAmount }}">
                            </div>
                            <div class="product_addonItems ps-5">
                                @if ($parentItem = $listing->parentItem)
                                    @foreach ($parentItem as $item_list)
                                        <div class="products-checkout col-12">
                                            <div class="p-c">
                                                <img onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';"
                                                    src="{{ asset('images/products/' . $item_list->picture) }}"
                                                    alt="">
                                                <div class="i-content" style="padding-left: 5px;">
                                                    <p class="f-h">{{ $item_list->product_name }}</p>
                                                    <p>Qty: {{ $item_list->quantity }} </p>
                                                </div>
                                            </div>
                                            <div class="val">
                                                <p>{{ getPrice($item_list->price_amount * $item_list->quantity) }}</p>
                                            </div>
                                            @php
                                                $subtotal = $item_list->price_amount * $item_list->quantity;
                                                $totalAmount += $subtotal;
                                                
                                                $productAmount = $item_list->price_amount * $item_list->quantity;
                                                $taxRatePercentage = $item_list->tax_percentage;
                                                
                                                $taxAmount = ($productAmount * $taxRatePercentage) / 100;
                                                $totalTax = $totalTax + $taxAmount;
                                            @endphp
                                            <input type="hidden" class="p_tax_amount" value="{{ $taxAmount }}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        @endforeach
                        <input type="hidden" value="{{ $totalTax }}" name="TaxAmount"   value="{{old('TaxAmount')}}">
                        <div class="greeting-card ">

                        </div>
                        <span class='w-100 card-alert'></span>
                        <div class="gift-apply">
                            <input type="text" name="gift_code" form="place__order" id="gift_code"
                                placeholder="Gift card or discount code">
                            <button class="gift_card_apply">Apply Coupon</button>
                        </div>
                        <div class="sub-total">
                            <p class="f-h">Subtotal</p>
                            <p class="f-p sub_total" data-price="{{ $totalAmount }}">{{ getPrice($totalAmount) }}
                            </p>
                        </div>
                        <div class="shpping-pickup">
                            @if ($basket->order_type != 'pickup')
                                <p class="f-h">Shipping Charge</p>
                                <p class="f-p shipping_pickup_charge">
                                    {{ getPrice($shiiping_method->charge ?? 0) }}
                                </p>
                            @else
                                <p class="f-p shipping_pickup_charge d-none">
                                    {{ getPrice($shiiping_method->charge ?? 0) }}
                                </p>
                            @endif
                        </div>
                        <div class="sub-total">
                            <p class="f-h">Tax Amount</p>
                            <p class="f-p tax_amount">{{ getPrice($totalTax) }}</p>
                        </div>

                        <div class="sub-total">
                            <p class="f-h">Discount</p>
                            <p class="f-p discount_amount">-{{ getPrice(0) }}</p>
                        </div>

                        <hr>
                        <div class="cart-product-total">
                            <p class="f-h">Total</p>
                            <p class="f-p total_price">
                                @if ($basket->order_type != 'pickup')
                                    @if ($shiiping_method->count() == 1)
                                        {{ getPrice($ttl = $totalAmount + $shiiping_method->charge + $totalTax) }}
                                    @else
                                        {{ getPrice($ttl = $totalAmount + $totalTax + $shiiping_method->charge) }}
                                    @endif
                                @else
                                    {{ getPrice($ttl = $totalAmount + $totalTax) }}
                                @endif

                            </p>
                            <input type="hidden" id="total_price" value="{{ getPrice($ttl) }}">
                        </div>
                    </div>
                @else
                    <div class="col-md-12 text-center">
                        <h6 class="font-bold">The cart is empty</h6>
                    </div>
                @endif
            </div>
            <div class="col-lg-8">
                 @if ($basket)
                    @php $already = App\Models\Subscribe::where('email',$basket->email)->first(); @endphp
                    @if (!$already)
                        <div class="cart-purchased col-md-12 mt-3 ">
                            <div class="form-check">
                                <input class="form-check-input" checked type="checkbox" form="place__order" value="1"
                                    name="promotional_mails" id="flexCheckChecked">
                                <label class="form-check-label" for="flexCheckChecked" style="font-size:85%;">
                                    <strong>Yes, I would like to receive marketing promotional emails from Sweetie Pie and its
                                    sister companies.</strong><br>
                                    By checking this box, I agree to receive marketing communications, exclusive offers,
                                    and updates about products, services, and events from Sweetie Pie and its affiliated
                                    sister companies. I understand that I can unsubscribe at any time by following the
                                    instructions provided in the emails. My data will be handled in accordance with the
                                    privacy policy of Sweetie Pie and its sister companies.
                                </label>
                            </div>
                        </div>
                    @endif
                @endif
                @if(!auth()->check())
                    <div class="form-check mt-3">
                        <input class="form-check-input" checked type="checkbox" form="place__order" value="1"
                            name="clickedSignup" id="clickedSignup">
                        <label class="form-check-label" for="clickedSignup" style="font-size:85%;">
                            <strong>Would you like to create an account using this information?</strong>
                        </label>
                    </div>
                @endif
                <div class="text-start mb-3 me-3 mt-3">
                    <button class="btn  btn-sm primary-btn mt-1"  form="place__order" type="submit">COMPLETE PURCHASE</button>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

@if(auth()->check() || !empty($basket->email)) 
  <!-- Modal -->
    <div class="modal fade checkout-modal" id="newAddressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-between">
                <h5 class="modal-title" id="new_ModalLabel">Add Address</h5>
                <i class="fa fa-times text-dark fa-2x" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            
            <div class="modal-body">
              <form action="{{url('myaccount/address/add')}}" method="POST" id="add_address" class="row address-form">
                  @csrf()
                  <div class="col-lg-6 form-group mb-2">
                      <label class="mb-2" for="">First Name</label>
                      <input type="text" required autocomplete="off"  form="add_address" class="form-control" name="firstname">
                  </div>
                  <div class="col-lg-6 form-group mb-2">
                      <label class="mb-2" for="">Last Name</label>
                      <input type="text" required autocomplete="off"  form="add_address" class="form-control" name="lastname">
                  </div>
                  <div class="col-lg-12 form-group mb-2">
                      <label class="mb-2" for="">Address</label>
                      <input type="text"  autocomplete="off" placeholder=""  class="form-control address_fill" form="add_address" name="address">
                  </div> 
                  <div class="col-lg-6 form-group mb-2">
                      <label class="mb-2" for="">Postal Code</label>
                      <input type="text" required autocomplete="off"  form="add_address" class="form-control postalCode_fill" name="postalcode">
                  </div>
                  <div class="col-lg-6 form-group mb-2">
                      <label class="mb-2" for="">City</label>
                      <input type="text" required autocomplete="off"  form="add_address" class="form-control city_fill" name="city">
                  </div> 
                  <div class="col-lg-6 form-group mb-2">
                      <label class="mb-2" for="">Province</label>
                      <select form="add_address"  class="form-control province_fill" name="province">
                       @foreach ($province as $province_items)
                            <option value="{{ $province_items->name }}" @if(old('province') == $province_items->code) selected @endif>
                                {{ $province_items->name }}
                            </option>
                        @endforeach
                        </select>
                  </div>
                  <div class="col-lg-12 form-group mb-2">
                    <div class="form-check form-switch">
                          <input class="form-check-input" form="add_address" type="checkbox" name="base" id="flexSwitchbase">
                          <label class="form-check-label" for="flexSwitchbase">Default</label>
                    </div>
                  </div>
              </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="add_address" class="btn btn-primary">Save</button>
            </div>
        </div>
      </div>
    </div>
@else
    <div class="modal fade checkout-modal" id="loginModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                  <div class="col-lg-12 text-center" >
                    <h2 class="fw-bold modal-title" id="loginModalLabel">Welcome back!</h2>
                    <p class="h6"> Please log in to continue</p>
                  </div>
              </div>
              <div class="modal-body bg-secondary-subtle">
              
                    <form  method="post"  id="existingCustomer" action="{{url('sign-in')}}" novalidate>
                         @csrf()
                      <!-- Existing Customer Login Form -->
                      <div class="mb-3">
                        <label for="username" class="form-label">Email</label>
                        <input type="email" required class="form-control rounded-pill" id="email" name="email">
                      </div>
                      <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" required  autocomplete="new-password" class="form-control rounded-pill" id="password" name="password">
                      </div>
                        <div class="text-center ">
                            <button type="submit" style="background: var(--primary)" class="btn text-white rounded-pill mt-3 mb-3 pe-4 ps-4">Sign In</button>                      
                        </div>
                        <div class="text-center mt-3">
                            Don't have an account? <a href="{{url('sign-up')}}">Add</a> Or  <a  id="newCustomerTab" onclick="$('#existingCustomer').hide();$('#newCustomer').show();" class="cursor-pointer" data-bs-toggle="pill" data-bs-target="#newCustomer" role="tab" aria-controls="newCustomer" aria-selected="false"> Continue as Guest</a>
                        </div>
                    </form>
                 
                    <form method="post"  action="{{url('guest')}}"  id="newCustomer" style="display:none" >
                              @csrf()
                      <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" required class="form-control rounded-pill" id="email" name="email">
                      </div>
                      <div class=" text-center">
                        <button type="submit" style="background:var(--primary);" class="btn text-white rounded-pill mt-3 mb-3 pe-4 ps-4">Continue</button>
                      </div>
                      <div class="text-center mt-3">
                            I have an account? <a href="#" id="existingCustomerTab" onclick="$('#existingCustomer').show();$('#newCustomer').hide();" data-bs-toggle="pill" data-bs-target="#existingCustomer" type="button" role="tab" aria-controls="existingCustomer" aria-selected="true" >Login</a> 
                        </div>
                    </form>
              </div>
            </div>
        </div>
    </div>
                                     
@endif
@endsection
@section('scripts')

<script>

   checkAtLeastOneAddressChecked();
 
    function checkAtLeastOneAddressChecked() {
      var radioGroup = $('input[name="pickup_store"]');
      var checkedCount = radioGroup.filter(':checked').length;
    
      if (checkedCount === 0) {
        radioGroup.first().prop('checked', true);
      }
    
      $('.pickuploc').removeClass('selected');
      $('input[name="pickup_store"]:checked').closest('.pickuploc').addClass('selected');
    }


@if(auth()->check() || !empty($basket->email)) 

@else
    $(document).ready(function() {
        // Show the modal after the page has finished loading
        $('#loginModal').modal('show');
      });
                              
@endif

        $('body').on('change', '.shipping_method', function () {
            var selectedOption  = $(this).find(':selected');
            var dataVal         = parseFloat(selectedOption.data('val'));
            
            var price = parseFloat($('.sub_total').data('price'));
            var amount = price + dataVal;
            $('.shipping_pickup_charge').text('$'+dataVal)
            // $('.total_price').text('$'+amount)
            //  $('#total_price').val('$'+amount)
            calculate_ttl()
        });
        
        $('body').on('click', '.gift_card_apply', function () {
            var gift_code = $('#gift_code').val();
            $('.card-alert').html('');
            $.ajax({
                url: "{{url('gift_code_apply')}}",
                cache: false,
                type: "GET",
                data: {gift_code : gift_code},
                success: function(response){
                    $('.card-alert').html(response.msg);
                    
                    if(response.value_type == 'amount'){
                        $('.discount_amount').text('-$'+response.value);
                        var ttl_price   = parseFloat($('#total_price').val().replace('$', ''));
                        ttl_price       = ttl_price - parseFloat(response.value);
                        // $('.total_price').text('$'+ttl_price.toFixed(2));
                        calculate_ttl()
                    }
                    else if(response.value_type == 'percentage')
                    {
                        var productAmount = parseFloat($('#total_price').val().replace('$', ''));
                        var taxRatePercentage = response.value;
                        
                        var taxAmount = (productAmount * taxRatePercentage) / 100;
                        var totalAmount = productAmount - taxAmount;
                        $('.discount_amount').text('-$'+taxAmount.toFixed(2));
                        // $('.total_price').text('$'+totalAmount.toFixed(2));
                        calculate_ttl()
                    }
                    else
                    {
                        var productAmount = parseFloat($('#total_price').val().replace('$', ''));
                        $('.discount_amount').text('-$0');
                        // $('.total_price').text('$'+productAmount.toFixed(2));
                        calculate_ttl()
                    }
                    
                    
                }
            });
            
        });
         
    </script>
    <script>
        function toggleShippingAddress() {
            var checkbox = document.getElementById("same-address-checkbox");
            var shippingDiv = document.getElementById("shipping-address-div");
          
            if (checkbox.checked) {
                shippingDiv.style.display = "block";
            } else {
                shippingDiv.style.display = "none";
            }
        }
        
         function validateCardNo() {
            var input = document.getElementById("cardNumber");
              var value = input.value.trim();
        
              // Remove non-digit characters
              value = value.replace(/\D/g, '');
        
              // Restrict to a maximum of 16 digits
              if (value.length > 16) {
                value = value.slice(0, 16);
              }
        
              // Update the input value
              input.value = value;
        }
        
        function ValidatecardName() {
              var input = document.getElementById("nameOnCard");
              var name = input.value;
        
              // Remove special characters using regex
              var sanitized = name.replace(/[^A-Za-z\s]/g, '');
        
              // Update the input value with the sanitized name
              input.value = sanitized;

        }
       
        function validateExpiryDate() {
            var input = document.getElementById("expirationDate");
           var value = input.value;

              // Remove non-digit characters
              value = value.replace(/\D/g, '');
        
              // Get the first two digits
              var firstTwoDigits = value.slice(0, 2);
                
              var lastTwoDigit = value.slice(2, 4);
              
        
              // Check if the first two digits exceed 12
              if (parseInt(firstTwoDigits) > 12) {
                // Adjust the value to maximum valid month
                value = '12' + value.slice(2);
              }
                // Check if the last two digits exceed 23
            //   if (parseInt(lastTwoDigit) < 23) {
            //     // Adjust the value to maximum valid month
            //     value =  value.slice(0, 2) + '/' + '23';
            //     $('.error-texting').text('Card year Invalid');
            //   }
        
        
              // Format the value with a slash
              if (value.length > 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
              }
        
              // Update the input value
              input.value = value;
        }
        
        
        $('.greeting_card').click(function() {
            $('.greeting-card').html('');
            var ttl_prices  = 0;
            var totalTax       = 0;
            
            $('.greeting_card:checked').each(function() {
                var pdct_price = $(this).data('price');
                var pdct_sku   = $(this).data('sku');
                var pdct_name  = $(this).data('name');
                var pdct_img   = $(this).data('image');
                var pdct_tax   = $(this).data('taxAmt');
                var value      = $(this).val();
                ttl_prices     = parseFloat(ttl_prices + pdct_price);
                var productAmount = '';
                var taxRatePercentage = '';
                var taxAmount = '';
                
                var greeting_card = `<div class="products-checkout col-12 mb-3 products-cart">
                                        <div class="p-c"> 
                                            <img src="`+pdct_img+`" alt="">
                                            <div class="i-content">
                                                <p class="f-h">`+pdct_name+`</p>
                                                <p>Qty: `+ 1 +` </p>
                                            </div>
                                        </div>
                                        <div class="val">
                                            <p>$`+(parseFloat(pdct_price) * 1).toFixed(2) +`</p>
                                        </div>
                                    </div>`;
                                            
                                            productAmount     = parseFloat(pdct_price) * 1;
                                            taxRatePercentage = pdct_tax;
                                            
                                            taxAmount = (productAmount * taxRatePercentage) / 100;
                                            // totalTax  = totalTax + $taxAmount;
                                            
                    // greeting_card  += `<input type="hidden" class="p_tax_amount"   value="`+taxAmount+`"> </div>`;
             
            $('.greeting-card').append(greeting_card);
          
        });
        
        var subTotal = parseFloat($('.sub_total').data('price'));
        
        subTotal = parseFloat(subTotal + ttl_prices).toFixed(2);
        $('.sub_total').text('$'+subTotal)
        
        calculate_ttl(); 
        
    });
    
    
    function calculate_ttl(){
                var sub_ttl             = $('.sub_total').text().replace('$', '');
                var shipping_charge     = $('.shipping_pickup_charge').text().replace('$', '');
               
                var tax_amount          = $('.tax_amount').text().replace('$', '');
                var discount_amount     = $('.discount_amount').text().replace('-$', '');
                

            var ttl_prices = ((parseFloat(sub_ttl) + parseFloat(shipping_charge) + parseFloat(tax_amount)) - parseFloat(discount_amount)).toFixed(2);;
            $('.total_price').text('$'+ttl_prices)

    }
           
    </script>
@endsection