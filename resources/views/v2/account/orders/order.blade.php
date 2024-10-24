@extends('layouts.frontend')
@section('styleTop')
<link rel="stylesheet" href="{{ asset('/theme/bsxl.css') }}">
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/theme/style.css') }}">
@endsection
@section('contents')
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 position-relative page_product-listing">
                    <h1>Orders</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="product-detail-slider position-relative product-listing page_section bg-light">
        <div class="container">
            <div class="row mb-5">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-xxl-3 stick-1 mb-4 mb-md-0">
                        @include('v2.account.sidebar')
                    </div>
                    <div class="col-md-8 col-lg-8 col-xxl-9 stic-2 payment-holder">
                        @if(request()->has('success'))
                        <div class=" p-3">
                            <div class="mb-4 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-theme" width="75" height="75"
                                    fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                </svg>
                            </div>
                            <div class="text-center">
                                <h1 style="font-weight: 800">Thank You!</h1>
                                <p>Your order has been completed and placed successfully. <br> A confirmation email has been sent to the email address you provided.</p>
                            </div>
                        </div>
                        @endif
                        <div class="fs-2 text-overflow mb-4">
                            Order#{{ $order->invoice_id }}
                        </div>
                        <div class="cart-table-container payment orders">
                            <div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <div class="text-muted">Billing address</div>
                                        <div>
                                            <div class="fw-semibold">{{ $billingAddress->firstname }}
                                                {{ $billingAddress->lastname }}
                                            </div>
                                            <div class="">{{ $billingAddress->address }}, {{ $billingAddress->city }}
                                            </div>
                                            <div class="">{{ $billingAddress->province }},
                                                {{ $billingAddress->postalcode }}</div>
                                            <div class="">Email. {{ $billingAddress->email }}</div>
                                            <div class="">Phone. {{ $billingAddress->phone }}</div>
                                        </div>
                                        <hr>
                                        @if ($deliveryAddress)
                                            <div class="text-muted">Shipping address</div>
                                            <div>
                                                <div class="fw-semibold">{{ $deliveryAddress->firstname }}
                                                    {{ $deliveryAddress->lastname }}</div>
                                                <div class="">{{ $deliveryAddress->address }},
                                                    {{ $deliveryAddress->city }}</div>
                                                <div class="">{{ $deliveryAddress->province }},
                                                    {{ $deliveryAddress->postalcode }}
                                                </div>
                                                <div class="">Email. {{ $deliveryAddress->email }}</div>
                                                <div class="">Phone. {{ $deliveryAddress->phone }}</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-5">
                                        <div class="text-end">
                                            <div class="">Total. {{ getPrice($order->subtotal) }}</div>
                                            <div>Tax. {{ getPrice($order->taxamount) }}</div>
                                            @if($order->shipping_charge > 0)
                                            <div>Shipping charges. {{ getPrice($order->shipping_charge) }}</div>
                                            @endif
                                            @if($order->discount > 0)
                                            <div>Discount. {{ getPrice($order->discount) }}</div>
                                            @endif
                                            <div class="fs-5 fw-semibold">Grand total. {{ getPrice($order->grandtotal) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table cart-table">
                                <thead class="cart-desktop">
                                    <tr class="text-start">
                                        <th class="">
                                            <div class="text-overflow mw99">Quantity</div>
                                        </th>
                                        <th class="">
                                            <div class="text-overflow mw99">Product name</div>
                                        </th>
                                        <th class="cart-desktop cart-small text-start ">
                                            <div class="text-overflow mw99">Properties</div>
                                        </th>
                                        <th class="cart-desktop cart-small text-end ">
                                            <div class="text-overflow mw99">Price</div>
                                        </th>
                                        <th class="cart-desktop cart-small text-end ">
                                            <div class="text-overflow mw99">Total</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="cart-body">
                                    @forelse ($order->basket->items as $item)
                                        <tr class="tr-item product-holder cart__{{ $item->id }} product-tr">
                                            @include('v2.account.orders.tr')
                                        </tr>
                                    @empty
                                        <tr class="tr-item">
                                            <td colspan="6" class="text-center font-weight-bold">No items found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div>
                                <div class="text-end mb-2 p-3">
                                    {{-- <div class="">Total. {{ getPrice($order->subtotal) }}</div>
                                    <div>Tax. {{ getPrice($order->taxamount) }}</div>
                                    <div>Shipping charges. {{ getPrice($order->shipping_charge) }}</div>
                                    <div>Discount. {{ getPrice($order->discount) }}</div> --}}
                                    <div class="fs-5 fw-semibold">Grand total. {{ getPrice($order->grandtotal) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script></script>
@endsection
