@extends('layouts.frontend')

@section('contents')
    
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Forget Password</h1>
                </div>
            </div>
        </div> 
    </section>
    
    <section class="page_section bg-light">
        <div class="container">
            <div class="row justify-content-center w-100 m-0">
                
              <div class="col-md-7 col-lg-5 card border-0 shadow-none p-3 mb-5 bg-body rounded">
                <div class="text-center mb-4">
                    <h2 class="text-center fw-semibold mb-0">Reset password</h2>
                </div>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form class="card-body validated not-ajax" method="POST" action="{{url('reset-password')}}" >
                        <div class=" row">
                            @csrf()
                            <div class="col-lg-12">
                                <div class="mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="email" class="form-label">Email<span class="text-danger"> *</span></label>
                                    <input placeholder="Enter your email address" type="email" name="email" class="form-control px-0 border-0 bg-light shadow-none" id="email" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-start">
                                <button type="submit" class="primary-btn border-0 px-5 mb-2 py-3 rounded-2">Send Password Reset Link</button><br>
                            </div>
                            <div class="text-start mt-3">
                                 <a href="{{url('sign-in')}}">Back to login?</a>
                            </div>
                            
                        </div>
                        
                        
                        
                    </form>
              </div>
            </div>
        </div>
    </section>

@endsection