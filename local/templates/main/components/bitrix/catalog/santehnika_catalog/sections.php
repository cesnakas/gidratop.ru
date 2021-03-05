<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);
$this->addExternalCss("/bitrix/css/main/bootstrap.css");
?>

    <div class="catalog-box">

        <h1 class="catalog-title"><?=GetMessage("TITLE_CATALOG");?></h1>

        <?
            $APPLICATION->IncludeComponent(
                "krayt:podborki.section.list",
                "",
                Array(
                    "IBLOCK_TYPE" => $arParams['IBLOCK_PODBORKI_TUPE'],
                    "I_BLOCK" => $arParams['IBLOCK_PODBORKI'],
                    "IBLOCK_TYPE_CATALOG" => $arParams['IBLOCK_TYPE'],
                    "I_BLOCK_CATALOG" => $arParams['IBLOCK_ID'],
                    "SECTION_PODBORKI_OK" => $arParams['SECTION_PODBORKI_OK'],
                ),
                $component,
                array("HIDE_ICONS" => "Y")
            );
        ?>

    </div>