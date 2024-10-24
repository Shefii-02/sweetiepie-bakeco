 @extends('layouts.frontend')
@section('styles')


@endsection

@section('contents')


<section class="product-listing-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                 <h1>
                    Catering Menu
                </h1>
            </div>
        </div>
    </div>
</section>



<section class="get-catering">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6">

                <div class="cat-content">
                    <h2>Let Sweetie Pie Cater Your Next Event</h2>
                    <p>Choose from our sweet variety of treats</p>

                    <div class="row">
                        <div class="col-4">
                            <img class="w-100"
                                src="assets/images/icon-img/pie.png"
                                alt="">
                            <p class=" g-c-p text-center" >Sweet Pies</p>
                        </div>

                        <div class="col-4">
                            <img class="w-100"
                                src="assets/images/icon-img/sr pir.png"
                                alt="">
                            <p class="g-c-p text-center" >Savory Pies</p>
                        </div>

                        <div class="col-4">
                            <img class="w-100"
                                src="assets/images/icon-img/quiche.png"
                                alt="">
                            <p class="g-c-p text-center" >Quiche</p>
                        </div>



                        <!--  -->
                        <div class="col-4">
                            <img class="w-100"
                                src="assets/images/icon-img/cup cake.png"
                                alt="">
                            <p class="g-c-p text-center">Baked Goods</p>
                        </div>

                        <div class="col-4">
                            <img class="w-100"
                                src="assets/images/icon-img/cookie.png"
                                alt="">
                            <p class="g-c-p text-center">Gourmet Cookies</p>
                        </div>

                        <div class="col-4">
                            <img class="w-100"
                                src="assets/images/icon-img/bottle cake.png"
                                alt="">
                            <p class=" g-c-p text-center" >Cake in a Jar</p>
                        </div>
                    </div>


                </div>

            </div>
            <div class="col-12 col-md-6">
               
                <form action="{{route('catering-send')}}" class=""  data-classes="leadgenpro_form" method="POST" novalidate>
                    @csrf()
                    <div class="category-form">
                        <h2>Create Your Account and Gain Access to Your Personal Catering Representative</h2>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <input type="text" autocomplete="off" name="fullname" id="fullname"  placeholder="Your Name" class="form-control" required="">
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="text" autocomplete="off" name="phone" id="phone"  maxlength="14" placeholder="Contact Number" class="form-control" required="">
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="text" autocomplete="off" name="company" id="company"  placeholder="Your Company" class="form-control" required="">
                        </div>
                        <div class="col-md-12 mb-3">
                            <input type="email" autocomplete="off" name="email" id="email"  placeholder="Email Address" class="form-control" required="">
                        </div>
                        <div class="col-md-12 mb-3">
                            <textarea autocomplete="off" name="message" id="message"  placeholder="Message" class="form-control" required="" rows="6"></textarea>
                        </div>
                        <div class="row">
                            <div class="d-flex justify-content-center  mb-5">
                                <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}" data-callback="enableBtn"></div>
                            </div>
                        </div>
                        <div class="text-center">
                             <input type="hidden" name="success_url" >
                            <button type="submit">Submit</button>
                        </div>         
                    </div>

                    
                </form>

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