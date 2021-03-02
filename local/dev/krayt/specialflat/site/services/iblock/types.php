<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
	
CModule::IncludeModule("main");
if(!CModule::IncludeModule("iblock"))
	return;
	
	
	
$arTypes = Array(
	Array(
		"ID" => "catalog",
		"SECTIONS" => "Y",
		"IN_RSS" => "Y",
		"SORT" => 200,
		"LANG" => Array(),
	),
	Array(
		"ID" => "offers",
		"SECTIONS" => "Y",
		"IN_RSS" => "N",
		"SORT" => 100,
		"LANG" => Array(),
	),
	Array(
		"ID" => "content",
		"SECTIONS" => "Y",
		"IN_RSS" => "N",
		"SORT" => 100,
		"LANG" => Array(),
	),
	Array(
		"ID" => "office",
		"SECTIONS" => "Y",
		"IN_RSS" => "N",
		"SORT" => 100,
		"LANG" => Array(),
	)
);

$arLanguages = Array();
$rsLanguage = CLanguage::GetList($by, $order, array());
while($arLanguage = $rsLanguage->Fetch())
	$arLanguages[] = $arLanguage["LID"];

$iblockType = new CIBlockType;
foreach($arTypes as $arType)
{
	$dbType = CIBlockType::GetList(Array(),Array("=ID" => $arType["ID"]));
	if($dbType->Fetch())
		continue;

	foreach($arLanguages as $languageID)
	{
		
		WizardServices::IncludeServiceLang("types.php", $languageID);
		$code = strtoupper($arType["ID"]);
		$arType["LANG"][$languageID]["NAME"] = GetMessage($code."_TYPE_NAME");
		$arType["LANG"][$languageID]["ELEMENT_NAME"] = GetMessage($code."_ELEMENT_NAME");

		if ($arType["SECTIONS"] == "Y")
			$arType["LANG"][$languageID]["SECTION_NAME"] = GetMessage($code."_SECTION_NAME");
	}

	$iblockType->Add($arType);
}
	CUrlRewriter::Add(array(
        "CONDITION" => "#^".WIZARD_SITE_DIR."personal/order/#",
        "RULE" => "",
        "ID" => "bitrix:sale.personal.order",
        "PATH" => WIZARD_SITE_DIR."personal/order/index.php",
    ));
	CUrlRewriter::Add(array(
        "CONDITION" => "#^".WIZARD_SITE_DIR."proizvoditeli/#",
        "RULE" => "",
        "ID" => "krayt:brend",
        "PATH" => WIZARD_SITE_DIR."proizvoditeli/index.php",
    ));
	CUrlRewriter::Add(array(
        "CONDITION" => "#^".WIZARD_SITE_DIR."personal/#",
        "RULE" => "",
        "ID" => "bitrix:sale.personal.section",
        "PATH" => WIZARD_SITE_DIR."personal/index.php",
    ));
	CUrlRewriter::Add(array(
        "CONDITION" => "#^".WIZARD_SITE_DIR."podborki/#",
        "RULE" => "",
        "ID" => "bitrix:catalog",
        "PATH" => WIZARD_SITE_DIR."podborki/index.php",
    ));
	CUrlRewriter::Add(array(
        "CONDITION" => "#^".WIZARD_SITE_DIR."articles/#",
        "RULE" => "",
        "ID" => "bitrix:news",
        "PATH" => WIZARD_SITE_DIR."articles/index.php",
    ));
	CUrlRewriter::Add(array(
        "CONDITION" => "#^".WIZARD_SITE_DIR."catalog/#",
        "RULE" => "",
        "ID" => "bitrix:catalog",
        "PATH" => WIZARD_SITE_DIR."catalog/index.php",
    ));
	
	CUrlRewriter::Add(array(
        "CONDITION" => "#^".WIZARD_SITE_DIR."brend/#",
        "RULE" => "",
        "ID" => "krayt:brend",
        "PATH" => WIZARD_SITE_DIR."brend/index.php",
    ));
	CUrlRewriter::Add(array(
        "CONDITION" => "#^".WIZARD_SITE_DIR."store/#",
        "RULE" => "",
        "ID" => "bitrix:catalog.store",
        "PATH" => WIZARD_SITE_DIR."store/index.php",
    ));
	CUrlRewriter::Add(array(
        "CONDITION" => "#^".WIZARD_SITE_DIR."news/#",
        "RULE" => "",
        "ID" => "bitrix:news",
        "PATH" => WIZARD_SITE_DIR."news/index.php",
    ));
    

COption::SetOptionString('iblock','combined_list_mode','Y');

?>