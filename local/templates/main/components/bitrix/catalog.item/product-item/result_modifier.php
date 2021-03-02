<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */
$arSection_prop = array();
if($arResult['ITEM']["~IBLOCK_SECTION_ID"] > 0) {
    $db_list = CIBlockSection::GetList(Array(SORT => "ASC"), $arFilter = Array("IBLOCK_ID" => $arResult['ITEM']["IBLOCK_ID"], "ID" => $arResult['ITEM']["~IBLOCK_SECTION_ID"]), true, Array("UF_PROP_SECTION"));
    while ($ar_prop = $db_list->GetNext()) {
        $arSection_prop = $ar_prop;
    }
}


$arResult['SECTION_PROP'] = $arSection_prop;
