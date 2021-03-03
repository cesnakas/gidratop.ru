<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "SECTION_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("K_SECTION_ID"),
            "TYPE" => "STRING",
        ),
        "CATALOG_IBLOCK_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("K_CATALOG_IBLOCK_ID"),
            "TYPE" => "STRING",
        ),
        "PODBORCI" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("K_PODBORCI"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N"
        ),
        "PODBORKI_SECTION" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("K_PODBORKI_SECTION"),
            "TYPE" => "STRING",
        ),
        "I_BLOC_POD" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("K_I_BLOC_POD"),
            "TYPE" => "STRING",
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
    ),
);