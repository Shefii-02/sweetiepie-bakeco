@extends('layouts.email')

@section('content')
    <div style="padding: 0px 30px;">
        <div>
            <div>
                <p style="text-align: center; font-weight: 700; font-size: 30px; margin-top: 10px;">Your order
                    delivery/pickup location has been updated</p>
            </div>

            <table cellpadding="10" cellspacing="0" align="center" border="0" style="border:none;">
                <tr>
                    <td align="center">
                        <big><strong>Order Status: <span style="color:Green;">Processing</span></strong></big>
                    </td>
                <tr>

                </tr>
                <td align="center">
                    <big><strong>Invoice#: <span
                                style="color:#e480b0;">{{ $order_details->invoice_id }}</span></strong></big>
                </td>
                </tr>
                <tr>
                    <td align="center">
                        <big><strong>Order Amount</strong></big>: <big><strong><span
                                    style="color:#e480b0;">{{ getPrice($order_details->grandtotal) }}</span></strong></big>
                    </td>
                <tr>

                <tr>
                    <td colspan="2" align="center">
                        <img style="width: 100px; "
                            src="https://cdn.dribbble.com/users/3670719/screenshots/11315097/media/cea1ccb72bd93e291c398f6b40313c64.gif"
                            alt="">
                    </td>
                </tr>

            </table>

            <div style="text-align:center; margin:15px">
                <a target="_new"
                    href="{{ url('order-inquiry?token=' . $order_details->basket->session . '&invoiceId=' . $order_details->invoice_id . '&activatedSession=' . md5($order_details->basket->session)) }}"
                    style="margin:15px auto; padding:7px 10px; border-radius:5px;background-color:#f591c1;color:#fff;opacity: 1;text-decoration:none;">ORDER
                    INQUIRY</a>
            </div>

            @if ($billing_address = $order_details->address->where('type', 'billing')->first())
                <table width="100%" cellpadding="5" cellspacing="0" align="center"
                    style="background:#EEE; border-radius: 10px; margin:15px auto;width:500px; ">
                    <tr>
                        <th style="text-align:center;text-decoration:underline;">CUSTOMER INFORMATION</th>
                    </tr>
                    <tr>
                        <td style="padding-left: 15px; padding-right:15px; text-align:center;" valign="top">
                            <p>{{ strtoupper(titleText($billing_address->firstname) . ' ' . titleText($billing_address->lastname)) }}<br />{{ titleText($billing_address->address) }}<br />
                                {{ strtoupper($billing_address->postalcode) }}
                                <strong>{{ titleText($billing_address->city) }}</strong>
                                {{ titleText($billing_address->province) }}.</p>
                            <p>
                                Phone: <strong>{{ $billing_address->phone }}</strong><br />
                                Email: <strong>{{ $billing_address->email }}</strong><br />
                            </p>
                        </td>
                    </tr>
                </table>
            @endif


            <table width="100%" cellpadding="5" cellspacing="0" align="center"
                style="background:#EEE; border-radius: 10px; margin:15px auto; width:500px; ">
                <tr>
                    <th style="text-align:center; text-decoration:underline;">
                        @if ($order_details->basket->order_type == 'delivery')
                            DELIVERY DETAILS
                        @else
                            PICKUP DETAILS
                        @endif
                    </th>
                </tr>
                <tr>
                    <td width="50%" style="padding-left: 15px; padding-right:15px; text-align:center;" valign="top">
                        @if ($order_details->basket->order_type == 'delivery')
                            @if ($delivery_address = $order_details->address->where('type', 'delivery')->first())
                                <p style="margin: 0 0 10px 0;">
                                    <strong>{{ strtoupper(titleText($delivery_address->firstname) . ' ' . titleText($delivery_address->lastname)) }}</strong><br />
                                    {{ titleText($delivery_address->address) }} <br />
                                    {{ strtoupper($delivery_address->postalcode) }}
                                    <strong>{{ titleText($delivery_address->city) }}</strong>
                                    {{ strtoupper(substr($delivery_address->province, 0, 2)) }}.<br />-------<br />
                                    Expected delivery date:
                                    <strong>{{ date('d M y, D', strtotime($order_details->basket->serve_date)) }}</strong>
                                </p>
                            @endif
                        @else
                            @php
                                $pickupAddress = App\Models\Store::where(
                                    'id',
                                    $order_details->basket->pickup_id,
                                )->first();
                                //
                            @endphp
                            @if ($pickupAddress)
                                <p style="margin: 0 0 10px 0;">
                                    <strong>{{ strtoupper(titleText($pickupAddress->name)) }}</strong><br />
                                    {{ titleText($pickupAddress->address) }} <br />
                                    {{ strtoupper($pickupAddress->postal_code) }}
                                    <strong>{{ $pickupAddress->city }}</strong>
                                    {{ strtoupper(substr($pickupAddress->province, 0, 2)) }}<br />
                                    <small><small><strong><a target="_new"
                                                    href="{{ url('/stores/' . $pickupAddress->slug) }}"
                                                    style="color:#e480b0;text-decortion:none;">VIEW
                                                    LOCATION</a></strong></small></small><br />
                                </p>
                                <p>
                                    Phone: <strong>{{ $pickupAddress->phone }}</strong><br />
                                    Email: <strong>{{ $pickupAddress->email }}</strong><br />

                                    -------<br />
                                    Date:
                                    <strong>{{ date('d M y, D', strtotime($order_details->basket->serve_date)) }}</strong><br />Time:
                                    <strong>{{ date('h:ia', strtotime($order_details->basket->serve_time)) }}</strong><br />
                                </p>
                            @endif
                        @endif
                    </td>
                </tr>
            </table>

            <p></p>
            <br>
            <div>
                <table style="width: 100%;" cellpadding="7" cellspacing="0" border="0">
                    <tr>

                        <th style="background: #f3f3f3;text-align: left;">
                            ITEM
                        </th>
                        <th style="background: #f3f3f3; text-align: center;">
                            QTY
                        </th>
                        <th style="background: #f3f3f3; text-align: right;">
                            PRICE
                        </th>
                    </tr>
                    @foreach ($order_details->orderItems->whereNull('parent') as $items_listing)
                        <tr>
                            <td style="border-bottom: 1px solid #DDD;">
                                @if ($items_listing->pre_order == 1)
                                    <span style="display:flex;align-items: center; font-weight:800">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#f591c1"
                                            viewBox="0 0 16 16">
                                            <path
                                                d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                        <i style="margin-left:10px">Limited Edition</i>
                                    </span>
                                @endif
                                <strong>{{ $items_listing->product_name }}</strong> <br />{{ $items_listing->variation }}
                                <br>
                                <div>
                                    {{ getPrice($items_listing->item_price) }} per {{ $items_listing->weight }} |
                                    {{ $items_listing->box_quantity }} units per case
                                </div>
                            </td>
                            <td style="border-bottom: 1px solid #DDD;" align="center" valign="middle">
                                {{ $items_listing->quantity }}
                            </td>
                            <td style="border-bottom: 1px solid #DDD;" align="right" valign="middle">
                                {{ getPrice($items_listing->price_amount * $items_listing->quantity) }}
                            </td>
                        </tr>
                        @if ($parentItem = $items_listing->parentItem)
                            @foreach ($parentItem as $item_list)
                                <tr class="products-checkout col-12">

                                    <td style="border-bottom: 1px solid #DDD;" valign="middle">

                                        {{ $item_list->product_name }}

                                    </td>
                                    <td style="border-bottom: 1px solid #DDD;" align="center" valign="middle">
                                        {{ $item_list->quantity }}
                                    </td>
                                    <td style="border-bottom: 1px solid #DDD;" align="right" valign="middle">
                                        {{ getPrice($item_list->price_amount * $item_list->quantity) }}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </table>
            </div>
            <p></p>
            <table cellpadding="7" cellspacing="0" align="right">
                @if ($order_details->subtotal > 0)
                    <tr>
                        <th align="left">Subtotal</th>
                        <td align="right">{{ getPrice($order_details->subtotal) }}</td>
                    </tr>
                @endif

                @if ($order_details->discount > 0)
                    <tr>
                        <th align="left">Discount</th>
                        <td align="right">{{ getPrice($order_details->discount) }}</td>
                    </tr>
                @endif

                @if ($order_details->shipping_charge > 0)
                    <tr>
                        <th align="left">Shipping</th>
                        <td align="right">{{ getPrice($order_details->shipping_charge) }}</td>
                    </tr>
                @endif

                @if ($order_details->taxamount > 0)
                    <tr>
                        <th align="left">Tax</th>
                        <td align="right">{{ getPrice($order_details->taxamount) }}</td>
                    </tr>
                @endif

                @if ($order_details->grandtotal > 0)
                    <tr>
                        <th align="left"><strong>Grand Total</strong></th>
                        <td align="right"><strong
                                style="color:#e480b0;">{{ getPrice($order_details->grandtotal) }}</strong></td>
                    </tr>
                @endif

            </table>

            <div style="clear:both;float:none;"></div>
            <table cellpadding="7" cellspacing="0">
                <tr>
                    @if ($order_details->basket->make_gift == 1)
                        <td>
                            <center><big><strong>Greeting Card Message</strong></big></center>
                            <p class="text-center" style="font-size: 18px;">
                                <i><strong>{{ $order_details->basket->card_msg }}</strong></i></p>
                        </td>
                    @endif
                </tr>
                <tr>
                    @if ($order_details->basket->remarks != null)
                        <td>
                            <center><big><strong>Order Notes</strong></big></center>
                            <p class="text-left" style="font-size: 18px;">{{ $order_details->basket->remarks }}</p>
                        </td>
                    @endif
                </tr>

            </table>
            <div style="clear:both;float:none;"></div>
            <hr>
            <div style="padding: 10px 20px;">
                <p style="margin: 0; font-size: 16px; font-weight: 500; text-align: center;">
                    If you have any questions or need further assistance, please don't hesitate to reach out to our friendly
                    customer service team. Thank you again for being a part of the Sweetie Pie family!
                </p>
                <p style="text-align: center">
                    The Sweetie Pie Team
                </p>
            </div>
        </div>
    </div>


    <div style="text-align:center">
        <a target="_new"
            href="{{ url('share-feedback?token=' . $order_details->basket->session . '&invoiceId=' . $order_details->invoice_id . '&activatedSession=' . md5($order_details->basket->session)) }}">Share
            your feedback</a>
    </div>
@endsection
