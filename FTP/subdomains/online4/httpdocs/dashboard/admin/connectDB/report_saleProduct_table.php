<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

<?
	//-- session for export to excel --
	session_start(); 
	unset($_SESSION['report_header']);
	unset($_SESSION['report_values']);
	$_SESSION['report_header']=array("Code","Name","Property","Price","DiscountPrice","Qty."); 

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);
	
	$sqlProduct = "SELECT Product_ID,products.Product_Code,property.name_en,Group_Name_En,Price_Buy,Price_sale 
					FROM products JOIN product_groups ON products.Product_Code = product_groups.Product_Code
					JOIN property ON products.Property_ID = property.prop_id
					ORDER BY products.Product_Code,property.name_en";
	$resultProduct = mysql_query($sqlProduct, $objCon) or die(mysql_error());
?>

<div style="text-align:left;">
		<input type="button" style="width:100px;" value="Export to excel" onclick="window.location.href='report_export.php?fn=sale_report'">
	<div id="line"></div>
	<br><br><br>
</div>

<table style="width:80%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td>Code</td>
			<td>Name</td>
			<td>Property</td>
			<td>Price</td>
			<td>Discount Price</td>
			<td>Sale Qty.</td>
		</tr>
		<form name="frmTableOrder">
			<?
				$i=0;
			while ($dataProduct=mysql_fetch_array($resultProduct))
			{
				$productID = $dataProduct['Product_ID'];
				$productCode = $dataProduct['Product_Code'];
					$_SESSION['report_values'][$i][0]=$productCode;
				$productName = $dataProduct['Group_Name_En'];
					$_SESSION['report_values'][$i][1]=$productName;
				$productProperty = $dataProduct['name_en'];
					$_SESSION['report_values'][$i][2]=$productProperty;
				$productPrice = $dataProduct['Price_Buy'];
					$_SESSION['report_values'][$i][3]=$productPrice;
				$productPriceDiscount = $dataProduct['Price_sale'];
					$_SESSION['report_values'][$i][4]=$productPriceDiscount;
				$productQty = 0;
			?>
				<?
				$sqlSale = "SELECT order_item.Qty FROM order_item JOIN orders
							ON order_item.Order_ID = orders.Order_ID
							WHERE order_item.Product_ID = '$productID'
							AND (orders.status=2 OR orders.status=3)
							ORDER BY Product_ID";
				$resultSale = mysql_query($sqlSale, $objCon) or die(mysql_error());
				while ($dataSale=mysql_fetch_array($resultSale))
				{
					$productQty += $dataSale['Qty'];
				}?>
					<tr style="height:20px;">
						<td style="text-align:center;"><?=$productCode?></td>
						<td style="text-align:center;"><?=$productName?></td>
						<td style="text-align:center;"><?=$productProperty?></td>
						<td style="text-align:right;"><?=$productPrice?></td>
						<td style="text-align:right;"><?=$productPriceDiscount?></td>
						<td style="text-align:center;"><?=$productQty?></td>
					</tr>
			<?
				$_SESSION['report_values'][$i][5]=(string)$productQty;
				$i++;
			}?>
		</form>
	</tbody>
</table>
<br>