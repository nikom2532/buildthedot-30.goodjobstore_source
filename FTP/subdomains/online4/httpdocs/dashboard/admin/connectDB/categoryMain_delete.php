<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$mainID = $_GET["mainID"];
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	//-- reset sort --
	$sqlAllCategory = "SELECT main_ID,main_sort FROM main_menu ORDER BY main_sort";
	$resultAllCategory = mysql_query($sqlAllCategory, $objCon) or die(mysql_error());

	$idStatus = 0; //--  codeStatus 0.)beforDelete 1.)Delete 2.)afterDelete --
	while($dataAllCategory=mysql_fetch_array($resultAllCategory))
	{
		$nowID = $dataAllCategory['main_ID'];
		if($idStatus==1)
		{
			$upSort = $dataAllCategory['main_sort']-1;
			$sqlUp = "UPDATE main_menu SET main_sort = $upSort WHERE main_ID = '$nowID'";
			mysql_query($sqlUp, $objCon) or die(mysql_error());
		}
		if($nowID==$mainID)
		{
			$idStatus=1;
		}
	}

	//---------- delete son menu -----------
	$sql = "SELECT Sub_ID FROM sub_menu WHERE Main_ID=".$mainID;
	$result = mysql_query($sql, $objCon) or die(mysql_error());
	while($data=mysql_fetch_array($result))
	{
		$DelSub = $data['Sub_ID'];
		$sqlDelSon = "DELETE FROM son_menu WHERE Sub_ID = $DelSub";
		mysql_query($sqlDelSon, $objCon) or die(mysql_error());
	}

	//---------- delete main menu -----------
	$strSQL = "DELETE FROM main_menu WHERE main_ID=".$mainID;
	mysql_query($strSQL, $objCon) or die(mysql_error());

	//---------- delete sub menu -----------
	$sqlDelSub = "DELETE FROM sub_menu WHERE Main_ID=".$mainID;
	mysql_query($sqlDelSub, $objCon) or die(mysql_error());

	//-------- close database ------
	mysql_close($objCon);
?>