<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM groups ORDER BY Name";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>




<table style="width:50%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td>Group Name</td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?
		while ($data=mysql_fetch_array($result))
		{?>
			<tr>
				<td style="text-align:center;"><?=$data['Name']?></td>
				<td>
					<input type="button" value="Member" 
					onclick="window.location.href='cusGroup_member.php?groupID=<?=$data['Group_ID']?>&groupName=<?=$data['Name']?>'"
					style="width:60px">
				</td>
				<td>
					<input type="button" value="Edit" 
					onclick="window.location.href='cusGroup_viewEdit.php?groupID=<?=$data['Group_ID']?>&groupName=<?=$data['Name']?>'"
					style="width:60px"></td>
				<td><input type="button" value="Delete" onclick="deleteGroup(<?=$data['Group_ID']?>);" style="width:60px"></td>
			</tr>
		<?}?>
	</tbody>
</table>