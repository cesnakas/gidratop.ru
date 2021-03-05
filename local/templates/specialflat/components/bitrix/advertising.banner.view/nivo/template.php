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
<section>
<? if ($arParams['CASUAL_PROPERTIES']['TYPE'] == 'template'): ?>

	<? if ($arParams['PROPS']['LINK_URL'] != '' && !isset($arParams['PREVIEW'])): ?>
		<a href="<?=$arParams['PROPS']['LINK_URL']?>" title="<?=$arParams['PROPS']['LINK_TITLE']?>" target="<?=$arParams['PROPS']['LINK_TARGET']?>" style="display:block;">
	<? endif ?>

	<? if (isset($arParams['PROPS']['BACKGROUND']) && $arParams['PROPS']['BACKGROUND'] == 'video'): ?>
	<? elseif (isset($arParams['PROPS']['BACKGROUND']) && $arParams['PROPS']['BACKGROUND'] == 'stream'): ?>
	<? else: ?>
    <div class="main_banner_cont" style="background-image: url(<?=$arParams['FILES']['IMG']['SRC']?>);">


	<? if ($arParams['EXT_MODE'] == 'N'): ?>
		<? if ($arParams['PROPS']['OVERLAY'] == 'Y'): ?>
			<div class="bx-advertisingbanner-pattern" style="background:rgba(<?=$arParams['PROPS']['OVERLAY_COLOR']?>)"></div>
		<? endif ?>

		<? if ($arParams['PROPS']['HEADING_SHOW'] == 'Y' || $arParams['PROPS']['ANNOUNCEMENT_SHOW'] == 'Y' || $arParams['PROPS']['BUTTON'] == 'Y'): ?>
            <div class="main_filter"></div>
            <div class="main_cont">
				<? if ($arParams['PROPS']['HEADING_SHOW'] == 'Y'): ?>
                    <div class="main_subtitle wow faster fadeInUp"><?=$headingText?></div>
				<? endif ?>

				<? if ($arParams['PROPS']['ANNOUNCEMENT_SHOW'] == 'Y'): ?>
                    <div class="main_title main_title_sec wow faster fadeInUp"><?=html_entity_decode($announcementText)?></div>
				<? endif ?>

				<? if ($arParams['PROPS']['BUTTON'] == 'Y'): ?>
                    <a href="<?=$arParams['PROPS']['BUTTON_LINK_URL']?>" target="<?=$arParams['PROPS']['BUTTON_LINK_TARGET']?>" class="main_btn btn wow faster fadeIn" data-wow-delay=".6s"><?=$arParams['PROPS']['BUTTON_TEXT']?></a>
				<? endif ?>
                <? if ($arParams['PROPS']['BUTTON'] == 'Y'): ?>
                    <div class="main_comment wow faster fadeIn" data-wow-delay=".6s"><?=$arParams['PROPS']['LINK_TITLE']?></div>
                <? endif ?>
			</div>
		<? endif ?>
	<? elseif ($arParams['EXT_MODE'] == 'Y'): ?>
		<?=$headingText?>
	<? endif ?>
	<? if ($arParams['PROPS']['LINK_URL'] != '' && !isset($arParams['PREVIEW'])): ?>
		</a>
	<? endif ?>
        </div>
    <? endif ?>

<? else: ?>
	<? if ($arParams['CASUAL_PROPERTIES']['URL'] != '' && !isset($arParams['PREVIEW'])): ?>
		<a href="<?=$arParams['CASUAL_PROPERTIES']['URL']?>" title="<?=$arParams['CASUAL_PROPERTIES']['ALT']?>" target="<?=$arParams['CASUAL_PROPERTIES']['URL_TARGET']?>" style="display:block;">
	<? endif ?>
	<img src="<?=$arParams['FILES']['CASUAL_IMG']['SRC']?>" class="center-block img-responsive">
	<? if ($arParams['CASUAL_PROPERTIES']['URL'] != '' && !isset($arParams['PREVIEW'])): ?>
		</a>
	<? endif ?>
<? endif ?>



</section>
