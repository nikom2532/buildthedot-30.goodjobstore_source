<?php
/*
* 2007-2011 PrestaShop 
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 8005 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_'))
	exit;

class BlockCartInfo extends Module
{
	public function __construct()
	{
		$this->name = 'blockcartinfo';
		$this->tab = 'front_office_features';
		$this->version = 1.0;
		$this->need_instance = 0;

		parent::__construct();
		
		$this->displayName = $this->l('Cart info block');
		$this->description = $this->l('Adds a block that displays information about the cart.');
	}

	public function install()
	{
		return ( parent::install() AND $this->registerHook('header')  AND $this->registerHook('topmenu') );
	}
	
	public function smartyAssigns(&$smarty, &$params)
	{
		global $errors, $cookie;

		// Set currency
		if (!(int)($params['cart']->id_currency))
			$currency = new Currency((int)$params['cookie']->id_currency);
		else
			$currency = new Currency((int)$params['cart']->id_currency);
		if (!Validate::isLoadedObject($currency))
			$currency = new Currency((int)(Configuration::get('PS_CURRENCY_DEFAULT')));

		if ($params['cart']->id_customer)
		{
			$customer = new Customer((int)$params['cart']->id_customer);
			$taxCalculationMethod = Group::getPriceDisplayMethod((int)$customer->id_default_group);
		}
		else
			$taxCalculationMethod = Group::getDefaultPriceDisplayMethod();

		$useTax = true;/*!($taxCalculationMethod == PS_TAX_EXC);*/ 

		$products = $params['cart']->getProducts(true);
		$nbTotalProducts = 0;
		foreach ($products AS $product)
			$nbTotalProducts += (int)$product['cart_quantity'];

		$wrappingCost = (float)($params['cart']->getOrderTotal($useTax, Cart::ONLY_WRAPPING));
		$totalToPay = $params['cart']->getOrderTotal($useTax);

		if ($useTax AND Configuration::get('PS_TAX_DISPLAY') == 1)
		{
			$totalToPayWithoutTaxes = $params['cart']->getOrderTotal(false);
			$smarty->assign('tax_cost', Tools::displayPrice($totalToPay - $totalToPayWithoutTaxes, $currency));
		}

		$smarty->assign(array(
			'products' => $products,
			'customizedDatas' => Product::getAllCustomizedDatas((int)($params['cart']->id)),
			'CUSTOMIZE_FILE' => _CUSTOMIZE_FILE_,
			'CUSTOMIZE_TEXTFIELD' => _CUSTOMIZE_TEXTFIELD_,
			'discounts' => $params['cart']->getDiscounts(false, Tools::isSubmit('id_product')),
			'nb_total_products' => (int)($nbTotalProducts),
			'shipping_cost' => Tools::displayPrice($params['cart']->getOrderTotal($useTax, Cart::ONLY_SHIPPING), $currency),
			'show_wrapping' => $wrappingCost > 0 ? true : false,
			'show_tax' => (int)(Configuration::get('PS_TAX_DISPLAY') == 1 && (int)Configuration::get('PS_TAX')),
			'wrapping_cost' => Tools::displayPrice($wrappingCost, $currency),
			'product_total' => Tools::displayPrice($params['cart']->getOrderTotal($useTax, Cart::BOTH_WITHOUT_SHIPPING), $currency),
			'total' => Tools::displayPrice($totalToPay, $currency),
			'id_carrier' => (int)($params['cart']->id_carrier),
			'order_process' => Configuration::get('PS_ORDER_PROCESS_TYPE') ? 'order-opc' : 'order',
			'ajax_allowed' => (int)(Configuration::get('PS_BLOCK_CART_AJAX')) == 1 ? true : false
		));
		if (sizeof($errors))
			$smarty->assign('errors', $errors);
		if (isset($cookie->ajax_blockcart_display))
			$smarty->assign('colapseExpandStatus', $cookie->ajax_blockcart_display);
	}
		
	/**
	* Returns module content for header
	*
	* @param array $params Parameters
	* @return string Content
	*/
	public function hookTopmenu($params)
	{
		if (Configuration::get('PS_CATALOG_MODE'))
			return;

		global $smarty;
		$smarty->assign('order_page', strpos($_SERVER['PHP_SELF'], 'order') !== false);
		$this->smartyAssigns($smarty, $params);
		return $this->display(__FILE__, 'blockcartinfo.tpl');
		
		return $this->display(__FILE__, 'blockcartinfo.tpl');
	}
	
	public function hookHeader($params)
	{
		Tools::addCSS(($this->_path).'blockcartinfo.css', 'all');
	}

}


