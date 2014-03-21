<?php /* Smarty version Smarty-3.0.7, created on 2012-04-23 23:09:34
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/blockwishlist/managewishlist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12044396964f957ebe55d684-45532760%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5f5c308f667992413fdb43823eaa57e8ddfa264f' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/blockwishlist/managewishlist.tpl',
      1 => 1335087505,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12044396964f957ebe55d684-45532760',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_date_format')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/modifier.date_format.php';
?>

<?php if ($_smarty_tpl->getVariable('products')->value){?>
<?php if (!$_smarty_tpl->getVariable('refresh')->value){?>
	<br />
	<a href="#" id="hideBoughtProducts" class="button_account"  onclick="WishlistVisibility('wlp_bought', 'BoughtProducts'); return false;"><?php echo smartyTranslate(array('s'=>'Hide products','mod'=>'blockwishlist'),$_smarty_tpl);?>
</a>
	<a href="#" id="showBoughtProducts" class="button_account"  onclick="WishlistVisibility('wlp_bought', 'BoughtProducts'); return false;"><?php echo smartyTranslate(array('s'=>'Show products','mod'=>'blockwishlist'),$_smarty_tpl);?>
</a>
	<?php if (count($_smarty_tpl->getVariable('productsBoughts')->value)){?>
	<a href="#" id="hideBoughtProductsInfos" class="button_account" onclick="WishlistVisibility('wlp_bought_infos', 'BoughtProductsInfos'); return false;"><?php echo smartyTranslate(array('s'=>'Hide bought product\'s info','mod'=>'blockwishlist'),$_smarty_tpl);?>
</a>
	<?php }?>
	<a href="#" id="showSendWishlist" class="button_account" onclick="WishlistVisibility('wl_send', 'SendWishlist'); return false;"><?php echo smartyTranslate(array('s'=>'Send this wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>
</a>
	<a href="#" id="hideSendWishlist" class="button_account" onclick="WishlistVisibility('wl_send', 'SendWishlist'); return false;"><?php echo smartyTranslate(array('s'=>'Close send this wishlist','mod'=>'blockwishlist'),$_smarty_tpl);?>
</a>
	<span class="clear"></span>
	<br />
<?php }?>
	<div class="wlp_bought">
	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['index']++;
?>
	<table class="std">
				<thead>
					<tr>
						<th class="first_item"><center><?php echo smartyTranslate(array('s'=>'Product','mod'=>'blockwishlist'),$_smarty_tpl);?>
</center></th>
						<th class="item"><center><?php echo smartyTranslate(array('s'=>'Comment','mod'=>'blockwishlist'),$_smarty_tpl);?>
</center></th>
						<th class="item"><center><?php echo smartyTranslate(array('s'=>'Date Added','mod'=>'blockwishlist'),$_smarty_tpl);?>
</center></th>
						<th class="last_item"><center><?php echo smartyTranslate(array('s'=>'Action','mod'=>'blockwishlist'),$_smarty_tpl);?>
</center></th>
					</tr>
				</thead>
	
	<tbody>
	<tr>
		<td>
			<?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],30,'...'),'htmlall','UTF-8');?>

				<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getProductlink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category_rewrite']);?>
" title="<?php echo smartyTranslate(array('s'=>'Product detail','mod'=>'blockwishlist'),$_smarty_tpl);?>
"></br>
					<img src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['cover'],'medium');?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'htmlall','UTF-8');?>
" /></br>
				</a>
			
			<ul class="address <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['i']['index']%2){?>alternate_<?php }?>item" style="margin:5px 0 0 5px;" id="wlp_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
">
		</td>
		
		<td><span class="wishlist_product_detail">
			<?php if (isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])){?>
				
				<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getProductlink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category_rewrite']);?>
" title="<?php echo smartyTranslate(array('s'=>'Product detail','mod'=>'blockwishlist'),$_smarty_tpl);?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['attributes_small'],'htmlall','UTF-8');?>
</a>
			<?php }?>
		</td>
		
		<td>
			<?php echo smartyTranslate(array('s'=>'Date Added'),$_smarty_tpl);?>

		</td>
		
		<td>
				<br /><?php echo smartyTranslate(array('s'=>'Quantity','mod'=>'blockwishlist'),$_smarty_tpl);?>
:<input type="text" id="quantity_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
" value="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['quantity']);?>
" size="3"  />
				
				
			</span>
				<a href="javascript:;" class="clear button" onclick="WishlistProductManage('wlp_bought_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
', 'update', '<?php echo $_smarty_tpl->getVariable('id_wishlist')->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
', '<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
', $('#quantity_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
').val(), $('#priority_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
').val());" title="<?php echo smartyTranslate(array('s'=>'Save','mod'=>'blockwishlist'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Save','mod'=>'blockwishlist'),$_smarty_tpl);?>
</a>
				<a href="javascript:;" class="clear button" onclick="WishlistProductManage('wlp_bought', 'delete', '<?php echo $_smarty_tpl->getVariable('id_wishlist')->value;?>
', '<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
', '<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
', $('#quantity_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
').val(), $('#priority_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
').val());" title="<?php echo smartyTranslate(array('s'=>'REMOVE ITEM','mod'=>'blockwishlist'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'REMOVE ITEM','mod'=>'blockwishlist'),$_smarty_tpl);?>
</a>
				<br />
		</td>
	<tr>
	
	</tbody>
	</table>
			
	<?php }} ?>
	</div>
	<br />
	<?php if (!$_smarty_tpl->getVariable('refresh')->value){?>
	<form method="post" class="wl_send std hidden" onsubmit="return (false);">
		<fieldset>
			<p class="required">
				<label for="email1"><?php echo smartyTranslate(array('s'=>'Email','mod'=>'blockwishlist'),$_smarty_tpl);?>
1</label>
				<input type="text" name="email1" id="email1" />
				<sup>*</sup>
			</p>
			<?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=11) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = (int)2;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] < 0)
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = max($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : -1, $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start']);
else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = min($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1);
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = min(ceil(($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start']+1)/abs($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'])), $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max']);
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
			<p>
				<label for="email<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['i']['index'];?>
"><?php echo smartyTranslate(array('s'=>'Email','mod'=>'blockwishlist'),$_smarty_tpl);?>
<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['i']['index'];?>
</label>
				<input type="text" name="email<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['i']['index'];?>
" id="email<?php echo $_smarty_tpl->getVariable('smarty')->value['section']['i']['index'];?>
" />
			</p>
			<?php endfor; endif; ?>
			<p class="submit">
				<input class="button" type="submit" value="<?php echo smartyTranslate(array('s'=>'Send','mod'=>'blockwishlist'),$_smarty_tpl);?>
" name="submitWishlist" onclick="WishlistSend('wl_send', '<?php echo $_smarty_tpl->getVariable('id_wishlist')->value;?>
', 'email');" />
			</p>
			<p class="required">
				<sup>*</sup>
				<?php echo smartyTranslate(array('s'=>'Required field'),$_smarty_tpl);?>

			</p>
		</fieldset>
	</form>
	<?php if (count($_smarty_tpl->getVariable('productsBoughts')->value)){?>
	<table class="wlp_bought_infos hidden std">
		<thead>
			<tr>
				<th class="first_item"><?php echo smartyTranslate(array('s'=>'Product','mod'=>'blockwishlist'),$_smarty_tpl);?>
</td>
				<th class="item"><?php echo smartyTranslate(array('s'=>'Quantity','mod'=>'blockwishlist'),$_smarty_tpl);?>
</td>
				<th class="item"><?php echo smartyTranslate(array('s'=>'Offered by','mod'=>'blockwishlist'),$_smarty_tpl);?>
</td>
				<th class="last_item"><?php echo smartyTranslate(array('s'=>'Date','mod'=>'blockwishlist'),$_smarty_tpl);?>
</td>
			</tr>
		</thead>
		<tbody>
		<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('productsBoughts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['i']['index']++;
?>
			<?php  $_smarty_tpl->tpl_vars['bought'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['product']->value['bought']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['bought']->key => $_smarty_tpl->tpl_vars['bought']->value){
?>
			<?php if ($_smarty_tpl->tpl_vars['bought']->value['quantity']>0){?>
				<tr>
					<td class="first_item">
					<span style="float:left;"><img src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['cover'],'small');?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'htmlall','UTF-8');?>
" /></span>			
					<span style="float:left;"><?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],40,'...'),'htmlall','UTF-8');?>

					<?php if (isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])){?>
						<br /><i><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['attributes_small'],'htmlall','UTF-8');?>
</i>
					<?php }?></span>
					</td>
					<td class="item align_center"><?php echo intval($_smarty_tpl->tpl_vars['bought']->value['quantity']);?>
</td>
					<td class="item align_center"><?php echo $_smarty_tpl->tpl_vars['bought']->value['firstname'];?>
 <?php echo $_smarty_tpl->tpl_vars['bought']->value['lastname'];?>
</td>
					<td class="last_item align_center"><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['bought']->value['date_add'],"%Y-%m-%d");?>
</td>
				</tr>
			<?php }?>
			<?php }} ?>
		<?php }} ?>
		</tbody>
	</table>
	<?php }?>
	<?php }?>
<?php }else{ ?>
	<?php echo smartyTranslate(array('s'=>'No products','mod'=>'blockwishlist'),$_smarty_tpl);?>

<?php }?>
