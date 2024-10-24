
@extends('layouts.only-logo')
  
    @section('styles')
  <style>
    *{
      font-family: 'Montserrat', sans-serif;
    }
    :root{
      --primary: #e29843;
      --white: #fff;
    }
    .oops{
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-size: cover;
      /*background: url('https://cdn.dribbble.com/users/332742/screenshots/10537181/media/f3ceac170109ffe733535ec7fe85916b.gif');*/
    }
    .oops .col-12{
      text-align: center;
    }
    .oops h1 {
      font-weight: 700;
      font-size: 35px;
    }
    .oops a{
      padding: 10px 30px;
      background: var(--primary);
      color: var(--white);
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      border-radius: 30px;
    }
  </style>
@endsection
    @section('contents')
  
      <section class="oops">
        <div class="container">
          <div class="row">
            <div class="col-12">   <h1>Oops!</h1>
              <h1 class="text-center"> Looks like there is nothing yummilicious here!</h1>
              <p class="text-center">We searched high and low but couldn't find what you're looking for. <br>
              Lets find a better place for you to go.</p>
              <a href="/">BACK HOME</a>
            </div>
          </div>
        </div>
      </section>
    @endsection