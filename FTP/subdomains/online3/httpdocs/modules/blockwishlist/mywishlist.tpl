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
*  @version  Release: $Revision: 8084 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<div id="mywishlist">
	{capture name=path}{l s='WISH LIST' mod='blockwishlist'}{/capture}
	{include file="$tpl_dir./dashboard.tpl"}

	<h1>{l s='WISH LIST' mod='blockwishlist'}</h1>
<div id="DashboardLeft">
        <ul>
            <li><a href="{$link->getPageLink('order-slip.php')}">Notification</a></li>
            <li><a href="{$link->getPageLink('identity.php')}">My info</a></li>
            <li><a href="{$link->getPageLink('history.php')}">Order History</a></li>
            <li><a class="active" href="#">Wish list</a></li>
            <li><a href="http://online.goodjobstore.com/th/order">My cart</a></li>
            <li><a href="{$link->getPageLink('discount.php')}">My coupon</a></li>
        </ul>
</div>
	{include file="$tpl_dir./errors.tpl"}
	
<div id="DashboardRight" class="rte">
<div id="DashboardRightSub3">
		{if $wishlists}
		<div id="block-history" class="block-center">
			<table class="std">
				<thead>
					<tr>
						<th class="first_item">{l s='Product' mod='blockwishlist'}</th>
						<th class="item mywishlist_first">{l s='Viewed' mod='blockwishlist'}</th>
						<th class="item mywishlist_second">{l s='Date Added' mod='blockwishlist'}</th>
						<th class="item mywishlist_first">{l s='Qty' mod='blockwishlist'}</th>
						<th class="item mywishlist_second">{l s='Direct Link' mod='blockwishlist'}</th>
						<th class="last_item mywishlist_first">{l s='Delete' mod='blockwishlist'}</th>
					</tr>
				</thead>
				<tbody>
				{section name=i loop=$wishlists}
					<tr id="wishlist_{$wishlists[i].id_wishlist|intval}">
						<td class="bold" style="width:200px;"><a href="javascript:;" onclick="javascript:WishlistManage('block-order-detail', '{$wishlists[i].id_wishlist|intval}');">{$wishlists[i].name|truncate:30:'...'|escape:'htmlall':'UTF-8'}</a></td>
						<td class="align_center">{$wishlists[i].counter|intval}</td>
						<td class="align_center">{$wishlists[i].date_add|date_format:"%Y-%m-%d"}</td>
						<td class="bold align_center">
						{assign var=n value=0}
						{foreach from=$nbProducts item=nb name=i}
							{if $nb.id_wishlist eq $wishlists[i].id_wishlist}
								{assign var=n value=$nb.nbProducts|intval}
							{/if}
						{/foreach}
						{if $n}
							{$n|intval}
						{else}
							0
						{/if}
						</td>
						<td class="align_center"><a href="javascript:;" onclick="javascript:WishlistManage('block-order-detail', '{$wishlists[i].id_wishlist|intval}');">{l s='View' mod='blockwishlist'}</a></td>
						<td class="align_center">
							<a href="javascript:;"onclick="return (WishlistDelete('wishlist_{$wishlists[i].id_wishlist|intval}', '{$wishlists[i].id_wishlist|intval}', '{l s='Do you really want to delete this wishlist ?' mod='blockwishlist'}'));"><img src="{$content_dir}modules/blockwishlist/img/icon/delete.png" alt="{l s='Delete' mod='blockwishlist'}" /></a>
						</td>
		
					</tr>
						
				{/section}
				</tbody>
			</table>
		</div>
	{if $id_customer|intval neq 0}
		<form action="{$base_dir_ssl}modules/blockwishlist/mywishlist.php" method="post"> {* class="std" *}
			<fieldset>
				{*<h3>{l s='New wishlist' mod='blockwishlist'}</h3>
				<input type="hidden" name="token" value="{$token|escape:'htmlall':'UTF-8'}" />
				<label class="align_right" for="name">{l s='Name' mod='blockwishlist'}</label>
				<input type="text" id="name" name="name" value="{if isset($smarty.post.name) and $errors|@count > 0}{$smarty.post.name|escape:'htmlall':'UTF-8'}{/if}" />
				<input type="submit" name="submitWishlist" id="submitWishlist" value="{l s='Save' mod='blockwishlist'}" class="exclusive" />9*}
			</fieldset>
		</form>
		<div id="block-order-detail">&nbsp;</div>
		{/if}
	{/if}
</div>
</div>
	<ul class="footer_links">
		
	</ul>
</div>
