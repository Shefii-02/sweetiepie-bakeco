@forelse ($items as $item)
<tr class="tr-item">
    <!--<td class="cart-quantity">-->
    <!--    <div class="update-quantity text-center d-flex">-->
    <!--        <div class="quantity-count d-flex align-items-center bg-light"><span class="m-auto">{{ $item->quantity }}</span></div>-->
    <!--    </div>-->
    <!--</td>-->
    <td>
        <div class="co-product d-flex align-content-center position-relative">
            <div class="ms-0 me-1 co-img-container">
                <img src="{{asset('images/products/'.$item->picture)}}" onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';" alt="">
            </div>
            <div class="text-overflow" style="max-width:180px">
                <p class="shade small mb-0 text-overflow">{{ $item->product->categories->pluck('name')->implode(', ') }}</p>
                <p class="mb-0 text-overflow">{{ $item->product_name }}</p>
                <p class="small mb-0 text-muted text-overflow">{{ $item->variation }}</p>
            </div>
            <span class="delete-co-item d-flex d-sm-none" item="{{ $item->id }}" product="{{ $item->product_variation_id }}"><i class="m-auto fa-solid fa-trash-can"></i></span>
        </div>
        <div class="d-flex">
            {{-- <span class="price-total price-mob small px-2">{{ getPrice($item->price_amount) }}</span> --}}
            <span class="price-total price-mob small ms-2 px-2 bg-dark">Total. {{ getPrice($item->price_amount * $item->quantity) }}</span>
        </div>
    </td>
    @if(!isset($small))
    <td class="text-start cart-desktop cart-small">{{ getPrice($item->item_price) }} per {{ $item->weight }} |
        {{ $item->box_quantity }} units per case</td>
    <td class="text-end cart-desktop cart-small">{{ getPrice($item->price_amount) }}</td>
    @endif
    <td class="text-end cart-desktop cart-small">
        <span class="me-2">({{ $item->quantity }})</span> {{ getPrice($item->price_amount * $item->quantity) }}
    </td>
</tr>
@empty
    <tr class="tr-item">
        <td colspan="6" class="text-center font-weight-bold">Your cart is empty</td>
    </tr>
@endforelse
