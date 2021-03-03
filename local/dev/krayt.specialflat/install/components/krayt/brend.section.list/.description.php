<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
    "NAME" => GetMessage("IBLOCK_NAME"),
    "DESCRIPTION" => GetMessage("IBLOCK_DESCRIPTION"),
    "ICON" => "/images/news_all.gif",
    "PATH" => array(
        "ID" => "krayt",
        "CHILD" => array(
            "ID" => "brend",
            "NAME" => GetMessage("T_IBLOCK_NEWS"),
            "SORT" => 10,
            "CHILD" => array(
                "ID" => "brend_ection_list",
            ),
        ),
    ),
);

?>