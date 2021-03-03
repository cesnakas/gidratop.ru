<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$url = explode ('?',$_SERVER['REQUEST_URI']);


if (!empty($arResult)):?>
<section class="goods_block">
    <h3>
        <?=GetMessage("GOODS_TITLE");?> <?=$arResult['SECTION_NAME'];?>
    </h3>
    <div class="goods-carousel owl-carousel">
        <? 
		if($arResult["SETS"])
		foreach ($arResult["SETS"] as $arItems):?>
            <div class="goods_box">
                <div class="goods_box-wrp clearfix">
                    <div class="goods_img">
                        <?if(empty($arItems['PREVIEW_PICTURE'])){
                            $img = $templateFolder."/images/no_photo.png";
                        }
                        else{
                            $img = CFile::ResizeImageGet(
                                $arItems['PREVIEW_PICTURE'],
                                array('width' => 360, 'height' => 360),
                                BX_RESIZE_IMAGE_PROPORTIONAL
                            );
                            $img = $img['src'];
                        }?>
                        <div class="goods_img-box">
                            <div class="img" style="background-image: url(<?=$img;?>);"></div>
                        </div>
                    </div>
                    <div class="goods_data">
                        <div class="goods_title_box">
                            <span><?=GetMessage("GOODS_COMPLEKT");?>:</span>
                            <a href="<?=$arItems['DETAIL_PAGE_URL'];?>"><?=$arItems['NAME'];?></a>
                            <div class="artikul_box">
                                <div id="articul_name">
                                    <span><?=GetMessage("ARTICUL");?> </span>
                                    <span id="articul_value"> <?=$arItems['PROPERTY_COD_TOVARA_VALUE']?></span>
                                </div>
                            </div>
                        </div>
                        <div class="goods_pay_box">
                            <div class="goods_prise">
                                <? if ($arItems['DISCOUNT_PRICE'] < $arItems['PRICE']['PRICE']):?>
                                    <div class="old_prise">
                                        <span><?=number_format($arItems['PRICE']['PRICE'],0, ',', ' ');?></span>
                                        <span class="rubl">i</span>
                                    </div>
                                <?endif;?>
                                <div class="osn_price">
                                    <span><?=number_format($arItems['DISCOUNT_PRICE'],0, ',', ' ');?></span>
                                    <span class="rubl">i</span>
                                </div>
                            </div>
                            <div class="box-buy-btn">
                                <button class="goods_in_basket" data-id="in-basket" data-idset="<?=$arItems['ID'];?>">
                                    <div class="buy-btn-in">
                                        <span><?=GetMessage("ADD_TO_CART");?></span>
                                    </div>
                                </button>
                                <div class="BasketEmodal">
                                    <div class="emodal-data" id="in-basket"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="goods_set_block">
                        <div class="goods_set_title">
                            <?=GetMessage("SET_TITLE");?>:
                        </div>
                        <div class="goods_set_box">
                            <?
                            if($arItems['PRODUCT'])
                            foreach ($arItems['PRODUCT'] as $set):?>
                                <div class="set_box_tr">
                                    <div class="set_name">
                                        <?if (!empty($set['NO_CATALOG']) || $set['ID'] ==$arParams['ID_GOODS'] || $set['DETAIL_PAGE_URL'] == $url[0]){?>
                                            <span><?=$set['NAME'];?></span>
                                        <?}else{?>
                                            <a href="<?=$set['DETAIL_PAGE_URL'];?>"><?=$set['NAME'];?></a>
                                        <?}?>
                                    </div>
                                    <div class="set_prise">
                                        <? if ($set['DISCOUNT_PRICE'] < $set['PRICE']['PRICE']):?>
                                            <div class="old_prise"> <?=number_format($set['PRICE']['PRICE'],0, ',', ' ');?><span class="rubl">i</span></div>
                                        <?endif;?>
                                        <div class="osn_price"><?=number_format($set['DISCOUNT_PRICE'],0, ',', ' ');?><span class="rubl">i</span></div>
                                    </div>
                                </div>
                            <?endforeach;?>
                        </div>
                    </div>
                    <div class="goods_text"></div>
                </div>
            </div>
        <?endforeach;?>
    </div>
</section>
<?endif;?>
