$(document).ready(function () {

    $(".brend-block").owlCarousel({
        items: 5,
        loop: true,
        nav: true,
        dots: false,
        responsiveClass: true,
        lazyContent: true,
        responsive:{
            0:{
                items: 1
            },
            321:{
                items:2
            },
            481: {
                items: 3
            },
            769: {
                items: 5
            },
            1025:{
                items:5,
                nav:true
            }
        }
    });

});
