<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<?
	$proSearch = $_GET['proSearch'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT Product_Code,Group_Name_En,Group_Status,sort FROM product_groups";
	if($proSearch!=NULL){
		$sql .= " WHERE (Product_Code LIKE '%$proSearch%') OR (Group_Name_En LIKE '%$proSearch%')";}
	$sql .=	" ORDER BY sort";
	$result = mysql_query($sql, $objCon) or die(mysql_error());

	//-- check row --
	$dataRow = mysql_num_rows($result);
	$row = 1;
?>
							
	<table style="width:95%; border-collapse:collapse;">
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td>No.</td>
			<td>Product Code</td>
			<td>Image</td>
			<td>Product Name</td>
			<td>Public</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<?while ($data=mysql_fetch_array($result))
		{	$proCodeImg = $data['Product_Code'];
		?>	
			<tr>
				<td style="text-align:center;">
					<input type="text" id="number_<?=$data['Product_Code']?>" style="width:30px;" onKeyPress="javascript:if(event.keyCode==13)changeNumber('<?=$data['Product_Code']?>',<?=$dataRow?>);" value="<?=$data['sort']?>">
				</td>
				<td style="text-align:center;"><?=$data['Product_Code']?></td>
				<td style="text-align:center;">
				<?
				$sqlImg = "SELECT images.Thumbnail_path FROM product_groups
							JOIN products ON product_groups.Product_Code = products.Product_Code
							JOIN images ON products.Product_ID = images.Product_ID
							WHERE product_groups.Product_Code = '$proCodeImg'
							AND primary_product = 1
							ORDER BY images.Level
							LIMIT 1";
				$resultImg = mysql_query($sqlImg, $objCon) or die(mysql_error());
				while ($dataImg=mysql_fetch_array($resultImg))
				{?>
					<img src="../../public/<?=$dataImg['Thumbnail_path']?>">
				<?}?>

				</td>
				<td style="text-align:center;"><?=$data['Group_Name_En']?></td>
				<td style="text-align:center;">
					<input type="checkbox" name="change_proStatus" id="change_proStatus_<?=$data['Product_Code']?>" <?if($data['Group_Status']==1){?>checked<?}?> onclick="change_productStatus('<?=$data['Product_Code']?>');" value="1">
				</td>
			<!-- button -->
				<td>
					<?if($row!=1){?>
						<input type="button" value="Up" style="width:50px;" onclick="upSort('<?=$data['Product_Code']?>');">
					<?}?>
				</td>
				<td>
					<?if($row!=$dataRow){?>
						<input type="button" value="Down" style="width:50px;" onclick="downSort('<?=$data['Product_Code']?>')">
					<?}?>
				</td>
				<td>
					<input type="button" value="Products" style="width:65px;"
							onclick="window.location.href='viewProduct.php?proCode=<?=$data['Product_Code']?>'">
				</td>
				<td>
					<input type="button" value="Cross & Category" style="width:120px;"
							onclick="window.location.href='productGroup_viewCatAndCross.php?proCode=<?=$data['Product_Code']?>'">
				</td>
				<td>
					<input type="button" value="Description" style="width:75px;"
							onclick="window.location.href='productGroup_viewEditDescrip.php?proCode=<?=$data['Product_Code']?>'">
				</td>
				<td>
					<input type="button" value="Delete" onclick="deleteProductGroup('<?=$data['Product_Code']?>')" style="width:60px;">
				</td>
			<!-- end button -->
			</tr>
		<?$row+=1;
		}?>
	</table>
</div>