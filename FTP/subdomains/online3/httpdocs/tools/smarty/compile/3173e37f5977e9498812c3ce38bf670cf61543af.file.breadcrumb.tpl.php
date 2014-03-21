<?php /* Smarty version Smarty-3.0.7, created on 2012-04-29 23:28:03
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/./breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16633468274f9d6c137d3253-32607475%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3173e37f5977e9498812c3ce38bf670cf61543af' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/./breadcrumb.tpl',
      1 => 1334987425,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16633468274f9d6c137d3253-32607475',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/modifier.escape.php';
?>

<!-- Breadcrumb -->
<?php if (isset(Smarty::$_smarty_vars['capture']['path'])){?><?php $_smarty_tpl->tpl_vars['path'] = new Smarty_variable(Smarty::$_smarty_vars['capture']['path'], null, null);?><?php }?>
<div class="breadcrumb">
	<a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
" title="<?php echo smartyTranslate(array('s'=>'return to'),$_smarty_tpl);?>
<?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
</a><?php if (isset($_smarty_tpl->getVariable('path',null,true,false)->value)&&$_smarty_tpl->getVariable('path')->value){?><span class="navigation-pipe"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('navigationPipe')->value,'html','UTF-8');?>
</span><?php if (!strpos($_smarty_tpl->getVariable('path')->value,'span')){?><span class="navigation_page"><?php echo $_smarty_tpl->getVariable('path')->value;?>
</span><?php }else{ ?><?php echo $_smarty_tpl->getVariable('path')->value;?>
<?php }?><?php }?>
</div>
<!-- /Breadcrumb -->