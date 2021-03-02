<div class="mini_banner_wrp">
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}?>

<?if (count($arResult['BANNERS']) > 0):?>

<?$frame = $this->createFrame()->begin("");?>

<?=$arResult["BANNERS"][0]?>

<?$frame->end();?>

<?endif;?>
</div>
