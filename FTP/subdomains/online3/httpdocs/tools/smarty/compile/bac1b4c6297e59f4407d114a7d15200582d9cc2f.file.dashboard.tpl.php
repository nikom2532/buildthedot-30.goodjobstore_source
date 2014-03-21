<?php /* Smarty version Smarty-3.0.7, created on 2012-05-24 10:33:56
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/themes/goodjob/./dashboard.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6527772864fbdac24f12783-47749208%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bac1b4c6297e59f4407d114a7d15200582d9cc2f' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/themes/goodjob/./dashboard.tpl',
      1 => 1334337645,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6527772864fbdac24f12783-47749208',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/tools/smarty/plugins/modifier.escape.php';
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