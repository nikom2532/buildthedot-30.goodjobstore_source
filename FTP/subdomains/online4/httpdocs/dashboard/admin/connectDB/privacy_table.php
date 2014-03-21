<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM employees";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>




<table style="width:85%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td style="width:20%">First name</td>
			<td style="width:20%">Last name</td>
			<td style="width:20%">Username</td>
			<td style="width:15%">Position</td>
			<td style="width:10%">
		</tr>
		<?
		while ($data=mysql_fetch_array($result))
		{?>
			<tr>
				<td><?=$data['FirstName']?></td>
				<td><?=$data['LastName']?></td>
				<td><?=$data['Email']?></td>
				<td style="text-align:center;">
					<select id="change_position_<?=$data['Emp_ID']?>">
						<option value='1' <?if($data['Position_ID']==1){?>selected<?}?>>Super Admin</option>
						<option value='2' <?if($data['Position_ID']==2){?>selected<?}?>>Admin</option>
						<option value='3' <?if($data['Position_ID']==3){?>selected<?}?>>General User</option>
					</select>
				</td>
				<td>
					<input type="button" value="Update" onclick="updatePrivacy('<?=$data['Emp_ID']?>');" style="width:60px">
				</td>
			</tr>
		<?}?>
	</tbody>
</table>