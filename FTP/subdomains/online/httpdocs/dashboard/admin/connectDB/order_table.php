<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

<?
	$filterStat = $_GET['filterStat'];
	$orderID = $_GET['orderID'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM orders
			WHERE Order_Status = 1";
	if ($filterStat!=0){
		$sql .= " AND status = $filterStat";}
	if ($orderID!=NULL){
		$sql .= " AND Order_ID LIKE '$orderID'";}
	$sql .= " ORDER BY created_at desc";

	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>




<table style="width:90%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td>Order</td>
			<td>Price</td>
			<td>Status</td> 
			<td <?if($filterStat==1 or $filterStat==2 or $filterStat==5){?>style="display:none;"<?}?>>Shipping number</td>
			<td></td>
			<td <?if($filterStat==1 or $filterStat==3 or $filterStat==4 or $filterStat==5){?>style="display:none;"<?}?>>Gen coupon</td>
			<td>Create</td>
		</tr>
		<form name="frmTableOrder">
			<?
			while ($data=mysql_fetch_array($result))
			{
				$orderID = $data['Order_ID'];
			?>
				<tr>
					<td style="text-align:center;">
						<a href="order_detail.php?orderID=<?=$data['Order_ID']?>&cusID=<?=$data['Cus_ID']?>">
						<?=$data['Order_ID']?></a></td>
					<td style="text-align:right;"><?=$data['Final_Price']?></td>
					<td style="text-align:center;">
						<select name="change_status" id="change_status_<?=$data['Order_ID']?>" 
						onchange="showMe('<?=$data['Order_ID']?>','ship_num_<?=$data['Order_ID']?>', this)">
							<option value="1" <?if($data['status']==1){?>selected<?}?>>Pending</option>
							<option value="2" <?if($data['status']==2){?>selected<?}?>>Payment Received</option>
							<option value="3" <?if($data['status']==3){?>selected<?}?>>Shipped</option>
							<option value="4" <?if($data['status']==4){?>selected<?}?>>Refund</option>
							<option value="5" <?if($data['status']==5){?>selected<?}?>>Cancel</option>
						</select>
					</td>
					<td style="text-align:center; <?if($filterStat==1 or $filterStat==2 or $filterStat==5){?>display:none;<?}?>">
						<input type="text" id="ship_num_<?=$data['Order_ID']?>" name="ship_num" value="<?=$data['shipping_number']?>"
							<?if($data['status']==1 or $data['status']==2 or $data['status']==5){?>style="display:none;"<?}?>
						>
					</td>
					<td>
						<input type="button" value="Update" onclick="updateOrder('<?=$data['Order_ID']?>',<?=$filterStat?>,<?=$data['status']?>);" style="width:60px">
					</td>
					<td <?if($filterStat==1 or $filterStat==3 or $filterStat==4 or $filterStat==5){?>style="display:none"<?}?>>
						<input type="button" id="gen_coupon_<?=$data['Order_ID']?>" value="gen coupon" 
						onclick="window.location.href='coupon.php?cusID=<?=$data['Cus_ID']?>'" 
						style="width:80px;
							<?if($data['status']!=2){?>display:display;<?}?>
						">
					</td>
					<td><?=$data['created_at']?></td>
				</tr>
			<?}?>
		</form>
	</tbody>
</table>