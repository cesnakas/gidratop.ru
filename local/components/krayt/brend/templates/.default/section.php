<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
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


<?if (empty($arResult["VARIABLES"]["SECTION_CODE"])){
    $section_code = end(explode("/", $arResult["VARIABLES"]["SECTION_CODE_PATH"]));
}else{
    $section_code = $arResult["VARIABLES"]["SECTION_CODE"];
}?>

<?$APPLICATION->IncludeComponent(
    "krayt:brend.section",
    "",
    Array(
        "CACHE_TIME" => $arParams["CACHE_TIME"],
        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "I_BLOCK" => $arParams["I_BLOCK"],
        "IBLOCK_TYPE_CATALOG" => $arParams["IBLOCK_TYPE_CATALOG"],
        "I_BLOCK_CATALOG" => $arParams["I_BLOCK_CATALOG"],
        "SECTION_CODE" => $section_code,
        "SECTION_ID" => "",
        'PROP_1' => $arParams['PROP_1'],
        'PROP_2' => $arParams['PROP_2'],
        'PROP_3' => $arParams['PROP_3'],
        'PROP_4' => $arParams['PROP_4'],
        'PROP_5' => $arParams['PROP_5'],
        'PROP_5' => $arParams['PROP_5'],
        "PROP_ARTICUL" => $arParams["PROP_ARTICUL"],
        'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
        'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
        'LABEL_PROP' => $arParams['LABEL_PROP'],
        'PRICE_CODE' => $arParams['PRICE_CODE'],
    ),
    $component

);?>

