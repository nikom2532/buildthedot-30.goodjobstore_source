<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$imageID = $_GET["imageID"];
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sqlCheckPrim = "SELECT Image_ID FROM images WHERE Image_ID = $imageID AND primary_product=1";
	$resultCheckPrim = mysql_query($sqlCheckPrim, $objCon) or die(mysql_error());
	$checkPrim = mysql_fetch_row($resultCheckPrim);
	
	if(!$checkPrim)
	{
		$strSQL = "DELETE FROM images WHERE Image_ID=".$imageID;
		mysql_query($strSQL, $objCon) or die(mysql_error());
		mysql_close($objCon);
	}
?>