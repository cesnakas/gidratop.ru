
<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
echo "<div hidden>";
print_r($arResult['BREND']);
echo "</div>";

if (!empty($arResult)):?>
   <div class="brand-card">
        <div class="gt-breadcrumbs-holder">
			<ul class="gt-breadcrumbs">
				<li><a href="/">Главная</a></li>
				<li><a href="/proizvoditeli/">Производители</a></li>
				<li><a href="<?= $arResult['BREND']['SECTION_PAGE_URL'] ?>"><?= $arResult['BREND']['NAME'] ?></a></li>
                <li>Коллекция: <?= $arResult['COLLECTION']['NAME'] ?></li>
			</ul>
        </div>


        <div class="brand-card-top">

			<div class="bg">
				<img src="/local/templates/main/img/images/brand_card_bg.png" alt="">
			</div>

			<div class="gt-block-white gt-brand-lead">
				<div class="gt-img_box">
					<? if (empty($arResult['BREND']['PICTURE'])) {
							$arResult['BREND']['PICTURE'] = $templateFolder . "/images/no_photo.png";
					} else {
						$arResult['BREND']['PICTURE'] = CFile::GetPath($arResult['BREND']["PICTURE"]);
					} ?>
                    <div class="gt-img" style="background-image: url(<?= $arResult['BREND']['PICTURE']; ?>);"></div>
				</div>

				<div class="gt-description">
					<h1><?= GetMessage("COLLECTION"); ?><span class="gt-text-blue"><?= $arResult['COLLECTION']['NAME'] ?></span> от <?= $arResult['BREND']['NAME'] ?></h1>
				</div>

				<div class="gt-brand-action">
					<a href="#" class="gt-button">Каталог товаров</a>
				</div>
			</div>
        </div>

   </div>
    


   


    <? if (!empty($arResult["SECTION"])): ?>

        </section>

        <section class="gt-section" id="section-brend-items">
            <section class="gt-container">

            <div class="gt-section-title">
                <h2><?= GetMessage("PRODUCT"); ?></h2>
                <div class="bg-text">Goods</div>
            </div>


            <div class="gt-page-catalog">
                <div class="gt-catalog-aside" id="gt-catalog-filters">

                    <div class="gt-show-mobile gt-catalog-filter-mobile-title">
                        <span id="gtMobileFilterPanelName">Панель фитров:</span>
                    </div>
                    <!--ПАНЕЛЬ ФИЛЬТРОВ-->
                    <div class="gt-aside-block expanded">
                        <div class="gt-aside-block-title">
                            <a href="#" class="gt-aside-toggler" onclick="return false;">Товары <?= $arResult['COLLECTION']['NAME'] ?></a>
                        </div>
                        <div class="gt-aside-block-content" id="brand-catalog-types">
							<? foreach ($arResult["SECTION"] as $section): ?>
								<?$cifra = abs(crc32($arResult['BREND']['ID']));?>
								<div class="gt-checkbox">
									<input id="checkbox<?=$section["ID"]?>" data-id="<?=$section["ID"]?>" type="checkbox" class="gt-cb-category" />
									<label for="checkbox<?=$section["ID"]?>">
									    <?= $section['NAME'] ?>&nbsp;(<?= count($section['PRODUCT']); ?>)
										<a style="display:none;" target="_blank" onclick="return false;" href="<?= $section['SECTION_PAGE_URL'] ?>?arFilterCatalog_310_<?=abs(crc32($arResult['BREND']['ID'])); ?>=Y&set_filter=<?=GetMessage("POKA");?>"><?= $section['NAME'] ?> <span>(<?= count($section['PRODUCT']); ?>)</span></a>
									</label>
								</div>
							<? endforeach; ?>
                        </div>
                    </div>
                    
                    <!--!!!ПАНЕЛЬ ФИЛЬТРОВ-->
                    <div class="gt-hide-mobile">
					    <br>
                        <a href="#" class="gt-button gt-btn-full" onclick="fn_BrandCatalogFilters(event, false)">Применить</a>
                        <a href="#" class="gt-button gt-btn-greentext gt-btn-full" onclick="fn_BrandCatalogFilters(event, true)">Сбросить фильтры</a>
                    </div>

                    <div class="gt-aside-block expanded">
                        <div class="gt-aside-block-title">
                            <a href="#" class="gt-aside-toggler" onclick="clickCatalogExpand(event, this)">Коллекции <?= $arResult['BREND']['NAME'] ?></a>
                        </div>
                        <div class="gt-aside-block-content">
                            <ul class="gt-aside-menu gt-link-gray">
							<? foreach ($arResult['DOP_COLLECTION'] as $collection): ?>
								<li>
									<a href="<?= $collection['DETAIL_PAGE_URL'] ?>">
										<span><?= $collection['NAME'] ?></span>
									</a>
								</li>
							<? endforeach; ?>
                            </ul>

                        </div>

                    </div>


                    <div class="gt-catalog-mobile-filters gt-show-mobile">
                        <a href="#" class="gt-button gt-btn-full" onclick="fn_BrandCatalogFilters(event, false, true)">Применить</a>
                        <a href="#" class="gt-button gt-btn-greentext gt-btn-full" onclick="fn_BrandCatalogFilters(event, true, true)">Сбросить фильтры</a>
                    </div>
                </div>
                <div class="gt-catalog-content">
                    <div class="gt-show-mobile gt-mobile-filters">
                        <div class="gt-flex-row" style="justify-content: space-between;">
                            <div>
                                <div class="gt-dropdown" onclick="toggleCatalogFilters(event, true, 1)">
                                    <div class="name">Коллекции</div>
                                    <span class="toggler"></span>
                                </div>
                            </div>
                            <div>
                                <div class="gt-dropdown" onclick="toggleCatalogFilters(event, true, 0)">
                                    <div class="name">Фильтры</div>
                                    <span class="toggler"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="gt-catalog-content-menu gt-hide-mobile ">

                        <ul class="gt-catalog-menu ">
                            <li>Сортировать:</li>
                            <li><a href="# " class="active ">По популярности</a></li>
                            <li><a href="# ">Сначала дешевые</a></li>
                            <li><a href="# ">Сначала дорогие</a></li>
                        </ul>

                        <div class="gt-catalog-viewtype ">
                            <ul class="gt-inline-ul ">
                                <li>
                                    <a href="# " class="gt-view-icon gt-view-1 "></a>
                                </li>
                                <li>
                                    <a href="# " class="gt-view-icon gt-view-2 "></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="gt-catalog-content-items gt-product-items-inrow gt-items-buttons-toggled gt-catalog-items-holder ">
                        <!-- Компоненты-->
                        <? foreach ($arResult["SECTION"] as $section): ?>
                            <?
                            global $filterCol;
                            $filterCol = array("PROPERTY_COLLECTION" => $arResult['COLLECTION']['ID'], "PROPERTY_NO_CATALOG" => false); ?>
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:catalog.section",
                                "brend-gt",
                                Array(
                                    "ACTION_VARIABLE" => "action",
                                    "ADD_PICT_PROP" => "MORE_PHOTO",
                                    "ADD_PROPERTIES_TO_BASKET" => "Y",
                                    "ADD_SECTIONS_CHAIN" => "N",
                                    "ADD_TO_BASKET_ACTION" => "ADD",
                                    "AJAX_MODE" => "N",
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
                                    "PAGE_ELEMENT_COUNT" => "1800",
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
            
                        <? endforeach; ?>
                        <!-- !Компоненты-->
                    </div>
                </div>
            </div>

        </section>





    <? endif; ?>
    


    <? if (!empty($arResult["DOP_COLLECTION"])): ?>
        </section>

        <section class="gt-section" id="section-brend-collections">
        <section class="gt-container">
            <div class="gt-section-title">
                <h2><?= GetMessage("DOP_COLLECTION"); ?></h2>
                <div class="bg-text">Collections</div>
            </div>


            <div class="gt-collections">
                <div class="gt-collections-list">
                    <? foreach ($arResult['DOP_COLLECTION'] as $collection): ?>
                        <a href="<?= $collection['DETAIL_PAGE_URL'] ?>" class="gt-collection-item">
                            <div class="gt-collection_box">
                                <?//print_r($collection);?>
                                <span><?= $collection['NAME'] ?></span>
                            </div>
                        </a>
                    <? endforeach; ?>
                </div>
            </div>
        </section>


    <? endif; ?>
<? endif; ?>