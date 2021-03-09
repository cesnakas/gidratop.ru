<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!empty($arResult)):?>
    <? $url = explode('?', $_SERVER['REQUEST_URI']); ?>

    <section class="vision_blok">
        <h3>
            <?= GetMessage("VERSION_TITLE"); ?> <!-- <?= $arResult['NAME']; ?> -->
        </h3>
        <div class="box-table">
            <table id="myTable">
                <thead class="t_hed">
                <tr>
                    <? foreach ($arResult['NAME_TOP'] as $name):?>
                        <th <? if ($name == GetMessage("VERSION_CENA")) {
                            echo "class='price'";
                        } ?>><?= $name; ?></th>
                    <? endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <? foreach ($arResult['VISION'] as $arItem):?>
                    <tr>
                        <? if ($url[0] != $arItem['DETAIL_PAGE_URL']) {
                            ?>
                            <td><a href="<?= $arItem['DETAIL_PAGE_URL']; ?>"><?= $arItem['NAME']; ?></a></td>
                        <? } else {
                            ?>
                            <td><?= $arItem['NAME']; ?></td>
                        <? } ?>
                        <td><?=number_format($arItem['DISCOUNT_PRICE'],0, ',', ' ');?> <span class="rubl">p</span></td>
                        <?
                        if($arItem['PROPERTY'])
                        foreach ($arItem['PROPERTY'] as $prop):?>
                            <td><? if (empty($prop['VALUE'])) {
                                    ?>
                                    -
                                <? } else {
                                    ?>
                                    <?= $prop['VALUE_ENUM']?$prop['VALUE_ENUM']:$prop['VALUE']; ?>
                                <? } ?>
                            </td>
                        <? endforeach; ?>
                    </tr>
                <? endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="horizontal-scroll-mobile"></div>
    </section>
<? endif; ?>
