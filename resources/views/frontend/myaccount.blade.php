
@extends('layouts.frontend')

@section('contents')
<style>
    section.my-account-page .col-lg-10 .col-lg-4{
        width: 32.3333%;
    }
    @media(max-width: 1025px){
        section.my-account-page .col-lg-10 .col-lg-4 .card{
        padding: 10px 0 !important;
        }
    }
    @media(max-width: 992px){
        section.my-account-page .col-lg-10 .col-lg-4{
            width: 49%;
        }
    }
    @media(max-width: 600px){
         section.my-account-page .col-lg-10 .col-lg-4{
            width: 100%;
        }
    }
</style>
      
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>My Account</h1>
                </div>
            </div>
        </div>
    </section>
    
    <section class="page_section my-account-page">
        <div class="container">
            <div class="row justify-content-center w-100 m-0">
              <div class="col-md-12 col-lg-10 ">
                  
                    <div class="row justify-content-between">
                        <div class="col-md-6 col-lg-4 shadow mb-3">
                            <a href="{{url('/myaccount/order-history')}}" class="text-decoration-none">
                                <div class="card border-0 p-3 bg-body rounded">
                                    <div class="card-body">
                                        <div class="row g-0">
                                            <div class="col-3">
                                                <img src="{{url('assets/images/icon-img/orders.png')}}" class="img-fluid p-2">
                                            </div>
                                            <div class="col-9">
                                                <h6>My Orders</h6>
                                                <small>View and track your orders</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-md-6 col-lg-4 shadow mb-3">
                            <a href="{{url('/myaccount/login-security')}}" class="text-decoration-none">
                                <div class="card border-0 p-3 bg-body rounded">
                                    <div class="card-body">
                                        <div class="row g-0">
                                            <div class="col-3">
                                                <img src="{{url('assets/images/icon-img/security.png')}}" class="img-fluid p-2">
                                            </div>
                                            <div class="col-9">
                                                <h6>Profile & security</h6>
                                                <small>Edit login, name, and mobile number</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-md-6 col-lg-4 shadow mb-3">
                            <a href="{{url('/myaccount/address')}}" class="text-decoration-none">
                                <div class="card border-0 p-3 bg-body rounded">
                                    <div class="card-body">
                                        <div class="row g-0">
                                            <div class="col-3">
                                                <img src="{{url('assets/images/icon-img/addresss.png')}}" style="width: 48px !important;" class="img-fluid">
                                            </div>
                                            <div class="col-9">
                                                <h6>Addresses</h6>
                                                <small>Edit addresses for orders</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        
                        <div class="col-md-6 col-lg-4 shadow mb-3">
                            
                            <a href="{{url('/myaccount/contact-us')}}" class="text-decoration-none">
                                <div class="card border-0 p-3 bg-body rounded">
                                    <div class="card-body">
                                        <div class="row g-0">
                                            <div class="col-3">
                                                <img src="{{url('assets/images/icon-img/technical-support.png')}}" class="img-fluid p-1">
                                            </div>
                                            <div class="col-9">
                                                <h6>Support Center</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection