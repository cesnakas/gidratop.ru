$(document).ready(function () {
    /*console.log("http://"+window.location.host+"/");
    console.log("https://"+window.location.host+"/");
    console.log(window.location.href);

    a="http://"+window.location.host+"/";
    b="https://"+window.location.host+"/";
    c=window.location.href;

    if ((a==c) || (b==c)){
        $.ajax({
            type: "GET",
            url: window.location.href+'catalog/',
            timeout: 3000,

            success: function(data) {
                console.log('DA');
                // $('#catalog-menu_mobile').append($(data).find('#catalog-menu_mobile'));
                //$('#catalog-menu_mobile').remove();
                $('.vertical-multilevel-menu').append($(data).find('.vertical-multilevel-menu'));

            }
        });
    }*/



    var open = $('.open_list-menu');

    open.on('click', function (e) {
        e.preventDefault();
        $(this).parent().toggleClass('opened-list_menu');
        $(this).parent().find(".root-item-menu").slideToggle(300);
    });
});

var jsvhover = function()
{

        var menuDiv = document.getElementById("catalog-menu_mobile");
        if (!menuDiv)
            return;

        var nodes = menuDiv.getElementsByTagName("li");
        for (var i=0; i<nodes.length; i++)
        {
            nodes[i].onmouseover = function()
            {
                this.className += " jsvhover";
            };

            nodes[i].onmouseout = function()
            {
                this.className = this.className.replace(new RegExp(" jsvhover\\b"), "");
            }
        }


};

if (window.attachEvent)
	window.attachEvent("onload", jsvhover);





//console.log(window.location.href+'catalog/');