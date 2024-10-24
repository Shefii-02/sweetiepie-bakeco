@php
    $calculations = json_decode($calculations);
@endphp

<div class="sub-total">
    <p class="f-h">Subtotal</p>
    <p class="f-p sub_total">{{ getPrice($calculations->subTotal) }}
    </p>
</div>
<div class="sub-total">
    <p class="f-h">Discount</p>
    <p class="f-p discount_amount">-{{ getPrice($calculations->Discount) }}</p>
</div>
<div class="shpping-pickup">
    @if ($basket->order_type != 'pickup')
        <p class="f-h">Shipping Charge</p>
        <p class="f-p shipping_pickup_charge">
            {{ getPrice($calculations->ShippingCharge ?? 0) }}
        </p>
    @else
        <p class="f-p shipping_pickup_charge d-none">
            {{ getPrice($calculations->ShippingCharge ?? 0) }}
        </p>
    @endif
</div>
<div class="sub-total">
    <p class="f-h">Tax Amount</p>
    <p class="f-p tax_amount">{{ getPrice($calculations->TotalTax) }}</p>
</div>


<hr>
<div class="cart-product-total">
    <p class="f-h">Total</p>
    <p class="f-p total_price">
        {{ getPrice($calculations->grandTotal) }}
    </p>
</div>