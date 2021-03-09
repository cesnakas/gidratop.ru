<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
Cmodule::IncludeMOdule('catalog');

use \Bitrix\Main\Data\Cache;
use \Bitrix\Iblock;
$cache = Cache::createInstance();

if (empty($arParams['SECTION_ID'])) {
    $strid = $arParams['SECTION_CODE'];
}else{
    $strid =$arParams['SECTION_ID'];
}
if($arParams['UF_PODBORKI_FILTER'] != 'top'){
    $arParams['UF_PODBORKI_FILTER'] = 'left';
}
$strid = $strid.$arParams['UF_PODBORKI_FILTER'];


if ($cache->initCache($arParams['CACHE_TIME'],$strid,"/podborki/".$strid)) {
    $vars = $cache->GetVars();
    $arResult = $vars;

}elseif ($cache->startDataCache()) {


    $spIterator = CIBlockSection::GetList(Array(), array('CODE' => $arParams['SECTION_CODE']), false,array('ID','IBLOCK_ID','UF_PODBORKI_RAZDEL'));
    while ($arSP = $spIterator->GetNext()) {


        $ipropValues = new Iblock\InheritedProperty\SectionValues($arSP['IBLOCK_ID'], $arSP['ID']);
        $arSP['IPROPERTY_VALUES'] = $ipropValues->getValues();

        if($arSP['IPROPERTY_VALUES'])
        {
            if($arSP['IPROPERTY_VALUES']['SECTION_META_TITLE'])
            {
                $APPLICATION->SetPageProperty('title', $arSP['IPROPERTY_VALUES']['SECTION_META_TITLE']);
            }
            if($arSP['IPROPERTY_VALUES']['SECTION_META_KEYWORDS'])
            {
                $APPLICATION->SetPageProperty('keywords', $arSP['IPROPERTY_VALUES']['SECTION_META_KEYWORDS']);
            }
            if($arSP['IPROPERTY_VALUES']['SECTION_META_DESCRIPTION'])
            {
                $APPLICATION->SetPageProperty('description', $arSP['IPROPERTY_VALUES']['SECTION_META_DESCRIPTION']);
            }
            //SECTION_META_KEYWORDS
        }

        $bid_sec[] = $arSP['IBLOCK_ID'];
        $sec_id = $arSP['ID'];
    }


    if($bid_sec && array_search($arParams['CATALOG_IBLOCK_ID'],$bid_sec) !== false){

        if ($arParams['UF_PODBORKI_FILTER'] == 'left') {

            $nav = CIBlockSection::GetNavChain($arParams['CATALOG_IBLOCK_ID'], $sec_id,array('ID','UF_PODBORKI_RAZDEL'));
            $aeIdSection = array();
            while($arSectionPath = $nav->GetNext()){
                $aeIdSection[] = $arSectionPath['ID'];
            }
        }else{
            $aeIdSection = $arParams['SECTION_ID'];
        }

        if (empty($aeIdSection)) {
            $arSectionID = array();
            $aeIdSection = CIBlockFindTools::GetSectionID(array(),$arParams['SECTION_CODE'], array('IBLOCK_ID' => $arParams['CATALOG_IBLOCK_ID']));
        }

        $arPodborki = array();
        $arSelectr = Array("IBLOCK_ID", "ID", "NAME", "SECTION_PAGE_URL","DESCRIPTION", "PICTURE", "UF_PODBORKI_SECTION", "UF_PODBORKI_TOP", "UF_PODBORKI_LEFT", "UF_PODBORKI_FILTER","SECTION_ID","UF_PODBORKI_RAZDEL","UF_DISCKRIPTION","UF_KEYWORDS","UF_LEFT_GROUP","UF_SCVOZ","UF_PODBORKI_SECTION");
        $arFilter = Array("IBLOCK_ID" => $arParams['PODBORKI_IBLOCK_ID'], "UF_PODBORKI_SECTION" => $aeIdSection,"ACTIVE"=>"Y");
        if ($arParams['UF_PODBORKI_FILTER'] == 'top'){
            $arFilter[] = array($arParams['UF_PODBORKI'] => 1);
        }
        if ($arParams['UF_PODBORKI_FILTER'] == 'left'){
            $arFilter[] = array('UF_PODBORKI_LEFT' => 1);
        }
        $spIterator = CIBlockSection::GetList(Array(), $arFilter, false,$arSelectr,false);
        while ($arSP = $spIterator->GetNext()) {

            $arPodborki['PODBORKI'][] = $arSP;
        }

        $arPodborki['TYPE'] = "tovar";
        $arResult = $arPodborki;

    }else{


        if ($arParams['UF_PODBORKI_FILTER'] == 'left') {

		
		
		
            $spIterator = CIBlockSection::GetList(Array(), array('ID' => $sec_id,'IBLOCK_ID'=>$arParams['PODBORKI_IBLOCK_ID']), false, array('ID','IBLOCK_ID','UF_PODBORKI_RAZDEL'));
            while ($arSP = $spIterator->GetNext()) {
                $sec_podborka_prevjazka = $arSP['UF_PODBORKI_RAZDEL'];
            }
			
            $nav = CIBlockSection::GetNavChain($arParams['PODBORKI_IBLOCK_ID'],$sec_id,array('ID','UF_PODBORKI_RAZDEL'));
            $aeIdSection = array();
            while($arSectionPath = $nav->GetNext()){
                $aeIdSection[] = $arSectionPath['ID'];
            }
            $spIterator = CIBlockSection::GetList(Array(),
                array('SECTION_ID' => $aeIdSection,'IBLOCK_ID'=>$arParams['PODBORKI_IBLOCK_ID']),
                false,
                array('ID','IBLOCK_ID','UF_PODBORKI_RAZDEL')
            );
            $arIdNew = array();
            while ($arSP = $spIterator->GetNext()) {
                if($arSP['UF_PODBORKI_RAZDEL'] == $sec_podborka_prevjazka){
                    $arIdNew[] = $arSP['ID'];
                }
            }
            $aeIdSection = $arIdNew;
        }else{
            $aeIdSection = $arParams['SECTION_ID'];
        }


        if (empty($aeIdSection)) {
            $arSectionID = array();
            $aeIdSection = CIBlockFindTools::GetSectionID(array(),$arParams['SECTION_CODE'], array('IBLOCK_ID' => $arParams['PODBORKI_IBLOCK_ID']));
        }

        $arPodborki = array();
        $bid_sec = array();
        $spIterator = CIBlockSection::GetList(Array(), array('CODE' => $arParams['SECTION_CODE'],'IBLOCK_ID'=>$arParams['PODBORKI_IBLOCK_ID']), false,array('ID','IBLOCK_ID','NAME','DESCRIPTION','SECTION_PAGE_URL','UF_KEYWORDS','UF_PODBORKI_SECTION','UF_PODBORKI_RAZDEL','UF_PODBORKI_FILTER'),false);
        while ($arSP = $spIterator->GetNext()) {
            $bid_sec = $arSP;
        }

        $arSelectr = Array("IBLOCK_ID", "ID", "NAME","IBLOCK_SECTION_ID", "SECTION_PAGE_URL","DESCRIPTION", "PICTURE", "UF_PODBORKI_SECTION", "UF_PODBORKI_TOP", "UF_PODBORKI_LEFT", "UF_PODBORKI_FILTER","SECTION_ID","UF_PODBORKI_RAZDEL","UF_DISCKRIPTION","UF_KEYWORDS","UF_LEFT_GROUP","UF_SCVOZ","UF_PODBORKI_SECTION");
        $arFilter = Array("IBLOCK_ID" => $arParams['PODBORKI_IBLOCK_ID'],"ACTIVE"=>"Y");
        if ($arParams['UF_PODBORKI_FILTER'] == 'top'){
            $arFilter += array('UF_PODBORKI_TOP' => 1);
            $arFilter += array("SECTION_ID" =>$aeIdSection);
        }
        if ($arParams['UF_PODBORKI_FILTER'] == 'left'){

//            $arFilter += array('UF_PODBORKI_LEFT' => 1,
//                array(
//                    "LOGIC"=> "OR",
//                    array("ID" =>$aeIdSection),
//                    array("SECTION_ID"=>$sec_id)
//                )
//            );
            $arFilter += array("SECTION_ID" =>$sec_id);
        }

        $spIterator = CIBlockSection::GetList(Array(), $arFilter, false,$arSelectr,false);
        while ($arSP = $spIterator->GetNext()) {
            if ($arParams['UF_PODBORKI_FILTER'] == 'left'){
                if($arSP['UF_SCVOZ'] == 1 || $arSP['IBLOCK_SECTION_ID'] == $sec_id ){
                    $arPodborki[$arSP['ID']] = $arSP;
                }
            }else{
                $arPodborki[] = $arSP;
            }

        }
		
        if ($arParams['UF_PODBORKI_FILTER'] == 'left'){
            $arSelectr = Array("IBLOCK_ID", "ID", "NAME","IBLOCK_SECTION_ID", "SECTION_PAGE_URL","DESCRIPTION", "PICTURE", "UF_PODBORKI_SECTION", "UF_PODBORKI_TOP", "UF_PODBORKI_LEFT", "UF_PODBORKI_FILTER","SECTION_ID","UF_PODBORKI_RAZDEL","UF_DISCKRIPTION","UF_KEYWORDS","UF_LEFT_GROUP","UF_SCVOZ","UF_PODBORKI_SECTION");
            $arFilter = Array("IBLOCK_ID" => $arParams['PODBORKI_IBLOCK_ID'],"ACTIVE"=>"Y","ID" =>$aeIdSection);
            $spIterator = CIBlockSection::GetList(Array(), $arFilter, false,$arSelectr,false);
            while ($arSP = $spIterator->GetNext()) {
               
				if($arSP['UF_SCVOZ'] == 1 || $arSP['IBLOCK_SECTION_ID'] == $sec_id ){
                    $arPodborki[$arSP['ID']] = $arSP;
                }
            }
        }

		 
        $bid_sec['TYPE'] = "podborka";

        $bid_sec['ELEMENT'] = $arPodborki;

        $arResult = $bid_sec;

        $GLOBALS['SECTION_PODBORKA_BREND'] =  $arPodborki['UF_PODBORKI_SECTION'];
    }

    $cache->endDataCache($arResult);
}


if ($arResult['TYPE'] == "podborka") {
    $GLOBALS['PODBORKI']['TUGLE'] = "Y";
    $GLOBALS['PODBORKI']['SECTION_CATALOG'] = $arResult['UF_PODBORKI_SECTION'];
    $GLOBALS['PODBORKI']['SECTION_ID'] = $arResult['UF_PODBORKI_RAZDEL'];
    $GLOBALS['PODBORKI']['PODBORKA_ID'] = $arResult['ID'];
    $getFilterOld = explode('&',str_replace('?','',$arResult['UF_PODBORKI_FILTER']));
    $getFilter = array();
    foreach ($getFilterOld as $valFilter) {
        $valMas = explode('=',$valFilter);
        $getFilter = array_merge($getFilter, array($valMas[0] => $valMas[1]));
    }
    $_GET = array_merge($_GET,$getFilter);
    $APPLICATION->SetTitle($arResult['NAME']);
    $APPLICATION->SetPageProperty("keywords", $arResult['UF_KEYWORDS']);
    $APPLICATION->SetPageProperty("description", $arResult['UF_DISCKRIPTION']);

}else{
    unset($GLOBALS['PODBORKI']);
}

$this->IncludeComponentTemplate();
