<?php /* Smarty version Smarty-3.0.7, created on 2012-04-16 21:05:33
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/maofree_menu/maofree_menu_tree.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6167757144f8c272d930977-20790507%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7868098efd25f6a371ccdad53899dbf8fe1f0ac0' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/maofree_menu/maofree_menu_tree.tpl',
      1 => 1334584850,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6167757144f8c272d930977-20790507',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/modifier.escape.php';
?><?php $_smarty_tpl->tpl_vars['faa'] = new Smarty_variable('eee', null, null);?>
<?php  $_smarty_tpl->tpl_vars['number'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('homecategoriesID')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['number']->key => $_smarty_tpl->tpl_vars['number']->value){
?><?php if ($_smarty_tpl->getVariable('node')->value['id']==$_smarty_tpl->tpl_vars['number']->value){?><?php $_smarty_tpl->tpl_vars['faa'] = new Smarty_variable('aaa', null, null);?><?php }?><?php }} ?>
<li class="<?php if (isset($_smarty_tpl->getVariable('last',null,true,false)->value)&&$_smarty_tpl->getVariable('last')->value=='true'){?>last <?php }?><?php if (isset($_smarty_tpl->getVariable('maomenucurrentCategoryId',null,true,false)->value)&&($_smarty_tpl->getVariable('node')->value['id']==$_smarty_tpl->getVariable('maomenucurrentCategoryId')->value)){?><?php if (!$_smarty_tpl->getVariable('maomenumodecatview')->value&&($_smarty_tpl->getVariable('faa')->value=='aaa')){?>root<?php }?>selected-maomenu<?php }?><?php if (!$_smarty_tpl->getVariable('maomenumodecatview')->value&&(count($_smarty_tpl->getVariable('node')->value['children'])==0)&&($_smarty_tpl->getVariable('faa')->value=='aaa')){?> noarrow-maomenu<?php }?>">
	<a href="<?php echo $_smarty_tpl->getVariable('node')->value['link'];?>
" <?php if (isset($_smarty_tpl->getVariable('maomenucurrentCategoryId',null,true,false)->value)&&($_smarty_tpl->getVariable('node')->value['id']==$_smarty_tpl->getVariable('maomenucurrentCategoryId')->value)){?>class="selected-a-maomenu"<?php }?> title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('node')->value['desc'],'html','UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('node')->value['name'],'html','UTF-8');?>
<?php if ($_smarty_tpl->getVariable('maomenumodecatview')->value&&(count($_smarty_tpl->getVariable('node')->value['children'])>0)){?><span class="arrow-maomenu"></span><?php }elseif(!$_smarty_tpl->getVariable('maomenumodecatview')->value&&(count($_smarty_tpl->getVariable('node')->value['children'])>0)){?><?php if (($_smarty_tpl->getVariable('faa')->value=='aaa')&&!$_smarty_tpl->getVariable('maomenurootarrow')->value){?><?php }else{ ?><span class="arrow-maomenu"></span><?php }?><?php }?></a>
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
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['maomenucategoryTreeBranch']['last'] = $_smarty_tpl->tpl_vars['child']->last;
?>
			<?php if (isset($_smarty_tpl->getVariable('smarty',null,true,false)->value['foreach']['maomenucategoryTreeBranch'])&&$_smarty_tpl->getVariable('smarty')->value['foreach']['maomenucategoryTreeBranch']['last']){?>
				<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('maomenu_branch_tpl_path')->value), $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('node',$_smarty_tpl->tpl_vars['child']->value);$_template->assign('last','true'); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
			<?php }else{ ?>
				<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('maomenu_branch_tpl_path')->value), $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('node',$_smarty_tpl->tpl_vars['child']->value);$_template->assign('last','false'); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
			<?php }?>
		<?php }} ?>
		</ul>
	<?php }?>
</li>