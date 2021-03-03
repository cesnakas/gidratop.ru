<? defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;

Loc::loadMessages(__file__);

if (class_exists('krayt_specialflat')) {
    return;
}

class krayt_specialflat extends CModule
{
    const MODULE_ID = "krayt.specialflat";
    var $MODULE_ID = "krayt.specialflat";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $MODULE_GROUP_RIGHTS = "Y";

    function __construct()
    {
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __file__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include ($path . "/version.php");

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        $this->MODULE_NAME = Loc::getMessage("SCOM_INSTALL_NAME_krayt.specialflat");
        $this->MODULE_DESCRIPTION = Loc::getMessage("SCOM_INSTALL_DESCRIPTION_krayt.specialflat");
        $this->PARTNER_NAME = Loc::getMessage("SPER_PARTNER_krayt.specialflat");
        $this->PARTNER_URI = Loc::getMessage("PARTNER_URI_krayt.specialflat");
    }

    function InstallDB($arParams = array())
    {
        RegisterModuleDependences("main", "OnBeforeProlog", self::MODULE_ID, "CKrayt_specialflat", "ShowPanel");

        RegisterModuleDependences("main", "OnEndBufferContent", self::MODULE_ID, "CKrayt_specialflat", "OnEndBufferContent");


        return true;
    }

     function UnInstallDB($arParams = array())
    {
        UnRegisterModuleDependences("main", "OnBeforeProlog", self::MODULE_ID, "CKrayt_specialflat", "ShowPanel");
        UnRegisterModuleDependences("main", "OnEndBufferContent", self::MODULE_ID, "CKrayt_specialflat", "OnEndBufferContent");
        return true;
    }


    function InstallFiles($arParams = array())
    {
        $local_dir = '/local';
        if(!file_exists($_SERVER["DOCUMENT_ROOT"].$local_dir))
        {
            mkdir($_SERVER["DOCUMENT_ROOT"].$local_dir, 0755);

            if(!file_exists($_SERVER["DOCUMENT_ROOT"].$local_dir."/templates/"))
            {
                mkdir($_SERVER["DOCUMENT_ROOT"].$local_dir, 0755);
                mkdir($_SERVER["DOCUMENT_ROOT"].$local_dir."/templates/", 0755);
                mkdir($_SERVER["DOCUMENT_ROOT"].$local_dir."/components/", 0755);
            }
        }else{

            if(!file_exists($_SERVER["DOCUMENT_ROOT"].$local_dir."/templates/"))
            {
                mkdir($_SERVER["DOCUMENT_ROOT"].$local_dir."/templates/", 0755);

            }
            if(!file_exists($_SERVER["DOCUMENT_ROOT"].$local_dir."/components/"))
            {
                mkdir($_SERVER["DOCUMENT_ROOT"].$local_dir."/components/", 0755);

            }
        }


        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/components", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/upload", $_SERVER["DOCUMENT_ROOT"]."/upload", true, true);
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".self::MODULE_ID."/install/wizards/krayt/specialflat", $_SERVER["DOCUMENT_ROOT"]."/bitrix/wizards/krayt/specialflat", true, true);


        if (is_dir($admin = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin'))
        {
            if ($dir = opendir($admin))
            {
                while (false !== $item = readdir($dir))
                {
                    if ($item == '..' || $item == '.' || $item == 'menu.php')
                        continue;
                    file_put_contents($file = $_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/k_'.$item,
                        '<'.'? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/'.self::MODULE_ID.'/admin/'.$item.'");?'.'>');
                }
                closedir($dir);
            }
        }


        return true;
    }


     function UnInstallFiles()
    {

        if (is_dir($admin = $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.self::MODULE_ID.'/admin'))
        {
            if ($dir = opendir($admin))
            {
                while (false !== $item = readdir($dir))
                {
                    if ($item == '..' || $item == '.')
                        continue;
                    unlink($_SERVER['DOCUMENT_ROOT'].'/bitrix/admin/k_'.$item);
                }
                closedir($dir);
            }
        }

        \Bitrix\Main\IO\Directory::deleteDirectory($_SERVER["DOCUMENT_ROOT"]."/bitrix/wizards/krayt/specialflat");//удалилить мастер установки

        return true;
    }

    function DoInstall()
    {
        $this->InstallFiles();
        $this->InstallDB();
        RegisterModule(self::MODULE_ID);
    }

    function DoUninstall()
    {
        global $APPLICATION;
        UnRegisterModule(self::MODULE_ID);
        $this->UnInstallDB();
        $this->UnInstallFiles();
    }
}
?>