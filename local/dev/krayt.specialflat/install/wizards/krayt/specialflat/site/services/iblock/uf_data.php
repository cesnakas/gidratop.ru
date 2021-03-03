<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

use Bitrix\Highloadblock as HL;
global $USER_FIELD_MANAGER;

//read file json list hiload
$hlFile = file_get_contents($_SERVER['DOCUMENT_ROOT'].WIZARD_SERVICE_RELATIVE_PATH.'/uf.json');
if(!$hlFile)
{
    echo WIZARD_SERVICE_RELATIVE_PATH;
    echo "No file json Uf Data";
    die();
}
$jsonHl = Bitrix\Main\Web\Json::decode($hlFile);
if(!$jsonHl)
{
    echo "No decode json file";
    die();
}
//$_SESSION["WIZARD_PODBORKI_IBLOCK_ID"]
//$_SESSION["WIZARD_BRAND_IBLOCK_ID"]
//$_SESSION["WIZARD_CATALOG_IBLOCK_ID"]


foreach($jsonHl as $key=>$uf)
{
    $rsData = CUserTypeEntity::GetList( array(), array(
        "FIELD_NAME" => $uf['FIELD_NAME']) );
    while($arRes = $rsData->Fetch())
    {
        $oUserTypeEntity    = new CUserTypeEntity();
        $oUserTypeEntity->Update( $arRes['ID'], array(
            'EDIT_FORM_LABEL' => array(
                'ru' => $uf['EDIT_FORM_LABEL']
            ),
            'LIST_COLUMN_LABEL' =>  array(
                'ru' => $uf['EDIT_FORM_LABEL']
            ),
            'LIST_FILTER_LABEL' =>  array(
                'ru' => $uf['EDIT_FORM_LABEL']
            ),
        ) );
    }
}
