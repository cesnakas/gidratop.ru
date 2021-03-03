<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "ID_TOVAR" => array(
            "PARENT" => "BASE",
            "NAME" =>GetMessage("ID_TOVAR"),
            "TYPE" => "STRING",
            "MULTIPLE" => "Y",
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
        "IBLOCK_CATALOG_ID" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_CATALOG_ID"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
            "REFRESH" => "Y",
        ),
    ),
);