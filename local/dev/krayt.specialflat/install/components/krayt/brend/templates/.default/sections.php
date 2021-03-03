<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

?>

<?$APPLICATION->IncludeComponent(
    "krayt:brend.section.list",
    "",
    Array(
        "CACHE_TIME" => $arParams['CACHE_TIME'],
        "CACHE_TYPE" => $arParams['CACHE_TYPE'],
        "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
        "I_BLOCK" => $arParams['I_BLOCK'],
        "PAGER_SHOW_ALWAYS_TIP" => $arParams['PAGER_SHOW_ALWAYS_TIP'],
        "ELEMENT_COL" => $arParams['ELEMENT_COL'],
        "COMPONENT_TEMPLATE" => $arParams['COMPONENT_TEMPLATE'],
    ),
    $component
);?>