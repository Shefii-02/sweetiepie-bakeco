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
                        <div class="fs-2 text-overflow mb-4">
                            Your orders
                        </div>
                        <div class="cart-table-container payment orders">
                            <table class="table cart-table">
                                <thead class="cart-desktop">
                                    <tr class="text-start">
                                        <th class="">
                                            <div class="text-overflow mw99">Order</div>
                                        </th>
                                        <th class="">
                                            <div class="text-overflow mw99">Date</div>
                                        </th>
                                        <th class="text-overflow mw99 text-end ">
                                            <div class="text-overflow mw99">Total</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="cart-body">
                                    @include('v2.account.orders.table')
                                </tbody>
                            </table>
                            <div class="mt-4">
                                {{ $orders->links() }}
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
