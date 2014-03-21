function viewToday()
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
		var area = document.getElementById('report_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/report_today_table.php"+pmeters,true);
	req.send(null);
}

function viewHotSale()
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
		var area = document.getElementById('report_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/report_hotSale_table.php"+pmeters,true);
	req.send(null);
}

function viewSaleProduct()
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
		var area = document.getElementById('report_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/report_saleProduct_table.php"+pmeters,true);
	req.send(null);
}

function viewStock()
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
		var area = document.getElementById('report_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/report_stock_table.php"+pmeters,true);
	req.send(null);
}


function viewTodayFilter()
{
	//--- get start date ---
	start_day = $("#start_day").val();
		if (start_day<10){start_day="0"+start_day;}
	start_month = $("#start_month").val();
		if (start_month<10){start_month="0"+start_month;}
	start_year = $("#start_year").val();
	start_date = start_year+"-"+start_month+"-"+start_day;

	//--- get end date ---
	end_day = $("#end_day").val();
		if (end_day<10){end_day="0"+end_day;}
	end_month = $("#end_month").val();
		if (end_month<10){end_month="0"+end_month;}
	end_year = $("#end_year").val();
	end_date = end_year+"-"+end_month+"-"+end_day;
	
	if (start_day=="" || start_month=="" || start_year=="")
	{	alert("Select Start date.");	}
	else if (end_day=="" || end_month=="" || end_year=="")
	{	alert("Select End date.");	}
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
			var area = document.getElementById('report_content');
			if (req.readyState == 4)
				area.innerHTML = req.responseText;
		}
		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'ran='+ran;
		pmeters += '&start_date='+start_date;
		pmeters += '&end_date='+end_date;
		
		req.open("GET","connectDB/report_today_table.php"+pmeters,true);
		req.send(null);
	}
}