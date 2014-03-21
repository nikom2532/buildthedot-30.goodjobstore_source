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
		var area = document.getElementById('background_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/background_table.php"+pmeters,true);
	req.send(null);
}

function deleteBackground(backgroundID)
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
		pmeters += 'backgroundID='+backgroundID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/background_delete.php"+pmeters,true);
		req.send(null);
}

function changeStatus(backgroundID)
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

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'backgroundID='+backgroundID;

		if ( $( "#change_status_"+backgroundID+":checked" ).val() == 1 )
			pmeters += '&changeStat=1';
		else
			pmeters += '&changeStat=0';

		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/background_update.php"+pmeters,true);
		req.send(null);
}