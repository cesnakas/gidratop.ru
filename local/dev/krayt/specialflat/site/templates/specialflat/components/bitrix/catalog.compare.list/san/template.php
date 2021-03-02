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
$containerId = "catalog-compare-list" . $this->randString();
?>

<div class="emarket-compare-list circle-num" id="<? echo $containerId ?>">
    <? $frame = $this->createFrame($containerId)->begin(''); ?>
    <div class="btn_sravnenie">
            <span>
                <? if (count($arResult) > 0) {
                    echo count($arResult);
                } elseif (count($arResult) == 0) {
                    echo 0;
                } elseif ($_REQUEST['action_del'] == "DELETE_COMPARE") {
                    echo 0;
                } ?>
            </span>
    </div>


    <?
    $arSection = array();
    foreach ($arResult as $item) {
        $arSection[$item['IBLOCK_SECTION_ID']][] = $item;
    }
    ?>
    <? if (count($arResult) > 0): ?>
        <div style='display:none;' class="bx_catalog_compare_form" id="open__compare-list">
            <?
            $arIds = array();
            foreach ($arSection as $key => $sect):?>
                <ul>
                    <? foreach ($sect as $item):?>
                        <li class="compare_item">
                            <div class="compare_item_img">
                                <a href="<?= $item['DETAIL_PAGE_URL'] ?>">
                                    <? if (empty($item['PICTURE'])) {
                                        $item['PICTURE'] = $templateFolder . "/images/no_photo.png";
                                    } ?>
                                    <img src="<?= $item['PICTURE'] ?>">
                                </a>
                            </div>
                            <div class="compare-prod-name">
                                <a href="<?= $item['DETAIL_PAGE_URL'] ?>">
                                    <?= $item['NAME'] ?>

                                    <div class="clear_both"></div>
                                </a>
                            </div>
                            <div class="bx-basket-item-list-item-remove mdi mdi-close"
                                 onclick="delCompareList(<?= $item['ID'] ?>);return false;"
                                 title="<?= GetMessage('CATALOG_DELETE') ?>"></div>
                        </li>
                    <? endforeach; ?>
                    <? if (count($sect) > 1):?>
                        <li class="btn-item">
                            <a class="link-compare em_button" title="<?= GetMessage("CATALOG_COMPARE") ?>"
                               href="<?=SITE_DIR?>catalog/compare/<? /*=$arParams['COMPARE_URL']*/
                               ?>?SECTION=<?= $key ?>"><?= GetMessage("CATALOG_COMPARE") ?></a>
                        </li>
                    <? else:?>
                        <li class="btn-item">
                            <a class="link-compare em_button disabled" title="<?= GetMessage("CATALOG_COMPARE") ?>"
                               href="#"><?= GetMessage("CATALOG_COMPARE") ?></a>
                        </li>
                    <? endif; ?>
                </ul>
            <? endforeach; ?>
        </div>
    <? endif; ?>
    <? $frame->end(); ?>
</div>