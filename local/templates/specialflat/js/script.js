function topLinePosition() {
    var scrollTop = $(document).scrollTop(),
        headerbottomTop = $(".header-bottom").offset().top;

    if(scrollTop >= headerbottomTop) {
        $(".hb-content").addClass("fixed");
    }
    else {
        $(".hb-content").removeClass("fixed");
    }
}

$(document).ready(function() {

    $( ".mob_search" ).click(function() {
        $( ".mob_search_panel" ).css("display","block");
        $( ".mob_fon" ).css("display","block");
        $( ".mob_zaglushka" ).css("display","block");
        $('body').addClass('stop-scrolling');

    });

    $( ".krest" ).click(function() {
        $( ".mob_search_panel" ).css("display","none");
        $( ".mob_fon" ).css("display","none");
        $( ".mob_zaglushka" ).css("display","none");
        $('body').removeClass('stop-scrolling');

    });




    $('.buy-btn').click(function (){ // �������� � �������

        $(this).find(".buy-btn-in").addClass("loading");

        var per = $(this);

        var value = [];
        var dop_values = [];
        var servis = "N";
        var id_product = 0;
        if($(this).attr('item-id'))
            id_product = $(this).attr('item-id');

        //если кнопка покупки комплекта получем его состав
        if($(this).data('id') == 'buy-btn1' || $(this).data('id') == 'buy-btn2')
        {
            $('.element_dop_bloc input[type="checkbox"]:checked').each(function () {

                if ($(this).val() != "on")
                {
                    if ($(this).attr("name") != "servis"){
                        dop_values.push($(this).val());
                    }else{
                        servis = "Y";
                    }
                }
            });

            $('.element_ocn_block input[type="radio"]:checked').each(function () {
                value.push($(this).val());

            });
        }

        var mas = {
            'id_product':id_product,
            'value': value,
            'dop_values':dop_values,
            'servis':servis,
            'SITE_ID':settingSantech.SITE_ID
        };


        $.post(settingSantech.SITE_TEMPLATE_PATH+'/components/bitrix/catalog/santehnika_catalog/bitrix/catalog.element/.default/ajax/basket.php',{
                mastovar:JSON.stringify(mas)
            },
            function(data) {

                var res = BX.parseJSON(data);

                if(res['error'])
                {
                    $(".buy-btn-in").removeClass("loading");
                    alert(res['error']);
                }else{
                    BX.onCustomEvent('OnBasketChange');
                    per.addClass('active');
                    setTimeout (function() {
                        per.removeClass('active');
                    }, 3000);

                    $(".buy-btn-in").removeClass("loading");

                    var data_id = per.attr('data-id'),
                        strContent = '<div class="product-modal"><span>'+BX.message('JS_ALERT_ADD_TOVAR')+'</span><a href="'+settingSantech.SITE_DIR+'personal/cart" class="btn btn_blue"><span>'+BX.message('JS_BNT_LINK_ORDER')+'</span></a></div>';

                    //$('.product-modal').addClass("open");
                    $(".BasketEmodal .emodal-data[id='" + data_id + "']").html(strContent);

                    setTimeout(function(){
                        $(".BasketEmodal .emodal-data[id='" + data_id + "'] .product-modal").addClass("open");
                    }, 6);

                    setTimeout(function(){
                        $('.product-modal').removeClass("open");
                    }, 4500);
                }
            });

        value = [];
        return false;
    });


    $('.basket_btn').hover(function () {
        $(this).addClass('open_basket');
    },
        function () {
            $(this).removeClass('open_basket');
        });

    new WOW().init();

    $('.block_in_main .main_news_slider').slick(
        {
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 1
                    }
                }
                ]
        }
    );

    $('.search_input-box .where_search').styler();

    topLinePosition();
    $(window).scroll(function() {
        topLinePosition();
    });

    $('.bxslider').bxSlider({
        pagerCustom: '#bx-pager',
    });


    if ($(window).width() <= 1024) {

        $('a.catalog-btn').click(function (e) {

            $('.left_panel').addClass('open');
            $('.overflow').addClass('open');
            $('body').addClass('menu-in');

            e.preventDefault();
        });


        $('i.close-btn, .overflow').click(function () {
            $('.left_panel').removeClass('open');
            $('.overflow').removeClass('open');
            $('body').removeClass('menu-in');
        });


    }


    $(".city-change select").styler();


    $(window).scroll(function () {
        if ($(this).scrollTop() > 150) {
            $("#upbutton").addClass("visible");
            checkScrollToTop();
        } else {
            $("#upbutton").removeClass("visible");
        }
    });

    $('#upbutton').click(function(e) {
        e.preventDefault();
        $('html, body').stop().animate({scrollTop : 0}, 800);
    });

    function checkScrollToTop() {
        var e = $(window).scrollTop(),
            t = $(window).height(),
            a = $(".footer_bottom").offset().top + 30;
        if (a < e + t) {
            $("#upbutton").css("bottom", 45 + e + t - a);
        } else {
            $("#upbutton").css("bottom", 25);
        }
    }


    $('.btn-back').tooltipster({
        side: 'bottom',
        animation: 'fade',
        delay: 200
    });
    $('.input_tooltip').tooltipster({
        side: 'bottom',
        animation: 'fade',
        delay: 200,
        maxWidth: 250
    });
    $('.prop_tooltip').tooltipster({
        side: 'top',
        animation: 'fade',
        delay: 200
    });
    $('.img_tooltip').tooltipster({
        side: 'right',
        animation: 'fade',
        delay: 200,
        contentCloning: true,
        theme: 'tooltipster-previmg'
    });

});