<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM payments";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>

	
	
	<table style="width:95%; border-collapse:collapse;">
		<tbody>
			<tr  style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
				<td>Payment name [En]</td>
				<td>Payment name [Th]</td>
				<td>Description [En]</td>
				<td>Description [Th]</td>
				<td></td>
				<td></td>
			</tr>
			<? $i=1;
			while ($data=mysql_fetch_array($result))
			{?>
				<?=($i%2==1)?'<tr style="background-color:#DDDDDD;">':'<tr style="background-color:#EEEEEE;">'?>
					<td><?=$data['name_en']?></td>
					<td><?=$data['name_th']?></td>
					<td><?=$data['description_en']?></td>
					<td><?=$data['description_th']?></td>

					<td>
					<input type="button" value="Edit" style="width:60px" 
						onclick="window.location.href='payment_viewEdit.php?paymentID=<?=$data['id']?>'">
					</td>
					<td><input type="button" value="Delete" onclick="deletePayment(<?=$data['id']?>);" style="width:60px"></td>
				</tr>
			<? $i++;
			}?>
		</tbody>
	</table>