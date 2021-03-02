<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();



$arServices = Array(
    "main" => Array(
        "NAME" => GetMessage("SERVICE_MAIN_SETTINGS"),
        "STAGES" => Array(
            "files.php",
            "template.php",
            // "mail.php"
        ),
    ),
    "iblock" => Array(
        "NAME" => GetMessage("SERVICE_IBLOCK_DEMO_DATA"),
        "STAGES" => Array(
            "types.php",
            "news.php",
            "service.php",
            "catalog_property.php",
            "brand.php",
            'hl.php',
            "hl_data.php",
            "catalog.php",
            "podborki.php",
            "offers.php",
            "uf_data.php",
            "complect.php",
            "catalog3.php",
            "updatexml.php"
        ),
    ),
    "sale" => Array(
        "NAME" => GetMessage("SERVICE_SALE_DEMO_DATA"),
        "STAGES" => Array(
            "locations.php",
            "step1.php",
            "step2.php",
            "step3.php"
        ),
    ),
    "advertising" => Array(
        "NAME" => GetMessage("SERVICE_ADVERTISING"),
    )
);
?>