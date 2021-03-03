<?
IncludeModuleLangFile(__FILE__);

use Bitrix\Main\Loader;
use \Bitrix\Main\Data\Cache;
use Bitrix\Main\Application;

Class CKrayt_specialflat
{


    function ShowPanel()
    {

    }

    function OnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu)
    {
        if($GLOBALS['APPLICATION']->GetGroupRight("main") < "R")
            return;

        global $USER;
        if(!$USER->IsAdmin())
            return;


        $aGlobalMenu['global_menu_krayt'] = array(
            'menu_id' => "krayt",
            'text' => GetMessage('K_MENU_GLOBAL_TITLE'),
            'title' => GetMessage('K_MENU_GLOBAL_TEXT'),
            'sort'  => 1000,
            'items_id' => 'global_menu_krayt',
            'help_section' => 'krayt',
            'items' => array()

        );

    }

    function OnEndBufferContent(&$content)
    {
        if(SITE_TEMPLATE_ID == 'room')
        {
            $copyright = '<a href="http://marketplace.1c-bitrix.ru/partners/detail.php?ID=712923.php">'.GetMessage('K_COPY_TEXT').'</a>';

            if (preg_match('|<div class="copyright">|sei', $content))
            {
                $content = preg_replace("!<div class=\"copyright\">(.*?)</div>!si","<div class=\"copyright\">$copyright</div>",$content);
            }else{
                $copyright = '<div class="copyright" style="
                                                            position: absolute;
                                                            display: block !important;
                                                        "><a href="http://marketplace.1c-bitrix.ru/partners/detail.php?ID=712923.php" style="
                                                            position: relative !important;
                                                            top: -69px !important;
                                                            left: 60px !important;
                                                            color: #7aa4cf;
                                                            font-size: 14px;
                                                            display: block !important;
                                                        ">'.GetMessage('K_COPY_TEXT').'</a></div>';
                $content = preg_replace("!</body>!si","<div class='copyright'>$copyright</div></body>",$content);
            }
        }

    }

   static function getArticul($prop)
   {
       if($prop && $prop['VALUE'])
       {
           if(is_array($prop['VALUE']))
           {
               return implode(',',$prop['VALUE']);
           }else{
               return $prop['VALUE'];
           }
       }
       return false;
   }
   static function getBannerSection($id_section,$IBLOCK_ID)
   {
       $path = false;
       $arFilter = array('ID' => $id_section,"IBLOCK_ID" => $IBLOCK_ID);
       $cache = Application::getInstance()->getManagedCache();
       $cacheId = "banner_section";
       $result = array();
       if ($cache->read(7200, $cacheId))
       {
           $res = $cache->get($cacheId);
           $result = $res["ITEMS"];
           if(isset($result[$id_section]))
           {
               $path = $result[$id_section]['BANNER_PATH'];
           }else{
               $rsSect = CIBlockSection::GetList(array(),$arFilter,false,array("ID","IBLOCK_ID",'PICTURE',"UF_CATLOG_BANNER"))->GetNext();
               if($rsSect)
               {
                   if($rsSect['UF_CATLOG_BANNER'])
                   {
                       $rsSect['BANNER_PATH'] = CFile::GetPath($rsSect["UF_CATLOG_BANNER"]);
                       $path = $rsSect['BANNER_PATH'];
                       $result[$rsSect['ID']] = $rsSect;
                       $cache->set($cacheId, array("ITEMS" => $result));
                   }
               }
           }

       } else {
           try
           {
               $rsSect = CIBlockSection::GetList(array(),$arFilter,false,array("ID","IBLOCK_ID",'PICTURE',"UF_CATLOG_BANNER"))->GetNext();
               if($rsSect)
               {
                   if($rsSect['UF_CATLOG_BANNER'])
                   {
                       $rsSect['BANNER_PATH'] = CFile::GetPath($rsSect["UF_CATLOG_BANNER"]);
                       $path = $rsSect['BANNER_PATH'];
                       $result[$rsSect['ID']] = $rsSect;
                       $cache->set($cacheId, array("ITEMS" => $result));
                   }
               }
           }
           catch(SystemException $e)
           {
               $cache->abortDataCache();
               ShowError($e->getMessage());
           }
       }

       return $path;
   }


   static function getMinPriceComplect($props,&$price)
   {
        $arIdProduct = [];
        $arPropIds = [];
        $arCode = ['DOP_TOVAR_ONE','DOP_TOVAR_TWO','DOP_TOVAR_THREE'];
        foreach ($props as $p)
        {
            if(in_array($p['CODE'],$arCode))
            {
                if(is_array($p['VALUE']))
                {
                    foreach ($p['VALUE'] as $v)
                    {
                        if(!empty($v))
                        {
                            $arIdProduct[] = $v;
                            $arPropIds[$p['ID']][] = $v;
                        }
                    }
                }
            }
        }

        if($arIdProduct && $price['BASE']['PRICE_ID'])
        {

            $id_price = $price['BASE']['PRICE_ID'];

            $arFilter = array(
                'ID' => $arIdProduct,
                'CATALOG_PRICE_'.$id_price
            );

            $arSelect = array(
                "ID",'CATALOG_GROUP_'.$id_price
            );
            $res = CIBlockElement::GetList(Array(
                'CATALOG_PRICE_'.$id_price => "asc"
            ), $arFilter, false, Array("nPageSize"=>100), $arSelect);

            $arProductPrice = array();
            while ($item = $res->Fetch())
            {
                $arProductPrice[$item['ID']] = $item;
            }
        }
        $propsPrice = [];
        foreach ($arPropIds as $id_prop=>$pp)
        {
            foreach ($pp as $value)
            {
                if($arProductPrice[$value])
                {
                    $product_price = $arProductPrice[$value]['CATALOG_PRICE_'.$id_price];
                    if(isset($propsPrice[$id_prop]))
                    {
                        if($propsPrice[$id_prop] > $product_price)
                        {
                            $propsPrice[$id_prop] = $product_price;
                        }
                    }else{
                        $propsPrice[$id_prop] = $product_price;
                    }
                }
            }
        }
        $totalPrice = 0;
        if($propsPrice)
        {
            $totalPrice = array_sum($propsPrice);
        }

        if($totalPrice > 0)
        {
            $totalPrice = $totalPrice+ $price['BASE']['DISCOUNT_VALUE'];
            $CURRENCY = $price['BASE']['CURRENCY'];

            return [
                'PRICE' => $totalPrice,
                "PRICE_PRINT" => \CCurrencyLang::CurrencyFormat($totalPrice,$CURRENCY),
            ];
        }else{
            return false;
        }


   }
}
?>
