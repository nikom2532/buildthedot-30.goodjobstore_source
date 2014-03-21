<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?
	$cusID = $_GET['cusID'];

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

<!--Permission-->

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

<!--Permission-->
<html>
<head>
	<title>GOODJOB - Administration</title>
	
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
</head>

<!-- connect database -->
<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT products.Product_ID,products.Product_Code,Pro_Name_En,property.name_en,Thumbnail_path,Size,cart.Qty
			FROM cart JOIN images ON cart.Product_ID = images.Product_ID
			JOIN products ON cart.Product_ID = products.Product_ID
			AND cart.Color_ID = images.Color_ID
			JOIN property ON products.Property_ID=property.prop_id
			WHERE cart.Cus_ID =  '$cusID'
			GROUP BY products.Product_ID,images.Color_ID";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>

<body>
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
						<div class="overview" style="font-size:14px;">
							<h2>Cart Record</h2>

							<?=$cusID?><br>
							<br><input type="button" value="back" style="width:60px;" onclick="window.location.href='record.php'">
							<br><br><div id="line"></div>
<br>
							<div id="record_content">
																					<div style="width: 800px; height: 400px; overflow: auto; padding: 5px">

								<table style="width:90%; border-collapse:collapse;">
									<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
										<td>Product Code</td>
										<td>Product</td>
										<td>Name</td>
										<td>Property</td>
										<td>Size</td>
										<td>Quantity</td>
									</tr>
									<?$i=1;
									while ($data=mysql_fetch_array($result))
									{?>
										<?=($i%2==1)?'<tr style="background-color:#DDDDDD;">':'<tr style="background-color:#EEEEEE;">'?>
											<td style="text-align:center;"><?=$data['Product_Code']?></td>
											<td style="text-align:center;"><img src="../../public/<?=$data['Thumbnail_path']?>"></td>
											<td style="text-align:center;"><?=$data['Pro_Name_En']?></td>
											<td style="text-align:center;"><?=$data['name_en']?></td>
											<td style="text-align:center;"><?=$data['Size']?></td>
											<td style="text-align:center;"><?=$data['Qty']?></td>
										</tr>
									<?$i++;
									}?>
								</table>
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
