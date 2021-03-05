<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Loader;
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED ||
    \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
)
{
    ShowMessage(Loc::getMessage('K_ERROR',['NAME_MODULE' => "krayt.specialflat"]));
}
CJSCore::RegisterExt('lang_js', array(
    'lang' => SITE_TEMPLATE_PATH.'/lang/'.LANGUAGE_ID.'/js/script.php'
));

CJSCore::Init(array("jquery2", "fx", "ajax",'lang_js'));

?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" / <link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico" />
        <title>
            <? $APPLICATION->ShowTitle() ?>
        </title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800&display=swap&subset=cyrillic,cyrillic-ext" rel="stylesheet">

        <script>
            var settingSantech = {
                SITE_DIR: '<?=SITE_DIR?>',
                SITE_ID: '<?=SITE_ID?>',
                SITE_TEMPLATE_PATH: '<?=SITE_TEMPLATE_PATH?>'
            };
        </script>

        <?
    use Bitrix\Main\Page\Asset;

    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/jquery.bxslider.min.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/owl.carousel.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/tooltipster.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/jquery.fancybox.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/css/animate.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/js/slick/slick.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/js/jQueryFormStyler/jquery.formstyler.css");
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH . "/js/jQueryFormStyler/jquery.formstyler.theme.css");

    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.bxslider.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/owl.carousel.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/tooltipster.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.fancybox.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/slick/slick.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jQueryFormStyler/jquery.formstyler.min.js");
   // Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/zoomsl-3.0.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.cookie.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/jquery.tablesorter.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/wow.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/velocity.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/script.js");

    ?>
            <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
            <? $APPLICATION->ShowHead(); ?>
                <link href="fonts/ptsans/ptsans.css" type="text/css" rel="stylesheet" />
                <link href="fonts/DINPro/stylesheet.css" type="text/css" rel="stylesheet" />
                <link href="style.css" type="text/css" rel="stylesheet" />
                <link href="style-adjusted.css" type="text/css" rel="stylesheet" />
                <link href="style-tablet.css" type="text/css" rel="stylesheet" />
                <link href="style-mobile.css" type="text/css" rel="stylesheet" />
    </head>

    <body>
        <? $APPLICATION->ShowPanel() ?>
            <header>

                <div class="gt-container">

                    <table class="gt-table">
                        <tbody>
                            <tr>
                                <td class="gt-logo">
                                    <a href="#">
                                        <img src="/images/left_big.png" alt="">
                                    </a>
                                </td>
                                <td class="gt-menu-holder">
                                    <ul class="gt-menu">
                                        <li><a href="#">О нас</a></li>
                                        <li><a href="#">Производители</a></li>
                                        <li><a href="#">Гарантии и возврат</a></li>
                                        <li><a href="#">Доставка</a></li>
                                        <li><a href="#">Оплата</a></li>
                                        <li><a href="#">Контакты</a></li>
                                    </ul>

                                </td>

                                <td class="gt-icons-top">
                                    <a href="#" class="gt-ico gt-ico-phone"></a>
                                    <a href="#" class="gt-ico gt-ico-user">
                                        <span class="gt-hide-tablet">Вход / регистрация</span>
                                    </a>

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


                <div class="header-top" style="display: none !important;">
                    <div class="w1200 header-top_cont" data-class="w1200">
                        <div class="header_top_left">
                            <div class="header-middle-left">
                                <a href="<?= SITE_DIR ?>" class="logo">
                                    <?php $APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/logo.php")); ?>
                                </a>
                            </div>
                            <nav>
                                <? $APPLICATION->IncludeComponent(
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
                ); ?>
                            </nav>
                        </div>
                        <div class="top-auth">
                            <? $APPLICATION->IncludeComponent(
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
                ); ?>
                        </div>
                    </div>
                </div>
                <div class="header-bottom" style="display: none !important;">
                    <div class="hb-content w1200">
                        <div class="w1200 catalog-nav-box_cont">
                            <div class="catalog-nav-box">
                                <a class="catalog-btn" href="<?= SITE_DIR ?>catalog/" id="catalog-btn">
                                    <i class="cat-menu">
                            <div class="line"></div>
                            <div class="line"></div>
                            <div class="line"></div>
                        </i>
                                    <span><?= GetMessage("TITLE_TOP_MENU"); ?></span>
                                </a>

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
                            "PATH" => SITE_DIR."include/header/krayt_new_menu_catalog.php"
                        )
                    );?>
                            </div>


                            <div class="header-title-search">
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
                            </div>

                            <div class="panel_box">

                                <div class="mob_search"></div>
                                <div class="mob_fon"></div>

                                <div class="mob_search_panel">

                                    <?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"search_top_mobile", 
	array(
		"CATEGORY_0" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_TITLE" => "",
		"CATEGORY_0_iblock_catalog" => array(
			0 => "8",
		),
		"CHECK_DATES" => "N",
		"CONTAINER_ID" => "title-search2",
		"INPUT_ID" => "title-search-input2",
		"NUM_CATEGORIES" => "1",
		"ORDER" => "date",
		"PAGE" => "#SITE_DIR#search/index.php",
		"SHOW_INPUT" => "Y",
		"SHOW_OTHERS" => "N",
		"TOP_COUNT" => "5",
		"USE_LANGUAGE_GUESS" => "Y",
		"COMPONENT_TEMPLATE" => "search_top_mobile",
		"TEMPLATE_THEME" => "green",
		"PRICE_CODE" => "",
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SHOW_PREVIEW" => "Y",
		"CONVERT_CURRENCY" => "N",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75"
	),
	false
);?>




                                </div>
                                <div class="mob_zaglushka"></div>







                                <a href="<?= SITE_DIR ?>" class="logo_mobile">
                                    <?php $APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/logo.php")); ?>
                                </a>
                                <div class="header_icon_cont">
                                    <a href="<?= SITE_DIR ?>catalog/favorite/" class="favorit_icon_box">
                                        <?
                        $mas_forewer_cookie = explode("|", $_COOKIE['FOREVER']);
                        $mas_ok = array();
                        foreach ($mas_forewer_cookie as $value) {
                            if (!empty($value)) {
                                $mas_ok[] = $value;
                            }
                        }
                        ?>
                                            <div class="circle-num">
                                                <div class="icon_forever">
                                                    <span><?= count($mas_ok); ?></span>
                                                </div>
                                            </div>
                                    </a>
                                    <div class="header_icons_text">
                                        <?=Loc::getMessage('K_FAVORITE_TITLE')?>
                                    </div>
                                </div>
                                <div class="header_icon_cont">
                                    <div class="cpmpare_icon_box" id="open__compare">
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
                                    </div>
                                    <div class="header_icons_text">
                                        <?=Loc::getMessage('K_COMPARE_TITLE')?>
                                    </div>
                                </div>
                                <div class="header_icon_cont basket_btn">

                                    <? $APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "mini_basket", Array(
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
                                ); ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

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


            <main>
                <div class="for_banner"></div>
                <div class="w1200">

                    <? $APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "breadcrumbs",
            Array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0"
            )
        ); ?>