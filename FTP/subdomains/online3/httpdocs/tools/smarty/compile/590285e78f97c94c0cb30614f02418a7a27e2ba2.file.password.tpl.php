<?php /* Smarty version Smarty-3.0.7, created on 2012-04-22 20:09:18
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/password.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8220863084f9402fe1e58e6-60913848%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '590285e78f97c94c0cb30614f02418a7a27e2ba2' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/password.tpl',
      1 => 1334069945,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8220863084f9402fe1e58e6-60913848',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/modifier.escape.php';
?>

<?php ob_start(); ?><?php echo smartyTranslate(array('s'=>'Forgot your password'),$_smarty_tpl);?>
<?php  Smarty::$_smarty_vars['capture']['path']=ob_get_clean();?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./breadcrumb.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<h1><?php echo smartyTranslate(array('s'=>'Forgot your password'),$_smarty_tpl);?>
</h1>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./errors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<?php if (isset($_smarty_tpl->getVariable('confirmation',null,true,false)->value)&&$_smarty_tpl->getVariable('confirmation')->value==1){?>
<p class="success"><?php echo smartyTranslate(array('s'=>'Your password has been successfully reset and has been sent to your e-mail address:'),$_smarty_tpl);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('email')->value,'htmlall','UTF-8');?>
</p>
<?php }elseif(isset($_smarty_tpl->getVariable('confirmation',null,true,false)->value)&&$_smarty_tpl->getVariable('confirmation')->value==2){?>
<p class="success"><?php echo smartyTranslate(array('s'=>'A confirmation e-mail has been sent to your address:'),$_smarty_tpl);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('email')->value,'htmlall','UTF-8');?>
</p>
<?php }else{ ?>
<p><?php echo smartyTranslate(array('s'=>'Please enter the e-mail address used to register. We will e-mail you your new password.'),$_smarty_tpl);?>
</p>
<form action="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('request_uri')->value,'htmlall','UTF-8');?>
" method="post" class="std">
	<fieldset>
		<p class="text">
			<label for="email"><?php echo smartyTranslate(array('s'=>'E-mail:'),$_smarty_tpl);?>
</label>
			<input type="text" id="email" name="email" value="<?php if (isset($_POST['email'])){?><?php echo stripslashes(smarty_modifier_escape($_POST['email'],'htmlall','UTF-8'));?>
<?php }?>" />
		</p>
		<p class="submit">
			<input type="submit" class="button" value="<?php echo smartyTranslate(array('s'=>'Retrieve Password'),$_smarty_tpl);?>
" />
		</p>
	</fieldset>
</form>
<?php }?>
<p class="clear">
	<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('authentication.php',true);?>
" title="<?php echo smartyTranslate(array('s'=>'Return to Login'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
icon/my-account.gif" alt="<?php echo smartyTranslate(array('s'=>'Return to Login'),$_smarty_tpl);?>
" class="icon" /></a><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('authentication.php');?>
" title="<?php echo smartyTranslate(array('s'=>'Back to Login'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Back to Login'),$_smarty_tpl);?>
</a>
</p>
