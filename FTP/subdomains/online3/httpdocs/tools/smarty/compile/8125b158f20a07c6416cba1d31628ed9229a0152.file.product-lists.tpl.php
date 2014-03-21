<?php /* Smarty version Smarty-3.0.7, created on 2012-06-28 20:45:08
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/themes/goodjob/./product-lists.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7821729174fec5fe4471c75-61457885%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8125b158f20a07c6416cba1d31628ed9229a0152' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/themes/goodjob/./product-lists.tpl',
      1 => 1334941312,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7821729174fec5fe4471c75-61457885',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/tools/smarty/plugins/modifier.escape.php';
?>

<?php if (isset($_smarty_tpl->getVariable('products',null,true,false)->value)){?>
	<!-- Products list -->
    <div id="#product_lists_wrapper">
	<ul id="product_lists" class="clear">
	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['index']=-1;
if ($_smarty_tpl->tpl_vars['product']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['first'] = $_smarty_tpl->tpl_vars['product']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['last'] = $_smarty_tpl->tpl_vars['product']->last;
?>
		<li class="ajax_block_product <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['products']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['products']['last']){?>last_item<?php }?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['products']['index']%2){?>alternate_item<?php }else{ ?>item<?php }?> clearfix ">
			<div>
				<a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['link'],'htmlall','UTF-8');?>
" class="product_img_link" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'htmlall','UTF-8');?>
">
                	<img src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home');?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['legend'],'htmlall','UTF-8');?>
" <?php if (isset($_smarty_tpl->getVariable('homeSize',null,true,false)->value)){?> width="100" height="80"<?php }?> />
                    
                    <?php if (isset($_smarty_tpl->tpl_vars['product']->value['online_only'])&&$_smarty_tpl->tpl_vars['product']->value['online_only']){?><span></span><?php }?>
                    
                    <?php if (isset($_smarty_tpl->tpl_vars['product']->value['available_for_order'])&&$_smarty_tpl->tpl_vars['product']->value['available_for_order']&&!isset($_smarty_tpl->getVariable('restricted_country_mode',null,true,false)->value)){?><?php if (($_smarty_tpl->tpl_vars['product']->value['allow_oosp']||$_smarty_tpl->tpl_vars['product']->value['quantity']>0)){?><?php }elseif((isset($_smarty_tpl->tpl_vars['product']->value['quantity_all_versions'])&&$_smarty_tpl->tpl_vars['product']->value['quantity_all_versions']>0)){?><span></span><?php }else{ ?><span><?php }?></span><?php }?>
                    
                    <?php if (isset($_smarty_tpl->tpl_vars['product']->value['on_sale'])&&$_smarty_tpl->tpl_vars['product']->value['on_sale']&&isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?><span></span>
				<?php }elseif(isset($_smarty_tpl->tpl_vars['product']->value['reduction'])&&$_smarty_tpl->tpl_vars['product']->value['reduction']&&isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price']&&!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?><span></span><?php }?> 
                
                <?php if (isset($_smarty_tpl->tpl_vars['product']->value['new'])&&$_smarty_tpl->tpl_vars['product']->value['new']==1){?><span></span><?php }?>
                
               </a>
               
				<h3>
			</div>																				 
			<div class="right_block">
				
				<?php if ((!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value&&((isset($_smarty_tpl->tpl_vars['product']->value['show_price'])&&$_smarty_tpl->tpl_vars['product']->value['show_price'])||(isset($_smarty_tpl->tpl_vars['product']->value['available_for_order'])&&$_smarty_tpl->tpl_vars['product']->value['available_for_order'])))){?>
				<div>
                    
				</div>
				<?php }?>
				<?php if (isset($_smarty_tpl->getVariable('comparator_max_item',null,true,false)->value)&&$_smarty_tpl->getVariable('comparator_max_item')->value){?>
					<p class="compare"><input type="checkbox" class="comparator" id="comparator_item_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" value="comparator_item_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" <?php if (isset($_smarty_tpl->getVariable('compareProducts',null,true,false)->value)&&in_array($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->getVariable('compareProducts')->value)){?>checked<?php }?>/> <label for="comparator_item_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
"><?php echo smartyTranslate(array('s'=>'Select to compare'),$_smarty_tpl);?>
</label></p>
				<?php }?>
			</div>
		</li>
	<?php }} ?>
	</ul>
    </div>
	<!-- /Products list -->
<?php }?>
