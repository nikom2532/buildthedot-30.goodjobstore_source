<?php

class BankWireAyd extends PaymentModule
{
	private $_html = '';
	private $_postErrors = array();

	public  $id_order_state;
	public  $branch;
	public  $owner;
	public	$acnumber;

	public function __construct()
	{
		$this->name = 'bankwireayd';
		$this->tab = 'Payment';
		$this->version = 1.0;
		
		$this->currencies = true;
		$this->currencies_mode = 'checkbox';

		$config = Configuration::getMultiple(array('BANK_WIRE_AYD_ID_ORDER_STATE', 'BANK_WIRE_AYD_BRANCH', 'BANK_WIRE_AYD_OWNER', 'BANK_WIRE_AYD_ACNUMBER'));
		if (isset($config['BANK_WIRE_AYD_ID_ORDER_STATE']))
			$this->id_order_state = $config['BANK_WIRE_AYD_ID_ORDER_STATE'];
		if (isset($config['BANK_WIRE_AYD_OWNER']))
			$this->owner = $config['BANK_WIRE_AYD_OWNER'];
		if (isset($config['BANK_WIRE_AYD_BRANCH']))
			$this->branch = $config['BANK_WIRE_AYD_BRANCH'];
		if (isset($config['BANK_WIRE_AYD_ACNUMBER']))
			$this->acnumber = $config['BANK_WIRE_AYD_ACNUMBER'];

		parent::__construct();

		$this->displayName = $this->l('Krung Thai Bank');
		$this->description = $this->l('Accept payments by Krung Thai Bank');
		$this->confirmUninstall = $this->l('Are you sure you want to delete your details?');
		if (!isset($this->owner) OR !isset($this->branch) OR !isset($this->acnumber))
			$this->warning = $this->l('Account owner and account number must be configured in order to use this module correctly');
		if (!sizeof(Currency::checkPaymentCurrencies($this->id)))
			$this->warning = $this->l('No currency set for this module');
	}

	public function install()
	{
		if (!parent::install() OR !$this->registerHook('payment') OR !$this->registerHook('paymentReturn'))
			return false;
	}

	public function uninstall()
	{
		if (!Configuration::deleteByName('BANK_WIRE_AYD_BRANCH')
				OR !Configuration::deleteByName('BANK_WIRE_AYD_OWNER')
				OR !Configuration::deleteByName('BANK_WIRE_AYD_ACNUMBER')
				OR !Configuration::deleteByName('BANK_WIRE_AYD_ID_ORDER_STATE')
				OR !parent::uninstall())
			return false;
	}

	private function _postValidation()
	{
		if (isset($_POST['btnSubmit']))
		{
			if (empty($_POST['branch']))
				$this->_postErrors[] = $this->l('Account branch are required.');
			elseif (empty($_POST['owner']))
				$this->_postErrors[] = $this->l('Account owner is required.');
			elseif (empty($_POST['acnumber']))
				$this->_postErrors[] = $this->l('Account number is required.');
			elseif (empty($_POST['id_order_state']))
				$this->_postErrors[] = $this->l('Id order state is required.');
		}
	}

	private function _postProcess()
	{
		if (isset($_POST['btnSubmit']))
		{
			Configuration::updateValue('BANK_WIRE_AYD_BRANCH', $_POST['branch']);
			Configuration::updateValue('BANK_WIRE_AYD_OWNER', $_POST['owner']);
			Configuration::updateValue('BANK_WIRE_AYD_ACNUMBER', $_POST['acnumber']);
			Configuration::updateValue('BANK_WIRE_AYD_ID_ORDER_STATE', $_POST['id_order_state']);
		}
		$this->_html .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('ok').'" /> '.$this->l('Settings updated').'</div>';
	}

	private function _displayBankWire()
	{
		$this->_html .= '<img src="'.$this->_path.'icon_bank.jpg" style="float:left; margin-right:15px;"><b>'.$this->l('This module allows you to accept payments by ').$this->displayName.'.</b><br /><br />
		'.$this->l('If the client chooses this payment mode, the order will change its status into a \'Waiting for payment\' status.').'<br />
		'.$this->l('Therefore, you will need to manually confirm the order as soon as you receive a wire..').'<br /><br /><br />';
	}

	private function _displayForm()
	{
		$this->_html .=
		'<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset>
			<legend><img src="../img/admin/contact.gif" />'.$this->l('Contact details').'</legend><br />
				<table border="0" width="500" cellpadding="0" cellspacing="0" id="form">
					<tr><td colspan="2">'.$this->l('Please specify the Krung Thai Bank account details for customers').'.<br /><br /></td></tr>
					<tr>
					    <td width="130" style="height: 35px;">'.$this->l('ID order state').'</td>
					    <td><input type="text" name="id_order_state" value="'.htmlentities(Tools::getValue('id_order_state', $this->id_order_state), ENT_COMPAT, 'UTF-8').'" style="width: 30px;" /></td>
					</tr>
					<tr>
					    <td width="130" style="height: 35px;">'.$this->l('Account owner').'</td>
					    <td><input type="text" name="owner" value="'.htmlentities(Tools::getValue('owner', $this->owner), ENT_COMPAT, 'UTF-8').'" style="width: 300px;" /></td>
					</tr>
					<tr>
						<td width="130" style="vertical-align: top;">'.$this->l('Branch').'</td>
						<td style="padding-bottom:15px;">
							<input type="text" name="branch" value="'.htmlentities(Tools::getValue('branch', $this->branch), ENT_COMPAT, 'UTF-8').'" style="width: 300px;" />
						</td>
					</tr>
					<tr>
						<td width="130" style="vertical-align: top;">'.$this->l('Account Number').'</td>
						<td style="padding-bottom:15px;">
							<input type="text" name="acnumber" value="'.htmlentities(Tools::getValue('acnumber', $this->acnumber), ENT_COMPAT, 'UTF-8').'" style="width: 300px;" />
							<p style="color: #7F7F7F;font-size: 0.85em;">'.$this->l('Ex. 123-4-567890 (saving)').'</p>
						</td>
					</tr>
					<tr><td colspan="2" align="center"><input class="button" name="btnSubmit" value="'.$this->l('Update settings').'" type="submit" /></td></tr>
				</table>
			</fieldset>
		</form>';
	}

	public function getContent()
	{
		$this->_html = '<h2>'.$this->displayName.'</h2>';

		if (!empty($_POST))
		{
			$this->_postValidation();
			if (!sizeof($this->_postErrors))
				$this->_postProcess();
			else
				foreach ($this->_postErrors AS $err)
					$this->_html .= '<div class="alert error">'. $err .'</div>';
		}
		else
			$this->_html .= '<br />';

		$this->_displayBankWire();
		$this->_displayForm();

		return $this->_html;
	}

	public function execPayment($cart)
	{
		 
		 
		
		if (!$this->active)
			return ;

		global $cookie, $smarty;

		$smarty->assign(array(
			'nbProducts' => $cart->nbProducts(),
			'cust_currency' => $cookie->id_currency,
			'currencies' => $this->getCurrency(),
			'total' => number_format($cart->getOrderTotal(true, 3), 2, '.', ''),
			'isoCode' => Language::getIsoById(intval($cookie->id_lang)),
			'bankwireName' => $this->l('Krung Thai Bank'),
			'bankwireBranch' => nl2br2($this->branch),
			'bankwireAcnumber' => nl2br2($this->acnumber),
			'bankwireOwner' => $this->owner,
			'this_path' => $this->_path,
			'this_path_ssl' => (Configuration::get('PS_SSL_ENABLED') ? 'https://' : 'http://').htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'modules/'.$this->name.'/'
		));

		return $this->display(__FILE__, 'payment_execution.tpl');
	}

	public function hookPayment($params)
	{
		if (!$this->active)
			return ;

		global $smarty;

		$smarty->assign(array(
			'this_path' => $this->_path,
			'this_path_ssl' => (Configuration::get('PS_SSL_ENABLED') ? 'https://' : 'http://').htmlspecialchars($_SERVER['HTTP_HOST'], ENT_COMPAT, 'UTF-8').__PS_BASE_URI__.'modules/'.$this->name.'/'
		));
		return $this->display(__FILE__, 'payment.tpl');
	}

	public function hookPaymentReturn($params)
	{
		if (!$this->active)
			return ;

		global $smarty;
		$state = $params['objOrder']->getCurrentState();
		if ($state == $this->id_order_state OR $state == _PS_OS_OUTOFSTOCK_)
			$smarty->assign(array(
				'total_to_pay' => Tools::displayPrice($params['total_to_pay'], $params['currencyObj'], false, false),
				'bankwireBranch' => nl2br2($this->branch),
				'bankwireAcnumber' => nl2br2($this->acnumber),
				'bankwireOwner' => $this->owner,
				'status' => 'ok',
				'this_path' => $this->_path,
				'id_order' => $params['objOrder']->id
			));
		else
			$smarty->assign('status', 'failed');
		return $this->display(__FILE__, 'payment_return.tpl');
	}
	 
}
