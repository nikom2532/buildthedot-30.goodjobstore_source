<div>

	<FORM METHOD="post" ACTION="https://www.krungsriepayment.net/EPayDefaultWeb/PaymentManager/PaymentInput.do"> 
		<P>
			Please complete the form.
		</P> 
		<P>
			MERCHANTNUMBER <INPUT TYPE="text" NAME="MERCHANTNUMBER" ID="MERCHANTNUMBER" SIZE="9" MAXLENGTH="9" value="959000233" > <BR> 
			ORDERNUMBER <INPUT TYPE="text" NAME="ORDERNUMBER" ID="ORDERNUMBER" SIZE="9" MAXLENGTH="9" value="<?=rand(000000001, 999999999)?>"><BR> 
			PAYMENTTYPE 
	        	<SELECT name="PAYMENTTYPE"> 
	            	<OPTION value= "CreditCard" >CreditCard</OPTION> 
	                <OPTION value= "DirectDebit">DirectDebit</OPTION>
	            </SELECT>
	        AMOUNT <INPUT TYPE="text" NAME="AMOUNT" ID="AMOUNT" SIZE="20" MAXLENGTH="20" value="12300"><BR> 
	        CURRENCY <INPUT TYPE="text" NAME="CURRENCY" ID="CURRENCY" SIZE="20" MAXLENGTH="20" value="764"><BR> 
	        EXP <INPUT TYPE="text" NAME="AMOUNTEXP10" ID="AMOUNTEXP10" SIZE="20" MAXLENGTH="20" value="-2"><BR> 
	        LANGUAGE <INPUT size="20" type="text" name="LANGUAGE" value="<?=(LANG=='TH')?'TH':'EN';?>"> <BR> 
	        REF1 <INPUT size="20" type="text" name="REF1" value="aabb"><BR> 
	        REF2 <INPUT size="20" type="text" name="REF2"><BR> 
	        REF3 <INPUT size="20" type="text" name="REF3"><BR> 
	        REF4 <INPUT size="20" type="text" name="REF4"><BR> 
	        REF5 <INPUT size="20" type="text" name="REF5" value="">
	    </P>
	    <P> 
	    	<INPUT TYPE="submit" NAME="Submit" ID="Submit" VALUE="Submit"> 
	    	&nbsp; 
	    	<INPUT TYPE="reset" NAME="Reset" ID="Reset" VALUE="Reset"> 
	    	&nbsp; 
	    </P> 
	</FORM> 

</div>