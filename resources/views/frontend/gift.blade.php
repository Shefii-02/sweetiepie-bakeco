@extends('layouts.frontend')
@section('styles')


@endsection
@section('contents')
@php
    $totalAmount = 0;
    $basket = GetBasket();
@endphp
<section class="product-listing-banner">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h1>Gifts</h1>
      
        </div>
      </div>
    </div>
  </section>

  <section class="page_section">

    <div class="container">
      <div class="container-product-listing">
        
        <div class="main-content row">
            @if($products->count() >0)
                @foreach($products as $list)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="product-card">
                            <a  @if(session()->has('session_string')) class="bg-transparent cursor-pointer" href="{{url('product/'.$list->slug)}}"   @else  data-bs-toggle="modal" data-bs-target="#order-btn" data-href="{{url('product/'.$list->slug)}}"  class="order_now bg-transparent cursor-pointer" @endif  >
                                <img class="w-100" src="{!! ($list->thumbImages->count()) != '' ? asset('images/products/' . $list->thumbImages->first()->picture) : asset('/assets/images/dummy-product.jpg') !!}" onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';"  alt=""> 
                                <h4 class="mt-2 mb-3 fw-bold text-dark" >{{capitalText($list->name)}}</h4>
                                <p class="text-center h3 fw-bold text-dark">{{min_price($list->id)}}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 mt-4">
                    <div class="not-found-container d-flex justify-content-center align-items-center" style=" height: 300px;">
                        <div class="alert alert-warning text-center d-flex flex-column" role="alert">
                             <div class="col-lg-12  p-4 rounded mt-2 mb-2  d-flex flex-column">
                                <h2 class="text-danger  fw-bolder">Oops!</h2>
                                <h6 class="text-dark fw-bolder">
                                   Sweetie Pie is currently not available products for your location
                                </h6>    
                                <h6 class="text-dark">
                                    We are working on getting your favorite item to your area soon.
                                </h6>
                                
                                <div class="form-group mt-2">
                                    <button class="btn btn-dark rounded" data-bs-target="#DeliveryModalToggle" data-bs-toggle="modal" >@if($basket->order_type == 'delivery') {{'Update'}} @endif Delivery Address</button>
                                    <button class="btn btn-dark rounded" data-bs-target="#PickupModalToggle" data-bs-toggle="modal" >@if($basket->order_type == 'pickup') {{'Update'}} @endif Pickup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        @endif
        </div>
        
        
      </div>

    </div>




  </section>
  
  <section class="back-button-section">
      <div class="container">
          <div class="row">
              <div class="text-center">
                  <a href="{{ url()->previous() }}">Go Back</a>
              </div>
          </div>
      </div>
      
  </section>




@endsection

@section('scripts')
    <script>
    $(document).ready(function () {
        var string = `{{request()->filter}}`; //here id can contain value either 1,2 or 3,4 //Now i want to split id variable value by comma and want to find all checkbox in Checkboxprocess div only and if any checkbox value match with checkbox then i want to //check that checkbox along with its parent checkbox. //For Eg if Id contains 1,2 then i want to check checkbox chkchild1 and chkchild2 and its parent chkParent1
        string  = string.split(',');
  
  
        $('.category-checkbox').each(function() {
       
            var checkbox_val = $(this).val();   
             if ($.inArray(checkbox_val, string) > -1) {
                    $(".category-checkbox[value='" + checkbox_val + "']").prop('checked', true);
             }
     
        });
               
    });

          $('.category-checkbox').change(function() {
                var categories = [];
                $('.category-checkbox:checked').each(function() {
                    categories.push($(this).val());
                });
                var current_url = `{{url('category')}}`
                var queryParams = new URLSearchParams(window.location.search);
                queryParams.set('filter', categories);
                var newUrl = current_url + '?' + queryParams.toString();
                // window.history.replaceState({}, '', newUrl);
                window.location=newUrl;
               
            });
            
            $(".delete-btn").click(function() {
                var item = $(this).closest('.cart-item');
                var quantity = $(this).val();
                var product_sku = $(this).data('psku');
                var product_id  = $(this).data('pid');
                var product_price = $(this).data('price');
                
                update_products(product_sku,product_id,product_price,0);
                var totalAmount = 0;
                      $(this).closest(".cart-item").remove();
                $('.Item_total').each(function() {
                    totalAmount += parseFloat($(this).text().replace('$', ''));
                });
                
                $('#total-amount').text('Total: $' + totalAmount.toFixed(2));
          
            });
            
            
              const body = $('body');
        function update_products(product_sku,product_id,product_price,quantity) {
            body.append(`<div class="product-loading"><i class="bi bi-arrow-clockwise"></i></div>`);
            $.ajax({
                url: '/cart/productadd', 
                method: 'GET', 
                dataType: 'json',
                data: {'product_sku': product_sku,'product_id': product_id,'quantity': quantity,'price'   : product_price},
                success: function(response) {
                    $('.cart-icon .cart-count').html(response.cart_count)
                    body.find('.product-loading').remove();
                },
                error: function(xhr, status, error) {
                     alert('something went wrong please try again')
                    // body.find('.product-loading').remove();
                }
            });
        }
    </script>

@endsection