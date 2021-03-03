<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
?>
<div class="mobile_wrp">
<div class="auth_page regestration">
    <h1><?echo GetMessage("AUTH_REGISTER")?></h1>
<?
ShowMessage($arParams["~AUTH_RESULT"]);
?>
<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y" && is_array($arParams["AUTH_RESULT"]) &&  $arParams["AUTH_RESULT"]["TYPE"] === "OK"):?>
<p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
<?else:?>

<?if($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
	<p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
<?endif?>
<noindex>
<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform">
<?
if (strlen($arResult["BACKURL"]) > 0)
{
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
}
?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="REGISTRATION" />

<table class="bx-auth-table data-table bx-registration-table">
	<tbody>
		<tr>
			<td class="bx-auth-label"><?=GetMessage("AUTH_NAME")?></td>
			<td><input type="text" name="USER_NAME" maxlength="50" value="<?=$arResult["USER_NAME"]?>" class="bx-auth-input" /></td>
		</tr>
		<tr>
			<td class="bx-auth-label"><?=GetMessage("AUTH_LAST_NAME")?></td>
			<td><input type="text" name="USER_LAST_NAME" maxlength="50" value="<?=$arResult["USER_LAST_NAME"]?>" class="bx-auth-input" /></td>
		</tr>
        <tr>
            <td class="bx-auth-label"><?=GetMessage("AUTH_EMAIL")?><?if($arResult["EMAIL_REQUIRED"]):?><span class="starrequired">*</span><?endif?></td>
            <td><input type="text" name="USER_EMAIL" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" class="bx-auth-input" /></td>
        </tr>
		<tr>
			<td class="bx-auth-label"><?=GetMessage("AUTH_LOGIN_MIN")?><span class="starrequired">*</span></td>
			<td><input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" class="bx-auth-input" /></td>
		</tr>
		<tr>
			<td class="bx-auth-label"><?=GetMessage("AUTH_PASSWORD_REQ")?><span class="starrequired">*</span></td>
			<td><input type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" />
<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
<script type="text/javascript">
document.getElementById('bx_auth_secure').style.display = 'inline-block';
</script>
<?endif?>
			</td>
		</tr>
		<tr>
			<td class="bx-auth-label"><?=GetMessage("AUTH_CONFIRM")?><span class="starrequired">*</span></td>
			<td><input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" /></td>
		</tr>

<?// ********************* User properties ***************************************************?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<tr><td colspan="2"><?=strlen(trim($arParams["USER_PROPERTY_NAME"])) > 0 ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></td></tr>
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
	<tr><td><?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;
		?><?=$arUserField["EDIT_FORM_LABEL"]?>:</td><td>
			<?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit",
				$arUserField["USER_TYPE"]["USER_TYPE_ID"],
				array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "bform"), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
	<?endforeach;?>
<?endif;?>
<?// ******************** /User properties ***************************************************

	/* CAPTCHA */
	if ($arResult["USE_CAPTCHA"] == "Y")
	{
		?>
		<tr>
			<td class="captcha" colspan="2"><b><?=GetMessage("CAPTCHA_REGF_TITLE")?></b></td>
		</tr>
		<tr>
			<td class="bx-auth-label cap">
                <?=GetMessage("CAPTCHA_REGF_PROMT")?><span class="starrequired">*</span>
            </td>
			<td class="captcha_img">
				<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                <input class="bx-auth-input" type="text" name="captcha_word" maxlength="50" value="" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
			</td>
		</tr>
		<?
	}
	/* CAPTCHA */
	?>
        <tr>
            <td></td>
            <td>
                <?$APPLICATION->IncludeComponent("bitrix:main.userconsent.request", "",
                    array(
                        "ID" => COption::getOptionString("main", "new_user_agreement", ""),
                        "IS_CHECKED" => "Y",
                        "AUTO_SAVE" => "N",
                        "IS_LOADED" => "Y",
                        "ORIGINATOR_ID" => $arResult["AGREEMENT_ORIGINATOR_ID"],
                        "ORIGIN_ID" => $arResult["AGREEMENT_ORIGIN_ID"],
                        "INPUT_NAME" => $arResult["AGREEMENT_INPUT_NAME"],
                        "REPLACE" => array(
                            "button_caption" => GetMessage("AUTH_REGISTER"),
                            "fields" => array(
                                rtrim(GetMessage("AUTH_NAME"), ":"),
                                rtrim(GetMessage("AUTH_LAST_NAME"), ":"),
                                rtrim(GetMessage("AUTH_LOGIN_MIN"), ":"),
                                rtrim(GetMessage("AUTH_PASSWORD_REQ"), ":"),
                                rtrim(GetMessage("AUTH_EMAIL"), ":"),
                            )
                        ),
                    )
                );?>
            </td>
        </tr>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2" class="authorize-submit-cell registration_btn">
                <label class="btn_anim">
                    <span class="btn"><?echo GetMessage("AUTH_REGISTER")?></span>
                    <input type="submit" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>" />
                </label>
                <p class="forgot_path">
                    <a href="<?=$arResult["AUTH_AUTH_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_AUTH")?></a>
                </p>
            </td>
		</tr>
	</tfoot>
</table>

<p class="addition_text">
    <span class="starrequired">* </span><?=GetMessage("AUTH_REQ")?></br>
    <?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?>
</p>



</form>
</noindex>
<script type="text/javascript">
document.bform.USER_NAME.focus();
</script>

<?endif?>
</div>
</div>
