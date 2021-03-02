<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Конверсионный интернет-магазин сантехники «Крайт: Сантехника.Special-Flat». Маркетплейс 1С-Битрикс");
$APPLICATION->SetPageProperty("keywords", "Конверсионный интернет-магазин сантехники «Крайт: Сантехника.Special-Flat». Маркетплейс 1С-Битрикс");
$APPLICATION->SetPageProperty("title", "Производители - Конверсионный интернет-магазин сантехники «Крайт: Сантехника.Special-Flat». Маркетплейс 1С-Битрикс");
$APPLICATION->SetTitle("Производители -  Конверсионный интернет-магазин сантехники «Крайт: Сантехника.Special-Flat». Маркетплейс 1С-Битрикс");
?>

<?$APPLICATION->IncludeComponent(
	"krayt:brend", 
	".default", 
	array(
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"IBLOCK_TYPE" => "catalog",
		"I_BLOCK" => "#CODE_10#",
		"SEF_FOLDER" => "#SITE_DIR#proizvoditeli/",
		"SEF_MODE" => "Y",
		"COMPONENT_TEMPLATE" => "special_flat",
		"PAGER_SHOW_ALWAYS_TIP" => "Y",
		"ELEMENT_COL" => "15",
		"IBLOCK_TYPE_CATALOG" => "catalog",
		"I_BLOCK_CATALOG" => "#CODE_2#",
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
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>