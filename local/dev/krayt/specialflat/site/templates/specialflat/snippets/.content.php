<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}?>
<?
$SNIPPETS = Array();
$SNIPPETS['snippet0001.snp'] = Array('title' => GetMessage("GREY_BLOCK"));
$SNIPPETS['snippet0002.snp'] = Array('title' => GetMessage("BLUE_BLOCk"));
?>