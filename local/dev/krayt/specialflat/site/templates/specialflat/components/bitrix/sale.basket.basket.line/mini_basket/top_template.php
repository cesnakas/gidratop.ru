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

        <div class="bx-basket-block"><?
            if (!$compositeStub)
            {
                echo $arResult['NUM_PRODUCTS'];
            }?>
        </div>

</div>
