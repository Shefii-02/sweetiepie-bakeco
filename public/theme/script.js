const cartContainer = $('.cart-item-container');
const sidePanel = $('.side-panel');
const profilePanel = $('.profle-panel');
const adjustPanel = function () {
    let width = $(window).width();
    if (parseInt(width) >= 992) {
        sidePanel.show("slide", { direction: "left" });
    }
    else {
        sidePanel.hide("slide", { direction: "left" });
    }
}
$('span.side-toggler').on('click', function () {
    sidePanel.toggle("slide", { direction: "left" });
});
$(function () {
    adjustPanel();
});
$(window).resize(function () {
    adjustPanel();
});
const body = $('body');
$('.toggle-menu').on('click', function () {
    $(this).toggleClass('collapesed');
    $(this).parent().find('.menu-list').slideToggle();
});
$('.cart-toggle').on('click', function () {
    $(this).toggleClass('active');
    $('.topbar').toggleClass('active')
    $('.cart-items').slideToggle();
    $('.product-row').toggleClass('side-bar');
    updateRows();
})

const updateRows = async function () {
    if ($('.product-row').hasClass('side-bar') && $(window).width() > 575) {
        $('.product-col-container').removeClass('col-xxl-2 col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-6').addClass('col-xxl-3 col-xl-4 col-lg-6 col-md-12 col-sm-12 col-sx-12');
    }
    else {
        $('.product-col-container').removeClass('col-xxl-3 col-xl-4 col-lg-6 col-md-12 col-sm-12 col-sx-12').addClass('col-xxl-2 col-xl-3 col-lg-4 col-md-4 col-sm-6 col-xs-6');
    }
}
function delay(time) {
    return new Promise(resolve => setTimeout(resolve, time));
}
$(window).resize(function () {
    updateRows();
});
$('.product-col').on('click', function () {
    showProduct($(this).attr('href'));
});
function showProduct(url) {
    body.append(`<div class="product-loading"><i class="fa-solid fa-circle-notch"></i></div>`);
    console.log(url);
    $.getJSON(url, function (data) {
        body.find('.product-loading').remove();
        popProduct(data.html);
    });
}
const popProduct = function (product) {

    $('#product-pop').modal('hide').remove();
    body.append(`<div class="modal product-pop" data-bs-backdrop="static" data-bs-keyboard="false" id="product-pop" aria-hidden="true" aria-labelledby="product-pop" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          ${product}
        </div>
      </div>`);
    $('#product-pop').modal('show');
    setVariation();
}
$(document).on('click', '#product-pop .change-quanity', function () {
    let qControl = $(this).closest('.popqControl');
    let qty = parseInt(qControl.find('.popQuantity').text());
    if ($(this).hasClass('minus-quantity')) {
        qty = Math.max(qty - 1, 1);
    } else {
        qty = Math.max(qty + 1, 1);
    }
    qControl.find('.popQuantity').text(qty);
    qControl.find('input').val(qty);
})

$(function () {
    let width = $(window).width();
    if (parseInt(width) >= 576) {
        $('.cart-toggle').click();
    }
})
const adujstPanels = function () {
    
    let header = parseInt($('.app-header').height());
    let scrollTop = parseInt($(document).scrollTop());
    scrollTop = scrollTop > header ? header : scrollTop;
    let headerOffset = header - scrollTop;

    let footer = parseInt($('.app-footer').height());
    let scrollBottom = parseInt($(document).height() - $(window).height() - $(window).scrollTop());
    scrollBottom = scrollBottom > footer ? footer : scrollBottom;
    let footerOffset = footer - scrollBottom;
    $('.checkout-footer').css('bottom', footerOffset);

    $('.topItems').css('top', headerOffset);
    $('.bar-inside').css('padding-bottom', headerOffset);
    let width = $(window).width();

    let headerH = $('.header-first-col').closest('header').height();

    if (footerOffset && parseInt(width) >= 576) {
        console.log(true);
        //$('.leftItems').css({bottom : footerOffset, top: 'unset'});
        $('.leftItems, .rightItem').css({
            bottom: footerOffset,
            top: 'unset',
            'padding-top': headerH + 24,
        });
        $('a.checkout').css({ bottom: 10 })
        $('.cart-items').css({'padding-bottom' : 100})
    } else {
        console.log(false);
        $('.leftItems, .rightItem').css({
            bottom: 'unset',
            top: 'unset',
            'padding-top': 0,
        });
        $('a.checkout').css({ bottom: 100 })
        $('.cart-items').css({'padding-bottom' : 180})
        let width = $(window).width();
        if (parseInt(width) <= 991) {
            $('a.checkout').css({ bottom: 60 })
            $('.cart-items').css({'padding-bottom' : 130})
        }
        
    }
    $('.cart-items').css({
        'height': `calc(100vh - ${$('.top-main').height()}px)`
    });
    //$('.topItems').css('height', `calc(100vh - ${footerOffset}px)`);
}

$(window).scroll(function () {
    adujstPanels();
});
$(window).resize(function () {
    adjustBars();
    adujstPanels();
});
const adjustBars = function () {
    let headerH = $('.header-first-col').closest('header').height();
    $('.app-container').css({
        'padding-top': headerH,
    });
    $('.app-container .topbar').css({
        'top': headerH,
    });
    let width = $(window).width();
    if (parseInt(width) <= 576) {
        $('.row.pt-4.mainRow').css({
            'padding-top': '128',
        })
    }
}
adjustBars();
adujstPanels();