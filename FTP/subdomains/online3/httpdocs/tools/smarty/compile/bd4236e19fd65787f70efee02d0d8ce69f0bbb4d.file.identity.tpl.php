<?php /* Smarty version Smarty-3.0.7, created on 2012-05-13 19:14:04
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/themes/goodjob/identity.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4131750414fafa58c973396-94679836%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bd4236e19fd65787f70efee02d0d8ce69f0bbb4d' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/themes/goodjob/identity.tpl',
      1 => 1334938618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4131750414fafa58c973396-94679836',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/tools/smarty/plugins/modifier.escape.php';
?>

<?php ob_start(); ?><?php echo smartyTranslate(array('s'=>'MY INFO'),$_smarty_tpl);?>
<?php  Smarty::$_smarty_vars['capture']['path']=ob_get_clean();?>
<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./dashboard.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<h1><?php echo smartyTranslate(array('s'=>'MY INFO'),$_smarty_tpl);?>
</h1>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./errors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div id="DashboardLeft">
        <ul>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order-slip.php');?>
">Notification</a></li>
            <li><a class="active" href="#">My info</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('history.php');?>
">Order History</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('modules/blockwishlist/mywishlist.php');?>
">Wish list</a></li>
            <li><a href="http://online.goodjobstore.com/th/order" target="_blank">My cart</a></li>
            <li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('discount.php');?>
">My coupon</a></li>
        </ul>
 </div>
		<div id="DashboardRight" class="rte">
		<div id="DashboardRightSub3">
		<hr width="100%" size="1" color="000000"> 
		<h5><B>Billing Add ress</B></h5></br>
	<form action="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('identity.php',true);?>
" method="post"> 
		<fieldset>
		
		<TABLE BORDER="2" CELLPADDING="5" CELLSPACING="5" WIDTH="100%">
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="email"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'E-mail'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="text" name="emails" id="email" value="<?php echo $_POST['email'];?>
" class="account_input"/>  </td>
			</p>
		</tr>
		<tr><p class="required text">
				<td WIDTH="50%"><label for="firstname"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'First name'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="text" id="firstname" name="firstname" value="<?php echo $_POST['firstname'];?>
" class="account_input" /> </td>
			</p>
		</tr>
		<tr><p class="required text">
				<td WIDTH="50%"><label for="lastname"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'Last name'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="text" name="lastname" id="lastname" value="<?php echo $_POST['lastname'];?>
" class="account_input"/> </td>
			</p>
		</tr>	
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="phonernumber"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'Phone Number'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="text" name="old_passwd" id="old_passwd" class="account_input"/>  </td>
			</p>
		</tr>
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="address1"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'Address'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="text" name="address1" id="address1" class="account_input"/>  </td>
			</p>
		</tr>
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="city"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'City'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="text" name="city" id="city" class="account_input"/>  </td>
			</p>
		</tr>
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="postcode"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'Postal code'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="text" name="postcode" id="postcode" class="account_input"/>  </td>
			</p>
		</tr>
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="old_passwd"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'Current Password'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="password" name="old_passwd" id="old_passwd" class="account_input"/>  </td>
			</p>
		</tr>

		<tr><p class="password">
				<td WIDTH="50%"><label for="passwd"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'New Password'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="password" name="passwd" id="passwd" class="account_input"/> </td>
			</p>
		</tr>
		<tr><p class="password">
				<td WIDTH="50%<?php ?>><label for="confirmation"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'Confirmation'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="password" name="confirmation" id="confirmation" class="account_input"/></td>
			</p>
		</tr>

		</TABLE>
		
			
			
			
			<?php if ($_smarty_tpl->getVariable('newsletter')->value){?>
			<p class="checkbox">
				<input type="checkbox" id="newsletter" name="newsletter" value="1" <?php if (isset($_POST['newsletter'])&&$_POST['newsletter']==1){?> checked="checked"<?php }?> />
				<label for="newsletter"><?php echo smartyTranslate(array('s'=>'Sign up for our newsletter'),$_smarty_tpl);?>
</label>
			</p>
			<p class="checkbox">
				<input type="checkbox" name="optin" id="optin" value="1" <?php if (isset($_POST['optin'])&&$_POST['optin']==1){?> checked="checked"<?php }?> />
				<label for="optin"><?php echo smartyTranslate(array('s'=>'Receive special offers from our partners'),$_smarty_tpl);?>
</label>
			</p>
			<?php }?>
			<p class="submit">
				<input type="submit" class="button" name="submitIdentity" value="<?php echo smartyTranslate(array('s'=>'Update'),$_smarty_tpl);?>
" />
			</p>
			
		</fieldset>
	</br>	
		<?php if (isset($_smarty_tpl->getVariable('confirmation',null,true,false)->value)&&$_smarty_tpl->getVariable('confirmation')->value){?>
	<p class="success">
		<?php echo smartyTranslate(array('s'=>'Your personal information has been successfully updated.'),$_smarty_tpl);?>

		<?php if (isset($_smarty_tpl->getVariable('pwd_changed',null,true,false)->value)){?><br /><?php echo smartyTranslate(array('s'=>'Your password has been sent to your e-mail:'),$_smarty_tpl);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('email')->value,'htmlall','UTF-8');?>
<?php }?>
	</p>
		<?php }else{ ?>
	</br>
	<hr width="100%" size="2" color="CCCCCC"> 
	<h5><B>Shipping Add ress</B></h5>
		<div align="right">

			<input type="checkbox" name="same" value="same">&nbsp;Same as Billing Add ress<br>
		</div>
	
	</br> 

	<TABLE BORDER="2" CELLPADDING="5" CELLSPACING="5" WIDTH="100%">
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="firstname"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'First name'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="text" id="firstname" name="firstname" value="<?php echo $_POST['firstname'];?>
" class="account_input" /> </td>
			</p>
		</tr>
		<tr><p class="required text">
				<td WIDTH="50%"><label for="lastname"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'Last name'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="text" name="lastname" id="lastname" value="<?php echo $_POST['lastname'];?>
" class="account_input"/> </td>
			</p>
		</tr>	
				
		<tr><p class="required text">
				<td WIDTH="50%"><label for="address1"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'Address'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="text" name="address1" id="address1" class="account_input"/>  </td>
			</p>
		</tr>
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="city"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'City'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="text" name="city" id="city" class="account_input"/>  </td>
			</p>
		</tr>
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="postcode"><B><div align ="right"><?php echo smartyTranslate(array('s'=>'Postal code'),$_smarty_tpl);?>
</div></B></label></td>
				<td><input type="text" name="postcode" id="postcode" class="account_input"/>  </td>
			</p>
		</tr>
		
		</TABLE>
	
	
		</form>
	</div>
</div>
	<p id="security_informations">
	</p>
<?php }?>

<ul class="footer_links">
	
</ul>


