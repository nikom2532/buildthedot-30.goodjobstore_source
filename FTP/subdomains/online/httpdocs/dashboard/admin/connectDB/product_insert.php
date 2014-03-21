<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$genProID = $_GET["genProID"];
	$proCode = $_GET["proCode"];
	$propertyName = $_GET["propertyName"];
	$proPrice = $_GET["proPrice"];
	$proDisStat = $_GET["proDisStat"];
	$proDisType = $_GET["proDisType"];
	$proDiscount = $_GET["proDiscount"];
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
	$proPropID = $_GET["proPropID"];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

//************* add product description from product_groups ***************
	$sqlProGroup = "SELECT * FROM product_groups WHERE Product_Code = '$proCode'";
	$resultProGroup = mysql_query($sqlProGroup, $objCon) or die(mysql_error());
	while($dataProGroup = mysql_fetch_array($resultProGroup))
	{
		$proNameEN = $dataProGroup['Group_Name_En'];
		$proNameTH = $dataProGroup['Group_Name_Th'];
		$descripEN = $dataProGroup['Group_Description_En'];
		$descripTH = $dataProGroup['Group_Description_Th'];
		$proSize = $dataProGroup['Group_Size'];
		$proMsgEN = $dataProGroup['Group_msg_En'];
		$proMsgTH = $dataProGroup['Group_msg_Th'];
		$proKeyWord = $dataProGroup['Group_KeyWord'];
		$proUrlEN = $dataProGroup['Group_Url_En'];
		$proUrlTH = $dataProGroup['Group_Url_Th'];
		$proStatus = $dataProGroup['Group_Status'];
		$proAtt = $dataProGroup['Group_attribute_id'];
		$proBox = $dataProGroup['Group_gift_box'];
	}

//************************ sql Add Product ***************************

	$sqlAddPro = "INSERT INTO products (Product_ID,Product_Code,Property_Name,Pro_Name_En,Pro_Name_Th,Description_En,Description_Th,Size,Price_Buy,Price_sale,Discount_PC,Discount_Num,Short_msg_En,Short_msg_Th,Qty,Sale_min,Sale_max,KeyWord,Weight,Url_En,Url_Th,Discount_Status,Product_Status,attribute_id,Property_ID,gift_box) 
				VALUES ('".$genProID."','".$proCode."','".$propertyName."','".$proNameEN."','".$proNameTH."','".$descripEN."','".$descripTH."','".$proSize."','".$proPrice."','".$proPriceTotal."','".$proDisPC."','".$proDisNum."','".$proMsgEN."','".$proMsgTH."','".$proQty."','".$proSaleMin."','".$proSaleMax."','".$proKeyWord."','".$proWeight."','".$proUrlEN."','".$proUrlTH."','".$proDisStat."','".$proStatus."','".$proAtt."','".$proPropID."','".$proBox."')";

	mysql_query($sqlAddPro, $objCon) or die(mysql_error());

//*************** Close Database ****************
	mysql_close($objCon);
?>