<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}

if($_REQUEST['action_del'] == "DELETE_COMPARE"){
    unset($_SESSION["CATALOG_COMPARE_LIST"]);
}


$defaultParams = array(
	'POSITION_FIXED' => 'Y',
	'POSITION' => 'top left'
);

$arParams = array_merge($defaultParams, $arParams);
unset($defaultParams);
if ($arParams['POSITION_FIXED'] != 'N')
	$arParams['POSITION_FIXED'] = 'Y';

$arParams['POSITION'] = trim($arParams['POSITION']);
$arParams['POSITION'] = explode(' ', $arParams['POSITION']);
if (empty($arParams['POSITION']) || count($arParams['POSITION']) != 2){
	$arParams['POSITION'] = array('top', 'left');}
if ($arParams['POSITION'][0] != 'bottom'){
	$arParams['POSITION'][0] = 'top';}
if ($arParams['POSITION'][1] != 'right'){
	$arParams['POSITION'][1] = 'left';}

foreach ($arResult as $key=>$value) {
    $res = CIBlockElement::GetByID($value['ID']);
    if ($ar_res = $res->GetNext()) {
        if (!empty($ar_res['DETAIL_PICTURE'])) {
            $arResult[$key]['PICTURE'] =  CFile::GetPath($ar_res["DETAIL_PICTURE"]);
        }
    }
}