<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$this->IncludeLangFile('template.php');

$cartId = $arParams['cartId'];

require(realpath(dirname(__FILE__)).'/top_template.php');

if ($arParams["SHOW_PRODUCTS"] == "Y" && $arResult['NUM_PRODUCTS'] > 0)
{
?>

        <div data-role="basket-item-list" class="bx-basket-item-list">

            <div id="<?=$cartId?>products" class="bx-basket-item-list-container">
                <?foreach ($arResult["CATEGORIES"] as $category => $items):
                    if (empty($items))
                        continue;
                    ?>
                    <?foreach ($items as $v):?>
                    <?if (!empty($v["PROP"]['SET_ID']))
                    continue;
                    ?>
                    <div class="bx-basket-item-list-item">
                        <div class="bx-basket-item-list-item-img">
                            <?if ($arParams["SHOW_IMAGE"] == "Y" && $v["PICTURE_SRC"]):?>
                                <?if($v["DETAIL_PAGE_URL"]):?>
                                    <a href="<?=$v["DETAIL_PAGE_URL"]?>"><img src="<?=$v["PICTURE_SRC"]?>" alt="<?=$v["NAME"]?>"></a>
                                <?else:?>
                                    <img src="<?=$v["PICTURE_SRC"]?>" alt="<?=$v["NAME"]?>" />
                                <?endif?>
                            <?endif?>
                        </div>
                        <div class="bx-basket-item-list-item-name">
                            <?if ($v["DETAIL_PAGE_URL"]):?>
                                <a href="<?=$v["DETAIL_PAGE_URL"]?>"><?=$v["NAME"]?></a>
                            <?else:?>
                                <?=$v["NAME"]?>
                            <?endif?>
                        </div>
                        <?if (true):/*$category != "SUBSCRIBE") TODO */?>
                            <div class="bx-basket-item-list-item-price-block">
                                <?if ($arParams["SHOW_PRICE"] == "Y"):?>
                                    <div class="bx-basket-item-list-item-price"><strong><?=$v["PRICE"]?><span class="rubl">i</span></strong></div>
                                    <?if ($v["PRICE"] != $v["BASE_PRICE"]):?>
                                        <div class="bx-basket-item-list-item-price-old"><?=$v["BASE_PRICE"]?><span class="rubl">i</span></div>
                                    <?endif?>
                                <?endif?>
                                <?if ($arParams["SHOW_SUMMARY"] == "Y"):?>
                                    <div class="bx-basket-item-list-item-price-summ">
                                        <strong><?=$v["QUANTITY"]?></strong> <?=$v["MEASURE_NAME"]?> <?=GetMessage("TSB1_SUM")?>
                                        <strong><?=$v["SUM"]?></strong>
                                    </div>
                                <?endif?>
                            </div>
                        <?endif?>
                        <?if (!empty($v['PROP']['SET_DOP'])){?>

                            <div class="bx-basket-item-list-item-remove"
                               onclick="<?=$cartId?>.removeItemFromCart(<?=$v['ID']?>);<?foreach ($v['SET_DOP'] as $val){?><?=$cartId?>.removeItemFromCart(<?=$val?>);<?}?>"
                               title="<?=GetMessage("TSB1_DELETE")?>"></div>
                        <?}else{?>
                            <div class="bx-basket-item-list-item-remove" onclick="<?=$cartId?>.removeItemFromCart(<?=$v['ID']?>)" title="<?=GetMessage("TSB1_DELETE")?>"></div>

                        <?}?>
                    </div>
                <?endforeach?>
                <?endforeach?>
            </div>

            <?if ($arParams["POSITION_FIXED"] == "Y"):?>
                <div id="<?=$cartId?>status" class="bx-basket-item-list-action" onclick="<?=$cartId?>.toggleOpenCloseCart()"><?=GetMessage("TSB1_COLLAPSE")?></div>
            <?endif?>

            <?if ($arParams["PATH_TO_ORDER"] && $arResult["CATEGORIES"]["READY"]):?>
                <div class="bx-basket-item-list-button-container">
                    <div class="prise_box"><?=GetMessage("ITOG")?>: <span class="bold"><?=$arResult['TOTAL_PRICE'];?></span></div>
                    <a href="<?=$arParams["PATH_TO_BASKET"]?>" class="btn ">
                        <span><?=GetMessage("TSB1_2ORDER")?></span>
                    </a>
                </div>
            <?endif?>
        </div>


	<script>
		BX.ready(function(){
			<?=$cartId?>.fixCart();
		});
	</script>
<?
}
