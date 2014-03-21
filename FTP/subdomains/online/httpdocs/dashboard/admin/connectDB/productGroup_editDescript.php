<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$proCode = $_GET["proCode"];
	$productCode = $_GET["productCode"];
	$m_proNameEN = $_GET["proNameEN"];
		$proNameEN = str_replace("'","''",$m_proNameEN);
	$m_proNameTH = $_GET["proNameTH"];
		$proNameTH = str_replace("'","''",$m_proNameTH);
	$m_descripEN = $_GET["descripEN"];
		$descripEN = str_replace("'","''",$m_descripEN);
	$m_descripTH = $_GET["descripTH"];
		$descripTH = str_replace("'","''",$m_descripTH);
	$proSize = $_GET["proSize"];
	$groupPrice = $_GET["groupPrice"];
	$m_proMsgEN = $_GET["proMsgEN"];
		$proMsgEN = str_replace("'","''",$m_proMsgEN);
	$m_proMsgTH = $_GET["proMsgTH"];
		$proMsgTH = str_replace("'","''",$m_proMsgTH);
	$proKeyWord = $_GET["proKeyWord"];
	$proUrlEN = $_GET["proUrlEN"];
	$proUrlTH = $_GET["proUrlTH"];
	$proStatus = $_GET["proStatus"];
	$proAtt = $_GET["proAtt"];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

//************************ sql Edit Product Groups ***************************
	$sqlEditProGroup = "UPDATE product_groups SET
						Product_Code='$productCode',Group_Name_En='$proNameEN',Group_Name_Th='$proNameTH',Group_Description_En='$descripEN',Group_Description_Th='$descripTH',Group_Size='$proSize',price_default='$groupPrice',Group_msg_En='$proMsgEN',Group_msg_Th='$proMsgTH',Group_KeyWord='$proKeyWord',Group_Url_En='$proUrlEN',Group_Url_Th='$proUrlTH',Group_Status='$proStatus',Group_attribute_id='$proAtt'
						WHERE Product_Code='$proCode'";
	mysql_query($sqlEditProGroup, $objCon) or die(mysql_error());

//************************ sql Edit Products ****************************
	$sqlEditProduct = "UPDATE products SET
						Product_Code='$productCode',Pro_Name_En='$proNameEN',Pro_Name_Th='$proNameTH',Description_En='$descripEN',Description_Th='$descripTH',Size='$proSize',Short_msg_En='$proMsgEN',Short_msg_Th='$proMsgTH',KeyWord='$proKeyWord',Url_En='$proUrlEN',Url_Th='$proUrlTH',Product_Status='$proStatus',attribute_id='$proAtt'
						WHERE Product_Code = '$proCode'";
	mysql_query($sqlEditProduct, $objCon) or die(mysql_error());

//*************** sql Edit other table about product_code **************
	$sqlEditImage = "UPDATE images SET Product_Code='$productCode' WHERE Product_Code='$proCode'";
	mysql_query($sqlEditImage, $objCon) or die(mysql_error());

	$sqlEditCross = "UPDATE cross_sale SET Product_Code='$productCode' WHERE Product_Code='$proCode'";
	mysql_query($sqlEditCross, $objCon) or die(mysql_error());

	$sqlEditCrossCode = "UPDATE cross_sale SET Product_Cross_Code='$productCode' WHERE Product_Cross_Code='$proCode'";
	mysql_query($sqlEditCrossCode, $objCon) or die(mysql_error());

//*************** Close Database ****************
	mysql_close($objCon);
?>