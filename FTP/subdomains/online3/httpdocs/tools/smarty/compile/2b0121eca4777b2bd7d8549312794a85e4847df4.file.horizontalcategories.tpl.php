<?php /* Smarty version Smarty-3.0.7, created on 2012-04-30 10:12:35
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/horizontalcategories/horizontalcategories.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17155936034f9e03234c45a3-78054524%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2b0121eca4777b2bd7d8549312794a85e4847df4' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/horizontalcategories/horizontalcategories.tpl',
      1 => 1335086591,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17155936034f9e03234c45a3-78054524',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<!-- Horizontal categories module -->
<div id="goodjobmenu" class="droplinetabs">
	<ul>
	<?php  $_smarty_tpl->tpl_vars['child'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('blockCategTree')->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['child']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['child']->iteration=0;
if ($_smarty_tpl->tpl_vars['child']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value){
 $_smarty_tpl->tpl_vars['child']->iteration++;
 $_smarty_tpl->tpl_vars['child']->last = $_smarty_tpl->tpl_vars['child']->iteration === $_smarty_tpl->tpl_vars['child']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['blockCategTree']['last'] = $_smarty_tpl->tpl_vars['child']->last;
?>
		<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['blockCategTree']['last']){?>
		
					<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('branche_tpl_path')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('node',$_smarty_tpl->tpl_vars['child']->value);$_template->assign('last','true'); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
		
		<?php }else{ ?>
					<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('branche_tpl_path')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('node',$_smarty_tpl->tpl_vars['child']->value); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
		<?php }?>
	<?php }} ?>
	</ul>
</div>
<!-- /Horizontal categories module -->
