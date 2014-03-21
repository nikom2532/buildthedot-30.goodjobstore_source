function viewItem(proCode,filterColor,proID)
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
		var area = document.getElementById('content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'proCode='+proCode;
	pmeters += '&filterColor='+filterColor;
	pmeters += '&proID='+proID;
	pmeters += '&ran='+ran;

	req.open("GET","../../dashboard/connectDB/connect.item.php"+pmeters,true);
	req.send(null);
}

function viewHeadDetail(proID,colorID,proCode)
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
		var area = document.getElementById('head_detail');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'proID='+proID;
	pmeters += '&colorID='+colorID;
	pmeters += '&proCode='+proCode;
	pmeters += '&ran='+ran;

	req.open("GET","../../dashboard/connectDB/connect.itemHeadDescrip.php"+pmeters,true);
	req.send(null);
}

function viewDescrip(proID,proCode,colorID,QtyPro)
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
		var area = document.getElementById('product_BuyAndCrossPrice');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'proID='+proID;
	pmeters += '&proCode='+proCode;
	pmeters += '&colorID='+colorID;
	pmeters += '&QtyPro='+QtyPro;
	pmeters += '&ran='+ran;

	req.open("GET","../../dashboard/connectDB/connect.itemDescrip.php"+pmeters,true);
	req.send(null);
}