<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
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
include_once '../classes/Products.php';
$products = new Products();
$product_id = $_GET['id'];
$AllProduct = $products->Allproducts();
$AllProduct_c = $products->Allproduct_c($product_id);
?>
<html>
<head>
	<title>GOODJOB - Administration</title>
	<meta name="description" content="Shop powered by PrestaShop">
	<meta name="keywords" content="shop, prestashop">
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8">
	<meta name="generator" content="GoodJobStore">
	<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="../scripts/droplinemenu.js" type="text/javascript"></script>
	<script type="text/javascript">
		//build menu with DIV ID="myslidemenu" on page:
		droplinemenu.buildmenu("droplinetabs1")
	</script>
	<script type="text/javascript" src="../scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
		});
	</script>	
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div class="logo"><a href ="../"><img src="../images/logo.jpg" /></a></div>
			<div class="right">
			<table>
					<tbody>
						<tr>
							<td style="vertical-align:middle">
								<div id="member">
									<ul class="member_style">
										<li class="line"><a href="<?=$link?>?id=<?=$id?>"><?=$login?></a></li> 
										<li><a href="../admin/"><?=$logout?></a></li>
									</ul>
								</div>
							</td>
							<td>
								<div id="search">
								<form method="get" action="#" id="searchbox">
									<input type="hidden" name="orderby" value="position">
									<input type="hidden" name="orderway" value="desc">
					            	<input type="submit" name="submit_search" value="Search" class="submit_search"><input class="search_query ac_input" type="text" id="search_query_top" name="search_query" value="" autocomplete="off">
								</form>
								</div>
							</td>
						</tr>
					</tbody>
				</table>	
				<div id="language">
					<span class="guide"><a href="../shopping_guide">Shopping Guide</a></span>
					<ul>
						<li class="first"><a href="index.php?lang=th">TH</a></li>
						<li class="select"><a href="index.php?lang=en">EN</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Navigation Section -->
		<div id="nav">
			<div id="droplinetabs1" class="droplinetabs">
				<ul>
					<li class="first">
						<a href="#" title="">New Arrivals</a>
						<ul>
							<li><a href="#">Spacial</a></li>
							<li><a href="#">Corporate Gift</a></li>
							<li><a href="#">Skirt</a></li>
							<li><a href="#">Notebook case</a></li>
						</ul>
					</li>
					<li><a href="#" title="">Stationery</a></li>
					<li>
						<a href="#" title="">Bags & Accessories</a>
						<ul>
							<li><a href="#">Document Bag </a></li>
							<li><a href="#">Presentation Bag </a></li>
							<li><a href="#">Laptop Bag</a></li>
							<li><a href="#">Wine Holder</a></li>
							<li><a href="#">Tissue Holder</a></li>
						</ul>
					</li>
					<li><a href="#" title="">Awesome</a></li>
					<li><a href="#" title="">Designers' tools</a></li>
					<li><a href="#" title="" class="last">Sales</a></li>
				</ul>
			</div>
			<div id="shopping_info">
				<a href="my-cart.php"><img src="../images/cart.jpg" align="absmiddle" />Shopping Cart</a>
				<a href="#"><img src="../images/location.jpg" align="absmiddle" />Store Locator</a>
			</div>
		</div>
		<!-- Body Section -->
		<div id="title_head">
		Back Office
		</div>
		<div id="content">
		    <div id="leftcolum">
			    <ul>
			        <li><a href="profile.php?id=<?=$get_empid?>">Profile</a></li>
			        <li><a href="category.php?id=<?=$get_empid?>">Category</a></li>
			        <li><a href="sub-category.php?id=<?=$get_empid?>">Sub Category</a></li>
					<li><a class="active" href="product.php?id=<?=$get_empid?>">Product</a></li>
					<li><a href="employee.php?id=<?=$get_empid?>">Employee</a></li>
					<li><a href="customer.php?id=<?=$get_empid?>">Customer</a></li>
					<li><a href="Shopping Guide.php?id=<?=$get_empid?>">Shopping Guide</a></li>
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
					</form>
					<h2>Products</h2>
						 	<form action="Upload.php" method="POST" name="product" enctype="multipart/form-data">
					<table>
						<tbody>
							<tr>								
								<?
								echo $products->getAllproduct_c();
								?>
							</tr>
						</tbody>
					</table>
					
					</form>
						 	<div id="line"></div>
	
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

