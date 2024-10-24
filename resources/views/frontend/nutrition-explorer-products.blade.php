 <div class="products-list position-relative">
     <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
     @foreach($products as $list)
     <div class="col">
                                <a dataid="{{ $list->id }}" href="{{url('nutrition-explorer/'.$list->slug)}}" class="cursor-pointer text-decoration-none nutri-item" >
                                  <div class="card h-100 border-0   rounded ">
                                    <img class="w-100" src="{{asset('images/products/'.product_thumbImage($list->id))}}" onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';" alt="{{ $list->name }}" >
                                    <div class="card-body text-center pt-0 pb-0">
                                       <h4 class="mb-3 fw-bold text-dark" >{!! capitalText($list->name) !!}</h4>
                                    </div>
                                  </div>
                                </a>
                            </div>
     @endforeach
     </div>
     <div>
         @if(!$products->count())
         <div class="my-4">
         <div class="alert bg-light border-0 rounded-1">
         Sorry, no products matched your search, Please try something else.
        </div>
     </div>
         @endif
</div>