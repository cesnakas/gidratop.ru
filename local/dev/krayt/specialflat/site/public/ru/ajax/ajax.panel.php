<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
error_reporting(0);
header('Content-Type: text/html; charset='.SITE_CHARSET);

 
if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) && 
	!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
	strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
{
	if($_REQUEST['action'] == 'cpmpare'){
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.compare.list",
			"san",
			array(
				"AJAX_MODE" => "Y",
				"IBLOCK_TYPE" => "catalog",
				"IBLOCK_ID" => "#CODE_2#",
				"POSITION_FIXED" => "N",
				"POSITION" => "top right",
				"DETAIL_URL" => "",
				"COMPARE_URL" => "compare.php",
				"NAME" => "CATALOG_COMPARE_LIST",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"ACTION_VARIABLE" => "action",
				"PRODUCT_ID_VARIABLE" => "id",
				"COMPONENT_TEMPLATE" => "san",
				"AJAX_OPTION_ADDITIONAL" => ""
			),
			false
		);
	}
}