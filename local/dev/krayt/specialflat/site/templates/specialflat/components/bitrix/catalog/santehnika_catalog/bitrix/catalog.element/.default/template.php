<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => array(
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
		'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
		'JS_OFFERS' => $arResult['JS_OFFERS']
	)
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
	'STICKER_ID' => $mainId.'_sticker',
	'BIG_SLIDER_ID' => $mainId.'_big_slider',
	'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId.'_slider_cont',
	'OLD_PRICE_ID' => $mainId.'_old_price',
	'PRICE_ID' => $mainId.'_price',
	'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
	'PRICE_TOTAL' => $mainId.'_price_total',
	'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
	'QUANTITY_ID' => $mainId.'_quantity',
	'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
	'QUANTITY_UP_ID' => $mainId.'_quant_up',
	'QUANTITY_MEASURE' => $mainId.'_quant_measure',
	'QUANTITY_LIMIT' => $mainId.'_quant_limit',
	'BUY_LINK' => $mainId.'_buy_link',
	'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
	'COMPARE_LINK' => $mainId.'_compare_link',
	'TREE_ID' => $mainId.'_skudiv',
	'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
	'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
	'OFFER_GROUP' => $mainId.'_set_group_',
	'BASKET_PROP_DIV' => $mainId.'_basket_prop',
	'SUBSCRIBE_LINK' => $mainId.'_subscribe',
	'TABS_ID' => $mainId.'_tabs',
	'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
	//'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
	//'TABS_PANEL_ID' => $mainId.'_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers)
{
	$actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']])
		? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]
		: reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['MORE_PHOTO_COUNT'] > 1)
		{
			$showSliderControls = true;
			break;
		}
	}
}
else
{
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['CATALOG_SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}
//PR($price);

$valuta=preg_replace('/\d/','',$price['PRINT_PRICE']);

?>

<div class="bx-catalog-element" id="<?=$itemIds['ID']?>"
     itemscope itemtype="http://schema.org/Product" xmlns="http://www.w3.org/1999/html">
        <?if (empty($arResult['OFFERS'])){;?>
            <div class="hiden data_box oktual_prise_product " data-prise="<?=$arResult["PRICES"]["BASE"]["DISCOUNT_VALUE"]?>" data-id="<?=$arResult['ID'];?>"  data-oldprise="<?=$arResult["PRICES"]["BASE"]["VALUE"];?>"></div>
        <?}else{?>
            <?$pos_sku = end($arResult['OFFERS']);?>
            <div class="hiden data_box oktual_prise_product "  data-prise="<?=$pos_sku["PRICES"]["BASE"]["DISCOUNT_VALUE"]?>" data-id="<?=$pos_sku['ID'];?>"  data-oldprise="<?=$pos_sku["PRICES"]["BASE"]["VALUE"];?>"></div>
        <?}?>
        <?if ($arParams['DISPLAY_NAME'] === 'Y')
        {
            ?>
            <div class="bx-title-line">
                <h1 class="bx-title"><?=$name?></h1>
                <div class="btns">
                    <div data-cookieid="<?=$arResult['ID']?>" class="bookmark icon">
                        <div class="icon not-active"></div>
                        <div class="icon active"></div>
                        <div class="hint"><?=GetMessage("DOBAV_IN_FAVORITE");?></div>
                    </div>
                    <div class="compare icon">
                        <div class="hint"><?=GetMessage("DOBAV_IN_SRAV");?></div>
                        <? if ($arParams['DISPLAY_COMPARE']):?>
                            <span id="<?=$itemIds['COMPARE_LINK']?>" >
                                <input type="checkbox" data-id="<?=$arResult['ID']?>" data-entity="compare-checkbox" id="compare">
                                <label for="compare">
                                    <div class="icon not-active"></div>
                                    <div class="icon active"></div>
                                </label>
                            </span>
                        <?endif;?>
                    </div>
                </div>
            </div>
            <?
        }
        ?>
        <div class="product-item-content">
            <div class="product-item-left">
                <div class="product-item-detail-slider-container" id="<?=$itemIds['BIG_SLIDER_ID']?>">
                        <div class="product-item-detail-slider-container-relative">
                        <span class="product-item-detail-slider-close" data-entity="close-popup"></span>

                        <div class="product-item-detail-slider-block
                        <?=($arParams['IMAGE_RESOLUTION'] === '1by1' ? 'product-item-detail-slider-block-square' : '')?>"
                             data-entity="images-slider-block">
                            <div class="lable_detail_box">
                                <?
                                if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y')
                                {

                                    if ($haveOffers)
                                    {
                                        ?>
                                        <div class="product-item-label-discount_detail" id="<?=$itemIds['DISCOUNT_PERCENT_ID']?>" <?if ($price['PERCENT'] == 0) {echo 'style ="display:none;';}?>
                                             title="<?=-$price['PERCENT']?>%">
                                            <span><?=-$price['PERCENT']?></span>%
                                        </div>
                                        <?
                                    }
                                    else
                                    {
                                        if ($price['DISCOUNT'] > 0)
                                        {
                                            ?>
                                            <div class="product-item-label-discount_detail" id="<?=$itemIds['DISCOUNT_PERCENT_ID']?>"
                                                 title="<?=-$price['PERCENT']?>%">
                                                <?=-$price['PERCENT']?>%
                                            </div>
                                            <?
                                        }
                                    }
                                }
                                if ($arResult['LABEL'] && !empty($arResult['LABEL_ARRAY_VALUE']))
                                {
                                    foreach ($arResult['LABEL_ARRAY_VALUE'] as $code => $value)
                                    {
                                        ?>
                                        <div class="product_deteil_label <?=mb_convert_case($code,MB_CASE_LOWER )?>">
                                            <span title="<?=$value?>"><?=$value?></span>
                                        </div>
                                        <?
                                    }
                                }
                                ?>
                            </div>
                            <div class="product-item-detail-slider-images-container" data-entity="images-container">
                                <?
                                if (!empty($actualItem['MORE_PHOTO']))
                                {
                                    foreach ($actualItem['MORE_PHOTO'] as $key => $photo)
                                    {
                                        ?>
                                        <div class="product-item-detail-slider-image<?=($key == 0 ? ' active' : '')?>" data-entity="image" data-id="<?=$photo['ID']?>">
                                            <div class="slider-image-box">
                                                <img src="<?=$photo['SRC']?>" alt="<?=$alt?>" title="<?=$title?>"<?=($key == 0 ? ' itemprop="image"' : '')?>>
                                            </div>
                                        </div>
                                        <?
                                    }
                                }

                                if ($arParams['SLIDER_PROGRESS'] === 'Y')
                                {
                                    ?>
                                    <div class="product-item-detail-slider-progress-bar" data-entity="slider-progress-bar" style="width: 0;"></div>
                                    <?
                                }
                                ?>
                            </div>
                        </div>
                        <?
                        if ($showSliderControls)
                        {
                            if ($haveOffers)
                            {
                                foreach ($arResult['OFFERS'] as $keyOffer => $offer)
                                {
                                    if (!isset($offer['MORE_PHOTO_COUNT']) || $offer['MORE_PHOTO_COUNT'] <= 0)
                                        continue;

                                    $strVisible = $arResult['OFFERS_SELECTED'] == $keyOffer ? '' : 'none';
                                    ?>
                                    <div class="product-item-detail-slider-controls-block" id="<?=$itemIds['SLIDER_CONT_OF_ID'].$offer['ID']?>" style="display: <?=$strVisible?>;">
                                        <?
                                        foreach ($offer['MORE_PHOTO'] as $keyPhoto => $photo)
                                        {
                                            ?>
                                            <div class="product-item-detail-slider-controls-image<?=($keyPhoto == 0 ? ' active' : '')?>"
                                                 data-entity="slider-control" data-value="<?=$offer['ID'].'_'.$photo['ID']?>">
                                                <div class="slider-image-box">
                                                    <img src="<?=$photo['SRC']?>">
                                                </div>
                                            </div>
                                            <?
                                        }
                                        ?>
                                    </div>
                                    <?
                                }
                            }
                            else
                            {
                                ?>
                                <div class="product-item-detail-slider-controls-block" id="<?=$itemIds['SLIDER_CONT_ID']?>">
                                    <div class="product-item-detail-slider">
                                        <?
                                        if (!empty($actualItem['MORE_PHOTO']))
                                        {
                                            foreach ($actualItem['MORE_PHOTO'] as $key => $photo)
                                            {
                                                ?>
                                                <div class="product-item-detail-slider-controls-image<?=($key == 0 ? ' active' : '')?>"
                                                     data-entity="slider-control" data-value="<?=$photo['ID']?>">
                                                    <div class="slider-image-box">
                                                        <img src="<?=$photo['SRC']?>">
                                                    </div>
                                                </div>
                                                <?
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="product-item-detail-data mobile">
                    <div class="product-item-detail-data-left">
                        <?
                        foreach ($arParams['PRODUCT_INFO_BLOCK_ORDER'] as $blockName)
                        {
                            switch ($blockName)
                            {
                                case 'props':?>
                                    <div class="top_prop_block">
                                        <?foreach ($arResult['TOP_PROP'] as $prop):?>
                                            <?if(!empty($prop['VALUE'])):?>
                                                <div class="top_prop_box">
                                                    <span class="top_prop_box_name"><?=$prop['NAME']?></span>
                                                    <span class="top_prop_box_value"><?=$prop['VALUE']?></span>
                                                </div>
                                            <?endif?>
                                        <?endforeach;?>
                                    </div>

                                    <?break;

                                case 'sku':
                                    if ($haveOffers && !empty($arResult['OFFERS_PROP'])){?>
                                        <div class="top_prop_block_sku" id="sku_block_mobile">
                                            <?$masCodePropSku = array();
                                            $i=0;
                                            foreach ($arResult['SKU_PROPS'] as $code_prop =>$skuProperty):?>
                                                <?$masCodePropSku[] =$code_prop;?>
                                                <?foreach ($arResult['SKU_PROP_ID'] as $code_prop_id):
                                                    if($code_prop_id ==$code_prop):?>
                                                        <div class="top_prop_blox_sku">
                                                            <div class="title_prop_sku"><?=$skuProperty['NAME'];?>:</div>
                                                            <?if($skuProperty['PROPERTY_TYPE'] == "S" && $skuProperty['USER_TYPE'] == "directory"){
                                                                $class_hiden = "style='display:none'";
                                                                foreach ($skuProperty['VALUES'] as $skuProp){?>
                                                                    <? if ($skuProp['ID'] != 0):?>
                                                                        <div class="pic_box <? if ($i == 0){echo "click_ok";}?>" style="background: url(<?=$skuProp['PICT']['SRC'];?>)" data-val="<?=$skuProp['XML_ID'];?>" data-select="<?=$i;?>"></div>
                                                                    <?endif?>
                                                                <?}
                                                                ?>
                                                            <?}else{
                                                                $class_hiden = "class='select'";
                                                            }?>
                                                            <select <?=$class_hiden;?> data-select="<?=$i;?>" name="sku_prop_top">
                                                                <?if($i!=0){echo " <option value='' disabled selected >".GetMessage("VIBERETE_IZ_SPISKA")."</option>";}?>
                                                                <?foreach ($skuProperty['VALUES'] as $id_prop => $skuprop):?>
                                                                    <? if ($id_prop != 0):?>
                                                                        <?if (empty($skuprop['XML_ID'])){?>
                                                                            <option  <?if($i!=0){echo "disabled='disabled'";}?>  value="<?=$skuprop['NAME']?>"><?=$skuprop['NAME']?></option>
                                                                        <?}else{?>
                                                                            <option  <?if($i!=0){echo "disabled='disabled'";}?>  value="<?=$skuprop['XML_ID']?>"><?=$skuprop['NAME']?></option>
                                                                        <?}?>
                                                                    <?endif?>
                                                                <?endforeach;?>
                                                            </select>
                                                        </div>
                                                        <? $i++;?>
                                                    <?endif;?>
                                                <?endforeach;?>
                                            <?endforeach;?>
                                            <div class="hiden">
                                                <?foreach ($arResult['OFFERS'] as $sku):?>
                                                    <span class="hiden"
                                                          data-prise="<?=$sku['PRICES']['BASE']['DISCOUNT_VALUE_NOVAT'];?>"
                                                          data-oldprise="<?=$sku["PRICES"]["BASE"]["VALUE"];?>"
                                                          data-skuid="<?=$sku['ID']?>"
                                                          data-sku_img ="
                                                            <?if(empty($sku['DETAIL_PICTURE']['SRC'])){
                                                              echo $arResult['DETAIL_PICTURE']["SRC"];
                                                          }else{
                                                              echo $sku['DETAIL_PICTURE']['SRC'];
                                                          }?>"
                                                          data-sku-prop ="
                                                          <?foreach ($sku['PROPERTIES'] as $key => $valsku){
                                                              foreach ($masCodePropSku as $val){
                                                                  if($val == $key){
                                                                      echo $valsku['VALUE'];
                                                                  }
                                                              }
                                                          }?>
                                                          "
                                                          data-discont="<?=$sku['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'];?>"
                                                        <?$i = 0;?>
                                                        <?foreach ($sku['PROPERTIES'] as $key => $valsku){
                                                            foreach ($masCodePropSku as $val){
                                                                if($val == $key){?>
                                                                    data-sku<?=$i;?> = "<?=$valsku['VALUE'];?>"
                                                                    <?$i++;?>
                                                                <?}
                                                            }
                                                        }?>
                                                    >
                                                    </span>
                                                <?endforeach?>
                                            </div>
                                        </div>
                                    <?}?>

                                    <?break;

                            }
                        }
                        ?>

                    </div>
                    <div class="product-item-detail-data-right">
                        <div class="product-item-detail-pay-block">
                            <?
                            foreach ($arParams['PRODUCT_PAY_BLOCK_ORDER'] as $blockName)
                            {
                                switch ($blockName)
                                {
                                    case 'price':
                                        ?>
                                        <div class="product-item-detail-info-container product-item-detail-price">
                                            <div class="product-item-detail-price-current" id="<?=$itemIds['PRICE_ID']?>">
                                                <span class="prise_nap"><?=CCurrencyLang::CurrencyFormat($price['PRICE'],$price['CURRENCY']);?></span>
                                            </div>
                                        <?
                                        if ($arParams['SHOW_OLD_PRICE'] === 'Y')
                                        {
                                            ?>
                                            <div class="product-item-detail-price-old" id="<?=$itemIds['OLD_PRICE_ID']?>"
                                                 style="display: <?=($showDiscount ? '' : 'none')?>;">
                                                <span class="old_prise_nap"><?=CCurrencyLang::CurrencyFormat($price['BASE_PRICE'],$price['CURRENCY']);?></span>
                                            </div>
                                            <?
                                        }
                                        ?>
                                        </div>
                                        <?
                                        break;

                                    case 'priceRanges':
                                        if ($arParams['USE_PRICE_COUNT'])
                                        {
                                            $showRanges = !$haveOffers && count($actualItem['ITEM_QUANTITY_RANGES']) > 1;
                                            $useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';
                                            ?>
                                            <div class="product-item-detail-info-container"
                                                <?=$showRanges ? '' : 'style="display: none;"'?>
                                                 data-entity="price-ranges-block">
                                                <div class="product-item-detail-info-container-title">
                                                    <?=$arParams['MESS_PRICE_RANGES_TITLE']?>
                                                    <span data-entity="price-ranges-ratio-header">
                                                        (<?=(Loc::getMessage(
                                                            'CT_BCE_CATALOG_RATIO_PRICE',
                                                            array('#RATIO#' => ($useRatio ? $measureRatio : '1').' '.$actualItem['ITEM_MEASURE']['TITLE'])
                                                        ))?>)
                                                    </span>
                                                </div>
                                                <dl class="product-item-detail-properties" data-entity="price-ranges-body">
                                                    <?
                                                    if ($showRanges)
                                                    {
                                                        foreach ($actualItem['ITEM_QUANTITY_RANGES'] as $range)
                                                        {
                                                            if ($range['HASH'] !== 'ZERO-INF')
                                                            {
                                                                $itemPrice = false;

                                                                foreach ($arResult['ITEM_PRICES'] as $itemPrice)
                                                                {
                                                                    if ($itemPrice['QUANTITY_HASH'] === $range['HASH'])
                                                                    {
                                                                        break;
                                                                    }
                                                                }

                                                                if ($itemPrice)
                                                                {
                                                                    ?>
                                                                    <dt>
                                                                        <?
                                                                        echo Loc::getMessage(
                                                                                'CT_BCE_CATALOG_RANGE_FROM',
                                                                                array('#FROM#' => $range['SORT_FROM'].' '.$actualItem['ITEM_MEASURE']['TITLE'])
                                                                            ).' ';

                                                                        if (is_infinite($range['SORT_TO']))
                                                                        {
                                                                            echo Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
                                                                        }
                                                                        else
                                                                        {
                                                                            echo Loc::getMessage(
                                                                                'CT_BCE_CATALOG_RANGE_TO',
                                                                                array('#TO#' => $range['SORT_TO'].' '.$actualItem['ITEM_MEASURE']['TITLE'])
                                                                            );
                                                                        }
                                                                        ?>
                                                                    </dt>
                                                                    <dd><?=($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE'])?></dd>
                                                                    <?
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </dl>
                                            </div>
                                            <?
                                            unset($showRanges, $useRatio, $itemPrice, $range);
                                        }

                                        break;

                                    case 'quantityLimit':
                                        if ($arParams['SHOW_MAX_QUANTITY'] !== 'N')
                                        {
                                            if ($haveOffers)
                                            {
                                                ?>
                                                <div class="product-item-detail-info-container" id="<?=$itemIds['QUANTITY_LIMIT']?>" style="display: none;">
                                                    <div class="product-item-detail-info-container-title">
                                                        <?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
                                                        <span class="product-item-quantity" data-entity="quantity-limit-value"></span>
                                                    </div>
                                                </div>
                                                <?
                                            }
                                            else
                                            {
                                                if (
                                                    $measureRatio
                                                    && (float)$actualItem['CATALOG_QUANTITY'] > 0
                                                    && $actualItem['CATALOG_QUANTITY_TRACE'] === 'Y'
                                                    && $actualItem['CATALOG_CAN_BUY_ZERO'] === 'N'
                                                )
                                                {
                                                    ?>
                                                    <div class="product-item-detail-info-container" id="<?=$itemIds['QUANTITY_LIMIT']?>">
                                                        <div class="product-item-detail-info-container-title">
                                                            <?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
                                                            <span class="product-item-quantity" data-entity="quantity-limit-value">
                                                                <?
                                                                if ($arParams['SHOW_MAX_QUANTITY'] === 'M')
                                                                {
                                                                    if ((float)$actualItem['CATALOG_QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR'])
                                                                    {
                                                                        echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
                                                                    }
                                                                    else
                                                                    {
                                                                        echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    echo $actualItem['CATALOG_QUANTITY'].' '.$actualItem['ITEM_MEASURE']['TITLE'];
                                                                }
                                                                ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <?
                                                }
                                            }
                                        }

                                        break;

                                    case 'buttons':?>

                                       <? if($arResult['CATALOG_QUANTITY_TRACE'] == "Y"):
                                        if($arResult['CATALOG_CAN_BUY_ZERO'] == 'Y'):
                                        ?>
                                        <div class="box-buy-btn">
                                            <a class="buy-btn btn" item-id="<?=$arResult['ID']?>" data-id="buy-btn1" href="javascript:void(0);">
                                                <div class="buy-btn-in">
                                                    <i class="basket-btn"></i><span><?=$arParams['MESS_BTN_ADD_TO_BASKET']?></span>
                                                </div>
                                            </a>
                                            <div class="BasketEmodal">
                                                <div class="emodal-data" id="buy-btn1"></div>
                                            </div>
                                        </div>
                                        <?else:?>
                                        <?if($arResult['CATALOG_QUANTITY'] > 0):?>
                                            <div class="box-buy-btn">
                                                <a class="buy-btn btn" item-id="<?=$arResult['ID']?>" data-id="buy-btn1" href="javascript:void(0);">
                                                    <div class="buy-btn-in">
                                                        <i class="basket-btn"></i><span><?=$arParams['MESS_BTN_ADD_TO_BASKET']?></span>
                                                    </div>
                                                </a>
                                                <div class="BasketEmodal">
                                                    <div class="emodal-data" id="buy-btn1"></div>
                                                </div>
                                            </div>
                                        <?else:?>
                                                <div class="box-buy-btn">
                                                    <div class="not-quantity"><?=$arParams['MESS_NOT_AVAILABLE']?></div>
                                                </div>
                                        <?endif;?>
                                        <?endif;?>
                                        <?else:?>
                                        <div class="box-buy-btn">
                                            <a class="buy-btn btn" item-id="<?=$arResult['ID']?>" data-id="buy-btn1" href="javascript:void(0);">
                                                <div class="buy-btn-in">
                                                    <i class="basket-btn"></i><span><?=$arParams['MESS_BTN_ADD_TO_BASKET']?></span>
                                                </div>
                                            </a>
                                            <div class="BasketEmodal">
                                                <div class="emodal-data" id="buy-btn1"></div>
                                            </div>
                                        </div>
                                        <?endif;?>

                                        <?
                                        break;
                                }
                            }
                            ?>

                            <?if ($arResult['SHARE_TIME']['UNIX'] > 0):?>
                                <div class="discount-timer">
                                    <span class="text"><?=GetMessage("DISCOUNT_TIMER_MOBILE")?></span>
                                    <div class="timer"><span class="number"><?=sprintf("%02d",$arResult['SHARE_TIME']['DEY']);?></span> <?=GetMessage("DEY");?> <span class="number"><?=sprintf("%02d",$arResult['SHARE_TIME']['HOURS']);?></span>  <?=GetMessage("CHAS");?></div>
                                </div>
                            <?endif;?>
                        </div>

                        <?if($arResult['PROPERTIES']['COL_TOVAR_OGR']['VALUE_XML_ID'] == "Y"):?>
                            <div class="quantity-attention">
                                <span><?=GetMessage("QUANTITY_ATTENTION_TEXT")?></span>
                            </div>
                        <?endif;?>
                    </div>

                </div>
                <?if (!empty( $arResult['PROPERTIES']['PREDUPREZHDENIE']["VALUE"])):
                    $pred = $arResult['PROPERTIES']['PREDUPREZHDENIE']["VALUE"];
                    ?>
                    <div class="complect_attention">
                        <div class="complect_attention-box" style="border:<?=$pred['UF_COLOR'];?> 1px solid">
                            <div class="img_box" style="background: url(<?=$pred['UF_FILE'];?>) no-repeat;  background-size: contain;  background-position: center"></div>
                            <div class="content_box">
                                <span><?=$pred['UF_DESCRIPTION'];?></span>
                                <?=$pred['UF_FULL_DESCRIPTION'];?>
                            </div>
                        </div>
                    </div>
                <?endif;?>
            </div>
            <div class="product-item-right">
                <div class="product-item-detail-data mobile_none">

                    <div class="str">
                        <div class="product-item-detail-data-right">
                            <div class="product-item-detail-pay-block">
                                <div class="not_sale">
                                <?
                                foreach ($arParams['PRODUCT_PAY_BLOCK_ORDER'] as $blockName)
                                {

                                    switch ($blockName)
                                    {
                                        case 'price':
                                            ?>
                                            <div class="product-item-detail-info-container product-item-detail-price">

                                                <div class="product-item-detail-price-current" id="<?=$itemIds['PRICE_ID']?>">
                                                    <span class="prise_nap"><?=CCurrencyLang::CurrencyFormat($price['PRICE'],$price['CURRENCY']);?></span>
                                                </div>
                                                <?
                                                if ($arParams['SHOW_OLD_PRICE'] === 'Y')
                                                {
                                                    ?>
                                                    <div class="product-item-detail-price-old" id="<?=$itemIds['OLD_PRICE_ID']?>"
                                                         style="display: <?=($showDiscount ? '' : 'none')?>;">
                                                        <span class="old_prise_nap"><?=CCurrencyLang::CurrencyFormat($price['BASE_PRICE'],$price['CURRENCY']);?></span>
                                                    </div>
                                                    <?
                                                }
                                                ?>
                                            </div>
                                            <?
                                            break;

                                        case 'priceRanges':
                                            if ($arParams['USE_PRICE_COUNT'])
                                            {
                                                $showRanges = !$haveOffers && count($actualItem['ITEM_QUANTITY_RANGES']) > 1;
                                                $useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';
                                                ?>
                                                <div class="product-item-detail-info-container"
                                                    <?=$showRanges ? '' : 'style="display: none;"'?>
                                                     data-entity="price-ranges-block">
                                                    <div class="product-item-detail-info-container-title">
                                                        <?=$arParams['MESS_PRICE_RANGES_TITLE']?>
                                                        <span data-entity="price-ranges-ratio-header">
                                                        (<?=(Loc::getMessage(
                                                                'CT_BCE_CATALOG_RATIO_PRICE',
                                                                array('#RATIO#' => ($useRatio ? $measureRatio : '1').' '.$actualItem['ITEM_MEASURE']['TITLE'])
                                                            ))?>)
                                                    </span>
                                                    </div>
                                                    <dl class="product-item-detail-properties" data-entity="price-ranges-body">
                                                        <?
                                                        if ($showRanges)
                                                        {
                                                            foreach ($actualItem['ITEM_QUANTITY_RANGES'] as $range)
                                                            {
                                                                if ($range['HASH'] !== 'ZERO-INF')
                                                                {
                                                                    $itemPrice = false;

                                                                    foreach ($arResult['ITEM_PRICES'] as $itemPrice)
                                                                    {
                                                                        if ($itemPrice['QUANTITY_HASH'] === $range['HASH'])
                                                                        {
                                                                            break;
                                                                        }
                                                                    }

                                                                    if ($itemPrice)
                                                                    {
                                                                        ?>
                                                                        <dt>
                                                                            <?
                                                                            echo Loc::getMessage(
                                                                                    'CT_BCE_CATALOG_RANGE_FROM',
                                                                                    array('#FROM#' => $range['SORT_FROM'].' '.$actualItem['ITEM_MEASURE']['TITLE'])
                                                                                ).' ';

                                                                            if (is_infinite($range['SORT_TO']))
                                                                            {
                                                                                echo Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
                                                                            }
                                                                            else
                                                                            {
                                                                                echo Loc::getMessage(
                                                                                    'CT_BCE_CATALOG_RANGE_TO',
                                                                                    array('#TO#' => $range['SORT_TO'].' '.$actualItem['ITEM_MEASURE']['TITLE'])
                                                                                );
                                                                            }
                                                                            ?>
                                                                        </dt>
                                                                        <dd><?=($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE'])?></dd>
                                                                        <?
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </dl>
                                                </div>
                                                <?
                                                unset($showRanges, $useRatio, $itemPrice, $range);
                                            }

                                            break;

                                        case 'quantityLimit':
                                            if ($arParams['SHOW_MAX_QUANTITY'] !== 'N')
                                            {
                                                if ($haveOffers)
                                                {
                                                    ?>
                                                    <div class="product-item-detail-info-container" id="<?=$itemIds['QUANTITY_LIMIT']?>" style="display: none;">
                                                        <div class="product-item-detail-info-container-title">
                                                            <?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
                                                            <span class="product-item-quantity" data-entity="quantity-limit-value"></span>
                                                        </div>
                                                    </div>
                                                    <?
                                                }
                                                else
                                                {
                                                    if (
                                                        $measureRatio
                                                        && (float)$actualItem['CATALOG_QUANTITY'] > 0
                                                        && $actualItem['CATALOG_QUANTITY_TRACE'] === 'Y'
                                                        && $actualItem['CATALOG_CAN_BUY_ZERO'] === 'N'
                                                    )
                                                    {
                                                        ?>
                                                        <div class="product-item-detail-info-container" id="<?=$itemIds['QUANTITY_LIMIT']?>">
                                                            <div class="product-item-detail-info-container-title">
                                                                <?=$arParams['MESS_SHOW_MAX_QUANTITY']?>:
                                                                <span class="product-item-quantity" data-entity="quantity-limit-value">
                                                                <?
                                                                if ($arParams['SHOW_MAX_QUANTITY'] === 'M')
                                                                {
                                                                    if ((float)$actualItem['CATALOG_QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR'])
                                                                    {
                                                                        echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
                                                                    }
                                                                    else
                                                                    {
                                                                        echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    echo $actualItem['CATALOG_QUANTITY'].' '.$actualItem['ITEM_MEASURE']['TITLE'];
                                                                }
                                                                ?>
                                                            </span>
                                                            </div>
                                                        </div>
                                                        <?
                                                    }
                                                }
                                            }

                                            break;

                                        case 'buttons':

                                            if($arResult['CATALOG_QUANTITY_TRACE'] == "Y"):
                                                if($arResult['CATALOG_CAN_BUY_ZERO'] == 'Y'):
                                                    ?>
                                                    <div class="box-buy-btn">
                                                        <a class="buy-btn" item-id="<?=$arResult['ID']?>" data-id="buy-btn1" href="javascript:void(0);">
                                                            <div class="buy-btn-in">
                                                                <i class="basket-btn"></i><span><?=$arParams['MESS_BTN_ADD_TO_BASKET']?></span>
                                                            </div>
                                                        </a>
                                                        <div class="BasketEmodal">
                                                            <div class="emodal-data" id="buy-btn1"></div>
                                                        </div>
                                                    </div>
                                                <?else:?>
                                                    <?if($arResult['CATALOG_QUANTITY'] > 0):?>
                                                        <div class="box-buy-btn">
                                                            <a class="buy-btn" item-id="<?=$arResult['ID']?>" data-id="buy-btn1" href="javascript:void(0);">
                                                                <div class="buy-btn-in">
                                                                    <i class="basket-btn"></i><span><?=$arParams['MESS_BTN_ADD_TO_BASKET']?></span>
                                                                </div>
                                                            </a>
                                                            <div class="BasketEmodal">
                                                                <div class="emodal-data" id="buy-btn1"></div>
                                                            </div>
                                                        </div>
                                                    <?else:?>
                                                        <div class="not-quantity"><?=$arParams['MESS_NOT_AVAILABLE']?></div>
                                                    <?endif;?>
                                                <?endif;?>
                                            <?else:?>
                                                <div class="box-buy-btn">
                                                    <a class="buy-btn" item-id="<?=$arResult['ID']?>" data-id="buy-btn1" href="javascript:void(0);">
                                                        <div class="buy-btn-in">
                                                            <i class="basket-btn"></i><span><?=$arParams['MESS_BTN_ADD_TO_BASKET']?></span>
                                                        </div>
                                                    </a>
                                                    <div class="BasketEmodal">
                                                        <div class="emodal-data" id="buy-btn1"></div>
                                                    </div>
                                                </div>
                                            <?endif;?>
                                            <?
                                            break;
                                    }
                                }
                                ?>
                                </div>
                                <?if ($arResult['SHARE_TIME']['UNIX'] > 0):?>
                                    <div class="discount-timer">
                                        <?=GetMessage("DISCOUNT_TIMER")?>
                                        <div class="timer"><span class="number"><?=sprintf("%02d",$arResult['SHARE_TIME']['DEY']);?></span> <?=GetMessage("DEY");?> <span class="number"><?=sprintf("%02d",$arResult['SHARE_TIME']['HOURS']);?></span> <?=GetMessage("CHAS");?></div>
                                    </div>
                                <?endif;?>
                            </div>

                            <?if($arResult['PROPERTIES']['COL_TOVAR_OGR']['VALUE_XML_ID'] == "Y"):?>
                                <div class="quantity-attention">
                                    <span><?=GetMessage("QUANTITY_ATTENTION_TEXT")?></span>
                                </div>
                            <?endif;?>
                        </div>
                    </div>
                    <div class="str">
                        <div class="product-item-detail-data-left">
                            <?
                            foreach ($arParams['PRODUCT_INFO_BLOCK_ORDER'] as $blockName)
                            {
                                switch ($blockName)
                                {
                                    case 'props':?>
                                        <div class="top_prop_block">
                                            <?foreach ($arResult['TOP_PROP'] as $prop):?>
                                                <?if(!empty($prop['VALUE'])):?>
                                                    <div class="top_prop_box">
                                                        <span class="top_prop_box_name"><?=$prop['NAME']?></span>
                                                        <span class="top_prop_box_value"><?=$prop['VALUE']?></span>
                                                    </div>
                                                <?endif?>
                                            <?endforeach;?>
                                        </div>

                                        <?break;

                                    case 'sku':
                                        if ($haveOffers && !empty($arResult['OFFERS_PROP'])){?>
                                            <div class="top_prop_block_sku" id="sku_block_osn">
                                                <?$masCodePropSku = array();
                                                $i=0;
                                                foreach ($arResult['SKU_PROPS'] as $code_prop =>$skuProperty):?>
                                                    <?$masCodePropSku[] =$code_prop;?>
                                                    <?foreach ($arResult['SKU_PROP_ID'] as $code_prop_id):
                                                        if($code_prop_id ==$code_prop):?>
                                                            <div class="top_prop_blox_sku">
                                                                <div class="title_prop_sku"><?=$skuProperty['NAME'];?>:</div>
                                                                <?if($skuProperty['PROPERTY_TYPE'] == "S" && $skuProperty['USER_TYPE'] == "directory"){
                                                                    $class_hiden = "style='display:none'";
                                                                    foreach ($skuProperty['VALUES'] as $skuProp){?>
                                                                        <? if ($skuProp['ID'] != 0):?>
                                                                            <div class="pic_box <? if ($i == 0){echo "click_ok";}?>" style="background: url(<?=$skuProp['PICT']['SRC'];?>)" data-val="<?=$skuProp['XML_ID'];?>" data-select="<?=$i;?>"></div>
                                                                        <?endif?>
                                                                    <?}
                                                                    ?>
                                                                <?}else{
                                                                    $class_hiden = "class='select'";
                                                                }?>
                                                                <select <?=$class_hiden;?> data-select="<?=$i;?>" name="sku_prop_top">
                                                                    <?if($i!=0){echo " <option value='' disabled selected >".GetMessage("VIBERETE_IZ_SPISKA")."</option>";}?>
                                                                    <?foreach ($skuProperty['VALUES'] as $id_prop => $skuprop):?>
                                                                        <? if ($id_prop != 0):?>
                                                                            <?if (empty($skuprop['XML_ID'])){?>
                                                                                <option  <?if($i!=0){echo "disabled='disabled'";}?>  value="<?=$skuprop['NAME']?>"><?=$skuprop['NAME']?></option>
                                                                            <?}else{?>
                                                                                <option  <?if($i!=0){echo "disabled='disabled'";}?>  value="<?=$skuprop['XML_ID']?>"><?=$skuprop['NAME']?></option>
                                                                            <?}?>
                                                                        <?endif?>
                                                                    <?endforeach;?>
                                                                </select>
                                                            </div>
                                                            <? $i++;?>
                                                        <?endif;?>
                                                    <?endforeach;?>
                                                <?endforeach;?>
                                                <div class="hiden">
                                                    <?foreach ($arResult['OFFERS'] as $sku):?>
                                                        <span class="hiden"
                                                              data-prise="<?=$sku['PRICES']['BASE']['DISCOUNT_VALUE_NOVAT'];?>"
                                                              data-oldprise="<?=$sku["PRICES"]["BASE"]["VALUE"];?>"
                                                              data-skuid="<?=$sku['ID']?>"
                                                              data-sku_img ="
                                                            <?if(empty($sku['DETAIL_PICTURE']['SRC'])){
                                                                  echo $arResult['DETAIL_PICTURE']["SRC"];
                                                              }else{
                                                                  echo $sku['DETAIL_PICTURE']['SRC'];
                                                              }?>"
                                                              data-sku-prop ="
                                                          <?foreach ($sku['PROPERTIES'] as $key => $valsku){
                                                                  foreach ($masCodePropSku as $val){
                                                                      if($val == $key){
                                                                          echo $valsku['VALUE'];
                                                                      }
                                                                  }
                                                              }?>
                                                          "
                                                              data-discont="<?=$sku['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'];?>"
                                                            <?$i = 0;?>
                                                            <?foreach ($sku['PROPERTIES'] as $key => $valsku){
                                                                foreach ($masCodePropSku as $val){
                                                                    if($val == $key){?>
                                                                        data-sku<?=$i;?> = "<?=$valsku['VALUE'];?>"
                                                                        <?$i++;?>
                                                                    <?}
                                                                }
                                                            }?>
                                                        >
                                                    </span>
                                                    <?endforeach?>
                                                </div>
                                            </div>
                                        <?}?>

                                        <?break;

                                }?>

                            <?php }
                            ?>
                            <div class="props_description">
                                <? if (!empty($arResult['DETAIL_TEXT'])): ?>
                                    <span><?=Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB')?></span>
                                    <div class="detail_text_box open_list mobile_none">
                                        <div class="opened_list">
                                            <div class="description">
                                                <?=$arResult['DETAIL_TEXT']?>
                                            </div>
                                        </div>
                                    </div>
                                <? endif; ?>
                            </div>
                        </div>
                    </div>

                </div>



            </div>
        </div>
        <?
        if ($haveOffers)
        {
            if ($arResult['OFFER_GROUP'])
            {
                foreach ($arResult['OFFER_GROUP_VALUES'] as $offerId)
                {
                    ?>
                    <span id="<?=$itemIds['OFFER_GROUP'].$offerId?>" style="display: none;">
                        <?
                        $APPLICATION->IncludeComponent(
                            'bitrix:catalog.set.constructor',
                            'special_flat',
                            array(
                                'IBLOCK_ID' => $arResult['OFFERS_IBLOCK'],
                                'ELEMENT_ID' => $offerId,
                                'PRICE_CODE' => $arParams['PRICE_CODE'],
                                'BASKET_URL' => $arParams['BASKET_URL'],
                                'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
                                'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                                'CACHE_TIME' => $arParams['CACHE_TIME'],
                                'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                                'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME'],
                                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                'CURRENCY_ID' => $arParams['CURRENCY_ID']
                            ),
                            $component,
                            array('HIDE_ICONS' => 'Y')
                        );
                        ?>
                    </span>
                    <?
                }
            }
        }
        else
        {
            if ($arResult['MODULES']['catalog'] && $arResult['OFFER_GROUP'])
            {
                $APPLICATION->IncludeComponent(
                    'bitrix:catalog.set.constructor',
                    'special_flat',
                    array(
                        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                        'ELEMENT_ID' => $arResult['ID'],
                        'PRICE_CODE' => $arParams['PRICE_CODE'],
                        'BASKET_URL' => $arParams['BASKET_URL'],
                        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                        'CACHE_TIME' => $arParams['CACHE_TIME'],
                        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                        'TEMPLATE_THEME' => $arParams['~TEMPLATE_THEME'],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID']
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );
            }
        }
        ?>
        <?if($arResult["PRODUCT"]["TYPE"] != 2):?>
            <?$APPLICATION->IncludeComponent(
                "krayt:goods.in.set",
                "",
                Array(
                    "ID_GOODS" => $arResult['ID'],
                    "CACHE_TIME" => $arParams['CACHE_TIME'],
                    "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                    "NAME" => $arResult['NAME'],
                    "IBLOCK_ID" => $arResult['IBLOCK_ID'],
                ),
                $component,
                array('HIDE_ICONS' => 'Y')
            );?>
        <?endif;?>




	</div>

	<meta itemprop="name" content="<?=$name?>" />
	<meta itemprop="category" content="<?=$arResult['CATEGORY_PATH']?>" />
	<?
	if ($haveOffers)
	{
		foreach ($arResult['JS_OFFERS'] as $offer)
		{
			$currentOffersList = array();

			if (!empty($offer['TREE']) && is_array($offer['TREE']))
			{
				foreach ($offer['TREE'] as $propName => $skuId)
				{
					$propId = (int)substr($propName, 5);

					foreach ($skuProps as $prop)
					{
						if ($prop['ID'] == $propId)
						{
							foreach ($prop['VALUES'] as $propId => $propValue)
							{
								if ($propId == $skuId)
								{
									$currentOffersList[] = $propValue['NAME'];
									break;
								}
							}
						}
					}
				}
			}

			$offerPrice = $offer['ITEM_PRICES'][$offer['ITEM_PRICE_SELECTED']];
			?>
			<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<meta itemprop="sku" content="<?=htmlspecialcharsbx(implode('/', $currentOffersList))?>" />
				<meta itemprop="price" content="<?=$offerPrice['RATIO_PRICE']?>" />
				<meta itemprop="priceCurrency" content="<?=$offerPrice['CURRENCY']?>" />
				<link itemprop="availability" href="http://schema.org/<?=($offer['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
			</span>
			<?
		}

		unset($offerPrice, $currentOffersList);
	}
	else
	{
		?>
		<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<meta itemprop="price" content="<?=$price['RATIO_PRICE']?>" />
			<meta itemprop="priceCurrency" content="<?=$price['CURRENCY']?>" />
			<link itemprop="availability" href="http://schema.org/<?=($actualItem['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
		</span>
		<?
	}
	?>
<?
if ($haveOffers)
{

	$offerIds = array();
	$offerCodes = array();

	$useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

	foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer)
	{
		$offerIds[] = (int)$jsOffer['ID'];
		$offerCodes[] = $jsOffer['CODE'];

		$fullOffer = $arResult['OFFERS'][$ind];
		$measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

		$strAllProps = '';
		$strMainProps = '';
		$strPriceRangesRatio = '';
		$strPriceRanges = '';

		if ($arResult['SHOW_OFFERS_PROPS'])
		{
			if (!empty($jsOffer['DISPLAY_PROPERTIES']))
			{
				foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property)
				{
					$current = '<dt>'.$property['NAME'].'</dt><dd>'.(
						is_array($property['VALUE'])
							? implode(' / ', $property['VALUE'])
							: $property['VALUE']
						).'</dd>';
					$strAllProps .= $current;

					if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']]))
					{
						$strMainProps .= $current;
					}
				}

				unset($current);
			}
		}

		if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1)
		{
			$strPriceRangesRatio = '('.Loc::getMessage(
					'CT_BCE_CATALOG_RATIO_PRICE',
					array('#RATIO#' => ($useRatio
							? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
							: '1'
						).' '.$measureName)
				).')';

			foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range)
			{
				if ($range['HASH'] !== 'ZERO-INF')
				{
					$itemPrice = false;

					foreach ($jsOffer['ITEM_PRICES'] as $itemPrice)
					{
						if ($itemPrice['QUANTITY_HASH'] === $range['HASH'])
						{
							break;
						}
					}

					if ($itemPrice)
					{
						$strPriceRanges .= '<dt>'.Loc::getMessage(
								'CT_BCE_CATALOG_RANGE_FROM',
								array('#FROM#' => $range['SORT_FROM'].' '.$measureName)
							).' ';

						if (is_infinite($range['SORT_TO']))
						{
							$strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
						}
						else
						{
							$strPriceRanges .= Loc::getMessage(
								'CT_BCE_CATALOG_RANGE_TO',
								array('#TO#' => $range['SORT_TO'].' '.$measureName)
							);
						}

						$strPriceRanges .= '</dt><dd>'.($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']).'</dd>';
					}
				}
			}

			unset($range, $itemPrice);
		}

		$jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
		$jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
		$jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
		$jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
	}

	$templateData['OFFER_IDS'] = $offerIds;
	$templateData['OFFER_CODES'] = $offerCodes;
	unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => true,
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
			'OFFER_GROUP' => $arResult['OFFER_GROUP'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null
		),
		'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
		'VISUAL' => $itemIds,
		'DEFAULT_PICTURE' => array(
			'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
			'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
		),
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'NAME' => $arResult['~NAME'],
			'CATEGORY' => $arResult['CATEGORY_PATH']
		),
		'BASKET' => array(
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		),
		'OFFERS' => $arResult['JS_OFFERS'],
		'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
		'TREE_PROPS' => $skuProps
	);
}
else
{
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties)
	{
		?>

		<div id="<?=$itemIds['BASKET_PROP_DIV']?>" style="display: none;">
			<?
			if (!empty($arResult['PRODUCT_PROPERTIES_FILL']))
			{
				foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo)
				{
					?>
					<input type="hidden" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]" value="<?=htmlspecialcharsbx($propInfo['ID'])?>">
					<?
					unset($arResult['PRODUCT_PROPERTIES'][$propId]);
				}
			}

			$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
			if (!$emptyProductProperties)
			{
				?>
				<table>
					<?
					foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo)
					{
						?>
						<tr>
							<td><?=$arResult['PROPERTIES'][$propId]['NAME']?></td>
							<td>
								<?
								if (
									$arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
									&& $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
								)
								{
									foreach ($propInfo['VALUES'] as $valueId => $value)
									{
										?>
										<label>
											<input type="radio" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]"
												value="<?=$valueId?>" <?=($valueId == $propInfo['SELECTED'] ? '"checked"' : '')?>>
											<?=$value?>
										</label>
										<br>
										<?
									}
								}
								else
								{
									?>
									<select name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]">
										<?
										foreach ($propInfo['VALUES'] as $valueId => $value)
										{
											?>
											<option value="<?=$valueId?>" <?=($valueId == $propInfo['SELECTED'] ? '"selected"' : '')?>>
												<?=$value?>
											</option>
											<?
										}
										?>
									</select>
									<?
								}
								?>
							</td>
						</tr>
						<?
					}
					?>
				</table>
				<?
			}
			?>
		</div>
    <?}?>

    <div class="minislaider">
        <h3><?=GetMessage('POHOZHIE');?></h3>
        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "mini_section",
            array(
                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ELEMENT_SORT_FIELD" => $sort,
                "ELEMENT_SORT_ORDER" => $sort_po,
                "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
                "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                "INCLUDE_SUBSECTIONS" => 'N',
                "BASKET_URL" => $arParams["BASKET_URL"],
                "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                "FILTER_NAME" =>'arFiterElement',
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "SET_TITLE" => "N",
                // "MESSAGE_404" => $arParams["~MESSAGE_404"],
                //  "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                //  "SHOW_404" => $arParams["SHOW_404"],
                // "FILE_404" => $arParams["FILE_404"],
                "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                "PAGE_ELEMENT_COUNT" => $count_element,
                "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                "PRICE_CODE" => $arParams["PRICE_CODE"],
                "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                // "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                //   "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

                // "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                //  "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                //  "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                 "LAZY_LOAD" => "N",
                // "MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
                //  "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

                "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                "OFFERS_SORT_FIELD" => $sort,
                "OFFERS_SORT_ORDER" => $sort_po,
                "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                "SECTION_ID" => $arResult["IBLOCK_SECTION_ID"],
                "SECTION_CODE" => $arResult["SECTION_CODE"],
                "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
                "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                'LABEL_PROP' => $arParams['LABEL_PROP'],
                'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                "SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
                'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
                'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
                'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                // 'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                // "ADD_SECTIONS_CHAIN" => $section_chain,
                //  'ADD_TO_BASKET_ACTION' => $basketAction,
                'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
                'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
                'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),
                'PROP_1' => $arParams['PROP_1'],
                'PROP_2' => $arParams['PROP_2'],
                'PROP_3' => $arParams['PROP_3'],
                'PROP_4' => $arParams['PROP_4'],
                'PROP_5' => $arParams['PROP_5'],

                //  "SET_META_KEYWORDS" => $set_meta_keywords,
                //   "SET_META_DESCRIPTION" => $set_meta_dis,
                //  "AJAX_MODE" => "Y",
                "SHOW_ALL_WO_SECTION" =>"Y",
                "RCM_TYPE" => $arParams['RCM_TYPE'],
                "RCM_PROD_ID" => $arParams['RCM_PROD_ID'],
                "SHOW_FROM_SECTION" => $arParams['SHOW_FROM_SECTION'],

            ),$component,
            array('HIDE_ICONS' => 'Y')
        );?>
    </div>

        <section class="cat_el_tabs_wrp">
            <div class="tabs_nav">
                <?if (!empty($arResult['SET'])):?>
                    <div data-tab="tab-complekt" class="tab_title selected"><?=Loc::getMessage('K_TITLE_TAB_KOMPLEKT')?></div>
                <?endif;?>

                <div data-tab="tab-characteristics" class="tab_title <?if(empty($arResult['SET'])):?> selected<?endif;?>"><?=Loc::getMessage('K_TITLE_TAB_PROPS')?></div>
                <? if (!empty($arResult['DETAIL_TEXT'])): ?>
                    <div data-tab="tab-describe" class="tab_title"><?=Loc::getMessage('K_TITLE_TAB_DESC')?></div>
                <?endif;?>
                <div class="top-menu__line"></div>
            </div>
            <div class="tabs_cont">
                 <?if (!empty($arResult['SET'])):?>
                    <div id="tab-complekt" class="tab_block complectation active">
                <div class="complect_box">
                    <!-- Sostav Set -->
                    <div class="complect_block_padding"></div>
                    <div class="complect_block js-complect-block" <?if (empty($arResult['SET'])){echo "style='display:none;'";}?>>
                        <div class="complect_block_data">
                            <div class="complect_img">
                                <?if(empty($arResult['DETAIL_PICTURE'])){$arResult['DETAIL_PICTURE']['SRC'] =$templateFolder."/images/no_photo.png";}?>
                                <img src="<?=$arResult['DETAIL_PICTURE']['SRC'];?>">
                            </div>
                            <div class="complect_text">
                                <span class="text"><?=GetMessage("IN_SET");?></span>
                                <span class="count-elements"><?if (empty($arResult['SET'])){echo "1";}else{echo count($arResult['SET_MIN']);}?> <?=GetMessage("POZ");?></span>
                            </div>
                            <div class="complect_basket_box">
                                <div class="complect_prise">
                                    <span class="text"><?=GetMessage("STOIMOST");?></span>
                                    <?if ($price['BASE_PRICE'] == $price['PRICE']){$dis = "style='display:none;'";}?>
                                    <span class="current-price"><span class="prise_nap"><?=CCurrencyLang::CurrencyFormat($price['PRICE'],$price['CURRENCY']);?></span></span>
                                    <span <?=$dis;?> class="old-current-price">  <span class="old_prise_nap"><?=CCurrencyLang::CurrencyFormat($price['BASE_PRICE'],$price['CURRENCY']);?></span></span>
                                </div>
                                <div class="complect_in_basket">
                                    <div class="box-buy-btn">
                                        <?
                                        if($arResult['CATALOG_QUANTITY_TRACE'] == "Y"):
                                            if($arResult['CATALOG_CAN_BUY_ZERO'] == 'Y'):
                                                ?>
                                                <a class="buy-btn" item-id="<?=$arResult['ID']?>" data-id="buy-btn2" href="javascript:void(0);">
                                                    <div class="btn">
                                                        <i class="basket-btn"></i><span><?=Loc::getMessage('CT_BCE_CATALOG_ADD')?></span>
                                                    </div>
                                                </a>
                                                <div class="BasketEmodal">
                                                    <div class="emodal-data" id="buy-btn2"></div>
                                                </div>
                                            <?else:?>
                                                <?if($arResult['CATALOG_QUANTITY'] > 0):?>
                                                    <a class="buy-btn" item-id="<?=$arResult['ID']?>" data-id="buy-btn2" href="javascript:void(0);">
                                                        <div class="btn">
                                                            <i class="basket-btn"></i><span><?=Loc::getMessage('CT_BCE_CATALOG_ADD')?></span>
                                                        </div>
                                                    </a>
                                                    <div class="BasketEmodal">
                                                        <div class="emodal-data" id="buy-btn2"></div>
                                                    </div>
                                                <?else:?>

                                                <?endif;?>
                                            <?endif;?>
                                        <?else:?>
                                            <a class="buy-btn" item-id="<?=$arResult['ID']?>" data-id="buy-btn2" href="javascript:void(0);">
                                                <div class="btn">
                                                    <i class="basket-btn"></i><span><?=Loc::getMessage('CT_BCE_CATALOG_ADD')?></span>
                                                </div>
                                            </a>
                                            <div class="BasketEmodal">
                                                <div class="emodal-data" id="buy-btn2"></div>
                                            </div>
                                        <?endif;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content_hiden_block">
                            <div class="complect_slaider_box">
                                <?if (!empty($arResult['SET_MIN'])):?>
                                    <?foreach ($arResult['SET_MIN'] as $comp):?>
                                        <div class="item elem_slide" data-id="element<?=$comp['ID'];?>">
                                            <a href="#element<?=$comp['ID'];?>" title="<?=$comp['SECTION_NAME'];?>">
                                                <?if(empty($comp['PREVIEW_PICTURE'])){
                                                    $img = $templateFolder."/images/no_photo.png";
                                                }
                                                else{
                                                    $img = CFile::ResizeImageGet(
                                                        $comp["PREVIEW_PICTURE"],
                                                        array('width' => 60, 'height' => 60),
                                                        BX_RESIZE_IMAGE_PROPORTIONAL
                                                    );
                                                    $img = $img['src'];
                                                }?>
                                                <div class="img">
                                                    <div class="box-img">
                                                        <div class="img-bg" style="background-image: url(<?=$img;?>);"></div>
                                                    </div>
                                                </div>
                                                <div class="name">
                                                    <span><?=$comp['SECTION_NAME'];?></span>
                                                </div>
                                            </a>
                                        </div>
                                    <?endforeach?>
                                <?else:?>
                                    <a href="#element<?=$arResult['ID'];?>" class="item elem_slide">
                                        <?if(empty($arResult['PREVIEW_PICTURE'])){
                                            $img = $templateFolder."/images/no_photo.png";
                                        }
                                        else{
                                            $img = CFile::ResizeImageGet(
                                                $arResult["PREVIEW_PICTURE"],
                                                array('width' => 60, 'height' => 60),
                                                BX_RESIZE_IMAGE_PROPORTIONAL
                                            );
                                            $img = $img['src'];
                                        }?>
                                        <div class="img">
                                            <div class="box-img">
                                                <div class="img-bg" style="background-image: url(<?=$img;?>);"></div>
                                            </div>
                                        </div>
                                        <div class="name">
                                            <span><?=$arResult['SECTION_NAME'];?></span>
                                        </div>
                                    </a>
                                <?endif;?>
                            </div>
                        </div>
                        <div class="bg_niz"></div>
                        <div class="bg_niz2"></div>
                    </div>
                    <?if (!empty($arResult['PROPERTIES']['RECOMMEND']['VALUE']) || !empty($arResult['SET'])){?>
                        <?if (!empty($arResult['SET'])):?>
                            <!-- SOSTAV SET -->
                            <div class="complect_osn_box complect">
                                <div class="product-item-detail-sep"></div>
                                <div class="title_box">
                                    <?=GetMessage('SOSTAV_KOMPLECTA');?>
                                </div>
                                <?foreach ($arResult['SET'] as $comp):?>
                                    <div class="element_dop_bloc" id="element<?=$comp['ID'];?>">
                                        <div class="input_box">
                                            <img class="check-disabled" src="<?=SITE_TEMPLATE_PATH?>/images/icons/check_mark_disabled.svg" alt="">
                                        </div>
                                        <div class="img_box">
                                            <?if(empty($comp['PREVIEW_PICTURE'])){
                                                $img = $templateFolder."/images/no_photo.png";
                                            }
                                            else{
                                                $img = CFile::ResizeImageGet(
                                                    $comp["PREVIEW_PICTURE"],
                                                    array('width' => 80, 'height' => 80),
                                                    BX_RESIZE_IMAGE_PROPORTIONAL
                                                );
                                                $img = $img['src'];
                                            }?>
                                            <div class="img img_tooltip" data-image="<?=$img;?>" data-tooltip-content="#img_el<?=$comp['ID'];?>">
                                                <div class="bg-img" style="background-image: url(<?=$img;?>);"></div>
                                            </div>
                                            <div class="preview_img">
                                                <span></span>
                                                <div class="preview_img-box" id="img_el<?=$comp['ID'];?>">
                                                    <?if(empty($comp['PREVIEW_PICTURE'])){
                                                        $img_big = $templateFolder."/images/no_photo.png";
                                                    }
                                                    else{
                                                        $img_big = CFile::ResizeImageGet(
                                                            $comp["PREVIEW_PICTURE"],
                                                            array('width' => 250, 'height' => 250),
                                                            BX_RESIZE_IMAGE_PROPORTIONAL
                                                        );
                                                        $img_big = $img_big['src'];
                                                    }?>
                                                    <img src="<?=$img_big;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="info_box">
                                            <?if(empty($comp['POKAZ']['VALUE'])):?>
                                                <div class="name_box"> <a href="<?=$comp['DETAIL_PAGE_URL'];?>"><?=$comp['NAME'];?></a></div>
                                            <?else:?>
                                                <div class="name_box"> <?=$comp['NAME'];?></div>
                                            <?endif;?>
                                            <?if(is_array($comp['PROPERTY'])):?>
                                                <div class="prop_box">
                                                    <?foreach ($comp['PROPERTY'] as $prop):?>
                                                        <?if (!empty($prop['NAME']) &&!empty($prop['VALUE']) ):?>
                                                            <div class="box_properties">
                                                                <span class="name"><?=$prop['NAME']?>:</span> <span class="value"><?=$prop['XML_VALUE']?$prop['XML_VALUE']:$prop['VALUE']?></span>
                                                            </div>
                                                        <?endif;?>
                                                    <?endforeach;?>
                                                </div>
                                            <?endif;?>
                                        </div>
                                        <div class="prise_box">
                                            <?if($price['DISCOUNT_PRICE'] > 0):?>
                                                <span class="discont_prise"><?=CCurrencyLang::CurrencyFormat($price['DISCOUNT_PRICE'],$price['CURRENCY']);?></span>
                                                <?if ($comp['CATALOG_PRICE_1'] > $comp['DISCOUNT_PRICE']):?>
                                                    <span class="old_prise"><?=CCurrencyLang::CurrencyFormat($comp['CATALOG_PRICE_1'],$price['CURRENCY']);?></span>
                                                <?endif;?>
                                            <?endif;?>
                                        </div>
                                    </div>
                                <?endforeach?>
                            </div>
                            <?if (!empty($arResult['DOP_TOVAR'])):?>
                                <!--Dop tovar in set -->
                                <div class="complect_osn_box dop_tovar">
                                    <?$y=0?>
                                    <?foreach ($arResult['DOP_TOVAR'] as $section_name => $dop_tovar):?>
                                        <div class="mego_box open_list">
                                            <div class="section_name">
                                                <span><?=$section_name;?></span>
                                                <i class="trigger-arrow"></i>
                                            </div>
                                            <div class="box__element_ocn_block opened_list">
                                                <?$x = 0;?>
                                                <?foreach ($dop_tovar as $rectovar):?>
                                                    <div class="element_ocn_block">
                                                        <div data-sectionname ="<?=$section_name?>" class="element_dop_bloc" id="element<?=$rectovar['ID'];?>">
                                                            <div class="input_box">
                                                                <?if(empty($rectovar['SKU'])){?>
                                                                    <label class="radio">
                                                                        <input <?if ($x == 0){echo  'checked';};?> value="<?=$rectovar['ID']?>" type="radio" name="doptovar<?=$y?>">
                                                                        <span class="checked"></span>
                                                                    </label>
                                                                <?}else{?>
                                                                    <?$one_sku = current($rectovar['SKU']);?>
                                                                    <label class="radio">
                                                                        <input <?if ($x == 0){echo  'checked';};?> value="<?=$one_sku['ID']?>" type="radio" name="doptovar<?=$y?>">
                                                                        <span class="checked"></span>
                                                                    </label>
                                                                <?}?>
                                                            </div>
                                                            <div class="img_box">
                                                                <?if(empty($rectovar['PREVIEW_PICTURE'])){
                                                                    $img = $templateFolder."/images/no_photo.png";
                                                                }
                                                                else{
                                                                    $img = CFile::ResizeImageGet(
                                                                        $rectovar["PREVIEW_PICTURE"],
                                                                        array('width' => 80, 'height' => 80),
                                                                        BX_RESIZE_IMAGE_PROPORTIONAL
                                                                    );
                                                                    $img = $img['src'];
                                                                }?>
                                                                <div class="img img_tooltip" data-image="<?=$img;?>"data-tooltip-content="#img_el<?=$rectovar['ID'];?>">
                                                                    <div class="bg-img" style="background-image: url(<?=$img;?>);"></div>
                                                                </div>
                                                                <div class="preview_img">
                                                                    <span></span>
                                                                    <div class="preview_img-box" id="img_el<?=$rectovar['ID'];?>">
                                                                        <?if(empty($rectovar['PREVIEW_PICTURE'])){
                                                                            $img_big = $templateFolder."/images/no_photo.png";
                                                                        }
                                                                        else{
                                                                            $img_big = CFile::ResizeImageGet(
                                                                                $rectovar["PREVIEW_PICTURE"],
                                                                                array('width' => 300, 'height' => 300),
                                                                                BX_RESIZE_IMAGE_PROPORTIONAL
                                                                            );
                                                                            $img_big = $img_big['src'];
                                                                        }?>
                                                                        <img src="<?=$img_big;?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="info_box">
                                                                <div class="name_box"> <a href="<?=$rectovar['DETAIL_PAGE_URL'];?>"><?=$rectovar['NAME'];?></a></div>
                                                                <div class="prop_box">
                                                                    <?if(empty($rectovar['SKU'])){?>
                                                                        <?foreach ($rectovar['PROPERTY'] as $prop):?>
                                                                            <div class="box_properties">
                                                                                <?if (!empty($prop['NAME']) &&!empty($prop['VALUE']) ):?>
                                                                                    <span class="name"><?=$prop['NAME']?>:</span> <span class="value"><?=$prop['VALUE_ENUM']?$prop['VALUE_ENUM']:$prop['VALUE']?></span>
                                                                                <?endif;?>
                                                                            </div>
                                                                        <?endforeach;?>
                                                                    <?}else{?>
                                                                        <? $i=1;
                                                                        foreach ($rectovar['SPISOK_SKU'] as $key => $sku):?>
                                                                            <div class="box_properties">
                                                                                <span class="name"><?=$key?>:</span>
                                                                                <?if (count($sku) > 1):?>
                                                                                    <select class="select" <?echo "data-option='data-sku".$i."''";?>>
                                                                                        <?if($i!=1){echo " <option value='' disabled selected >".GetMessage("VIBERETE_IZ_SPISKA")."</option>";}?>
                                                                                        <?foreach ($sku as $option):?>
                                                                                            <option class="option_sku" data-opsku =<?=$option;?> <?if($i!=1){echo "style='display:none'";}?>  value="<?=$option;?>"><?=$option?></option>
                                                                                        <?endforeach;?>
                                                                                    </select>
                                                                                <?else:?>
                                                                                    <?foreach ($sku as $option):?>
                                                                                        <select style='display:none' <?echo "data-option='data-sku".$i."''";?>>
                                                                                            <option class="option_sku" data-opsku =<?=$option;?> <?if($i!=1){echo "style='display:none'";}?>  value="<?=$option;?>"><?=$option?></option>
                                                                                        </select>
                                                                                        <span class="option_sku value" data-opsku =<?=$option;?>><?=$option;?></span>
                                                                                    <?endforeach;?>
                                                                                <?endif;?>
                                                                                <?$i++;?>
                                                                            </div>
                                                                        <?endforeach;?>
                                                                    <?}?>
                                                                    <?if(!empty($rectovar['PROPERTY_RECOMMEND_NAME'])):?>
                                                                        <a href="#"><?=GetMessage("K_TOVARU");?></a>
                                                                    <?endif?>
                                                                </div>
                                                            </div>
                                                            <div class="prise_box">
                                                                <?if(!empty($rectovar['SKU'])){?>
                                                                    <? $j = 0; ?>
                                                                    <?foreach ($rectovar['SKU'] as $sku):?>
                                                                        <?if(empty($sku['PREVIEW_PICTURE'])){
                                                                            $img = $templateFolder."/images/no_photo.png";
                                                                        }
                                                                        else{
                                                                            $img = CFile::GetPath($sku["PREVIEW_PICTURE"]);
                                                                        }?>
                                                                        <span class="<?if ($j != 0){echo "hiden";}else{echo "oktual";}?>"
                                                                              data-oldprise="<?=$sku['CATALOG_PRICE_1'];?>"
                                                                              data-prise="<?=$sku['DISCOUNT_PRICE'];?>"
                                                                              data-skuid="<?=$sku['ID']?>"
                                                                              data-imgsku = "<?=$img?>"
                                                                              data-sku="<?
                                                                              foreach ($sku['PROPERTY'] as $prop){
                                                                                  if(!empty($prop['VALUE'])) {
                                                                                      echo $prop['VALUE'] . "|";
                                                                                  }
                                                                              }?>"
                                                                            <? $i=1;
                                                                            foreach ($sku['PROPERTY'] as $prop){
                                                                                echo "data-sku".$i."='".$prop['VALUE']."'";
                                                                                $i++;
                                                                            }?>
                                                                        >
                                                                            <div class="compl_cont_column"><span class="compl_title"><?=GetMessage('STOIMOST');?></span>
                                                                            <div class="price_column">
                                                                                <span class="discont_prise"><?=CCurrencyLang::CurrencyFormat($sku['DISCOUNT_PRICE'],$price['CURRENCY']);?></span>
                                                                            <?if ($sku['CATALOG_PRICE_1'] > $sku['DISCOUNT_PRICE']):?>
                                                                                <span class="old_prise"><?=CCurrencyLang::CurrencyFormat($sku['CATALOG_PRICE_1'],$price['CURRENCY']);?></span>
                                                                            <?endif;?>
                                                                                </div>
                                                                            </div>
                                                                    </span>
                                                                        <? $j++; ?>
                                                                    <?endforeach?>
                                                                <?}else{?>
                                                                    <span class="compl_title"><?=GetMessage('STOIMOST');?></span>
                                                                    <span class="oktual" data-oldprise="<?=$rectovar['CATALOG_PRICE_1'];?>" data-prise="<?=$rectovar['DISCOUNT_PRICE'];?>">
                                                                        <span class="discont_prise"><?=CCurrencyLang::CurrencyFormat($rectovar['DISCOUNT_PRICE'],$price['CURRENCY']);?></span>
                                                                        <?if ($rectovar['CATALOG_PRICE_1'] > $rectovar['DISCOUNT_PRICE']):?>
                                                                            <span class="old_prise"><?=CCurrencyLang::CurrencyFormat($rectovar['CATALOG_PRICE_1'],$price['CURRENCY']);?></span>
                                                                        <?endif;?>
                                                                </span>
                                                                <?}?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?$x++;?>
                                                <?endforeach?>
                                            </div>
                                        </div>
                                        <?$y++;?>
                                    <?endforeach;?>
                                </div>
                            <?endif?>
                        <?endif;?>
                        <?if (!empty($arResult['PROPERTIES']['RECOMMEND']['VALUE'])):?>
                            <!-- REC TOVAR -->
                            <div class="complect_osn_box recomend">
                                <div class="title_box"><?=GetMessage('DOP_TOVAR');?></div>
                                <div class="container-dop">
                                    <?foreach ($arResult['RECOMMENDED_PRODUCTS'] as $section_name => $dop_tova):?>
                                        <div class="mego_box open_list">
                                            <div class="section_name">
                                                <span><?=$section_name;?></span>
                                                <i class="trigger-arrow"></i>
                                            </div>
                                            <div class="box__element_ocn_block opened_list">
                                                <?foreach ($dop_tova as $rectovar):?>
                                                    <div class="element_ocn_block">
                                                        <div class="section_name"><span><?=$rectovar['SECTION_NAME'];?></span></div>
                                                        <div class="element_dop_bloc" data-sectionname ="<?=$section_name;?>" id="element<?=$rectovar['ID'];?>">
                                                            <div class="input_box open_hint">
                                                                <div class="hint"><?=GetMessage("VI_MOZHETE");?></div>
                                                                <?if(empty($rectovar['SKU'])){?>
                                                                    <label class="checkbox">
                                                                        <input value="<?=$rectovar['ID']?>" type="checkbox">
                                                                        <span class="checked"></span>
                                                                    </label>
                                                                <?}else{?>
                                                                    <?$one_sku = current($rectovar['SKU']);?>
                                                                    <label class="checkbox">
                                                                        <input value="<?=$one_sku['ID']?> " type="checkbox">
                                                                        <span class="checked"></span>
                                                                    </label>
                                                                <?}?>
                                                            </div>
                                                            <div class="img_box">
                                                                <?if(empty($rectovar['PREVIEW_PICTURE'])){
                                                                    $img = $templateFolder."/images/no_photo.png";
                                                                }
                                                                else{
                                                                    $img = CFile::ResizeImageGet(
                                                                        $rectovar["PREVIEW_PICTURE"],
                                                                        array('width' => 80, 'height' => 80),
                                                                        BX_RESIZE_IMAGE_PROPORTIONAL
                                                                    );
                                                                    $img = $img['src'];
                                                                }?>
                                                                <div class="img img_tooltip" data-image="<?=$img;?>"data-tooltip-content="#img_el<?=$rectovar['ID'];?>">
                                                                    <div class="bg-img" style="background-image: url(<?=$img;?>);"></div>
                                                                </div>
                                                                <div class="preview_img">
                                                                    <span></span>
                                                                    <div class="preview_img-box" id="img_el<?=$rectovar['ID'];?>">
                                                                        <?if(empty($rectovar['PREVIEW_PICTURE'])){
                                                                            $img_big = $templateFolder."/images/no_photo.png";
                                                                        }
                                                                        else{
                                                                            $img_big = CFile::ResizeImageGet(
                                                                                $rectovar["PREVIEW_PICTURE"],
                                                                                array('width' => 300, 'height' => 300),
                                                                                BX_RESIZE_IMAGE_PROPORTIONAL
                                                                            );
                                                                            $img_big = $img_big['src'];
                                                                        }?>
                                                                        <img src="<?=$img_big;?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="info_box">
                                                                <div class="name_box"> <a href="<?=$rectovar['DETAIL_PAGE_URL'];?>"><?=$rectovar['NAME'];?></a></div>
                                                                <div class="prop_box">
                                                                    <?if(empty($rectovar['SKU'])){?>
                                                                        <?foreach ($rectovar['PROPERTY'] as $prop):?>
                                                                            <div class="box_properties">
                                                                                <?if (!empty($prop['NAME']) &&!empty($prop['VALUE']) ):?>
                                                                                    <?if (!empty($prop['VALUE_ENUM'])){?>
                                                                                        <span class="name"><?=$prop['NAME']?>:</span> <span class="value"><?=$prop['VALUE_ENUM']?></span>
                                                                                    <?}else{?>
                                                                                        <span class="name"><?=$prop['NAME']?>:</span> <span class="value"><?=$prop['XML_VALUE']?$prop['XML_VALUE']:$prop['VALUE']?></span>
                                                                                    <?}?>
                                                                                <?endif;?>
                                                                            </div>
                                                                        <?endforeach;?>
                                                                    <?}else{?>
                                                                        <? $i=1;
                                                                        foreach ($rectovar['SPISOK_SKU'] as $key => $sku):?>
                                                                            <div class="box_properties">
                                                                                <span class="name"><?=$key?>:</span>
                                                                                <?if (count($sku) > 1):?>
                                                                                    <select class="select"  <?echo "data-option='data-sku".$i."''";?>>
                                                                                        <?if($i!=1){echo " <option value='' disabled selected >".GetMessage("VIBERETE_IZ_SPISKA")."</option>";}?>
                                                                                        <?foreach ($sku as $option):?>
                                                                                            <option class="option_sku" data-opsku =<?=$option;?> <?if($i!=1){echo "style='display:none'";}?>  value="<?=$option;?>"><?=$option?></option>
                                                                                        <?endforeach;?>
                                                                                    </select>
                                                                                <?else:?>
                                                                                    <?foreach ($sku as $option):?>
                                                                                        <select style='display:none' <?echo "data-option='data-sku".$i."''";?>>
                                                                                            <option class="option_sku" data-opsku =<?=$option;?> <?if($i!=1){echo "style='display:none'";}?>  value="<?=$option;?>"><?=$option?></option>
                                                                                        </select>
                                                                                        <span class="option_sku value" data-opsku =<?=$option;?>><?=$option;?></span>
                                                                                    <?endforeach;?>
                                                                                <?endif;?>
                                                                                <?$i++;?>
                                                                            </div>
                                                                        <?endforeach;?>
                                                                    <?}?>
                                                                </div>
                                                                <?if(!empty($rectovar['RECOMMEND_PROP'])):?>
                                                                    <span class="more-recommend-switch"><?=GetMessage("RECOMMEND_SWITCH_TEXT")?></span>
                                                                <?endif?>
                                                            </div>
                                                            <div class="prise_box">
                                                                <?if(!empty($rectovar['SKU'])){?>
                                                                    <? $j = 0; ?>
                                                                    <?foreach ($rectovar['SKU'] as $sku):?>
                                                                        <?if(empty($sku['PREVIEW_PICTURE'])){
                                                                            $img = $templateFolder."/images/no_photo.png";
                                                                        }
                                                                        else{
                                                                            $img = CFile::GetPath($sku["PREVIEW_PICTURE"]);
                                                                        }?>
                                                                        <span class="<?if ($j != 0){echo "hiden";}else{echo "oktual";}?>"
                                                                              data-oldprise="<?=$sku['CATALOG_PRICE_1'];?>"
                                                                              data-prise="<?=$sku['DISCOUNT_PRICE'];?>"
                                                                              data-skuid="<?=$sku['ID']?>"
                                                                              data-imgsku = "<?=$img?>"
                                                                              data-sku="<?
                                                                              foreach ($sku['PROPERTY'] as $prop){
                                                                                  if(!empty($prop['VALUE'])) {
                                                                                      echo $prop['VALUE'] . "|";
                                                                                  }
                                                                              }?>"
                                                                            <? $i=1;
                                                                            foreach ($sku['PROPERTY'] as $prop){
                                                                                echo "data-sku".$i."='".$prop['VALUE']."'";
                                                                                $i++;
                                                                            }?>
                                                                        >
                                                                            <div class="compl_cont_column">
                                                                            <span class="compl_title"><?=GetMessage('STOIMOST');?></span>
                                                                            <div class="price_column">
                                                                            <span class="discont_prise"><?=CCurrencyLang::CurrencyFormat($sku['DISCOUNT_PRICE'],$price['CURRENCY']);?></span>
                                                                            <?if ($sku['CATALOG_PRICE_1'] > $sku['DISCOUNT_PRICE']):?>
                                                                                <span class="old_prise"><?=CCurrencyLang::CurrencyFormat($sku['CATALOG_PRICE_1'],$price['CURRENCY']);?></span>
                                                                            <?endif;?>
                                                                                </div>
                                                                            </div>
                                                    </span>
                                                                        <? $j++; ?>
                                                                    <?endforeach?>
                                                                <?}else{?>
                                                                    <span class="compl_title"><?=GetMessage('STOIMOST');?></span>
                                                                    <span class="oktual" data-oldprise="<?=$rectovar['CATALOG_PRICE_1'];?>" data-prise="<?=$rectovar['DISCOUNT_PRICE'];?>">
                                                                        <span class="discont_prise"><?=CCurrencyLang::CurrencyFormat($rectovar['DISCOUNT_PRICE'],$price['CURRENCY']);?></span>
                                                                        <?if ($rectovar['CATALOG_PRICE_1'] > $rectovar['DISCOUNT_PRICE']):?>
                                                                            <span class="old_prise"> <?=CCurrencyLang::CurrencyFormat($rectovar['CATALOG_PRICE_1'],$price['CURRENCY']);?></span>
                                                                        <?endif;?>
                                                </span>
                                                                <?}?>
                                                            </div>
                                                        </div>
                                                        <?if(!empty($rectovar['RECOMMEND_PROP'])):?>
                                                            <!-- REC_TOVAR in REC_TOVAR -->
                                                            <div class="doprectovar-list">
                                                                <?foreach ($rectovar['DOP_TOVAR'] as $section_name_dop => $dopdoptovar):?>
                                                                    <div class="mego_box open_list">
                                                                        <div class="section_name">
                                                                            <span><?=$section_name_dop;?></span>
                                                                            <i class="trigger-arrow"></i>
                                                                        </div>
                                                                        <div class="opened_list">
                                                                            <?foreach ($dopdoptovar as $doprectovar):?>
                                                                                <div class="doptovarbox">
                                                                                    <div class="element_dop_bloc" data-sectionname ="<?=$section_name;?>" id="element<?=$doprectovar['ID'];?>">
                                                                                        <div class="input_box">
                                                                                            <?if(empty($doprectovar['SKU'])){?>
                                                                                                <?$one_sku = current($doprectovar['SKU']);?>
                                                                                                <label class="checkbox">
                                                                                                    <input value="<?=$doprectovar['ID']?>" type="checkbox">
                                                                                                    <span class="checked"></span>
                                                                                                </label>
                                                                                            <?}else{?>
                                                                                                <?$one_sku = current($doprectovar['SKU']);?>
                                                                                                <label class="checkbox">
                                                                                                    <input value="<?=$one_sku['ID']?> " type="checkbox">
                                                                                                    <span class="checked"></span>
                                                                                                </label>
                                                                                            <?}?>
                                                                                        </div>
                                                                                        <div class="img_box">
                                                                                            <?if(empty($doprectovar['PREVIEW_PICTURE'])){
                                                                                                $img = $templateFolder."/images/no_photo.png";
                                                                                            }
                                                                                            else{
                                                                                                $img = CFile::ResizeImageGet(
                                                                                                    $doprectovar['PREVIEW_PICTURE'],
                                                                                                    array('width' => 80, 'height' => 80),
                                                                                                    BX_RESIZE_IMAGE_PROPORTIONAL
                                                                                                );
                                                                                                $img = $img['src'];
                                                                                            }?>
                                                                                            <div class="img img_tooltip" data-image="<?=$img;?>" data-tooltip-content="img_el<?=$doprectovar['ID'];?>">
                                                                                                <div class="bg-img" style="background-image: url(<?=$img;?>);"></div>
                                                                                            </div>
                                                                                            <div class="preview_img">
                                                                                                <span></span>
                                                                                                <div class="preview_img-box" id="img_el<?=$doprectovar['ID'];?>">
                                                                                                    <?if(empty($doprectovar['PREVIEW_PICTURE'])){
                                                                                                        $img_big = $templateFolder."/images/no_photo.png";
                                                                                                    }
                                                                                                    else{
                                                                                                        $img_big = CFile::ResizeImageGet(
                                                                                                            $doprectovar["PREVIEW_PICTURE"],
                                                                                                            array('width' => 300, 'height' => 300),
                                                                                                            BX_RESIZE_IMAGE_PROPORTIONAL
                                                                                                        );
                                                                                                        $img_big = $img_big['src'];
                                                                                                    }?>
                                                                                                    <img src="<?=$img_big;?>">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="info_box">
                                                                                            <div class="name_box"> <a href="<?=$doprectovar['DETAIL_PAGE_URL'];?>"><?=$doprectovar['NAME'];?></a></div>
                                                                                            <div class="prop_box">
                                                                                                <?if(empty($doprectovar['SKU'])){?>
                                                                                                    <?foreach ($doprectovar['PROPERTY'] as $prop):?>
                                                                                                        <?if (!empty($prop['NAME']) &&!empty($prop['VALUE']) ):?>
                                                                                                            <div class="box_properties">
                                                                                                                <span class="name"><?=$prop['NAME']?>:</span>
                                                                                                                <span class="value"><?=$prop['XML_VALUE']?$prop['XML_VALUE']:$prop['VALUE']?></span>
                                                                                                            </div>
                                                                                                        <?endif;?>
                                                                                                    <?endforeach;?>
                                                                                                <?}else{?>
                                                                                                    <? $i=1;
                                                                                                    foreach ($doprectovar['SPISOK_SKU'] as $key => $sku):?>
                                                                                                        <span><?=$key?></span>
                                                                                                        <?if (count($sku) > 1):?>
                                                                                                            <select class="select" <?echo "data-option='data-sku".$i."''";?>>
                                                                                                                <?if($i!=1){echo " <option value='' disabled selected >".GetMessage("VIBERETE_IZ_SPISKA")."</option>";}?>
                                                                                                                <?foreach ($sku as $option):?>
                                                                                                                    <option class="option_sku" data-opsku =<?=$option;?> <?if($i!=1){echo "style='display:none'";}?>  value="<?=$option;?>"><?=$option?></option>
                                                                                                                <?endforeach;?>
                                                                                                            </select>
                                                                                                        <?else:?>
                                                                                                            <?foreach ($sku as $option):?>
                                                                                                                <select style='display:none' <?echo "data-option='data-sku".$i."''";?>>
                                                                                                                    <option class="option_sku" data-opsku =<?=$option;?> <?if($i!=1){echo "style='display:none'";}?>  value="<?=$option;?>"><?=$option?></option>
                                                                                                                </select>
                                                                                                                <span class="option_sku" data-opsku =<?=$option;?>><?=$option;?></span>
                                                                                                            <?endforeach;?>
                                                                                                        <?endif;?>
                                                                                                        <?$i++;?>
                                                                                                    <?endforeach;?>
                                                                                                <?}?>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="prise_box">
                                                                                            <?if(!empty($doprectovar['SKU'])){?>
                                                                                                <? $j = 0; ?>
                                                                                                <?foreach ($doprectovar['SKU'] as $sku):?>
                                                                                                    <?if(empty($sku['PREVIEW_PICTURE'])){
                                                                                                        $img = $templateFolder."/images/no_photo.png";
                                                                                                    }
                                                                                                    else{
                                                                                                        $img = CFile::GetPath($sku["PREVIEW_PICTURE"]);
                                                                                                    }?>
                                                                                                    <span class="<?if ($j != 0){echo "hiden";}else{echo "oktual";}?>"
                                                                                                          data-oldprise="<?=$sku['CATALOG_PRICE_1'];?>"
                                                                                                          data-prise="<?=$sku['DISCOUNT_PRICE'];?>"
                                                                                                          data-skuid="<?=$sku['ID']?>"
                                                                                                          data-imgsku = "<?=$img?>"
                                                                                                          data-sku="<?
                                                                                                          foreach ($sku['PROPERTY'] as $prop){
                                                                                                              if(!empty($prop['VALUE'])) {
                                                                                                                  echo $prop['VALUE'] . "|";
                                                                                                              }
                                                                                                          }?>"
                                                                                                        <? $i=1;
                                                                                                        foreach ($sku['PROPERTY'] as $prop){
                                                                                                            echo "data-sku".$i."='".$prop['VALUE']."'";
                                                                                                            $i++;
                                                                                                        }?>
                                                                                                    >
                                                                            <span class="discont_prise"> <?=CCurrencyLang::CurrencyFormat($sku['PRICE'],$price['CURRENCY']);?></span>
                                                                                                        <?if ($sku['CATALOG_PRICE_1'] > $sku['DISCOUNT_PRICE']):?>
                                                                                                            <span class="old_prise"> <?=CCurrencyLang::CurrencyFormat($sku['CATALOG_PRICE_1'],$price['CURRENCY']);?></span>
                                                                                                        <?endif;?>
                                                    </span>
                                                                                                    <? $j++; ?>
                                                                                                <?endforeach?>
                                                                                            <?}else{?>
                                                                                                <span class="compl_title"><?=GetMessage('STOIMOST');?></span>
                                                                                                <span class="oktual" data-oldprise="<?=$doprectovar['CATALOG_PRICE_1'];?>" data-prise="<?=$doprectovar['DISCOUNT_PRICE'];?>">
                                                                        <span class="discont_prise"><?=CCurrencyLang::CurrencyFormat($doprectovar['DISCOUNT_PRICE'],$price['CURRENCY']);?></span>
                                                                                                    <?if ($doprectovar['CATALOG_PRICE_1'] > $doprectovar['DISCOUNT_PRICE']):?>
                                                                                                        <span class="old_prise"> <?=CCurrencyLang::CurrencyFormat($doprectovar['CATALOG_PRICE_1'],$price['CURRENCY']);?></span>
                                                                                                    <?endif;?>
                                                </span>
                                                                                            <?}?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?endforeach;?>
                                                                        </div>
                                                                    </div>
                                                                <?endforeach;?>
                                                            </div>
                                                        <?endif?>
                                                    </div>
                                                <?endforeach?>
                                            </div>
                                        </div>
                                    <?endforeach;?>
                                </div>
                            </div>
                        <?endif?>
                        <?if (!empty($arResult['PROPERTIES']['SERVISE']['VALUE'])):?>
                            <!-- SERVESE -->
                            <div class="element_ocn_block service">
                                <div class="mego_box open_list">
                                    <div class="section_name">
                                        <span><?=GetMessage("SERVICE_TITLE")?></span>
                                        <i class="trigger-arrow"></i>
                                    </div>
                                    <div class="opened_list">
                                        <div class="element_dop_bloc" data-sectionname="<?=$arResult['PROPERTIES']['SERVISE']['VALUE']['NAME']?>">
                                            <div class="input_box">
                                                <label class="checkbox">
                                                    <input name="servis" value="<?=$arResult['PROPERTIES']['SERVISE']['VALUE']['ID']?>" type="checkbox">
                                                    <span class="checked"></span>
                                                </label>
                                            </div>
                                            <div class="img_box">
                                                <div class="img" data-image="<?=$arResult['PROPERTIES']['SERVISE']['VALUE']['PREVIEW_PICTURE']?>">
                                                    <div class="bg-img" style="background-image: url(<?=$arResult['PROPERTIES']['SERVISE']['VALUE']['PREVIEW_PICTURE']?>);"></div>
                                                </div>
                                            </div>
                                            <div class="info_box">
                                                <div class="title"><?=$arResult['PROPERTIES']['SERVISE']['VALUE']['NAME']?></div>
                                                <ul>
                                                    <?
                                                    if(isset($arResult['PROPERTIES']['SERVISE']['VALUE']['PROPERTY_SPISOK_VALUE']) && is_array($arResult['PROPERTIES']['SERVISE']['VALUE']['PROPERTY_SPISOK_VALUE']))
                                                        foreach ($arResult['PROPERTIES']['SERVISE']['VALUE']['PROPERTY_SPISOK_VALUE'] as $value):?>
                                                            <li><?=$value?></li>
                                                        <?endforeach?>
                                                </ul>
                                            </div>
                                            <div class="prise_box service">
                                                <div class="price_price"><?=GetMessage("OT");?><?=CCurrencyLang::CurrencyFormat($arResult['PROPERTIES']['SERVISE']['VALUE']['PROPERTY_PRICE_VALUE'],$price['CURRENCY']);?></div>
                                                <div class="price-text"><?=$arResult['PROPERTIES']['SERVISE']['VALUE']['PROPERTY_TEXT_VALUE']?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?endif?>
                    <?}else{?>

                    <?}?>
                    <div class="bottom_padding"></div>
                </div>
            </div>
                 <?endif;?>
                <div id="tab-characteristics" <?if(empty($arResult['SET'])):?> style="display: block" <?endif;?> class="tab_block characteristics  <?if(empty($arResult['SET'])):?> active<?endif;?>">
                <div class="product-item-detail-properties mobile_none">
                    <?if ($arParams['I_BLOCK_GROUP_PROP'] > 0){?>
                        <?foreach ($arResult['PROPS_GROUP'] as $razdel):?>
                                <?if($razdel['TUGLE'] == "Y"):?>
                                    <div class="prop_group_title">
                                        <span><?=$razdel['NAME']?></span>
                                        <i class="trigger-arrow"></i>
                                    </div>
                                    <div class="opened_list">
                                        <?foreach ($razdel['PROP'] as $prop):?>
                                            <? if(!empty($prop['VALUE'])):?>
                                                <div class="prop_tr">
                                                    <div class="prop_name">
                                                        <span class="value"><?=$prop['NAME'];?></span>
                                                        <?if(!empty($prop["DESCRIPTION_N"])):?>
                                                            <span class="prop_tooltip">
                                                    <span class="fa fa-question-circle-o"></span>
                                                        <span class="prop_desc">
                                                            <?=$prop["DESCRIPTION_N"]?>
                                                        </span>
                                                    </span>
                                                        <?endif;?>
                                                    </div>
                                                    <div class="prop_value">
                                                        <? if ($prop["PROPERTY_TYPE"] == "L") { ?>
                                                            <?if($prop["VALUE_XML_ID"] == "Y" || $prop["VALUE_XML_ID"] == "N"){?>
                                                                <span class="<?= ($prop["VALUE_XML_ID"] == "Y") ? 'yes' : 'no'; ?>"></span>
                                                            <?}else{?>
                                                                <?=$prop['VALUE']?>
                                                            <?}?>
                                                        <? } else {
                                                            if (is_array($prop['VALUE'])) {
                                                                echo implode(", ", $prop['VALUE']);
                                                            } else {
                                                                echo $prop['VALUE'];
                                                            }
                                                        }?>
                                                    </div>
                                                </div>
                                            <?endif;?>
                                        <?endforeach?>
                                    </div>
                                <?endif;?>
                        <?endforeach?>
                    <?}else{?>
                        <div class="prop_box">
                            <?foreach($arResult['PROPERTIES'] as $prop):?>
                                <? if(!empty($prop['VALUE'])):?>
                                    <div class="prop_tr">
                                        <div class="prop_name">
                                            <span class="value"><?=$prop['NAME'];?></span>
                                            <?if(!empty($prop["HINT"])):?>
                                                <span class="prop_tooltip">
                                            <span class="fa fa-question-circle-o"></span>
                                                        <span class="prop_desc">
                                                            <?=$prop["HINT"]?>
                                                        </span>
                                                    </span>
                                            <?endif;?>
                                        </div>
                                        <div class="prop_value">
                                            <? if ($prop["PROPERTY_TYPE"] == "L") { ?>
                                                <?if($prop["VALUE_XML_ID"] == "Y" || $prop["VALUE_XML_ID"] == "N"){?>
                                                    <span class="<?= ($prop["VALUE_XML_ID"] == "Y") ? 'yes' : 'no'; ?>"></span>
                                                <?}else{?>
                                                    <?=$prop['VALUE']?>
                                                <?}?>
                                            <? } else {
                                                if (is_array($prop['VALUE'])) {
                                                    echo implode(",", $prop['VALUE']);
                                                } else {
                                                    echo $prop['VALUE'];
                                                }
                                            }?>
                                        </div>
                                    </div>
                                <?endif;?>
                            <?endforeach;?>
                        </div>
                    <?}?>
                </div>
            </div>

            </div>
            <div id="tab-describe" class="tab_block type_rel">
                <div class="describe_tab">
                    <? if (!empty($arResult['DETAIL_TEXT'])): ?>
                        <div class="detail_text_box open_list mobile_none">
                            <div class="opened_list">
                                <div class="description">
                                    <?=$arResult['DETAIL_TEXT']?>
                                </div>
                            </div>
                        </div>
                    <? endif; ?>
                </div>
            </div>

        </section>
        <?if(!empty($arResult['PROPERTIES']['MODIFICATIONS']['VALUE'])):?>
            <?$APPLICATION->IncludeComponent(
                "krayt:versions",
                "",
                Array(
                    "CACHE_TIME" => $arParams['CACHE_TIME'],
                    "CACHE_TYPE" =>  $arParams['CACHE_TYPE'],
                    "ID_TOVAR" => $arResult['PROPERTIES']['MODIFICATIONS']['VALUE'],
                    "ID_PROPERTY" => $arResult['PROPERTIES']['DIFFERENT']['VALUE_XML_ID'],
                    "NAME" => $arResult['NAME'],
                    "ID_TOVAR_COMPLECT" => $arResult['ID'],
                    "IBLOCK_ID" => $arResult['IBLOCK_ID']

                ),
                $component,
                array('HIDE_ICONS' => 'Y')
            );?>
    <?endif;?>

        <?if(!empty($arResult['PROPERTIES']['COLLECTION']['VALUE'])):?>
        <?$APPLICATION->IncludeComponent(
            "krayt:collections",
            "",
            Array(
                "CACHE_TIME" => $arParams['CACHE_TIME'],
                "CACHE_TYPE" =>  $arParams['CACHE_TYPE'],
                "ID_TOVAR" => $arResult['PROPERTIES']['COLLECTION']['VALUE'],
                "IBLOCK_CATALOG_ID" => $arResult['IBLOCK_ID'],
                "PRICE_CODE" => $arParams["PRICE_CODE"],
                "ID_PRODUCT" => $arResult['ID'],
                "SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
                'LABEL_PROP' => $arParams['LABEL_PROP'],
                'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                "SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
                'PROP_1' => $arParams['PROP_1'],
                'PROP_2' => $arParams['PROP_2'],
                'PROP_3' => $arParams['PROP_3'],
                'PROP_4' => $arParams['PROP_4'],
                'PROP_5' => $arParams['PROP_5'],
                "PROP_ARTICUL" => $arParams["PROP_ARTICUL"],
            ),
            $component,
            array('HIDE_ICONS' => 'Y')
        );?>

    <?endif;?>

		<?


	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => !empty($arResult['ITEM_PRICES']),
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null
		),
		'VISUAL' => $itemIds,
		'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'PICT' => reset($arResult['MORE_PHOTO']),
			'NAME' => $arResult['~NAME'],
			'SUBSCRIPTION' => true,
			'ITEM_PRICE_MODE' => $arResult['ITEM_PRICE_MODE'],
			'ITEM_PRICES' => $arResult['ITEM_PRICES'],
			'ITEM_PRICE_SELECTED' => $arResult['ITEM_PRICE_SELECTED'],
			'ITEM_QUANTITY_RANGES' => $arResult['ITEM_QUANTITY_RANGES'],
			'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
			'ITEM_MEASURE_RATIOS' => $arResult['ITEM_MEASURE_RATIOS'],
			'ITEM_MEASURE_RATIO_SELECTED' => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
			'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
			'SLIDER' => $arResult['MORE_PHOTO'],
			'CAN_BUY' => $arResult['CAN_BUY'],
			'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
			'QUANTITY_FLOAT' => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
			'MAX_QUANTITY' => $arResult['CATALOG_QUANTITY'],
			'STEP_QUANTITY' => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
			'CATEGORY' => $arResult['CATEGORY_PATH']
		),
		'BASKET' => array(
			'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'EMPTY_PROPS' => $emptyProductProperties,
			'BASKET_URL' => $arParams['BASKET_URL'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		)
	);
	unset($emptyProductProperties);
}

if ($arParams['DISPLAY_COMPARE'])
{
	$jsParams['COMPARE'] = array(
		'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
		'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
		'COMPARE_PATH' => $arParams['COMPARE_PATH']
	);
}
?>
<script>
	BX.message({
		ECONOMY_INFO_MESSAGE: '<?=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>',
		TITLE_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>',
		TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>',
		BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		BTN_SEND_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>',
		BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>',
		BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		TITLE_SUCCESSFUL: '<?=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>',
		COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK')?>',
		COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
		COMPARE_TITLE: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE')?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		PRODUCT_GIFT_LABEL: '<?=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>',
		PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>',
		RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
		SITE_ID: '<?=SITE_ID?>',
        CURRENCY:'<?=$price['CURRENCY']?>'
	});

	var <?=$obName?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
</script>
<?
unset($actualItem, $itemIds, $jsParams);