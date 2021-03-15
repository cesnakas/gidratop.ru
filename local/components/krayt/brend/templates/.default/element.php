<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

?>
<?$APPLICATION->IncludeComponent("krayt:brend.element", "", Array(
	"CACHE_TIME" => $arParams["CACHE_TIME"],	// Время кеширования (сек.)
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],	// Тип кеширования
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],	// Тип инфоблока
		"I_BLOCK" => $arParams["I_BLOCK"],	// Инфоблок
		"IBLOCK_TYPE_CATALOG" => $arParams["IBLOCK_TYPE_CATALOG"],
		"I_BLOCK_CATALOG" => $arParams["I_BLOCK_CATALOG"],
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],	// Код раздела
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],	// ID раздела
		"ELEMENT_CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"],
		"ELEMENT_ID" => $arResult["VARIABLES"]["ELEMENT_ID"],	// ID секции
		"PROP_1" => $arParams["PROP_1"],
		"PROP_2" => $arParams["PROP_2"],
		"PROP_3" => $arParams["PROP_3"],
		"PROP_4" => $arParams["PROP_4"],
		"PROP_5" => $arParams["PROP_5"],
		"PROP_ARTICUL" => $arParams["PROP_ARTICUL"],
		"DISCOUNT_PERCENT_POSITION" => $arParams["DISCOUNT_PERCENT_POSITION"],
		"SHOW_DISCOUNT_PERCENT" => $arParams["SHOW_DISCOUNT_PERCENT"],
		"LABEL_PROP" => $arParams["LABEL_PROP"],
		"PRICE_CODE" => $arParams["PRICE_CODE"]
	),
	false
);?>