<?php
	session_start();
	//$get_cusid = $_GET['id'];
	$get_cusid = $_SESSION['Cus'];
	//Wishlist
	include_once 'classes/Wish_List.php';
	$getwish = new Wish_List();
	$wish = $getwish->cus($get_cusid);
	$getcreate = $getwish->getCreate_Date();
	$getpro = $getwish->getProduct_ID();
	//Product
	if(!isset($_SESSION['Cus']))
	{
	   header("Location:login.php");
	}
	$product_id=$_REQUEST['product_id'];
	$color_id=$_REQUEST['color_id'];
	$Cus_ID=$_SESSION['Cus'];
	
	
	/*include_once 'classes/Products.php';
	$getproduct = new Products();
	$pro = $getproduct->pro($getpro);
	$getproduct_name = $getproduct->getPro_Name_En();
	$getcolor = $getproduct->getColor_En();
	$getsize = $getproduct->getSize();
	$getprice = $getproduct->getPrice_sale();
	$getqty = $getproduct->getQty();*/
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
		Wish List
		</div>
		<div id="content">
		    <div id="leftcolum">
			   <ul>
					<li><a href="notification.php?id=<?=$get_cusid?>">Notification</a></li>
					<li><a href="my-info.php?id=<?=$get_cusid?>">My info</a></li>
					<li><a href="order-history.php?id=<?=$get_cusid?>">Order History</a></li>
					<li><a class="active" href="wishlist.php?id=<?=$get_cusid?>">Wishlist</a></li>
					<li><a href="shopping-cart.php?id=<?=$get_cusid?>">My cart</a></li>
					<li><a href="my-coupon.php?id=<?=$get_cusid?>">My coupon</a></li>
				</ul>
		   	</div>
			<div id="withlist"> 
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
						 	<table id="tabble_withlist">
						 		<tbody>
						 			<tr class="header">
						 				<td width="50px">Product</td>
						 				<td width="2px"><img src="images/line.png" /></td>
						 				<td width="160px">Comment</td>
						 				<td width="2px"><img src="images/line.png" /></td>
						 				<td width="50px">Data Added</td>
						 				<td width="2px"><img src="images/line.png" /></td>
						 				<td width="160px">Action</td>
									</tr>
									<?php
									   $ch=$getwish->showAllWithProduct($product_id,$color_id);
									   //echo "dddSSSDX $product_id:$color_id:".$ch;
									   $data ="";
									   $data .= $getwish->getWL_show();
									   $ch=$getwish->showAll($Cus_ID);
									   //echo "ShowAll=dddSSSDX $Cus_ID:".$ch;
									   $data .= $getwish->getWL_show();
									   echo $data;
									?>
									<!-- Item 1 -->
								<!--	<tr class="body">
						 				<td><img src="product/order1.jpg" /></td>
						 				<td></td>
						 				<td>
						 					<textarea row="3" colum="5"></textarea>
						 				</td>
						 				<td></td>
						 				<td><=$getcreate?></td>
						 				<td></td>
						 				<td>-->
						 					<!-- Action Field -->
						 				<!--	<table id="action">
						 						<tbody>
						 							<tr>
						 								<td width="100px"></td>
						 								<td width="80px"></td>
						 								<td width="150px"><input type="button" value="ADD TO CART" name="add" class="button"></td>
						 							</tr>
						 							<tr>
						 								<td><input type="text" name="qty" class="qty"></td>
						 								<td>QTY</td>
						 								<td><input type="button" value="EDIT" name="edit" class="button"></td>
						 							</tr>
						 							<tr>
						 								<td></td>
						 								<td></td>
						 								<td><input type="button" value="ROMOVE ITEM" name="rm" class="button"</td>
						 							</tr>
						 						</tbody>
						 					</table>
						 				</td>
									</tr>
									<tr class="tableline">
						 				<td><=$getproduct_name?></td>
						 				<td></td>
						 				<td><div id="left">Color Yellow</div> <div id="right">Size 11"x14"</div></td>
						 				<td></td>
						 				<td></td>
						 				<td></td>
						 				<td><div id="left">Price 2,800฿</div> <div id="right">Subtotal 2,800฿</div></td>
									</tr> -->
									<!-- Item 2 -->
									<!--<tr class="body">
						 				<td><img src="product/order1.jpg" /></td>
						 				<td></td>
						 				<td>
						 					<textarea row="3" colum="5"></textarea>
						 				</td>
						 				<td></td>
						 				<td>01/03/12</td>
						 				<td></td>
						 				<td>-->
						 					<!-- Action Field -->
						 					<!--<table id="action">
						 						<tbody>
						 							<tr>
						 								<td width="100px"></td>
						 								<td width="80px"></td>
						 								<td width="150px"><input type="button" value="ADD TO CART" name="add" class="button"></td>
						 							</tr>
						 							<tr>
						 								<td><input type="text" name="qty" class="qty"></td>
						 								<td>QTY</td>
						 								<td><input type="button" value="EDIT" name="edit" class="button"></td>
						 							</tr>
						 							<tr>
						 								<td></td>
						 								<td></td>
						 								<td><input type="button" value="ROMOVE ITEM" name="rm" class="button"</td>
						 							</tr>
						 						</tbody>
						 					</table>
						 				</td>
									</tr>
									<tr class="tableline">
						 				<td>Telephone Case</td>
						 				<td></td>
						 				<td><div id="left">Color Yellow</div> <div id="right">Size 11"x14"</div></td>
						 				<td></td>
						 				<td></td>
						 				<td></td>
						 				<td><div id="left">Price 2,800฿</div> <div id="right">Subtotal 2,800฿</div></td>
									</tr>-->
										<!-- Item 3 -->
									<!--<tr class="body">
						 				<td><img src="product/order1.jpg" /></td>
						 				<td></td>
						 				<td>
						 					<textarea row="3" colum="5"></textarea>
						 				</td>
						 				<td></td>
						 				<td>01/03/12</td>
						 				<td></td>
						 				<td>-->
						 					<!-- Action Field -->
						 					<!--<table id="action">
						 						<tbody>
						 							<tr>
						 								<td width="100px"></td>
						 								<td width="80px"></td>
						 								<td width="150px"><input type="button" value="ADD TO CART" name="add" class="button"></td>
						 							</tr>
						 							<tr>
						 								<td><input type="text" name="qty" class="qty"></td>
						 								<td>QTY</td>
						 								<td><input type="button" value="EDIT" name="edit" class="button"></td>
						 							</tr>
						 							<tr>
						 								<td></td>
						 								<td></td>
						 								<td><input type="button" value="ROMOVE ITEM" name="rm" class="button"</td>
						 							</tr>
						 						</tbody>
						 					</table>
						 				</td>
									</tr>
									<tr class="tableline">
						 				<td>Telephone Case</td>
						 				<td></td>
						 				<td><div id="left">Color Yellow</div> <div id="right">Size 11"x14"</div></td>
						 				<td></td>
						 				<td></td>
						 				<td></td>
						 				<td><div id="left">Price 2,800฿</div> <div id="right">Subtotal 2,800฿</div></td>
									</tr>-->
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
