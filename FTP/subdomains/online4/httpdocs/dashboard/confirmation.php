<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<title>GOODJOB</title>
	<meta name="description" content="Shop powered by PrestaShop">
	<meta name="keywords" content="shop, prestashop">
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8">
	<meta name="generator" content="GoodJobStore">
	<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="css/checkout.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="scripts/droplinemenu.js" type="text/javascript"></script>
	<script type="text/javascript">
		//build menu with DIV ID="myslidemenu" on page:
		droplinemenu.buildmenu("droplinetabs1")
	</script>
	
</head>
<body>
	<div id="wrapper">
		<!-- Header Section -->
		<? include("header.php"); ?>

		<!-- Body Section -->
		<div id="title_head">
			Checkout 
		</div>
		<div id="process">
			<ul>
				<li><img src="images/step_01.png" /></li>
				<li><img src="images/step_02.png" /></li>
				<li><img src="images/step_03.png" /></li>
				<li><img src="images/step_04_active.png" /></li>
			</ul>
		</div>
		<div id="confirmation">
			<div id="confirmation_title">Thank you <br>for your purchase</div>
			<div class="left">
				<div class="back_button"><a href="#">Back to Shipping</a></div>
				<div class="item">
					<h3>This is item you bougth :</h3>
					200 Bath. Home<br>
					beech /black
				</div>
				<h3>Your order number is</h3>
				<div class="code">WAU358734</div>
				<p>Please keep this order number for tracking letter.</p>
			</div>
			<div class="right">
				<p>An email will be sent to you shortly containing all the details of your order. If you do not recieive this email
				please phone or email us asap. You will receive another email when your order has been processed and goods dispatched.</p>

				<p>if you have any queries regarding your order you can get hold of us during normal business hours at the following contact details.</p>
				<h3>T:</h3>
				<h3>E:</h3>
			</div>
		</div>
		<div id="co_space">
		</div>
		<!-- Footer Section -->
		<? include("footer.php"); ?>
	</div>
</body>
</html>