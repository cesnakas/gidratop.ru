<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "SECTION_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("SECTION_ID"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
        ),
        "SECTION_CODE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("SECTION_CODE"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
        ),
        "CATALOG_IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_IBLOCK"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",

        ),

        "CACHE_TYPE" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("CACHE_TYPE"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
        ),
        "CACHE_TIME" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("CACHE_TIME"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",

        ),
        "PODBORKI_IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_PODBORKI"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
        ),

    ),
);