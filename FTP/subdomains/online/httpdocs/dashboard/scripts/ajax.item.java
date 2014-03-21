function doAjax(ProID)
{
	viewItem(ProID);
	viewDescrip(ProID);
}

function viewItem(ProID)
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
			area.innerHTML = req.responseText
		else
			area.innerHTML = "Now is Loading...";
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'proID='+ProID;
	pmeters += '&ran='+ran;
	
	req.open("GET","connectDB/connect.item.php"+pmeters,true);
	req.send(null);
}

function viewDescrip(ProID,colorID)
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
		var area = document.getElementById('productDetail');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
		else
			area.innerHTML = "Now is Loading...";
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'proID='+ProID;
	pmeters += '&colorID='+colorID;
	pmeters += '&ran='+ran;
	
	req.open("GET","connectDB/connect.itemDescrip.php"+pmeters,true);
	req.send(null);
}