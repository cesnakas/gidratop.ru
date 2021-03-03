<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
    "NAME" => GetMessage("NAME"),
    "DESCRIPTION" => GetMessage("DESCRIPTION"),
    "PATH" => array(
        "ID" => "krayt",
        "CHILD" => array(
            "ID" => "brend_line",
            "NAME" =>  GetMessage("NAME"),
        )
    ),
    "ICON" => "/images/icon.gif",
);
