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
                            Change profile information
                        </div>
                        <div>
                            <form action="" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                            <label for="firstname" class="form-label">First Name<span class="text-danger">
                                                    *</span></label>
                                            <input value="{{ $user->firstname }}" placeholder="Enter your first name" type="text" autocomplete="off"
                                                class="form-control px-0 border-0 bg-white shadow-none" name="firstname"
                                                id="firstname" value="{{ old('firstname') }}" required>
                                            <span>
                                                {{ $errors->first('firstname') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                            <label for="lastname" class="form-label">Last Name</label>
                                            <input value="{{ $user->lastname }}" placeholder="Enter your last name" type="text" autocomplete="off"
                                                class="form-control px-0 border-0 bg-white shadow-none" name="lastname"
                                                id="lastname" required>
                                            <span>
                                                {{ $errors->first('lastname') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                            <label for="email" class="form-label">Email<span class="text-danger">
                                                    *</span></label>
                                            <input  value="{{ $user->email }}" placeholder="Enter your email address" type="email" name="email"
                                                autocomplete="off" id="email" value="{{ old('email') }}"
                                                class="px-0 border-0 bg-white shadow-none form-control" required>
                                            <span>
                                                {{ $errors->first('email') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                            <label for="phone" class="form-label">Phone Number<span class="text-danger">
                                                    *</span></label>
                                            <input  value="{{ $user->phone }}" placeholder="Enter your phone number" type="text" autocomplete="off"
                                                class="form-control px-0 border-0 bg-white shadow-none" name="phone"
                                                id="phone" required>
                                            <span>
                                                {{ $errors->first('phone') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                            <label for="address" class="form-label">Address<span class="text-danger">
                                                    *</span></label>
                                            <textarea placeholder="Enter your address" class="form-control address_fill px-0 border-0 bg-white shadow-none"
                                                autocomplete="off" value="{{ old('address') }}" name="address" id="address">{{ $user->address }}</textarea>
                                            <span>
                                                {{ $errors->first('address') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                            <label for="city" class="form-label">City<span class="text-danger">
                                                    *</span></label>
                                            <input  value="{{ $user->city }}" placeholder="Enter your city" type="text" autocomplete="off"
                                                class="form-control city_fill px-0 border-0 bg-white shadow-none"
                                                value="{{ old('city') }}" name="city" id="city" required>
                                            <span>
                                                {{ $errors->first('city') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                            <label for="postal_code" class="form-label">Postal Code<span
                                                    class="text-danger"> *</span></label>
                                            <input  value="{{ $user->postalcode }}" placeholder="Enter your province" type="text" autocomplete="off"
                                                maxlength="7"
                                                class="form-control postalCode_fill px-0 border-0 bg-white shadow-none"
                                                id="postal_code" value="{{ old('postalcode') }}" name="postalcode"
                                                required>
                                            <span>
                                                {{ $errors->first('postalcode') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                            <label for="province" class="form-label">Province<span class="text-danger">
                                                    *</span></label>

                                            <select class="form-control province_fill px-0 border-0 bg-white shadow-none"
                                                name="province" id="province" required>
                                                <option value="">Select Province</option>
                                                @foreach ($provinces as $item)
                                                    <option  {{ $user->province == $item->name ? "selected" : '' }} value="{{ $item->name }}"
                                                        {{ $item->code == old('province') ? 'selected' : '' }}>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            <span>
                                                {{ $errors->first('province') }}
                                            </span>

                                        </div>
                                    </div>
                                </div>
                                <div class="text-start text-right d-flex mb-2">
                                    <button type="submit"
                                        class="ms-auto ml-auto primary-btn border-0 px-5 py-3 rounded-2">Update profile</button><br>
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
