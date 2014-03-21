<?php /* Smarty version Smarty-3.0.7, created on 2012-06-28 20:49:08
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/modules/horizontalcategories/category-tree-branch.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2774617724fec60d4cb36f3-81162135%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9d7e9c4ab48262d1e7ed004155490b9683f69275' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/modules/horizontalcategories/category-tree-branch.tpl',
      1 => 1334066928,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2774617724fec60d4cb36f3-81162135',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/tools/smarty/plugins/modifier.escape.php';
?>		<li>
		<a href="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('node')->value['link'],'htmlall','UTF-8');?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('node')->value['desc'],'htmlall','UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('node')->value['name'],'htmlall','UTF-8');?>
</a>
<?php if (count($_smarty_tpl->getVariable('node')->value['children'])>0){?>
			<ul>
			<?php  $_smarty_tpl->tpl_vars['child'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('node')->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['child']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['child']->iteration=0;
if ($_smarty_tpl->tpl_vars['child']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value){
 $_smarty_tpl->tpl_vars['child']->iteration++;
 $_smarty_tpl->tpl_vars['child']->last = $_smarty_tpl->tpl_vars['child']->iteration === $_smarty_tpl->tpl_vars['child']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['categoryTreeBranch']['last'] = $_smarty_tpl->tpl_vars['child']->last;
?>
				<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['categoryTreeBranch']['last']){?>
							<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('branche_tpl_path')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('node',$_smarty_tpl->tpl_vars['child']->value);$_template->assign('last','true'); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
				<?php }else{ ?>
							<?php $_template = new Smarty_Internal_Template($_smarty_tpl->getVariable('branche_tpl_path')->value, $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('node',$_smarty_tpl->tpl_vars['child']->value);$_template->assign('last','false'); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
				<?php }?>
			<?php }} ?>
			</ul>
<?php }?>
		</li>
