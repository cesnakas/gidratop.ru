$( document ).ready(function() {

    if($(".goods_box").length > 1) {

        $(".goods-carousel").owlCarousel({
            items: 1,
            dotsSpeed: 1000,
            nav: false,
            dot: true
        });
    }

    $('.goods_in_basket').click(function (){

        var value = [],
            btn_in   = $(this);

            value.push($(this).attr('data-idset'));


            $.post('/local/components/krayt/goods.in.set/templates/special_flat/ajax/basket.php',{
                    mastovar:JSON.stringify(value)
                },
                function(data) {

                    BX.onCustomEvent('OnBasketChange');

                    // появления модального окна после добавления в корзину
                    btn_in.addClass('active');
                    setTimeout (function() {
                        btn_in.removeClass('active');
                    }, 3000);


                    var dataid = btn_in.attr('data-id'),
                        strCont = '<div class="product-modal open"><span>Товар добавлен в корзину</span><a href="/personal/order/make" class="btn btn_blue"><span>Оформить заказ</span></a></div>';

                    $('.product-modal').addClass("open");
                    $(".BasketEmodal .emodal-data[id='" + dataid + "']").html(strCont);

                    setTimeout(function(){
                        $('.product-modal').removeClass("open");
                    }, 5000);
                    // конец //
                });


            value = "";
            return false;
    });
});