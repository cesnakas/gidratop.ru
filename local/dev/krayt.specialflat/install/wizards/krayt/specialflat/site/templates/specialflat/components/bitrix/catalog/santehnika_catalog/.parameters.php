<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/** @var array $arCurrentValues */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Web\Json;
use Bitrix\Iblock;

if (!Loader::includeModule('iblock'))
	return;

$boolCatalog = Loader::includeModule('catalog');
CBitrixComponent::includeComponentClass('bitrix:catalog.section');
CBitrixComponent::includeComponentClass('bitrix:catalog.top');
CBitrixComponent::includeComponentClass('bitrix:catalog.element');

$ext = 'jpg,jpeg,png,gif';

if (!Loader::includeModule('iblock'))
    return;
$catalogIncluded = Loader::includeModule('catalog');
$iblockExists = (!empty($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0);

$compatibleMode = !(isset($arCurrentValues['COMPATIBLE_MODE']) && $arCurrentValues['COMPATIBLE_MODE'] === 'N');

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$iblockFilter = (
!empty($arCurrentValues['IBLOCK_TYPE'])
    ? array('TYPE' => $arCurrentValues['IBLOCK_TYPE'], 'ACTIVE' => 'Y')
    : array('ACTIVE' => 'Y')
);
$rsIBlock = CIBlock::GetList(array('SORT' => 'ASC'), $iblockFilter);
while ($arr = $rsIBlock->Fetch())
    $arIBlock[$arr['ID']] = '['.$arr['ID'].'] '.$arr['NAME'];
unset($arr, $rsIBlock, $iblockFilter);

$arProperty = array();
$arProperty_N = array();
$arProperty_X = array();
$arProperty_F = array();
$arPropertyId = array();
if ($iblockExists)
{
    $propertyIterator = Iblock\PropertyTable::getList(array(
        'select' => array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PROPERTY_TYPE', 'MULTIPLE', 'LINK_IBLOCK_ID', 'USER_TYPE', 'SORT'),
        'filter' => array('=IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], '=ACTIVE' => 'Y'),
        'order' => array('SORT' => 'ASC', 'NAME' => 'ASC')
    ));
    while ($property = $propertyIterator->fetch())
    {
        $arPropertyId[$property['ID']] = '['.$property['CODE'].'] '.$property['NAME'];

        $propertyCode = (string)$property['CODE'];
        if ($propertyCode == '')
            $propertyCode = $property['ID'];
        $propertyName = '['.$propertyCode.'] '.$property['NAME'];

        if ($property['PROPERTY_TYPE'] != Iblock\PropertyTable::TYPE_FILE)
        {
            $arProperty[$propertyCode] = $propertyName;

            if ($property['MULTIPLE'] == 'Y')
                $arProperty_X[$propertyCode] = $propertyName;
            elseif ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_LIST)
                $arProperty_X[$propertyCode] = $propertyName;
            elseif ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_ELEMENT && (int)$property['LINK_IBLOCK_ID'] > 0)
                $arProperty_X[$propertyCode] = $propertyName;
        }
        else
        {
            if ($property['MULTIPLE'] == 'N')
                $arProperty_F[$propertyCode] = $propertyName;
        }

        if ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_NUMBER)
            $arProperty_N[$propertyCode] = $propertyName;
    }
    unset($propertyCode, $propertyName, $property, $propertyIterator);
}

$arProperty_LNS = $arProperty;

$arSKU = false;
$boolSKU = false;
if ($boolCatalog && (isset($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID']) > 0)
{
	$arSKU = CCatalogSKU::GetInfoByProductIBlock($arCurrentValues['IBLOCK_ID']);
	$boolSKU = !empty($arSKU) && is_array($arSKU);
}

$defaultValue = array('-' => GetMessage('CP_BC_TPL_PROP_EMPTY'));

$arThemes = array();
if (ModuleManager::isModuleInstalled('bitrix.eshop'))
{
	$arThemes['site'] = GetMessage('CPT_BC_TPL_THEME_SITE');
}

$arThemes['blue'] = GetMessage('CPT_BC_TPL_THEME_BLUE');
$arThemes['green'] = GetMessage('CPT_BC_TPL_THEME_GREEN');
$arThemes['red'] = GetMessage('CPT_BC_TPL_THEME_RED');
$arThemes['wood'] = GetMessage('CPT_BC_TPL_THEME_WOOD');
$arThemes['yellow'] = GetMessage('CPT_BC_TPL_THEME_YELLOW');
$arThemes['black'] = GetMessage('CP_BC_TPL_THEME_BLACK');

$documentRoot = Loader::getDocumentRoot();

$arViewModeList = array(
	'LIST' => GetMessage('CPT_BC_SECTIONS_VIEW_MODE_LIST'),
	'LINE' => GetMessage('CPT_BC_SECTIONS_VIEW_MODE_LINE'),
	'TEXT' => GetMessage('CPT_BC_SECTIONS_VIEW_MODE_TEXT'),
	'TILE' => GetMessage('CPT_BC_SECTIONS_VIEW_MODE_TILE')
);



$arTemplateParameters["FILTER_VIEW_MODE"] = array(
	"PARENT" => "FILTER_SETTINGS",
	"NAME" => GetMessage('CPT_BC_FILTER_VIEW_MODE'),
	"TYPE" => "LIST",
	"VALUES" => $arFilterViewModeList,
	"DEFAULT" => "VERTICAL",
	"HIDDEN" => (!isset($arCurrentValues['USE_FILTER']) || 'N' == $arCurrentValues['USE_FILTER'])
);
$arTemplateParameters["INSTANT_RELOAD"] = array(
	"PARENT" => "FILTER_SETTINGS",
	"NAME" => GetMessage("CPT_BC_INSTANT_RELOAD"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);

$arAllPropList = array();
$arListPropList = array();
$arHighloadPropList = array();
$arFilePropList = $defaultValue;

if (isset($arCurrentValues['IBLOCK_ID']) && (int)$arCurrentValues['IBLOCK_ID'] > 0)
{
	$rsProps = CIBlockProperty::GetList(
		array('SORT' => 'ASC', 'ID' => 'ASC'),
		array('IBLOCK_ID' => $arCurrentValues['IBLOCK_ID'], 'ACTIVE' => 'Y')
	);
	while ($arProp = $rsProps->Fetch())
	{
		$strPropName = '['.$arProp['ID'].']'.('' != $arProp['CODE'] ? '['.$arProp['CODE'].']' : '').' '.$arProp['NAME'];
		if ('' == $arProp['CODE'])
		{
			$arProp['CODE'] = $arProp['ID'];
		}

		$arAllPropList[$arProp['CODE']] = $strPropName;

		if ('F' == $arProp['PROPERTY_TYPE'])
		{
			$arFilePropList[$arProp['CODE']] = $strPropName;
		}

		if ('L' == $arProp['PROPERTY_TYPE'])
		{
			$arListPropList[$arProp['CODE']] = $strPropName;
		}

		if ('S' == $arProp['PROPERTY_TYPE'] && 'directory' == $arProp['USER_TYPE'] && CIBlockPriceTools::checkPropDirectory($arProp))
		{
			$arHighloadPropList[$arProp['CODE']] = $strPropName;
		}
	}

	if (!empty($arCurrentValues['LIST_PROPERTY_CODE']))
	{
		$selected = array();

		foreach ($arCurrentValues['LIST_PROPERTY_CODE'] as $code)
		{
			if (isset($arAllPropList[$code]))
			{
				$selected[$code] = $arAllPropList[$code];
			}
		}

		$arTemplateParameters['LIST_PROPERTY_CODE_MOBILE'] = array(
			'PARENT' => 'LIST_SETTINGS',
			'NAME' => GetMessage('CP_BC_TPL_PROPERTY_CODE_MOBILE'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'VALUES' => $selected
		);
	}

    $lineElementCount = (int)$arCurrentValues['LINE_ELEMENT_COUNT'] ?: 3;
	$pageElementCount = (int)$arCurrentValues['PAGE_ELEMENT_COUNT'] ?: 30;


	$arTemplateParameters['LIST_ENLARGE_PRODUCT'] = array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_ENLARGE_PRODUCT'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'N',
		'ADDITIONAL_VALUES' => 'N',
		'REFRESH' => 'Y',
		'DEFAULT' => 'N',
		'VALUES' => array(
			'STRICT' => GetMessage('CP_BC_TPL_ENLARGE_PRODUCT_STRICT'),
			'PROP' => GetMessage('CP_BC_TPL_ENLARGE_PRODUCT_PROP')
		)
	);

	if (isset($arCurrentValues['LIST_ENLARGE_PRODUCT']) && $arCurrentValues['LIST_ENLARGE_PRODUCT'] === 'PROP')
	{
		$arTemplateParameters['LIST_ENLARGE_PROP'] = array(
			'PARENT' => 'LIST_SETTINGS',
			'NAME' => GetMessage('CP_BC_TPL_ENLARGE_PROP'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'N',
			'ADDITIONAL_VALUES' => 'N',
			'REFRESH' => 'N',
			'DEFAULT' => '-',
			'VALUES' => $defaultValue + $arListPropList
		);
	}
	$arTemplateParameters['LIST_SHOW_SLIDER'] = array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_SHOW_SLIDER'),
		'TYPE' => 'CHECKBOX',
		'MULTIPLE' => 'N',
		'REFRESH' => 'Y',
		'DEFAULT' => 'Y'
	);

	if (!isset($arCurrentValues['LIST_SHOW_SLIDER']) || $arCurrentValues['LIST_SHOW_SLIDER'] === 'Y')
	{
		$arTemplateParameters['LIST_SLIDER_INTERVAL'] = array(
			'PARENT' => 'LIST_SETTINGS',
			'NAME' => GetMessage('CP_BC_TPL_SLIDER_INTERVAL'),
			'TYPE' => 'TEXT',
			'MULTIPLE' => 'N',
			'REFRESH' => 'N',
			'DEFAULT' => '3000'
		);
		$arTemplateParameters['LIST_SLIDER_PROGRESS'] = array(
			'PARENT' => 'LIST_SETTINGS',
			'NAME' => GetMessage('CP_BC_TPL_SLIDER_PROGRESS'),
			'TYPE' => 'CHECKBOX',
			'MULTIPLE' => 'N',
			'REFRESH' => 'N',
			'DEFAULT' => 'N'
		);
	}

	$arTemplateParameters['ADD_PICT_PROP'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BC_TPL_ADD_PICT_PROP'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'N',
		'ADDITIONAL_VALUES' => 'N',
		'REFRESH' => 'N',
		'DEFAULT' => '-',
		'VALUES' => $arFilePropList
	);
	$arTemplateParameters['LABEL_PROP'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BC_TPL_LABEL_PROP'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'ADDITIONAL_VALUES' => 'N',
		'REFRESH' => 'Y',
		'VALUES' => $arListPropList
	);

	if (!empty($arCurrentValues['LABEL_PROP']))
	{
		if (!is_array($arCurrentValues['LABEL_PROP']))
		{
			$arCurrentValues['LABEL_PROP'] = array($arCurrentValues['LABEL_PROP']);
		}

		$selected = array();
		foreach ($arCurrentValues['LABEL_PROP'] as $name)
		{
			if (isset($arListPropList[$name]))
			{
				$selected[$name] = $arListPropList[$name];
			}
		}

		$arTemplateParameters['LABEL_PROP_MOBILE'] = array(
			'PARENT' => 'VISUAL',
			'NAME' => GetMessage('CP_BC_TPL_LABEL_PROP_MOBILE'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'ADDITIONAL_VALUES' => 'N',
			'REFRESH' => 'N',
			'VALUES' => $selected
		);
		unset($selected);
	}

	if ($boolSKU)
	{
		$arTemplateParameters['PRODUCT_DISPLAY_MODE'] = array(
			'PARENT' => 'VISUAL',
			'NAME' => GetMessage('CP_BC_TPL_PRODUCT_DISPLAY_MODE'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'N',
			'ADDITIONAL_VALUES' => 'N',
			'REFRESH' => 'Y',
			'DEFAULT' => 'N',
			'VALUES' => array(
				'N' => GetMessage('CP_BC_TPL_DML_SIMPLE'),
				'Y' => GetMessage('CP_BC_TPL_DML_EXT')
			)
		);
		$arAllOfferPropList = array();
		$arFileOfferPropList = array(
			'-' => GetMessage('CP_BC_TPL_PROP_EMPTY')
		);
		$arTreeOfferPropList = array(
			'-' => GetMessage('CP_BC_TPL_PROP_EMPTY')
		);
		$rsProps = CIBlockProperty::GetList(
			array('SORT' => 'ASC', 'ID' => 'ASC'),
			array('IBLOCK_ID' => $arSKU['IBLOCK_ID'], 'ACTIVE' => 'Y')
		);
		while ($arProp = $rsProps->Fetch())
		{
			if ($arProp['ID'] == $arSKU['SKU_PROPERTY_ID'])
				continue;
			$arProp['USER_TYPE'] = (string)$arProp['USER_TYPE'];
			$strPropName = '['.$arProp['ID'].']'.('' != $arProp['CODE'] ? '['.$arProp['CODE'].']' : '').' '.$arProp['NAME'];
			if ('' == $arProp['CODE'])
				$arProp['CODE'] = $arProp['ID'];
			$arAllOfferPropList[$arProp['CODE']] = $strPropName;
			if ('F' == $arProp['PROPERTY_TYPE'])
				$arFileOfferPropList[$arProp['CODE']] = $strPropName;
			if ('N' != $arProp['MULTIPLE'])
				continue;
			if (
				'L' == $arProp['PROPERTY_TYPE']
				|| 'E' == $arProp['PROPERTY_TYPE']
				|| ('S' == $arProp['PROPERTY_TYPE'] && 'directory' == $arProp['USER_TYPE'] && CIBlockPriceTools::checkPropDirectory($arProp))
			)
				$arTreeOfferPropList[$arProp['CODE']] = $strPropName;
		}
		$arTemplateParameters['OFFER_ADD_PICT_PROP'] = array(
			'PARENT' => 'VISUAL',
			'NAME' => GetMessage('CP_BC_TPL_OFFER_ADD_PICT_PROP'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'N',
			'ADDITIONAL_VALUES' => 'N',
			'REFRESH' => 'N',
			'DEFAULT' => '-',
			'VALUES' => $arFileOfferPropList
		);
		$arTemplateParameters['OFFER_TREE_PROPS'] = array(
			'PARENT' => 'VISUAL',
			'NAME' => GetMessage('CP_BC_TPL_OFFER_TREE_PROPS'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'Y',
			'ADDITIONAL_VALUES' => 'N',
			'REFRESH' => 'N',
			'DEFAULT' => '-',
			'VALUES' => $arTreeOfferPropList
		);
	}
}

$arCurrentValues['DETAIL_PROPERTY_CODE'] = isset($arCurrentValues['DETAIL_PROPERTY_CODE']) ? $arCurrentValues['DETAIL_PROPERTY_CODE'] : array();
if (!empty($arCurrentValues['DETAIL_PROPERTY_CODE']))
{
	$selected = array();

	foreach ($arCurrentValues['DETAIL_PROPERTY_CODE'] as $code)
	{
		if (isset($arAllPropList[$code]))
		{
			$selected[$code] = $arAllPropList[$code];
		}
	}

	$arTemplateParameters['DETAIL_MAIN_BLOCK_PROPERTY_CODE'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_MAIN_BLOCK_PROPERTY_CODE'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'SIZE' => (count($selected) > 5 ? 8 : 3),
		'VALUES' => $selected
	);
}

$arCurrentValues['DETAIL_OFFERS_PROPERTY_CODE'] = isset($arCurrentValues['DETAIL_OFFERS_PROPERTY_CODE']) ? $arCurrentValues['DETAIL_OFFERS_PROPERTY_CODE'] : array();
if (!empty($arCurrentValues['DETAIL_OFFERS_PROPERTY_CODE']))
{
	$selected = array();

	foreach ($arCurrentValues['DETAIL_OFFERS_PROPERTY_CODE'] as $code)
	{
		if (isset($arAllOfferPropList[$code]))
		{
			$selected[$code] = $arAllOfferPropList[$code];
		}
	}

	$arTemplateParameters['DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_MAIN_BLOCK_OFFERS_PROPERTY_CODE'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'SIZE' => (count($selected) > 5 ? 8 : 3),
		'VALUES' => $selected
	);
}

if (isset($arCurrentValues['DETAIL_USE_COMMENTS']) && 'Y' == $arCurrentValues['DETAIL_USE_COMMENTS'])
{
	if (ModuleManager::isModuleInstalled("blog"))
	{
		$arTemplateParameters['DETAIL_BLOG_USE'] = array(
			'PARENT' => 'DETAIL_SETTINGS',
			'NAME' => GetMessage('CP_BC_TPL_DETAIL_BLOG_USE'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'N',
			'REFRESH' => 'Y'
		);
		if (isset($arCurrentValues['DETAIL_BLOG_USE']) && $arCurrentValues['DETAIL_BLOG_USE'] == 'Y')
		{
			$arTemplateParameters['DETAIL_BLOG_URL'] = array(
				'PARENT' => 'DETAIL_SETTINGS',
				'NAME' => GetMessage('CP_BC_DETAIL_TPL_BLOG_URL'),
				'TYPE' => 'STRING',
				'DEFAULT' => 'catalog_comments'
			);
			$arTemplateParameters['DETAIL_BLOG_EMAIL_NOTIFY'] = array(
				'PARENT' => 'DETAIL_SETTINGS',
				'NAME' => GetMessage('CP_BC_TPL_DETAIL_BLOG_EMAIL_NOTIFY'),
				'TYPE' => 'CHECKBOX',
				'DEFAULT' => 'N'
			);
		}
	}

	$boolRus = false;
	$langBy = "id";
	$langOrder = "asc";
	$rsLangs = CLanguage::GetList($langBy, $langOrder, array('ID' => 'ru',"ACTIVE" => "Y"));
	if ($arLang = $rsLangs->Fetch())
	{
		$boolRus = true;
	}

	if ($boolRus)
	{
		$arTemplateParameters['DETAIL_VK_USE'] = array(
			'PARENT' => 'DETAIL_SETTINGS',
			'NAME' => GetMessage('CP_BC_TPL_DETAIL_VK_USE'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'N',
			'REFRESH' => 'Y'
		);

		if (isset($arCurrentValues['DETAIL_VK_USE']) && 'Y' == $arCurrentValues['DETAIL_VK_USE'])
		{
			$arTemplateParameters['DETAIL_VK_API_ID'] = array(
				'PARENT' => 'DETAIL_SETTINGS',
				'NAME' => GetMessage('CP_BC_TPL_DETAIL_VK_API_ID'),
				'TYPE' => 'STRING',
				'DEFAULT' => 'API_ID'
			);
		}
	}

	$arTemplateParameters['DETAIL_FB_USE'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_DETAIL_FB_USE'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
		'REFRESH' => 'Y'
	);

	if (isset($arCurrentValues['DETAIL_FB_USE']) && 'Y' == $arCurrentValues['DETAIL_FB_USE'])
	{
		$arTemplateParameters['DETAIL_FB_APP_ID'] = array(
			'PARENT' => 'DETAIL_SETTINGS',
			'NAME' => GetMessage('CP_BC_TPL_DETAIL_FB_APP_ID'),
			'TYPE' => 'STRING',
			'DEFAULT' => ''
		);
	}
}



$arTemplateParameters['DETAIL_DISPLAY_NAME'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_DETAIL_DISPLAY_NAME'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'Y'
);
$arTemplateParameters['DETAIL_IMAGE_RESOLUTION'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_DETAIL_IMAGE_RESOLUTION'),
	'TYPE' => 'LIST',
	'VALUES' => array(
		'16by9' => GetMessage('CP_BC_TPL_DETAIL_IMAGE_RESOLUTION_16_BY_9'),
		'1by1' => GetMessage('CP_BC_TPL_DETAIL_IMAGE_RESOLUTION_1_BY_1')
	),
	'DEFAULT' => '16by9'
);
$arTemplateParameters['DETAIL_PRODUCT_INFO_BLOCK_ORDER'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_PRODUCT_INFO_BLOCK_ORDER'),
	'TYPE' => 'CUSTOM',
	'JS_FILE' => CatalogElementComponent::getSettingsScript('/bitrix/components/bitrix/catalog.element', 'dragdrop_order'),
	'JS_EVENT' => 'initDraggableOrderControl',
	'JS_DATA' => Json::encode(array(
		'sku' => GetMessage('CP_BC_TPL_DETAIL_PRODUCT_BLOCK_SKU'),
		'props' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_PROPS')
	)),
	'DEFAULT' => 'sku,props'
);
$arTemplateParameters['DETAIL_PRODUCT_PAY_BLOCK_ORDER'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_PRODUCT_PAY_BLOCK_ORDER'),
	'TYPE' => 'CUSTOM',
	'JS_FILE' => CatalogElementComponent::getSettingsScript('/bitrix/components/bitrix/catalog.element', 'dragdrop_order'),
	'JS_EVENT' => 'initDraggableOrderControl',
	'JS_DATA' => Json::encode(array(
		'rating' => GetMessage('CP_BC_TPL_DETAIL_PRODUCT_BLOCK_RATING'),
		'price' => GetMessage('CP_BC_TPL_DETAIL_PRODUCT_BLOCK_PRICE'),
		'priceRanges' => GetMessage('CP_BC_TPL_PRODUCT_BLOCK_PRICE_RANGES'),
		'quantityLimit' => GetMessage('CP_BC_TPL_DETAIL_PRODUCT_BLOCK_QUANTITY_LIMIT'),
		'quantity' => GetMessage('CP_BC_TPL_DETAIL_PRODUCT_BLOCK_QUANTITY'),
		'buttons' => GetMessage('CP_BC_TPL_DETAIL_PRODUCT_BLOCK_BUTTONS')
	)),
	'DEFAULT' => 'rating,price,priceRanges,quantityLimit,quantity,buttons'
);
$arTemplateParameters['DETAIL_SHOW_SLIDER'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_DETAIL_SHOW_SLIDER'),
	'TYPE' => 'CHECKBOX',
	'MULTIPLE' => 'N',
	'REFRESH' => 'Y',
	'DEFAULT' => 'N'
);

if (isset($arCurrentValues['DETAIL_SHOW_SLIDER']) && $arCurrentValues['DETAIL_SHOW_SLIDER'] === 'Y')
{
	$arTemplateParameters['DETAIL_SLIDER_INTERVAL'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_DETAIL_SLIDER_INTERVAL'),
		'TYPE' => 'TEXT',
		'MULTIPLE' => 'N',
		'REFRESH' => 'N',
		'DEFAULT' => '5000'
	);
	$arTemplateParameters['DETAIL_SLIDER_PROGRESS'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_DETAIL_SLIDER_PROGRESS'),
		'TYPE' => 'CHECKBOX',
		'MULTIPLE' => 'N',
		'REFRESH' => 'N',
		'DEFAULT' => 'N'
	);
}

$arTemplateParameters['DETAIL_DETAIL_PICTURE_MODE'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_DETAIL_DETAIL_PICTURE_MODE'),
	'TYPE' => 'LIST',
	'MULTIPLE' => 'Y',
	'DEFAULT' => array('POPUP', 'MAGNIFIER'),
	'VALUES' => array(
		'POPUP' => GetMessage('DETAIL_DETAIL_PICTURE_MODE_POPUP'),
		'MAGNIFIER' => GetMessage('DETAIL_DETAIL_PICTURE_MODE_MAGNIFIER'),
	)
);

$arTemplateParameters['DETAIL_ADD_DETAIL_TO_SLIDER'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_DETAIL_ADD_DETAIL_TO_SLIDER'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'N'
);
$arTemplateParameters['DETAIL_DISPLAY_PREVIEW_TEXT_MODE'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_DETAIL_DISPLAY_PREVIEW_TEXT_MODE'),
	'TYPE' => 'LIST',
	'VALUES' => array(
		'H' => GetMessage('CP_BC_TPL_DETAIL_DISPLAY_PREVIEW_TEXT_MODE_HIDE'),
		'E' => GetMessage('CP_BC_TPL_DETAIL_DISPLAY_PREVIEW_TEXT_MODE_EMPTY_DETAIL'),
		'S' => GetMessage('CP_BC_TPL_DETAIL_DISPLAY_PREVIEW_TEXT_MODE_SHOW')
	),
	'DEFAULT' => 'E'
);

if ($boolCatalog)
{

	$useCommonSettingsBasketPopup = (
		isset($arCurrentValues['USE_COMMON_SETTINGS_BASKET_POPUP'])
		&& $arCurrentValues['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y'
	);
	$addToBasketActions = array(
		'BUY' => GetMessage('ADD_TO_BASKET_ACTION_BUY'),
		'ADD' => GetMessage('ADD_TO_BASKET_ACTION_ADD')
	);

	$arTemplateParameters['MESS_PRICE_RANGES_TITLE'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_MESS_PRICE_RANGES_TITLE'),
		'TYPE' => 'STRING',
		'DEFAULT' => GetMessage('CP_BC_TPL_MESS_PRICE_RANGES_TITLE_DEFAULT')
	);
	$arTemplateParameters['MESS_DESCRIPTION_TAB'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_MESS_DESCRIPTION_TAB'),
		'TYPE' => 'STRING',
		'DEFAULT' => GetMessage('CP_BC_TPL_MESS_DESCRIPTION_TAB_DEFAULT')
	);
	$arTemplateParameters['MESS_PROPERTIES_TAB'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_MESS_PROPERTIES_TAB'),
		'TYPE' => 'STRING',
		'DEFAULT' => GetMessage('CP_BC_TPL_MESS_PROPERTIES_TAB_DEFAULT')
	);
	$arTemplateParameters['MESS_COMMENTS_TAB'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_MESS_COMMENTS_TAB'),
		'TYPE' => 'STRING',
		'DEFAULT' => GetMessage('CP_BC_TPL_MESS_COMMENTS_TAB_DEFAULT')
	);


	if (!$useCommonSettingsBasketPopup && !empty($arCurrentValues['DETAIL_ADD_TO_BASKET_ACTION']))
	{
		$selected = array();

		if (!is_array($arCurrentValues['DETAIL_ADD_TO_BASKET_ACTION']))
		{
			$arCurrentValues['DETAIL_ADD_TO_BASKET_ACTION'] = array($arCurrentValues['DETAIL_ADD_TO_BASKET_ACTION']);
		}

		foreach ($arCurrentValues['DETAIL_ADD_TO_BASKET_ACTION'] as $action)
		{
			if (isset($addToBasketActions[$action]))
			{
				$selected[$action] = $addToBasketActions[$action];
			}
		}


	}

    $arTemplateParameters['SHOW_DISCOUNT_PERCENT'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BC_TPL_SHOW_DISCOUNT_PERCENT'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
		'REFRESH' => 'Y',
	);


	$arTemplateParameters['SHOW_OLD_PRICE'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BC_TPL_SHOW_OLD_PRICE'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
	);
	$arTemplateParameters['SHOW_MAX_QUANTITY'] = array(
		'PARENT' => 'VISUAL',
		'NAME' => GetMessage('CP_BC_TPL_SHOW_MAX_QUANTITY'),
		'TYPE' => 'LIST',
		'REFRESH' => 'Y',
		'MULTIPLE' => 'N',
		'VALUES' => array(
			'N' => GetMessage('CP_BC_TPL_SHOW_MAX_QUANTITY_N'),
			'Y' => GetMessage('CP_BC_TPL_SHOW_MAX_QUANTITY_Y'),
			'M' => GetMessage('CP_BC_TPL_SHOW_MAX_QUANTITY_M')
		),
		'DEFAULT' => array('N')
	);

	if (isset($arCurrentValues['SHOW_MAX_QUANTITY']))
	{
		if ($arCurrentValues['SHOW_MAX_QUANTITY'] !== 'N')
		{
			$arTemplateParameters['MESS_SHOW_MAX_QUANTITY'] = array(
				'PARENT' => 'VISUAL',
				'NAME' => GetMessage('CP_BC_TPL_MESS_SHOW_MAX_QUANTITY'),
				'TYPE' => 'STRING',
				'DEFAULT' => GetMessage('CP_BC_TPL_MESS_SHOW_MAX_QUANTITY_DEFAULT')
			);
		}

		if ($arCurrentValues['SHOW_MAX_QUANTITY'] === 'M')
		{
			$arTemplateParameters['RELATIVE_QUANTITY_FACTOR'] = array(
				'PARENT' => 'VISUAL',
				'NAME' => GetMessage('CP_BC_TPL_RELATIVE_QUANTITY_FACTOR'),
				'TYPE' => 'STRING',
				'DEFAULT' => '5'
			);
			$arTemplateParameters['MESS_RELATIVE_QUANTITY_MANY'] = array(
				'PARENT' => 'VISUAL',
				'NAME' => GetMessage('CP_BC_TPL_MESS_RELATIVE_QUANTITY_MANY'),
				'TYPE' => 'STRING',
				'DEFAULT' => GetMessage('CP_BC_TPL_MESS_RELATIVE_QUANTITY_MANY_DEFAULT')
			);
			$arTemplateParameters['MESS_RELATIVE_QUANTITY_FEW'] = array(
				'PARENT' => 'VISUAL',
				'NAME' => GetMessage('CP_BC_TPL_MESS_RELATIVE_QUANTITY_FEW'),
				'TYPE' => 'STRING',
				'DEFAULT' => GetMessage('CP_BC_TPL_MESS_RELATIVE_QUANTITY_FEW_DEFAULT')
			);
		}
	}
}

$arTemplateParameters['LAZY_LOAD'] = array(
	'PARENT' => 'PAGER_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_LAZY_LOAD'),
	'TYPE' => 'CHECKBOX',
	'REFRESH' => 'Y',
	'DEFAULT' => 'N'
);

if (isset($arCurrentValues['LAZY_LOAD']) && $arCurrentValues['LAZY_LOAD'] === 'Y')
{
	$arTemplateParameters['MESS_BTN_LAZY_LOAD'] = array(
		'PARENT' => 'PAGER_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_MESS_BTN_LAZY_LOAD'),
		'TYPE' => 'TEXT',
		'DEFAULT' => GetMessage('CP_BC_TPL_MESS_BTN_LAZY_LOAD_DEFAULT')
	);
}

$arTemplateParameters['LOAD_ON_SCROLL'] = array(
	'PARENT' => 'PAGER_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_LOAD_ON_SCROLL'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'N'
);

$arTemplateParameters['MESS_BTN_BUY'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BC_TPL_MESS_BTN_BUY'),
	'TYPE' => 'STRING',
	'DEFAULT' => GetMessage('CP_BC_TPL_MESS_BTN_BUY_DEFAULT')
);
$arTemplateParameters['MESS_BTN_ADD_TO_BASKET'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BC_TPL_MESS_BTN_ADD_TO_BASKET'),
	'TYPE' => 'STRING',
	'DEFAULT' => GetMessage('CP_BC_TPL_MESS_BTN_ADD_TO_BASKET_DEFAULT')
);
$arTemplateParameters['MESS_BTN_COMPARE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BC_TPL_MESS_BTN_COMPARE'),
	'TYPE' => 'STRING',
	'DEFAULT' => GetMessage('CP_BC_TPL_MESS_BTN_COMPARE_DEFAULT')
);
$arTemplateParameters['MESS_BTN_DETAIL'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BC_TPL_MESS_BTN_DETAIL'),
	'TYPE' => 'STRING',
	'DEFAULT' => GetMessage('CP_BC_TPL_MESS_BTN_DETAIL_DEFAULT')
);
$arTemplateParameters['MESS_NOT_AVAILABLE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BC_TPL_MESS_NOT_AVAILABLE'),
	'TYPE' => 'STRING',
	'DEFAULT' => GetMessage('CP_BC_TPL_MESS_NOT_AVAILABLE_DEFAULT')
);
$arTemplateParameters['MESS_BTN_SUBSCRIBE'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CP_BC_TPL_MESS_BTN_SUBSCRIBE'),
	'TYPE' => 'STRING',
	'DEFAULT' => GetMessage('CP_BC_TPL_MESS_BTN_SUBSCRIBE_DEFAULT')
);

if (ModuleManager::isModuleInstalled("sale"))
{
	$arTemplateParameters['USE_SALE_BESTSELLERS'] = array(
		'NAME' => GetMessage('CP_BC_TPL_USE_SALE_BESTSELLERS'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y'
	);

	$arTemplateParameters['USE_BIG_DATA'] = array(
		'PARENT' => 'BIG_DATA_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_USE_BIG_DATA'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
		'REFRESH' => 'Y'
	);
	if (!isset($arCurrentValues['USE_BIG_DATA']) || $arCurrentValues['USE_BIG_DATA'] == 'Y')
	{
		$rcmTypeList = array(
			'personal' => GetMessage('CP_BC_TPL_RCM_PERSONAL'),
			'bestsell' => GetMessage('CP_BC_TPL_RCM_BESTSELLERS'),
			'similar_sell' => GetMessage('CP_BC_TPL_RCM_SOLD_WITH'),
			'similar_view' => GetMessage('CP_BC_TPL_RCM_VIEWED_WITH'),
			'similar' => GetMessage('CP_BC_TPL_RCM_SIMILAR'),
			'any_similar' => GetMessage('CP_BC_TPL_RCM_SIMILAR_ANY'),
			'any_personal' => GetMessage('CP_BC_TPL_RCM_PERSONAL_WBEST'),
			'any' => GetMessage('CP_BC_TPL_RCM_RAND')
		);
		$arTemplateParameters['BIG_DATA_RCM_TYPE'] = array(
			'PARENT' => 'BIG_DATA_SETTINGS',
			'NAME' => GetMessage('CP_BC_TPL_BIG_DATA_RCM_TYPE'),
			'TYPE' => 'LIST',
			'DEFAULT' => 'personal',
			'VALUES' => $rcmTypeList
		);
		unset($rcmTypeList);
	}
}

if (isset($arCurrentValues['SHOW_TOP_ELEMENTS']) && 'Y' == $arCurrentValues['SHOW_TOP_ELEMENTS'])
{
	$arTemplateParameters['TOP_VIEW_MODE'] = array(
		'PARENT' => 'TOP_SETTINGS',
		'NAME' => GetMessage('CPT_BC_TPL_TOP_VIEW_MODE'),
		'TYPE' => 'LIST',
		'VALUES' => array(
			'BANNER' => GetMessage('CPT_BC_TPL_VIEW_MODE_BANNER'),
			'SLIDER' => GetMessage('CPT_BC_TPL_VIEW_MODE_SLIDER'),
			'SECTION' => GetMessage('CPT_BC_TPL_VIEW_MODE_SECTION')
		),
		'MULTIPLE' => 'N',
		'DEFAULT' => 'SECTION',
		'REFRESH' => 'Y'
	);

	if (isset($arCurrentValues['TOP_VIEW_MODE']) && ('SLIDER' == $arCurrentValues['TOP_VIEW_MODE'] || 'BANNER' == $arCurrentValues['TOP_VIEW_MODE']))
	{
		$arTemplateParameters['TOP_ROTATE_TIMER'] = array(
			'PARENT' => 'TOP_SETTINGS',
			'NAME' => GetMessage('CPT_BC_TPL_TOP_ROTATE_TIMER'),
			'TYPE' => 'STRING',
			'DEFAULT' => '30'
		);
	}

	if (isset($arCurrentValues['TOP_VIEW_MODE']) && $arCurrentValues['TOP_VIEW_MODE'] === 'SECTION')
	{
		if (!empty($arCurrentValues['TOP_PROPERTY_CODE']))
		{
			$selected = array();

			foreach ($arCurrentValues['TOP_PROPERTY_CODE'] as $code)
			{
				if (isset($arAllPropList[$code]))
				{
					$selected[$code] = $arAllPropList[$code];
				}
			}

			$arTemplateParameters['TOP_PROPERTY_CODE_MOBILE'] = array(
				'PARENT' => 'TOP_SETTINGS',
				'NAME' => GetMessage('CP_BC_TPL_PROPERTY_CODE_MOBILE'),
				'TYPE' => 'LIST',
				'MULTIPLE' => 'Y',
				'VALUES' => $selected
			);
		}

        $lineElementCount = (int)$arCurrentValues['TOP_LINE_ELEMENT_COUNT'] ?: 3;
		$pageElementCount = (int)$arCurrentValues['TOP_ELEMENT_COUNT'] ?: 9;

		$arTemplateParameters['TOP_PRODUCT_ROW_VARIANTS'] = array(
			'PARENT' => 'TOP_SETTINGS',
			'NAME' => GetMessage('CP_BC_TPL_PRODUCT_ROW_VARIANTS'),
			'TYPE' => 'CUSTOM',
			'BIG_DATA' => 'N',
			'COUNT_PARAM_NAME' => 'TOP_ELEMENT_COUNT',
			'JS_FILE' => CatalogTopComponent::getSettingsScript('/bitrix/components/bitrix/catalog.top', 'dragdrop_add'),
			'JS_EVENT' => 'initDraggableAddControl',
			'JS_MESSAGES' => Json::encode(array(
				'variant' => GetMessage('CP_BC_TPL_SETTINGS_VARIANT'),
				'delete' => GetMessage('CP_BC_TPL_SETTINGS_DELETE'),
				'quantity' => GetMessage('CP_BC_TPL_SETTINGS_QUANTITY'),
				'quantityBigData' => GetMessage('CP_BC_TPL_SETTINGS_QUANTITY_BIG_DATA')
			)),
			'JS_DATA' => Json::encode(CatalogTopComponent::getTemplateVariantsMap()),
			'DEFAULT' => Json::encode(CatalogTopComponent::predictRowVariants($lineElementCount, $pageElementCount))
		);

		$arTemplateParameters['TOP_ENLARGE_PRODUCT'] = array(
			'PARENT' => 'TOP_SETTINGS',
			'NAME' => GetMessage('CP_BC_TPL_ENLARGE_PRODUCT'),
			'TYPE' => 'LIST',
			'MULTIPLE' => 'N',
			'ADDITIONAL_VALUES' => 'N',
			'REFRESH' => 'Y',
			'DEFAULT' => 'N',
			'VALUES' => array(
				'STRICT' => GetMessage('CP_BC_TPL_ENLARGE_PRODUCT_STRICT'),
				'PROP' => GetMessage('CP_BC_TPL_ENLARGE_PRODUCT_PROP')
			)
		);

		if (isset($arCurrentValues['TOP_ENLARGE_PRODUCT']) && $arCurrentValues['TOP_ENLARGE_PRODUCT'] === 'PROP')
		{
			$arTemplateParameters['TOP_ENLARGE_PROP'] = array(
				'PARENT' => 'TOP_SETTINGS',
				'NAME' => GetMessage('CP_BC_TPL_ENLARGE_PROP'),
				'TYPE' => 'LIST',
				'MULTIPLE' => 'N',
				'ADDITIONAL_VALUES' => 'N',
				'REFRESH' => 'N',
				'DEFAULT' => '-',
				'VALUES' => $defaultValue + $arListPropList
			);
		}
		$arTemplateParameters['TOP_SHOW_SLIDER'] = array(
			'PARENT' => 'TOP_SETTINGS',
			'NAME' => GetMessage('CP_BC_TPL_SHOW_SLIDER'),
			'TYPE' => 'CHECKBOX',
			'MULTIPLE' => 'N',
			'REFRESH' => 'Y',
			'DEFAULT' => 'Y'
		);

		if (!isset($arCurrentValues['TOP_SHOW_SLIDER']) || $arCurrentValues['TOP_SHOW_SLIDER'] === 'Y')
		{
			$arTemplateParameters['TOP_SLIDER_INTERVAL'] = array(
				'PARENT' => 'TOP_SETTINGS',
				'NAME' => GetMessage('CP_BC_TPL_SLIDER_INTERVAL'),
				'TYPE' => 'TEXT',
				'MULTIPLE' => 'N',
				'REFRESH' => 'N',
				'DEFAULT' => '3000'
			);
			$arTemplateParameters['TOP_SLIDER_PROGRESS'] = array(
				'PARENT' => 'TOP_SETTINGS',
				'NAME' => GetMessage('CP_BC_TPL_SLIDER_PROGRESS'),
				'TYPE' => 'CHECKBOX',
				'MULTIPLE' => 'N',
				'REFRESH' => 'N',
				'DEFAULT' => 'N'
			);
		}
	}
}


$arTemplateParameters['SIDEBAR_SECTION_SHOW'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CPT_SIDEBAR_SECTION_SHOW'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'Y',
	'SORT' => 800
);
$arTemplateParameters['SIDEBAR_DETAIL_SHOW'] = array(
	'PARENT' => 'VISUAL',
	'NAME' => GetMessage('CPT_SIDEBAR_DETAIL_SHOW'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'N',
	'SORT' => 800
);

$arTemplateParameters['USE_ENHANCED_ECOMMERCE'] = array(
	'PARENT' => 'ANALYTICS_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_USE_ENHANCED_ECOMMERCE'),
	'TYPE' => 'CHECKBOX',
	'REFRESH' => 'Y',
	'DEFAULT' => 'N'
);

if (isset($arCurrentValues['USE_ENHANCED_ECOMMERCE']) && $arCurrentValues['USE_ENHANCED_ECOMMERCE'] === 'Y')
{
	$arTemplateParameters['DATA_LAYER_NAME'] = array(
		'PARENT' => 'ANALYTICS_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_DATA_LAYER_NAME'),
		'TYPE' => 'STRING',
		'DEFAULT' => 'dataLayer'
	);
}

$arTemplateParameters['DETAIL_SHOW_POPULAR'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_DETAIL_SHOW_POPULAR'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'Y'
);
$arTemplateParameters['DETAIL_SHOW_VIEWED'] = array(
	'PARENT' => 'DETAIL_SETTINGS',
	'NAME' => GetMessage('CP_BC_TPL_DETAIL_SHOW_VIEWED'),
	'TYPE' => 'CHECKBOX',
	'DEFAULT' => 'Y'
);

// hack to hide component parameters by templates
$arTemplateParameters['HIDE_USE_ALSO_BUY'] = array();

///////////////////////////////////////////////////////////// New params////////////////////////////////////////////////

if (0 < intval($arCurrentValues['IBLOCK_ID'])) {
    $arPropList = array();
    $rsProps = CIBlockProperty::GetList(array(), array('IBLOCK_ID' => $arCurrentValues['IBLOCK_ID']));
    while ($arProp = $rsProps->Fetch()) {
        $arPropList[$arProp['ID']] = $arProp['NAME'];
        $arPropSectionblock[$arProp['CODE']] = $arProp['NAME'];
    }
    $arTemplateParameters['DOP_ELEMENT_PROPERTY_ONE'] = array(
        'NAME' => GetMessage('DOP_ELEMENT_PROPERTY_ONE'),
        'TYPE' => 'LIST',
        'ADDITIONAL_VALUES' => "Y",
        'VALUES' => $arPropList,
    );

    $arTemplateParameters['DOP_ELEMENT_PROPERTY_TWO'] = array(
        'NAME' => GetMessage('DOP_ELEMENT_PROPERTY_TWO'),
        'TYPE' => 'LIST',
        'ADDITIONAL_VALUES' => 'Y',
        'VALUES' => $arPropList,
    );

    $arTemplateParameters['DOP_ELEMENT_PROPERTY_THREE'] = array(
        'NAME' => GetMessage('DOP_ELEMENT_PROPERTY_THREE'),
        'TYPE' => 'LIST',
        'ADDITIONAL_VALUES' => 'Y',
        'VALUES' => $arPropList,
    );

    $arPropListSku = array();
    $rsProps = CIBlockProperty::GetList(array(), array('IBLOCK_ID' => 3));
    while ($arProp = $rsProps->Fetch()) {
        $arPropListSku[$arProp['ID']] = $arProp['NAME'];
    }
    /*$arTemplateParameters['DOP_SKU_PROPERTY_ONE'] = array(
        'NAME' => GetMessage('DOP_SKU_PROPERTY_ONE'),
        'TYPE' => 'LIST',
        'ADDITIONAL_VALUES' => "Y",
        'VALUES' => $arPropListSku,
    );

    $arTemplateParameters['DOP_SKU_PROPERTY_TWO'] = array(
        'NAME' => GetMessage('DOP_SKU_PROPERTY_TWO'),
        'TYPE' => 'LIST',
        'ADDITIONAL_VALUES' => 'Y',
        'VALUES' => $arPropListSku,
    );

    $arTemplateParameters['DOP_SKU_PROPERTY_THREE'] = array(
        'NAME' => GetMessage('DOP_SKU_PROPERTY_THREE'),
        'TYPE' => 'LIST',
        'ADDITIONAL_VALUES' => 'Y',
        'VALUES' => $arPropListSku,
    );*/

    $arIblocID = array();
    $rsIbloc = CIBlock::GetList(array(), array());
    while ($arIoblock = $rsIbloc->Fetch()) {
        $arIblocID[$arIoblock['ID']] = $arIoblock['NAME'];
    }

    $arTemplateParameters['I_BLOCK_GROUP_PROP'] = array(
        'NAME' => GetMessage('I_BLOCK_GROUP_PROP'),
        'TYPE' => 'LIST',
        'ADDITIONAL_VALUES' => 'Y',
        'VALUES' => $arIblocID,
    );

    $arTemplateParameters['PROPERTY_TOP_ONE'] = array(
        "PARENT" => "DETAIL_SETTINGS",
        'NAME' => GetMessage('PROPERTY_TOP_ONE'),
        'TYPE' => 'LIST',
        'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProperty_LNS,
    );

    $arTemplateParameters['PROPERTY_TOP_TWO'] = array(
        "PARENT" => "DETAIL_SETTINGS",
        'NAME' => GetMessage('PROPERTY_TOP_TWO'),
        'TYPE' => 'LIST',
        'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProperty_LNS,
    );

    $arTemplateParameters['PROPERTY_TOP_THREE'] = array(
        "PARENT" => "DETAIL_SETTINGS",
        'NAME' => GetMessage('PROPERTY_TOP_THREE'),
        'TYPE' => 'LIST',
        'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProperty_LNS,
    );

    $arTemplateParameters['PROPERTY_TOP_FOUR'] = array(
        "PARENT" => "DETAIL_SETTINGS",
        'NAME' => GetMessage('PROPERTY_TOP_FOUR'),
        'TYPE' => 'LIST',
        'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProperty_LNS,
    );

    $arTemplateParameters['PROPERTY_TOP_FIVE'] = array(
        "PARENT" => "DETAIL_SETTINGS",
        'NAME' => GetMessage('PROPERTY_TOP_FIVE'),
        'TYPE' => 'LIST',
        'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProperty_LNS,
    );


    $arTemplateParameters['PROP_1'] = array(
        "PARENT" => "LIST_SETTINGS",
        'NAME' => GetMessage('PROP_1'),
        "TYPE" => "LIST",
        'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProperty_LNS,
    );

    $arTemplateParameters['PROP_2'] = array(
        "PARENT" => "LIST_SETTINGS",
        'NAME' => GetMessage('PROP_2'),
        "TYPE" => "LIST",
        'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProperty_LNS,
    );

    $arTemplateParameters['PROP_3'] = array(
        "PARENT" => "LIST_SETTINGS",
        'NAME' => GetMessage('PROP_3'),
        "TYPE" => "LIST",
        'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProperty_LNS,
    );

    $arTemplateParameters['PROP_4'] = array(
        "PARENT" => "LIST_SETTINGS",
        'NAME' => GetMessage('PROP_4'),
        "TYPE" => "LIST",
        'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProperty_LNS,
    );

    $arTemplateParameters['PROP_5'] = array(
        "PARENT" => "LIST_SETTINGS",
        'NAME' => GetMessage('PROP_5'),
        "TYPE" => "LIST",
        'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arProperty_LNS,
    );

    $arTemplateParameters['PROP_DOP_1'] = array(
        "PARENT" => "DETAIL_SETTINGS",
        'NAME' => GetMessage('PROP_DOP_1'),
        "TYPE" => "LIST",
        'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" =>  $arPropertyId,
    );


    $arTemplateParameters['PROP_DOP_2'] = array(
        "PARENT" => "DETAIL_SETTINGS",
        'NAME' => GetMessage('PROP_DOP_2'),
        "TYPE" => "LIST",
        'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" =>  $arPropertyId,
    );

    $arTemplateParameters['PROP_DOP_3'] = array(
        "PARENT" => "DETAIL_SETTINGS",
        'NAME' => GetMessage('PROP_DOP_3'),
        "TYPE" => "LIST",
        'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" =>  $arPropertyId,
    );

    $arTemplateParameters['PROP_DOP_3'] = array(
        "PARENT" => "DETAIL_SETTINGS",
        'NAME' => GetMessage('PROP_DOP_3'),
        "TYPE" => "LIST",
        'REFRESH' => isset($templateProperties['LIST_PROPERTY_CODE_MOBILE']) ? 'Y' : 'N',
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" =>  $arPropertyId,
    );

    $arTemplateParameters['PROP_ARTICUL'] = array(
        "PARENT" => "LIST_SETTINGS",
        'NAME' => GetMessage('K_PROP_ARTICUL'),
        "TYPE" => "LIST",
        "VALUES" => $arProperty,
    );


    $arSelPod = array("PODBORKI"=>GetMessage("IZ_PODBOROK"),"CATALOG"=>GetMessage("IZ_CATALOGA"));

    $arTemplateParameters['SECTION_PODBORKI_OK'] = array(
        "PARENT" => "BASE",
        'NAME' => GetMessage('SECTION_PODBORKI_OK'),
        "TYPE" => "LIST",
        'MULTIPLE' => 'Y',
        "VALUES" =>  $arSelPod,
    );

    $arTemplateParameters['IBLOCK_PODBORKI_TUPE'] = array(
            "PARENT" => "BASE",
            "NAME" => GetMessage("IBLOCK_PODBORKI_TUPE"),
            "TYPE" => "LIST",
            "VALUES" => $arIBlockType,
            "REFRESH" => "Y",
    );

    $arTemplateParameters['IBLOCK_PODBORKI'] = array(
        "PARENT" => "BASE",
        "NAME" => GetMessage("IBLOCK_PODBORKI"),
        "TYPE" => "LIST",
        "VALUES" => $arIBlock,
        "REFRESH" => "Y",
    );

}
?>