$(function () {



// region main banner -----------------------------------
    $('.main_banner .owl-carousel').owlCarousel({
        items: 1,
        dots: true,
        nav: false,
        dotSpeed: 500,
        loop: true,
        autoplay: true,
        lazyContent: true,
        autoplayHoverPause: true,
		autoplayTimeout:arParamsSlide['INTERVAL_COUNT'],
        animateOut: 'fadeOut'
    });


        //$('.owl-carousel').css('width','100% !important');




// endregion
})