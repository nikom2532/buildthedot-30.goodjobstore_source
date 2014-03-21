<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../header.php');
include(dirname(__FILE__).'/bankwireayd.php');

$currency = new Currency(intval(isset($_POST['currency_payement']) ? $_POST['currency_payement'] : $cookie->id_currency));
$total = floatval(number_format($cart->getOrderTotal(true, 3), 2, '.', ''));
$mailVars = array(
	'{bankwire_owner}' => Configuration::get('BANK_WIRE_AYD_OWNER'),
	'{bankwire_branch}' => nl2br(Configuration::get('BANK_WIRE_AYD_BRANCH')),
	'{bankwire_acnumber}' => nl2br(Configuration::get('BANK_WIRE_AYD_ACNUMBER'))
);

$bankwireayd = new BankWireAyd();
$bankwireayd->validateOrder($cart->id, Configuration::get('BANK_WIRE_AYD_ID_ORDER_STATE'), $total, $bankwireayd->displayName, NULL, $mailVars, $currency->id);
$order = new Order($bankwireayd->currentOrder);
Tools::redirectLink(__PS_BASE_URI__.'order-confirmation.php?id_cart='.$cart->id.'&id_module='.$bankwireayd->id.'&id_order='.$bankwireayd->currentOrder.'&key='.$order->secure_key);
?>