<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?
	$proCode = $_GET['proCode'];
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
	<script src="ajax/ajax.product.java"></script>
	<script type="text/javascript"> 
		function showMe (it, box) 
		{ 
		  var vis = (box.checked) ? "block" : "none"; 
		  document.getElementById(it).style.display = vis;
		} 
	</script>	

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	//------ Gen Product ID -------
	$sqlGenID = "SELECT  Product_ID  FROM products ORDER BY Product_ID DESC LIMIT 0,1";
	$resultGenID = mysql_query($sqlGenID, $objCon) or die(mysql_error());

	while ($data=mysql_fetch_array($resultGenID))
	{
		$genProID = substr($data['Product_ID'], -6);
		$genProID += 1;
		$genProID = sprintf("%06d", $genProID);
		$genProID = "PR".$genProID;
	}

	//---- Dropdown Property ----
	$sqlProperty = "SELECT prop_id,name_en FROM property ORDER BY name_en";
	$resultProperty = mysql_query($sqlProperty, $objCon) or die(mysql_error());
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
							<h2>Add -- <?=$proCode?> -- Product</h2>
						 	<form name="frmAddProduct">
							<div style="width: 800px; height: 400px; overflow: auto; padding: 5px">
								<table style="width:400px">
									<tbody>			
										<!----------- Description ----------->
										<tr>
										<td><br></td>
										</tr>
										<tr style="display:none;">
											<td>Property Name</td>
											<td><img src="../images/dot.gif" /><PRE>          </pre></td>
											<td><input type="text" name="Property_Name" /></td>
										</tr>
										<tr>
											<td>Property</td>
											<td><img src="../images/dot.gif" /><PRE>          </pre></td>
											<td>
												<select name="selectProperty"\>
													<?
													while ($dataProperty=mysql_fetch_array($resultProperty))
													{?>
														<option value="<?=$dataProperty['prop_id']?>"><?=$dataProperty['name_en']?></option>
													<?}?>
												</select>
											</td>
										</tr>
										<tr>
										<td><br></td>
										</tr>

										<!----------- Price ----------->
										<tr>
											<td>Price</td>
											<td><img src="../images/dot.gif" /></td>
											<td><input type="text" name="Price"/></td>
										</tr>
										<tr>
											<td>Discount</td>
											<td><img src="../images/dot.gif" /></td>
											<td><input type="checkbox" name="modtype" id="modtype" value="1" onclick="showMe('hide_discount', this)" >  Yes</input></td>
										<tr>
											<td></td>
											<td></td>
											<td>
												<div id="hide_discount" style="display:none">
													<input type="text" name="Discount">
													<select name="DiscountType">
														<option value="Discount_num" >Baht</option>
														<option value="Discount_PC" >%</option>
													</select>
												</div>
											</td>
										</tr>
										<tr>
										<td><br></td>
										</tr>

										<!---------- Description --------->
										<tr>
										<td><br></td>
										</tr>
										<tr>
												<td>Quantity</td>
												<td><img src="../images/dot.gif" /></td>
												<td><input type="text" name="qty"/></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>
										<tr>
												<td>Sale min</td>
												<td><img src="../images/dot.gif" /></td>
												<td><input type="text" name="Sale_min"/></td>
										</tr>
										<tr>
												<td>Sale max</td>
												<td><img src="../images/dot.gif" /></td>
												<td><input type="text" name="Sale_max"/></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>
										<tr>
												<td>Weight(Kg)</td>
												<td><img src="../images/dot.gif" /></td>
												<td><input type="text" name="Weight"/><td>
										</tr>
										<tr>
										<td><br></td>
										</tr>
									</tbody>
								</table>
								</div>
								<div id="line"></div>
								
						
					</div>
				</div>	
				<input type='button' value='Next' onclick="addProduct('<?=$genProID?>','<?=$proCode?>');" style="width:60px;">
								<input type='button' value='Cancel' onclick="window.location.href='viewProduct.php?proCode=<?=$proCode?>'" style="width:60px;">
								<input type="hidden" name="MM_insert" value="frmAddProduct" />
							</form>	<!-- End Content -->  
			</div>

		</div>
			     
		
	<!-- Footer Section -->
		<div id="footer">
			<div class="payment_logo"><img src="../images/payment_logo.jpg" /></div>
			<div class="copyright">? 2011 - 2015 GOODJOB CO., LTD</div>
		</div>
	
	</div>

</body>
</html>