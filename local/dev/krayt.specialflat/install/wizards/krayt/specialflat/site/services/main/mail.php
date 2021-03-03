<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
global $USER;
$user_email = "";
$user_email = $USER->GetEmail();

if(!empty($user_email))
{
    $user_email = ",".$user_email;
}

$dbSite = CSite::GetByID(WIZARD_SITE_ID);
if($arSite = $dbSite -> Fetch())
    $lid = $arSite["LANGUAGE_ID"];
if(strlen($lid) <= 0)
    $lid = "ru";

$dbEvent = CEventMessage::GetList($b="ID", $order="ASC", Array("EVENT_NAME" => "EMARKET_FEEDBACK_PROPD", "SITE_ID" => WIZARD_SITE_ID));
if(!($dbEvent->Fetch()))
{
    WizardServices::IncludeServiceLang("index.php", $lid);

    $dbEvent = CEventType::GetList(Array("TYPE_ID" => "EMARKET_FEEDBACK_PROPD"));
    if(!($dbEvent->Fetch()))
    {
        $et = new CEventType;
        $et->Add(array(
            "LID" => $lid,
            "EVENT_NAME" => "EMARKET_FEEDBACK_PROPD",
            "NAME" => GetMessage("EMARKET_FEEDBACK_TILTE"),
            "DESCRIPTION" => GetMessage("EMARKET_FEEDBACK_DESC"),
        ));

    }

    $emess = new CEventMessage;
    $emess->Add(array(
        "ACTIVE" => "Y",
        "EVENT_NAME" => "EMARKET_FEEDBACK_PROPD",
        "LID" => WIZARD_SITE_ID,
        "EMAIL_FROM" => "#DEFAULT_EMAIL_FROM#",
        "EMAIL_TO" => "#DEFAULT_EMAIL_FROM#".$user_email,
        "SUBJECT" => GetMessage("EMARKET_FEEDBACK_SUBJECT"),
        "MESSAGE" => GetMessage("EMARKET_FEEDBACK_MESSAGE"),
        "BODY_TYPE" => "html",
    ));
}
?>