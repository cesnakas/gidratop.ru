<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!empty($arResult)):?>
    <? if ($arResult['TYPE'] == "tovar") {
        ?>
        <div class="podborki_block">
            <?
            if($arResult['PODBORKI'])
            foreach ($arResult['PODBORKI'] as $arItems):?>
                <? if ($arItems['UF_PODBORKI_TOP'] == true):?>
                    <div class="podborki_box">
                        <a class="podborki_box-link"
                           href="<?= $arItems['SECTION_PAGE_URL']; ?>">
                            <div class="img_box">
                                <? if (empty($arItems['PICTURE'])) {
                                    $arItems['PICTURE'] = $templateFolder . "/images/no_photo.png";
                                } else {
                                    $arItems['PICTURE'] = CFile::GetPath($arItems["PICTURE"]);
                                } ?>
                                <div class="bg_img" style="background-image: url(<?= $arItems['PICTURE']; ?>);"></div>
                            </div>
                        </a>
                        <div class="title">
                            <a href="<?= $arItems['SECTION_PAGE_URL']; ?>"><?= $arItems['NAME']; ?></a>
                        </div>
                    </div>
                <?endif; ?>
            <?endforeach; ?>
        </div>
    <?
    } elseif ($arResult['TYPE'] == "podborka") {
        ?>
        <div class="page_podborki">
            <div class="osn_podborki_block">
                <? $GLOBALS['PODBORKI_TEXT'] = $arResult['DESCRIPTION']; ?>
            </div>
            <div class="podborki_block">
                <?
                if($arResult['ELEMENT'])
                foreach ($arResult['ELEMENT'] as $arItems):?>
                    <div class="podborki_box">
                        <a class="podborki_box-link"
                           href="<?= $arItems['SECTION_PAGE_URL']; ?>">
                            <div class="img_box">
                                <? if (empty($arItems['PICTURE'])) {
                                    $arItems['PICTURE'] = $templateFolder . "/images/no_photo.png";
                                } else {
                                    $arItems['PICTURE'] = CFile::GetPath($arItems["PICTURE"]);
                                } ?>
                                <div class="bg_img" style="background-image: url(<?= $arItems['PICTURE']; ?>);"></div>
                            </div>
                        </a>
                        <div class="title">
                            <a href="<?= $arItems['SECTION_PAGE_URL']; ?>"><?=$arItems['NAME']; ?></a>
                        </div>
                    </div>
                <?endforeach; ?>
            </div>
        </div>

    <?
    }
endif;
?>

