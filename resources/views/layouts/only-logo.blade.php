<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="keywords" content="@yield('keywords')">
  <meta name="description" content="@yield('description')">
  <meta name="token" content="{{csrf_token()}}">
  <title>@yield('title') Sweetiepie bakeco</title>
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/images/Fav/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/Fav/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/Fav/favicon-16x16.png') }}">
  <link rel="manifest" href="{{ asset('assets/images/Fav/site.webmanifest') }}">
  <link rel="mask-icon" href="{{ asset('assets/images/Fav/safari-pinned-tab.svg') }}" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
   <link rel="stylesheet" href="{{ asset('assets/themes/'.$theme.'/css/style.css?v=5.7') }}" />
  <link rel="stylesheet" href="{{ asset('assets/themes/'.$theme.'/css/newstyle.css?v=5.4') }}" />
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
 <script async src="https://www.googletagmanager.com/gtag/js?id=UA-22591984-31"></script>

    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-22591984-31');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->

@yield('styles')
<style>
    .element-error::after {
        content: attr(data-error);
        font-size: small;
        color: red;
    }
     header .first-li-div a img.only-logo-page{
            width:300px !important;
            position: absolute;
            top:0;
        }
        .header-first-col{
            padding-top: 24px;
            padding-bottom: 24px;
        }
   
    @media(max-width: 600px){
        .first-li-div li a img:nth-child(2) {
            width: 200px !important;
            margin-left: 100px !important;
        }
        header .first-li-div a img.only-logo-page{
            width:180px !important;
            position: absolute;
            top:0;
        }
    }
</style>

</head>

<body>
  <header>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 header-first-col shadow-sm rounded-0" style="position: relative;">
          <ul class="first-ul">
            <div class="first-li-div">
              <li>
                <a href="/"><img class="" width="50" src="{{ asset('assets/images/mspt.webp')}}" alt="Sweetie Pie Home" /></a>
              </li>
            </div>
            <div class="second-li-div">
              
                <li>
                    <a href="@if(auth()->check() == true) {{ url('myaccount') }} @else {{ url('sign-in') }}@endif" ><i class="fa fa-user-o" style="font-size: 20px;"></i></a>
                </li>
            </div>
          </ul>
        </div>
      </div>
    </div>
  </header>

  @yield('contents')




<section class="f-bottom" style="background: #000;">
    <div class="container-fluid" style="border-top: 1px solid rgba(255,255,255,.1)">
        <div class="row">
            <div class="col-12">
                <p>&COPY;{{date("Y")}} Sweetiepiebakeco.ca. All rights are reserved.</p>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places"></script>
<script src="{{ asset('assets/js/autofilldata.js?v=1.4') }}"></script>
    
<script src="{{ asset('assets/js/mask.js?v=3') }}"></script>
<script src="{{ asset('assets/js/script.js?v=3.4') }}"></script>
<script src="{{ asset('assets/js/formsubmit.js?v=3.6') }}"></script>




@yield('scripts')



<script>
function alertJsFunction($message,$type){
  //  Swal.fire($message,'',$type)    
}
</script>
@if (\Session::has('failed'))
<script>
    alertJsFunction(`{!! \Session::get('failed') !!}`, 'error');
</script>
@elseif (\Session::has('error'))
<script>
    alertJsFunction(`{!! \Session::get('error') !!}`, 'error');
</script>
@elseif (\Session::has('success'))
<script>
    alertJsFunction(`{!! \Session::get('success') !!}`, 'success');
</script>
@elseif (\Session::has('warning'))
<script>
    alertJsFunction(`{!! \Session::get('warning') !!}`, 'warning');
</script>
@elseif (\Session::has('status'))
<script>
    alertJsFunction(`{!! \Session::get('status') !!}`, 'success');
</script>
@endif

</body>

</html>
