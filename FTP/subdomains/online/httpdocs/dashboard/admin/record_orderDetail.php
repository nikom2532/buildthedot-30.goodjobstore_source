<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<!--Permission-->

<?php
session_start(); //เปิด session
$ses_userid =$_SESSION[ses_userid];
$ses_username = $_SESSION[ses_username];
if($ses_userid <> session_id() or $ses_username =="")
{
echo "Please Login to system<br />";
}

if($_SESSION[ses_status] != "Super Admin") 
{
echo "This page for Super Admin only!";
echo "<br><a href=index.php>Back</a>";
exit();
}
?>

<!--Permission-->
<?
	$orderID = $_GET['orderID'];
	$cusID = $_GET['cusID'];

	//include_once '../classes/Products.php';
	//Initialization
	include_once '../classes/Employees.php';
	$login = 'Log in';
	$logout = 'Register';
	$link = 'profile.php';
		$get_empid = '0001';
		//$get_empid = $_GET['id'];
		$getemp = new Employees();
		$get = $getemp->emp($get_empid);
		$getlastname = $getemp->getLastName();
		$getemail = $getemp->getEmail();
		$login = $getemp->getFirstName()." ".$getemp->getLastName();
		$logout = 'Log out';
		if(isset($getfirstname)==0&&isset($getlastname)==0)
			{
				$login = $getemp->getEmail();
			} 

	//------- connect Database ----------
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	//------ Customer --------
	$sqlCus = "SELECT * FROM customers WHERE Cus_ID = '$cusID'";
	$resultCus = mysql_query($sqlCus, $objCon) or die(mysql_error());

	//------ Shipping --------
	$sqlShip = "SELECT * FROM shipping JOIN city 
				ON shipping.s_City_ID = city.City_ID
				WHERE Cus_ID = '$cusID'";
	$resultShip = mysql_query($sqlShip, $objCon) or die(mysql_error());

	//------ Ship Option -----
		//------ Gift warp -------
		$sqlGift = "SELECT Have_ID FROM have_option WHERE Order_ID = '$orderID' AND Option_ID=1";
		$resultGift = mysql_query($sqlGift, $objCon) or die(mysql_error());
		$gift = mysql_fetch_row($resultGift);
		//------ Invoice ---------
		$sqlInvoice = "SELECT Have_ID FROM have_option WHERE Order_ID = '$orderID' AND Option_ID=2";
		$resultInvoice = mysql_query($sqlInvoice, $objCon) or die(mysql_error());
		$invoice = mysql_fetch_row($resultInvoice);

	//----- Shipping method -----
	$sqlShipMet = "SELECT * FROM orders JOIN how_delivery
					ON orders.How_ID = how_delivery.How_ID
					WHERE Order_ID = '$orderID'";
	$resultShipMet = mysql_query($sqlShipMet, $objCon) or die(mysql_error());

	//----- Shipping method -----
	$sqlPayMet = "SELECT * FROM orders JOIN payments
					ON orders.payment_id = payments.id
					WHERE Order_ID = '$orderID'";
	$resultPayMet = mysql_query($sqlPayMet, $objCon) or die(mysql_error());

	//------- Order Item -------
	$sqlItem = "SELECT products.Product_Code,Pro_Name_En,Thumbnail_path,color.Name_EN,order_item.Qty,Price_Buy,Price_sale,Total_Price 
				FROM order_item JOIN images 
				ON order_item.Product_ID = images.Product_ID
				JOIN products ON order_item.Product_ID = products.Product_ID
				JOIN color ON order_item.Color_ID = color.Color_ID
				AND order_item.Color_ID = images.Color_ID
				WHERE order_item.Order_ID =  '$orderID'
				ORDER BY products.Product_Code";
	$resultItem = mysql_query($sqlItem, $objCon) or die(mysql_error());

	//------- Price -------
	$sqlPrice = "SELECT Total_Price,shipping_price,service_price,Final_Price FROM orders WHERE orders.Order_ID = '$orderID'";
	$resultPrice = mysql_query($sqlPrice, $objCon) or die(mysql_error());
?>


<html>
<head>
	<title>GOODJOB - Administration</title>

	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
</head>
<body>
<!--logout-->

	<div id="wrapper">
		<div id="header">
			<div class="logo"><a href ="http://online.goodjobstore.com"><img src="../images/logo.jpg" /></a></div>
			<div class="right">
				<ul class="member_style">
					
					<li><a href="logout.php">log out</a></li>
				</ul>
			</div>
		</div>
		
<!--logout-->
		
		<!-- Body Section -->
		<div id="title_head">
		Back Office
		</div>
		<div id="content">
		    <div id="leftcolum">
<!--menu-->

									<b><a href="order.php">Order</a></b>
								<?if($_SESSION[ses_status] == "Super Admin") 
			{?>
								<!-- End Admin -->
									<b><br><br><a href="saleReport.php">Sale Report</a>
									<br><br><a href="record.php">Customer Record</a>
									<br><br><a href="productGroup.php">Product</a>
									<br><br><a href="category.php">Category</a>
									<br><br><a href="property.php">Property</a>
									<br><br><a href="color.php">Color</a>
									<br><br><a href="banner.php">Banner</a>
									<br><br><a href="banner_notice.php">Notice Banner</a>
									<br><br><a href="slide.php">Slide</a>
									<br><br><a href="background.php">Background</a>
									<br><br><a href="giftwarp.php">Gift warp price</a>
									<br><br><a href="shipper.php">Shipper</a>
									<br><br><a href="cusGroup.php">Group Customers</a>
									<br><br><a href="freeShip.php">Free Shipping</a>
									<br><br><a href="payment.php">Payment</a>
									<br><br><a href="shopGuide_main.php">Shopping Guide</a>
									<br><br><a href="privacy.php">Permission</a>
									<br><br><a href="usdRate.php">USD Rate</a></b>
			<?}?>	

<!--menu-->
		   	</div>
			<div id="dashboard"> 

					<div class="viewport">
						<div class="overview">
							<h2>Order: <?=$orderID?></h2>

							<br>Customer ID: <?=$cusID?>
							<?while($dataCus=mysql_fetch_array($resultCus))
							{?>
								<br>Name: <?=$dataCus['FirstName']?> <?=$dataCus['LastName']?>
								<br>E-mail: <?=$dataCus['Email']?>
								<br>Tel: <?=$dataCus['Phone_Number']?>
							<?}?>
							<br><br><br>
							<?while($dataShip=mysql_fetch_array($resultShip))
							{?>
								<br>Shipping Name: <?=$dataShip['s_FirstName']?> <?=$dataShip['s_LastName']?> 
								<br>Shipping Address: <?=$dataShip['s_Address']?>
								<br>City: <?=$dataShip['Name_Th']?>
								<br>Postcode: <?=$dataShip['s_Postal_Code']?>
								<br>Tel: <?=$dataShip['s_Phone_Number']?>
							<?}
							while($dataShipMet=mysql_fetch_array($resultShipMet))
							{?>
								<br>Shipping Method: <?=$dataShipMet['Name_En']?>
							<?}
							while($dataPayMet=mysql_fetch_array($resultPayMet))
							{?>
								<br>Payment Method: <?=$dataPayMet['name_en']?>
							<?}?>
							<br>Gift warp: <?=(!$gift)?NO:YES;?>
							<br>Invoice: <?=(!$invoice)?NO:YES;?>
							<br><br>
							<input type="button" value="Back" onclick="window.location.href='record_order.php?cusID=<?=$cusID?>'" style="width:60px">
							<br><br>
							<div id="line"></div>

							<div id="order_detail_content">
								<div style="width: 800px; height: 250px; overflow: auto; padding: 5px">

								<table style="width:90%; border-collapse:collapse;">
									<tbody>
										<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
											<td>Code</td>
											<td>Product</td>
											<td>Name</td>
											<td>Color</td>
											<td>Quantity</td>
											<td>Price</td>
											<td>Total Price</td>
										</tr>
										<?$i=1;
										while ($dataItem=mysql_fetch_array($resultItem))
										{?>
											<?=($i%2==1)?'<tr style="background-color:#DDDDDD;">':'<tr style="background-color:#EEEEEE;">'?>
												<td style="text-align:center;"><?=$dataItem['Product_Code']?></td>
												<td style="text-align:center;"><img src="../../public/<?=$dataItem['Thumbnail_path']?>"></td>
												<td style="text-align:center;"><?=$dataItem['Pro_Name_En']?></td>
												<td style="text-align:center;"><?=$dataItem['Name_EN']?></td>
												<td style="text-align:center;"><?=$dataItem['Qty']?></td>
												<td style="text-align:right;"><?=($dataItem['Price_sale']==0)?$dataItem['Price_Buy']:$dataItem['Price_sale'];?></td>
												<td style="text-align:right;"><?=$dataItem['Total_Price']?></td>
											</tr>
										<?$i++;
										}?>
									</tbody>
								</table>
							</div>
							<?while($dataPrice=mysql_fetch_array($resultPrice))
							{?>
								<br>Products Total: <b><?=$dataPrice['Total_Price']?></b> Bath.
								<br>Shipping Price: <b><?=$dataPrice['shipping_price']?></b> Bath.
								<br>Service Price: <b><?=$dataPrice['service_price']?></b> Bath.
								<br>Total: <b><?=$dataPrice['Final_Price']?></b> Bath.
							<?}?>
						</div>
					</div>
			</div>
		</div> <!-- End Content -->       
		
	<!-- Footer Section -->
		<div id="footer">
			<div class="payment_logo"><img src="../images/payment_logo.jpg" /></div>
			<div class="copyright">? 2011 - 2015 GOODJOB CO., LTD</div>
		</div>
	
	</div>
</body>
</html>
