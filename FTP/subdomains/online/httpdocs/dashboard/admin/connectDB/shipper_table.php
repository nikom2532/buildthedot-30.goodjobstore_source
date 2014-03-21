<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM how_delivery";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>

	
	
	<table style="width:95%; border-collapse:collapse;">
		<tbody>
			<tr  style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
				<td>Shipper name [En]</td>
				<td>Shipper name [Th]</td>
				<td>Description [En]</td>
				<td>Description [Th]</td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?
			while ($data=mysql_fetch_array($result))
			{?>
				<tr>
					<td><?=$data['Name_En']?></td>
					<td><?=$data['Name_Th']?></td>
					<td><?=$data['Description_En']?></td>
					<td><?=$data['Description_Th']?></td>

					<td>
						<input type="button" value="Price" onclick="window.location.href='shipping.php?howID=<?=$data['How_ID']?>&nameEn=<?=$data['Name_En']?>'" style="width:60px">
					</td>
					<td>
						<input type="button" value="Edit" style="width:60px" 
						onclick="window.location.href='shipper_viewEdit.php?howID=<?=$data['How_ID']?>'">
					</td>
					<td><input type="button" value="Delete" onclick="deleteShipper(<?=$data['How_ID']?>);" style="width:60px"></td>
				</tr>
			<?}?>
		</tbody>
	</table>