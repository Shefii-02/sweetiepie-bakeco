@extends('layouts.frontend')
@section('contents')
    
<section class="product-listing-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Share Feedback</h1>
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
                        @if(session()->has('success_send'))
                            <div style="padding:50px;min-height:300px;">
                                <h3 class="text-center">{!! Session::get('success_send') !!}</h3>
                            </div>
                        @elseif(isset($msg))
                            <div class="w-100 text-center" style="padding:50px;min-height:300px;">
                                <h3 class="text-center">{!! $msg !!}</h3>
                                <a href="/" class="text-center btn btn-dark mt-5"><i class="fa fa-arrow-left"></i> Back</a>
                            </div>
                        @else
                        
                        
                        <form class="orderInqury-form  row  validated   not-ajax" action="{{ route('share-feedback',['id' => $order_details->invoice_id, 'session' => $order_details->basket->session]) }}" method="POST">
                        @csrf
                        <div class="row " style="display: flex; flex-wrap: wrap;">
                            <div class="col-md-6 mb-3">
                                
                                <div class="card" style=" height: 100%;">
                                    <div class="card-header"><h5>ORDER DETAILS</h5></div>
                                    <div class="card-body">
                                        <p>
                                            Invoice#: <strong>{{ $order_details->invoice_id }}</strong><br/>
                                            Time: <strong>{{date('d M Y, h:ia',strtotime($order_details->created_at))}}</strong><br/>
                                            Total: <strong>{{ getPrice($order_details->grandtotal) }}</strong></p>
                                            <p>
                                            @if ($billing_address = $order_details->address->where('type', 'billing')->first())
                                            <small>Billing Address:</small><br/>
                                            <strong>{{ titleText($billing_address->firstname) }} {{ titleText($billing_address->lastname) }}</strong><br/>
                                                {{ titleText($billing_address->address) }}
                                                <br/>{{ $billing_address->postalcode }} {{ titleText($billing_address->city) }} {{ titleText($billing_address->province) }}
                                            @endif    
                                            </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                    @if ($delivery_address = $order_details->address->where('type', 'delivery')->first())
                                    <div class="card" style=" height: 100%;">
                                        <div class="card-header"><h5>DELIVERY DETAILS</h5></div>
                                        <div class="card-body">
                                                <p><strong>{{ titleText($delivery_address->firstname) }} {{ titleText($delivery_address->lastname) }}</strong><br/>
                                                {{ titleText($delivery_address->address) }}
                                                <br/>{{ $delivery_address->postalcode }} {{ titleText($delivery_address->city) }} {{ titleText($delivery_address->province) }}</p>
                                                <p>Delivery date: <strong>{{ date('d M Y D',strtotime($order_details->basket->serve_date)) }}</strong></p>
                                        </div>
                                    </div>
                                    @else
                                        @php
                                            $pickupAddress = App\Models\Store::where('id', $order_details->basket->pickup_id)->first();
                                        @endphp
                                        <!-- PICKUP DETAILS -->
                                        @if ($pickupAddress)
                                                <div class="card" style=" height: 100%;">
                                                    <div class="card-header"><h5>PICKUP DETAILS</h5></div>
                                                    <div class="card-body">
                                                        <p><strong>{{ titleText($pickupAddress->name) }}</strong><br/>
                                                        {{ titleText($pickupAddress->address) }}<br/>
                                                        {{ $pickupAddress->postal_code }}, {{ $pickupAddress->city }}, {{ $pickupAddress->province }}<br/>
                                                        <a target="_new" class="fw-bold" href="{{ url('/stores/'.$pickupAddress->slug) }}">View Location</a>
                                                        </p>
                                                        <p>Date: <strong>{{ date('d M Y D',strtotime($order_details->basket->serve_date)) }}</strong><br/>
                                                        Time: <strong>{{ date('h:ia',strtotime($order_details->basket->serve_date)) }}</strong></p>
                                                        
                                                    </div>
                                                </div>
                                        @endif
                                    @endif
                            </div>
                        </div><!-- Row //-->

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="rating">Your Rating</label><br/>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rating" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rating" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rating" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rating" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rating" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="comments">Your Comments</label>
                                <textarea rows="5" name="comments" id="comments" placeholder="write your feedback here..."  class="form-control" spellcheck="false"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <div class="d-flex justify-content-center">
                                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}" data-callback="enableBtn"></div>
                                </div>
                            </div>
                            <div class="col-md-12 text-center">
                                <input type="hidden" name="success_url">
                                <button class="btn btn-primary" type="submit">Submit Feedback</button>
                            </div>
                        </div>
                    </form>
                        @endif
                </div>
            </div>
        </div>
    </section>
</main>

@endsection

@section('styles')
<style>
    
    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }
    .rate:not(:checked) > input {
        position:absolute;
        top:-9999px;
    }
    .rate:not(:checked) > label {
        float:right;
        width:1em;
        overflow:hidden;
        white-space:nowrap;
        cursor:pointer;
        font-size:30px;
        color:#ccc;
    }
    .rate:not(:checked) > label:before {
        content: '★ ';
    }
    .rate > input:checked ~ label {
        color: #ffcc00;    
    }
    .rate:not(:checked) > label:hover,
    .rate:not(:checked) > label:hover ~ label {
        color: #ffcc00;  
    }
    .rate > input:checked + label:hover,
    .rate > input:checked + label:hover ~ label,
    .rate > input:checked ~ label:hover,
    .rate > input:checked ~ label:hover ~ label,
    .rate > label:hover ~ input:checked ~ label {
        color: #ffcc00;
    }

</style>
@endsection