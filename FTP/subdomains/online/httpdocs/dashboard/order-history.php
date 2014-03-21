<?php
	session_start();
	$get_cusid = $_GET['id'];
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
			$('#scrollbar_order').tinyscrollbar();	
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
		Order History
		</div>
		<div id="content">
		    <div id="leftcolum">
			    <ul>
					<li><a href="notification.php?id=<?=$get_cusid?>">Notification</a></li>
					<li><a href="my-info.php?id=<?=$get_cusid?>">My info</a></li>
					<li><a class="active" href="order-history.php?id=<?=$get_cusid?>">Order History</a></li>
					<li><a href="wishlist.php?id=<?=$get_cusid?>">Wishlist</a></li>
					<li><a href="shopping-cart.php?id=<?=$get_cusid?>">My cart</a></li>
					<li><a href="my-coupon.php?id=<?=$get_cusid?>">My coupon</a></li>
				</ul>
		   	</div>
		   	<div id="order_history"> 
				<div id="scrollbar_order">
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
						 	<table id="order_history">
						 		<tbody>
						 			<tr class="header">
						 				<td width="150px"></td>
						 				<td width="120px">Name</td>
						 				<td width="180px">Discription</td>
						 				<td width="50px">Qty</td>
						 				<td width="100px">Price</td>
						 				<td width="100px">Order Date</td>
						 				<td width="120px">Status</td>
									</tr>
									<tr class="body">
						 				<td><img src="product/order1.jpg" /></td>
						 				<td>Notebook</td>
						 				<td>Yellow Color</td>
						 				<td>1</td>
						 				<td>2,800</td>
						 				<td>30/01/12</td>
						 				<td class="status">Pending</td>
									</tr>
									<tr class="body">
						 				<td><img src="product/order1.jpg" /></td>
						 				<td>Notebook</td>
						 				<td>Yellow Color</td>
						 				<td>1</td>
						 				<td>2,800</td>
						 				<td>30/01/12</td>
						 				<td class="status">Pending</td>
									</tr>
									<tr class="body">
						 				<td><img src="product/order1.jpg" /></td>
						 				<td>Notebook</td>
						 				<td>Yellow Color</td>
						 				<td>1</td>
						 				<td>2,800</td>
						 				<td>30/01/12</td>
						 				<td class="status">Pending</td>
									</tr>
									<tr class="body">
						 				<td><img src="product/order1.jpg" /></td>
						 				<td>Notebook</td>
						 				<td>Yellow Color</td>
						 				<td>1</td>
						 				<td>2,800</td>
						 				<td>30/01/12</td>
						 				<td class="status">Pending</td>
									</tr>
						 		</tbody>
						 	</table>
						</div>
					</div>
				</div>
			</div>
			
		</div>                
		<!-- Footer Section -->
		<? include("footer.php"); ?>

	</div>
	
</body>
</html>
