<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}

if (!empty($arResult)):?>
    <? $i = false;
    if($arResult['TYPE'] == "tovar"){
        if($arResult['PODBORKI'])
        foreach ($arResult['PODBORKI'] as $arItems):
            if($arItems['UF_PODBORKI_LEFT'] == true):
              $i = true;
            endif;
        endforeach;
    }elseif ($arResult['TYPE'] == "podborka"){
        if($arResult['ELEMENT'])
        foreach ($arResult['ELEMENT'] as $arItems):
            if($arItems['UF_PODBORKI_LEFT'][0]['ELEMENT'] == true):
                $i = true;
            endif;
        endforeach;
    }?>
    <?if ($i):?>
        <div class="bottom_podborki row">
             <h3><?=GetMessage("TITLE_PODBORKI_BOTTOM");?></h3>
          <div class="podboki_box_podboki">
              <?if($arResult['TYPE'] == "tovar"){?>
                      <?foreach ($arResult['PODBORKI_NEW'] as $key => $section ):?>
                          <ul
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
                          <?foreach ($section as $arItems):?>
                              <?if($arItems['UF_PODBORKI_LEFT'] == true):?>
                                      <li>
                                          <a href="<?=$arItems['SECTION_PAGE_URL'];?>"><?=$arItems['NAME'];?></a>
                                      </li>
                              <?endif;?>
                          <?endforeach;?>
                          </ul>
                  <?endforeach;?>
              <?}elseif ($arResult['TYPE'] == "podborka"){?>
                  <?foreach ($arResult['PODBORKI_NEW_TWO'] as $key => $section ):?>
                      <ul
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
                          <?foreach ($section as $arItems):?>
                              <?if($arItems['UF_PODBORKI_LEFT'] == true):?>
                                  <li>
                                      <a href="<?=$arItems['SECTION_PAGE_URL'];?>"><?=$arItems['NAME'];?></a>
                                  </li>
                              <?endif;?>
                          <?endforeach;?>
                      </ul>
                  <?endforeach;?>
               <?}?>
          </div>
        </div>
    <?endif;?>
<?endif;?>

