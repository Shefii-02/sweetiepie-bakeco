<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="token" content="{{csrf_token()}}">
  <title>@yield('title',$title)</title>
  <meta name="_token" content="{{ csrf_token() }}">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="csrf-param" content="_token" />
  <meta name="keywords" content="@yield('keywords',$keywords)">
  <meta name="description" content="@yield('description',$description)">
  @yield('stylesTop')
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/Fav/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/Fav/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/Fav/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('assets/images/Fav/site.webmanifest') }}">
  <link rel="mask-icon" href="{{ asset('assets/images/Fav/safari-pinned-tab.svg') }}" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="{{ asset('assets/themes/'.$theme.'/css/style.css?v=5.7') }}" />
  <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('assets/themes/'.$theme.'/css/newstyle.css?v=5.4') }}" />
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">-->

<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=64c2121860781a00121c8026&product=sop' async='async'></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-DMZXMS5G7T"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-DMZXMS5G7T');
</script>
<style>
    .flex-nowrap {
    flex: none;
}
.whitespace-nowrap {
        white-space: nowrap;
}
    #loader-overlay {
        position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }
    
    .loader {
      border: 6px solid #f3f3f3;
      border-top: 6px solid #3498db;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 2s linear infinite;
    }
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
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
li.nav-item.dropdown{
    width: unset !important;
}
.dropdown-menu .hp-2{
 transition: all .25s ease-out;
 border-left:1px solid #fff;
 }
.dropdown-menu .hp-2:hover {
    padding-left: 20px !important;
    border-left:1px solid #111;
}
img.d-logo {
    position: absolute;
    top: -34px;
}

</style>
@yield('styles')
</head>

<body>
  <header>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 header-first-col shadow rounded-0 px-lg-5 py-lg-3 py-2" style="position: relative;">
          <ul class="first-ul d-flex align-items-center">
            <div class="first-li-div d-lg-none col">
              <li>
                <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                  aria-controls="offcanvasExample">
                  <i class="bi bi-filter-left"></i>
                </a>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample"
                  aria-labelledby="offcanvasExampleLabel">
                  <div class="offcanvas-header">
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                      aria-label="Close"></button>
                      @if(auth()->check())
                        <a href="{{url('account')}}" style="text-decoration: none; color: var(--white);" class="offcanvas-title"
                          id="offcanvasExampleLabel">
                          <i class="bi bi-person"></i>
                        </a>
                      @else
                        <a href="{{url('sign-in')}}" style="text-decoration: none; color: var(--white);" class="offcanvas-title"
                          id="offcanvasExampleLabel">
                          Sign In
                        </a>
                      @endif
                  </div>

                  <div class="offcanvas-body" style="display: flex; flex-direction: column; justify-content: space-between;">
                 
                    <div class="for-sup">
                        <div class="f-msp">
                           {!!getMenu('main-menu',['id'=>'header-wr'])!!} 
                        </div> 
                        <!--<div class="mb-20 sm:mb:0 f-submenu">-->
                        <!--      {!!getMenu('main-menu',['id'=>'header-wr'])!!} -->
                        <!--</div>-->
                        <div class="icons-for-carts d-sm-block d-md-none">
                            <span><a class="text-light" href="{{url('cart')}}" ><i class="bi bi-cart"></i></a></span>
                            <span><a class="text-light" href="{{ auth()->check() ? url('account') : url('sign-in') }}" ><i class="bi bi-person"></i></a></span>
                            <span><a class="text-light" href="tel:(647)245-3301" title="(647)245-3301"><i class="bi bi-telephone-outbound"></i></a></span>
                        </div>
                    </div>
                    <div class="social-links">
                         {!!getSocialmedia()!!}
                    </div>
                  </div>
                </div>
              </li>
              <li>
                <a href="/"><img style="" width="50" src="{{ asset('assets/images/mspt.webp')}}" alt="Sweetie Pie" title="Sweetie Pie Home" /></a>
              </li>
            </div>
            <!--<div class="d-none w-100 d-lg-block">-->
            <!--    <ul class="nav d-flex me-auto mb-2 mb-lg-0">-->
            <!--        {!!getMenu2('main-menu',['id'=>'header-wr'])!!} -->
            <!--    </ul>-->
                
            <!--</div>-->
            <div class="d-none py-4 d-lg-flex">
                <a class="d-block py-1 m-auto d-logo-container position-relative" href="/"><img class="d-logo shadow-sm rounded-circle border border-white border-4 m-auto" width="130" src="{{ asset('assets/images/mspt.webp')}}" alt="Sweetie Pie" title="Sweetie Pie Home" /></a>
            </div>
            <div class="second-li-div justify-content-end justify-end w-100 whitespace-nowrap ms-auto ms-lg-0">
                <ul class="nav d-lg-flex flex-nowrap d-none mb-2 mb-lg-0 ms-auto">
                    {!!getMenu2('main-menu',['id'=>'header-wr'])!!} 
                </ul>
                <!--<li>-->
                <!--    <a  class=" d-none d-lg-block fnd-sp"  href="{{url('stores')}}"  ><i class="bi bi-geo-alt"></i> FIND A SWEETIE PIE</a>-->
                <!--</li>-->
                
                <!--<li class="cursor-pointer">-->
                <!--    <a  @if(session()->has('session_string')) href="/menu" class=" btn btn-primary"  @else data-bs-toggle="modal" data-bs-target="#order-btn" data-pid="0" data-href="{{'menu'}}" class="order_now  btn btn-primary"  @endif>ORDER NOW</a>-->
                <!--</li>-->
                
                
                    {{-- @if(session()->has('session_string'))
                    @php
                        $session_string = session('session_string');
                        $basket = \App\Models\Basket::where('session',$session_string)->where('status',0)->first();
                    @endphp
                        @if(($basket && $basket->special_campaign == 0) || session()->has('identity_place'))
                            <span data-bs-toggle="modal" data-bs-target="@if(session('ordertype') == 'pickup') #PickupModalToggle @elseif(session('ordertype') == 'delivery') #DeliveryModalToggle @else  #order-btn @endif" data-href="{{url('products')}}" data-pid="0"  class="order_now cursor-pointer text-capitalize">
                                 <li>
                                    <a href="#" >
                                        <div class="cart-icon cart-icon-1">
                                            @if(session('ordertype') == 'pickup' )
                                                <i class="bi bi-box" ></i>
                                            @else
                                                  <i class="bi bi-truck" ></i>
                                            @endif
                                           <span class="cart-count-main" >{{Str::limit(session('identity_place'), 10);}}</span> 
                                            
                                        </div>
                                    </a>
                                </li>
                            </span>
                        @endif
                    @endif --}}
               
               
                @auth
                <li> 
                    <a href="/cart">
                        <div class="cart-icon">
                          <i class="bi bi-cart"></i>
                          <span class="cart-count"><span class="m-auto">{{getCartCount()}}</span></span>
    
                        </div>
                    </a>
                </li>
                @endif
                <li class="last-one">
                  <a class="{{ auth()->check() ? 'dropdown-toggle' : null }}" id="{{ auth()->check() ? 'dropdownMenuButton' : null }}" data-bs-toggle="{{ auth()->check() ? 'dropdown' : null }}" href="{{ auth()->check() ? url('account') : url('sign-in') }}"><i class="bi bi-person"></i></a>
                  <div class="dropdown-menu border-0 shadow-none p-0" style="width: auto; padding: 10px;">
                    <a class="dropdown-item float-start fs-6 fw-medium rounded-2" href="{{url('account')}}"><i class="bi bi-person"></i> My Account</a>
                    <a class="dropdown-item float-start fs-6 fw-medium rounded-2" href="{{url('signout')}}"><i class="bi bi-box-arrow-in-left"></i> Logout</a>
                  </div>
                </li>
                 {{-- <li> 
                    <a href="tel:(647)245-3301" title="(647)245-3301">
                          <i class="bi bi-telephone-outbound" style="font-size: 19px;"></i>
                    </a>
                </li> --}}
            </div>
          </ul>
          
        </div>
      </div>
    </div>
  </header>
    <div id="loader-overlay">
      <div class="loader"></div>
    </div>
  @yield('contents')

<!-- Modal -->
<div class="modal fade" id="order-btn"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content ">
            <div class="custom-model-wrap">
                <div  data-bs-dismiss="modal" class="cursor-pointer close_button" ><i class="fa fa-times fa-2x text-end text-light"></i></div>
                <div class="open__div">
                    
                    <div class="pop-up-content-wrap">
                      <h3>What kind of order would you like to place ?</h3>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 mb-md-2">
                            <div class="pop-content cursor-pointer selected_type"  data-bs-target="#DeliveryModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal" data-type="delivery">
                              <img src="{{url('assets/themes/'. $theme .'/images/delivery-icon-1.png')}}" alt="delivery-icon-1">
                              <div class="pop-content-content">
                                <p class="main-p">DELIVERY</p>
                                <p>
                                  Freshly made desserts delivered right to you. Ensuring a convenient and delectable experience.
                                </p>
                              </div>
                            </div>
                            
                        </div>
    
                        <div class="col-12 col-md-6 mb-md-2">
                            <div class="pop-content  cursor-pointer selected_type"  data-bs-target="#PickupModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal"  data-type="pickup">
                              <img src="{{url('assets/themes/'. $theme .'/images/pickup-icon-1.png')}}" alt="">
                              <div class="pop-content-content">
                                <p class="main-p">PICK UP</p>
                                <p>Select your treats, place your order and swing by one of our locations and we will have your order ready.</p>
                              </div>
            
                            </div>
                        </div>
    
                        <div class="col-12 col-md-6 ">
                            <a href="/catering" class="text-decoration-none">
                                <div class="pop-content  cursor-pointer selected_type"  data-type="catering">
                                
                                  <img src="{{url('assets/themes/'. $theme .'/images/catering-icon-1.png')}}" alt="">
                                  <div class="pop-content-content">
                                    <p class="main-p">CATERING</p>
                                    <p>Sweetie Pie has catering options to suit your needs. Contact us today to discuss your event.</p>
                                  </div>
                                </div>
                            </a>
                        </div>
    
                        <div class="col-12 col-md-6 ">  
                            <a href="/corporate" class="text-decoration-none">
                                <div class="pop-content  cursor-pointer selected_type"  data-type="corporate">
                                  
                                      <img src="{{url('assets/themes/'. $theme .'/images/gift-icon-1.png')}}" alt="">
                                      <div class="pop-content-content">
                                        <p class="main-p">
                                          CORPORATE
                                        </p>
                                        <p>
                                          Delight Your Clients and Colleagues with Sweetie Pie Corporate Gifts.
                                        </p>
                                      </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="DeliveryModalToggle" aria-hidden="true" aria-labelledby="DeliveryToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                    <form method="GET" action="{{url('select-location')}}" class="selected_city choose_place validated not-ajax" id="selected_city">
                        @csrf()
                        <input  form="selected_city" type="hidden" id="ordertype" name="ordertype" value="delivery">
                    </form>
                <div class="custom-model-wrap">
                        <div class="">
                            <div  data-bs-dismiss="modal" class="cursor-pointer float-end close_button" ><i class="fa fa-times fa-2x text-end text-light"></i></div>
                            <label class="btn btn-outline-light btn-sm float-start"  data-bs-target="#PickupModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal" ><i class="fa fa-arrow-left me-2 text-end text-light"></i>Switch to Pickup</label>
                        </div>
                        <div class="pop-up-content-wrap mt-5">
                          <h3>Enter your address</h3>
                        </div>
                        <div class="form-group">
                            <input form="selected_city" type="text" required name="autocomplete" id="autocomplete"  class="form-control select_city" placeholder="Enter your address">
                        </div>
                        <div class="text-danger city_error"></div>
                        <input  form="selected_city" type="hidden" id="postal" name="postal">
                        <input  form="selected_city" type="hidden" id="city" name="city">
                        <input  form="selected_city" type="hidden" id="country" name="country">
                        <input  form="selected_city" type="hidden" id="street_address" name="street_address">
                        <input  form="selected_city" type="hidden" id="province" name="province" value="@if(session()->has('session_string')){{session('province')}}@endif">

                        <input type="hidden"  form="selected_city" name="redirect" class="redirect_url" >
                        <input type="hidden"  form="selected_city" name="product_Id" class="product_Id" >
                        <div class="form-group text-center mt-3">
                            <button form="selected_city" class="btn primary-btn btn-sm" type="submit"   >SELECT</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="PickupModalToggle" aria-hidden="true" aria-labelledby="PickupModalToggleLabel" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="custom-model-wrap">
                    <div class="">
                        <div  data-bs-dismiss="modal" class="cursor-pointer float-end close_button" ><i class="fa fa-times fa-2x text-end text-light"></i></div>
                        <label class="btn btn-outline-light btn-sm float-start"  data-bs-target="#DeliveryModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal" ><i class="fa fa-arrow-left me-2 text-end text-light"></i>Switch to Delivery</label>
                    </div>
                    <div class="pop-up-content-wrap mt-2 mt-md-0">
                      <h3>Choose a Pickup Location?</h3>
                    </div>
                    <form method="GET" action="{{url('select-location')}}" class="selected_store choose_place validated not-ajax" id="selected_store">
                        <input form="selected_store" type="hidden" name="ordertype" value="pickup">
                        <input type="hidden"  form="selected_store" name="redirect" class="redirect_url" >
                        <input type="hidden"  form="selected_store" name="product_Id" class="product_Id" >
                    </form>
                    <div class="form-group">
                      <div class="for-scroll" id="style-4">
                        <div class="row">
                          @php
                          $checked = true;
                          @endphp
                          @foreach(App\Models\Store::where('status',1)->where('store_code','<>','Colville')->get() as $stores_list)
                          <div class="col-6 col-md-6 col-lg-4">
                            <div class="pickuploc bg-light rounded-2 selected"  data-id="{{$stores_list->id}}">
                              <a class="show-map mb-0" data-id="{{$stores_list->id}}" href="#">
                                  <div class="col-md-12">
                                      <div class="row">
                                          <div class="col-lg-12">
                                                <img src="{{asset('images/store/'.$stores_list->picture_icon)}}" class="w-100 p-0 p-md-3"> 
                                                <input  form="selected_store" type="radio" @if(session()->has('session_string')) {{ $stores_list->id == session('pickup_id') ? 'checked' : ''}} @else @if ($checked) @php echo 'checked'; $checked = false; @endphp @endif @endif name="pickup_store" class="me-1" value="{{$stores_list->id}}" data-city="{{$stores_list->city}}" data-postal="{{$stores_list->postal_code}}" data-strname="{{$stores_list->name}}" data-address="{{$stores_list->address}}" id="pickup-{{$stores_list->id}}">
                                          </div>
                                      </div>
                                  </div>
                              </a>
                            </div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                    <div class="form-group mt-3 text-center">
                        <button type="submit" form="selected_store" class="btn  btn-sm primary-btn">SELECT</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="nutrition_infoModal" tabindex="-1" role="dialog" aria-labelledby="nutrition_infoModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-dialog-centered nutrition-info-modal" role="document">
        <div class="modal-content">
          
          <div class="modal-body">
              <span  class="close pull-right cursor-pointer" data-bs-dismiss="modal" aria-label="Close" style="font-size: 110%;">
                  <i class="bi  bi-x-lg"></i>
                </span>
            <img src="#" style="width: 100%; height:auto;" id="nutri-image" />
          </div>
          
        </div>
      </div>
    </div>
    @if(env('APP_URL') != 'https://www.stage.sweetiepiebakeco.ca')
        <!-- Load Facebook SDK for JavaScript -->
        <div id="fb-root"></div>
        <script>
            window.fbAsyncInit = function() {
                 FB.init({
                  xfbml            : true,
                  version          : 'v8.0'
                 });
            };
    
          (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
    
          <!--Your Chat Plugin code -->
         <div class="fb-customerchat"
           attribution=setup_tool
           page_id="102769771471649"
     theme_color="#f691c1">
         </div>
    @endif
<div class="app-footer">
@include('frontend/subscriptions-form')

<footer class="bg-dark">
    <div class="container">
        <div class="row main">
            

            <div class="col-6 col-md-2 mb-3 mb-md-0">
                <div class="logo">
                    <a href="/">
                    <img width="150" src="{{asset('assets/images/logo.png')}}" alt=""></a>
                </div>
                <div class="social-link">
                    {!!getSocialmedia()!!}
                </div>

            </div>
            <div class="col-12 col-md-3 col-lg-2 mb-3 mb-md-0">
                <div class="f-h">
                    <p>Our Menus</p>
                </div>
                {!!getMenu('our-menus',['id'=>'header-wr'])!!} 
            </div>
            <div class="col-12 col-md-3 col-lg-2 mb-3 mb-md-0">
                <div class="f-h">
                    <p>Quick Links</p>
                </div>
                {!!getMenu('quick-links',['id'=>'header-wr'])!!}
            </div>
            <div class="col-12 col-md-3 col-lg-4 mb-3 mb-md-0">
                <div class="f-h">
                    <p>Get In touch</p>
                </div>
                <form class="wholesale-form"  data-classes="leadgenpro_form" action="{{route('wholesaleForm-send')}}" method="POST" novalidate>
                            @csrf()
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input name="firstname" class="form-control border-1 border border-white rounded-0 bg-dark py-2 text-white" placeholder="Contact person">
                    </div>
                    <div class="col-md-6 mb-3">
                        <input name="company_name" class="form-control border-1 border border-white rounded-0 bg-dark py-2 text-white" placeholder="Company name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <input  name="email" class="form-control border-1 border border-white rounded-0 bg-dark py-2 text-white" placeholder="Email">
                    </div>
                    <div class="col-md-6 mb-3">
                        <input name="phone" type="email" class="form-control border-1 border border-white rounded-0 bg-dark py-2 text-white" placeholder="Phone">
                    </div>
                    <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}" data-callback="enableBtn"></div>
                    <div class="col-12 d-flex mt-3">
                        <input  type="submit" class="form-control border-1 w-auto m-auto border px-5 border-white rounded-0 text-white bg-dark py-2" value="Send">
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</footer>

<section class="f-bottom" id="bottom">
    <div class="container-fluid" >
        <div class="row">
            <div class="col-12">
                <p>&COPY; {{date('Y',time()).'-'.date('Y',time()+(60*60*24*366))}} Sweetiepiebakeco.ca. All rights are reserved.</p>
            </div>
        </div>
    </div>
</section>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap&libraries=places,geometry&v=weekly" defer></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
<script src="{{ asset('assets/js/autofilldata.js?v=1.6') }}"></script>

<script>

        $(function(){
    $('.dropdown').hover(function() {
        $(this).addClass('open');
        $(this).find('.dropdown-menu').addClass('show');
    },
    function() {
        $(this).removeClass('open');
        $(this).find('.dropdown-menu').removeClass('show');
    });
});
        function initMap() {
            const input = document.getElementById("autocomplete");
    
            const options = {
                strictBounds: false,
                types: ['address'],
                componentRestrictions: { country: 'CA' } 
            };

            const autocomplete = new google.maps.places.Autocomplete(input, options);

            autocomplete.addListener("place_changed", () => {
         
                const place = autocomplete.getPlace();
                
                if (!place.geometry || !place.geometry.location) {
    
                window.alert("No details available for input: '" + place.name + "'");
                return;
                }
                // Get city, postal code, and country from the place details
                var city = '';
                var postalCode = '';
                var country = '';
                var region="";
                var street_address="";
                 var province = "";
                for (var i = 0; i < place.address_components.length; i++) {
                    var component = place.address_components[i];
                    var componentType = component.types[0];
        
                     if (componentType === 'locality') {
                            city = component.long_name;
                        }
                    
                    
                    if(city == ''){
                       if (componentType === 'sublocality' || componentType === 'sublocality_level_1') {
                            city = component.long_name;
                        }
                    }
                   
                    if (componentType === 'administrative_area_level_1') {
                        province = component.long_name;
                    }
                    
                    
                    if (componentType === 'postal_code_prefix') {
                        postalCode = component.long_name;
                    }
                    
                    if(postalCode == ''){
                        if (componentType === 'postal_code') {
                            postalCode = component.long_name;
                        }
                    }
                    
                    if (componentType === 'country') {
                        country = component.long_name;
                    }
                    street_address = place.name;
                    
                }
                
                // console.log(place.geometry['location'].lat())
                // console.log(place.geometry['location'].lng())
                // console.log(postalCode)
                // console.log(city)
                // // console.log(street_address)
                // console.log(province)
                
                console.log(place)
                
                
                $('#postal').val(postalCode);
                $('#city').val(city);
                $('#country').val(country);
                $('#street_address').val(street_address);
                $('#order_type').val('delivery');
                $('#province').val(province);

             
            });
          
        }
      
        window.initMap = initMap;
 
    </script>
 
<script>

      // Initially check at least one radio button
      checkAtLeastOneChecked();
  
  $('.show-map').on('click', function() {
        var atr_id = $(this).data('id');
        $('#pickup-' + atr_id).prop('checked', !$('#pickup-' + atr_id).prop('checked'));
        checkAtLeastOneChecked();
        $('.pickuploc').removeClass('selected');
        $(this).closest('.pickuploc').addClass('selected');
        return false;
  });
  
    
    function checkAtLeastOneChecked() {
      var radioGroup = $('input[name="pickup_store"]');
      var checkedCount = radioGroup.filter(':checked').length;
    
      if (checkedCount === 0) {
        radioGroup.first().prop('checked', true);
      }
    
      $('.pickuploc').removeClass('selected');
      $('input[name="pickup_store"]:checked').closest('.pickuploc').addClass('selected');
    }
      
    
    
    $('.form-btn').on('click', function () {
        $(".form-model-main").addClass('form-open');
    });
    $('.form-close, .bg-form').click(function () {
        $('.form-model-main').removeClass('form-open')
    });

    $('.franch-btn').on('click', function () {
        $(".form-model-main.franch").addClass('form-open');
    });
    $('.form-close, .bg-form').click(function () {
        $('.form-model-main.franch').removeClass('form-open')
    });

</script>
<script>

    function city_availabilityCheck(city) {
        return new Promise(function (resolve, reject) {
            $.ajax({
                url: `{{url('check-available-city')}}`,
                data: { city: city },
                cache: false,
                success: function (html) {
                    if (html == 0) {
                        $('.city_error').html(`<p class="fw-bolder">This site currently not available in this City<br>
                        We are working on getting your favorite item to your area soon.</p>`);
                        resolve(0);
                    } else {
                        resolve(1);
                    }
                },
                error: function (error) {
                    reject(error);
                }
            });
        });
    }
    
    $('body').on('submit', '.choose_place', async function (e) {
        e.preventDefault();
        $('.city_error').html('');
        var _this = $(this);
        var ordertypeValue = $(this).find('input[name="ordertype"]').val();
        var city = $('#city').val();
        if (ordertypeValue == 'delivery') {
            var cityavailabilty = await city_availabilityCheck(city);
            if (cityavailabilty == 0) {
                return;
            }
        }

        @if(session()->has('ordertype'))
            try {
                var already_ordertype = `{{session('ordertype') ?? ''}}`;
                if (ordertypeValue == already_ordertype) {
                    _this.submit();
                } else {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'Are you sure? the cart will be emptied!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes switch to ' + ordertypeValue
                    }).then((result) => {
                        if (result.isConfirmed) {
                            _this.submit(); // Submit the form
                        }
                    });
    
                    return false; // Prevent form submission
                }
            } catch (error) {
                console.error(error);
            }
        @else
            _this.submit(); // Submit the form
        @endif
    
    });

    $('body').on('click', '.order_now', function () {
        console.log($(this).data('href'));
        console.log($(this).data('pid'));
        $('.redirect_url').val($(this).data('href'));
        $('.product_Id').val($(this).data('pid'))
    });
    
    $('body').on('click', '.nutrientinfo', function (e) {
        e.preventDefault();
        var imgpath = $(this).attr("data-pic");
        $("#nutri-image").attr("src",imgpath)
        $("#nutrition_infoModal").modal("show");
    
        $("#nutrients-modal").attr("style","display:block;");
      
    });
    
    $('body').on('submit', '#store_selected_form', function (e) {
        e.preventDefault(); 
        var ordertypeValue = $(this).find('input[name="ordertype"]').val();
        var already_ordertype = `{{session('ordertype') ?? ''}}`;
        if ((ordertypeValue != already_ordertype) && (already_ordertype != '')) {
             Swal.fire({
                title: 'Are you sure?',
                text: 'Are you sure? the cart will be emptied!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes switch to '+ordertypeValue
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).submit(); // Submit the form
                }
            });
            return false; // Prevent form submission
        }
        else {
             $(this).submit(); 
        }
    });
    
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
    
<script src="{{ asset('assets/js/mask.js?v=3') }}"></script>
<script src="{{ asset('assets/js/script.js?v=3.1') }}"></script>
<script src="{{ asset('assets/js/formsubmit.js?v=3.7') }}"></script>


 <script>
      $(document).ready(function() {
          $('#_form_39_').submit(function(event) {
              event.preventDefault(); 
            // Get the form data
            var formData = $(this).serialize();
            // Submit the form asynchronously using AJAX
            $.ajax({
              url: `{{url('subscription-submit')}}`,
              type: 'POST',
              data: formData,
              success: function(response) {
                // Handle the successful response
                    if(response['type'] == 'success'){
                        $('.subEmail').val('');
                      }
                  Swal.fire(response['message'],'',response['type'])  
                  
              },
              error: function(xhr, status, error) {
                // Handle the error response
                console.log(xhr.responseText);
              }
            });
          });
        });

    </script>
@yield('scripts')

<script>
function alertJsFunction($message,$type){
    Swal.fire($message,'',$type)    
}
</script>
@if (\Session::has('failed'))
<script>
    alertJsFunction("{{ \Session::get('failed') }}", 'error');
</script>
@elseif (\Session::has('error'))
<script>
    alertJsFunction("{{ \Session::get('error') }}", 'error');
</script>
@elseif (\Session::has('success'))
<script>
    alertJsFunction("{{ \Session::get('success') }}", 'success');
</script>
@elseif (\Session::has('warning'))
<script>
    alertJsFunction("{{ \Session::get('warning') }}", 'warning');
</script>
@elseif (\Session::has('status'))
<script>
    alertJsFunction("{{ \Session::get('status') }}", 'success');
</script>
@endif

{{-- <script src="https://leadgenpro.ca/leadcontroller-wp.js"></script> --}}

</body>

</html>
