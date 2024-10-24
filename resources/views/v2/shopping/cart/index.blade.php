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
                    <h1>Cart</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="product-detail-slider position-relative product-listing page_section bg-light">
        <div class="container-sm">
            <div class="row mb-5">
                <div class="col-12">
                    <div class="cart-actions">
                        <div class="row align-items-center">
                            <div class="col-auto me-xl-auto mb-2 mb-xl-0">
                                <div href="#"
                                    class="font-weight-600 text-dark align-items-center text-decoration-none d-flex">
                                    <span class="text-overflow"><i class="fa-solid fa-arrow-up-z-a me-2"
                                            aria-hidden="true"></i> Short by </span>
                                    <div class="switch-field d-flex ms-2 text-overflow">
                                        <input type="radio" id="radio-one" name="sort_product" class="sort-products"
                                            value="name" checked="">
                                        <label for="radio-one" class="mb-0 text-overflow sort-by-name">Name</label>
                                        <input type="radio" id="radio-two" name="sort_product" class="sort-products"
                                            value="price">
                                        <label for="radio-two" class="mb-0 sort-by-price">Price</label>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-auto ms-auto mb-2 mb-xl-0">
                                <div class="d-flex coupon-code align-items-center">
                                    <input type="text" value='{{ $basket->coupon->code ?? null }}' class="form-control coupon-holder" placeholder="Enter coupon">
                                    <a href="##" class="addCoupon">Add</a>
                                </div>
                            </div> --}}
                            <div class="col-auto">
                                <a href="{{ url('/shopping/clear') }}"
                                    class="font-weight-600 text-dark text-decoration-none clear-cart"><i
                                        class="fa-solid fa-trash-can me-2" aria-hidden="true"></i> Clear cart</a>
                            </div>
                        </div>
                    </div>
                    <div class="cart-table-container">
                        <table class="table cart-table">
                            <thead class="cart-desktop">
                                <tr class="text-start">
                                    <th class="">
                                        <div class="text-overflow mw99">Quantity</div>
                                    </th>
                                    <th class="">
                                        <div class="text-overflow mw99">Name</div>
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
                                @include('v2.shopping.cart.table')
                            </tbody>
                        </table>
                        <div class="text-end mt-4">
                            <div class="d-flex mb-2">
                                <div class="ms-auto col-auto mb-2 mb-xl-0">
                                    <div class="d-flex coupon-code align-items-center">
                                        <input type="text" value='{{ $basket->coupon->code ?? null }}' class="form-control coupon-holder" placeholder="Enter coupon">
                                        <a href="##" class="addCoupon">Apply</a>
                                    </div>
                                </div>
                            </div>
                            <div class="small">*Delivery Charges & Taxes to be added at checkout</div>
                            <div class="discountmessage">@if($basket->coupon_id ?? null) Discount will be applied on checkout. @endif</div>
                            <h1 class="cart-total text-dark fs-2">Total. <span class="">{{ getPrice($total) }}</span>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container-fluid checkout-footer py-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-6 d-none d-md-block">
                    <div class="d-flex w-100">
                        <a href="{{ url('/menu') }}"
                            class="mt-0 m-auto me-sm-auto btn btn-outline-dark shadow-none rounded-5 border-2 invert text-overflow">
                            <div class="text-overflow">Continue shopping</div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="d-flex w-100">
                        <div class="m-auto ms-sm-auto d-flex align-items-center text-overflow">
                            <div class="cart-btn me-auto d-flex align-items-center flex-1">
                                <span class="cart-total ms-2 cart-total fs-3"><span>{{ getPrice($total) }}</span></span>
                            </div>
                            <a href="{{ url('/checkout') }}"
                                class="mt-0 ms-2 btn-dark shadow-none rounded-5 btn text-overflow">
                                <div class="text-overflow">Proceed to checkout</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/theia-sticky-sidebar@1.7.0/dist/theia-sticky-sidebar.min.js"></script>
    <script src="{{ asset('/theme/script.js') }}"></script>
    <script src="{{ asset('/theme/jqueryUI/script.js') }}"></script>
    <script src="https://kit.fontawesome.com/33d34e55f3.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        $('.sort-products').on('click', function() {
            loadCart();
        })
        const loadCart = function() {
            $.ajax({
                url: `{{ url('/basket/cart') }}?sort=${$('.sort-products:checked').val()}`,
                success: function(result) {
                    $('.cart-count2 span, .cart-count span').text(result.item_count);
                    $('.cart-body').html(result.cart_page);
                    $('.cart-total').text(result.total);
                }
            });
        }
        $(document).on('click', '.cart-table .change-quanity', function() {
            let qControl = $(this).closest('.cart-quantity');
            let qty = parseInt(qControl.find('.quantity-count span').text());
            let preq = qty;
            if ($(this).hasClass('minus-quantity')) {
                qty = Math.max(qty - 1, 0);
            } else {
                qty = Math.max(qty + 1, 0);
            }
            qControl.find('.quantity-count span').text(qty);
            qControl.find('input').val(qty);
            if (preq != qty) {
                setCart(qControl.find('input').attr('product'), qControl.find('input').attr('item'), qControl.find(
                    'input').val())
            }
        });
        $(document).on('click', '.delete-co-item', function() {
            setCart($(this).attr('product'), $(this).attr('item'), 0);
        });

        function setCart(product, item, quantity) {
            body.append(`<div class="product-loading"><i class="fa-solid fa-circle-notch"></i></div>`);
            $.ajax({
                url: `{{ url('/cart/productadd') }}?product_id=${product}&item_id=${item}&quantity=${quantity}`,
                success: function(result) {
                    body.find('.product-loading').remove();
                    loadCart();
                }
            });
        }
        $(document).on('click', '.addCoupon', async function() {
            if ($('.coupon-holder').val()) {
                body.append(`<div class="product-loading"><i class="fa-solid fa-circle-notch"></i></div>`);
                //gift_code_apply
                try {
                    await $.ajax({
                    url: `{{ url('gift_code_apply') }}?gift_code=${$('.coupon-holder').val()}`,
                    success: function(result) {
                       
                        if (result.result == '1') {
                            msg = 'Discount will be applied on checkout.'
                        } else {
                            msg = '';
                        }
                        $('.discountmessage').text(msg);
                        Swal.fire({
                            title: result.result == '1' ? 'Success' : "Error",
                            html: result.msg+"<br>"+msg,
                            showCloseButton: true,
                            showCancelButton: false,
                            cancelButtonAriaLabel: "Thumbs down"
                        });
                    }
                });
                } catch (error) {
                    
                }
                body.find('.product-loading').remove();
            }
        });
    </script>
@endsection
