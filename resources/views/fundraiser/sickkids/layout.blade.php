<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

       <meta charset="UTF-8">
        <meta http-equiv="content-language" content="en">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="SickKids Fundraiser,Fundraiser,2024,SickKids">
        <meta name="author" content="SickKids 2024">
          <meta name="publisher" content="INDIGTAL GROUP">
          <meta name="copyright" content="INDIGTAL GROUP">
          <meta name="description" content="SickKids - Fundraiser 2024">
          <meta name="page-topic" content="Media">
          <meta name="page-type" content="Shopping">
          <meta name="audience" content="Everyone">
          <meta name="robots" content="index, follow">
        <title>SickKids - Fundraiser 2024</title>
        <link rel="icon" type="image/png" href="{{url('assets/images/Fav/favicon-32x32.png')}}" />

        <meta property="og:title" content="SickKids - Fundraiser 2024">
        <meta property="og:type" content="article" />
        <meta property="og:description" content="SickKids - Fundraiser 2024">
        <meta property="og:image" content="{{url('assets/images/mspt.webp')}}">
        <meta property="og:url" content="{{url()->full()}}">
        
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('assets/themes/theme-1/css/style.css?v=5.7')}}">
      <!-- Include Toastify library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

    <!-- Custom CSS -->
    <style>
    @font-face {
        font-family: 'PP Formula Compressed';
        src: url('/assets/fundraiser/Fonts/PPFormula-CondensedBlack.woff2') format('woff2'), url('/assets/fundraiser/Fonts/PPFormula-CondensedBlack.woff') format('woff');
        font-display: swap;
    }
     @font-face {
        font-family: 'PP Formula Semi Cond Exlight';
        src: url('/assets/fundraiser/Fonts/PPFormula-SemiCondensedExtralight.woff2') format('woff2'), url('/assets/fundraiser/Fonts/PPFormula-SemiCondensedExtralight.woff') format('woff');
        font-display: swap;
    }
    
        body {
            margin: 0;
            padding: 0;
        }

        .header {
            background: #303030;
            overflow: hidden;
            position: relative;
            width: 100%;
            z-index: 99;
            padding:20px 0;
        }

       .productList{
           padding: 20px;
       }
        .productList img {
            max-height: 350px;
            width:auto;
            height: 100%;
            object-fit: contain;
        }
        
        @media(max-width: 600px){
            .fundriser_logo{
                width: 100%;
            }
        }
        
        @media(max-width: 369px){
            .fundriser_btn{
                padding: 7px 15px;
            }
        }
        
        .bg-blue{
            background-color:#02349d;
        }

        .theme-color{
            color:#d85291;
        }
        .btn-theme{
             background-color:#d85291;
             
             color:#fff;
        }
        
        .btn-theme:hover{
            border:1px solid #d85291;
             background-color:#fff;
             color:#d85291;
        }
        
        h2{
            font-size:55px;
            font-family: 'PP Formula Compressed';
            font-weight: 900;
            font-style: normal;
        }
        p{
            font-size:20px;
            line-height:1.6;
            font-family: 'PP Formula Semi Cond Exlight';
            font-weight: 200;
            font-style: normal;
            padding:5px;
        }
    </style>
    
@yield('scripts')

</head>
<body>

@yield('content')

<footer>
    <div class="container">
        <div class="row main">
            <div class="col-6 col-md-3 col-lg-2 mb-3 mb-md-0">
                <div class="f-h">
                    <p>Company</p>
                </div>
                {!!getMenu('Company',['id'=>'header-wr'])!!} 
            </div>
            <div class="col-6 col-md-3 col-lg-2 mb-3 mb-md-0">
                <div class="f-h">
                    <p>Support</p>
                </div>
                {!!getMenu('support',['id'=>'header-wr'])!!}
            </div>

            <div class="col-6 col-md-4 mb-3 mb-md-0">
                <div class="f-h">
                    <p>Our Locations</p>
                </div>
                <div class="f-a">
                {!!getStore()!!}
                </div>

            </div>

            <div class="col-6 col-md-2 mb-3 mb-md-0">
                <div class="logo">
                    <a href="/">
                    <img src="{{asset('assets/images/logo-icon.png')}}" alt=""></a>
                </div>
                <div class="social-link">
                    {!!getSocialmedia()!!}
                </div>

            </div>
            
        </div>
    </div>
</footer>

<section class="f-bottom" id="bottom">
    <div class="container-fluid" >
        <div class="row">
            <div class="col-12">
                <p>&COPY; {{date('Y',time()).'-'.date('Y',time()+(60*60*24*366))}}Sweetiepiebakeco.ca. All rights are reserved.</p>
            </div>
        </div>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $('.productListing').slick({
          dots: false,
          infinite: true,
          autoplay: true,
          autoplaySpeed: 2500,
          speed: 300,
          slidesToShow: 4,
          slidesToScroll: 4,
          arrows: false,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
        
          ]
        });
    </script>
   
@yield('scripts')
</body>
</html>
