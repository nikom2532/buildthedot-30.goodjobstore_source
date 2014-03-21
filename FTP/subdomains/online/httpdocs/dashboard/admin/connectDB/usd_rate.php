<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM usd_rate
			WHERE id = 1
			LIMIT 0,1";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>




<table style="width:60%; border-collapse:collapse;">
	<tbody>
		<form name='frmOptionPrice'>
			<?
			while ($data=mysql_fetch_array($result))
			{?>
				<tr>
					<td style="width:30%;">US$ 1</td>
					<td style="width:10px;"><img src="../images/dot.gif" /></td>
					<td style="width:20%;"><input type="text" name="changeRate" value="<?=$data['rate']?>"></td>
					<td><input type="button" value="Update" onclick="updateRate('<?=$data['id']?>');" style="width:60px"></td>
				</tr>
			<?}?>
		</form>
	</tbody>
</table>