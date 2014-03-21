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
		var area = document.getElementById('property_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/property_table.php"+pmeters,true);
	req.send(null);
}


function addProperty()
{
	var prop_en = document.frmAddProperty.Prop_En.value;
	var prop_th = document.frmAddProperty.Prop_Th.value;
	if (prop_en==""){
		alert("Please insert property name.");
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
				viewTable();
				clearTxt();
			}
		}
		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'prop_en='+prop_en;
		pmeters += '&prop_th='+prop_th;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/property_insert.php"+pmeters,true);
		req.send(null);
	}
}

function clearTxt()
{
	document.frmAddProperty.Prop_En.value="";
	document.frmAddProperty.Prop_Th.value="";
}


function deleteProperty(propID)
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
		pmeters += 'propID='+propID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/property_delete.php"+pmeters,true);
		req.send(null);
}

function editProperty(propID)
{
	var prop_en = document.frmAddProperty.Prop_En.value;
	var prop_th = document.frmAddProperty.Prop_Th.value;

	if (prop_en==""){
		alert("Please insert property name.");
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
				window.location.href="property.php"
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'propID='+propID;
		pmeters += '&prop_en='+prop_en;
		pmeters += '&prop_th='+prop_th;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/property_edit.php"+pmeters,true);
		req.send(null);
	}
}