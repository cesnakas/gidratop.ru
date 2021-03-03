<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if(!CModule::IncludeModule("iblock"))
	return;

$rsIBlock = CIBlock::GetList(array(), array("LID" => WIZARD_SITE_ID));
$iblockID = false; 
while($arIBlock = $rsIBlock->Fetch())
{
	$iblockID = $arIBlock["ID"]; 
	$iblock = new CIBlock;
	$iblock->Update($iblockID, Array("XML_ID"=>$arIBlock['CODE']));
}
?>