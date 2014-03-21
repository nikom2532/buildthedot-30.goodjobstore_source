<?php /* Smarty version Smarty-3.0.7, created on 2012-04-30 10:12:35
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/homebanner/homebanner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17984530794f9e0323db7b88-59037223%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd23e83549bdb64607872b4abbd68546b7129b2a8' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/homebanner/homebanner.tpl',
      1 => 1334066913,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17984530794f9e0323db7b88-59037223',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- Block home banner module -->
    <div class="homebanner">
        <ul>
              <?php  $_smarty_tpl->tpl_vars['banner'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('banners')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value){
?>
              <li>
              <?php if ($_smarty_tpl->tpl_vars['banner']->value['url']!=''){?>
              <a href="<?php echo $_smarty_tpl->tpl_vars['banner']->value['url'];?>
" target="_blank">
              <?php }?>
                  <img src="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
module_br/<?php echo $_smarty_tpl->tpl_vars['banner']->value['id_banner_right'];?>
.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['banner']->value['title'];?>
" border="0"  />
               <?php if ($_smarty_tpl->tpl_vars['banner']->value['url']!=''){?></a><?php }?>
               </li>
              <?php }} ?>
        </ul>
	</div>
<!-- /Block home banner module -->
