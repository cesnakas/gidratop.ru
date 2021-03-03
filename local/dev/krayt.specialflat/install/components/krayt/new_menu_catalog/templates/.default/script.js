$(document).ready(function () {
    if(!$("html").hasClass('bx-no-touch'))
    {
        return false;
    }

    var btn = $('.catalog-nav-box'),
        menu = $('#top_menu_catalog');

    if ($(window).width() > 1024) {

        btn.hover(
            function () {
                btn.addClass('open');
                intervalID = setTimeout(
                    function () {
                        menu.fadeIn(200);
                    }, 100);
            },
            function () {
                menu.fadeOut('fast');
                clearInterval(intervalID);
                btn.removeClass('open');
            }
        );

    }

    var open = $('.open_top-menu');

    open.on('click', function (e) {
        e.preventDefault();
        $(this).closest('.sub_menu_catalog li').find('.sub_menu_catalog_in').slideToggle('300');
        $(this).closest('.sub_menu_catalog li').toggleClass('opened-list_menu-in');
    });


    // else {
        // btn_link.click(function (e) {
        //     e.preventDefault();
        //     btn_link.toggleClass('active');
        //     menu.toggleClass('menu_open');
        //     $('body').toggleClass('menu-in');
        // })
    // }

    // var block = null;

    // $('.osn_menu_li').hover(
    //     function () {
    //         block = $(this).find('.submenu_box');
    //         block.addClass('edited');
    //
    //         block.velocity({'opacity': 1, 'left': 180, 'z-index': 200}, {duration: 150}, [0, 0, 0.58, 1]);
    //
    //     }, function () {
    //
    //         block = $(this).find('.submenu_box');
    //         block.velocity("stop");
    //
    //         block.velocity({'opacity': 0, 'left': 180, 'z-index': 0}, {duration: 150}, [0, 0, 0.58, 1]);
    //
    //     });
    //
    // $('.osn_menu_li a').hover(function () {
    //     $('.osn_menu_li').removeClass('p_select');
    //     $('.osn_menu_li').removeClass('select');
    //     $(this).parent('.osn_menu_li').addClass('p_select');
    // });


});
