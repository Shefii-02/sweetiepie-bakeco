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
                        <div class="fs-2 text-overflow mb-4">
                            Change your password
                        </div>
                        <div>
                            <form action="" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                            <label for="password" class="form-label">Password<span class="text-danger">
                                                    *</span></label>
                                            <input placeholder="Enter your new password" type="password"
                                                autocomplete="new-password"
                                                class="form-control px-0 border-0 bg-white shadow-none" name="password"
                                                id="password">
                                            <span>
                                                {{ $errors->first('password') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                            <label for="confirm" class="form-label">Confirm Password<span
                                                    class="text-danger"> *</span></label>
                                            <input placeholder="Confirm your new password" type="password"
                                                autocomplete="off" class="form-control px-0 border-0 bg-white shadow-none"
                                                name="confirm_password" id="confirm">
                                            <span>
                                                {{ $errors->first('confirm_password') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-start text-right d-flex mb-2">
                                    <button type="submit"
                                        class="ms-auto ml-auto primary-btn border-0 px-5 py-3 rounded-2">Chagne
                                        password</button><br>
                                </div>
                            </form>
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
