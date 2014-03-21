<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
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

//********************** check product_code **************************
	$sqlCheckProCode = "SELECT Product_Code FROM product_groups WHERE Product_Code = '$productCode'";
	$resultCheckProCode = mysql_query($sqlCheckProCode, $objCon) or die(mysql_error());
	$CheckProCode = mysql_fetch_row($resultCheckProCode);

//************************ sql Add Product ***************************
	if(!$CheckProCode)
	{
		//----- set sort ----
		$sqlSort = "SELECT sort FROM product_groups ORDER BY sort DESC LIMIT 1";
		$resultSort = mysql_query($sqlSort, $objCon) or die(mysql_error());
		$groupSort = '1';
		while($dataSort=mysql_fetch_array($resultSort))
		{
			$groupSort = $dataSort['sort']+1;
		}
		//--- end set sort ---

		$sqlAddPro = "INSERT INTO product_groups (Product_Code,Group_Name_En,Group_Name_Th,Group_Description_En,Group_Description_Th,Group_Size,price_default,Group_msg_En,Group_msg_Th,Group_KeyWord,Group_Url_En,Group_Url_Th,Group_Status,Group_attribute_id,sort) 
					VALUES ('".$productCode."','".$proNameEN."','".$proNameTH."','".$descripEN."','".$descripTH."','".$proSize."','".$groupPrice."','".$proMsgEN."','".$proMsgTH."','".$proKeyWord."','".$proUrlEN."','".$proUrlTH."','".$proStatus."','".$proAtt."','".$groupSort."')";

		mysql_query($sqlAddPro, $objCon) or die(mysql_error());
	}

//*************** Close Database ****************
	mysql_close($objCon);
?>