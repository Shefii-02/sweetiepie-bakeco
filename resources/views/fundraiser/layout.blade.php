<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

       <meta charset="UTF-8">
        <meta http-equiv="content-language" content="en">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="Sweetie Pie, Dolce Chocolate">
        <meta name="author" content="Sweetie Pie & Dolce Chocolate">
          <meta name="publisher" content="INDIGTAL GROUP">
          <meta name="copyright" content="INDIGTAL GROUP">
          <meta name="description" content="Rosedale heights school of the arts - Fundraiser 2024">
          <meta name="page-topic" content="Media">
          <meta name="page-type" content="Shopping">
          <meta name="audience" content="Everyone">
          <meta name="robots" content="index, follow">
        <title>Sweetie Pie & Dolce Chocolate - Fundraiser 2024</title>
        <link rel="icon" type="image/png" href="https://www.stage.sweetiepiebakeco.ca/assets/images/Fav/favicon-32x32.png" />

        <meta property="og:title" content="Sweetie Pie & Dolce Chocolate - Fundraiser 2024">
        <meta property="og:type" content="article" />
        <meta property="og:description" content="Rosedale heights school of the arts - Fundraiser 2024">
        <meta property="og:image" content="{{url('assets/images/mspt.webp')}}">
        <meta property="og:url" content="{{url()->full()}}">
        
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{asset('assets/themes/theme-1/css/style.css?v=5.7')}}">
      <!-- Include Toastify library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    
    <!-- Custom CSS -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        .header {
            background: #303030;
            overflow: hidden;
            position: relative;
            width: 100%;
            z-index: 99;
            padding:20px 0;
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

    </style>
    
@yield('scripts')

</head>
<body>

 <!-- Header with Transparent Navbar -->
        <div class="header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-6">
                         <img class="fundriser_logo" src="{{url('assets/images/sp-logo-white.webp')}}" alt="Logo" >
                    </div>
                     <div class="col-6 text-end">
                        <button class=" btn btn-primary btn-sm rounded-5 fundriser_btn"><i class="bi bi-telephone-outbound"></i> Call Us Now</button>
                    </div>
                </div>
            </div>
        </div>
@yield('content')

@include('frontend/subscriptions-form')

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
                <p>&COPY; {{date('Y',time()).'-'.date('Y',time()+(60*60*24*366))}} Sweetiepiebakeco.ca. All rights are reserved.</p>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>


    $(document).ready(function () {
        // Event listener for minus button
        $('.minus').on('click', function () {
            updateQuantity($(this), -1);
        });

        // Event listener for plus button
        $('.plus').on('click', function () {
            updateQuantity($(this), 1);
        });

        // Function to update quantity
        function updateQuantity(button, amount) {
            var input = button.siblings('.qty-input');
            var currentQuantity = parseInt(input.val()) || 0;
            var newQuantity = currentQuantity + amount;

            // Ensure the new quantity is not negative
            newQuantity = Math.max(0, newQuantity);

            // Update the input value
            input.val(newQuantity);
        }
    });

</script>

        <script>
         $(document).ready(function() {
            $('body').on('submit','#add-cart', function(e){
               
                if (validateForm()) {
                    return true;
                }
                else{
                    event.preventDefault();
                    
                    $('.error_msg').html('<div class="alert alert-danger "> At least one item quantity added  <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button></div>')
                   
                }
            })
        });

        function validateForm() {
            var isValid = false;

            // Your validation logic here
            $("input[name^='quantity']").each(function() {
                var value = parseInt($(this).val());
                if (!isNaN(value) && value >= 1) {
                    isValid = true;
                    return false; // Exit the loop early
                }
            });

            return isValid;
        }
        
           
        </script>
   
@yield('scripts')
</body>
</html>
