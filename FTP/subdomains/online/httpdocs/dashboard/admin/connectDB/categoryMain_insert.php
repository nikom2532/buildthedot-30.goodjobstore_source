<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$nameEN = $_GET["nameEN"];
	$nameTH = $_GET["nameTH"];
	$mainUrl = $_GET["mainUrl"];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "INSERT INTO main_menu (Name_En,Name_Th,main_url) 
			VALUES ('".$nameEN."','".$nameTH."','".$mainUrl."')";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>