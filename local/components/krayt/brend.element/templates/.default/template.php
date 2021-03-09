<div class="w1200" data-idd="w1200">

<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (!empty($arResult)):?>
    <div class="brend_collection_block">
        <div class="brend_collection_top_block">
            <div class="text_box">
                <h1 class="name-brand">
                    <?= GetMessage("COLLECTION"); ?> <?= $arResult['BREND']['NAME'] ?> <?= $arResult['COLLECTION']['NAME'] ?>
                </h1>
            </div>
            <div class="c-elem">
                <a href="<?=$arResult['BREND']['SECTION_PAGE_URL']?>" class="img_box">
                    <? if (empty($arResult['BREND']['PICTURE'])) {
                        $arResult['BREND']['PICTURE'] = $templateFolder . "/images/no_photo.png";
                    } else {
                        $arResult['BREND']['PICTURE'] = CFile::GetPath($arResult['BREND']["PICTURE"]);
                    } ?>
                    <div class="bg_img" style="background-image: url(<?= $arResult['BREND']['PICTURE']; ?>);"></div>
                </a>
            </div>
        </div>
        <? if (!empty($arResult["SECTION"])): ?>
            <div class="brend_section_block">
                <div class="title_box in-collection">
                    <?= GetMessage("PRODUCT"); ?>
                </div>
                <?if(count($arResult["SECTION"]) > 1):?>
                    <div class="nav_section in-collection">
                        <? foreach ($arResult["SECTION"] as $section): ?>
                            <a href="<?= $section['SECTION_PAGE_URL'] ?>?arFilterCatalog_309_<?= abs(crc32($arResult['COLLECTION']['ID'])); ?>=Y&arFilterCatalog_310_<?= abs(crc32($arResult['BREND']['ID'])); ?>=Y&arFilterCatalog_309_357040185=Y&arFilterCatalog_P1_MIN=&arFilterCatalog_P1_MAX=&set_filter=<?=GetMessage("POKAZ");?>"><?= $section['NAME'] ?> <span>(<?= count($section['PRODUCT']); ?>)</span></a>
                        <? endforeach; ?>
                    </div>
                <?endif;?>
                <? foreach ($arResult["SECTION"] as $section): ?>
                    <div class="brend_section_box">
                        <a href="<?= $section['SECTION_PAGE_URL'] ?>?arFilterCatalog_309_<?= abs(crc32($arResult['COLLECTION']['ID'])); ?>=Y&arFilterCatalog_310_<?= abs(crc32($arResult['BREND']['ID'])); ?>=Y&arFilterCatalog_309_357040185=Y&arFilterCatalog_P1_MIN=&arFilterCatalog_P1_MAX=&set_filter=<?=GetMessage("POKAZ");?>" class="title_box sub">
                            <span><?= $section['NAME'] ?></span> <span class="count"><?= count($section['PRODUCT']); ?></span>
                        </a>
                        <div class="companent_section_box">
                            <?
                            global $filterCol;
                            $filterCol = array("PROPERTY_COLLECTION" => $arResult['COLLECTION']['ID'], "PROPERTY_NO_CATALOG" => false); ?>

                            <? $APPLICATION->IncludeComponent(
                                "bitrix:catalog.section",
                                "brend",
                                Array(
                                    "ACTION_VARIABLE" => "action",
                                    "ADD_PICT_PROP" => "MORE_PHOTO",
                                    "ADD_PROPERTIES_TO_BASKET" => "Y",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "ADD_TO_BASKET_ACTION" => "ADD",
                                    "AJAX_MODE" => "Y",
                                    "AJAX_OPTION_ADDITIONAL" => "",
                                    "AJAX_OPTION_HISTORY" => "N",
                                    "AJAX_OPTION_JUMP" => "N",
                                    "AJAX_OPTION_STYLE" => "Y",
                                    "BROWSER_TITLE" => "-",
                                    "CACHE_FILTER" => "N",
                                    "CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
                                    "CACHE_TIME" => $arParams['CACHE_TIME'],
                                    "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                                    "COMPATIBLE_MODE" => "Y",
                                    "CONVERT_CURRENCY" => "Y",
                                    "CURRENCY_ID" => "RUB",
                                    "CUSTOM_FILTER" => "",
                                    "DATA_LAYER_NAME" => "dataLayer",
                                    "DETAIL_URL" => "",
                                    "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                                    "DISCOUNT_PERCENT_POSITION" => $arParams['DISCOUNT_PERCENT_POSITION'],
                                    "DISPLAY_BOTTOM_PAGER" => "N",
                                    "DISPLAY_TOP_PAGER" => "N",
                                    "ELEMENT_SORT_FIELD" => "sort",
                                    "ELEMENT_SORT_FIELD2" => "id",
                                    "ELEMENT_SORT_ORDER" => "asc",
                                    "ELEMENT_SORT_ORDER2" => "desc",
                                    "ENLARGE_PRODUCT" => "PROP",
                                    "ENLARGE_PROP" => "NEWPRODUCT",
                                    "FILTER_NAME" => "filterCol",
                                    "HIDE_NOT_AVAILABLE" => "N",
                                    "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                                    "IBLOCK_ID" => $arParams['I_BLOCK_CATALOG'],
                                    "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE_CATALOG'],
                                    "INCLUDE_SUBSECTIONS" => "Y",
                                    "LABEL_PROP" => $arParams['LABEL_PROP'],
                                    "LABEL_PROP_MOBILE" => array(),
                                    "LABEL_PROP_POSITION" => "top-left",
                                    "LAZY_LOAD" => "Y",
                                    "LINE_ELEMENT_COUNT" => "3",
                                    "LOAD_ON_SCROLL" => "N",
                                    "MESSAGE_404" => "",
                                    "META_DESCRIPTION" => "-",
                                    "META_KEYWORDS" => "-",
                                    "OFFERS_CART_PROPERTIES" => array("COLOR" . "GABARIT"),
                                    "OFFERS_FIELD_CODE" => array("COLOR", "GABARIT"),
                                    "OFFERS_LIMIT" => "5",
                                    "OFFERS_PROPERTY_CODE" => array("COLOR", "GABARIT"),
                                    "OFFERS_SORT_FIELD" => "sort",
                                    "OFFERS_SORT_FIELD2" => "id",
                                    "OFFERS_SORT_ORDER" => "asc",
                                    "OFFERS_SORT_ORDER2" => "desc",
                                    "OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
                                    "OFFER_TREE_PROPS" => array("COLOR", "GABARIT"),
                                    "PAGER_BASE_LINK_ENABLE" => "N",
                                    "PAGER_DESC_NUMBERING" => "N",
                                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                    "PAGER_SHOW_ALL" => "N",
                                    "PAGER_SHOW_ALWAYS" => "N",
                                    "PAGER_TEMPLATE" => ".default",
                                    "PAGE_ELEMENT_COUNT" => "18",
                                    "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                    "PRICE_CODE" => $arParams['PRICE_CODE'],
                                    "PRICE_VAT_INCLUDE" => "Y",
                                    "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                                    "PRODUCT_DISPLAY_MODE" => "Y",
                                    "PRODUCT_ID_VARIABLE" => "id",
                                    "PRODUCT_PROPERTIES" => array("NEWPRODUCT", "MATERIAL"),
                                    "PRODUCT_PROPS_VARIABLE" => "prop",
                                    "PRODUCT_QUANTITY_VARIABLE" => "",
                                    "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':true}]",
                                    "PRODUCT_SUBSCRIPTION" => "Y",
                                    "PROPERTY_CODE" => array("NEWPRODUCT", ""),
                                    "PROPERTY_CODE_MOBILE" => array(),
                                    "RCM_PROD_ID" => "",
                                    "RCM_TYPE" => "personal",
                                    "SECTION_CODE" => "",
                                    "SECTION_ID" => $section['ID'],
                                    "SECTION_ID_VARIABLE" => "",
                                    "SECTION_URL" => "",
                                    "SECTION_USER_FIELDS" => array("", ""),
                                    "SEF_MODE" => "N",
                                    "SET_BROWSER_TITLE" => "N",
                                    "SET_LAST_MODIFIED" => "N",
                                    "SET_META_DESCRIPTION" => "N",
                                    "SET_META_KEYWORDS" => "N",
                                    "SET_STATUS_404" => "N",
                                    "SET_TITLE" => "N",
                                    "SHOW_404" => "N",
                                    "SHOW_ALL_WO_SECTION" => "N",
                                    "SHOW_CLOSE_POPUP" => "N",
                                    "SHOW_DISCOUNT_PERCENT" => $arParams['SHOW_DISCOUNT_PERCENT'],
                                    "SHOW_FROM_SECTION" => "N",
                                    "SHOW_MAX_QUANTITY" => "N",
                                    "SHOW_OLD_PRICE" => "Y",
                                    "SHOW_PRICE_COUNT" => "1",
                                    "SHOW_SLIDER" => "Y",
                                    "SLIDER_INTERVAL" => "3000",
                                    "SLIDER_PROGRESS" => "N",
                                    "TEMPLATE_THEME" => "blue",
                                    "USE_ENHANCED_ECOMMERCE" => "Y",
                                    "USE_MAIN_ELEMENT_SECTION" => "N",
                                    "USE_PRICE_COUNT" => "N",
                                    "USE_PRODUCT_QUANTITY" => "N",
                                    'PROP_1' => $arParams['PROP_1'],
                                    'PROP_2' => $arParams['PROP_2'],
                                    'PROP_3' => $arParams['PROP_3'],
                                    'PROP_4' => $arParams['PROP_4'],
                                    'PROP_5' => $arParams['PROP_5'],
                                    "PROP_ARTICUL" => $arParams["PROP_ARTICUL"],
                                    "DISPLAY_COMPARE" => "Y"
                                )
                            ); ?>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        <? endif; ?>
        <? if (!empty($arResult["DOP_COLLECTION"])): ?>
            <div class="dop_collection_box">
                <div class="title_box">
                    <?= GetMessage("DOP_COLLECTION"); ?>
                </div>
                <div class="spisok_collection">
                <? foreach ($arResult["DOP_COLLECTION"] as $col): ?>
                    <a href="<?= $col['DETAIL_PAGE_URL'] ?>">
                        <div class="collection_box">
                            <span><?= $col['NAME'] ?></span>
                        </div>
                    </a>
                <? endforeach; ?>
                </div>
            </div>
        <? endif; ?>
    </div>
<? endif; ?>

</div>