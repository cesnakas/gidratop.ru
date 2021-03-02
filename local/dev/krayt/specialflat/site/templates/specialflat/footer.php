<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>
</div>

</main>

        <a href="#" class="scrollup" style="display: block;" id="upbutton">
        <span class="circle">
            <span class="circle-in">
                <span class="arrow-in"></span>
            </span>
        </span>
        </a>

<footer class="footer">
    <div class="w1200">
        <div class="c-footer">
            <div class="footer-left">
                <div>
                <a class="footer-logo" href="<?= SITE_DIR ?>">
                    <?php $APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/logo.php")); ?>
                </a>
                <div class="footer-right-block social">
                    <?php $APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/socset.php")); ?>
                </div>
                </div>
                <div class="footer-right-block pay">
                    <div class="title"><?php $APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/footer_pay_title.php")); ?></div>
                    <div class="cards"><?php $APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/footer_pay.php")); ?></div>
                </div>
            </div>
            <div class="footer-right">
                <div class="footer-right-block">
                    <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom_menu", 
	array(
		"ROOT_MENU_TYPE" => "bottom",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "bottom",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "bottom_menu"
	),
	false
); ?>
                </div>
                <div class="footer-right-block">
                    <? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom_menu_two", 
	array(
		"ROOT_MENU_TYPE" => "bottom_two",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "bottom",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "bottom_menu_two"
	),
	false
); ?>
                </div>
                <div class="footer-right-block contacts">
                    <div class="title_box"><?=Loc::getMessage('K_KONTACT_TITLE')?></div>
                    <div>
                    <?php $APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/contact.php")); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer_bottom">
        <div class="w1200">
            <div class="left"><?=Loc::getMessage('K_COPY_DEV_SITE')?> <a href="https://krayt.ru" target="_blank"><?=Loc::getMessage('K_COPY_WEB_STUDIO')?> <span><?=Loc::getMessage('K_COPY_WEB_STUDIO_KRAYT')?></span></a></div>
            <div class="right"><?=Loc::getMessage('K_COPY_ROOM')?></div>
        </div>
    </div>
</footer>

<div class="left_panel">
    <div class="head">
        <a class="footer-logo" href="<?= SITE_DIR ?>">
            <?php $APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/logo-mobile.php")); ?>
        </a>
        <i class="close-btn"></i>
    </div>
    <div class="content">
        <div class="content-box">
            <? $APPLICATION->IncludeComponent("bitrix:menu", "menu_catalog-mobile", Array(
                "ROOT_MENU_TYPE" => "top_catalog",
                "MAX_LEVEL" => "5",
                "CHILD_MENU_TYPE" => "top_catalog",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "Y",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => "",
                "PODBORKA_TUPE" => $GLOBALS['PODBORKI']['TUGLE'],
                "SECTION_PODBORKA" => $GLOBALS['PODBORKI']['SECTION_CATALOG'],
            ),
                $component,
                array('HIDE_ICONS' => 'Y')
            ); ?>

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

            <div class="auth_form">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:system.auth.form",
                    "top_auth",
                    Array(
                        "FORGOT_PASSWORD_URL" => "",
                        "PROFILE_URL" => SITE_DIR . "auth/",
                        "REGISTER_URL" => SITE_DIR . "personal/",
                        "SHOW_ERRORS" => "N"
                    )
                ); ?>
            </div>

            <div class="search">
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
                        "PATH" => SITE_DIR."include/footer/bitrix_search_title_mobile.php"
                    )
                );?>
            </div>
        </div>
    </div>
</div>

<div class="overflow"></div>
<?if(COption::GetOptionString("krayt.specialflat", "SHOW_MODAL") == "Y"):?>
    <div id="cookies_modal">
        <div class="cookies_modal_text">
            <?=COption::GetOptionString("krayt.specialflat", "MODAL_TEXT");?>
        </div>
        <div class="cookies_modal_btn">
            <button id="cookies_modal_btn" class="btn btn_anim"><?=COption::GetOptionString("krayt.specialflat", "MODAL_BNT_TEXT");?></button>
        </div>
    </div>
    <script>
        BX.ready(function(){
            var show_cookies_modal = BX.getCookie('show_cookies_modal');

            if(!show_cookies_modal)
            {
                BX.adjust(BX('cookies_modal'), {style: {display: 'block'}});
            };
            BX.bind(BX('cookies_modal_btn'), 'click', function(){
                BX.setCookie('show_cookies_modal',"1",{path:"/"});
                BX.adjust(BX('cookies_modal'), {style: {display: 'none'}});
            });
        });
    </script>
<?endif;?>
</body>
</html>