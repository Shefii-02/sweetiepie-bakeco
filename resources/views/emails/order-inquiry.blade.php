@extends('layouts.email')

@section('content')


<div style="padding: 0px 30px;">
   <div>
      
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Details</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Order No: {{ $order_details->invoice_id }}</li>
                        <li class="list-group-item">Order Date: {{ dateOnly($order_details->basket->serve_date) }}</li>
                        <li class="list-group-item">Total Amount: {{ $order_details->grandtotal }}</li>
                        <li class="list-group-item">Pickup or Delivery: {{ $order_details->basket->order_type }}</li>
                    </ul>
                </div>
            </div>
        
            <div class="">
                @if ($delivery_address = $order_details->address->where('type', 'delivery')->first())
                    <!-- DELIVERY DETAILS -->
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold mb-2">DELIVERY DETAILS</h5>
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
                        <div class="card bg-light mt-3">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold mb-2">PICKUP DETAILS</h5>
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
        </div>
        <div class="col-lg-12">
            <label style="font-weight:600">Reason for inquiry : {{$reason}}</label>
            
        </div>
        <div class="col-lg-12">
            <label style="font-weight:600">Message : {{$messages}}</label>
        </div>
        
        <div style="padding: 10px 20px;">
            <p style="margin: 0; font-size: 16px; font-weight: 500; text-align: center;">
                If you have any questions or need further assistance, please don't hesitate to reach out to our friendly customer service team. Thank you again for being a part of the Sweetie Pie family!
            </p>
            <p style="text-align: right">
                Warm regards,<br>
                The Sweetie Pie Team
            </p>
        </div>
   </div>
</div>

@endsection