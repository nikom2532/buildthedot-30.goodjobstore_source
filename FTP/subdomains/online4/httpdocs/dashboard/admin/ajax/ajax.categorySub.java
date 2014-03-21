function viewTable(mainID)
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
		var area = document.getElementById('sub_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&mainID='+mainID;
	
	req.open("GET","connectDB/categorySub_table.php"+pmeters,true);
	req.send(null);
}


function addCategorySub(mainID)
{
	var nameEN = document.frmAddCategorySub.nameEN.value;
	var nameTH = document.frmAddCategorySub.nameTH.value;
	var subUrl = document.frmAddCategorySub.subUrl.value;

	if (subUrl==""){
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
				viewTable(mainID);
				clearTxt();
			}
		}
		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'mainID='+mainID;
		pmeters += '&nameEN='+nameEN;
		pmeters += '&nameTH='+nameTH;
		pmeters += '&subUrl='+subUrl;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/categorySub_insert.php"+pmeters,true);
		req.send(null);
	}
}


function clearTxt()
{
	document.frmAddCategorySub.nameEN.value="";
	document.frmAddCategorySub.nameTH.value="";
	document.frmAddCategorySub.subUrl.value="";
}


function deleteCategorySub(mainID,subID)
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
				viewTable(mainID);
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'subID='+subID;
		pmeters += '&mainID='+mainID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/categorySub_delete.php"+pmeters,true);
		req.send(null);
}


function editCategorySub(mainID,subID)
{
		var nameEN = document.frmAddCategorySub.nameEN.value;
		var nameTH = document.frmAddCategorySub.nameTH.value;
		var subUrl = document.frmAddCategorySub.subUrl.value;

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
		pmeters += 'subID='+subID;
		pmeters += '&nameEN='+nameEN;
		pmeters += '&nameTH='+nameTH;
		pmeters += '&subUrl='+subUrl;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/categorySub_edit.php"+pmeters,true);
		req.send(null);
}

function upSubSort(subID,mainID)
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
			viewTable(mainID);
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&mainID='+mainID;
	pmeters += '&subID='+subID;
	
	req.open("GET","connectDB/categorySub_upSort.php"+pmeters,true);
	req.send(null);
}

function downSubSort(subID,mainID)
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
			viewTable(mainID);
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&mainID='+mainID;
	pmeters += '&subID='+subID;
	
	req.open("GET","connectDB/categorySub_downSort.php"+pmeters,true);
	req.send(null);
}