<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */

//one css for all system.auth.* forms
$APPLICATION->SetAdditionalCSS("/bitrix/css/main/system.auth/flat/style.css");
?>

<div class="mobile_wrp">
<div class="auth_page">

    <h1><?=GetMessage("FAGOT_TITLE")?></h1>

<?
if(!empty($arParams["~AUTH_RESULT"])):
	$text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);
?>
	<div class="alert <?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "alert-success":"alert-danger")?>"><?=nl2br(htmlspecialcharsbx($text))?></div>
<?endif?>

	<!-- <h3 class="bx-title"><?=GetMessage("AUTH_GET_CHECK_STRING")?></h3> !-->

	<p class="change_text bx-authform-content-container"><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></p>

	<form class="bx-auth-table" name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="SEND_PWD">

		<div class="bx-authform-formgroup-container">
			<div class="bx-auth-label change"><?echo GetMessage("AUTH_LOGIN_EMAIL")?></div>
			<div class="bx-auth-input change">
				<input type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" />
				<input type="hidden" name="USER_EMAIL" />
			</div>
		</div>

		<div class="authorize-submit-cell bx-authform-formgroup-container submit_btn">
            <label class="btn">
                <span><?echo GetMessage("AUTH_SEND")?></span>
                <input type="submit" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />
            </label>
            <div class="forgot_path bx-authform-link-container">
                <a href="<?=$arResult["AUTH_AUTH_URL"]?>"><?=GetMessage("AUTH_AUTH")?></a>
            </div>
		</div>



	</form>

</div>
</div>

<script type="text/javascript">
document.bform.onsubmit = function(){document.bform.USER_EMAIL.value = document.bform.USER_LOGIN.value;};
document.bform.USER_LOGIN.focus();

</script>
