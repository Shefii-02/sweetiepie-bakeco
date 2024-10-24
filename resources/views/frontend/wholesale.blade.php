@extends('layouts.frontend')
@section('contents')
    
<section class="product-listing-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Wholesale</h1>
            </div>
        </div>
    </div>
</section>

<main>
    <section id="wholesaleForm" class="page_section bg-light">
        <div class="container">
            <div class="row justify-content-center">
                
                <div class="col-md-8 col-lg-8 card border-0 shadow-none p-3 mb-5 bg-body rounded">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <h2 class="text-center fw-semibold mb-0 text-dark">Wholesale Inquiry Form</h2>
                        </div>
                  
                        <form class="wholesale-form"  data-classes="leadgenpro_form" action="{{route('wholesaleForm-send')}}" method="POST" novalidate>
                            @csrf()
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="theme-input-group bg-light p-2 rounded-1">
                                        <label for="">First name</label>
                                        <input type="text" autocomplete="off" name="firstname" id="name" placeholder="First Name" class="form-control px-0 border-0 bg-light shadow-none" required="">
                                    </div>
                                        
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="theme-input-group bg-light p-2 rounded-1">
                                        <label for="">Last name</label>
                                        <input type="text" autocomplete="off" name="lastname" id="s-name" placeholder="Last Name" class="form-control px-0 border-0 bg-light shadow-none" required="">
                                    </div>
                                        
                                </div>
                            </div>  
                             <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="theme-input-group bg-light p-2 rounded-1">
                                        <label for="">Phone number</label>
                                        <input type="text" autocomplete="off" name="phone" id="phone" max="14" placeholder="Phone Number" class="form-control no-spinners px-0 border-0 bg-light shadow-none" required="">
                                    </div>
                                        
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="theme-input-group bg-light p-2 rounded-1">
                                        <label for="">Email address</label>
                                        <input type="email" autocomplete="off" name="email" id="email" placeholder="Email Address" class="form-control px-0 border-0 bg-light shadow-none" required="">
                                    </div>
                                        
                                </div>
                            </div>  
                             <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="theme-input-group bg-light p-2 rounded-1">
                                        <label for="">Company name</label>
                                        <input type="text" autocomplete="off" name="company_name" id="company_name"  placeholder="Company Name" class="form-control px-0 border-0 bg-light shadow-none" required="">
                                    </div>
                                        
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="theme-input-group bg-light p-2 rounded-1">
                                        <label for="">Job title</label>
                                        <input type="text" autocomplete="off" name="position" id="position" placeholder="Job Title" class="form-control px-0 border-0 bg-light shadow-none" required="">
                                    </div>
                                        
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="theme-input-group bg-light p-2 rounded-1">
                                        <label for="">Website</label>
                                        <input type="text" autocomplete="off" name="website" id="website"  placeholder="Website" class="form-control px-0 border-0 bg-light shadow-none" required="">
                                    </div>
                                        
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="theme-input-group bg-light p-2 rounded-1">
                                        <label for="">Type of business</label>
                                        <select class="form-select px-0 border-0 bg-light shadow-none" aria-label="Default select example" name="type_business">
                                            <option selected disabled>Select an option</option>
                                              <option >Grocery</option>
                                              <option >Retail</option>
                                              <option >Restaurant</option> 
                                              <option >Coffee Shop</option>
                                              <option >Food Service</option>
                                              <option >Other</option>
                                          </select>
                                    </div>
                                        
                                </div>
                            </div>
                                
                            <div class="w-interest">
                                <div class="theme-input-group bg-light p-2 rounded-1 mb-3">
                                    <label for="">Preferred Products</label>

                                    <div class="row mt-2">
                                        <div class=" col-sm-6 mb-1">
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" name="interested[]" type="checkbox" value="Sweet Pies" id="inlineCheckbox1">
                                              <label class="form-check-label" for="inlineCheckbox1">
                                                Sweet Pies
                                              </label>
                                            </div>
                                        </div>
                                        <div class=" col-sm-6 mb-1">
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" name="interested[]" type="checkbox" value="Savory Pies" id="inlineCheckbox2">
                                              <label class="form-check-label" for="inlineCheckbox2">
                                                Savory Pies
                                              </label>
                                            </div>
                                        </div>
                                        <div class=" col-sm-6 mb-1">
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" name="interested[]" type="checkbox" value="Quiches" id="inlineCheckbox3">
                                              <label class="form-check-label" for="inlineCheckbox3">
                                                Quiches
                                              </label>
                                            </div>
                                        </div>
                                        <div class=" col-sm-6 mb-1">
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" name="interested[]" type="checkbox" value="Cookies" id="inlineCheckbox4">
                                              <label class="form-check-label" for="inlineCheckbox4">
                                                Cookies
                                              </label>
                                            </div>
                                        </div>
                                        <div class=" col-sm-6 mb-1">
                                            <div class="form-check form-check-inline">
                                              <input class="form-check-input" name="interested[]" type="checkbox" value="Butter Tarts" id="inlineCheckbox5">
                                              <label class="form-check-label" for="inlineCheckbox5">
                                                Butter Tarts
                                              </label>
                                            </div>
                                        </div>
                                        <div class=" col-sm-6 mb-1">
                                            <div class="form-check form-check-inline col-sm-6 mb-3">
                                              <input class="form-check-input" name="interested[]" type="checkbox" value="Cake Jars" id="inlineCheckbox6">
                                              <label class="form-check-label" for="inlineCheckbox6">
                                                Cake Jars
                                              </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <div class="theme-input-group bg-light p-2 rounded-1">
                                            <label for="">Message</label>
                                            <textarea autocomplete="off" rows="5" name="message" id="message" placeholder="Tell us about your business" class="form-control px-0 border-0 bg-light shadow-none" spellcheck="false"></textarea>
                                        </div>
                                        
                                    </div>
                                </div>
                                 <div class="row">
                                    <div class="d-flex">
                                        <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}" data-callback="enableBtn"></div>
                                    </div>
                                </div>
                                <div class="text-start mt-3">
                                     <input type="hidden" name="success_url" >
                                    <button class="primary-btn border-0 px-5 mb-2 py-3 rounded-2" type="submit" >SEND INQUIRY</button>
                                </div>
    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection