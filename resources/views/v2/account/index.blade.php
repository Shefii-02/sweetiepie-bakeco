@extends('layouts.frontend')
@section('styles')
@endsection
@section('contents')
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 position-relative page_product-listing">
                    <h1>My account</h1>
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
                        <div class="fs-1 text-overflow">
                            Hi, {{ $user->firstname }} {{ $user->lastname }}
                        </div>
                        <div>Welcome back</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        
    </script>
@endsection
