<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
Cmodule::IncludeMOdule('catalog');

use \Bitrix\Main\Data\Cache;
$cache = Cache::createInstance();
global $USER;
if($arParams['ID_TOVAR']):
if(is_array($arParams['ID_TOVAR'])){
    $strid = implode("-",$arParams['ID_TOVAR']);
}else{
    $strid = $arParams['ID_TOVAR'];
}

if ($cache->initCache($arParams['CACHE_TIME'],$strid,"/versions/".$strid)) {
    $vars = $cache->GetVars();
    $arResult = $vars;
}elseif ($cache->startDataCache()) {


    $user_id = $USER->GetUserGroupArray();

    $arVersion = array();
    $arNameProp = array(GetMessage("MODEL_COM"), GetMessage("PRICE_COM"));
    $arSelectFields = Array("IBLOCK_ID", "ID", "NAME", "DETAIL_PAGE_URL", "CATALOG_GROUP_1");

    $arParams['ID_TOVAR'][] = $arParams['ID_TOVAR_COMPLECT'];
    $spIterator = CIBlockElement::GetList(Array(), Array(
        "ID" => $arParams['ID_TOVAR'],
        "IBLOCK_ID" => intval($arParams['IBLOCK_ID'])
    ), false, false, $arSelectFields);

    while ($arSP = $spIterator->GetNext()) {

        $arPrice = CCatalogProduct::GetOptimalPrice($arSP['ID'], 1, $USER->GetUserGroupArray());
        $arSP = array_merge($arSP, $arPrice);

        if($arParams['ID_PROPERTY'])
        {
            $db_props = CIBlockElement::GetProperty(
                $arSP['IBLOCK_ID'],
                $arSP['ID'],
                array(),
                array(
                    "IBLOCK_ID" => intval($arParams['IBLOCK_ID'])
                    ));
            while ($ob = $db_props->GetNext()) {

                if($arParams['ID_PROPERTY'])
                    foreach ($arParams['ID_PROPERTY'] as $code) {
                        if ($ob['CODE'] == $code) {
                            $arSP['PROPERTY'][] = $ob;
                            $arNameProp[$ob['ID']] = $ob['NAME'];
                        }
                    }
            }
        }

        $arVersion[] = $arSP;
    }

    $masZero = array();
    foreach ($arVersion as $keyver => $ver){
	if($ver['PROPERTY'])
        foreach ($ver['PROPERTY'] as $keyprop => $prop) {
            if (empty($prop['VALUE'])) {
                unset($arNameProp[$prop['ID']]);
                $masZero[] = $keyprop;
            }
        }
    }


    foreach ($arVersion as $keyver => $ver){
        if($ver['PROPERTY'])
        foreach ($ver['PROPERTY'] as $keyprop => $prop) {
            foreach ($masZero as $zero){
                if ($keyprop == $zero){
                    unset($arVersion[$keyver]['PROPERTY'][$keyprop]);
                }
            }
        }
    }

    $arResult['NAME_TOP'] = $arNameProp;
    $arResult['VISION'] = $arVersion;
    $arResult['NAME'] = $arParams['NAME'];

    $cache->endDataCache($arResult);

}
endif;
$this->IncludeComponentTemplate();
