function doAjax(Page,MainCat,SubCat,Min,Max)
{
	viewNav(Page,MainCat,SubCat,Min,Max);
	viewList(Page,MainCat,SubCat,Min,Max);
}

function viewList(Page,MainCat,SubCat,Min,Max)
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
	pmeters += "&mainCat="+MainCat;
	pmeters += "&subCat="+SubCat;
	pmeters += "&min="+Min;
	pmeters += "&max="+Max;
	pmeters += "&ran="+ran;

	req.open("GET","../../dashboard/connectDB/connect.categoryList.php"+pmeters,true);
	req.send(null);
}

function viewNav(Page,MainCat,SubCat,Min,Max)
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
	pmeters += "&mainCat="+MainCat;
	pmeters += "&subCat="+SubCat;
	pmeters += "&min="+Min;
	pmeters += "&max="+Max;
	pmeters += "&ran="+ran;

	req.open("GET","../../dashboard/connectDB/connect.categoryNav.php"+pmeters,true);
	req.send(null);
}