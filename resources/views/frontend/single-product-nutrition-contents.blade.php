<section class="product-detail-slider p-0">
    <div class="container">

        <div class="row">
            <!-- card left -->

            <div class="col-12 col-md-6 position-relative">
                <div class="">
                    <div class="slider-for ">
                        <!--  img-showcase -->
                        <div>
                                <img class="w-100" src="{{ asset('images/products/' . product_thumbImage($products->id)) }}"
                                    onerror="this.onerror=null;this.src='/assets/images/dummy-product.jpg';"
                                    alt="cookie image">
                            </div>
                    </div>
                </div>
            </div>

            <!-- card right -->
            <div class="col-12 col-md-6">
                <div class="product-content">
                    <h2 class="product-title">{!! titleText($products->name) !!}</h2>
                    @empty($products->description)
                    @else
                        <div class="product-detail">
                            {!! $products->description !!}
                        </div>
                        
                        @endif
                        @if ($products->product_specializations()->count())
                            <div class="product-detail mb-3">
                                <h3 class="">Dietary Considerations:</h3>
                                <div class="d-flex">
                                    @foreach ($products->product_specializations()->get() as $sp)
                                        <img src="{{ asset('/images/specialization/'.$sp->icon) }}" width="80" class="me-2">
                                       <div class="d-none">
                                            <div class="d-flex align-items-center me-1 bg-light rounded-circle">
                                            <span class="m-auto small text-center">{{ $sp->name }}</span>
                                        </div>
                                       </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <hr>
                        <div>
                             @if(count($products->option)>0 && ($products->has_variation == 1))
                                        @php
                                            $options = $products->option->pluck('type')->unique()->toArray();
                                            if(in_array('size', $options))
                                                $first_option = 'size';
                                            elseif(in_array('type', $options))
                                                $first_option = 'type';
                                            else
                                                $first_option = 'color';
                                        @endphp
                           
                                <!--//mutiple variation-->
                                <div class="product__variations">
                                    <h3 class="">Choose your option:</h3>
                                    <!--//mutiple variation-->
                                    <div class="row position-relative">
                                        @php
                                            $uniq_types = $products->option()->where('type',$first_option)->get();
                                        @endphp
                                        @foreach ($uniq_types->unique('value') as $key1 => $size_items)
                                            <div class="col-12 d-flex align-items-center mb-4">
                                               @php
                                                    if($first_option == 'size')
                                                        if(in_array('type', $options))
                                                    	    $second_option = 'type';
                                                    	else
                                                    	    $second_option = 'color';
                                                    elseif($first_option == 'type')
                                                        if(in_array('color', $options))
                                                    	    $second_option = 'color';
                                                    else
                                                            $second_option = '';
                                                @endphp
                                               
                                                    @if($products->option->where('type', $second_option)->count() == 0)
                                                        @php
                                                            $variation_data = App\Models\VariationKey::leftJoin('product_variations', 'variation_keys.variation_id', 'product_variations.id')
                                                                ->where(function ($query) {
                                                                    return $query->where('product_variations.sku', '<>', '')->orWhere('product_variations.sku', '<>', null);
                                                                })
                                                                ->where('value', $size_items->value)
                                                                ->where('product_variations.product_id', $products->id)
                                                                ->first();
                                                        @endphp
                                                    @endif

                                                <div class="">
                                                    <input type="radio" name="single_selection"
                                                        @if ($products->option->where('type', $second_option)->count() == 0 && $variation_data) data-vname="{{ $variation_data->variation }}" data-price="{{ $variation_data->price }}" data-id="{{ $variation_data->variation_id }}" @endif
                                                        data-option="{{ $size_items->id }}"
                                                        @if ($key1 == 0) checked @endif
                                                        class="vari_checkbox @if (!($products->option->where('type', $second_option)->count() > 0)) option__type @endif"
                                                        id="checkbox_option_rounded_{{ $size_items->id }}" hidden>
                                                    <label for="checkbox_option_rounded_{{ $size_items->id }}"
                                                        class="btn btn-light border-0 d-flex align-items-center me-2">
                                                        <span class="m-auto">{{ $size_items->value }}</span>
                                                    </label>
                                                </div>
                                                <div class="w-100 ms-4 variants" style="display:none">
                                                    @if ($products->option->where('type', $second_option)->count() > 0)
                                                        <div class="w-100">
                                                            <div class="row align-items-center">
                                                                @php
                                                                    $ii = 0;
                                                                    $third_option ='';
                                                                    if($second_option == 'type'){
                                                                        if(in_array('color', $options))
                                                                    	    $third_option = 'color';
                                                                        else
                                                                            $third_option = '';
                                                                    }
                                                                    $key2 = 0
                                                                @endphp
                                                                @php
                                                                    // $uniq_values = $products->option()->where('type',$second_option)->get();
                                                                    $firstOption_Vids = $products->option()->where('type',$first_option)->where('value',$size_items->value)->pluck('variation_id')->toArray();
                                                                    $uniq_values = $products->option()->where('type',$second_option)->whereIn('variation_id',$firstOption_Vids)->get();
                                                                   
                                                                @endphp
                                                                    @foreach($uniq_values as $type_items)
                                                                    @if ($products->option->where('type', $second_option)->count() == 0)
                                                                        @php
                                                                            $variation_data = App\Models\VariationKey::leftJoin('product_variations','variation_keys.variation_id','product_variations.id')
                                                                                            ->where(function($query){
                                                                                                 return $query
                                                                                                        ->where('product_variations.sku', '<>','')
                                                                                                        ->orWhere('product_variations.sku', '<>',NULL);
                                                                     						})
                                                                     						->where('value',$size_items->value)
                                                                                            ->where('product_variations.product_id',$products->id)
                                                                                            ->first(); 
                                                                        @endphp
                                                                    @else
                                                                        @php
                                                                            $vari_ids = $products->variationList->where('value',$size_items->value)->pluck('variation_id');
                                                                            $variation_data = App\Models\VariationKey::leftJoin('product_variations','variation_keys.variation_id','product_variations.id')
                                                                                                                    ->where(function($query){
                                                                                                                         return $query
                                                                                                                                ->where('product_variations.sku', '<>','')
                                                                                                                                ->orWhere('product_variations.sku', '<>',NULL);
                                                                                             						})
                                                                                                                    ->where('product_variations.product_id',$products->id)
                                                                                                                    ->where('value',$type_items->value)
                                                                                                                    ->whereIn('variation_id',$vari_ids)
                                                                                                                    ->first(); 
                                                    
                                                                        @endphp
                                                                    @endif
                                                                    @if ($variation_data)
                                                                        <div class="col-6 col-md-3 text-center">
                                                                            <div class="">
                                                                                <input type="radio" class="option__type"
                                                                                    name="vari_type"
                                                                                    @if ($key1 == 0 && $ii == 0) checked @endif
                                                                                    id="radio_rounded_{{ $key1 }}_{{ $key2 }}"
                                                                                    hidden>
                                                                                <label
                                                                                    for="radio_rounded_{{ $key1 }}_{{ $key2 }}"
                                                                                    class="btn btn-light border-0 me-2">
                                                                                    <span
                                                                                        class="m-auto">{{ $variation_data->value }}</span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        @php
                                                                            $ii = $ii + 1;
                                                                            $key2++;
                                                                        @endphp
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12">
    
 

                    
                    
                @if (count($products->option) > 0 && $products->has_variation == 1)
                    @php
                        $uniq_types = $products->option()->where('type',$first_option)->get();
                    @endphp
                       @foreach ($uniq_types->unique('value') as $key1 => $size_items)
                            @php
                                if($first_option == 'size')
                                    if(in_array('type', $options))
                                	    $second_option = 'type';
                                	else
                                	    $second_option = 'color';
                                elseif($first_option == 'type')
                                    if(in_array('color', $options))
                                	    $second_option = 'color';
                                else
                                        $second_option = '';
                            @endphp
                            
                            @if ($products->option->where('type', $second_option)->count() == 0)
                                @php
                                    $variation_data = App\Models\VariationKey::leftJoin('product_variations', 'variation_keys.variation_id', 'product_variations.id')
                                        ->where(function ($query) {
                                            return $query->where('product_variations.sku', '<>', '')->orWhere('product_variations.sku', '<>', null);
                                        })
                                        ->where('value', $size_items->value)
                                        ->where('product_variations.product_id', $products->id)
                                        ->first();
                                @endphp
                            @endif

                            @if ($products->option->where('type', $second_option)->count() > 0)
                                @php
                                    $ii = 0;
                                    $third_option ='';
                                    if($second_option == 'type'){
                                        if(in_array('color', $options))
                                    	    $third_option = 'color';
                                        else
                                            $third_option = '';
                                    }
                                    $key2 = 0
                                @endphp
                                 @php
                                    // $uniq_values = $products->option()->where('type',$second_option)->get();
                                    $firstOption_Vids = $products->option()->where('type',$first_option)->where('value',$size_items->value)->pluck('variation_id')->toArray();
                                    $uniq_values = $products->option()->where('type',$second_option)->whereIn('variation_id',$firstOption_Vids)->get();
                                   
                                @endphp
                                    @foreach($uniq_values as $type_items)
                                    @if ($products->option->where('type', $second_option)->count() == 0)
                                        @php
                                            $variation_data = App\Models\VariationKey::leftJoin('product_variations','variation_keys.variation_id','product_variations.id')
                                                            ->where(function($query){
                                                                 return $query
                                                                        ->where('product_variations.sku', '<>','')
                                                                        ->orWhere('product_variations.sku', '<>',NULL);
                                     						})
                                     						->where('value',$size_items->value)
                                                            ->where('product_variations.product_id',$products->id)
                                                            ->first(); 
                                        @endphp
                                    @else
                                        @php
                                            $vari_ids = $products->variationList->where('value',$size_items->value)->pluck('variation_id');
                                            $variation_data = App\Models\VariationKey::leftJoin('product_variations','variation_keys.variation_id','product_variations.id')
                                                                                    ->where(function($query){
                                                                                         return $query
                                                                                                ->where('product_variations.sku', '<>','')
                                                                                                ->orWhere('product_variations.sku', '<>',NULL);
                                                             						})
                                                                                    ->where('product_variations.product_id',$products->id)
                                                                                    ->where('value',$type_items->value)
                                                                                    ->whereIn('variation_id',$vari_ids)
                                                                                    ->first(); 
                    
                                        @endphp
                                    @endif
                                    @if ($variation_data)
                                        <div class="alert bg-white border-0 row nutritionDetails px-0 radio_rounded_{{ $key1 }}_{{ $key2 }}"
                                            style="display:none">
                                            <div class="row m-auto">
                                                
                                                @forelse (\App\Models\NutritionExplorer::whereVariationId($variation_data->id)->get() as $nutri)
                                                    <div
                                                        class="col-xl-1 col-6 col-md-2 nutrition-values text-center border p-0">
                                                        <div class="p-3 border-bottom small px-1">
                                                            {{ $nutri->nutrition_title }}
                                                        </div>
                                                        <div class="fw-semibold text-theme p-3">
                                                            {{ $nutri->nutrition_value }}
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="col-12">
                                                        Sorry, no data found.
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                        @php
                                            $ii = $ii + 1;
                                            $key2++;
                                        @endphp
                                    @endif
                                @endforeach
                            @else
                                <div
                                    class="alert bg-white border-0 row nutritionDetails px-0 checkbox_option_rounded_{{ $size_items->id }}"style="display:none">
                                    <div class="row m-auto">
                                        @php
                                            $nutrients = \App\Models\NutritionExplorer::whereVariationId($products->product_variation()->first()->id)->get();
                                        @endphp
                                        @forelse ($nutrients as $nutri)
                                            <div class="col-xl-1 col-6 col-md-2 nutrition-values text-center border p-0">
                                                <div class="p-3 border-bottom small px-1">
                                                    {{ $nutri->nutrition_title }}
                                                </div>
                                                <div class="fw-semibold text-theme p-3">
                                                    {{ $nutri->nutrition_value }}
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                Sorry, no data found.
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            @endif
                        @endforeach
                </div>
            @else
                <div class="alert bg-white border-0  px-0 row">
                    <div class="row m-auto">
                        @forelse (\App\Models\NutritionExplorer::whereVariationId($products->product_variation()->first()->id)->get() as $nutri)
                            <div class="col-xl-1 col-6 col-md-2 nutrition-values text-center border p-0">
                                <div class="p-3 border-bottom small px-1">
                                    {{ $nutri->nutrition_title }}
                                </div>
                                <div class="fw-semibold text-theme p-3">
                                    {{ $nutri->nutrition_value }}
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                Sorry, no data found.
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
            </div>

        </div>
        </div>



    </section>
