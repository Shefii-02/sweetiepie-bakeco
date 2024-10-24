<div class="cart-item-container c-scroll">
    @foreach ($items as $item)
        <div class="product-cart-item position-relative mb-2">
            <div class="d-flex align-items-center">
                <div class="remove-product shadow-sm" item="{{ $item->id }}"
                    product="{{ $item->product_variation_id }}"><i class="fa-solid fa-trash-can m-auto"></i></div>
                <div class="cart-quantity me-2">
                    <div class="update-quantity text-center">
                        <input type="hidden" name="quantity" class="quantity" item="{{ $item->id }}"
                            product="{{ $item->product_variation_id }}" value="{{ $item->quantity }}">
                        <div class="plus-quantity shadow-sm change-quanity mb-1"><i class="fa-solid fa-plus m-auto"></i></div>
                        <div class="quantity-count d-flex align-items-center"><span
                                class="m-auto">{{ $item->quantity }}</span></div>
                        <div class="minus-quantity shadow-sm change-quanity mt-1"><i class="fa-solid fa-minus m-auto"></i></div>
                    </div>
                </div>
                <div class="cart-description small me-auto text-overflow">
                    <p class="small shade brand-name mb-1">
                        {{ $item->product->categories->pluck('name')->implode(', ') }}</p>
                    <p class="h6 product-name text-overflow">{{ $item->product_name }}</p>
                    <p class="h5 font-weight-bold">{{ getPrice($item->price_amount) }}</p>
                    <p class="h5 small font-weight-bold mb-0">{{ $item->variation }}</p>
                </div>
                <div class="cart-image ms-auto"><img src="{{ asset('images/products/' . $item->picture) }}"
                    onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';" alt=""></div>
            </div>
            <p class="small mb-0 mt-2">{{ getPrice($item->item_price) }} per {{ $item->weight }} |
                {{ $item->box_quantity }} units per case</p>
        </div>
    @endforeach
</div>
@if (!$items->count())
    <div class="cart-error text-center pt-5">
        <p class="h4 mt-5">Your cart is empty</p>
    </div>
@else
    <a href="{{ url('/cart') }}" class="add-cart-error w-100 checkout">
        <div class="d-flex align-items-center">
            <span class="me-auto">Checkout</span><span class="checkout-total">{{ $total }}</span>
        </div>
    </a>
@endif
