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

{capture name=path}{l s='ORDER HISTORY'}{/capture}
{include file="$tpl_dir./dashboard.tpl"}
{include file="$tpl_dir./errors.tpl"}

<h1>{l s='Order history'}</h1>


{if $slowValidation}<p class="warning">{l s='If you have just placed an order, it may take a few minutes for it to be validated. Please refresh the page if your order is missing.'}</p>{/if}
<div id="DashboardLeft">
        <ul>
            <li><a href="{$link->getPageLink('order-slip.php')}">Notification</a></li>
            <li><a href="{$link->getPageLink('identity.php')}">My info</a></li>
            <li><a class="active" href="#">Order History</a></li>
            <li><a href="{$link->getPageLink('modules/blockwishlist/mywishlist.php')}">Wish list</a></li>
            <li><a href="http://online.goodjobstore.com/th/order" target="_blank">My cart</a></li>
            <li><a href="{$link->getPageLink('discount.php')}">My coupon</a></li>
        </ul>
    </div>
<div id="DashboardRight" class="rte">
<div id="DashboardRightSub3">
<div class="block-center" id="block-history">
	{if $orders && count($orders)}
	<table id="order-list" class="std">
		<thead>
			<tr>
				<th class="first_item">{l s=' '}</th>
				<th class="item"><center>{l s='Name'}</center></th>
				<th class="item"><center>{l s='Description'}</center></th>
				<th class="item"><center>{l s='Qty'}</center></th>
				<th class="item"><center>{l s='Price'}</center></th>
				<th class="item"><center>{l s='Order Date'}</center></th>
				<th class="item"><center>{l s='Status'}</center></th>
			</tr>
		</thead>
		<tbody>
		{foreach from=$orders item=order name=myLoop}
			<tr class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if} {if $smarty.foreach.myLoop.index % 2}alternate_item{/if}">
				<td class="history_link bold">
					{if isset($order.invoice) && $order.invoice && isset($order.virtual) && $order.virtual}<img src="{$img_dir}icon/download_product.gif" class="icon" alt="{l s='Products to download'}" title="{l s='Products to download'}" />{/if}
					<a class="color-myaccount" href="javascript:showOrder(1, {$order.id_order|intval}, 'order-detail');">{l s=''}{$order.id_order|string_format:"%06d"}</a>
				</td>
				
				<td class="history_name"><span class="name"></td>
				<td class="history_description"></td>
				<td class="history_quantity"></td>
				<td class="history_price"><span class="price">{displayPrice price=$order.total_paid_real currency=$order.id_currency no_utf8=false convert=false}</span></td>
				<td class="history_date bold">{dateFormat date=$order.date_add full=0}</td>
				<td class="history_state">{if isset($order.order_state)}{$order.order_state|escape:'htmlall':'UTF-8'}{/if}</td>
			</tr>
		{/foreach}
		</tbody>
	</table>
</div>
	<div id="block-order-detail" class="hidden">&nbsp;</div>
	{else}
		<p class="warning">{l s='You have not placed any orders.'}</p>
	{/if}
</div></div>

<ul class="footer_links">
	
</ul>

