<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$howID = $_GET['m_howID'];
	$weightStart = $_GET['m_weightStart'];
	$weightEnd = $_GET['m_weightEnd'];
	$price = $_GET['m_rangePrice'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "INSERT INTO range_weight (How_ID,Weight_Start,Weight_End,Price) 
			VALUES ('".$howID."','".$weightStart."','".$weightEnd."','".$price."')";

	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>