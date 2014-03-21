function viewTable(proSearch)
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
		var area = document.getElementById('viewProduct_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&proSearch='+proSearch;
	
	req.open("GET","connectDB/productGroup_table.php"+pmeters,true);
	req.send(null);
}

function change_productStatus(proCode)
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
		pmeters += 'proCode='+proCode;

		if ( $( "#change_proStatus_"+proCode+":checked" ).val() == 1 )
			pmeters += '&proStat=1';
		else
			pmeters += '&proStat=0';

		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/productGroup_update.php"+pmeters,true);
		req.send(null);
}

function addProductGroup()
{
	var productCode = document.frmAddProduct.Product_Code.value;
	var proNameEN = document.frmAddProduct.Product_Name_En.value;
	var proNameTH = document.frmAddProduct.Product_Name_Th.value;
	var descripEN = document.frmAddProduct.Description_En.value;
	var descripTH = document.frmAddProduct.Description_Th.value;
	var proSize = document.frmAddProduct.Size.value;
	var groupPrice = document.frmAddProduct.price.value;
	var proMsgEN = document.frmAddProduct.Short_msg_En.value;
	var proMsgTH = document.frmAddProduct.Short_msg_Th.value;
	var proKeyWord = document.frmAddProduct.KeyWord.value;
	var proUrlEN = document.frmAddProduct.Url_En.value;
	var proUrlTH = document.frmAddProduct.Url_Th.value;
	var proStatus = document.frmAddProduct.Product_Status.value;
	var proAtt = document.frmAddProduct.Product_Attribute.value;
	
	if (productCode!='' && proNameEN!='')
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
				next_pmeters = '?';
				next_pmeters += 'proCode='+productCode;
				next_pmeters += '&proNameEN='+proNameEN;
				next_pmeters += '&step=1';
				window.location.href="productGroup_viewCatAndCross.php"+next_pmeters;
			}
		}
		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'ran='+ran;
		pmeters += '&productCode='+productCode;
		pmeters += '&proNameEN='+proNameEN;
		pmeters += '&proNameTH='+proNameTH;
		pmeters += '&descripEN='+descripEN;
		pmeters += '&descripTH='+descripTH;
		pmeters += '&proSize='+proSize;
		pmeters += '&groupPrice='+groupPrice;
		pmeters += '&proMsgEN='+proMsgEN;
		pmeters += '&proMsgTH='+proMsgTH;
		pmeters += '&proKeyWord='+proKeyWord;
		pmeters += '&proUrlEN='+proUrlEN;
		pmeters += '&proUrlTH='+proUrlTH;
		pmeters += '&proStatus='+proStatus;
		pmeters += '&proAtt='+proAtt;
			
		req.open("GET","connectDB/productGroup_insert.php"+pmeters,true);
		req.send(null);
	}
	else
	{
		alert("Please insert Product Code and Product Name");
	}
}

function deleteProductGroup(proCode)
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
				alert("Done.");
				window.location.href="productGroup.php";
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'proCode='+proCode;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/productGroup_delete.php"+pmeters,true);
		req.send(null);
}

//--------- edit Group Description --------
function editProGroupDescrip(proCode)
{
	var productCode = document.frmAddProduct.Product_Code.value;
	var proNameEN = document.frmAddProduct.Product_Name_En.value;
	var proNameTH = document.frmAddProduct.Product_Name_Th.value;
	var descripEN = document.frmAddProduct.Description_En.value;
	var descripTH = document.frmAddProduct.Description_Th.value;
	var proSize = document.frmAddProduct.Size.value;
	var groupPrice = document.frmAddProduct.price.value;
	var proMsgEN = document.frmAddProduct.Short_msg_En.value;
	var proMsgTH = document.frmAddProduct.Short_msg_Th.value;
	var proKeyWord = document.frmAddProduct.KeyWord.value;
	var proUrlEN = document.frmAddProduct.Url_En.value;
	var proUrlTH = document.frmAddProduct.Url_Th.value;
	var proStatus = document.frmAddProduct.Product_Status.value;
	var proAtt = document.frmAddProduct.Product_Attribute.value;

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
			window.location.href="productGroup.php";
		}
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&proCode='+proCode;
	pmeters += '&productCode='+productCode;
	pmeters += '&proNameEN='+proNameEN;
	pmeters += '&proNameTH='+proNameTH;
	pmeters += '&descripEN='+descripEN;
	pmeters += '&descripTH='+descripTH;
	pmeters += '&proSize='+proSize;
	pmeters += '&groupPrice='+groupPrice;
	pmeters += '&proMsgEN='+proMsgEN;
	pmeters += '&proMsgTH='+proMsgTH;
	pmeters += '&proKeyWord='+proKeyWord;
	pmeters += '&proUrlEN='+proUrlEN;
	pmeters += '&proUrlTH='+proUrlTH;
	pmeters += '&proStatus='+proStatus;
	pmeters += '&proAtt='+proAtt;
		
	req.open("GET","connectDB/productGroup_editDescript.php"+pmeters,true);
	req.send(null);
}

//--------- check Category ---------------

function selectMain(mainID,proCode)
{
	if ( $( "#checkMain_"+mainID+":checked" ).val() == mainID )
	{
		//alert(mainID+genProID);
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
		pmeters += 'subID='+mainID;
		pmeters += '&proCode='+proCode;
		pmeters += '&lvl=1';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/productGroup_category_insert.php"+pmeters,true);
		req.send(null);
	}
	else
	{
		//alert("no");
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
		pmeters += 'subID='+mainID;
		pmeters += '&proCode='+proCode;
		pmeters += '&lvl=1';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/productGroup_category_delete.php"+pmeters,true);
		req.send(null);
	}
}

function selectSub(subID,proCode)
{
	if ( $( "#checkSub_"+subID+":checked" ).val() == subID )
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
		pmeters += 'subID='+subID;
		pmeters += '&proCode='+proCode;
		pmeters += '&lvl=2';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/productGroup_category_insert.php"+pmeters,true);
		req.send(null);
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

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'subID='+subID;
		pmeters += '&proCode='+proCode;
		pmeters += '&lvl=2';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/productGroup_category_delete.php"+pmeters,true);
		req.send(null);
	}
}

function selectSon(sonID,proCode)
{
	if ( $( "#checkSon_"+sonID+":checked" ).val() == sonID )
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
		pmeters += 'subID='+sonID;
		pmeters += '&proCode='+proCode;
		pmeters += '&lvl=3';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/productGroup_category_insert.php"+pmeters,true);
		req.send(null);
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

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'subID='+sonID;
		pmeters += '&proCode='+proCode;
		pmeters += '&lvl=3';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/productGroup_category_delete.php"+pmeters,true);
		req.send(null);
	}
}

function selectThumb(thumbID,proCode)
{
	if ( $( "#checkThumb_"+thumbID+":checked" ).val() == thumbID )
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
		pmeters += 'subID='+thumbID;
		pmeters += '&proCode='+proCode;
		pmeters += '&lvl=4';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/productGroup_category_insert.php"+pmeters,true);
		req.send(null);
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

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'subID='+thumbID;
		pmeters += '&proCode='+proCode;
		pmeters += '&lvl=4';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/productGroup_category_delete.php"+pmeters,true);
		req.send(null);
	}
}
//-- End select Category

//-- Cross sale --
function updateCross(proCode,step)
{
		var proCross1 = document.frmAddProduct.selectCross1.value;
		var proCross2 = document.frmAddProduct.selectCross2.value;
		var proCross3 = document.frmAddProduct.selectCross3.value;
		var proCross4 = document.frmAddProduct.selectCross4.value;

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
				if (step == 1)
					window.location.href="viewProduct.php?proCode="+proCode;
				else
				{
					alert("Done.");
					window.location.href="productGroup.php";
				}
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'ran='+ran;
		pmeters += '&proCode='+proCode;
		pmeters += '&proCross1='+proCross1;
		pmeters += '&proCross2='+proCross2;
		pmeters += '&proCross3='+proCross3;
		pmeters += '&proCross4='+proCross4;
				
		req.open("GET","connectDB/productGroup_crossUpdate.php"+pmeters,true);
		req.send(null);
}

function searchProCode()
{
	var proSearch = $("#proSearch").val();
	viewTable(proSearch);
}

function upSort(proCode)
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
			viewTable('');
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&proCode='+proCode;
	
	req.open("GET","connectDB/productGroup_upSort.php"+pmeters,true);
	req.send(null);
}

function downSort(proCode)
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
			viewTable('');
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&proCode='+proCode;
	
	req.open("GET","connectDB/productGroup_downSort.php"+pmeters,true);
	req.send(null);
}

//---- check input is nummber -----
function check_number(ch)
{
	var len, digit;
	if(ch == " ")
	{ 
		return false;
		len=0;
	}
	else
	{
		len = ch.length;
	}
	for(var i=0 ; i<len ; i++)
	{
		digit = ch.charAt(i)
		if(digit >="0" && digit <="9")
			{;}
		else{
			return false;	
		}	
	}	
	return true;
}

function changeNumber(proCode,dataRow)
{
	var changeNum = $("#number_"+proCode).val();
	if(!check_number(changeNum))
		alert("not number");
	else
	{
		if(dataRow < changeNum)
			alert("not have this number");
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
					viewTable('');
			}
			var ran = Math.random();
			var pmeters = '?';
			pmeters += 'ran='+ran;
			pmeters += '&proCode='+proCode;
			pmeters += '&changeNum='+changeNum;
			
			req.open("GET","connectDB/productGroup_changeSort.php"+pmeters,true);
			req.send(null);
		}
	}
}