<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

    </main>

    <footer class="footer">
        <div class="gt-container">
            <div class="gt-footer-row gt-footer-main">
                <div class="gt-footer-block">
                    <div class="gt-footer-logo">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/logo_left.png" alt="">
                    </div>

                    <div class="gt-footer-info">
                        <div class="gt-info-title">
                            Мы в социальных сетях
                        </div>

                        <div class="gt-info-content gt-flex-row">
                            <a href="#" class="gt-ico">
                                <img src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ico_socmedia/ico_vk.png" alt="" />
                            </a>
                            <a href="#" class="gt-ico">
                                <img src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ico_socmedia/ico_ig.png" alt="" />
                            </a>
                            <a href="#" class="gt-ico">
                                <img src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ico_socmedia/ico_fb.png" alt="" />
                            </a>
                        </div>
                    </div>

                    <div class="gt-footer-info">
                        <div class="gt-info-title">
                            Мы принимаем
                        </div>
                        <div class="gt-info-content gt-flex-row">
                            <a href="#" class="gt-ico">
                                <img src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ico_payments/ico_visa.png" alt="" />
                            </a>
                            <a href="#" class="gt-ico">
                                <img src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ico_payments/ico_master.png" alt="" />
                            </a>
                            <a href="#" class="gt-ico">
                                <img src="<?=SITE_TEMPLATE_PATH;?>/img/icons/ico_payments/ico_mir.png" alt="" />
                            </a>
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

                    <!--<ul class="gt-footer-menu">
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
                    </ul>-->
                </div>
                <div class="gt-footer-block">
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

                    <!--<ul class="gt-footer-menu">
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
                    </ul>-->

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

</body>
</html>