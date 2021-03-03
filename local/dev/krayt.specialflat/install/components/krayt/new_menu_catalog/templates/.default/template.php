<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? //var_dump($_SERVER['REQUEST_URI']);?>

<? if (!empty($arResult)): ?>
    <div class="top_menu_catalog" id="top_menu_catalog">
        <ul class="osn_box_menu">
            <? $i = 1; ?>
            <? foreach ($arResult as $section): ?>
                <li data-select="<?= $i; ?>"
                    class="osn_menu_li <? if (strrpos($_SERVER['REQUEST_URI'], $section['SECTION_PAGE_URL']) !== false) {
                        echo "select";
                    } ?>">
                    <? if ((!empty($section['CHILD'])) || (!empty($section['PODBORKI']))): ?>
                        <a class="osn_menu_li-link" href="<?= $section['SECTION_PAGE_URL'] ?>"><?= $section['NAME'] ?>
                            <i class="root-menu-open"></i></a>
                        <div class="submenu_box">
                            <div class="submenu_box-container">
                                <? if (!empty($section['CHILD'])): ?>
                                    <div class="sub_menu_catalog-box">
                                        <!--? //if (count($section['CHILD']) < 14){?-->
                                        <ul class="sub_menu_catalog">
                                            <? foreach ($section['CHILD'] as $sectionChild): ?>
                                                <li <? if (strrpos($_SERVER['REQUEST_URI'], $sectionChild['SECTION_PAGE_URL']) !== false) {
                                                    echo "class='select'";
                                                } ?>>
                                                    <? if (!empty($sectionChild['CHILD'])): ?>
                                                    <a class="sub_menu_catalog-link"
                                                           href="<?= $sectionChild['SECTION_PAGE_URL'] . $sectionChild['UF_PODBORKI_FILTER'] ?>"><?= $sectionChild['NAME'] ?></a>
                                                        <a class="open_top-menu"><i class="in-menu"></i></a>
                                                        <ul class="sub_menu_catalog_in">
                                                            <? foreach ($sectionChild['CHILD'] as $sectionChild3): ?>
                                                                <li <? if (strrpos($_SERVER['REQUEST_URI'], $sectionChild3['SECTION_PAGE_URL']) !== false) {
                                                                    echo "class='select'";
                                                                } ?>>
                                                                    <a href="<?= $sectionChild3['SECTION_PAGE_URL'] . $sectionChild3['UF_PODBORKI_FILTER'] ?>"><?= $sectionChild3['NAME'] ?></a>
                                                                </li>
                                                            <? endforeach; ?>
                                                        </ul>
                                                    <?else:?>
                                                        <a class="sub_menu_catalog-link"
                                                           href="<?= $sectionChild['SECTION_PAGE_URL'] . $sectionChild['UF_PODBORKI_FILTER'] ?>"><?= $sectionChild['NAME'] ?></a>
                                                    <? endif; ?>
                                                </li>
                                            <? endforeach; ?>
                                        </ul>
                                        <!--?//}elseif (count($section['CHILD']) > 12 && count($section['CHILD'])<27){
//                                        $i=1;?>
                                        <ul class="sub_menu_catalog">
                                            ? foreach ($section['CHILD'] as $sectionChild): ?>
                                                <li <!?// if (strrpos($_SERVER['REQUEST_URI'], $sectionChild['SECTION_PAGE_URL']) !== false) {
//                                                    echo "class='select'";
                                                } ?>
                                                    <a href="<!?= //$sectionChild['SECTION_PAGE_URL'] . $sectionChild['UF_PODBORKI_FILTER'] ?>"><!?= //$sectionChild['NAME'] ?></a>
                                                </li>
                                                <!?
//                                                if ($i >12){?>
                                                    </ul>
                                                    <ul class="sub_menu_catalog">
                                                <!?} else {
//                                                    $i++;
//                                                }?>
                                            <!--? endforeach; ?>
                                        </ul>
                                    <!?} elseif(count($section['CHILD']) > 27){
//                                        $i = 1;
//                                        $end = round(count($section['CHILD']) / 2);?>
                                        <ul class="sub_menu_catalog">
                                            <!? //foreach ($section['CHILD'] as $sectionChild): ?>
                                                <li <!? //if (strrpos($_SERVER['REQUEST_URI'], $sectionChild['SECTION_PAGE_URL']) !== false) {
//                                                    echo "class='select'";
//                                                } ?>
                                                    <a href="<!?= //$sectionChild['SECTION_PAGE_URL'] . $sectionChild['UF_PODBORKI_FILTER'] ?>"><?= $sectionChild['NAME'] ?></a>
                                                </li>
                                                <!?
//                                                if ($i =$end-1){?>
                                                    </ul>
                                                    <ul class="sub_menu_catalog">
                                                <!? //}
//                                                $i++;?>
                                            <!? //endforeach; ?>
                                        </ul>
                                    <!? //}?-->
                                    </div>
                                <? endif; ?>
                                <? if (!empty($section['PODBORKI'])): ?>
                                    <ul class="sub_podborki_catalog">
                                        <? foreach ($section['PODBORKI'] as $sectionChild): ?>
                                            <li <? if (strrpos($_SERVER['REQUEST_URI'], $sectionChild['SECTION_PAGE_URL']) !== false) {
                                                echo "class='select'";
                                            } ?> >
                                                <a href="<?= $sectionChild['SECTION_PAGE_URL'] . $sectionChild['UF_PODBORKI_FILTER'] ?>"><?= $sectionChild['NAME'] ?></a>
                                            </li>
                                        <? endforeach; ?>
                                    </ul>
                                <? endif; ?>

                                <div class="clearfix"></div>
                            </div>
                        </div>
                    <? else: ?>
                        <a class="osn_menu_li-link" href="<?= $section['SECTION_PAGE_URL'] ?>"><?= $section['NAME'] ?></a>

                    <? endif; ?>
                </li>
                <? $i++; ?>
            <? endforeach; ?>
        </ul>
    </div>
<? endif; ?>






