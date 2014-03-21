<?php /* Smarty version Smarty-3.0.7, created on 2012-06-28 20:49:08
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/modules/homebanner/homebanner.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4737380254fec60d4ec1759-00708944%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '21c82c9981648b17c54e7587bca6bc67504ce137' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/modules/homebanner/homebanner.tpl',
      1 => 1334066913,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4737380254fec60d4ec1759-00708944',
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
