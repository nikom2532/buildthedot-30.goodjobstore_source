<?php /* Smarty version Smarty-3.0.7, created on 2012-04-23 23:09:41
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/./dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6625040444f957ec593ca17-02891801%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6e3f9ff804ba1bd54ac3836e38b5a5f885427061' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/./dashboard.tpl',
      1 => 1334337645,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6625040444f957ec593ca17-02891801',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/modifier.escape.php';
?>

<!-- Cusromer_Dashboard -->
<?php if (isset(Smarty::$_smarty_vars['capture']['path'])){?><?php $_smarty_tpl->tpl_vars['path'] = new Smarty_variable(Smarty::$_smarty_vars['capture']['path'], null, null);?><?php }?>
<div class="breadcrumb">
	<a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
" title="<?php echo smartyTranslate(array('s'=>'return to'),$_smarty_tpl);?>
 <?php echo smartyTranslate(array('s'=>'Customer Dashboard'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'CUSTOMER DASHBOARD'),$_smarty_tpl);?>
</a><?php if (isset($_smarty_tpl->getVariable('path',null,true,false)->value)&&$_smarty_tpl->getVariable('path')->value){?><span class="navigation-pipe"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('navigationPipe')->value,'html','UTF-8');?>
</span><?php if (!strpos($_smarty_tpl->getVariable('path')->value,'span')){?><span class="navigation_page"><?php echo $_smarty_tpl->getVariable('path')->value;?>
</span><?php }else{ ?><?php echo $_smarty_tpl->getVariable('path')->value;?>
<?php }?><?php }?>
</div>
<!-- /Cusromer_Dashboard -->