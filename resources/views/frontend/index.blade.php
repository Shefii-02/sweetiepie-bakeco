
@extends('layouts.frontend')
@section('styles')
<style>
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        display: none;
    }
    img.cat-image {
    min-height: 260px;
}
    .loading-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none;
        z-index: 999;
    }
    
    .loading {
        background-color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }.bg-primary-light {
    background: #00000070;
}
.cat-card h4{
    transition: all .5s;
}
.cat-card:hover h4 {
    bottom: 40px !important;
    background: #111;
}
</style>


@endsection

@section('contents')
<div class="headerOffset" style="height:88px"></div>
<!-- DESKTOP BANNER -->
<section class="banner for-desktop-banner">
    <div class="slick-banner">
       @php 
            $io = 0;
        @endphp
        @foreach($slider as $key => $item)
            @if($item->picture != '' &&  $item->picture != 'dummy.png')
                @if($item->file_type == 'image')
                    <div>
                        <div style="position: relative">
                            <img class="w-100" src="{{asset('images/banners/'.$item->picture)}}" alt="">
                            @if($item->link != '')
                            <div class="banner-slick-button" style="position: absolute;bottom:15%; width:100%;display: flex; justify-content: center;"> 
                                <a  @if(session()->has('session_string')) href="{{$item->link}}" class="btn btn-primary"   @else data-bs-toggle="modal" data-bs-target="#order-btn" data-pid="0" data-href="{{$item->link}}" class="order_now d-none d-md-block btn btn-primary"  @endif >ORDER NOW</a> 
                            </div>
                            @endif
                        </div>
                    </div>
                 @else
                      <div>
                        <video class="img-fluid" autoplay loop muted>
                            <source src="{{asset('images/banners/'.$item->picture)}}" type="video/mp4" />
                        </video>
                      </div>
                @endif
            @php 
                $io = $io+1;
            @endphp 
            @endif
        @endforeach
    </div>

</section>

<!-- FOR MOBILE BANNER -->
<section class="banner for-mobile-banner">

  <div class="slick-banner-mobile">
       @php 
            $io = 0;
        @endphp
        @foreach($slider as $key => $item)
        @if($item->file_type == 'image')
            @if($item->picture_small != '' && $item->picture_small != 'dummy.png')
            <div>
              <img class="w-100" src="{{asset('images/banners/'.$item->picture_small)}}" alt="">
                @if($item->link != '')
               
                    <div class="banner-slick-button" style="position: absolute;bottom:10%; width:100%;text-align: center;"> 
                        <a @if(session()->has('session_string')) href="{{$item->link}}"  class="btn btn-primary"    @else data-bs-toggle="modal" data-bs-target="#order-btn" data-pid="0" data-href="{{$item->link}}" class="order_now   btn btn-primary"  @endif>ORDER NOW</a> 
                    </div>
                @endif
            </div>
            @endif
         @else
              <div>
               <video class="img-fluid" autoplay loop muted>
                <source src="{{asset('images/banners/'.$item->picture)}}" type="video/mp4" />
              </video>
              </div>
        @endif
         @php 
            $io = $io+1;
        @endphp 
        @endforeach
  </div>

</section>

<!--<section class="taste-weekly">-->
<!--  <div class="container">-->
<!--    <div class="row">-->
<!--      <div class="col-md-1 col-lg-2"></div>-->
<!--      <div class="col-12 col-md-10 col-lg-8 mb-3 mb-lg-5 ">-->
<!--        <h1 class="mt-3">Ordering made sweeter</h1>-->
<!--        <p> Choose from our Sweetest Selections</p>-->
<!--      </div>-->
<!--      <div class="col-md-1 col-lg-2"></div>-->

      <!-- Icons -->
<!--      <div class="row for-icon justify-content-between">-->
<!--        <div class="col-6 col-md-3 col-lg-3 mb-4  cursor-pointer"  data-bs-target="#DeliveryModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal" >-->
<!--          <img src="assets/themes/{{$theme}}/images/delivery-icon-2.png" alt="">-->
<!--          <h5 >Delivery</h5>-->
<!--        </div>-->
<!--        <div class="col-6 col-md-3 col-lg-3 mb-4  cursor-pointer"  data-bs-target="#PickupModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal" >-->
<!--          <img src="assets/themes/{{$theme}}/images/pickup-icon-2.png" alt="">-->
<!--          <h5>Pickup</h5>-->
<!--        </div>-->
<!--        <div class="col-6 col-md-3 col-lg-3 mb-4  cursor-pointer" >-->
          
<!--            <a href="{{url('catering')}}" class="text-light text-decoration-none">-->
<!--              <img src="assets/themes/{{$theme}}/images/catering-icon-2.png" alt="">-->
<!--              <h5>Catering</h5>-->
<!--            </a>-->
<!--        </div>-->
<!--        <div class="col-6 col-md-3 col-lg-3 mb-4  cursor-pointer" >-->
<!--            <a href="{{url('gifts')}}" class="text-light text-decoration-none">-->
<!--                <img src="assets/themes/{{$theme}}/images/gift-icon-2.png" alt="">-->
<!--                <h5>Gifts</h5>-->
<!--            </a>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</section>-->
<section class="homepage-product">
  <div class="container">
    <div class="row">
      <!--<div class="col-md-3"></div>-->
      <!--<div class="col-12 col-md-6 heading-div mb-5">-->
      <!--  <div class="d-flex justify-content-center">-->
      <!--    <h3>OUR PRODUCTS</h3>-->
      <!--  </div>-->
        <!--<p class="mt-3"><i>EXPLORE OUR MENUS</i></p>-->
      <!--</div>-->
      <!--<div class="col-md-3"></div>-->

        @if(isset($tiles))
            @foreach($tiles as $tile)
                 <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                     <div class="position-relative cat-card">
                        <a href="{{$tile->link}}" class="text-decoration-none text-white">
                            <img class="w-100 object-fit-cover cat-image" src="{{asset('images/banners/'.$tile->picture)}}" alt="{{$tile->name}}">
                            <div class="mt-3">
                            <h4 class="text-dark position-absolute start-0 bottom-0 w-100 text-white bg-primary-light m-0 p-2 text-start text-left">{{$tile->name}}</h4>
                        </div>
                        </a> 
                     </div>
                </div>
            @endforeach
        @endif
        
       

    </div>
  </div>

</section>
<div class="bg-light py-5">
    <div class="container">
        <div class="row my-5 align-items-center">
            <div class="col-md-6">
                <div class="text-center mb-5">
                    <img style="" width="200" src="{{ asset('assets/images/mspt.webp')}}" alt="Sweetie Pie" title="Sweetie Pie Home" />
                </div>
            </div>
            <div class="col-md-6">

                
                <h2 class="mb-4" style="font-size:140%;" >Hi and Welcome to Sweetie Pie Bake Co.</h2>
                
                <p class="mb-4">What started in the basement of a tiny shop at the cornerof Harbord St. and Grace in Toronto has grown into something we never could have imagined.</p>
                
                <p class="mb-4">We are proud to saywe have grown a wholesale business that expands across Canada. Located inNorth York, we have a 15,000 squarefoot facility that houses our main commissary kitchen, our packaging and
production space, warehouse and head offices.</p>
                
                <p class="mb-4">We supply your favourite cafes, hotels, restaurants, grocery stores with our gourmet, handcrafted pies, cookies and baked goods.</p>
                
                <a href="/about-us">Read more</a>


            </div>
        </div>
    </div>
</div>
<section class="homepage-product">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-12 col-md-6 heading-div mb-5">
        <div class="d-flex justify-content-center">
          <h3>{{isset($front_products) ? $front_products->title : ''}}</h3>
        </div>
        <!--<p class="mt-3"><i>{{isset($front_products) ? $front_products->short_desc : ''}}</i></p>-->
      </div>
      <div class="col-md-3"></div>

        @if(isset($front_products->product_list))
            @foreach($front_products->product_list as $item)
                @php
                    $product = App\Models\Product::where('master_id', $item->product_id)->first();
                @endphp
                @if($product)
                 <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <a href="{{url('product/'.$product->slug)}}" class="cursor-pointer text-decoration-none">
                        <div class="card border-0 rounded card-product-listing">
                              
                            <div class="d-flex align-items-center position-relative">
                                <img class="w-100 h-auto {{ $product->mark_stock_status == 1 ? 'product-image out-of-stock' : ''}}" src="{!! ($product->thumbImages->count()) != '' ? asset('images/products/' . $product->thumbImages->first()->picture) : asset('/assets/images/dummy-product.jpg') !!}" onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';" alt="" >
                                <div class="stock-overlay">
                                    <p class="stock-text-overlay">Out of Stock</p>
                                </div>
                            </div>
                            <div class="card-body text-center">
                               <h4 class="fw-bolder text-dark mt-2 mb-2" >{!! capitalText($product->name) !!}</h4>
                            </div>
                        </div>        
                    </a>
                </div>
                   
                @endif
            @endforeach
        @endif
        
       

    </div>
  </div>

</section>
<!--<section class="franchising">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-12 col-md-6 mb-3">-->
<!--                <div class="franchising-card">-->
<!--                  <img src="assets/themes/{{$theme}}/images/franchising-icon.png" alt="franchising-icon">-->
<!--                  <div>-->
<!--                    <h5>START A CAREER</h5>-->
<!--                    <p>Sweetie Pie is hiring and we are looking for dynamic and enthusiastic individuals to join our team.</p>-->
<!--                    <a class="form-btn btn btn-primary"  data-bs-toggle="modal" data-bs-target="#careerModal">Apply Now</a>-->
<!--                  </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="col-12 col-md-6 mb-3">-->
<!--                <div class="franchising-card">-->
<!--                  <img src="assets/themes/{{$theme}}/images/career-icon.png" alt="career-icon">-->
<!--                  <div>-->
<!--                    <h5>FRANCHISING OPPORTUNITIES</h5>-->
<!--                    <p>Become the proud owner of your own Sweetie Pie location that focuses on community and collaboration.</p>-->
<!--                    <a target="_new" class="btn btn-primary" href="http://sweetiepiefranchise.com/">Learn More</a>-->
<!--                  </div>-->
<!--                </div>-->
<!--            </div>-->
            <!-- career ModaL -->
            <!-- Modal -->
<!--            <div class="modal fade" id="careerModal" tabindex="-1" aria-labelledby="careerModalLabel" aria-hidden="true">-->
<!--                <div class="modal-dialog modal-lg">-->
<!--                    <div class="modal-content">-->
<!--                        <div class="modal-header">-->
<!--                            <h3 class="modal-title fw-bolder text-center w-100" id="careerModalLabel">START A CAREER</h3>-->
<!--                            <i class="fa fa-times fa-2x text-end text-dark" data-bs-dismiss="modal" aria-label="Close" role="button"></i>-->
<!--                        </div>-->
<!--                        <div class="modal-body bg-light">-->
<!--                            <div class="row job-application">-->
<!--                              <div class="col-12 job-application-body">-->
<!--                                <form action="{{url('store-career-request')}}" method="POST" id="form-career" novalidate enctype="multipart/form-data">-->
<!--                                    @csrf()-->
<!--                                    <div class="form-group mb-3">-->
<!--                                        <label for="store_location" class="control-label ms-1">Select a location</label>-->
<!--                                        <select id="store_location" name="location" class="form-select form-control"  required >-->
<!--                                            <option value="" selected>Select a Store</option>-->
<!--                                            @foreach($career_stores as $st_list)-->
<!--                                            <option value="{{$st_list->master_id}}">{{$st_list->name}}</option>-->
<!--                                            @endforeach-->
<!--                                        </select>-->
<!--                                    </div>-->
                                    
<!--                                    <div class="form-group mb-3">-->
<!--                                        <label for="available_position" class="control-label ms-1">Current job openings</label>-->
<!--                                        <select id="available_position" name="position" class="form-select form-control "  required >-->
<!--                                            <option value="" selected disabled>Select a store first</option>-->
<!--                                        </select>-->
<!--                                    </div>-->
<!--                                    <h4 class="col-lg-12 text-center mb-2 fw-bold">Fill out the application</h4>-->
                                    
                                    
<!--                                  <div class="form-group row">-->
<!--                                    <div class="col-lg-6 mb-3">-->
<!--                                        <input type="text" required autocomplete="off" class=" form-control " name="firstname" id="firstname" placeholder="First Name">-->
<!--                                    </div>-->
<!--                                    <div class="col-lg-6 mb-3">-->
<!--                                    <input type="text"  autocomplete="off" class=" form-control " name="lastname" id="lastname" placeholder="Last Name">-->
<!--                                    </div>-->
<!--                                  </div>-->
<!--                                  <div class="form-group row">-->
                                      
<!--                                    <div class="col-lg-6 mb-3">-->
<!--                                        <input type="text" max-length="14" required autocomplete="off" class="col-md-6 form-control no-spinners" name="phone" id="phone" placeholder="Phone">-->
<!--                                    </div>-->
                                        
<!--                                    <div class="col-lg-6 mb-3">-->
<!--                                        <input type="email" required autocomplete="off" class="col-md-6 form-control " name="email" id="email" placeholder="Email">-->
<!--                                    </div>  -->
<!--                                  </div>-->
<!--                                  <div class="form-group mb-3">-->

                                            
<!--                                                <label for="resume" class="control-label ms-1" >Upload Resume</label>-->
<!--                                                <input type="file" class="form-control" id="resume" name="resume" accept=".pdf,.doc,.docx">-->
<!--                                            <span class="text-danger file-error"></span>-->
<!--                                </div>-->
<!--                                <div class="form-group mb-3">-->
<!--                                        <label for="availability" class="control-label ms-1">My availability is</label>-->
<!--                                        <select id="availability" name="availability" class="form-select form-control "  required >-->
<!--                                            <option value="">Select availability</option>-->
<!--                                            <option value="full time">Full Time</option>-->
<!--                                            <option value="part time">Part Time</option>-->
<!--                                            <option value="full/part time">Either Full Time or Part Time</option>-->
<!--                                        </select>-->
<!--                                    </div>-->
<!--                                <div class="form-group mb-3">-->
<!--                                        <textarea name="descrption" id="descrption" class="form-control" rows="4"  placeholder="How would you make a valuable addition to our company?"></textarea>-->
<!--                                </div>-->
<!--                                <div class="form-group mb-3">-->
<!--                                    <div class="text-center">-->
<!--                                        <button class="btn btn-primary career-btn " form="form-career" type="submit"  onclick=" $('.file-error').text('')">SUBMIT APPLICATION</button>-->
<!--                                    </div>-->
                                    
<!--                                  </div>-->
<!--                                <div class="overlay"></div>-->
<!--                                <div class="loading-container">-->
<!--                                    <div class="loading">Loading...</div>-->
<!--                                </div>-->
<!--                                </form>-->
<!--                              </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</section>-->
@endsection


@section('scripts')
<script>
  document.getElementById("resume").addEventListener("change", function() {
    const fileName = this.files[0].name;
    document.getElementById("file-name").innerHTML = fileName;
  });
</script>
    <script>
    
    $(document).ready(function() {
        $('.headerOffset').css({
            'height' : $('header').height(),
        });
        $('body').on('submit', '#form-career', function(event) {
                event.preventDefault();
        
                var form = $(this);
                var formData = new FormData(form[0]);
                $('.loading').show();
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if(response == 1){
                            var rtnMsg= `<span class="d-flex justify-content-center mb-5 mt-5 fw-bold text-dark">Successfully Submitted..</span>`;
                            $('.job-application-body').html(rtnMsg);
                             $('.loading').hide();
                        }
                        else
                        {
                            var rtnMsg= `<span class="d-flex justify-content-center mb-5 mt-5 fw-bold text-dark">Failed Attempt Try again..</span>`;
                            $('.job-application-body').html(rtnMsg);
                             $('.loading').hide();
                        }
                        // Handle the successful response here
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Handle the error here
                        console.error(error);
                    }
                });
            });
       
        
        $('#resume').change(function() {
            $('.file-error').text('');
            var fileInput = this;
            var file = fileInput.files[0];

            if (file && file.size > 5 * 1024 * 1024) {
                $('.file-error').text(' Please select a file with a maximum size of 5 MB.');
                // Optionally, you can reset the file input to allow the user to select another file
                $(fileInput).val('');
                $('#file-name').text('No file selected');
            }
        });
        $('body').on('change', '#store_location', function() {
            var store_id = $(this).val();
            var url      = `{{url('get_positions')}}`;
            $.ajax({
                url: url,
                type: "GET",
                data: {store_id : store_id},
                cache: false,
                success: function(html){

                    $("#available_position").html(html);
                }
            });
        });
    });
    </script>
@endsection


