<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] === 'Y') {
    $basketAction = isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '';
} else {
    $basketAction = isset($arParams['SECTION_ADD_TO_BASKET_ACTION']) ? $arParams['SECTION_ADD_TO_BASKET_ACTION'] : '';
}
?>


<? if (empty($arResult["VARIABLES"]["SECTION_CODE"])) {
    $section_podborka = end(explode("/", $arResult["VARIABLES"]["SECTION_CODE_PATH"]));
} else {
    $section_podborka = $arResult["VARIABLES"]["SECTION_CODE"];
} ?>
<?
$top_banner = CKrayt_specialflat::getBannerSection($arResult['VARIABLES']['SECTION_ID'],$arParams['IBLOCK_ID']);
?>
<div class="top_banner" <?if ($top_banner):?>
     style="background-image:url(<?=$top_banner?>)"
    <?endif?>
><h1 class="title"><? $APPLICATION->ShowTitle(false) ?></h1></div>
    <div class="left_content_block">
        <div class="left_menu_box">
            <? $APPLICATION->IncludeComponent("bitrix:menu", "left_menu_catalog", Array(
                "ROOT_MENU_TYPE" => "top_catalog",
                "MAX_LEVEL" => "5",
                "CHILD_MENU_TYPE" => "top_catalog",
                "USE_EXT" => "Y",
                "DELAY" => "N",
                "ALLOW_MULTI_SELECT" => "Y",
                "MENU_CACHE_TYPE" => "N",
                "MENU_CACHE_TIME" => "3600",
                "MENU_CACHE_USE_GROUPS" => "Y",
                "MENU_CACHE_GET_VARS" => "",
                "PODBORKA_TUPE" => $GLOBALS['PODBORKI']['TUGLE'],
                "SECTION_PODBORKA" => $GLOBALS['PODBORKI']['SECTION_CATALOG'],
            ),
                $component,
                array('HIDE_ICONS' => 'Y')
            ); ?>
        </div>

        <? $APPLICATION->IncludeComponent(
            "krayt:podborki",
            "left",
            Array(
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "SECTION_CODE" => $section_podborka,
				//"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                "CATALOG_IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "PODBORKI_IBLOCK_ID" => $arParams['IBLOCK_PODBORKI'],
                "UF_PODBORKI_FILTER"=>"left",

            ),
            $component,
            array('HIDE_ICONS' => 'Y')
        ); ?>

        <? if ($GLOBALS['PODBORKI']['TUGLE'] == "Y") {
            $section_brand_id = $GLOBALS['SECTION_PODBORKA_BREND'];
            $secton_iblock = $arParams['IBLOCK_PODBORKI'];
            $arResult["VARIABLES"]["SECTION_ID"] =  $GLOBALS['PODBORKI']['SECTION_ID'];
        } else {
            $section_brand_id = $arResult["VARIABLES"]["SECTION_ID"];
            $secton_iblock = $arParams['IBLOCK_ID'];
        } ?>

        <?$activeElements = CIBlockSection::GetSectionElementsCount($arResult["VARIABLES"]["SECTION_ID"], Array("CNT_ACTIVE"=>"Y"));?>

        <?if ($activeElements >0):?>

<? $APPLICATION->IncludeComponent(
            "krayt:brend.line",
            "",
            Array(
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "SECTION_ID" => $section_brand_id,
                "CATALOG_IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "PODBORCI" => $GLOBALS['PODBORKI']['TUGLE'],
                "PODBORKI_SECTION"=>$section_podborka,
                "I_BLOC_POD"=>$arParams['IBLOCK_PODBORKI'],
            ),
            $component,
            array('HIDE_ICONS' => 'Y')
        ); ?>

        <?
             if ($GLOBALS['PODBORKI']['TUGLE'] == "Y") {
                $section_brand_id = $GLOBALS['PODBORKI']['PODBORKA_ID'];
                $secton_iblock = $arParams['IBLOCK_PODBORKI'];
                $arResult["VARIABLES"]["SECTION_ID"] =  $GLOBALS['PODBORKI']['SECTION_ID'];
            } else {
                $section_brand_id = $arResult["VARIABLES"]["SECTION_ID"];
                $secton_iblock = $arParams['IBLOCK_ID'];
            }
            $APPLICATION->IncludeComponent(
            "krayt:see_also",
            "",
            Array(
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "SECTION_ID" => $section_brand_id,
                "IBLOCK_ID" => $secton_iblock,
                "CATALOG_IBLOCK_ID" => $arParams['IBLOCK_ID']
            ),
            $component,
            array('HIDE_ICONS' => 'Y')
        ); ?>

        <?endif;?>
        <? $APPLICATION->IncludeComponent(
            "krayt:product.in_day",
            "",
            Array(
                "CACHE_TIME" => $arParams["CACHE_TIME"],
                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                "SECTION_CODE_P" => $section_podborka,
                // "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                "CATALOG_IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "PODBORKI_IBLOCK_ID" => $arParams['IBLOCK_PODBORKI'],
                "PODBOKI_TEXT" => $GLOBALS['PODBORKI_TEXT'],
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
                "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                "BASKET_URL" => $arParams["BASKET_URL"],
                "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                "FILTER_NAME" => $arParams["FILTER_NAME"],
                "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                "MESSAGE_404" => $arParams["~MESSAGE_404"],
                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                "SHOW_404" => $arParams["SHOW_404"],
                "FILE_404" => $arParams["FILE_404"],
                "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                "PRICE_CODE" => $arParams["PRICE_CODE"],
                "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

                "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                "LAZY_LOAD" => $arParams["LAZY_LOAD"],
                "MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
                "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

                "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                "OFFERS_SORT_FIELD" => $sort,
                "OFFERS_SORT_ORDER" => $sort_po,
                "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
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

                'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                "ADD_SECTIONS_CHAIN" => "N",
                'ADD_TO_BASKET_ACTION' => "",
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
                "PROP_ARTICUL" => $arParams["PROP_ARTICUL"],
                "AJAX_MODE" => "N",
            ),
            $component,
            array('HIDE_ICONS' => 'Y')
        ); ?>
    </div>
    <div class="right_content_block">
        <div class="">
            <div class="podborki-container">

                <? $APPLICATION->IncludeComponent(
                    "krayt:podborki",
                    "",
                    Array(
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "SECTION_CODE" => $section_podborka,
                        //"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                        "CATALOG_IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "PODBORKI_IBLOCK_ID" => $arParams["IBLOCK_PODBORKI"],
                        "UF_PODBORKI_FILTER" => "top",
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                ); ?>
            </div>

            <? if ($GLOBALS['PODBORKI']['TUGLE'] == "Y") {
                $arResult["VARIABLES"]["SECTION_ID"] = $GLOBALS['PODBORKI']['SECTION_ID'];
                $set_title = "N";
                $set_meta_keywords = "N";
                $set_meta_dis = "N";
                $section_chain = "N";


            } else {
                $set_title = $arParams["SET_TITLE"];
                $set_meta_keywords = $arParams["SET_META_KEYWORDS"];
                $set_meta_dis = $arParams["SET_META_DESCRIPTION"];
                $section_chain = $arParams['ADD_SECTIONS_CHAIN'];
            } ?>


            <?
			
			
			
			if ($activeElements >0):?>

            <div class="filter-container">
                <? if ($isFilter): ?>
                    <div class="bx-filter-container-box">
                        <?

                        $GLOBALS['PREFILTERSECTION'] = array("PROPERTY_NO_CATALOG" => false);
                        $APPLICATION->IncludeComponent(
                            "bitrix:catalog.smart.filter",
                            "santechika",
                            array(
                                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                                "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                                "FILTER_NAME" => $arParams["FILTER_NAME"],
                                "PRICE_CODE" => $arParams["PRICE_CODE"],
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                "SAVE_IN_SESSION" => "N",
                                "FILTER_VIEW_MODE" => "HORIZONTAL",
                                "XML_EXPORT" => "Y",
                                "SECTION_TITLE" => "NAME",
                                "SECTION_DESCRIPTION" => "DESCRIPTION",
                                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                                "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                "SEF_MODE" => "N",
                                "SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
                                "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                                "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
								"DISPLAY_ELEMENT_COUNT" => "N",
                                "PREFILTER_NAME" => "PREFILTERSECTION"
                            ),
                            $component,
                            array('HIDE_ICONS' => 'Y')
                        );
                        ?>
                    </div>
                <? endif ?>
                <div class="col-xs-12">
                    <?
                    if (ModuleManager::isModuleInstalled("sale")) {
                        $arRecomData = array();
                        $recomCacheID = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
                        $obCache = new CPHPCache();
                        if ($obCache->InitCache(36000, serialize($recomCacheID), "/sale/bestsellers")) {
                            $arRecomData = $obCache->GetVars();
                        } elseif ($obCache->StartDataCache()) {
                            if (Loader::includeModule("catalog")) {
                                $arSKU = CCatalogSku::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
                                $arRecomData['OFFER_IBLOCK_ID'] = (!empty($arSKU) ? $arSKU['IBLOCK_ID'] : 0);
                            }
                            $obCache->EndDataCache($arRecomData);
                        }

                        if (!empty($arRecomData) && $arParams['USE_GIFTS_SECTION'] === 'Y') {
                            ?>
                            <div data-entity="parent-container">
                            <?
                            if (!isset($arParams['GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE']) || $arParams['GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE'] !== 'Y') {
                                ?>
                                <div class="catalog-block-header" data-entity="header" data-showed="false"
                                     style="display: none; opacity: 0;">
                                    <?= ($arParams['GIFTS_SECTION_LIST_BLOCK_TITLE'] ?: \Bitrix\Main\Localization\Loc::getMessage('CT_GIFTS_SECTION_LIST_BLOCK_TITLE_DEFAULT')) ?>
                                </div>
                                <?
                            }

                            CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.section');
                            $APPLICATION->IncludeComponent(
                                'bitrix:sale.products.gift.section',
                                '.default',
                                array(
                                    'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                                    'IBLOCK_ID' => $arParams['IBLOCK_ID'],

                                    "SHOW_FROM_SECTION" => 'Y',
                                    'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
                                    'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
                                    'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],

                                    'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
                                    'ACTION_VARIABLE' => (!empty($arParams['ACTION_VARIABLE']) ? $arParams['ACTION_VARIABLE'] : 'action') . '_spgs',

                                    'PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
                                        SaleProductsGiftSectionComponent::predictRowVariants(
                                            $arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT'],
                                            $arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT']
                                        )
                                    ),
                                    'PAGE_ELEMENT_COUNT' => $arParams['GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT'],
                                    'DEFERRED_PRODUCT_ROW_VARIANTS' => '',
                                    'DEFERRED_PAGE_ELEMENT_COUNT' => 0,

                                    'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
                                    'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                                    'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
                                    'PRODUCT_DISPLAY_MODE' => 'Y',
                                    'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                                    'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                                    'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                                    'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                                    'TEXT_LABEL_GIFT' => $arParams['GIFTS_DETAIL_TEXT_LABEL_GIFT'],

                                    'LABEL_PROP_' . $arParams['IBLOCK_ID'] => array(),
                                    'LABEL_PROP_MOBILE_' . $arParams['IBLOCK_ID'] => array(),
                                    'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

                                    'ADD_TO_BASKET_ACTION' => $basketAction,
                                    'MESS_BTN_BUY' => $arParams['~GIFTS_MESS_BTN_BUY'],
                                    'MESS_BTN_ADD_TO_BASKET' => $arParams['~GIFTS_MESS_BTN_BUY'],
                                    'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
                                    'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],

                                    'PROPERTY_CODE' => $arParams['LIST_PROPERTY_CODE'],
                                    'PROPERTY_CODE_MOBILE' => $arParams['LIST_PROPERTY_CODE_MOBILE'],
                                    'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],

                                    'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
                                    'OFFERS_PROPERTY_CODE' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
                                    'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                                    'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
                                    'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],

                                    'HIDE_NOT_AVAILABLE' => 'Y',
                                    'HIDE_NOT_AVAILABLE_OFFERS' => 'Y',
                                    'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                                    'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
                                    'PRICE_CODE' => $arParams['PRICE_CODE'],
                                    'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
                                    'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
                                    'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                    'BASKET_URL' => $arParams['BASKET_URL'],
                                    'ADD_PROPERTIES_TO_BASKET' => $arParams['ADD_PROPERTIES_TO_BASKET'],
                                    'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
                                    'PARTIAL_PRODUCT_PROPERTIES' => $arParams['PARTIAL_PRODUCT_PROPERTIES'],
                                    'USE_PRODUCT_QUANTITY' => 'N',
                                    'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                                    'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

                                    'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                                    'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                                    'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),
                                ),
                                $component,
                                array("HIDE_ICONS" => "Y")
                            );
                        }
                        ?>
                        </div>
                        <?
                    }
                    ?>
                </div>
                <div class="col-xs-12">


                    <?

                    $dbPriceType = CCatalogGroup::GetList(
                        array("SORT" => "ASC"),
                        array("NAME" => $arParams["PRICE_CODE"][0])
                    )->Fetch();
                    $ID_PRICE = $dbPriceType['ID'];

                    switch ($_COOKIE['catalog_secton_sort']) {
                        case 'popularity':
                            $sort = "shows";
                            $sort_po = "desc";
                            $activ_punct_one = "active";
                            break;
                        case 'cheaper':
                            $sort = "catalog_PRICE_1";
                            $sort_po = "asc";
                            $activ_punct_two = "active";
                            break;
                        case 'expensive':
                            $sort = "catalog_PRICE_1";
                            $sort_po = "desc";
                            $activ_punct_three = "active";
                            break;
                        default:
                            $sort = "shows";
                            $sort_po = "desc";
                            $activ_punct_one = "active";
                            break;
                    }

                    if (!empty($_COOKIE['catalog_secton_count'])) {
                        $count_element = $_COOKIE['catalog_secton_count'];
                    } else {
                        $count_element = 18;
                    }
                    ?>
                    <div class="row">
                        <div class="catalog_section_option_bolock">
                            <div class="l_option_box sorting">
                                <span class="sorting-title"><?=GetMessage("SORT_PO");?></span>
                                <div class="sorting-box">
                                    <a class="per_option <?= $activ_punct_one; ?>" data-percatalog="popularity"><?=GetMessage("PO_POPILJAR");?></a>
                                    <a class="per_option <?= $activ_punct_two; ?>" data-percatalog="cheaper"><?=GetMessage("PO_DESHEVLE");?></a>
                                    <a class="per_option <?= $activ_punct_three; ?>" data-percatalog="expensive"><?=GetMessage("PO_DOROZHE");?></a>
                                </div>
                            </div>
                            <div class="r_option_box sorting">
                                <span class="sorting-title"><?=GetMessage("VIVODIT_PO");?></span>
                                <div class="sorting-box">
                                    <a class="per_count <? if ($count_element == 18) {
                                        echo "active";
                                    } ?>" data-percatalog="18">18</a>
                                    <a class="per_count <? if ($count_element == 36) {
                                        echo "active";
                                    } ?>" data-percatalog="36">36</a>
                                    <a class="per_count <? if ($count_element == 108) {
                                        echo "active";
                                    } ?>" data-percatalog="108">108</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?
                    if($_GET['is_ajax'] == "catalog_list" && $_GET['bxajaxid'])
                    {
                        $APPLICATION->RestartBuffer();
                    }

                    $GLOBALS[$arParams["FILTER_NAME"]][] = $arResult['NO_CATALOG'];

                    $intSectionID = $APPLICATION->IncludeComponent(
                        "bitrix:catalog.section",
                        "",
                        array(
                            "PODBOKI_TEXT" => $GLOBALS['PODBORKI_TEXT'],
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
                            "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                            "BASKET_URL" => $arParams["BASKET_URL"],
                            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                            "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                            "FILTER_NAME" => $arParams["FILTER_NAME"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                            "SET_TITLE" => $set_title,
                            "MESSAGE_404" => $arParams["~MESSAGE_404"],
                            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                            "SHOW_404" => $arParams["SHOW_404"],
                            "FILE_404" => $arParams["FILE_404"],
                            "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                            "PAGE_ELEMENT_COUNT" => $count_element,
                            "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                            "PRICE_CODE" => $arParams["PRICE_CODE"],
                            "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                            "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                            "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                            "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                            "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                            "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                            "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

                            "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                            "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                            "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                            "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                            "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                            "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                            "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                            "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                            "LAZY_LOAD" => $arParams["LAZY_LOAD"],
                            "MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
                            "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

                            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                            "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                            "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                            "OFFERS_SORT_FIELD" => $sort,
                            "OFFERS_SORT_ORDER" => $sort_po,
                            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                            "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                            "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
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

                            'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                            "ADD_SECTIONS_CHAIN" => $section_chain,
                            'ADD_TO_BASKET_ACTION' => $basketAction,
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
                            'PROP_ARTICUL' => $arParams['PROP_ARTICUL'],

                            "SET_META_KEYWORDS" => $set_meta_keywords,
                            "SET_META_DESCRIPTION" => $set_meta_dis,
                            "AJAX_MODE" => "N",

                        ),
                        $component
                    );


                    if($_GET['is_ajax'] == "catalog_list" && $_GET['bxajaxid'])
                    {
                        die();
                    }
                    ?>

                    <div class="boottom_podborki">
                        <? $APPLICATION->IncludeComponent(
                            "krayt:podborki",
                            "bottom",
                            Array(
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "SECTION_CODE" => $section_podborka,
                                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                                "CATALOG_IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                "PODBORKI_IBLOCK_ID" => $arParams['IBLOCK_PODBORKI'],
                                "UF_PODBORKI_FILTER"=>'bottom',


                            ),
                            $component,
                            array('HIDE_ICONS' => 'Y')
                        ); ?>
                    </div>

            <?else:?>

                <span class="no_tovar"><?=GetMessage("CATALOG_NO_TOVAR");?></span>

             <?endif;?>

                    <div class="product-carousel prosmotr-carousel">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:catalog.products.viewed",
                            "prosmotr_section",
                            Array(
                                "CONVERT_CURRENCY" => "N",
                                "DEPTH" => "2",
                                "DISPLAY_COMPARE" => "N",
                                "ENLARGE_PRODUCT" => "STRICT",
                                "HIDE_NOT_AVAILABLE" => "N",
                                "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                                "IBLOCK_MODE" => "single",
                                'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                                'LABEL_PROP' => $arParams['LABEL_PROP'],
                                'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                                'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                                "OFFER_TREE_PROPS_3" => array(),
                                "PAGE_ELEMENT_COUNT" => "9",
                                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                'PRICE_CODE' => $arParams['PRICE_CODE'],
                                "PRICE_VAT_INCLUDE" => "Y",
                                "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                                "PRODUCT_ID_VARIABLE" => "id",
                                "PRODUCT_PROPS_VARIABLE" => "prop",
                                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                                "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                                "PRODUCT_SUBSCRIPTION" => "Y",
                                "PROPERTY_CODE_2" => array("", ""),
                                "PROPERTY_CODE_3" => array("", ""),
                                "PROPERTY_CODE_5" => array("", ""),
                                "PROPERTY_CODE_MOBILE_2" => array(),
                                "SECTION_CODE" => "",
                                "SECTION_ELEMENT_CODE" => "",
                                "SECTION_ELEMENT_ID" => "",
                                "SECTION_ID" => "",
                                "SHOW_CLOSE_POPUP" => "N",
                                "SHOW_DISCOUNT_PERCENT" => "N",
                                "SHOW_FROM_SECTION" => "N",
                                "SHOW_MAX_QUANTITY" => "N",
                                "SHOW_OLD_PRICE" => $arParams['SHOW_OLD_PRICE'],
                                "SHOW_PRICE_COUNT" => "1",
                                "SHOW_PRODUCTS_2" => "N",
                                "SHOW_PRODUCTS_5" => "N",
                                "SHOW_SLIDER" => "Y",
                                "SLIDER_INTERVAL" => "3000",
                                "SLIDER_PROGRESS" => "N",
                                "TEMPLATE_THEME" => "blue",
                                "USE_ENHANCED_ECOMMERCE" => "N",
                                "USE_PRICE_COUNT" => "N",
                                "USE_PRODUCT_QUANTITY" => "N"
                            )
                        ); ?>
                    </div>

                </div>


                <?
                //$GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;?>
            </div>




        </div>


        <? if ($isSidebar): ?>
            <div class="col-md-3 col-sm-4">
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:main.include",
                    "",
                    array(
                        "AREA_FILE_SHOW" => "file",
                        "PATH" => $arParams["SIDEBAR_PATH"],
                        "AREA_FILE_RECURSIVE" => "N",
                        "EDIT_MODE" => "html",
                    ),
                    false,
                    array('HIDE_ICONS' => 'Y')
                );
                ?>

            </div>
        <? endif ?>


    </div>
