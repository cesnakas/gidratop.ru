$(document).ready(function() {


    var btn = $('.gt-catalog-toggler'),
        menu = $('#gt-top-catalog');
    var menuInterval;

    if ($(window).width() > 1024) {
        if (!$("html").hasClass('bx-no-touch')) {
            return false;
        }
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

    } else {

        btn.on('click', function(e) {
            e.preventDefault();
            menu.slideToggle('300');
            btn.toggleClass('expanded');
        });

        var rootMenuItem = $('.gt-root-menu-item');
        rootMenuItem.on('click', function(e) {
            e.preventDefault();
            $(this).next().slideToggle('300');
            $(this).next().toggleClass('opened-list_menu-in');
        });


    }
});