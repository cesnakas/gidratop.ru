<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.12.2017
 * Time: 15:33
 */
class SearchExclude
{
    function BeforeIndexHandler($arFields)
    {


        if ($arFields["MODULE_ID"] == "iblock" && $arFields["PARAM2"] == '#CODE_2#') {
            $db_props = CIBlockElement::GetProperty(
                $arFields["PARAM2"],
                $arFields["ITEM_ID"],
                array("sort" => "asc"),
                Array("CODE" => "NO_CATALOG"));
            if ($ar_props = $db_props->Fetch()) {
                if (!is_null($ar_props['VALUE'])) {
                    $arFields["BODY"]='';
                    $arFields["TITLE"]='';
                }
            }
        }
        return $arFields;
    }

}