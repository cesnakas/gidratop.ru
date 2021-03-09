<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
Cmodule::IncludeMOdule('catalog');

use \Bitrix\Main\Data\Cache;
$cache = Cache::createInstance();
if(is_array($arParams['ID_GOODS'])){
    $strid = implode("-",$arParams['ID_GOODS']);
}else{
    $strid = $arParams['ID_GOODS'];
}

if ($cache->initCache($arParams['CACHE_TIME'],$strid,"/goodsinset/".$strid)) {
    $vars = $cache->GetVars();
    $arResult = $vars;
}else {

    $offersExist = CCatalogSKU::getExistOffers($arParams['ID_GOODS']);
    if (is_array($offersExist) && array_shift($offersExist) === true) {
        $res = CCatalogSKU::getOffersList($arParams['ID_GOODS'], 0, array(), array(), array('ID'));
        $idGoods = array();
        foreach ($res[$arParams['ID_GOODS']] as $val) {
            $idGoods[] = $val['ID'];
        }
    } else {
        $idGoods = $arParams['ID_GOODS'];
    }
    $arProAndSetId = array();
    $arSetsOb = CCatalogProductSet::getList(
        array(),
        array("ITEM_ID" => $idGoods),
        false,
        false,
        array('OWNER_ID', 'ITEM_ID')
    );

    while ($set = $arSetsOb->Fetch()) {
            $arProAndSetId[] = $set['OWNER_ID'];
    }

    $arSelectFields = Array("IBLOCK_ID", "ID");
    $arFilterFirlds = array('TYPE' => CCatalogProductSet::TYPE_SET, "IBLOCK_ID"=>$arParams['IBLOCK_ID'],
        array(
            "LOGIC" => "OR",
            array("PROPERTY_DOP_TOVAR_ONE.ID" => $idGoods),
            array("PROPERTY_DOP_TOVAR_TWO.ID" => $idGoods),
            array("PROPERTY_DOP_TOVAR_THREE.ID" => $idGoods),

        ),
    );

    $spIterator = CIBlockElement::GetList(Array(), $arFilterFirlds, false, array('nTopCount'=>10), $arSelectFields);
    while ($arSP = $spIterator->GetNext()) {
        $arProAndSetId[$arSP['ID']] = $arSP['ID'];
    }

    if (!empty($arProAndSetId)) {

         $arSelect = Array("IBLOCK_ID", "ID", "PREVIEW_PICTURE", "NAME", "DETAIL_PAGE_URL","PROPERTY_COD_TOVARA");
         $spSet = CIBlockElement::GetList(Array(), array('ID' => $arProAndSetId,"IBLOCK_ID" => intval($arParams['IBLOCK_ID'])), false, false, $arSelect);
         $sets = array();
         while ($set = $spSet->GetNext()) {
             $arPrice = CCatalogProduct::GetOptimalPrice($set['ID'], 1, $user_id, $renewal);

             $set['DISCOUNT_PRICE'] = $arPrice['DISCOUNT_PRICE'];
             $set['PRICE'] = $arPrice['PRICE'];
             $db_props = CIBlockElement::GetProperty(2, $set['ID'], array("sort" => "asc"), Array("CODE" => "DOP_TOVAR_ONE"));
             if ($ar_props = $db_props->Fetch()) {
                 if ($ar_props["VALUE"] != 0) {
                     $set['ID_TOVAR'][] = $ar_props["VALUE"];
                 }
             }
             $db_props = CIBlockElement::GetProperty(2, $set['ID'], array("sort" => "asc"), Array("CODE" => "DOP_TOVAR_TWO"));
             if ($ar_props = $db_props->Fetch()) {
                 if ($ar_props["VALUE"] != 0) {
                     $set['ID_TOVAR'][] = $ar_props["VALUE"];
                 }
             }
             $db_props = CIBlockElement::GetProperty(2, $set['ID'], array("sort" => "asc"), Array("CODE" => "DOP_TOVAR_THRE"));
             if ($ar_props = $db_props->Fetch()) {
                 if ($ar_props["VALUE"] != 0) {
                     $set['ID_TOVAR'][] = $ar_props["VALUE"];
                 }
             }

             $arSets = CCatalogProductSet::getAllSetsByProduct($set["ID"], CCatalogProductSet::TYPE_SET);

             $arSetItems = array();
             foreach ($arSets as $arSet) {
                 foreach ($arSet["ITEMS"] as $arSetItem) {
                     $arSetItems[] = $arSetItem["ITEM_ID"];
                 }
             }

             if (!empty($set['ID_TOVAR'])) {
                 $set['ID_TOVAR'] = array_merge($arSetItems, $set['ID_TOVAR']);
             } else {
                 $set['ID_TOVAR'] = $arSetItems;
             }

             $arSelectTovar = Array("IBLOCK_ID", "ID", "PREVIEW_PICTURE", "NAME", "DETAIL_PAGE_URL");
             $spTovar = CIBlockElement::GetList(Array(), array('ID' => $set['ID_TOVAR'],"IBLOCK_ID" => intval($arParams['IBLOCK_ID'])), false, false, $arSelectTovar);
             while ($tovar = $spTovar->GetNext()) {
                 $arPrice = CCatalogProduct::GetOptimalPrice($tovar['ID'], 1, $user_id, $renewal);
                 $tovar['DISCOUNT_PRICE'] = $arPrice['DISCOUNT_PRICE'];
                 $tovar['PRICE'] = $arPrice['PRICE'];
                 $mxResult = CCatalogSku::GetProductInfo($tovar['ID']);
                 if (is_array($mxResult)) {
                     $id_prop = $mxResult['ID'];
                 } else {
                     $id_prop = $tovar['ID'];
                 }
                 $db_props = CIBlockElement::GetProperty(2, $id_prop, array("sort" => "asc"), Array("CODE" => "NO_CATALOG"));
                 if ($ar_props = $db_props->Fetch()) {
                     if ($ar_props["VALUE"] != 0) {
                         $tovar['NO_CATALOG'] = $ar_props["VALUE"];
                     }
                 }
                 $set['PRODUCT'][] = $tovar;
             }
             $sets[] = $set;
         }

         $arResult["SETS"] = $sets;
         $arResult['SECTION_NAME'] = $arParams['NAME'];
     }else{
         $arResult = false;
     }
    $cache->endDataCache($arResult);
}

$this->IncludeComponentTemplate();
