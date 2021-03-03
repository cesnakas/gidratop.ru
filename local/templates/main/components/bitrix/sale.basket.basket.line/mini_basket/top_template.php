<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>

<div class="bx-hdr-profile">
    <ico class="gt-ico-cart"></ico>

    <span class="bx-basket-block">
        <?=\Bitrix\Main\Localization\Loc::getMessage('TSB1_CART')?>
        <? if (!$compositeStub) {
            echo $arResult['NUM_PRODUCTS'];
        } ?>
    </span>

</div>
