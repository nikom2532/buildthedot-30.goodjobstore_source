<?php
class KrungsriPayment extends PaymentModule
{

	public function __construct()
	{
		$this->name = 'krungsripayment';
		$this->tab = 'payments_gateways';
		$this->version = '1.0';
		$this->date = '20 March 2012';
		$this->developer = 'Mr.Thanakorn';
		$this->developeremail = 'james9.0@msn.com';
		
		$this->currencies = true;
		$this->currencies_mode = 'radio';

        parent::__construct();

        /* The parent construct is required for translations */
		$this->page = basename(__FILE__, '.php');
        $this->displayName = $this->l('Krungsri e-Payment Secure Gateway');
        $this->description = $this->l('Accepts payments by Krungsri e-Payment');
		$this->confirmUninstall = $this->l('Are you sure you want to delete your details ?');
	}
		
	public function getKrungsriUrl()
	{
		return "https://www.krungsriepayment.net/EPayDefaultWeb/PaymentManager/PaymentInput.do";
		//return "http://localhost/web2/goodjob/temp/e-payment/bay.php";
	}

	public function install()
	{
		if (!parent::install() OR 
				!Configuration::updateValue('KRUNGSRI_MERCHANTNUMBER', '959000233') OR
		//	!Configuration::updateValue('KRUNGSRI_MERCHANTNUMBER', '40319') OR
			!$this->registerHook('payment')
		)
			return false;
		return true;
	}

	public function uninstall()
	{
		if (!Configuration::deleteByName('KRUNGSRI_MERCHANTNUMBER') OR !parent::uninstall())
			return false;
		return true;
	}
	
	public function hookPayment($params)
	{
		global $smarty;
		
		$currency = Currency::getCurrency($params['cart']->id_currency);
		
		$language = Language::getLanguage($params['cart']->id_lang);
		
		$smarty->assign(array(
			'krungsriUrl' => $this->getKrungsriUrl(),
			'MERCHANTNUMBER' => Configuration::get('KRUNGSRI_MERCHANTNUMBER'),
			'ORDERNUMBER' => $params['cart']->id_address_invoice,
			'PAYMENTTYPE' => 'CreditCard',
			'AMOUNT' => (int)$params['cart']->getOrderTotal(true, 4),
			'CURRENCY' => $currency['iso_code_num'],
			'AMOUNTEXP10' => '-2',
			'LANGUAGE' => strtoupper($language['iso_code']),
			'REF1' => 'aabb',
			'REF2' => '',
			'REF3' => '',
			'REF4' => '',
			'REF5' => '',
			'this_path' => $this->_path,
			'this_path_ssl' => Tools::getShopDomainSsl(true, true).__PS_BASE_URI__.'modules/'.$this->name.'/'
		));
		
		return $this->display(__FILE__, 'payment.tpl');
	}
	
	public function hookPaymentReturn($params)
	{
		print_r($params);	
	}

}

?>