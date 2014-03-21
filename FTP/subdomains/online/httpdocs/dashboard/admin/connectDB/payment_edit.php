<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$paymentID = $_GET["paymentID"];
	$m_payment_EN = $_GET["payment_EN"];
	$payment_EN = str_replace("'","''",$m_payment_EN);
	$payment_TH = $_GET["payment_TH"];
	$m_descrip_EN = $_GET["descrip_EN"];
	$descrip_EN = str_replace("'","''",$m_descrip_EN);
	$descrip_TH = $_GET["descrip_TH"];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE payments SET 
				name_th='$payment_TH',
				name_en='$payment_EN',
				description_th='$descrip_TH',
				description_en='$descrip_EN' 
				WHERE id = '$paymentID'";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>