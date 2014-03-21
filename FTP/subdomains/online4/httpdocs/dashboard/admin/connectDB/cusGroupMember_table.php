<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$groupID = $_GET['groupID'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT customers.Cus_ID,Email,FirstName,LastName FROM customers JOIN group_item
			ON customers.Cus_ID = group_item.Cus_ID
			JOIN groups ON group_item.Group_ID = groups.Group_ID
			WHERE groups.Group_ID = $groupID
			ORDER BY Email";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>




<table style="width:75%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td style="text-align:center;">Customer ID</td>
			<td style="text-align:center;">Members</td>
			<td style="text-align:center;">Name</td>
			<td></td>
		</tr>
		<?
		while ($data=mysql_fetch_array($result))
		{?>
			<tr>
				<td style="text-align:center;"><?=$data['Cus_ID'];?></td>
				<td style="text-align:center;"><?=$data['Email'];?></td>
				<td style="text-align:center;"><?=$data['FirstName']?> <?=$data['LastName']?></td>
				<td><input type="button" value="Delete" onclick="deleteMember(<?=$groupID?>,'<?=$data['Cus_ID']?>');" style="width:60px"></td>
			</tr>
		<?}?>
	</tbody>
</table>






