<?php /* Smarty version Smarty-3.0.7, created on 2012-04-13 13:30:58
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/blockwishlist/view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6673489974f87c82266b7b1-98955311%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e5e1a752e9b4e713cbc1c2a33b085372789ffbfe' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/blockwishlist/view.tpl',
      1 => 1334066694,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6673489974f87c82266b7b1-98955311',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/modifier.escape.php';
?>

<div id="view_wishlist">
<h2><?php echo smartyTranslate(array('s'=>'Wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>
</h2>
<?php if ($_smarty_tpl->getVariable('wishlists')->value){?>
<p>
	<?php echo smartyTranslate(array('s'=>'Other wishlists of','mod'=>'blockwishlist'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->getVariable('current_wishlist')->value['firstname'];?>
 <?php echo $_smarty_tpl->getVariable('current_wishlist')->value['lastname'];?>
:
	<?php  $_smarty_tpl->tpl_vars['wishlist'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('wishlists')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['wishlist']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['wishlist']->iteration=0;
 $_smarty_tpl->tpl_vars['wishlist']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['index']=-1;
if ($_smarty_tpl->tpl_vars['wishlist']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['wishlist']->key => $_smarty_tpl->tpl_vars['wishlist']->value){
 $_smarty_tpl->tpl_vars['wishlist']->iteration++;
 $_smarty_tpl->tpl_vars['wishlist']->index++;
 $_smarty_tpl->tpl_vars['wishlist']->first = $_smarty_tpl->tpl_vars['wishlist']->index === 0;
 $_smarty_tpl->tpl_vars['wishlist']->last = $_smarty_tpl->tpl_vars['wishlist']->iteration === $_smarty_tpl->tpl_vars['wishlist']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['first'] = $_smarty_tpl->tpl_vars['wishlist']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['last'] = $_smarty_tpl->tpl_vars['wishlist']->last;
?>
		<?php if ($_smarty_tpl->tpl_vars['wishlist']->value['id_wishlist']!=$_smarty_tpl->getVariable('current_wishlist')->value['id_wishlist']){?>
			<a href="<?php echo $_smarty_tpl->getVariable('base_dir_ssl')->value;?>
modules/blockwishlist/view.php?token=<?php echo $_smarty_tpl->tpl_vars['wishlist']->value['token'];?>
"><?php echo $_smarty_tpl->tpl_vars['wishlist']->value['name'];?>
</a>
			<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['i']['last']){?>
				/
			<?php }?>
		<?php }?>
	<?php }} ?>
</p>
<?php }?>
<?php if ($_smarty_tpl->getVariable('products')->value){?>
<div class="addresses" id="featured-products_block_center">
	<h3><?php echo smartyTranslate(array('s'=>'Welcome to the wishlist of','mod'=>'blockwishlist'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->getVariable('current_wishlist')->value['firstname'];?>
 <?php echo $_smarty_tpl->getVariable('current_wishlist')->value['lastname'];?>
: <?php echo $_smarty_tpl->getVariable('current_wishlist')->value['name'];?>
</h3>
	<p />
	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['index']=-1;
if ($_smarty_tpl->tpl_vars['product']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['first'] = $_smarty_tpl->tpl_vars['product']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['last'] = $_smarty_tpl->tpl_vars['product']->last;
?>
		<ul class="address <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['last']){?>last_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['first']){?>first_item<?php }?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['index']%2){?>alternate_item<?php }else{ ?>item<?php }?>" id="block_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
">
		<div class="ajax_block_product">
			<li class="address_title"><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category_rewrite']);?>
" title="<?php echo smartyTranslate(array('s'=>'View','mod'=>'blockwishlist'),$_smarty_tpl);?>
"><?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],30,'...'),'htmlall','UTF-8');?>
</a></li>
			<li class="address_name">
				<a	href="<?php echo $_smarty_tpl->getVariable('link')->value->getProductlink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category_rewrite']);?>
" title="<?php echo smartyTranslate(array('s'=>'Product detail','mod'=>'blockwishlist'),$_smarty_tpl);?>
" class="product_image">
					<img src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['cover'],'medium');?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'htmlall','UTF-8');?>
" />				
				</a>
			<span class="wishlist_product_detail">
			<?php if (isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])){?>
				<br /><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getProductlink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category_rewrite']);?>
" title="<?php echo smartyTranslate(array('s'=>'Product detail','mod'=>'blockwishlist'),$_smarty_tpl);?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['attributes_small'],'htmlall','UTF-8');?>
</a>
			<?php }?>
				<br /><?php echo smartyTranslate(array('s'=>'Quantity:','mod'=>'blockwishlist'),$_smarty_tpl);?>
<input type="text" id="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
" size="3" value="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['quantity']);?>
" readonly/>
				<br /><?php echo smartyTranslate(array('s'=>'Priority:','mod'=>'blockwishlist'),$_smarty_tpl);?>

				<?php if ($_smarty_tpl->tpl_vars['product']->value['priority']==0){?>
					<span style="color:darkred; float:right;"><?php echo smartyTranslate(array('s'=>'High','mod'=>'blockwishlist'),$_smarty_tpl);?>
</span>
				<?php }elseif($_smarty_tpl->tpl_vars['product']->value['priority']==1){?>
					<span style="color:darkorange; float:right;"><?php echo smartyTranslate(array('s'=>'Medium','mod'=>'blockwishlist'),$_smarty_tpl);?>
</span>
				<?php }else{ ?>
					<span style="color:green; float:right;"><?php echo smartyTranslate(array('s'=>'Low','mod'=>'blockwishlist'),$_smarty_tpl);?>
</span>
				<?php }?>
			</span>
			</li>
			<li class="address_address1 clear">
				<a class="button_small clear" href="<?php echo $_smarty_tpl->getVariable('link')->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category_rewrite']);?>
" title="<?php echo smartyTranslate(array('s'=>'View','mod'=>'blockwishlist'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'View','mod'=>'blockwishlist'),$_smarty_tpl);?>
</a>
				<?php if (isset($_smarty_tpl->tpl_vars['product']->value['attribute_quantity'])&&$_smarty_tpl->tpl_vars['product']->value['attribute_quantity']>=1||!isset($_smarty_tpl->tpl_vars['product']->value['attribute_quantity'])&&$_smarty_tpl->tpl_vars['product']->value['product_quantity']>=1){?>
				<?php if (!$_smarty_tpl->getVariable('ajax')->value){?>
				<form id="addtocart_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
" action="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('cart.php');?>
" method="post">
				<p class="hidden">
					<input type="hidden" name="id_product" value="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" id="product_page_product_id"  />
					<input type="hidden" name="add" value="1" />
					<input type="hidden" name="token" value="<?php echo $_smarty_tpl->getVariable('token')->value;?>
" />
					<input type="hidden" name="id_product_attribute" id="idCombination" value="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
" />
				</p>
				</form>
				<?php }?>
				<a href="javascript:;" class="exclusive" onclick="WishlistBuyProduct('<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('token')->value,'htmlall','UTF-8');?>
', '<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
', '<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
', '<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
', this, <?php echo $_smarty_tpl->getVariable('ajax')->value;?>
);" title="<?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'homefeatured'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'blockwishlist'),$_smarty_tpl);?>
</a>
				<?php }else{ ?>
				<span class="exclusive"><?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'blockwishlist'),$_smarty_tpl);?>
</span>
				<?php }?>
			</li>
		</div>
		</ul>
		<div class="clear">&nbsp;</div>
	<?php }} ?>
	<p class="clear" />
</div>
<?php }else{ ?>
	<?php echo smartyTranslate(array('s'=>'No products','mod'=>'blockwishlist'),$_smarty_tpl);?>

<?php }?>
</div>
