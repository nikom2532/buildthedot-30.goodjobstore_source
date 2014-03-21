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
		var area = document.getElementById('promotion_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/promotion_table.php"+pmeters,true);
	req.send(null);
}



function addPromotion()
{
	var pro_name = document.frmAddPromotions.Promotion_Name.value;
	if (pro_name==""){
		alert("Please insert promotion");
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
			var area = document.getElementById('testt');
			if (req.readyState == 4)
			{
				area.innerHTML = req.responseText;
				viewTable();
				clearTxt();
			}
		}
		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'proName='+pro_name;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/promotion_insert.php"+pmeters,true);
		req.send(null);
	}
}



function clearTxt()
{
	document.frmAddPromotions.Promotion_Name.value="";
}


function deletePromotion(promotionID)
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
		pmeters += 'promotionID='+promotionID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/promotion_delete.php"+pmeters,true);
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
		
		req.open("GET","connectDB/promotion_update.php"+pmeters,true);
		req.send(null);
}