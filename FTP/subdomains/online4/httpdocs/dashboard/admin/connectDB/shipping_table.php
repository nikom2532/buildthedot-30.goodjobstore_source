<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$howID = $_GET['howID'];
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM range_weight
			WHERE How_ID = '$howID'";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>

	
	
	<table style="width:60%; border-collapse:collapse;">
		<tbody>
			<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
				<td>Weight Start</td>
				<td>Weight End</td>
				<td>Price</td>
				<td></td>
				<td></td>
			</tr>
			<?
			while ($data=mysql_fetch_array($result))
			{?>
				<tr>
					<td style="text-align:center;"><?=$data['Weight_Start']?></td>
					<td style="text-align:center;"><?=$data['Weight_End']?></td>
					<td style="text-align:center;"><?=$data['Price']?></td>

					<td style="width:50px;">
						<input type="button" value="Edit" 
						onclick="window.location.href='shipping_viewEdit.php?rangeID=<?=$data['Range_ID']?>
								&howID=<?=$data['How_ID']?>
								&weightStart=<?=$data['Weight_Start']?>
								&weightEnd=<?=$data['Weight_End']?>
								&rangePrice=<?=$data['Price']?>'" 
						style="width:60px">
					</td>
					<td style="width:50px;"><input type="button" value="Delete" onclick="deleteShipping(<?=$data['Range_ID']?>);" style="width:60px"></td>
				</tr>
			<?}?>
		</tbody>
	</table>