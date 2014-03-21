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

	//---- Delete All from hot_sale ----
	$sqlDelAll = "DELETE FROM hot_sale";
	mysql_query($sqlDelAll, $objCon) or die(mysql_error());
	
	$sqlProduct = "SELECT Product_ID,products.Product_Code,property.name_en,Group_Name_En,Price_Buy,Price_sale 
					FROM products JOIN product_groups ON products.Product_Code = product_groups.Product_Code
					JOIN property ON products.Property_ID = property.prop_id";
	$resultProduct = mysql_query($sqlProduct, $objCon) or die(mysql_error());

		while ($dataProduct=mysql_fetch_array($resultProduct))
		{
			$productID = $dataProduct['Product_ID'];
			$productCode = $dataProduct['Product_Code'];
			$productProperty = $dataProduct['name_en'];
			$productName = $dataProduct['Group_Name_En'];
			$productQty = 0;
			$productPrice = $dataProduct['Price_Buy'];
			$productPriceDiscount = $dataProduct['Price_sale'];
			
			$sqlQty = "SELECT order_item.Qty FROM order_item JOIN orders
						ON order_item.Order_ID = orders.Order_ID
						WHERE order_item.Product_ID = '$productID'
						AND (orders.status=2 OR orders.status=3)
						ORDER BY Product_ID";
			$resultQty = mysql_query($sqlQty, $objCon) or die(mysql_error());
			while ($dataQty=mysql_fetch_array($resultQty))
			{
				$productQty += $dataQty['Qty'];
			}

			//----------- Add hot_sale table -----------
			$sqlInsert =  "INSERT INTO hot_sale (Product_ID,Product_Code,Pro_Name_En,Property_Name,Price,Discount,Qty) 
							VALUES ('".$productID."','".$productCode."','".$productName."','".$productProperty."','".$productPrice."','".$productPriceDiscount."','".$productQty."')";
			mysql_query($sqlInsert, $objCon) or die(mysql_error());
		}

		$sqlHot = "SELECT * FROM hot_sale
					ORDER BY Qty Desc, Product_Code,Property_Name";
		$resultHot = mysql_query($sqlHot, $objCon) or die(mysql_error());
?>


<div style="text-align:left;">
		<input type="button" style="width:100px;" value="Export to excel" onclick="window.location.href='report_export.php?fn=hotSale_report'">
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
		<?	$i=0;
		while($dataHot=mysql_fetch_array($resultHot))
		{?>
			<tr style="height:20px;">
				<td style="text-align:center;"><?=$dataHot['Product_Code']?></td>
					<?$_SESSION['report_values'][$i][0]=$dataHot['Product_Code'];?>
				<td style="text-align:center;"><?=$dataHot['Pro_Name_En']?></td>
					<?$_SESSION['report_values'][$i][1]=$dataHot['Pro_Name_En'];?>
				<td style="text-align:center;"><?=$dataHot['Property_Name']?></td>
					<?$_SESSION['report_values'][$i][2]=$dataHot['Property_Name'];?>
				<td style="text-align:right;"><?=$dataHot['Price']?></td>
					<?$_SESSION['report_values'][$i][3]=$dataHot['Price'];?>
				<td style="text-align:right;"><?=$dataHot['Discount']?></td>
					<?$_SESSION['report_values'][$i][4]=$dataHot['Discount'];?>
				<td style="text-align:center;"><?=$dataHot['Qty']?></td>
					<?$_SESSION['report_values'][$i][5]=$dataHot['Qty'];?>
			</tr>
		<?	$i++;
		}?>
	</tbody>
</table>
<br>