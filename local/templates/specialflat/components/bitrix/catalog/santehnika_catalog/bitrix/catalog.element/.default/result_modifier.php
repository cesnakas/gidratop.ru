<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */
$arResult['SET'] = array();
$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$masPropIdDop = array($arParams['DOP_ELEMENT_PROPERTY_ONE'],$arParams['DOP_ELEMENT_PROPERTY_TWO'],$arParams['DOP_ELEMENT_PROPERTY_THREE']); // The array of id properties for output
$masPropIdSku = array($arParams['DOP_SKU_PROPERTY_ONE'],$arParams['DOP_SKU_PROPERTY_TWO'],$arParams['DOP_SKU_PROPERTY_THREE']); // Array of id SKU properties
$user_id = $USER->GetUserGroupArray(); // Current user id
$site_id = SITE_ID;
$masPropIdDop = array($arParams['PROP_DOP_1'],$arParams['PROP_DOP_2'],$arParams['PROP_DOP_3']);
$masCodeProp = $arParams['OFFER_TREE_PROPS'];

/**
 * @param $arSelectDop
 * @param $arSkuProp
 * @param $id
 * @return array
 */


// Function of obtaining an element with all properties and sentences


function DopELmentSku ($arSelectDop, $arSkuProp, $id,$iblockid,$masPropIdDop,$user_id,$site_id, $masCodeProp,$dop_tugle = false){
    $spIterator = CIBlockElement::GetList(Array(),Array("ID"=>$id,"IBLOCK_SITE_ID" => $site_id),false,false,$arSelectDop);
    $arRecProducts = array();
    while($arSP = $spIterator->GetNext())
    {
        if (CCatalogSKU::GetInfoByOfferIBlock($arSP['IBLOCK_ID'])){
            $arPrice = CCatalogProduct::GetOptimalPrice($arSP['ID'], 1, $user_id, $renewal);
            $arSP['DISCOUNT_PRICE'] = $arPrice['DISCOUNT_PRICE'];
            $arSP['CATALOG_PRICE_1'] = $arPrice['PRICE']['PRICE'];
            $arSP['PROPERTY'] = array();
            $db_props = CIBlockElement::GetProperty($arSP['IBLOCK_ID'], $arSP['ID'], array(), Array());
            while ($ar_props = $db_props->GetNext()) {
                foreach ($masCodeProp as $key=>$propCode) {
                    if ($propCode == $ar_props['CODE']) {
                        $arSP['PROPERTY'][$key] = $ar_props;
                    }
                }
                if($ar_props['PROPERTY_TYPE'] == "E"){
                    $arSP['SKU_ID'] = $ar_props['VALUE'];
                }

            }

        }else {

            $arPrice = CCatalogProduct::GetOptimalPrice($arSP['ID'], 1, $user_id, $renewal);
            $arSP['DISCOUNT_PRICE'] = $arPrice['DISCOUNT_PRICE'];
            $arSP['CATALOG_PRICE_1'] = $arPrice['PRICE']['PRICE'];


            $db_props = CIBlockElement::GetProperty($iblockid, $arSP['ID'], array(), Array("ID" => $masPropIdDop));
            $arSP['PROPERTY'] = array();
            while ($ar_props = $db_props->GetNext()) {
                foreach ($masPropIdDop as $key=>$value){
                    if ($ar_props['ID'] == $value){
                        $arSP['PROPERTY'][$key] = $ar_props;
                    }
                }
            }

            $prop_dop = CIBlockElement::GetProperty($iblockid, $arSP['ID'], array(), Array("CODE" =>'RECOMMEND'));
            while ($ar_props = $prop_dop->GetNext()) {
                if (!empty($ar_props['VALUE'])) {
                    $arSP['RECOMMEND_PROP'][] = $ar_props['VALUE'];
                }
            }

            if(is_array($arSP['PROPERTY']) && count($arSP['PROPERTY']) > 1);
            {
                ksort($arSP['PROPERTY']);
            }

            foreach ($arSP['PROPERTY'] as $key => $prop) {
                if ($prop['PROPERTY_TYPE'] == "E") {
                    $res = CIBlockElement::GetByID($prop["VALUE"]);
                    if ($ar_res = $res->GetNext()) {
                        $arSP['PROPERTY'][$key]['VALUE'] = '<a href="' . $ar_res['DETAIL_PAGE_URL'] . '">' . $ar_res['NAME'] . '</a>';
                    }
                } elseif (!empty($prop['USER_TYPE_SETTINGS'])) {
                    if (CModule::IncludeModule("highloadblock")):
                        $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('TABLE_NAME' => $prop['USER_TYPE_SETTINGS']["TABLE_NAME"])));
                        $arData = $rsData->fetch();

                        $Entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);

                        $Query = new \Bitrix\Main\Entity\Query($Entity);

                        $Query->setSelect(array('UF_NAME', 'UF_FILE'));
                        $Query->setFilter(array('UF_XML_ID' => $prop["VALUE"]));
                        $Query->setOrder(array('UF_SORT' => 'ASC'));

                        $result = $Query->exec();

                        $result = new CDBResult($result);
                        $arHB = array();
                        while ($row = $result->Fetch()) {

                            $arHB['PICTURE'] = CFile::GetPath($row["UF_FILE"]);
                            $arHB['NAME'] = $row['UF_NAME'];
                        }
                        $arSP['PROPERTY'][$key]['VALUE'] = $arHB['NAME'];
                    endif;
                } elseif ($prop['PROPERTY_TYPE'] == "G") {
                    $res = CIBlockSection::GetByID($prop["VALUE"]);
                    if ($ar_res = $res->GetNext()) {
                        $arSP['PROPERTY'][$key]['VALUE'] = '<a href="' . $ar_res['SECTION_PAGE_URL'] . '">' . $ar_res['NAME'] . '</a>';
                    }
                }
            }
        }


        $arRecProducts[$arSP['ID']] = $arSP;

    }

    foreach ($arRecProducts as $keytovar => $tovar){
        if(!empty($tovar['SKU_ID'])){
            $res = CIBlockElement::GetByID($tovar['SKU_ID']);
            if($ar_res = $res->GetNext()){
                if (!isset($arRecProducts[$tovar['SKU_ID']])){
                    $prop_dop = CIBlockElement::GetProperty($ar_res['IBLOCK_ID'], $ar_res['ID'], array(), Array("CODE" =>'RECOMMEND'));
                    while ($ar_props = $prop_dop->GetNext()) {
                        if (!empty($ar_props['VALUE'])) {
                            $ar_res['RECOMMEND_PROP'][] = $ar_props['VALUE'];
                        }
                    }
                    $arRecProducts[$tovar['SKU_ID']] = $ar_res;
                }
                $arRecProducts[$tovar['SKU_ID']]['SKU'][] = $arRecProducts[$keytovar];
                unset($arRecProducts[$keytovar]);
            }
        };
    };


    foreach ($arRecProducts as $keytovar =>  $tovar) {
        if (isset($tovar['SKU'])) {
            foreach ($tovar['SKU'] as $keysku => $sku) {
                foreach ($sku["PROPERTY"] as $keyprop => $prop) {
                    if (!empty($prop['USER_TYPE_SETTINGS'])) {
                        if (CModule::IncludeModule("highloadblock")):
                            $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('TABLE_NAME' => $prop['USER_TYPE_SETTINGS']["TABLE_NAME"])));
                            $arData = $rsData->fetch();

                            $Entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);

                            $Query = new \Bitrix\Main\Entity\Query($Entity);

                            $Query->setSelect(array('UF_NAME', 'UF_FILE','UF_XML_ID'));
                            $Query->setFilter(array('UF_XML_ID' => $prop["VALUE"]));
                            $Query->setOrder(array('UF_SORT' => 'ASC'));

                            $result = $Query->exec();

                            $result = new CDBResult($result);
                            $arHB = array();
                            while ($row = $result->Fetch()) {
                                $arHB['NAME'] = $row['UF_NAME'];
                                $arHB['ID'] = $row['ID'];
                            }
                            $arRecProducts[$keytovar]['SKU'][$keysku]['PROPERTY'][$keyprop]['VALUE'] = $arHB['NAME'];
                            $arRecProducts[$keytovar]['SPISOK_SKU'][$prop['NAME']][$prop["VALUE"]] = $arHB['NAME'];
                        endif;
                    } else {
                        if (!empty($prop['VALUE_ENUM'])) {
                            $arRecProducts[$keytovar]['SPISOK_SKU'][$prop['NAME']][$prop["VALUE"]] = $prop['VALUE_ENUM'];
                            $arRecProducts[$keytovar]['SKU'][$keysku]['PROPERTY'][$keyprop]['VALUE'] = $prop['VALUE_ENUM'];
                        }
                    }
                }
            }
        }
    }


    if (empty($dop_tugle)) {

        $arRecProductsSection = array();
        $arSort = array();
        foreach ($arRecProducts as $key => $value) {
            if (!empty($value['IBLOCK_SECTION_ID'])) {
                $res = CIBlockSection::GetByID($value['IBLOCK_SECTION_ID']);
                if ($ar_res = $res->GetNext()) {
                    $name = $ar_res['NAME'];
                    $sort = $ar_res['SORT'];
                }
                $arRecProductsSection[$name][] = $value;
                $arSort[$name] = $sort;
            } else {
                $arRecProductsSection['DOP'][] = $value;
            }

        }
        asort ($arSort);
        $mas = array();
        foreach ($arSort as $keysort => $sortvalue){
            foreach ($arRecProductsSection as $section => $valsec){
                if ($keysort == $section ){
                    $mas[$section] = $arRecProductsSection[$section];
                }
            }
        }
        $arRecProductsSection = $mas;
    }else{
        $arRecProductsSection = array();
        foreach ($arRecProducts as $key => $value) {
            foreach ($dop_tugle as $key_sec => $value_Sec) {
                if (array_search($value['ID'], $value_Sec) !== false){
                    $arRecProductsSection[$key_sec][$value['ID']] = $value;
                }else{
                    if (!empty($value['SKU'])){
                        foreach ($value['SKU'] as $valsku){
                            if (array_search($valsku['ID'], $value_Sec) !== false){
                                $arRecProductsSection[$key_sec][$value['ID']] = $value;
                            }
                        }
                    }
                }
            }
        }
    }


    return $arRecProductsSection;
}


// Get the kit

switch($arResult["CATALOG_TYPE"])
{
        case CCatalogProduct::TYPE_SET:

            $arSets = CCatalogProductSet::getAllSetsByProduct($arResult["ID"], CCatalogProductSet::TYPE_SET);

            $arSetItems = array();
            foreach($arSets as $arSet)
            {
                foreach($arSet["ITEMS"] as $arSetItem)
                {
                    $arSetItems[] = $arSetItem["ITEM_ID"];
                }
            }

            $arSelectFields = Array ("IBLOCK_ID", "ID", "NAME", "PREVIEW_PICTURE" ,"DETAIL_PAGE_URL","LANG_DIR","CATALOG_GROUP_1","ACTIVE","SECTION_NAME");
            $spIterator = CIBlockElement::GetList(Array(),Array("ID"=>$arSetItems),false,false,$arSelectFields);
            $arSetProducts = array();
            while($arSP = $spIterator->GetNext())
            {
                if (CCatalogSKU::GetInfoByOfferIBlock($arSP['IBLOCK_ID'])){
                    $arPrice = CCatalogProduct::GetOptimalPrice($arSP['ID'], 1, $user_id, $renewal);
                    $arSP['DISCOUNT_PRICE'] = $arPrice['DISCOUNT_PRICE'];
                    $arSP['CATALOG_PRICE_1'] = $arPrice['PRICE']['PRICE'];

                    $db_props = CIBlockElement::GetProperty($arSP['IBLOCK_ID'], $arSP['ID'], array(), Array());
                    while ($ar_props = $db_props->GetNext()) {
                        foreach ($masCodeProp as $propCode) {
                            if ($propCode == $ar_props['CODE']) {
                                $arSP['PROPERTY'][] = $ar_props;
                            }
                        }
                    }

                    $mxResult = CCatalogSku::GetProductInfo($arSP['ID'],$arSP['IBLOCK_ID']);

                    $db_pok_props = CIBlockElement::GetProperty($arResult['IBLOCK_ID'], $mxResult['ID'], array(), Array("CODE"=>'NO_CATALOG'));
                    while($ar_props = $db_pok_props->GetNext()) {
                        $arSP['POKAZ'] = $ar_props;
                    }

                    $db_old_groups = CIBlockElement::GetElementGroups($mxResult['ID'], true,array('NAME'));
                    while($ar_group = $db_old_groups->Fetch()){
                        $arSP['SECTION_NAME'] = $ar_group['NAME'];
                    }
                    foreach ($arSP["PROPERTY"] as $keyprop =>  $prop) {
                        if (!empty($prop['USER_TYPE_SETTINGS'])) {
                            if (CModule::IncludeModule("highloadblock")):
                                $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('TABLE_NAME' => $prop['USER_TYPE_SETTINGS']["TABLE_NAME"])));
                                $arData = $rsData->fetch();

                                $Entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);

                                $Query = new \Bitrix\Main\Entity\Query($Entity);

                                $Query->setSelect(array('UF_NAME', 'UF_FILE'));
                                $Query->setFilter(array('UF_XML_ID' => $prop["VALUE"]));
                                $Query->setOrder(array('UF_SORT' => 'ASC'));

                                $result = $Query->exec();

                                $result = new CDBResult($result);
                                $arHB = array();
                                while ($row = $result->Fetch()) {
                                    $arHB['NAME'] = $row['UF_NAME'];
                                }
                                $arSP["PROPERTY"][$keyprop]['VALUE'] = $arHB['NAME'];
                            endif;
                        } else {
                            if (!empty($prop['VALUE_ENUM'])) {
                                $arSP["PROPERTY"][$keyprop]['VALUE'] = $prop['VALUE_ENUM'];
                            }
                        }
                    }



                }else{
                    $db_props = CIBlockElement::GetProperty($arResult['IBLOCK_ID'], $arSP['ID'], array(), Array("ID"=>$masPropIdDop));
                    while($ar_props = $db_props->GetNext()) {
                        $arSP['PROPERTY'][] = $ar_props;
                    }

                    $arPrice = CCatalogProduct::GetOptimalPrice($arSP['ID'], 1, $user_id, $renewal);
                    $arSP['DISCOUNT_PRICE'] = $arPrice['DISCOUNT_PRICE'];
                    $arSP['CATALOG_PRICE_1'] = $arPrice['PRICE']['PRICE'];

                    $db_pok_props = CIBlockElement::GetProperty($arResult['IBLOCK_ID'], $arSP['ID'], array(), Array("CODE"=>'NO_CATALOG'));
                    while($ar_props = $db_pok_props->GetNext()) {
                            $arSP['POKAZ'] = $ar_props;
                    }


                    if(is_array($arSP['PROPERTY']))
                    foreach ($arSP['PROPERTY'] as $key => $prop) {

                        if ($prop['PROPERTY_TYPE'] == "E") {
                            $res = CIBlockElement::GetByID($prop["VALUE"]);
                            if ($ar_res = $res->GetNext()) {
                                $arSP['PROPERTY'][$key]['VALUE'] = '<a href="' . $ar_res['DETAIL_PAGE_URL'] . '">' . $ar_res['NAME'] . '</a>';
                            }
                        } elseif (!empty($prop['USER_TYPE_SETTINGS'])) {
                            if (CModule::IncludeModule("highloadblock")):
                                $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('TABLE_NAME' => $prop['USER_TYPE_SETTINGS']["TABLE_NAME"])));
                                $arData = $rsData->fetch();

                                $Entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);

                                $Query = new \Bitrix\Main\Entity\Query($Entity);

                                $Query->setSelect(array('UF_NAME', 'UF_FILE'));
                                $Query->setFilter(array('UF_XML_ID' => $prop["VALUE"]));
                                $Query->setOrder(array('UF_SORT' => 'ASC'));

                                $result = $Query->exec();

                                $result = new CDBResult($result);
                                $arHB = array();
                                while ($row = $result->Fetch()) {

                                    $arHB['PICTURE'] = CFile::GetPath($row["UF_FILE"]);
                                    $arHB['NAME'] = $row['UF_NAME'];
                                }
                                $arSP['PROPERTY'][$key]['VALUE'] = $arHB['NAME'];
                            endif;
                        } elseif ($prop['PROPERTY_TYPE'] == "G") {
                            $res = CIBlockSection::GetByID($prop["VALUE"]);
                            if ($ar_res = $res->GetNext()) {
                                $arSP['PROPERTY'][$key]['VALUE'] = '<a href="' . $ar_res['SECTION_PAGE_URL'] . '">' . $ar_res['NAME'] . '</a>';
                            }
                        } elseif ($prop['PROPERTY_TYPE'] == "L") {
                                $arSP['PROPERTY'][$key]['VALUE'] = $prop['VALUE_ENUM'];
                        }
                    }

                }

                $arSP['CATALOG_PRICE_1'] = number_format($arSP['CATALOG_PRICE_1'], 0, '.', '');

                $db_old_groups = CIBlockElement::GetElementGroups($arSP['ID'], true,array('NAME'));
                while($ar_group = $db_old_groups->Fetch()){
                    $arSP['SECTION_NAME'] = $ar_group['NAME'];
                }

                $arSetProducts[] = $arSP;
            }

            $arResult['SET'] = $arSetProducts;


}

// Get the Recommended Products

if (!empty($arResult['PROPERTIES']['RECOMMEND']['VALUE'])) {
    $masDop = Array("IBLOCK_ID","ID","NAME","PREVIEW_PICTURE","DETAIL_PAGE_URL","LANG_DIR","CATALOG_GROUP_1","PROPERTY_RECOMMEND",'CATALOG_TYPE','CATALOG_BUND', 'SECTION_NAME');

    $masDopDop = Array("IBLOCK_ID","ID","NAME","PREVIEW_PICTURE","DETAIL_PAGE_URL","LANG_DIR","CATALOG_GROUP_1",'CATALOG_TYPE','CATALOG_BUND',);
    $masSkuProp = array("ID" => $masPropIdSku);
    $arRecomend = DopELmentSku($masDop, $masSkuProp, $arResult['PROPERTIES']['RECOMMEND']['VALUE'],$arResult['IBLOCK_ID'],$masPropIdDop,$user_id,$site_id,$masCodeProp);
    foreach ($arRecomend as $key_section => $section){
        foreach ($section as $key => $recomend) {
            if (!empty($recomend['RECOMMEND_PROP'])) {
                $arRecomend[$key_section][$key]['DOP_TOVAR'] = DopELmentSku($masDopDop, $masSkuProp, $recomend['RECOMMEND_PROP'], $arResult['IBLOCK_ID'], $masPropIdDop, $user_id, $site_id, $masCodeProp);
            }
        }
    }
    $arResult['RECOMMENDED_PRODUCTS'] = $arRecomend;


}

// We receive additional kit goods

if (!empty($arResult['PROPERTIES']['DOP_TOVAR_ONE']['VALUE']) || !empty($arResult['PROPERTIES']['DOP_TOVAR_TWO']['VALUE']) || !empty($arResult['PROPERTIES']['DOP_TOVAR_THREE']['VALUE'])) {
    if (!is_array ($arResult['PROPERTIES']['DOP_TOVAR_ONE']['VALUE'])){
        $arResult['PROPERTIES']['DOP_TOVAR_ONE']['VALUE'] = array();
    }
    if (!is_array ($arResult['PROPERTIES']['DOP_TOVAR_TWO']['VALUE'])){
        $arResult['PROPERTIES']['DOP_TOVAR_TWO']['VALUE'] = array();
    }
    if (!is_array ($arResult['PROPERTIES']['DOP_TOVAR_THREE']['VALUE'])){
        $arResult['PROPERTIES']['DOP_TOVAR_THREE']['VALUE'] = array();
    }
    $dopTovarId = array_merge($arResult['PROPERTIES']['DOP_TOVAR_ONE']['VALUE'],$arResult['PROPERTIES']['DOP_TOVAR_TWO']['VALUE'],$arResult['PROPERTIES']['DOP_TOVAR_THREE']['VALUE']);
    $masDop = Array("IBLOCK_ID", "ID", "NAME", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "LANG_DIR", "CATALOG_GROUP_1", 'CATALOG_TYPE', 'CATALOG_BUND',);
    $masSkuProp = array("ID" => $masPropIdSku);
    $masDopEl = array(
        $arResult['PROPERTIES']['NAME_COMMP_ONE']['VALUE'] =>$arResult['PROPERTIES']['DOP_TOVAR_ONE']['VALUE'],
        $arResult['PROPERTIES']['NAME_COMMP_TWO']['VALUE'] =>$arResult['PROPERTIES']['DOP_TOVAR_TWO']['VALUE'],
        $arResult['PROPERTIES']['NAME_COMMP_THREE']['VALUE'] =>$arResult['PROPERTIES']['DOP_TOVAR_THREE']['VALUE'],
        );


    $arResult['DOP_TOVAR'] = DopELmentSku($masDop, $masSkuProp, $dopTovarId,$arResult['IBLOCK_ID'],$masPropIdDop,$user_id,$site_id,$masCodeProp, $masDopEl);

    $dop = array();
    foreach ($arResult['DOP_TOVAR'] as $key=>$value) {
        $el = current($value);
        $el['SECTION_NAME'] = $key;
        $dop[] = $el;
    }
    if($arResult['SET'] && $dop)
    $arResult['SET_MIN'] = array_merge($arResult['SET'],$dop);
}else {
    $arResult['SET_MIN'] =  $arResult['SET'];
}






// We receive service

if (!empty($arResult['PROPERTIES']['SERVISE']['VALUE'])){
    $arSelectFields = Array ("IBLOCK_ID", "ID", "NAME" , "PROPERTY_SPISOK","CATALOG_GROUP_1","PROPERTY_TEXT","PROPERTY_PRICE","PREVIEW_PICTURE");
    $spIterator = CIBlockElement::GetList(Array(),Array("ID"=>$arResult['PROPERTIES']['SERVISE']['VALUE']),false,false,$arSelectFields);
    while($arSP = $spIterator->GetNext()){
        $res = CIBlockSection::GetByID($arSP["IBLOCK_SECTION_ID"]);
        if($arRes = $res->Fetch()) {
            $arSP['SECTION_NAME'] = $arRes["NAME"];
        }
        $arSP["PREVIEW_PICTURE"] = CFile::GetPath($arSP["PREVIEW_PICTURE"]);
        $arResult['PROPERTIES']['SERVISE']['VALUE'] = $arSP;
    }
}


// Get the property block of properties

$masPropFile = array();
foreach ($arParams['PROPERTY_CODE'] as $code) {
    $db_props = CIBlockElement::GetProperty($arResult['IBLOCK_ID'], $arResult['ID'], array("sort" => "asc"), Array("CODE" => $code, "PROPERTY_TYPE" =>"F"));

    if ($ar_props = $db_props->GetNext()) {
        $arFile = CFile::GetFileArray($ar_props["VALUE"]);
        if($arFile)
			//print_r($arFile);
        $ar_props["VALUE"]  = '<a class="prop_link prop_tooltip" title="'.GetMessage("OPEN_IN_IN").'" href="'.$arFile['SRC'].'" target="_blank:">'.$arFile['ORIGINAL_NAME'].'</a>';
        $masPropFile[$ar_props['CODE']] =  $ar_props;
    }

}

$allProp = array_merge($arResult['DISPLAY_PROPERTIES'],$masPropFile);

$dis_prop = CIBlockSectionPropertyLink::GetArray($arResult['IBLOCK_ID'], $SECTION_ID = 0, $bNewSection = false);

foreach ($allProp as $keyprop =>$prop){
    foreach ($dis_prop as $key => $rez_id){
        if($prop['ID'] == $key && !empty($rez_id['FILTER_HINT'])){
            $allProp[$keyprop]['DESCRIPTION_N'] = $rez_id['FILTER_HINT'];
            }
    }
}


if ($arParams['I_BLOCK_GROUP_PROP'] > 0) {
    $arGroupProp = array();
    $arFilter = array('IBLOCK_ID' => $arParams['I_BLOCK_GROUP_PROP'], 'SECTION_ACTIVE' => 'Y');
    $arSelected = Array("IBLOCK_ID", "ID", "NAME", "LANG_DIR", "PROPERTY_DESCRIPTION", "PROPERTY_DIMENSION", "IBLOCK_SECTION_ID", "PROPERTY_ID_PROP","DETAIL_TEXT");
    $obGroupProp = CIBlockSection::GetMixedList( array("sort" => "asc"), $arFilter, false, $arSelected);
    while ($GroupProp = $obGroupProp->GetNext()) {

        if ($GroupProp['TYPE'] == "S") {
            $arGroupProp[$GroupProp['ID']] = $GroupProp;
        } else {
            $arGroupProp[$GroupProp['IBLOCK_SECTION_ID']]['PROP'][] = $GroupProp;
        }
    }
    foreach ($allProp as $kp=>$prop) {
        foreach ($arGroupProp as $keyraz => $raz) {
            foreach ($raz['PROP'] as $keyprop => $prop_raz) {
                if ($prop['CODE'] == $prop_raz['PROPERTY_ID_PROP_VALUE']) {
                    $arGroupProp[$keyraz]['PROP'][$keyprop]['VALUE'] = $prop['VALUE'];
                    $arGroupProp[$keyraz]['PROP'][$keyprop]['PROPERTY_TYPE'] = $prop['PROPERTY_TYPE'];
                    $arGroupProp[$keyraz]['PROP'][$keyprop]['USER_TYPE_SETTINGS'] = $prop['USER_TYPE_SETTINGS'];
                    $arGroupProp[$keyraz]['PROP'][$keyprop]['VALUE_XML_ID'] = $prop['VALUE_XML_ID'];
                    $arGroupProp[$keyraz]['PROP'][$keyprop]['DESCRIPTION_N'] = $prop['DESCRIPTION_N'];
                    if(!empty($prop_raz['DETAIL_TEXT']))
                    {
                        $arGroupProp[$keyraz]['PROP'][$keyprop]['DESCRIPTION_N'] = $prop_raz['~DETAIL_TEXT'];
                    }
                    unset($allProp[$kp]);
                }
            }
        }
    }

    foreach ($allProp as $kp=>$prop)
    {
        $arr['NORAZDEL']['PROP'][] = $prop;
    }

    $arr['NORAZDEL']['NAME'] = GetMessage("NO_SECT_PROP");

    $arGroupProp = array_merge($arr,$arGroupProp);

    foreach ($arGroupProp as $key =>$razdel) {
        foreach ($razdel['PROP'] as $prop) {
            if (!empty($prop['VALUE'])) {
                $arGroupProp[$key]['TUGLE'] = "Y";
            }
        }
    }


    foreach ($arGroupProp as $keysection => $section){
        foreach ($section["PROP"] as $keyprop => $prop) {
            if ($prop['PROPERTY_TYPE'] == "E") {
                if (is_array($prop["VALUE"])){
                    $arSelectFields = Array ("IBLOCK_ID", "ID", "NAME" ,"DETAIL_PAGE_URL");
                    $spIterator = CIBlockElement::GetList( array("sort" => "asc"),Array("ID"=>$prop["VALUE"]),false,false,$arSelectFields);
                    //$arGroupProp[$keysection]["PROP"][$keyprop]['VALUE'] ="";
                    while($ar_res = $spIterator->GetNext()){
                        if(isset($arGroupProp[$keysection]))
                        {
                            $arGroupProp[$keysection]["PROP"][$keyprop]['VALUE'][]  = '<a class="prop_more" href="' . $ar_res['DETAIL_PAGE_URL'] . '">' . $ar_res['NAME'] . '</a>';
                        }
                    }
                }else {
                    $res = CIBlockElement::GetByID($prop["VALUE"]);
                    if ($ar_res = $res->GetNext()) {
                        $arGroupProp[$keysection]["PROP"][$keyprop]['VALUE'] = '<a class="prop_link prop_tooltip" title="'.GetMessage("PERETI_NA_COLECTION").' '. $ar_res['NAME'] .'" href="' . $ar_res['DETAIL_PAGE_URL'] . '">' . $ar_res['NAME'] . '</a>';
                    }
                }
            } elseif (!empty($prop['USER_TYPE_SETTINGS'])) {
                if (CModule::IncludeModule("highloadblock")):
                    $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('TABLE_NAME' => $prop['USER_TYPE_SETTINGS']["TABLE_NAME"])));
                    $arData = $rsData->fetch();

                    $Entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);

                    $Query = new \Bitrix\Main\Entity\Query($Entity);

                    $Query->setSelect(array('UF_NAME', 'UF_FILE','ID'));
                    $Query->setFilter(array('UF_XML_ID' => $prop["VALUE"]));
                    $Query->setOrder(array('UF_SORT' => 'ASC'));

                    $result = $Query->exec();

                    $result = new CDBResult($result);
                    $arHB = array();
                    $per_one = array();

                    while ($row = $result->Fetch()) {

                        $arHB['PICTURE'] = CFile::GetPath($row["UF_FILE"]);
                        $arHB['NAME'] = $row['UF_NAME'];
                        $arHB['ID'] = $row['ID'];
                        $per_val =$per_val.'<div class="value_item"><a href=/proizvoditeli/?strana='.$arHB['ID'].'><div class="flag" style="background-image: url(' . $arHB['PICTURE'] . ');"></div><span class="country">'.$arHB['NAME'].'</span></a></div>';
                    }
                    $arGroupProp[$keysection]["PROP"][$keyprop]['VALUE'] = $per_val;
                    unset($per_val);
                endif;
            } elseif ($prop['PROPERTY_TYPE'] == "G") {
                $res = CIBlockSection::GetByID($prop["VALUE"]);
                if ($ar_res = $res->GetNext()) {
                    $arGroupProp[$keysection]["PROP"][$keyprop]['VALUE'] = '<a class="prop_link prop_tooltip" title="'.GetMessage("PERETI_NA_BREND").' '. $ar_res['NAME'] .'" href="' . $ar_res['SECTION_PAGE_URL'] . '">' . $ar_res['NAME'] . '</a>';
                }
            }
        }
    }

    $arResult['PROPS_GROUP'] = $arGroupProp;

// We obtain properties for the top
    $aTopProp = array();
    $arTopPropCode = array($arParams['PROPERTY_TOP_ONE'],$arParams['PROPERTY_TOP_TWO'],$arParams['PROPERTY_TOP_THREE'],$arParams['PROPERTY_TOP_FOUR'],$arParams['PROPERTY_TOP_FIVE']);
    foreach ($arTopPropCode as $code) {
        $db_props = CIBlockElement::GetProperty($arParams['IBLOCK_ID'], $arResult['ID'], array("sort" => "asc"), Array("CODE" => $code));
        while ($ob = $db_props->GetNext())
        {
            $aTopProp[] = $ob;
        }
    }
    foreach ($aTopProp as $key => $prop){
        if ($prop['PROPERTY_TYPE'] == "E"){
            $res = CIBlockElement::GetByID($prop["VALUE"]);
            if($ar_res = $res->GetNext()){
                $aTopProp[$key]['VALUE'] = '<a href="'.$ar_res['DETAIL_PAGE_URL'].'" class="prop_tooltip" title="'.GetMessage("PERETI_NA_COLECTION").' '. $ar_res['NAME'] .'">'.$ar_res['NAME'].'</a>';
            }
        }elseif (!empty($prop['USER_TYPE_SETTINGS'])){

            if (CModule::IncludeModule("highloadblock")):
                $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('TABLE_NAME'=>$prop['USER_TYPE_SETTINGS']["TABLE_NAME"])));
                $arData = $rsData->fetch();

                $Entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);

                $Query = new \Bitrix\Main\Entity\Query($Entity);

                $Query->setSelect(array('UF_NAME','UF_FILE','ID'));
                $Query->setFilter(array('UF_XML_ID' => $prop["VALUE"]));
                $Query->setOrder(array('UF_SORT' => 'ASC'));

                $result = $Query->exec();

                $result = new CDBResult($result);
                $arHB = array();
                while ($row = $result->Fetch()){

                    $arHB['PICTURE'] = CFile::GetPath($row["UF_FILE"]);
                    $arHB['NAME'] = $row['UF_NAME'];
                    $arHB['ID'] = $row['ID'];
                }

                if($arHB)
                $aTopProp[$key]['VALUE'] = '<div class="value_item"><a href=/proizvoditeli/?strana='.$arHB['ID'].'><div class="flag" style="background-image: url(' . $arHB['PICTURE'] . ');"></div><span class="country">'.$arHB['NAME'].'</span></a></div>';
            endif;
        }elseif($prop['PROPERTY_TYPE'] == "G"){
            $res = CIBlockSection::GetByID($prop["VALUE"]);
            if($ar_res = $res->GetNext()){

                $aTopProp[$key]['VALUE'] = '<a class="prop_link prop_tooltip" title="'.GetMessage("PERETI_NA_BREND").' '. $ar_res['NAME'] .'" href="'.$ar_res['SECTION_PAGE_URL'].'">'.$ar_res['NAME'].'</a>';
            }
        }
    }

    $per_one = array();
    foreach ($aTopProp as $key=>$value){
        $numer = array_search($value['CODE'],$per_one);
        if($numer != false){
            $aTopProp[$numer]['VALUE'] =  $aTopProp[$numer]['VALUE']."".$value['VALUE'];
            unset($aTopProp[$key]);
        }else{
            $per_one[] = $value['CODE'];
        }
    }

    $arResult['TOP_PROP'] = $aTopProp;

    // we get data for warning

    if (!empty($arResult['PROPERTIES']['PREDUPREZHDENIE']['VALUE'])){
        if (CModule::IncludeModule("highloadblock")):
            $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter'=>array('TABLE_NAME'=>$arResult['PROPERTIES']['PREDUPREZHDENIE']['USER_TYPE_SETTINGS']["TABLE_NAME"])));
            $arData = $rsData->fetch();

            $Entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);

            $Query = new \Bitrix\Main\Entity\Query($Entity);

            $Query->setSelect(array('UF_COLOR','UF_FILE','UF_DESCRIPTION','UF_FULL_DESCRIPTION'));
            $Query->setFilter(array('UF_XML_ID' => $arResult['PROPERTIES']['PREDUPREZHDENIE']["VALUE"]));
            $Query->setOrder(array('UF_SORT' => 'ASC'));

            $result = $Query->exec();

            $result = new CDBResult($result);
            $arPredup = array();
            while ($row = $result->Fetch()){

                $row["UF_FILE"] = CFile::GetPath($row["UF_FILE"]);
                $arPredup = $row;
            }

            $rsType = CUserFieldEnum::GetList(array(), array(
                'USER_FIELD_NAME' => 'UF_COLOR'
            ));

            foreach($rsType->arResult as $arType) {
                if ($arPredup['UF_COLOR'] == $arType['ID']){
                    $arPredup['UF_COLOR'] = $arType['XML_ID'];
                    continue;
                }
            }

            $arResult['PROPERTIES']['PREDUPREZHDENIE']["VALUE"] = $arPredup;

        endif;
    }

    // Get the date for the promotion
    $data = strtotime($arResult['PROPERTIES']['SHARE_TIME']['VALUE']) -time();
    $dey = floor($data/3600/24) ;
    $hours = floor($data/3600) % 24;
    $arResult['SHARE_TIME'] = array('UNIX'=> $data, 'DEY'=>$dey,'HOURS'=>$hours);


    // We get the filled SKU properties

    $masSkuOk = array();
    foreach ($arResult['OFFERS'] as $offers){
        foreach ($offers['PROPERTIES'] as $key => $prop){
            if(!empty($prop['VALUE'])){
                $masSkuOk[$key] = $key;
            }
        }
    }

    $arResult['SKU_PROP_ID'] = $masSkuOk;



}

