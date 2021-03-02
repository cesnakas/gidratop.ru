<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID;?>" class="no-js" prefix="og: http://ogp.me/ns#">
<head>

    <?
    $APPLICATION->ShowHead();
    // Bitrix
    use Bitrix\Main\Page\Asset;

    // Meta
    Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=0">');

    // Bootstrap v4
    // use Bitrix\Main\UI\Extension;
    //Extension::load('ui.bootstrap4');

    // CSS
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/fonts/ptsans/ptsans.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/fonts/DINPro/stylesheet.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/style.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/style-adjusted.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/style-tablet.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/style-mobile.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/assets/owlcarousel/assets/owl.carousel.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/assets/owlcarousel/assets/owl.theme.default.min.css');

    // JS
    Asset::getInstance()->addJs('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js');
    Asset::getInstance()->addJs('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/vendors/jquery.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/owlcarousel/owl.carousel.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/scripts.js');
    ?>

    <title><?$APPLICATION->ShowTitle();?></title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-178776193-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-178776193-1');
    </script>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m, e, t, r, i, k, a) {
            m[i] = m[i] || function() {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        ym(67589239, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/67589239" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">

</head>
<div id="panel"><?$APPLICATION->ShowPanel();?></div>
<body>

    <header>
        <div class="header-top">
            <div class="gt-container">

                <table class="gt-table">
                    <tbody>
                    <tr>
                        <td class="gt-logo">
                            <a href="<?=SITE_DIR;?>">
                                <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/logo_left.png" alt="">
                            </a>
                        </td>
                        <td class="gt-menu-holder">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:menu",
                                "top_menu",
                                array(
                                    "ROOT_MENU_TYPE" => "top",
                                    "MAX_LEVEL" => "4",
                                    "CHILD_MENU_TYPE" => "top",
                                    "USE_EXT" => "N",
                                    "DELAY" => "N",
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "MENU_CACHE_TYPE" => "N",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => array("")
                                ),
                                false
                            );?>
                        </td>

                        <td class="gt-icons-top">
                            <a href="#" class="gt-ico gt-ico-phone"></a>
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:system.auth.form",
                                "top_auth",
                                array(
                                    "FORGOT_PASSWORD_URL" => "",
                                    "PROFILE_URL" => SITE_DIR."personal",
                                    "REGISTER_URL" => SITE_DIR."personal/",
                                    "SHOW_ERRORS" => "N",
                                    "COMPONENT_TEMPLATE" => "top_auth"
                                ),
                                false
                            );?>

                            <div class="gt-show-mobile gt-icons-mobile ">
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-favorite"></ico>
                                </a>
                                <a href="#" class="gt-ico">
                                    <ico class="gt-ico-cart"></ico>
                                </a>

                                <div id="gt_mobile-menu-toggler" class="gt_navbar-toggle" onclick="return fn_toggleMobileMenu(this)">
                                    <span class="sr-only">Свернуть навигацию</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </header>

    <div class="header-bottom">
        <div class="gt-container gt-flex-row">
            <table class="gt-table">
                <tbody>
                <tr>
                    <td class="gt-catalog">
                        <a href="<?=SITE_DIR;?>catalog/" class="gt-catalog-toggler">Каталог товаров</a>
                    </td>
                    <td class="gt-search-top">
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_RECURSIVE" => "Y",
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "COMPOSITE_FRAME_MODE" => "A",
                                "COMPOSITE_FRAME_TYPE" => "AUTO",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_DIR."include/header/bitrix_search_title.php"
                            )
                        );?>
                    </td>
                    <td class="gt-header-phone">

                        <strong>8-800-000-00-00</strong>
                        <span>Вам перезвонить?</span>
                    </td>
                    <td class="gt-subheader-icons">
                        <a href="<?=SITE_DIR?>catalog/favorite/" class="gt-ico">
                            <?
                            $mas_forewer_cookie = explode("|", $_COOKIE['FOREVER']);
                            $mas_ok = array();
                            foreach ($mas_forewer_cookie as $value) {
                                if (!empty($value)) {
                                    $mas_ok[] = $value;
                                }
                            }
                            ?>
                            <ico class="gt-ico-favorite"></ico><span>Избранное</span>
                        </a>
                        <a href="#" class="gt-ico">
                            <?$APPLICATION->IncludeComponent(
                                "bitrix:main.include",
                                "",
                                Array(
                                    "AREA_FILE_RECURSIVE" => "Y",
                                    "AREA_FILE_SHOW" => "file",
                                    "AREA_FILE_SUFFIX" => "inc",
                                    "COMPOSITE_FRAME_MODE" => "A",
                                    "COMPOSITE_FRAME_TYPE" => "AUTO",
                                    "EDIT_TEMPLATE" => "",
                                    "PATH" => SITE_DIR."include/header/bitrix_catalog_compare_list.php"
                                )
                            );?>
                            <ico class="gt-ico-poll"></ico><span>Сравнение</span>
                        </a>
                        <a href="#" class="gt-ico">
                            <?/* $APPLICATION->IncludeComponent(
                                "bitrix:sale.basket.basket.line",
                                "mini_basket",
                                Array(
                                    "HIDE_ON_BASKET_PAGES" => "Y",
                                    "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
                                    "PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",
                                    "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
                                    "PATH_TO_PROFILE" => SITE_DIR . "personal/",
                                    "PATH_TO_REGISTER" => SITE_DIR . "login/",
                                    "POSITION_FIXED" => "N",
                                    "POSITION_HORIZONTAL" => "right",
                                    "POSITION_VERTICAL" => "top",
                                    "SHOW_AUTHOR" => "N",
                                    "SHOW_DELAY" => "N",
                                    "SHOW_EMPTY_VALUES" => "Y",
                                    "SHOW_IMAGE" => "Y",
                                    "SHOW_NOTAVAIL" => "N",
                                    "SHOW_NUM_PRODUCTS" => "Y",
                                    "SHOW_PERSONAL_LINK" => "N",
                                    "SHOW_PRICE" => "Y",
                                    "SHOW_PRODUCTS" => "Y",
                                    "SHOW_SUMMARY" => "Y",
                                    "SHOW_TOTAL_PRICE" => "Y",
                                    "COMPONENT_TEMPLATE" => ".default",
                                    "PATH_TO_AUTHORIZE" => "",
                                    "SHOW_SUBSCRIBE" => "N",
                                ),
                                false
                            ); */?>
                            <ico class="gt-ico-cart"></ico><span>Корзина</span>
                        </a>

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