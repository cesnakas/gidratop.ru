<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogTopComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 *
 * @var string $strElementEdit
 * @var string $strElementDelete
 * @var array $arElementDeleteParams
 * @var array $arSkuTemplate
 */
global $APPLICATION;
$this->setFrameMode(true);
?>

<?/*
if (!empty($arResult['ITEMS']))
{
	$elementEdit = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT');
	$elementDelete = CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE');
	$elementDeleteParams = array('CONFIRM' => GetMessage('CT_BCT_ELEMENT_DELETE_CONFIRM'));

	$fullPath = \Bitrix\Main\Application::getDocumentRoot().$templateFolder;
	$templateLibrary = array('popup');
	$currencyList = '';

	if (!empty($arResult['CURRENCIES']))
	{
		$templateLibrary[] = 'currency';
		$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
	}

	$templateData = array(
		'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
		'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
		'TEMPLATE_LIBRARY' => $templateLibrary,
		'CURRENCIES' => $currencyList
	);
	unset($currencyList, $templateLibrary);

	switch ($arParams['VIEW_MODE'])
	{
		case 'BANNER':
			include($fullPath.'/banner/template.php');
			break;
		case 'SLIDER':
			include($fullPath.'/slider/template.php');
			break;
		case 'SECTION':
			include($fullPath.'/section/template.php');
			break;
	}
	?>
	<script type='text/javascript'>
	   BX.message({
		   BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCT_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		   BASKET_URL: '<?=$arParams['BASKET_URL']?>',
		   ADD_TO_BASKET_OK: '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
		   TITLE_ERROR: '<?=GetMessageJS('CT_BCT_CATALOG_TITLE_ERROR')?>',
		   TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCT_CATALOG_TITLE_BASKET_PROPS')?>',
		   TITLE_SUCCESSFUL: '<?=GetMessageJS('ADD_TO_BASKET_OK')?>',
		   BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCT_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		   BTN_MESSAGE_SEND_PROPS: '<?=GetMessageJS('CT_BCT_CATALOG_BTN_MESSAGE_SEND_PROPS')?>',
		   BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCT_CATALOG_BTN_MESSAGE_CLOSE')?>',
		   BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCT_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		   COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCT_CATALOG_MESS_COMPARE_OK')?>',
		   COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCT_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
		   COMPARE_TITLE: '<?=GetMessageJS('CT_BCT_CATALOG_MESS_COMPARE_TITLE')?>',
		   PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCT_CATALOG_PRICE_TOTAL_PREFIX')?>',
		   BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCT_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		   SITE_ID: '<?=SITE_ID?>'
	   });
	</script>
	<?
}
*/?>

    <div class="gt-container">

        <div class="gt-section-title">
            <h2><?=$arParams['TITLE_BOX']; // Акции ?></h2>
            <div class="bg-text">Stock</div>
        </div>

        <div class="owl-carousel owl-theme gt-slider-promo" id="slider-promos">

            <? foreach ($arResult['ITEMS'] as $key => $arItem) {
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
                $strMainID = $this->GetEditAreaId($arItem['ID']);
                $arItemIDs = array(
                    'ID' => $strMainID,
                    'PICT' => $strMainID.'_pict',
                    'SECOND_PICT' => $strMainID.'_secondpict',
                    'MAIN_PROPS' => $strMainID.'_main_props',

                    'QUANTITY' => $strMainID.'_quantity',
                    'QUANTITY_DOWN' => $strMainID.'_quant_down',
                    'QUANTITY_UP' => $strMainID.'_quant_up',
                    'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
                    'BUY_LINK' => $strMainID.'_buy_link',
                    'SUBSCRIBE_LINK' => $strMainID.'_subscribe',

                    'PRICE' => $strMainID.'_price',
                    'DSC_PERC' => $strMainID.'_dsc_perc',
                    'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',

                    'PROP_DIV' => $strMainID.'_sku_tree',
                    'PROP' => $strMainID.'_prop_',
                    'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop'
                );
                $strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/i", "x", $strMainID);
            ?>

            <div class="item gt-promo-item" id="<? echo $arItemIDs['PICT']; ?>">
                <div class="img">
                    <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="">
                </div>
            </div>

            <? } ?>

        </div>

        <script type="text/javascript">
            $('#slider-promos').owlCarousel({
                margin: 30,
                loop: true,
                autoWidth: true,
                responsiveClass: true,
                nav: true,
                responsive: {
                    0: {
                        items: 2,
                        nav: true,
                        margin: 5,
                    },
                    600: {
                        items: 3,
                        nav: true,
                        margin: 15,
                    },
                    1200: {
                        items: 3,
                        nav: true,
                        loop: true,
                        margin: 30,
                    }
                }
            })
        </script>

    </div>
