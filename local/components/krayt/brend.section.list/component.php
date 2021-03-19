<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED ||
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
Cmodule::IncludeMOdule('catalog');
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
CModule::IncludeModule('highloadblock');

function GetEntityDataClass($iHlBlockId) {
    if (empty($iHlBlockId) || $iHlBlockId < 1)
    {
        return false;
    }
    $hlblock = HLBT::getById($iHlBlockId)->fetch();
    $entity = HLBT::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}
use \Bitrix\Main\Data\Cache;
use \Bitrix\Main\Application;

$cache = Cache::createInstance();

//////////////////////////////////////////////

function abc($a,$b){
    $la = mb_substr($a,0,1,'utf-8');
    $lb = mb_substr($b,0,1,'utf-8');
    if(ord($la) > 122 && ord($lb) > 122){
        return $a > $b ? 1 : -1;
    }
    if(ord($la) > 122 || ord($lb) > 122) {
        return $a < $b ? 1 : -1;
    }

}

function sgp($url,$varname,$value){
    if(is_array($varname)){
        foreach($varname as $i=>$n){
            $v=(is_array($value))?(isset($value[$i])?$value[$i]:NULL):$value;
            $url=sgp($url,$n,$v);
        }
        return $url;
    }
    preg_match('/^([^?]+)(\?.*?)?(#.*)?$/',$url,$matches);
    $gp=(isset($matches[2]))?$matches[2]:'';
    if(!$gp)return $url;
    $pattern="/([?&])$varname=.*?(?=&|#|\z)/";
    if(preg_match($pattern,$gp)){
        $substitution=($value!=='')?"\${1}$varname=".preg_quote($value):'';
        $newgp=preg_replace($pattern,$substitution,$gp);
        $newgp=preg_replace('/^&/','?',$newgp);
    }
    else{
        $s=($gp)?'&':'?';
        $newgp=$gp.$s.$varname.'='.$value;
    }
    $anchor=(isset($matches[3]))?$matches[3]:'';
    $newurl=$matches[1].$newgp.$anchor;
    $newurl=rtrim($newurl,'&');
    $newurl=str_replace('&&','&',$newurl);
    $newurl=str_replace('?&','?',$newurl);
    return $newurl;
}

////////////////////////////////////////////////////

if (isset($_GET['bukva']) && !empty($_GET['bukva'])){
    $str = htmlspecialchars($_GET['bukva']).htmlspecialchars($_GET['PAGEN_1']);
}else{
    $str= $arParams['I_BLOCK'].htmlspecialchars($_GET['PAGEN_1']);
}
if ($cache->initCache($arParams['CACHE_TIME'],"/brend.section.list/".$str)) {
    $vars = $cache->GetVars();
    $arResult = $vars;
}elseif ($cache->startDataCache()) {



   // print_r($arCountry);
    $nowCountry=array();
    $arFilterCount = Array("IBLOCK_ID" => $arParams['I_BLOCK']);
    $arSelect = Array("IBLOCK_ID","NAME",'UF_STRANA');
    $spIteratorCount = CIBlockSection::GetList(Array("NAME"=>"ASC"),$arFilterCount, false, $arSelect);
    $j=0;
    while ($arSPCount = $spIteratorCount->GetNext()) {
        $arCountryNow[$j] =$arSPCount;
           $nowCountry[$j]=$arCountryNow[$j]['UF_STRANA'];
        $j++;
    }

    $actualCountryList = array_filter($nowCountry, function($element) {
        return !empty($element);
    });

    $actualCountryList=array_values(array_unique($actualCountryList));

    //print_r($actualCountryList);
    $arCountry=array();
    $entity_data_class = GetEntityDataClass(5);
    $i=1;
    foreach ($actualCountryList as &$value) {
        //print_r($value);
        $rsData = $entity_data_class::getList(array(
            'select' => array('ID','UF_NAME','UF_FILE'),
            "filter" => array('ID' =>$value),

        ));

        while($el = $rsData->fetch()){
           //print_r($el);
            $arCountry[$i]=$el;
            $i++;
        }

    }
    $arCountry2=$arCountry;

    function cmp($a, $b){
        return strcmp($a["UF_NAME"], $b["UF_NAME"]);
    }

  usort($arCountry,'cmp');

    //print_r( $arCountry);
//echo $_GET['strana'];
   // echo $_GET['bukva'];
    $arBrend = array();

    $arBrend['COUNTRYS']=$arCountry;

    $request = Application::getInstance()->getContext()->getRequest();

    $strana = $request->get("strana");
    $bukva = $request->get("bukva");
    $nameFilter = $request->get("nameFilter");
   // print_r($strana);

    // print_r($arBrend['COUNTRYS']);
    if (empty($strana)){
    if (empty($bukva)){
        $arFilter = Array("IBLOCK_ID" => $arParams['I_BLOCK']);
    }else{
        $arFilter = Array("IBLOCK_ID" => $arParams['I_BLOCK'],"NAME" => htmlspecialchars($bukva)."%");
    } }

    else {
        $arFilter = Array("IBLOCK_ID" => $arParams['I_BLOCK'],'UF_STRANA'=>$_GET['strana']);
        if (!empty($bukva)){
            $arFilter = Array("IBLOCK_ID" => $arParams['I_BLOCK'],'UF_STRANA'=>$strana,"NAME" => htmlspecialchars($bukva)."%");


        }
    }

    $arSelectr = Array("IBLOCK_ID", "ID", "NAME", "SECTION_PAGE_URL", "PICTURE", "UF_COUNTRY","UF_STRANA", "UF_PRICE_TYPE");
    $spIterator = CIBlockSection::GetList(Array("NAME"=>"ASC"),$arFilter, false,$arSelectr,array("nPageSize" => $arParams['ELEMENT_COL']));
    if (empty($strana) and empty($bukva)){
        $arFilter2=Array("IBLOCK_ID" => $arParams['I_BLOCK']);
    }

    else {
        $arFilter2=Array("IBLOCK_ID" => $arParams['I_BLOCK'],'UF_STRANA'=>$strana);
        if (!empty($bukva)) {
            $arFilter2=Array("IBLOCK_ID" => $arParams['I_BLOCK']);
        }
        if (!empty($bukva)) {
            $arFilter2=Array("IBLOCK_ID" => $arParams['I_BLOCK'],'UF_STRANA'=>$strana);
        }
        if (empty($strana)) {
            $arFilter2=Array("IBLOCK_ID" => $arParams['I_BLOCK']);
        }
    }

    $spIteratorAlfa = CIBlockSection::GetList(Array("NAME"=>"ASC"), $arFilter2, false, $arSelectr);

    $strEnLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
    $strRuLettes = "АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюя";
    $strNumbers = "0123456789";

    $alfavit = array();
    $alfavit_rus = array();
    $alfavit_num = array();

    while ($arSP = $spIteratorAlfa->GetNext()) {
        $buk = mb_substr(ltrim($arSP['NAME']," /n"), 0, 1);
        if (strpos($strRuLettes, $buk) !== false){
            $alfavit_rus[$buk] = $buk;
        }
        else if (strpos($strNumbers, $buk) !== false){
            $alfavit_num[$buk] = $buk;
        }
        else{
            $alfavit[$buk] = $buk;
        }
    }


    while ($arSP = $spIterator->GetNext()) {
        $arBrend['BREND'][] = $arSP;
    }


    $arBrend['ALFAVIT'] = $alfavit;
    $arBrend['ALFAVIT_RUS'] = $alfavit_rus;
    $arBrend['ALFAVIT_NUM'] = $alfavit_num;

    $spIterator->nPageWindow = $arParams['ELEMENT_COL'];
    $arBrend["NAV_STRING"] = $spIterator->GetPageNavStringEx($navComponentObject, "", $arParams['COMPONENT_TEMPLATE']);

    $arResult = $arBrend;

    //print_r($arCountry2);
   // print_r($arResult['BREND']);
    //print_r($arCountry2);
    $k=0;
    foreach ($arResult['BREND'] as $brend) {


        $brend_strana = $brend['UF_STRANA'];
        //print_r($brend_strana);
        $rsData = $entity_data_class::getList(array(
            'select' => array('ID','UF_NAME', 'UF_FILE'),
            "filter" => array('ID' =>$brend['UF_STRANA']),
        ));

        while($el = $rsData->fetch()){
            //print_r($el);
            $arResult['BREND'][$k]['UF_STRANA_NAME']=$el;
            $k++;
        }
    }
    print_r("<div hidden>");
    print_r($arResult['ALFAVIT']);
    print_r($arResult['ALFAVIT_RUS']);
    print_r($arResult['ALFAVIT_NUM']);
    print_r("</div>");
    $cache->endDataCache($arResult);

}


$this->IncludeComponentTemplate();
