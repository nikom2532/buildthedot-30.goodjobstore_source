<?php /* Smarty version Smarty-3.0.7, created on 2012-04-23 19:22:50
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/order-detail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18501897914f95499a5376c2-28331150%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '561c50c0162369e2041740cc882649f5a82bde9f' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/order-detail.tpl',
      1 => 1335089429,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18501897914f95499a5376c2-28331150',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_function_counter')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/function.counter.php';
?>

<?php if (!isset($_GET['ajax'])){?>
<div class="block-center" id="block-history">
	<div id="block-order-detail">
<?php }?>
<?php echo $_smarty_tpl->getVariable('HOOK_ORDERDETAILDISPLAYED')->value;?>

<?php if (!$_smarty_tpl->getVariable('is_guest')->value){?><form action="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order-follow.php',true);?>
" method="post"><?php }?>
<div id="order-list" class="block-center">
	<table class="std">
		<thead>
			<tr>
				<?php if ($_smarty_tpl->getVariable('return_allowed')->value){?><th class="first_item"><input type="checkbox" /></th><?php }?>
				<th class="<?php if ($_smarty_tpl->getVariable('return_allowed')->value){?>item<?php }else{ ?>first_item<?php }?>"><?php echo smartyTranslate(array('s'=>'Reference'),$_smarty_tpl);?>
</th>
				<th class="item"><?php echo smartyTranslate(array('s'=>'Product'),$_smarty_tpl);?>
</th>
				<th class="item"><?php echo smartyTranslate(array('s'=>'Quantity'),$_smarty_tpl);?>
</th>
				<th class="item"><?php echo smartyTranslate(array('s'=>'Unit price'),$_smarty_tpl);?>
</th>
				<th class="last_item"><?php echo smartyTranslate(array('s'=>'Total price'),$_smarty_tpl);?>
</th>
			</tr>
		</thead>
		<tfoot>
			<?php if ($_smarty_tpl->getVariable('priceDisplay')->value&&$_smarty_tpl->getVariable('use_tax')->value){?>
				<tr class="item">
					<td colspan="<?php if ($_smarty_tpl->getVariable('return_allowed')->value){?>6<?php }else{ ?>5<?php }?>">
						<?php echo smartyTranslate(array('s'=>'Total products (tax excl.):'),$_smarty_tpl);?>
 <span class="price"><?php echo Product::displayWtPriceWithCurrency(array('price'=>$_smarty_tpl->getVariable('order')->value->getTotalProductsWithoutTaxes(),'currency'=>$_smarty_tpl->getVariable('currency')->value),$_smarty_tpl);?>
</span>
					</td>
				</tr>
			<?php }?>
		</tfoot>
		<tbody>
		<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['index']++;
?>
			<?php if (!isset($_smarty_tpl->tpl_vars['product']->value['deleted'])){?>
				<?php $_smarty_tpl->tpl_vars['productId'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_id'], null, null);?>
				<?php $_smarty_tpl->tpl_vars['productAttributeId'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_attribute_id'], null, null);?>
				<?php if (isset($_smarty_tpl->getVariable('customizedDatas',null,true,false)->value[$_smarty_tpl->getVariable('productId',null,true,false)->value][$_smarty_tpl->getVariable('productAttributeId',null,true,false)->value])){?><?php $_smarty_tpl->tpl_vars['productQuantity'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_quantity']-$_smarty_tpl->tpl_vars['product']->value['customizationQuantityTotal'], null, null);?><?php }else{ ?><?php $_smarty_tpl->tpl_vars['productQuantity'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_quantity'], null, null);?><?php }?>
				<!-- Customized products -->
				<?php if (isset($_smarty_tpl->getVariable('customizedDatas',null,true,false)->value[$_smarty_tpl->getVariable('productId',null,true,false)->value][$_smarty_tpl->getVariable('productAttributeId',null,true,false)->value])){?>
					<tr class="item">
						<?php if ($_smarty_tpl->getVariable('return_allowed')->value){?><td class="order_cb"></td><?php }?>
						<td><label for="cb_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
"><?php if ($_smarty_tpl->tpl_vars['product']->value['product_reference']){?><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['product_reference'],'htmlall','UTF-8');?>
<?php }else{ ?>--<?php }?></label></td>
						<td class="bold">
							<label for="cb_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['product_name'],'htmlall','UTF-8');?>
</label>
						</td>
						<td><input class="order_qte_input"  name="order_qte_input[<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['products']['index'];?>
]" type="text" size="2" value="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['customizationQuantityTotal']);?>
" /><label for="cb_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
"><span class="order_qte_span editable"><?php echo intval($_smarty_tpl->tpl_vars['product']->value['customizationQuantityTotal']);?>
</span></label></td>
						<td>
							<label for="cb_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
">
								<?php if ($_smarty_tpl->getVariable('group_use_tax')->value){?>
									<?php echo Product::convertPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['product']->value['product_price_wt'],'currency'=>$_smarty_tpl->getVariable('currency')->value,'convert'=>0),$_smarty_tpl);?>

								<?php }else{ ?>
									<?php echo Product::convertPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['product']->value['product_price'],'currency'=>$_smarty_tpl->getVariable('currency')->value,'convert'=>0),$_smarty_tpl);?>

								<?php }?>
							</label>
						</td>
						<td>
							<label for="cb_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
">
								<?php if (isset($_smarty_tpl->getVariable('customizedDatas',null,true,false)->value[$_smarty_tpl->getVariable('productId',null,true,false)->value][$_smarty_tpl->getVariable('productAttributeId',null,true,false)->value])){?>
									<?php if ($_smarty_tpl->getVariable('group_use_tax')->value){?>
										<?php echo Product::convertPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_customization_wt'],'currency'=>$_smarty_tpl->getVariable('currency')->value,'convert'=>0),$_smarty_tpl);?>

									<?php }else{ ?>
										<?php echo Product::convertPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_customization'],'currency'=>$_smarty_tpl->getVariable('currency')->value,'convert'=>0),$_smarty_tpl);?>

									<?php }?>
								<?php }else{ ?>
									<?php if ($_smarty_tpl->getVariable('group_use_tax')->value){?>
										<?php echo Product::convertPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_wt'],'currency'=>$_smarty_tpl->getVariable('currency')->value,'convert'=>0),$_smarty_tpl);?>

									<?php }else{ ?>
										<?php echo Product::convertPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_price'],'currency'=>$_smarty_tpl->getVariable('currency')->value,'convert'=>0),$_smarty_tpl);?>

									<?php }?>
								<?php }?>
							</label>
						</td>
					</tr>
					<?php  $_smarty_tpl->tpl_vars['customization'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['customizationId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('customizedDatas')->value[$_smarty_tpl->getVariable('productId')->value][$_smarty_tpl->getVariable('productAttributeId')->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['customization']->key => $_smarty_tpl->tpl_vars['customization']->value){
 $_smarty_tpl->tpl_vars['customizationId']->value = $_smarty_tpl->tpl_vars['customization']->key;
?>
					<tr class="alternate_item">
						<?php if ($_smarty_tpl->getVariable('return_allowed')->value){?><td class="order_cb"><input type="checkbox" id="cb_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
" name="customization_ids[<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
][]" value="<?php echo intval($_smarty_tpl->tpl_vars['customizationId']->value);?>
" /></td><?php }?>
						<td colspan="2">
						<?php  $_smarty_tpl->tpl_vars['datas'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customization']->value['datas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['datas']->key => $_smarty_tpl->tpl_vars['datas']->value){
 $_smarty_tpl->tpl_vars['type']->value = $_smarty_tpl->tpl_vars['datas']->key;
?>
							<?php if ($_smarty_tpl->tpl_vars['type']->value==$_smarty_tpl->getVariable('CUSTOMIZE_FILE')->value){?>
							<ul class="customizationUploaded">
								<?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['datas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
?>
									<li><img src="<?php echo $_smarty_tpl->getVariable('pic_dir')->value;?>
<?php echo $_smarty_tpl->tpl_vars['data']->value['value'];?>
_small" alt="" class="customizationUploaded" /></li>
								<?php }} ?>
							</ul>
							<?php }elseif($_smarty_tpl->tpl_vars['type']->value==$_smarty_tpl->getVariable('CUSTOMIZE_TEXTFIELD')->value){?>
							<ul class="typedText"><?php echo smarty_function_counter(array('start'=>0,'print'=>false),$_smarty_tpl);?>

								<?php  $_smarty_tpl->tpl_vars['data'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['datas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['data']->key => $_smarty_tpl->tpl_vars['data']->value){
?>
									<?php $_smarty_tpl->tpl_vars['customizationFieldName'] = new Smarty_variable(("Text #").($_smarty_tpl->tpl_vars['data']->value['id_customization_field']), null, null);?>
									<li><?php echo (($tmp = @$_smarty_tpl->tpl_vars['data']->value['name'])===null||$tmp==='' ? $_smarty_tpl->getVariable('customizationFieldName')->value : $tmp);?>
<?php echo smartyTranslate(array('s'=>':'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['data']->value['value'];?>
</li>
								<?php }} ?>
							</ul>
							<?php }?>
						<?php }} ?>
						</td>
						<td>
							<input class="order_qte_input" name="customization_qty_input[<?php echo intval($_smarty_tpl->tpl_vars['customizationId']->value);?>
]" type="text" size="2" value="<?php echo intval($_smarty_tpl->tpl_vars['customization']->value['quantity']);?>
" /><label for="cb_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
"><span class="order_qte_span editable"><?php echo intval($_smarty_tpl->tpl_vars['customization']->value['quantity']);?>
</span></label>
						</td>
						<td colspan="2"></td>
					</tr>
					<?php }} ?>
				<?php }?>
				<!-- Classic products -->
				<?php if ($_smarty_tpl->tpl_vars['product']->value['product_quantity']>$_smarty_tpl->tpl_vars['product']->value['customizationQuantityTotal']){?>
					<tr class="item">
						<?php if ($_smarty_tpl->getVariable('return_allowed')->value){?><td class="order_cb"><input type="checkbox" id="cb_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
" name="ids_order_detail[<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
]" value="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
" /></td><?php }?>
						<td><label for="cb_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
"><?php if ($_smarty_tpl->tpl_vars['product']->value['product_reference']){?><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['product_reference'],'htmlall','UTF-8');?>
<?php }else{ ?>--<?php }?></label></td>
						<td class="bold">
							<label for="cb_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
">
								<?php if ($_smarty_tpl->tpl_vars['product']->value['download_hash']&&$_smarty_tpl->getVariable('invoice')->value){?>
									<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('get-file.php',true);?>
?key=<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['filename'],'htmlall','UTF-8');?>
-<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['download_hash'],'htmlall','UTF-8');?>
<?php if (isset($_smarty_tpl->getVariable('is_guest',null,true,false)->value)&&$_smarty_tpl->getVariable('is_guest')->value){?>&id_order=<?php echo $_smarty_tpl->getVariable('order')->value->id;?>
&secure_key=<?php echo $_smarty_tpl->getVariable('order')->value->secure_key;?>
<?php }?>" title="<?php echo smartyTranslate(array('s'=>'download this product'),$_smarty_tpl);?>
">
										<img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
icon/download_product.gif" class="icon" alt="<?php echo smartyTranslate(array('s'=>'Download product'),$_smarty_tpl);?>
" />
									</a>
									<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('get-file.php',true);?>
?key=<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['filename'],'htmlall','UTF-8');?>
-<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['download_hash'],'htmlall','UTF-8');?>
<?php if (isset($_smarty_tpl->getVariable('is_guest',null,true,false)->value)&&$_smarty_tpl->getVariable('is_guest')->value){?>&id_order=<?php echo $_smarty_tpl->getVariable('order')->value->id;?>
&secure_key=<?php echo $_smarty_tpl->getVariable('order')->value->secure_key;?>
<?php }?>" title="<?php echo smartyTranslate(array('s'=>'download this product'),$_smarty_tpl);?>
">
										<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['product_name'],'htmlall','UTF-8');?>

									</a>
								<?php }else{ ?>
									<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['product_name'],'htmlall','UTF-8');?>

								<?php }?>
							</label>
						</td>
						<td><input class="order_qte_input" name="order_qte_input[<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
]" type="text" size="2" value="<?php echo intval($_smarty_tpl->getVariable('productQuantity')->value);?>
" /><label for="cb_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
"><span class="order_qte_span editable"><?php echo intval($_smarty_tpl->getVariable('productQuantity')->value);?>
</span></label></td>
						<td>
							<label for="cb_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
">
							<?php if ($_smarty_tpl->getVariable('group_use_tax')->value){?>
								<?php echo Product::convertPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['product']->value['product_price_wt'],'currency'=>$_smarty_tpl->getVariable('currency')->value,'convert'=>0),$_smarty_tpl);?>

							<?php }else{ ?>
								<?php echo Product::convertPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['product']->value['product_price'],'currency'=>$_smarty_tpl->getVariable('currency')->value,'convert'=>0),$_smarty_tpl);?>

							<?php }?>
							</label>
						</td>
						<td>
							<label for="cb_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_order_detail']);?>
">
							<?php if ($_smarty_tpl->getVariable('group_use_tax')->value){?>
								<?php echo Product::convertPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_wt'],'currency'=>$_smarty_tpl->getVariable('currency')->value,'convert'=>0),$_smarty_tpl);?>

							<?php }else{ ?>
								<?php echo Product::convertPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['product']->value['total_price'],'currency'=>$_smarty_tpl->getVariable('currency')->value,'convert'=>0),$_smarty_tpl);?>

							<?php }?>
							</label>
						</td>
					</tr>
				<?php }?>
			<?php }?>
		<?php }} ?>
		<?php  $_smarty_tpl->tpl_vars['discount'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('discounts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['discount']->key => $_smarty_tpl->tpl_vars['discount']->value){
?>
			<tr class="item">
				<td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['discount']->value['name'],'htmlall','UTF-8');?>
</td>
				<td><?php echo smartyTranslate(array('s'=>'Voucher:'),$_smarty_tpl);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['discount']->value['name'],'htmlall','UTF-8');?>
</td>
				<td><span class="order_qte_span editable">1</span></td>
				<td>&nbsp;</td>
				<td><?php if ($_smarty_tpl->tpl_vars['discount']->value['value']!=0.00){?><?php echo smartyTranslate(array('s'=>'-'),$_smarty_tpl);?>
<?php }?><?php echo Product::convertPriceWithCurrency(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value'],'currency'=>$_smarty_tpl->getVariable('currency')->value,'convert'=>0),$_smarty_tpl);?>
</td>
				<?php if ($_smarty_tpl->getVariable('return_allowed')->value){?>
				<td>&nbsp;</td>
				<?php }?>
			</tr>
		<?php }} ?>
		</tbody>
	</table>
</div>
<br />
<?php if (!$_smarty_tpl->getVariable('is_guest')->value){?>
	<?php if ($_smarty_tpl->getVariable('return_allowed')->value){?>
	<p class="bold"><?php echo smartyTranslate(array('s'=>'Merchandise return'),$_smarty_tpl);?>
</p>
	<p><?php echo smartyTranslate(array('s'=>'If you wish to return one or more products, please mark the corresponding boxes and provide an explanation for the return. Then click the button below.'),$_smarty_tpl);?>
</p>
	<p class="textarea">
		<textarea cols="67" rows="3" name="returnText"></textarea>
	</p>
	<p class="submit">
		<input type="submit" value="<?php echo smartyTranslate(array('s'=>'Make a RMA slip'),$_smarty_tpl);?>
" name="submitReturnMerchandise" class="button_large" />
		<input type="hidden" class="hidden" value="<?php echo intval($_smarty_tpl->getVariable('order')->value->id);?>
" name="id_order" />
	</p>
	<br />
	<?php }?>
	</form>

	<?php if (count($_smarty_tpl->getVariable('messages')->value)){?>
	<p class="bold"><?php echo smartyTranslate(array('s'=>'Messages'),$_smarty_tpl);?>
</p>
	<div class="table_block">
		<table class="detail_step_by_step std">
			<thead>
				<tr>
					<th class="first_item" style="width:150px;"><?php echo smartyTranslate(array('s'=>'From'),$_smarty_tpl);?>
</th>
					<th class="last_item"><?php echo smartyTranslate(array('s'=>'Message'),$_smarty_tpl);?>
</th>
				</tr>
			</thead>
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['message'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('messages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['message']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['message']->iteration=0;
 $_smarty_tpl->tpl_vars['message']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["messageList"]['index']=-1;
if ($_smarty_tpl->tpl_vars['message']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['message']->key => $_smarty_tpl->tpl_vars['message']->value){
 $_smarty_tpl->tpl_vars['message']->iteration++;
 $_smarty_tpl->tpl_vars['message']->index++;
 $_smarty_tpl->tpl_vars['message']->first = $_smarty_tpl->tpl_vars['message']->index === 0;
 $_smarty_tpl->tpl_vars['message']->last = $_smarty_tpl->tpl_vars['message']->iteration === $_smarty_tpl->tpl_vars['message']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["messageList"]['first'] = $_smarty_tpl->tpl_vars['message']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["messageList"]['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["messageList"]['last'] = $_smarty_tpl->tpl_vars['message']->last;
?>
				<tr class="<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['messageList']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['messageList']['last']){?>last_item<?php }?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['messageList']['index']%2){?>alternate_item<?php }else{ ?>item<?php }?>">
					<td>
						<?php if (isset($_smarty_tpl->tpl_vars['message']->value['ename'])&&$_smarty_tpl->tpl_vars['message']->value['ename']){?>
							<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['message']->value['efirstname'],'htmlall','UTF-8');?>
 <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['message']->value['elastname'],'htmlall','UTF-8');?>

						<?php }elseif($_smarty_tpl->tpl_vars['message']->value['clastname']){?>
							<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['message']->value['cfirstname'],'htmlall','UTF-8');?>
 <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['message']->value['clastname'],'htmlall','UTF-8');?>

						<?php }else{ ?>
							<b><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('shop_name')->value,'htmlall','UTF-8');?>
</b>
						<?php }?>
						<br />
						<?php echo Tools::dateFormat(array('date'=>$_smarty_tpl->tpl_vars['message']->value['date_add'],'full'=>1),$_smarty_tpl);?>

					</td>
					<td><?php echo nl2br($_smarty_tpl->tpl_vars['message']->value['message']);?>
</td>
				</tr>
			<?php }} ?>
			</tbody>
		</table>
	</div>
	<?php }?>
	<?php if (isset($_smarty_tpl->getVariable('errors',null,true,false)->value)&&$_smarty_tpl->getVariable('errors')->value){?>
		<div class="error">
			<p><?php if (count($_smarty_tpl->getVariable('errors')->value)>1){?><?php echo smartyTranslate(array('s'=>'There are'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'There is'),$_smarty_tpl);?>
<?php }?> <?php echo count($_smarty_tpl->getVariable('errors')->value);?>
 <?php if (count($_smarty_tpl->getVariable('errors')->value)>1){?><?php echo smartyTranslate(array('s'=>'errors'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'error'),$_smarty_tpl);?>
<?php }?> :</p>
			<ol>
			<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['error']->key;
?>
				<li><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</li>
			<?php }} ?>
			</ol>
		</div>
	<?php }?>
<?php }else{ ?>
<p><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
icon/infos.gif" alt="" class="icon" />&nbsp;<?php echo smartyTranslate(array('s'=>'You cannot make a merchandise return with a guest account'),$_smarty_tpl);?>
</p>
<?php }?>
<?php if (!isset($_GET['ajax'])){?>
	</div>
</div>
<?php }?>