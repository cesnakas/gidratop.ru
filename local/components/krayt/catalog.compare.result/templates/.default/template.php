

    <? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>


    <? if (count($arResult["ITEMS_TO_ADD"]) > 0): ?>
            <form action="<?= $APPLICATION->GetCurPageParam("SECTION={$arParams['SECTION']}"); ?>" method="get">
                <input type="hidden" name="IBLOCK_ID" value="<?= $arParams["IBLOCK_ID"] ?>"/>
                <input type="hidden" name="action" value="ADD_TO_COMPARE_RESULT"/>
                <select name="id">
                    <? foreach ($arResult["ITEMS_TO_ADD"] as $ID => $NAME): ?>
                        <option value="<?= $ID ?>"><?= $NAME ?></option>
                    <? endforeach ?>
                </select>
                <input type="submit" value="<?= GetMessage("CATALOG_ADD_TO_COMPARE_LIST") ?>"/>
            </form>
    <? endif ?>
    <div class="container-fluid">
        <div class="catalog-compare-result">
            <div class="head clear">
                <h1><?= GetMessage("TITLE_COMPARE") ?></h1>
                <div class="control">
                    <noindex>
                        <form class="compare-switch" name="compare-switch">

                            <? if ($arResult["DIFFERENT"]) { ?>
                                <div class="switch">
                                    <input type="checkbox" id="switch" class="switch-check" checked="checked">
                                    <label for="switch" class="switch-label"><span></span></label>
                                </div>

                                <div class="compare-switch-link">
                                    <a class="active btn_anim"
                                       href="<?= htmlspecialcharsbx($APPLICATION->GetCurPageParam("DIFFERENT=N", array("DIFFERENT"))) ?>"
                                       rel="nofollow"><div  class="text"><?= GetMessage("CATALOG_ALL_CHARACTERISTICS") ?></div></a>
                                    <span><?= GetMessage("CATALOG_ONLY_DIFFERENT") ?></span>
                                </div>
                            <? } else { ?>
                                <div class="switch">
                                    <input type="checkbox" id="switch" class="switch-check">
                                    <label for="switch" class="switch-label"><span></span></label>
                                </div>

                                <div class="compare-switch-link">
                                    <span><?= GetMessage("CATALOG_ALL_CHARACTERISTICS") ?></span>
                                    <a class="active btn_anim"
                                       href="<?= htmlspecialcharsbx($APPLICATION->GetCurPageParam("DIFFERENT=Y", array("DIFFERENT"))) ?>"
                                       rel="nofollow"><div class="text"><?= GetMessage("CATALOG_ONLY_DIFFERENT") ?></div></a>
                                </div>
                            <? } ?>

                        </form>
                    </noindex>
                </div>

                <form class="compare_item_form" name="compare_item_form" action="<?= $APPLICATION->GetCurPage() ?>"
                      method="get">
                    <input type="hidden" name="SECTION" value="<?= $arParams['SECTION'] ?>"/>
                    <div class="item-list emarket-mSlider">
                        <div class="mSlider-wrap">
                            <ul class="mSlider-window">
                                <? foreach ($arResult["ITEMS"] as $key => $arElement) { ?>

                                    <li data-slide="<?= $key ?>" class="slide <? if (!$key) echo 'current'; ?>">
                                        <? //echo '<pre>'; print_r($arElement); echo '</pre>';?>
                                        <div class="slide-wrap">
                                            <div class="slide-item">
                                                <div class="picture">
                                                    <a href="<?= $arElement['DETAIL_PAGE_URL'] ?>"
                                                       title="<?= $arElement['NAME'] ?>">
                                                        <? if ($arElement['PREVIEW_PICTURE']["SRC"]): ?>
                                                            <!--<img src="<?= $arElement['PREVIEW_PICTURE']["SRC"] ?>" alt="<?= $arElement['NAME'] ?>"> !-->
                                                            <div class="img_item_compare"
                                                                 style="background-image: url(<?= $arElement['PREVIEW_PICTURE']["SRC"] ?>);">

                                                            </div>

                                                        <? else: ?>
                                                            <!-- <img src="<?= $arElement['DETAIL_PICTURE']["SRC"] ?>" alt="<?= $arElement['NAME'] ?>">  !-->
                                                            <div class="img_item_compare"
                                                                 style="background-image: url(<?= $arElement['DETAIL_PICTURE']["SRC"] ?>);"></div>
                                                        <? endif; ?>
                                                    </a>
                                                </div>
                                                <a class="link"
                                                   href="<?= $arElement['DETAIL_PAGE_URL'] ?>"><?= $arElement['NAME'] ?></a>


                                                <? if ($arElement["PRICES"]['Rub']["CAN_ACCESS"]): ?>
                                                    <b><?= $arElement["PRICES"]['Rub']["PRINT_DISCOUNT_VALUE"] ?></b>
                                                <? endif; ?>
                                                <div class="mdi mdi-close open_hint">
                                                    <input type="submit" name="ID[]" value="<?= $arElement["ID"] ?>"
                                                           class="close">
                                                    <div class="hint"><?=GetMessage("DEL_IN_TOVAR");?></div>
                                                </div>

                                                <div class="price">

                                                    <? if ($arElement["PRICES"]["BASE"]["DISCOUNT_DIFF_PERCENT"]): ?>
                                                        <span class="current_price"><?= $arElement["PRICES"]["BASE"]["PRINT_DISCOUNT_VALUE_NOVAT"] ?></span>
                                                        <span class="old_price"><?= $arElement["PRICES"]["BASE"]["PRINT_VALUE_NOVAT"] ?></span>
                                                    <? else: ?>
                                                        <span class="current_price"><?= $arElement["PRICES"]["BASE"]["PRINT_VALUE_NOVAT"] ?></span>
                                                    <? endif; ?>
                                                </div>
                                            </div>

                                        </div>
                                    </li>

                                <? } ?>
                            </ul>
                        </div>
                        <a href="/error_js.php" class="mdi mdi-chevron-left mSlider-prev"></a>
                        <a href="/error_js.php" class="mdi mdi-chevron-right mSlider-next"></a>
                    </div>
                    <input type="hidden" name="action" value="DELETE_FROM_COMPARE_RESULT"/>
                    <input type="hidden" name="IBLOCK_ID" value="<?= $arParams["IBLOCK_ID"] ?>"/>
                    <div class="clearfix"></div>
                </form>
            </div>
            <?
            $arPropNoEmpty = array();
            foreach ($arResult["SHOW_PROPERTIES"] as $code => $arProperty) {
                foreach ($arResult["ITEMS"] as $key => $arElement) {
                    if (empty($arElement["DISPLAY_PROPERTIES"][$code]["VALUE"])) {
                        unset($arPropNoEmpty[$code]);
                    } else {
                        $arPropNoEmpty[$code] = $arProperty;
                    }
                }
            } ?>
            <div class="property-list">
                <h2><?= GetMessage("CATALOG_CHARACTERISTICS") ?></h2>
                <div class="clear" style="margin-bottom:-3px;">
                    <? foreach ($arPropNoEmpty as $code => $arProperty):
                        $arCompare = Array();
                        foreach ($arResult["ITEMS"] as $arElement) {
                            $arPropertyValue = $arElement["DISPLAY_PROPERTIES"][$code]["VALUE"];
                            if (is_array($arPropertyValue)) {
                                sort($arPropertyValue);
                                $arPropertyValue = implode(" / ", $arPropertyValue);
                            }
                            $arCompare[] = $arPropertyValue;
                        }
                        $diff = (count(array_unique($arCompare)) > 1 ? true : false);
                        if ($diff || !$arResult["DIFFERENT"]):?>
                            <div class="property-name"><p><?= $arProperty["NAME"] ?></p></div>
                            <div class="property-value emarket-mSlider">
                                <div class="mSlider-wrap">
                                    <ul class="mSlider-window">
                                        <? foreach ($arResult["ITEMS"] as $key => $arElement) { ?>
                                            <li data-slide="<?= $key ?>"
                                                class="slide-prop <? if (!$key) echo 'current'; ?>">
                                                <div class="slide-wrap"><p>
                                                        <?
                                                        if ($diff) {
                                                            if (is_array($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])) {
                                                                echo implode(" ", $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]);
                                                            } else {
                                                                if ($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"] == 'Y')
                                                                    echo ' ';
                                                                else
                                                                    echo $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"];
                                                            }
                                                        } else {
                                                            if (is_array($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"])) {
                                                                echo implode("", $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]);
                                                            } else {
                                                                if ($arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"] == 'Y')
                                                                    echo ' ';
                                                                else
                                                                    echo $arElement["DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"];
                                                            }
                                                        }
                                                        ?>&nbsp;
                                                    </p></div>
                                            </li>
                                        <? } ?>
                                    </ul>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                        <? endif ?>
                    <? endforeach; ?>
                </div>
            </div>


            <table>
                <? foreach ($arResult["SHOW_OFFER_FIELDS"] as $code):
                    $arCompare = Array();
                    foreach ($arResult["ITEMS"] as $arElement) {
                        $Value = $arElement["OFFER_FIELDS"][$code];
                        if (is_array($Value)) {
                            sort($Value);
                            $Value = implode(" / ", $Value);
                        }
                        $arCompare[] = $Value;
                    }
                    $diff = (count(array_unique($arCompare)) > 1 ? true : false);
                    if ($diff || !$arResult["DIFFERENT"]):?>
                        <tr>
                            <th valign="top" nowrap>&nbsp;<?= GetMessage("IBLOCK_FIELD_" . $code) ?>&nbsp;</th>
                            <? foreach ($arResult["ITEMS"] as $arElement): ?>
                                <? if ($diff): ?>
                                    <td valign="top">&nbsp;
                                        <?= (is_array($arElement["OFFER_FIELDS"][$code]) ? implode("/ ", $arElement["OFFER_FIELDS"][$code]) : $arElement["OFFER_FIELDS"][$code]) ?>
                                    </td>
                                <? else: ?>
                                    <th valign="top">&nbsp;
                                        <?= (is_array($arElement["OFFER_FIELDS"][$code]) ? implode("/ ", $arElement["OFFER_FIELDS"][$code]) : $arElement["OFFER_FIELDS"][$code]) ?>
                                    </th>
                                <? endif ?>
                            <? endforeach ?>
                        </tr>
                    <? endif ?>
                <? endforeach; ?>


                <? foreach ($arResult["SHOW_OFFER_PROPERTIES"] as $code => $arProperty):
                    $arCompare = Array();
                    foreach ($arResult["ITEMS"] as $arElement) {
                        $arPropertyValue = $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["VALUE"];
                        if (is_array($arPropertyValue)) {
                            sort($arPropertyValue);
                            $arPropertyValue = implode(" / ", $arPropertyValue);
                        }
                        $arCompare[] = $arPropertyValue;
                    }
                    $diff = (count(array_unique($arCompare)) > 1 ? true : false);
                    if ($diff || !$arResult["DIFFERENT"]):?>
                        <tr>
                            <th valign="top" nowrap>&nbsp;<?= $arProperty["NAME"] ?>&nbsp;</th>
                            <? foreach ($arResult["ITEMS"] as $arElement): ?>
                                <? if ($diff): ?>
                                    <td valign="top">&nbsp;
                                        <?= (is_array($arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) ? implode("/ ", $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) : $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) ?>
                                    </td>
                                <? else: ?>
                                    <th valign="top">&nbsp;
                                        <?= (is_array($arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) ? implode("/ ", $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) : $arElement["OFFER_DISPLAY_PROPERTIES"][$code]["DISPLAY_VALUE"]) ?>
                                    </th>
                                <? endif ?>
                            <? endforeach ?>
                        </tr>
                    <? endif ?>
                <? endforeach; ?>
            </table>
        </div>
        <div class="compare-del-btn">
            <a class="btn_anim" href="<?= $_SERVER['REQUEST_URI'] ?>&action_del=DELETE_COMPARE" rel="nofollow">
                <span href="<?= $_SERVER['REQUEST_URI'] ?>&action_del=DELETE_COMPARE"
                      rel="nofollow"><?= GetMessage("CLIRING"); ?></span>
            </a>
        </div>
    </div>

