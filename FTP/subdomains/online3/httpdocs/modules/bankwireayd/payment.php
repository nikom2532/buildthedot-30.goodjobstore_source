<?php

/* SSL Management */
$useSSL = true;

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../header.php');
include(dirname(__FILE__).'/bankwireayd.php');

if (!$cookie->isLogged())
    Tools::redirect('authentication.php?back=order.php');
$bankwireayd = new BankWireAyd();
echo $bankwireayd->execPayment($cart);

include_once(dirname(__FILE__).'/../../footer.php');

?>