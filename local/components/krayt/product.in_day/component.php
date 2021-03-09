<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
Cmodule::IncludeMOdule('catalog');

use \Bitrix\Main\Data\Cache;
$cache = Cache::createInstance();
$strid = '12345';


$arResult['ID_TOVAR'] = null;

//проверка существоавния товара дня у раздела.
$arFilter = array(
    'ACTIVE' => 'Y',
    'IBLOCK_ID' => $arParams['CATALOG_IBLOCK_ID'],
    'ID' => $arParams['SECTION_ID'],
    //'!UF_TOVAR_DNJA' => false
);
$arSelect = array('IBLOCK_ID','ID','NAME',"UF_TOVAR_DNJA");
$arOrder = array('DEPTH_LEVEL' => 'ASC', 'SORT' => 'ASC');
$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect)->Fetch();

if($rsSections)
{
    if($rsSections['UF_TOVAR_DNJA'])
    {
        $arResult['ID_TOVAR'] = $rsSections['UF_TOVAR_DNJA'];

    }
    //проверка существует или такая подборка
    $arFilterP = array(
        'ACTIVE' => 'Y',
        'IBLOCK_ID' => $arParams['PODBORKI_IBLOCK_ID'],
        'CODE' => $arParams['SECTION_CODE_P'],
        '!UF_TOVAR_DNJA' => false,
        'UF_PODBORKI_RAZDEL' => $rsSections['ID']
);
    $arSelectP = array('IBLOCK_ID','ID','NAME',"UF_TOVAR_DNJA");
    $rsPodbor = CIBlockSection::GetList($arOrder, $arFilterP, false, $arSelectP)->Fetch();

    if($rsPodbor)
    {
        $arResult['ID_TOVAR'] = $rsPodbor['UF_TOVAR_DNJA'];
    }
}

if($arResult['ID_TOVAR'])
{
    $product = \Bitrix\Iblock\ElementTable::getList([
        'select' => array('ID'),
        'filter' => array('ID' => $arResult['ID_TOVAR'], "IBLOCK_ID" => $arParams["IBLOCK_ID"])
    ])->fetch();

    if(!$product)
    {
        $arResult['ID_TOVAR'] = false;
    }
}
$this->IncludeComponentTemplate();
