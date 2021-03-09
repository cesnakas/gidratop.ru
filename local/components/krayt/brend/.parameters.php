<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\Web\Json;
use Bitrix\Iblock;
use Bitrix\Currency;

global $USER_FIELD_MANAGER;

$boolCatalog = Loader::includeModule('catalog');
CBitrixComponent::includeComponentClass('bitrix:catalog.section');
CBitrixComponent::includeComponentClass('bitrix:catalog.top');
CBitrixComponent::includeComponentClass('bitrix:catalog.element');

if (!Loader::includeModule('iblock'))
    return;
$catalogIncluded = Loader::includeModule('catalog');
$iblockExists = (!empty($arCurrentValues['I_BLOCK_CATALOG']) && (int)$arCurrentValues['I_BLOCK_CATALOG'] > 0);

$compatibleMode = !(isset($arCurrentValues['COMPATIBLE_MODE']) && $arCurrentValues['COMPATIBLE_MODE'] === 'N');

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$iblockFilter = (
!empty($arCurrentValues['IBLOCK_TYPE'])
    ? array('TYPE' => $arCurrentValues['IBLOCK_TYPE'], 'ACTIVE' => 'Y')
    : array('ACTIVE' => 'Y')
);
$rsIBlock = CIBlock::GetList(array('SORT' => 'ASC'), $iblockFilter);
while ($arr = $rsIBlock->Fetch())
    $arIBlock[$arr['ID']] = '['.$arr['ID'].'] '.$arr['NAME'];
unset($arr, $rsIBlock, $iblockFilter);

$arProperty = array();
$arProperty_N = array();
$arProperty_X = array();
$arProperty_F = array();
$arListPropList = array();


if ($iblockExists)
{

    $propertyIterator = Iblock\PropertyTable::getList(array(
        'select' => array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PROPERTY_TYPE', 'MULTIPLE', 'LINK_IBLOCK_ID', 'USER_TYPE', 'SORT'),
        'filter' => array('=IBLOCK_ID' => $arCurrentValues['I_BLOCK_CATALOG'], '=ACTIVE' => 'Y'),
        'order' => array('SORT' => 'ASC', 'NAME' => 'ASC')
    ));
    while ($property = $propertyIterator->fetch())
    {
        $propertyCode = (string)$property['CODE'];
        if ($propertyCode == '')
            $propertyCode = $property['ID'];
        $propertyName = '['.$propertyCode.'] '.$property['NAME'];

        if ($property['PROPERTY_TYPE'] != Iblock\PropertyTable::TYPE_FILE)
        {
            $arProperty[$propertyCode] = $propertyName;

            if ($property['MULTIPLE'] == 'Y')
                $arProperty_X[$propertyCode] = $propertyName;
            elseif ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_LIST)
                $arProperty_X[$propertyCode] = $propertyName;
            elseif ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_ELEMENT && (int)$property['LINK_IBLOCK_ID'] > 0)
                $arProperty_X[$propertyCode] = $propertyName;
        }
        else
        {
            if ($property['MULTIPLE'] == 'N')
                $arProperty_F[$propertyCode] = $propertyName;
        }

        if ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_NUMBER) {
            $arProperty_N[$propertyCode] = $propertyName;
        }

        if ($property['PROPERTY_TYPE'] == 'L'){
            $arListPropList[$property['CODE']] = '['.$property['ID'].']'.'['.$property['CODE'].']'.$property['NAME'];
        }
    }
    unset($propertyCode, $propertyName, $property, $propertyIterator);
}
$arProperty_LNS = $arProperty;


$arProperty_UF = array();
$arSProperty_LNS = array();
$arSProperty_F = array();
if ($iblockExists)
{
    $arUserFields = $USER_FIELD_MANAGER->GetUserFields('IBLOCK_'.$arCurrentValues['IBLOCK_ID'].'_SECTION', 0, LANGUAGE_ID);

    foreach( $arUserFields as $FIELD_NAME => $arUserField)
    {
        $arUserField['LIST_COLUMN_LABEL'] = (string)$arUserField['LIST_COLUMN_LABEL'];
        $arProperty_UF[$FIELD_NAME] = $arUserField['LIST_COLUMN_LABEL'] ? '['.$FIELD_NAME.']'.$arUserField['LIST_COLUMN_LABEL'] : $FIELD_NAME;

        if ($arUserField['USER_TYPE']['BASE_TYPE'] === 'string')
        {
            $arSProperty_LNS[$FIELD_NAME] = $arProperty_UF[$FIELD_NAME];
        }

        if ($arUserField['USER_TYPE']['BASE_TYPE'] === 'file' && $arUserField['MULTIPLE'] === 'N')
        {
            $arSProperty_F[$FIELD_NAME] = $arProperty_UF[$FIELD_NAME];
        }
    }
    unset($arUserFields);
}

$offers = false;
$filterDataValues = array();
$arProperty_Offers = array();
$arProperty_OffersWithoutFile = array();


if ($catalogIncluded && $iblockExists)
{


    $filterDataValues['iblockId'] = (int)$arCurrentValues['I_BLOCK_CATALOG'];
    $offers = CCatalogSku::GetInfoByProductIBlock($arCurrentValues['I_BLOCK_CATALOG']);

    if (!empty($offers))
    {

        $filterDataValues['offersIblockId'] = $offers['IBLOCK_ID'];
        $propertyIterator = Iblock\PropertyTable::getList(array(
            'select' => array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PROPERTY_TYPE', 'MULTIPLE', 'LINK_IBLOCK_ID', 'USER_TYPE', 'SORT'),
            'filter' => array('=IBLOCK_ID' => $offers['IBLOCK_ID'], '=ACTIVE' => 'Y', '!=ID' => $offers['SKU_PROPERTY_ID']),
            'order' => array('SORT' => 'ASC', 'NAME' => 'ASC')
        ));
        while ($property = $propertyIterator->fetch())
        {
            $propertyCode = (string)$property['CODE'];

            if ($propertyCode === '')
            {
                $propertyCode = $property['ID'];
            }

            $propertyName = '['.$propertyCode.'] '.$property['NAME'];
            $arProperty_Offers[$propertyCode] = $propertyName;

            if ($property['PROPERTY_TYPE'] != Iblock\PropertyTable::TYPE_FILE)
            {
                $arProperty_OffersWithoutFile[$propertyCode] = $propertyName;
            }
        }
        unset($propertyCode, $propertyName, $property, $propertyIterator);
    }
}

$arSort = CIBlockParameters::GetElementSortFields(
    array('SHOWS', 'SORT', 'TIMESTAMP_X', 'NAME', 'ID', 'ACTIVE_FROM', 'ACTIVE_TO'),
    array('KEY_LOWERCASE' => 'Y')
);

$arPrice = array();
if ($catalogIncluded)
{
    $arOfferSort = array_merge($arSort, CCatalogIBlockParameters::GetCatalogSortFields());
    if (isset($arSort['CATALOG_AVAILABLE']))
        unset($arSort['CATALOG_AVAILABLE']);
    $arPrice = CCatalogIBlockParameters::getPriceTypesList();
}
else
{
    $arOfferSort = $arSort;
    $arPrice = $arProperty_N;
}





$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "IBLOCK_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_TYPE"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlockType,
            "REFRESH" => "Y",
        ),
        "I_BLOCK" => array(
            "PARENT" => "BASE",
            'NAME' => GetMessage('IBLOCK_IBLOCK'),
            'TYPE' => 'LIST',
            'ADDITIONAL_VALUES' => "Y",
            'VALUES' => $arIBlock,
            "REFRESH" => "Y",
        ),

        "IBLOCK_TYPE_CATALOG" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_TYPE_CATALOG"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlockType,
            "REFRESH" => "Y",
        ),
        "I_BLOCK_CATALOG" => array(
            "PARENT" => "BASE",
            'NAME' => GetMessage('I_BLOCK_CATALOG'),
            'TYPE' => 'LIST',
            'ADDITIONAL_VALUES' => "Y",
            'VALUES' => $arIBlock,
            "REFRESH" => "Y",
        ),
        'OFFERS_PROPERTY_CODE' => array(
            'PARENT' => 'VISUAL',
            'NAME' => GetMessage('CP_BCS_OFFERS_PROPERTY_CODE'),
            'TYPE' => 'LIST',
            'MULTIPLE' => 'Y',
            'VALUES' => $arProperty_Offers,
            'ADDITIONAL_VALUES' => 'Y',
        ),
        "VARIABLE_ALIASES" => array(
            "ELEMENT_ID" => array(
                "NAME" => GetMessage("CP_BC_VARIABLE_ALIASES_ELEMENT_ID"),
            ),
            "SECTION_ID" => array(
                "NAME" => GetMessage("CP_BC_VARIABLE_ALIASES_SECTION_ID"),
            ),
        ),
        "SEF_MODE" => array(
            "sections" => array(
                "NAME" => GetMessage("SECTIONS_TOP_PAGE"),
                "DEFAULT" => "",
                "VARIABLES" => array(
                ),
            ),
            "section" => array(
                "NAME" => GetMessage("SECTION_PAGE"),
                "DEFAULT" => "#SECTION_ID#/",
                "VARIABLES" => array(
                    "SECTION_ID",
                    "SECTION_CODE",
                    "SECTION_CODE_PATH",
                ),
            ),
            "element" => array(
                "NAME" => GetMessage("DETAIL_PAGE"),
                "DEFAULT" => "#SECTION_ID#/#ELEMENT_ID#/",
                "VARIABLES" => array(
                    "ELEMENT_ID",
                    "ELEMENT_CODE",
                    "SECTION_ID",
                    "SECTION_CODE",
                    "SECTION_CODE_PATH",
                ),
            ),
        ),
        'PRICE_CODE' => array(
            'PARENT' => 'PRICES',
            'NAME' => GetMessage('IBLOCK_PRICE_CODE'),
            'TYPE' => 'LIST',
            'MULTIPLE' => 'Y',
            'VALUES' => $arPrice,
        ),
        "CACHE_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("CACHE_TYPE"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "REFRESH" => "Y",
        ),
        "CACHE_TIME" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("CACHE_TIME"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "REFRESH" => "Y",
        ),
//        "PAGER_SHOW_ALWAYS_TIP" => array(
//            "PARENT" => "BASE",
//            "NAME" => GetMessage("PAGER_SHOW_ALWAYS_TIP"),
//            "TYPE" => "CHECKBOX",
//            "MULTIPLE" => "N",
//            "REFRESH" => "N",
//        ),
        "ELEMENT_COL" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("ELEMENT_COL"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
        ),

        'PROP_1' => array(
            "PARENT" => "LIST_SETTINGS",
            'NAME' => GetMessage('PROP_1'),
            "TYPE" => "LIST",
            'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arProperty_LNS,
        ),

        'PROP_2' => array(
            "PARENT" => "LIST_SETTINGS",
            'NAME' => GetMessage('PROP_2'),
            "TYPE" => "LIST",
            'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arProperty_LNS,
        ),

        'PROP_3' => array(
            "PARENT" => "LIST_SETTINGS",
            'NAME' => GetMessage('PROP_3'),
            "TYPE" => "LIST",
            'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arProperty_LNS,
        ),

        'PROP_4' => array(
            "PARENT" => "LIST_SETTINGS",
            'NAME' => GetMessage('PROP_4'),
            "TYPE" => "LIST",
            'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arProperty_LNS,
        ),

        'PROP_5' => array(
            "PARENT" => "LIST_SETTINGS",
            'NAME' => GetMessage('PROP_5'),
            "TYPE" => "LIST",
            'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arProperty_LNS,
        ),
        'PROP_ARTICUL' => array(
            "PARENT" => "LIST_SETTINGS",
            'NAME' => GetMessage('K_PROP_ARTICUL'),
            "TYPE" => "LIST",
            "ADDITIONAL_VALUES" => "Y",
            "VALUES" => $arProperty_LNS,
        ),
        'LABEL_PROP' => array(
            'PARENT' => 'VISUAL',
            'NAME' => GetMessage('CP_BC_TPL_LABEL_PROP'),
            'TYPE' => 'LIST',
            'MULTIPLE' => 'Y',
            'ADDITIONAL_VALUES' => 'N',
            'REFRESH' => 'Y',
            'VALUES' => $arListPropList,
        ),

        'SHOW_DISCOUNT_PERCENT' => array(
            'PARENT' => 'VISUAL',
            'NAME' => GetMessage('CP_BC_TPL_SHOW_DISCOUNT_PERCENT'),
            'TYPE' => 'CHECKBOX',
            'DEFAULT' => 'N',
            'REFRESH' => 'Y',
        ),
    ),

);

$arTemplateParameters['PROP_ARTICUL'] = array(
    "PARENT" => "LIST_SETTINGS",
    'NAME' => GetMessage('K_PROP_ARTICUL'),
    "TYPE" => "LIST",
    'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
    "ADDITIONAL_VALUES" => "Y",
    "VALUES" => $aePropFor,
);