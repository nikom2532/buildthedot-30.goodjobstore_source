function viewTable(howID)
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
		var area = document.getElementById('shipping_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&howID='+howID;
	
	req.open("GET","connectDB/shipping_table.php"+pmeters,true);
	req.send(null);
}



function addShipping(howID)
{
	var weightStart = document.frmAddShipping.weight_start.value;
	var weightEnd = document.frmAddShipping.weight_end.value;
	var rangePrice = document.frmAddShipping.price.value;

	if (weightStart=="" && weightEnd=="" && price==""){
		alert("Please insert range and price");
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
				viewTable(howID);
				clearTxt();
			}
		}
		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'm_howID='+howID;
		pmeters += '&m_weightStart='+weightStart;
		pmeters += '&m_weightEnd='+weightEnd;
		pmeters += '&m_rangePrice='+rangePrice;
		
		req.open("GET","connectDB/shipping_insert.php"+pmeters,true);
		req.send(null);
	}
}

function clearTxt()
{
	document.frmAddShipping.weight_start.value="";
	document.frmAddShipping.weight_end.value="";
	document.frmAddShipping.price.value="";
}



function deleteShipping(rangeID)
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
		pmeters += 'rangeID='+rangeID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/shipping_delete.php"+pmeters,true);
		req.send(null);
}


function editShipping(rangeID)
{
		var weightStart = document.frmEditShipping.weight_start.value;
		var weightEnd = document.frmEditShipping.weight_end.value;
		var rangePrice = document.frmEditShipping.price.value;

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
				window.location.href="shipper.php"
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'rangeID='+rangeID;
		pmeters += '&weightStart='+weightStart;
		pmeters += '&weightEnd='+weightEnd;
		pmeters += '&rangePrice='+rangePrice;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/shipping_edit.php"+pmeters,true);
		req.send(null);
}