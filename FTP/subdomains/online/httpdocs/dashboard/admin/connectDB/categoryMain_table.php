<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM main_menu ORDER BY main_sort";
	$result = mysql_query($sql, $objCon) or die(mysql_error());

	//-- check row --
	$dataRow = mysql_num_rows($result);
	$row = 1;
?>




<table style="width:95%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td>No.</td>
			<td>Main [En]</td>
			<td>Main [Th]</td>
			<td>Url</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?
		while ($data=mysql_fetch_array($result))
		{?>
			<tr>
				<td style="text-align:center;"><?=$data['main_sort']?></td>
				<td><?=$data['Name_En']?></td>
				<td><?=$data['Name_Th']?></td>
				<td><?=$data['main_url']?></td>
				<td>
					<?if($row!=1){?>
						<input type="button" value="Up" style="width:50px;" onclick="upMainSort('<?=$data['main_ID']?>');">
					<?}?>
				</td>
				<td>
					<?if($row!=$dataRow){?>
						<input type="button" value="Down" style="width:50px;" onclick="downMainSort('<?=$data['main_ID']?>');">
					<?}?>
				</td>		
				<td>
					<input type="button" value="Sub Category" onclick="window.location.href='categorySub.php?mainID=<?=$data['main_ID']?>'" style="width:100px">
				</td>
				<td>
					<input type="button" value="Edit" 
					onclick="window.location.href='categoryMain_viewEdit.php?mainID=<?=$data['main_ID']?>'" 
					style="width:60px">
				</td>
				<td><input type="button" value="Delete" onclick="deleteCategoryMain(<?=$data['main_ID']?>);" style="width:60px"></td>
			</tr>
		<?$row+=1;
		}?>
	</tbody>
</table>