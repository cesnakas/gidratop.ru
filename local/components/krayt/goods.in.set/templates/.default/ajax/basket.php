<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
use Bitrix\Sale;
$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
$masTovar = json_decode($_POST['mastovar'],true);

$quantity = 1;

    if ($item = $basket->getExistsItem('catalog', $masTovar)) {

        $item->setField('QUANTITY', $item->getQuantity() + $masTovar);
    } else {
        $item = $basket->createItem('catalog', $masTovar);
        $item->setFields([
            'QUANTITY' => $quantity,
            'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
            'LID' => \Bitrix\Main\Context::getCurrent()->getSite(),
            'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
        ]);
    }

    $basket->save();
?>