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
    
    <section class=" pb-5 pt-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
               
              <div class="col-md-5 card border-0 shadow-none p-3 mb-5 bg-body rounded">
                <div class="text-center mb-4">
                    <h2 class="text-center fw-semibold mb-0">Reset password</h2>
                </div>
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form class="card-body validated not-ajax" method="POST" action="{{url('new-password')}}" >
                        <div class=" row">
                            @csrf()
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="col-lg-12">
                                <div class="mb-3 mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="new_password" class="form-label">New Password<span class="text-danger"> *</span></label>
                                    <input type="password" placeholder="Enter your new password" name="password" class="form-control form-control px-0 border-0 bg-light shadow-none" id="new_password" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 mb-3 theme-input-group bg-light p-2 rounded-1">
                                    <label for="confirm_password" class="form-label">Confirm Password<span class="text-danger"> *</span></label>
                                    <input type="password" placeholder="Confirm your new password" name="password_confirmation" class="form-control form-control px-0 border-0 bg-light shadow-none" id="confirm_password" required>
                                </div>
                            </div>
                            <div class="">
                                <button type="submit" class="primary-btn border-0 px-5 mb-2 py-3 rounded-2">Reset password</button><br>
                            </div>
                            <div class=" mt-3">
                                 <a href="{{url('sign-in')}}">Back to login?</a>
                            </div>
                            
                        </div>
                        
                        
                        
                    </form>
              </div>
            </div>
        </div>
    </section>

@endsection