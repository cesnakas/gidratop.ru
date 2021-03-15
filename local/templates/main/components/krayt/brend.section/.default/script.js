$(document).ready(function() {
    //$('.collection_element_slider_blox').bxSlider();



});


function fn_BrandCatalogFilters(event, isClear, isApplyMobile) {
    if (event) event.preventDefault();
    var target = '#brand-catalog-types';
    var allList = $(target + ' input:checkbox');
    if (isClear) {
        allList.each(function() {
            $(this).prop('checked', false);
        });
    }

    var checkList = $(target + ' input:checkbox:checked');
    var selected_ids = [];
    if (checkList.length > 0) {
        checkList.each(function() {
            selected_ids.push($(this).attr('data-id'));
        });
    }


    if (selected_ids.length > 0) {
        $('.gts_all').css('display', 'none');
        selected_ids.forEach(function(id) {
            $('.gts_' + id).css('display', '');
        });
    } else {
        $('.gts_all').css('display', '');
    }

    if (isApplyMobile) toggleCatalogFilters(event);
}