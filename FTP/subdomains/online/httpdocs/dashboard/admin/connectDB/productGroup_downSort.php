<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$proCode = $_GET['proCode'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sqlTest = "SELECT Product_Code,sort FROM product_groups ORDER BY sort";
	$resultTest = mysql_query($sqlTest, $objCon) or die(mysql_error());
	
	$downStatus = 0; //--  downStatus 0.)beforDown 1.)down 2.)afterDown --
	while($dataTest=mysql_fetch_array($resultTest))
	{
		
		if ($downStatus==1)
		{
			$upCode = $dataTest['Product_Code'];
			$upSort = $dataTest['sort']-1;
			$sqlUp = "UPDATE product_groups SET sort = $upSort WHERE Product_Code = '$upCode'";
			mysql_query($sqlUp, $objCon) or die(mysql_error());
			$downStatus = 2;
		}
		if ($dataTest['Product_Code']==$proCode AND $downStatus==0)
		{
			$downSort = $dataTest['sort']+1;
			$sqlDown = "UPDATE product_groups SET sort = $downSort WHERE Product_Code = '$proCode'";
			mysql_query($sqlDown, $objCon) or die(mysql_error());
			$downStatus = 1;
		}
	}
?>