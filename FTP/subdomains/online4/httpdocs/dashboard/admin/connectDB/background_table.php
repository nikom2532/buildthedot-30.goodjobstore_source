<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM background";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>




<table style="width:60%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td>Banner</td>
			<td>Enable</td>
			<td></td>
		</tr>
		<?
		while ($data=mysql_fetch_array($result))
		{?>
			<tr>
				<td align="center"><img src="../../public/<?=$data['path']?>" style="height:120px;"></td>
				<td style="text-align:center;">
					<input type="checkbox" id="change_status_<?=$data['id']?>" <?if($data['status']==1){?>checked<?}?> value="1" onclick="changeStatus('<?=$data['id']?>');" >
				</td>
				<td><input type="button" value="Delete" style="width:60px;" onclick="deleteBackground('<?=$data['id']?>');"></td>
			</tr>
		<?}?>
	</tbody>
</table>