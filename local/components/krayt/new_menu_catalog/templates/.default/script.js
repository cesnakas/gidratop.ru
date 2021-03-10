$(document).ready(function() {
    if (!$("html").hasClass('bx-no-touch')) {
        return false;
    }

    var btn = $('.gt-catalog-toggler'),
        menu = $('#gt-top-catalog');
    var menuInterval;
    if ($(window).width() > 1024) {

        btn.hover(
            function() {
                btn.addClass('open');
                clearInterval(menuInterval);
                menuInterval = setTimeout(
                    function() {
                        menu.fadeIn(200);
                    }, 100);
            },
            function() {;
                clearInterval(menuInterval);
                menuInterval = setTimeout(
                    function() {
                        menu.fadeOut('fast');
                    }, 300);

                btn.removeClass('open');
            }
        );


        menu.hover(
            function() {
                clearInterval(menuInterval);
                btn.addClass('open');
            },
            function() {
                clearInterval(menuInterval);
                menuInterval = setTimeout(
                    function() {
                        menu.fadeOut('fast');
                    }, 300);

                btn.removeClass('open');

            }
        );

    }
});