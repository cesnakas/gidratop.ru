<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "ID_TOVAR" => array(
            "PARENT" => "BASE",
            "NAME" => "ID SECTION",
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
    ),
);