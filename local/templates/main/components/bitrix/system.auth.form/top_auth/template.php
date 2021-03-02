<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        

if(
    \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED ||
    \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{return false;}

CJSCore::Init();

$cur = $APPLICATION->GetCurDir();
?>

<? if($arResult["FORM_TYPE"] == "login"): ?>

    <a
        href="<?=SITE_DIR?>auth/?login=yes"
        class="gt-ico gt-ico-user <?if(($cur == '/auth/') && ($_GET['login'] == 'yes')):?>selected<?endif;?>"
        style="margin-right: 0;"
    >
        <span class="gt-hide-tablet"><?=GetMessage("AUTH_ENTER")?></span>
    </a>

    <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
    <span style="color: #4798DE; font-size: 13px;"> / </span>
    <a
        class="gt-ico <?if(($cur == '/auth/') && ($_GET['register'] == 'yes')):?>selected<?endif;?>"
        href="<?=SITE_DIR?>auth/?register=yes"
        style="margin-left: 0;"
    >
        <span class="gt-hide-tablet"><?=GetMessage("AUTH_REGISTER")?></span>
    </a>
    <?endif;?>

<? else: ?>

    <a
        class="gt-ico gt-ico-user"
        href="<?=SITE_DIR?>personal/"
        title="<?=GetMessage("AUTH_PROFILE")?>"
        style="margin-right: 0;"
    >
            <?=$arResult["USER_NAME"]?>
    </a>
    <span style="color: #4798DE; font-size: 13px;"> / </span>
    <a
        class="gt-ico logout"
        href="<?=$APPLICATION->GetCurPageParam("logout=yes", Array("logout"))?>"
        style="margin-left: 0;"
    >
        <?=GetMessage("AUTH_LOGOUT_BUTTON")?>
    </a>

<? endif; ?>