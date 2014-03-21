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
		var area = document.getElementById('username_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/privacy_table.php"+pmeters,true);
	req.send(null);
}


function updatePrivacy(empID)
{
		var changePosition = $("change_position_"+empID).val();

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
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'empID='+empID;
		pmeters += '&empPosition='+changePosition;
		pmeters += '&ran='+ran;
		
		
		
		req.open("GET","connectDB/privacy_update.php"+pmeters,true);
		req.send(null);
}