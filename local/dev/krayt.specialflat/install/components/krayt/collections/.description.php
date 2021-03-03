<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
    "NAME" => GetMessage("COLLECTION_NAME"),
    "DESCRIPTION" => GetMessage("COLLECTION_DESCRIPTION"),
    "PATH" => array(
        "ID" => "krayt",
        "CHILD" => array(
            "ID" => "collections",
            "NAME" => GetMessage("COLLECTION_NAME")
        )
    ),
    "ICON" => "/images/icon.gif",
);
