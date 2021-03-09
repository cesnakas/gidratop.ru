<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("CMDESKTOP_DESC_NAME"),
	"DESCRIPTION" => GetMessage("CMDESKTOP_DESC_DESCRIPTION"),
	"ICON" => "/images/comp.gif",
	"SORT" => 210,
	"PATH" => array(
		"ID" => "krayt",
		"CHILD" => array(
			"ID" => "brend",
			"NAME" => GetMessage("T_IBLOCK_DESC_NEWS"),
			"SORT" => 10,
			"CHILD" => array(
				"ID" => "brend_cmpx",
			),
		),
	),
);
?>