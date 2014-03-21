/*function viewColor()
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
		var area = document.getElementById('select_color');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/product_color.php"+pmeters,true);
	req.send(null);
}*/

/*
function viewProperty()
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
		var area = document.getElementById('select_property');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/product_property.php"+pmeters,true);
	req.send(null);
}
*/


function viewCategory(genProID)
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
		var area = document.getElementById('showCategory');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&genProID='+genProID;
	
	req.open("GET","connectDB/product_category.php"+pmeters,true);
	req.send(null);
}


function viewCrossProduct(num)
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
		var area = document.getElementById('cross_product'+num);
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&num='+num;
	
	req.open("GET","connectDB/product_crossProduct.php"+pmeters,true);
	req.send(null);
}



//*****************************************************************


function addProduct(genProID,proCode)
{
	var propertyName = document.frmAddProduct.Property_Name.value;
	var proPrice = document.frmAddProduct.Price.value;
	var proDiscount = document.frmAddProduct.Discount.value;
	var proDisType = document.frmAddProduct.DiscountType.value;
	var proQty = document.frmAddProduct.qty.value;
	var proSaleMin = document.frmAddProduct.Sale_min.value;
	var proSaleMax = document.frmAddProduct.Sale_max.value;
	var proWeight = document.frmAddProduct.Weight.value;
	var proPropID = document.frmAddProduct.selectProperty.value;

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
			var proDetail = '?';
			proDetail += 'genProID='+genProID;
			proDetail += '&proCode='+proCode;
			proDetail += '&propertyName='+propertyName;
			window.location.href="product_insertImage.php"+proDetail;
		}
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&genProID='+genProID;
	pmeters += '&proCode='+proCode;
	pmeters += '&propertyName='+propertyName;
	pmeters += '&proPrice='+proPrice;
	pmeters += '&proDiscount='+proDiscount;
	pmeters += '&proDisType='+proDisType;
	pmeters += '&proQty='+proQty;
	pmeters += '&proSaleMin='+proSaleMin;
	pmeters += '&proSaleMax='+proSaleMax;
	pmeters += '&proWeight='+proWeight;
	pmeters += '&proPropID='+proPropID;

	if ( $( "#modtype:checked" ).val() == 1 )
		pmeters += "&proDisStat=1";
		
	req.open("GET","connectDB/product_insert.php"+pmeters,true);
	req.send(null);
}


//--------- check Category ---------------

function selectMain(mainID,genProID)
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
		pmeters += '&genProID='+genProID;
		pmeters += '&lvl=1';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/product_category_insert.php"+pmeters,true);
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
		pmeters += '&genProID='+genProID;
		pmeters += '&lvl=1';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/product_category_delete.php"+pmeters,true);
		req.send(null);
	}
}

function selectSub(subID,genProID)
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
		pmeters += '&genProID='+genProID;
		pmeters += '&lvl=2';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/product_category_insert.php"+pmeters,true);
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
		pmeters += '&genProID='+genProID;
		pmeters += '&lvl=2';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/product_category_delete.php"+pmeters,true);
		req.send(null);
	}
}

function selectSon(sonID,genProID)
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
		pmeters += '&genProID='+genProID;
		pmeters += '&lvl=3';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/product_category_insert.php"+pmeters,true);
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
		pmeters += '&genProID='+genProID;
		pmeters += '&lvl=3';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/product_category_delete.php"+pmeters,true);
		req.send(null);
	}
}

function selectThumb(thumbID,genProID)
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
		pmeters += '&genProID='+genProID;
		pmeters += '&lvl=4';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/product_category_insert.php"+pmeters,true);
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
		pmeters += '&genProID='+genProID;
		pmeters += '&lvl=4';
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/product_category_delete.php"+pmeters,true);
		req.send(null);
	}
}

function deleteCategoryAll(genProID)
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
			window.location.href="viewProduct.php";
	}

	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'genProID='+genProID;
	pmeters += '&ran='+ran;
		
	req.open("GET","connectDB/product_category_Alldelete.php"+pmeters,true);
	req.send(null);
}


function editDescrip(productID,proCode)
{
		var propertyName = document.frmAddProduct.Property_Name.value;
		var proPrice = document.frmAddProduct.Price.value;
		var proDiscount = document.frmAddProduct.Discount.value;
		var proDisType = document.frmAddProduct.DiscountType.value;
		var proQty = document.frmAddProduct.qty.value;
		var proSaleMin = document.frmAddProduct.Sale_min.value;
		var proSaleMax = document.frmAddProduct.Sale_max.value;
		var proWeight = document.frmAddProduct.Weight.value;
		var proPropID = document.frmAddProduct.selectProperty.value;

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
				var viewPmeters = "proCode="+proCode;
				window.location.href="viewProduct.php?"+viewPmeters;}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'ran='+ran;
		pmeters += '&genProID='+productID;
		pmeters += '&propertyName='+propertyName;
		pmeters += '&proPrice='+proPrice;
		pmeters += '&proDiscount='+proDiscount;
		pmeters += '&proDisType='+proDisType;
		pmeters += '&proQty='+proQty;
		pmeters += '&proSaleMin='+proSaleMin;
		pmeters += '&proSaleMax='+proSaleMax;
		pmeters += '&proWeight='+proWeight;
		pmeters += '&proPropID='+proPropID;

		if ( $( "#modtype:checked" ).val() == 1 )
			pmeters += "&proDisStat=1";
				
		req.open("GET","connectDB/product_edit.php"+pmeters,true);
		req.send(null);
}

