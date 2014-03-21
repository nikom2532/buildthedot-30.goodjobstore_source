<?php

/*Copyright 2011 maofree  email: msecco@gmx.com

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 3, as 
published by the Free Software Foundation.

This file can't be removed. This module can't be sold.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see <http://www.gnu.org/licenses/>.

*/

if (!defined('_PS_VERSION_'))
	exit;

class Maofree_Menu extends Module
{    
    public function __construct()
    {
        $this->name = 'maofree_menu';
        $this->tab = 'others';
        $this->version = '1.0';
        $this->author = 'maofree';
	  	  $this->need_instance = 0;
        
        parent::__construct();

        $this->displayName = $this->l('Horizontal Menu');
        $this->description = $this->l('Adds an horizontal menu to your web shop, with more than 50 settings');
    }

	public function install()
	{
		if (!parent::install() ||
		   !$this->registerHook('top') ||
		   !$this->registerHook('header') ||
		   !Configuration::updateValue('MAOMENU_MAX_DEPTH', 5) ||
			!Configuration::updateValue('MAOMENU_BACKGROUND', 'CCC') ||
			!Configuration::updateValue('MAOMENU_A_COLOR', '000') ||
			!Configuration::updateValue('MAOMENU_LI_BORDER_R', '9BA4A9') ||
			!Configuration::updateValue('MAOMENU_LI_HOVER_BACK', 'FFA500') ||
			!Configuration::updateValue('MAOMENU_LI_BRANCHSEL_B', 'A52A2A') ||
			!Configuration::updateValue('MAOMENU_LI_A_SELECT_C', 'FFF') ||
			!Configuration::updateValue('MAOMENU_LI_BRANCHSEL_H_B', '7C7C7C') ||
			!Configuration::updateValue('MAOMENU_LI_BRANSEL_H_A_C', '000') ||
			!Configuration::updateValue('MAOMENU_LI_HOVER_A_C', '474747') ||
			!Configuration::updateValue('MAOMENU_UL_LI_BACK', 'F5F5DC') ||
			!Configuration::updateValue('MAOMENU_UL_BORDER', 'CCC') ||
			!Configuration::updateValue('MAOMENU_UL_LI_HOVER_BACK', 'FFFF00') ||
			!Configuration::updateValue('MAOMENU_UL_LI_A_COLOR', '008000') ||
			!Configuration::updateValue('MAOMENU_LI_UL_LI_A_HOVER', '800080') ||
			!Configuration::updateValue('MAOMENU_UL_LI_A_SELECT_C', 'FF0000') ||
			!Configuration::updateValue('MAOMENU_UL_LI_BRANSEL_B', 'A52A2A') ||
			!Configuration::updateValue('MAOMENU_UL_LI_BRANSEL_H', '008000') ||
			!Configuration::updateValue('MAOMENU_UL_LI_A_SELECT_H', 'FFA500') ||
		   !Configuration::updateValue('MAOMENU_WIDTH_MENU', 950) ||
		   !Configuration::updateValue('MAOMENU_HEIGHT_MENU', 35) ||
		   !Configuration::updateValue('MAOMENU_MARGIN_BOTTOM', 20) ||
		   !Configuration::updateValue('MAOMENU_MARGIN_LEFT', 13) ||
		   !Configuration::updateValue('MAOMENU_OPACITY', 0.97) ||
		   !Configuration::updateValue('MAOMENU_CORNER_IMAGE', 6) ||
		   !Configuration::updateValue('MAOMENU_WIDTH_BUTTON', 10) ||
		   !Configuration::updateValue('MAOMENU_FONT_SIZE_BUTTON', 14) ||
		   !Configuration::updateValue('MAOMENU_WIDTH_BRANCH', 190) ||
		   !Configuration::updateValue('MAOMENU_HEIGHT_BRANCH', 30) ||
		   !Configuration::updateValue('MAOMENU_PAD_TEXT_BRANCH', 10) ||
		   !Configuration::updateValue('MAOMENU_FONT_SIZE_BRANCH', 12) ||
		   !Configuration::updateValue('MAOMENU_SEARCH', 1) ||
		   !Configuration::updateValue('MAOMENU_ROOTARROW', 1) ||
		   !Configuration::updateValue('MAOMENU_TOP_ROOTARROW', 13) ||
		   !Configuration::updateValue('MAOMENU_TOP_BRANCHARROW', 8) ||
		   !Configuration::updateValue('MAOMENU_HOME', 1) ||
		   !Configuration::updateValue('MAOMENU_MANUFACTURES', 1) ||
		   !Configuration::updateValue('MAOMENU_SUPPLIERS', 0) ||
		   !Configuration::updateValue('MAOMENU_NEWPRODUCTS', 0) ||
		   !Configuration::updateValue('MAOMENU_PRICESDROP', 0) ||
		   !Configuration::updateValue('MAOMENU_BESTSALES', 0) ||
		   !Configuration::updateValue('MAOMENU_INFORMATION', 1) ||
		   !Configuration::updateValue('MAOMENU_STORESMAP', 0) ||
		   !Configuration::updateValue('MAOMENU_SITEMAP', 1) ||
		   !Configuration::updateValue('MAOMENU_CONTACTUS', 1) ||
		   !Configuration::updateValue('MAOMENU_SEARCH_HEIGHT', 25) ||
		   !Configuration::updateValue('MAOMENU_LAST_BORDER', 1) ||
		   !Configuration::updateValue('MAOMENU_THEME', 'gray') ||
		   !Configuration::updateValue('MAOMENU_ARROWSCOLOR', 'black') ||
		   !Configuration::updateValue('MAOMENU_MODE_CAT', 'list') ||
		   !Configuration::updateValue('MAOMENU_ITEMS_BY', 'name')
		)
			return false;
			
		return true;
	}
	
	public function uninstall()
	{
		if (!Configuration::deleteByName('MAOMENU_MAX_DEPTH') ||
         !Configuration::deleteByName('MAOMENU_ITEMS_BY') ||
	      !Configuration::deleteByName('MAOMENU_BACKGROUND') ||
	      !Configuration::deleteByName('MAOMENU_A_COLOR') ||
	      !Configuration::deleteByName('MAOMENU_LI_BORDER_R') ||
	      !Configuration::deleteByName('MAOMENU_LI_HOVER_BACK') ||
	      !Configuration::deleteByName('MAOMENU_LI_BRANCHSEL_B') ||
	      !Configuration::deleteByName('MAOMENU_LI_A_SELECT_C') ||
	      !Configuration::deleteByName('MAOMENU_LI_BRANCHSEL_H_B') ||
	      !Configuration::deleteByName('MAOMENU_LI_BRANSEL_H_A_C') ||
	      !Configuration::deleteByName('MAOMENU_LI_HOVER_A_C') ||
	      !Configuration::deleteByName('MAOMENU_UL_LI_BACK') ||
	      !Configuration::deleteByName('MAOMENU_UL_BORDER') ||
	      !Configuration::deleteByName('MAOMENU_UL_LI_HOVER_BACK') ||
	      !Configuration::deleteByName('MAOMENU_UL_LI_A_COLOR') ||
	      !Configuration::deleteByName('MAOMENU_LI_UL_LI_A_HOVER') ||
	      !Configuration::deleteByName('MAOMENU_UL_LI_A_SELECT_C') ||
	      !Configuration::deleteByName('MAOMENU_UL_LI_BRANSEL_B') ||
	      !Configuration::deleteByName('MAOMENU_UL_LI_BRANSEL_H') ||
	      !Configuration::deleteByName('MAOMENU_UL_LI_A_SELECT_H') ||
         !Configuration::deleteByName('MAOMENU_WIDTH_MENU') ||
         !Configuration::deleteByName('MAOMENU_HEIGHT_MENU') ||
         !Configuration::deleteByName('MAOMENU_MARGIN_BOTTOM') ||
         !Configuration::deleteByName('MAOMENU_MARGIN_LEFT') ||
         !Configuration::deleteByName('MAOMENU_OPACITY') ||
         !Configuration::deleteByName('MAOMENU_CORNER_IMAGE') ||
         !Configuration::deleteByName('MAOMENU_WIDTH_BUTTON') ||
         !Configuration::deleteByName('MAOMENU_FONT_SIZE_BUTTON') ||
         !Configuration::deleteByName('MAOMENU_WIDTH_BRANCH') ||
         !Configuration::deleteByName('MAOMENU_HEIGHT_BRANCH') ||
         !Configuration::deleteByName('MAOMENU_PAD_TEXT_BRANCH') ||
         !Configuration::deleteByName('MAOMENU_FONT_SIZE_BRANCH') ||
         !Configuration::deleteByName('MAOMENU_SEARCH') ||
         !Configuration::deleteByName('MAOMENU_ROOTARROW') ||
         !Configuration::deleteByName('MAOMENU_TOP_ROOTARROW') ||
         !Configuration::deleteByName('MAOMENU_TOP_BRANCHARROW') ||
         !Configuration::deleteByName('MAOMENU_HOME') ||
         !Configuration::deleteByName('MAOMENU_MANUFACTURES') ||
         !Configuration::deleteByName('MAOMENU_SUPPLIERS') ||
         !Configuration::deleteByName('MAOMENU_NEWPRODUCTS') ||
         !Configuration::deleteByName('MAOMENU_PRICESDROP') ||
         !Configuration::deleteByName('MAOMENU_BESTSALES') ||
         !Configuration::deleteByName('MAOMENU_INFORMATION') ||
         !Configuration::deleteByName('MAOMENU_STORESMAP') ||
         !Configuration::deleteByName('MAOMENU_SITEMAP') ||
         !Configuration::deleteByName('MAOMENU_CONTACTUS') ||
         !Configuration::deleteByName('MAOMENU_SEARCH_HEIGHT') ||
         !Configuration::deleteByName('MAOMENU_LAST_BORDER') ||
         !Configuration::deleteByName('MAOMENU_THEME') ||
         !Configuration::deleteByName('MAOMENU_ARROWSCOLOR') ||
         !Configuration::deleteByName('MAOMENU_MODE_CAT') ||
		   !parent::uninstall())
			return false;
			
		return true;
	}

	public function getContent()
	{
		$output = '<style type="text/css">.margin-form { padding: 0 0 1em 270px; margin-top:10px } label { width: 260px } div.divleftmenu { width:440px;float:left;margin:10px 0; } div.divrightmenu { width:440px;float:right;margin:10px 0; } label.labelmenu { width:270px; font-size: 11px; }</style>';
		$output .= '<link type="text/css" href="'._MODULE_DIR_.$this->name.'/css/ui-lightness/jquery-ui-1.8.13.custom.css" rel="stylesheet" />';
      $output .= '<link href="'._MODULE_DIR_.$this->name.'/js/uploadify/uploadify.css" type="text/css" rel="stylesheet" />';
      $output .= '<script type="text/javascript">var absolute_url = "'._MODULE_DIR_.$this->name.'";</script>';
      $output .= '<script type="text/javascript" src="'._MODULE_DIR_.$this->name.'/js/uploadify/swfobject.js"></script>';
      $output .= '<script type="text/javascript" src="'._MODULE_DIR_.$this->name.'/js/uploadify/jquery.uploadify.v2.1.4.min.js"></script>';
      $output .= '<script type="text/javascript" src="'._MODULE_DIR_.$this->name.'/js/settings-uploader.js"></script>';
		$output .= '<script type="text/javascript" src="'._MODULE_DIR_.$this->name.'/js/jquery-ui-1.8.13.custom.min.js"></script>';
		$output .= '<script type="text/javascript" src="'._MODULE_DIR_.$this->name.'/js/colorPicker/colorPicker.js"></script>';
		$output .= '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitMenu'))
		{
			$background = Tools::getValue('background');
			$acolor = Tools::getValue('acolor');
			$liborderr = Tools::getValue('liborderr');
			$lihoverback = Tools::getValue('lihoverback');
			$libranchselectedb = Tools::getValue('libranchselectedb');
			$liaselectc = Tools::getValue('liaselectc');
			$libranchselectedhb = Tools::getValue('libranchselectedhb');
			$libranchselectedhaselectedc = Tools::getValue('libranchselectedhaselectedc');
			$lihoverac = Tools::getValue('lihoverac');
			$ulliback = Tools::getValue('ulliback');
			$ulborder = Tools::getValue('ulborder');
			$ullihoverback = Tools::getValue('ullihoverback');
			$ulliacolor = Tools::getValue('ulliacolor');
			$liulliahover = Tools::getValue('liulliahover');
			$ulliaselectedc = Tools::getValue('ulliaselectedc');
			$ullibranchselectedb = Tools::getValue('ullibranchselectedb');
			$ullibranchselectedhb = Tools::getValue('ullibranchselectedhb');
			$ulliaselectedhc = Tools::getValue('ulliaselectedhc');
			$arrangedby = Tools::getValue('arrangedby');
			$fontsizebranch = (float)Tools::getValue('fontsizebranch');
			$paddingtextbranch = (float)Tools::getValue('paddingtextbranch');
			$heightbranch = (float)Tools::getValue('heightbranch');
			$widthbranch = (float)Tools::getValue('widthbranch');
			$widthbutton = (float)Tools::getValue('widthbutton');
			$fontsizebutton = (float)Tools::getValue('fontsizebutton');
			$widthmenu = (int)Tools::getValue('widthmenu');
			$heightmenu = (float)Tools::getValue('heightmenu');
			$marginbottom = (float)Tools::getValue('marginbottom');
			$marginleft = (float)Tools::getValue('marginleft');
			$opacity = (float)Tools::getValue('opacity');
			$cornerimage = (float)Tools::getValue('cornerimage');
			$search = (int)Tools::getValue('search');
			$rootarrow = (int)Tools::getValue('rootarrow');
			$toprootarrow = (float)Tools::getValue('toprootarrow');
			$topbrancharrow = (float)Tools::getValue('topbrancharrow');
			$home = (int)Tools::getValue('home');
			$manufactures = (int)Tools::getValue('manufactures');
			$suppliers = (int)Tools::getValue('suppliers');
			$newproducts = (int)Tools::getValue('newproducts');
			$pricesdrop = (int)Tools::getValue('pricesdrop');
			$bestsales = (int)Tools::getValue('bestsales');
			$information = (int)Tools::getValue('information');
			$storesmap = (int)Tools::getValue('storesmap');
			$sitemap = (int)Tools::getValue('sitemap');
			$contactus = (int)Tools::getValue('contactus');
			$searchinputheight = (float)Tools::getValue('searchinputheight');
			$lastbordermenu = (int)Tools::getValue('lastbordermenu');
			$menutheme = Tools::getValue('menutheme');
			$arrowscolor = Tools::getValue('arrowscolor');
			$modecatview = Tools::getValue('modecatview');
			$maxDepth = (int)Tools::getValue('maxDepth');
			if (!$maxDepth OR $maxDepth < 0 OR !Validate::isInt($maxDepth))
				$output .= '<div class="alert error">'.$this->l('Maximum depth: Invalid number.').'</div>';
			elseif (!$widthmenu OR $widthmenu <= 0 OR !Validate::isInt($widthmenu))
				$output .= '<div class="alert error">'.$this->l('Width: Invalid number.').'</div>';
			elseif (!Validate::isUnsignedFloat($heightmenu))
				$output .= '<div class="alert error">'.$this->l('Height: Invalid number.').'</div>';
			elseif (!Validate::isUnsignedFloat($marginbottom))
				$output .= '<div class="alert error">'.$this->l('Margin-bottom: Invalid number.').'</div>';
			elseif (!Validate::isUnsignedFloat($marginleft))
				$output .= '<div class="alert error">'.$this->l('Margin-left: Invalid number.').'</div>';
			elseif (!Validate::isUnsignedFloat($opacity))
				$output .= '<div class="alert error">'.$this->l('Opacity: Invalid number.').'</div>';
			elseif (!Validate::isUnsignedFloat($cornerimage))
				$output .= '<div class="alert error">'.$this->l('Width of Corner Images: Invalid number.').'</div>';
			elseif (!Validate::isUnsignedFloat($widthbutton))
				$output .= '<div class="alert error">'.$this->l('Button Width: Invalid number.').'</div>';
			elseif (!Validate::isUnsignedFloat($fontsizebutton))
				$output .= '<div class="alert error">'.$this->l('Button Font-size: Invalid number.').'</div>';
			elseif (!Validate::isUnsignedFloat($widthbranch))
				$output .= '<div class="alert error">'.$this->l('Branches Width: Invalid number.').'</div>';
			elseif (!Validate::isUnsignedFloat($heightbranch))
				$output .= '<div class="alert error">'.$this->l('Branch Height: Invalid number.').'</div>';
			elseif (!Validate::isUnsignedFloat($paddingtextbranch))
				$output .= '<div class="alert error">'.$this->l('Padding-left of branch text: Invalid number.').'</div>';
			elseif (!Validate::isUnsignedFloat($fontsizebranch))
				$output .= '<div class="alert error">'.$this->l('Branches Font-size: Invalid number.').'</div>';
			elseif (!Validate::isUnsignedFloat($toprootarrow))
				$output .= '<div class="alert error">'.$this->l('The Top of Root Arrow: Invalid number.').'</div>';
			elseif (!Validate::isUnsignedFloat($topbrancharrow))
				$output .= '<div class="alert error">'.$this->l('The Top of Branch Arrow: Invalid number.').'</div>';
			elseif ($search != 0 AND $search != 1)
				$output .= '<div class="alert error">'.$this->l('Search: Invalid choice.').'</div>';
			elseif ($rootarrow != 0 AND $rootarrow != 1)
				$output .= '<div class="alert error">'.$this->l('Root Arrow: Invalid choice.').'</div>';
			elseif ($home != 0 AND $home != 1)
				$output .= '<div class="alert error">'.$this->l('Home: Invalid choice.').'</div>';
			elseif ($manufactures != 0 AND $manufactures != 1)
				$output .= '<div class="alert error">'.$this->l('Manufactures: Invalid choice.').'</div>';
			elseif ($suppliers != 0 AND $suppliers != 1)
				$output .= '<div class="alert error">'.$this->l('Suppliers: Invalid choice.').'</div>';
			elseif ($newproducts != 0 AND $newproducts != 1)
				$output .= '<div class="alert error">'.$this->l('New Products: Invalid choice.').'</div>';
			elseif ($pricesdrop != 0 AND $pricesdrop != 1)
				$output .= '<div class="alert error">'.$this->l('Prices Drop: Invalid choice.').'</div>';
			elseif ($bestsales != 0 AND $bestsales != 1)
				$output .= '<div class="alert error">'.$this->l('Best Sales: Invalid choice.').'</div>';
			elseif ($information != 0 AND $information != 1)
				$output .= '<div class="alert error">'.$this->l('Information: Invalid choice.').'</div>';
			elseif ($storesmap != 0 AND $storesmap != 1)
				$output .= '<div class="alert error">'.$this->l('Stores map: Invalid choice.').'</div>';
			elseif ($sitemap != 0 AND $sitemap != 1)
				$output .= '<div class="alert error">'.$this->l('Sitemap: Invalid choice.').'</div>';
			elseif ($contactus != 0 AND $contactus != 1)
				$output .= '<div class="alert error">'.$this->l('Contact us: Invalid choice.').'</div>';
			elseif ((!Validate::isUnsignedFloat($searchinputheight)) OR ($searchinputheight > $heightmenu))
				$output .= '<div class="alert error">'.$this->l('Height of input search: Invalid number (it must be less than height of menu).').'</div>';
			elseif ($lastbordermenu != 0 AND $lastbordermenu != 1)
				$output .= '<div class="alert error">'.$this->l('Border-right of last button: Invalid choice.').'</div>';
			else
			{
				Configuration::updateValue('MAOMENU_ITEMS_BY', $arrangedby);
				Configuration::updateValue('MAOMENU_MAX_DEPTH', (int)($maxDepth));
				Configuration::updateValue('MAOMENU_WIDTH_MENU', (int)($widthmenu));
				Configuration::updateValue('MAOMENU_HEIGHT_MENU', (float)($heightmenu));
				Configuration::updateValue('MAOMENU_MARGIN_BOTTOM', (float)($marginbottom));
				Configuration::updateValue('MAOMENU_MARGIN_LEFT', (float)($marginleft));
				Configuration::updateValue('MAOMENU_OPACITY', (float)($opacity));
				Configuration::updateValue('MAOMENU_CORNER_IMAGE', (float)($cornerimage));
				Configuration::updateValue('MAOMENU_WIDTH_BUTTON', (float)($widthbutton));
				Configuration::updateValue('MAOMENU_FONT_SIZE_BUTTON', (float)($fontsizebutton));
				Configuration::updateValue('MAOMENU_WIDTH_BRANCH', (float)($widthbranch));
				Configuration::updateValue('MAOMENU_HEIGHT_BRANCH', (float)($heightbranch));
				Configuration::updateValue('MAOMENU_PAD_TEXT_BRANCH', (float)($paddingtextbranch));
				Configuration::updateValue('MAOMENU_FONT_SIZE_BRANCH', (float)($fontsizebranch));
				Configuration::updateValue('MAOMENU_BACKGROUND', $background);
				Configuration::updateValue('MAOMENU_A_COLOR', $acolor);
				Configuration::updateValue('MAOMENU_LI_BORDER_R', $liborderr);
				Configuration::updateValue('MAOMENU_LI_HOVER_BACK', $lihoverback);
				Configuration::updateValue('MAOMENU_LI_BRANCHSEL_B', $libranchselectedb);
				Configuration::updateValue('MAOMENU_LI_A_SELECT_C', $liaselectc);
				Configuration::updateValue('MAOMENU_LI_BRANCHSEL_H_B', $libranchselectedhb);
				Configuration::updateValue('MAOMENU_LI_BRANSEL_H_A_C', $libranchselectedhaselectedc);
				Configuration::updateValue('MAOMENU_LI_HOVER_A_C', $lihoverac);
				Configuration::updateValue('MAOMENU_UL_LI_BACK', $ulliback);
				Configuration::updateValue('MAOMENU_UL_BORDER', $ulborder);
				Configuration::updateValue('MAOMENU_UL_LI_HOVER_BACK', $ullihoverback);
				Configuration::updateValue('MAOMENU_UL_LI_A_COLOR', $ulliacolor);
				Configuration::updateValue('MAOMENU_LI_UL_LI_A_HOVER', $liulliahover);
				Configuration::updateValue('MAOMENU_UL_LI_A_SELECT_C', $ulliaselectedc);
				Configuration::updateValue('MAOMENU_UL_LI_BRANSEL_B', $ullibranchselectedb);
				Configuration::updateValue('MAOMENU_UL_LI_BRANSEL_H', $ullibranchselectedhb);
				Configuration::updateValue('MAOMENU_UL_LI_A_SELECT_H', $ulliaselectedhc);
				Configuration::updateValue('MAOMENU_SEARCH', $search);
				Configuration::updateValue('MAOMENU_ROOTARROW', $rootarrow);
				Configuration::updateValue('MAOMENU_TOP_ROOTARROW', (float)($toprootarrow));
				Configuration::updateValue('MAOMENU_TOP_BRANCHARROW', (float)($topbrancharrow));
				Configuration::updateValue('MAOMENU_HOME', $home);
				Configuration::updateValue('MAOMENU_MANUFACTURES', $manufactures);
				Configuration::updateValue('MAOMENU_SUPPLIERS', $suppliers);
				Configuration::updateValue('MAOMENU_NEWPRODUCTS', $newproducts);
				Configuration::updateValue('MAOMENU_PRICESDROP', $pricesdrop);
				Configuration::updateValue('MAOMENU_BESTSALES', $bestsales);
				Configuration::updateValue('MAOMENU_INFORMATION', $information);
				Configuration::updateValue('MAOMENU_STORESMAP', $storesmap);
				Configuration::updateValue('MAOMENU_SITEMAP', $sitemap);
				Configuration::updateValue('MAOMENU_CONTACTUS', $contactus);
				Configuration::updateValue('MAOMENU_SEARCH_HEIGHT', (float)($searchinputheight));
				Configuration::updateValue('MAOMENU_LAST_BORDER', $lastbordermenu);
				Configuration::updateValue('MAOMENU_THEME', $menutheme);
				Configuration::updateValue('MAOMENU_ARROWSCOLOR', $arrowscolor);
				Configuration::updateValue('MAOMENU_MODE_CAT', $modecatview);
				$output .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" /> '.$this->l('Settings updated').'</div>';
			}
		}
		return $output.$this->displayForm();
	}


	public function displayForm()
	{
		return '
		<fieldset>
			<legend><img src="'.$this->_path.'logo.gif" alt="maofree\'s module" title="maofree\'s module" />maofree</legend>		
			<a href="http://www.maofree-developer.com" target="_blank"><img src="'._MODULE_DIR_.$this->name.'/img/donate.png" alt="maofree\'s website" title="'.$this->l('Do you need some help? (click here)').'" /></a>
			<div style="float:right;width:70%;">
				<h3 style="color:lightCoral;">'.$this->l('If you like my job, you could support me with a donation').'.</h3>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="MEF3Z7XDHQZF8">
					<input type="image" src="https://www.paypal.com/en_GB/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="Paypal" style="margin-top:20px;">
					<img alt="" border="0" src="https://www.paypal.com/it_IT/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
		</fieldset>		

		<form action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" method="post">
			<fieldset>
				<legend><img src="'.$this->_path.'logo.gif" alt="maofree\'s module" title="maofree\'s module" />'.$this->l('Settings').'</legend>

				<br /><h2>'.$this->l('General settings').':</h2><br />
				
				<label style="padding-top: 10px">'.$this->l('Home').':</label>
				<div class="margin-form">
					<input type="radio" name="home" id="home_on" value="1" '.(Tools::getValue('home', Configuration::get('MAOMENU_HOME')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="home_on"><img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="home" id="home_off" value="0" '.(!Tools::getValue('home', Configuration::get('MAOMENU_HOME')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="home_off"><img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
				</div><br />
				
				<label style="padding-top: 10px">'.$this->l('Manufactures').':</label>
				<div class="margin-form">
					<input type="radio" name="manufactures" id="manufactures_on" value="1" '.(Tools::getValue('manufactures', Configuration::get('MAOMENU_MANUFACTURES')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="manufactures_on"><img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="manufactures" id="manufactures_off" value="0" '.(!Tools::getValue('manufactures', Configuration::get('MAOMENU_MANUFACTURES')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="manufactures_off"><img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
				</div><br />
				
				<label style="padding-top: 10px">'.$this->l('Suppliers').':</label>
				<div class="margin-form">
					<input type="radio" name="suppliers" id="suppliers_on" value="1" '.(Tools::getValue('suppliers', Configuration::get('MAOMENU_SUPPLIERS')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="suppliers_on"><img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="suppliers" id="suppliers_off" value="0" '.(!Tools::getValue('suppliers', Configuration::get('MAOMENU_SUPPLIERS')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="suppliers_off"><img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
				</div><br />
				
				<label style="padding-top: 10px">'.$this->l('New Products').':</label>
				<div class="margin-form">
					<input type="radio" name="newproducts" id="newproducts_on" value="1" '.(Tools::getValue('newproducts', Configuration::get('MAOMENU_NEWPRODUCTS')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="newproducts_on"><img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="newproducts" id="newproducts_off" value="0" '.(!Tools::getValue('newproducts', Configuration::get('MAOMENU_NEWPRODUCTS')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="newproducts_off"><img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
				</div><br />
				
				<label style="padding-top: 10px">'.$this->l('Prices Drop').':</label>
				<div class="margin-form">
					<input type="radio" name="pricesdrop" id="pricesdrop_on" value="1" '.(Tools::getValue('pricesdrop', Configuration::get('MAOMENU_PRICESDROP')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="pricesdrop_on"><img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="pricesdrop" id="pricesdrop_off" value="0" '.(!Tools::getValue('pricesdrop', Configuration::get('MAOMENU_PRICESDROP')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="pricesdrop_off"><img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
				</div><br />
				
				<label style="padding-top: 10px">'.$this->l('Best Sales').':</label>
				<div class="margin-form">
					<input type="radio" name="bestsales" id="bestsales_on" value="1" '.(Tools::getValue('bestsales', Configuration::get('MAOMENU_BESTSALES')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="bestsales_on"><img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="bestsales" id="bestsales_off" value="0" '.(!Tools::getValue('bestsales', Configuration::get('MAOMENU_BESTSALES')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="bestsales_off"><img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
				</div><br />
				
				<label style="padding-top: 10px">'.$this->l('Information').':</label>
				<div class="margin-form">
					<input type="radio" name="information" id="information_on" value="1" '.(Tools::getValue('information', Configuration::get('MAOMENU_INFORMATION')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="information_on"><img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="information" id="information_off" value="0" '.(!Tools::getValue('information', Configuration::get('MAOMENU_INFORMATION')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="information_off"><img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
				</div><br />

				<label style="padding-top: 10px">'.$this->l('Stores map (in information)').':</label>
				<div class="margin-form">
					<input type="radio" name="storesmap" id="storesmap_on" value="1" '.(Tools::getValue('storesmap', Configuration::get('MAOMENU_STORESMAP')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="storesmap_on"><img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="storesmap" id="storesmap_off" value="0" '.(!Tools::getValue('storesmap', Configuration::get('MAOMENU_STORESMAP')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="storesmap_off"><img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
				</div><br />
				
				<label style="padding-top: 10px">'.$this->l('Sitemap (in information)').':</label>
				<div class="margin-form">
					<input type="radio" name="sitemap" id="sitemap_on" value="1" '.(Tools::getValue('sitemap', Configuration::get('MAOMENU_SITEMAP')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="sitemap_on"><img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="sitemap" id="sitemap_off" value="0" '.(!Tools::getValue('sitemap', Configuration::get('MAOMENU_SITEMAP')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="sitemap_off"><img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
				</div><br />
				
				<label style="padding-top: 10px">'.$this->l('Contact us (in information)').':</label>
				<div class="margin-form">
					<input type="radio" name="contactus" id="contactus_on" value="1" '.(Tools::getValue('contactus', Configuration::get('MAOMENU_CONTACTUS')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="contactus_on"><img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="contactus" id="contactus_off" value="0" '.(!Tools::getValue('contactus', Configuration::get('MAOMENU_CONTACTUS')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="contactus_off"><img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
				</div><br />
				
				<label style="padding-top: 10px">'.$this->l('Search Bar').':</label>
				<div class="margin-form">
					<input type="radio" name="search" id="search_on" value="1" '.(Tools::getValue('search', Configuration::get('MAOMENU_SEARCH')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="search_on"><img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="search" id="search_off" value="0" '.(!Tools::getValue('search', Configuration::get('MAOMENU_SEARCH')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="search_off"><img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
				</div><br />

				<label style="padding-top: 10px">'.$this->l('Root Arrow').':</label>
				<div class="margin-form">
					<input type="radio" name="rootarrow" id="rootarrow_on" value="1" '.(Tools::getValue('rootarrow', Configuration::get('MAOMENU_ROOTARROW')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="rootarrow_on"><img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="rootarrow" id="rootarrow_off" value="0" '.(!Tools::getValue('rootarrow', Configuration::get('MAOMENU_ROOTARROW')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="rootarrow_off"><img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
				</div><br />

				<label style="padding-top: 10px">'.$this->l('Category View').':</label>
				<div class="margin-form">
					<select name="modecatview">
						<option value="list" '.(Tools::getValue('modecatview', Configuration::get('MAOMENU_MODE_CAT')) == 'list' ? 'selected="selected"' : '').'>'.$this->l('In a list').'</option>
						<option value="toolbar" '.(Tools::getValue('modecatview', Configuration::get('MAOMENU_MODE_CAT')) == 'toolbar' ? 'selected="selected"' : '').'>'.$this->l('Along the menu').'</option>
					</select>
					'.$this->l('(default: In a list)').'
				</div><br />
				
				<label style="padding-top: 10px">'.$this->l('Categories arranged by').':</label>
				<div class="margin-form">
					<select name="arrangedby">
						<option value="name" '.(Tools::getValue('arrangedby', Configuration::get('MAOMENU_ITEMS_BY')) == 'name' ? 'selected="selected"' : '').'>'.$this->l('Name').'</option>
						<option value="position" '.(Tools::getValue('arrangedby', Configuration::get('MAOMENU_ITEMS_BY')) == 'position' ? 'selected="selected"' : '').'>'.$this->l('Position').'</option>
					</select>
					'.$this->l('(default: Name)').'
				</div><br />
				
				<label style="padding-top: 10px">'.$this->l('Choose a theme').':</label>
				<div class="margin-form">
					<select name="menutheme">
						<option value="black" '.(Tools::getValue('menutheme', Configuration::get('MAOMENU_THEME')) == 'black' ? 'selected="selected"' : '').'>'.$this->l('black').'</option>
						<option value="blue" '.(Tools::getValue('menutheme', Configuration::get('MAOMENU_THEME')) == 'blue' ? 'selected="selected"' : '').'>'.$this->l('blue').'</option>
						<option value="gray" '.(Tools::getValue('menutheme', Configuration::get('MAOMENU_THEME')) == 'gray' ? 'selected="selected"' : '').'>'.$this->l('gray').'</option>							
						<option value="orange" '.(Tools::getValue('menutheme', Configuration::get('MAOMENU_THEME')) == 'orange' ? 'selected="selected"' : '').'>'.$this->l('orange').'</option>
						<option value="yellow" '.(Tools::getValue('menutheme', Configuration::get('MAOMENU_THEME')) == 'yellow' ? 'selected="selected"' : '').'>'.$this->l('yellow').'</option>
						<option value="custom" '.(Tools::getValue('menutheme', Configuration::get('MAOMENU_THEME')) == 'custom' ? 'selected="selected"' : '').'>'.$this->l('your custom theme').'</option>
						<option value="none" '.(Tools::getValue('menutheme', Configuration::get('MAOMENU_THEME')) == 'none' ? 'selected="selected"' : '').'>'.$this->l('no theme, only with colors').'</option>
					</select>
				</div><br />
				
				<label style="padding-top: 10px">'.$this->l('Color of the arrows').':</label>
				<div class="margin-form">
					<select name="arrowscolor">
						<option value="black" '.(Tools::getValue('arrowscolor', Configuration::get('MAOMENU_ARROWSCOLOR')) == 'black' ? 'selected="selected"' : '').'>'.$this->l('black').'</option>
						<option value="white" '.(Tools::getValue('arrowscolor', Configuration::get('MAOMENU_ARROWSCOLOR')) == 'white' ? 'selected="selected"' : '').'>'.$this->l('white').'</option>
					</select>
				</div><br />
				
				<label style="padding-top: 25px">'.$this->l('Maximum depth').':</label>
				<div class="margin-form">
					<label for="maxDepth-value">('.$this->l('increment of').' 1):</label>
					<input name="maxDepth" type="text" id="maxDepth-value" size="3" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 5)
					<div id="maxDepth-bar"></div>
					<p class="clear">'.$this->l('Set the maximum depth of sublevels displayed in this block (0 = infinite)').'</p>
				</div><br />

				<label style="width: 470px">'.$this->l('Select images (only for a custom theme)').':</label>
				<div class="margin-form" style="padding: 0 0 1em 500px"><input id="file_upload" name="file_upload" type="file" /></div>
				<h3 style="color: orange; margin-left: 50px">'.$this->l('Uploader Instructions').':</h3>
				<p class="clear" style="margin-left: 70px">'.$this->l('Allowed only .gif images, named').': home.gif, hover.gif, hover-selected.gif, left.gif, menu.gif, right.gif, selected.gif<br />
				('.$this->l('rename your images with these names').')</p>
				<p class="clear" style="margin-left: 70px">'.$this->l('Remember to set below "Width of Corner Images" and "Height" with the exact values of your images').'.</p><br />

				<br /><h2>'.$this->l('CSS settings').':</h2><br />

				<label style="padding-top: 25px">'.$this->l('Width').':</label>
				<div class="margin-form">
					<label for="widthmenu-value">('.$this->l('increment of').' 1):</label>
					<input name="widthmenu" type="text" id="widthmenu-value" size="4" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 950px)
					<div id="widthmenu-bar"></div>
				</div>
				
			   <label style="padding-top: 25px">'.$this->l('Height').':</label>
				<div class="margin-form">
					<label for="heightmenu-value">('.$this->l('increment of').' 0.1):</label>
					<input name="heightmenu" type="text" id="heightmenu-value" size="3" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 35px)
					<div id="heightmenu-bar"></div>
				</div>
				
				<label style="padding-top: 25px">'.$this->l('Margin-bottom').':</label>
				<div class="margin-form">
					<label for="marginbottom-value">('.$this->l('increment of').' 0.1):</label>
					<input name="marginbottom" type="text" id="marginbottom-value" size="3" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 20px)
					<div id="marginbottom-bar"></div>
				</div>
				
				<label style="padding-top: 25px">'.$this->l('Margin-left').':</label>
				<div class="margin-form">
					<label for="marginleft-value">('.$this->l('increment of').' 0.1):</label>
					<input name="marginleft" type="text" id="marginleft-value" size="3" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 13px)
					<div id="marginleft-bar"></div>
				</div>
				
				<label style="padding-top: 25px">'.$this->l('Opacity').':</label>
				<div class="margin-form">
					<label for="opacity-value">('.$this->l('increment of').' 0.01):</label>
					<input name="opacity" type="text" id="opacity-value" size="3" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 0.97)
					<div id="opacity-bar"></div>
				</div>
				
				<label style="padding-top: 25px">'.$this->l('Width of Corner Images').':</label>
				<div class="margin-form">
					<label for="cornerimage-value">('.$this->l('increment of').' 0.1):</label>
					<input name="cornerimage" type="text" id="cornerimage-value" size="3" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 6px)
					<div id="cornerimage-bar"></div>
				</div>
				
				<label style="padding-top: 25px">'.$this->l('Button Width').':</label>
				<div class="margin-form">
					<label for="widthbutton-value">('.$this->l('increment of').' 0.1):</label>
					<input name="widthbutton" type="text" id="widthbutton-value" size="3" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 10px)
					<div id="widthbutton-bar"></div>
				</div>				
								
				<label style="padding-top: 25px">'.$this->l('Button Font-size').':</label>
				<div class="margin-form">
					<label for="fontsizebutton-value">('.$this->l('increment of').' 0.1):</label>
					<input name="fontsizebutton" type="text" id="fontsizebutton-value" size="3" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 14px)
					<div id="fontsizebutton-bar"></div>
				</div>
				
				<label style="padding-top: 25px">'.$this->l('Branches Width').':</label>
				<div class="margin-form">
					<label for="widthbranch-value">('.$this->l('increment of').' 1):</label>
					<input name="widthbranch" type="text" id="widthbranch-value" size="4" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 190px)
					<div id="widthbranch-bar"></div>
				</div>
				
				<label style="padding-top: 25px">'.$this->l('Branch Height').':</label>
				<div class="margin-form">
					<label for="heightbranch-value">('.$this->l('increment of').' 0.1):</label>
					<input name="heightbranch" type="text" id="heightbranch-value" size="3" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 30px)
					<div id="heightbranch-bar"></div>
				</div>
				
				<label style="padding-top: 25px">'.$this->l('Padding-left of branch text').':</label>
				<div class="margin-form">
					<label for="paddingtextbranch-value">('.$this->l('increment of').' 0.1):</label>
					<input name="paddingtextbranch" type="text" id="paddingtextbranch-value" size="3" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 10px)
					<div id="paddingtextbranch-bar"></div>
				</div>
				
				<label style="padding-top: 25px">'.$this->l('Branches Font-size').':</label>
				<div class="margin-form">
					<label for="fontsizebranch-value">('.$this->l('increment of').' 0.1):</label>
					<input name="fontsizebranch" type="text" id="fontsizebranch-value" size="3" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 12px)
					<div id="fontsizebranch-bar"></div>
				</div>
				
				<label style="padding-top: 25px">'.$this->l('The Top of Root Arrow').':</label>
				<div class="margin-form">
					<label for="toprootarrow-value">('.$this->l('increment of').' 0.1):</label>
					<input name="toprootarrow" type="text" id="toprootarrow-value" size="4" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 13px)
					<div id="toprootarrow-bar"></div>
				</div>
				
				<label style="padding-top: 25px">'.$this->l('The Top of Branch Arrow').':</label>
				<div class="margin-form">
					<label for="topbrancharrow-value">('.$this->l('increment of').' 0.1):</label>
					<input name="topbrancharrow" type="text" id="topbrancharrow-value" size="4" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 8px)
					<div id="topbrancharrow-bar"></div>
				</div>
				
				<label style="padding-top: 25px">'.$this->l('Height of input search').':</label>
				<div class="margin-form">
					<label for="searchinputheight-value">('.$this->l('increment of').' 0.1):</label>
					<input name="searchinputheight" type="text" id="searchinputheight-value" size="3" style="border:0; color:#f6931f; font-weight:bold;" />('.$this->l('default').': 25px)
					<div id="searchinputheight-bar"></div>
				</div><br />
				
				<label style="padding-top: 10px">'.$this->l('Border-right of last button').':</label>
				<div class="margin-form">
					<input type="radio" name="lastbordermenu" id="lastbordermenu_on" value="1" '.(Tools::getValue('lastbordermenu', Configuration::get('MAOMENU_LAST_BORDER')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="lastbordermenu_on"><img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="lastbordermenu" id="lastbordermenu_off" value="0" '.(!Tools::getValue('lastbordermenu', Configuration::get('MAOMENU_LAST_BORDER')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="lastbordermenu_off"><img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
					<p class="clear">'.$this->l('Usable only with categories along the menu').'</p>
				</div>
				
				<br /><h2>'.$this->l('Color settings').':</h2><br />
				
				<h3 style="color: orange; margin-left: 50px">'.$this->l('Background color').':</h3>
				
				<div class="divleftmenu">
					<label class="labelmenu">'.$this->l('Color of menu bar').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="background" value="'.Tools::getValue('background', Configuration::get('MAOMENU_BACKGROUND')).'" style="background-color: #'.Tools::getValue('background', Configuration::get('MAOMENU_BACKGROUND')).'" />
					<p class="center">('.$this->l('default').': #CCC)</p>
				</div>
				
				<div class="divrightmenu">
					<label class="labelmenu">'.$this->l('Hover color of root buttons').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="lihoverback" value="'.Tools::getValue('lihoverback', Configuration::get('MAOMENU_LI_HOVER_BACK')).'" style="background-color: #'.Tools::getValue('lihoverback', Configuration::get('MAOMENU_LI_HOVER_BACK')).'" />
					<p class="center">('.$this->l('default').': #FFA500)</p>
				</div>

				<div class="divleftmenu">				
					<label class="labelmenu">'.$this->l('Color of branches').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="ulliback" value="'.Tools::getValue('ulliback', Configuration::get('MAOMENU_UL_LI_BACK')).'" style="background-color: #'.Tools::getValue('ulliback', Configuration::get('MAOMENU_UL_LI_BACK')).'" />
					<p class="center">('.$this->l('default').': #F5F5DC)</p>
				</div>

				<div class="divrightmenu">
					<label class="labelmenu">'.$this->l('Hover color of branches').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="ullihoverback" value="'.Tools::getValue('ullihoverback', Configuration::get('MAOMENU_UL_LI_HOVER_BACK')).'" style="background-color: #'.Tools::getValue('ullihoverback', Configuration::get('MAOMENU_UL_LI_HOVER_BACK')).'" />
					<p class="center">('.$this->l('default').': #FFFF00)</p>
				</div>

				<div class="divleftmenu">				
					<label class="labelmenu">'.$this->l('Color of selected root buttons').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="libranchselectedb" value="'.Tools::getValue('libranchselectedb', Configuration::get('MAOMENU_LI_BRANCHSEL_B')).'" style="background-color: #'.Tools::getValue('libranchselectedb', Configuration::get('MAOMENU_LI_BRANCHSEL_B')).'" />
					<p class="center">('.$this->l('default').': #A52A2A)</p>
				</div>

				<div class="divrightmenu">
					<label class="labelmenu">'.$this->l('Hover color of selected root buttons').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="libranchselectedhb" value="'.Tools::getValue('libranchselectedhb', Configuration::get('MAOMENU_LI_BRANCHSEL_H_B')).'" style="background-color: #'.Tools::getValue('libranchselectedhb', Configuration::get('MAOMENU_LI_BRANCHSEL_H_B')).'" />
					<p class="center">('.$this->l('default').': #7C7C7C)</p>
				</div>
				
				<div class="divleftmenu">				
					<label class="labelmenu">'.$this->l('Color of selected branches').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="ullibranchselectedb" value="'.Tools::getValue('ullibranchselectedb', Configuration::get('MAOMENU_UL_LI_BRANSEL_B')).'" style="background-color: #'.Tools::getValue('ullibranchselectedb', Configuration::get('MAOMENU_UL_LI_BRANSEL_B')).'" />
					<p class="center">('.$this->l('default').': #A52A2A)</p>
				</div>
				
				<div class="divrightmenu">				
					<label class="labelmenu">'.$this->l('Hover color of selected branches').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="ullibranchselectedhb" value="'.Tools::getValue('ullibranchselectedhb', Configuration::get('MAOMENU_UL_LI_BRANSEL_H')).'" style="background-color: #'.Tools::getValue('ullibranchselectedhb', Configuration::get('MAOMENU_UL_LI_BRANSEL_H')).'" />
					<p class="center">('.$this->l('default').': #008000)</p>
				</div>
				
				<h3 class="clear" style="color: orange; margin-left: 50px;">'.$this->l('Text color').':</h3>	
				
				<div class="divleftmenu">
					<label class="labelmenu">'.$this->l('Text Color of root buttons').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="acolor" value="'.Tools::getValue('acolor', Configuration::get('MAOMENU_A_COLOR')).'" style="background-color: #'.Tools::getValue('acolor', Configuration::get('MAOMENU_A_COLOR')).'" />
					<p class="center">('.$this->l('default').': #000)</p>
				</div>
				
				<div class="divrightmenu">
					<label class="labelmenu">'.$this->l('Hover text color of root buttons').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="lihoverac" value="'.Tools::getValue('lihoverac', Configuration::get('MAOMENU_LI_HOVER_A_C')).'" style="background-color: #'.Tools::getValue('lihoverac', Configuration::get('MAOMENU_LI_HOVER_A_C')).'" />
					<p class="center">('.$this->l('default').': #474747)</p>
				</div>
				
				<div class="divleftmenu">
					<label class="labelmenu">'.$this->l('Text color of branches').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="ulliacolor" value="'.Tools::getValue('ulliacolor', Configuration::get('MAOMENU_UL_LI_A_COLOR')).'" style="background-color: #'.Tools::getValue('ulliacolor', Configuration::get('MAOMENU_UL_LI_A_COLOR')).'" />
					<p class="center">('.$this->l('default').': #008000)</p>
				</div>

				<div class="divrightmenu">				
					<label class="labelmenu">'.$this->l('Hover text color of branches').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="liulliahover" value="'.Tools::getValue('liulliahover', Configuration::get('MAOMENU_LI_UL_LI_A_HOVER')).'" style="background-color: #'.Tools::getValue('liulliahover', Configuration::get('MAOMENU_LI_UL_LI_A_HOVER')).'" />
					<p class="center">('.$this->l('default').': #800080)</p>
				</div>
				
				<div class="divleftmenu">
					<label class="labelmenu">'.$this->l('Text color of selected root buttons').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="liaselectc" value="'.Tools::getValue('liaselectc', Configuration::get('MAOMENU_LI_A_SELECT_C')).'" style="background-color: #'.Tools::getValue('liaselectc', Configuration::get('MAOMENU_LI_A_SELECT_C')).'" />
					<p class="center">('.$this->l('default').': #FFF)</p>
				</div>
				
				<div class="divrightmenu">				
					<label class="labelmenu">'.$this->l('Hover text color of selected root buttons').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="libranchselectedhaselectedc" value="'.Tools::getValue('libranchselectedhaselectedc', Configuration::get('MAOMENU_LI_BRANSEL_H_A_C')).'" style="background-color: #'.Tools::getValue('libranchselectedhaselectedc', Configuration::get('MAOMENU_LI_BRANSEL_H_A_C')).'" />
					<p class="center">('.$this->l('default').': #000)</p>
				</div>
				
				<div class="divleftmenu">				
					<label class="labelmenu">'.$this->l('Text color of selected branches').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="ulliaselectedc" value="'.Tools::getValue('ulliaselectedc', Configuration::get('MAOMENU_UL_LI_A_SELECT_C')).'" style="background-color: #'.Tools::getValue('ulliaselectedc', Configuration::get('MAOMENU_UL_LI_A_SELECT_C')).'" />
					<p class="center">('.$this->l('default').': #FF0000)</p>
				</div>
				
				<div class="divrightmenu">				
					<label class="labelmenu">'.$this->l('Hover text color of selected branches').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="ulliaselectedhc" value="'.Tools::getValue('ulliaselectedhc', Configuration::get('MAOMENU_UL_LI_A_SELECT_H')).'" style="background-color: #'.Tools::getValue('ulliaselectedhc', Configuration::get('MAOMENU_UL_LI_A_SELECT_H')).'" />
					<p class="center">('.$this->l('default').': #FFA500)</p>
				</div>

				<h3 class="clear" style="color: orange; margin-left: 50px">'.$this->l('Other color settings').':</h3>
			
				<div class="divleftmenu">
					<label class="labelmenu">'.$this->l('Submenu border color').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="ulborder" value="'.Tools::getValue('ulborder', Configuration::get('MAOMENU_UL_BORDER')).'" style="background-color: #'.Tools::getValue('ulborder', Configuration::get('MAOMENU_UL_BORDER')).'" />
					<p class="center">('.$this->l('default').': #CCC)</p>
				</div>
				
				<div class="divrightmenu">				
					<label class="labelmenu">'.$this->l('Border-right color of root buttons').':</label>
					<input type="text" maxlength="6" size="6" onmouseover="colorPicker(event)" name="liborderr" value="'.Tools::getValue('liborderr', Configuration::get('MAOMENU_LI_BORDER_R')).'" style="background-color: #'.Tools::getValue('liborderr', Configuration::get('MAOMENU_LI_BORDER_R')).'" />
					<p class="center">('.$this->l('default').': #9BA4A9)</p>
				</div>
				
            <script type="text/javascript">
					$(function(){				
						$("#maxDepth-bar").slider({
				         value: '.Tools::getValue('maxDepth', Configuration::get('MAOMENU_MAX_DEPTH')).',
							min: 0,
							max: 10,
							animate: true,
							step: 1,
							slide: function( event, ui ) {
								$( "#maxDepth-value" ).val( ui.value );
							}
						});
                  $("#maxDepth-value").val($("#maxDepth-bar").slider("value"));                                                                                                                                                            

						$("#widthmenu-bar").slider({
				         value: '.Tools::getValue('widthmenu', Configuration::get('MAOMENU_WIDTH_MENU')).',
							min: 1,
							max: 1300,
							animate: true,
							step: 1,
							slide: function( event, ui ) {
								$( "#widthmenu-value" ).val( ui.value );
							}
						});
                  $("#widthmenu-value").val($("#widthmenu-bar").slider("value"));

						$("#heightmenu-bar").slider({
				         value: '.Tools::getValue('heightmenu', Configuration::get('MAOMENU_HEIGHT_MENU')).',
							min: 1,
							max: 100,
							animate: true,
							step: 0.1,
							slide: function( event, ui ) {
								$( "#heightmenu-value" ).val( ui.value );
							}
						});
                  $("#heightmenu-value").val($("#heightmenu-bar").slider("value"));
                  
						$("#marginbottom-bar").slider({
				         value: '.Tools::getValue('marginbottom', Configuration::get('MAOMENU_MARGIN_BOTTOM')).',
							min: 1,
							max: 70,
							animate: true,
							step: 0.1,
							slide: function( event, ui ) {
								$( "#marginbottom-value" ).val( ui.value );
							}
						});
                  $("#marginbottom-value").val($("#marginbottom-bar").slider("value"));
                  
						$("#marginleft-bar").slider({
				         value: '.Tools::getValue('marginleft', Configuration::get('MAOMENU_MARGIN_LEFT')).',
							min: 0,
							max: 100,
							animate: true,
							step: 0.1,
							slide: function( event, ui ) {
								$( "#marginleft-value" ).val( ui.value );
							}
						});
                  $("#marginleft-value").val($("#marginleft-bar").slider("value"));
                  
						$("#opacity-bar").slider({
				         value: '.Tools::getValue('opacity', Configuration::get('MAOMENU_OPACITY')).',
							min: 0.1,
							max: 1,
							animate: true,
							step: 0.01,
							slide: function( event, ui ) {
								$( "#opacity-value" ).val( ui.value );
							}
						});
                  $("#opacity-value").val($("#opacity-bar").slider("value"));
                  
						$("#cornerimage-bar").slider({
				         value: '.Tools::getValue('cornerimage', Configuration::get('MAOMENU_CORNER_IMAGE')).',
							min: 1,
							max: 30,
							animate: true,
							step: 0.1,
							slide: function( event, ui ) {
								$( "#cornerimage-value" ).val( ui.value );
							}
						});
                  $("#cornerimage-value").val($("#cornerimage-bar").slider("value"));
                  
						$("#widthbutton-bar").slider({
				         value: '.Tools::getValue('widthbutton', Configuration::get('MAOMENU_WIDTH_BUTTON')).',
							min: 0.1,
							max: 60,
							animate: true,
							step: 0.1,
							slide: function( event, ui ) {
								$( "#widthbutton-value" ).val( ui.value );
							}
						});
                  $("#widthbutton-value").val($("#widthbutton-bar").slider("value"));
                  
						$("#fontsizebutton-bar").slider({
				         value: '.Tools::getValue('fontsizebutton', Configuration::get('MAOMENU_FONT_SIZE_BUTTON')).',
							min: 1,
							max: 30,
							animate: true,
							step: 0.1,
							slide: function( event, ui ) {
								$( "#fontsizebutton-value" ).val( ui.value );
							}
						});
                  $("#fontsizebutton-value").val($("#fontsizebutton-bar").slider("value"));
                  
						$("#widthbranch-bar").slider({
				         value: '.Tools::getValue('widthbranch', Configuration::get('MAOMENU_WIDTH_BRANCH')).',
							min: 50,
							max: 400,
							animate: true,
							step: 1,
							slide: function( event, ui ) {
								$( "#widthbranch-value" ).val( ui.value );
							}
						});
                  $("#widthbranch-value").val($("#widthbranch-bar").slider("value"));
                  
						$("#heightbranch-bar").slider({
				         value: '.Tools::getValue('heightbranch', Configuration::get('MAOMENU_HEIGHT_BRANCH')).',
							min: 1,
							max: 80,
							animate: true,
							step: 0.1,
							slide: function( event, ui ) {
								$( "#heightbranch-value" ).val( ui.value );
							}
						});
                  $("#heightbranch-value").val($("#heightbranch-bar").slider("value"));
                  
						$("#paddingtextbranch-bar").slider({
				         value: '.Tools::getValue('paddingtextbranch', Configuration::get('MAOMENU_PAD_TEXT_BRANCH')).',
							min: 0,
							max: 50,
							animate: true,
							step: 0.1,
							slide: function( event, ui ) {
								$( "#paddingtextbranch-value" ).val( ui.value );
							}
						});
                  $("#paddingtextbranch-value").val($("#paddingtextbranch-bar").slider("value"));
                  
						$("#fontsizebranch-bar").slider({
				         value: '.Tools::getValue('fontsizebranch', Configuration::get('MAOMENU_FONT_SIZE_BRANCH')).',
							min: 1,
							max: 30,
							animate: true,
							step: 0.1,
							slide: function( event, ui ) {
								$( "#fontsizebranch-value" ).val( ui.value );
							}
						});
                  $("#fontsizebranch-value").val($("#fontsizebranch-bar").slider("value"));
                  
						$("#searchinputheight-bar").slider({
				         value: '.Tools::getValue('searchinputheight', Configuration::get('MAOMENU_SEARCH_HEIGHT')).',
							min: 15,
							max: 50,
							animate: true,
							step: 0.1,
							slide: function( event, ui ) {
								$( "#searchinputheight-value" ).val( ui.value );
							}
						});
                  $("#searchinputheight-value").val($("#searchinputheight-bar").slider("value"));
                  
						$("#toprootarrow-bar").slider({
				         value: '.Tools::getValue('toprootarrow', Configuration::get('MAOMENU_TOP_ROOTARROW')).',
							min: 1,
							max: 40,
							animate: true,
							step: 0.1,
							slide: function( event, ui ) {
								$( "#toprootarrow-value" ).val( ui.value );
							}
						});
                  $("#toprootarrow-value").val($("#toprootarrow-bar").slider("value"));
                  
						$("#topbrancharrow-bar").slider({
				         value: '.Tools::getValue('topbrancharrow', Configuration::get('MAOMENU_TOP_BRANCHARROW')).',
							min: 1,
							max: 40,
							animate: true,
							step: 0.1,
							slide: function( event, ui ) {
								$( "#topbrancharrow-value" ).val( ui.value );
							}
						});
                  $("#topbrancharrow-value").val($("#topbrancharrow-bar").slider("value"));
                                                                                                                              								
					});
				</script>												
								
				<div class="margin-form clear"><input type="submit" name="submitMenu" value="'.$this->l('Save').'" class="button" /></div>
			</fieldset>
		</form>';
	}

	private function getTree($resultParents, $resultIds, $maxDepth, $id_category = 1, $currentDepth = 0)
	{
		global $link;
		
		$children = array();
		if (isset($resultParents[$id_category]) AND sizeof($resultParents[$id_category]) AND ($maxDepth == 0 OR $currentDepth < $maxDepth))
			foreach ($resultParents[$id_category] as $subcat)
				$children[] = $this->getTree($resultParents, $resultIds, $maxDepth, $subcat['id_category'], $currentDepth + 1);
		if (!isset($resultIds[$id_category]))
			return false;
		return array('id' => $id_category, 'link' => $link->getCategoryLink($id_category, $resultIds[$id_category]['link_rewrite']),
					 'name' => $resultIds[$id_category]['name'], 'desc'=> $resultIds[$id_category]['description'],
					 'children' => $children);
	}

	public function hookTop($params)
	{
		global $smarty, $cookie;

		$id_customer = (int)($params['cookie']->id_customer);
		// Get all groups for this customer and concatenate them as a string: "1,2,3..."
		// It is necessary to keep the group query separate from the main select query because it is used for the cache
		$groups = $id_customer ? implode(', ', Customer::getGroupsStatic($id_customer)) : _PS_DEFAULT_CUSTOMER_GROUP_;
		$id_lang = (int)($params['cookie']->id_lang);
		$id_product = (int)(Tools::getValue('id_product', 0));
		$id_category = (int)(Tools::getValue('id_category', 0));
		$maxdepth = Configuration::get('MAOMENU_MAX_DEPTH');
		$ajaxSearch= (int)(Configuration::get('PS_SEARCH_AJAX'));
		$instantSearch = (int)(Configuration::get('PS_INSTANT_SEARCH'));
		
		if (!$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
			SELECT c.id_parent, c.id_category, cl.name, cl.description, cl.link_rewrite
			FROM `'._DB_PREFIX_.'category` c
			LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND `id_lang` = '.$id_lang.')
			LEFT JOIN `'._DB_PREFIX_.'category_group` cg ON (cg.`id_category` = c.`id_category`)
			WHERE (c.`active` = 1 OR c.`id_category` = 1)
			'.((int)($maxdepth) != 0 ? ' AND `level_depth` <= '.(int)($maxdepth) : '').'
			AND cg.`id_group` IN ('.pSQL($groups).')
			GROUP BY id_category
			ORDER BY `level_depth` ASC, '.(Configuration::get('MAOMENU_ITEMS_BY') == 'name' ? 'cl.`name`' : 'c.`position`').' ASC')
		)
			return;

		$resultParents = array();
		$resultIds = array();
		foreach ($result AS $row)
		{
			$resultParents[$row['id_parent']][] = $row;
			$resultIds[$row['id_category']] = $row;
		}
		$menuCategTree = $this->getTree($resultParents, $resultIds, $maxdepth);
		unset($resultParents);
		unset($resultIds);

		if (Tools::isSubmit('id_category'))
		{
			$cookie->last_visited_category = $id_category;
			$smarty->assign('maomenucurrentCategoryId', $cookie->last_visited_category);
		}
		if (Tools::isSubmit('id_product'))
		{
			if (!isset($cookie->last_visited_category) OR !Product::idIsOnCategoryId($id_product, array('0' => array('id_category' => $cookie->last_visited_category))))
			{
				$product = new Product($id_product);
				if (isset($product) AND Validate::isLoadedObject($product))
					$cookie->last_visited_category = (int)($product->id_category_default);
			}
			$smarty->assign('maomenucurrentCategoryId', (int)($cookie->last_visited_category));
		}
		
		$homecategories = array();
		$homecategoriesID = array();
		$homecategories = Category::getHomeCategories($id_lang);
		foreach ($homecategories AS $row)
		{
			$homecategoryID = $row['id_category'];
         $homecategoriesID[] = $homecategoryID;
		}

		$smarty->assign(array(
         'homecategoriesID' => $homecategoriesID,
         'maomenuCategTree' => $menuCategTree,
         'maomenu_branch_tpl_path' => _PS_MODULE_DIR_.'maofree_menu/maofree_menu_tree.tpl',
			'maomenusearch' => (int)(Configuration::get('MAOMENU_SEARCH')) == 1 ? true : false,
			'maomenuhome' => (int)(Configuration::get('MAOMENU_HOME')) == 1 ? true : false,
			'maomenurootarrow' => (int)(Configuration::get('MAOMENU_ROOTARROW')) == 1 ? true : false,
			'maomenumanufacturers' => (int)(Configuration::get('MAOMENU_MANUFACTURES')) == 1 ? true : false,
			'maomenusuppliers' => (int)(Configuration::get('MAOMENU_SUPPLIERS')) == 1 ? true : false,
			'maomenunewproducts' => (int)(Configuration::get('MAOMENU_NEWPRODUCTS')) == 1 ? true : false,
			'maomenupricesdrop' => (int)(Configuration::get('MAOMENU_PRICESDROP')) == 1 ? true : false,
			'maomenubestsales' => (int)(Configuration::get('MAOMENU_BESTSALES')) == 1 ? true : false,
			'maomenuinformation' => (int)(Configuration::get('MAOMENU_INFORMATION')) == 1 ? true : false,
			'MENU_ENT_QUOTES' => ENT_QUOTES,
			'mao_search_ssl' => (int)Tools::usingSecureMode(),
			'mao_ajaxsearch' => $ajaxSearch,
			'mao_theme' => Configuration::get('MAOMENU_THEME') != 'none' ? true : false,
			'maomenumodecatview' => Configuration::get('MAOMENU_MODE_CAT') == 'list' ? true : false,
			'menu_manufacturers' => Manufacturer::getManufacturers(),
			'menu_display_link_manufacturer' => Configuration::get('PS_DISPLAY_SUPPLIERS'),
			'menu_suppliers' => Supplier::getSuppliers(false),
			'menu_display_stores' => Configuration::get('MAOMENU_STORESMAP'),
			'menu_display_sitemap' => Configuration::get('MAOMENU_SITEMAP'),
			'menu_display_contactus' => Configuration::get('MAOMENU_CONTACTUS'),
			'menu_cmslinks' => CMS::getLinks($id_lang, $selection = NULL, $active = true),
			'mao_instantsearch' => $instantSearch
		));
		
		return $this->display(__FILE__, 'maofree_menu.tpl');
	}
	
	public function hookHeader($params)
	{
		$ajaxSearch= (int)(Configuration::get('PS_SEARCH_AJAX'));

		Tools::addCSS(($this->_path).'css/menu-horizontal.css', 'all');
		if ($ajaxSearch)
		{
			Tools::addCSS(_PS_CSS_DIR_.'jquery.autocomplete.css');
			Tools::addJS(_PS_JS_DIR_.'jquery/jquery.autocomplete.js');
		}
		Tools::addCSS(_THEME_CSS_DIR_.'product_list.css');
		
		return $this->display(__FILE__, 'header.tpl');
	}
}