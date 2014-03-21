<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<?
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
				<ul class="member_style">
					<li class="line"><a href="<?=$link?>?id=<?=$id?>"><?=$login?></a></li> 
					<li><a href="../admin/"><?=$logout?></a></li>
				</ul>
			</div>
		</div>
		
		<!-- Body Section -->
		<div id="title_head">
		Back Office
		</div>
		<div id="content">
		    <div id="leftcolum">
			   <b><a href="viewProduct.php">Product</a>
									<br><br><a href="order.php">Order</a>
								<!-- End Admin -->
									<br><br><a href="category.php">Category</a>
									<br><br><a href="color.php">Color</a>
									<br><br><a href="shopGuide_main.php">Shopping Guide</a>
									<br><br><a href="shipper.php">Shipper</a>
									<br><br><a href="promotion.php">Promotion</a>
									<br><br><a href="giftwarp.php">Gift warp price</a>
									<br><br><a href="privacy.php">Privacy</a>
									<br><br><a href="payment.php">Payment</a></b>
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
						<div class="overview" style="font-size:14px;">
							<!-- Super Admin -->
								<!-- Admin -->
									<a href="Products.php">Product</a>
									<br><br><a href="order.php">Order</a>
								<!-- End Admin -->
									<br><br><a href="">Category</a>
									<br><br><a href="color.php">Color</a>
									<br><br><a href="">Shopping Guide</a>
									<br><br><a href="shipper.php">Shipper</a>
									<br><br><a href="giftwarp.php">Gift warp price</a>
									<br><br><a href="privacy.php">Privacy</a>
									<br><br><a href="payment.php">Payment</a>
							<!-- End Super Admin -->
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
