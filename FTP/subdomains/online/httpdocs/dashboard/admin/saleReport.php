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
session_start(); //�Դ session
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
	<script src="ajax/ajax.saleReport.java"></script>
</head>
<body>
	<script>
		viewToday();
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
							<h2>Sale Report</h2>
							<input type="button" value="Today report" onclick="viewToday(); showMe(1);" style="width:100px">
							<input type="button" value="Hot sale" onclick="viewHotSale();  showMe(0);" style="width:100px">
							<input type="button" value="Sale products" onclick="viewSaleProduct();  showMe(0);" style="width:100px">
							<input type="button" value="Stock products" onclick="viewStock();  showMe(0);" style="width:100px">
							<br><br>

							<!-- filter date -->
							<div id="hide_date" style="display:block;">
								<!-- start date -->
								Start Date <img src="../images/dot.gif" /> 
								<select id="start_day">
									<option value=""> -- Day -- </option>
									<?for($d=1;$d<=31;$d++)
									{?>
										<option value="<?=$d?>"><?=$d?></option>
									<?}?>
								</select>
								<select id="start_month">
									<option value=""> -- Month -- </option>
									<?for($m=1;$m<=12;$m++)
									{?>
										<option value="<?=$m?>"><?=$m?></option>
									<?}?>
								</select>
								<select id="start_year">
									<option value=""> -- Year -- </option>
									<?
									$now = date("Y")-25;
									$year_end = date("Y")+25;
									for($y=$now;$y<=$year_end;$y++)
									{?>
										<option value="<?=$y?>"><?=$y?></option>
									<?}?>
								</select>
								<br>
								<!-- end date -->
								<?
									$today_d = date("d");
									$today_m = date("m");
									$today_y = date("Y");
								?>
								End Date &nbsp;&nbsp;<img src="../images/dot.gif" /> 
								<select id="end_day">
									<option value=""> -- Day -- </option>
									<?for($d=1;$d<=31;$d++)
									{?>
										<option value="<?=$d?>" <?if($d==$today_d){?>selected<?}?>><?=$d?></option>
									<?}?>
								</select>
								<select id="end_month">
									<option value=""> -- Month -- </option>
									<?for($m=1;$m<=12;$m++)
									{?>
										<option value="<?=$m?>" <?if($m==$today_m){?>selected<?}?>><?=$m?></option>
									<?}?>
								</select>
								<select id="end_year">
									<option value=""> -- Year -- </option>
									<?
									$now = date("Y")-25;
									$year_end = date("Y")+25;
									for($y=$now;$y<=$year_end;$y++)
									{?>
										<option value="<?=$y?>" <?if($y==$today_y){?>selected<?}?>><?=$y?></option>
									<?}?>
								</select>
								<br>
								<input type="button" value="Search" style="width:60px;" onclick="viewTodayFilter();">
							</div>
							<!-- end filter date -->
<!--
<br><BR>
							<div id="line"></div>
<br><br>
-->
							<div style="text-align:center;">
							<div style="width: 800px; height: 350px; overflow: auto; padding: 5px">
								<div id="report_content">
									<!-- table show color -->
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


	<script type="text/javascript"> 
		function showMe (click_button) 
		{ 
		  if (click_button==1)
		  {
			  document.getElementById('hide_date').style.display = "block";
		  }
		  else
		  {
			  document.getElementById('hide_date').style.display = "none";
		  }
		} 
	</script>