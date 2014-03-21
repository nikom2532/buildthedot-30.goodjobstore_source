function viewListSearch(Page,keyword)
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
		var area = document.getElementById('category_images');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
		else
			area.innerHTML = "Now is Loading...";
	}
	var ran = Math.random();
	var pmeters = "?";
	pmeters += "page="+Page;
	pmeters += "&keyword="+keyword;

	req.open("GET","../../dashboard/connectDB/connect.searchList.php"+pmeters,true);
	req.send(null);
}

function viewNavSearch(Page,keyword)
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
		var area = document.getElementById('categoryNav');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = "?";
	pmeters += "page="+Page;
	pmeters += "&keyword="+keyword;

	req.open("GET","../../dashboard/connectDB/connect.searchNav.php"+pmeters,true);
	req.send(null);
}