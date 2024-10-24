@extends('layouts.frontend')
@section('stylesTop')
<link rel="stylesheet" href="{{ asset('/theme/bsxl.css') }}">
    
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('/theme/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/theme/jqueryUI/style.css') }}">
    <style>
    .product-case:checked+label {
        background: var(--primary) !important;
        color: #fff;
    }
.carousel-indicators [data-bs-target] {
    width: 80px;
}
</style>
@endsection
@section('contents')
    <div class="app-container w-100 h-100 container-fluid">
        @include('v2.shopping.topbar')
        @include('v2.shopping.sidebar')
        <div class="row pt-4 mainRow">
            @include('v2.shopping.items')
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
        @if (request()->product)
            showProduct('{{ url('/product/' . request()->product->slug ?? null) }}');
        @endif
        function findMatchingVariationId(attributes, query) {
            // Group attributes by variation_id
            const groupedByVariation = attributes.reduce((acc, attr) => {
                if (!acc[attr.variation_id]) {
                    acc[attr.variation_id] = {};
                }
                acc[attr.variation_id][attr.type] = attr.value;
                return acc;
            }, {});

            // Find variation_id that matches all query conditions
            for (const variation_id in groupedByVariation) {
                const matches = Object.entries(query).every(([key, value]) =>
                    groupedByVariation[variation_id][key] === value
                );
                if (matches) {
                    return parseInt(variation_id);
                }
            }

            // Return null if no match is found
            return null;
        }
        $(document).on('click', '.product-variation', function() {
            setVariation();
        })
        $(document).on('click', '.product-case', function() {
            setCase();
        })
        const setCase = function(){
            $('.addTocard').attr('case', $('.product-case:checked').val());
        }
        const setVariation = async function() {
            let variants = [];
            $('.product-variation:checked').each(function() {
                variants[$(this).attr('name')] = $(this).val();
            })
            let variation = await findMatchingVariationId(variations, variants);
            $('.variation-sliders, .prices, .variation-details').hide();
            $("#image_" + variation).show();
            $("#price_" + variation).show();
            $("#details_" + variation).show();
            if (variation) {
                $('.addTocard').attr('product', variation);
            }
        }
        $(document).on('click', '.addTocard', function() {
            body.append(`<div class="product-loading"><i class="fa-solid fa-circle-notch"></i></div>`);
            $.ajax({
                url: `{{ url('/basket/add') }}?pdct_id=${$(this).attr('product')}&quantity=${$('.popqControl input').val()}&case_id=${$(this).attr('case')}`,
                success: function(result) {
                    body.find('.product-loading').remove();
                    loadCart();
                    $('div#product-pop').modal('hide').remove();
                }
            });
        });
        const loadCart = function() {
            $.ajax({
                url: `{{ url('/basket/cart') }}`,
                success: function(result) {
                    $('.cart-count2 span, .cart-count span').text(result.item_count);
                    $('.cart-items').html(result.cart_side);
                    $('.cart-total').text(result.total);
                    adjustBars();
                    adujstPanels();
                }
            });
        }
        $(loadCart);
        $(document).on('click', '.cart-items .change-quanity', function() {
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
        $(document).on('click', '.remove-product', function() {
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
    </script>
@endsection
