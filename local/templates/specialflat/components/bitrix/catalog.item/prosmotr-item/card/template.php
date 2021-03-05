<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $item
 * @var array $actualItem
 * @var array $minOffer
 * @var array $itemIds
 * @var array $price
 * @var array $measureRatio
 * @var bool $haveOffers
 * @var bool $showSubscribe
 * @var array $morePhoto
 * @var bool $showSlider
 * @var string $imgTitle
 * @var string $productTitle
 * @var string $buttonSizeClass
 * @var CatalogSectionComponent $component
 */
?>
<div class="product-item">
    <div class="product-item-box">
        <a class="product-item-image-wrapper"
             data-entity="image-wrapper" href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $imgtTitle ?>">
		<div class="product-item-image-slider-slide-container slide" id="<?= $itemIds['PICT_SLIDER'] ?>"
              style="display: <?= ($showSlider ? '' : 'none') ?>;"
              data-slider-interval="<?= $arParams['SLIDER_INTERVAL'] ?>" data-slider-wrap="true">
            <div class="shine-wrp"><div class="shine"></div></div>
                <?
                if ($showSlider) {
                    foreach ($morePhoto as $key => $photo) {
                        ?>
                        <div class="product-item-image-slide item <?= ($key == 0 ? 'active' : '') ?>">
                            <div class="product-item-image-slide-box">
                                <div class="product-item-image-slide-img" style="background-image: url(<?= $photo['SRC'] ?>);"></div>
                            </div>
                        </div>
                        <?
                    }
                }
                ?>
		</div>
            <div class="product-item-image-original" id="<?= $itemIds['PICT'] ?>"
                  style="display: <?= ($showSlider ? 'none' : '') ?>;">
                <div class="shine-wrp"><div class="shine"></div></div>
                <div class="product-item-image-slide-box">
                    <div class="product-item-image-slide-img" style="background-image: url(<?= $item['PREVIEW_PICTURE']['SRC'] ?>); "></div>
                </div>
            </div>
            <?
            if ($item['SECOND_PICT']) {
                $bgImage = !empty($item['PREVIEW_PICTURE_SECOND']) ? $item['PREVIEW_PICTURE_SECOND']['SRC'] : $item['PREVIEW_PICTURE']['SRC'];
                ?>
                <div class="product-item-image-alternative" id="<?= $itemIds['SECOND_PICT'] ?>"
                      style="display: <?= ($showSlider ? 'none' : '') ?>;">
                    <div class="shine-wrp"><div class="shine"></div></div>
                    <div class="product-item-image-slide-box">
                        <div class="product-item-image-slide-img" style="background-image: url(<?= $bgImage ?>); "></div>
                    </div>
			</div>
                <?
            } ?>
        </a>


            <a class="product-item-title"  href="<?= $item['DETAIL_PAGE_URL'] ?>" title="<?= $productTitle ?>">
                <span><?= $productTitle ?></span>
            </a>
    </div>
</div>