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

$(document).ready(function () {



    var open = $('.open_list-menu');

        open.on('click', function (e) {
            e.preventDefault();
            $(this).parent().toggleClass('opened-list_menu');
            $(this).parent().find(".root-item-menu").slideToggle(300);
        });
});