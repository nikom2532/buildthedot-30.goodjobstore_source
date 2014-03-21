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


<html>
<head>
	<title>GOODJOB - Administration</title>
	
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
</head>

<!-- connect database -->
<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT Order_ID,Cus_ID,Final_Price,status,created_at 
			FROM orders WHERE Cus_ID = '$cusID'
			ORDER BY created_at DESC";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>

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
						<div class="overview" style="font-size:14px;">
							<h2>Order Record</h2>
							<?=$cusID?>
							<br><br><input type="button" value="back" style="width:60px;" onclick="window.location.href='record.php'">
							<br><br><div id="line"></div>
<br>
							<div id="record_content">
								<div style="width: 800px; height: 400px; overflow: auto; padding: 5px">

								<table style="width:90%; border-collapse:collapse;">
									<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
										<td>Order ID</td>
										<td>Price</td>
										<td>Status</td>
										<td>Create</td>
									</tr>
									<?$i=1;
									while ($data=mysql_fetch_array($result))
									{?>
										<?=($i%2==1)?'<tr style="background-color:#DDDDDD;">':'<tr style="background-color:#EEEEEE;">'?>
											<td style="text-align:center;">
												<a href="order_detail.php?orderID=<?=$data['Order_ID']?>&cusID=<?=$data['Cus_ID']?>&backTo=2"><?=$data['Order_ID']?></a>
											</td>
											<td style="text-align:center;"><?=$data['Final_Price']?></td>
											<td style="text-align:center;">
												<?
													switch ($data['status']) 
													{
														case 1:
															echo "Pending";
															break;
														case 2:
															echo "Payment Received";
															break;
														case 3:
															echo "Shipped";
															break;
														case 4:
															echo "refund";
															break;
														case 5:
															echo "Cancel";
															break;
													}
												?>
											</td>
											<td style="text-align:center;"><?=$data['created_at']?></td>
										</tr>
									<?$i++;
									}?>
								</table>
							</div>
						</div>
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
