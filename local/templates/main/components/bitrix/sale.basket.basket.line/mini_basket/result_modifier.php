<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
use Bitrix\Main;
use Bitrix\Sale;

$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
$basketItems = $basket->getBasketItems();

$arProduct = array();

if($arResult['CATEGORIES']['READY'])
foreach ($arResult['CATEGORIES']['READY'] as $product){
    $arProduct[$product['ID']] = $product;
}

$i = 0;
if($arResult['CATEGORIES']['READY'])
foreach ($arResult['CATEGORIES']['READY'] as $keymas  => $valnas){
    $item = $basketItems[$keymas];
    $basketPropertyCollection = $item->getPropertyCollection();
    $collection = $basketPropertyCollection->getPropertyValues();
    $arProduct[$item->getId()]['PROP'] = $collection;
    if (!empty($collection['SET_ID'])){
        $i = $i+1;
        foreach ($arResult['CATEGORIES']['READY'] as $prop){
            if ($collection['SET_ID']['VALUE'] == $prop['PRODUCT_ID']){
                $arProduct[$prop['ID']]['SET_DOP'][] = $valnas['ID'];
                $arProduct[$prop['ID']]['PRICE'] =  $arProduct[$prop['ID']]['PRICE'] + $item->getPrice();
                $arProduct[$prop['ID']]['BASE_PRICE'] =  $arProduct[$prop['ID']]['BASE_PRICE'] + $item->getField("BASE_PRICE");
            }
        }
    }
}
$arResult['NUM_PRODUCTS'] = $arResult['NUM_PRODUCTS'] -$i;

$arResult['CATEGORIES']['READY'] = $arProduct;



