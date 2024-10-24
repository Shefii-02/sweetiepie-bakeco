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
  <link rel="stylesheet" href="{{ asset('assets/css/style.css?v=5.7') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/newstyle.css?v=5.4') }}" />
  <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">-->

<script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=64c2121860781a00121c8026&product=sop' async='async'></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-22591984-31"></script>

    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-22591984-31');
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->

@yield('styles')
</head>

<body>

