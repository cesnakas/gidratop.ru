<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}

if (!empty($arResult)):?>
    <div class="left_podborki_block brand_bl">
        <div class="title_box">
            <?=GetMessage("TITLE");?>
        </div>
        <ul class="brand_block_left">
            <?foreach ($arResult as $arItem):?>
                    <li>
                        <? $url = explode("?",$_SERVER['REQUEST_URI']);
                        if (strripos($_SERVER['REQUEST_URI'],GetMessage("SBROS")) != false || strripos($_SERVER['REQUEST_URI'],'arFilterCatalog') === false){
                            $link = $url[0].'?arFilterCatalog_310_'.abs(crc32($arItem['ID'])). '=Y&arFilterCatalog_309_357040185=Y&arFilterCatalog_P1_MIN=&arFilterCatalog_P1_MAX=&set_filter='.GetMessage("SOME_MESSAGE_CODE");
                        }elseif(strripos($_SERVER['REQUEST_URI'],'arFilterCatalog_310_') !== false){
                            $link = preg_replace('#arFilterCatalog_310_([0-9]+)=Y#','arFilterCatalog_310_'.abs(crc32($arItem['ID'])). '=Y',$_SERVER['REQUEST_URI']);
                        }else{
                            $link=$_SERVER['REQUEST_URI']."&".'arFilterCatalog_310_'.abs(crc32($arItem['ID'])).'=Y';
                        }
                        ?>
                        <a href="<?=$link;?>">
                            <?=$arItem['NAME'];?></a>
                    </li>
            <?endforeach;?>
        </ul>
    </div>
<?endif;?>