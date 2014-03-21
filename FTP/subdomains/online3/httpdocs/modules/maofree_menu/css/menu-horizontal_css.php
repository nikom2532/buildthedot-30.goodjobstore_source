<?php
require_once dirname(__FILE__) . '/../../../config/config.inc.php';
require_once dirname(__FILE__) . '/../../../init.php';

$maomenu_theme = Configuration::get('MAOMENU_THEME');
$maomenu_width = Configuration::get('MAOMENU_WIDTH_MENU');
$maomenu_height = Configuration::get('MAOMENU_HEIGHT_MENU');
$maomenu_cornerimagewidth = Configuration::get('MAOMENU_CORNER_IMAGE');
$maomenu_widthbutton = Configuration::get('MAOMENU_WIDTH_BUTTON');
$maomenu_widthbranch = Configuration::get('MAOMENU_WIDTH_BRANCH');
$maomenu_arrowscolor = Configuration::get('MAOMENU_ARROWSCOLOR');
$maomenu_rootarrow = Configuration::get('MAOMENU_ROOTARROW');

header('Content-type: text/css; charset=utf-8;');

echo '#maomenucontainer { clear: both; width: ' . $maomenu_width . 'px; height: ' . $maomenu_height . 'px; margin-bottom: ' . Configuration::get('MAOMENU_MARGIN_BOTTOM') . 'px; margin-left: ' . Configuration::get('MAOMENU_MARGIN_LEFT') . 'px; }' . "\n";

echo 'ul.maomenu-horizontal { background: ' . ($maomenu_theme != 'none' ? ('transparent url(../img/menu/' . $maomenu_theme . '/menu.gif) repeat-x') : '#' . Configuration::get('MAOMENU_BACKGROUND')) . '; width: ' . ($maomenu_theme != 'none' ? ($maomenu_width - 2*$maomenu_cornerimagewidth) : $maomenu_width) . 'px; height: ' . $maomenu_height . 'px; line-height: ' . $maomenu_height . 'px; }' . "\n";
echo 'ul.maomenu-horizontal a, ul.maomenu-horizontal a:visited, ul.maomenu-horizontal a:link { text-decoration: none; color: #' . Configuration::get('MAOMENU_A_COLOR') . ' }' . "\n";
echo 'ul.maomenu-horizontal li { border-right: 1px solid #' . Configuration::get('MAOMENU_LI_BORDER_R') . ' }' . "\n";
echo 'ul.maomenu-horizontal li a { padding: 0 ' . ($maomenu_rootarrow ? '' . 11 + $maomenu_widthbutton . 'px 0 ' : '') . $maomenu_widthbutton . 'px; font-size: ' . Configuration::get('MAOMENU_FONT_SIZE_BUTTON') . 'px; }' . "\n";
echo 'ul.maomenu-horizontal li:hover, ul.maomenu-horizontal li.hover { ' . ($maomenu_theme != 'none' ? 'background: transparent url(../img/menu/' . $maomenu_theme . '/hover.gif) repeat-x' : 'background-color: #' . Configuration::get('MAOMENU_LI_HOVER_BACK')) . ' }' . "\n";
echo 'ul.maomenu-horizontal li:hover a, ul.maomenu-horizontal a:focus, ul.maomenu-horizontal a:hover, ul.maomenu-horizontal a:active { color: #' . Configuration::get('MAOMENU_LI_HOVER_A_C') . ' }' . "\n";
if (!(Configuration::get('MAOMENU_LAST_BORDER'))) {echo 'ul.maomenu-horizontal li.last { border-right: none }' . "\n";}
echo 'ul.maomenu-horizontal ul { width: ' . $maomenu_widthbranch . 'px; border: 1px solid #' . Configuration::get('MAOMENU_UL_BORDER') . '; }' . "\n";
echo 'ul.maomenu-horizontal ul li { background-color: #' . Configuration::get('MAOMENU_UL_LI_BACK') . '; height: ' . Configuration::get('MAOMENU_HEIGHT_BRANCH') . 'px; line-height: ' . Configuration::get('MAOMENU_HEIGHT_BRANCH') . 'px; opacity: ' . Configuration::get('MAOMENU_OPACITY') . '; }' . "\n";
echo 'ul.maomenu-horizontal ul li:hover, ul.maomenu-horizontal ul li.hover { background: #' . Configuration::get('MAOMENU_UL_LI_HOVER_BACK') . ' }' . "\n";
echo 'ul.maomenu-horizontal li:hover ul li a, ul.maomenu-horizontal ul li a, ul.maomenu-horizontal ul li a:visited, ul.maomenu-horizontal ul li a:link { color: #' . Configuration::get('MAOMENU_UL_LI_A_COLOR') . '; padding-left: ' . Configuration::get('MAOMENU_PAD_TEXT_BRANCH') . 'px; padding-right: 20px; font-size: ' . Configuration::get('MAOMENU_FONT_SIZE_BRANCH') . 'px }' . "\n";
echo 'ul.maomenu-horizontal li:hover ul li a:hover { color: #' . Configuration::get('MAOMENU_LI_UL_LI_A_HOVER') . ' }' . "\n";

echo 'ul.maomenu-horizontal li a.selected-a-maomenu { color: #' . Configuration::get('MAOMENU_LI_A_SELECT_C') . ' }' . "\n";
echo 'ul.maomenu-horizontal li.rootselected-maomenu { ' . ($maomenu_theme != 'none' ? 'background: transparent url(../img/menu/' . $maomenu_theme . '/selected.gif) repeat-x' : 'background-color: #' . Configuration::get('MAOMENU_LI_BRANCHSEL_B')) . ' }' . "\n";
echo 'ul.maomenu-horizontal li.rootselected-maomenu:hover { ' . ($maomenu_theme != 'none' ? 'background: transparent url(../img/menu/' . $maomenu_theme . '/hover-selected.gif) repeat-x' : 'background-color: #' . Configuration::get('MAOMENU_LI_BRANCHSEL_H_B')) . ' }' . "\n";
echo 'ul.maomenu-horizontal li.rootselected-maomenu:hover a.selected-a-maomenu { color: #' . Configuration::get('MAOMENU_LI_BRANSEL_H_A_C') . ' }' . "\n";
echo 'ul.maomenu-horizontal li:hover ul li a.selected-a-maomenu, ul.maomenu-horizontal ul li a.selected-a-maomenu:visited, ul.maomenu-horizontal ul li a.selected-a-maomenu:link { color: #' . Configuration::get('MAOMENU_UL_LI_A_SELECT_C') . '; }' . "\n";
echo 'ul.maomenu-horizontal li:hover ul li.selected-maomenu, ul.maomenu-horizontal ul li.selected-maomenu { background-color: #' . Configuration::get('MAOMENU_UL_LI_BRANSEL_B') . '; }' . "\n";
echo 'ul.maomenu-horizontal li:hover ul li.selected-maomenu:hover { background: #' . Configuration::get('MAOMENU_UL_LI_BRANSEL_H') . '; }' . "\n";
echo 'ul.maomenu-horizontal li:hover ul li a.selected-a-maomenu:hover, ul.maomenu-horizontal li:hover ul li.selected-maomenu:hover a.selected-a-maomenu { color: #' . Configuration::get('MAOMENU_UL_LI_A_SELECT_H') . '; }' . "\n";

echo 'ul.maomenu-horizontal li.maosearch { border-right: 0; width: 180px; height: ' . Configuration::get('MAOMENU_HEIGHT_MENU') . 'px; float:right; background-image: none; }' . "\n";
echo 'ul.maomenu-horizontal li.maosearch input.mao_search_query { height: ' . Configuration::get('MAOMENU_SEARCH_HEIGHT') . 'px; width: 120px; font-size: ' . Configuration::get('MAOMENU_FONT_SIZE_BRANCH') . 'px; padding-left: 5px; margin-left: 10px; vertical-align: middle; }' . "\n";
echo 'ul.maomenu-horizontal li.maosearch input.mao_search_image { vertical-align: middle; border-style: hidden; width: ' . Configuration::get('MAOMENU_SEARCH_HEIGHT') . 'px; height: ' . Configuration::get('MAOMENU_SEARCH_HEIGHT') . 'px; }' . "\n";

echo '#maomenucontainer .maomenu-left { float: left; width: ' . $maomenu_cornerimagewidth . 'px; height: ' . $maomenu_height . 'px; background: transparent url(../img/menu/' . $maomenu_theme . '/left.gif) no-repeat left center; }' . "\n";
echo '#maomenucontainer .maomenu-right { float: right; width: ' . $maomenu_cornerimagewidth . 'px; height: ' . $maomenu_height . 'px; background: transparent url(../img/menu/' . $maomenu_theme . '/right.gif) no-repeat right center; }' . "\n";

echo 'ul.maomenu-horizontal li.maomenu-home { border-right: 0; float: left; width: ' . $maomenu_height . 'px; height: ' . $maomenu_height . 'px; background: transparent ' . ($maomenu_theme != 'none' ? 'url(../img/menu/' . $maomenu_theme . '/home.gif)' : 'url(../img/menu/home.gif)') . ' no-repeat center; }' . "\n";

if ($maomenu_rootarrow) {
echo '
ul.maomenu-horizontal span.arrow-maomenu {
   background-image: ' . ($maomenu_arrowscolor == 'black' ? 'url(../img/arrow/nav-arrow-down.png)' : 'url(../img/arrow/nav-arrow-down-white.png)') . ';
   background-position: 100% 50%;
   background-repeat: no-repeat;
   position: absolute;
   display:	block;
   right: 3px;
   top: ' . Configuration::get('MAOMENU_TOP_ROOTARROW') . 'px;
   width: 11px;
   height: 10px;
}
' . "\n";
}

echo '
ul.maomenu-horizontal ul span.arrow-maomenu {   background-image: ' . ($maomenu_arrowscolor == 'black' ? 'url(../img/arrow/nav-arrow-right.png)' : 'url(../img/arrow/nav-arrow-right-white.png)') . ';
   background-position: 100% 50%;
   background-repeat: no-repeat;
   position: absolute;
   display:	block;
   right: 5px;
   top: ' . Configuration::get('MAOMENU_TOP_BRANCHARROW') . 'px;
   width: 12px;
   height: 15px;
}
' . "\n";

echo 'ul.maomenu-horizontal li.noarrow-maomenu a {	padding-right: ' . $maomenu_widthbutton . 'px; }' . "\n";