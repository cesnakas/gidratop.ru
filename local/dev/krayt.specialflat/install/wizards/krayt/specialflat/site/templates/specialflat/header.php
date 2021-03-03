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
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/
    <link rel="shortcut icon" type="image/x-icon" href="<?=SITE_DIR?>favicon.ico"/>
    <title><? $APPLICATION->ShowTitle() ?></title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800&display=swap&subset=cyrillic,cyrillic-ext" rel="stylesheet">

	<script>
        var settingSantech = {
            SITE_DIR: '<?=SITE_DIR?>',
            SITE_ID: '<?=SITE_ID?>',
            SITE_TEMPLATE_PATH:'<?=SITE_TEMPLATE_PATH?>'
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

    <? $APPLICATION->ShowHead(); ?>
</head>
<body>
<? $APPLICATION->ShowPanel() ?>
<header>
    <div class="header-top">
        <div class="w1200 header-top_cont">
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
    <div class="header-bottom">
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
                        <div class="header_icons_text"><?=Loc::getMessage('K_COMPARE_TITLE')?></div>
                    </div>
                    <div class="header_icon_cont basket_btn" >

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


<main>

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


