<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");
echo '<section class="gt-container">';
?>

	<div class="bx-404-container">
		<div class="bx-404_left">
            <div class="bx-404_left_subtitle">К СОЖАЛЕНИЮ, ЗАПРОШЕННАЯ ВАМИ СТРАНИЦА НЕ СУЩЕСТВУЕТ</div>
            <div class="bx-404_left_text">
                Ошибка могла произойти по нескольким причинам:
                <ul>
                    <li>Вы ввели неправильный адрес</li>
                    <li>Cтраница, на которую вы хотели зайти, устарела и была удалена</li>
                    <li>На сервере произошла ошибка. Если так, то мы уже знаем о ней и обязательно исправим</li>
                </ul>
            </div>
            <div class="bx-404_left_main">Для того чтобы найти интересующую вас информацию, воспользуйтесь строкой поиска или <a href="<?=SITE_DIR?>"> перейдите на главную страницу </a></div>
        </div>
        <div class="bx-404_right">404</div>
	</div>

<!--	<div class="col-sm-offset-2 col-sm-4">-->
<!--		<div class="bx-map-title"><i class="fa fa-leanpub"></i> Каталог</div>-->
<!--		--><?//$APPLICATION->IncludeComponent(
//			"bitrix:catalog.section.list",
//			"tree",
//			array(
//				"COMPONENT_TEMPLATE" => "tree",
//				"IBLOCK_TYPE" => "catalog",
//				"IBLOCK_ID" => "#CODE_2#",
//				"SECTION_ID" => $_REQUEST["SECTION_ID"],
//				"SECTION_CODE" => "",
//				"COUNT_ELEMENTS" => "Y",
//				"TOP_DEPTH" => "2",
//				"SECTION_FIELDS" => array(
//					0 => "",
//					1 => "",
//				),
//				"SECTION_USER_FIELDS" => array(
//					0 => "",
//					1 => "",
//				),
//				"SECTION_URL" => "",
//				"CACHE_TYPE" => "A",
//				"CACHE_TIME" => "36000000",
//				"CACHE_GROUPS" => "Y",
//				"ADD_SECTIONS_CHAIN" => "Y"
//			),
//			false
//		);
//		?>
<!--	</div>-->
<!---->
<!--	<div class="col-sm-offset-1 col-sm-4">-->
<!--		<div class="bx-map-title"><i class="fa fa-info-circle"></i> О магазине</div>-->
<!--		--><?//
//		$APPLICATION->IncludeComponent(
//			"bitrix:main.map",
//			".default",
//			array(
//				"CACHE_TYPE" => "A",
//				"CACHE_TIME" => "36000000",
//				"SET_TITLE" => "N",
//				"LEVEL" => "3",
//				"COL_NUM" => "2",
//				"SHOW_DESCRIPTION" => "Y",
//				"COMPONENT_TEMPLATE" => ".default"
//			),
//			false
//		);?>
<!--	</div>-->

<?
echo '</section>';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>