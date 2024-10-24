// NAVBAR

$(document).ready(function () {
  $("#open-button").click(function () {
    $("#my-div").show();
    $("#open-button").hide(); // Hide the open button when the div is shown
  });

  $("#close-button").click(function () {
    $("#my-div").hide();
    $("#open-button").show(); // Show the open button when the div is hidden
  });
});





// slick home page
$(document).on('ready', function () {
  $(".slick-banner").slick({
    arrows: true,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
  });
});

$(document).on('ready', function () {
  $(".slick-banner-mobile").slick({
    arrows: true,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
  });
});

// slick landing page

$(document).on('ready', function () {
  $(".slick-gallery").slick({
    dots: true,
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    centerMode: true,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          infinite: true,
          arrows: false,
        },
      }]
  });
});

// slick product detail slider

$('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 4,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  centerMode: false,
  focusOnSelect: true
});

// slick pop cart


	
