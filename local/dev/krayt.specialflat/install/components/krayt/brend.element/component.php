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

//////////////////////////////////////////////

function sgp($url,$varname,$value){
    if(is_array($varname)){
        foreach($varname as $i=>$n){
            $v=(is_array($value))?(isset($value[$i])?$value[$i]:NULL):$value;
            $url=sgp($url,$n,$v);
        }
        return $url;
    }
    preg_match('/^([^?]+)(\?.*?)?(#.*)?$/',$url,$matches);
    $gp=(isset($matches[2]))?$matches[2]:'';
    if(!$gp)return $url;
    $pattern="/([?&])$varname=.*?(?=&|#|\z)/";
    if(preg_match($pattern,$gp)){
        $substitution=($value!=='')?"\${1}$varname=".preg_quote($value):'';
        $newgp=preg_replace($pattern,$substitution,$gp);
        $newgp=preg_replace('/^&/','?',$newgp);
    }
    else{
        $s=($gp)?'&':'?';
        $newgp=$gp.$s.$varname.'='.$value;
    }
    $anchor=(isset($matches[3]))?$matches[3]:'';
    $newurl=$matches[1].$newgp.$anchor;
    $newurl=rtrim($newurl,'&');
    $newurl=str_replace('&&','&',$newurl);
    $newurl=str_replace('?&','?',$newurl);
    return $newurl;
}

////////////////////////////////////////////////////



if ($cache->initCache($arParams['CACHE_TIME'],"/brend.element/".$arParams['ELEMENT_CODE'])) {

    $vars = $cache->GetVars();
    $arResult = $vars;

}elseif ($cache->startDataCache()) {



    $arSelect = Array("ID", "NAME", "IBLOCK_ID","DETAIL_PAGE_URL", "SECTION_ID ");
    $arFilter = Array("IBLOCK_ID"=>$arParams["I_BLOCK"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "CODE"=> $arParams['ELEMENT_CODE']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNext())
    {

        $ipropValues = new Iblock\InheritedProperty\ElementValues($ob['IBLOCK_ID'], $ob['ID']);
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
        $collection = $ob;
    }

    $arBrend = array();
    $arSelectr = Array("IBLOCK_ID", "ID", "NAME", "PICTURE","DESCRIPTION","SECTION_PAGE_URL");
    $arFilter = array("ID"=>$collection['IBLOCK_SECTION_ID']);
    $spIterator = CIBlockSection::GetList(Array(),$arFilter, false,$arSelectr,false);
    while ($arSP = $spIterator->GetNext()) {
        $arBrend = $arSP;
    }

    $arProduct = array();
    $arSelect = Array("ID", "NAME", "IBLOCK_ID","DETAIL_PAGE_URL","IBLOCK_SECTION_ID");
    $arFilter = Array("IBLOCK_ID"=>$arParams["I_BLOCK_CATALOG"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_COLLECTION"=> $collection['ID']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNext())
    {
        $arProduct[$ob['IBLOCK_SECTION_ID']][] = $ob;
    }

    $arSection = array();
    foreach ($arProduct as $key => $value ) {
        $res = CIBlockSection::GetByID($key);
        if ($ar_res = $res->GetNext()) {
            $arSection[$ar_res['ID']] = $ar_res;
            $arSection[$ar_res['ID']]['PRODUCT'] = $arProduct[$key];
        }
    }
    unset($arProduct);

    $dopCollection = array();
    $arSelect = Array("ID", "NAME", "IBLOCK_ID","DETAIL_PAGE_URL", "SECTION_ID");
    $arFilter = Array("IBLOCK_ID"=>$arParams["I_BLOCK"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "SECTION_ID"=> $collection['IBLOCK_SECTION_ID']);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNext())
    {
        if ($collection['ID'] != $ob['ID']) {
            $dopCollection[] = $ob;
        }
    }


    $arResult['SECTION'] =  $arSection;
    $arResult['COLLECTION'] = $collection;
    $arResult['BREND'] = $arBrend;
    $arResult['DOP_COLLECTION'] = $dopCollection;

    $cache->endDataCache($arResult);


}

$APPLICATION->AddChainItem($arResult['BREND']['NAME'], $arResult['BREND']['SECTION_PAGE_URL']);
$APPLICATION->AddChainItem($arResult['COLLECTION']['NAME'], '');

$this->IncludeComponentTemplate();