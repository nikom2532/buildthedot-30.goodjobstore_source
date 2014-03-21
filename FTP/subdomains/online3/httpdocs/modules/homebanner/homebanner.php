<?php
if (!defined('_PS_VERSION_'))
	exit;

class HomeBanner extends Module 
{
	
	public function __construct()
	{
		$this->name = 'homebanner';
		$this->tab = 'front_office_features';
		$this->version = '1.0';
		$this->author = 'Thanakorn';
		$this->need_instance = 0;

	 	parent::__construct();

		$this->displayName = $this->l('Banner highlight on the homepage (Right Column)');
		$this->description = $this->l('Adds a block with additional home.');
		$this->confirmUninstall = $this->l('Are you sure you want to delete all your links ?');
	}
	
	public function install()
	{
		return ( parent::install() AND $this->registerHook('header')  AND $this->registerHook('home') );
		
	}
	
	public function uninstall()
	{
		if (!parent::uninstall())
			return false;
		return true;
	}
	
	public function hookHome($params)
	{
		global $smarty;
		
		$objBanner = new BannerRight();
		$banners = $objBanner->get_banner((int)($params['cookie']->id_lang));
		
		$smarty->assign(array(
		'banners' => $banners));
		
		Tools::addCSS(($this->_path).'homebanner.css', 'all');
		//Tools::addCSS(($this->_path).'homebanner.css', 'all');
		
		return $this->display(__FILE__, 'homebanner.tpl');
	}

	public function hookHeader($params)
	{
		Tools::addCSS(($this->_path).'homebanner.css', 'all');
	}
}
