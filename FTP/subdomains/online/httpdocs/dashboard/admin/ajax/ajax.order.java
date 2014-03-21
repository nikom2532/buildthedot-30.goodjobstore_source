function viewTable(filterStat,orderID)
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
		var area = document.getElementById('order_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	pmeters += '&filterStat='+filterStat;
	pmeters += '&orderID='+orderID;
	
	req.open("GET","connectDB/order_table.php"+pmeters,true);
	req.send(null);
}

function updateOrder(orderID,filterStat,stat)
{
		//var changeStat = document.frmTableOrder.change_status.value;
		//var shipNum = document.frmTableOrder.ship_num.value;
		var changeStat = $("#change_status_"+orderID).val();
		var shipNum = $("#ship_num_"+orderID).val();
		//alert(shipNum);
		if (changeStat==0)
			changeStat = stat;

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
				viewTable(filterStat,'');
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'orderID='+orderID;
		pmeters += '&changeStat='+changeStat;
		pmeters += '&shipNum='+shipNum;
		pmeters += '&ran='+ran;
		
		
		
		req.open("GET","connectDB/order_update.php"+pmeters,true);
		req.send(null);
}

function searchOrder()
{
	var orderSearch = $("#orderSearch").val();
	viewTable('0',orderSearch);
}