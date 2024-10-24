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
    
    <section class=" pb-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
              <div class="col-md-5 card border-0 shadow-lg p-3 mb-5 bg-body rounded">
                    <form class="card-body"  action="{{url('sign-up')}}" >
                        <div class=" row">
                            @csrf()
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Password<span class="text-danger"> *</span></label>
                                    <input type="email" class="form-control" id="email" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Confirm Password<span class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" id="password" required>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-dark rounded-pill mt-3 mb-3 pe-4 ps-4">Sign In</button><br>
                            </div>
                           
                        </div>
                        
                        
                        
                    </form>
              </div>
            </div>
        </div>
    </section>
    
    
@endsection