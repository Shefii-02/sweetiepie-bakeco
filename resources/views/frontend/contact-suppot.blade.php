
@extends('layouts.frontend')
@section('styles')

@endsection
@section('contents')
      
    <section class="product-listing-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 text-left">
                    <h1>Support Center</h1>
                </div>
            </div>
        </div>
    </section>
    
    <section class=" pb-5 pt-5">
        <div class="container">
           
            <div class="row justify-content-center">
                <div class="col-md-10 ">
                         
                    <nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"  class="mb-2">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('myaccount')}}">My Account</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Support Center</li>
                      </ol>
                    </nav>
                    
                    <div class="col-md-12">
                        <div class="row ">
                            @foreach(App\Models\Store::where('status',1)->get() as $stores)
       
                            <div class="col-md-6 col-lg-4">
                           
                                <div class="card border-0 shadow-lg p-3 mb-5 bg-body rounded">
                                    <div class="card-body text-center">
                                        <div class="row g-0">
                                            <div class="col-12">
                                                <img src="{{url('/assets/images/icon-img/storefront.png')}}" class="img-fluid p-2">
                                            </div>
                                            <div class="col-12">
                                                <h6>{{titleText($stores->name)}}</h6>
                                                    <small>{{titleText($stores->address)}}</small><br>
                                                    <small>{{titleText($stores->city)}},{{titleText($stores->postal_code)}},{{titleText($stores->province)}}</small>
                                                    <p class="text-center">
                                                        <a class="mb-1 store_button" href="tel:+14166759436"><i class="bi bi-telephone"></i> Call</a>
                                                        <a class="mb-1 store_button" href="{{url('contact?store='.$stores->slug)}}"><i class="bi bi-envelope "></i> Inquiry</a>
                                                    </p>
                                                    <p class="text-center">
                                                       <a class="mb-1 store_button" target="map_new" href="{{$stores->map_link}}"><i class="bi bi-geo"></i> Directions</a>
                                                    </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    <!-- Modal -->
    <div class="modal fade" id="new_Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="new_ModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="new_ModalLabel">Add Address</h5>
            <i class="btn-close fa fa-times text-dark fa-2x" data-bs-dismiss="modal" aria-label="Close"></i>
          </div>
          <div class="modal-body">
              <form action="" class="row">
                  <div class="col-lg-6 form-group mb-2">
                      <label class="mb-2" for="">Card Number</label>
                      <input type="text" class="form-control" name="lastname">
                  </div>
                  <div class="col-lg-6 form-group mb-2">
                      <label class="mb-2" for="">Full Name on Card</label>
                      <input type="text" class="form-control" name="firstname">
                  </div>
                 
                  <div class="col-lg-6 form-group mb-2">
                      <label class="mb-2" for="">Exp:Date</label>
                      <input type="text" class="form-control" name="city">
                  </div> 
                  <div class="col-lg-6 form-group mb-2">
                      <label class="mb-2" for="">Security Code</label>
                      <input type="text" class="form-control" name="postalcode">
                  </div>
                 
              </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
@endsection    


@section('scripts')
<script>


</script>
@endsection
                 