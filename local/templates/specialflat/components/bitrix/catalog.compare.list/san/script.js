
function delCompareList(id)
{
	$.get(
        settingSantech.SITE_DIR+"catalog/compare/"
		,
		{
			id:id,
            ajax_action:'Y',
            action:'DELETE_FROM_COMPARE_LIST'
		},
		function(data)
		{
            var item = $('input[data-id="'+id+'"]');

            if(item.length)
            {
                item.prop('checked',false);
            }
            BX.onCustomEvent('OnCompareChange');
		}
	)
}

$(document).ready(function() {

    $("#open__compare").hover(
        function() {
            $(".bx_catalog_compare_form").stop().fadeIn("0");
        }, function() {
            $(".bx_catalog_compare_form").stop().fadeOut("0");
        }
    );

});

function noCompere(){
    $(document).on("click", "label[data-entity='compare-title']", function(){

        var zapros = {'action': 'cpmpare'}

        $.ajax({
            type: "POST",
            url: settingSantech.SITE_DIR+"ajax/ajax.panel.php",
            data: zapros,
            success: function (data) {
                $('.cpmpare_icon_box').html(data);
                BX.onCustomEvent('OnCompareChange');
            }
        });
    });
}

$(document).ready(function(){
    noCompere();
    if($("font").hasClass("notetext")){
        var zapros = {'action': 'cpmpare'}

        $.ajax({
            type: "POST",
            url: settingSantech.SITE_DIR+"ajax/ajax.panel.php",
            data: zapros,
            success: function (data) {
                $('.cpmpare_icon_box').html(data);
            }
        });
    }
});

function loadListCompare() {
    var zapros = {'action': 'cpmpare'}
    $.ajax({
        type: "POST",
        url: settingSantech.SITE_DIR+"ajax/ajax.panel.php",
        data: zapros,
        success: function (data) {
            $('.cpmpare_icon_box').html(data);
        }
    });
}
BX.ready(function(){
    BX.addCustomEvent("OnCompareChange", loadListCompare);
});