$( document ).ready(function() {

    $('.right_content_block .product-item-container').hover(function () {
            $(this).addClass('hovercat');
            $(this).find(' .product-item-price-container').show().css('display','flex');
        },
        function () {
            $(this).find('.product-item-price-container').hide();
            $(this).removeClass('hovercat');
        });


   $('.catalog_section_option_bolock .per_option').click(function () {
       document.cookie = "catalog_secton_sort="+$(this).attr('data-percatalog');
       location.reload();
   });

    $('.catalog_section_option_bolock .per_count').click(function () {
        document.cookie = "catalog_secton_count="+$(this).attr('data-percatalog');
        location.reload();
    });

});
