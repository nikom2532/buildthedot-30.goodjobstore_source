<?php /* Smarty version Smarty-3.0.7, created on 2012-06-27 20:34:24
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/modules/blockmyaccount/blockmyaccount.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9535689744feb0be05a8350-39028919%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '16428701a15eb45263c4e1b15e99eb684104a388' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/modules/blockmyaccount/blockmyaccount.tpl',
      1 => 1334066618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9535689744feb0be05a8350-39028919',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<!-- Block myaccount module -->
<div class="block myaccount">
	<h4><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('my-account.php',true);?>
"><?php echo smartyTranslate(array('s'=>'My account','mod'=>'blockmyaccount'),$_smarty_tpl);?>
</a></h4>
	<div class="block_content">
		<ul class="bullet">
			<li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('history.php',true);?>
" title=""><?php echo smartyTranslate(array('s'=>'My orders','mod'=>'blockmyaccount'),$_smarty_tpl);?>
</a></li>
			<?php if ($_smarty_tpl->getVariable('returnAllowed')->value){?><li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order-follow.php',true);?>
" title=""><?php echo smartyTranslate(array('s'=>'My merchandise returns','mod'=>'blockmyaccount'),$_smarty_tpl);?>
</a></li><?php }?>
			<li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order-slip.php',true);?>
" title=""><?php echo smartyTranslate(array('s'=>'My credit slips','mod'=>'blockmyaccount'),$_smarty_tpl);?>
</a></li>
			<li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('addresses.php',true);?>
" title=""><?php echo smartyTranslate(array('s'=>'My addresses','mod'=>'blockmyaccount'),$_smarty_tpl);?>
</a></li>
			<li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('identity.php',true);?>
" title=""><?php echo smartyTranslate(array('s'=>'My personal info','mod'=>'blockmyaccount'),$_smarty_tpl);?>
</a></li>
			<?php if ($_smarty_tpl->getVariable('voucherAllowed')->value){?><li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('discount.php',true);?>
" title=""><?php echo smartyTranslate(array('s'=>'My vouchers','mod'=>'blockmyaccount'),$_smarty_tpl);?>
</a></li><?php }?>
			<?php echo $_smarty_tpl->getVariable('HOOK_BLOCK_MY_ACCOUNT')->value;?>

		</ul>
		<p class="logout"><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('index.php');?>
?mylogout" title="<?php echo smartyTranslate(array('s'=>'Sign out','mod'=>'blockmyaccount'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Sign out','mod'=>'blockmyaccount'),$_smarty_tpl);?>
</a></p>
	</div>
</div>
<!-- /Block myaccount module -->