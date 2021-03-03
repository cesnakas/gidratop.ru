<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
Cmodule::IncludeMOdule('catalog');

use \Bitrix\Main\Data\Cache;
$cache = Cache::createInstance();


 if(is_array($arParams['SECTION_ID'])){
     $strid = implode("-",$arParams['SECTION_ID']);
 }else{
     $strid = $arParams['SECTION_ID'];
 }


if ($cache->initCache($arParams['CACHE_TIME'],$strid,"/brend.line/".$strid)) {
    $vars = $cache->GetVars();
    $arResult = $vars;

}elseif ($cache->startDataCache()) {

    if ($arParams['PODBORCI'] == "Y"){
        $arSelectFields = Array("IBLOCK_ID", "ID", "UF_PODBORKI_RAZDEL","NAME");
        $secObzhect = CIBlockSection::GetList(Array(), Array("CODE" => $arParams['PODBORKI_SECTION'],'IBLOCK_ID'=>$arParams['I_BLOC_POD']), false, $arSelectFields);
        while ($secMAs = $secObzhect->GetNext()) {
            $section_id = $secMAs['UF_PODBORKI_RAZDEL'];
        }


    }else {
        $section_id = $arParams['SECTION_ID'];
    }

    $arElement= array();

    $arFilter = Array('GLOBAL_ACTIVE'=>'Y', 'SECTION_ID'=>$section_id);
    $db_list = CIBlockSection::GetList(Array(), $arFilter, true);
    while($ar_result = $db_list->GetNext())
    {
        $arrayID[] = $ar_result['ID'];
    }

    $arrayID[] = $section_id;

    $arSelectFields = Array("IBLOCK_ID", "ID", "PROPERTY_BREND");
    $spIterator = CIBlockElement::GetList(Array(), Array("INCLUDE_SUBSECTIONS" => "Y","SECTION_ID" =>$arrayID), false, false, $arSelectFields);


    while ($arSP = $spIterator->Fetch()) {
        if(!empty($arSP['PROPERTY_BREND_VALUE'])) {
            $arElement[$arSP['PROPERTY_BREND_VALUE']] = $arSP['PROPERTY_BREND_VALUE'];
        }
    }


    if (!empty($arElement)) {
        $arBrend = array();
        $arSelectFieldsBrend = Array("ID", "NAME", "SECTION_PAGE_URL", "UF_POP_BREND");
        $spIteratorBrend = CIBlockSection::GetList(Array(), Array("IBLOCK_ID" => 10, "ID" => $arElement), false, $arSelectFieldsBrend, false);

        while ($arSP = $spIteratorBrend->GetNext()) {
            $arBrend[] = $arSP;
        }

        $arResult = $arBrend;

    }else{
        $arResult = false;
    }

    $cache->endDataCache($arResult);

}

$this->IncludeComponentTemplate();
