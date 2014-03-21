<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$rangeID = $_GET['rangeID'];
	$weightStart = $_GET['weightStart'];
	$weightEnd = $_GET['weightEnd'];
	$rangePrice = $_GET['rangePrice'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE range_weight SET Weight_Start = '$weightStart',Weight_End = '$weightEnd',Price = '$rangePrice'
				WHERE Range_ID = $rangeID";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>