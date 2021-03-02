<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.12.2017
 * Time: 15:27
 */
class MyElement
{
    function OnAfterIBlockElementAddHandler(&$arFields){
        if($arFields["ID"]>0){
            $ID_BLOCK = '#CODE_2#';
            $MIN_PRICE  = MyElement::get_offer_min_price($ID_BLOCK,$arFields['ID']);
            $MAX_PRICE  = MyElement::get_offer_max_price($ID_BLOCK,$arFields['ID']);

            CIBlockElement::SetPropertyValuesEx($arFields['ID'], $ID_BLOCK, array('MINIMUM_PRICE' => $MIN_PRICE));
            CIBlockElement::SetPropertyValuesEx($arFields['ID'], $ID_BLOCK, array('MAXIMUM_PRICE' => $MAX_PRICE));
        }

    }
    function OnBeforeIBlockElementUpdateHandler(&$arFields){
        $ID_BLOCK = '#CODE_2#';
        $MIN_PRICE  = MyElement::get_offer_min_price($ID_BLOCK,$arFields['ID']);
        $MAX_PRICE  = MyElement::get_offer_max_price($ID_BLOCK,$arFields['ID']);


        CIBlockElement::SetPropertyValuesEx($arFields['ID'], $ID_BLOCK, array('MINIMUM_PRICE' => $MIN_PRICE));
        CIBlockElement::SetPropertyValuesEx($arFields['ID'], $ID_BLOCK, array('MAXIMUM_PRICE' => $MAX_PRICE));
    }


    public function get_offer_min_price($IBLOCK_ID,$item_id){
        if(CCatalogSKU::IsExistOffers($item_id,$IBLOCK_ID)){
            $ret = 0;
            $arInfo = CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID);
            if (is_array($arInfo)) {
                $res = CIBlockElement::GetList(Array("PRICE" => "asc"),
                    array('IBLOCK_ID' => $arInfo['IBLOCK_ID'], 'ACTIVE' => 'Y', 'PROPERTY_' . $arInfo['SKU_PROPERTY_ID'] => $item_id),
                    false,
                    false,
                    array('ID', 'NAME'))->GetNext();
                if ($res) {
                    $ret = GetCatalogProductPrice($res["ID"], 1);
                    if ($ret['PRICE']) {
                        $ret = $ret['PRICE'];
                    }
                }
            }
        }else{
            $arPrice = GetCatalogProductPrice($item_id, 1);
            $ret = $arPrice['PRICE'];
        }
        return $ret;
    }

    public function get_offer_max_price($IBLOCK_ID,$item_id){
        if(CCatalogSKU::IsExistOffers($item_id,$IBLOCK_ID)){
            $ret = 0;
            $arInfo = CCatalogSKU::GetInfoByProductIBlock($IBLOCK_ID);
            if (is_array($arInfo)) {
                $res = CIBlockElement::GetList(Array("PRICE" => "desc"),
                    array('IBLOCK_ID' => $arInfo['IBLOCK_ID'], 'ACTIVE' => 'Y', 'PROPERTY_' . $arInfo['SKU_PROPERTY_ID'] => $item_id),
                    false,
                    false,
                    array('ID', 'NAME'))->GetNext();
                if ($res) {
                    $ret = GetCatalogProductPrice($res["ID"], 1);
                    if ($ret['PRICE']) {
                        $ret = $ret['PRICE'];
                    }
                }
            }
        }else{
            $arPrice = GetCatalogProductPrice($item_id, 1);
            $ret = $arPrice['PRICE'];
        }
        return $ret;
    }
}