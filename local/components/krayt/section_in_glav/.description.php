<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("IBLOCK_SECTIONS_TOP_2_TEMPLATE_NAME"),
	"DESCRIPTION" => GetMessage("IBLOCK_SECTIONS_TOP_2_TEMPLATE_DESCRIPTION"),
	"ICON" => "/images/sections_top_count.gif",
	"CACHE_PATH" => "Y",
	"SORT" => 20,
	"PATH" => array(
		"ID" => "krayt",
		"CHILD" => array(
			"ID" => "section_na_glav",
			"NAME" => GetMessage("T_IBLOCK_DESC_CATALOG"),
			"SORT" => 30,
			"CHILD" => array(
				"ID" => "section_na_glav",
			),
		),
	),
);

?>