<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var string $componentPath
 * @var string $componentName
 * @var array $arCurrentValues
 */

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Web\Json;

if (!Loader::includeModule('iblock'))
	return;

$boolCatalog = Loader::includeModule('catalog');
CBitrixComponent::includeComponentClass($componentName);

$arTemplateParameters['PROP_1'] = array(
    'NAME' => GetMessage('PROP_1'),
    'TYPE' => 'LIST',
    'ADDITIONAL_VALUES' => "Y",
);

$arTemplateParameters['PROP_2'] = array(
    'NAME' => GetMessage('PROP_2'),
    'TYPE' => 'LIST',
    'ADDITIONAL_VALUES' => "Y",
);

$arTemplateParameters['PROP_3'] = array(
    'NAME' => GetMessage('PROP_3'),
    'TYPE' => 'LIST',
    'ADDITIONAL_VALUES' => "Y",
);

$arTemplateParameters['PROP_4'] = array(
    'NAME' => GetMessage('PROP_4'),
    'TYPE' => 'LIST',
    'ADDITIONAL_VALUES' => "Y",
);

$arTemplateParameters['PROP_5'] = array(
    'NAME' => GetMessage('PROP_5'),
    'TYPE' => 'LIST',
    'ADDITIONAL_VALUES' => "Y",
);

$arTemplateParameters['SKU_PROP'] = array(
    'NAME' => GetMessage('PROP_5'),
    'TYPE' => 'LIST',
    'ADDITIONAL_VALUES' => "Y",
);