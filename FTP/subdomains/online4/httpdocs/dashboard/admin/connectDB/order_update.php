<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$orderID = $_GET["orderID"];
	$changeStat = $_GET["changeStat"];
	$shipNum = $_GET["shipNum"];

	switch ($changeStat) 
	{
		case 1:
			$changeStatItem = "Pending";
			break;
		case 2:
			$changeStatItem = "Payment Received";
			break;
		case 3:
			$changeStatItem = "Shipped";
			break;
		case 4:
			$changeStatItem = "Refund";
			break;
		case 5:
			$changeStatItem = "Cancel";
			break;
	}

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);
	
	//--- update order ---
	$sqlOrder = "UPDATE orders SET status = '$changeStat',shipping_number = '$shipNum' WHERE Order_ID = '$orderID'";
	mysql_query($sqlOrder, $objCon) or die(mysql_error());

	//--- update order_item status ---
	$sqlOrderItem = "UPDATE order_item SET Status = '$changeStatItem' WHERE Order_ID = '$orderID'";
	mysql_query($sqlOrderItem, $objCon) or die(mysql_error());

	//--- close database ---
	mysql_close($objCon);
?>