<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
Cmodule::IncludeMOdule('catalog');

use \Bitrix\Main\Data\Cache;
$cache = Cache::createInstance();

 if(is_array($arParams['ID_TOVAR']) && $arParams['SECTION_ID']){
     $strid = implode("-",$arParams['SECTION_ID']);
 }else{
     $strid = $arParams['SECTION_ID'];
 }

if ($cache->initCache($arParams['CACHE_TIME'],$strid,"/see_also/".$strid)) {
    $vars = $cache->GetVars();
    $arResult = $vars;

}elseif ($cache->startDataCache()) {

    $section= array();
    $arSelect = Array("ID","NAME","SECTION_PAGE_URL","UF_SEE_ALSO");
    $spIterator = CIBlockSection::GetList(Array(), Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], "ID"=> $arParams['SECTION_ID']), false, $arSelect , false);

    while ($arSP = $spIterator->GetNext()) {
        $section = $arSP;
    }

    if (!empty($section['UF_SEE_ALSO'])) {

        $sectionAlso = array();
        $spIteratorSpisok = CIBlockSection::GetList(Array(), Array("ID" => $section['UF_SEE_ALSO'],"IBLOCK_ID"=>$arParams['CATALOG_IBLOCK_ID']), false, $arSelect, false);
        while ($arSP = $spIteratorSpisok->GetNext()) {
            $sectionAlso[] = $arSP;
        }

        $arResult = $sectionAlso;

    }else{
        $arResult = false;
    }

    $cache->endDataCache($arResult);

}

$this->IncludeComponentTemplate();
