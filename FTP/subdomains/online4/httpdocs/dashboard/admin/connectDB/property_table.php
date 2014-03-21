<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM property ORDER BY name_en";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>

<table style="width:60%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td>Property [En]</td>
			<td>Property [Th]</td>
			<td></td>
			<td></td>
		</tr>
		<?
		while ($data=mysql_fetch_array($result))
		{?>
			<tr>
				<td style="text-align:center;"><?=$data['name_en']?></td>
				<td style="text-align:center;"><?=$data['name_th']?></td>
				<td>
					<input type="button" value="Edit" 
					onclick="window.location.href='property_viewEdit.php?propID=<?=$data['prop_id']?>
					&nameEN=<?=$data['name_en']?>
					&nameTH=<?=$data['name_th']?>'" 
					style="width:60px">
				</td>
				<td><input type="button" value="Delete" onclick="deleteProperty(<?=$data['prop_id']?>);" style="width:60px"></td>
			</tr>
		<?}?>
	</tbody>
</table>