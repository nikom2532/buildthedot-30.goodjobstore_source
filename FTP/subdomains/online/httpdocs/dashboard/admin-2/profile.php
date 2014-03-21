<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
session_start();
include_once '../classes/Employees.php';
$login = 'Log in';
$logout = 'Register';
$link = 'profile.php';

	//$get_empid = $_GET['id'];
	$get_empid = $_SESSION['login'];
	echo $get_empid;
	$getemp = new Employees();
	$get = $getemp->emp($get_empid);
	$getemail = $getemp->getemail();
	$getfirstname = $getemp->getFirstName();
	$getlastname = $getemp->getLastName();
	$getemail = $getemp->getEmail();
	$getphonenumber = $getemp->getPhone_Number();
	$getaddress = $getemp->getAddress();
	$getpostal = $getemp->getPostal_Code();
	$login = $getemp->getFirstName()." ".$getemp->getLastName();
	$logout = 'Log out';
	if(isset($getfirstname)==0&&isset($getlastname)==0)
		{
			$login = $getemp->getEmail();
		} 
	
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
		<!-- Header Section -->
		<!--<div id="header">
			<div class="logo"><a href ="../"><img src="../images/logo.jpg" /></a></div>
			<div class="right">
				<span class="member"><a href="../account/login/">Log in</a> | <a href="../login/">Register</a></span>
				<span id="search">
				<form method="get" action="#" id="searchbox">
					<input type="hidden" name="orderby" value="position">
					<input type="hidden" name="orderway" value="desc">
	            	<input type="submit" name="submit_search" value="Search" class="submit_search"><input class="search_query ac_input" type="text" id="search_query_top" name="search_query" value="" autocomplete="off">
				</form>
				</span>
				<div id="language">
					<span class="guide"><a href="#">Shopping Guide</a></span>
					<ul>
						<li class="first"><a href="#">TH</a></li>
						<li class="select">EN</li>
					</ul>
				</div>
			</div>
		</div>-->
		<div id="header">
			<div class="logo"><a href ="../"><img src="../images/logo.jpg" /></a></div>
			<div class="right">
				<ul class="member_style">
					<li class="line"><a href="<?=$link?>?id=<?=$id?>"><?=$login?></a></li> 
					<li><a href="logout.php"><?=$logout?></a></li>
				</ul>
			</div>
		</div>
		
		<!-- Body Section -->
		<div id="title_head">
		Back Office
		</div>
		<div id="content">
		    <div id="leftcolum">
			    <ul>
			        <li><a class="active" href="profile.php?id=<?=$get_empid?>">Profile</a></li>
			        <li><a href="category.php?id=<?=$get_empid?>">Category</a></li>
			        <li><a href="sub-category.php?id=<?=$get_empid?>">Sub Category</a></li>
					<li><a href="Products.php?id=<?=$get_empid?>">Product</a></li>
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
						 	<h2><?=$login?> Profile</h2>
						 	<form action="" method="" name="">
					<table>
						<tbody>
							<tr>
								<td width="100px">E-mail</td>
								<td width="30px"><img src="images/dot.gif" /></td>
								<td><input type="text" name="email" value="<?=$getemail?>"/></td>
							</tr>
							<tr>
								<td>First name</td>
								<td><img src="images/dot.gif" /></td>
								<td><input type="text" name="fistName" value="<?=$getfirstname?>"/></td>
							</tr>
							<tr>
								<td>Last name</td>
								<td><img src="images/dot.gif" /></td>
								<td><input type="text" name="lastName" value="<?=$getlastname?>" /></td>
							</tr>
							<tr>
								<td>Phone number</td>
								<td><img src="images/dot.gif" /></td>
								<td><input type="text" name="phonNumber" value="<?=$getphonenumber?>" /></td>
							</tr>
							<tr>
								<td>Address</td>
								<td><img src="images/dot.gif" /></td>
								<td><input type="text" name="address" value="<?=$getaddress?>" /></td>
							</tr>
							<tr>
									<td>Postal code</td>
									<td><img src="images/dot.gif" /></td>
									<td><input type="text" name="postCode" value="<?=$getpostal?>"/></td>
							</tr>
							<tr>
								<td>
									<input type="submit" id="submit1" value=" Submit ">
								</td>
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
