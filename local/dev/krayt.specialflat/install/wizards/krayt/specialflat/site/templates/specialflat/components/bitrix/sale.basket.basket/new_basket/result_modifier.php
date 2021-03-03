<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
use Bitrix\Main;

$defaultParams = array(
	'TEMPLATE_THEME' => 'blue'
);
$arParams = array_merge($defaultParams, $arParams);
unset($defaultParams);

$arParams['TEMPLATE_THEME'] = (string)($arParams['TEMPLATE_THEME']);
if ('' != $arParams['TEMPLATE_THEME'])
{
	$arParams['TEMPLATE_THEME'] = preg_replace('/[^a-zA-Z0-9_\-\(\)\!]/', '', $arParams['TEMPLATE_THEME']);
	if ('site' == $arParams['TEMPLATE_THEME'])
	{
		$templateId = (string)Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', SITE_ID);
		$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? 'eshop_adapt' : $templateId;
		$arParams['TEMPLATE_THEME'] = (string)Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', SITE_ID);
	}
	if ('' != $arParams['TEMPLATE_THEME'])
	{
		if (!is_file($_SERVER['DOCUMENT_ROOT'].$this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
			$arParams['TEMPLATE_THEME'] = '';
	}
}
if ('' == $arParams['TEMPLATE_THEME']) {
    $arParams['TEMPLATE_THEME'] = 'blue';
}

foreach ($arResult['GRID']['ROWS'] as $key => $value){
    if($value['TYPE'] =='1'){

        $arSets = CCatalogProductSet::getAllSetsByProduct($value["PRODUCT_ID"], CCatalogProductSet::TYPE_SET);


        $arSetItems = array();

        foreach($arSets as $arSet)
        {
            foreach($arSet["ITEMS"] as $arSetItem)
            {
                $arSetItems[] = $arSetItem["ITEM_ID"];
            }
        }

        $arSelectFields = Array ("IBLOCK_ID", "ID", "NAME","DETAIL_PAGE_URL");
        $spIterator = CIBlockElement::GetList(Array(),Array("ID"=>$arSetItems),false,false,$arSelectFields);
        $arSetProducts = array();
        while($arSP = $spIterator->GetNext())
        {
            $arSetProducts[] = $arSP;
        }

        $arResult['GRID']['ROWS'][$key]['SET'] = $arSetProducts;


        foreach ($arResult['ITEMS']['AnDelCanBuy'] as $dop_tovar){
            foreach ($dop_tovar["PROPS"] as $prop){
                if ($prop['CODE'] == 'SET_ID'){

                    if ($prop['VALUE'] == $value["ID"]){
                        $arResult['GRID']['ROWS'][$key]['SET'][] = $dop_tovar;
                        $arResult['GRID']['ROWS'][$key]['PRODUCT_DEl'][] = $dop_tovar['ID'];
                        $arResult['GRID']['ROWS'][$key]['PRODUCT_DElAY'][] = $dop_tovar['ID'];
                        $arResult['GRID']['ROWS'][$key]['PRICE'] = $arResult['GRID']['ROWS'][$key]['PRICE'] + $dop_tovar['PRICE'];
                        $arResult['GRID']['ROWS'][$key]['BASE_PRICE'] = $arResult['GRID']['ROWS'][$key]['BASE_PRICE'] + $dop_tovar['BASE_PRICE'];
                    }
                }
            }
        }

    }

    foreach ($arResult['ITEMS']['AnDelCanBuy'] as $dop_tovar){
        if ($dop_tovar['ID'] == $value['ID']) {
            foreach ($dop_tovar["PROPS"] as $prop_new) {
                if ($prop_new['CODE'] == 'SET_ID') {
                    if (!empty($prop_new['VALUE'])) {
                        $arResult['GRID']['ROWS'][$key]['HID'] = "Y";
                    }
                }
            }
        }
    }

    $db_props = CIBlockElement::GetProperty($arParams['IBLOCK_ID'], $value['PRODUCT_ID'], array("sort" => "asc"), Array("CODE"=>"SERVISE"));
    if($ar_props = $db_props->Fetch()) {
        if (!empty($ar_props['VALUE'])) {
            $arResult['GRID']['ROWS'][$key]['MONTAZH']['EST'] = $ar_props['VALUE'];
            $tugle = true;
        }
    }

    if ($tugle) {

    foreach ($value['PROPS'] as $prop){
        if ($prop['CODE'] == 'MONTAZH_YES'){
                $arResult['GRID']['ROWS'][$key]['MONTAZH']['NUZHEN'] = $prop['VALUE'];
            }
        }
    }

    $i = 0;
    foreach ($arResult["ITEMS"]["AnDelCanBuy"] as $item){
        if ($value['ID'] == $item['ID']){
            $arResult['GRID']['ROWS'][$key]['NUMER_BASKET'] = $i;
        }
        $i++;
    }

    unset($tugle);

}

//var_dump( $arResult['GRID']['ROWS']);


