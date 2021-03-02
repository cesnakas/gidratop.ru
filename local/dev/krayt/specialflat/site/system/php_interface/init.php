<?
/**
 * Created by PhpStorm.
 * User: User
 * Date: 30.10.2017
 * Time: 19:39
 */

// we establish the minimum and maximum price of goods on trade offers
CModule::AddAutoloadClasses('', array('MyElement' => '/local/php_interface/classes/MyElement.php',));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate",  Array("MyElement", "OnBeforeIBlockElementUpdateHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("MyElement", "OnAfterIBlockElementAddHandler"));
// delete from search index
CModule::AddAutoloadClasses('', array('SearchExclude' => '/local/php_interface/classes/SearchExclude.php',));
AddEventHandler("search", "BeforeIndex", Array("SearchExclude", "BeforeIndexHandler"));


