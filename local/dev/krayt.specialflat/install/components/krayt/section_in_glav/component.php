<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
Cmodule::IncludeMOdule('catalog');
Cmodule::IncludeMOdule('iblock');

use \Bitrix\Main\Data\Cache;
$cache = Cache::createInstance();

    $strid = $arParams['IBLOCK_ID'];

if ($cache->initCache($arParams['CACHE_TIME'],$strid,"/section_in_glav/".$strid)) {
    $vars = $cache->GetVars();
    $arResult = $vars;

}elseif ($cache->startDataCache()) {

    if ($arParams['DEFOLT_OPTION'] =="Y"){
        $arOrder = array("UF_SORT_GLAV"=>"ASC");
        $arFilter = array(
            "ACTIVE" => "Y",
            "UF_NA_GLAV" =>1,
            "IBLOCK_ID"=>$arParams['IBLOCK_ID']);
    }else{
        $arOrder = array("SORT"=>"ASC");
        $arFilter = array(
            "ACTIVE" => "Y",
            "DEPTH_LEVEL" =>1,
            "IBLOCK_ID"=>$arParams['IBLOCK_ID']);
    }

    $arSelect = array("ID","IBLOCK_ID","NAME","PICTURE","SECTION_PAGE_URL");

    $arResult = array();
    $db_list = CIBlockSection::GetList($arOrder, $arFilter, false,$arSelect,array("nTopCount" =>$arParams['COUNT_ELEMENT']));
    while($ar_result = $db_list->GetNext())
    {
        if (!empty($ar_result['PICTURE'])){
            $ar_result['PICTURE'] = CFile::GetPath($ar_result["PICTURE"]);

        }
        $arResult[] = $ar_result;
    }

    $cache->endDataCache($arResult);

}

$this->IncludeComponentTemplate();
