<div class="w1200">

<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
if (!empty($arResult)):?>
<?$j=1;
//print_r(CFile::GetPath(1221));


?>
    <div class="gt-breadcrumbs-holder">
        <ul class="gt-breadcrumbs">
            <li><a href="/">Главная</a></li>
            <li>Производители</li>
        </ul>
    </div>
   <div class="gt-section-title">
        <h2>Производители</h2>
        <div class="bg-text">Brands</div>
    </div>

    <div class="gt-brand-languages-list">
        <? foreach ($arResult['COUNTRYS'] as $brend):?>
            <a class="gt-brand-language gt-link-gray" href="?strana=<?=$brend['ID'];?>">
                <div class="gt-img"><img class="country_img"  src="<?print_r(CFile::GetPath($brend['UF_FILE']))?>"></div>
                <div class="gt-name<? if($_REQUEST['strana']==$brend['ID']){ echo " active";}?>" ><?=$brend['UF_NAME'];?></div>
            </a>
            <?$j++;?>
        <? endforeach; ?>
        <a class="gt-brand-language gt-link-gray" href="?strana=0">
            <div class="gt-img"><img src="/local/templates/main/img/images/flags/earth.png" /></div>
            <div class="gt-name">Все</div>
        </a>
    </div>

    <div class="gt-separator"></div>


    <div class="gt-page-catalog thin">
        <div class="gt-catalog-aside" id="gt-catalog-filters">

            <div class="gt-show-mobile gt-catalog-filter-mobile-title">
                <span id="gtMobileFilterPanelName">Панель фитров:</span>
            </div>


            <div class="gt-aside-block-2">
                <div class="gt-block-title">Ценовая группа</div>
                <div class="gt-checkbox gt-topline">
                    <input id="price_324" type="checkbox" />
                    <label for="price_324">Эконом</label>
                </div>

                <div class="gt-checkbox gt-topline">
                    <input id="price_325" type="checkbox" />
                    <label for="price_325">Средняя цена</label>
                </div>

                <div class="gt-checkbox gt-topline">
                    <input id="price_326" type="checkbox" />
                    <label for="price_326">Премиум</label>
                </div>
            </div>

            <div class="gt-aside-block-2" <? if($_REQUEST['strana'] !="0" && $_REQUEST['strana'] !="" && $_REQUEST['strana'] !=null && $_REQUEST['strana'] !=0 ){ echo " hidden";}?>>
                <div class="gt-block-title">Страна</div>
                <div class="gt-checkbox gt-topline gt-bold ">
                    <input id="country_all" type="checkbox" />
                    <label for="country_all">Все</label>
                </div>


                <? foreach ($arResult['COUNTRYS'] as $brend):?>
                    <div class="gt-checkbox gt-topline">
                        <input id="country<?=$brend['ID'];?>" type="checkbox" <? if($_REQUEST['strana']==$brend['ID']){ echo " checked='checked'";}?> />
                        <label for="country<?=$brend['ID'];?>"><?=$brend['UF_NAME'];?></label>
                    </div>
                <? endforeach; ?>



            </div>

            <div class="gt-catalog-mobile-filters gt-show-mobile">
                <a href="#" class="gt-button gt-btn-full" onclick="toggleCatalogFilters(event)">Применить</a>
                <a href="#" class="gt-button gt-btn-greentext gt-btn-full" onclick="toggleCatalogFilters(event)">Сбросить фильтры</a>
            </div>

        </div>

        <div class="gt-catalog-content">
            <div class="gt-brand-filter-panel gt-hide-mobile">
                <table class="gt-border-table">
                    <tbody>
                        <tr>
                            <td class="w-fixed">
                                <? 
                                    $isEn = false;
                                    $isRu = false;
                                    $isNum = false;
                                    if (!strripos($_SERVER['REQUEST_URI'], "bukva")) {
                                        $active = " active";
                                        $isEn = true;
                                    }
                                    else{
                                       if (in_array($_REQUEST['bukva'], $arResult['ALFAVIT'])){
                                           $isEn = true;
                                       }

                                       else if (in_array($_REQUEST['bukva'], $arResult['ALFAVIT_RUS'])){
                                            $isRu = true;
                                       }

                                       else if (in_array($_REQUEST['bukva'], $arResult['ALFAVIT_NUM'])){
                                            $isNum = true;
                                       }

                                    }
                                ?>
                                <a class="gt-link-gray<?= $active; ?>" href="<?= sgp($_SERVER['REQUEST_URI'], 'bukva', ''); ?>"><?=GetMessage("VSE");?></a>
                            </td>
                            <td class="letters <?if ($isEn == true){echo "expanded";}?>">
                                <div class="toggler"><a href="#" class="gt-link-gray">A-Z</a></div>
                                <div class="ltr-content">
                                    <? foreach ($arResult['ALFAVIT'] as $buk):?>
                                        <? if (strripos($_SERVER['REQUEST_URI'], "bukva")) {
                                            $url = sgp($_SERVER['REQUEST_URI'], 'bukva', $buk);
                                        } else {
                                            if (strripos($_SERVER['REQUEST_URI'], "?")) {
                                                $url = $_SERVER['REQUEST_URI'] . "&bukva=" . $buk;

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
                                            <a class="alfavit__item gt-link-gray <?= $active; ?>" href="<?= $url; ?>"><?= $buk; ?></a>
                                        <? endif; ?>
                                    <? endforeach; ?>
                                    <? if (empty($_REQUEST['bukva'])) {
                                        $active = "active";
                                    } else {
                                        unset($active);
                                    } ?>
                                </div>
                            </td>

                            <td class="letters <?if ($isRu == true){echo "expanded";}?>">
                                <div class="toggler"><a href="#" class="gt-link-gray">А-Я</a></div>
                                <div class="ltr-content">
                                    <? foreach ($arResult['ALFAVIT_RUS'] as $buk):?>
                                        <? if (strripos($_SERVER['REQUEST_URI'], "bukva")) {
                                            $url = sgp($_SERVER['REQUEST_URI'], 'bukva', $buk);
                                        } else {
                                            if (strripos($_SERVER['REQUEST_URI'], "?")) {
                                                $url = $_SERVER['REQUEST_URI'] . "&bukva=" . $buk;

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
                                            <a class="alfavit__item gt-link-gray <?= $active; ?>" href="<?= $url; ?>"><?= $buk; ?></a>
                                        <? endif; ?>
                                    <? endforeach; ?>
                                    <? if (empty($_REQUEST['bukva'])) {
                                        $active = "active";
                                    } else {
                                        unset($active);
                                    } ?>
                                </div>
                            </td>


                            <td class="letters <?if ($isNum == true){echo "expanded";}?>">
                                <div class="toggler"><a href="#" class="gt-link-gray">0-9</a></div>
                                <div class="ltr-content">
                                    <? foreach ($arResult['ALFAVIT_NUM'] as $buk):?>
                                        <? if (strripos($_SERVER['REQUEST_URI'], "bukva")) {
                                            $url = sgp($_SERVER['REQUEST_URI'], 'bukva', $buk);
                                        } else {
                                            if (strripos($_SERVER['REQUEST_URI'], "?")) {
                                                $url = $_SERVER['REQUEST_URI'] . "&bukva=" . $buk;

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
                                            <a class="alfavit__item gt-link-gray <?= $active; ?>" href="<?= $url; ?>"><?= $buk; ?></a>
                                        <? endif; ?>
                                    <? endforeach; ?>
                                    <? if (empty($_REQUEST['bukva'])) {
                                        $active = "active";
                                    } else {
                                        unset($active);
                                    } ?>
                                </div>
                            </td>

                            <td class="w-fixed">
                                <ul class="gt-inline-ul ">
                                    <li>
                                        <a href="# " class="gt-view-icon gt-view-1 "></a>
                                    </li>
                                    <li>
                                        <a href="# " class="gt-view-icon gt-view-2 "></a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div class="gt-show-mobile gt-mobile-filters" style="padding:0;">
                <div class="gt-flex-row" style="justify-content: space-between;">
                    <div>
                        <div class="gt-dropdown" onclick="toggleCatalogFilters(event, true, 3)">
                            <div class="name">Ценовая группа</div>
                            <span class="toggler"></span>
                        </div>
                    </div>
                    <div>
                        <div class="gt-dropdown" onclick="toggleCatalogFilters(event, true, 4)">
                            <div class="name">Фильтр по алфавиту</div>
                            <span class="toggler"></span>
                        </div>
                    </div>
                </div>

            </div>

           <div class="gt-brand-items-holder">
                <?$i=1;?>
                <?//print_r($arResult['BREND']);?>
                <?//print_r($arResult['COUNTRYS']);?>

                <? foreach ($arResult['BREND'] as $brend):?>
                    <a class="gt-brand-item" href="<?= $brend['SECTION_PAGE_URL']; ?>"
                       title="<?= $brend['NAME'] ?>">
                        <div class="gt-c-elem">
                            <div class="gt-img_box">
                                <? if (empty($brend['PICTURE'])) {
                                    $brend['PICTURE'] = $templateFolder . "/images/no_photo.png";
                                } else {
                                    $brend['PICTURE'] = CFile::GetPath($brend["PICTURE"]);
                                } ?>
                                <div class="gt-img" style="background-image: url(<?= $brend['PICTURE']; ?>);"></div>
                            </div>
                            <div class="gt-name">
                                <div class="gt-title"><?= $brend['NAME'] ?></div>
                                <div class="gt-country"><img src="<?print_r(CFile::GetPath($brend['UF_STRANA_NAME']['UF_FILE']))?>"><? echo$brend['UF_STRANA_NAME']['UF_NAME'];?></div>

                                <?//$arResult['COUNTRYS'];?>

                            </div>
                        </div>
                    </a>
                    <?$i++; ?>
                <? endforeach; ?>
           
           </div>
           <div id="realTemplatePager" class="page-navigation" data-pagination-num="<?=$navParams['NavNum']?>" style="display:none;">
                <? echo $arResult["NAV_STRING"]; ?>
           </div>

           <div id="fakePager"></div>

           <div style="display:none;">
                <a href="# " class="gt-button gt-btn-white gt-btn-full gt-btn-uppercase gt-border-gray ">Показать ещё</a>

                <div class="gt-pager ">
                    <ul class="gt-pager-ul">
                        <li>
                            <a href="# " class="active ">1</a>
                        </li>
                        <li>
                            <a href="# ">2</a>
                        </li>
                    </ul>
                </div>

            </div>

        </div>

    </div>


<? endif; ?>

</div>