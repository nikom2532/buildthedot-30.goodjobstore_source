<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$mainID = $_GET['mainID'];
	$subID = $_GET['subID'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT Sub_ID,sub_sort FROM sub_menu WHERE Main_ID = $mainID ORDER BY sub_sort";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
	
	while($data=mysql_fetch_array($result))
	{
		if ($data['Sub_ID']==$subID)
		{
			$upSort = $data['sub_sort']-0.1;
			$sqlUp = "UPDATE sub_menu SET sub_sort = $upSort WHERE Sub_ID = '$subID'";
			mysql_query($sqlUp, $objCon) or die(mysql_error());
			
			$downSort = $data['sub_sort'];
			$sqlDown = "UPDATE sub_menu SET sub_sort = $downSort WHERE Sub_ID = '$beforID'";
			mysql_query($sqlDown, $objCon) or die(mysql_error());
		}
		$beforID = $data['Sub_ID'];
	}
?>