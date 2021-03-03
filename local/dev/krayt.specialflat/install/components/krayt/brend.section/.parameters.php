<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


if (CModule::IncludeModule('iblock')) {
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
        "CACHE_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("CACHE_TYPE"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "REFRESH" => "Y",
        ),
        "SECTION_CODE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("SECTION_CODE"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "REFRESH" => "N",
        ),
        "SECTION_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("SECTION_ID"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "REFRESH" => "N",
        ),
        "CACHE_TIME" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("CACHE_TIME"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "REFRESH" => "Y",
        ),
    ),
);

