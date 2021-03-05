<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}

if (!empty($arResult)):?>
    <? $i = false;
    if($arResult['TYPE'] == "tovar" && $arResult['PODBORKI']){
        foreach ($arResult['PODBORKI'] as $arItems):
            if($arItems['UF_PODBORKI_LEFT'] == true):
              $i = true;
            endif;
        endforeach;
    }elseif ($arResult['TYPE'] == "podborka" && $arResult['ELEMENT']){
        foreach ($arResult['ELEMENT'] as $arItems):
            if($arItems['UF_PODBORKI_LEFT']['ELEMENT'] == true):
                $i = true;
            endif;
        endforeach;
    }?>
    <?if ($i):?>
        <div class="gt-aside-block expanded gt-hide-mobile">
            <div class="gt-aside-block-title">
                <a href="#" class="gt-aside-toggler" onclick="clickCatalogExpand(event, this)">
                    <?=GetMessage("TITLE_LEFT_PODBORKI");?>
                    <!--<span class="gt-cnt">(10)</span>-->
                </a>
            </div>
          <?if($arResult['TYPE'] == "tovar" && $arResult['PODBORKI_NEW']){?>
              <div class="gt-aside-block-content">
              <?foreach ($arResult['PODBORKI_NEW'] as $key => $section ):?>
                  <ul class="gt-aside-menu gt-link-gray"
                      <?switch ($key) {
                          case 7:
                              echo "class='blue'";
                              break;
                          case 8:
                              echo "class='green'";
                              break;
                          case 9:
                              echo "class='red'";
                              break;
                      }?>
                  >
                  <?if($section):?>
                      <?foreach ($section as $arItems):?>
                          <?if($arItems['UF_PODBORKI_LEFT'] == true):?>
                                  <li>
                                      <a href="<?=$arItems['SECTION_PAGE_URL'];?>"><?=$arItems['NAME'];?></a>
                                  </li>
                          <?endif;?>
                      <?endforeach;?>
                  <?endif;?>
                  </ul>
              <?endforeach;?>
              </div>
          <?}elseif ($arResult['TYPE'] == "podborka" && $arResult['PODBORKI_NEW_TWO']){?>
              <div class="gt-aside-block-content">
              <?foreach ($arResult['PODBORKI_NEW_TWO'] as $key => $section ):?>
                  <ul class="gt-aside-menu gt-link-gray"
                      <?switch ($key) {
                          case 7:
                              echo "class='blue'";
                              break;
                          case 8:
                              echo "class='green'";
                              break;
                          case 9:
                              echo "class='red'";
                              break;
                      }?>
                  >
					<?if($section):?>
                      <?foreach ($section as $arItems):?>
                          <?if($arItems['UF_PODBORKI_LEFT'] == true):?>
                              <li>
                                  <a href="<?=$arItems['SECTION_PAGE_URL'];?>"><?=$arItems['NAME'];?></a>
                              </li>
                          <?endif;?>
                      <?endforeach;?>
					<?endif;?>  
                  </ul>
              <?endforeach;?>
              </div>
           <?}?>
        </div>
    <?endif;?>
<?endif;?>


