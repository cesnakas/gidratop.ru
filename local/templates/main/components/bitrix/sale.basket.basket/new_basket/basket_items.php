<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @var array $arUrls */
/** @var array $arHeaders */
use Bitrix\Sale\DiscountCouponsManager;

if (!empty($arResult["ERROR_MESSAGE"]))
    ShowError($arResult["ERROR_MESSAGE"]);

$bDelayColumn = false;
$bDeleteColumn = false;
$bWeightColumn = false;
$bPropsColumn = false;
$bPriceType = false;

if ($normalCount > 0):
    ?>

    <div id="basket_items_list">
        <div class="bx_ordercart_order_table_container">
            <table id="basket_items">
                <thead>
                <tr>

                    <!--					<td class="margin"></td>-->
                    <?
                    foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):
                        $arHeaders[] = $arHeader["id"];

                        // remember which values should be shown not in the separate columns, but inside other columns
                        if (in_array($arHeader["id"], array("TYPE"))) {
                            $bPriceType = true;
                            continue;
                        } elseif ($arHeader["id"] == "PROPS") {
                            $bPropsColumn = true;
                            continue;
                        } elseif ($arHeader["id"] == "DELAY") {
                            $bDelayColumn = true;
                            continue;
                        } elseif ($arHeader["id"] == "DELETE") {
                            $bDeleteColumn = true;
                            continue;
                        } elseif ($arHeader["id"] == "WEIGHT") {
                            $bWeightColumn = true;
                        }

                        if ($arHeader["id"] == "NAME"):
                            ?>
                            <td class="item name" colspan="2" id="col_<?= $arHeader["id"]; ?>">
                            <?
                        elseif ($arHeader["id"] == "PRICE"):
                            ?>
                            <td class="price" id="col_<?= $arHeader["id"]; ?>">
                            <?
                        else:
                            ?>
                            <td class="custom" id="col_<?= $arHeader["id"]; ?>">
                            <?
                        endif;
                        ?>
                        <?= $arHeader["name"]; ?>
                        </td>
                        <?
                    endforeach;

                    if ($bDeleteColumn || $bDelayColumn):
                        ?>
                        <td class="custom"></td>
                        <?
                    endif;
                    ?>
                </tr>
                </thead>

                <tbody>
                <?
                $skipHeaders = array('PROPS', 'DELAY', 'DELETE', 'TYPE');

                foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):


                    if ($arItem["DELAY"] == "N" && $arItem["CAN_BUY"] == "Y" && $arItem['HID'] != "Y"):
                        ?>
                        <tr class="item-box" id="<?= $arItem["ID"] ?>"
                            data-item-name="<?= $arItem["NAME"] ?>"
                            data-item-brand="<?= $arItem[$arParams['BRAND_PROPERTY'] . "_VALUE"] ?>"
                            data-item-price="<?= $arItem["PRICE"] ?>"
                            data-item-currency="<?= $arItem["CURRENCY"] ?>"
                        >
                            <!--						<td class="margin"></td>-->
                            <?
                            foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):

                                if (in_array($arHeader["id"], $skipHeaders)) // some values are not shown in the columns in this template
                                    continue;

                                if ($arHeader["name"] == '')
                                    $arHeader["name"] = GetMessage("SALE_" . $arHeader["id"]);

                                if ($arHeader["id"] == "NAME"):
                                    ?>
                                    <td class="item_photo">
                                        <div class="bx_ordercart_photo_container">
                                            <?
                                            if (strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0):
                                                $url = $arItem["PREVIEW_PICTURE_SRC"];
                                            elseif (strlen($arItem["DETAIL_PICTURE_SRC"]) > 0):
                                                $url = $arItem["DETAIL_PICTURE_SRC"];
                                            else:
                                                $url = $templateFolder . "/images/no_photo.png";
                                            endif;

                                            if (strlen($arItem["DETAIL_PAGE_URL"]) > 0): ?><a
                                                    href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?endif;
                                                ?>
                                                <div class="bx_ordercart_photo"
                                                     style="background-image:url('<?= $url ?>')"></div>
                                                <? if (strlen($arItem["DETAIL_PAGE_URL"]) > 0): ?></a><?endif;
                                        ?>
                                        </div>
                                        <?
                                        if (!empty($arItem["BRAND"])):
                                            ?>
                                            <div class="bx_ordercart_brand">
                                                <img alt="" src="<?= $arItem["BRAND"] ?>"/>
                                            </div>
                                            <?
                                        endif;
                                        ?>
                                    </td>
                                    <td class="item_name">
                                        <div class="bx_ordercart_itemtitle">
                                            <? if (strlen($arItem["DETAIL_PAGE_URL"]) > 0): ?><a
                                                    href="<?= $arItem["DETAIL_PAGE_URL"] ?>"><?endif;
                                                ?>
                                                <?= $arItem["NAME"] ?>
                                                <? if (strlen($arItem["DETAIL_PAGE_URL"]) > 0): ?></a><?endif;
                                        ?>
                                        </div>
                                        <? if (!empty($arItem['SET'])): ?>
                                            <div class="set_block">
                                                <div class="title_box"><?= GetMessage("SET_NEW"); ?>:</div>
                                                <div class="set_block-box">
                                                    <? foreach ($arItem['SET'] as $product): ?>
                                                        <span>- <?= $product['NAME'] ?></span>
                                                    <? endforeach; ?>
                                                </div>
                                            </div>
                                        <? endif; ?>
                                        <div class="bx_ordercart_itemart">
                                            <?
                                            if ($bPropsColumn):
                                                foreach ($arItem["PROPS"] as $val):
                                                    if (is_array($arItem["SKU_DATA"])) {
                                                        $bSkip = false;
                                                        foreach ($arItem["SKU_DATA"] as $propId => $arProp) {
                                                            if ($arProp["CODE"] == $val["CODE"]) {
                                                                $bSkip = true;
                                                                break;
                                                            }
                                                        }
                                                        if ($bSkip)
                                                            continue;
                                                    }
                                                    if ($val['CODE'] != "MONTAZH_YES" && $val['CODE'] != "SET_DOP") {
                                                        echo htmlspecialcharsbx($val["NAME"]) . ":&nbsp;<span>" . $val["VALUE"] . "</span><br/>";
                                                    } else {

                                                    }
                                                endforeach;
                                            endif;
                                            ?>
                                        </div>
                                        <? if (!empty($arItem['MONTAZH']['EST'])): ?>
                                            <div class="servis">
                                                <input type="checkbox" <? if ($arItem['MONTAZH']['NUZHEN'] == GetMessage("YES")) {
                                                    echo "checked";
                                                } ?> value="<?= $arItem['NUMER_BASKET'] ?>"
                                                       id="input_<?= $arItem['NUMER_BASKET'] ?>">
                                                <label for="input_<?= $arItem['NUMER_BASKET'] ?>"><?= GetMessage("SERVIS"); ?></label>
                                            </div>
                                        <? endif; ?>
                                        <?
                                        if (is_array($arItem["SKU_DATA"]) && !empty($arItem["SKU_DATA"])):
                                            $propsMap = array();
                                            foreach ($arItem["PROPS"] as $propValue) {
                                                if (empty($propValue) || !is_array($propValue))
                                                    continue;
                                                $propsMap[$propValue['CODE']] = (isset($propValue['~VALUE']) ? $propValue['~VALUE'] : $propValue['VALUE']);
                                            }
                                            unset($propValue);

                                            foreach ($arItem["SKU_DATA"] as $propId => $arProp):
                                                $selectedIndex = 0;
                                                // if property contains images or values
                                                $isImgProperty = false;
                                                if (!empty($arProp["VALUES"]) && is_array($arProp["VALUES"])) {
                                                    $counter = 0;
                                                    foreach ($arProp["VALUES"] as $id => $arVal) {
                                                        $counter++;
                                                        if (isset($propsMap[$arProp['CODE']])) {
                                                            if ($propsMap[$arProp['CODE']] == $arVal['NAME'] || $propsMap[$arProp['CODE']] == $arVal['XML_ID'])
                                                                $selectedIndex = $counter;
                                                        }
                                                        if (!empty($arVal["PICT"]) && is_array($arVal["PICT"])
                                                            && !empty($arVal["PICT"]['SRC'])
                                                        ) {
                                                            $isImgProperty = true;
                                                        }
                                                    }
                                                    unset($counter);
                                                }
                                                $countValues = count($arProp["VALUES"]);
                                                $full = ($countValues > 5) ? "full" : "";

                                                $marginLeft = 0;
                                                if ($countValues > 5 && $selectedIndex > 5)
                                                    $marginLeft = ((5 - $selectedIndex) * 20) . '%';

                                                if ($isImgProperty): // iblock element relation property
                                                    ?>
                                                    <div class="bx_item_detail_scu_small_noadaptive <?= $full ?>">
													<span class="bx_item_section_name_gray">
														<?= htmlspecialcharsbx($arProp["NAME"]) ?>:
													</span>
                                                        <div class="bx_scu_scroller_container">

                                                            <div class="bx_scu">
                                                                <ul id="prop_<?= $arProp["CODE"] ?>_<?= $arItem["ID"] ?>"
                                                                    style="width: 200%; margin-left: <?= $marginLeft; ?>"
                                                                    class="sku_prop_list"
                                                                >
                                                                    <?
                                                                    $counter = 0;
                                                                    foreach ($arProp["VALUES"] as $valueId => $arSkuValue):
                                                                        $counter++;
                                                                        $selected = ($selectedIndex == $counter ? ' bx_active' : '');
                                                                        ?>
                                                                        <li style="width:10%;"
                                                                            class="sku_prop<?= $selected ?>"
                                                                            data-sku-selector="Y"
                                                                            data-value-id="<?= $arSkuValue["XML_ID"] ?>"
                                                                            data-sku-name="<?= htmlspecialcharsbx($arSkuValue["NAME"]); ?>"
                                                                            data-element="<?= $arItem["ID"] ?>"
                                                                            data-property="<?= $arProp["CODE"] ?>"
                                                                        >
                                                                            <a href="javascript:void(0)"
                                                                               class="cnt"><span class="cnt_item"
                                                                                                 style="background-image:url(<?= $arSkuValue["PICT"]["SRC"]; ?>)"></span></a>
                                                                        </li>
                                                                        <?
                                                                    endforeach;
                                                                    unset($counter);
                                                                    ?>
                                                                </ul>
                                                            </div>

                                                            <div class="bx_slide_left"
                                                                 onclick="leftScroll('<?= $arProp["CODE"] ?>', <?= $arItem["ID"] ?>, <?= $countValues ?>);"></div>
                                                            <div class="bx_slide_right"
                                                                 onclick="rightScroll('<?= $arProp["CODE"] ?>', <?= $arItem["ID"] ?>, <?= $countValues ?>);"></div>
                                                        </div>

                                                    </div>
                                                    <?
                                                else:
                                                    ?>
                                                    <div class="bx_item_detail_size_small_noadaptive <?= $full ?>">
													<span class="bx_item_section_name_gray">
														<?= htmlspecialcharsbx($arProp["NAME"]) ?>:
													</span>
                                                        <div class="bx_size_scroller_container">
                                                            <div class="bx_size">
                                                                <ul id="prop_<?= $arProp["CODE"] ?>_<?= $arItem["ID"] ?>"
                                                                    style="width: 200%; margin-left: <?= $marginLeft; ?>;"
                                                                    class="sku_prop_list"
                                                                >
                                                                    <?
                                                                    if (!empty($arProp["VALUES"])) {
                                                                        $counter = 0;
                                                                        foreach ($arProp["VALUES"] as $valueId => $arSkuValue):
                                                                            $counter++;
                                                                            $selected = ($selectedIndex == $counter ? ' bx_active' : '');
                                                                            ?>
                                                                            <li style="width:10%;"
                                                                                class="sku_prop<?= $selected ?>"
                                                                                data-sku-selector="Y"
                                                                                data-value-id="<?= ($arProp['TYPE'] == 'S' && $arProp['USER_TYPE'] == 'directory' ? $arSkuValue['XML_ID'] : htmlspecialcharsbx($arSkuValue['NAME'])); ?>"
                                                                                data-sku-name="<?= htmlspecialcharsbx($arSkuValue["NAME"]); ?>"
                                                                                data-element="<?= $arItem["ID"] ?>"
                                                                                data-property="<?= $arProp["CODE"] ?>"
                                                                            >
                                                                                <a href="javascript:void(0)"
                                                                                   class="cnt"><?= htmlspecialcharsbx($arSkuValue["NAME"]); ?></a>
                                                                            </li>
                                                                            <?
                                                                        endforeach;
                                                                        unset($counter);
                                                                    }
                                                                    ?>
                                                                </ul>
                                                            </div>
                                                            <div class="bx_slide_left"
                                                                 onclick="leftScroll('<?= $arProp["CODE"] ?>', <?= $arItem["ID"] ?>, <?= $countValues ?>);"></div>
                                                            <div class="bx_slide_right"
                                                                 onclick="rightScroll('<?= $arProp["CODE"] ?>', <?= $arItem["ID"] ?>, <?= $countValues ?>);"></div>
                                                        </div>

                                                    </div>
                                                    <?
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                    </td>
                                    <?
                                elseif ($arHeader["id"] == "QUANTITY"):
                                    ?>
                                    <td class="custom colvo">
<!--                                        <span>--><?//= $arHeader["name"]; ?><!--:</span>-->
                                        <div>
                                            <?= $arItem["QUANTITY"] ?><?=GetMessage("SHTUK");?>
                                        </div>
                                        <input type="hidden" id="QUANTITY_<?= $arItem['ID'] ?>"
                                               name="QUANTITY_<?= $arItem['ID'] ?>" value="<?= $arItem["QUANTITY"] ?>"/>
                                    </td>
                                    <?
                                elseif ($arHeader["id"] == "PRICE"):
                                    ?>
                                    <td class="price">
                                        <div class="current_price" id="current_price_<?= $arItem["ID"] ?>">
                                            <?= $arItem["PRICE"] ?><span class="rubl">i</span>
                                        </div>
                                        <div class="old_price" id="old_price_<?= $arItem["ID"] ?>">
                                            <? if ($arItem["BASE_PRICE"] > $arItem["PRICE"]): ?>
                                                <?= $arItem["BASE_PRICE"] ?><span class="rubl">i</span>
                                            <? endif; ?>

                                        </div>

                                        <? if ($bPriceType && strlen($arItem["NOTES"]) > 0): ?>
                                            <div class="type_price"><?= GetMessage("SALE_TYPE") ?></div>
                                            <div class="type_price_value"><?= $arItem["NOTES"] ?></div>
                                        <? endif; ?>
                                    </td>
                                    <?
                                elseif ($arHeader["id"] == "DISCOUNT"):
                                    ?>
                                    <td class="custom discount">
<!--                                        <span>--><?//= $arHeader["name"]; ?><!--:</span>-->
                                        <div id="discount_value_<?= $arItem["ID"] ?>"><?= $arItem["DISCOUNT_PRICE_PERCENT_FORMATED"] ?></div>
                                    </td>
                                    <?
                                elseif ($arHeader["id"] == "WEIGHT"):
                                    ?>
                                    <td class="custom">
<!--                                        <span>--><?//= $arHeader["name"]; ?><!--:</span>-->
                                        <?= $arItem["WEIGHT_FORMATED"] ?>
                                    </td>
                                    <?
                                else:
                                    ?>
                                    <td class="custom sum_all basket_all_sum">
                                        <?
                                        if ($arHeader["id"] == "SUM"):
                                        ?>
                                        <div id="sum_<?= $arItem["ID"] ?>">
                                            <?
                                            endif;
                                            ?>
                                            <span class="sum-name"><?= $arHeader["name"]; ?>:</span>
                                            <span><?= $arItem[$arHeader["id"]]; ?></span>
                                    <?
                                            if ($arHeader["id"] == "SUM"):
                                            ?>
                                        </div>
                                    <?
                                    endif;
                                    ?>
                                    </td>
                                    <?
                                endif;
                            endforeach;

                            if ($bDelayColumn || $bDeleteColumn):
                                ?>
                                <td class="control">
                                    <? if ($bDeleteColumn): ?>
                                        <?
                                        $tugle = false;
                                        foreach ($arItem['PROPS'] as $prop) {
                                            if ($prop['CODE'] == 'SET_DOP') {
                                                $tugle = true;
                                                $delUrl = "?BasketRefresh=Y&DELETE_" . $arItem['ID'] .= "=Y";
                                                foreach ($arItem['PRODUCT_DEl'] as $val) {
                                                    $delUrl = $delUrl . '&DELETE_' . $val . "=Y";
                                                } ?>
                                                <?
                                            } ?>
                                            <?
                                        } ?>
                                        <? if ($tugle) {
                                            ?>
                                            <a href="<?=SITE_DIR?>personal/cart/<?= $delUrl; ?>"><?= GetMessage("SALE_DELETE") ?></a>
                                            <?
                                        } else {
                                            ?>
                                            <a href="<?= str_replace("#ID#", $arItem["ID"], $arUrls["delete"]) ?>"
                                               onclick="return deleteProductRow(this)"><?= GetMessage("SALE_DELETE") ?></a>
                                            <?
                                        } ?>
                                        <?
                                    endif;
                                    if ($bDelayColumn):
                                        $tugle = false;
                                        foreach ($arItem['PROPS'] as $prop) {
                                            if ($prop['CODE'] == 'SET_DOP') {
                                                $tugle = true;
                                                $delayUrl = "?basketAction=delay" . $arItem['ID'] .= "=Y";
                                                foreach ($arItem['PRODUCT_DElAY'] as $val) {
                                                    $delayUrl = $delayUrl . '&id' . $val . "=Y";
                                                } ?>
                                                <?
                                            } ?>
                                            <?
                                        } ?>
                                        <? if ($tugle) {
                                        ?>
                                        <a href="<?=SITE_DIR?>personal/cart/<?= $delayUrl; ?>"><?= GetMessage("SALE_DELAY") ?></a>
                                        <?
                                    } else {
                                        ?>
                                        <a href="<?= str_replace("#ID#", $arItem["ID"], $arUrls["delay"]) ?>"><?= GetMessage("SALE_DELAY") ?></a>
                                        <?
                                    } ?>
                                        <?
                                    endif;
                                    ?>
                                </td>
                                <?
                            endif;
                            ?>
                            <!--							<td class="margin"></td>-->
                        </tr>
                        <?
                    endif;
                endforeach;
                ?>
                </tbody>
            </table>
        </div>
        <input type="hidden" id="column_headers" value="<?= htmlspecialcharsbx(implode($arHeaders, ",")) ?>"/>
        <input type="hidden" id="offers_props"
               value="<?= htmlspecialcharsbx(implode($arParams["OFFERS_PROPS"], ",")) ?>"/>
        <input type="hidden" id="action_var" value="<?= htmlspecialcharsbx($arParams["ACTION_VARIABLE"]) ?>"/>
        <input type="hidden" id="quantity_float" value="<?= ($arParams["QUANTITY_FLOAT"] == "Y") ? "Y" : "N" ?>"/>
        <input type="hidden" id="price_vat_show_value"
               value="<?= ($arParams["PRICE_VAT_SHOW_VALUE"] == "Y") ? "Y" : "N" ?>"/>
        <input type="hidden" id="hide_coupon" value="<?= ($arParams["HIDE_COUPON"] == "Y") ? "Y" : "N" ?>"/>
        <input type="hidden" id="use_prepayment" value="<?= ($arParams["USE_PREPAYMENT"] == "Y") ? "Y" : "N" ?>"/>
        <input type="hidden" id="auto_calculation" value="<?= ($arParams["AUTO_CALCULATION"] == "N") ? "N" : "Y" ?>"/>

        <div class="bx_ordercart_order_pay-box">
            <div class="table-over">
                <div class="bx_ordercart_order_pay left" id="coupons_block">
                    <?
                    if ($arParams["HIDE_COUPON"] != "Y") {
                        ?>
                        <div class="bx_ordercart_coupon">
<!--                        <span>--><?//= GetMessage("STB_COUPON_PROMT") ?><!--</span>-->
                        <div class="input-box">
                            <input type="text" id="coupon" name="COUPON" value="" onchange="enterCoupon();" placeholder="<?= GetMessage("STB_COUPON_PROMT") ?>">
                            <a class="bx_bt_button bx_big" href="javascript:void(0)" onclick="enterCoupon();"
                               title="<?= GetMessage('SALE_COUPON_APPLY_TITLE'); ?>"></a>
                        </div>
                        </div><?
                        if (!empty($arResult['COUPON_LIST'])) {
                            foreach ($arResult['COUPON_LIST'] as $oneCoupon) {
                                $couponClass = 'disabled';
                                switch ($oneCoupon['STATUS']) {
                                    case DiscountCouponsManager::STATUS_NOT_FOUND:
                                    case DiscountCouponsManager::STATUS_FREEZE:
                                        $couponClass = 'bad';
                                        break;
                                    case DiscountCouponsManager::STATUS_APPLYED:
                                        $couponClass = 'good';
                                        break;
                                }
                                ?>
                                <div class="bx_ordercart_coupon"><input disabled readonly type="text"
                                                                        name="OLD_COUPON[]"
                                                                        value="<?= htmlspecialcharsbx($oneCoupon['COUPON']); ?>"
                                                                        class="<? echo $couponClass; ?>"><span
                                        class="<? echo $couponClass; ?>"
                                        data-coupon="<? echo htmlspecialcharsbx($oneCoupon['COUPON']); ?>"></span>
                                <div class="bx_ordercart_coupon_notes"><?
                                    if (isset($oneCoupon['CHECK_CODE_TEXT'])) {
                                        echo(is_array($oneCoupon['CHECK_CODE_TEXT']) ? implode('<br>', $oneCoupon['CHECK_CODE_TEXT']) : $oneCoupon['CHECK_CODE_TEXT']);
                                    }
                                    ?></div></div><?
                            }
                            unset($couponClass, $oneCoupon);
                        }
                    } else {
                        ?>&nbsp;<?
                    }
                    ?>
                </div>
                <div class="bx_ordercart_order_pay right">
                    <div class="bx_ordercart_order_sum">
                        <? if ($bWeightColumn && floatval($arResult['allWeight']) > 0): ?>
                                <span class="custom_t1"><?= GetMessage("SALE_TOTAL_WEIGHT") ?></span>
                                <span class="custom_t2" id="allWeight_FORMATED"><?= $arResult["allWeight_FORMATED"] ?></span>
                        <? endif; ?>
                        <? if ($arParams["PRICE_VAT_SHOW_VALUE"] == "Y"): ?>
                            <div style="display: none;">
                                <span><? echo GetMessage('SALE_VAT_EXCLUDED') ?></span>
                                <span id="allSum_wVAT_FORMATED"><?= $arResult["allSum_wVAT_FORMATED"] ?></span>
                            </div>
                            <?
                            $showTotalPrice = (float)$arResult["DISCOUNT_PRICE_ALL"] > 0;
                            ?>
                                <!--							<span class="custom_t1"></span>-->
                                <span class="custom_t2" id="PRICE_WITHOUT_DISCOUNT">
								<?= ($showTotalPrice ? $arResult["PRICE_WITHOUT_DISCOUNT"] : ''); ?></span>
                            <?
                            if (floatval($arResult['allVATSum']) > 0):
                                ?>
                                    <span><? echo GetMessage('SALE_VAT') ?></span>
                                    <span id="allVATSum_FORMATED"><?= $arResult["allVATSum_FORMATED"] ?></span>
                                <?
                            endif;
                            ?>
                        <? endif; ?>
                        <div style="line-height: 20px;">
                            <span class="fwb name-sale_total"><?= GetMessage("SALE_TOTAL") ?></span>
                            <span id="allSum_FORMATED"><?= $arResult["allSum_FORMATED"] ?></span>
                        </div>


                    </div>
                    <div style="clear:both;"></div>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div class="bx_ordercart_order_pay_center">

                <span class="global_del_basket"><?= GetMessage("DEL_BASKET") ?></span>

                <? if ($arParams["USE_PREPAYMENT"] == "Y" && strlen($arResult["PREPAY_BUTTON"]) > 0): ?>
                    <?= $arResult["PREPAY_BUTTON"] ?>
                    <span><?= GetMessage("SALE_OR") ?></span>
                <? endif; ?>
                <?
                if ($arParams["AUTO_CALCULATION"] != "Y") {
                    ?>
                    <a href="javascript:void(0)" onclick="updateBasket();"
                       class="checkout refresh btn_anim"><span><?= GetMessage("SALE_REFRESH") ?></span></a>
                    <?
                }
                ?>
                <a href="javascript:void(0)" onclick="checkOut();" class="checkout btn_anim"><span><?= GetMessage("SALE_ORDER") ?></span></a>
            </div>
        </div>
    </div>
    <?
else:
    ?>
    <div id="basket_items_list">
        <table>
            <tbody>
            <tr>
                <td style="text-align:center">
                    <div class=""><?= GetMessage("SALE_NO_ITEMS"); ?></div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <?
endif;