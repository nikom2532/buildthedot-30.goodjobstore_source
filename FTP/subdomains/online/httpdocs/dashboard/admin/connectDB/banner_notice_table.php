<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM banner_notice ORDER BY id DESC";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>




<table style="width:95%; border-collapse:collapse; align:center;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td style="width:75%;">Notice Banner</td>
			<td style="width:10%;">Enable</td>
			<td style="width:10%;"></td>
		</tr>
		<?
		while ($data=mysql_fetch_array($result))
		{?>
			<tr align="center">
				<td><img src="../../public/<?=$data['path']?>" style="width:95%;"></td>
				<td style="text-align:center;">
					<input type="checkbox" name="change_proStatus" id="change_proStatus_<?=$data['id']?>" <?if($data['status']==1){?>checked<?}?> onclick="change_productStatus('<?=$data['id']?>');" value="1">
				</td>
				<td><input type="button" style="width:60px;" value="Delete" onclick="deleteBanner('<?=$data['id']?>');"></td>
			</tr>
		<?}?>
	</tbody>
</table>