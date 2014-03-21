function editAboutUs()
{
		var descripEN = document.frmAboutUs.Descrip_En.value;
		var descripTH = document.frmAboutUs.Descrip_Th.value;

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
				window.location.href="shopGuide_main.php"
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += '&descripEN='+descripEN;
		pmeters += '&descripTH='+descripTH;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/shopGuide_AboutUs_edit.php"+pmeters,true);
		req.send(null);
}


function editPayment()
{
		var descripEN = document.frmPayment.Descrip_En.value;
		var descripTH = document.frmPayment.Descrip_Th.value;
		var descripDeliveryEN = document.frmPayment.DescripDelivery_En.value;
		var descripDeliveryTH = document.frmPayment.DescripDelivery_Th.value;

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
				window.location.href="shopGuide_main.php"
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += '&descripEN='+descripEN;
		pmeters += '&descripTH='+descripTH;
		pmeters += '&descripDeliveryEN='+descripDeliveryEN;
		pmeters += '&descripDeliveryTH='+descripDeliveryTH;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/shopGuide_Payment_edit.php"+pmeters,true);
		req.send(null);
}


function editRuturn()
{
		var descripEN = document.frmReturn.Descrip_En.value;
		var descripTH = document.frmReturn.Descrip_Th.value;

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
				window.location.href="shopGuide_main.php"
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += '&descripEN='+descripEN;
		pmeters += '&descripTH='+descripTH;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/shopGuide_Return_edit.php"+pmeters,true);
		req.send(null);
}


function editTechnology()
{
		var descripEN = document.frmTechnology.Descrip_En.value;
		var descripTH = document.frmTechnology.Descrip_Th.value;

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
				window.location.href="shopGuide_main.php"
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += '&descripEN='+descripEN;
		pmeters += '&descripTH='+descripTH;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/shopGuide_Tech_edit.php"+pmeters,true);
		req.send(null);
}


function editFAQ()
{
		var descripEN = document.frmFAQ.Descrip_En.value;
		var descripTH = document.frmFAQ.Descrip_Th.value;

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
				window.location.href="shopGuide_main.php"
			}
		}

		var ran = Math.random();
		var pmeters = '?';
		pmeters += '&descripEN='+descripEN;
		pmeters += '&descripTH='+descripTH;
		pmeters += '&ran='+ran;
		
		req.open("GET","connectDB/shopGuide_FAQ_edit.php"+pmeters,true);
		req.send(null);
}