<p class="payment_module">
	<a href="javascript:$('#krungsri_form').submit()" title="{l s='Pay by Krungsri e-Payment Credit Card' mod='krungsripayment'}">
		<img src="{$this_path}krungsripayment.gif" alt="{l s='Pay by Krungsri e-Payment Credit Card' mod='krungsripayment'}" />
		{l s='Pay by Krungsri e-Payment Credit Card' mod='krungsripayment'}
	</a>
</p>

<form action="{$krungsriUrl}" method="post" id="krungsri_form" class="hidden">
	<input type="hidden" name="MERCHANTNUMBER" ID="MERCHANTNUMBER" SIZE="9" MAXLENGTH="9" value="959000233" />
	<input type="hidden" name="ORDERNUMBER" ID="ORDERNUMBER" SIZE="9" MAXLENGTH="9" value="00000000{$ORDERNUMBER}" />
	<input type="hidden" name="PAYMENTTYPE" value="{$PAYMENTTYPE}" />
	<input type="hidden" name="AMOUNT" ID="AMOUNT" SIZE="20" MAXLENGTH="20" value="{$AMOUNT}00" />
	<input type="hidden" name="CURRENCY" ID="CURRENCY" SIZE="20" MAXLENGTH="20" value="{$CURRENCY}" />
	<input type="hidden" name="AMOUNTEXP10" ID="AMOUNTEXP10" SIZE="20" MAXLENGTH="20" value="{$AMOUNTEXP10}" />	
	<input type="hidden" name="LANGUAGE" size="20" value="{$LANGUAGE}" />
	<input type="hidden" name="REF1" value="{$REF1}" />
	<input type="hidden" name="REF2" value="{$REF2}" />
    <input type="hidden" name="REF3" value="{$REF3}" />
    <input type="hidden" name="REF4" value="{$REF4}" />
    <input type="hidden" name="REF5" value="{$REF5}" />
</form>