$(document).ready(function() {
    //$('.collection_element_slider_blox').bxSlider();




    $('.letters > .toggler > a').on('click', function(event) {
        event.preventDefault();
        $(".letters").removeClass('expanded');
        $(this).parent().parent().addClass('expanded');
    });

    fn_setBrendListPager();

});

function fn_setBrendListPager() {
    var allButtonHtml = '<a href="#" class="gt-button gt-btn-white gt-btn-full gt-btn-uppercase gt-border-gray ">Показать ещё</a>';
    var isEnableShowAll = false;
    var arrayPages = [];
    var currentPage = $('#realTemplatePager').find('b').first().text();
    if (currentPage.length > 0) {
        arrayPages.push({ page: parseInt(currentPage), url: '#' });
    }
    $('#realTemplatePager a').each(function() {
        var url = $(this).attr('href');
        var action = url.split('?')[1];
        var name = $(this).text();
        if (action == 'SHOWALL_1=1') {
            isEnableShowAll = true;
            allButtonHtml = '<a href="' + url + '" class="gt-button gt-btn-white gt-btn-full gt-btn-uppercase gt-border-gray ">Показать все</a>'
        } else if (isNaN(name) == false) {
            arrayPages.push({ page: parseInt(name), url: url });
        }
    });
    //
    if (isEnableShowAll) $("#fakePager").append(allButtonHtml);
    arrayPages.sort(function(a, b) {
        if (a.page > b.page) return 1;
        if (a.page == b.page) return 0;
        if (a.page < b.page) return -1;
    });
    ul = '<div class="gt-pager"><ul class="gt-pager-ul">'
    arrayPages.forEach(function(item) {
        ul += '<li><a href="' + item.url + '" ' + (item.page == parseInt(currentPage) ? "class='active' onclick='return false;'" : "") + '>' + item.page + '</a></li>';
    });
    ul + '</ul></div>';
    $("#fakePager").append(ul);
}