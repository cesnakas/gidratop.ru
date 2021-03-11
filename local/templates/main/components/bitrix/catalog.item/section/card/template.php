<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */

?>

<div class="item gt-product-item ">
    <div class="gt-product-item-container ">
        <div class="gt-pr-item-content ">

            <div class="product-gal ">
                <a href="<?=$item['DETAIL_PAGE_URL']?>" title="<?=$imgTitle?>" data-entity="image-wrapper">
                    <img src="<?/*=SITE_TEMPLATE_PATH;/img/images/products/1.png*/?> <?=$item['PREVIEW_PICTURE']['SRC']?>" alt=" " />
                </a>
            </div>

            <div class="product-info ">
                <a href="<?=$item['DETAIL_PAGE_URL']?>" class="name">
                    <?=$productTitle?>
                </a>
                <?if($item["ARTICULE_CODE"]):?>
                <p>
                    <?=Loc::getMessage('K_TILE_ARTICULE')?><span class="number"><?=$item["ARTICULE_CODE"]?></span>
                </p>
                <?endif;?>
                <?if (!empty($arResult['PROP_CARD'])) { ?>

                    <? foreach ($arResult['PROP_CARD'] as $prop) { ?>

                        <? if (!empty($prop['VALUE'])): ?>
                        <p><?=$prop['NAME'];?>:<span><?=$prop['VALUE'];?></span></p>
                        <? endif; ?>

                    <? } ?>

                <? } ?>
                <!--<p>Бренд:<span><a href="# ">Aquatek</a></span></p>-->
                <!--<p>Страна:<span>Россия</span></p>-->
                <!--<p>Габариты:<span>123x69x18</span></p>-->
                <!--<p>Материал:<span>Чугун</span></p>-->
                <a href="# " class="in-stock ">В наличии</a>
                <div class="price ">15 000</div>
            </div>

        </div>
        <div class="product-actions ">
            <a href="# " class="gt-button ">В корзину</a>
            <div class="icons ">
                <a href="# " class="gt-ico-favorite "></a>
                <a href="# " class="gt-ico ">
                    <ico class="gt-ico-poll "></ico>
                </a>

            </div>

        </div>
        <div class="product-tags ">
            <span class="gt-tag tag-hit ">Хит продаж</span>
        </div>
    </div>
</div>

<!--//-->

<?/*

<div class="product-item">
    <div class="product-item-box">

        <?if (empty($item['OFFERS'])){;?>
            <div class="hiden data_box oktual_prise " data-prise="<?=$item["PRICES"]["BASE"]["DISCOUNT_VALUE"]?>" data-id="<?=$item['ID'];?>"  data-oldprise="<?=$item["PRICES"]["BASE"]["VALUE"];?>"></div>
        <?}else{?>
            <?$pos_sku = end($item['OFFERS']);?>
            <div class="hiden data_box oktual_prise " data-prise="<?=$pos_sku["PRICES"]["BASE"]["DISCOUNT_VALUE"]?>" data-id="<?=$pos_sku['ID'];?>"  data-oldprise="<?=$pos_sku["PRICES"]["BASE"]["VALUE"];?>"></div>
        <?}?>
<!--        <div class="kn" style="width: 20px; height: 20px; background-color: #ccc"></div>-->
        <a class="product-item-image-wrapper"
           data-entity="image-wrapper" href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $imgTitle ?>">

            <div class="item_lable_blck">
                <? if ($price['PERCENT'] > 0 && $arParams['SHOW_DISCOUNT_PERCENT'] === "Y"): ?>
                    <div class="discont_box" id="<?= $itemIds['DSC_PERC'] ?>">
                        <span><?= -$price['PERCENT'] ?>%</span>
                    </div>
                <? endif; ?>
                <? foreach ($item['LABEL_ARRAY_VALUE'] as $code => $value) { ?>
                    <div class="lable_box
                        <? echo mb_convert_case($code, MB_CASE_LOWER);
                    if (!isset($item['LABEL_PROP_MOBILE'][$code])) {
                        echo "";
                    } ?>
                     ">
                        <span title="<?= $value ?>"><?= $value ?></span>
                    </div>
                <? } ?>
            </div>
            <div class="shine-wrp"><div class="shine"></div></div>
            <div class="product-item-image-slider-slide-container slide" id="<?= $itemIds['PICT_SLIDER'] ?>"
                 style="display: <?= ($showSlider ? '' : 'none') ?>;"
                 data-slider-interval="<?= $arParams['SLIDER_INTERVAL'] ?>" data-slider-wrap="true">
                <?
                if ($showSlider) {
                    foreach ($morePhoto as $key => $photo) {
                        ?>
                        <div class="product-item-image-slide item <?= ($key == 0 ? 'active' : '') ?>">
                            <div class="product-item-image-slide-box">
                                <div class="product-item-image-slide-img"
                                     style="background-image: url(<?= $photo['SRC'] ?>);"></div>
                            </div>
                        </div>
                        <?
                    }
                }
                ?>
            </div>
            <div class="product-item-image-original" id="<?= $itemIds['PICT'] ?>"
                 style="display: <?= ($showSlider ? 'none' : '') ?>;">
                <div class="product-item-image-slide-box">
                    <div class="product-item-image-slide-img"
                         style="background-image: url(<?= $item['PREVIEW_PICTURE']['SRC'] ?>); "></div>
                </div>
            </div>
            <?
            if ($item['SECOND_PICT'] && !($arParams['HIDE_SECOND_PICT'] == "Y")) {
                $bgImage = !empty($item['PREVIEW_PICTURE_SECOND']) ? $item['PREVIEW_PICTURE_SECOND']['SRC'] : $item['PREVIEW_PICTURE']['SRC'];
                ?>
                <div class="product-item-image-alternative" id="<?= $itemIds['SECOND_PICT'] ?>"
                     style="display: <?= ($showSlider ? 'none' : '') ?>;">
                    <div class="product-item-image-slide-box">
                        <div class="product-item-image-slide-img load-img-alternative" data-src="<?= $bgImage ?>"
                             style="background-image: url('<?=$templateFolder?>/images/fon.svg'); "></div>
                    </div>
                </div>
                <?
            } ?>
            <div class="product-item-image-slider-control-container" id="<?= $itemIds['PICT_SLIDER'] ?>_indicator"
                 style="display: <?= ($showSlider ? '' : 'none') ?>;">
                <?
                if ($showSlider) {
                    foreach ($morePhoto as $key => $photo) {
                        ?>
                        <div class="product-item-image-slider-control<?= ($key == 0 ? ' active' : '') ?>"
                             data-go-to="<?= $key ?>"></div>
                        <?
                    }
                }
                ?>
            </div>
            <?
            if ($arParams['SLIDER_PROGRESS'] === 'Y') {
                ?>
                <div class="product-item-image-slider-progress-bar-container">
                    <div class="product-item-image-slider-progress-bar" id="<?= $itemIds['PICT_SLIDER'] ?>_progress_bar"
                         style="width: 0;"></div>
                </div>
                <?
            }
            ?>
        </a>
        <?if($item["ARTICULE_CODE"]):?>
            <div class="articul">
                <span class="text"><?=Loc::getMessage('K_TILE_ARTICULE')?> </span> <span class="number"><?=$item["ARTICULE_CODE"]?></span>
            </div>
        <?endif;?>
        <div class="box-title-price">
            <a class="product-item-title" href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $productTitle ?>">
                <span><?= $productTitle ?></span>
            </a>
            <?
            if (!empty($arParams['PRODUCT_BLOCKS_ORDER']))
            {
            ?>

        </div>

        <?
        if ($arParams['SHOW_MAX_QUANTITY'] !== 'N') {
            if ($haveOffers) {
                if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y') {
                    ?>
                    <div class="product-item-info-container" id="<?= $itemIds['QUANTITY_LIMIT'] ?>"
                         style="display: none;" data-entity="quantity-limit-block">
                        <div class="product-item-info-container-title">
                            <?= $arParams['MESS_SHOW_MAX_QUANTITY'] ?>:
                            <span class="product-item-quantity" data-entity="quantity-limit-value"></span>
                        </div>
                    </div>
                    <?
                }
            } else {
                if (
                    $measureRatio
                    && (float)$actualItem['CATALOG_QUANTITY'] > 0
                    && $actualItem['CATALOG_QUANTITY_TRACE'] === 'Y'
                    && $actualItem['CATALOG_CAN_BUY_ZERO'] === 'N'
                ) {
                    ?>
                    <div class="product-item-info-container" id="<?= $itemIds['QUANTITY_LIMIT'] ?>">
                        <div class="product-item-info-container-title">
                            <?= $arParams['MESS_SHOW_MAX_QUANTITY'] ?>:
                            <span class="product-item-quantity">
											<?
                                            if ($arParams['SHOW_MAX_QUANTITY'] === 'M') {
                                                if ((float)$actualItem['CATALOG_QUANTITY'] / $measureRatio >= $arParams['RELATIVE_QUANTITY_FACTOR']) {
                                                    echo $arParams['MESS_RELATIVE_QUANTITY_MANY'];
                                                } else {
                                                    echo $arParams['MESS_RELATIVE_QUANTITY_FEW'];
                                                }
                                            } else {
                                                echo $actualItem['CATALOG_QUANTITY'] . ' ' . $actualItem['ITEM_MEASURE']['TITLE'];
                                            }
                                            ?>
										</span>
                        </div>
                    </div>
                    <?
                }
            }
        }?>
<div class="card_prop_block">
        <?if (!empty($arResult['PROP_CARD'])) { ?>

            <? foreach ($arResult['PROP_CARD'] as $prop) { ?>
                <? if (!empty($prop['VALUE'])): ?>
                    <div class="card_prop_box">
                        <span class="prop_name"><?= $prop['NAME']; ?>: </span> <span> <?= $prop['VALUE']; ?></span>
                    </div>
                <? endif; ?>
                <?
            } ?>
            <?
            }

            $arParams['PRODUCT_DISPLAY_MODE'] = "Y";
            if ($arParams['PRODUCT_DISPLAY_MODE'] === 'Y' && $haveOffers && !empty($item['OFFERS_PROP'])) {
                ?>
                <div id="<?= $itemIds['PROP_DIV'] ?>">
                    <?
                    foreach ($arParams['SKU_PROPS'] as $skuProperty) {
                        $propertyId = $skuProperty['ID'];
                        $skuProperty['NAME'] = htmlspecialcharsbx($skuProperty['NAME']);
                        if (!isset($item['SKU_TREE_VALUES'][$propertyId]))
                            continue;
                        ?>
                        <div class="product-item-info-container" data-entity="sku-block">
                            <div class="product-item-scu-container" data-entity="sku-line-block">
                                <span class="name"><?= $skuProperty['NAME'] ?>:</span>
                                <div class="product-item-scu-block">
                                    <div class="product-item-scu-list">
                                        <ul class="product-item-scu-item-list">
                                            <?
                                            foreach ($skuProperty['VALUES'] as $value) {
                                                if (!isset($item['SKU_TREE_VALUES'][$propertyId][$value['ID']]))
                                                    continue;

                                                $value['NAME'] = htmlspecialcharsbx($value['NAME']);

                                                if ($skuProperty['SHOW_MODE'] === 'PICT') {
                                                    ?>
                                                    <li class="product-item-scu-item-color-container"
                                                        title="<?= $value['NAME'] ?>"
                                                        data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>"
                                                        data-onevalue="<?= $value['ID'] ?>">
                                                        <div class="product-item-scu-item-color-block">
                                                            <div class="product-item-scu-item-color"
                                                                 title="<?= $value['NAME'] ?>"
                                                                 style="background-image: url(<?= $value['PICT']['SRC'] ?>);">
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?
                                                } else {
                                                    ?>
                                                    <li class="product-item-scu-item-text-container"
                                                        title="<?= $value['NAME'] ?>"
                                                        data-treevalue="<?= $propertyId ?>_<?= $value['ID'] ?>"
                                                        data-onevalue="<?= $value['ID'] ?>">
                                                        <div class="product-item-scu-item-text-block">
                                                            <div class="product-item-scu-item-text"><?= $value['NAME'] ?></div>
                                                        </div>
                                                    </li>
                                                    <?
                                                }
                                            }
                                            ?>
                                        </ul>
                                        <div style="clear: both;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?
                    }
                    ?>
                </div>
                <?
                foreach ($arParams['SKU_PROPS'] as $skuProperty) {
                    if (!isset($item['OFFERS_PROP'][$skuProperty['CODE']]))
                        continue;

                    $skuProps[] = array(
                        'ID' => $skuProperty['ID'],
                        'SHOW_MODE' => $skuProperty['SHOW_MODE'],
                        'VALUES' => $skuProperty['VALUES'],
                        'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
                    );
                }

                unset($skuProperty, $value);

                $item['OFFERS_PROPS_DISPLAY'] = true;

                if ($item['OFFERS_PROPS_DISPLAY']) {


                    foreach ($item['JS_OFFERS'] as $keyOffer => $jsOffer) {
                        $strProps = '';


                        if (!empty($jsOffer['DISPLAY_PROPERTIES'])) {
                            foreach ($jsOffer['DISPLAY_PROPERTIES'] as $displayProperty) {
                                $strProps .= '<dt>' . $displayProperty['NAME'] . '</dt><dd>'
                                    . (is_array($displayProperty['VALUE'])
                                        ? implode(' / ', $displayProperty['VALUE'])
                                        : $displayProperty['VALUE'])
                                    . '</dd>';
                            }
                        }

                        $item['JS_OFFERS'][$keyOffer]['DISPLAY_PROPERTIES'] = $strProps;
                    }
                    unset($jsOffer, $strProps);
                }
            }
            } ?>
        </div>
        <div class="price_cont">

            <span class="product-item-price-current" id="<?= $itemIds['PRICE'] ?>">
                                <?
                                if (!empty($price)) {
                                    if ($arParams['PRODUCT_DISPLAY_MODE'] === 'N' && $haveOffers) {
                                        echo Loc::getMessage(
                                            'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
                                            array(
                                                '#PRICE#' => $price['PRINT_RATIO_PRICE'],
                                                '#VALUE#' => $measureRatio,
                                                '#UNIT#' => $minOffer['ITEM_MEASURE']['TITLE']
                                            )
                                        );
                                    } else {

                                        if($arResult['PRICE_COMPLECT'])
                                        {
                                            echo Loc::getMessage(
                                                'CT_BCI_TPL_MESS_PRICE_SIMPLE_MODE',
                                                array(
                                                    '#PRICE#' => $price['PRINT_RATIO_PRICE'],
                                                    '#VALUE#' => $measureRatio,
                                                    '#UNIT#' => $minOffer['ITEM_MEASURE']['TITLE']
                                                )
                                            );
                                        }else{
                                            echo $price['PRINT_RATIO_PRICE'];
                                        }

                                    }
                                }
                                ?>
                            </span>
                <span class="product-item-price-old" id="<?= $itemIds['PRICE_OLD'] ?>"
                    <?= ($price['RATIO_PRICE'] >= $price['RATIO_BASE_PRICE'] ? 'style="display: none;"' : '') ?>>
                                    <?= $price['PRINT_RATIO_BASE_PRICE'] ?>
                                </span>

        </div>
        <div class="product-item-info-container product-item-price-container" data-entity="price-block">
            <div class="left">
                <?if ($actualItem['CAN_BUY']):?>
                    <?if($arResult['PRICE_COMPLECT']):?>
                            <a href="<?= $item['DETAIL_PAGE_URL'] ?>" class="btn btn_furn" data-id="buy-btn1-<?=$item['ID'];?>" item-id="<?=$item['ID'];?>">
                                <div class="buy-btn-in">
                                    <?=Loc::getMessage('K_BTN_MORE')?>
                                </div>
                            </a>
                        <?else:?>
                            <a href="#" class="btn btn_furn buy-btn" data-id="buy-btn1-<?=$item['ID'];?>" item-id="<?=$item['ID'];?>">
                                <div class="buy-btn-in">
                                    <?=Loc::getMessage('K_BTN_CART')?>
                                </div>
                            </a>
                            <div class="BasketEmodal">
                                <div class="emodal-data" id="buy-btn1-<?=$item['ID'];?>"></div>
                            </div>
                    <?endif;?>
                <?else:?>
                    <a class="btn btn-silver <?=$buttonSizeClass?>"
                       id="<?=$itemIds['NOT_AVAILABLE_MESS']?>" href="javascript:void(0)" rel="nofollow">
                        <?=$arParams['MESS_NOT_AVAILABLE']?>
                    </a>
                <?endif;?>
            </div>
            <div class="right"><? if (
                $arParams['DISPLAY_COMPARE']
                && (!$haveOffers || $arParams['PRODUCT_DISPLAY_MODE'] === 'Y')
            ) {
                ?>
                <div class="product-item-conteiner-low">
                    <div class="flag-low open_hint" data-cookieid="<?= $item['ID']; ?>">
                        <div class="hint" data-label-in="<?= GetMessage("IN_FAVORE"); ?>" data-label-out="<?= GetMessage("OUT_FAVORE"); ?>"></div>
                    </div>
                </div>
                <div class="product-item-compare-container">
                    <div class="product-item-compare">
                        <div class="checkbox open_hint" id="<?= $itemIds['COMPARE_LINK'] ?>">
                            <input type="checkbox" data-entity="compare-checkbox"
                                   id="<?= $itemIds['COMPARE_LINK'] ?>">
                            <label for="<?= $itemIds['COMPARE_LINK'] ?>">
                                <div class="hint" data-label-in="<?= GetMessage("IN_SRAVNENIE"); ?>" data-label-out="<?= GetMessage("OUT_SRAVNENIE"); ?>"></div>
                                <span class="bar-chart"><i></i><i></i><i></i></span>
                            </label>
                        </div>
                    </div>
                </div>
                <?
            }
            ?>
            </div>

        </div>
        <div class="bg_down_shadow"></div>

    </div>
</div>

*/?>