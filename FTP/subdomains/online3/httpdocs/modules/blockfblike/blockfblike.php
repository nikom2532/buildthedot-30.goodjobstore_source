<?php
class Blockfblike extends Module
{
	function __construct()
	{
		$this->name = 'blockfblike';
		$this->tab = 'Blocks';
		$this->version = 1.0;

		parent::__construct(); // The parent construct is required for translations

		$this->page = basename(__FILE__, '.php');
		$this->displayName = $this->l('Facebook Like Button');
		$this->description = $this->l('Add a Facebook Like Button and the Open Graph html meta tags at each product page.');
	}

	function install()
	{
		if (!parent::install())
			return false;
		if (!($this->registerHook('header') && $this->registerHook('extraright')))
			return false;
		return true;
	}

	/**
	* Returns module content
	*
	* @param array $params Parameters
	* @return string Content
	*/
	function hookHeader ($params)
	{
		global $cookie, $link, $smarty;

		$product = new Product((int)(Tools::getValue('id_product')), false, (int)($cookie->id_lang));
		$productLink = $link->getProductLink($product);
		
		$images = $product->getImages((int)($cookie->id_lang));
		foreach ($images AS $k => $image)
			if ($image['cover'])
			{
				$cover['id_image'] = (int)($product->id).'-'.(int)($image['id_image']);
				$cover['legend'] = $image['legend'];
			}
		if (!isset($cover))
			$cover = array('id_image' => Language::getIsoById((int)($cookie->id_lang)).'-default', 'legend' => 'No picture');
		
		$smarty->assign(array(
			'product' => $product,
			'productLink' => $productLink,
			'cover' => $cover,
		));
		
	
		return $this->display(__FILE__, 'metadata.tpl');
	}

/*	function hookProductFooter ($params)
	{
		return $this->display(__FILE__, 'fblike.tpl');
	}
*/	
	function hookExtraRight($params)
	{
		return $this->display(__FILE__, 'fblike.tpl');
	}
	
	
}
?>