<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?php
session_start();
$ses_userid =$_SESSION[ses_userid];
$ses_username = $_SESSION[ses_username];
if($ses_userid <> session_id() or $ses_username =="")
{
echo "Please Login to system<br />";
}

if($_SESSION[ses_status] != "Super Admin" && $_SESSION[ses_status] != "Admin") 
{
echo "This page for Admin only!";
echo "<br><a href=index.php>Back</a>";
exit();
}
?>


<html>
<head>
	<title>GOODJOB - Administration</title>

	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="ajax/ajax.order.java"></script>
	<script>
		function filterStatus()
		{
			var filterStat = document.frmFilterStatus.filter_status.value;
			viewTable(filterStat,'');
		}
	</script>
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
		   	</div>
			<div id="dashboard"> 

					<div class="viewport">
						<div class="overview">
							<h2>Order Status</h2>
												<div style="text-align:center;">

						 	
								<table>
									<form name="frmFilterStatus">
										<tr style="height:30px;">
											<td style="width:70px;">Status</td>
											<td style="width:15px;"><img src="../images/dot.gif" /></td>
											<td>
												<select name="filter_status" onchange="filterStatus()">
													<option value="0">Show all</option>
													<option value="1">Pending</option>
													<option value="2">Payment Received</option>
													<option value="3">Shipped</option>
													<option value="4">Refund</option>
													<option value="5">Cancel</option>
												</select>
											</td>
										</tr>
										<tr>
											<td><br></td>
										</tr>
									</form>		
										<tr>
											<td style="width:70px;">Search</td>
											<td style="width:15px;"><img src="../images/dot.gif" /></td>
											<td><input type="text" id="orderSearch" onKeyPress="javascript:if(event.keyCode==13)searchOrder();"></td>
											<td><input type="button" value="search" style="width:70px;" onclick="searchOrder();"></td>
										</tr>
										<tr>
											<td><br></td>
										</tr>
									</tbody>
								</table>
							<div id="line"></div>
							<div style="width: 800px; height: 400px; overflow: auto; padding: 5px">

							<div id="order_content">
									<script>viewTable('0','');</script>
								<!-- table show order -->
							</div>
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
		function showMe (id, ship, box) 
		{ 
		  var status = $("#change_status_"+id).val();
		  if (status==3 || status==4)
		  {
			  document.getElementById(ship).style.display = "block";
		  }
		  else
		  {
			  document.getElementById(ship).style.display = "none";
		  }
		} 
	</script>