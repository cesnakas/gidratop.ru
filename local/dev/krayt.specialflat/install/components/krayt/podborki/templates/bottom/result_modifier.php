<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}

$arPod = array();
if($arResult['PODBORKI'])
foreach ($arResult['PODBORKI'] as $key=>$value){
    if(empty($value['UF_LEFT_GROUP'])){$value['UF_LEFT_GROUP'] = 7;}
    $arPod[$value['UF_LEFT_GROUP']] [] = $value;
}

ksort($arPod);

$arPodTwo = array();
if($arResult['ELEMENT'])
foreach ($arResult['ELEMENT'] as $key=>$value){
    if(empty($value['UF_LEFT_GROUP'])){$value['UF_LEFT_GROUP'] = 7;}
        $arPodTwo[$value['UF_LEFT_GROUP']] [] = $value;
}

ksort($arPodTwo);

$arResult['PODBORKI_NEW'] = $arPod;
$arResult['PODBORKI_NEW_TWO'] = $arPodTwo;

