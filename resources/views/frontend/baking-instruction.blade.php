@extends('layouts.frontend')
@section('contents')
    <style>
        a{
            text-decoration: none;
            color: var(--white);
        }
        #bakingInstruction a h1{
            text-shadow: 4px 4px 2px rgba(0,0,0,0.6);
        }
        #bakingInstruction a img {
            transition: 0.8s;
        }
        #bakingInstruction a:hover img {
            transform: scale(1.2);
        }
    </style>
<section class="product-listing-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Baking/Warming Instructions</h1>
            </div>
        </div>
    </div>
</section>
<main>
    <section id="bakingInstruction" class="page_section">
        <div class="container">
            <div class="row justify-content-center">
                @foreach($instructions as $items)
                <div class="col-12 col-sm-6 col-md-4 mb-4">
                    <a class="w-100" href="{{url('baking-instructions/'.$items->slug)}}">
                        <div class="instruction-product position-relative">
                            <div class="image-wrapper overflow-hidden">
                                <img class="w-100" src="{{isset($instructions) && $items->picture != '' ? asset('images/blogs/'.$items->picture):asset('dummy.jpg')}}" alt="">
                            </div>
                            <div class="instruction-name position-absolute w-100 h-100 d-flex top-0 justify-content-center align-items-center">
                                <h1 class="fw-bolder display-5 display-lg-4 text-center">{{$items->name}}</h1>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
{{--
<section class="blog-area pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-9">
                    <div class="row">
                        @foreach($instructions as $items)
                        <div class="col-12 col-md-6 ">
                            <a href="{{url('baking-instructions/'.$items->slug)}}" class="text-decoration-none">
                                <div class="blog-card shadow">
                                    <div class="blog-img">
                                        <img src="{{isset($instructions) && $items->picture != '' ? asset('images/blogs/'.$items->picture):asset('dummy.jpg')}}" alt="">
                                    </div>
                                    <div class="blog-content">
                                        <h2>{{$items->name}}</h2>
                                        <div class="d-none">
                                            {!! Str::limit($items->description, 30, ' ...') !!}                                   
                                         </div>
                                        <a href="{{url('baking-instructions/'.$items->slug)}}">Read more </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>



                </div>
                <div class="col-12 col-md-12 col-lg-3">
                    <div class="for-sticky">
                        <div class="re-category mt-3">
                            <div class="row ">
                                <div class="col-12">
                                    <ul>
                                         @foreach($instructions as $items)
                                        <li>
                                            <a href="{{url('baking-instructions/'.$items->slug)}}"  class="text-decoration-none">
                                                <img src="{{isset($instructions) && $items->picture != '' ? asset('images/blogs/'.$items->picture):asset('dummy.jpg')}}" alt="">
                                                <div class="recent-content">
                                                    <h5>{{$items->name}}</h5>
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
--}}

@endsection