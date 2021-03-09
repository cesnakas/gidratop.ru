<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */
/** @global CUserTypeManager $USER_FIELD_MANAGER */
global $USER_FIELD_MANAGER;

if(!\Bitrix\Main\Loader::includeModule("iblock"))
	return;

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$rsIBlock = CIBlock::GetList(Array("sort" => "asc"), Array("TYPE" => $arCurrentValues["IBLOCK_TYPE"], "ACTIVE"=>"Y"));
while($arr=$rsIBlock->Fetch())
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];

$arProperty_UF = array();
$arUserFields = $USER_FIELD_MANAGER->GetUserFields("IBLOCK_".$arCurrentValues["IBLOCK_ID"]."_SECTION", 0, LANGUAGE_ID);

$arComponentParameters = array(
	"GROUPS" => array(),
	"PARAMETERS" => array(
		"IBLOCK_TYPE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CP_BCSL_IBLOCK_TYPE"),
			"TYPE" => "LIST",
			"VALUES" => $arIBlockType,
			"REFRESH" => "Y",
		),
		"IBLOCK_ID" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("CP_BCSL_IBLOCK_ID"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => $arIBlock,
			"REFRESH" => "Y",
		),
		"PAGE_SECTION" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("PAGE_SECTION"),
            "TYPE" => "STRING",
            "REFRESH" => "N",
        ),
        "COUNT_ELEMENT" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("COUNT_ELEMENT"),
            "TYPE" => "STRING",
            "DEFAULT" => "0",
            "REFRESH" => "N",
        ),
        "DEFOLT_OPTION" => array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("DEFOLT_OPTION"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "N",
        ),
		"CACHE_TIME"  =>  Array("DEFAULT"=>36000000),
		"CACHE_GROUPS" => array(
			"PARENT" => "CACHE_SETTINGS",
			"NAME" => GetMessage("CP_BCSL_CACHE_GROUPS"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
        "TITLE_BOX" => array(
            "PARENT" => "LIST_SETTINGS",
            'NAME' => GetMessage('TITLE_BOX'),
            "TYPE" => "STRING",
        ),
        "LOAD_IMG_JS" => array(
            "PARENT" => "LIST_SETTINGS",
            "NAME" => GetMessage("K_LOAD_IMG_JS"),
            "TYPE" => "CHECKBOX",
            "DEFAULT" => "Y",
        )
    ),
);

?>