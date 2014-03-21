<?php /* Smarty version Smarty-3.0.7, created on 2012-04-23 23:09:16
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/order-slip.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4574250144f957eac4cb7f5-48133690%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5ffe9dc47dba50e558f4f579d9a3002bad5016f' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/themes/goodjob/order-slip.tpl',
      1 => 1334938256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4574250144f957eac4cb7f5-48133690',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php ob_start(); ?><?php echo smartyTranslate(array('s'=>'NOTIFICATIONS'),$_smarty_tpl);?>
<?php  Smarty::$_smarty_vars['capture']['path']=ob_get_clean();?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./dashboard.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<h1><?php echo smartyTranslate(array('s'=>'NOTIFICATIONS'),$_smarty_tpl);?>
</h1>
<div id="DashboardLeft">
        <ul>
            <li><a class="active" href="#">Notification</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('identity.php');?>
">My info</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('history.php');?>
">Order History</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('modules/blockwishlist/mywishlist.php');?>
">Wish list</a></li>
            <li><a href="http://online.goodjobstore.com/th/order" target="_blank">My cart</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('discount.php');?>
">My coupon</a></li>
        </ul>
</div>

	<img src="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
welcome.jpg" align ="right" border="0"/>

<div id="DashboardRight" class="rte">
<div id="shoppingGuideRightSub3">
	<div id="block-history" class="block-center">
	<table class="std">
	<h4><B><?php echo smartyTranslate(array('s'=>'ORDER STATUS'),$_smarty_tpl);?>
</B></h4></br>
		<thead>
			<tr>
				<th class="first_item"><center><?php echo smartyTranslate(array('s'=>'Description'),$_smarty_tpl);?>
</center></th>
				<th class="item"><center><?php echo smartyTranslate(array('s'=>'Shipping Number'),$_smarty_tpl);?>
</center></th>
				<th class="item"><center><?php echo smartyTranslate(array('s'=>'Order Status'),$_smarty_tpl);?>
</center></th>
			</tr>
		</thead>
	<tbody>
		
	</tbody>


	<div id="block-history" class="block-center">
	<table class="std">
	<h4><B><?php echo smartyTranslate(array('s'=>'RESTOCK NOTIFICATIONS'),$_smarty_tpl);?>
</B></h4></br>
		<thead>
			<tr>
				<th class="first_item"><center><?php echo smartyTranslate(array('s'=>'Description'),$_smarty_tpl);?>
&nbsp;&nbsp;</center></th>
				<th class="item"><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo smartyTranslate(array('s'=>'Price'),$_smarty_tpl);?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center></th>
				<th class="item"><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center></th>
			</tr>
		</thead>
	<tbody>
		
	</tbody>
	
	</table>
</div>

</div>

</div>
