<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
	
if ($arParams['SHOW_ACCOUNT_PAGE'] !== 'Y')
{
	LocalRedirect($arParams['SEF_FOLDER']);
}

use Bitrix\Main\Localization\Loc;
if ($arParams['SET_TITLE'] == 'Y')
{
	$APPLICATION->SetTitle(Loc::getMessage("SPS_TITLE_ACCOUNT"));
}

if (strlen($arParams["MAIN_CHAIN_NAME"]) > 0)
{
	$APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}
$APPLICATION->AddChainItem(Loc::getMessage("SPS_CHAIN_ACCOUNT"));

if ($arParams['SHOW_ACCOUNT_COMPONENT'] !== 'N')
{
	$APPLICATION->IncludeComponent(
		"bitrix:sale.personal.account",
		"",
		Array(
			"SET_TITLE" => "N"
		),
		$component
	);
}
if ($arParams['SHOW_ACCOUNT_PAY_COMPONENT'] !== 'N' && $USER->IsAuthorized())
{
	?>
	<h3 class="sale-personal-section-account-sub-header">
		<?=Loc::getMessage("SPS_BUY_MONEY")?>
	</h3>
	<?
	$APPLICATION->IncludeComponent(
		"bitrix:sale.account.pay",
		"",
		Array(
			"COMPONENT_TEMPLATE" => "special_flat",
			"REFRESHED_COMPONENT_MODE" => "Y",
			"ELIMINATED_PAY_SYSTEMS" => $arParams['ACCOUNT_PAYMENT_ELIMINATED_PAY_SYSTEMS'],
			"PATH_TO_BASKET" => $arParams['PATH_TO_BASKET'],
			"PATH_TO_PAYMENT" => $arParams['PATH_TO_PAYMENT'],
			"PERSON_TYPE" => $arParams['ACCOUNT_PAYMENT_PERSON_TYPE'],
			"REDIRECT_TO_CURRENT_PAGE" => "N",
			"SELL_AMOUNT" => $arParams['ACCOUNT_PAYMENT_SELL_TOTAL'],
			"SELL_CURRENCY" => $arParams['ACCOUNT_PAYMENT_SELL_CURRENCY'],
			"SELL_SHOW_FIXED_VALUES" => $arParams['ACCOUNT_PAYMENT_SELL_SHOW_FIXED_VALUES'],
			"SELL_SHOW_RESULT_SUM" =>  $arParams['ACCOUNT_PAYMENT_SELL_SHOW_RESULT_SUM'],
			"SELL_TOTAL" => $arParams['ACCOUNT_PAYMENT_SELL_TOTAL'],
			"SELL_USER_INPUT" => $arParams['ACCOUNT_PAYMENT_SELL_USER_INPUT'],
			"SELL_VALUES_FROM_VAR" => "N",
			"SELL_VAR_PRICE_VALUE" => "",
			"SET_TITLE" => "N",
		),
		$component
	);
}
?>
