<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

if(!CModule::IncludeModule('advertising'))
    return;

__IncludeLang(GetLangFileName(dirname(__FILE__)."/lang/", '/'.basename(__FILE__)));

//read file json list hiload
$BannerFile = file_get_contents($_SERVER['DOCUMENT_ROOT'].WIZARD_SERVICE_RELATIVE_PATH.'/banner.json');
if(!$BannerFile)
{
    echo WIZARD_SERVICE_RELATIVE_PATH;
    echo "No file json Banner";
    die();
}


try{

    $arBannerData = Bitrix\Main\Web\Json::decode($BannerFile);
    if(!$arBannerData)
    {
        echo "No decode json file";
        die();
    }


}catch (Exception $e)
{
    echo $e->getMessage();
    die();
}


//Matrix
$arWeekday = Array(
    "SUNDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
    "MONDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
    "TUESDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
    "WEDNESDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
    "THURSDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
    "FRIDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23),
    "SATURDAY" => Array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23)
);

$contractId  = false;

$dataContarct = current($arBannerData['CONTRACT']);
$dataType = $arBannerData['TYPE'];
$arBanners = $arBannerData['BANNER'];

$rsADV = CAdvContract::GetList(
    $v1="s_sort", $v2="desc",
    array(
        "NAME" => $dataContarct['NAME'],
        'DESCRIPTION' => $dataContarct['NAME']." [".WIZARD_SITE_ID."]"), $is_filtered);
if ($arADV = $rsADV->Fetch())
{
    $contractId  = $arADV["ID"];

    CAdvContract::Delete($arADV["ID"]);
    $contractId  = false;

}
if ($contractId == false)
{
    $arFields = array(
        'ACTIVE' => 'Y',
        'NAME' => $dataContarct['NAME'],
        'SORT' => 1000,
        'DESCRIPTION' => $dataContarct['NAME']." [".WIZARD_SITE_ID."]",
        'EMAIL_COUNT' => 1,
        'arrTYPE' => array('ALL'),
        'arrWEEKDAY' => $arWeekday,
        'arrSITE' => Array(WIZARD_SITE_ID),
    );
    $contractId = CAdvContract::Set($arFields, 0, 'N');


    foreach ($dataType as $arFields)
    {
        $dbResult = CAdvType::GetByID($arFields["SID"], $CHECK_RIGHTS="N");
        if ($dbResult && $dbResult->Fetch())
            continue;

        CAdvType::Set($arFields, "", $CHECK_RIGHTS="N");
    }


    global  $strError;
    foreach ($arBanners as $arFields)
    {

        $arFields["arrSITE"] = Array(WIZARD_SITE_ID);
        $arFields["arrWEEKDAY"] =  $arWeekday;
        $arFields["CONTRACT_ID"] =  $contractId;

        $arFields["COMMENTS"] = "banner for " . WIZARD_SITE_ID;



        if(isset($arFields['TEMPLATE']['PROPS']) && is_array($arFields['TEMPLATE']['PROPS']))
        {
            foreach ($arFields['TEMPLATE']['PROPS'] as &$p)
            {
                if(isset($p['LINK_URL']) && (!empty($p['LINK_URL'])))
                {
                    if(isset($p['LINK_URL'][0]))
                    {
                        $p['LINK_URL'][0] = '#';
                        $p['LINK_URL'] = str_replace("#",WIZARD_SITE_DIR,$p['LINK_URL']);
                    }
                }
                if(isset($p['BUTTON_LINK_URL']) && (!empty($p['BUTTON_LINK_URL'])))
                {
                    if(isset($p['BUTTON_LINK_URL'][0]))
                    {
                        $p['BUTTON_LINK_URL'][0] = '#';
                        $p['BUTTON_LINK_URL'] = str_replace("#",WIZARD_SITE_DIR,$p['BUTTON_LINK_URL']);
                    }
                }
            }
        }

        $arFields['TEMPLATE'] = serialize($arFields['TEMPLATE']);

        if($arFields['TEMPLATE_FILES'] && is_array($arFields['TEMPLATE_FILES']))
        {
            foreach ($arFields['TEMPLATE_FILES'] as &$file)
            {
                $file['IMG']  = CFile::MakeFileArray(WIZARD_SERVICE_RELATIVE_PATH.$file["IMG"]);
                $file['IMG']['MODULE_ID'] = 'advertising';
            }
        }

        $dbResult = CAdvBanner::GetList($by, $order, Array("COMMENTS" => $arFields["COMMENTS"], "COMMENTS_EXACT_MATCH" => "Y"), $is_filtered, "N");
        if ($dbResult && $dbResult->Fetch())
            continue;

        CAdvBanner::Set($arFields, "", $CHECK_RIGHTS="N");

        if (strlen($strError) > 0)
        {
            print_r($strError);
        }
    }
}
?>