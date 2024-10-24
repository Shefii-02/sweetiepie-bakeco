@extends('layouts.frontend')
@section('styles')
  <style>
      .page_product-listing .position-absolute{
          bottom: 20px;
      }
      .page_product-listing .position-absolute a{
          background: var(--primary);
          border-color: var(--primary);
      }
      @media(max-width: 767px){
          .page_product-listing .position-absolute{
              left: 10px;
              position: relative !important;
              bottom: 10px!important;
          }
      }
      
      
      /* Style for the overlay */
    .stock-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8); /* Transparent white overlay */
        display: none; /* Initially hidden */
        justify-content: center;
        align-items: center;
    }
    
    /* Style for the overlay text */
    .stock-text-overlay {
        font-size: 18px;
        font-weight: bold;
        color: red; /* Customize the color as needed */
    }
    
    /* Style to show overlay when product is out of stock */
    .product-image.out-of-stock + .stock-overlay {
        display: flex; /* Show the overlay */
    }

  </style> 
@endsection
@section('contents')
@php
    $totalAmount = 0;
    $basket = GetBasket();
@endphp
<section class="product-listing-banner">
    <div class="container">
      <div class="row">
        <div class="col-12 position-relative page_product-listing">
          <h1>
              {{$categories->name}}
          </h1>
          <div class="position-absolute">
            <a href="{{url('menu')}}" class="btn btn-dark btn-sm text-light"><i class="bi bi-arrow-left"></i> Back to Menu</a>
         </div>
        </div> 
      </div>
    </div>
</section>
  
  
  <section class="product-listing main-product-listing page_section">
       @if($type_list->count()>0 || $size_list->count()>0 || $specialization_list->count())
    <div class="container pb-5 ps-lg-5 pe-lg-5">
        <div class="accordion accordion-flush d-flex justify-content-center" id="accordionFlushExample">
            @if($type_list->count()>0) 
            <div class="accordion-item">
                <h2 class="accordion-header mb-0" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Select Type 
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse filter-dropdown" aria-labelledby="flush-headingOne"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body dropdown-filter">
                        <div class="filter-dropdown-toggle"  data-dropdown-id="type"></div>
                        <ul class="filter-dropdown-menu">
                            @foreach($type_list->unique('value') as $key2 => $listing_one)
                                <div class="form-margin">
                                    <label for="tid_{{$listing_one->id}}__{{ $key2 }}" class="cursor-pointer">
                                        <input class="category-checkbox" type="checkbox" value="{{$listing_one->value}}" id="tid_{{$listing_one->id}}__{{ $key2 }}"> {{$listing_one->value}}
                                    </label>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            @if($size_list->count()>0)
            <div class="accordion-item">
                <h2 class="accordion-header mb-0" id="flush-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Select Size 
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse dropdown" aria-labelledby="flush-headingTwo"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body dropdown-filter">
                        <div class="filter-dropdown-toggle"  data-dropdown-id="size"></div>
                        <ul class="filter-dropdown-menu">
                            @foreach($size_list->unique('new_value')  as $key => $listing_two)
                                <div class="form-margin">
                                    <label for="sid_{{$listing_two->id}}__{{ $key }}" class="cursor-pointer">
                                        <input class="category-checkbox" type="checkbox" value="{{$listing_two->new_value}}" id="sid_{{$listing_two->id}}__{{ $key }}"> {{$listing_two->new_value}}
                                    </label>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            
        </div>
        <!--<div class="col-12">-->
        <!--    <div id="selectedOptions">-->
        <!--        <ul id="selectedOptionsList" class="d-flex"></ul>-->
        <!--    </div>-->
        <!--</div>-->
    </div>
    @endif
        
    <div class="container">
        <div class="container-product-listing">
            <div class="main-content row">
                @if($products->count() >0)
                    <div class="container pt-3">
                          <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                            <!-- Product 1 -->
                            @foreach($products as $list)
                                <div class="col">
                                    <a @if(session()->has('session_string'))href="{{url('product/'.$list->slug)}}" class="cursor-pointer text-decoration-none" @else data-bs-toggle="modal" data-bs-target="#order-btn" data-href="{{url('product/'.$list->slug)}}"  class="order_now cursor-pointer text-decoration-none"   @endif  >
                                      <div class="card border-0 rounded card-product-listing">
                                          
                                        <div class="d-flex align-items-center  position-relative">
                                            <img class="w-100 h-auto {{ $list->mark_stock_status == 1 ? 'product-image out-of-stock' : ''}}" src="{!! ($list->thumbImages->count() && $list->thumbImages->first()->picture) != '' ? asset('images/products/' . $list->thumbImages->first()->picture) : asset('/assets/images/dummy-product.jpg') !!}" onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';" alt="" >
                                            <div class="stock-overlay">
                                                <p class="stock-text-overlay">Out of Stock</p>
                                            </div>
                                        </div>
                                        <div class="card-body text-center">
                                          
                                           <h4 class="mb-0 fw-bold text-dark singleLinetext-d" >{!! capitalText($list->name) !!}</h4>
                                            @if(product_nutritional_facts($list->id))
                                                {{-- <div class="nutrient_details">
                                                    <a href="#" class="nutrientinfo" data-pic="{{asset('images/products/'.product_nutritional_facts($list->id))}}">
                                                        <i class="bi bi-card-checklist text-dark"></i>
                                                    </a>
                                                </div> --}}
                                            @endif
                                        </div>
                                      </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-12 mt-4">
                        <div class="not-found-container ir-not-found-container">
                            <div class="col-lg-12 bg-danger-subtle bg-opacity-50 p-4 rounded mt-2 mb-2  d-flex flex-column">
                                 <div class="col-lg-12  p-4 rounded mt-2 mb-2  d-flex flex-column text-center">
                                    <h2 class="text-danger  fw-bolder">Oops!</h2>
                                    <h6 class="text-dark fw-bolder">
                                      Currently not available products 
                                    </h6>    
                                    <h6 class="text-dark">
                                        We are working on getting your favorite item to your area soon.
                                    </h6>
                                    
                                    <div class="form-group mt-2">
                                        <a class="btn bg-black text-light rounded text-decoration-none" href="{{url('menu')}}" >Back to Menu</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    @include('frontend.side-cart')
  </section>


@endsection

@section('scripts')
<script>
        $(document).ready(function() {
         
          $('.filter-dropdown-menu input[type="checkbox"]').on('change', function() {
            updateUrlAndOptionsList();
          });
        
             $(document).on('click', '.remove-icon', function() {
              var optionText = $(this).parent().contents().filter(function() {
                return this.nodeType === 3;
              }).text().trim();
            
              $('.dropdown-menu input[type="checkbox"]').each(function() {
                if ($(this).parent().text().trim() === optionText) {
                  $(this).prop('checked', false);
                }
              });
            
              updateUrlAndOptionsList();
            });
        
          function updateUrlAndOptionsList() {
            var selectedOptions = [];
            var queryParameters = [];
        
            $('.dropdown-filter').each(function() {
              var dropdownId = $(this).find('.filter-dropdown-toggle').data('dropdown-id');
              var options = [];
        
              $(this).find('input[type="checkbox"]:checked').each(function() {
                options.push($(this).val());
              });
        
              if (options.length > 0) {
                selectedOptions.push(dropdownId + '=' + options.join(','));
              }
            });
        
            var currentUrl = window.location.href;
            var url = currentUrl.split('?')[0]; // Remove existing query parameters
        
            if (selectedOptions.length > 0) {
              queryParameters = '?' + selectedOptions.join('&');
              url += queryParameters;
            }
        
            // Update the URL
            window.history.pushState('', '', url);
        
            window.location="";
            // Update the selected options list
            updateSelectedOptionsList();
          }
        
        
        	function updateSelectedOptionsList() {
              var selectedOptions = [];
              $('.dropdown-filter').each(function() {
                var dropdownId = $(this).find('.filter-dropdown-toggle').data('dropdown-id');
                var dropdownName = $(this).find('.filter-dropdown-toggle').text();
                var dropdownSelectedOptions = [];
                $(this).find('.dropdown-menu input[type="checkbox"]:checked').each(function() {
                  dropdownSelectedOptions.push($(this).val());
                //   selectedOptions.push($(this).parent().text().trim());
                });
                // Check the corresponding checkboxes based on URL parameters
                var dropdownUrlParam = getUrlParam(dropdownId);
                if (dropdownUrlParam) {
                  var selectedValues = dropdownUrlParam.split(',');
                  $(this).find('.dropdown-menu input[type="checkbox"]').each(function() {
                    if (selectedValues.includes($(this).val())) {
                      $(this).prop('checked', true);
                      dropdownSelectedOptions.push($(this).val());
                      selectedOptions.push($(this).parent().text().trim());
                    }
                  });
                }
              });
              $('#selectedOptionsList').html('');
              selectedOptions.forEach(function(option) {
                $('#selectedOptionsList').append('<li>' + option + '<span class="remove-icon">&times;</span></li>');
              });
            }
        
        
          // Helper function to get URL parameter value by name
          function getUrlParam(name) {
            var urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(name);
          }
        
          updateSelectedOptionsList();
        });

</script>

  <script>


    $(document).ready(function () {
        var string = `{{request()->type}}`; //here id can contain value either 1,2 or 3,4 //Now i want to split id variable value by comma and want to find all checkbox in Checkboxprocess div only and if any checkbox value match with checkbox then i want to //check that checkbox along with its parent checkbox. //For Eg if Id contains 1,2 then i want to check checkbox chkchild1 and chkchild2 and its parent chkParent1
        string  = string.split(',');
  
        $('.category-checkbox').each(function() {
            var checkbox_val = $(this).val();
             if ($.inArray(checkbox_val, string) > -1) {
                    $(".category-checkbox[value='" + checkbox_val + "']").prop('checked', true);
             }
     
        });
        var string = `{{request()->size}}`; //here id can contain value either 1,2 or 3,4 //Now i want to split id variable value by comma and want to find all checkbox in Checkboxprocess div only and if any checkbox value match with checkbox then i want to //check that checkbox along with its parent checkbox. //For Eg if Id contains 1,2 then i want to check checkbox chkchild1 and chkchild2 and its parent chkParent1
        string  = string.split(',');
  
        $('.category-checkbox').each(function() {
            var checkbox_val = $(this).val();
             if ($.inArray(checkbox_val, string) > -1) {
                    $(".category-checkbox[value='" + checkbox_val + "']").prop('checked', true);
             }
     
        });
        var string = `{{request()->specialization}}`; //here id can contain value either 1,2 or 3,4 //Now i want to split id variable value by comma and want to find all checkbox in Checkboxprocess div only and if any checkbox value match with checkbox then i want to //check that checkbox along with its parent checkbox. //For Eg if Id contains 1,2 then i want to check checkbox chkchild1 and chkchild2 and its parent chkParent1
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
                var current_url = `{{url('category/'.$categories->slug)}}`
                var queryParams = new URLSearchParams(window.location.search);
                queryParams.set('filter', categories);
                var newUrl = current_url + '?' + queryParams.toString();
                // window.history.replaceState({}, '', newUrl);
                window.location=newUrl;
               
            });
            
            $(".delete-btn").click(async function() {
                var item = $(this).closest('.cart-item');
                var quantity = $(this).val();
                var product_sku = $(this).data('psku');
                var product_id  = $(this).data('pid');
                var product_price = $(this).data('price');
                
                await update_products(product_sku,product_id,product_price,0);
                var totalAmount = 0;
                      $(this).closest(".cart-item").remove();
                $('.Item_total').each(function() {
                    totalAmount += parseFloat($(this).text().replace('$', ''));
                });
                
                $('#total-amount').text('Total: $' + totalAmount.toFixed(2));
          
                if ($('.cart-item').length === 0 || preorder == 1) {
                    // All items have been deleted, refresh the page
                    location.reload();
                }
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
                    $('.cart-icon .cart-count,.float-button .cart-count').html(response.cart_count)
                    body.find('.product-loading').remove();
                },
                error: function(xhr, status, error) {
                     alert('something went wrong please try again')
                    // body.find('.product-loading').remove();
                }
            });
        }
        
           
    </script>
    
        <script>
          $(document).ready(function() {
            if (window.innerWidth <= 1919) {
              const cartPanel = $("#cart");
              const cartButton = $("#cart-button, #cart-button *");
              const closeButton = $("#close-button");
              const deleteBtn = $(".delete-btn, .delete-btn *");
        
              cartButton.on("click", function() {
                cartPanel.css("right", "0");
                cartButton.css("display", "none"); // Hide the cart button
              });
              
              closeButton.on("click", function() {
                cartPanel.css("right", "-300px");
                cartButton.css("display", "flex"); // Show the cart button
              });
        
              // Event listener for clicks on the document
              $(document).on("click", function(event) {
                // Check if the clicked element is outside the cart panel and cart button
                if (!cartPanel.is(event.target) && !cartButton.is(event.target) && !deleteBtn.is(event.target)) {
                  // Hide the cart panel and show the cart button
                  cartPanel.css("right", "-300px");
                  cartButton.css("display", "flex");
                }
              });
            } else {
              // If screen size is larger than 1920px, show the cart panel and hide the cart button
              $("#cart").css("right", "0");
              $("#cart-button").css("display", "none");
            }
        });
    
    
    </script>
     

@endsection