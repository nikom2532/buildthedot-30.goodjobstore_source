<?php /* Smarty version Smarty-3.0.7, created on 2012-04-23 23:07:47
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/krungsripayment/payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1406550924f957e5376cb39-90632609%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '509dada056a814136bee5ac43f2e4e91bc8f3be7' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/krungsripayment/payment.tpl',
      1 => 1334673524,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1406550924f957e5376cb39-90632609',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<p class="payment_module">
	<a href="javascript:$('#krungsri_form').submit()" title="<?php echo smartyTranslate(array('s'=>'Pay by Krungsri e-Payment Credit Card','mod'=>'krungsripayment'),$_smarty_tpl);?>
">
		<img src="<?php echo $_smarty_tpl->getVariable('this_path')->value;?>
krungsripayment.gif" alt="<?php echo smartyTranslate(array('s'=>'Pay by Krungsri e-Payment Credit Card','mod'=>'krungsripayment'),$_smarty_tpl);?>
" />
		<?php echo smartyTranslate(array('s'=>'Pay by Krungsri e-Payment Credit Card','mod'=>'krungsripayment'),$_smarty_tpl);?>

	</a>
</p>

<form action="<?php echo $_smarty_tpl->getVariable('krungsriUrl')->value;?>
" method="post" id="krungsri_form" class="hidden">
	<input type="hidden" name="MERCHANTNUMBER" ID="MERCHANTNUMBER" SIZE="9" MAXLENGTH="9" value="959000233" />
	<input type="hidden" name="ORDERNUMBER" ID="ORDERNUMBER" SIZE="9" MAXLENGTH="9" value="00000000<?php echo $_smarty_tpl->getVariable('ORDERNUMBER')->value;?>
" />
	<input type="hidden" name="PAYMENTTYPE" value="<?php echo $_smarty_tpl->getVariable('PAYMENTTYPE')->value;?>
" />
	<input type="hidden" name="AMOUNT" ID="AMOUNT" SIZE="20" MAXLENGTH="20" value="<?php echo $_smarty_tpl->getVariable('AMOUNT')->value;?>
00" />
	<input type="hidden" name="CURRENCY" ID="CURRENCY" SIZE="20" MAXLENGTH="20" value="<?php echo $_smarty_tpl->getVariable('CURRENCY')->value;?>
" />
	<input type="hidden" name="AMOUNTEXP10" ID="AMOUNTEXP10" SIZE="20" MAXLENGTH="20" value="<?php echo $_smarty_tpl->getVariable('AMOUNTEXP10')->value;?>
" />	
	<input type="hidden" name="LANGUAGE" size="20" value="<?php echo $_smarty_tpl->getVariable('LANGUAGE')->value;?>
" />
	<input type="hidden" name="REF1" value="<?php echo $_smarty_tpl->getVariable('REF1')->value;?>
" />
	<input type="hidden" name="REF2" value="<?php echo $_smarty_tpl->getVariable('REF2')->value;?>
" />
    <input type="hidden" name="REF3" value="<?php echo $_smarty_tpl->getVariable('REF3')->value;?>
" />
    <input type="hidden" name="REF4" value="<?php echo $_smarty_tpl->getVariable('REF4')->value;?>
" />
    <input type="hidden" name="REF5" value="<?php echo $_smarty_tpl->getVariable('REF5')->value;?>
" />
</form>