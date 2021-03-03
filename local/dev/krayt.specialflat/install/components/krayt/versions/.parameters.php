<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
    "GROUPS" => array(),
    "PARAMETERS" => array(
        "ID_TOVAR" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("ID_TOVAR"),
            "TYPE" => "STRING",
            "MULTIPLE" => "Y",
        ),
        "ID_TOVAR_COMPLECT" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("ID_TOVAR_COMPLECT"),
            "TYPE" => "STRING",
            "MULTIPLE" => "Y",
        ),
        "ID_PROPERTY" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("ID_PROPERTY"),
            "TYPE" => "STRING",
            "MULTIPLE" => "Y",
        ),
        "NAME" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("TOVAR_NAME"),
            "TYPE" => "STRING",
            "MULTIPLE" => "N",
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