<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM promotions";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>




<table style="width:95%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td style="width:25%; min-width:100px;">Name</td>
			<td style="width:45%; min-width:450px;">Promotion</td>
			<td style="width:15%; min-width:50px;">Enable</td>
			<td style="width:10%; min-width:50px;"></td>
			<td style="width:10%; min-width:50px;"></td>
		</tr>
		<?
		while ($data=mysql_fetch_array($result))
		{?>
			<tr>
				<td><?=$data['name']?></td>
				<td><img src="../../public/<?=$data['path']?>" style="width:90%"></td>
				<td style="text-align:center;">
					<input type="checkbox" name="change_proStatus" id="change_proStatus_<?=$data['id']?>" <?if($data['status']==1){?>checked<?}?> onclick="change_productStatus('<?=$data['id']?>');" value="1">
				</td>


<!--			<td><input type="button" value="Edit" onclick="editColor(<?=$data['Color_ID']?>);"></td>	-->
				<td><input type="button" value="Delete" onclick="deletePromotion(<?=$data['id']?>);"></td>
			</tr>
		<?}?>
	</tbody>
</table>