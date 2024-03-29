<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Контакты - интернет-магазин европейской сантехники");
$APPLICATION->SetPageProperty("keywords", "Контакты - интернет-магазин европейской сантехники");
$APPLICATION->SetPageProperty("title", "Контакты - интернет-магазин европейской сантехники");
$APPLICATION->SetTitle("Контакты - Интернет-магазин европейской сантехники");
echo '<section class="gt-container">'
?>            <div class="gt-breadcrumbs-holder">
                <ul class="gt-breadcrumbs">
                    <li><a href="/">Главная</a></li>
                    <li>Контакты</li>
                </ul>
            </div>
            <div class="gt-section-title">
                <h2>Контакты</h2>
                <div class="bg-text">Contacts</div>
            </div>

            <div class="gt-contacts">
                <div class="gt-left gt-article-medium">
                    <div class="gt-text gt-text-blue gt-bold">ТЕЛЕФОН</div>
                    <p>
                        Телефоны единой справочной службы:
                    </p>
                    <ul>
                        <li><a href="tel:8(800)700-00-00">8(800)800-00-00</a></li>
                        <li><a href="tel:8(800)700-00-00">8(800)700-00-00</a></li>
                    </ul>
                    <p>
                        Ежедневно с 9.00 до 20.00
                    </p>
                    <div class="gt-text gt-text-blue gt-bold">СОЦИАЛЬНЫЕ СЕТИ</div>

                    <p class="contacts-socmedia">
						<a href="#"><img src="/local/templates/main/img/icons/ico_socmedia/ico_vk.png" /></a>
                        <a href="#"><img src="/local/templates/main/img/icons/ico_socmedia/ico_ig.png" /></a>
                        <a href="#"><img src="/local/templates/main/img/icons/ico_socmedia/ico_fb.png" /></a>
                    </p>
                    <div class="gt-text gt-text-blue gt-bold">E-MAIL</div>
                    <p>
                        Для информации о сотрудничестве и коммерческих предложений:
                    </p>
                    <ul>
                        <li><a href="mailto:zakaz@gidratop.ru">zakaz@gidratop.ru</a></li>
                        <li><a href="mailto:admin@gidratop.ru">admin@gidratop.ru</a></li>
                    </ul>
                    <br>
                    <div class="gt-text gt-text-blue gt-bold">АДРЕС</div>
                    <p>
                        Наш офис находится по адресу:
                    </p>
                    <ul>
                        <li>г. Краснодар, ул. Уральская, 95</li>
                    </ul>
                </div>

                <div class="gt-right">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:map.yandex.view",
                        ".default",
                        Array(
                            "COMPONENT_TEMPLATE" => ".default",
                            "CONTROLS" => array(0=>"ZOOM",1=>"SMALLZOOM",2=>"MINIMAP",3=>"TYPECONTROL",4=>"SCALELINE",5=>"SEARCH",),
                            "INIT_MAP_TYPE" => "PUBLIC",
                            "MAP_DATA" => "a:5:{s:10:\"yandex_lat\";d:59.934265871092;s:10:\"yandex_lon\";d:30.316349517867977;s:12:\"yandex_scale\";i:16;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:30.31859333731;s:3:\"LAT\";d:59.932933754203;s:4:\"TEXT\";s:10:\"Адрес\";}}s:9:\"POLYLINES\";a:1:{i:0;a:3:{s:6:\"POINTS\";a:12:{i:0;a:2:{s:3:\"LAT\";d:59.93581742076989;s:3:\"LON\";d:30.31538608012036;}i:1;a:2:{s:3:\"LAT\";d:59.934426193634685;s:3:\"LON\";d:30.317466390444363;}i:2;a:2:{s:3:\"LAT\";d:59.933358698050746;s:3:\"LON\";d:30.31561495956618;}i:3;a:2:{s:3:\"LAT\";d:59.93323755075341;s:3:\"LON\";d:30.31511606868942;}i:4;a:2:{s:3:\"LAT\";d:59.932793340198145;s:3:\"LON\";d:30.315797349779203;}i:5;a:2:{s:3:\"LAT\";d:59.93291987350974;s:3:\"LON\";d:30.316194316713414;}i:6;a:2:{s:3:\"LAT\";d:59.93276372594888;s:3:\"LON\";d:30.31644107994278;}i:7;a:2:{s:3:\"LAT\";d:59.93251334987216;s:3:\"LON\";d:30.31677367386062;}i:8;a:2:{s:3:\"LAT\";d:59.932577963234785;s:3:\"LON\";d:30.31754078563888;}i:9;a:2:{s:3:\"LAT\";d:59.93270180516017;s:3:\"LON\";d:30.317605158655244;}i:10;a:2:{s:3:\"LAT\";d:59.933105634302535;s:3:\"LON\";d:30.318200609056557;}i:11;a:2:{s:3:\"LAT\";d:59.933070695211384;s:3:\"LON\";d:30.31831087472534;}}s:5:\"TITLE\";s:30:\"Маршрут от метро\";s:5:\"STYLE\";a:2:{s:11:\"strokeColor\";s:8:\"FF00007F\";s:11:\"strokeWidth\";i:3;}}}}",
                            "MAP_HEIGHT" => "550",
                            "MAP_ID" => "",
                            "MAP_WIDTH" => "100%",
                            "OPTIONS" => array(0=>"ENABLE_SCROLL_ZOOM",1=>"ENABLE_DBLCLICK_ZOOM",2=>"ENABLE_RIGHT_MAGNIFIER",3=>"ENABLE_DRAGGING",)
                        )
                    );?>

                </div>


            </div>
<?
echo '</section>';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>