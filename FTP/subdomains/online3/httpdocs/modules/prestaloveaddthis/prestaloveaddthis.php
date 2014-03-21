<?php
/*
	Module Name: PrestaLoveAddThis
	Module URI: http://www.prestalove.com
	Description: PrestaLoveAddThis module.
	Version: 1.0
	Author: Nguyen Quoc
	Author URI: http://www.prestalove.com
	Copyright (C) 2011 PrestaLove.com. 

*/

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class PrestaLoveAddThis extends Module
{
	private $_html = '';
	private $_postErrors = array();
	private $arrParamValues = array();
	private $currentproduct = array();
	
	public function __construct()
	{
		$this->name = 'prestaloveaddthis';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'PrestaLove.com';

		parent::__construct();

		$this->displayName = $this->l('PrestaLove AddThis');
		$this->description = $this->l('Put AddThis tools box on your site.');
	}

	public function install()
	{
		//HOOK_EXTRA_RIGHT
		if (!parent::install() OR
		!$this->registerHook('header') OR
		!$this->registerHook('extraright') OR
		!Configuration::updateValue('PLAT_PROFILE_ID', 'Your Profile ID') OR
		!Configuration::updateValue('PLAT_BUTTON_STYLE', 'lg-share') OR
		!Configuration::updateValue('PLAT_CUSTOM_URL', '') OR
		!Configuration::updateValue('PLAT_TOOLBOX_SERVICES', 'facebook,twitter,email,print,facebook_like,tweet,google_plusone') OR
		!Configuration::updateValue('PLAT_TOOLBOX_SERVICES_MODE', 'expanded') OR
		!Configuration::updateValue('PLAT_ICON_DIMENSION', '16') OR
		!Configuration::updateValue('PLAT_BRAND', '') OR
		!Configuration::updateValue('PLAT_HEADER_COLOR', '') OR
		!Configuration::updateValue('PLAT_HEADER_BACKGROUND', '') OR
		!Configuration::updateValue('PLAT_SERVICES_COMPACT', '') OR
		!Configuration::updateValue('PLAT_SERVICES_EXCLUDE', '') OR
		!Configuration::updateValue('PLAT_SERVICES_EXPANDED', '') OR
		!Configuration::updateValue('PLAT_SERVICES_CUSTOM', '') OR
		!Configuration::updateValue('PLAT_OFFSET_TOP', '') OR
		!Configuration::updateValue('PLAT_OFFSET_LEFT', '') OR
		!Configuration::updateValue('PLAT_HOVER_DELAY', '') OR
		!Configuration::updateValue('PLAT_CLICK', '0') OR
		!Configuration::updateValue('PLAT_HOVER_DIRECTION', '0') OR
		!Configuration::updateValue('PLAT_USE_ADDRESSBOOK', '0') OR
		!Configuration::updateValue('PLAT_508_COMPLIANT', '0') OR
		!Configuration::updateValue('PLAT_DATA_TRACK_CLICKBACK', '1') OR
		!Configuration::updateValue('PLAT_HIDE_EMBED', '1') OR
		!Configuration::updateValue('PLAT_USE_CSS', '1') OR
		!Configuration::updateValue('PLAT_GA_TRACKER', ''))
			return false;
		return true;
	}

	public function uninstall()
	{
		if (!parent::uninstall() OR
		!Configuration::deleteByName('PLAT_PROFILE_ID') OR
		!Configuration::deleteByName('PLAT_BUTTON_STYLE') OR
		!Configuration::deleteByName('PLAT_CUSTOM_URL') OR
		!Configuration::deleteByName('PLAT_TOOLBOX_SERVICES') OR
		!Configuration::deleteByName('PLAT_TOOLBOX_SERVICES_MODE') OR
		!Configuration::deleteByName('PLAT_ICON_DIMENSION') OR
		!Configuration::deleteByName('PLAT_BRAND') OR
		!Configuration::deleteByName('PLAT_HEADER_COLOR') OR
		!Configuration::deleteByName('PLAT_HEADER_BACKGROUND') OR
		!Configuration::deleteByName('PLAT_SERVICES_COMPACT') OR
		!Configuration::deleteByName('PLAT_SERVICES_EXCLUDE') OR
		!Configuration::deleteByName('PLAT_SERVICES_EXPANDED') OR
		!Configuration::deleteByName('PLAT_SERVICES_CUSTOM') OR
		!Configuration::deleteByName('PLAT_OFFSET_TOP') OR
		!Configuration::deleteByName('PLAT_OFFSET_LEFT') OR
		!Configuration::deleteByName('PLAT_HOVER_DELAY') OR
		!Configuration::deleteByName('PLAT_CLICK') OR
		!Configuration::deleteByName('PLAT_HOVER_DIRECTION') OR
		!Configuration::deleteByName('PLAT_USE_ADDRESSBOOK') OR
		!Configuration::deleteByName('PLAT_508_COMPLIANT') OR
		!Configuration::deleteByName('PLAT_DATA_TRACK_CLICKBACK') OR
		!Configuration::deleteByName('PLAT_HIDE_EMBED') OR
		!Configuration::deleteByName('PLAT_USE_CSS') OR
		!Configuration::deleteByName('PLAT_GA_TRACKER'))
			return false;
		return true;
	}

	private function _postProcess()
	{
		Configuration::updateValue('PLAT_PROFILE_ID', Tools::getValue('profile_id'));
		Configuration::updateValue('PLAT_BUTTON_STYLE', Tools::getValue('button_style'));
		Configuration::updateValue('PLAT_CUSTOM_URL', Tools::getValue('custom_url'));
		Configuration::updateValue('PLAT_TOOLBOX_SERVICES', Tools::getValue('toolbox_services'));
		Configuration::updateValue('PLAT_TOOLBOX_SERVICES_MODE', Tools::getValue('toolbox_more_services_mode'));
		Configuration::updateValue('PLAT_ICON_DIMENSION', Tools::getValue('icon_dimension'));
		Configuration::updateValue('PLAT_BRAND', Tools::getValue('brand'));
		Configuration::updateValue('PLAT_HEADER_COLOR', Tools::getValue('header_color'));
		Configuration::updateValue('PLAT_HEADER_BACKGROUND', Tools::getValue('header_background'));
		Configuration::updateValue('PLAT_SERVICES_COMPACT', Tools::getValue('services_compact'));
		Configuration::updateValue('PLAT_SERVICES_EXCLUDE', Tools::getValue('services_exclude'));
		Configuration::updateValue('PLAT_SERVICES_EXPANDED', Tools::getValue('services_expanded'));
		Configuration::updateValue('PLAT_SERVICES_CUSTOM', Tools::getValue('services_custom'));
		Configuration::updateValue('PLAT_OFFSET_TOP', Tools::getValue('offset_top'));
		Configuration::updateValue('PLAT_OFFSET_LEFT', Tools::getValue('offset_left'));
		Configuration::updateValue('PLAT_HOVER_DELAY', Tools::getValue('hover_delay'));
		Configuration::updateValue('PLAT_CLICK', Tools::getValue('click'));
		Configuration::updateValue('PLAT_HOVER_DIRECTION', Tools::getValue('hover_direction'));
		Configuration::updateValue('PLAT_USE_ADDRESSBOOK', Tools::getValue('use_addressbook'));
		Configuration::updateValue('PLAT_508_COMPLIANT', Tools::getValue('508_compliant'));
		Configuration::updateValue('PLAT_DATA_TRACK_CLICKBACK', Tools::getValue('data_track_clickback'));
		Configuration::updateValue('PLAT_HIDE_EMBED', Tools::getValue('hide_embed'));
		Configuration::updateValue('PLAT_USE_CSS', Tools::getValue('use_css'));
		Configuration::updateValue('PLAT_GA_TRACKER', Tools::getValue('ga_tracker'));
		
		$this->_html .= '<div class="conf confirm">'.$this->l('Settings updated').'</div>';
	}
	
	public function getContent()
	{
		$this->_html .= '<h2>'.$this->displayName.'</h2>';
		 if (Tools::isSubmit('submit')) $this->_postProcess();
		$this->_displayForm();
		
		return $this->_html;
	}
	
	private function _displayForm()
	{
		$this->_html .= '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset>
				<legend><img src="../img/admin/cog.gif" alt="" class="middle" />'.$this->l('Settings').'</legend>
				<label>'.$this->l('AddThis Profile ID').'</label>
				<div class="margin-form">
					<input type="text" name="profile_id" value="'.Tools::getValue('profile_id', Configuration::get('PLAT_PROFILE_ID')).'"/>
					<p class="clear">'.$this->l('Profile ID under your AddThis account').'</p>
				</div>
				<label>'.$this->l('Button Style').'</label>
				<div class="margin-form">
					<input type="radio" name="button_style" value="lg-share"'.(Tools::getValue('button_style', Configuration::get('PLAT_BUTTON_STYLE')) == "lg-share" ? ' checked="checked"' : '').' > <img src="http://s7.addthis.com/static/btn/lg-share-en.gif"/><br/><br/></option>
					<input type="radio" name="button_style" value="lg-bookmark"'.(Tools::getValue('button_style', Configuration::get('PLAT_BUTTON_STYLE')) == "lg-bookmark" ? ' checked="checked"' : '').' > <img src="http://s7.addthis.com/static/btn/lg-bookmark-en.gif"/><br/><br/></option>
					<input type="radio" name="button_style" value="lg-addthis"'.(Tools::getValue('button_style', Configuration::get('PLAT_BUTTON_STYLE')) == "lg-addthis" ? ' checked="checked"' : '').' > <img src="http://s7.addthis.com/static/btn/lg-addthis-en.gif"/><br/><br/></option>
					<input type="radio" name="button_style" value="sm-share"'.(Tools::getValue('button_style', Configuration::get('PLAT_BUTTON_STYLE')) == "sm-share" ? ' checked="checked"' : '').' > <img src="http://s7.addthis.com/static/btn/sm-share-en.gif"/><br/><br/></option>
					<input type="radio" name="button_style" value="sm-bookmark"'.(Tools::getValue('button_style', Configuration::get('PLAT_BUTTON_STYLE')) == "sm-bookmark" ? ' checked="checked"' : '').' > <img src="http://s7.addthis.com/static/btn/sm-bookmark-en.gif"/><br/><br/></option>
					<input type="radio" name="button_style" value="sm-plus"'.(Tools::getValue('button_style', Configuration::get('PLAT_BUTTON_STYLE')) == "sm-plus" ? ' checked="checked"' : '').' > <img src="http://s7.addthis.com/static/btn/sm-plus.gif"/><br/><br/></option>
					<input type="radio" name="button_style" value="toolbox"'.(Tools::getValue('button_style', Configuration::get('PLAT_BUTTON_STYLE')) == "toolbox" ? ' checked="checked"' : '').' > <img src="http://s7.addthis.com/static/btn/sm-plus.gif"/> TOOLBOX<br/><br/></option>
					<input type="radio" name="button_style" value="custom"'.(Tools::getValue('button_style', Configuration::get('PLAT_BUTTON_STYLE')) == "custom" ? ' checked="checked"' : '').' > CUSTOM BUTTON</option>
					<p class="clear"></p>
				</div>
				<label>'.$this->l('Custom Button URL').'</label>
				<div class="margin-form">
					<input type="text" name="custom_url" value="'.Tools::getValue('custom_url', Configuration::get('PLAT_CUSTOM_URL')).'" size="60" />
					<p class="clear">'.$this->l('URL for your button If you selected Custom Button above').'</p>
				</div>
				<label>'.$this->l('Toolbox Services').'</label>
				<div class="margin-form">
					<input type="text" name="toolbox_services" value="'.Tools::getValue('toolbox_services', Configuration::get('PLAT_TOOLBOX_SERVICES')).'" size="100" />
					<p class="clear">'.$this->l('Services to be shown in the toolbox. Applicable only if toolbox mode is selected').'</p>
				</div>

				<label>'.$this->l('Toolbox more services mode').'</label>
				<div class="margin-form">
					<select name = "toolbox_more_services_mode">
						<option value="expanded"'.(Tools::getValue('toolbox_more_services_mode', Configuration::get('PLAT_TOOLBOX_SERVICES_MODE')) == "expanded" ? ' SELECTED' : '').' >Expanded</option>
						<option value="compact"'.(Tools::getValue('toolbox_more_services_mode', Configuration::get('PLAT_TOOLBOX_SERVICES_MODE')) == "compact" ? ' SELECTED' : '').' >Compact</option>
						<option value="counter"'.(Tools::getValue('toolbox_more_services_mode', Configuration::get('PLAT_TOOLBOX_SERVICES_MODE')) == "counter" ? ' SELECTED' : '').' >Share Counter</option>
					</select>
					<p class="clear">'.$this->l('Visibility of compact menu when toolbox mode is selected').'</p>
				</div>
				<label>'.$this->l('Toolbox icon dimension').'</label>
				<div class="margin-form">
					<input type="radio" name="icon_dimension" value="16"'.(Tools::getValue('icon_dimension', Configuration::get('PLAT_ICON_DIMENSION')) == "16" ? ' checked="checked"' : '').' > 16</option>
					<input type="radio" name="icon_dimension" value="32"'.(Tools::getValue('icon_dimension', Configuration::get('PLAT_ICON_DIMENSION')) == "32" ? ' checked="checked"' : '').' > 32</option>
					<p class="clear">'.$this->l('Size of the icons to be shown in toolbox').'</p>
				</div>
				<label>'.$this->l('Brand').'</label>
				<div class="margin-form">
					<input type="text" name="brand" value="'.Tools::getValue('brand', Configuration::get('PLAT_BRAND')).'"/>
					<p class="clear">'.$this->l('Text label that shows on the top right of the menu').'</p>
				</div>
				<label>'.$this->l('Header Color').'</label>
				<div class="margin-form">
					<input type="text" name="header_color" value="'.Tools::getValue('header_color', Configuration::get('PLAT_HEADER_COLOR')).'"/>
					<p class="clear">'.$this->l('Custom color to use for the text foreground in the header of the menu, in hex. (ex: "#ff0000"). Leave blank for default.').'</p>
				</div>
				<label>'.$this->l('Header Background').'</label>
				<div class="margin-form">
					<input type="text" name="header_background" value="'.Tools::getValue('header_background', Configuration::get('PLAT_HEADER_BACKGROUND')).'"/>
					<p class="clear">'.$this->l('Custom color to use as a background in the header of the menu, iin hex. (ex: "#ff0000"). Leave blank for default.').'</p>
				</div>
				<label>'.$this->l('Services to show in the compact menu').'</label>
				<div class="margin-form">
					<input type="text" name="services_compact" value="'.Tools::getValue('services_compact', Configuration::get('PLAT_SERVICES_COMPACT')).'"/>
					<p class="clear">'.$this->l('Comma-separated list of services to show in the compact menu. Leave blank for default.').'</p>
				</div>
				<label>'.$this->l('Services to exclude').'</label>
				<div class="margin-form">
					<input type="text" name="services_exclude" value="'.Tools::getValue('services_exclude', Configuration::get('PLAT_SERVICES_EXCLUDE')).'" size="60" />
					<p class="clear">'.$this->l('Comma-separated 	list of services to be excluded from the menu. Leave blank for default.').'</p>
				</div>
				<label>'.$this->l('Services to show in the expanded menu').'</label>
				<div class="margin-form">
					<input type="text" name="services_expanded" value="'.Tools::getValue('services_expanded', Configuration::get('PLAT_SERVICES_EXPANDED')).'" size="60" />
					<p class="clear">'.$this->l('Comma-separated list of services to be shown in the expanded menu. Leave blank for default.').'</p>
				</div>
				<label>'.$this->l('Custom services to show in the menu').'</label>
				<div class="margin-form">
					<input type="text" name="services_custom" value="'.Tools::getValue('services_custom', Configuration::get('PLAT_SERVICES_CUSTOM')).'" size="60" />
					<p class="clear">'.$this->l('Specify your own AddThis bookmarking service like so:{name: \'My Service\',url: \'http://share.example.com?url={{URL}}\',icon: \'http://example.com/icon.jpg\'. All three fields must be present for each custom service.').'</p>
				</div>
				<label>'.$this->l('Menu Top Offset').'</label>
				<div class="margin-form">
					<input type="text" name="offset_top" value="'.Tools::getValue('offset_top', Configuration::get('PLAT_OFFSET_TOP')).'"/>
					<p class="clear">'.$this->l('Vertical offset for the drop-down window (in pixels). Leave blank for default..').'</p>
				</div>
				<label>'.$this->l('Menu Left Offset').'</label>
				<div class="margin-form">
					<input type="text" name="offset_left" value="'.Tools::getValue('offset_left', Configuration::get('PLAT_OFFSET_LEFT')).'"/>
					<p class="clear">'.$this->l('Horizontal offset for the drop-down window (in pixels). Leave blank for default..').'</p>
				</div>
				<label>'.$this->l('Hover Delay').'</label>
				<div class="margin-form">
					<input type="text" name="hover_delay"" value="'.Tools::getValue('hover_delay"', Configuration::get('PLAT_HOVER_DELAY')).'"/>
					<p class="clear">'.$this->l('Delay in opening of the compact menu in milliseconds (minimum 50, maximum 500). Leave blank for default.').'</p>
				</div>
				<label>'.$this->l('Menu on click of the button').'</label>
				<div class="margin-form">
					<input type="radio" name="click" value="1"'.(Tools::getValue('click', Configuration::get('PLAT_CLICK')) == "1" ? ' checked="checked"' : '').' > Yes</option>
					<input type="radio" name="click" value="0"'.(Tools::getValue('click', Configuration::get('PLAT_CLICK')) == "0" ? ' checked="checked"' : '').' > No</option>
					<p class="clear">'.$this->l('If true compact menu will appear only upon click of the sharing button. Leave blank for default.').'</p>
				</div>
				<label>'.$this->l('Menu open direction').'</label>
				<div class="margin-form">
					<input type="radio" name="hover_direction" value="0"'.(Tools::getValue('hover_direction', Configuration::get('PLAT_HOVER_DIRECTION')) == "0" ? ' checked="checked"' : '').' > Auto</option>
					<input type="radio" name="hover_direction" value="1"'.(Tools::getValue('hover_direction', Configuration::get('PLAT_HOVER_DIRECTION')) == "1" ? ' checked="checked"' : '').' > Up</option>
					<input type="radio" name="hover_direction" value="-1"'.(Tools::getValue('hover_direction', Configuration::get('PLAT_HOVER_DIRECTION')) == "-1" ? ' checked="checked"' : '').' > Down</option>
					<p class="clear">'.$this->l('Normally, show the compact menu in the direction of the user\'s browser that has the most space. You can override this behavior with this setting.').'</p>
				</div>
				<label>'.$this->l('Show address book').'</label>
				<div class="margin-form">
					<input type="radio" name="use_addressbook" value="1"'.(Tools::getValue('use_addressbook', Configuration::get('PLAT_USE_ADDRESSBOOK')) == "1" ? ' checked="checked"' : '').' > Yes</option>
					<input type="radio" name="use_addressbook" value="0"'.(Tools::getValue('use_addressbook', Configuration::get('PLAT_USE_ADDRESSBOOK')) == "0" ? ' checked="checked"' : '').' > No</option>
					<p class="clear">'.$this->l('If true, the user will be able import their contacts from popular webmail services when using AddThis\'s email sharing. Leave blank for default.').'</p>
				</div>
				<label>'.$this->l('508 Compliant').'</label>
				<div class="margin-form">
					<input type="radio" name="508_compliant" value="1"'.(Tools::getValue('508_compliant', Configuration::get('PLAT_508_COMPLIANT')) == "1" ? ' checked="checked"' : '').' > Yes</option>
					<input type="radio" name="508_compliant" value="0"'.(Tools::getValue('508_compliant', Configuration::get('PLAT_508_COMPLIANT')) == "0" ? ' checked="checked"' : '').' > No</option>
					<p class="clear">'.$this->l('If true, clicking the AddThis button will open a new window to a page supporting sharing without JavaScript. Leave blank for default.').'</p>
				</div>
				<label>'.$this->l('Track click backs').'</label>
				<div class="margin-form">
					<input type="radio" name="data_track_clickback" value="1"'.(Tools::getValue('data_track_clickback', Configuration::get('PLAT_DATA_TRACK_CLICKBACK')) == "1" ? ' checked="checked"' : '').' > Yes</option>
					<input type="radio" name="data_track_clickback" value="0"'.(Tools::getValue('data_track_clickback', Configuration::get('PLAT_DATA_TRACK_CLICKBACK')) == "0" ? ' checked="checked"' : '').' > No</option>
					<p class="clear">'.$this->l('Set to true to allow us to append a variable to your URLs upon sharing. We\'ll use this to track how many people come back to your content via links shared with AddThis. Highly recommended. Leave blank for default.').'</p>
				</div>
				<label>'.$this->l('Hide Flash Content').'</label>
				<div class="margin-form">
					<input type="radio" name="hide_embed" value="1"'.(Tools::getValue('hide_embed', Configuration::get('PLAT_HIDE_EMBED')) == "1" ? ' checked="checked"' : '').' > Yes</option>
					<input type="radio" name="hide_embed" value="0"'.(Tools::getValue('hide_embed', Configuration::get('PLAT_HIDE_EMBED')) == "0" ? ' checked="checked"' : '').' > No</option>
					<p class="clear">'.$this->l('Temporarily hide flash objects that intersect the menu. Default is true.').'</p>
				</div>
				<label>'.$this->l('Load AddThis CSS').'</label>
				<div class="margin-form">
					<input type="radio" name="use_css" value="1"'.(Tools::getValue('use_css', Configuration::get('PLAT_USE_CSS')) == "1" ? ' checked="checked"' : '').' > Yes</option>
					<input type="radio" name="use_css" value="0"'.(Tools::getValue('use_css', Configuration::get('PLAT_USE_CSS')) == "0" ? ' checked="checked"' : '').' > No</option>
					<p class="clear">'.$this->l('If false, we will not load our standard CSS file, allowing you to style everything yourself without incurring the cost of an additonal load.').'</p>
				</div>
				<label>'.$this->l('Google Analytics tracking object').'</label>
				<div class="margin-form">
					<input type="text" name="ga_tracker" value="'.Tools::getValue('ga_tracker', Configuration::get('PLAT_GA_TRACKER')).'" size="60" />
					<p class="clear">'.$this->l('Google Analytics tracking object, or the name of a global variable that references it. If set, we\'ll send AddThis tracking events to Google, so you can have integrated reporting.').'</p>
				</div>

						
				<input type="submit" name="submit" value="'.$this->l('Save').'" class="button" />
			</fieldset>
		</form>';
	}
	//HOOK_EXTRA_RIGHT
	public function hookExtraRight()
	{
		global $cookie, $link;
		/* Product informations */
		$product = new Product((int)Tools::getValue('id_product'), false, (int)$cookie->id_lang);
		$this->currentproduct = $product;
		$productLink = $link->getProductLink($product);
		$language = strtolower(Language::getIsoById($cookie->id_lang));

		$arrParams = array("PLAT_PROFILE_ID", "PLAT_BUTTON_STYLE", "PLAT_CUSTOM_URL", "PLAT_TOOLBOX_SERVICES", "PLAT_ICON_DIMENSION",
        				   "PLAT_BRAND", "PLAT_HEADER_COLOR", "PLAT_HEADER_BACKGROUND", "PLAT_SERVICES_COMPACT",
        				   "PLAT_SERVICES_EXCLUDE", "PLAT_SERVICES_EXPANDED", "PLAT_SERVICES_CUSTOM", "PLAT_OFFSET_TOP",
        				   "PLAT_OFFSET_LEFT", "PLAT_HOVER_DELAY", "PLAT_CLICK", "PLAT_HOVER_DIRECTION",
        				   "PLAT_USE_ADDRESSBOOK", "PLAT_508_COMPLIANT", "PLAT_DATA_TRACK_CLICKBACK",
        				   "PLAT_HIDE_EMBED", "PLAT_TOOLBOX_SERVICES_MODE",
        				   "PLAT_USE_CSS", "PLAT_GA_TRACKER");
        foreach ( $arrParams as $key => $value ) {
			$this->arrParamValues[$value] = Configuration::get($value);
		}
    	$configValue = "";
		$arrConfigs = array("PLAT_PROFILE_ID" => "pubid", "PLAT_BRAND" => "ui_cobrand", "PLAT_HEADER_COLOR" => "ui_header_color",
							"PLAT_HEADER_BACKGROUND" => "ui_header_background", "PLAT_SERVICES_COMPACT" => "services_compact",
							"PLAT_SERVICES_EXCLUDE" => "services_exclude", "PLAT_SERVICES_EXPANDED" => "services_expanded",
							"PLAT_SERVICES_CUSTOM" => "services_custom", "PLAT_OFFSET_TOP" => "ui_offset_top",
							"PLAT_OFFSET_LEFT" => "ui_offset_left", "PLAT_HOVER_DELAY" => "ui_delay", "PLAT_CLICK" => "ui_click",
							"PLAT_HOVER_DIRECTION" => "ui_hover_direction", "PLAT_USE_ADDRESSBOOK" => "ui_use_addressbook",
							"PLAT_508_COMPLIANT" => "ui_508_compliant", "PLAT_DATA_TRACK_CLICKBACK" => "data_track_clickback",
							"PLAT_HIDE_EMBED" => "ui_hide_embed", "PLAT_USE_CSS" => "ui_use_css", "PLAT_GA_TRACKER" => "data_ga_tracker");

		foreach ( $arrConfigs as $key => $value ) {
		   if(in_array($value, array("pubid", "ui_cobrand", "ui_header_color", "ui_header_background", "services_compact",
		               "services_exclude", "services_expanded", "ui_language")) && ($this->arrParamValues[$key] != ""))
		           $configValue .= $value . ":'" . $this->arrParamValues[$key] . "'," . PHP_EOL;
		   elseif(in_array($value, array("ui_offset_top", "ui_offset_left", "ui_delay", "ui_hover_direction", "data_ga_tracker",
		               "services_custom")) && ($this->arrParamValues[$key] != ""))
				   $configValue .= $value . ":" . $this->arrParamValues[$key] . "," .  PHP_EOL;
		   elseif(in_array($value, array("ui_click", "ui_use_addressbook", "ui_508_compliant", "data_track_clickback", "ui_hide_embed",
		               "ui_use_css", )) && ($this->arrParamValues[$key] != ""))
				   $configValue .= "1" == $this->arrParamValues[$key]? $value . ":true," . PHP_EOL : (("ui_use_css" == $value || "data_track_clickback" == $value) ? $value . ":false," . PHP_EOL : "");
		}

    	//Creating div elements for AddThis
		$outputValue = " <div class='prestalove_add_this'>";
		$outputValue .= "<!-- AddThis Button BEGIN -->" . PHP_EOL;

		//Creates addthis configuration script
	    $outputValue .= "<script type='text/javascript'>\r\n";
	    $outputValue .= "var addthis_product = 'jlp-1.2';\r\n";
		$outputValue .="var addthis_config =\r\n{";

    	//Removing the last comma and end of line characters
    	if("" != trim($configValue))
		{
		  	$outputValue .= implode( ',', explode( ',', $configValue, -1 ));
		}
		$outputValue .= "}</script>". PHP_EOL;

        //Creates the button code depending on the button style chosen
        $buttonValue = "";

		if("toolbox" == $this->arrParamValues["PLAT_BUTTON_STYLE"])
        {
        	 $buttonValue .= $this->getToolboxScript($this->arrParamValues["PLAT_TOOLBOX_SERVICES"], $productLink);
        }
        //Generates button code for rest of the button styles
        else
		{
			$buttonValue .= "<a href='http://www.addthis.com/bookmark.php' ".
				" onmouseover=\"return addthis_open(this,'', '". urldecode($productLink)."', '".$product->name."' )\" ".
			" onmouseout='addthis_close();' onclick='return addthis_sendto();'>";
		    $buttonValue .= "<img src='";
			
		    //Custom image for button
			if ("custom" == trim($this->arrParamValues["PLAT_BUTTON_STYLE"]))
	    	{
		        if ("" == trim($this->arrParamValues["PLAT_CUSTOM_URL"]))
		        {
		            $buttonValue .= "http://s7.addthis.com/static/btn/v2/" .  $this->getButtonImage('lg-share',$language);
					
		        }
	        	else $buttonValue .= $this->arrParamValues["PLAT_CUSTOM_URL"];
	    	}
	    	//Pointing to addthis button images
	    	else
		    {
				$buttonValue .= "http://s7.addthis.com/static/btn/v2/" . $this->getButtonImage($this->arrParamValues["PLAT_BUTTON_STYLE"],$language);
			}
			$buttonValue .= "' border='0' alt='AddThis Social Bookmark Button' />";
			$buttonValue .= "</a>". PHP_EOL;
		}
		$outputValue .= $buttonValue;
		
		//Adding AddThis script to the page
		$outputValue .= "<script type='text/javascript' src='http://s7.addthis.com/js/250/addthis_widget.js'></script>\r\n";
		$outputValue .= "<!-- AddThis Button END -->". PHP_EOL;
		$outputValue .= "</div>";
		
		return $outputValue;
    }

    private function getToolboxScript($services, $productLink)
    {
	//Deciding the toobox icon dimensions
		$product = $this->currentproduct;
    	$dimensionStyle = $this->arrParamValues["PLAT_ICON_DIMENSION"] == "16" ? '' : ' addthis_32x32_style';
    	//Toolbox main div element, holds the url and title for sharing
    	$toolboxScript  = "<div class='addthis_toolbox" . $dimensionStyle . " addthis_default_style' addthis:url='".$productLink."' addthis:title='" . htmlspecialchars($product->name, ENT_QUOTES) . "'>";
    	$serviceList = explode(",", $services);
    	//Adding the services one by one
    	for ( $i = 0, $max_count = sizeof( $serviceList ); $i < $max_count; $i++ )
    	{
			$toolboxScript .= "<a class='addthis_button_" . $serviceList[$i] . "'></a>";
		}
		//Adding more services button in user selected mode - (Expanded | Compact || share counter)
		/*$toolboxScript .= ("expanded" == $this->arrParamValues["PLAT_TOOLBOX_SERVICES_MODE"] || "compact" == $this->arrParamValues["PLAT_TOOLBOX_SERVICES_MODE"]) ? "<a class='addthis_button_" . $this->arrParamValues["PLAT_TOOLBOX_SERVICES_MODE"] ."'></a>" : "<a class='addthis_" . $this->arrParamValues["PLAT_TOOLBOX_SERVICES_MODE"] ." addthis_pill_style'></a>";*/
		$toolboxScript .= "</div>";
		return $toolboxScript;
    }
	
    private function getButtonImage($name, $language)
    {
       $buttonImage = "";
       if ("sm-plus" == $name)
            $buttonImage = $name . '.gif';
       elseif ($language != 'en')
       {
            if (in_array($name, array("lg-share", "lg-bookmark", "lg-addthis")))
                $buttonImage = 'lg-share-' . $language . '.gif';
            elseif(in_array($name, array("sm-share", "sm-bookmark")))
                $buttonImage = 'sm-share-' . $language . '.gif';
       }
       else
            $buttonImage = $name . '-' . $language . '.gif';
       return $buttonImage;
    }
	
	
	public function hookHeader($params)
	{
		global $smarty;	
		return $this->display(__FILE__, 'prestaloveaddthis-header.tpl');
	}
	 
	
}

