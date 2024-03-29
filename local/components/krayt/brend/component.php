<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}


$smartBase = ($arParams["SEF_URL_TEMPLATES"]["section"]? $arParams["SEF_URL_TEMPLATES"]["section"]: "#SECTION_ID#/");
$arDefaultUrlTemplates404 = array(
    "sections" => "",
    "section" => "#SECTION_ID#/",
    "element" => "#SECTION_ID#/#ELEMENT_ID#/",
    "compare" => "compare.php?action=COMPARE",
    "smart_filter" => $smartBase."filter/#SMART_FILTER_PATH#/apply/"
);

$arDefaultVariableAliases404 = array();

$arDefaultVariableAliases = array();

$arComponentVariables = array(
    "SECTION_ID",
    "SECTION_CODE",
    "ELEMENT_ID",
    "ELEMENT_CODE",
    "action",
);

if($arParams["SEF_MODE"] == "Y")
{
    $arVariables = array();

    $engine = new CComponentEngine($this);
    if (\Bitrix\Main\Loader::includeModule('iblock'))
    {
        $engine->addGreedyPart("#SECTION_CODE_PATH#");
        $engine->addGreedyPart("#SMART_FILTER_PATH#");
        $engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
    }
    $arUrlTemplates = CComponentEngine::makeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);
    $arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);

    $componentPage = $engine->guessComponentPath(
        $arParams["SEF_FOLDER"],
        $arUrlTemplates,
        $arVariables
    );

    if ($componentPage === "smart_filter")
        $componentPage = "section";

    if(!$componentPage && isset($_REQUEST["q"]))
        $componentPage = "search";

    $b404 = false;
    if(!$componentPage)
    {
        $componentPage = "sections";
        $b404 = true;
    }

    if($componentPage == "section")
    {
        if (isset($arVariables["SECTION_ID"]))
            $b404 |= (intval($arVariables["SECTION_ID"])."" !== $arVariables["SECTION_ID"]);
        else
            $b404 |= !isset($arVariables["SECTION_CODE"]);
    }

    if($b404 && CModule::IncludeModule('iblock'))
    {
        $folder404 = str_replace("\\", "/", $arParams["SEF_FOLDER"]);
        if ($folder404 != "/")
            $folder404 = "/".trim($folder404, "/ \t\n\r\0\x0B")."/";
        if (substr($folder404, -1) == "/")
            $folder404 .= "index.php";

        if ($folder404 != $APPLICATION->GetCurPage(true))
        {
            \Bitrix\Iblock\Component\Tools::process404(
                ""
                ,($arParams["SET_STATUS_404"] === "Y")
                ,($arParams["SET_STATUS_404"] === "Y")
                ,($arParams["SHOW_404"] === "Y")
                ,$arParams["FILE_404"]
            );
        }
    }

    CComponentEngine::initComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);
    $arResult = array(
        "FOLDER" => $arParams["SEF_FOLDER"],
        "URL_TEMPLATES" => $arUrlTemplates,
        "VARIABLES" => $arVariables,
        "ALIASES" => $arVariableAliases
    );
}
else
{
    $arVariables = array();

    $arVariableAliases = CComponentEngine::makeComponentVariableAliases($arDefaultVariableAliases, $arParams["VARIABLE_ALIASES"]);
    CComponentEngine::initComponentVariables(false, $arComponentVariables, $arVariableAliases, $arVariables);

    $componentPage = "";

    $arCompareCommands = array(
        "COMPARE",
        "DELETE_FEATURE",
        "ADD_FEATURE",
        "DELETE_FROM_COMPARE_RESULT",
        "ADD_TO_COMPARE_RESULT",
        "COMPARE_BUY",
        "COMPARE_ADD2BASKET",
    );

    if(isset($arVariables["action"]) && in_array($arVariables["action"], $arCompareCommands))
        $componentPage = "compare";
    elseif(isset($arVariables["ELEMENT_ID"]) && intval($arVariables["ELEMENT_ID"]) > 0)
        $componentPage = "element";
    elseif(isset($arVariables["ELEMENT_CODE"]) && strlen($arVariables["ELEMENT_CODE"]) > 0)
        $componentPage = "element";
    elseif(isset($arVariables["SECTION_ID"]) && intval($arVariables["SECTION_ID"]) > 0)
        $componentPage = "section";
    elseif(isset($arVariables["SECTION_CODE"]) && strlen($arVariables["SECTION_CODE"]) > 0)
        $componentPage = "section";
    elseif(isset($_REQUEST["q"]))
        $componentPage = "search";
    else
        $componentPage = "sections";

    $currentPage = htmlspecialcharsbx($APPLICATION->GetCurPage())."?";
    $arResult = array(
        "FOLDER" => "",
        "URL_TEMPLATES" => array(
            "section" => $currentPage.$arVariableAliases["SECTION_ID"]."=#SECTION_ID#",
            "element" => $currentPage.$arVariableAliases["SECTION_ID"]."=#SECTION_ID#"."&".$arVariableAliases["ELEMENT_ID"]."=#ELEMENT_ID#",
            "compare" => $currentPage.$arVariableAliases["action"]."=COMPARE",
        ),
        "VARIABLES" => $arVariables,
        "ALIASES" => $arVariableAliases
    );
}

$this->IncludeComponentTemplate($componentPage);