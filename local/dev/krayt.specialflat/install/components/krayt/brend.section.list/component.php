<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();                        
if(\Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") == \Bitrix\Main\Loader::MODULE_DEMO_EXPIRED || 
   \Bitrix\Main\Loader::includeSharewareModule("krayt.specialflat") ==  \Bitrix\Main\Loader::MODULE_NOT_FOUND
    )
{ return false;}
Cmodule::IncludeMOdule('catalog');

use \Bitrix\Main\Data\Cache;
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


    $arBrend = array();
    if (empty($_GET['bukva'])){
        $arFilter = Array("IBLOCK_ID" => $arParams['I_BLOCK']);
    }else{
        $arFilter = Array("IBLOCK_ID" => $arParams['I_BLOCK'],"NAME" => htmlspecialchars($_GET['bukva'])."% |  ". htmlspecialchars($_GET['bukva'])."%");
    }
    $arFilter = Array("IBLOCK_ID" => $arParams['I_BLOCK'],"NAME" => htmlspecialchars($_GET['bukva'])."%");
    $arSelectr = Array("IBLOCK_ID", "ID", "NAME", "SECTION_PAGE_URL", "PICTURE", "UF_COUNTRY");

    $spIterator = CIBlockSection::GetList(Array("NAME"=>"ASC"),$arFilter, false,$arSelectr,array("nPageSize" => $arParams['ELEMENT_COL']));
    $spIteratorAlfa = CIBlockSection::GetList(Array("NAME"=>"ASC"),Array("IBLOCK_ID" => $arParams['I_BLOCK']), false,$arSelectr);
    $alfavit = array();

    while ($arSP = $spIteratorAlfa->GetNext()) {
        $buk = mb_substr(ltrim($arSP['NAME']," /n"),0,1);
        $alfavit[$buk] = $buk;
    }


    while ($arSP = $spIterator->GetNext()) {
        $arBrend['BREND'][] = $arSP;
    }

    $arBrend['ALFAVIT'] = $alfavit;

    $spIterator->nPageWindow = $arParams['ELEMENT_COL'];
    $arBrend["NAV_STRING"] = $spIterator->GetPageNavStringEx($navComponentObject, "", $arParams['COMPONENT_TEMPLATE']);

    $arResult = $arBrend;

    $cache->endDataCache($arResult);

}


$this->IncludeComponentTemplate();