<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
    "NAME" => GetMessage("VER_NAME"),
    "DESCRIPTION" => GetMessage("VER_DESCRIPTION"),
    "PATH" => array(
        "ID" => "krayt",
        "CHILD" => array(
            "ID" => "versions",
            "NAME" => GetMessage("VER_NAME"),
        )
    ),
    "ICON" => "/images/icon.gif",
);
