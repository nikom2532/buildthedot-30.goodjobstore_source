<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
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
<?
	$rangeID = $_GET['rangeID'];
	$weightStart = $_GET['weightStart'];
	$weightEnd = $_GET['weightEnd'];
	$rangePrice = $_GET['rangePrice'];
	$howID = $_GET['howID'];

//	$nameEn = $_GET['nameEn'];

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

	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="ajax/ajax.shipping.java"></script>
</head>
<body>
	<script>
		viewTable(<?=$howID?>);
	</script>
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
						<div class="overview">
							<h2>Edit range shipping</h2>
						 	<form name="frmEditShipping">
								<table>
									<tbody>
										<tr>
											<td style="width:150px;">Weight Start</td>
											<td style="width:15px;"><img src="../images/dot.gif" /></td>
											<td style="width:-จ0px;"><input type='text' name='weight_start' value="<?=$weightStart?>"></td>
										</tr>
																				<tr><td><br></td></tr>

										<tr>
											<td>Weight End</td>
											<td><img src="../images/dot.gif" /></td>
											<td><input type='text' name='weight_end' value="<?=$weightEnd?>"></td>
										</tr>
										<tr><td><br></td></tr>
										<tr>
											<td>Price</td>
											<td><img src="../images/dot.gif" /></td>
											<td><input type='text' name='price' value="<?=$rangePrice?>"></td>
										</tr>
																				<tr><td><br></td></tr>

									</tbody>
								</table>
								
								<input type='button' value='Edit' onclick="editShipping(<?=$rangeID?>);" style="width:60px">
								<input type='button' value='Back' onclick="window.location.href='shipper.php'" style="width:60px">
							</form>		
							<br><br>
							<div id="line"></div>
<div style="width: 800px; height: 350px; overflow: auto; padding: 5px">

							<div id="shipping_content">
								<!-- view shipper Table -->
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