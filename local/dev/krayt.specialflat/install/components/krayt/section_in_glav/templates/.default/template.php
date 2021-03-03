<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}

if(!empty($arResult)):?>
    <section class="section_in_glav catalog">
        <div class="category-block">
            <div class="category-item first_block">
                <div class="category_title"><?=GetMessage("TITLE_SECTION");?></div>
                <div class="category_text"> <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "standard.php",
                            "PATH" => SITE_DIR."include/main_categories.php"
                        )
                    );?></div>
                <a class="category_btn" href="<?=$arParams['PAGE_SECTION']?>" title="<?=GetMessage("PEREITI_NA");?> <?=GetMessage("VSE_CAT_NA_GLAV");?>">
                    <span><?=GetMessage("VSE_CAT_NA_GLAV");?></span>
                </a>
            </div>
            <?foreach ($arResult as $arItem):?>
                <a href="<?=$arItem['SECTION_PAGE_URL']?>" class="category-item" title="<?=GetMessage("PEREITI_CAT");?> <?=$arItem['NAME']?>">
                    <?if (empty($arItem['PICTURE'])){
                        $arItem['PICTURE'] = $templateFolder.'/images/no_photo.png';
                    }?>
                    <div class="category-item-img">
                        <div class="img-box">

                            <?if($arParams['LOAD_IMG_JS'] == 'Y'):?>
                                <div data-src="<?=$arItem['PICTURE'];?>" class="img img-load" style="background-image: url('<?=$templateFolder?>/images/fon.svg');"></div>
                               <?else:?>
                                <div data-src="<?=$arItem['PICTURE'];?>" class="img" style="background-image: url(<?=$arItem['PICTURE'];?>);"></div>
                            <?endif;?>

                        </div>
                    </div>
                    <div class="title"><div><?=$arItem['NAME']?></div></div>
                </a>
            <?endforeach;?> 
        </div>
    </section>
<?endif;?>
