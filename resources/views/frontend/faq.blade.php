@extends('layouts.frontend')
@section('contents')
    
<section class="product-listing-banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>FAQs</h1>
            </div>
        </div>
    </div>
</section>



<main class="pb-5 pt-5">
    <section class="faq-section">
        <div class="container">
            <div class="fix-wrap"> 
                <div class="faq-accordions">
                    @if(count($general)>0)
                        <h2>General</h2>
                        @foreach($general as $list)
                        <div class="accordion-row">
                            <div class="title">{{$list->question}}</div>
                            <div class="content">
                                {{$list->answer}}
                            </div>
                        </div>
                        @endforeach 
                    @endif
                    @if(count($substitutions)>0)
                        <h2>Substitutions</h2>
                        @foreach($substitutions as $list)
                            <div class="accordion-row">
                                <div class="title">{{$list->question}}</div>
                                <div class="content">
                                    {{$list->answer}}
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if(count($discounts)>0)
                        <h2>Discounts</h2>
                        @foreach($discounts as $list)
                            <div class="accordion-row">
                                <div class="title">{{$list->question}}</div>
                                <div class="content">
                                    {{$list->answer}}
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if(count($returns)>0)
                        <h2>Returns</h2>
                        @foreach($returns as $list)
                            <div class="accordion-row">
                                <div class="title">{{$list->question}}
                                </div>
                                <div class="content">
                                    {{$list->answer}}
                                </div>
                            </div>
                        @endforeach
                    @endif


                </div>
            </div>
        </div>
    </section>




    <script>
        let items = document.querySelectorAll(".faq-section .faq-accordions .title");
        items.forEach(function (t) {
            t.addEventListener("click", function (e) {
                items.forEach(function (e) {
                    e !== t || e.classList.contains("open")
                        ? e.classList.remove("open")
                        : e.classList.add("open");
                });
            });
        });
    </script>

</main>




@endsection