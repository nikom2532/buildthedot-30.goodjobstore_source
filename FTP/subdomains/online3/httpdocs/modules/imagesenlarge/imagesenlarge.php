<?php

class ImagesEnlarge extends Module
{
	function __construct()
	{
		$this->name = 'imagesenlarge';
		$this->tab = 'Utilities';
		$this->version = 1.3;

		parent::__construct(); // The parent construct is required for translations

		$this->page = basename(__FILE__, '.php');
		$this->displayName = $this->l('Images Enlarge');
		$this->description = $this->l('Enable enlarge image on mouseover. (www.marghoobsuleman.com | www.giftlelo.com)');
	}

	function install()
	{
		if (!parent::install())
			return false;
		if (!$this->registerHook('top'))
			return false;
		return true;
	}
	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitBlockimagesenlarge'))
		{
			$animation = Tools::getValue('animation');
			if ($animation != 0 AND $animation != 1)
				$output .= '<div class="alert error">'.$this->l('animation : Invalid choice.').'</div>';
			else
			{
				Configuration::updateValue('PS_DEFAULT_IE_ANIMATION', intval($animation));
			}

			$extendedzoom = Tools::getValue('extendedzoom');
			if ($extendedzoom != 0 AND $extendedzoom != 1)
				$output .= '<div class="alert error">'.$this->l('extendedzoom : Invalid choice.').'</div>';
			else
			{
				Configuration::updateValue('PS_DEFAULT_IE_EXTENDEDZOOM', intval($extendedzoom));
			}
				$output .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l('Settings updated').'</div>';

		}
		
		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		return '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset>
				<legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
				
				<label>'.$this->l('Set animation status').'</label>
				<div class="margin-form">
					<input type="radio" name="animation" id="animation_on" value="1" '.(Tools::getValue('animation', Configuration::get('PS_DEFAULT_IE_ANIMATION')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="animation_on"> <img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="animation" id="animation_off" value="0" '.(!Tools::getValue('animation', Configuration::get('PS_DEFAULT_IE_ANIMATION')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="animation_off"> <img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
					<p class="clear">'.$this->l('on/off animation ').'</p>
				</div>
				
				<label>'.$this->l('Use extended zoom').'</label>
				<div class="margin-form">
					<input type="radio" name="extendedzoom" id="extendedzoom_on" value="1" '.(Tools::getValue('extendedzoom', Configuration::get('PS_DEFAULT_IE_EXTENDEDZOOM')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="extendedzoom_on"> <img src="../img/admin/enabled.gif" alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" /></label>
					<input type="radio" name="extendedzoom" id="extendedzoom_off" value="0" '.(!Tools::getValue('extendedzoom', Configuration::get('PS_DEFAULT_IE_EXTENDEDZOOM')) ? 'checked="checked" ' : '').'/>
					<label class="t" for="extendedzoom_off"> <img src="../img/admin/disabled.gif" alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" /></label>
					<p class="clear">'.$this->l('Use bigger image [thickbox] on rollover. Say it Magic Zoom').'</p>
				</div>
				<center><input type="submit" name="submitBlockimagesenlarge" value="'.$this->l('Save').'" class="button" /></center>
			</fieldset>
		</form>';
	}
	/**
	* Returns module content
	*
	* @param array $params Parameters
	* @return string Content
	*/
	function hookTop($params)
	{
		global $smarty;
		$smarty->assign('animationStatus', intval(Configuration::get('PS_DEFAULT_IE_ANIMATION')));
		$smarty->assign('extendedZoom', intval(Configuration::get('PS_DEFAULT_IE_EXTENDEDZOOM')));
		return $this->display(__FILE__, 'imagesenlarge.tpl');
	}
}

?>