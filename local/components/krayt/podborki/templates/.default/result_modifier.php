<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();


if ($arResult['TYPE'] == "podborka"){
    $nav = CIBlockSection::GetNavChain(false,  $arResult['ID']);
    while ($rez = $nav->GetNext()) {
       if ($rez['ID'] != $arResult['ID']){
            $APPLICATION->AddChainItem($rez['NAME'], $rez['SECTION_PAGE_URL']);
       }else{
           $APPLICATION->AddChainItem($rez['NAME'], "");
       }
    }
}
