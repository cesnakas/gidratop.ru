<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $arResult
 * @var array $arParams
 */

$this->setFrameMode(true);
$rnd = $component->randString();

$arParams['PROPS']['VIDEO_MUTE'] = $arParams['PROPS']['VIDEO_MUTE'] == 'Y' ? 'muted' : '';
$arParams['PROPS']['STREAM_MUTE'] = $arParams['PROPS']['STREAM_MUTE'] == 'Y' ? '1' : '0';
$arParams['AUTOPLAY'] = $arParams['INDEX'] == '0' ? '&autoplay=1' : '';
$arParams['PROPS']['HEADING_FONT_SIZE'] = intval($arParams['PROPS']['HEADING_FONT_SIZE']);
$arParams['PROPS']['ANNOUNCEMENT_FONT_SIZE'] = intval($arParams['PROPS']['ANNOUNCEMENT_FONT_SIZE']);
$arParams['PROPS']['HEADING_BG_OPACITY'] = isset($arParams['PROPS']['HEADING_BG_OPACITY']) ? intval($arParams['PROPS']['HEADING_BG_OPACITY']) : 100;

$arParams['PROPS']['OVERLAY_COLOR'] = hexdec(substr($arParams['PROPS']['OVERLAY_COLOR'],0,2)).','
	.hexdec(substr($arParams['PROPS']['OVERLAY_COLOR'],2,2)).','
	.hexdec(substr($arParams['PROPS']['OVERLAY_COLOR'],4,2)).','
	.abs(100 - intval($arParams['PROPS']['OVERLAY_OPACITY']))/100;

$arParams['PROPS']['HEADING_BG_COLOR'] = hexdec(substr($arParams['PROPS']['HEADING_BG_COLOR'],0,2)).','
	.hexdec(substr($arParams['PROPS']['HEADING_BG_COLOR'],2,2)).','
	.hexdec(substr($arParams['PROPS']['HEADING_BG_COLOR'],4,2)).','
	.abs(100 - $arParams['PROPS']['HEADING_BG_OPACITY'])/100;

$arParams['PROPS']['ANNOUNCEMENT_BG_COLOR'] = hexdec(substr($arParams['PROPS']['ANNOUNCEMENT_BG_COLOR'],0,2)).','
	.hexdec(substr($arParams['PROPS']['ANNOUNCEMENT_BG_COLOR'],2,2)).','
	.hexdec(substr($arParams['PROPS']['ANNOUNCEMENT_BG_COLOR'],4,2)).','
	.abs(100 - intval($arParams['PROPS']['ANNOUNCEMENT_BG_OPACITY']))/100;

$arParams['PROPS']['BUTTON_BG_COLOR'] = hexdec(substr($arParams['PROPS']['BUTTON_BG_COLOR'],0,2)).','
	.hexdec(substr($arParams['PROPS']['BUTTON_BG_COLOR'],2,2)).','
	.hexdec(substr($arParams['PROPS']['BUTTON_BG_COLOR'],4,2));

$arParams['PROPS']['PRESET'] = intval($arParams['PROPS']['PRESET']);
$animation = $arParams['PROPS']['ANIMATION'] == 'Y' ? ' data-duration="'.intval($arParams['PROPS']['ANIMATION_DURATION']).'" data-delay="'.intval($arParams['PROPS']['ANIMATION_DELAY']).'"' : '';
$playClass = $arParams['PROPS']['ANIMATION'] == 'Y' ? ' play-caption' : '';
$mobileHide = $arParams['PROPS']['ANNOUNCEMENT_MOBILE_HIDE'] == 'Y' ? ' hidden-xs' : '';

$id = '';
if ($arParams['PROPS']['BACKGROUND'] == 'stream')
{
	if (strpos($arParams['PROPS']['STREAM'], 'watch?') !== false && ($v = strpos($arParams['PROPS']['STREAM'], 'v=')) !== false)
	{
		$id = substr($arParams['PROPS']['STREAM'], $v + 2, 11);
	}
	elseif ($v = strpos($arParams['PROPS']['STREAM'], 'youtu.be/'))
	{
		$id = substr($arParams['PROPS']['STREAM'], $v + 9, 11);
	}
	elseif ($v = strpos($arParams['PROPS']['STREAM'], 'embed/'))
	{
		$id = substr($arParams['PROPS']['STREAM'], $v + 6, 11);
	}
}

if (is_array($arParams['PROPS']['HEADING']))
{
	$headingText = $arParams['PROPS']['HEADING']['CODE'];
}
else
{
	$headingText = $arParams['PROPS']['HEADING'];
	$announcementText = $arParams['PROPS']['ANNOUNCEMENT'];
}
?>

<? if ($arParams['CASUAL_PROPERTIES']['TYPE'] == 'template'): ?>

	<? if ($arParams['PROPS']['LINK_URL'] != '' && !isset($arParams['PREVIEW'])): ?>
		<a href="<?=$arParams['PROPS']['LINK_URL']?>" title="<?=$arParams['PROPS']['LINK_TITLE']?>" target="<?=$arParams['PROPS']['LINK_TARGET']?>" class="main_slider_right_item">
	<? endif ?>

	<? if (isset($arParams['PROPS']['BACKGROUND']) && $arParams['PROPS']['BACKGROUND'] == 'video'): ?>
	<? elseif (isset($arParams['PROPS']['BACKGROUND']) && $arParams['PROPS']['BACKGROUND'] == 'stream'): ?>
	<? else: ?>
        <img src="<?=$arParams['FILES']['IMG']['SRC']?>" alt="">


	<? if ($arParams['EXT_MODE'] == 'N'): ?>
		<? if ($arParams['PROPS']['OVERLAY'] == 'Y'): ?>
			<div class="bx-advertisingbanner-pattern" style="background:rgba(<?=$arParams['PROPS']['OVERLAY_COLOR']?>)"></div>
		<? endif ?>

		<? if ($arParams['PROPS']['HEADING_SHOW'] == 'Y' || $arParams['PROPS']['ANNOUNCEMENT_SHOW'] == 'Y' || $arParams['PROPS']['BUTTON'] == 'Y'): ?>
				<? if ($arParams['PROPS']['HEADING_SHOW'] == 'Y'): ?>
                    <span class="subtitle"><?=$headingText?></span>
				<? endif ?>

				<? if ($arParams['PROPS']['ANNOUNCEMENT_SHOW'] == 'Y'): ?>
                    <span class="title title_two"><?=html_entity_decode($announcementText)?></span>
				<? endif ?>

		<? endif ?>
	<? elseif ($arParams['EXT_MODE'] == 'Y'): ?>
		<?=$headingText?>
	<? endif ?>
	<? if ($arParams['PROPS']['LINK_URL'] != '' && !isset($arParams['PREVIEW'])): ?>
		</a>
	<? endif ?>
    <? endif ?>

<? else: ?>

<? endif ?>