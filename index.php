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
        <div class="slides">

            <div class="gt-slide-item">
                <div class="gt-slider-slide">
                    <div class="gt-slide-background">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/slider/slide1.jpg" alt="" />
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
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/slider/slide1.jpg" alt="" />
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
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/slider/slide1.jpg" alt="" />
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

    <?/*
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
    */?>

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
        <div class="gt-container">
            <div class="gt-section-title">
                <h2>Акции</h2>
                <div class="bg-text">Stock</div>
            </div>
            <div class="owl-carousel owl-theme gt-slider-promo" id="slider-promos">
                <div class="item gt-promo-item">
                    <div class="img">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/banner1.jpg" alt="">
                    </div>
                </div>
                <div class="item gt-promo-item">
                    <div class="img">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/banner2.jpg" alt="">
                    </div>
                </div>
                <div class="item gt-promo-item">
                    <div class="img">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/banner3.jpg" alt="">
                    </div>
                </div>

                <div class="item gt-promo-item">
                    <div class="img">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/banner1.jpg" alt="">
                    </div>
                </div>
                <div class="item gt-promo-item">
                    <div class="img">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/banner2.jpg" alt="">
                    </div>
                </div>
                <div class="item gt-promo-item">
                    <div class="img">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/banner3.jpg" alt="">
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

<?/*
$APPLICATION->IncludeComponent(
    "krayt:section_in_glav",
    ".default",
    Array(
        "ADD_SECTIONS_CHAIN" => "Y",
        "CACHE_GROUPS" => "Y",
        "CACHE_NOTES" => "",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPONENT_TEMPLATE" => ".default",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO",
        "COUNT_ELEMENT" => "10",
        "DEFOLT_OPTION" => "Y",
        "IBLOCK_ID" => "15",
        "IBLOCK_TYPE" => "catalog",
        "LOAD_IMG_JS" => "Y",
        "PAGE_SECTION" => "/catalog/",
        "TITLE_BOX" => ""
    )
);
*/?>

<?
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
?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>