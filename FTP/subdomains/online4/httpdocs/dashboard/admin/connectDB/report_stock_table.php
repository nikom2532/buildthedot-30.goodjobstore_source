<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>

<?
	//-- session for export to excel --
	session_start(); 
	unset($_SESSION['report_header']);
	unset($_SESSION['report_values']);
	$_SESSION['report_header']=array("Code","Name","Property","Qty."); 

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sqlStock = "SELECT products.Product_Code,product_groups.Group_Name_En,property.name_en,products.Qty 
				FROM products JOIN product_groups ON products.Product_Code = product_groups.Product_Code
				JOIN property ON products.Property_ID = property.prop_id
				ORDER BY Qty";
	$resultStock = mysql_query($sqlStock, $objCon) or die(mysql_error());
?>

<div style="text-align:left;">
		<input type="button" style="width:100px;" value="Export to excel" onclick="window.location.href='report_export.php?fn=stock_report'">
	<div id="line"></div>
	<br><br><br>
</div>

<table style="width:80%; border-collapse:collapse;">
	<tbody>
		<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
			<td>Code</td>
			<td>Name</td>
			<td>Property</td>
			<td>Qty.</td>
		</tr>
		<form name="frmTableOrder">
			<?
				$i=0;
			while ($dataStock=mysql_fetch_array($resultStock))
			{?>
				<tr style="height:20px;">
					<td style="text-align:center;"><?=$dataStock['Product_Code']?></td>
						<?$_SESSION['report_values'][$i][0]=$dataStock['Product_Code'];?>
					<td style="text-align:center;"><?=$dataStock['Group_Name_En']?></td>
						<?$_SESSION['report_values'][$i][1]=$dataStock['Group_Name_En'];?>
					<td style="text-align:center;"><?=$dataStock['name_en']?></td>
						<?$_SESSION['report_values'][$i][2]=$dataStock['name_en'];?>
					<td style="text-align:center;"><?=$dataStock['Qty']?></td>
						<?$_SESSION['report_values'][$i][3]=$dataStock['Qty'];?>
				</tr>
			<?	$i++;
			}?>
		</form>
	</tbody>
</table>
<br>