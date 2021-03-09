<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
Cmodule::IncludeMOdule('catalog');

use \Bitrix\Main\Data\Cache;
$cache = Cache::createInstance();


function Podborci($mas){
    if (isset($mas['CHILD'])){
        echo "<div class='podborki_box'>";
        foreach ($mas['CHILD'] as $section){
            echo "<div class='li_box'><a class='link_podborki mini_podborki' href='".$section['SECTION_PAGE_URL']."'>".$section['NAME']."</a>";
            if(isset($section['CHILD'])){
                Podborci($section);
            }
            echo "</div>";
        }
        echo "</div>";
    }
}

$strid = "catalog_list";

if ($cache->initCache($arParams['CACHE_TIME'],$strid,"/podborki_sectin_list/".$arParams['I_BLOCK'])) {
    $vars = $cache->GetVars();
    $arResult = $vars;

}elseif ($cache->startDataCache()) {

    $arPodborciTree = array();

    if((!empty($arParams['I_BLOCK'])) && in_array('PODBORKI',$arParams['SECTION_PODBORKI_OK'])) {

        $arFilter = array(
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $arParams['I_BLOCK'],
            "<=DEPTH_LEVEL" => 3,
            "UF_PODBORKI_TOP" => 1
        );
        //���� � ���������� �������� ������ �� ��������� - ������� ���.
        if(!in_array('CATALOG',$arParams['SECTION_PODBORKI_OK']))
        {
            unset($arFilter['UF_PODBORKI_TOP']);
        }

        $arSelect = array('IBLOCK_ID', 'ID', 'NAME', 'DEPTH_LEVEL','DETAIL_PICTURE', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL', 'UF_PODBORKI_FILTER', 'UF_PODBORKI_SECTION');
        $arOrder = array('DEPTH_LEVEL' => 'ASC', 'SORT' => 'ASC');
        $rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
        //$sectionLinc = array();

        //$sectionLinc[0] = &$arPodborci['ROOT'];
        $arPodborkiOb = array();
        while ($arSection = $rsSections->GetNext()) {

            if($arSection['DETAIL_PICTURE'] > 0)
            {
                $arSection['DETAIL_PICTURE_SRC'] = CFile::GetPath($arSection['DETAIL_PICTURE']);
            }

            $arPodborkiOb[$arSection['ID']] = $arSection;

            if(!empty($arSection['IBLOCK_SECTION_ID']))
            {

                if($arSection['DEPTH_LEVEL'] == 2)
                {
                    $arPodborciTree[$arSection['IBLOCK_SECTION_ID']]['CHILD'][$arSection['ID']] =  $arSection;
                }

                if($arSection['DEPTH_LEVEL'] == 3)
                {
                    foreach ($arPodborciTree as &$pT) {

                        if($pT['CHILD'][$arSection['IBLOCK_SECTION_ID']])
                        {
                            $pT['CHILD'][$arSection['IBLOCK_SECTION_ID']]['CHILD'][$arSection['ID']] =  $arSection;
                        }

                    }
                    //$arPodborciTree[$arSection['IBLOCK_SECTION_ID']]['CHILD'][$arSection['ID']] =  $arSection;
                }
            }else{
                $arPodborciTree[$arSection['ID']] =  $arSection;
            }

            // $sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']] = $arSection;
           // $sectionLinc[$arSection['ID']] = &$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']];
        }
        //unset($sectionLinc);
    }

    if((!empty($arParams['I_BLOCK_CATALOG'])) && $arParams['SECTION_PODBORKI_OK'] && in_array('CATALOG',$arParams['SECTION_PODBORKI_OK'])) {


        $arFilter = array(
            'ACTIVE' => 'Y',
            'IBLOCK_ID' => $arParams['I_BLOCK_CATALOG'],
            "<=DEPTH_LEVEL" => 3,
        );
        $arSelect = array('IBLOCK_ID', 'ID', 'NAME', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID', 'SECTION_PAGE_URL',"DETAIL_PICTURE");
        $arOrder = array('DEPTH_LEVEL' => 'ASC', 'SORT' => 'ASC');
        $rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
        $sectionLinc = array();
        $arCatalog['ROOT'] = array();
        $sectionLinc[0] = &$arCatalog['ROOT'];
        while ($arSection = $rsSections->GetNext()) {

            if($arSection['DETAIL_PICTURE'] > 0)
            {
                $arSection['DETAIL_PICTURE_SRC'] = CFile::GetPath($arSection['DETAIL_PICTURE']);
            }

            $sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']] = $arSection;
            $sectionLinc[$arSection['ID']] = &$sectionLinc[intval($arSection['IBLOCK_SECTION_ID'])]['CHILD'][$arSection['ID']];
        }
        unset($sectionLinc);
    }

    $arCatalog = $arCatalog['ROOT']['CHILD'];
    $arPodborci = $arPodborciTree;
    $arResult = array();

    if((!empty($arParams['I_BLOCK_CATALOG'])) && $arParams['SECTION_PODBORKI_OK'] && in_array('CATALOG',$arParams['SECTION_PODBORKI_OK']) ){

        if($arCatalog)
        foreach ($arCatalog as $keyCatalog => &$valCatalog){
            if($arPodborci)
            foreach ($arPodborci as $keyPodborci => $valPodborci){
                if ($valCatalog['ID'] == $valPodborci['UF_PODBORKI_SECTION']){
                    $valCatalog['CHILD'][$keyPodborci] = $valPodborci;
                   // unset($arPodborci[$keyPodborci]);

                }elseif(!empty($valPodborci['CHILD'])){
                    foreach($valPodborci['CHILD'] as $keyPod => $childPod){
                        if ($valCatalog['ID'] == $childPod['UF_PODBORKI_SECTION']){
                            $valCatalog['CHILD'][$keyPod] = $childPod;
                          //  unset($arPodborci[$keyPodborci]['CHILD'][$keyPod]);
                        }
                    }
                }

            }
            /*foreach ($arPodborci as $keyPodborci => $valPodborci){
                if ($valCatalog['ID'] == $valPodborci['UF_PODBORKI_SECTION']){
                    $valCatalog['CHILD'][$valPodborci['ID']] = $valPodborci;
                }
            }*/
            if(!empty($valCatalog['CHILD'])) {
                foreach ($valCatalog['CHILD'] as $keyChild => $valChild){
                    foreach ($arPodborkiOb as $keyPodborciChild => $valPodborciChild) {
                        if ($valChild['ID'] == $valPodborciChild['UF_PODBORKI_SECTION']) {
                            $valCatalog['CHILD'][$keyChild]['CHILD'][$keyPodborciChild] = $valPodborciChild;
                        }
                    }
                    
                    if($arPodborci)
                    foreach ($arPodborci as $keyPodborciChild => $valPodborciChild){
                        if ($valChild['ID'] == $valPodborciChild['UF_PODBORKI_SECTION']){
                            $valCatalog['CHILD'][$keyChild]['CHILD'][$keyPodborciChild] = $valPodborciChild;
                        }
                        if($valPodborciChild['CHILD'])
                        foreach ($valPodborciChild['CHILD'] as $keyy => $podChildChild){
                            if ($valChild['ID'] == $podChildChild['UF_PODBORKI_SECTION']){
                                $valCatalog['CHILD'][$keyChild]['CHILD'][$keyy] = $podChildChild;
                            }
                        }
                    }
                }
            }
            $arResult[] = $valCatalog;
        }
    } elseif((!empty($arParams['I_BLOCK'])) && $arParams['SECTION_PODBORKI_OK'] && in_array('PODBORKI',$arParams['SECTION_PODBORKI_OK'])) {

        $arResult = $arPodborci;
    }


    if($arPodborci)
    {
        $arResult = array_merge($arResult,$arPodborci);
    }
    $cache->endDataCache($arResult);
}
$this->IncludeComponentTemplate();