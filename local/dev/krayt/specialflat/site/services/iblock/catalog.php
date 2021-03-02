<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

if(!CModule::IncludeModule("iblock"))
    return;
$iblockXMLFile = $_SERVER["DOCUMENT_ROOT"].WIZARD_SERVICE_RELATIVE_PATH."/xml/".LANGUAGE_ID."/special_flat_catalog.xml";
$iblockXMLFilePrices = $_SERVER["DOCUMENT_ROOT"].WIZARD_SERVICE_RELATIVE_PATH."/xml/".LANGUAGE_ID."/special_flat_catalog_prices.xml";

$iblockCode = "catalog_st_".WIZARD_SITE_ID;
$iblockType = "catalog";

$rsIBlock = CIBlock::GetList(array(), array("XML_ID" => $iblockCode, "TYPE" => $iblockType));
$iblockID = false;
if ($arIBlock = $rsIBlock->Fetch())
{
    $iblockID = $arIBlock["ID"];
    if (WIZARD_INSTALL_DEMO_DATA)
    {
        CIBlock::Delete($arIBlock["ID"]);
        $iblockID = false;
    }
}

if($iblockID == false)
{
    $permissions = Array(
        "1" => "X",
        "2" => "R"
    );
    $dbGroup = CGroup::GetList($by = "", $order = "", Array("STRING_ID" => "content_editor"));
    if($arGroup = $dbGroup -> Fetch())
    {
        $permissions[$arGroup["ID"]] = 'W';
    };
    //die($iblockXMLFile);
    $iblockID = WizardServices::ImportIBlockFromXML(
        $iblockXMLFile,
        $iblockCode,
        $iblockType,
        WIZARD_SITE_ID,
        $permissions
    );
	$IBLOCK_CATALOG_ID1 = WizardServices::ImportIBlockFromXML(
    	$iblockXMLFilePrices,
    	$iblockCode,
    	$iblockType."_prices",
    	WIZARD_SITE_ID,
    	$permissions
    );
    if ($iblockID < 1)
        return;

    //IBlock fields
    $iblock = new CIBlock;
    $arFields = Array(
        "ACTIVE" => "Y",
        "FIELDS" => array ( 'IBLOCK_SECTION' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'ACTIVE' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => 'Y', ), 'ACTIVE_FROM' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '=today', ), 'ACTIVE_TO' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'SORT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'NAME' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => '', ), 'PREVIEW_PICTURE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => array ( 'FROM_DETAIL' => 'N', 'SCALE' => 'N', 'WIDTH' => '', 'HEIGHT' => '', 'IGNORE_ERRORS' => 'N', 'METHOD' => 'resample', 'COMPRESSION' => 95, 'DELETE_WITH_DETAIL' => 'N', 'UPDATE_WITH_DETAIL' => 'N', ), ), 'PREVIEW_TEXT_TYPE' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => 'text', ), 'PREVIEW_TEXT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'DETAIL_PICTURE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => array ( 'SCALE' => 'N', 'WIDTH' => '', 'HEIGHT' => '', 'IGNORE_ERRORS' => 'N', 'METHOD' => 'resample', 'COMPRESSION' => 95, ), ), 'DETAIL_TEXT_TYPE' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => 'text', ), 'DETAIL_TEXT' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'XML_ID' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'CODE' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => array ( 'UNIQUE' => 'Y', 'TRANSLITERATION' => 'Y', 'TRANS_LEN' => 100, 'TRANS_CASE' => 'L', 'TRANS_SPACE' => '_', 'TRANS_OTHER' => '_', 'TRANS_EAT' => 'Y', 'USE_GOOGLE' => 'Y', ), ), 'TAGS' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'SECTION_NAME' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => '', ), 'SECTION_PICTURE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => array ( 'FROM_DETAIL' => 'N', 'SCALE' => 'N', 'WIDTH' => '', 'HEIGHT' => '', 'IGNORE_ERRORS' => 'N', 'METHOD' => 'resample', 'COMPRESSION' => 95, 'DELETE_WITH_DETAIL' => 'N', 'UPDATE_WITH_DETAIL' => 'N', ), ), 'SECTION_DESCRIPTION_TYPE' => array ( 'IS_REQUIRED' => 'Y', 'DEFAULT_VALUE' => 'text', ), 'SECTION_DESCRIPTION' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'SECTION_DETAIL_PICTURE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => array ( 'SCALE' => 'N', 'WIDTH' => '', 'HEIGHT' => '', 'IGNORE_ERRORS' => 'N', 'METHOD' => 'resample', 'COMPRESSION' => 95, ), ), 'SECTION_XML_ID' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => '', ), 'SECTION_CODE' => array ( 'IS_REQUIRED' => 'N', 'DEFAULT_VALUE' => array ( 'UNIQUE' => 'N', 'TRANSLITERATION' => 'N', 'TRANS_LEN' => 100, 'TRANS_CASE' => 'L', 'TRANS_SPACE' => '_', 'TRANS_OTHER' => '_', 'TRANS_EAT' => 'Y', 'USE_GOOGLE' => 'N', ), ), ),
        "CODE" => $iblockCode,
		"LID" => array(WIZARD_SITE_ID)
       // "XML_ID" => $iblockCode,
        //"NAME" => "[".WIZARD_SITE_ID."] ".$iblock->GetArrayByID($iblockID, "NAME")
    );

    $iblock->Update($iblockID, $arFields);
}
else
{
     $arSites[] = WIZARD_SITE_ID;
        $iblock = new CIBlock;
        $iblock->Update($iblockID, array("LID" => $arSites));
}

	
	
$_SESSION["WIZARD_CATALOG_IBLOCK_ID"] = $iblockID;
	
	
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/_index.php", array("CODE_2" => $iblockID));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/catalog/index.php", array("CODE_2" => $iblockID));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/catalog/.top_catalog.menu_ext.php", array("CODE_2" => $iblockID));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/catalog/.left_catalog.menu_ext.php", array("CODE_2" => $iblockID));

CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/catalog/stock/index.php", array("CODE_2" => $iblockID));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/catalog/markdown/index.php", array("CODE_2" => $iblockID));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/catalog/favorite/index.php", array("CODE_2" => $iblockID));

CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/search/index.php", array("CODE_2" => $iblockID));

CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include/header/bitrix_search_title.php", array("CODE_2" => $iblockID));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include/header/bitrix_catalog_compare_list.php", array("CODE_2" => $iblockID));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include/header/krayt_new_menu_catalog.php", array("CODE_2" => $iblockID));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include/footer/bitrix_search_title_mobile.php", array("CODE_2" => $iblockID));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/include/header/bitrix_search_title.php", array("CODE_2" => $iblockID));
//local/php_interface/include/handler/ajax.panel.php
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/ajax/ajax.panel.php", array("CODE_2" => $iblockID));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH."/proizvoditeli/index.php", array("CODE_2" => $iblockID));

CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/classes/SearchExclude.php", array("CODE_2" => $iblockID));
CWizardUtil::ReplaceMacros($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/classes/MyElement.php", array("CODE_2" => $iblockID));

//$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".WIZARD_TEMPLATE_ID;
//CWizardUtil::ReplaceMacros($bitrixTemplateDir."/components/bitrix/news/brands/bitrix/news.detail/.default/template.php", array("CATALOG_IBLOCK_ID" => $iblockID));
?>