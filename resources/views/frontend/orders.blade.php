
@extends('layouts.frontend')
@section('contents')
      
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>My Orders</h1>
                </div>
            </div>
        </div>
    </section>
    
    <section class="page_section">
        <div class="container">
           
            <div class="row justify-content-center">
                <div class="col-md-10 ">
                               
                    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"  class="mb-2">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('myaccount')}}">My Account</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Order History</li>
                      </ol>
                    </nav>
                    <div class="mb-2 d-flex ">
                        <small class="pe-2 mt-2">{{$orders->count()}} Order's  in</small>
                        <form action="" id="filter_order"></form>
                        <div class="custom-select">
                          <select name="filter" form="filter_order" class="rounded" id="yearSelect">
                              {{app('request')->input('filter')}}
                            <option @if(app('request')->input('filter') == '2024') selected @endif value="2024">Last {{date('n')}} month</option>
                            <option @if(app('request')->input('filter') == '2023') selected @endif value="2023">2023</option>
                            <option @if(app('request')->input('filter') == '2022') selected @endif value="2022">2022</option>
                          </select>
                        </div>

                    </div>
                    
                    @if($orders->count() > 0 )
                    
                        @foreach($orders as $item)
                        <div class="card mb-3">

                            <div class="card-header" data-bs-toggle="collapse" data-bs-target="#{{$item->id}}" aria-expanded="false" aria-controls="{{$item->id}}" role="button">
                                <ul class="nav_booter list-unstyled  pe-md-5 m-0 d-flex justify-content-between flex-wrap">
                                    <li class="d-flex flex-column">
                                        <small>Order Placed</small>
                                        <small class="fw-bolder">{{dateOnly($item->created_at)}}</small>
                                    </li>
                                    
                                    <li>
                                        <small class="fw-bolder">Total :{{getPrice($item->grandtotal)}}</small>
                                    </li>
                                    <li>
                                        @if($add_billing = $item->address->where('type','billing')->first())
                                            <small class="hover-container">Billing To <i class="fa fa-angle-down"></i>
                                              
                                                <div class="hidden-div  fw-bolder mb-5 p-3 rounded shadow-lg">
                                                    <div class="d-flex flex-column">
                                                        <small>{{$add_billing->firstname .' '. $add_billing->lastname}}</small>
                                                        <small>{{$add_billing->address}}</small>
                                                        <small>{{$add_billing->city.','.$add_billing->postalcode}}</small>
                                                        <small>{{$add_billing->province.','.$add_billing->country}}</small>
                                                    </div>
                                                </div>
                                            </small>
                                        @endif
                                          
                                    </li>
                                    @if($item->order_type == 'delivery')
                                    <li>
                                        @if($add_delivery = $item->address->where('type','delivery')->first())
                                            <small class="hover-container">Ship/Pickup To <i class="fa fa-angle-down"></i>
                                              
                                            <div class="hidden-div  fw-bolder mb-5 p-3 rounded shadow-lg">
                                                <div class="d-flex flex-column">
                                                    <small>{{$add_delivery->firstname .' '. $add_delivery->lastname}}</small>
                                                    <small>{{$add_delivery->address}}</small>
                                                    <small>{{$add_delivery->city.','.$add_delivery->postalcode}}</small>
                                                    <small>{{$add_delivery->province.','.$add_delivery->country}}</small>
                                                </div>
                                            </div>
                                            </small>
                                        @endif
                                    </li>
                                    @endif
                                    
                                    <li class="d-flex flex-column">
                                        <small class="fw-bolder">Order No:#{{$item->invoice_id}}</small>
                                        <!--<small class="float-end cursor-pointer">Invoice <i class="fa fa-download"></i></small>-->
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body collapse" id="{{$item->id}}">
                                
                                <div class="row g-0">
                                    <div class="col-md-8 card-body pe-3">
                                        <div class=""  >
                                            @foreach($item->basket->items as  $listing_item)
                        
                                                <div class="col-md-12">
                                                    <div class="row g-0">
                                                        <div class="col-md-2">
                                                          <img onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';" src="{{asset('images/products/'.$listing_item->picture)}}"  class="img-fluid rounded " alt="...">
                                                        </div>
                                                        <div class="col-md-10">
                                                          <div class="card-body">
                                                            <h5 class="card-title">{{$listing_item->product_name}}</h5>
                                                            <p class="card-text">{{$listing_item->variation}}</p>
                                                            <p class="card-text">{{getPrice($listing_item->price_amount * $listing_item->quantity)}}</p>
                                                            
                                                          </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <hr>
                                            @endforeach
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-4 order-page-s">
                                        <h5 class="mb-3">Order Summary</h5>
                                        <div id="od-subtotals" class="col-12 a-fixed-right-grid-col a-col-right">
                                            <div class="row fw-bolder">
                                                <div class="col-7 mb-3">
                                                    <p class="mb-0">Item(s) Subtotal:</p>
                                                </div> 
                                                <div class="col-5 text-end mb-3">
                                                    <span class="text-end">
                                                        {{getPrice($item->subtotal)}}
                                                    </span> 
                                                </div>
                                                <div class="col-7 mb-3">
                                                    <p class="mb-0">
                                                        Shipping:
                                                    </p> 
                                                </div> 
                                                <div class="col-5 text-end mb-3">
                                                    <span  class="text-end">
                                                        {{getPrice($item->shipping_charge)}}
                                                    </span> 
                                                </div> 
                                                <div class="col-7 mb-3">
                                                    <p class="mb-0" >
                                                        Tax:
                                                    </p> 
                                                </div> 
                                                <div class="col-5 text-end mb-3">
                                                    <span class="text-end">
                                                        {{getPrice($item->taxamount)}}
                                                    </span>
                                                </div> 
                                                <div class="col-7 mb-5">
                                                    <p class="mb-0">
                                                        Discount:
                                                    </p> 
                                                </div> 
                                                <div class="col-5 text-end mb-5">
                                                    <span class="text-end">
                                                        {{getPrice($item->discount)}}
                                                    </span>
                                                </div>
                                                <div class="col-12 order-page-ss" >
                                                    <div class="row">
                                                        <hr>
                                                <div class="col-7">
                                                    <p class="mb-0">
                                                        Grand Total:
                                                    </p> 
                                                </div> 
                                                <div class="col-5 text-end">
                                                    <span class="text-end">
                                                        {{getPrice($item->grandtotal)}}
                                                    </span>
                                                </div> 
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        @endforeach
                    @else
                            <div class="mt-5 d-flex justify-content-center align-items-center">
                                <div class="col-md-6">
                                    <div class="border border-3 border-dark"></div>
                                    <div class="card  bg-white shadow p-5">
                                        <div class="mb-4 text-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 120 120">
                                              <circle cx="60" cy="60" r="52" fill="#F5F6F8" stroke="#E2E4E8" stroke-width="4" />
                                              <path d="M32 40L88 40" stroke="#A0AEC0" stroke-width="8" stroke-linecap="round" />
                                              <path d="M32 60L88 60" stroke="#A0AEC0" stroke-width="8" stroke-linecap="round" />
                                              <path d="M32 80L88 80" stroke="#A0AEC0" stroke-width="8" stroke-linecap="round" />
                                              <circle cx="60" cy="60" r="10" fill="#A0AEC0" />
                                            </svg>


                                        </div>
                                        <div class="text-center">
                                            <h1>No Orders Found !</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection    


@section('scripts')
<script>
$(document).ready(function() {
  $('.hover-container').mousemove(function(e) {
    const x = e.pageX - $(this).offset().left;
    const y = e.pageY - $(this).offset().top;

    $(this).find('.hidden-div').css({
      display: 'block',
    });
  });

  $('.hover-container').mouseleave(function() {
    $(this).find('.hidden-div').css('display', 'none');
  });
   $('#yearSelect').change(function() {
        $('#filter_order').submit();
    });
});

</script>
@endsection
                 