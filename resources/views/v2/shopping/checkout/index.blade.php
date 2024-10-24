@extends('layouts.frontend')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/theme/bsxl.css') }}">
    <link rel="stylesheet" href="{{ asset('/theme/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/theme/jqueryUI/style.css') }}">
    <style>
        .update-quantity.text-center.d-flex {
            max-width: 140px;
        }
    </style>
@endsection
@section('contents')
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 position-relative page_product-listing">
                    <h1>Checkout</h1>
                </div>
            </div>
        </div>
    </section>
    <form action="{{ url('place-order') }}" method="POST">
        @csrf

        <section class="product-detail-slider position-relative product-listing page_section bg-light">
            <div class="container-sm">
                <div class="row mb-5">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-12">
                                <div class="text-muted mb-2">
                                    Delivery address
                                </div>
                                <div x-data="{ address_id: '{{ old('address_id', $addresses->first()->id ?? null) }}' }">
                                    <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                        <label for="province" class="form-label">Delivery address<span class="text-danger">
                                                *</span></label>

                                        <select x-model="address_id"
                                            class="form-control province_fill px-0 border-0 bg-white shadow-none"
                                            name="address_id" required>
                                            <option value="" selected disabled>Select an address</option>
                                            @foreach ($addresses as $adds)
                                                <option {{ old('address_id') == $adds->id ? 'selected' : '' }} value="{{ $adds->id }}">{{ $adds->firstname }}
                                                    {{ $adds->lastname }}, {{ $adds->address }} {{ $adds->postalcode }}
                                                </option>
                                            @endforeach
                                            <option value="new">Add new address</option>
                                        </select>
                                        <span>
                                            {{ $errors->first('province') }}
                                        </span>

                                    </div>
                                    <div x-show="address_id == 'new'" style="display: none">
                                        @include('v2.shopping.checkout.address', ['name' => 's'])
                                    </div>
                                </div>

                            </div>
                            <div class="col-12" x-data="{ sameBilling: {{ !$errors->isEmpty() ? (old('billing_address_add') ? 'true' : 'false') : 'true' }} }">
                                <div class="custom-control custom-checkbox mb-3">
                                    <input x-model="sameBilling" @click="sameBilling = $event.target.checked"
                                        type="checkbox" class="custom-control-input" value="1"
                                        id="billing_address" name="billing_address_add">
                                    <label class="custom-control-label cursor-pointer" for="billing_address">Billing address
                                        :
                                        Same as delivery address </label>
                                </div>
                                <div class="billing_address" x-show="!sameBilling" style="display: none">
                                    @include('v2.shopping.checkout.address', ['name' => 'b'])
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                    <label>Special notes</label>
                                    <textarea placeholder="Enter your notes or messages" class="form-control px-0 border-0 bg-white shadow-none"
                                        autocomplete="off" value="" name="notes" id="notes">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-muted mb-2">
                                        Payment information
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                        <small for="cardNumber mb-2">Card Number</small>
                                        <input placeholder="Enter your card number" type="text"
                                            class="form-control px-0 border-0 bg-white shadow-none" minlength="14"
                                            name="cardNumber" value="" autocomplete="off" id="cardNumber"
                                            oninput="validateCardNo()" placeholder="">
                                        <span class="text-danger card-validate" style="display:none"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                        <small for="nameOnCard mb-2">Name on Card</small>
                                        <input placeholder="Enter name on your card" type="text"
                                            class="form-control px-0 border-0 bg-white shadow-none" name="nameOnCard"
                                            value="" autocomplete="off" id="nameOnCard" oninput="ValidatecardName()"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                        <small for="expirationDate mb-2">Card Expiry</small>
                                        <input type="text" class="form-control px-0 border-0 bg-white shadow-none"
                                            name="expirationDate" value="" autocomplete="off" id="expirationDate"
                                            placeholder="MM/YY" oninput="validateExpiryDate()">
                                        <span class="error-texting text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 theme-input-group bg-white p-2 rounded-1">
                                        <small for="securityCode mb-2">Security Code</small>
                                        <input type="text" class="form-control px-0 border-0 bg-white shadow-none"
                                            name="securityCode" value="" autocomplete="off" maxlength="4"
                                            id="securityCode" placeholder="CVV">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white rounded-1">
                        <div class="p-3">
                            <table class="table cart-table table-borderless">
                                <!--<thead class="cart-desktop">-->
                                <!--    <tr class="text-start">-->
                                <!--        <th class="">-->
                                <!--            <div class="text-overflow mw99">Quantity</div>-->
                                <!--        </th>-->
                                <!--        <th class="">-->
                                <!--            <div class="text-overflow mw99">Product name</div>-->
                                <!--        </th>-->
                                        <!--<th class="cart-desktop cart-small text-start ">-->
                                        <!--    <div class="text-overflow mw99">Properties</div>-->
                                        <!--</th>-->
                                        <!--<th class="cart-desktop cart-small text-end ">-->
                                        <!--    <div class="text-overflow mw99">Price</div>-->
                                        <!--</th>-->
                                <!--        <th class="cart-desktop cart-small text-end ">-->
                                <!--            <div class="text-overflow mw99">Total</div>-->
                                <!--        </th>-->
                                <!--    </tr>-->
                                <!--</thead>-->
                                <tbody class="cart-body">
                                    @include('v2.shopping.checkout.table2', ['small' => true])
                                </tbody>
                            </table>
                            <div class="p-3">
                                <div class="text-end mt-4">
                                <h1 class="cart-total text-dark fs-5 fw-normal">Subtotal. <span
                                        class="">{{ getPrice($calculation->subTotal) }}</span></h1>
                                <h1 class="cart-total text-dark fs-5 fw-normal">Discount. @if ($calculation->DiscountCode)
                                    ({{ $calculation->DiscountCode }})
                                @endif <span
                                        class="">{{ getPrice($calculation->Discount) }}
                                    </span>
                                </h1>
                                @if($calculation->ShippingCharge > 0)
                                <h1 class="cart-total text-dark fs-5 fw-normal">Shipping. <span
                                        class="">{{ getPrice($calculation->ShippingCharge) }}</span>
                                </h1>
                                @endif
                                <h1 class="cart-total text-dark fs-5 fw-normal">Tax. <span
                                        class="">{{ getPrice($calculation->TotalTax) }}</span></h1>
    
                                <h1 class="cart-total text-dark fs-5">Grand total. <span
                                        class="">{{ getPrice($calculation->grandTotal) }}</span></h1>
                            </div>
                            <div class="d-flex  my-4">
                                <div class="g-recaptcha ms-auto" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"
                                    data-callback="enableBtn"></div>
                            </div>
                            <div class="ms-auto text-end d-flex align-items-center">
                                <a href="{{ url('/cart') }}"
                                    class="btn btn-dark ms-auto me-2 text-capitalize px-3 py-2 fs-6 rounded-5 border-0 shadow-none">
                                    <div class="text-overflow">Edit order</div>
                                </a>
                                <button type="submit"
                                    class="btn primary-btn text-capitalize px-3 py-2 fs-6 rounded-5 border-0 shadow-none">
                                    <div class="text-overflow">Place order</div>
                                </button>
                            </div>
                            </div>
                        </div>
                    </div>
                        <!--<div class="text-end mt-4">-->
                        <!--    <h1 class="cart-total text-dark fs-5 fw-normal">Subtotal. <span-->
                        <!--            class="">{{ getPrice($calculation->subTotal) }}</span></h1>-->
                        <!--    <h1 class="cart-total text-dark fs-5 fw-normal">Discount. @if ($calculation->DiscountCode)-->
                        <!--        ({{ $calculation->DiscountCode }})-->
                        <!--    @endif <span-->
                        <!--            class="">{{ getPrice($calculation->Discount) }}-->
                        <!--        </span>-->
                        <!--    </h1>-->
                        <!--    @if($calculation->ShippingCharge > 0)-->
                        <!--    <h1 class="cart-total text-dark fs-5 fw-normal">Shipping. <span-->
                        <!--            class="">{{ getPrice($calculation->ShippingCharge) }}</span>-->
                        <!--    </h1>-->
                        <!--    @endif-->
                        <!--    <h1 class="cart-total text-dark fs-5 fw-normal">Tax. <span-->
                        <!--            class="">{{ getPrice($calculation->TotalTax) }}</span></h1>-->

                        <!--    <h1 class="cart-total text-dark fs-5">Grand total. <span-->
                        <!--            class="">{{ getPrice($calculation->grandTotal) }}</span></h1>-->
                        <!--</div>-->
                        <!--<div>-->
                        <!--    <div class="row">-->
                        <!--        <div class="col-12">-->
                        <!--            <div class="text-muted mb-2">-->
                        <!--                Payment information-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="col-12">-->
                        <!--            <div class="mb-3 theme-input-group bg-white p-2 rounded-1">-->
                        <!--                <small for="cardNumber mb-2">Card Number</small>-->
                        <!--                <input placeholder="Enter your card number" type="text"-->
                        <!--                    class="form-control px-0 border-0 bg-white shadow-none" minlength="14"-->
                        <!--                    name="cardNumber" value="" autocomplete="off" id="cardNumber"-->
                        <!--                    oninput="validateCardNo()" placeholder="">-->
                        <!--                <span class="text-danger card-validate" style="display:none"></span>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="col-12">-->
                        <!--            <div class="mb-3 theme-input-group bg-white p-2 rounded-1">-->
                        <!--                <small for="nameOnCard mb-2">Name on Card</small>-->
                        <!--                <input placeholder="Enter name on your card" type="text"-->
                        <!--                    class="form-control px-0 border-0 bg-white shadow-none" name="nameOnCard"-->
                        <!--                    value="" autocomplete="off" id="nameOnCard" oninput="ValidatecardName()"-->
                        <!--                    placeholder="">-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="col-md-6">-->
                        <!--            <div class="mb-3 theme-input-group bg-white p-2 rounded-1">-->
                        <!--                <small for="expirationDate mb-2">Card Expiry</small>-->
                        <!--                <input type="text" class="form-control px-0 border-0 bg-white shadow-none"-->
                        <!--                    name="expirationDate" value="" autocomplete="off" id="expirationDate"-->
                        <!--                    placeholder="MM/YY" oninput="validateExpiryDate()">-->
                        <!--                <span class="error-texting text-danger"></span>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        <div class="col-md-6">-->
                        <!--            <div class="mb-3 theme-input-group bg-white p-2 rounded-1">-->
                        <!--                <small for="securityCode mb-2">Security Code</small>-->
                        <!--                <input type="text" class="form-control px-0 border-0 bg-white shadow-none"-->
                        <!--                    name="securityCode" value="" autocomplete="off" maxlength="4"-->
                        <!--                    id="securityCode" placeholder="CVV">-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    <!--<div class="col-12">-->
                    <!--    <div class="cart-table-container">-->
                    <!--        <table class="table cart-table">-->
                    <!--            <thead class="cart-desktop">-->
                    <!--                <tr class="text-start">-->
                    <!--                    <th class="">-->
                    <!--                        <div class="text-overflow mw99">Quantity</div>-->
                    <!--                    </th>-->
                    <!--                    <th class="">-->
                    <!--                        <div class="text-overflow mw99">Product name</div>-->
                    <!--                    </th>-->
                    <!--                    <th class="cart-desktop cart-small text-start ">-->
                    <!--                        <div class="text-overflow mw99">Properties</div>-->
                    <!--                    </th>-->
                    <!--                    <th class="cart-desktop cart-small text-end ">-->
                    <!--                        <div class="text-overflow mw99">Price</div>-->
                    <!--                    </th>-->
                    <!--                    <th class="cart-desktop cart-small text-end ">-->
                    <!--                        <div class="text-overflow mw99">Total</div>-->
                    <!--                    </th>-->
                    <!--                </tr>-->
                    <!--            </thead>-->
                    <!--            <tbody class="cart-body">-->
                    <!--                @include('v2.shopping.checkout.table')-->
                    <!--            </tbody>-->
                    <!--        </table>-->
                    <!--        <div class="text-end mt-4">-->
                    <!--            <h1 class="cart-total text-dark fs-5 fw-normal">Subtotal. <span-->
                    <!--                    class="">{{ getPrice($calculation->subTotal) }}</span></h1>-->
                    <!--            <h1 class="cart-total text-dark fs-5 fw-normal">Discount. @if ($calculation->DiscountCode)-->
                    <!--                ({{ $calculation->DiscountCode }})-->
                    <!--            @endif <span-->
                    <!--                    class="">{{ getPrice($calculation->Discount) }}-->
                    <!--                </span>-->
                    <!--            </h1>-->
                    <!--            @if($calculation->ShippingCharge > 0)-->
                    <!--            <h1 class="cart-total text-dark fs-5 fw-normal">Shipping. <span-->
                    <!--                    class="">{{ getPrice($calculation->ShippingCharge) }}</span>-->
                    <!--            </h1>-->
                    <!--            @endif-->
                    <!--            <h1 class="cart-total text-dark fs-5 fw-normal">Tax. <span-->
                    <!--                    class="">{{ getPrice($calculation->TotalTax) }}</span></h1>-->
    
                    <!--            <h1 class="cart-total text-dark fs-5">Grand total. <span-->
                    <!--                    class="">{{ getPrice($calculation->grandTotal) }}</span></h1>-->
                    <!--        </div>-->
                    <!--        <div class="d-flex  my-4">-->
                    <!--            <div class="g-recaptcha ms-auto" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"-->
                    <!--                data-callback="enableBtn"></div>-->
                    <!--        </div>-->
                    <!--        <div class="ms-auto text-end d-flex align-items-center">-->
                    <!--            <a href="{{ url('/cart') }}"-->
                    <!--                class="btn btn-dark ms-auto me-2 text-capitalize px-3 py-2 fs-6 rounded-5 border-0 shadow-none">-->
                    <!--                <div class="text-overflow">Edit order</div>-->
                    <!--            </a>-->
                    <!--            <button type="submit"-->
                    <!--                class="btn primary-btn text-capitalize px-3 py-2 fs-6 rounded-5 border-0 shadow-none">-->
                    <!--                <div class="text-overflow">Place order</div>-->
                    <!--            </button>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </div>
        </section>
    </form>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/theia-sticky-sidebar@1.7.0/dist/theia-sticky-sidebar.min.js"></script>
    <script src="{{ asset('/theme/script.js') }}"></script>
    <script src="{{ asset('/theme/jqueryUI/script.js') }}"></script>
    <script src="https://kit.fontawesome.com/33d34e55f3.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://unpkg.com/alpinejs" defer></script>
    <script>
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



            // Format the value with a slash
            if (value.length > 2) {
                value = value.slice(0, 2) + '/' + value.slice(2, 4);
            }

            // Update the input value
            input.value = value;
        }
    </script>
@endsection
