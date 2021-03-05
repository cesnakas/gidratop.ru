<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Интернет-магазин европейской сантехники");
$APPLICATION->SetPageProperty("keywords", "Интернет-магазин европейской сантехники");
$APPLICATION->SetPageProperty("title", "Интернет-магазин европейской сантехники Gidratop");
$APPLICATION->SetTitle("Каталог");
?>

    <?$APPLICATION->IncludeComponent(
        "bitrix:catalog",
        "santehnika_catalog",
        array(
            "ACTION_VARIABLE" => "action",
            "ADD_ELEMENT_CHAIN" => "Y",
            "ADD_PICT_PROP" => "MORE_PHOTO",
            "ADD_PROPERTIES_TO_BASKET" => "Y",
            "ADD_SECTIONS_CHAIN" => "Y",
            "ADD_SECTION_CHAIN" => "Y",
            "AJAX_MODE" => "N",
            "AJAX_OPTION_ADDITIONAL" => "",
            "AJAX_OPTION_HISTORY" => "Y",
            "AJAX_OPTION_JUMP" => "N",
            "AJAX_OPTION_STYLE" => "Y",
            "ALSO_BUY_ELEMENT_COUNT" => "4",
            "ALSO_BUY_MIN_BUYES" => "1",
            "BASKET_URL" => "/personal/cart/",
            "BIG_DATA_RCM_TYPE" => "similar",
            "CACHE_FILTER" => "Y",
            "CACHE_GROUPS" => "N",
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "COMMON_ADD_TO_BASKET_ACTION" => "ADD",
            "COMMON_SHOW_CLOSE_POPUP" => "Y",
            "COMPARE_ELEMENT_SORT_FIELD" => "sort",
            "COMPARE_ELEMENT_SORT_ORDER" => "asc",
            "COMPARE_FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
            "COMPARE_OFFERS_FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "COMPARE_OFFERS_PROPERTY_CODE" => array(
                0 => "ARTNUMBER",
                1 => "SHIRINA",
                2 => "COLOR_REF",
                3 => "VISOTA",
                4 => "DLINNA",
                5 => "",
            ),
            "COMPARE_POSITION" => "top left",
            "COMPARE_POSITION_FIXED" => "Y",
            "COMPARE_PROPERTY_CODE" => array(
                0 => "STRANA",
                1 => "BLOG_COMMENTS_CNT",
                2 => "GLUBINA",
                3 => "DLINA",
                4 => "MONTAZH",
                5 => "OBLAST",
                6 => "OBEM",
                7 => "DIZAIN",
                8 => "FORMA",
                9 => "SHIRINA",
                10 => "DOP_FUNKCI",
                11 => "DIAMETR_SLIVA",
                12 => "COL_CELOVEK",
                13 => "NOZHKI",
                14 => "PODGOLOVNIK",
                15 => "RUCHKI",
                16 => "SLIV_PERELIV",
                17 => "TOLSHINA_LISTA",
                18 => "UGLOVAJA_CON",
                19 => "BEZOBODKOVIY",
                20 => "BISTROSEMNOE_SIDENIE",
                21 => "MEHANIZM_SLIVA",
                22 => "PODOGREV_SIDENIJA",
                23 => "RECOMMEND",
                24 => "NAPROVLENIE_VIPUSKA",
                25 => "SIDENIE_V_KOMPONENTE",
                26 => "SIDENIE_S_MICROFITOM",
                27 => "GARANTIJA",
                28 => "POKRIRIE",
                29 => "MATERIAL_SEDENIJA",
                30 => "METOD_USTANOVKI_BOCHKA",
                31 => "SMiVAUSHIY_POTOK",
                32 => "OSNASHENIE",
                33 => "POLOCHKA_V_CAHE",
                34 => "RAS_PERELIVA",
                35 => "RESCHiIM_SLIVA",
                36 => "SISTEMA_ANTIVSPLESK",
                37 => "",
            ),
            "COMPATIBLE_MODE" => "Y",
            "CONVERT_CURRENCY" => "N",
            "DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",
            "DETAIL_ADD_TO_BASKET_ACTION" => array(
                0 => "ADD",
            ),
            "DETAIL_ADD_TO_BASKET_ACTION_PRIMARY" => array(
                0 => "ADD",
            ),
            "DETAIL_BACKGROUND_IMAGE" => "-",
            "DETAIL_BLOG_EMAIL_NOTIFY" => "N",
            "DETAIL_BLOG_URL" => "catalog_comments",
            "DETAIL_BLOG_USE" => "Y",
            "DETAIL_BRAND_PROP_CODE" => array(
                0 => "",
                1 => "BRAND_REF",
                2 => "",
            ),
            "DETAIL_BRAND_USE" => "N",
            "DETAIL_BROWSER_TITLE" => "-",
            "DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
            "DETAIL_DETAIL_PICTURE_MODE" => array(
                0 => "POPUP",
            ),
            "DETAIL_DISPLAY_NAME" => "Y",
            "DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "H",
            "DETAIL_FB_APP_ID" => "",
            "DETAIL_FB_USE" => "Y",
            "DETAIL_IMAGE_RESOLUTION" => "1by1",
            "DETAIL_MAIN_BLOCK_OFFERS_PROPERTY_CODE" => array(
            ),
            "DETAIL_MAIN_BLOCK_PROPERTY_CODE" => array(
            ),
            "DETAIL_META_DESCRIPTION" => "-",
            "DETAIL_META_KEYWORDS" => "-",
            "DETAIL_OFFERS_FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "DETAIL_OFFERS_PROPERTY_CODE" => array(
                0 => "ARTNUMBER",
                1 => "COLOR",
                2 => "GABARIT",
                3 => "GLUBINA",
                4 => "DLINA",
                5 => "SHIRINA",
                6 => "TEST1",
                7 => "",
            ),
            "DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "props,sku",
            "DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
            "DETAIL_PROPERTY_CODE" => array(
                0 => "DOP_TOVAR",
                1 => "KEYWORDS",
                2 => "SERVISE",
                3 => "UCENKA",
                4 => "BEST",
                5 => "VES",
                6 => "VYSOTA_UPAKOVKI_SM",
                7 => "VYSOTA",
                8 => "GARANTIA",
                9 => "GLUBINA",
                10 => "DLINA_UPAKOVKI_SM",
                11 => "DLINA",
                12 => "KOLICHESTVO_KOROBOK",
                13 => "MASSA",
                14 => "MATERIAL",
                15 => "MATERIAL_UPAKOVKI",
                16 => "MONTAZH",
                17 => "OBLAST",
                18 => "OBEM",
                19 => "OBEM_M3",
                20 => "POVERHNOST",
                21 => "PREDEL_NAGRUZKA",
                22 => "DIFFERENT",
                23 => "DIZAIN",
                24 => "FORMA",
                25 => "COLOR",
                26 => "PRICE",
                27 => "SHIRINA_UPAKOVKI_SM",
                28 => "SHIRINA",
                29 => "ELECTPOPITANIE",
                30 => "ORIENTACIA",
                31 => "DOP_FUNKCI",
                32 => "TITLE",
                33 => "POLOTNO_DVERI",
                34 => "KOLICHESTVO_SEKCI",
                35 => "KONSTRUKCIA_DVERI",
                36 => "MATERIAL_POLOTNA_DVERI",
                37 => "MATERIAL_PROFIL",
                38 => "PODDON_KOMPLEKT",
                39 => "TIP_KONSTRUKCIA",
                40 => "SHIRINA_VHODA",
                41 => "POKRITIE",
                42 => "aeromassazh",
                43 => "BOK_EKRAN",
                44 => "MODIFICATIONS",
                45 => "VYSOTA_S_OPOROY",
                46 => "Temp",
                47 => "DIAMETR_SLIVA",
                48 => "ZASHITA_TOK",
                49 => "KARKAS",
                50 => "COL_CELOVEK",
                51 => "NOZHKI",
                52 => "Ozonirovanie",
                53 => "podvodnaya_podsvetka",
                54 => "PODGOLOVNIK",
                55 => "Raspolojenie_sliva",
                56 => "RUCHKI",
                57 => "systema_gidro",
                58 => "systema_dezinfekcii",
                59 => "SLIV_PERELIV",
                60 => "Spina",
                61 => "TOLSHINA_LISTA",
                62 => "UGLOVAJA_CON",
                63 => "UPRAVLENIE_SISTEMOI",
                64 => "FRONT_EKRAN",
                65 => "chromoterapiya",
                66 => "BEZOBODKOVIY",
                67 => "BISTROSEMNOE_SIDENIE",
                68 => "Mejosevoe",
                69 => "MEHANIZM_SLIVA",
                70 => "NAPROVLENIE_VIPUSKA_UNITAZA",
                71 => "PODVOD_VODY",
                72 => "SIDENIE_V_KOMPLEKTE",
                73 => "SIDENIE_S_MICROLFTOM",
                74 => "PODOGREV_SIDENIJA",
                75 => "TIP_UNITAZA",
                76 => "SISTEMA_INSTILJACII",
                77 => "FUNCTION_BIDE",
                78 => "DIAMETR_PEREHOD",
                79 => "DIAMETR_SLIVA_UNI",
                80 => "KNOPKA",
                81 => "KLAVISHY_SMYVA",
                82 => "KREPLENIA",
                83 => "METOD_KREPLENIYA",
                84 => "MONTAZHNAYA_VYSOTA",
                85 => "MONTAZHNAYA_GLUBINA_SM",
                86 => "OBEM_SMYVNOGO_BACHKA",
                87 => "TIP_INSTAL",
                88 => "UPRAVLENIE_SMYVOM",
                89 => "PROKLADKA_SHUM",
                90 => "STIRALKA",
                91 => "OTVERSTIYA_POD_SMESITEL",
                92 => "SLIV_PERELIV_Racovina_bide",
                93 => "TIP_RAKOVINY",
                94 => "SMESITEL_V_KOMPLEKTE",
                95 => "TIP_BIDE",
                96 => "PODVOD_VODY_PISSUARA",
                97 => "UPRAVLENIE_SMYVOM_PISSUARA",
                98 => "USTROISTVO_SLIVA_V_KOMPLEKTE",
                99 => "VYSOTA_IZLIVA",
                100 => "DONNIY_KLAPAN",
                101 => "MEHANISM_SMESITEL",
                102 => "POVOROT_IZLIV",
                103 => "PODVODKA",
                104 => "RASHOD_VODY",
                105 => "SMESITEL_S_VRHNIM_DUSHEM",
                106 => "STANDART_PODVODKI",
                107 => "TIP_SMESITELYA",
                108 => "UPRAVLENIE_SMESITELEM",
                109 => "ECONOMY_VODY",
                110 => "VERHNIY_DUSH",
                111 => "VYLET_VERHEGO_DUSHA",
                112 => "DEVIATOR",
                113 => "DLINA_SHLANGA",
                114 => "ZASHITA_OT_OBRATNOGO_POTOKA",
                115 => "IZLIV_DLYA_NAPOLNENIYA",
                116 => "KOLICHESTVO_REJIMOV_STRUI",
                117 => "NAZNACHENIE_DUSHA",
                118 => "RAZMER_VERHEGO_DUSHA",
                119 => "RAZMER_LEYKI",
                120 => "RUCHNOY_DUSH",
                121 => "ISVEST",
                122 => "SMESITEL_VSTROEN",
                123 => "RASMER_ROZETKI",
                124 => "VID_ZATVORA",
                125 => "VID_RESHETKI",
                126 => "MAX_PROPUSK",
                127 => "MASHTAB_REGULIROVKI",
                128 => "MIN_PROPUSK",
                129 => "Napravlenie_vypuska_sifona",
                130 => "RASMESHENIE_LOTKA",
                131 => "REGULIROVKA",
                132 => "RESHETKA_V_KOMPLEKTE",
                133 => "KORZINA_BELYEVAYA",
                134 => "VID_ZERKALA",
                135 => "MATERIAL_KORPUSA",
                136 => "MATERIAL_FASADA",
                137 => "DOVODCHIK",
                138 => "MOSHNOST_LAMPY",
                139 => "PoKRYTIE_KORPUSA",
                140 => "POKRYTIE_FASADA",
                141 => "SYSTEMA_HRANENIYA",
                142 => "TIP_VIKLYUCHATELYA",
                143 => "TIP_SVET",
                144 => "CVET_KORPUSA",
                145 => "CVET_RAKOVINY",
                146 => "Konstrukcia",
                147 => "VISOTA_S_OPOROY",
                148 => "UPRAVLENIE",
                149 => "UPRAV_SISTEMOI",
                150 => "NAPROVLENIE_VIPUSKA",
                151 => "SIDENIE_V_KOMPONENTE",
                152 => "SIDENIE_S_MICROFITOM",
                153 => "smyv",
                154 => "MONTAZHNAYA_VYSOTA_SM",
                155 => "OTVERSTIYA",
                156 => "VISOTA_IZLIVA",
                157 => "MEHANISM",
                158 => "NAZNACHENIE_SMESITELYA",
                159 => "VYLEY_VERHEGO_DUSHA",
                160 => "Napravlenie_vypuska",
                161 => "MATERIAL_RAKOVINY",
                162 => "OSNASHENIE_ZERKALA",
                163 => "COD_TOVARA",
                164 => "GARANTIJA",
                165 => "RASPOLOJENYE_PERELIVA",
                166 => "MANUFACTURER",
                167 => "POKRIRIE",
                168 => "combinirovanaya_vanna",
                169 => "MAXIMUM_PRICE",
                170 => "MATERIAL_SEDENIJA",
                171 => "METOD_USTANOVKI_BOCHKA",
                172 => "MINIMUM_PRICE",
                173 => "MODEL",
                174 => "SMiVAUSHIY_POTOK",
                175 => "OSNASHENIE",
                176 => "POLOCHKA_V_CAHE",
                177 => "RAS_PERELIVA",
                178 => "RESCHiIM_SLIVA",
                179 => "SISTEMA_ANTIVSPLESK",
                180 => "TEST",
                181 => "COLOR_SIDENIJA",
                182 => "INSTRUKCIJA",
                183 => "INSTRUKCIA",
                184 => "",
            ),
            "DETAIL_SET_CANONICAL_URL" => "N",
            "DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
            "DETAIL_SHOW_BASIS_PRICE" => "Y",
            "DETAIL_SHOW_MAX_QUANTITY" => "N",
            "DETAIL_SHOW_POPULAR" => "Y",
            "DETAIL_SHOW_SLIDER" => "Y",
            "DETAIL_SHOW_VIEWED" => "Y",
            "DETAIL_SLIDER_INTERVAL" => "3000",
            "DETAIL_SLIDER_PROGRESS" => "Y",
            "DETAIL_STRICT_SECTION_CHECK" => "N",
            "DETAIL_USE_COMMENTS" => "N",
            "DETAIL_USE_VOTE_RATING" => "N",
            "DETAIL_VK_API_ID" => "API_ID",
            "DETAIL_VK_USE" => "Y",
            "DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
            "DISABLE_INIT_JS_IN_COMPONENT" => "N",
            "DISCOUNT_PERCENT_POSITION" => "top-left",
            "DISPLAY_BOTTOM_PAGER" => "Y",
            "DISPLAY_ELEMENT_SELECT_BOX" => "N",
            "DISPLAY_TOP_PAGER" => "N",
            "DOP_ELEMENT_PROPERTY_ONE" => "319",
            "DOP_ELEMENT_PROPERTY_THREE" => "11",
            "DOP_ELEMENT_PROPERTY_TWO" => "12",
            "DOP_SKU_ELEMENT_PROPERTY_ONE" => "33",
            "DOP_SKU_ELEMENT_PROPERTY_THREE" => "",
            "DOP_SKU_ELEMENT_PROPERTY_TWO" => "297",
            "DOP_SKU_PROPERTY_ONE" => "33",
            "DOP_SKU_PROPERTY_THREE" => "32",
            "DOP_SKU_PROPERTY_TWO" => "297",
            "ELEMENT_SORT_FIELD" => "desc",
            "ELEMENT_SORT_FIELD2" => "id",
            "ELEMENT_SORT_ORDER" => "asc",
            "ELEMENT_SORT_ORDER2" => "desc",
            "FIELDS" => array(
                0 => "SCHEDULE",
                1 => "STORE",
                2 => "",
            ),
            "FILE_404" => "",
            "FILTER_FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "FILTER_HIDE_ON_MOBILE" => "N",
            "FILTER_NAME" => "arFilterCatalog",
            "FILTER_OFFERS_FIELD_CODE" => array(
                0 => "PREVIEW_PICTURE",
                1 => "DETAIL_PICTURE",
                2 => "",
            ),
            "FILTER_OFFERS_PROPERTY_CODE" => array(
                0 => "COLOR",
                1 => "",
            ),
            "FILTER_PRICE_CODE" => array(
                0 => "BASE",
            ),
            "FILTER_PROPERTY_CODE" => array(
                0 => "MATERIAL",
                1 => "COLOR",
                2 => "smyv",
                3 => "dush",
                4 => "dush_ug",
                5 => "aks",
                6 => "zerk",
                7 => "",
            ),
            "FILTER_VIEW_MODE" => "",
            "FORUM_ID" => "1",
            "GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
            "GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
            "GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
            "GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
            "GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
            "GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
            "GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
            "GIFTS_MESS_BTN_BUY" => "Выбрать",
            "GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
            "GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
            "GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "4",
            "GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
            "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
            "GIFTS_SHOW_IMAGE" => "Y",
            "GIFTS_SHOW_NAME" => "Y",
            "GIFTS_SHOW_OLD_PRICE" => "Y",
            "HIDE_NOT_AVAILABLE" => "N",
            "HIDE_NOT_AVAILABLE_OFFERS" => "N",
            "IBLOCK_ID" => "8",
            "IBLOCK_PODBORKI" => "9",
            "IBLOCK_PODBORKI_TUPE" => "catalog",
            "IBLOCK_TYPE" => "catalog",
            "INCLUDE_SUBSECTIONS" => "Y",
            "INSTANT_RELOAD" => "N",
            "I_BLOCK_GROUP_PROP" => "6",
            "LABEL_PROP" => array(
                0 => "AKCIYA",
                1 => "UCENKA",
                2 => "NEW",
                3 => "BEST",
            ),
            "LABEL_PROP_MOBILE" => array(
                0 => "AKCIYA",
                1 => "UCENKA",
                2 => "NEW",
                3 => "BEST",
            ),
            "LABEL_PROP_POSITION" => "top-center",
            "LAZY_LOAD" => "N",
            "LINE_ELEMENT_COUNT" => "3",
            "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
            "LINK_IBLOCK_ID" => "",
            "LINK_IBLOCK_TYPE" => "",
            "LINK_PROPERTY_SID" => "",
            "LIST_BROWSER_TITLE" => "-",
            "LIST_ENLARGE_PRODUCT" => "STRICT",
            "LIST_META_DESCRIPTION" => "-",
            "LIST_META_KEYWORDS" => "-",
            "LIST_OFFERS_FIELD_CODE" => array(
                0 => "NAME",
                1 => "PREVIEW_PICTURE",
                2 => "DETAIL_PICTURE",
                3 => "",
            ),
            "LIST_OFFERS_LIMIT" => "0",
            "LIST_OFFERS_PROPERTY_CODE" => array(
                0 => "ARTNUMBER",
                1 => "COLOR",
                2 => "COLOR_REF",
                3 => "SIZES_SHOES",
                4 => "SIZES_CLOTHES",
                5 => "MORE_PHOTO",
                6 => "",
            ),
            "LIST_PRODUCT_BLOCKS_ORDER" => "price,props,compare,sku,quantityLimit,quantity,buttons",
            "LIST_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
            "LIST_PROPERTY_CODE" => array(
                0 => "",
                1 => "POKRIRIE",
                2 => "NEWPRODUCT",
                3 => "SALELEADER",
                4 => "SPECIALOFFER",
                5 => "",
            ),
            "LIST_PROPERTY_CODE_MOBILE" => array(
            ),
            "LIST_SHOW_SLIDER" => "Y",
            "LIST_SLIDER_INTERVAL" => "3000",
            "LIST_SLIDER_PROGRESS" => "Y",
            "LOAD_ON_SCROLL" => "N",
            "MAIN_TITLE" => "Наличие на складах",
            "MESSAGES_PER_PAGE" => "10",
            "MESSAGE_404" => "",
            "MESS_BTN_ADD_TO_BASKET" => "В корзину",
            "MESS_BTN_BUY" => "Купить",
            "MESS_BTN_COMPARE" => "Сравнение",
            "MESS_BTN_DETAIL" => "Подробнее",
            "MESS_BTN_SUBSCRIBE" => "Подписаться",
            "MESS_COMMENTS_TAB" => "Комментарии",
            "MESS_DESCRIPTION_TAB" => "Описание",
            "MESS_NOT_AVAILABLE" => "Нет в наличии",
            "MESS_PRICE_RANGES_TITLE" => "Цены",
            "MESS_PROPERTIES_TAB" => "Характеристики",
            "MIN_AMOUNT" => "10",
            "OFFERS_CART_PROPERTIES" => array(
            ),
            "OFFERS_SORT_FIELD" => "sort",
            "OFFERS_SORT_FIELD2" => "id",
            "OFFERS_SORT_ORDER" => "desc",
            "OFFERS_SORT_ORDER2" => "desc",
            "OFFER_ADD_PICT_PROP" => "-",
            "OFFER_TREE_PROPS" => array(
                0 => "COLOR",
                1 => "DLINA",
                2 => "SHIRINA",
                3 => "GABARIT",
            ),
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "special_flat",
            "PAGER_TITLE" => "Товары",
            "PAGE_ELEMENT_COUNT" => "15",
            "PARTIAL_PRODUCT_PROPERTIES" => "N",
            "PATH_TO_SMILE" => "",
            "PRICE_CODE" => array(
                0 => "BASE",
            ),
            "PRICE_VAT_INCLUDE" => "Y",
            "PRICE_VAT_SHOW_VALUE" => "N",
            "PRODUCT_DISPLAY_MODE" => "Y",
            "PRODUCT_ID_VARIABLE" => "id",
            "PRODUCT_PROPERTIES" => array(
                0 => "OBLAST",
            ),
            "PRODUCT_PROPS_VARIABLE" => "prop",
            "PRODUCT_QUANTITY_VARIABLE" => "quantity",
            "PRODUCT_SUBSCRIPTION" => "N",
            "PROPERTY_TOP_FIVE" => "PYATOE",
            "PROPERTY_TOP_FOUR" => "STRANA",
            "PROPERTY_TOP_ONE" => "ARTICUL",
            "PROPERTY_TOP_THREE" => "BREND",
            "PROPERTY_TOP_TWO" => "COLLECTION",
            "PROP_1" => "BREND",
            "PROP_2" => "MATERIAL",
            "PROP_3" => "STRANA",
            "PROP_4" => "",
            "PROP_5" => "COD_TOVARA",
            "PROP_DOP_1" => "",
            "PROP_DOP_1_IMG" => "",
            "PROP_DOP_2" => "",
            "PROP_DOP_2_IMG" => "",
            "PROP_DOP_3" => "",
            "PROP_DOP_3_IMG" => "/images/cmplcolor.gif",
            "QUANTITY_FLOAT" => "N",
            "REVIEW_AJAX_POST" => "Y",
            "SEARCH_CHECK_DATES" => "Y",
            "SEARCH_NO_WORD_LOGIC" => "Y",
            "SEARCH_PAGE_RESULT_COUNT" => "50",
            "SEARCH_RESTART" => "N",
            "SEARCH_USE_LANGUAGE_GUESS" => "Y",
            "SECTIONS_HIDE_SECTION_NAME" => "N",
            "SECTIONS_SHOW_PARENT_NAME" => "N",
            "SECTIONS_VIEW_MODE" => "TILE",
            "SECTION_ADD_TO_BASKET_ACTION" => "ADD",
            "SECTION_BACKGROUND_IMAGE" => "-",
            "SECTION_COUNT_ELEMENTS" => "Y",
            "SECTION_ID_VARIABLE" => "SECTION_ID",
            "SECTION_PODBORKI_OK" => array(
                0 => "PODBORKI",
                1 => "CATALOG",
            ),
            "SECTION_TOP_DEPTH" => "1",
            "SEF_FOLDER" => "/catalog/",
            "SEF_MODE" => "Y",
            "SET_LAST_MODIFIED" => "N",
            "SET_STATUS_404" => "N",
            "SET_TITLE" => "Y",
            "SHOW_404" => "N",
            "SHOW_DEACTIVATED" => "N",
            "SHOW_DISCOUNT_PERCENT" => "Y",
            "SHOW_EMPTY_STORE" => "Y",
            "SHOW_GENERAL_STORE_INFORMATION" => "N",
            "SHOW_LINK_TO_FORUM" => "Y",
            "SHOW_MAX_QUANTITY" => "Y",
            "SHOW_OLD_PRICE" => "Y",
            "SHOW_PRICE_COUNT" => "1",
            "SHOW_TOP_ELEMENTS" => "N",
            "SIDEBAR_DETAIL_SHOW" => "N",
            "SIDEBAR_PATH" => "/catalog/sidebar.php",
            "SIDEBAR_SECTION_SHOW" => "N",
            "STORES" => array(
                0 => "",
                1 => "",
            ),
            "STORE_PATH" => "/store/#store_id#",
            "TEMPLATE_THEME" => "site",
            "TOP_ADD_TO_BASKET_ACTION" => "ADD",
            "URL_TEMPLATES_READ" => "",
            "USER_CONSENT" => "Y",
            "USER_CONSENT_ID" => "1",
            "USER_CONSENT_IS_CHECKED" => "Y",
            "USER_CONSENT_IS_LOADED" => "N",
            "USER_FIELDS" => array(
                0 => "",
                1 => "",
            ),
            "USE_ALSO_BUY" => "Y",
            "USE_BIG_DATA" => "Y",
            "USE_CAPTCHA" => "Y",
            "USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
            "USE_COMPARE" => "Y",
            "USE_ELEMENT_COUNTER" => "Y",
            "USE_ENHANCED_ECOMMERCE" => "Y",
            "USE_FILTER" => "Y",
            "USE_GIFTS_DETAIL" => "N",
            "USE_GIFTS_MAIN_PR_SECTION_LIST" => "N",
            "USE_GIFTS_SECTION" => "N",
            "USE_MAIN_ELEMENT_SECTION" => "N",
            "USE_MIN_AMOUNT" => "N",
            "USE_PRICE_COUNT" => "N",
            "USE_PRODUCT_QUANTITY" => "N",
            "USE_REVIEW" => "N",
            "USE_SALE_BESTSELLERS" => "Y",
            "USE_STORE" => "N",
            "COMPONENT_TEMPLATE" => "santehnika_catalog",
            "COMPOSITE_FRAME_MODE" => "A",
            "COMPOSITE_FRAME_TYPE" => "AUTO",
            "MESS_SHOW_MAX_QUANTITY" => "Наличие",
            "PROP_ARTICUL" => "ARTICUL",
            "TOP_ELEMENT_COUNT" => "9",
            "TOP_LINE_ELEMENT_COUNT" => "3",
            "TOP_ELEMENT_SORT_FIELD" => "sort",
            "TOP_ELEMENT_SORT_ORDER" => "asc",
            "TOP_ELEMENT_SORT_FIELD2" => "id",
            "TOP_ELEMENT_SORT_ORDER2" => "desc",
            "TOP_PROPERTY_CODE" => array(
                0 => "ARTICUL",
                1 => "BREND",
                2 => "COLLECTION",
                3 => "STRANA",
                4 => "",
            ),
            "TOP_OFFERS_FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "TOP_OFFERS_PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "TOP_OFFERS_LIMIT" => "5",
            "TOP_VIEW_MODE" => "SECTION",
            "TOP_PROPERTY_CODE_MOBILE" => array(
                0 => "ARTICUL",
                1 => "BREND",
                2 => "COLLECTION",
                3 => "STRANA",
            ),
            "TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
            "TOP_ENLARGE_PRODUCT" => "STRICT",
            "TOP_SHOW_SLIDER" => "Y",
            "TOP_SLIDER_INTERVAL" => "3000",
            "TOP_SLIDER_PROGRESS" => "N",
            "DATA_LAYER_NAME" => "dataLayer",
            "SEF_URL_TEMPLATES" => array(
                "sections" => "",
                "section" => "#SECTION_CODE_PATH#/",
                "element" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#",
                "compare" => "compare/",
                "smart_filter" => "#SECTION_CODE#/filter/#SMART_FILTER_PATH#/apply/",
            )
        ),
        false
    );?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>