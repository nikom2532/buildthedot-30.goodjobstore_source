<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../header.php');
include(dirname(__FILE__).'/bankwiretfb.php');

$currency = new Currency(intval(isset($_POST['currency_payement']) ? $_POST['currency_payement'] : $cookie->id_currency));
$total = floatval(number_format($cart->getOrderTotal(true, 3), 2, '.', ''));
$mailVars = array(
	'{bankwire_owner}' => Configuration::get('BANK_WIRE_TFB_OWNER'),
	'{bankwire_branch}' => nl2br(Configuration::get('BANK_WIRE_TFB_BRANCH')),
	'{bankwire_acnumber}' => nl2br(Configuration::get('BANK_WIRE_TFB_ACNUMBER'))
);

$bankwiretfb = new BankWireTfb();
$bankwiretfb->validateOrder($cart->id, Configuration::get('BANK_WIRE_TFB_ID_ORDER_STATE'), $total, $bankwiretfb->displayName, NULL, $mailVars, $currency->id);
$order = new Order($bankwiretfb->currentOrder);
Tools::redirectLink(__PS_BASE_URI__.'order-confirmation.php?id_cart='.$cart->id.'&id_module='.$bankwiretfb->id.'&id_order='.$bankwiretfb->currentOrder.'&key='.$order->secure_key);
?>