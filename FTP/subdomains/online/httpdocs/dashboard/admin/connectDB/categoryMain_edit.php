<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$mainID = $_GET['mainID'];
	$nameEN = $_GET['nameEN'];
	$nameTH = $_GET['nameTH'];
	$mainURL = $_GET['mainUrl'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE main_menu SET Name_En = '$nameEN',Name_Th = '$nameTH',main_url = '$mainUrl' WHERE main_ID = $mainID";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>