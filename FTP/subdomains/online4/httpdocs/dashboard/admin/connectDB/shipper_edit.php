<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$howID = $_GET["howID"];
	$m_Name_EN = $_GET["shipperEN"];
	$Name_EN = str_replace("'","''",$m_Name_EN);
	$Name_TH = $_GET["shipperTH"];
	$m_Descrip_EN = $_GET["descripEN"];
	$Descrip_EN = str_replace("'","''",$m_Descrip_EN);
	$Descrip_TH = $_GET["descripTH"];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "UPDATE how_delivery SET 
				Name_Th='$Name_TH',
				Name_En='$Name_EN',
				Description_Th='$Descrip_TH',
				Description_En='$Descrip_EN' 
				WHERE How_ID = '$howID'";
	mysql_query($strSQL, $objCon) or die(mysql_error());
	mysql_close($objCon);
?>