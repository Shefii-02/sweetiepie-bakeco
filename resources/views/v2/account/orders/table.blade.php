@forelse ($orders as $order)
    <tr class="tr-item tr-item product-holder order__{{ $order->id }} product-tr">
        <td>
            <a href="{{ url('account/orders/' . $order->id) }}">#{{ $order->invoice_id }}</a>
        </td>
        <td>
            {{ dateonly($order->created_at) }}
        </td>
        <td class="text-end fw-semibold">
            {{ getPrice($order->grandtotal) }}
        </td>
    </tr>
    <tr>
        <td colspan="4" class="order-products p-0">
            <div class="cart-table-container payment order-products-container">
                <table class="table cart-table">
                    @forelse ($order->basket->items as $item)
                        <tr class="tr-item product-holder cart__{{ $item->id }} product-tr">
                            @include('v2.account.orders.tr')
                        </tr>
                    @empty
                        <tr class="tr-item">
                            <td colspan="6" class="text-center font-weight-bold">No items found</td>
                        </tr>
                    @endforelse

                </table>
                <div class="text-end mb-2 p-3">
                    <div class="">Total. {{ getPrice($order->subtotal) }}</div>
                    <div>Tax. {{ getPrice($order->taxamount) }}</div>
                    @if($order->shipping_charge > 0)
                    <div>Shipping charges. {{ getPrice($order->shipping_charge) }}</div>
                    @endif
                    @if($order->discount > 0)
                    <div>Discount. {{ getPrice($order->discount) }}</div>
                    @endif
                    <div class="fs-5 fw-semibold">Grand total. {{ getPrice($order->grandtotal) }}</div>
                </div>
                <div class="text-start p-3">
                    <a href="{{ url('/account/orders/'.$order->id) }}" class="mt-0 ms-2 btn-dark shadow-none rounded-5 btn text-overflow">
                        <div class="text-overflow">View details</div>
                    </a>
                </div>
            </div>
            
        </td>
    </tr>
@empty
    <tr class="tr-item">
        <td class="text-center" colspan="4">No orders found</td>
    </tr>
@endforelse
