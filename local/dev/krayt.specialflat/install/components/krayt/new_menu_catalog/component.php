<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
Cmodule::IncludeMOdule('catalog');

use \Bitrix\Main\Data\Cache;
$cache = Cache::createInstance();


if ($cache->initCache($arParams['CACHE_TIME'],$strid,"/podborki_sectin_list/".$arParams['I_BLOCK'])) {
    $vars = $cache->GetVars();
    $arResult = $vars;

}elseif ($cache->startDataCache()) {


    if(!empty($arParams['I_BLOCK']) && array_search('PODBORKI',$arParams['SECTION_PODBORKI_OK']) !== false) {

        $arFilter = array(
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $arParams['I_BLOCK'],
            'GLOBAL_ACTIVE' => 'Y',
            "<=DEPTH_LEVEL" => 2,
            //"UF_PODBORKI_TOP" => 1,
        );
        $arSelect = array('IBLOCK_ID', 'ID', 'NAME', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL', 'UF_PODBORKI_FILTER', 'UF_PODBORKI_SECTION',"UF_PODBORKI_TOP","UF_PODBORKI_LEFT","UF_TOVAR_DNJA");
        $arOrder = array('DEPTH_LEVEL' => 'ASC', 'SORT' => 'ASC');
        $rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
        $sectionLinc = array();
        $arPodborci['ROOT'] = array();
        $sectionLinc[0] = &$arPodborci['ROOT'];
        while ($arSection = $rsSections->GetNext()) {
            $sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']] = $arSection;
            $sectionLinc[$arSection['ID']] = &$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']];
        }
        unset($sectionLinc);
    }
    if(!empty($arParams['I_BLOCK_CATALOG']) && $arParams['SECTION_PODBORKI_OK'] && array_search('CATALOG',$arParams['SECTION_PODBORKI_OK']) !== false) {

        $arFilter = array(
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $arParams['I_BLOCK_CATALOG'],
            'GLOBAL_ACTIVE' => 'Y',
            "<=DEPTH_LEVEL" => 3,
        );
        $arSelect = array('IBLOCK_ID', 'ID', 'NAME', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL','UF_TOVAR_DNJA');
        $arOrder = array('DEPTH_LEVEL' => 'ASC', 'SORT' => 'ASC');
        $rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
        $sectionLinc = array();
        $arCatalog['ROOT'] = array();
        $sectionLinc[0] = &$arCatalog['ROOT'];
        while ($arSection = $rsSections->GetNext()) {
            $sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']] = $arSection;
            $sectionLinc[$arSection['ID']] = &$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']];
        }
        unset($sectionLinc);

    }

    $arCatalog = $arCatalog['ROOT']['CHILD'];
    $arPodborci = $arPodborci['ROOT']['CHILD'];
    $arResult = array();


   if(!empty($arParams['I_BLOCK_CATALOG']) && $arParams['SECTION_PODBORKI_OK'] && array_search('CATALOG',$arParams['SECTION_PODBORKI_OK']) ){

       if($arCatalog)
       foreach ($arCatalog as $keyCatalog => $valCatalog){
            foreach ($arPodborci as $keyPodborci => $valPodborci){
                if ($valCatalog['ID'] == $valPodborci['UF_PODBORKI_SECTION']){
                    if($valPodborci['UF_PODBORKI_TOP'] == 1) {
                        $valCatalog['CHILD'][] = $valPodborci;
                    }
                    if($valPodborci['UF_PODBORKI_LEFT'] == 1) {
                        $valCatalog['PODBORKI'][] = $valPodborci;
                    }
                }
            }
            if(!empty($valCatalog['CHILD'])) {
                foreach ($valCatalog['CHILD'] as $keyChild => $valChild){
                    foreach ($arPodborci as $keyPodborciChild => $valPodborciChild){
                        if ($valChild['ID'] == $valPodborciChild['UF_PODBORKI_SECTION']){
                            if($valPodborciChild['UF_PODBORKI_TOP'] == 1) {
                                $valCatalog['CHILD'][$keyChild]['CHILD'][] = $valPodborciChild;
                            }
                            if($valPodborciChild['UF_PODBORKI_LEFT'] == 1) {
                                $valCatalog['CHILD'][$keyChild]['PODBORKI'][] = $valPodborciChild;
                            }
                        }
                    }
                }
            }
            if(!empty($valCatalog['UF_TOVAR_DNJA'])) {
                $arSelectTovar = Array ("IBLOCK_ID", "ID", "NAME", "PREVIEW_PICTURE" ,"DETAIL_PAGE_URL","PROPERTY_MINIMUM_PRICE");
                $spIterator = CIBlockElement::GetList(Array(),Array("ID"=>$valCatalog['UF_TOVAR_DNJA'],"IBLOCK_ID"=>$arParams['I_BLOCK_CATALOG']),false,false,$arSelectTovar);
                while($arSP = $spIterator->GetNext()){
                    if(!empty($arSP['PREVIEW_PICTURE'])) {
                        $arSP['PREVIEW_PICTURE'] = CFile::GetPath($arSP["PREVIEW_PICTURE"]);
                    }else{
                        $arSP['PREVIEW_PICTURE'] =$templateFolder."images/no_photo.png";
                    }

                    $valCatalog['TOVAR'] = $arSP;
                }

            }

            $arResult[] = $valCatalog;
        }
    } elseif(!empty($arParams['I_BLOCK']) && $arParams['SECTION_PODBORKI_OK'] && array_search('PODBORKI',$arParams['SECTION_PODBORKI_OK']) !== false) {
        foreach ($arPodborci as $kry =>$value){
            if(!empty($value['UF_TOVAR_DNJA'])) {
                $arSelectTovar = Array ("IBLOCK_ID", "ID", "NAME", "PREVIEW_PICTURE" ,"DETAIL_PAGE_URL","MINIMUM_PRICE");
                $spIterator = CIBlockElement::GetList(Array(),Array("ID"=>$value['UF_TOVAR_DNJA'],"IBLOCK_ID"=>$arParams['I_BLOCK_CATALOG']),false,false,$arSelectTovar);
                while($arSP = $spIterator->GetNext()){
                    if(!empty($arSP['PREVIEW_PICTURE'])) {
                        $arSP['PREVIEW_PICTURE'] = CFile::GetPath($arSP["PREVIEW_PICTURE"]);
                    }else{
                        $arSP['PREVIEW_PICTURE'] =$templateFolder."images/no_photo.png";
                    }
                    $arPodborci[$kry]['TOVAR'] = $arSP;
                }

            }
        }
        $arResult = $arPodborci;
    }


  $cache->endDataCache($arResult);

}


$this->IncludeComponentTemplate();
