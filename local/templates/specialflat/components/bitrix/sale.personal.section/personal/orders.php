<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
use Bitrix\Main\Localization\Loc;

if ($arParams['SHOW_ORDER_PAGE'] !== 'Y')
{
	LocalRedirect($arParams['SEF_FOLDER']);
}	

if (strlen($arParams["MAIN_CHAIN_NAME"]) > 0)
{
	$APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}

$APPLICATION->AddChainItem(Loc::getMessage("SPS_CHAIN_ORDERS"), $arResult['PATH_TO_ORDERS']);
$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.list",
	"special_flat",
	array(
		"PATH_TO_DETAIL" => $arResult["PATH_TO_ORDER_DETAIL"],
		"PATH_TO_CANCEL" => $arResult["PATH_TO_ORDER_CANCEL"],
		"PATH_TO_CATALOG" => $arParams["PATH_TO_CATALOG"],
		"PATH_TO_COPY" => $arResult["PATH_TO_ORDER_COPY"],
		"PATH_TO_BASKET" => $arParams["PATH_TO_BASKET"],
		"PATH_TO_PAYMENT" => $arParams["PATH_TO_PAYMENT"],
		"SAVE_IN_SESSION" => $arParams["SAVE_IN_SESSION"],
		"ORDERS_PER_PAGE" => $arParams["ORDERS_PER_PAGE"],
		"SET_TITLE" =>$arParams["SET_TITLE"],
		"ID" => $arResult["VARIABLES"]["ID"],
		"NAV_TEMPLATE" => $arParams["NAV_TEMPLATE"],
		"ACTIVE_DATE_FORMAT" => $arParams["ACTIVE_DATE_FORMAT"],
		"HISTORIC_STATUSES" => $arParams["ORDER_HISTORIC_STATUSES"],
		"ALLOW_INNER" => $arParams["ALLOW_INNER"],
		"ONLY_INNER_FULL" => $arParams["ONLY_INNER_FULL"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"DEFAULT_SORT" => $arParams["ORDER_DEFAULT_SORT"],
		"RESTRICT_CHANGE_PAYSYSTEM" => $arParams["ORDER_RESTRICT_CHANGE_PAYSYSTEM"],
	),
	$component
);
?>

