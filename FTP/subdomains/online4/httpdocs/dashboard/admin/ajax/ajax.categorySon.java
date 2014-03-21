function viewTable(subID)
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
		var area = document.getElementById('son_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&subID='+subID;
	
	req.open("GET","connectDB/categorySon_table.php"+pmeters,true);
	req.send(null);
}


function addCategorySon(subID)
{
	var nameEN = document.frmAddCategorySon.nameEN.value;
	var nameTH = document.frmAddCategorySon.nameTH.value;
	var sonUrl = document.frmAddCategorySon.sonUrl.value;

	if (sonUrl==""){
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
				viewTable(subID);
				clearTxt();
			}
		}
		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'subID='+subID;
		pmeters += '&nameEN='+nameEN;
		pmeters += '&nameTH='+nameTH;
		pmeters += '&sonUrl='+sonUrl;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/categorySon_insert.php"+pmeters,true);
		req.send(null);
	}
}


function clearTxt()
{
	document.frmAddCategorySon.nameEN.value="";
	document.frmAddCategorySon.nameTH.value="";
	document.frmAddCategorySon.sonUrl.value="";
}


function deleteCategorySon(subID,sonID)
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
				viewTable(subID);
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'sonID='+sonID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/categorySon_delete.php"+pmeters,true);
		req.send(null);
}


function editCategorySon(subID,sonID)
{
		var nameEN = document.frmAddCategorySon.nameEN.value;
		var nameTH = document.frmAddCategorySon.nameTH.value;
		var sonUrl = document.frmAddCategorySon.sonUrl.value;

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
		pmeters += 'sonID='+sonID;
		pmeters += '&nameEN='+nameEN;
		pmeters += '&nameTH='+nameTH;
		pmeters += '&sonUrl='+sonUrl;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/categorySon_edit.php"+pmeters,true);
		req.send(null);
}