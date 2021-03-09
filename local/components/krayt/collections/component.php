<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
Cmodule::IncludeMOdule('catalog');

use \Bitrix\Main\Data\Cache;
$cache = Cache::createInstance();

 if(is_array($arParams['ID_TOVAR'])){
     $strid = implode("-",$arParams['ID_TOVAR']);
 }else{
     $strid = $arParams['ID_TOVAR'];
 }

if ($cache->initCache($arParams['CACHE_TIME'],$strid,"/collections/".$strid)) {
    $vars = $cache->GetVars();
    $arResult = $vars;

}elseif ($cache->startDataCache()) {

    $user_id = $USER->GetUserGroupArray();

    $arColection = array();
    $arSelectFields = Array("IBLOCK_ID", "ID", "NAME", "DETAIL_PAGE_URL");
    $spIterator = CIBlockElement::GetList(Array(), Array("ID" => $arParams['ID_TOVAR']), false, false, $arSelectFields);
    while ($arSP = $spIterator->GetNext()) {
        $arColection[] = $arSP;
    }

    $arTovar = array();
    $arSelectFields = Array("IBLOCK_ID", "ID", "NAME", "DETAIL_PAGE_URL","PREVIEW_PICTURE");
    $spIterator = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => $arParams['IBLOCK_ID'], "PROPERTY_COLLECTION" =>$arParams['ID_TOVAR']), false, false, $arSelectFields);
    while ($arSP = $spIterator->GetNext()) {
        if ($arSP['ID'] != $arParams['ID_PRODUCT']) {
            $arPrice = CCatalogProduct::GetOptimalPrice($arSP['ID'], 1, $user_id, $renewal);
            $arSP['DISCOUNT_PRICE'] = $arPrice['DISCOUNT_PRICE'];
            $arSP['CATALOG_PRICE'] = $arPrice['PRICE']['PRICE'];
            $arTovar[] = $arSP;
            $arResult['TOVAR_IDS'][] = $arSP["ID"];
        }
    }

    $arResult['COLECTION'] = $arColection;
    $arResult['TOVAR'] = $arTovar;

    $cache->endDataCache($arResult);

}

$this->IncludeComponentTemplate();
