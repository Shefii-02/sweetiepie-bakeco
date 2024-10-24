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

$(document).ready(function () {
  $('input[name="phone"]').mask('(000) 000-0000');
  $('input[name="s_phone"]').mask('(000) 000-0000');
  $('input[name="b_phone"]').mask('(000) 000-0000');

  $(document).on('DOMNodeInserted', function (e) {
    $('input[name="phone"]').mask('(000) 000-0000');
    $('input[name="s_phone"]').mask('(000) 000-0000');
    $('input[name="b_phone"]').mask('(000) 000-0000');

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
    autoplaySpeed: 4000,
  });
});

$(document).on('ready', function () {
  $(".slick-banner-mobile").slick({
    arrows: true,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4000,
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
          centerMode: false,
        },
      }]
  });
});

// slick product detail slider

const loadSlider = function (destroy = false) {
  if (destroy) {
    $('.slider-for').slick('unslick');
    $('.slider-nav').slick('unslick');
  }
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
}
loadSlider(false);