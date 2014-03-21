<?php /* Smarty version Smarty-3.0.7, created on 2012-04-29 20:42:09
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/./order-steps.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16988268284f9d45318ac566-63060912%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b131ae018de00f6825772e13e2e881e870265c3f' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/./order-steps.tpl',
      1 => 1335029306,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16988268284f9d45318ac566-63060912',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php if (!$_smarty_tpl->getVariable('opc')->value){?>
<!-- Steps -->
<?php if ($_smarty_tpl->getVariable('current_step')->value=='summary'||$_smarty_tpl->getVariable('current_step')->value=='login'){?>
	<?php }?>
<?php }else{ ?><?php if ($_smarty_tpl->getVariable('current_step')->value=='payment'||$_smarty_tpl->getVariable('current_step')->value=='shipping'||$_smarty_tpl->getVariable('current_step')->value=='billing'||$_smarty_tpl->getVariable('current_step')->value=='login'){?>step_done<?php }else{ ?>step_todo<?php }?><?php }?>
		<?php if ($_smarty_tpl->getVariable('current_step')->value=='payment'||$_smarty_tpl->getVariable('current_step')->value=='shipping'||$_smarty_tpl->getVariable('current_step')->value=='billing'){?>
<ul class="step" id="order_step">
	<li class="<?php if ($_smarty_tpl->getVariable('current_step')->value=='billing'){?>step1_current<?php }else{ ?><?php if ($_smarty_tpl->getVariable('current_step')->value=='payment'||$_smarty_tpl->getVariable('current_step')->value=='shipping'){?>step1_done<?php }else{ ?>step1_todo<?php }?><?php }?>">
<!--
		<?php if ($_smarty_tpl->getVariable('current_step')->value=='payment'||$_smarty_tpl->getVariable('current_step')->value=='shipping'||$_smarty_tpl->getVariable('current_step')->value=='billing'||$_smarty_tpl->getVariable('current_step')->value=='login'){?>
		<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order.php',true);?>
<?php if (isset($_smarty_tpl->getVariable('back',null,true,false)->value)&&$_smarty_tpl->getVariable('back')->value){?>?back=<?php echo $_smarty_tpl->getVariable('back')->value;?>
<?php }?>">
			<?php echo smartyTranslate(array('s'=>'Summary'),$_smarty_tpl);?>

		</a>
		<?php }else{ ?>
		<?php echo smartyTranslate(array('s'=>'Summary'),$_smarty_tpl);?>

		<?php }?>
-->
	</li>
	<li class="<?php if ($_smarty_tpl->getVariable('current_step')->value=='payment'){?>step2_current<?php }else{ ?><?php if ($_smarty_tpl->getVariable('current_step')->value=='login'||$_smarty_tpl->getVariable('current_step')->value=='shipping'||$_smarty_tpl->getVariable('current_step')->value=='billing'){?>step2_done<?php }else{ ?>step2_todo<?php }?><?php }?>">
<!--
		<?php if ($_smarty_tpl->getVariable('current_step')->value=='payment'||$_smarty_tpl->getVariable('current_step')->value=='shipping'||$_smarty_tpl->getVariable('current_step')->value=='billing'){?>
		<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order.php',true);?>
?step=1<?php if (isset($_smarty_tpl->getVariable('back',null,true,false)->value)&&$_smarty_tpl->getVariable('back')->value){?>&amp;back=<?php echo $_smarty_tpl->getVariable('back')->value;?>
<?php }?>">
			<?php echo smartyTranslate(array('s'=>'Login'),$_smarty_tpl);?>

		</a>
		<?php }else{ ?>
		<?php echo smartyTranslate(array('s'=>'Login'),$_smarty_tpl);?>

		<?php }?>
-->
	</li>
	<li class="<?php if ($_smarty_tpl->getVariable('current_step')->value=='summary'){?>step3_current<?php }else{ ?><?php if ($_smarty_tpl->getVariable('current_step')->value=='payment'||$_smarty_tpl->getVariable('current_step')->value=='shipping'||$_smarty_tpl->getVariable('current_step')->value=='billing'||$_smarty_tpl->getVariable('current_step')->value=='login'){?>step3_done<?php }else{ ?>step3_todo<?php }?><?php }?>">
<!--
		<?php if ($_smarty_tpl->getVariable('current_step')->value=='payment'||$_smarty_tpl->getVariable('current_step')->value=='shipping'){?>
		<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order.php',true);?>
?step=1<?php if (isset($_smarty_tpl->getVariable('back',null,true,false)->value)&&$_smarty_tpl->getVariable('back')->value){?>&amp;back=<?php echo $_smarty_tpl->getVariable('back')->value;?>
<?php }?>">
			<?php echo smartyTranslate(array('s'=>'Address'),$_smarty_tpl);?>

		</a>
		<?php }else{ ?>
		<?php echo smartyTranslate(array('s'=>'Address'),$_smarty_tpl);?>

		<?php }?>
-->
	</li>
	<li class="<?php if ($_smarty_tpl->getVariable('current_step')->value=='shipping'){?>step4_current<?php }else{ ?><?php if ($_smarty_tpl->getVariable('current_step')->value=='payment'){?>step4_done<?php }else{ ?>step4_todo<?php }?><?php }?>">
<!--
		<?php if ($_smarty_tpl->getVariable('current_step')->value=='payment'){?>
		<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order.php',true);?>
?step=2<?php if (isset($_smarty_tpl->getVariable('back',null,true,false)->value)&&$_smarty_tpl->getVariable('back')->value){?>&amp;back=<?php echo $_smarty_tpl->getVariable('back')->value;?>
<?php }?>">
			<?php echo smartyTranslate(array('s'=>'Shipping'),$_smarty_tpl);?>

		</a>
		<?php }else{ ?>
		<?php echo smartyTranslate(array('s'=>'Shipping'),$_smarty_tpl);?>

		<?php }?>
-->
	</li>
<!--
	<li id="step_end" class="<?php if ($_smarty_tpl->getVariable('current_step')->value=='payment'){?>step_current<?php }else{ ?>step_todo<?php }?>">
		<?php echo smartyTranslate(array('s'=>'Payment'),$_smarty_tpl);?>

	</li>
-->
</ul>
<!-- /Steps -->
<?php }?>