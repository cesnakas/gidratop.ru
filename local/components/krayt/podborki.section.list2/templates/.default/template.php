<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}?>

<?if (!empty($arResult)):?>
    <div class="podborki_section_block">
        <div class="podborki_section_serch">
            <input type="text" name="podborki_serch" placeholder="<?=GetMessage("PODBORCI_SERCH_PLAS");?>">
        </div><div class="podborki_section_content_wrp">
                <?foreach ($arResult as $section):?>
                    <?if($section['NAME']="Санфаянс") {?>
                    <div class="podborki_section_content">
                        <a href='<?=$section['SECTION_PAGE_URL'];?><?=$section['UF_PODBORKI_FILTER'];?>' title="<?=GetMessage("PODBORCI_SERCH_IN_RAZDEL");?> <?=$section['NAME'];?>">
                            <div class="image" style="background-image: url('<?=$section['DETAIL_PICTURE_SRC']?>');"></div>
                        </a>
                        <div class="text">
                        <h2><a class="link_podborki big shine"  href='<?=$section['SECTION_PAGE_URL'];?><?=$section['UF_PODBORKI_FILTER'];?>' title="<?=GetMessage("PODBORCI_SERCH_IN_RAZDEL");?> <?=$section['NAME'];?>"><?=$section['NAME'];?></a></h2>
                        <?Podborci($section);?>
                            <a class="podborki_box_link" href='<?=$section['SECTION_PAGE_URL'];?><?=$section['UF_PODBORKI_FILTER'];?>'><?=GetMessage("PODBORCI_ALL_CAT");?></a>
                        </div>
                    </div>
            <?}?>
                <?endforeach;?>
        </div>
        </div>
        <div id="not_find_category">
            <?=GetMessage('PODBORCI_SERCH_NOT_CATEG')?>
        </div>
    </div>
<?endif;?>





