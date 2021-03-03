<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
    "NAME" => GetMessage("IBLOCK_NEWS_NAME"),
    "DESCRIPTION" => GetMessage("IBLOCK_NEWS_DESCRIPTION"),
    "ICON" => "/images/news_all.gif",
    "PATH" => array(
        "ID" => "krayt",
        "CHILD" => array(
            "ID" => "podborki",
            "NAME" => GetMessage("T_IBLOCK_DESC"),
            "SORT" => 10,
            "CHILD" => array(
                "ID" => "podborki",
            ),
        ),
    ),
);

