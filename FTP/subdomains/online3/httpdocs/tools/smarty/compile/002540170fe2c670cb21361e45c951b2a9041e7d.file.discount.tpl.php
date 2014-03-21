<?php /* Smarty version Smarty-3.0.7, created on 2012-04-23 23:09:41
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/discount.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19220881264f957ec5801963-75371160%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '002540170fe2c670cb21361e45c951b2a9041e7d' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/discount.tpl',
      1 => 1335109104,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19220881264f957ec5801963-75371160',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php ob_start(); ?><?php echo smartyTranslate(array('s'=>'MY COUPON'),$_smarty_tpl);?>
<?php  Smarty::$_smarty_vars['capture']['path']=ob_get_clean();?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./dashboard.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<h1><?php echo smartyTranslate(array('s'=>'MY COUPON'),$_smarty_tpl);?>
</h1>
<div id="DashboardLeft">
        <ul>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order-slip.php');?>
">Notification</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('identity.php');?>
">My info</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('history.php');?>
">Order History</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('modules/blockwishlist/mywishlist.php');?>
">Wish list</a></li>
            <li><a href="http://online.goodjobstore.com/th/order" target="_blank">My cart</a></li>
            <li><a class="active" href="#">My coupon</a></li>
        </ul>
    </div>
<div id="DashboardRight" class="rte">
<div id="DashboardRightSub3">
<?php if (isset($_smarty_tpl->getVariable('discount',null,true,false)->value)&&count($_smarty_tpl->getVariable('discount')->value)&&$_smarty_tpl->getVariable('nbDiscounts')->value){?>
<table class="discount std">
	<thead>
		<tr>
			<th class="discount_code first_item"><?php echo smartyTranslate(array('s'=>'COUPON CODE'),$_smarty_tpl);?>
</th>
			<th class="discount_description item"><?php echo smartyTranslate(array('s'=>'VALUE'),$_smarty_tpl);?>
</th>
			<th class="discount_expiration_date last_item"><?php echo smartyTranslate(array('s'=>'EXPIRED DATE'),$_smarty_tpl);?>
</th>
		</tr>
	</thead>
	<tbody>
	<?php  $_smarty_tpl->tpl_vars['discountDetail'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('discount')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['discountDetail']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['discountDetail']->iteration=0;
 $_smarty_tpl->tpl_vars['discountDetail']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['index']=-1;
if ($_smarty_tpl->tpl_vars['discountDetail']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['discountDetail']->key => $_smarty_tpl->tpl_vars['discountDetail']->value){
 $_smarty_tpl->tpl_vars['discountDetail']->iteration++;
 $_smarty_tpl->tpl_vars['discountDetail']->index++;
 $_smarty_tpl->tpl_vars['discountDetail']->first = $_smarty_tpl->tpl_vars['discountDetail']->index === 0;
 $_smarty_tpl->tpl_vars['discountDetail']->last = $_smarty_tpl->tpl_vars['discountDetail']->iteration === $_smarty_tpl->tpl_vars['discountDetail']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['first'] = $_smarty_tpl->tpl_vars['discountDetail']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['last'] = $_smarty_tpl->tpl_vars['discountDetail']->last;
?>
		<tr class="<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['last']){?>last_item<?php }else{ ?>item<?php }?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['index']%2){?>alternate_item<?php }?>">
			<td class="discount_code"><?php echo $_smarty_tpl->tpl_vars['discountDetail']->value['name'];?>
</td>
			<td class="discount_description"><?php echo $_smarty_tpl->tpl_vars['discountDetail']->value['description'];?>
</td>
			<td class="discount_expiration_date"><?php echo Tools::dateFormat(array('date'=>$_smarty_tpl->tpl_vars['discountDetail']->value['date_to']),$_smarty_tpl);?>
</td>
		</tr>
	<?php }} ?>
	</tbody>
</table>
<p>
</p>
<?php }else{ ?>
	<p class="warning"><?php echo smartyTranslate(array('s'=>'You do not possess any coupons.'),$_smarty_tpl);?>
</p>
<?php }?>
</div></div>
<ul class="footer_links">
	
</ul>
