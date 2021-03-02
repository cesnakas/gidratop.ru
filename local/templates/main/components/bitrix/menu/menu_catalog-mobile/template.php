<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}?>

<?if (!empty($arResult)):?>

<ul class="vertical-multilevel-menu" id="catalog-menu_mobile">

    <?
    $previousLevel = 0;
foreach($arResult as $arItem):?>

    <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
        <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
    <?endif?>

    <?if ($arItem["IS_PARENT"]):?>

    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
    <li><a href="<?=$arItem["LINK"]?>" class="open_list-menu <?if ($arItem["SELECTED"]):?>root-item-link-selected<?else:?>root-item-link<?endif?>"><?=$arItem["TEXT"]?></a><i class="root-menu-open"></i>
    <ul class="root-item-menu">
    <?else:?>
    <li><a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-link-selected<?endif?>"><?=$arItem["TEXT"]?></a>
    <ul class="root-item-menu-in">
    <?endif?>

    <?else:?>

        <?if ($arItem["PERMISSION"] > "D"):?>

            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                <li class="empty-root-item"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-link-selected<?else:?>root-item-link<?endif?>"><?=$arItem["TEXT"]?></a></li>
            <?else:?>
                <li class="empty-root-item"><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-link-selected"<?endif?>><?=$arItem["TEXT"]?></a></li>
            <?endif?>

        <?else:?>

            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                <li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-link-selected<?else:?>root-item-link<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
            <?else:?>
                <li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
            <?endif?>

        <?endif?>

    <?endif?>

    <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

    <?if ($previousLevel > 1)://close last item tags?>
        <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
    <?endif?>

</ul>
<?endif?>


