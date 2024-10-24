@extends('layouts.frontend')

@section('styles')
    
    <style>
           
        h3 {
            font-size:110%;
            font-weight:bold;
        }
        
    </style>

@endsection


@section('contents')
<section class="product-listing-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>{{$site->heading}}</h1>
            </div>
        </div>
    </div>
</section>

<main>
    <section id="page" class="page_section">
        <div class="container">
          <div class="row justify-content-center">
              <div class="col-12 col-md-10 col-lg-8">
                    <div class="fix-wrap">
                        <div class="faq-accordions">
                            {!! str_replace("&nbsp;","",$site->html) !!}
                        </div>
                    </div>
              </div>
          </div>
        </div>
    </section>
</main>

@endsection