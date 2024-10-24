@extends('layouts.frontend')

@section('contents')
    
<section class="product-listing-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Media</h1>
            </div>
        </div>
    </div>
</section>

<main>
  <section class="page_section d-flex align-items-center" style="min-height: 50vh">
      <div class="container">
    <div class="row justify-content-center">
        @foreach($media as $items)
            <div class=" col-9 col-md-8 col-lg-2 mb-2 d-flex align-items-center justify-content-center">
               <div class="shadow-sm p-2">
                    <a href="{{$items->link}}" target="_new">
                    <img src="{!!$items->image != '' ? asset('images/media/'.$items->image):asset('dummy.jpg')!!}" title="{{$items->title}}" alt="{{$items->title}}" class=" w-100">
                </a>
               </div>
            </div>
        @endforeach
    </div>
  </div>
  </section>
</main>


@endsection