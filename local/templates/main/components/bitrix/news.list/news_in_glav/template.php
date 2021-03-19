<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
use Bitrix\Main\Localization\Loc;

echo "<div id='div_news_in_glav' hidden>";
print_r($arResult);
echo "</div>";
?>
<section class="news_in_glav">
    <div class="title_box">
        <?=Loc::getMessage('K_TITLE_NEWS');?>
    </div>
<div class="main_news_slider">
    <? $i = 1; ?>
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        if ($i % 2) {
            $class_one = "right";
            $class_two = "left";
        } else {
            $class_one = "left";
            $class_two = "right";
        }
        ?>
    <div class="news_wrap wow fadeInUp">
        <?if($arParams['LOAD_IMG_JS'] == 'Y'):?>
        <div class="news-item clearfix img-load-news_in_glav"
             id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
             style="background-image: url('<?=$templateFolder?>/images/fon.svg');"
             data-src="<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>"
            >
        <?else:?>
            <div class="news-item clearfix"
                 id="<?= $this->GetEditAreaId($arItem['ID']); ?>"
                 style="background-image: url(<?= $arItem["PREVIEW_PICTURE"]["SRC"] ?>);">
        <?endif;?>
                <a class="news_card_link" href="<?= $arItem['DETAIL_PAGE_URL'] ?>"></a>
            <div class="filter"></div>
            <div class="text_box <?= $class_two; ?>">
                <div class="content">
                    <div class="title_box"><?= $arItem['NAME']; ?></div>
                    <div class="text">
                        <?= $arItem['PREVIEW_TEXT']; ?>
                    </div>
                    <div class="link_box clearfix">
                        <a href="<?= $arItem['DETAIL_PAGE_URL'] ?>" class="detail"><?= GetMessage('PODROBNO'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <? $i++; ?>
    <? endforeach; ?>
</div>
</section>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
