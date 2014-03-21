<?php
	session_start();
//Get Value for Billing Address
	include_once 'classes/Customers.php';
	//$get_cusid = $_GET['id'];
	$get_cusid = $_SESSION['Cus'];
	$getcus = new Customers();
	$get = $getcus->cus($get_cusid);
	$getemail = $getcus->getemail();
	$getfirstname = $getcus->getFirstName();
	$getlastname = $getcus->getLastName();
	$getphone = $getcus->getPhone_Number();
	$getaddress = $getcus->getAddress();
	$getcode = $getcus->getPostal_Code();
//Update Data Billing to table	
	if(!empty($_POST['update']))
	{
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$email = $_POST['email'];
		$firstname = $_POST['fistname'];
		$lastname = $_POST['lastname'];
		$phonenumber = $_POST['phonenumber'];
		$address = $_POST['address'];
		$postcode = $_POST['postcode'];
		$insert = new Customers();
		$ins = $insert->insert($firstname,$get_cusid,$lastname,$phonenumber,$address,$postcode,$email);
		if($ins == 0)
		{
			$_SESSION['INSERT']= $insert;
		//	echo "<script>alert('$id')</script>";
		}
	}
	}
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
	<?include("script-menu.php");?>
	<link rel="stylesheet" type="text/css" href="css/menu.css">
	<script type="text/javascript" src="scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
		});
	</script>
</head>
<body>
	<div id="wrapper">
		<!-- Header Section -->
		<? include("header.php"); ?>

		<!-- Body Section -->
		<div id="title_head">
		MY INFO 
		</div>
		<div id="content">
		    <div id="leftcolum">
			    <ul>
					<li><a href="notification.php?id=<?=$get_cusid?>">Notification</a></li>
					<li><a class="active" href="my-info.php?id=<?=$get_cusid?>">My info</a></li>
					<li><a href="order-history.php?id=<?=$get_cusid?>">Order History</a></li>
					<li><a href="wishlist.php?id=<?=$get_cusid?>">Wishlist</a></li>
					<li><a href="shopping-cart.php?id=<?=$get_cusid?>">My cart</a></li>
					<li><a href="my-coupon.php?id=<?=$get_cusid?>">My coupon</a></li>
				</ul>
		   	</div>
		   	<form action="my-info.php?id=<?=$get_cusid?>" method="POST" name="billing">
			<!-- Billing Address -->
			<div id="content_billing">
				<div id="line"></div>
				<div id="scrollbar1">
					<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
					<div class="viewport">
						<div class="overview">
							<div id="billing">
							<h4>Billing Address</h4>
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
											<td><input type="text" name="fistname" value="<?=$getfirstname?>"/></td>
										</tr>
										<tr>
											<td>Last name</td>
											<td><img src="images/dot.gif" /></td>
											<td><input type="text" name="lastname" value="<?=$getlastname?>"/></td>
										</tr>
										<tr>
											<td>Phone number</td>
											<td><img src="images/dot.gif" /></td>
											<td><input type="text" name="phonenumber" value="<?=$getphone?>"/></td>
										</tr>
										<tr>
											<td>Address</td>
											<td><img src="images/dot.gif" /></td>
											<td><input type="text" name="address" value="<?=$getaddress?>"/></td>
										</tr>
										<tr>
											<td>Province</td>
											<td><img src="images/dot.gif" /></td>
											<td>
												<div class="styled-select">
													<select name="province">
									                    <option value=" ">------ Select Province -----</option>
									                   	<option value="กระบี่">กระบี่ </option>
									                   	<option value="กำแพงเพชร">กำแพงเพชร </option>
									                    <option value="กรุงเทพมหานคร">กรุงเทพมหานคร </option>
									                    <option value="กาญจนบุรี">กาญจนบุรี </option>
								                    </select>
								                </div>
											</td>
										</tr>
										<tr>
												<td>Postal code</td>
												<td><img src="images/dot.gif" /></td>
												<td>
													<input type="text" name="postcode" value="<?=$getcode?>"/
												</td>
												
										</tr>
									</tbody>
								</table>
								<div id="line2"></div>
								<div id="checkbox">
									<input type="checkbox" name="c1" onclick="showMe('div1', this)" > &nbsp;Same as Billing Address
								</div>
								
								<div id="div1">
								<h4>Shipping Address</h4>
								<table>
									<tbody>
										<tr>
											<td width="100px">First name</td>
											<td width="30px"><img src="images/dot.gif" /></td>
											<td><input type="text" name="fistName" /></td>
										</tr>
										<tr>
											<td>Last name</td>
											<td><img src="images/dot.gif" /></td>
											<td><input type="text" name="lastName" /></td>
										</tr>
										<tr>
											<td>Address</td>
											<td><img src="images/dot.gif" /></td>
											<td><input type="text" name="address" /></td>
										</tr>
										<tr>
											<td>Province</td>
											<td><img src="images/dot.gif" /></td>
											<td>
												<div class="styled-select">
													<select name="province">
									                    <option value=" ">------ Select Province -----</option>
									                   	<option value="กระบี่">กระบี่ </option>
									                   	<option value="กำแพงเพชร">กำแพงเพชร </option>
									                    <option value="กรุงเทพมหานคร">กรุงเทพมหานคร </option>
									                    <option value="กาญจนบุรี">กาญจนบุรี </option>
								                    </select>
								                </div>
											</td>
										</tr>
										<tr>
												<td>Postal code</td>
												<td><img src="images/dot.gif" /></td>
												<td><input type="text" name="postCode" /></td>
										</tr>
									</tbody>
								</table>
								</div> <!-- end div1 -->
								
						</div><!-- end div billing -->
					</div>
				</div><!-- end div scrollbar -->
				<div id="form_button">
					<input type="button" name="cancel" value="CANCEL">
					<input type="submit" name ="update" value="UPDATE" class="button" onClick="window.location.reload()">
				</div>	
			</div> <!-- end div content_billing -->
			</form>
		</div>  <!-- end div content -->              
		<!-- Footer Section -->
		<? include("footer.php"); ?>

	</div>
<script>
function showMe (it, box) {
  var vis = (box.checked) ? "hidden" : "visible";
  document.getElementById(it).style.visibility = vis;
}
</script>
</body>
</html>
