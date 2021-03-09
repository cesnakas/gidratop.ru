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

$arSelPod = array("PODBORKI"=>GetMessage("IZ_PODBOROC"),"CATALOG"=> GetMessage("IZ_CATALOGA"));

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
        "PAGER_SHOW_ALWAYS_TIP" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("PAGER_SHOW_ALWAYS_TIP"),
            "TYPE" => "CHECKBOX",
            "MULTIPLE" => "N",
            "REFRESH" => "N",
        ),
        "ELEMENT_COL" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("ELEMENT_COL"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "REFRESH" => "Y",
        ),
        "SECTION_PODBORKI_OK" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("SECTION_PODBORKI_OK"),
            "TYPE" => "LIST",
            'MULTIPLE' => 'Y',
            "VALUES" =>  $arSelPod,
        ),
    ),
);


