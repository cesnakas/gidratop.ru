<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/**
 * @global string $componentPath
 * @global string $templateName
 * @var CBitrixComponentTemplate $this
 */
$cartStyle = 'bx-basket circle-num';
$cartId = "bx_basket".$this->randString();
$arParams['cartId'] = $cartId;

if ($arParams['POSITION_FIXED'] == 'Y')
{
	$cartStyle .= "-fixed {$arParams['POSITION_HORIZONTAL']} {$arParams['POSITION_VERTICAL']}";
	if ($arParams['SHOW_PRODUCTS'] == 'Y')
		$cartStyle .= ' bx-closed';
}
else
{
	$cartStyle .= ' bx-opener';
}
?><script>
var <?=$cartId?> = new BitrixSmallCart;
</script>
<a class="header_basket_link" href="<?= $arParams['PATH_TO_BASKET'] ?>"></a>
<div class="basket_icon_box" id="open__basket" >
<div id="<?=$cartId?>" class="<?=$cartStyle?>">

    <?
	/** @var \Bitrix\Main\Page\FrameBuffered $frame */
	$frame = $this->createFrame($cartId, false)->begin();
		require(realpath(dirname(__FILE__)).'/ajax_template.php');
	$frame->beginStub();
		$arResult['COMPOSITE_STUB'] = 'Y';
		require(realpath(dirname(__FILE__)).'/top_template.php');
		unset($arResult['COMPOSITE_STUB']);
	$frame->end();
?>

</div>
</div>
<div class="header_icons_text"><?=\Bitrix\Main\Localization\Loc::getMessage('TSB1_CART')?></div>
<script type="text/javascript">
	<?=$cartId?>.siteId       = '<?=SITE_ID?>';
	<?=$cartId?>.cartId       = '<?=$cartId?>';
	<?=$cartId?>.ajaxPath     = '<?=$componentPath?>/ajax.php';
	<?=$cartId?>.templateName = '<?=$templateName?>';
	<?=$cartId?>.arParams     =  <?=CUtil::PhpToJSObject ($arParams)?>; // TODO \Bitrix\Main\Web\Json::encode
	<?=$cartId?>.closeMessage = '<?=GetMessage('TSB1_COLLAPSE')?>';
	<?=$cartId?>.openMessage  = '<?=GetMessage('TSB1_EXPAND')?>';
	<?=$cartId?>.activate();
</script>