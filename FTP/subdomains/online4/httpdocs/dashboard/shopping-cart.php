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
	<link rel="stylesheet" type="text/css" href="css/shopping-cart.css">
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
</head>
<body>
	<div id="wrapper">
		<!-- Header Section -->
		<? include("header.php"); ?>

		<!-- Body Section -->
		<div id="sc_title_head">
		Shopping Cart
		</div>
		<div id="content">
			<div id="sc_table_header">
			    <table>
			    	<tr>
			    		<td width="100px">Items</td>
			    		<td width="2px"><img src="images/line.png" /></td>
			    		<td width="140px">Name</td>
			    		<td width="2px"><img src="images/line.png" /></td>
			    		<td width="140px">Description</td>
			    		<td width="20px"><img src="images/line.png" /></td>
			    		<td width="100px">Qty</td>
			    		<td width="2px"><img src="images/line.png" /></td>
			    		<td width="120px">Price</td>
			    		<td width="2px"><img src="images/line.png" /></td>
			    		<td width="120px">Move to Wishlist</td>
			    		<td width="2px"><img src="images/line.png" /></td>
			    		<td width="100px">Subtotal</td>
			    		<td width="2px"><img src="images/line.png" /></td>
			    		<td width="40px"></td>
			    	</tr>
			    </table>
			    <div class="shopping_icon"><img src="images/shopping-icon.jpg" /></div>
			</div>
			<div id="sc_table_body">
			<div id="scrollbar1">
			<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
			<div class="viewport">
				 <div class="overview">
				 	<table>
				 		<tbody>
				 			<tr>
						    		<td width="100px"><img src="product/shopping-img.jpg" /></td>
						    		<td class="tl" width="120px">Notebook</td>
						    		<td class="tl" width="130px">Yello Color <br />10"x10"</td>
						    		<td width="110px">
										<div id="qt_left">2</div>
							    		<div id="qt_right">
							    		<ul>
							    			<li><a href="#"><img src="images/up.jpg" /></a></li>
							    			<li><a href="#"><img src="images/down.jpg" /></a></li>
							    		</ul>
					    				</div>
						    		</td>
						    		<td width="121px">250 ฿</td>
						    		<td width="122px"><input type="checkbox" name="mvTowishlist"></td>
						    		<td width="100px">500 ฿</td>
						    		<td width="135px"><input type="button" name="rmItem" value="REMOVE ITEM"></td>
						    	</tr>
						    	<tr>
						    		<td><img src="product/shopping-img.jpg" /></td>
						    		<td class="tl">Notebook</td>
						    		<td class="tl">Yello Color <br />10"x10"</td>
						    		<td>
						    			<div id="qt_left">2</div>
							    		<div id="qt_right">
							    		<ul>
							    			<li><a href="#"><img src="images/up.jpg" /></a></li>
							    			<li><a href="#"><img src="images/down.jpg" /></a></li>
							    		</ul>
					    				</div>
						    		</td>
						    		<td>250 ฿</td>
						    		<td><input type="checkbox" name="mvTowishlist"></td>
						    		<td>500 ฿</td>
						    		<td><input type="button" name="rmItem" value="REMOVE ITEM"></td>
						    	</tr>
						    	<tr>
						    		<td><img src="product/shopping-img.jpg" /></td>
						    		<td class="tl">Notebook</td>
						    		<td class="tl">Yello Color <br />10"x10"</td>
						    		<td>
										<div id="qt_left">2</div>
							    		<div id="qt_right">
							    		<ul>
							    			<li><a href="#"><img src="images/up.jpg" /></a></li>
							    			<li><a href="#"><img src="images/down.jpg" /></a></li>
							    		</ul>
					    				</div>					    		
						    		</td>
						    		<td>250 ฿</td>
						    		<td><input type="checkbox" name="mvTowishlist"></td>
						    		<td>500 ฿</td>
						    		<td><input type="button" name="rmItem" value="REMOVE ITEM"></td>
						    	</tr>
						    	<tr>
						    		<td><img src="product/shopping-img.jpg" /></td>
						    		<td class="tl">Notebook</td>
						    		<td class="tl">Yello Color <br />10"x10"</td>
						    		<td>
										<div id="qt_left">2</div>
							    		<div id="qt_right">
							    		<ul>
							    			<li><a href="#"><img src="images/up.jpg" /></a></li>
							    			<li><a href="#"><img src="images/down.jpg" /></a></li>
							    		</ul>
					    				</div>
						    		</td>
						    		<td>250 ฿</td>
						    		<td><input type="checkbox" name="mvTowishlist"></td>
						    		<td>500 ฿</td>
						    		<td><input type="button" name="rmItem" value="REMOVE ITEM"></td>
						    	</tr>
						    	<tr>
						    		<td><img src="product/shopping-img.jpg" /></td>
						    		<td class="tl">Notebook</td>
						    		<td class="tl">Yello Color <br />10"x10"</td>
						    		<td>
										<div id="qt_left">2</div>
							    		<div id="qt_right">
							    		<ul>
							    			<li><a href="#"><img src="images/up.jpg" /></a></li>
							    			<li><a href="#"><img src="images/down.jpg" /></a></li>
							    		</ul>
					    				</div>					    		
						    		</td>
						    		<td>250 ฿</td>
						    		<td><input type="checkbox" name="mvTowishlist"></td>
						    		<td>500 ฿</td>
						    		<td><input type="button" name="rmItem" value="REMOVE ITEM"></td>
						    	</tr>
				 		</tbody>
				 	</table>
				</div>
			</div>	
			</div>
			</div>
		</div> 
		<div id="sc_coupon">
			<div class="left">
				<h3>COUPON CODE</h3>
				Please enter your coupon code.
				<form name="applycode" method="#" class="applycode">
					<input type="text" name="couponcode"><br />
					<input type="submit" name="applycode" value="APPLY CODE">
				</form>
			</div>
			<div class="right">
				<from name="cartUpdate" methode="#">
					<a href="#" class="continue">CONTINUE SHOPPING</a><input type="submit" value="UPDATE CART"><br />
					<div class="total">TOTAL &nbsp;&nbsp;&nbsp;&nbsp; 5,000 ฿</div><br />
					<a href="#">CHECK OUT</a>
				</form>
			</div>
		</div>
		<div id="sc_space">               
		</div>
		<!-- Footer Section -->
		<? include("footer.php"); ?>
		
	</div>
	
</body>
</html>