<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$proCode = $_GET["proCode"];
	$proCross1 = $_GET["proCross1"];
	$proCross2 = $_GET["proCross2"];
	$proCross3 = $_GET["proCross3"];
	$proCross4 = $_GET["proCross4"];
	echo $proCode."<BR>";
	echo $proCross1."<BR>";
	echo $proCross2."<BR>";
	echo $proCross3."<BR>";
	echo $proCross4."<BR>";

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);
	
//********************** sql Edit Cross Sale *********************

	$sqlCrossCode = "SELECT * FROM cross_sale JOIN product_groups 
					ON cross_sale.Product_Code = product_groups.Product_Code
					WHERE product_groups.Product_Code =  '$proCode'
					ORDER BY cross_sale.Product_Cross_Code";
	$resultCrossCode = mysql_query($sqlCrossCode, $objCon) or die(mysql_error());

	$i=0;
	while ($dataCrossCode=mysql_fetch_array($resultCrossCode))
	{$i++;
		if($i==1){
		$crossID1 = $dataCrossCode['Cross_ID'];}
		else if($i==2){
		$crossID2 = $dataCrossCode['Cross_ID'];}
		else if($i==3){
		$crossID3 = $dataCrossCode['Cross_ID'];}
		else if($i==4){
		$crossID4 = $dataCrossCode['Cross_ID'];}
	}

if($i>=1)
{
	//------------------ cross 1 -------------------
	if($proCross1!=NULL)
	{
		$sqlAddCross1 = "UPDATE cross_sale SET Product_Code='$proCode',Product_Cross_Code='$proCross1' WHERE Cross_ID='$crossID1'";
		mysql_query($sqlAddCross1, $objCon) or die(mysql_error());
echo '1<br>';
	}
	else
	{
		$sqlDeleteCross1 = "DELETE FROM cross_sale WHERE Cross_ID='$crossID1'";
		mysql_query($sqlDeleteCross1, $objCon) or die(mysql_error());
echo '2<br>';
	}
	
	if($i>=2)
	{
		//------------------ cross 2 -------------------
		if($proCross2!=NULL)
		{
			$sqlAddCross2 = "UPDATE cross_sale SET Product_Code='$proCode',Product_Cross_Code='$proCross2' WHERE Cross_ID='$crossID2'";
			mysql_query($sqlAddCross2, $objCon) or die(mysql_error());
echo '3<br>';
		}
		else
		{
			$sqlDeleteCross2 = "DELETE FROM cross_sale WHERE Cross_ID='$crossID2'";
			mysql_query($sqlDeleteCross2, $objCon) or die(mysql_error());
echo '4<br>';
		}
		
		if($i>=3)
		{
			//------------------ cross 3 -------------------
			if($proCross3!=NULL)
			{
				$sqlAddCross3 = "UPDATE cross_sale SET Product_Code='$proCode',Product_Cross_Code='$proCross3' WHERE Cross_ID='$crossID3'";
				mysql_query($sqlAddCross3, $objCon) or die(mysql_error());
echo '5<br>';
			}
			else
			{
				$sqlDeleteCross3 = "DELETE FROM cross_sale WHERE Cross_ID='$crossID3'";
				mysql_query($sqlDeleteCross3, $objCon) or die(mysql_error());
echo '6<br>';
			}
			
			if($i>=4)
			{
				//------------------ cross 4 -------------------
				if($proCross4!=NULL)
				{
					$sqlAddCross4 = "UPDATE cross_sale SET Product_Code='$proCode',Product_Cross_Code='$proCross4' WHERE Cross_ID='$crossID4'";
					mysql_query($sqlAddCross4, $objCon) or die(mysql_error());
echo '7<br>';
				}
				else
				{
					$sqlDeleteCross4 = "DELETE FROM cross_sale WHERE Cross_ID='$crossID4'";
					mysql_query($sqlDeleteCross4, $objCon) or die(mysql_error());
echo '8<br>';
				}
			}
		}
	}
}

if($i!=4)
{
	if($proCross4!=NULL)
	{
		$sqlAddCross4 = "INSERT INTO cross_sale (Product_Code,Product_Cross_Code) VALUE ('".$proCode."','".$proCross4."')";
		mysql_query($sqlAddCross4, $objCon) or die(mysql_error());
echo '9<br>';
	}
	if($i!=3)
	{
		if($proCross3!=NULL)
		{
			$sqlAddCross3 = "INSERT INTO cross_sale (Product_Code,Product_Cross_Code) VALUE ('".$proCode."','".$proCross3."')";
			mysql_query($sqlAddCross3, $objCon) or die(mysql_error());
echo '10<br>';
		}
		if($i!=2)
		{
			if($proCross2!=NULL)
			{
				$sqlAddCross2 = "INSERT INTO cross_sale (Product_Code,Product_Cross_Code) VALUE ('".$proCode."','".$proCross2."')";
				mysql_query($sqlAddCross2, $objCon) or die(mysql_error());
echo '11<br>';
			}
			if($i!=1 && $proCross1!=NULL)
			{
				$sqlAddCross1 = "INSERT INTO cross_sale (Product_Code,Product_Cross_Code) VALUE ('".$proCode."','".$proCross1."')";
				mysql_query($sqlAddCross1, $objCon) or die(mysql_error());
echo '12<br>';
			}
		}
	}
}


//*************** Close Database ****************
	mysql_close($objCon);
?>
