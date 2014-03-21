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
		var area = document.getElementById('shipper_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/shipper_table.php"+pmeters,true);
	req.send(null);
}



function addShipper(descripEN)
{
	var shipper_EN = document.frmAddShipper.Shipper_En.value;
	var shipper_TH = document.frmAddShipper.Shipper_Th.value;
	var descripTH = document.frmAddShipper.Descrip_Th.value;
	if (shipper_EN=="" && shipper_TH==""){
		alert("Please insert shipper");
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
		pmeters += 'shipperEN='+shipper_EN;
		pmeters += '&shipperTH='+shipper_TH;
		pmeters += '&descripEN='+descripEN;
		pmeters += '&descripTH='+descripTH;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/shipper_insert.php"+pmeters,true);
		req.send(null);
	}
}


function clearTxt()
{
	document.frmAddShipper.Shipper_En.value="";
	document.frmAddShipper.Shipper_Th.value="";
	document.frmAddShipper.Descrip_En.value="";
	document.frmAddShipper.Descrip_Th.value="";
}



function deleteShipper(HowID)
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
		pmeters += 'howID='+HowID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/shipper_delete.php"+pmeters,true);
		req.send(null);
}



function editShipper(howID)
{
		var shipper_EN = document.frmEditShipper.Shipper_En.value;
		var shipper_TH = document.frmEditShipper.Shipper_Th.value;
		var descripEN = document.frmEditShipper.Descrip_En.value;
		var descripTH = document.frmEditShipper.Descrip_Th.value;

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
		pmeters += 'howID='+howID;
		pmeters += '&shipperEN='+shipper_EN;
		pmeters += '&shipperTH='+shipper_TH;
		pmeters += '&descripEN='+descripEN;
		pmeters += '&descripTH='+descripTH;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/shipper_edit.php"+pmeters,true);
		req.send(null);
}