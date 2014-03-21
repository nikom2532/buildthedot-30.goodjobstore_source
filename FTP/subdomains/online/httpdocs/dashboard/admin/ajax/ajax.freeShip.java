function updateFreeShip(freeshipID)
{
	var changePrice = $("#minPrice").val();
	if ( $( "#free_status:checked" ).val() == 1 )
		var changeStatus = 1;
	else 
		var changeStatus =0;
	
	if (changeStatus==1 && changePrice==""){
		alert("Please insert price.");
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
				alert("Done.");
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += 'freeshipID='+freeshipID;
		pmeters += '&changePrice='+changePrice;
		pmeters += '&changeStatus='+changeStatus;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/freeShip_update.php"+pmeters,true);
		req.send(null);
	}
}