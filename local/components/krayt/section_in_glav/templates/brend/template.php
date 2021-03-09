<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!empty($arResult)):?>
    <section class="section_in_glav brend">
        <div class="brend-block owl-carousel">
            <? foreach ($arResult as $arItem):?>
                <a href="<?= $arItem['SECTION_PAGE_URL'] ?>" class="brend-item"
                   title="<?= GetMessage("PEREITI_BREND");?> <?= $arItem['NAME'] ?>">
                    <? if (empty($arItem['PICTURE'])) {
                        $arItem['PICTURE'] = $templateFolder . '/images/no_photo.png';
                    } ?>
                    <div class="brend-item-img">
                        <div class="img-box">
                            <div class="img" style="background-image: url(<?= $arItem['PICTURE']; ?>);"></div>
                        </div>
                    </div>
                </a>
            <?endforeach;?>
        </div>
        <div class="allbrand_cont"><a href="<?=SITE_DIR?>proizvoditeli" class="btn allbrands"><?=\Bitrix\Main\Localization\Loc::getMessage('VSE_CAT_NA_GLAV_BREND')?></a></div>
    </section>
<? endif; ?>
