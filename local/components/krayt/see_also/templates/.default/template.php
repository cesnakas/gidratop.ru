<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
if (!empty($arResult)):?>
    <div class="left_podborki_block see_also">
        <div class="title_box">
            <?=GetMessage("TITLE_S");?>
        </div>
        <ul class="brand_block_left">
            <?
			if($arResult)
			foreach ($arResult as $arItem):?>
                    <li>
                        <a href="<?=$arItem['SECTION_PAGE_URL'];?>"><?=$arItem['NAME'];?></a>
                    </li>
            <?endforeach;?>
        </ul>
    </div>
<?endif;?>
