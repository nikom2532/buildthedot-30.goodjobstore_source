<?php /* Smarty version Smarty-3.0.7, created on 2012-04-16 22:45:44
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/productsblocksc/productsblocksc.tpl" */ ?>
<?php /*%%SmartyHeaderCode:880411444f8c3ea8568831-05032879%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a5af1e709c62acf9434e5f9353c2df5d10c55b95' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/productsblocksc/productsblocksc.tpl',
      1 => 1334590290,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '880411444f8c3ea8568831-05032879',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_math')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/function.math.php';
if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/modifier.escape.php';
?><?php if (count($_smarty_tpl->getVariable('categoryProducts')->value)>0){?>
<script type="text/javascript">var middle = <?php echo $_smarty_tpl->getVariable('middlePosition')->value;?>
;</script> 
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
modules/productsblocksc/js/productscategory.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
themes/prestashop/js/product.js"></script>
 
<ul class="idTabs">
	<li><a href="#idTab3"><?php echo smartyTranslate(array('s'=>'You will also like:','mod'=>'productsblocksc'),$_smarty_tpl);?>
</a></li>
</ul>
<div id="<?php if (count($_smarty_tpl->getVariable('categoryProducts')->value)>5){?>productscategory<?php }else{ ?>productscategory_noscroll<?php }?>">
<?php if (count($_smarty_tpl->getVariable('categoryProducts')->value)>5){?><a id="productscategory_scroll_left" title="<?php echo smartyTranslate(array('s'=>'Previous','mod'=>'productsblocksc'),$_smarty_tpl);?>
" href="javascript:{}" style=" visibility: hidden;"><?php echo smartyTranslate(array('s'=>'Previous','mod'=>'productsblocksc'),$_smarty_tpl);?>
</a><?php }?>
<div id="productscategory_list">
	<ul <?php if (count($_smarty_tpl->getVariable('categoryProducts')->value)>5){?>style="width: <?php echo smarty_function_math(array('equation'=>"width * nbImages",'width'=>107,'nbImages'=>count($_smarty_tpl->getVariable('categoryProducts')->value)),$_smarty_tpl);?>
px"<?php }?>>
		<?php  $_smarty_tpl->tpl_vars['categoryProduct'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categoryProducts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['categoryProduct']->key => $_smarty_tpl->tpl_vars['categoryProduct']->value){
?>
		<li <?php if (count($_smarty_tpl->getVariable('categoryProducts')->value)<6){?>style="width: <?php echo smarty_function_math(array('equation'=>"width / nbImages",'width'=>94,'nbImages'=>count($_smarty_tpl->getVariable('categoryProducts')->value)),$_smarty_tpl);?>
%"<?php }?>>
			<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getProductLink($_smarty_tpl->tpl_vars['categoryProduct']->value['id_product'],$_smarty_tpl->tpl_vars['categoryProduct']->value['link_rewrite'],$_smarty_tpl->tpl_vars['categoryProduct']->value['category']);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['categoryProduct']->value['name']);?>
">
				<img src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->tpl_vars['categoryProduct']->value['link_rewrite'],$_smarty_tpl->tpl_vars['categoryProduct']->value['id_image'],'medium');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['categoryProduct']->value['name']);?>
" />
			</a><br/>
			<b><?php echo Product::convertPrice(array('price'=>smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->tpl_vars['categoryProduct']->value['price'],70,'...'),'htmlall','UTF-8')),$_smarty_tpl);?>
 </b><br/>
			<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getProductLink($_smarty_tpl->tpl_vars['categoryProduct']->value['id_product'],$_smarty_tpl->tpl_vars['categoryProduct']->value['link_rewrite'],$_smarty_tpl->tpl_vars['categoryProduct']->value['category'],$_smarty_tpl->tpl_vars['categoryProduct']->value['ean13']);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['categoryProduct']->value['name']);?>
">
			<?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->tpl_vars['categoryProduct']->value['name'],70,'...'),'htmlall','UTF-8');?>

			</a>
		</li>
		<?php }} ?>
	</ul>
</div>
<?php if (count($_smarty_tpl->getVariable('categoryProducts')->value)>5){?><a id="productscategory_scroll_right" title="<?php echo smartyTranslate(array('s'=>'Next','mod'=>'productsblocksc'),$_smarty_tpl);?>
" href="javascript:{}" style=" visibility: hidden;"><?php echo smartyTranslate(array('s'=>'Next','mod'=>'productsblocksc'),$_smarty_tpl);?>
</a><?php }?> 
</div>
<?php }?>
