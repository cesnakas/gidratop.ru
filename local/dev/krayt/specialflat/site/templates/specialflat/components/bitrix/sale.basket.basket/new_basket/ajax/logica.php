<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
use Bitrix\Sale;
$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
$mas = json_decode($_POST['idmontazh'],true);
$idtovar = $mas['id_tovar'];
$basketItems = $basket->getBasketItems();

if($_POST['globaldel'] == "Y") {
    CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());
}

if($_POST['idmontazh']) {

    $basketItem = $basketItems[$idtovar];
    $basketPropertyCollection = $basketItem->getPropertyCollection();

    if ($mas['servis'] == "Y") {

        $basketPropertyCollection->setProperty(array(
            array(
                'NAME' => GetMessage("USTANOVKA"),
                'CODE' => 'MONTAZH_YES',
                'SORT' => 100,
                'VALUE' => GetMessage("YES")
            ),
        ));

        $test = $basketPropertyCollection->save();

    } else {

        $basketPropertyCollection->setProperty(array(
            array(
                'NAME' => GetMessage("USTANOVKA"),
                'CODE' => 'MONTAZH_YES',
                'SORT' => 100,
                'VALUE' => GetMessage("NOU")
            ),
        ));
        $basketPropertyCollection->save();

    }

}

$basket->save();