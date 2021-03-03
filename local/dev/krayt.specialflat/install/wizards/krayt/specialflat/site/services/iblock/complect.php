<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

CModule::IncludeModule("iblock");

if (!CModule::IncludeModule("catalog"))
    return;


use Bitrix\Highloadblock as HL;
global $USER_FIELD_MANAGER;

//read file json list hiload
$complectFile = file_get_contents($_SERVER['DOCUMENT_ROOT'].WIZARD_SERVICE_RELATIVE_PATH.'/complect.json');
if(!$complectFile)
{
    echo WIZARD_SERVICE_RELATIVE_PATH;
    echo "No file json Complect";
    die();
}
$ArComplect = Bitrix\Main\Web\Json::decode($complectFile);
if(!$ArComplect)
{
    echo "No decode json file";
    die();
}

$IBLOCK_ID_COMPLECT =  $_SESSION["WIZARD_CATALOG_IBLOCK_ID"];
$IBLOCK_ID_COMPLECT_OF = $_SESSION["WIZARD_OFFERS_IBLOCK_ID"];
$ArComplectNew = [];
if($IBLOCK_ID_COMPLECT && is_array($ArComplect))
{
    foreach($ArComplect as $xml_id=>$complect)
    {
        $element = \Bitrix\Iblock\ElementTable::getList(
            [
                'select' => ['ID','IBLOCK_ID'],
                'filter' => ['=XML_ID' => $xml_id, "IBLOCK_ID" => $IBLOCK_ID_COMPLECT]
            ]
        )->fetch();
        if($element)
        {
            $ArComplectNew[$element['ID']]['ITEMS'] = array();
            $ArComplectNew[$element['ID']]['PROPERTIES'] = array();

            if(is_array($complect['ITEMS']))
            {
                foreach ($complect['ITEMS'] as $ITEM)
                {
                    $elementSCom = \Bitrix\Iblock\ElementTable::getList(
                        [
                            'select' => ['ID','IBLOCK_ID'],
                            'filter' => ['=XML_ID' => $ITEM, "IBLOCK_ID" => array($IBLOCK_ID_COMPLECT,$IBLOCK_ID_COMPLECT_OF)]
                        ])->fetch();
                    if($elementSCom)
                    {
                        $ArComplectNew[$element['ID']]['ITEMS'][] = array(
                            "ITEM_ID" => $elementSCom['ID'],
                            "QUANTITY" => 1,
                            "SORT" => 100
                        );
                    }
                }
            }

            if(is_array($complect['PROPERTIES']))
            {
                foreach ($complect['PROPERTIES'] as $CODE=>$PROPERTY)
                {
                    if($PROPERTY['VALUE'])
                    {
                        if(is_array($PROPERTY['VALUE']))
                        {
                            foreach ($PROPERTY['VALUE'] as $v)
                            {
                                $elementSP = \Bitrix\Iblock\ElementTable::getList(
                                    [
                                        'select' => ['ID','IBLOCK_ID'],
                                        'filter' => ['=XML_ID' => $v, "IBLOCK_ID" => array($IBLOCK_ID_COMPLECT,$IBLOCK_ID_COMPLECT_OF)]
                                    ])->fetch();
                                if($elementSP)
                                {
                                    $ArComplectNew[$element['ID']]['PROPERTIES'][$CODE]['VALUE'][] = $elementSP['ID'];
                                }
                            }
                        }else{
                            $elementSP = \Bitrix\Iblock\ElementTable::getList(
                                [
                                    'select' => ['ID','IBLOCK_ID'],
                                    'filter' => ['=XML_ID' => $PROPERTY['VALUE'], "IBLOCK_ID" => array($IBLOCK_ID_COMPLECT,$IBLOCK_ID_COMPLECT_OF)]
                                ])->fetch();
                            if($elementSP)
                            {
                                $ArComplectNew[$element['ID']]['PROPERTIES'][$CODE]['VALUE'] = $elementSP['ID'];
                            }
                        }
                    }
                }
            }
        }
    }
}

if($ArComplectNew)
{
    foreach ($ArComplectNew as $pC=>$cmpN)
    {
        CCatalogProductSet::add(array(
            'ITEM_ID' => $pC,
            "TYPE" => CCatalogProductSet::TYPE_SET,
            "ITEMS" => $cmpN['ITEMS']
        ));

        if(is_array($cmpN['PROPERTIES']))
        {
            foreach ($cmpN['PROPERTIES'] as $code=>$p)
            {
                if($p['VALUE'])
                {
                    CIBlockElement::SetPropertyValueCode($pC, $code, $p['VALUE']);
                }
            }
        }
    }
}

