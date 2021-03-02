<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.03.2018
 * Time: 17:00
 */

$APPLICATION->IncludeComponent(
    "bitrix:search.title",
    "search_mobile",
    array(
        "CATEGORY_0" => array("iblock_catalog"),
        "CATEGORY_0_TITLE" => "",
        "CATEGORY_0_iblock_catalog" => array("8"),
        "CHECK_DATES" => "N",
        "CONTAINER_ID" => "title-search",
        "INPUT_ID" => "title-search-input",
        "NUM_CATEGORIES" => "1",
        "ORDER" => "date",
        "PAGE" => "#SITE_DIR#search/index.php",
        "SHOW_INPUT" => "Y",
        "SHOW_OTHERS" => "N",
        "TOP_COUNT" => "5",
        "USE_LANGUAGE_GUESS" => "Y"
    ),
    false
); ?>