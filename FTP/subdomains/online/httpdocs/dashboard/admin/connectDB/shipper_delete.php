<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$how_ID = $_GET["howID"];
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "DELETE FROM how_delivery WHERE How_ID=".$how_ID;
	mysql_query($sql, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>