<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 * @var array $PRODUCT
 */
if(CModule::IncludeModule('krayt.specialflat') && $arResult['ITEM']['PRODUCT']['TYPE'] == 2)
{
   $arResult['PRICE_COMPLECT'] = CKrayt_specialflat::getMinPriceComplect($arResult['ITEM']['PROPERTIES'],$arResult['ITEM']['PRICES']);
}
$db_list = CIBlockSection::GetList(Array(SORT=>"ASC"), $arFilter = Array("IBLOCK_ID"=>$arResult['ITEM']["IBLOCK_ID"], "ID"=>$arResult['ITEM']["~IBLOCK_SECTION_ID"]), true,Array("UF_PROP_SECTION"));
$arSection_prop = array();
while($ar_prop = $db_list->GetNext()){
    $arSection_prop =$ar_prop;
}

$arPropCode = array($arParams['PROP_1'],$arParams['PROP_2'],$arParams['PROP_3'],$arParams['PROP_4'],$arParams['PROP_5']);

$arPropCar = array();

//�������� �������
if($arParams['PROP_ARTICUL'] && $arResult['ITEM']['PROPERTIES'][$arParams['PROP_ARTICUL']])
{
    $arResult['ITEM']["ARTICULE_CODE"] = CKrayt_specialflat::getArticul($arResult['ITEM']['PROPERTIES'][$arParams['PROP_ARTICUL']]);
}

foreach ($arPropCode as $code){

    if(isset($arResult['ITEM']['PROPERTIES'][$code]))
    {
        $ar_props = $arResult['ITEM']['PROPERTIES'][$code];

		//print_r($ar_props['PROPERTY_TYPE']);
        if ($ar_props['PROPERTY_TYPE'] == "E") {

			//echo 'test';
            if (is_array($prop["VALUE"])) {
                $arSelectFields = Array("IBLOCK_ID", "ID", "NAME", "DETAIL_PAGE_URL");
                $spIterator = CIBlockElement::GetList(Array(), Array("ID" => $prop["VALUE"]), false, false, $arSelectFields);
                $arGroupProp[$keysection]["PROP"][$keyprop]['VALUE'] = "";
                while ($ar_res = $spIterator->GetNext()) {
                    $ar_props['VALUE'] = '<a href="' . $ar_res['DETAIL_PAGE_URL'] . '">' . $ar_res['NAME'] . '</a>';
                } echo 'test1';
            } else {
				//echo 'test2';
                $res = CIBlockElement::GetByID($ar_props["VALUE"]);
				//print_r($ar_props["VALUE"]);
                if ($ar_res = $res->GetNext()) {
                    $ar_props['VALUE'] = '<a href="' . $ar_res['DETAIL_PAGE_URL'] . '">' . $ar_res['NAME'] . '</a>';
					//echo 'test2';
                }
            }
        } elseif (!empty($ar_props['USER_TYPE_SETTINGS']) && !empty($ar_props["VALUE"])) {
            if (CModule::IncludeModule("highloadblock")):
                $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('TABLE_NAME' => $ar_props['USER_TYPE_SETTINGS']["TABLE_NAME"])));
                $arData = $rsData->fetch();

                $Entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arData);

                $Query = new \Bitrix\Main\Entity\Query($Entity);

                $Query->setSelect(array('UF_NAME', 'UF_FILE','ID'));
                $Query->setFilter(array('UF_XML_ID' => $ar_props["VALUE"]));
                $Query->setOrder(array('UF_SORT' => 'ASC'));

                $result = $Query->exec();

                $result = new CDBResult($result);
                $arHB = array();
                while ($row = $result->Fetch()) {

                    $arHB['PICTURE'] = CFile::GetPath($row["UF_FILE"]);
                    $arHB['NAME'] = $row['UF_NAME'];
                    $arHB['ID'] = $row['ID'];
                }
                $ar_props['VALUE'] = '<div class="value_item"><a href=/proizvoditeli/?strana='.$arHB['ID'].'><div class="flag" style="background: url(' . $arHB['PICTURE'] . '); background-size: cover;"></div><span class="country">'. $arHB['NAME'].'</span></a></div>';
            endif;
        } elseif ($ar_props['PROPERTY_TYPE'] == "G") {
            $res = CIBlockSection::GetByID($ar_props["VALUE"]);
            if ($ar_res = $res->GetNext()) {
                $ar_props['VALUE'] = '<a href="' . $ar_res['SECTION_PAGE_URL'] . '">' . $ar_res['NAME'] . '</a>';
            }
        }elseif($ar_props['PROPERTY_TYPE'] == "L"){
			 $ar_props['VALUE'] = $ar_props['VALUE_ENUM'];
        }

        if (isset($arPropCar[$ar_props['CODE']])) {
			$arPropCar[$ar_props['CODE']]['VALUE'] = t.$arPropCar[$ar_props['CODE']]['VALUE'] . "" . $ar_props['VALUE'];
        } else {
            $arPropCar[$ar_props['CODE']] = $ar_props;
        }

    }
}
//print_r($ar_props);

$arResult['PROP_CARD'] = $arPropCar;
//print_r($arResult['PROP_CARD']);
$arResult['SECTION_PROP'] = $arSection_prop;