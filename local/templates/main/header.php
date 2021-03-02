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
    // Asset::getInstance()->addCss('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css');
    // Asset::getInstance()->addCss('https://cdn.jsdelivr.net/npm/swiper@6.4.1/swiper-bundle.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/fonts/ptsans/ptsans.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/fonts/DINPro/stylesheet.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/style.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/style-adjusted.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/style-tablet.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/style-mobile.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/assets/owlcarousel/assets/owl.carousel.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/assets/owlcarousel/assets/owl.theme.default.min.css');

    // JS
    // Asset::getInstance()->addJs('https://code.jquery.com/jquery-3.5.1.min.js');
    // Asset::getInstance()->addJs('https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js');
    // Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js');
    // Asset::getInstance()->addJs('https://cdn.jsdelivr.net/npm/swiper@6.4.1/swiper-bundle.min.js');
    Asset::getInstance()->addJs('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js');
    Asset::getInstance()->addJs('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/vendors/jquery.min.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/assets/owlcarousel/owl.carousel.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/scripts.js');
    ?>

    <title><?$APPLICATION->ShowTitle();?></title>

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