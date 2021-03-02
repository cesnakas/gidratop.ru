<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.03.2018
 * Time: 16:38
 */

$APPLICATION->IncludeComponent(
    "krayt:new_menu_catalog",
    "",
    Array(
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_TYPE_CATALOG" => "catalog",
        "I_BLOCK" => "9",
        "I_BLOCK_CATALOG" => "8",
        "SECTION_PODBORKI_OK" => array("PODBORKI", "CATALOG")
    )
); ?>