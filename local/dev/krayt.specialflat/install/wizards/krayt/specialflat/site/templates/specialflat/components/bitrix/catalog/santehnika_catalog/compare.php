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

$this->setFrameMode(true);
?>


<div class="compare-box">

<?$APPLICATION->IncludeComponent(
    "krayt:catalog.compare.result",
    "",
    Array(
        "ACTION_VARIABLE" => "action",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "BASKET_URL" => $arParams["BASKET_URL"],
        "CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
        "DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
        "DISPLAY_ELEMENT_SELECT_BOX" => $arParams["DISPLAY_ELEMENT_SELECT_BOX"],
        "ELEMENT_SORT_FIELD_BOX" => $arParams["ELEMENT_SORT_FIELD_BOX"],
        "ELEMENT_SORT_ORDER_BOX" => $arParams["ELEMENT_SORT_ORDER_BOX"],
        "ELEMENT_SORT_FIELD_BOX2" => $arParams["ELEMENT_SORT_FIELD_BOX2"],
        "ELEMENT_SORT_ORDER_BOX2" => $arParams["ELEMENT_SORT_ORDER_BOX2"],
        "ELEMENT_SORT_FIELD" => $arParams["COMPARE_ELEMENT_SORT_FIELD"],
        "ELEMENT_SORT_ORDER" => $arParams["COMPARE_ELEMENT_SORT_ORDER"],
        "FIELD_CODE" =>$arParams["COMPARE_FIELD_CODE"],
        "HIDE_NOT_AVAILABLE" => $arParams['HIDE_NOT_AVAILABLE'],
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "NAME" => $arParams["COMPARE_NAME"],
        "OFFERS_FIELD_CODE" => $arParams["COMPARE_OFFERS_FIELD_CODE"],
        "OFFERS_PROPERTY_CODE" =>  $arParams["COMPARE_OFFERS_PROPERTY_CODE"],
        "PRICE_CODE" => $arParams["PRICE_CODE"],
        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
        "PROPERTY_CODE" => $arParams["COMPARE_PROPERTY_CODE"],
        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
        'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
    ),
    $component,
    array("HIDE_ICONS" => "Y")
);?>

</div>

<?
$APPLICATION->AddChainItem(GetMessage("TITLE_COMPARE"),"");
?>
