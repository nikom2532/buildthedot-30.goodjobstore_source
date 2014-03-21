<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$proCode = $_GET['proCode'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sqlTest = "SELECT Product_Code,sort FROM product_groups ORDER BY sort";
	$resultTest = mysql_query($sqlTest, $objCon) or die(mysql_error());
	
	while($dataTest=mysql_fetch_array($resultTest))
	{
		if ($dataTest['Product_Code']==$proCode)
		{
			$upSort = $dataTest['sort']-1;
			$sqlUp = "UPDATE product_groups SET sort = $upSort WHERE Product_Code = '$proCode'";
			mysql_query($sqlUp, $objCon) or die(mysql_error());
			
			$downSort = $dataTest['sort'];
			$sqlDown = "UPDATE product_groups SET sort = $downSort WHERE Product_Code = '$beforCode'";
			mysql_query($sqlDown, $objCon) or die(mysql_error());
		}
		$beforCode = $dataTest['Product_Code'];
	}
?>