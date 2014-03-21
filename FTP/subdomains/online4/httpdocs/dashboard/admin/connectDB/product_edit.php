<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$genProID = $_GET["genProID"];
	$propertyName = $_GET["propertyName"];
	$proPrice = $_GET["proPrice"];
	$proDisStat = $_GET["proDisStat"];
	$proDisType = $_GET["proDisType"];
	$proDiscount = $_GET["proDiscount"];
	$proPropID = $_GET["proPropID"];
		if($proDisStat==1)
		{
			if($proDisType == Discount_num)
			{
				$proDisNum = $proDiscount;
				$proPriceTotal = $proPrice - $proDiscount;
			}
			else
			{
				$proDisPC = $proDiscount;
				$proPriceTotal = $proPrice-($proPrice*$proDiscount/100);
			}
		}
		else
			$proPriceTotal = "";
	$proQty = $_GET["proQty"];
	$proSaleMin = $_GET["proSaleMin"];
	$proSaleMax = $_GET["proSaleMax"];
	$proWeight = $_GET["proWeight"];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);
	
	//------- Update Description -------------
	$strSQL = "UPDATE products SET Property_Name='$propertyName' ,Price_Buy='$proPrice' ,Price_sale='$proPriceTotal' ,Discount_PC='$proDisPC' ,Discount_Num='$proDisNum' ,Qty='$proQty' ,Sale_min='$proSaleMin' ,Sale_max='$proSaleMax' ,Weight='$proWeight' ,Discount_Status='$proDisStat' ,Property_ID='$proPropID' 
	WHERE Product_ID='$genProID'";
	mysql_query($strSQL, $objCon) or die(mysql_error());

//*************** Close Database ****************
	mysql_close($objCon);
?>
