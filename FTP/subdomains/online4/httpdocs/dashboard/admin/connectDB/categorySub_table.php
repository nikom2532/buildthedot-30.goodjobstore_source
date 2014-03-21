<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$mainID = $_GET['mainID'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM sub_menu WHERE Main_ID = '$mainID' ORDER BY sub_sort";
	$result = mysql_query($sql, $objCon) or die(mysql_error());

	//-- check row --
	$dataRow = mysql_num_rows($result);
	$row = 1;
?>




<table style="width:95%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td>No.</td>
			<td>Sub [En]</td>
			<td>Sub [Th]</td>
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
			<tr style="height:20px;">
				<td style="text-align:center;">
					<? $number = ($data['sub_sort']*10)%10;
					echo $number;?>
				</td>
				<td><?=$data['Name_En']?></td>
				<td><?=$data['Name_Th']?></td>
				<td><?=$data['sub_url']?></td>
				<td>
					<?if($row!=1){?>
						<input type="button" value="Up" style="width:50px;" onclick="upSubSort('<?=$data['Sub_ID']?>','<?=$data['Main_ID']?>');">
					<?}?>
				</td>
				<td>
					<?if($row!=$dataRow){?>
						<input type="button" value="Down" style="width:50px;" onclick="downSubSort('<?=$data['Sub_ID']?>','<?=$data['Main_ID']?>');">
					<?}?>
				</td>
				<td>
					<input type="button" value="Son Category" onclick="window.location.href='categorySon.php?subID=<?=$data['Sub_ID']?>&mainID=<?=$mainID?>'" style="width:100px">
				</td>
				<td>
					<input type="button" value="Edit" 
					onclick="window.location.href='categorySub_viewEdit.php?mainID=<?=$mainID?>&subID=<?=$data['Sub_ID']?>'" 
					style="width:60px">
				</td>
				<td><input type="button" value="Delete" onclick="deleteCategorySub(<?=$data['Main_ID']?>,<?=$data['Sub_ID']?>);" style="width:60px"></td>
			</tr>
		<?$row+=1;
		}?>
	</tbody>
</table>