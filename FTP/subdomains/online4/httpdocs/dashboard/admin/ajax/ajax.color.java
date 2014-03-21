function viewTable(colorID)
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
		var area = document.getElementById('color_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&colorID='+colorID;
	
	req.open("GET","connectDB/color_table.php"+pmeters,true);
	req.send(null);
}



function deleteColor(ColorID)
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
				viewTable('');
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'colorID='+ColorID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/color_delete.php"+pmeters,true);
		req.send(null);
}