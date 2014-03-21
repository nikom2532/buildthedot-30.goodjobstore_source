<?php
	session_start();
	include_once 'classes/Customers.php';


	
	//$get_cusid = $_GET['id'];
	$get_cusid = $_SESSION['Cus'];
	$id=$_REQUEST['id'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<title>GOODJOB - Dashboard</title>
	<meta name="description" content="Shop powered by PrestaShop">
	<meta name="keywords" content="shop, prestashop">
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8">
	<meta name="generator" content="GoodJobStore">
	<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="scripts/droplinemenu.js" type="text/javascript"></script>
	<script type="text/javascript">
		//build menu with DIV ID="myslidemenu" on page:
		droplinemenu.buildmenu("droplinetabs1")
	</script>
	<script type="text/javascript" src="scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
		});
	</script>
	<?include("script-menu.php");?>
	<link rel="stylesheet" type="text/css" href="css/menu.css">	
</head>
<body>
	<div id="wrapper">
		<!-- Header Section -->
		<? include("header.php"); ?>

		<!-- Body Section -->
		<div id="title_head">
		Notification 
		</div>
		<div id="content">
		    <div id="leftcolum">
			    <ul>
			        <li><a class="active" href="notification.php?id=<?=$get_cusid?>">Notification</a></li>
			        <li><a href="my-info.php?id=<?=$get_cusid?>">My info</a></li>
			        <li><a href="order-history.php?id=<?=$get_cusid?>">Order History</a></li>
					<li><a href="wishlist.php?id=<?=$get_cusid?>">Wishlist</a></li>
					<li><a href="shopping-cart.php?id=<?=$get_cusid?>">My cart</a></li>
					<li><a href="my-coupon.php?id=<?=$get_cusid?>">My coupon</a></li>
			    </ul>
		   	</div>
			<div id="dashboard"> 
				<div id="scrollbar1">
					<div class="scrollbar">
						<div class="track">
							<div class="thumb">
								<div class="end">
								</div>
							</div>
						</div>
					</div>
					<div class="viewport">
						 <div class="overview">
						 	<h2>ORDER STATUS</h2>
						 	<table id="table_notification">
						 		<tbody>
						 			<tr class="header">
						 				<td width="320px">Discription</td>
						 				<td width="2px"><img src="images/line.png" /></td>
						 				<td width="230px">Shipping Number</td>
						 				<td width="2px"><img src="images/line.png" /></td>
						 				<td width="230px">Order Status</td>
									</tr>
									<tr class="body">
						 				<td>
						 					<table width="310">
						 						<tbody>
						 							<tr>
						 								<td id="product_image"><img src="product/product1.png" /></td>
						 								<td id="product_detail">Touch phone case <br />Color yellow 10" x 10" <br />MA209376893</td>
						 							</tr>
						 						</tbody>
						 					</table>
						 				</td>
						 				<td><img src="images/greyline.png" /></td>
						 				<td>MA209376893</td>
						 				<td><img src="images/greyline.png" /></td>
						 				<td>MA209376893</td>
						 				<td></td>
									</tr>
						 		</tbody>
						 	</table>
						 	<div id="line"></div>
						 	<h2>RESTOCK NOTIFICATION</h2>
						 	<table id="table_notification">
						 		<tbody>
						 			<tr class="header">
						 				<td width="320px">Discription</td>
						 				<td width="2px"><img src="images/line.png" /></td>
						 				<td width="230px"> Price</td>
						 				<td width="2px"><img src="images/line.png" /></td>
						 				<td width="230px"></td>
									</tr>
									<tr class="body">
						 				<td>
						 					<table width="310">
						 						<tbody>
						 							<tr>
						 								<td id="product_image"><img src="product/product1.png" /></td>
						 								<td id="product_detail">Touch phone case <br />Color yellow 10" x 10" <br />MA209376893</td>
						 							</tr>
						 						</tbody>
						 					</table>
						 				</td>
						 				<td><img src="images/greyline.png" /></td>
						 				<td>MA209376893</td>
						 				<td><img src="images/greyline.png" /></td>
						 				<td>is now aviable<br /><a href="#">GO TO PRODUCT PAGE</a></td>
						 				<td></td>
									</tr>
						 		</tbody>
						 	</table>
						</div>
					</div>
				</div>
			</div>
			
		</div> <!-- End Content -->               
		
		<!-- Footer Section -->
		<? include("footer.php"); ?>
	</div>
	
</body>
</html>
