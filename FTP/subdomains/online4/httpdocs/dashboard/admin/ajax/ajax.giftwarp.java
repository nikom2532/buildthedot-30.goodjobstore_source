function viewGiftPrice()
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
		var area = document.getElementById('giftPrice_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/giftwarp_price.php"+pmeters,true);
	req.send(null);
}



function updateShipOption(optionID)
{
	var changePrice = document.frmOptionPrice.shipOption.value;
	
	if (changePrice==""){
		alert("Please insert price.");
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
				alert("Done.");
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'optionID='+optionID;
		pmeters += '&changePrice='+changePrice;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/giftwarp_update.php"+pmeters,true);
		req.send(null);
	}
}