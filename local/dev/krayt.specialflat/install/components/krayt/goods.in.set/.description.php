<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
    "NAME" => GetMessage("GOODS_NAME"),
    "DESCRIPTION" => GetMessage("GOODS_DESCRIPTION"),
    "PATH" => array(
        "ID" => "krayt",
        "CHILD" => array(
            "ID" => "goodsinset",
            "NAME" => GetMessage("GOODS_NAME"),
        )
    ),
    "ICON" => "/images/icon.gif",
);
