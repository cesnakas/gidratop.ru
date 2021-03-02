<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
echo ' <div class="static_page">'?><?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

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
<div class="catalog-box">
	<h1 class="catalog-title"><?=GetMessage("TITLE_CATALOG");?></h1>
	 <?$APPLICATION->IncludeComponent(
	"krayt:podborki.section.list",
	"",
	Array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_TYPE_CATALOG" => "catalog",
		"I_BLOCK" => "9",
		"I_BLOCK_CATALOG" => "13",
		"SECTION_PODBORKI_OK" => array("CATALOG")
	),
$component,
Array(
	'HIDE_ICONS' => 'Y'
)
);?>
</div>
 <br><?echo "</div>"; require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>