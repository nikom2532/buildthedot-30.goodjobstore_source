<FORM METHOD="post" ACTION="https://www.krungsriepayment.com/EPayDefaultWeb/PaymentManager/PaymentInput.do"> 
<INPUT TYPE="hidden" NAME="MERCHANTNUMBER" ID="MERCHANTNUMBER" SIZE="9" MAXLENGTH="9" value="950200659" > 
<INPUT TYPE="hidden" NAME="ORDERNUMBER" ID="ORDERNUMBER" SIZE="9" MAXLENGTH="9" value="<?=rand(000000001, 999999999)?>"> 
<INPUT TYPE="hidden" NAME="PAYMENTTYPE" ID="PAYMENTTYPE" SIZE="9" MAXLENGTH="9" value="CreditCard" >
<INPUT TYPE="hidden" NAME="AMOUNT" ID="AMOUNT" SIZE="20" MAXLENGTH="20" value="<?=$order->Final_Price * 100?>">
<INPUT TYPE="hidden" NAME="CURRENCY" ID="CURRENCY" SIZE="20" MAXLENGTH="20" value="764">
<INPUT TYPE="hidden" NAME="AMOUNTEXP10" ID="AMOUNTEXP10" SIZE="20" MAXLENGTH="20" value="-2"> 
<INPUT size="20" type="hidden" name="LANGUAGE" value="<?=(LANG=='TH')?'TH':'EN';?>">
<INPUT size="20" type="hidden" name="REF1" value="<?=$order->Order_ID?>">
<INPUT size="20" type="hidden" name="REF2">
<INPUT size="20" type="hidden" name="REF3"> 
<INPUT size="20" type="hidden" name="REF4"> 
<INPUT size="20" type="hidden" name="REF5" value="<?=$customer->Email?>">
<INPUT TYPE="submit" NAME="Submit" ID="Submit" VALUE="Confirm"> 
</FORM>