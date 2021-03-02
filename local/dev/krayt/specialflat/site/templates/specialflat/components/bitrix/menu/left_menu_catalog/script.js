$(document).ready(function () {

    $('.root-menu-open').click(function () {
            $(this).prev().toggleClass('active_ul');
            $(this).toggleClass('active');
            $(this).next('.root-item-menu').slideToggle('300');


    });



    var open = $('.open_list-menu');

    open.on('click', function (e) {
        e.preventDefault();
        $(this).closest('.root-item-menu li').find('.root-item-menu-in').slideToggle('300');
        $(this).closest('.root-item-menu li').toggleClass('opened-list_menu-in');
    });
});


var jsvhover = function()
{
	var menuDiv = document.getElementById("catalog-menu");
	if (!menuDiv)
		return;

  var nodes = menuDiv.getElementsByTagName("li");
  for (var i=0; i<nodes.length; i++) 
  {
    nodes[i].onmouseover = function()
    {
      this.className += " jsvhover";
    }
    
    nodes[i].onmouseout = function()
    {
      this.className = this.className.replace(new RegExp(" jsvhover\\b"), "");
    }
  }
}

if (window.attachEvent)
	window.attachEvent("onload", jsvhover);