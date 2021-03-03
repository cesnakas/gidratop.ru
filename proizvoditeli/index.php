<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Интернет-магазин европейской сантехники");
$APPLICATION->SetPageProperty("keywords", "Интернет-магазин европейской сантехники");
$APPLICATION->SetPageProperty("title", "Производители - Интернет-магазин европейской сантехники");
$APPLICATION->SetTitle("Производители -  Интернет-магазин европейской сантехники");
echo '<section class="gt-container">'
?>

<?$APPLICATION->IncludeComponent(
	"krayt:brend", 
	".default", 
	array(
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"IBLOCK_TYPE" => "catalog",
		"I_BLOCK" => "7",
		"SEF_FOLDER" => "/proizvoditeli/",
		"SEF_MODE" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"PAGER_SHOW_ALWAYS_TIP" => "Y",
		"ELEMENT_COL" => "15",
		"IBLOCK_TYPE_CATALOG" => "catalog",
		"I_BLOCK_CATALOG" => "8",
		"PRICE_CODE" => array(
			0 => "BASE",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROP_1" => "BREND",
		"PROP_2" => "MATERIAL",
		"PROP_3" => "STRANA",
		"PROP_4" => "",
		"PROP_5" => "",
		"LABEL_PROP" => array(
			0 => "AKCIYA",
			1 => "NEW",
			2 => "UCENKA",
			3 => "BEST",
		),
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"DISCOUNT_PERCENT_POSITION" => "top-left",
		"PROP_ARTICUL" => "COD_TOVARA",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_CODE_PATH#/",
			"element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#",
		)
	),
	false
);?>

<?
echo '</section>';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>