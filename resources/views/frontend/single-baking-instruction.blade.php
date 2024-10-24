@extends('layouts.frontend')
@section('contents')
  <style>
  .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: var(--bs-nav-pills-link-active-color) !important;
    background-color: var(--primary);
    }.page_section .nav-link {
        color: var(--primary) !important;
    }
    .recent-content h4{
        text-shadow: 4px 4px 2px rgba(0,0,0,0.6);
    }
    .recent-instruction .image-wrap img{
        transition: 0.8s;
    }
    .recent-instruction-card ul li a:hover img {
        transform: scale(1.2);
    }
    
  </style>
<section class="product-listing-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{$instruction->name}}</h1>
            </div>
        </div>
    </div>
</section>

<main>
    <section class="page_section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-12 col-md-12 col-lg-10">
                    <div class="row">
                        <div class="col-12 mb-3 ">
                            
                            <div class="blog-card ">
                                <div class="blog-img">
                                    <img class="object-fit-cover w-100" src="{{isset($instruction) && $instruction->picture != '' ? asset('images/blogs/'.$instruction->picture):asset('dummy.jpg')}}" alt="">
                                </div>
                                <ul class="nav nav-pills mb-3 mt-3" id="pills-tab" role="tablist">
                                  <li class="nav-item ms-auto" role="presentation">
                                    <button class="nav-link active" id="pills-baking-tab" data-bs-toggle="pill" data-bs-target="#pills-baking" type="button" role="tab" aria-controls="pills-baking" aria-selected="true">Baking</button>
                                  </li>
                                  <li class="nav-item me-auto" role="presentation">
                                    <button class="nav-link" id="pills-warming-tab" data-bs-toggle="pill" data-bs-target="#pills-warming" type="button" role="tab" aria-controls="pills-warming" aria-selected="false">Warming</button>
                                  </li>
                                  
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                  <div class="tab-pane fade show active" id="pills-baking" role="tabpanel" aria-labelledby="pills-baking-tab">
                                     @if($instruction->baking)
                                     <div>{!! $instruction->baking !!}</div>
                                     @else
                                     <p>Sorry, no instuction found.</p>
                                     @endif
                                  </div>
                                  <div class="tab-pane fade" id="pills-warming" role="tabpanel" aria-labelledby="pills-warming-tab">
                                    @if($instruction->warming)
                                     <div>{!! $instruction->warming !!}</div>
                                     @else
                                     <p>Sorry, no instuction found.</p>
                                     @endif
                                  </div>
                                </div>
                            </div>
                        </div>

                    </div>



                </div>
                
                

                <div class="col-12 col-md-12 col-lg-2">
                    <div class="for-sticky">
                        <div class="re-category recent-instruction-card">
                            <div class="row ">
                                <div class="col-12">
                                    <ul>
                                        @foreach($instructions as $items)
                                        <li class="mb-2">
                                            <a href="{{url('baking-instructions/'.$items->slug)}}"  class="text-decoration-none text-light">
                                               <div class="recent-instruction position-relative">
                                                    <div class="image-wrap overflow-hidden">
                                                        <img class="w-100 rounded" src="{{isset($instructions) && $items->picture != '' ? asset('images/blogs/'.$items->picture):asset('dummy.jpg')}}" alt="">
                                                    </div>
                                                    <div class="recent-content position-absolute w-100 h-100 top-0 d-flex align-items-center justify-content-center">
                                                        <h4 class="text-center">{{$items->name}}</h4>
                                                    </div>
                                               </div>
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        
                    </div>

                </div>


            </div>
        </div>
    </section>
</main>
{{--
<main class="pt-5 pb-5">
    <section class="">
        
    </section>

</main>
--}}

@endsection