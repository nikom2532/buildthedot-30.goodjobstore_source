<?php /* Smarty version Smarty-3.0.7, created on 2012-04-23 23:07:47
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/paypal/standard/paypal.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19804358204f957e5370d194-10436427%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4fe09111aa94f53eb8eb7861262e32d5604860ae' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/paypal/standard/paypal.tpl',
      1 => 1334067528,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19804358204f957e5370d194-10436427',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<p class="payment_module">
	<a href="<?php echo $_smarty_tpl->getVariable('base_dir_ssl')->value;?>
modules/paypal/standard/redirect.php" title="<?php echo smartyTranslate(array('s'=>'Pay with PayPal','mod'=>'paypal'),$_smarty_tpl);?>
">
		<img src="<?php echo $_smarty_tpl->getVariable('base_dir_ssl')->value;?>
modules/paypal/paypal.gif" alt="<?php echo smartyTranslate(array('s'=>'Pay with PayPal','mod'=>'paypal'),$_smarty_tpl);?>
" />
		<?php echo smartyTranslate(array('s'=>'Pay with PayPal','mod'=>'paypal'),$_smarty_tpl);?>

	</a>
</p>
