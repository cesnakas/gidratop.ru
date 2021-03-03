<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("catalog");
use Bitrix\Sale;

$masTovar = json_decode($_POST['mastovar'],true);

$id_tovar = $_REQUEST['tovar_id'];
$SITE_ID = \Bitrix\Main\Context::getCurrent()->getSite();

$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), $SITE_ID);

if($masTovar['SITE_ID'])
{
  $SITE_ID = $masTovar['SITE_ID'];
}
$basketFields = [
    'LID' => $SITE_ID
];
//основной товар
$id_product = $masTovar['id_product'];
//обязательные товары комплекта
$arProductComplect = $masTovar['value'];
//дополнительные  товары
$arDopTovar = $masTovar['dop_values'];
$arError = [];
$ariIdsBasket = [];
if($id_product)
{
    $fields = [
        'PRODUCT_ID' => $id_product, // ID товара, обязательно
        'QUANTITY' => 1, // количество, обязательно
    ];

    if($arProductComplect)
    {
        $fields['PROPS'][] =  array(
            'NAME' =>  GetMessage("DOP_TOVAR_SET"),
            'CODE' => 'SET_DOP',
            'SORT' => 100,
            'VALUE' => implode("|",$arProductComplect),
        );
    }

    if ($masTovar['servis'] == "Y")
    {
        $fields['PROPS'][] = array(
            'NAME' => GetMessage("TREB_MONTAZH"),
            'CODE' => 'MONTAZH_YES',
            'SORT' => 100,
            'VALUE' => GetMessage("YES"),
        );
    }else{
        $fields['PROPS'][] =  array(
            'NAME' => GetMessage("TREB_MONTAZH"),
            'CODE' => 'MONTAZH_YES',
            'SORT' => 100,
            'VALUE' => GetMessage("NET"),
        );
    }

    $r = \Bitrix\Catalog\Product\Basket::addProduct($fields,$basketFields);
    if (!$r->isSuccess()) {
        $productData = \Bitrix\Iblock\ElementTable::getList(array(
            'select' =>['NAME'],
            'filter' => ['ID' => $productId]
        ))->fetch();
        $arError[] = $productData['NAME']." ".implode(' ',$r->getErrorMessages());
    }else{
        $id_basket_complect = $r->getData();
        if($id_basket_complect['ID'])
        {
            $ariIdsBasket[] = $id_basket_complect['ID'];
        }

        foreach ($arProductComplect as $key => $p_c)
        {

            $fields = [
                'PRODUCT_ID' => $p_c, // ID товара, обязательно
                'QUANTITY' => 1, // количество, обязательно
                'PROPS' => [
                    array(
                        'NAME' =>  GetMessage("IS_TOVAR_SET"),
                        'CODE' => 'SET_ID',
                        'SORT' => 100,
                        'VALUE' => $id_basket_complect['ID'],
                    )
                ],
            ];
            $r = \Bitrix\Catalog\Product\Basket::addProduct($fields);
            if (!$r->isSuccess()) {

                $productData = \Bitrix\Iblock\ElementTable::getList(array(
                    'select' =>['NAME'],
                    'filter' => ['ID' => $p_c]
                ))->fetch();
                $arError[] = $productData['NAME']." ".implode(' ',$r->getErrorMessages());
            }else{
                $id_basket_complect_d = $r->getData();
                if($id_basket_complect_d['ID'])
                {
                    $ariIdsBasket[] = $id_basket_complect_d['ID'];
                }
            }
        }
        if($arError)
        {
            $basket = \Bitrix\Sale\Basket::loadItemsForFUser(
                \Bitrix\Sale\Fuser::getId(),
                $SITE_ID
            );
            foreach ($ariIdsBasket as $idB)
            {
                $basket->getItemById($idB)->delete();
            }
            $basket->save();
        }
        if($arDopTovar)
        {
            foreach ($arDopTovar as $p_d)
            {
                $fields = [
                    'PRODUCT_ID' => $p_d, // ID товара, обязательно
                    'QUANTITY' => 1, // количество, обязательно
                ];
                $r = \Bitrix\Catalog\Product\Basket::addProduct($fields);
                if (!$r->isSuccess()) {

                    $productData = \Bitrix\Iblock\ElementTable::getList(array(
                        'select' =>['NAME'],
                        'filter' => ['ID' => $p_d]
                    ))->fetch();
                    $arError[] = $productData['NAME']." ".implode(' ',$r->getErrorMessages());
                }
            }
        }
    }

    if($arError)
    {
        echo \Bitrix\Main\Web\Json::encode([
            'error' => $arError
        ]);
    }
}else{
    echo \Bitrix\Main\Web\Json::encode([
        'error' => ['Ошибка! Не указан id товара.']
    ]);
}
if(!$arError)
{
    echo \Bitrix\Main\Web\Json::encode(['ok' => 1]);
}
?>