<?php /* Smarty version Smarty-3.0.7, created on 2012-04-23 23:09:28
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/blockwishlist/mywishlist.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17821703064f957eb8528df8-15516345%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2e781d9cc4364375dbb6389161830aa56ff42fd' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/blockwishlist/mywishlist.tpl',
      1 => 1335079744,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17821703064f957eb8528df8-15516345',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_date_format')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/modifier.date_format.php';
?>

<div id="mywishlist">
	<?php ob_start(); ?><?php echo smartyTranslate(array('s'=>'WISH LIST','mod'=>'blockwishlist'),$_smarty_tpl);?>
<?php  Smarty::$_smarty_vars['capture']['path']=ob_get_clean();?>
	<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./dashboard.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

	<h1><?php echo smartyTranslate(array('s'=>'WISH LIST','mod'=>'blockwishlist'),$_smarty_tpl);?>
</h1>
<div id="DashboardLeft">
        <ul>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order-slip.php');?>
">Notification</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('identity.php');?>
">My info</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('history.php');?>
">Order History</a></li>
            <li><a class="active" href="#">Wish list</a></li>
            <li><a href="http://online.goodjobstore.com/th/order">My cart</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('discount.php');?>
">My coupon</a></li>
        </ul>
</div>
	<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./errors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
	
<div id="DashboardRight" class="rte">
<div id="DashboardRightSub3">
		<?php if ($_smarty_tpl->getVariable('wishlists')->value){?>
		<div id="block-history" class="block-center">
			<table class="std">
				<thead>
					<tr>
						<th class="first_item"><?php echo smartyTranslate(array('s'=>'Product','mod'=>'blockwishlist'),$_smarty_tpl);?>
</th>
						<th class="item mywishlist_first"><?php echo smartyTranslate(array('s'=>'Viewed','mod'=>'blockwishlist'),$_smarty_tpl);?>
</th>
						<th class="item mywishlist_second"><?php echo smartyTranslate(array('s'=>'Date Added','mod'=>'blockwishlist'),$_smarty_tpl);?>
</th>
						<th class="item mywishlist_first"><?php echo smartyTranslate(array('s'=>'Qty','mod'=>'blockwishlist'),$_smarty_tpl);?>
</th>
						<th class="item mywishlist_second"><?php echo smartyTranslate(array('s'=>'Direct Link','mod'=>'blockwishlist'),$_smarty_tpl);?>
</th>
						<th class="last_item mywishlist_first"><?php echo smartyTranslate(array('s'=>'Delete','mod'=>'blockwishlist'),$_smarty_tpl);?>
</th>
					</tr>
				</thead>
				<tbody>
				<?php unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->getVariable('wishlists')->value) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
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
					<tr id="wishlist_<?php echo intval($_smarty_tpl->getVariable('wishlists')->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id_wishlist']);?>
">
						<td class="bold" style="width:200px;"><a href="javascript:;" onclick="javascript:WishlistManage('block-order-detail', '<?php echo intval($_smarty_tpl->getVariable('wishlists')->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id_wishlist']);?>
');"><?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->getVariable('wishlists')->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['name'],30,'...'),'htmlall','UTF-8');?>
</a></td>
						<td class="align_center"><?php echo intval($_smarty_tpl->getVariable('wishlists')->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['counter']);?>
</td>
						<td class="align_center"><?php echo smarty_modifier_date_format($_smarty_tpl->getVariable('wishlists')->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['date_add'],"%Y-%m-%d");?>
</td>
						<td class="bold align_center">
						<?php $_smarty_tpl->tpl_vars['n'] = new Smarty_variable(0, null, null);?>
						<?php  $_smarty_tpl->tpl_vars['nb'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('nbProducts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['nb']->key => $_smarty_tpl->tpl_vars['nb']->value){
?>
							<?php if ($_smarty_tpl->tpl_vars['nb']->value['id_wishlist']==$_smarty_tpl->getVariable('wishlists')->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id_wishlist']){?>
								<?php $_smarty_tpl->tpl_vars['n'] = new Smarty_variable(intval($_smarty_tpl->tpl_vars['nb']->value['nbProducts']), null, null);?>
							<?php }?>
						<?php }} ?>
						<?php if ($_smarty_tpl->getVariable('n')->value){?>
							<?php echo intval($_smarty_tpl->getVariable('n')->value);?>

						<?php }else{ ?>
							0
						<?php }?>
						</td>
						<td class="align_center"><a href="javascript:;" onclick="javascript:WishlistManage('block-order-detail', '<?php echo intval($_smarty_tpl->getVariable('wishlists')->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id_wishlist']);?>
');"><?php echo smartyTranslate(array('s'=>'View','mod'=>'blockwishlist'),$_smarty_tpl);?>
</a></td>
						<td class="align_center">
							<a href="javascript:;"onclick="return (WishlistDelete('wishlist_<?php echo intval($_smarty_tpl->getVariable('wishlists')->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id_wishlist']);?>
', '<?php echo intval($_smarty_tpl->getVariable('wishlists')->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['id_wishlist']);?>
', '<?php echo smartyTranslate(array('s'=>'Do you really want to delete this wishlist ?','mod'=>'blockwishlist'),$_smarty_tpl);?>
'));"><img src="<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
modules/blockwishlist/img/icon/delete.png" alt="<?php echo smartyTranslate(array('s'=>'Delete','mod'=>'blockwishlist'),$_smarty_tpl);?>
" /></a>
						</td>
		
					</tr>
						
				<?php endfor; endif; ?>
				</tbody>
			</table>
		</div>
	<?php if (intval($_smarty_tpl->getVariable('id_customer')->value)!=0){?>
		<form action="<?php echo $_smarty_tpl->getVariable('base_dir_ssl')->value;?>
modules/blockwishlist/mywishlist.php" method="post"> 
			<fieldset>
			</fieldset>
		</form>
		<div id="block-order-detail">&nbsp;</div>
		<?php }?>
	<?php }?>
</div>
</div>
	<ul class="footer_links">
		
	</ul>
</div>
