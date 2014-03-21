<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);		
	
	//----- Color -----
	$sqlColor = "SELECT * FROM color";
	$resultColor = mysql_query($sqlColor, $objCon) or die(mysql_error());
?>


<select name="selectColor">
	<option value=""><-- Please Select Color --></option>
	<?
	while ($data=mysql_fetch_array($resultColor))
	{?>
		<option value="<?=$data['Color_ID']?>"><?=$data['Name_EN']?></option>
	<?}?>
</select>