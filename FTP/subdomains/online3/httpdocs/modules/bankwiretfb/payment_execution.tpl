{capture name=path}{l s='Kasikorn Bank payment' mod='bankwiretfb'}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}

<!--<h2>{l s='Order summary' mod='bankwiretfb'}</h2> -->

{if $page_name == 'payment'}
<div class="shopping-cart">
{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}
{/if}
{if $nbProducts <= 0}
	<p class="warning">{l s='Your shopping cart is empty.'}</p>
{else}
<link href="{$this_path}style.css" rel="stylesheet" type="text/css" />
<!--<h3>{l s='Bank wire payment' mod='bankwiretfb'}</h3> -->

<form action="{$this_path_ssl}validation.php" method="post">
<div class="info_bank">
<img src="{$this_path}icon_bank.jpg" alt="{l s='Kasikorn Bank' mod='bankwiretfb'}" border="0" />
<div class="info_bank_left">
<div style="margin-top:15px;">
	
	{l s='You have chosen to pay by ' mod='bankwiretfb'} {$bankwireName}.<br />
	<div class="bankform"><div class="banktitle">{l s='A/C Name:' mod='bankwiretfb'}</div><div class="bankdetail">{$bankwireOwner}</div></div><br />
    <div class="bankform"><div class="banktitle">{l s='A/C No.:' mod='bankwiretfb'}</div><div class="bankdetail">{$bankwireAcnumber}</div></div><br />
    <div class="bankform"><div class="banktitle">{l s='Branch:' mod='bankwiretfb'}</div><div class="bankdetail">{$bankwireBranch}</div></div>
</div><br />

<!--{l s='Here is a short summary of your order:' mod='bankwiretfb'} -->
<div style="margin-top:40px;">
	<div class="bankform"><div class="banktitle">{l s='The total amount of your order is' mod='bankwiretfb'}</div>
	{if $currencies|@count > 1}
		{foreach from=$currencies item=currency}
			<span id="amount_{$currency.id_currency}" class="price" style="display:none;">{convertPriceWithCurrency price=$total currency=$currency}</span>
		{/foreach}
	{else}
		<span id="amount_{$currencies.0.id_currency}" class="price">{convertPriceWithCurrency price=$total currency=$currencies.0}</span>
	{/if}
	{l s='(tax incl.)' mod='bankwiretfb'}</div>
</div>
<div style="margin-top:90px;">
	
	{if $currencies|@count > 1}
		{l s='We accept several currencies to be sent by Kasikorn Bank.' mod='bankwiretfb'}<br />
		{l s='Choose one of the following:' mod='bankwiretfb'}
		<select id="currency_payement" name="currency_payement" onchange="showElemFromSelect('currency_payement', 'amount_')">
			{foreach from=$currencies item=currency}
				<option value="{$currency.id_currency}" {if $currency.id_currency == $cust_currency}selected="selected"{/if}>{$currency.name}</option>
			{/foreach}
		</select>
		<script language="javascript">showElemFromSelect('currency_payement', 'amount_');</script>
	{else}
		{l s='We accept the following currency to be sent by bank wire:' mod='bankwiretfb'}&nbsp;<b>{$currencies.0.name}</b>
		<input type="hidden" name="currency_payement" value="{$currencies.0.id_currency}">
	{/if}
</div><br />
<!--<p>
	{l s='Bank wire account information will be displayed on the next page.' mod='bankwiretfb'}
	<br /><br />
	{l s='Please confirm your order by clicking \'I confirm my order\'' mod='bankwiretfb'}.
</p> -->
</div>
</div>
<p class="cart_navigation">
	<a href="{$base_dir_ssl}order.php?step=3" class="button_large">{l s='Other payment methods' mod='bankwiretfb'}</a>
	<input type="submit" name="submit" value="{l s='I confirm my order' mod='bankwiretfb'}" class="exclusive_large" />
</p>
</form>
{/if}
{if $page_name == 'payment'}
</div>
{/if}