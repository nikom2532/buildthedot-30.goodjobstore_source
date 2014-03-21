<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$propID = $_GET["propID"];
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "DELETE FROM property WHERE prop_id=".$propID;
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>