<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$imgID = $_GET["imgID"];
	$proCode = $_GET["proCode"];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strDelSQL = "UPDATE images SET primary_product = '0' WHERE primary_product = '1' AND Product_Code = '$proCode'";
	mysql_query($strDelSQL, $objCon) or die(mysql_error());

	$strSQL = "UPDATE images SET primary_product = '1' WHERE Image_ID = '$imgID'";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>