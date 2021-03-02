/**
 * Created by aleksander on 04.07.2019.
 */
$(function () {
    $.each($(".img-load-news_in_glav"),function () {
       $(this).css("background-image","url('"+$(this).data('src')+"')");
    });
});