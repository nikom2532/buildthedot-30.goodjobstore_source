function viewList(Page,MainCat,SubCat,SonCat,ThumbCat,Min,Max,CatUrl,language)
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
	}
	var ran = Math.random();
	var pmeters = "?";
	pmeters += "page="+Page;
	pmeters += "&mainCat="+MainCat;
	pmeters += "&subCat="+SubCat;
	pmeters += "&sonCat="+SonCat;
	pmeters += "&thumbCat="+ThumbCat;
	pmeters += "&min="+Min;
	pmeters += "&max="+Max;
	pmeters += "&catUrl="+CatUrl;
	pmeters += "&language="+language;
	pmeters += "&ran="+ran;

	req.open("GET","../../dashboard/connectDB/connect.categoryList.php"+pmeters,true);
	req.send(null);
}

function viewNav(Page,MainCat,SubCat,SonCat,ThumbCat,Min,Max,CatUrl,language)
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
	pmeters += "&sonCat="+SonCat;
	pmeters += "&thumbCat="+ThumbCat;
	pmeters += "&min="+Min;
	pmeters += "&max="+Max;
	pmeters += "&catUrl="+CatUrl;
	pmeters += "&language="+language;
	pmeters += "&ran="+ran;

	req.open("GET","../../dashboard/connectDB/connect.categoryNav.php"+pmeters,true);
	req.send(null);
}