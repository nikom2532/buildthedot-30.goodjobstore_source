<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$mainID = $_GET['mainID'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT main_ID,main_sort FROM main_menu ORDER BY main_sort";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
	
	while($data=mysql_fetch_array($result))
	{
		if ($data['main_ID']==$mainID)
		{
			$upSort = $data['main_sort']-1;
			$sqlUp = "UPDATE main_menu SET main_sort = $upSort WHERE main_ID = '$mainID'";
			mysql_query($sqlUp, $objCon) or die(mysql_error());
			
			$downSort = $data['main_sort'];
			$sqlDown = "UPDATE main_menu SET main_sort = $downSort WHERE main_ID = '$beforID'";
			mysql_query($sqlDown, $objCon) or die(mysql_error());
		}
		$beforID = $data['main_ID'];
	}
?>