<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
    "NAME" => GetMessage("SEE_NAME"),
    "DESCRIPTION" => GetMessage("SEE_DESCRIPTION"),
    "PATH" => array(
        "ID" => "krayt",
        "CHILD" => array(
            "ID" => "see_also",
            "NAME" => GetMessage("SEE_NAME"),
        )
    ),
    "ICON" => "/images/icon.gif",
);
