<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$templateData = array(
    'TEMPLATE_THEME' => $this->GetFolder() . '/themes/' . $arParams['TEMPLATE_THEME'] . '/colors.css',
    'TEMPLATE_CLASS' => 'bx-' . $arParams['TEMPLATE_THEME']
);

if (isset($templateData['TEMPLATE_THEME'])) {
    $this->addExternalCss($templateData['TEMPLATE_THEME']);
}
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
$this->addExternalCss("/bitrix/css/main/font-awesome.css");
?>

<div class="title-open_filter"><?=GetMessage("TITLE_FILTER");?></div>

<div class="bx-filter opened_filter bx-green <? if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL") echo "bx-filter-horizontal" ?>">
    <div class="row m_none">
        <div class="bx-filter-section container-fluid">
            <form name="<? echo $arResult["FILTER_NAME"] . "_form" ?>" action="<? echo $arResult["FORM_ACTION"] ?>"
                  method="get" class="smartfilter">
                <? foreach ($arResult["HIDDEN"] as $arItem): ?>
                    <input type="hidden" name="<? echo $arItem["CONTROL_NAME"] ?>" id="<? echo $arItem["CONTROL_ID"] ?>"
                           value="<? echo $arItem["HTML_VALUE"] ?>"/>
                <? endforeach; ?>
                <div class="row m_none filter_wrapper">
                    <div class="main_filter_title">
                        <?=\Bitrix\Main\Localization\Loc::getMessage('TITLE_FILTER')?>
                    </div>
                    <div class="filter_content">
                    <div class="filter_price_cont">
                        <div class="filter_price_block style__filter">
                            <div class="bx-filter-parameters-box-title filter_title">
                                <span><?= $arItem["NAME"] ?></span>
                                <i class="trigger-arrow"></i>
                                <span><?=\Bitrix\Main\Localization\Loc::getMessage('TITLE_PRICE')?></span>
                            </div>
                            <? foreach ($arResult["ITEMS"] as $key => $arItem)//prices
                            {
                                $key = $arItem["ENCODED_ID"];
                                if (isset($arItem["PRICE"])):
                                    if ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0)
                                        continue;

                                    $step_num = 4;
                                    $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / $step_num;
                                    $prices = array();
                                    if (Bitrix\Main\Loader::includeModule("currency")) {
                                        for ($i = 0; $i < $step_num; $i++) {
                                            $prices[$i] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MIN"]["VALUE"] + $step * $i, $arItem["VALUES"]["MIN"]["CURRENCY"], false);
                                        }
                                        $prices[$step_num] = CCurrencyLang::CurrencyFormat($arItem["VALUES"]["MAX"]["VALUE"], $arItem["VALUES"]["MAX"]["CURRENCY"], false);
                                    } else {
                                        $precision = $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0;
                                        for ($i = 0; $i < $step_num; $i++) {
                                            $prices[$i] = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * $i, $precision, ".", "");
                                        }
                                        $prices[$step_num] = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                                    }
                                    ?>
                                    <div class="opened_list-filter">
                                        <div class="<? if ($arParams["FILTER_VIEW_MODE"] == "HORIZONTAL"):?><?
                                        else:?>col-lg-12<?endif ?> bx-filter-parameters-box bx-active">
                                            <span class="bx-filter-container-modef"></span>
                                            <div class="bx-filter-block" data-role="bx_filter_block">
                                                <div class="row bx-filter-parameters-box-container">
                                                    <div class="input__box ">
                                                        <div class="bx-filter-parameters-box-container-block bx-left">
                                                            <span class="bx-ft-sub"><?= GetMessage("CT_BCSF_FILTER_FROM") ?></span>
                                                            <div class="bx-filter-input-container">
                                                                <input
                                                                        class="min-price"
                                                                        type="text"
                                                                        name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                                                        id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                                                        value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                                                        size="5"
                                                                        onkeyup="smartFilter.keyup(this)"
                                                                />
                                                            </div>
                                                        </div>
                                                        <span class="dash__line"></span>
                                                        <div class="bx-filter-parameters-box-container-block bx-right">
                                                            <span class="bx-ft-sub"><?= GetMessage("CT_BCSF_FILTER_TO") ?></span>
                                                            <div class="bx-filter-input-container">
                                                                <input
                                                                        class="max-price"
                                                                        type="text"
                                                                        name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                                                        id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                                                        value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                                                        size="5"
                                                                        onkeyup="smartFilter.keyup(this)"
                                                                />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="bx-ui-slider-track-container">
                                                        <div class="bx-ui-slider-track" id="drag_track_<?= $key ?>">
                                                            <?
                                                            $precision = $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0;
                                                            $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 5;
                                                            $value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
                                                            $value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
                                                            $value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
                                                            $value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
                                                            $value5 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 4, $precision, ".", "");
                                                            $value6 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                                                            ?>
                                                            <div class="bx-ui-slider-part big1">
                                                                <span><?= $value1 ?></span></div>
                                                            <div class="bx-ui-slider-part big2">
                                                                <span><?= $value2 ?></span></div>
                                                            <div class="bx-ui-slider-part big3">
                                                                <span><?= $value3 ?></span></div>
                                                            <div class="bx-ui-slider-part big4">
                                                                <span><?= $value4 ?></span></div>
                                                            <div class="bx-ui-slider-part big5">
                                                                <span><?= $value5 ?></span></div>
                                                            <div class="bx-ui-slider-part big6">
                                                                <span><?= $value5 ?></span></div>
                                                            <!--                                                --><?//for($i = 0; $i <= $step_num; $i++):
                                                            ?>
                                                            <!--                                                <div class="bx-ui-slider-part p-->
                                                            <?//=$i+1
                                                            ?><!--"><span>--><?//=$prices[$i]
                                                            ?><!--</span></div>-->
                                                            <!--                                                --><?//endfor;
                                                            ?>

                                                            <div class="bx-ui-slider-pricebar-vd"
                                                                 style="left: 0;right: 0;"
                                                                 id="colorUnavailableActive_<?= $key ?>"></div>
                                                            <div class="bx-ui-slider-pricebar-vn"
                                                                 style="left: 0;right: 0;"
                                                                 id="colorAvailableInactive_<?= $key ?>"></div>
                                                            <div class="bx-ui-slider-pricebar-v"
                                                                 style="left: 0;right: 0;"
                                                                 id="colorAvailableActive_<?= $key ?>"></div>
                                                            <div class="bx-ui-slider-range"
                                                                 id="drag_tracker_<?= $key ?>"
                                                                 style="left: 0%; right: 0%;">
                                                                <a class="bx-ui-slider-handle left" style="left:0;"
                                                                   href="javascript:void(0)"
                                                                   id="left_slider_<?= $key ?>"></a>
                                                                <a class="bx-ui-slider-handle right" style="right:0;"
                                                                   href="javascript:void(0)"
                                                                   id="right_slider_<?= $key ?>"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--                                        <div class="filter_prise_diopozon">-->
                                        <!--                                            --><?// for ($i = 0; $i <= $step_num - 1; $i++):?>
                                        <!--                                                --><?// $min = str_replace(' ', '', $prices[$i]);
                                        //                                                $max = str_replace(' ', '', $prices[$i + 1]); ?>
                                        <!--                                                <div class="range__item"><span data-otprice="--><?//= $min ?><!--"-->
                                        <!--                                                                               data-doprice="--><?//= $max ?><!--">--><?//= $prices[$i] ?>
                                        <!--                                                        - --><?//= $prices[$i + 1] ?><!-- </span></div>-->
                                        <!--                                            --><?//endfor; ?>
                                        <!--                                        </div>-->
                                    </div>
                                <?
                                $arJsParams = array(
                                    "leftSlider" => 'left_slider_' . $key,
                                    "rightSlider" => 'right_slider_' . $key,
                                    "tracker" => "drag_tracker_" . $key,
                                    "trackerWrap" => "drag_track_" . $key,
                                    "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                                    "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                                    "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                                    "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                                    "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                    "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                    "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"],
                                    "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                                    "precision" => $precision,
                                    "colorUnavailableActive" => 'colorUnavailableActive_' . $key,
                                    "colorAvailableActive" => 'colorAvailableActive_' . $key,
                                    "colorAvailableInactive" => 'colorAvailableInactive_' . $key,
                                );
                                ?>
                                    <script type="text/javascript">
                                        BX.ready(function () {
                                            window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                                        });
                                    </script>
                                <?endif;
                            } ?>
                        </div>
                    </div>
                    <div class="filter_other_cont">
                    <div class="filter_l_block">
                        <? foreach ($arResult["ITEMS"] as $key => $arItem){
                        if (empty($arItem["VALUES"]) || isset($arItem["PRICE"]))
                            continue;
                        if ($arItem["DISPLAY_TYPE"] == "A" && ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0))
                            continue;
                        if ($arItem['CODE'] != "BREND")
                            continue;
                        ?>
                        <div class=" filter_title">
                            <span><?= $arItem['NAME']; ?></span>
                            <i class="trigger-arrow"></i>
                        </div>
                        <div class="box-brand opened_list-filter">
                            <div class="filter_brend_block">
                                <div class="c-brand__list">
                                    <? foreach ($arItem["VALUES"] as $val => $ar): ?>
                                        <div class="checkbox hidden_collection">
                                            <div class="bx-filter-param-text"
                                                 for="<? echo $ar["CONTROL_ID"] ?>">
                                                            <span class="bx-filter-input-checkbox">
                                                                <label  data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                                        for="<? echo $ar["CONTROL_ID"] ?>"
                                                                        class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled' : '' ?>"
                                                                        title="<?= $ar["VALUE"]; ?>">

                                                                    <input
                                                                            type="checkbox"
                                                                            value="<? echo $ar["HTML_VALUE"] ?>"
                                                                            name="<? echo $ar["CONTROL_NAME"] ?>"
                                                                            id="<? echo $ar["CONTROL_ID"] ?>"
                                                                            <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                                            onclick="smartFilter.click(this)"
                                                                            <? echo $ar["DISABLED"] ? 'disabled="disabled"' : '' ?>
                                                                    />
                                                                    <span class="checkbox-custom"></span>
                                                                    <span class="checkbox-name"><?= $ar["VALUE"]; ?></span>

                                                                    <? if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                                        ?>(<span
                                                                            data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                                    endif; ?>
                                                                </label>
                                                            </span>
                                            </div>
                                        </div>
                                    <? endforeach; ?>
                                </div>
                                <? } ?>
                            </div>
                            <div class="botton_colection"><span><?=GetMessage("VIBOR_SERII");?></span></div>
                        </div>
                    </div>
                    <div class="filter_r_block">

                        <? foreach ($arResult["ITEMS"] as $key => $arItem) {
                            if ($arItem['CODE'] == "COLLECTION"):?>
                                <div class="filter_collection_block">
                                    <div class="title_box"><?= $arItem['NAME']; ?>
                                        <div class="close"></div>
                                    </div>
                                    <div class="collection_list">
                                        <!--                                    <div class="name_brand_collection">-->
                                        <? //=$ar["VALUE"];
                                        ?><!--</div>-->
                                        <? foreach ($arItem["VALUES"] as $val => $ar):?>
                                            <div class="checkbox">
                                                                <span class="bx-filter-input-checkbox">
                                            <label data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                   class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled' : '' ?>"
                                                   for="<? echo $ar["CONTROL_ID"] ?>">
                                                                    <input
                                                                            type="checkbox"
                                                                            value="<? echo $ar["HTML_VALUE"] ?>"
                                                                            name="<? echo $ar["CONTROL_NAME"] ?>"
                                                                            id="<? echo $ar["CONTROL_ID"] ?>"
                                                                            <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                                            onclick="smartFilter.click(this)"
                                                                            <? echo $ar["DISABLED"] ? 'disabled="disabled"' : '' ?>

                                                                    />
                                                                    <span class="checkbox-custom"></span>
                                                                    <span class="checkbox-name"><?= $ar["VALUE"]; ?></span>
                                                                    <?
                                                                        if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                                            ?>&nbsp;(<span
                                                                                data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                                        endif; ?>
                                            </label>
                                            </div>
                                        <? endforeach; ?>
                                    </div>
                                </div>
                            <? endif; ?>
                        <? } ?>
                        <div class="filter_bottom_block style__filter">
                            <div class="title filter_title">
                                <span><?=GetMessage("HARACTERISTIKA");?></span>
                                <i class="trigger-arrow"></i>
                            </div>
                            <div class="opened_list-filter">
                                <div class="box__cont">
                                    <? //not prices
                                    $count_block = ceil($arResult['COUNT_BLOCK'] / 2);
                                    $i=1;?>
                                    <div class="left_block_filter">
                                    <?foreach ($arResult["ITEMS"] as $key => $arItem) {
                                        if (
                                            empty($arItem["VALUES"])
                                            || isset($arItem["PRICE"])
                                        ) {
                                            continue;
                                        }
                                        if ($arItem["DISPLAY_TYPE"] == "A" && (
                                                $arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"] <= 0
                                            )
                                        ){
                                            continue;}
                                        if ($arItem['CODE'] == "BREND" || $arItem['CODE'] == "COLLECTION") {
                                            continue;
                                        }
                                        ?>
                                        <div class="bx-filter-parameters-box
                                            <?
                                            $open = false;
                                            foreach ($arItem['VALUES'] as $val){
                                                if($arItem["DISPLAY_TYPE"] == "F" && $val['CHECKED'] == true){
                                                    $open = true;
                                                }
                                                if ($arItem["DISPLAY_TYPE"] == "B" && !empty($val["HTML_VALUE"]) ||$arItem["DISPLAY_TYPE"] == "B" && !empty($val["HTML_VALUE"])){
                                                    $open = true;
                                                }
                                                if($arItem["DISPLAY_TYPE"] == "K" && $val['CHECKED'] == true){
                                                    $open = true;
                                                }
                                            }
                                            if ($open){
                                                echo "bx-active";
                                            }?>
                                            ">
<!--                                            --><?// if ($arItem["DISPLAY_EXPANDED"] == "Y"):?><!--bx-active--><?//endif ?>
<!--                                            <div class="bx-filter-parameters-box_open">-->
                                            <span class="bx-filter-container-modef"></span>
                                            <div class="bx-filter-parameters-box-title">
<!--                                                     onclick="smartFilter.hideFilterProps(this)">-->
                                                        <span class="bx-filter-parameters-box-hint"><?= $arItem["NAME"] ?>
                                                            <i data-role="prop_angle"
                                                               class="fa fa-angle-<? if ($arItem["DISPLAY_EXPANDED"] == "Y"):?>up<?
                                                               else:?>down<?endif ?>"></i>
                                                        </span>
                                                    <? if ($arItem["FILTER_HINT"] <> ""):?>
                                                        <i id="item_title_hint_<? echo $arItem["ID"] ?>"
                                                           class="fa fa-question-circle"></i>
                                                        <script type="text/javascript">
                                                            new top.BX.CHint({
                                                                parent: top.BX("item_title_hint_<?echo $arItem["ID"]?>"),
                                                                show_timeout: 10,
                                                                hide_timeout: 200,
                                                                dx: 2,
                                                                preventHide: true,
                                                                min_width: 250,
                                                                hint: '<?= CUtil::JSEscape($arItem["FILTER_HINT"])?>'
                                                            });
                                                        </script>
                                                    <?endif ?>
                                                </div>

                                            <div class="bx-filter-block" data-role="bx_filter_block" <?if($open === true){ echo "style='display:block'";}?>>
                                                <div class="bx-filter-parameters-box-container filter_range">
                                                    <?
                                                    $arCur = current($arItem["VALUES"]);
                                                    switch ($arItem["DISPLAY_TYPE"]) {
                                                    case "A"://NUMBERS_WITH_SLIDER
                                                        ?>
                                                        <div class="bx-filter-parameters-box-container-block bx-left ">
<!--                                                            <i class="bx-ft-sub">--><?//= GetMessage("CT_BCSF_FILTER_FROM") ?><!--</i>-->
                                                            <div class="bx-filter-input-container">
                                                                <input
                                                                        class="min-price"
                                                                        type="text"
                                                                        name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                                                        id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                                                        value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                                                        size="5"
                                                                        onkeyup="smartFilter.keyup(this)"
                                                                />
                                                            </div>
                                                        </div>
                                                        <span class="dash__line"></span>
                                                        <div class="bx-filter-parameters-box-container-block bx-right">
<!--                                                            <i class="bx-ft-sub">--><?//= GetMessage("CT_BCSF_FILTER_TO") ?><!--</i>-->
                                                            <div class="bx-filter-input-container">
                                                                <input
                                                                        class="max-price"
                                                                        type="text"
                                                                        name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                                                        id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                                                        value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                                                        size="5"
                                                                        onkeyup="smartFilter.keyup(this)"
                                                                />
                                                            </div>
                                                        </div>

                                                        <div class="bx-ui-slider-track-container">
                                                            <div class="bx-ui-slider-track" id="drag_track_<?= $key ?>">
                                                                <?
                                                                $precision = $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0;
                                                                $step = ($arItem["VALUES"]["MAX"]["VALUE"] - $arItem["VALUES"]["MIN"]["VALUE"]) / 4;
                                                                $value1 = number_format($arItem["VALUES"]["MIN"]["VALUE"], $precision, ".", "");
                                                                $value2 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step, $precision, ".", "");
                                                                $value3 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 2, $precision, ".", "");
                                                                $value4 = number_format($arItem["VALUES"]["MIN"]["VALUE"] + $step * 3, $precision, ".", "");
                                                                $value5 = number_format($arItem["VALUES"]["MAX"]["VALUE"], $precision, ".", "");
                                                                ?>
                                                                <div class="bx-ui-slider-part p1">
                                                                    <span><?= $value1 ?></span></div>
                                                                <div class="bx-ui-slider-part p2">
                                                                    <span><?= $value2 ?></span></div>
                                                                <div class="bx-ui-slider-part p3">
                                                                    <span><?= $value3 ?></span></div>
                                                                <div class="bx-ui-slider-part p4">
                                                                    <span><?= $value4 ?></span></div>
                                                                <div class="bx-ui-slider-part p5">
                                                                    <span><?= $value5 ?></span></div>

                                                                <div class="bx-ui-slider-pricebar-vd"
                                                                     style="left: 0;right: 0;"
                                                                     id="colorUnavailableActive_<?= $key ?>"></div>
                                                                <div class="bx-ui-slider-pricebar-vn"
                                                                     style="left: 0;right: 0;"
                                                                     id="colorAvailableInactive_<?= $key ?>"></div>
                                                                <div class="bx-ui-slider-pricebar-v"
                                                                     style="left: 0;right: 0;"
                                                                     id="colorAvailableActive_<?= $key ?>"></div>
                                                                <div class="bx-ui-slider-range"
                                                                     id="drag_tracker_<?= $key ?>"
                                                                     style="left: 0;right: 0;">
                                                                    <a class="bx-ui-slider-handle left" style="left:0;"
                                                                       href="javascript:void(0)"
                                                                       id="left_slider_<?= $key ?>"></a>
                                                                    <a class="bx-ui-slider-handle right"
                                                                       style="right:0;" href="javascript:void(0)"
                                                                       id="right_slider_<?= $key ?>"></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?
                                                    $arJsParams = array(
                                                        "leftSlider" => 'left_slider_' . $key,
                                                        "rightSlider" => 'right_slider_' . $key,
                                                        "tracker" => "drag_tracker_" . $key,
                                                        "trackerWrap" => "drag_track_" . $key,
                                                        "minInputId" => $arItem["VALUES"]["MIN"]["CONTROL_ID"],
                                                        "maxInputId" => $arItem["VALUES"]["MAX"]["CONTROL_ID"],
                                                        "minPrice" => $arItem["VALUES"]["MIN"]["VALUE"],
                                                        "maxPrice" => $arItem["VALUES"]["MAX"]["VALUE"],
                                                        "curMinPrice" => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                                        "curMaxPrice" => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                                        "fltMinPrice" => intval($arItem["VALUES"]["MIN"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MIN"]["FILTERED_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"],
                                                        "fltMaxPrice" => intval($arItem["VALUES"]["MAX"]["FILTERED_VALUE"]) ? $arItem["VALUES"]["MAX"]["FILTERED_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"],
                                                        "precision" => $arItem["DECIMALS"] ? $arItem["DECIMALS"] : 0,
                                                        "colorUnavailableActive" => 'colorUnavailableActive_' . $key,
                                                        "colorAvailableActive" => 'colorAvailableActive_' . $key,
                                                        "colorAvailableInactive" => 'colorAvailableInactive_' . $key,
                                                    );
                                                    ?>
                                                        <script type="text/javascript">
                                                            BX.ready(function () {
                                                                window['trackBar<?=$key?>'] = new BX.Iblock.SmartFilter(<?=CUtil::PhpToJSObject($arJsParams)?>);
                                                            });
                                                        </script>
                                                    <?
                                                    break;
                                                    case "B"://NUMBERS
                                                    ?>
                                                        <div class="bx-filter-parameters-box-container-block bx-left">
                                                            <i class="bx-ft-sub"><?= GetMessage("CT_BCSF_FILTER_FROM") ?></i>
                                                            <div class="bx-filter-input-container">
                                                                <input
                                                                        class="min-price"
                                                                        type="text"
                                                                        name="<? echo $arItem["VALUES"]["MIN"]["CONTROL_NAME"] ?>"
                                                                        id="<? echo $arItem["VALUES"]["MIN"]["CONTROL_ID"] ?>"
                                                                        value="<? echo $arItem["VALUES"]["MIN"]["HTML_VALUE"] ?>"
                                                                        size="5"
                                                                        onkeyup="smartFilter.keyup(this)"
                                                                        placeholder="<?= $arItem["VALUES"]["MIN"]["VALUE"]; ?>"
                                                                />
                                                            </div>
                                                        </div>
                                                        <span class="dash__line"></span>
                                                        <div class="bx-filter-parameters-box-container-block bx-right">
                                                            <i class="bx-ft-sub"><?= GetMessage("CT_BCSF_FILTER_TO") ?></i>
                                                            <div class="bx-filter-input-container">
                                                                <input
                                                                        class="max-price"
                                                                        type="text"
                                                                        name="<? echo $arItem["VALUES"]["MAX"]["CONTROL_NAME"] ?>"
                                                                        id="<? echo $arItem["VALUES"]["MAX"]["CONTROL_ID"] ?>"
                                                                        value="<? echo $arItem["VALUES"]["MAX"]["HTML_VALUE"] ?>"
                                                                        size="5"
                                                                        onkeyup="smartFilter.keyup(this)"
                                                                        placeholder="<?= $arItem["VALUES"]["MAX"]["VALUE"]; ?>"
                                                                />
                                                            </div>
                                                        </div>
                                                    <?
                                                    break;
                                                    case "G"://CHECKBOXES_WITH_PICTURES
                                                    ?>
                                                        <div class="col-xs-12">
                                                            <div class="bx-filter-param-btn-inline">
                                                                <? foreach ($arItem["VALUES"] as $val => $ar):?>
                                                                    <input
                                                                            style="display: none"
                                                                            type="checkbox"
                                                                            name="<?= $ar["CONTROL_NAME"] ?>"
                                                                            id="<?= $ar["CONTROL_ID"] ?>"
                                                                            value="<?= $ar["HTML_VALUE"] ?>"
                                                                        <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                                    />
                                                                    <?
                                                                    $class = "";
                                                                    if ($ar["CHECKED"])
                                                                        $class .= " bx-active";
                                                                    if ($ar["DISABLED"])
                                                                        $class .= " disabled";
                                                                    ?>
                                                                    <label for="<?= $ar["CONTROL_ID"] ?>"
                                                                           data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                                           class="bx-filter-param-label <?= $class ?>"
                                                                           onclick="smartFilter.keyup(BX('<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')); BX.toggleClass(this, 'bx-active');">
                                                        <span class="bx-filter-param-btn bx-color-sl">
                                                            <? if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                                <span class="bx-filter-btn-color-icon"
                                                                      style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                                            <?endif ?>
                                                        </span>
                                                                    </label>
                                                                <?endforeach ?>
                                                            </div>
                                                        </div>
                                                    <?
                                                    break;
                                                    case "H"://CHECKBOXES_WITH_PICTURES_AND_LABELS
                                                    ?>
                                                        <div class="col-xs-12">
                                                            <div class="bx-filter-param-btn-block">
                                                                <? foreach ($arItem["VALUES"] as $val => $ar):?>
                                                                    <input
                                                                            style="display: none"
                                                                            type="checkbox"
                                                                            name="<?= $ar["CONTROL_NAME"] ?>"
                                                                            id="<?= $ar["CONTROL_ID"] ?>"
                                                                            value="<?= $ar["HTML_VALUE"] ?>"
                                                                        <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                                    />
                                                                    <?
                                                                    $class = "";
                                                                    if ($ar["CHECKED"])
                                                                        $class .= " bx-active";
                                                                    if ($ar["DISABLED"])
                                                                        $class .= " disabled";
                                                                    ?>
                                                                    <label for="<?= $ar["CONTROL_ID"] ?>"
                                                                           data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                                           class="bx-filter-param-label<?= $class ?>"
                                                                           onclick="smartFilter.keyup(BX('<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')); BX.toggleClass(this, 'bx-active');">
                                                        <span class="bx-filter-param-btn bx-color-sl">
                                                            <? if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                                <span class="bx-filter-btn-color-icon"
                                                                      style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                                            <?endif ?>
                                                        </span>
                                                                        <span class="bx-filter-param-text"
                                                                              title="<?= $ar["VALUE"]; ?>"><?= $ar["VALUE"]; ?><?
                                                                            if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                                                ?> (<span
                                                                                    data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                                            endif; ?></span>
                                                                    </label>
                                                                <?endforeach ?>
                                                            </div>
                                                        </div>
                                                    <?
                                                    break;
                                                    case "P"://DROPDOWN
                                                    $checkedItemExist = false;
                                                    ?>
                                                        <div class="col-xs-12">
                                                            <div class="bx-filter-select-container">
                                                                <div class="bx-filter-select-block"
                                                                     onclick="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>')">
                                                                    <div class="bx-filter-select-text"
                                                                         data-role="currentOption">
                                                                        <?
                                                                        foreach ($arItem["VALUES"] as $val => $ar) {
                                                                            if ($ar["CHECKED"]) {
                                                                                echo $ar["VALUE"];
                                                                                $checkedItemExist = true;
                                                                            }
                                                                        }
                                                                        if (!$checkedItemExist) {
                                                                            echo GetMessage("CT_BCSF_FILTER_ALL");
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="bx-filter-select-arrow"></div>
                                                                    <input
                                                                            style="display: none"
                                                                            type="radio"
                                                                            name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
                                                                            id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                                                            value=""
                                                                    />
                                                                    <? foreach ($arItem["VALUES"] as $val => $ar):?>
                                                                        <input
                                                                                style="display: none"
                                                                                type="radio"
                                                                                name="<?= $ar["CONTROL_NAME_ALT"] ?>"
                                                                                id="<?= $ar["CONTROL_ID"] ?>"
                                                                                value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                                            <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                                        />
                                                                    <?endforeach ?>
                                                                    <div class="bx-filter-select-popup"
                                                                         data-role="dropdownContent"
                                                                         style="display: none;">
                                                                        <ul>
                                                                            <li>
                                                                                <label for="<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                                                       class="bx-filter-param-label"
                                                                                       data-role="label_<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                                                       onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape("all_" . $arCur["CONTROL_ID"]) ?>')">
                                                                                    <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                                                                </label>
                                                                            </li>
                                                                            <?
                                                                            foreach ($arItem["VALUES"] as $val => $ar):
                                                                                $class = "";
                                                                                if ($ar["CHECKED"])
                                                                                    $class .= " selected";
                                                                                if ($ar["DISABLED"])
                                                                                    $class .= " disabled";
                                                                                ?>
                                                                                <li>
                                                                                    <label for="<?= $ar["CONTROL_ID"] ?>"
                                                                                           class="bx-filter-param-label<?= $class ?>"
                                                                                           data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                                                           onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')"><?= $ar["VALUE"] ?></label>
                                                                                </li>
                                                                            <?endforeach ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?
                                                    break;
                                                    case "R"://DROPDOWN_WITH_PICTURES_AND_LABELS
                                                    ?>
                                                        <div class="col-xs-12">
                                                            <div class="bx-filter-select-container">
                                                                <div class="bx-filter-select-block"
                                                                     onclick="smartFilter.showDropDownPopup(this, '<?= CUtil::JSEscape($key) ?>')">
                                                                    <div class="bx-filter-select-text fix"
                                                                         data-role="currentOption">
                                                                        <?
                                                                        $checkedItemExist = false;
                                                                        foreach ($arItem["VALUES"] as $val => $ar):
                                                                            if ($ar["CHECKED"]) {
                                                                                ?>
                                                                                <? if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                                                    <span class="bx-filter-btn-color-icon"
                                                                                          style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                                                                <?endif ?>
                                                                                <span class="bx-filter-param-text">
                                                                        <?= $ar["VALUE"] ?>
                                                                    </span>
                                                                                <?
                                                                                $checkedItemExist = true;
                                                                            }
                                                                        endforeach;
                                                                        if (!$checkedItemExist) {
                                                                            ?>
                                                                            <span class="bx-filter-btn-color-icon all"></span> <?
                                                                            echo GetMessage("CT_BCSF_FILTER_ALL");
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                    <div class="bx-filter-select-arrow"></div>
                                                                    <input
                                                                            style="display: none"
                                                                            type="radio"
                                                                            name="<?= $arCur["CONTROL_NAME_ALT"] ?>"
                                                                            id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                                                            value=""
                                                                    />
                                                                    <? foreach ($arItem["VALUES"] as $val => $ar):?>
                                                                        <input
                                                                                style="display: none"
                                                                                type="radio"
                                                                                name="<?= $ar["CONTROL_NAME_ALT"] ?>"
                                                                                id="<?= $ar["CONTROL_ID"] ?>"
                                                                                value="<?= $ar["HTML_VALUE_ALT"] ?>"
                                                                            <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                                        />
                                                                    <?endforeach ?>
                                                                    <div class="bx-filter-select-popup"
                                                                         data-role="dropdownContent"
                                                                         style="display: none">
                                                                        <ul>
                                                                            <li style="border-bottom: 1px solid #e5e5e5;padding-bottom: 5px;margin-bottom: 5px;">
                                                                                <label for="<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                                                       class="bx-filter-param-label"
                                                                                       data-role="label_<?= "all_" . $arCur["CONTROL_ID"] ?>"
                                                                                       onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape("all_" . $arCur["CONTROL_ID"]) ?>')">
                                                                                    <span class="bx-filter-btn-color-icon all"></span>
                                                                                    <? echo GetMessage("CT_BCSF_FILTER_ALL"); ?>
                                                                                </label>
                                                                            </li>
                                                                            <?
                                                                            foreach ($arItem["VALUES"] as $val => $ar):
                                                                                $class = "";
                                                                                if ($ar["CHECKED"])
                                                                                    $class .= " selected";
                                                                                if ($ar["DISABLED"])
                                                                                    $class .= " disabled";
                                                                                ?>
                                                                                <li>
                                                                                    <label for="<?= $ar["CONTROL_ID"] ?>"
                                                                                           data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                                                           class="bx-filter-param-label<?= $class ?>"
                                                                                           onclick="smartFilter.selectDropDownItem(this, '<?= CUtil::JSEscape($ar["CONTROL_ID"]) ?>')">
                                                                                        <? if (isset($ar["FILE"]) && !empty($ar["FILE"]["SRC"])):?>
                                                                                            <span class="bx-filter-btn-color-icon"
                                                                                                  style="background-image:url('<?= $ar["FILE"]["SRC"] ?>');"></span>
                                                                                        <?endif ?>
                                                                                        <span class="bx-filter-param-text">
                                                                            <?= $ar["VALUE"] ?>
                                                                        </span>
                                                                                    </label>
                                                                                </li>
                                                                            <?endforeach ?>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?
                                                    break;
                                                    case "K"://RADIO_BUTTONS
                                                    ?>
                                                        <div class="col-xs-12">
                                                            <div class="radio">
                                                                <input
                                                                        type="radio"
                                                                        value=""
                                                                        name="<? echo $arCur["CONTROL_NAME_ALT"] ?>"
                                                                        id="<? echo "all_" . $arCur["CONTROL_ID"] ?>"
                                                                        onclick="smartFilter.click(this)"
                                                                />
                                                                <label class="bx-filter-param-label"
                                                                       for="<? echo "all_" . $arCur["CONTROL_ID"] ?>">
                                                                    <span class="bx-filter-param-text"><? echo GetMessage("CT_BCSF_FILTER_ALL"); ?></span>
                                                                </label>
                                                            </div>
                                                            <? foreach ($arItem["VALUES"] as $val => $ar):?>
                                                                <div class="radio">

                                                            <span class="bx-filter-input-checkbox">
                                                                
                                                                <input
                                                                        type="radio"
                                                                        value="<? echo $ar["HTML_VALUE_ALT"] ?>"
                                                                        name="<? echo $ar["CONTROL_NAME_ALT"] ?>"
                                                                        id="<? echo $ar["CONTROL_ID"] ?>"
                                                                    <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                                        onclick="smartFilter.click(this)"
                                                                    <? echo $ar["DISABLED"] ? 'disabled="disabled"' : '' ?>
                                                                />
																<label data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                                       class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled' : '' ?>"
                                                                       for="<? echo $ar["CONTROL_ID"] ?>">
                                                                    <span class="checkbox-custom"></span>
                                                                    <span class="checkbox-name"><?= $ar["VALUE"]; ?></span>
                                                                    <?
                                                                        if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                                            ?>&nbsp;(<span
                                                                                data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                                        endif; ?>
                                                                </label>
                                                            </span>
                                                                </div>
                                                            <?endforeach; ?>
                                                        </div>
                                                    <?
                                                    break;
                                                    case "U"://CALENDAR
                                                    ?>
                                                        <div class="col-xs-12">
                                                            <div class="bx-filter-parameters-box-container-block">
                                                                <div class="bx-filter-input-container bx-filter-calendar-container">
                                                                    <? $APPLICATION->IncludeComponent(
                                                                        'bitrix:main.calendar',
                                                                        '',
                                                                        array(
                                                                            'FORM_NAME' => $arResult["FILTER_NAME"] . "_form",
                                                                            'SHOW_INPUT' => 'Y',
                                                                            'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="' . FormatDate("SHORT", $arItem["VALUES"]["MIN"]["VALUE"]) . '" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                                                            'INPUT_NAME' => $arItem["VALUES"]["MIN"]["CONTROL_NAME"],
                                                                            'INPUT_VALUE' => $arItem["VALUES"]["MIN"]["HTML_VALUE"],
                                                                            'SHOW_TIME' => 'N',
                                                                            'HIDE_TIMEBAR' => 'Y',
                                                                        ),
                                                                        null,
                                                                        array('HIDE_ICONS' => 'Y')
                                                                    ); ?>
                                                                </div>
                                                            </div>
                                                            <div class="bx-filter-parameters-box-container-block">
                                                                <div class="bx-filter-input-container bx-filter-calendar-container">
                                                                    <? $APPLICATION->IncludeComponent(
                                                                        'bitrix:main.calendar',
                                                                        '',
                                                                        array(
                                                                            'FORM_NAME' => $arResult["FILTER_NAME"] . "_form",
                                                                            'SHOW_INPUT' => 'Y',
                                                                            'INPUT_ADDITIONAL_ATTR' => 'class="calendar" placeholder="' . FormatDate("SHORT", $arItem["VALUES"]["MAX"]["VALUE"]) . '" onkeyup="smartFilter.keyup(this)" onchange="smartFilter.keyup(this)"',
                                                                            'INPUT_NAME' => $arItem["VALUES"]["MAX"]["CONTROL_NAME"],
                                                                            'INPUT_VALUE' => $arItem["VALUES"]["MAX"]["HTML_VALUE"],
                                                                            'SHOW_TIME' => 'N',
                                                                            'HIDE_TIMEBAR' => 'Y',
                                                                        ),
                                                                        null,
                                                                        array('HIDE_ICONS' => 'Y')
                                                                    ); ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?
                                                    break;
                                                    default://CHECKBOXES
                                                    ?>
                                                        <div class="col-xs-12">
                                                            <? foreach ($arItem["VALUES"] as $val => $ar):?>
                                                                <div class="checkbox">
                                                            <span class="bx-filter-input-checkbox">
                                                                <label data-role="label_<?= $ar["CONTROL_ID"] ?>"
                                                                       class="bx-filter-param-label <? echo $ar["DISABLED"] ? 'disabled' : '' ?>"
                                                                       for="<? echo $ar["CONTROL_ID"] ?>"
                                                                       data-id="<? echo $ar["CONTROL_ID"] ?>">
                                                                <input
                                                                        type="checkbox"
                                                                        value="<? echo $ar["HTML_VALUE"] ?>"
                                                                        name="<? echo $ar["CONTROL_NAME"] ?>"
                                                                        id="<? echo $ar["CONTROL_ID"] ?>"
                                                                    <? echo $ar["CHECKED"] ? 'checked="checked"' : '' ?>
                                                                        onclick="smartFilter.click(this)"
                                                                    <? echo $ar["DISABLED"] ? 'disabled="disabled"' : '' ?>
                                                                />
                                                                    <span class="checkbox-custom"></span>
                                                                    <span class="checkbox-name"><?= $ar["VALUE"]; ?></span>
                                                                    <?
                                                                        if ($arParams["DISPLAY_ELEMENT_COUNT"] !== "N" && isset($ar["ELEMENT_COUNT"])):
                                                                            ?>&nbsp;(<span
                                                                                data-role="count_<?= $ar["CONTROL_ID"] ?>"><? echo $ar["ELEMENT_COUNT"]; ?></span>)<?
                                                                        endif; ?>
                                                                </label>
                                                            </span>

                                                                </div>
                                                            <?endforeach; ?>
                                                        </div>
                                                        <?
                                                    }
                                                    ?>
                                                </div>
                                                <div style="clear: both"></div>
                                            </div>
                                        </div>
<!--                                        </div>-->
                                        <?
                                       if ($count_block == $i){?>
                                            </div>
                                            <div class="right_filter_block">
                                       <?}
                                    $i++;}
                                    ?>
                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    <div class="row m_none">
                        <div class="col-xs-12 bx-filter-button-box">
                            <div class="title_hide">
                                <span><?=GetMessage("ROS_POISK");?></span>
                            </div>
                            <div class="bx-filter-block">
                                <div class="bx-filter-parameters-box-container">
                                    <input
                                            class="btn btn-themes"
                                            type="submit"
                                            id="set_filter"
                                            name="set_filter"
                                            value="<?= GetMessage("CT_BCSF_SET_FILTER") ?>"
                                    />

                                    <input
                                            class="btn btn-link"
                                            type="submit"
                                            id="del_filter"
                                            name="del_filter"
                                            value="<?= GetMessage("CT_BCSF_DEL_FILTER") ?>"
                                    />
                                    <div class="bx-filter-popup-result <? if ($arParams["FILTER_VIEW_MODE"] == "VERTICAL") echo $arParams["POPUP_POSITION"] ?>"
                                         id="modef" <? if (!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"'; ?>
                                         style="display: inline-block;">
                                        <a href="<? echo $arResult["FILTER_URL"] ?>" target="" class="filter_action_osn btn">
                                            <div class="text-rel"><?=GetMessage("FIL_ONE");?>
                                                <span class="active_filter-block">
                                    <span id="modef_num"> <?=intval($arResult["ELEMENT_COUNT"]);?>  </span>
                                                    <?=GetMessage("FIL_TWO");?>
                                </span>
                                            </div>
                                        </a>
                                        <span class="arrow"></span>
                                        <a class="filter_action_dop" href="<? echo $arResult["FILTER_URL"] ?>"
                                           target=""><? echo GetMessage("CT_BCSF_FILTER_SHOW") ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div><!--//row-->
        <div class="clb"></div>
        </form>
    </div>
</div>
</div>
<script type="text/javascript">
    var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($arResult["FORM_ACTION"])?>', '<?=CUtil::JSEscape($arParams["FILTER_VIEW_MODE"])?>', <?=CUtil::PhpToJSObject($arResult["JS_FILTER_PARAMS"])?>);
</script>