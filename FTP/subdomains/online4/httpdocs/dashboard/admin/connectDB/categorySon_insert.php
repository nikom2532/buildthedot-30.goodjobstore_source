<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$subID = $_GET["subID"];
	$nameEN = $_GET["nameEN"];
	$nameTH = $_GET["nameTH"];
	$sonUrl = $_GET["sonUrl"];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "INSERT INTO son_menu (Sub_ID,Name_En,Name_Th,son_url) 
			VALUES ('".$subID."','".$nameEN."','".$nameTH."','".$sonUrl."')";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>