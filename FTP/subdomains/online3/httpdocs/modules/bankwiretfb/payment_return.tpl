
{if $status == 'ok'}
	<link href="{$this_path}style.css" rel="stylesheet" type="text/css" />
    <p>{l s='Your order on' mod='bankwiretfb'} <span class="bold">{$shop_name}</span> {l s='is complete.' mod='bankwiretfb'}</p>
		<br /><br />
		{l s='Please send us a bank wire with:' mod='bankwiretfb'}<br /><br />
        <div class="info_bank">
        <img src="{$this_path}icon_bank.jpg" alt="{l s='Pay by Kasikorn Bank' mod='bankwiretfb'}" />
        <div class="info_bank_left">
        <div class="bankform"><div class="banktitle">{l s='A/C Name:' mod='bankwiretfb'}</div><div class="bankdetail">{if $bankwireOwner}{$bankwireOwner}{else}___________{/if}</div></div><br />
        <div class="bankform"><div class="banktitle">{l s='A/C No.:' mod='bankwiretfb'}</div><div class="bankdetail">{if $bankwireAcnumber}{$bankwireAcnumber}{else}___________{/if}</div></div><br />
		<div class="bankform"><div class="banktitle">{l s='Branch:' mod='bankwiretfb'}</div> <div class="bankdetail">{if $bankwireBranch}{$bankwireBranch}{else}___________{/if}</div></div><br />
		
        <p style="margin-top:40px;">
        <div class="bankform"><div class="banktitle">{l s='The total amount of your order is ' mod='bankwiretfb'}</div> <span class="price">{$total_to_pay}</span></div>
        </p><br /><br />
        </div></div>
		<p><br /><br />{l s='Do not forget to insert your order #' mod='bankwiretfb'} <span class="bold">{$id_order}</span> {l s='in the subjet of your bank wire' mod='bankwiretfb'}
		<br /><br />{l s='An e-mail has been sent to you with this information.' mod='bankwiretfb'}
		<br /><br /><span class="bold">{l s='Your order will be sent as soon as we receive your settlement.' mod='bankwiretfb'}</span>
		<br /><br />{l s='For any questions or for further information, please contact our' mod='bankwiretfb'} <a href="{$base_dir_ssl}contact-form.php">{l s='customer support' mod='bankwiretfb'}</a>.
	</p>
{else}
	<p class="warning">
		{l s='We noticed a problem with your order. If you think this is an error, you can contact our' mod='bankwiretfb'} 
		<a href="{$base_dir_ssl}contact-form.php">{l s='customer support' mod='bankwiretfb'}</a>.
	</p>
{/if}