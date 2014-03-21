function callBarcode(orderID,finalPrice,itemCode_0,itemCode_1,itemCode_2,itemCode_3,itemID_0,itemID_1,itemID_2,itemID_3,itemName_0,itemName_1,itemName_2,itemName_3,itemPrice_0,itemPrice_1,itemPrice_2,itemPrice_3,shipNameEn,shipPrice,servicePrice,fName,lName,sAddress,sCityID,sPostCode,cusID)
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
			return true;
		}
	}
	var ran = Math.random();
	var pmeters = '?';
	pmeters += '&ran='+ran;
	pmeters += '&orderID='+orderID;
	pmeters += '&finalPrice='+finalPrice;
	pmeters += '&itemCode_0='+itemCode_0;
	pmeters += '&itemCode_1='+itemCode_1;
	pmeters += '&itemCode_2='+itemCode_2;
	pmeters += '&itemCode_3='+itemCode_3;
	pmeters += '&itemID_0='+itemID_0;
	pmeters += '&itemID_1='+itemID_1;
	pmeters += '&itemID_2='+itemID_2;
	pmeters += '&itemID_3='+itemID_3;
	pmeters += '&itemName_0='+itemName_0;
	pmeters += '&itemName_1='+itemName_1;
	pmeters += '&itemName_2='+itemName_2;
	pmeters += '&itemName_3='+itemName_3;
	pmeters += '&itemPrice_0='+itemPrice_0;
	pmeters += '&itemPrice_1='+itemPrice_1;
	pmeters += '&itemPrice_2='+itemPrice_2;
	pmeters += '&itemPrice_3='+itemPrice_3;
	pmeters += '&shipNameEn='+shipNameEn;
	pmeters += '&shipPrice='+shipPrice;
	pmeters += '&servicePrice='+servicePrice;
	pmeters += '&fName='+fName;
	pmeters += '&lName='+lName;
	pmeters += '&sAddress='+sAddress;
	pmeters += '&sCityID='+sCityID;
	pmeters += '&sPostCode='+sPostCode;
	pmeters += '&cusID='+cusID;

	req.open("GET","../../dashboard/my/pdf.php"+pmeters,true);
	req.send(null);
}