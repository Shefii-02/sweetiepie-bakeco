@extends('layouts.frontend')
@section('contents')
    
<section class="product-listing-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Order Inquiry</h1>
            </div>
        </div>
    </div>
</section>

<main>
    <section id="wholesaleForm" class="page_section main">
        <div class="container">
            <div class="row justify-content-center">
                
                @if(session()->has('error'))
                    <div class="alert alert-danger" style="font-size:110%;"><strong>{{ Session::get('error') }}</strong>
                    </div>
                @endif
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="wholesle-under">
                        @if(session()->has('success_send'))
                        <div style="padding:50px;min-height:300px;">
                            <h3 class="text-center">{!! Session::get('success_send') !!}</h3>
                        </div>
                        @else
                        <form class="orderInqury-form row validated, not-ajax"  action="{{ route('order-inquiry', ['id' => $order_details->invoice_id, 'session' => optional($order_details->basket)->session]) }}" method="POST">
                        @csrf                                                   
                       <div class="col-md-6 card mb-3 bg-light">
                            <div class="">
                                <div class="card-body">
                                    <h5 class="card-title">Order Details</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item fw-bold">Invoice: {{ $order_details->invoice_id }}</li>
                                        <li class="list-group-item fw-bold">Order Date: {{ dateOnly($order_details->basket->serve_date) }}</li>
                                        <li class="list-group-item fw-bold">Total Amount: {{ getPrice($order_details->grandtotal) }}</li>
                                        <li class="list-group-item fw-bold">Pickup or Delivery: {{ $order_details->basket->order_type }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                       <div class="col-md-6 card bg-light mb-3">
                                @if ($delivery_address = $order_details->address->where('type', 'delivery')->first())
                                    <!-- DELIVERY DETAILS -->
                                        <div class="card-body">
                                            <h5 class="card-title font-weight-bold mb-2">DELIVERY DETAILS</h5>
                                            <div class="ms-2">
                                                <p class="font-weight-bold">{{ titleText($delivery_address->firstname) }} {{ titleText($delivery_address->lastname) }}</p>
                                                <p>{{ titleText($delivery_address->address) }}</p>
                                                <p>{{ $delivery_address->postalcode }}, {{ titleText($delivery_address->city) }}, {{ titleText($delivery_address->province) }}</p>
                                                <p>Expected delivery date: {{ dateOnly($order_details->basket->serve_date) }}</p>
                                                
                                            </div>
                                        </div>
                                @else
                                 @php
                                        $pickupAddress = App\Models\Store::where('id', $order_details->basket->pickup_id)->first();
                                    @endphp
                                    <!-- PICKUP DETAILS -->
                                    @if ($pickupAddress)
                                            <div class="card-body">
                                                <h5 class="card-title font-weight-bold mb-2">PICKUP DETAILS</h5>
                                                <div class="ms-2">
                                                    <p class="font-weight-bold">{{ titleText($pickupAddress->name) }}</p>
                                                    <p>{{ titleText($pickupAddress->address) }}</p>
                                                    <p>{{ $pickupAddress->postal_code }}, {{ $pickupAddress->city }}, {{ $pickupAddress->province }}</p>
                                                    <p>Date: {{ dateOnly($order_details->basket->serve_date) }}</p>
                                                    <p>Time: {{ $order_details->basket->serve_time }}</p>
                                                    <p><a target="_new" href="{{ url('/stores/'.$pickupAddress->slug) }}">View Location</a></p>
                                                </div>
                                            </div>
                                    @endif
                                @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="card-body">
                                <div class="col-md-12 mb-3">
                                    <label for="reason_inquiry">Reason for inquiry</label>
                                    <select class="form-select" aria-label="Reason for inquiry" name="reason_inquiry" id="reason_inquiry">
                                        <option>Update Pickup Date or Time</option>
                                        <option>Change Delivery Address</option>
                                        <option>Update items on the order</option>
                                        <option>Special Instructions for the order</option>
                                        <option>Other</option>
                                    </select>
                                </div>
                                <div class="w-interest">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="message">Message</label>
                                            <textarea rows="5" name="message" id="message" placeholder="Tell us about your business"
                                                      class="form-control" spellcheck="false"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex justify-content-center">
                                            <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}" data-callback="enableBtn"></div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <input type="hidden" name="success_url">
                                        <button class="btn btn-primary" type="submit">SEND INQUIRY</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection