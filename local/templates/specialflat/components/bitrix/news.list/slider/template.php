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
<div class="from_banner" style="    overflow: hidden;">
<div class="row">
    <div class="main_banner col-12">
		<div class="owl-carousel" style='width:100% !important'>

        <?foreach($arResult["ITEMS"] as $arItem):?>
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

            <div class="banner_item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <?
                if($arParams["DISPLAY_PICTURE"]!="N" || is_array($arItem["PREVIEW_PICTURE"])):?>
                    <a href="<?=$link?>" class="banner__link">
                        <picture>
                            <source media="(max-width: 1024px)" srcset="<?=$arItem['DISPLAY_PROPERTIES']['MOBILE_BANNER']['FILE_VALUE']['SRC']?>">
                            <img
                                <?if($arParams['LOAD_IMG_JS'] == 'Y'):?>
                                         src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                <?else:?>
                                    src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
                                <?endif;?>
                                    width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
                                    height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
                                    alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
                                    title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
                        </picture>
                    </a>
                    <?
                endif;?>
            </div>
        <?endforeach;?>

        </div>
    </div>
</div>
</div>
<script>
var arParamsSlide= <?=json_encode($arParams)?>;
	//$('.from_banner').css("display",'none');
	//$('.for_banner').css("margin-top",'20px');
	//$('.for_banner').html($('.from_banner').html());
	// $('.owl-carousel').css('width','100% !important');
</script>
