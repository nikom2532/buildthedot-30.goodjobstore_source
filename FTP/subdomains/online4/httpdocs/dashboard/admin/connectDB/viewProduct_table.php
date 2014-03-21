<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
		});
	</script>
<?
	$proCode = $_GET['proCode'];
	$propertyName = $_GET['propertyName'];

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT products.Product_ID, products.Product_Code, Property_Name, Thumbnail_path, Pro_Name_En, Price_Buy, Price_sale, Qty,			property.name_en
			FROM products JOIN images ON products.Product_ID = images.Product_ID
			JOIN property ON products.Property_ID = property.prop_id
			WHERE products.Product_Code = '$proCode' 
			GROUP BY products.Product_ID
			ORDER BY products.Product_Code";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>

																<div style="width: 790px; height: 350px; overflow: auto; padding: 5px">

	
<table style="width:95%; border-collapse:collapse;">
									<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
										<td>Product Code</td>
										<td>Images</td>
										<td>Name</td>
										<td>Property</td>
										<td>Price</td>
										<td>Price Sale</td>
										<td>Quantity</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>

									<?while ($data=mysql_fetch_array($result))
									{?>	
										<tr>
											<td style="text-align:center;"><?=$data['Product_Code']?></td>
											<td style="text-align:center;"><img src="../../public/<?=$data['Thumbnail_path']?>"></td>
											<td style="text-align:center;"><?=$data['Pro_Name_En']?></td>
											<td style="text-align:center;"><?=$data['name_en']?></td>
											<td style="text-align:right;"><?=$data['Price_Buy']?></td>
											<td style="text-align:right;"><?=$data['Price_sale']?></td>
											<td style="text-align:center;"><?=$data['Qty']?></td>
											<td>
												<input type="button" value="Description" style="width:75px;"
														onclick="window.location.href='product_viewEditDescrip.php?productID=<?=$data['Product_ID']?>&proCode=<?=$proCode?>'">
											</td>
											<td>
												<input type="button" value="Images" style="width:60px;"
														onclick="window.location.href='product_viewEditImage.php?productID=<?=$data['Product_ID']?>&proCode=<?=$proCode?>
														&propertyName=<?=$data['Property_Name']?>'">
											</td>
<!--										<td>
												<input type="button" value="Property" style="width:60px;"
														onclick="window.location.href='product_insertPropertyImg.php?genProID=<?=$data['Product_ID']?>&proCode=<?=$proCode?>&propertyName=<?=$data['Property_Name']?>'">
											</td>
-->											<td>
												<input type="button" value="Delete" style="width:60px;" onclick="deleteProduct('<?=$data['Product_ID']?>','<?=$proCode?>')" >
											</td>
										</tr>
									<?}?>
								</table>