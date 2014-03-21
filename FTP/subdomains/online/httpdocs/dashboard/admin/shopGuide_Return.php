<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$strSQL = "SELECT Return_Change_Th,Return_Change_En FROM shopping_guide WHERE Guide_ID=1";
	$result = mysql_query($strSQL, $objCon) or die(mysql_error());

	while($data=mysql_fetch_array($result))
	{
		$returnEN = $data['Return_Change_En'];
		$returnTH = $data['Return_Change_Th'];
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
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
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
	<script src="ajax/ajax.shoppingGuide.java"></script>
</head>

<!-- update about us -->
<?
	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmReturn")) 
	{
		$m_Descrip_EN = $_POST['Descrip_En'];
			$Descrip_EN = str_replace("'","''",$m_Descrip_EN);
		$m_Descrip_TH = $_POST['Descrip_Th'];
			$Descrip_TH = str_replace("'","''",$m_Descrip_TH);

		$strSQL = "UPDATE shopping_guide SET Return_Change_Th='$Descrip_TH', Return_Change_En='$Descrip_EN' 
					WHERE Guide_ID = 1";
		mysql_query($strSQL, $objCon) or die(mysql_error());
		header("Location: shopGuide_main.php");
	}
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
						<div class="overview">
							<h2>Edit Return & Exchange</h2>
							<form  action="" method="post" enctype="multipart/form-data" name="frmReturn" id="frmReturn">
								<table>
										<tr>
											<td>Return & Exchange [EN]</td>	<td><img src="../images/dot.gif" style="padding-left:5.0em;" /></td>

										</tr>
								</table>
								<br>
								<table>
										<tr>	
											<td><textarea name='Descrip_En' id='Descrip_En'  style="width:450px;height:200px;"><?=$returnEN?></textarea></td>
										</tr>
								</table>
								<!--CKEDITOR-->
								<script type="text/javascript">
										CKEDITOR.replace( 'Descrip_En' );
								</script>
								<!--CKEDITOR-->
								<br>
								<table>
										<tr>
											<td>Return & Exchange [TH]</td>
											<td><img src="../images/dot.gif" style="padding-left:5.0em;" /></td>
										</tr>
								</table>
								<br>
								<table>
										<tr>
											<td><textarea name='Descrip_Th' id='Descrip_Th'  style="width:450px;height:200px;"><?=$returnTH?></textarea></td>
										</tr>
								</table>
								<!--CKEDITOR-->
								<script type="text/javascript">
										CKEDITOR.replace( 'Descrip_Th' );
								</script>
								<!--CKEDITOR-->
<br><br>
							<div id="line"></div>
							<input type='submit' value="Update" style="width:60px;">
							<input type="hidden" name="MM_insert" value="frmReturn" />
							<input type='button' value="Cancel" onclick="window.location.href='shopGuide_main.php'" style="width:60px;">
							</form>
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