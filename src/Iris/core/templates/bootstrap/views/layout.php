<?php
/**********************************************************************
Параметры стиля

все параметры доступны в глобальном массиве javascrript g_layout_params
если добавить новый параметр, то он также будет доступен из javascript,
в массиве массиве g_layout_params
**********************************************************************/


/********* параметры, используемые на сервере *********/

global $LAYOUT_PARAMS;

// максимальное количество столбцов в списке автозавершения. Значение по умолчанию: 7
$LAYOUT_PARAMS['AUTOCOMPLETE_ROWS_COUNT'] = 7;

// тип меню в данном стиле
// Доступные значения: vertical, horizontal-short, [horizontal-full]
$LAYOUT_PARAMS['MENU_TYPE'] = 'horizontal-full';//'vertical';

// определяет, показывать ли закладки на карточках, если атрибут show_card_header не указан в xml карточки
$LAYOUT_PARAMS['SHOW_CARD_TOP_PANEL_DEFAULT'] = 'yes';

// определяет, показывать ли закладки на карточках, если атрибут show_card_details не указан в xml карточки
$LAYOUT_PARAMS['SHOW_CARD_DETAILS_DEFAULT'] = 'yes';


/********* параметры, используемые на клиенте *********/


// количество строк в реестре записей
$LAYOUT_PARAMS['GRID_ROWS_COUNT'] = 100;

// количество строк в реестре записей, который открывается в окне
$LAYOUT_PARAMS['WINDOW_ROWS_COUNT'] = 20;

// количество строк реестра у закладки
$LAYOUT_PARAMS['DETAIL_ROWS_COUNT'] = 50;

// wiredDrag
$LAYOUT_PARAMS['cardwnd_wiredDrag'] = false;
$LAYOUT_PARAMS['gridwnd_wiredDrag'] = false;

$LAYOUT_PARAMS['cardwnd_shownestedtabs'] = true;

//имя текущего стиля (используется в index.js для указания пути к картинки загрузки для карточки). задается в ядре
//$LAYOUT_PARAMS['style_name'] = '';

//mnv
//отступы карточки от краев
$LAYOUT_PARAMS['card_offset_left'] = 0;
$LAYOUT_PARAMS['card_offset_right'] = 0;
$LAYOUT_PARAMS['card_offset_top'] = 22;
$LAYOUT_PARAMS['card_offset_bottom'] = 0;

// отображать ли пустые напоминания. Доступные значения: 0 или 1
$LAYOUT_PARAMS['show_empty_remind'] = 1;

// максимальная высота карточки определяется как высота окна документа - card_maxheigth_adjustment.
// в card_maxheigth_adjustment считается высота заголовка и футера карточки и панели задач, куда сворачиваются окна системы
$LAYOUT_PARAMS['card_maxheigth_adjustment'] = 80;

// параметры ckeditor
$LAYOUT_PARAMS['ckeditor_uicolor'] = '#D5D5D5';
$LAYOUT_PARAMS['ckeditor_skin'] = 'kama';

// параметры growler
$LAYOUT_PARAMS['growler_default_theme'] = 'macosx';

// коофиценты для корректировки высоты карточки
// Y0 - высота карточки в xml
// Новая высота будет вычисляться по формуле Y = k*Y0 + b
// $LAYOUT_PARAMS['card_height_k'] = 1.05;
// $LAYOUT_PARAMS['card_height_b'] = 28;
$LAYOUT_PARAMS['card_height_k'] = 1.62;
$LAYOUT_PARAMS['card_height_b'] = 5;
$LAYOUT_PARAMS['grid_height_k'] = 1.3;
$LAYOUT_PARAMS['grid_height_b'] = 37;
