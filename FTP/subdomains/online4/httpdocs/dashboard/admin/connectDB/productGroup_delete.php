<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$proCode = $_GET["proCode"];
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

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
	}

//-- delete from all table about product --
	$sqlDelProGroup = "DELETE FROM product_groups WHERE Product_Code='".$proCode."'";
	mysql_query($sqlDelProGroup, $objCon) or die(mysql_error());

	$sqlDelPro = "DELETE FROM products WHERE Product_Code='".$proCode."'";
	mysql_query($sqlDelPro, $objCon) or die(mysql_error());

	$sqlDelImage = "DELETE FROM images WHERE Product_Code='".$proCode."'";
	mysql_query($sqlDelImage, $objCon) or die(mysql_error());

	$sqlDelCross = "DELETE FROM cross_sale WHERE Product_Code='".$proCode."'";
	mysql_query($sqlDelCross, $objCon) or die(mysql_error());

	$sqlDelCat = "DELETE FROM category_products WHERE Product_Code='".$proCode."'";
	mysql_query($sqlDelCat, $objCon) or die(mysql_error());

	mysql_close($objCon);
?>