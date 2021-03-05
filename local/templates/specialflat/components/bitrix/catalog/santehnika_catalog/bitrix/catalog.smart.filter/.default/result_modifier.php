<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}

$arParams["TEMPLATE_THEME"] = "blue";

$arParams["FILTER_VIEW_MODE"] = (isset($arParams["FILTER_VIEW_MODE"]) && toUpper($arParams["FILTER_VIEW_MODE"]) == "HORIZONTAL") ? "HORIZONTAL" : "VERTICAL";
$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";

$count = 0;

foreach ($arResult["ITEMS"] as $key => $arItem) {
    if (
        empty($arItem["VALUES"])
        || isset($arItem["PRICE"])
    ) {
        continue;
    }
    if ($arItem["DISPLAY_TYPE"] == "A" && (
            $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
        )
    ){
        continue;}

    if ($arItem['CODE'] == "BREND" || $arItem['CODE'] == "COLLECTION") {
        continue;
    }

    $count++;

}

$arResult['COUNT_BLOCK'] = $count;
