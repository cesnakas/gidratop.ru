<div class="w1200">

<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!empty($arResult)):?>
    <div class="brend_spisok_block">
        <h1><?=GetMessage("BREND_SECTION_TITLE");?></h1>
        <div class="brend_spisok_box">
            <div class="brend_spisok_alfavit">
                <div class="alfavit">
                    <? foreach ($arResult['ALFAVIT'] as $buk):?>
                        <? if (strripos($_SERVER['REQUEST_URI'], "bukva")) {
                            $url = sgp($_SERVER['REQUEST_URI'], 'bukva', $buk);
                        } else {
                            if (strripos($_SERVER['REQUEST_URI'], "?")) {
                                $url = $_SERVER['REQUEST_URI'] . "&bukva" . $buk;

                            } else {
                                $url = "?bukva=" . $buk;
                            }
                        } ?>
                        <? if ($buk != " "):?>
                            <? if ($_REQUEST['bukva'] == $buk) {
                                $active = "active";
                            } else {
                                unset($active);
                            } ?>
                            <a class="alfavit__item <?= $active; ?>" href="<?= $url; ?>"><?= $buk; ?></a>
                        <? endif; ?>
                    <? endforeach; ?>
                    <? if (empty($_REQUEST['bukva'])) {
                        $active = "active";
                    } else {
                        unset($active);
                    } ?>
                    <a class="alfavit__item <?= $active; ?>" href="<?= sgp($_SERVER['REQUEST_URI'], 'bukva', ''); ?>"><?=GetMessage("VSE");?></a>
                </div>
            </div>
            <div class="brend_spisok_element_block">
                <? foreach ($arResult['BREND'] as $brend):?>
                    <a class="brend_spisok_element_box" href="<?= $brend['SECTION_PAGE_URL']; ?>"
                       title="<?= $brend['NAME'] ?>">
                        <div class="c-elem">
                            <div class="img_box">
                                <? if (empty($brend['PICTURE'])) {
                                    $brend['PICTURE'] = $templateFolder . "/images/no_photo.png";
                                } else {
                                    $brend['PICTURE'] = CFile::GetPath($brend["PICTURE"]);
                                } ?>
                                <div class="bg_img" style="background-image: url(<?= $brend['PICTURE']; ?>);"></div>
                            </div>
                            <div class="name">
                                <div class="brand"><?= $brend['NAME'] ?></div>
                                <div class="country"><?= $brend['UF_COUNTRY'] ?></div>
                            </div>
                        </div>
                    </a>
                <? endforeach; ?>
            </div>
        </div>
        <div class="page-navigation" data-pagination-num="<?=$navParams['NavNum']?>">
            <? echo $arResult["NAV_STRING"]; ?>
        </div>
    </div>
<? endif; ?>

</div>