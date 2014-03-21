<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$subID = $_GET["subID"];
	$mainID = $_GET["mainID"];
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	//-- reset sort --
	$sqlAllCategory = "SELECT Sub_ID,sub_sort FROM sub_menu WHERE Main_ID = $mainID ORDER BY sub_sort";
	$resultAllCategory = mysql_query($sqlAllCategory, $objCon) or die(mysql_error());

	$idStatus = 0; //--  codeStatus 0.)beforDelete 1.)Delete 2.)afterDelete --
	while($dataAllCategory=mysql_fetch_array($resultAllCategory))
	{
		$nowID = $dataAllCategory['Sub_ID'];
		if($idStatus==1)
		{
			$upSort = $dataAllCategory['sub_sort']-0.1;
			$sqlUp = "UPDATE sub_menu SET sub_sort = $upSort WHERE Sub_ID = '$nowID'";
			mysql_query($sqlUp, $objCon) or die(mysql_error());
		}
		if($nowID==$subID)
		{
			$idStatus=1;
		}
	}

	//--------- delete sub menu ----------
	$strSQL = "DELETE FROM sub_menu WHERE Sub_ID=".$subID;
	mysql_query($strSQL, $objCon) or die(mysql_error());

	//--------- delete son menu
	$sqlDelSon = "DELETE FROM son_menu WHERE Sub_ID=".$subID;
	mysql_query($sqlDelSon, $objCon) or die(mysql_error());

	//------- close database -------
	mysql_close($objCon);
?>