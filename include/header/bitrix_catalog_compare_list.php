<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.03.2018
 * Time: 16:46
 */

$APPLICATION->IncludeComponent(
    "bitrix:catalog.compare.list",
    "san",
    array(
        "AJAX_MODE" => "Y",
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => "8",
        "POSITION_FIXED" => "N",
        "POSITION" => "top right",
        "DETAIL_URL" => "",
        "COMPARE_URL" => "compare.php",
        "NAME" => "CATALOG_COMPARE_LIST",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "N",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "COMPONENT_TEMPLATE" => "san",
        "AJAX_OPTION_ADDITIONAL" => ""
    ),
    false
); ?>