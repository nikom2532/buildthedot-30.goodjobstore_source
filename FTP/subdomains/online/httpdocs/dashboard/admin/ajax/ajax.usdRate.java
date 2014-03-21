function viewUsdRate()
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
		var area = document.getElementById('usdRate_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/usd_rate.php"+pmeters,true);
	req.send(null);
}


function updateRate(rateID)
{
	var changeRate = document.frmOptionPrice.changeRate.value;
	
	if (changeRate==""){
		alert("Please insert rate.");
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
		pmeters += 'rateID='+rateID;
		pmeters += '&changeRate='+changeRate;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/usdRate_update.php"+pmeters,true);
		req.send(null);
	}
}