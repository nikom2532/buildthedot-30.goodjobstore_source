<form action="https://www.paypal.com/th/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="contact@goodjobstore.com">
<input type="hidden" name="item_name" value="ORDER ID : <?=$order->Order_ID?>">
<input type="hidden" name="currency_code" value="THB">
<input type="hidden" name="amount" value="<?=$order->Final_Price?>">
<input type="hidden" name="return" value="http://online.goodjobstore.com/checkout/confirmation?order_id=<?=$order->Order_ID?>&status=complate">
<input type="hidden" name="cancel_return" value="http://online.goodjobstore.com/checkout/review">
<!--<input type="image" src="http://www.paypal.com/en_GB/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">-->
<input type="hidden" name="invoice" value="<?=$order->Order_ID?>"> 
<input type="hidden" name="rm" value="2"> 
<!--<input type="hidden" id="" name="payer_status" value="verified"> 
<input type="hidden" id="" name="verify_sign" value="Code_from_verisign"> 
<input type="hidden" id="" name="payment_status" value="Completed">--> 
<INPUT TYPE="submit" NAME="Submit" ID="Submit" VALUE="Confirm"> 
</form>