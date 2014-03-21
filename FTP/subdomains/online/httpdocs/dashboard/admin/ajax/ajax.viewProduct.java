function viewTable(proCode,propertyName)
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
		var area = document.getElementById('viewProduct_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&proCode='+proCode;
	pmeters += '&propertyName='+propertyName;
	
	req.open("GET","connectDB/viewProduct_table.php"+pmeters,true);
	req.send(null);
}
/*
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

		req.onreadystatechange = function()
		{
			if (req.readyState == 4)
			{
				viewTable();
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'proID='+proID;

		if ( $( "#change_proStatus_"+proID+":checked" ).val() == 1 )
			pmeters += '&proStat=1';
		else
			pmeters += '&proStat=0';

		pmeters += '&ran='+ran;
		
		
		
		req.open("GET","connectDB/viewProduct_update.php"+pmeters,true);
		req.send(null);
}
*/


function deleteProduct(proID,proCode)
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
				viewTable(proCode);
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'proID='+proID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/viewProduct_delete.php"+pmeters,true);
		req.send(null);
}

function searchProperty(proCode)
{
	var viewProSearch = document.searchViewProduct.viewProSearch.value;
	viewTable(proCode,viewProSearch);
}