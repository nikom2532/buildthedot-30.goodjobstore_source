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
		var area = document.getElementById('coupon_content');
		if (req.readyState == 4)
			area.innerHTML = req.responseText;
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += 'ran='+ran;
	
	req.open("GET","connectDB/coupon_table.php"+pmeters,true);
	req.send(null);
}

function GenCoupon(cusID)
{
	var discount = $("#discount").val();
	var dis_type = $("#dis_type").val();
	var exp_day = $("#exp_day").val();
	var exp_month = $("#exp_month").val();
	var exp_year = $("#exp_year").val();
	if(dis_type=="")
		alert("Please select discount type.");
	else if(discount=="")
		alert("Please insert discount.");
	else if(exp_day=="")
		alert("Please select exp. day.");
	else if(exp_month=="")
		alert("Please select exp. month.");
	else if(exp_year=="")
		alert("Please select exp. year.");
	else if(dis_type==1 && discount>100)
		alert("Can't discount more than 100 percen.");
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
				alert("Done");
				viewTable();
				clearTxt();
			}
		}
		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'discount='+discount;
		pmeters += '&dis_type='+dis_type;
		pmeters += '&exp_day='+exp_day;
		pmeters += '&exp_month='+exp_month;
		pmeters += '&exp_year='+exp_year;
		pmeters += '&cusID='+cusID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/coupon_insert.php"+pmeters,true);
		req.send(null);
	}
}

function clearTxt()
{
	$("#discount").val("");
	$("#dis_type").val("");
	$("#exp_day").val("");
	$("#exp_month").val("");
	$("#exp_year").val("");
}

function deleteCoupon(couponID)
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
		pmeters += 'couponID='+couponID;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/coupon_delete.php"+pmeters,true);
		req.send(null);
}