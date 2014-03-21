function viewTable()
{
	var req;
	if (window.XMLHttpRequest)
		req = new XMLHttpRequest();
	else if (window.ActiveXObject)
		req = new ActiveXObject("Microsoft.XMLHTTP");
	else
	{
		alert("Browser error");
		return false;
	}

	req.onreadystatechange = function()
	{
		var area = document.getElementById('payment_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/payment_table.php"+pmeters,true);
	req.send(null);
}



function addPayment()
{
	var payment_EN = document.frmPayment.Payment_En.value;
	var payment_TH = document.frmPayment.Payment_Th.value;
	var descrip_EN = document.frmPayment.Descrip_En.value;
	var descrip_TH = document.frmPayment.Descrip_Th.value;

	if (payment_EN==""){
		alert("Please insert payment");
	}
	else
	{
		var req;
		if (window.XMLHttpRequest)
			req = new XMLHttpRequest();
		else if (window.ActiveXObject)
			req = new ActiveXObject("Microsoft.XMLHTTP");
		else
		{
			alert("Browser error");
			return false;
		}

		req.onreadystatechange = function()
		{
			if (req.readyState == 4)
			{
				alert("Done.");
				viewTable();
				clearTxt();
			}
		}
		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'payment_EN='+payment_EN;
		pmeters += '&payment_TH='+payment_TH;
		pmeters += '&descrip_EN='+descrip_EN;
		pmeters += '&descrip_TH='+descrip_TH;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/payment_insert.php"+pmeters,true);
		req.send(null);
	}
}

function clearTxt()
{
	document.frmPayment.Payment_En.value="";
	document.frmPayment.Payment_Th.value="";
	document.frmPayment.Descrip_En.value="";
	document.frmPayment.Descrip_Th.value="";
}



function deletePayment(paymentID)
{
		var req;
		if (window.XMLHttpRequest)
			req = new XMLHttpRequest();
		else if (window.ActiveXObject)
			req = new ActiveXObject("Microsoft.XMLHTTP");
		else
		{
			alert("Browser error");
			return false;
		}

		req.onreadystatechange = function()
		{
			if (req.readyState == 4)
				viewTable();
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'paymentID='+paymentID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/payment_delete.php"+pmeters,true);
		req.send(null);
}



function editPayment(paymentID)
{
		var payment_EN = document.frmPayment.Payment_En.value;
		var payment_TH = document.frmPayment.Payment_Th.value;
		var descrip_EN = document.frmPayment.Descrip_En.value;
		var descrip_TH = document.frmPayment.Descrip_Th.value;

		var req;
		if (window.XMLHttpRequest)
			req = new XMLHttpRequest();
		else if (window.ActiveXObject)
			req = new ActiveXObject("Microsoft.XMLHTTP");
		else
		{
			alert("Browser error");
			return false;
		}

		req.onreadystatechange = function()
		{
			if (req.readyState == 4)
			{
				alert("Done.");
				window.location.href="payment.php"
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'paymentID='+paymentID;
		pmeters += '&payment_EN='+payment_EN;
		pmeters += '&payment_TH='+payment_TH;
		pmeters += '&descrip_EN='+descrip_EN;
		pmeters += '&descrip_TH='+descrip_TH;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/payment_edit.php"+pmeters,true);
		req.send(null);
}