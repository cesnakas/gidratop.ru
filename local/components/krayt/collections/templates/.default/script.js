$( document ).ready(function() {

    // $('.collection_element_block .js-carousel').slick({
    //     slidesToShow: 3,
    //     infinite: false,
    //     appendArrows: $(".collection_element_block .product-carousel-nav")
    // });

    // $(".collection_element_block .js-carousel").bxSlider({
    //     minSlides: 1,
    //     maxSlides: 3,
    //     pager: false,
    //     infiniteLoop: false,
    //     slideWidth: 298,
    //     slideMargin: 30,
    //     moveSlides: 1,
    //     responsive: true
    // });

    $(".collection_element_block .js-carousel").owlCarousel({
        items: 4,
        dots: false,
        nav: true,
        margin: 15,
        responsiveClass: true,
        responsive:{
            0:{
                items:1,
                margin: 0
            },
            415:{
                margin: 0,
                items:2
            },
            641: {
                margin: 0,
                items: 3
            },
            1025:{
                items:4
            }
        }

    });



});
