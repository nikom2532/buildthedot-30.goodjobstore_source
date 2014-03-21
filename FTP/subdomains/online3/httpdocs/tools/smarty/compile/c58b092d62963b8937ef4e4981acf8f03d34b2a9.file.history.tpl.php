<?php /* Smarty version Smarty-3.0.7, created on 2012-05-13 17:34:08
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/themes/goodjob/history.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16552916304faf8e20c08ce4-16134868%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c58b092d62963b8937ef4e4981acf8f03d34b2a9' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/themes/goodjob/history.tpl',
      1 => 1334938388,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16552916304faf8e20c08ce4-16134868',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/tools/smarty/plugins/modifier.escape.php';
?>

<?php ob_start(); ?><?php echo smartyTranslate(array('s'=>'ORDER HISTORY'),$_smarty_tpl);?>
<?php  Smarty::$_smarty_vars['capture']['path']=ob_get_clean();?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./dashboard.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./errors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<h1><?php echo smartyTranslate(array('s'=>'Order history'),$_smarty_tpl);?>
</h1>


<?php if ($_smarty_tpl->getVariable('slowValidation')->value){?><p class="warning"><?php echo smartyTranslate(array('s'=>'If you have just placed an order, it may take a few minutes for it to be validated. Please refresh the page if your order is missing.'),$_smarty_tpl);?>
</p><?php }?>
<div id="DashboardLeft">
        <ul>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order-slip.php');?>
">Notification</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('identity.php');?>
">My info</a></li>
            <li><a class="active" href="#">Order History</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('modules/blockwishlist/mywishlist.php');?>
">Wish list</a></li>
            <li><a href="http://online.goodjobstore.com/th/order" target="_blank">My cart</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('discount.php');?>
">My coupon</a></li>
        </ul>
    </div>
<div id="DashboardRight" class="rte">
<div id="DashboardRightSub3">
<div class="block-center" id="block-history">
	<?php if ($_smarty_tpl->getVariable('orders')->value&&count($_smarty_tpl->getVariable('orders')->value)){?>
	<table id="order-list" class="std">
		<thead>
			<tr>
				<th class="first_item"><?php echo smartyTranslate(array('s'=>' '),$_smarty_tpl);?>
</th>
				<th class="item"><center><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
</center></th>
				<th class="item"><center><?php echo smartyTranslate(array('s'=>'Description'),$_smarty_tpl);?>
</center></th>
				<th class="item"><center><?php echo smartyTranslate(array('s'=>'Qty'),$_smarty_tpl);?>
</center></th>
				<th class="item"><center><?php echo smartyTranslate(array('s'=>'Price'),$_smarty_tpl);?>
</center></th>
				<th class="item"><center><?php echo smartyTranslate(array('s'=>'Order Date'),$_smarty_tpl);?>
</center></th>
				<th class="item"><center><?php echo smartyTranslate(array('s'=>'Status'),$_smarty_tpl);?>
</center></th>
			</tr>
		</thead>
		<tbody>
		<?php  $_smarty_tpl->tpl_vars['order'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('orders')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['order']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['order']->iteration=0;
 $_smarty_tpl->tpl_vars['order']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['index']=-1;
if ($_smarty_tpl->tpl_vars['order']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['order']->key => $_smarty_tpl->tpl_vars['order']->value){
 $_smarty_tpl->tpl_vars['order']->iteration++;
 $_smarty_tpl->tpl_vars['order']->index++;
 $_smarty_tpl->tpl_vars['order']->first = $_smarty_tpl->tpl_vars['order']->index === 0;
 $_smarty_tpl->tpl_vars['order']->last = $_smarty_tpl->tpl_vars['order']->iteration === $_smarty_tpl->tpl_vars['order']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['first'] = $_smarty_tpl->tpl_vars['order']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['last'] = $_smarty_tpl->tpl_vars['order']->last;
?>
			<tr class="<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['last']){?>last_item<?php }else{ ?>item<?php }?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['index']%2){?>alternate_item<?php }?>">
				<td class="history_link bold">
					<?php if (isset($_smarty_tpl->tpl_vars['order']->value['invoice'])&&$_smarty_tpl->tpl_vars['order']->value['invoice']&&isset($_smarty_tpl->tpl_vars['order']->value['virtual'])&&$_smarty_tpl->tpl_vars['order']->value['virtual']){?><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
icon/download_product.gif" class="icon" alt="<?php echo smartyTranslate(array('s'=>'Products to download'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Products to download'),$_smarty_tpl);?>
" /><?php }?>
					<a class="color-myaccount" href="javascript:showOrder(1, <?php echo intval($_smarty_tpl->tpl_vars['order']->value['id_order']);?>
, 'order-detail');"><?php echo smartyTranslate(array('s'=>''),$_smarty_tpl);?>
<?php echo sprintf("%06d",$_smarty_tpl->tpl_vars['order']->value['id_order']);?>
</a>
				</td>
				
				<td class="history_name"><span class="name"></td>
				<td class="history_description"></td>
				<td class="history_quantity"></td>
				<td class="history_price"><span class="price"><?php echo Tools::displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['order']->value['total_paid_real'],'currency'=>$_smarty_tpl->tpl_vars['order']->value['id_currency'],'no_utf8'=>false,'convert'=>false),$_smarty_tpl);?>
</span></td>
				<td class="history_date bold"><?php echo Tools::dateFormat(array('date'=>$_smarty_tpl->tpl_vars['order']->value['date_add'],'full'=>0),$_smarty_tpl);?>
</td>
				<td class="history_state"><?php if (isset($_smarty_tpl->tpl_vars['order']->value['order_state'])){?><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['order']->value['order_state'],'htmlall','UTF-8');?>
<?php }?></td>
			</tr>
		<?php }} ?>
		</tbody>
	</table>
</div>
	<div id="block-order-detail" class="hidden">&nbsp;</div>
	<?php }else{ ?>
		<p class="warning"><?php echo smartyTranslate(array('s'=>'You have not placed any orders.'),$_smarty_tpl);?>
</p>
	<?php }?>
</div></div>

<ul class="footer_links">
	
</ul>

