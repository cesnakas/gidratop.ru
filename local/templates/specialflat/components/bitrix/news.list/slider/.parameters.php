<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"LOAD_IMG_JS" => array(
		"NAME" => GetMessage("K_LOAD_IMG_JS"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),

	"INTERVAL_COUNT" => array(
			"PARENT" => "BASE",
			"NAME" => "Интервал пролистывания, мс",
			"TYPE" => "STRING",
			"DEFAULT" => "1000",
		)
);


