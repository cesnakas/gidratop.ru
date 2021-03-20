<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Интернет-магазин европейской сантехники");
$APPLICATION->SetPageProperty("keywords", "Интернет-магазин европейской сантехники");
$APPLICATION->SetPageProperty("title", "Интернет-магазин европейской сантехники");
$APPLICATION->SetTitle("Gidratop | Интернет-магазин европейской сантехники");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
?>

<? if (IsModuleInstalled("advertising")): ?>

    <section class="gt-section" id="gt-section-slider">

        <?
        $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "slider",
            array(
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "ADD_SECTIONS_CHAIN" => "Y",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "DISPLAY_DATE" => "Y",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "DISPLAY_TOP_PAGER" => "N",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "FILTER_NAME" => "",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "IBLOCK_ID" => "11",
                "IBLOCK_TYPE" => "content",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
                "INCLUDE_SUBSECTIONS" => "Y",
                "MESSAGE_404" => "",
                "NEWS_COUNT" => "20",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_TEMPLATE" => ".default",
                "PAGER_TITLE" => "Новости",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "PREVIEW_TRUNCATE_LEN" => "",
                "PROPERTY_CODE" => array(
                    0 => "LINK",
                    1 => "MOBILE_BANNER",
                    2 => "",
                ),
                "SET_BROWSER_TITLE" => "Y",
                "SET_LAST_MODIFIED" => "N",
                "SET_META_DESCRIPTION" => "Y",
                "SET_META_KEYWORDS" => "Y",
                "SET_STATUS_404" => "N",
                "SET_TITLE" => "Y",
                "SHOW_404" => "N",
                "SORT_BY1" => "ACTIVE_FROM",
                "SORT_BY2" => "SORT",
                "SORT_ORDER1" => "DESC",
                "SORT_ORDER2" => "ASC",
                "STRICT_SECTION_CHECK" => "N",
                "COMPONENT_TEMPLATE" => "slider",
                "INTERVAL_COUNT" => "5000",
                "LOAD_IMG_JS" => "Y",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO"
            ),
            false
        );
        ?>

    </section>

    <?/*
    $APPLICATION->IncludeComponent(
        "bitrix:advertising.banner",
        "new_baner",
        Array(
            "16" => "/catalog/",
            "BS_ARROW_NAV" => "Y",
            "BS_BULLET_NAV" => "Y",
            "BS_CYCLING" => "Y",
            "BS_EFFECT" => "fade",
            "BS_HIDE_FOR_PHONES" => "Y",
            "BS_HIDE_FOR_TABLETS" => "N",
            "BS_INTERVAL" => "5000",
            "BS_KEYBOARD" => "Y",
            "BS_PAUSE" => "Y",
            "BS_WRAP" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "DEFAULT_TEMPLATE" => "-",
            "NOINDEX" => "Y",
            "QUANTITY" => "3",
            "TITLE_BOX" => "ПОПУЛЯРНЫЕ КАТЕКГОРИИ",
            "TYPE" => "MAIN"
        )
    );
    */?>

<? endif; ?>

    <section class="gt-section">
        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.top",
            "new_top",
            array(
                "ACTION_VARIABLE" => "action",
                "ADD_PICT_PROP" => "MORE_PHOTO",
                "ADD_PROPERTIES_TO_BASKET" => "Y",
                "ADD_TO_BASKET_ACTION" => "BUY",
                "BASKET_URL" => "/personal/basket.php",
                "BRAND_PROPERTY" => "-",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "CACHE_TIME" => "36000000",
                "CACHE_TYPE" => "A",
                "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
                "COMPARE_PATH" => "",
                "COMPATIBLE_MODE" => "Y",
                "COMPONENT_TEMPLATE" => "new_top",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO",
                "CONVERT_CURRENCY" => "Y",
                "CURRENCY_ID" => "RUB",
                "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
                "DATA_LAYER_NAME" => "dataLayer",
                "DETAIL_URL" => "",
                "DISCOUNT_PERCENT_POSITION" => "bottom-right",
                "DISPLAY_COMPARE" => "Y",
                "ELEMENT_COUNT" => "5",
                "ELEMENT_SORT_FIELD" => "shows",
                "ELEMENT_SORT_FIELD2" => "shows",
                "ELEMENT_SORT_ORDER" => "asc",
                "ELEMENT_SORT_ORDER2" => "asc",
                "ENLARGE_PRODUCT" => "STRICT",
                "FILTER_NAME" => "",
                "HIDE_NOT_AVAILABLE" => "N",
                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                "HIDE_SECOND_PICT" => "Y",
                "IBLOCK_ID" => "8",
                "IBLOCK_TYPE" => "catalog",
                "LABEL_PROP" => array(
                ),
                "LABEL_PROP_MOBILE" => array(
                    0 => "UCENKA",
                ),
                "LABEL_PROP_POSITION" => "top-left",
                "LINE_ELEMENT_COUNT" => "",
                "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                "MESS_BTN_BUY" => "Купить",
                "MESS_BTN_COMPARE" => "Сравнить",
                "MESS_BTN_DETAIL" => "Подробнее",
                "MESS_NOT_AVAILABLE" => "Нет в наличии",
                "MESS_RELATIVE_QUANTITY_FEW" => "мало",
                "MESS_RELATIVE_QUANTITY_MANY" => "много",
                "MESS_SHOW_MAX_QUANTITY" => "Наличие",
                "OFFERS_CART_PROPERTIES" => array(
                ),
                "OFFERS_FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "OFFERS_LIMIT" => "5",
                "OFFERS_PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "OFFERS_SORT_FIELD" => "shows",
                "OFFERS_SORT_FIELD2" => "shows",
                "OFFERS_SORT_ORDER" => "asc",
                "OFFERS_SORT_ORDER2" => "asc",
                "OFFER_ADD_PICT_PROP" => "-",
                "OFFER_TREE_PROPS" => array(
                ),
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRICE_CODE" => array(
                    0 => "BASE",
                ),
                "PRICE_VAT_INCLUDE" => "Y",
                "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                "PRODUCT_DISPLAY_MODE" => "Y",
                "PRODUCT_ID_VARIABLE" => "id",
                "PRODUCT_PROPERTIES" => array(
                ),
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PRODUCT_QUANTITY_VARIABLE" => "",
                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                "PRODUCT_SUBSCRIPTION" => "Y",
                "PROPERTY_CODE" => array(
                    0 => "ARTICUL",
                    1 => "BREND",
                    2 => "COLLECTION",
                    3 => "STRANA",
                    4 => "",
                ),
                "PROPERTY_CODE_MOBILE" => array(
                ),
                "PROP_1" => "COD_TOVARA",
                "PROP_2" => "BREND",
                "PROP_3" => "STRANA",
                "PROP_4" => "MATERIAL",
                "PROP_5" => "",
                "PROP_ARTICUL" => "COD_TOVARA",
                "RELATIVE_QUANTITY_FACTOR" => "5",
                "ROTATE_TIMER" => "30",
                "SECTION_URL" => "",
                "SEF_MODE" => "N",
                "SEF_RULE" => "",
                "SHOW_CLOSE_POPUP" => "N",
                "SHOW_DISCOUNT_PERCENT" => "Y",
                "SHOW_MAX_QUANTITY" => "N",
                "SHOW_OLD_PRICE" => "Y",
                "SHOW_PAGINATION" => "Y",
                "SHOW_PRICE_COUNT" => "1",
                "SHOW_SLIDER" => "Y",
                "SLIDER_INTERVAL" => "3000",
                "SLIDER_PROGRESS" => "N",
                "TEMPLATE_THEME" => "blue",
                "TITLE_BOX" => "Товары по акции",
                "USE_ENHANCED_ECOMMERCE" => "Y",
                "USE_PRICE_COUNT" => "N",
                "USE_PRODUCT_QUANTITY" => "Y",
                "VIEW_MODE" => "SECTION"
            ),
            false,
            array(
                "ACTIVE_COMPONENT" => "Y"
            )
        );?>
    </section>

    <section class="gt-section gt-hide-mobile" id="gt-section-tabs">
        <div class="gt-container">

            <div id="gt-tabs" class="gt-tabcontrol">
                <ul class="gt-tabmenu gt-tabs-ul1">
                    <li class="active">
                        <a href="#" data-tab="tabHits" onclick="clickTab(event, this)"><img src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ico_tab1.svg" alt="" />Хиты продаж</a>
                    </li>
                    <li>
                        <a href="#" data-tab="tabNew" onclick="clickTab(event, this)"><img src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ico_tab2.svg" alt="" />Новинки</a>
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/1.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/2.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/3.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/4.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/3.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/4.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/1.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/2.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/3.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/4.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/3.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/4.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/1.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/2.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/3.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/4.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/3.png" alt="" />
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
                                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/4.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/1.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/2.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/3.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/4.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/3.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/4.png" alt="" />
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
                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ico_offer1.svg" alt="">
                        </div>
                        <div class="gt-offer-info">
                            <strong>Доставка</strong>
                            <p>Доставим товар в удобное для вас время</p>
                        </div>
                    </div>

                    <div class="gt-offer">
                        <div class="gt-offer-thumb">
                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ico_offer2.svg" alt="">
                        </div>
                        <div class="gt-offer-info">
                            <strong>Самовывоз</strong>
                            <p>Вы можете самостоятельно забрать заказ в пункте самовывоза.</p>
                        </div>
                    </div>


                    <div class="gt-offer">
                        <div class="gt-offer-thumb">
                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ico_offer5.svg" alt="">
                        </div>
                        <div class="gt-offer-info">
                            <strong>ШИРОКИЙ АССОРТИМЕНТ ТОВАРОВ</strong>
                            <p>У нас найдётся всё</p>
                        </div>
                    </div>

                    <div class="gt-offer">
                        <div class="gt-offer-thumb">
                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ico_offer3.svg" alt="">
                        </div>
                        <div class="gt-offer-info">
                            <strong>Клиентский сервис</strong>
                            <p>Оказываем поддержку на всех этапах покупки товара</p>
                        </div>
                    </div>

                    <div class="gt-offer">
                        <div class="gt-offer-thumb">
                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ico_offer4.svg" alt="">
                        </div>
                        <div class="gt-offer-info">
                            <strong>Гарантия качества</strong>
                            <p>Соответствуем требованиям и стандартам качества</p>
                        </div>
                    </div>

                    <div class="gt-offer">
                        <div class="gt-offer-thumb">
                            <img src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ico_offer6.svg" alt="">
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/1.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/2.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/3.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/4.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/3.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/4.png" alt="" />
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
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/stories/1.png" alt="">
                    <span>Бренды</span>
                </div>

                <div class="item gt-story-item">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/stories/2.png" alt="">
                    <span>Акции</span>
                </div>

                <div class="item gt-story-item">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/stories/3.png" alt="">
                    <span>Оплата</span>
                </div>

                <div class="item gt-story-item">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/stories/4.png" alt="">
                    <span>Ванны Roca</span>
                </div>

                <div class="item gt-story-item">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/stories/5.png" alt="">
                    <span>Дарим подарки</span>
                </div>

                <div class="item gt-story-item">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/stories/6.png" alt="">
                    <span>Выбрать ванну</span>
                </div>
            </div>

        </div>


        <div class="gt-backdrop">
            <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/additional_bg1.jpg" alt="">
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/1.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/2.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/3.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/4.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/3.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/4.png" alt="" />
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
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/popular/1.png" alt="">
                        <span>Раковины</span>
                    </a>
                </div>
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/popular/2.png" alt="">
                        <span>Унитазы</span>
                    </a>
                </div>
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/popular/3.png" alt="">
                        <span>Смесители</span>
                    </a>
                </div>
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/popular/4.png" alt="">
                        <span>Системы инсталяции</span>
                    </a>
                </div>
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/popular/5.png" alt="">
                        <span>Ванны</span>
                    </a>
                </div>
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/popular/6.png" alt="">
                        <span>Мебель для ванных комнат</span>
                    </a>
                </div>
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/popular/7.png" alt="">
                        <span>Душевые углы и ограждения</span>
                    </a>
                </div>
                <div class="gt-popular-item">
                    <a href="#">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/popular/1.png" alt="">
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
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/big_banner1.jpg" alt="">
                    </div>
                </div>
                <div class="item gt-promo-item big">
                    <div class="img">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/big_banner2.jpg" alt="">
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/1.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/2.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/3.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/4.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/3.png" alt="" />
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
                                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/products/4.png" alt="" />
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
    <?/*
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "section_glav",
        array(
            "ACTION_VARIABLE" => "action",
            "ADD_PICT_PROP" => "MORE_PHOTO",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "ADD_SECTIONS_CHAIN" => "N",
            "ADD_TO_BASKET_ACTION" => "ADD",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "N",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "BACKGROUND_IMAGE" => "-",
            "BASKET_URL" => "/personal/cart/",
            "BROWSER_TITLE" => "-",
            "CACHE_FILTER" => "N",
            "CACHE_GROUPS" => "Y",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
            "COMPARE_PATH" => "",
            "COMPATIBLE_MODE" => "Y",
            "COMPONENT_TEMPLATE" => "section_glav",
            "COMPOSITE_FRAME_MODE" => "A",
            "COMPOSITE_FRAME_TYPE" => "AUTO",
            "CONVERT_CURRENCY" => "N",
            "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[]}",
            "DETAIL_URL" => "",
            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "DISPLAY_COMPARE" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "ELEMENT_SORT_FIELD" => "sort",
            "ELEMENT_SORT_FIELD2" => "shows",
            "ELEMENT_SORT_ORDER" => "desc",
            "ELEMENT_SORT_ORDER2" => "asc",
            "ENLARGE_PRODUCT" => "STRICT",
            "FILTER_NAME" => "arrFilter",
            "HIDE_NOT_AVAILABLE" => "N",
            "HIDE_NOT_AVAILABLE_OFFERS" => "N",
            "HIDE_SECOND_PICT" => "Y",
            "IBLOCK_ID" => "8",
            "IBLOCK_TYPE" => "catalog",
            "IBLOCK_TYPE_ID" => "catalog",
            "INCLUDE_SUBSECTIONS" => "Y",
            "LABEL_PROP" => array(
            ),
            "LABEL_PROP_MOBILE" => array(
                0 => "AKCIYA",
                1 => "UCENKA",
                2 => "NEW",
                3 => "BEST",
            ),
            "LABEL_PROP_POSITION" => "top-left",
            "LAZY_LOAD" => "N",
            "LINE_ELEMENT_COUNT" => "3",
            "LOAD_IMG_JS" => "Y",
            "LOAD_ON_SCROLL" => "N",
            "MESSAGE_404" => "",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_COMPARE" => "Сравнить",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_BTN_SUBSCRIBE" => "Подписаться",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "META_DESCRIPTION" => "-",
            "META_KEYWORDS" => "-",
            "OFFERS_CART_PROPERTIES" => array(
            ),
            "OFFERS_FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "OFFERS_LIMIT" => "3",
            "OFFERS_PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "OFFERS_SORT_FIELD" => "shows",
            "OFFERS_SORT_FIELD2" => "shows",
            "OFFERS_SORT_ORDER" => "asc",
            "OFFERS_SORT_ORDER2" => "asc",
            "OFFER_ADD_PICT_PROP" => "-",
            "OFFER_TREE_PROPS" => "",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Товары",
            "PAGE_ELEMENT_COUNT" => "5",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "PRICE_CODE" => array(
                0 => "BASE",
            ),
            "PRICE_VAT_INCLUDE" => "Y",
            "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
            "PRODUCT_DISPLAY_MODE" => "N",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRODUCT_PROPERTIES" => array(
            ),
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PRODUCT_QUANTITY_VARIABLE" => "",
            "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
            "PRODUCT_SUBSCRIPTION" => "N",
            "PROPERTY_CODE" => array(
                0 => "ARTICUL",
                1 => "BREND",
                2 => "COLLECTION",
                3 => "STRANA",
                4 => "",
            ),
            "PROPERTY_CODE_MOBILE" => array(
                0 => "ARTICUL",
                1 => "BREND",
                2 => "COLLECTION",
                3 => "STRANA",
            ),
            "PROP_1" => "BREND",
            "PROP_2" => "MATERIAL",
            "PROP_3" => "STRANA",
            "PROP_4" => "COD_TOVARA",
            "PROP_5" => "",
            "PROP_ARTICUL" => "COD_TOVARA",
            "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
            "RCM_TYPE" => "personal",
            "SECTION_CODE" => "",
            "SECTION_ID" => $_REQUEST["SECTION_ID"],
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "SECTION_URL" => "",
            "SECTION_USER_FIELDS" => array(
                0 => "",
                1 => "",
            ),
            "SEF_MODE" => "N",
            "SET_BROWSER_TITLE" => "Y",
            "SET_LAST_MODIFIED" => "N",
            "SET_META_DESCRIPTION" => "Y",
            "SET_META_KEYWORDS" => "Y",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "Y",
            "SHOW_404" => "N",
            "SHOW_ALL_WO_SECTION" => "Y",
            "SHOW_CLOSE_POPUP" => "N",
            "SHOW_DISCOUNT_PERCENT" => "Y",
            "SHOW_FROM_SECTION" => "N",
            "SHOW_MAX_QUANTITY" => "N",
            "SHOW_OLD_PRICE" => "Y",
            "SHOW_PRICE_COUNT" => "1",
            "SHOW_SLIDER" => "Y",
            "SLIDER_INTERVAL" => "3000",
            "SLIDER_PROGRESS" => "N",
            "TEMPLATE_THEME" => "site",
            "TITLE_BOX" => "Рекомендованные товары",
            "USE_ENHANCED_ECOMMERCE" => "N",
            "USE_MAIN_ELEMENT_SECTION" => "N",
            "USE_PRICE_COUNT" => "N",
            "USE_PRODUCT_QUANTITY" => "N"
        ),
        false
    );
    */?>

    <section class="gt-section">
        <div class="gt-container">

            <div class="gt-section-title">
                <h2>Популярные бренды</h2>
                <div class="bg-text">Brands</div>
            </div>

            <div class="owl-carousel owl-theme" id="owl-brands">
                <div class="item gt-brand">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/brands/brand1.png" />
                </div>
                <div class="item gt-brand">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/brands/brand2.png" />
                </div>
                <div class="item gt-brand">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/brands/brand3.png" />
                </div>
                <div class="item gt-brand">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/brands/brand4.png" />
                </div>
                <div class="item gt-brand">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/brands/brand5.png" />
                </div>
                <div class="item gt-brand">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/brands/brand6.png" />
                </div>


                <div class="item gt-brand">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/brands/brand1.png" />
                </div>
                <div class="item gt-brand">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/brands/brand2.png" />
                </div>
                <div class="item gt-brand">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/brands/brand3.png" />
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
                        <a href="#"><img src="<?=SITE_TEMPLATE_PATH;?>/img/images/news-item.jpg"></a>
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
                        <a href="#"><img src="<?=SITE_TEMPLATE_PATH;?>/img/images/news-item.jpg"></a>
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
                        <a href="#"><img src="<?=SITE_TEMPLATE_PATH;?>/img/images/news-item.jpg"></a>
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
                        <a href="#"><img src="<?=SITE_TEMPLATE_PATH;?>/img/images/news-item.jpg"></a>
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
                        <a href="#"><img src="<?=SITE_TEMPLATE_PATH;?>/img/images/news-item.jpg"></a>
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

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>