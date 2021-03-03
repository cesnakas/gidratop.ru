<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}

CJSCore::Init();

$cur = $APPLICATION->GetCurDir();

?>

<?if($arResult["FORM_TYPE"] == "login"):?>
    <a href="<?=SITE_DIR?>auth/?login=yes" <?if(($cur == '/auth/') && ($_GET['login'] == 'yes')):?>class="selected"<?endif;?>><?=GetMessage("AUTH_ENTER")?></a>
    <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
        <span>/ </span><a <?if(($cur == '/auth/') && ($_GET['register'] == 'yes')):?>class="selected"<?endif;?> href="<?=SITE_DIR?>auth/?register=yes" ><?=GetMessage("AUTH_REGISTER")?></a>
    <?endif;?>
<?
else:
?>
    <a href="<?=SITE_DIR?>personal/" title="<?=GetMessage("AUTH_PROFILE")?>"><?=$arResult["USER_NAME"]?></a>
    <span>/ </span>
    <a class="logout" href="<?=$APPLICATION->GetCurPageParam("logout=yes", Array("logout"))?>"><?=GetMessage("AUTH_LOGOUT_BUTTON")?></a>
<?endif?>