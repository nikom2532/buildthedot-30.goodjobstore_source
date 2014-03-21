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
		var area = document.getElementById('Main_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/categoryMain_table.php"+pmeters,true);
	req.send(null);
}



function addCategoryMain()
{
	var nameEN = document.frmAddCategoryMain.nameEN.value;
	var nameTH = document.frmAddCategoryMain.nameTH.value;
	var mainUrl = document.frmAddCategoryMain.mainUrl.value;

	if (mainUrl==""){
		alert("Please insert url.");
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
		pmeters += 'nameEN='+nameEN;
		pmeters += '&nameTH='+nameTH;
		pmeters += '&mainUrl='+mainUrl;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/categoryMain_insert.php"+pmeters,true);
		req.send(null);
	}
}



function clearTxt()
{
	document.frmAddCategoryMain.nameEN.value="";
	document.frmAddCategoryMain.nameTH.value="";
	document.frmAddCategoryMain.mainUrl.value="";
}


function deleteCategoryMain(mainID)
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
		pmeters += 'mainID='+mainID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/categoryMain_delete.php"+pmeters,true);
		req.send(null);
}


function editCategoryMain(mainID)
{
		var nameEN = document.frmAddCategoryMain.nameEN.value;
		var nameTH = document.frmAddCategoryMain.nameTH.value;
		var mainUrl = document.frmAddCategoryMain.mainUrl.value;

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
			if (req.readyState == 4){
				alert("Done.");
				window.location.href='category.php'}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'mainID='+mainID;
		pmeters += '&nameEN='+nameEN;
		pmeters += '&nameTH='+nameTH;
		pmeters += '&mainUrl='+mainUrl;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/categoryMain_edit.php"+pmeters,true);
		req.send(null);
}

function upMainSort(mainID)
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
	pmeters += 'ran='+ran;
	pmeters += '&mainID='+mainID;
	
	req.open("GET","connectDB/categoryMain_upSort.php"+pmeters,true);
	req.send(null);
}

function downMainSort(mainID)
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
	pmeters += 'ran='+ran;
	pmeters += '&mainID='+mainID;
	
	req.open("GET","connectDB/categoryMain_downSort.php"+pmeters,true);
	req.send(null);
}