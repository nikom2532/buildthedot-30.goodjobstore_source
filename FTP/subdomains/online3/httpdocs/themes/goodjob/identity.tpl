{*
* 2007-2011 PrestaShop 
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 8088 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{capture name=path}{l s='MY INFO'}{/capture}
{include file="$tpl_dir./dashboard.tpl"}

<h1>{l s='MY INFO'}</h1>

{include file="$tpl_dir./errors.tpl"}

<div id="DashboardLeft">
        <ul>
            <li><a href="{$link->getPageLink('order-slip.php')}">Notification</a></li>
            <li><a class="active" href="#">My info</a></li>
            <li><a href="{$link->getPageLink('history.php')}">Order History</a></li>
            <li><a href="{$link->getPageLink('modules/blockwishlist/mywishlist.php')}">Wish list</a></li>
            <li><a href="http://online.goodjobstore.com/th/order" target="_blank">My cart</a></li>
            <li><a href="{$link->getPageLink('discount.php')}">My coupon</a></li>
        </ul>
 </div>
		<div id="DashboardRight" class="rte">
		<div id="DashboardRightSub3">
		<hr width="100%" size="1" color="000000"> 
		<h5><B>Billing Add ress</B></h5></br>
	<form action="{$link->getPageLink('identity.php', true)}" method="post"> {*class="std"*}
		<fieldset>
		
		<TABLE BORDER="2" CELLPADDING="5" CELLSPACING="5" WIDTH="100%">
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="email"><B><div align ="right">{l s='E-mail'}</div></B></label></td>
				<td><input type="text" name="emails" id="email" value="{$smarty.post.email}" class="account_input"/>  {*<sup>*</sup>*}</td>
			</p>
		</tr>
		<tr><p class="required text">
				<td WIDTH="50%"><label for="firstname"><B><div align ="right">{l s='First name'}</div></B></label></td>
				<td><input type="text" id="firstname" name="firstname" value="{$smarty.post.firstname}" class="account_input" /> {*<sup>*</sup>*}</td>
			</p>
		</tr>
		<tr><p class="required text">
				<td WIDTH="50%"><label for="lastname"><B><div align ="right">{l s='Last name'}</div></B></label></td>
				<td><input type="text" name="lastname" id="lastname" value="{$smarty.post.lastname}" class="account_input"/> {*{<sup>*</sup>*}</td>
			</p>
		</tr>	
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="phonernumber"><B><div align ="right">{l s='Phone Number'}</div></B></label></td>
				<td><input type="text" name="old_passwd" id="old_passwd" class="account_input"/> {*<sup>*</sup>*} </td>
			</p>
		</tr>
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="address1"><B><div align ="right">{l s='Address'}</div></B></label></td>
				<td><input type="text" name="address1" id="address1" class="account_input"/> {*<sup>*</sup>*} </td>
			</p>
		</tr>
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="city"><B><div align ="right">{l s='City'}</div></B></label></td>
				<td><input type="text" name="city" id="city" class="account_input"/> {*<sup>*</sup>*} </td>
			</p>
		</tr>
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="postcode"><B><div align ="right">{l s='Postal code'}</div></B></label></td>
				<td><input type="text" name="postcode" id="postcode" class="account_input"/> {*<sup>*</sup>*} </td>
			</p>
		</tr>
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="old_passwd"><B><div align ="right">{l s='Current Password'}</div></B></label></td>
				<td><input type="password" name="old_passwd" id="old_passwd" class="account_input"/> {*<sup>*</sup>*} </td>
			</p>
		</tr>

		<tr><p class="password">
				<td WIDTH="50%"><label for="passwd"><B><div align ="right">{l s='New Password'}</div></B></label></td>
				<td><input type="password" name="passwd" id="passwd" class="account_input"/> </td>
			</p>
		</tr>
		<tr><p class="password">
				<td WIDTH="50%><label for="confirmation"><B><div align ="right">{l s='Confirmation'}</div></B></label></td>
				<td><input type="password" name="confirmation" id="confirmation" class="account_input"/></td>
			</p>
		</tr>

		</TABLE>
		
			{*<p class="radio">
				<span>{l s='Title'}</span>
				<input type="radio" id="id_gender1" name="id_gender" value="1" {if $smarty.post.id_gender == 1 OR !$smarty.post.id_gender}checked="checked"{/if} />
				<label for="id_gender1">{l s='Mr.'}</label>
				<input type="radio" id="id_gender2" name="id_gender" value="2" {if $smarty.post.id_gender == 2}checked="checked"{/if} />
				<label for="id_gender2">{l s='Ms.'}</label>
			</p>*}
			
		{*	<p class="select">
				<label>{l s='Date of Birth'}</label>
				<select name="days" id="days">
					<option value="">-</option>
					{foreach from=$days item=v}
						<option value="{$v|escape:'htmlall':'UTF-8'}" {if ($sl_day == $v)}selected="selected"{/if}>{$v|escape:'htmlall':'UTF-8'}&nbsp;&nbsp;</option>
					{/foreach}
				</select>
				
					{l s='January'}
					{l s='February'}
					{l s='March'}
					{l s='April'}
					{l s='May'}
					{l s='June'}
					{l s='July'}
					{l s='August'}
					{l s='September'}
					{l s='October'}
					{l s='November'}
					{l s='December'}
				
				<select id="months" name="months">
					<option value="">-</option>
					{foreach from=$months key=k item=v}
						<option value="{$k|escape:'htmlall':'UTF-8'}" {if ($sl_month == $k)}selected="selected"{/if}>{l s="$v"}&nbsp;</option>
					{/foreach}
				</select>
				<select id="years" name="years">
					<option value="">-</option>
					{foreach from=$years item=v}
						<option value="{$v|escape:'htmlall':'UTF-8'}" {if ($sl_year == $v)}selected="selected"{/if}>{$v|escape:'htmlall':'UTF-8'}&nbsp;&nbsp;</option>
					{/foreach}
				</select>
			</p> *}
			
			
			{if $newsletter}
			<p class="checkbox">
				<input type="checkbox" id="newsletter" name="newsletter" value="1" {if isset($smarty.post.newsletter) && $smarty.post.newsletter == 1} checked="checked"{/if} />
				<label for="newsletter">{l s='Sign up for our newsletter'}</label>
			</p>
			<p class="checkbox">
				<input type="checkbox" name="optin" id="optin" value="1" {if isset($smarty.post.optin) && $smarty.post.optin == 1} checked="checked"{/if} />
				<label for="optin">{l s='Receive special offers from our partners'}</label>
			</p>
			{/if}
			<p class="submit">
				<input type="submit" class="button" name="submitIdentity" value="{l s='Update'}" />
			</p>
			
		</fieldset>
	</br>	
		{if isset($confirmation) && $confirmation}
	<p class="success">
		{l s='Your personal information has been successfully updated.'}
		{if isset($pwd_changed)}<br />{l s='Your password has been sent to your e-mail:'} {$email|escape:'htmlall':'UTF-8'}{/if}
	</p>
		{else}
	{*	<h6>{l s='Please do not hesitate to update your personal information if it has changed.'}</h6>*}
	{*<p class="required"><sup>*</sup>{l s='Required field'}</p>*}
	</br>
	<hr width="100%" size="2" color="CCCCCC"> 
	<h5><B>Shipping Add ress</B></h5>
		<div align="right">

			<input type="checkbox" name="same" value="same">&nbsp;Same as Billing Add ress<br>
		</div>
	
	</br> 

	<TABLE BORDER="2" CELLPADDING="5" CELLSPACING="5" WIDTH="100%">
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="firstname"><B><div align ="right">{l s='First name'}</div></B></label></td>
				<td><input type="text" id="firstname" name="firstname" value="{$smarty.post.firstname}" class="account_input" /> {*<sup>*</sup>*}</td>
			</p>
		</tr>
		<tr><p class="required text">
				<td WIDTH="50%"><label for="lastname"><B><div align ="right">{l s='Last name'}</div></B></label></td>
				<td><input type="text" name="lastname" id="lastname" value="{$smarty.post.lastname}" class="account_input"/> {*{<sup>*</sup>*}</td>
			</p>
		</tr>	
				
		<tr><p class="required text">
				<td WIDTH="50%"><label for="address1"><B><div align ="right">{l s='Address'}</div></B></label></td>
				<td><input type="text" name="address1" id="address1" class="account_input"/> {*<sup>*</sup>*} </td>
			</p>
		</tr>
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="city"><B><div align ="right">{l s='City'}</div></B></label></td>
				<td><input type="text" name="city" id="city" class="account_input"/> {*<sup>*</sup>*} </td>
			</p>
		</tr>
		
		<tr><p class="required text">
				<td WIDTH="50%"><label for="postcode"><B><div align ="right">{l s='Postal code'}</div></B></label></td>
				<td><input type="text" name="postcode" id="postcode" class="account_input"/> {*<sup>*</sup>*} </td>
			</p>
		</tr>
		
		</TABLE>
	
	
		</form>
	</div>
</div>
	<p id="security_informations">
	{*	{l s='[Insert customer data privacy clause or law here, if applicable]'}*}
	</p>
{/if}

<ul class="footer_links">
	
</ul>


