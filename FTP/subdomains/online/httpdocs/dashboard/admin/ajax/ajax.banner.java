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
		var area = document.getElementById('banner_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/banner_table.php"+pmeters,true);
	req.send(null);
}



function deleteBanner(bannerID)
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
		pmeters += 'bannerID='+bannerID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/banner_delete.php"+pmeters,true);
		req.send(null);
}


function change_productStatus(proID)
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
		pmeters += 'proID='+proID;

		if ( $( "#change_proStatus_"+proID+":checked" ).val() == 1 )
			pmeters += '&proStat=1';
		else
			pmeters += '&proStat=0';

		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/banner_update.php"+pmeters,true);
		req.send(null);
}