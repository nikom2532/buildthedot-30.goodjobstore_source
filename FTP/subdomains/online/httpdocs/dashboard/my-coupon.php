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
	<?include("script-menu.php");?>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
</head>
<body>
	<div id="wrapper">
		<!-- Header Section -->
		<? include("header.php"); ?>

		<!-- Body Section -->
		<div id="title_head">
		My Coupon
		</div>
		<div id="coupon_notics">Please enter you coupon code in your shopping chart before your next purchase.</div>
		<div id="content">
		    <div id="leftcolum">
			    <ul>
					<li><a href="notification.php?id=<?=$get_cusid?>">Notification</a></li>
					<li><a href="my-info.php?id=<?=$get_cusid?>">My info</a></li>
					<li><a href="order-history.php?id=<?=$get_cusid?>">Order History</a></li>
					<li><a href="wishlist.php?id=<?=$get_cusid?>">Wishlist</a></li>
					<li><a href="shopping-cart.php?id=<?=$get_cusid?>">My cart</a></li>
					<li><a class="active" href="my-coupon.php?id=<?=$get_cusid?>">My coupon</a></li>
				</ul>
		   	</div>
			<div id="coupon_content">
				<table>
					<tbody>
						<tr class="header">
							<td width="250px">COUPON CODE</td>
							<td>|</td>
							<td width="250px">VALUE</td>
							<td>|</td>
							<td width="250px">EXPIRED DATE</td>
						</tr>
						<tr>
							<td>AA772330292</td>
							<td><img src="images/line-coupon.gif" /></td>
							<td>Discount 20%</td>
							<td><img src="images/line-coupon.gif" /></td>
							<td>15 Jun 2012</td>
						</tr>
						<tr>
							<td>CA243303242</td>
							<td><img src="images/line-coupon.gif" /></td>
							<td>500 Bath Cash</td>
							<td><img src="images/line-coupon.gif" /></td>
							<td>20 December 2012</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>                
		<!-- Footer Section -->
		<? include("footer.php"); ?>

	</div>
	
</body>
</html>
