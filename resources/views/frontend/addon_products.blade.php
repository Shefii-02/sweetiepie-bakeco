<div class="container">
    @foreach($items as $list) 
        @php
            $veriation_pdcts = App\Models\AddonProduct::leftJoin('products','products.master_id','addon_products.veriation_id')
                                                        ->leftJoin('product_variations','product_variations.product_id','products.id')
                                                        ->where('addon_products.product_id',$list->product_id)
                                                        ->select('products.picture','products.name','product_variations.price','product_variations.id','product_variations.variation','product_variations.product_id')
                                                        ->get();       
        @endphp
               
        @if($veriation_pdcts->count() > 0)
            <div class="col-md-12 ">
                <div class="row align-items-center">
                    <div class="col-md-4 position-relative">
                      <img src="{{asset('images/products/'.$list->picture)}}" alt="Product Image" class="w-75 mb-3 img-thumbnail border border-light-subtle border-opacity-100 ">
                      <span class="item-count-addon">{{$list->quantity}}</span>
                    </div>
                    <div class="col-md-8">
                        <div class="row align-items-center">
                            <div class="col-lg-8 d-flex flex-column">
                                <p class="fw-bold">{{$list->product_name}}</p>
                                <small>{{$list->variation}}</small>
                                <small class="fw-bolder">{{getPrice($list->price_amount)}}</small>
                            </div>
                            <div class="col-lg-4">
                                <p class="fw-bolder text-primary-emphasis float-end float-md-start h2">{{getPrice($list->price_amount * $list->quantity)}}</p>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-2">
               
                
               <div class="row flex-nowrap overflow-x-scroll" id="s-style-2">
                   <style>
                        #s-style-2::-webkit-scrollbar-track
                        {
                        	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
                        	border-radius: 10px;
                        	background-color: #F5F5F5;
                        }
                        
                        #s-style-2::-webkit-scrollbar
                        {
                        	width: 12px;
                        	background-color: #F5F5F5;
                        }
                        
                        #s-style-2::-webkit-scrollbar-thumb
                        {
                        	border-radius: 10px;
                        	-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
                        	background-color: var(--primary);
                        }
                   </style>
                   
                                <!--  -->
                    @foreach($veriation_pdcts->unique('id') as $addon_items)
                    
                        <div class="col-md-4 mt-3 mb-3">
                            <div class="card position-relative bg-light">
                               
                                <div class="row">
                                    <div class="col-md-12 position-relative">
                                        <img src="{{asset('images/products/'.product_thumbImage($addon_items->product_id))}}"  class="card-img-top" alt="Product Image">
                                    </div>
                                    <div class="col-md-12 d-flex align-items-center justify-content-around flex-column-reverse">
                                        <p class="card-price fw-bold mb-0">{{getPrice($addon_items->price)}} </p>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <p class="small fw-bolder text-capitalize mb-0">{{$addon_items->name}}</p>
                                    <p class="small fw-bolder text-capitalize mb-0">{{$addon_items->variation}}</p>
                                    <div class="round-checkbox ">
                                        <input type="checkbox"  id="checkbox_rounded_{{$addon_items->id }}" data-parent_id="{{$list->id}}" class="addon-pdct-btn"  data-pid="{{$addon_items->id }}" data-price="{{$addon_items->price }}" />
                                        <label for="checkbox_rounded_{{$addon_items->id }}"></label>
                                    </div>
                                </div>
                            </div>
                            <span class="alert__msg_{{$addon_items->id }} text-center text-light"></span>
                        </div>
                       
                    @endforeach
                </div>
                
            </div>
        
        @endif
    
    @endforeach
</div>
