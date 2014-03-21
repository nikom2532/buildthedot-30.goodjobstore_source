<?php /* Smarty version Smarty-3.0.7, created on 2012-04-29 20:42:09
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/shopping-cart.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1946301304f9d453134d0a4-16438028%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4832535d725b1039cdb5e9deea1fee94490d1dde' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/shopping-cart.tpl',
      1 => 1335106818,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1946301304f9d453134d0a4-16438028',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/modifier.escape.php';
?>

<?php ob_start(); ?><?php echo smartyTranslate(array('s'=>'Shopping cart'),$_smarty_tpl);?>
<?php  Smarty::$_smarty_vars['capture']['path']=ob_get_clean();?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./breadcrumb.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<h1 id="cart_title"><?php echo smartyTranslate(array('s'=>'Shopping cart'),$_smarty_tpl);?>
</h1>

<?php $_smarty_tpl->tpl_vars['current_step'] = new Smarty_variable('summary', null, null);?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./order-steps.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./errors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<?php if (isset($_smarty_tpl->getVariable('empty',null,true,false)->value)){?>
	<p class="warning"><?php echo smartyTranslate(array('s'=>'Your shopping cart is empty.'),$_smarty_tpl);?>
</p>
<?php }elseif($_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?>
	<p class="warning"><?php echo smartyTranslate(array('s'=>'This store has not accepted your new order.'),$_smarty_tpl);?>
</p>
<?php }else{ ?>
	<script type="text/javascript">
	// <![CDATA[
	var currencySign = '<?php echo html_entity_decode($_smarty_tpl->getVariable('currencySign')->value,2,"UTF-8");?>
';
	var currencyRate = '<?php echo floatval($_smarty_tpl->getVariable('currencyRate')->value);?>
';
	var currencyFormat = '<?php echo intval($_smarty_tpl->getVariable('currencyFormat')->value);?>
';
	var currencyBlank = '<?php echo intval($_smarty_tpl->getVariable('currencyBlank')->value);?>
';
	var txtProduct = "<?php echo smartyTranslate(array('s'=>'product'),$_smarty_tpl);?>
";
	var txtProducts = "<?php echo smartyTranslate(array('s'=>'products'),$_smarty_tpl);?>
";
	// ]]>
	</script>
	<p style="display:none" id="emptyCartWarning" class="warning"><?php echo smartyTranslate(array('s'=>'Your shopping cart is empty.'),$_smarty_tpl);?>
</p>

<div  id="" class="rte-cart">
	<table class="std" >
		<thead>
			<tr>
				<th><?php echo smartyTranslate(array('s'=>'Items'),$_smarty_tpl);?>
</th>
				<th class="item"><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
</th>
				<th class="item"><?php echo smartyTranslate(array('s'=>'Description'),$_smarty_tpl);?>
</th>
				<th class="item"><?php echo smartyTranslate(array('s'=>'Qty'),$_smarty_tpl);?>
</th>				
				<th class="item"><?php echo smartyTranslate(array('s'=>'Price'),$_smarty_tpl);?>
</th>
				<th class="item"><?php echo smartyTranslate(array('s'=>'Move to Wishlist'),$_smarty_tpl);?>
</th>
				<th><?php echo smartyTranslate(array('s'=>'Subtotal'),$_smarty_tpl);?>
</th>
				<th class="item"><?php echo smartyTranslate(array('s'=>''),$_smarty_tpl);?>
</th>
			</tr>
		</thead>
		<tfoot>
		
		<tr class="cart_total_price">
				<td colspan="7"></td>
				<td class="price" id="total_price"></td>
			</tr>
		
		</tfoot>
		<tbody>
		<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
?>
			<?php $_smarty_tpl->tpl_vars['productId'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['id_product'], null, null);?>
			<?php $_smarty_tpl->tpl_vars['productAttributeId'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['id_product_attribute'], null, null);?>
			<?php $_smarty_tpl->tpl_vars['quantityDisplayed'] = new Smarty_variable(0, null, null);?>
			<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./shopping-cart-product-line.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
			<?php if (isset($_smarty_tpl->getVariable('customizedDatas',null,true,false)->value[$_smarty_tpl->getVariable('productId',null,true,false)->value][$_smarty_tpl->getVariable('productAttributeId',null,true,false)->value])){?>
				<?php  $_smarty_tpl->tpl_vars['customization'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id_customization'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('customizedDatas')->value[$_smarty_tpl->getVariable('productId')->value][$_smarty_tpl->getVariable('productAttributeId')->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['customization']->key => $_smarty_tpl->tpl_vars['customization']->value){
 $_smarty_tpl->tpl_vars['id_customization']->value = $_smarty_tpl->tpl_vars['customization']->key;
?>
					<tr id="product_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
" class="alternate_item cart_item">
						<td colspan="5">
							<?php  $_smarty_tpl->tpl_vars['datas'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customization']->value['datas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['datas']->key => $_smarty_tpl->tpl_vars['datas']->value){
 $_smarty_tpl->tpl_vars['type']->value = $_smarty_tpl->tpl_vars['datas']->key;
?>
								<?php if ($_smarty_tpl->tpl_vars['type']->value==$_smarty_tpl->getVariable('CUSTOMIZE_FILE')->value){?>
									<div class="customizationUploaded">
										<ul class="customizationUploaded">
											<?php  $_smarty_tpl->tpl_vars['picture'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['datas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['picture']->key => $_smarty_tpl->tpl_vars['picture']->value){
?><li><img src="<?php echo $_smarty_tpl->getVariable('pic_dir')->value;?>
<?php echo $_smarty_tpl->tpl_vars['picture']->value['value'];?>
_small" alt="" class="customizationUploaded" /></li><?php }} ?>
										</ul>
									</div>
								<?php }elseif($_smarty_tpl->tpl_vars['type']->value==$_smarty_tpl->getVariable('CUSTOMIZE_TEXTFIELD')->value){?>
									<ul class="typedText">
										<?php  $_smarty_tpl->tpl_vars['textField'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['datas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['typedText']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['textField']->key => $_smarty_tpl->tpl_vars['textField']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['typedText']['index']++;
?><li><?php if ($_smarty_tpl->tpl_vars['textField']->value['name']){?><?php echo $_smarty_tpl->tpl_vars['textField']->value['name'];?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Text #'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['typedText']['index']+1;?>
<?php }?><?php echo smartyTranslate(array('s'=>':'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['textField']->value['value'];?>
</li><?php }} ?>
									</ul>
								<?php }?>
							<?php }} ?>
						</td>
						<td class="cart_quantity">
							<div style="float:right">
								<a rel="nofollow" class="cart_quantity_delete" id="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
" href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('cart.php',true);?>
?delete&amp;id_product=<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
&amp;ipa=<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
&amp;id_customization=<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
&amp;token=<?php echo $_smarty_tpl->getVariable('token_cart')->value;?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
icon/delete.gif" alt="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Delete this customization'),$_smarty_tpl);?>
" width="11" height="13" class="icon" /></a>
							</div>
							<div id="cart_quantity_button" style="float:left">
							<a rel="nofollow" class="cart_quantity_up" id="cart_quantity_up_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
" href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('cart.php',true);?>
?add&amp;id_product=<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
&amp;ipa=<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
&amp;id_customization=<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
&amp;token=<?php echo $_smarty_tpl->getVariable('token_cart')->value;?>
" title="<?php echo smartyTranslate(array('s'=>'Add'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
icon/quantity_up.gif" alt="<?php echo smartyTranslate(array('s'=>'Add'),$_smarty_tpl);?>
" width="14" height="9" /></a><br />
							<?php if ($_smarty_tpl->tpl_vars['product']->value['minimal_quantity']<($_smarty_tpl->tpl_vars['customization']->value['quantity']-$_smarty_tpl->getVariable('quantityDisplayed')->value)||$_smarty_tpl->tpl_vars['product']->value['minimal_quantity']<=1){?>
							<a rel="nofollow" class="cart_quantity_down" id="cart_quantity_down_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
" href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('cart.php',true);?>
?add&amp;id_product=<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
&amp;ipa=<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
&amp;id_customization=<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
&amp;op=down&amp;token=<?php echo $_smarty_tpl->getVariable('token_cart')->value;?>
" title="<?php echo smartyTranslate(array('s'=>'Subtract'),$_smarty_tpl);?>
">
								<img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
icon/quantity_down.gif" alt="<?php echo smartyTranslate(array('s'=>'Subtract'),$_smarty_tpl);?>
" width="14" height="9" />
							</a>
							<?php }else{ ?>
							<a class="cart_quantity_down" style="opacity: 0.3;" id="cart_quantity_down_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
" href="#" title="<?php echo smartyTranslate(array('s'=>'Subtract'),$_smarty_tpl);?>
">
								<img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
icon/quantity_down.gif" alt="<?php echo smartyTranslate(array('s'=>'Subtract'),$_smarty_tpl);?>
" width="14" height="9" />
							</a>
							<?php }?>
							</div>
							<input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['customization']->value['quantity'];?>
" name="quantity_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
_hidden"/>
							<input size="2" type="text" value="<?php echo $_smarty_tpl->tpl_vars['customization']->value['quantity'];?>
" class="cart_quantity_input" name="quantity_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
"/>
						</td>
						<td class="cart_total"></td>
						<td></td>
					</tr>
					<?php $_smarty_tpl->tpl_vars['quantityDisplayed'] = new Smarty_variable($_smarty_tpl->getVariable('quantityDisplayed')->value+$_smarty_tpl->tpl_vars['customization']->value['quantity'], null, null);?>
				<?php }} ?>
				<?php if ($_smarty_tpl->tpl_vars['product']->value['quantity']-$_smarty_tpl->getVariable('quantityDisplayed')->value>0){?><?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./shopping-cart-product-line.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?><?php }?>
			<?php }?>
		<?php }} ?>
		</tbody>
	<?php if (sizeof($_smarty_tpl->getVariable('discounts')->value)){?>
		<tbody>
		<?php  $_smarty_tpl->tpl_vars['discount'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('discounts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['discount']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['discount']->iteration=0;
 $_smarty_tpl->tpl_vars['discount']->index=-1;
if ($_smarty_tpl->tpl_vars['discount']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['discount']->key => $_smarty_tpl->tpl_vars['discount']->value){
 $_smarty_tpl->tpl_vars['discount']->iteration++;
 $_smarty_tpl->tpl_vars['discount']->index++;
 $_smarty_tpl->tpl_vars['discount']->first = $_smarty_tpl->tpl_vars['discount']->index === 0;
 $_smarty_tpl->tpl_vars['discount']->last = $_smarty_tpl->tpl_vars['discount']->iteration === $_smarty_tpl->tpl_vars['discount']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['discountLoop']['first'] = $_smarty_tpl->tpl_vars['discount']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['discountLoop']['last'] = $_smarty_tpl->tpl_vars['discount']->last;
?>
			<tr class="cart_discount <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['discountLoop']['last']){?>last_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['discountLoop']['first']){?>first_item<?php }else{ ?>item<?php }?>" id="cart_discount_<?php echo $_smarty_tpl->tpl_vars['discount']->value['id_discount'];?>
">
				<td class="cart_discount_name" colspan="2"><?php echo $_smarty_tpl->tpl_vars['discount']->value['name'];?>
</td>
				<td class="cart_discount_description" colspan="3"><?php echo $_smarty_tpl->tpl_vars['discount']->value['description'];?>
</td>
				<td class="cart_discount_delete"><a href="<?php if ($_smarty_tpl->getVariable('opc')->value){?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order-opc.php',true);?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order.php',true);?>
<?php }?>?deleteDiscount=<?php echo $_smarty_tpl->tpl_vars['discount']->value['id_discount'];?>
" title="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
icon/delete.gif" alt="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
" class="icon" width="11" height="13" /></a></td>
				<td class="cart_discount_price"><span class="price-discount">
					<?php if ($_smarty_tpl->tpl_vars['discount']->value['value_real']>0){?>
						<?php if (!$_smarty_tpl->getVariable('priceDisplay')->value){?><?php echo Tools::displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_real']*-1),$_smarty_tpl);?>
<?php }else{ ?><?php echo Tools::displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_tax_exc']*-1),$_smarty_tpl);?>
<?php }?>
					<?php }?>
				</span></td>
			</tr>
		<?php }} ?>
		</tbody>
	<?php }?>
	</table>
</div>

<?php if ($_smarty_tpl->getVariable('voucherAllowed')->value){?>
<div id="cart_voucher">
	<?php if (isset($_smarty_tpl->getVariable('errors_discount',null,true,false)->value)&&$_smarty_tpl->getVariable('errors_discount')->value){?>
		<ul class="error">
		<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errors_discount')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['error']->key;
?>
			<li><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['error']->value,'htmlall','UTF-8');?>
</li>
		<?php }} ?>
		</ul>
	<?php }?>
	<form action="<?php if ($_smarty_tpl->getVariable('opc')->value){?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order-opc.php',true);?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order.php',true);?>
<?php }?>" method="post" id="voucher">
		<fieldset>
			<h4><?php echo smartyTranslate(array('s'=>'COUPON CODE'),$_smarty_tpl);?>
</h4>
            <p style="margin: -2px 0px 5px 0px; padding: 0px;"><?php echo smartyTranslate(array('s'=>'Please enter your coupon code'),$_smarty_tpl);?>
</p>
			<p>
				<input type="text" id="discount_name" name="discount_name" value="<?php if (isset($_smarty_tpl->getVariable('discount_name',null,true,false)->value)&&$_smarty_tpl->getVariable('discount_name')->value){?><?php echo $_smarty_tpl->getVariable('discount_name')->value;?>
<?php }?>" />
			</p>
	

			<p class="submit"><input type="hidden" name="submitDiscount" /><input type="submit" name="submitAddDiscount" value="<?php echo smartyTranslate(array('s'=>'APPLY CODE'),$_smarty_tpl);?>
" class="mybutton" /></p>
		<?php if ($_smarty_tpl->getVariable('displayVouchers')->value){?>
			<h4><?php echo smartyTranslate(array('s'=>'Take advantage of our offers:'),$_smarty_tpl);?>
</h4>
			<div id="display_cart_vouchers">
			<?php  $_smarty_tpl->tpl_vars['voucher'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('displayVouchers')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['voucher']->key => $_smarty_tpl->tpl_vars['voucher']->value){
?>
				<span onclick="$('#discount_name').val('<?php echo $_smarty_tpl->tpl_vars['voucher']->value['name'];?>
');return false;" class="voucher_name"><?php echo $_smarty_tpl->tpl_vars['voucher']->value['name'];?>
</span> - <?php echo $_smarty_tpl->tpl_vars['voucher']->value['description'];?>
 <br />
			<?php }} ?>
			</div>
		<?php }?>
		</fieldset>
	</form>
</div>
<?php }?>
	
<div id="HOOK_SHOPPING_CART"><?php echo $_smarty_tpl->getVariable('HOOK_SHOPPING_CART')->value;?>
</div>

<p class="cart_navigation" style="border: 0px solid red; display: block; margin: 0px 0px 0px 0px; float: right">
	<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order.php',true);?>
?step=0" class="mybutton_large" title="<?php echo smartyTranslate(array('s'=>'UPDATE CART'),$_smarty_tpl);?>
" style="margin-left: 10px;"><?php echo smartyTranslate(array('s'=>'UPDATE CART'),$_smarty_tpl);?>
</a>
	<a href="<?php if ((isset($_SERVER['HTTP_REFERER'])&&strstr($_SERVER['HTTP_REFERER'],$_smarty_tpl->getVariable('link')->value->getPageLink('order.php')))||!isset($_SERVER['HTTP_REFERER'])){?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('index.php');?>
<?php }else{ ?><?php echo Tools::secureReferrer(smarty_modifier_escape($_SERVER['HTTP_REFERER'],'htmlall','UTF-8'));?>
<?php }?>" class="mybutton_large" title="<?php echo smartyTranslate(array('s'=>'COUNTINUE SHOPPING'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'CONTINUE SHOPPING'),$_smarty_tpl);?>
</a>

</p><br /><br /><br /><br /><span style="float:right;color:black;font-size: 15px;font-weight:bold">TOTAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo Tools::displayPriceSmarty(array('price'=>$_smarty_tpl->getVariable('total_price')->value),$_smarty_tpl);?>
</span>
<br /><br />
<p class="cart_navigation" style="border: 0px solid red; display: block; margin: 0px 0px 0px 0px; float: right">

	<?php if (!$_smarty_tpl->getVariable('opc')->value){?><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order.php',true);?>
?step=1<?php if ($_smarty_tpl->getVariable('back')->value){?>&amp;back=<?php echo $_smarty_tpl->getVariable('back')->value;?>
<?php }?>" class="mybutton_large" title="<?php echo smartyTranslate(array('s'=>'CHECK OUT'),$_smarty_tpl);?>
" style="margin-left: 10px;"><?php echo smartyTranslate(array('s'=>'CHECK OUT'),$_smarty_tpl);?>
</a><?php }?></p>

<p class="cart_navigation_extra">

	<span id="HOOK_SHOPPING_CART_EXTRA"><?php echo $_smarty_tpl->getVariable('HOOK_SHOPPING_CART_EXTRA')->value;?>
</span>

</p>
<?php }?>

