<?php

class CoolShare extends Module
{
	function __construct()
	{
		$this->name = 'coolshare';
		if(_PS_VERSION_ < "1.4.0.0"){
		$this->tab = 'Blocks';
		}
		if(_PS_VERSION_ > "1.4.0.0" && _PS_VERSION_ < "1.5.0.0")
		{
		$this->tab = 'front_office_features';
			}
		else
		{
				$this->tab = 'social_networks';
			}	
		$this->version = 1.8;	
			$this->author = 'RSI';
$this->need_instance = 0;
		parent::__construct();
	$this->error = false;
		$this->valid = false;
	
		$this->displayName = $this->l('Block of social share');
		$this->description = $this->l('Adds a block to display social bookmarks - www.catalogo-onlinersi.com.ar');
	}

	function install()
	{
	if (parent::install() == false OR $this->registerHook('header') == false OR !$this->registerHook('extraright'))
	 		return false;
				if (!Configuration::updateValue('COOLSHARE_WIDTHCS', '40'))
			return false;
				if (!Configuration::updateValue('COOLSHARE_FORMATCS', ''))
			return false;
			if (!Configuration::updateValue('COOLSHARE_FLOAT', 'left'))
			return false;
			if (!Configuration::updateValue('COOLSHARE_MARGIN', '0'))
			return false;
			if (!Configuration::updateValue('COOLSHARE_c1', 'yes'))
			return false;
			if (!Configuration::updateValue('COOLSHARE_c2', 'yes'))
			return false;
			if (!Configuration::updateValue('COOLSHARE_c3', 'yes'))
			return false;
			if (!Configuration::updateValue('COOLSHARE_c4', 'yes'))
			return false;
			if (!Configuration::updateValue('COOLSHARE_c6', 'yes'))
			return false;
			if (!Configuration::updateValue('COOLSHARE_c7', 'yes'))
			return false;
			if (!Configuration::updateValue('COOLSHARE_c8', 'yes'))
			return false;
			if (!Configuration::updateValue('COOLSHARE_c9', 'yes'))
			return false;
			if (!Configuration::updateValue('COOLSHARE_c10', 'yes'))
			return false;
			if (!Configuration::updateValue('COOLSHARE_c11', 'yes'))
			return false;
			if (!Configuration::updateValue('COOLSHARE_c12', 'yes'))
			return false;
				if (!Configuration::updateValue('COOLSHARE_c5', 'yes'))
			return false;
			if (!Configuration::updateValue('COOLSHARE_WIDTH', '200'))
			return false;
				if (!Configuration::updateValue('COOLSHARE_HEIGHT', '45'))
			return false;
			
	 	return true;
	}

public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitCoolshare'))
		{
			
			$widthcs = Tools::getValue('widthcs');
			$formatcs = Tools::getValue('formatcs');
			$float = Tools::getValue('float');
			$margin = Tools::getValue('margin');
			$c1 = Tools::getValue('c1');
			$c2 = Tools::getValue('c2');
			$c3 = Tools::getValue('c3');
			$c4 = Tools::getValue('c4');
				$c5 = Tools::getValue('c5');
				$c6 = Tools::getValue('c6');
				$c7 = Tools::getValue('c7');
				$c8 = Tools::getValue('c8');
				$c9 = Tools::getValue('c9');
					$c10 = Tools::getValue('c10');
						$c11 = Tools::getValue('c11');
						$c12 = Tools::getValue('c12');
				$width = Tools::getValue('width');
				$height = Tools::getValue('height');
	
				Configuration::updateValue('COOLSHARE_WIDTHCS', $widthcs);
				Configuration::updateValue('COOLSHARE_WIDTH', $width);
				Configuration::updateValue('COOLSHARE_MARGIN', $margin);
				Configuration::updateValue('COOLSHARE_HEIGHT', $height);
					Configuration::updateValue('COOLSHARE_FORMATCS', $formatcs);
					Configuration::updateValue('COOLSHARE_FLOAT', $float);
				Configuration::updateValue('COOLSHARE_c1', $c1);
				Configuration::updateValue('COOLSHARE_c2', $c2);
				Configuration::updateValue('COOLSHARE_c3', $c3);
				Configuration::updateValue('COOLSHARE_c4', $c4);
				Configuration::updateValue('COOLSHARE_c5', $c5);
					Configuration::updateValue('COOLSHARE_c6', $c6);
						Configuration::updateValue('COOLSHARE_c7', $c7);
							Configuration::updateValue('COOLSHARE_c8', $c8);
								Configuration::updateValue('COOLSHARE_c9', $c9);
								Configuration::updateValue('COOLSHARE_c10', $c10);
								Configuration::updateValue('COOLSHARE_c11', $c11);
								Configuration::updateValue('COOLSHARE_c12', $c12);
	
				
			if (isset($errors) AND sizeof($errors))
				$output .= $this->displayError(implode('<br />', $errors));
			else
				$output .= $this->displayConfirmation($this->l('Settings updated'));
		}
		return $output.$this->displayForm();
	}
	public function displayForm()
	{
		$output = '
	
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
	
	<label>'.$this->l('Width of images').'</label>
				<div class="margin-form">
					<input type="text" size="5" name="widthcs" value="'.Tools::getValue('widthcs', Configuration::get('COOLSHARE_WIDTHCS')).'" />
					<p class="clear">'.$this->l('Width of the images').'</p>
					
				</div>
				<label>'.$this->l('Width of module').'</label>
				<div class="margin-form">
					<input type="text" size="5" name="width" value="'.Tools::getValue('width', Configuration::get('COOLSHARE_WIDTH')).'" />
					<p class="clear">'.$this->l('Width of the modules (200 default)').'</p>
					
				</div>
				<label>'.$this->l('Height of module').'</label>
				<div class="margin-form">
					<input type="text" size="5" name="height" value="'.Tools::getValue('height', Configuration::get('COOLSHARE_HEIGHT')).'" />
					<p class="clear">'.$this->l('Height of the module (48 default)').'</p>
					
				</div>
				<label>'.$this->l('Margin left of the module').'</label>
				<div class="margin-form">
					<input type="text" size="5" name="margin" value="'.Tools::getValue('margin', Configuration::get('COOLSHARE_MARGIN')).'" />
				
					
				</div>
					<label>'.$this->l('Image format').'</label>
	<div class="margin-form">
  <select name="formatcs" >
  <option value=""'.((Configuration::get('COOLSHARE_FORMATCS') == "") ? 'selected="selected"' : '').'>Rounded images</option>
	  <option value="2"'.((Configuration::get('COOLSHARE_FORMATCS') == "2") ? 'selected="selected"' : '').'>Square images</option>
    </select>
	</div>
		<label>'.$this->l('Position').'</label>
	<div class="margin-form">
  <select name="float" >
  <option value="float:left"'.((Configuration::get('COOLSHARE_FLOAT') == "float:left") ? 'selected="selected"' : '').'>Left</option>
	  <option value="float:right"'.((Configuration::get('COOLSHARE_FLOAT') == "float:right") ? 'selected="selected"' : '').'>Right</option>
	
    </select>
	</div>
	<label>'.$this->l('Technorati').'</label>
	<div class="margin-form">
  <select name="c1" >
  <option value="yes"'.((Configuration::get('COOLSHARE_c1') == "yes") ? 'selected="selected"' : '').'>Yes</option>
	  <option value="no"'.((Configuration::get('COOLSHARE_c1') == "no") ? 'selected="selected"' : '').'>No</option>
    </select>

		
		</div>
			<label>'.$this->l('Delicious').'</label>
	<div class="margin-form">
  <select name="c2" >
  <option value="yes"'.((Configuration::get('COOLSHARE_c2') == "yes") ? 'selected="selected"' : '').'>Yes</option>
	  <option value="no"'.((Configuration::get('COOLSHARE_c2') == "no") ? 'selected="selected"' : '').'>No</option>
    </select>

		
		</div>
			<label>'.$this->l('Reddit').'</label>
	<div class="margin-form">
  <select name="c3" >
  <option value="yes"'.((Configuration::get('COOLSHARE_c3') == "yes") ? 'selected="selected"' : '').'>Yes</option>
	  <option value="no"'.((Configuration::get('COOLSHARE_c3') == "no") ? 'selected="selected"' : '').'>No</option>
    </select>

		
		</div>
			<label>'.$this->l('Facebook').'</label>
	<div class="margin-form">
  <select name="c4" >
  <option value="yes"'.((Configuration::get('COOLSHARE_c4') == "yes") ? 'selected="selected"' : '').'>Yes</option>
	  <option value="no"'.((Configuration::get('COOLSHARE_c4') == "no") ? 'selected="selected"' : '').'>No</option>
    </select>

		
		</div>
			<label>'.$this->l('Twitter').'</label>
	<div class="margin-form">
  <select name="c5" >
  <option value="yes"'.((Configuration::get('COOLSHARE_c5') == "yes") ? 'selected="selected"' : '').'>Yes</option>
	  <option value="no"'.((Configuration::get('COOLSHARE_c5') == "no") ? 'selected="selected"' : '').'>No</option>
    </select>

		
		</div>
			
				<label>'.$this->l('Stumbleupon').'</label>
	<div class="margin-form">
  <select name="c6" >
  <option value="yes"'.((Configuration::get('COOLSHARE_c6') == "yes") ? 'selected="selected"' : '').'>Yes</option>
	  <option value="no"'.((Configuration::get('COOLSHARE_c6') == "no") ? 'selected="selected"' : '').'>No</option>
    </select>
	
		
		</div>
				<label>'.$this->l('Yahoo').'</label>
	<div class="margin-form">
  <select name="c7" >
  <option value="yes"'.((Configuration::get('COOLSHARE_c7') == "yes") ? 'selected="selected"' : '').'>Yes</option>
	  <option value="no"'.((Configuration::get('COOLSHARE_c7') == "no") ? 'selected="selected"' : '').'>No</option>
    </select>

		
		</div>
				<label>'.$this->l('Digg').'</label>
	<div class="margin-form">
  <select name="c8" >
  <option value="yes"'.((Configuration::get('COOLSHARE_c8') == "yes") ? 'selected="selected"' : '').'>Yes</option>
	  <option value="no"'.((Configuration::get('COOLSHARE_c8') == "no") ? 'selected="selected"' : '').'>No</option>
    </select>

		
		</div> <!--
					<label>'.$this->l('Flickr').'</label>
	<div class="margin-form">
  <select name="c9" >
  <option value="yes"'.((Configuration::get('COOLSHARE_c9') == "yes") ? 'selected="selected"' : '').'>Yes</option>
	  <option value="no"'.((Configuration::get('COOLSHARE_c9') == "no") ? 'selected="selected"' : '').'>No</option>
    </select>

		
		</div> -->
			<label>'.$this->l('Linkedin').'</label>
	<div class="margin-form">
  <select name="c10" >
  <option value="yes"'.((Configuration::get('COOLSHARE_c10') == "yes") ? 'selected="selected"' : '').'>Yes</option>
	  <option value="no"'.((Configuration::get('COOLSHARE_c10') == "no") ? 'selected="selected"' : '').'>No</option>
    </select>

		
		</div>
		<label>'.$this->l('Mail').'</label>
	<div class="margin-form">
  <select name="c11" >
  <option value="yes"'.((Configuration::get('COOLSHARE_c11') == "yes") ? 'selected="selected"' : '').'>Yes</option>
	  <option value="no"'.((Configuration::get('COOLSHARE_c11') == "no") ? 'selected="selected"' : '').'>No</option>
    </select>

		
		</div>
				<label>'.$this->l('Google +1').'</label>
	<div class="margin-form">
  <select name="c12" >
  <option value="yes"'.((Configuration::get('COOLSHARE_c12') == "yes") ? 'selected="selected"' : '').'>Yes</option>
	  <option value="no"'.((Configuration::get('COOLSHARE_c12') == "no") ? 'selected="selected"' : '').'>No</option>
    </select>

		
		</div>
		
	
				<center><input type="submit" name="submitCoolshare" value="'.$this->l('Save').'" class="button" /></center><br/>
						<center><a href="../modules/coolshare/moduleinstall.pdf">README</a></center><br/>
						<center><a href="../modules/coolshare/termsandconditions.pdf">TERMS</a></center><br/>
			</fieldset>
		</form>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Contribute').'</legend>
				<p class="clear">'.$this->l('You can contribute with a donation if our free modules and themes are usefull for you. Clic on the link and support us!').'</p>
				<p class="clear">'.$this->l('For more modules & themes visit: www.catalogo-onlinersi.com.ar').'</p>
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="HMBZNQAHN9UMJ">
<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/scr/pixel.gif" width="1" height="1">
	</fieldset>
</form>';
		return $output;
	}
	/**
	* Returns module content
	*
	* @param array $params Parameters
	* @return string Content
	*/
	function hookRightColumn($params)
	{
		global $smarty, $protocol_content, $server_host, $height, $width, $margin, $c10, $c11;
$widthcs = Configuration::get('COOLSHARE_WIDTHCS');
$width = Configuration::get('COOLSHARE_WIDTH');
$margin = Configuration::get('COOLSHARE_MARGIN');
$hwight = Configuration::get('COOLSHARE_HEIGHT');
$formatcs = Configuration::get('COOLSHARE_FORMATCS');
$float = Configuration::get('COOLSHARE_FLOAT');
$c1 = Configuration::get('COOLSHARE_c1');
$c2 = Configuration::get('COOLSHARE_c2');
$c3 = Configuration::get('COOLSHARE_c3');
$c4 = Configuration::get('COOLSHARE_c4');
$c5 = Configuration::get('COOLSHARE_c5');
$c6 = Configuration::get('COOLSHARE_c6');
$c7 = Configuration::get('COOLSHARE_c7');
$c8 = Configuration::get('COOLSHARE_c8');
$c9 = Configuration::get('COOLSHARE_c9');
$c10 = Configuration::get('COOLSHARE_c10');
$c11 = Configuration::get('COOLSHARE_c11');
$c12 = Configuration::get('COOLSHARE_c12');
$servername=  $_SERVER['SERVER_NAME'];
$requesturi=  $_SERVER['REQUEST_URI'];

		$smarty->assign(array(
			'widthcs' => $widthcs,
			'width' => $width,
			'margin' => $margin,
			'height' => $height,
			'formatcs' => $formatcs,
			'float' => $float,
			'servername' => $servername,
			'requesturi' => $requesturi,
			'c1' => $c1,
			'c2' => $c2,
			'c3' => $c3,
			'c4' => $c4,
			'c5' => $c5,
			'c6' => $c6,
			'c7' => $c7,
			'c8' => $c8,
			'c9' => $c9,
				'c10' => $c10,
					'c11' => $c11,
					'c12' => $c12

			
		));

		return $this->display(__FILE__, 'soc.tpl');
	}

	function hookLeftColumn($params)
	{
		return $this->hookRightColumn($params);
	}
	
	function hookTop($params)
	{
		return $this->hookRightColumn($params);
	}
	function hookFooter($params)
	{
		return $this->hookRightColumn($params);
	}
	
	 function hookProductFooter($params)
    {
		return $this->hookRightColumn($params);
	}
	function hookHeader($params)
	{	
	if(_PS_VERSION_ < "1.4.0.0"){
	return $this->display(__FILE__, 'soc-header.tpl');
	}
	if(_PS_VERSION_ > "1.4.0.0" && _PS_VERSION_ < "1.5.0.0")
	{
	Tools::addCSS(__PS_BASE_URI__.'modules/coolshare/files/style.css', 'all');	
	Tools::addJS(__PS_BASE_URI__.'modules/coolshare/files/jsocial.js');	
	}
	if(_PS_VERSION_ > "1.5.0.0")
	{
		$this->context->controller->addCSS(($this->_path).'files/style.css', 'all');
		$this->context->controller->addJS(($this->_path).'files/jsocial.js');
		}
	
	}
}

?>