<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

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
<!--end Permission-->

<!--Export excel-->
<?
	unset($_SESSION['report_header']);
	unset($_SESSION['report_values']);
	$_SESSION['report_header']=array("ID","Name","Address","City","Post Code","Phone Number","Email"); 
?>

<html>
<head>
	<title>GOODJOB - Administration</title>

	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<!------------ show table customers ---------->
	<?
		$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
		$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
		mysql_query("SET NAMES utf8",$objCon);
		
		$sqlCustomer = "SELECT Cus_ID,FirstName,LastName,Address,Name_En,Postal_Code,Phone_Number,Email 
						FROM customers JOIN city ON (customers.City_ID=city.City_ID OR customers.City_ID=0)
						GROUP BY customers.Cus_ID";
		$resultCustomer = mysql_query($sqlCustomer, $objCon) or die(mysql_error());
	?>

</head>
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
						<div class="overview">
							<h2>Record</h2>
							<input type="button" style="width:100px;" value="Export to excel" onclick="window.location.href='report_export.php?fn=Customer'">
							<BR><BR>
							<div id="line"></div>
														<div style="width: 800px; height: 400px; overflow: auto; padding: 5px">

							<table style="width:80%; border-collapse:collapse;">
								<tr style="background-color:#000000; color:#FFFFFF; font-weight:bold; height:25px; text-align:center;">
									<td style="width:120px;">Customer ID</td>
									<td style="width:300px;">Name</td>
									<td style="width:300px;">Email</td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<?	$i=0;
								while ($dataCustomer=mysql_fetch_array($resultCustomer))
								{?>
									<tr>
										<td style="text-align:center;"><?=$dataCustomer['Cus_ID']?></td>
											<?
												$_SESSION['report_values'][$i][0]="#".$dataCustomer['Cus_ID'];
											?>
										<td style="text-align:center;">
											<?=$dataCustomer['FirstName']?> <?=$dataCustomer['LastName']?>
											<?$_SESSION['report_values'][$i][1]=$dataCustomer['FirstName']." ".$dataCustomer['LastName'];?>
										</td>

											<?$_SESSION['report_values'][$i][2]=$dataCustomer['Address'];?>
											<?$_SESSION['report_values'][$i][3]=$dataCustomer['Name_En'];?>
											<?$_SESSION['report_values'][$i][4]=$dataCustomer['Postal_Code'];?>
											<?$_SESSION['report_values'][$i][5]="#".$dataCustomer['Phone_Number'];?>

										<td style="text-align:center;"><?=$dataCustomer['Email']?></td>
											<?$_SESSION['report_values'][$i][6]=$dataCustomer['Email'];?>
										<td>
											<input type="button" value="Order" style="width:60px;" 
											onclick="window.location.href='record_order.php?cusID=<?=$dataCustomer['Cus_ID']?>'">
										</td>
										<td>
											<input type="button" value="Cart" style="width:60px;"
											onclick="window.location.href='record_cart.php?cusID=<?=$dataCustomer['Cus_ID']?>'">
										</td>
										<td>
											<input type="button" value="Wish List" style="width:80px;"
											onclick="window.location.href='record_wishList.php?cusID=<?=$dataCustomer['Cus_ID']?>'">
										</td>
									<tr>
								<?	$i++;
								}?>
							</table>
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
