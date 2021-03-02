<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("1С-Битрикс: Управление сайтом");
?>

    <div class="header-bottom">
        <div class="gt-container gt-flex-row">
            <table class="gt-table">
                <tbody>
                <tr>
                    <td class="gt-catalog">
                        <a href="#" class="gt-catalog-toggler">Каталог товаров</a>
                    </td>
                    <td class="gt-search-top">
                        <div class="gt-input gt-searchbox">
                            <input type="text" id="gt-search" placeholder="Поиск товаров и брендов" />
                            <input name="s" type="submit" class="gt-button gt-btn-blue gt-btn-search" value="" />
                        </div>

                    </td>
                    <td class="gt-header-phone">

                        <strong>8-800-000-00-00</strong>
                        <span>Вам перезвонить?</span>
                    </td>
                    <td class="gt-subheader-icons">
                        <a href="#" class="gt-ico">
                            <ico class="gt-ico-favorite"></ico><span>Избранное</span></a>
                        <a href="#" class="gt-ico">
                            <ico class="gt-ico-poll"></ico><span>Сравнение</span></a>
                        <a href="#" class="gt-ico">
                            <ico class="gt-ico-cart"></ico><span>Корзина</span></a>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="gt-bottom-menu">
        <div class="gt-container gt-flex-row">
            <a href="#" class="gt-ico">
                <ico class="gt-ico-catalog"></ico>
                <span>Каталог</span>
            </a>

            <a href="#" class="gt-ico">
                <ico class="gt-ico-favorite"></ico>
                <span>Избранное</span>
            </a>

            <a href="#" class="gt-ico">
                <img src="img/images/logo_small.png" alt="">
                <span>Главная</span>
            </a>

            <a href="#" class="gt-ico">
                <ico class="gt-ico-user"></ico>
                <span>Профиль</span>
            </a>

            <a href="#" class="gt-ico">
                <ico class="gt-ico-cart"></ico>
                <span>Корзина</span>
            </a>
        </div>
    </div>
    <!-- Main Content-->


    <section class="gt-section" id="gt-section-slider">
        <div class="slides">
            <div class="gt-slide-item">
                <div class="gt-slider-slide">
                    <div class="gt-slide-background">
                        <img src="img/images/slider/slide1.jpg" alt="" />
                    </div>
                    <div class="gt-slide-caption">
                        <p>Скидки на мебель для ванной комнаты</p>
                        <p class="green">до 10%</p>
                        <a href="#" class="gt-button">Подробнее</a>
                    </div>
                </div>
            </div>

            <div class="gt-slide-item">
                <div class="gt-slider-slide">
                    <div class="gt-slide-background">
                        <img src="img/images/slider/slide1.jpg" alt="" />
                    </div>
                    <div class="gt-slide-caption">
                        <p>Скидки на мебель для ванной комнаты</p>
                        <p class="green">до 10%</p>
                        <a href="#" class="gt-button">Подробнее</a>
                    </div>
                </div>
            </div>


            <div class="gt-slide-item">
                <div class="gt-slider-slide">
                    <div class="gt-slide-background">
                        <img src="img/images/slider/slide1.jpg" alt="" />
                    </div>
                    <div class="gt-slide-caption">
                        <p>Скидки на мебель для ванной комнаты</p>
                        <p class="green">до 10%</p>
                        <a href="#" class="gt-button">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var sliderMain = new CustomSlider({
                id: 'gt-section-slider',
                adjustMode: true,
                //isShowSliderButtons: true,
                isShowSliderMenu: true,
                isInfiniteCycle: true,
                autoSlideInterval: true,
                autoSlideInterval: 5000,
                transitionType: 'all',
                speed: 500
            });

            sliderMain.buildTemplate();
        </script>
    </section>
    <section class="gt-section">
        <div class="gt-container">
            <div class="gt-section-title">
                <h2>Акции</h2>
                <div class="bg-text">Stock</div>
            </div>
            <div class="owl-carousel owl-theme gt-slider-promo" id="slider-promos">
                <div class="item gt-promo-item">
                    <div class="img">
                        <img src="img/images/banner1.jpg" alt="">
                    </div>
                </div>
                <div class="item gt-promo-item">
                    <div class="img">
                        <img src="img/images/banner2.jpg" alt="">
                    </div>
                </div>
                <div class="item gt-promo-item">
                    <div class="img">
                        <img src="img/images/banner3.jpg" alt="">
                    </div>
                </div>

                <div class="item gt-promo-item">
                    <div class="img">
                        <img src="img/images/banner1.jpg" alt="">
                    </div>
                </div>
                <div class="item gt-promo-item">
                    <div class="img">
                        <img src="img/images/banner2.jpg" alt="">
                    </div>
                </div>
                <div class="item gt-promo-item">
                    <div class="img">
                        <img src="img/images/banner3.jpg" alt="">
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                $('#slider-promos').owlCarousel({
                    margin: 30,
                    loop: true,
                    autoWidth: true,
                    responsiveClass: true,
                    nav: true,
                    responsive: {
                        0: {
                            items: 2,
                            nav: true,
                            margin: 5,
                        },
                        600: {
                            items: 3,
                            nav: true,
                            margin: 15,
                        },
                        1200: {
                            items: 3,
                            nav: true,
                            loop: true,
                            margin: 30,
                        }
                    }
                })
            </script>


        </div>
    </section>

    <section class="gt-section gt-hide-mobile" id="gt-section-tabs">
        <div class="gt-container">

            <div id="gt-tabs" class="gt-tabcontrol">
                <ul class="gt-tabmenu gt-tabs-ul1">
                    <li class="active">
                        <a href="#" data-tab="tabHits" onclick="clickTab(event, this)"><img src="img/icons/ico_tab1.svg" alt="" />Хиты продаж</a>
                    </li>
                    <li>
                        <a href="#" data-tab="tabNew" onclick="clickTab(event, this)"><img src="img/icons/ico_tab2.svg" alt="" />Новинки</a>
                    </li>
                    <li><a href="#" data-tab="tabPromos" onclick="clickTab(event, this)">% Скидки</a></li>
                </ul>
                <ul class="gt-tabmenu gt-tabs-ul2">
                    <li class="active"><a href="#" onclick="return false;">Все</a></li>
                    <li><a href="#" onclick="return false;">Ванны</a></li>
                    <li><a href="#" onclick="return false;">Душ</a></li>
                    <li><a href="#" onclick="return false;">Душевые углы и ограждения</a></li>
                    <li><a href="#" onclick="return false;">Мебель для ванных комнат</a></li>
                    <li><a href="#" onclick="return false;">Полотенцесушители</a></li>
                    <li><a href="#" onclick="return false;">Санфаянс</a></li>
                    <li><a href="#" onclick="return false;">Смесители</a></li>
                    <li><a href="#" onclick="return false;">Аксессуары</a></li>
                    <li><a href="#" onclick="return false;">Системы инсталяции</a></li>
                </ul>


                <div class="gt-tabcontent active" id="tabHits">

                    <div class="owl-carousel owl-theme gt-owl-products-tabs">
                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/1.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-hit">Хит продаж</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/2.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-hit">Хит продаж</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/3.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-hit">Хит продаж</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/4.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-hit">Хит продаж</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/3.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-hit">Хит продаж</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/4.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-hit">Хит продаж</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="gt-center">
                        <a href="#" class="gt-button gt-btn-white gt-btn-uppercase">Загрузить ещё</a>
                    </div>
                </div>

                <div class="gt-tabcontent" id="tabNew">

                    <div class="owl-carousel owl-theme gt-owl-products-tabs">
                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/1.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-new">Новинка</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/2.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-new">Новинка</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/3.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-new">Новинка</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/4.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-new">Новинка</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/3.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-new">Новинка</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/4.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-new">Новинка</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="gt-center">
                        <a href="#" class="gt-button gt-btn-white">Показать все новинки</a>
                    </div>
                </div>

                <div class="gt-tabcontent" id="tabPromos">
                    <div class="owl-carousel owl-theme gt-owl-products-tabs">
                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/1.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-special">Акция</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/2.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-special">Акция</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/3.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-special">Акция</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/4.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-special">Акция</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/3.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-special">Акция</span>
                                </div>
                            </div>
                        </div>

                        <div class="item gt-product-item">
                            <div class="gt-product-item-container">
                                <div class="gt-pr-item-content">
                                    <div class="product-gal">
                                        <a href="#">
                                            <img src="img/images/products/4.png" alt="" />
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="#" class="name">Наименование продукта 1</a>
                                        <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                        <p>Страна:<span>Россия</span></p>
                                        <a href="#" class="in-stock">В наличии</a>
                                        <div class="price">15 000</div>
                                    </div>

                                </div>
                                <div class="product-actions">
                                    <a href="#" class="gt-button">В корзину</a>
                                    <div class="icons">
                                        <a href="#" class="gt-ico-favorite"></a>
                                        <a href="#" class="gt-ico">
                                            <ico class="gt-ico-poll"></ico>
                                        </a>

                                    </div>

                                </div>
                                <div class="product-tags">
                                    <span class="gt-tag tag-special">Акция</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="gt-center">
                        <a href="#" class="gt-button gt-btn-white">Больше скидок</a>
                    </div>
                </div>
            </div>





            <script type="text/javascript">
                adjustOwlProducts();
            </script>



        </div>
    </section>



    <section class="gt-section gt-show-mobile" id="gt-mobile-hits">
        <div class="gt-container">
            <div class="gt-section-title gt-show-mobile">
                <h2>Хиты продаж</h2>
                <div class="bg-text">Bestsellers</div>
            </div>
            <div class="owl-carousel owl-theme gt-owl-products">
                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/1.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-hit">Хит продаж</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/2.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-hit">Хит продаж</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/3.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-hit">Хит продаж</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/4.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-hit">Хит продаж</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/3.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-hit">Хит продаж</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/4.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-hit">Хит продаж</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="gt-section" id="gt-section-promo">
        <div class="gt-container">
            <div class="gt-disclaimer-grid">
                <div class="gt-disclaimer-1">
                    <span>Мы не просто продаем товары для ванной - мы помогаем вам найти лучшее решение.</span>
                </div>
                <div class="gt-disclaimer-2">
                    <p><span>2K</span>наименований продукции</p>
                    <p><span>30</span>брендов работают с нами</p>
                </div>
                <div class="gt-disclaimer-3">
                    <div class="gt-offer">
                        <div class="gt-offer-thumb">
                            <img src="img/icons/ico_offer1.svg" alt="">
                        </div>
                        <div class="gt-offer-info">
                            <strong>Доставка</strong>
                            <p>Доставим товар в удобное для вас время</p>
                        </div>
                    </div>

                    <div class="gt-offer">
                        <div class="gt-offer-thumb">
                            <img src="img/icons/ico_offer2.svg" alt="">
                        </div>
                        <div class="gt-offer-info">
                            <strong>Самовывоз</strong>
                            <p>Вы можете самостоятельно забрать заказ в пункте самовывоза.</p>
                        </div>
                    </div>


                    <div class="gt-offer">
                        <div class="gt-offer-thumb">
                            <img src="img/icons/ico_offer5.svg" alt="">
                        </div>
                        <div class="gt-offer-info">
                            <strong>ШИРОКИЙ АССОРТИМЕНТ ТОВАРОВ</strong>
                            <p>У нас найдётся всё</p>
                        </div>
                    </div>

                    <div class="gt-offer">
                        <div class="gt-offer-thumb">
                            <img src="img/icons/ico_offer3.svg" alt="">
                        </div>
                        <div class="gt-offer-info">
                            <strong>Клиентский сервис</strong>
                            <p>Оказываем поддержку на всех этапах покупки товара</p>
                        </div>
                    </div>

                    <div class="gt-offer">
                        <div class="gt-offer-thumb">
                            <img src="img/icons/ico_offer4.svg" alt="">
                        </div>
                        <div class="gt-offer-info">
                            <strong>Гарантия качества</strong>
                            <p>Соответствуем требованиям и стандартам качества</p>
                        </div>
                    </div>

                    <div class="gt-offer">
                        <div class="gt-offer-thumb">
                            <img src="img/icons/ico_offer6.svg" alt="">
                        </div>
                        <div class="gt-offer-info">
                            <strong>Акции и скидки</strong>
                            <p>Постоянным клиентам акции и скидки</p>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </section>


    <section class="gt-section gt-show-mobile" id="gt-mobile-new">
        <div class="gt-container">
            <div class="gt-section-title">
                <h2>Новинки</h2>
                <div class="bg-text">New items</div>
            </div>
            <div class="owl-carousel owl-theme gt-owl-products">
                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/1.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-new">Новинка</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/2.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-new">Новинка</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/3.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-new">Новинка</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/4.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-new">Новинка</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/3.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-new">Новинка</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/4.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-new">Новинка</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="gt-section" id="section-stories">
        <div class="gt-container">
            <div class="owl-carousel owl-theme" id="owl-stories">
                <div class="item gt-story-item">
                    <img src="img/images/stories/1.png" alt="">
                    <span>Бренды</span>
                </div>

                <div class="item gt-story-item">
                    <img src="img/images/stories/2.png" alt="">
                    <span>Акции</span>
                </div>

                <div class="item gt-story-item">
                    <img src="img/images/stories/3.png" alt="">
                    <span>Оплата</span>
                </div>

                <div class="item gt-story-item">
                    <img src="img/images/stories/4.png" alt="">
                    <span>Ванны Roca</span>
                </div>

                <div class="item gt-story-item">
                    <img src="img/images/stories/5.png" alt="">
                    <span>Дарим подарки</span>
                </div>

                <div class="item gt-story-item">
                    <img src="img/images/stories/6.png" alt="">
                    <span>Выбрать ванну</span>
                </div>
            </div>

        </div>


        <div class="gt-backdrop">
            <img src="img/images/additional_bg1.jpg" alt="">
            <div class="gt-fader"></div>
            <div class="gt-fader light"></div>
        </div>

        <script type="text/javascript">
            $('#owl-stories').owlCarousel({
                margin: 15,
                loop: true,
                autoWidth: true,
                responsiveClass: true,
                nav: true,
                responsive: {
                    0: {
                        items: 3,
                        nav: true,
                        margin: 20,
                    },
                    600: {
                        items: 4,
                        nav: true,
                        margin: 25,
                    },
                    1200: {
                        items: 6,
                        nav: true,
                        loop: true,
                        margin: 20,
                    }
                }
            })
        </script>
    </section>


    <section class="gt-section gt-show-mobile" id="gt-mobile-discounts">
        <div class="gt-container">

            <div class="gt-section-title">
                <h2>Скидки</h2>
                <div class="bg-text">Discounts</div>
            </div>
            <div class="owl-carousel owl-theme gt-owl-products">
                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/1.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-special">Акция</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/2.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-special">Акция</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/3.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-special">Акция</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/4.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-special">Акция</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/3.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-special">Акция</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/4.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-special">Акция</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="gt-section">
        <div class="gt-container">
            <div class="gt-section-title">
                <h2>Популярные категории</h2>
                <div class="bg-text">Categories</div>
            </div>
            <div class="gt-popular-list">
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="img/images/popular/1.png" alt="">
                        <span>Раковины</span>
                    </a>
                </div>
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="img/images/popular/2.png" alt="">
                        <span>Унитазы</span>
                    </a>
                </div>
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="img/images/popular/3.png" alt="">
                        <span>Смесители</span>
                    </a>
                </div>
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="img/images/popular/4.png" alt="">
                        <span>Системы инсталяции</span>
                    </a>
                </div>
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="img/images/popular/5.png" alt="">
                        <span>Ванны</span>
                    </a>
                </div>
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="img/images/popular/6.png" alt="">
                        <span>Мебель для ванных комнат</span>
                    </a>
                </div>
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="img/images/popular/7.png" alt="">
                        <span>Душевые углы и ограждения</span>
                    </a>
                </div>
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="img/images/popular/1.png" alt="">
                        <span>Аксессуары для ванных комнат</span>
                    </a>
                </div>
            </div>
    </section>


    <section class="gt-section">
        <div class="gt-container">

            <div class="owl-carousel owl-theme gt-slider-promo" id="slider-promos-big">
                <div class="item gt-promo-item big">
                    <div class="img">
                        <img src="img/images/big_banner1.jpg" alt="">
                    </div>
                </div>
                <div class="item gt-promo-item big">
                    <div class="img">
                        <img src="img/images/big_banner2.jpg" alt="">
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                $('#slider-promos-big').owlCarousel({
                    margin: 30,
                    loop: true,
                    autoWidth: true,
                    responsiveClass: true,
                    nav: true,
                    responsive: {
                        0: {
                            items: 2,
                            nav: true,
                            margin: 5,
                        },
                        600: {
                            items: 2,
                            nav: true,
                            margin: 15,
                        },
                        1200: {
                            items: 2,
                            nav: true,
                            loop: true,
                            margin: 30,
                        }
                    }
                })
            </script>
        </div>
    </section>


    <section class="gt-section">
        <div class="gt-container">
            <div class="gt-section-title">
                <h2>Рекомендованные товары</h2>
                <div class="bg-text">Recommendation</div>
            </div>


            <div class="owl-carousel owl-theme gt-owl-products" id="owl-recomended-items">
                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/1.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-hit">Хит продаж</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/2.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-new">Новинка</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/3.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-hit">Хит продаж</span>
                            <span class="gt-tag tag-special">Акция</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/4.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-hit">Хит продаж</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/3.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-hit">Хит продаж</span>
                        </div>
                    </div>
                </div>

                <div class="item gt-product-item">
                    <div class="gt-product-item-container">
                        <div class="gt-pr-item-content">
                            <div class="product-gal">
                                <a href="#">
                                    <img src="img/images/products/4.png" alt="" />
                                </a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="name">Наименование продукта 1</a>
                                <p>Бренд:<span><a href="#">Aquatek</a></span></p>
                                <p>Страна:<span>Россия</span></p>
                                <a href="#" class="in-stock">В наличии</a>
                                <div class="price">15 000</div>
                            </div>

                        </div>
                        <div class="product-actions">
                            <a href="#" class="gt-button">В корзину</a>
                            <div class="icons">
                                <a href="#" class="gt-ico-favorite"></a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-poll"></ico>
                                </a>

                            </div>

                        </div>
                        <div class="product-tags">
                            <span class="gt-tag tag-hit">Хит продаж</span>
                        </div>
                    </div>
                </div>

            </div>



            <script type="text/javascript">
                $('.gt-owl-products').owlCarousel({
                    margin: 15,
                    loop: true,
                    autoWidth: true,
                    responsiveClass: true,
                    nav: true,
                    responsive: {
                        0: {
                            items: 2,
                            nav: true,
                            margin: 20,
                        },
                        600: {
                            items: 3,
                            nav: true,
                            margin: 25,
                        },
                        1200: {
                            items: 4,
                            nav: true,
                            loop: true,
                            margin: 30,
                        }
                    }
                });
            </script>
        </div>
        </div>
    </section>


    <section class="gt-section">
        <div class="gt-container">

            <div class="gt-section-title">
                <h2>Популярные бренды</h2>
                <div class="bg-text">Brands</div>
            </div>

            <div class="owl-carousel owl-theme" id="owl-brands">
                <div class="item gt-brand">
                    <img src="img/images/brands/brand1.png" />
                </div>
                <div class="item gt-brand">
                    <img src="img/images/brands/brand2.png" />
                </div>
                <div class="item gt-brand">
                    <img src="img/images/brands/brand3.png" />
                </div>
                <div class="item gt-brand">
                    <img src="img/images/brands/brand4.png" />
                </div>
                <div class="item gt-brand">
                    <img src="img/images/brands/brand5.png" />
                </div>
                <div class="item gt-brand">
                    <img src="img/images/brands/brand6.png" />
                </div>


                <div class="item gt-brand">
                    <img src="img/images/brands/brand1.png" />
                </div>
                <div class="item gt-brand">
                    <img src="img/images/brands/brand2.png" />
                </div>
                <div class="item gt-brand">
                    <img src="img/images/brands/brand3.png" />
                </div>
            </div>


            <script type="text/javascript">
                $('#owl-brands').owlCarousel({
                    loop: true,
                    autoWidth: true,
                    responsiveClass: true,
                    nav: true,
                    dotsEach: 6,
                    responsive: {
                        0: {
                            items: 2,
                            nav: true,
                            margin: 10,
                            dotsEach: 2
                        },
                        600: {
                            items: 4,
                            nav: true,
                            margin: 22,
                            dotsEach: 4
                        },
                        1200: {
                            items: 6,
                            nav: true,
                            loop: true,
                            margin: 20,
                            dotsEach: 6
                        }
                    }
                })
            </script>

        </div>
    </section>



    <section class="gt-section">
        <div class="gt-container">

            <div class="gt-section-title">
                <h2>Новости и события</h2>
                <div class="bg-text">News and events</div>
            </div>


            <div class="owl-carousel owl-theme" id="owl-news">
                <div class="item gt-news-item">
                    <div class="gt-news-preview">
                        <a href="#"><img src="img/images/news-item.jpg"></a>
                        <div class="gt-news-button">
                            <a href="#" class="gt-button">Перейти в раздел</a>
                        </div>
                    </div>
                    <div class="gt-news-lead">
                        <a href="#" class="title">Новые поступления ванных</a>
                        <a href="#"> Что может быть лучше расслабляющей ванны после тяжолого рабочего дня?
                            <br>
                            У нас новые постепления, найдется ванна на любой вкус.
                        </a>
                    </div>
                </div>

                <div class="item gt-news-item">
                    <div class="gt-news-preview">
                        <a href="#"><img src="img/images/news-item.jpg"></a>
                        <div class="gt-news-button">
                            <a href="#" class="gt-button">Перейти в раздел</a>
                        </div>
                    </div>
                    <div class="gt-news-lead">
                        <a href="#" class="title">Новые поступления ванных</a>
                        <a href="#"> Что может быть лучше расслабляющей ванны после тяжолого рабочего дня?
                            <br>
                            У нас новые постепления, найдется ванна на любой вкус.
                        </a>
                    </div>
                </div>

                <div class="item gt-news-item">
                    <div class="gt-news-preview">
                        <a href="#"><img src="img/images/news-item.jpg"></a>
                        <div class="gt-news-button">
                            <a href="#" class="gt-button">Перейти в раздел</a>
                        </div>
                    </div>
                    <div class="gt-news-lead">
                        <a href="#" class="title">Новые поступления ванных</a>
                        <a href="#"> Что может быть лучше расслабляющей ванны после тяжолого рабочего дня?
                            <br>
                            У нас новые постепления, найдется ванна на любой вкус.
                        </a>
                    </div>
                </div>

                <div class="item gt-news-item">
                    <div class="gt-news-preview">
                        <a href="#"><img src="img/images/news-item.jpg"></a>
                        <div class="gt-news-button">
                            <a href="#" class="gt-button">Перейти в раздел</a>
                        </div>
                    </div>
                    <div class="gt-news-lead">
                        <a href="#" class="title">Новые поступления ванных</a>
                        <a href="#"> Что может быть лучше расслабляющей ванны после тяжолого рабочего дня?
                            <br>
                            У нас новые постепления, найдется ванна на любой вкус.
                        </a>
                    </div>
                </div>

                <div class="item gt-news-item">
                    <div class="gt-news-preview">
                        <a href="#"><img src="img/images/news-item.jpg"></a>
                        <div class="gt-news-button">
                            <a href="#" class="gt-button">Перейти в раздел</a>
                        </div>
                    </div>
                    <div class="gt-news-lead">
                        <a href="#" class="title">Новые поступления ванных</a>
                        <a href="#"> Что может быть лучше расслабляющей ванны после тяжолого рабочего дня?
                            <br>
                            У нас новые постепления, найдется ванна на любой вкус.
                        </a>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                $('#owl-news').owlCarousel({
                    loop: true,
                    autoWidth: true,
                    responsiveClass: true,
                    nav: true,
                    dotsEach: 6,
                    responsive: {
                        0: {
                            items: 1,
                            nav: true,
                            margin: 10,
                            dotsEach: 2
                        },
                        600: {
                            items: 2,
                            nav: true,
                            margin: 15,
                            dotsEach: 4
                        },
                        1200: {
                            items: 3,
                            nav: true,
                            loop: true,
                            margin: 20,
                            dotsEach: 6
                        }
                    }
                });
            </script>

        </div>
    </section>

    <!-- Footer-->
    <footer class="footer">
        <div class="gt-container">
            <div class="gt-footer-row gt-footer-main">
                <div class="gt-footer-block">
                    <div class="gt-footer-logo">
                        <img src="img/images/logo_left.png" alt="">
                    </div>

                    <div class="gt-footer-info">
                        <div class="gt-info-title">
                            Мы в социальных сетях
                        </div>

                        <div class="gt-info-content gt-flex-row">
                            <a href="#" class="gt-ico"><img src="img/icons/ico_socmedia/ico_vk.png" alt="" /></a>
                            <a href="#" class="gt-ico"><img src="img/icons/ico_socmedia/ico_ig.png" alt="" /></a>
                            <a href="#" class="gt-ico"><img src="img/icons/ico_socmedia/ico_fb.png" alt="" /></a>

                        </div>
                    </div>

                    <div class="gt-footer-info">
                        <div class="gt-info-title">
                            Мы принимаем
                        </div>
                        <div class="gt-info-content gt-flex-row">
                            <a href="#" class="gt-ico"><img src="img/icons/ico_payments/ico_visa.png" alt="" /></a>
                            <a href="#" class="gt-ico"><img src="img/icons/ico_payments/ico_master.png" alt="" /></a>
                            <a href="#" class="gt-ico"><img src="img/icons/ico_payments/ico_mir.png" alt="" /></a>

                        </div>
                    </div>

                </div>
                <div class="gt-footer-block pull-right">
                    <div class="gt-footer-title">КОНТАКТЫ</div>
                    <ul class="gt-footer-menu">
                        <li>
                            <a href="#" class="gt-ico gt-ico-contact"><span>8-800-000-00-00</span></a>
                        </li>
                        <li>
                            <a href="#" class="gt-ico gt-ico-email"><span>zakak@gidratop.ru</span></a>
                        </li>
                        <li>
                            <a href="#" class="gt-ico gt-ico-address"><span>г. Санкт-Петербург, пр-кт. Невский, д.</span></a>
                        </li>
                    </ul>
                </div>
                <div class="gt-footer-block">
                    <div class="gt-footer-title">ПОКУПАТЕЛЮ</div>
                    <ul class="gt-footer-menu">
                        <li>
                            <a href="#">Доставка</a>
                        </li>
                        <li>
                            <a href="#">Оплата</a>
                        </li>
                        <li>
                            <a href="#">Гарантии и возврат</a>
                        </li>
                        <li>
                            <a href="#">Производители</a>
                        </li>
                        <li>
                            <a href="#">Статьи</a>
                        </li>
                    </ul>
                </div>
                <div class="gt-footer-block">
                    <div class="gt-footer-title">КОМПАНИЯ</div>
                    <ul class="gt-footer-menu">
                        <li>
                            <a href="#">О нас</a>
                        </li>
                        <li>
                            <a href="#">Контакты</a>
                        </li>
                        <li>
                            <a href="#">Пользовательское соглашение</a>
                        </li>
                        <li>
                            <a href="#">Политика конфиденциальности</a>
                        </li>
                        <li>
                            <a href="#">Обратная связь</a>
                        </li>
                    </ul>

                </div>
            </div>

            <div class="gt-footer-row">
                <div class="gt-footer-block w50 gt-hide-mobile"></div>
                <div class="gt-footer-block gt-subscribe">
                    <div class="gt-input">
                        <input type="text" class="gt-textbox" placeholder="Введите Email" />
                        <input name="sr" type="submit" class="gt-button" value="Подписаться">
                    </div>
                    <div class="gt-subscribe-hint">Станьте нашим подписчиком, чтобы быть в курсе информации о новинках и специальных предложениях.</div>
                </div>
            </div>
        </div>
    </footer>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>