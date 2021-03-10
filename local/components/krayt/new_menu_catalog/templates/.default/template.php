<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? //var_dump($_SERVER['REQUEST_URI']);?>

<? if (!empty($arResult)): ?>
    <div id="gt-top-catalog" >
        <div class="gt-top-catalog-root">
            <ul>
                <? $i = 1; ?>
                
                <? foreach ($arResult as $section): ?>
                    <? $is_complex = false; 
                    if (!empty($section['CHILD'])){
                        foreach ($section['CHILD'] as $sectionChild){
                            if (!empty($sectionChild['CHILD'])){
                                $is_complex = true;
                            }
                        }
                    };
                ?> 
                
                    <li data-select="<?= $i; ?>"
                        class="<?if ($is_complex == true) echo "complex";?><? if (strrpos($_SERVER['REQUEST_URI'], $section['SECTION_PAGE_URL']) !== false) {
                            echo " select";
                        } ?>">

                        <a href="<?= $section['SECTION_PAGE_URL'] ?>"><?= $section['NAME'] ?></a>
                        <? if ((!empty($section['CHILD'])) || (!empty($section['PODBORKI']))): ?>
                            
                            <? if (($is_complex)): ?>
                                <div class="gt-top-catalog-menu-second">
                                    <? foreach ($section['CHILD'] as $sectionChild): ?>
                                        <ul>
                                            <li class="main">
                                                <a class="main" href="<?= $sectionChild['SECTION_PAGE_URL'] . $sectionChild['UF_PODBORKI_FILTER'] ?>"><?= $sectionChild['NAME'] ?></a>
                                            </li>
                                            <? foreach ($sectionChild['CHILD'] as $sectionChild3): ?>
                                                <li <? if (strrpos($_SERVER['REQUEST_URI'], $sectionChild3['SECTION_PAGE_URL']) !== false) {
                                                    echo "class='select'";
                                                } ?>>
                                                    <a href="<?= $sectionChild3['SECTION_PAGE_URL'] . $sectionChild3['UF_PODBORKI_FILTER'] ?>"><?= $sectionChild3['NAME'] ?></a>
                                                </li>
                                            <? endforeach; ?>
                                       </ul>
                                    <? endforeach; ?>
                                </div>
                            <? endif; ?>
                            <? if ((!$is_complex)): ?>
                                <ul class="gt-top-catalog-second">
                                    <? foreach ($section['CHILD'] as $sectionChild): ?>
                                        <li <? if (strrpos($_SERVER['REQUEST_URI'], $sectionChild['SECTION_PAGE_URL']) !== false) {
                                            echo "class='select'";
                                        } ?> >
                                            <a href="<?= $sectionChild['SECTION_PAGE_URL'] . $sectionChild['UF_PODBORKI_FILTER'] ?>"><?= $sectionChild['NAME'] ?></a>
                                        </li>
                                    <? endforeach; ?>
                                    
                                    <? foreach ($section['PODBORKI'] as $sectionChild): ?>
                                        <li <? if (strrpos($_SERVER['REQUEST_URI'], $sectionChild['SECTION_PAGE_URL']) !== false) {
                                            echo "class='select'";
                                        } ?> >
                                            <a href="<?= $sectionChild['SECTION_PAGE_URL'] . $sectionChild['UF_PODBORKI_FILTER'] ?>"><?= $sectionChild['NAME'] ?></a>
                                        </li>
                                    <? endforeach; ?>
                                </ul>

                            <? endif; ?>
     
                        <? endif; ?>
                    </li>
                    <? $i++; ?>
                <? endforeach; ?>
            </ul>
        </div>
    </div>
<? endif; ?>






