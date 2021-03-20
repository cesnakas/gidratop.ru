<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        

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
?>

<div class="slides">

    <div class="gt-slide-item">

        <? // TODO: delete ?>
        <div class="gt-slider-slide">
            <div class="gt-slide-background">
                <img src="<?=SITE_TEMPLATE_PATH;?>/img/images/slider/slide1.jpg" alt="" />
            </div>
            <div class="gt-slide-caption">
                <p>Скидки на мебель для ванной комнаты</p>
                <p class="green">до 10%</p>
                <a href="#" class="gt-button">Подробнее</a>
            </div>
        </div>
        <? // end delete ?>

        <? foreach($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

        //#SITE_DIR#
        $link = '#';

        if($arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'])
        {
            $link = str_replace('#SITE_DIR#',SITE_DIR,$arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']);
        }
        ?>

        <div class="gt-slider-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <? if ($arParams["DISPLAY_PICTURE"]!="N" || is_array($arItem["PREVIEW_PICTURE"])): ?>
            <div class="gt-slide-background">
                <img
                <?if($arParams['LOAD_IMG_JS'] == 'Y'):?>
                    src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                <?else:?>
                    src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                <?endif;?>
                    width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                    height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                    alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                    title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
                />
            </div>
            <? endif; ?>
            <div class="gt-slide-caption">
                <p>Скидки на мебель для ванной комнаты</p>
                <p class="green">до 10%</p>
                <a href="#" class="gt-button">Подробнее</a>
            </div>
        </div>

        <? endforeach; ?>
    </div>

</div>

<script type="text/javascript">
    var sliderMain = new CustomSlider({
        id: 'gt-section-slider',
        adjustMode: true,
        //isShowSliderButtons: true,
        isShowSliderMenu: true,
        isInfiniteCycle: true,
        autoSlideInterval: true,
        autoSlideInterval: 5000,
        transitionType: 'all',
        speed: 500
    });
    sliderMain.buildTemplate();
</script>

<?/*
<script>
var arParamsSlide= <?=json_encode($arParams)?>;
	//$('.from_banner').css("display",'none');
	//$('.for_banner').css("margin-top",'20px');
	//$('.for_banner').html($('.from_banner').html());
	// $('.owl-carousel').css('width','100% !important');
</script>
*/?>