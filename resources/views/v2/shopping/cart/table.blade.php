@forelse ($items as $item)
@include('v2.shopping.cart.tr')
@empty
    <tr class="tr-item">
        <td colspan="6" class="text-center font-weight-bold">Your cart is empty</td>
    </tr>
@endforelse
