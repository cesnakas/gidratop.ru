<div class="w1200" data-class-prev="w1200">

<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!empty($arResult)):?>
    <div class="content_brend_section_block">
        <div class="brend_section_block">
            <div class="c-elem mobile">
                <div class="img_box">
                    <? if (empty($arResult['BREND']['PICTURE'])) {
                        $arResult['BREND']['PICTURE'] = $templateFolder . "/images/no_photo.png";
                    } else {
                        $arResult['BREND']['PICTURE'] = CFile::GetPath($arResult['BREND']["PICTURE"]);
                    } ?>
                    <div class="bg_img" style="background-image: url(<?= $arResult['BREND']['PICTURE']; ?>);"></div>
                </div>
            </div>
            <div class="text_box">
                <h1 class="name-brand"><?= $arResult['BREND']['NAME'] ?></h1>
                <div class="description-brand"><?= $arResult['BREND']['DESCRIPTION'] ?></div>
            </div>
        </div>
        <? if (!empty($arResult['COLLECTION'])): ?>
            <div class="collection_section_block">
                <div class="title_box">
                    <?= GetMessage("COLLECTION"); ?>
                </div>
                <div class="spisok_collection">
                    <? foreach ($arResult['COLLECTION'] as $collection): ?>
                        <a href="<?= $collection['DETAIL_PAGE_URL'] ?>">
                            <div class="collection_box">
                                <?//print_r($collection);?>
                                <img class="coll_img" src="<? echo CFile::GetPath($collection['PROPERTY_COLL_IMG_VALUE'])?>">
                                <span><?= $collection['NAME'] ?></span>
                            </div>
                        </a>
                    <? endforeach; ?>
                </div>
            </div>
        <? endif; ?>
        <? if (!empty($arResult["SECTION"])): ?>
            <div class="brend_section_block">
                <div class="title_box">
                    <?= GetMessage("PRODUCT"); ?>
                </div>
                <?if(count($arResult["SECTION"]) > 1):?>
                    <div class="nav_section">
                        <? foreach ($arResult["SECTION"] as $section): ?>
                            <?$cifra = abs(crc32($arResult['BREND']['ID']));?>
                            <a href="<?= $section['SECTION_PAGE_URL'] ?>?arFilterCatalog_310_<?=abs(crc32($arResult['BREND']['ID'])); ?>=Y&set_filter=<?=GetMessage("POKA");?>"><?= $section['NAME'] ?> <span>(<?= count($section['PRODUCT']); ?>)</span></a>
                        <? endforeach; ?>
                    </div>
                <?endif;?>
                <? foreach ($arResult["SECTION"] as $section): ?>
                    <div class="brend_section_box">
                        <a href="<?= $section['SECTION_PAGE_URL'] ?>?arFilterCatalog_310_<?=abs(crc32($arResult['BREND']['ID'])); ?>=Y&set_filter=<?=GetMessage("POKA");?>" class="title_box sub">
                            <span class="name"><?= $section['NAME'] ?></span> <span class="count"><?= count($section['PRODUCT']); ?></span>
                        </a>
                        <div class="companent_section_box">
                            <?
                            global $filterSec;
                            $filterSec = array("PROPERTY_BREND" => $arResult['BREND']['ID'], "PROPERTY_NO_CATALOG" => false); ?>

                            <? $APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"brend", 
	array(
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
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_TYPE" => "A",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"CUSTOM_FILTER" => "",
		"DATA_LAYER_NAME" => "dataLayer",
		"DETAIL_URL" => "",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISCOUNT_PERCENT_POSITION" => $arParams["DISCOUNT_PERCENT_POSITION"],
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER2" => "desc",
		"ENLARGE_PRODUCT" => "PROP",
		"ENLARGE_PROP" => "NEWPRODUCT",
		"FILTER_NAME" => "filterSec",
		"HIDE_NOT_AVAILABLE" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"IBLOCK_ID" => $arParams["I_BLOCK_CATALOG"],
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => $arParams["LABEL_PROP"],
		"LABEL_PROP_MOBILE" => "",
		"LABEL_PROP_POSITION" => "top-left",
		"LAZY_LOAD" => "Y",
		"LINE_ELEMENT_COUNT" => "3",
		"LOAD_ON_SCROLL" => "N",
		"MESSAGE_404" => "",
		"META_DESCRIPTION" => "-",
		"META_KEYWORDS" => "-",
		"OFFERS_CART_PROPERTIES" => array(

		),
		"OFFERS_FIELD_CODE" => array(

		),
		"OFFERS_LIMIT" => "5",
		"OFFERS_PROPERTY_CODE" => array(

		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"OFFER_TREE_PROPS" => array(

		),
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
		"PRODUCT_PROPERTIES" => array(
		),
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':true}]",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PROPERTY_CODE" => array(
		),
		"PROPERTY_CODE_MOBILE" => "",
		"RCM_PROD_ID" => "",
		"RCM_TYPE" => "personal",
		"SECTION_CODE" => "",
		"SECTION_ID" => $section["ID"],
		"SECTION_ID_VARIABLE" => "",
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
		),
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
		"SHOW_DISCOUNT_PERCENT" => "N",
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
		"PROP_1" => $arParams["PROP_1"],
		"PROP_2" => $arParams["PROP_2"],
		"PROP_3" => $arParams["PROP_3"],
		"PROP_4" => $arParams["PROP_4"],
		"PROP_5" => $arParams["PROP_5"],
		"PROP_ARTICUL" => $arParams["PROP_ARTICUL"],

		"COMPONENT_TEMPLATE" => "brend",
		"BACKGROUND_IMAGE" => "-",
		"MESS_BTN_BUY" => "",
		"MESS_BTN_ADD_TO_BASKET" => "",
		"MESS_BTN_SUBSCRIBE" => "",
		"MESS_BTN_DETAIL" => "",
		"MESS_NOT_AVAILABLE" => "",
		"BASKET_URL" => SITE_DIR."personal/basket.php",
		"DISPLAY_COMPARE" => "Y",
		"COMPARE_PATH" => "",
		"MESS_BTN_COMPARE" => "",
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"BRAND_PROPERTY" => "-",
		"PAGER_TITLE" => "",
		"MESS_BTN_LAZY_LOAD" => "",
		"COMPATIBLE_MODE" => "Y"
	),
	false
); ?>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        <? endif; ?>
    </div>
<? endif; ?>

</div>