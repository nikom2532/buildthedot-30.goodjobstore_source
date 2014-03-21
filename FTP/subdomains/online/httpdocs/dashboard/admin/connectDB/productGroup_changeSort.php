<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$proCode = $_GET["proCode"];
	$changeNum = $_GET["changeNum"];
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	//-- check sort up or down --
	$sqlCheckSort = "SELECT sort FROM product_groups WHERE Product_Code = $proCode";
	$resultCheckSort = mysql_query($sqlCheckSort, $objCon) or die(mysql_error());
	while($dataCheckSort=mysql_fetch_array($resultCheckSort))
	{
		$selectSort = $dataCheckSort['sort'];
	}
	
	//-- change sort down --
	if($changeNum > $selectSort)
	{
		$sqlAllGroup = "SELECT Product_Code,sort FROM product_groups ORDER BY sort";
		$resultAllGroup = mysql_query($sqlAllGroup, $objCon) or die(mysql_error());

		$codeStatus = 0; //--  codeStatus 0.)beforChange 1.)selectChange 2.)Change 3.)afterChange --
		while($dataAllGroup=mysql_fetch_array($resultAllGroup))
		{
			$nowProCode = $dataAllGroup['Product_Code'];
			$nowSort = $dataAllGroup['sort'];
			if($codeStatus==1)
			{
				$upSort = $dataAllGroup['sort']-1;
				$sqlUp = "UPDATE product_groups SET sort = $upSort WHERE Product_Code = '$nowProCode'";
				mysql_query($sqlUp, $objCon) or die(mysql_error());
			}
			if($nowProCode==$proCode)
			{
				$codeStatus=1;
			}
			if($nowSort==$changeNum)
			{
				$codeStatus=2;
			}
		}
		$sqlChangeDown = "UPDATE product_groups SET sort = $changeNum WHERE Product_Code = '$proCode'";
		mysql_query($sqlChangeDown, $objCon) or die(mysql_error());
	}
	//-- change sort up --
	else if ($changeNum < $selectSort)
	{
		$sqlAllGroup = "SELECT Product_Code,sort FROM product_groups ORDER BY sort DESC";
		$resultAllGroup = mysql_query($sqlAllGroup, $objCon) or die(mysql_error());
		
		$codeStatus = 0; //--  codeStatus 0.)beforChange 1.)selectChange 2.)Change 3.)afterChange --
		while($dataAllGroup=mysql_fetch_array($resultAllGroup))
		{
			$nowProCode = $dataAllGroup['Product_Code'];
			$nowSort = $dataAllGroup['sort'];
			if($codeStatus==1)
			{
				$upSort = $dataAllGroup['sort']+1;
				$sqlUp = "UPDATE product_groups SET sort = $upSort WHERE Product_Code = '$nowProCode'";
				mysql_query($sqlUp, $objCon) or die(mysql_error());
			}
			if($nowProCode==$proCode)
			{
				$codeStatus=1;
			}
			if($nowSort==$changeNum)
			{
				$codeStatus=2;
			}
		}
		$sqlChangeDown = "UPDATE product_groups SET sort = $changeNum WHERE Product_Code = '$proCode'";
		mysql_query($sqlChangeDown, $objCon) or die(mysql_error());
	}
	/*
	//-- reset sort --
	$sqlAllGroup = "SELECT Product_Code,sort FROM product_groups ORDER BY sort";
	$resultAllGroup = mysql_query($sqlAllGroup, $objCon) or die(mysql_error());

	$codeStatus = 0; //--  codeStatus 0.)beforDelete 1.)Delete 2.)afterDelete --
	while($dataAllGroup=mysql_fetch_array($resultAllGroup))
	{
		$nowProCode = $dataAllGroup['Product_Code'];
		if($codeStatus==1)
		{
			$upSort = $dataAllGroup['sort']-1;
			$sqlUp = "UPDATE product_groups SET sort = $upSort WHERE Product_Code = '$nowProCode'";
			mysql_query($sqlUp, $objCon) or die(mysql_error());
		}
		if($nowProCode==$proCode)
		{
			$codeStatus=1;
		}
	}*/

	//-- close database --
	mysql_close($objCon);
?>