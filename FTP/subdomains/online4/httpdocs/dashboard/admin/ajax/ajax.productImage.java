function viewTable(productID)
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
		var area = document.getElementById('image_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&productID='+productID;
	
	req.open("GET","connectDB/product_imageTable.php"+pmeters,true);
	req.send(null);
}


function deleteImagePro(imageID,productID)
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
				viewTable(productID);
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'imageID='+imageID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/product_imageDelete.php"+pmeters,true);
		req.send(null);
}


function updateColor(productID,imgID)
{
	var changeColor = $("#change_color_"+imgID).val();
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
				viewTable(productID);
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'imgID='+imgID;
		pmeters += '&changeColor='+changeColor;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/product_colorUpdate.php"+pmeters,true);
		req.send(null);
}

function setPrimProduct(productID,proCode,imgID)
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
				viewTable(productID);
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'imgID='+imgID;
		pmeters += '&proCode='+proCode;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/product_setPrimProduct.php"+pmeters,true);
		req.send(null);
}