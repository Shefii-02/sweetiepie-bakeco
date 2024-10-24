@extends('layouts.frontend')

@section('contents')
    
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Sign In</h1>
                </div>
            </div>
        </div>
    </section>
    
    <section class=" page_section bg-light">
        <div class="container">
            <div class="row justify-content-center w-100 m-0">
              <div class="col-md-7 col-lg-5 card border-0 shadow-none p-3 mb-5 bg-body rounded">
                    
                    <form class="card-body validated not-ajax" method="post"  action="{{url('sign-in')}}" novalidate>
                        <div class="text-center mb-4">
                            <h2 class="text-center fw-semibold mb-0">Customer Sign-in</h2>
                        <div class="fs-5">ARE YOU A NEW CUSTOMER?</div>
                        <div class="mb-2">Don't have an account?</div>
                        <a class="d-block mb-2" href="{{url('sign-up')}}">Register Here</a>
                        <div>It's FREE</div>
                        </div>
                        <div class=" row">
                            @csrf()
                            <div class="col-lg-12">
                                <div class="mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="email" class="form-label">Email<span class="text-danger"> *</span></label>
                                    <input placeholder="Enter your email" type="email" autocomplete="off" class="form-control border-0 bg-light shadow-none px-0" name="email" id="email" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="password" class="form-label">Password<span class="text-danger"> *</span></label>
                                    <input placeholder="Enter your secret password" type="password" autocomplete="new-password" class="form-control px-0 border-0 bg-light shadow-none" name="password" id="password" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check d-flex justify-content-left mb-2 mb-md-4">
                                            <input class="form-check-input me-2" type="checkbox" value="1" id="remember" name="remember" aria-describedby="registerCheckHelpText">
                                            <label class="form-check-label" for="remember">
                                              Remember me
                                            </label>
                                        </div>  
                                    </div>
                                </div>
                               
                            </div>
                            <div class="text-start text-left mb-2">
                                <button type="submit" class="primary-btn border-0 px-5 py-3 rounded-2">Sign In</button><br>
                            </div>
                            <a href="{{url('forget-password')}}">Forgot password?</a>
                        </div>
                        
                        
                        
                    </form>
              </div>
            </div>
        </div>
    </section>
    
    
@endsection