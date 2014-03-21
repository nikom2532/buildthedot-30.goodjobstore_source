<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
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
	$howID = $_GET['howID'];

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

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT * FROM how_delivery WHERE How_ID = $howID";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>


<html>
<head>
	<title>GOODJOB - Administration</title>
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="ajax/ajax.shipper.java"></script>
</head>

<!-- add shipper -->
<?
	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmAddShipper")) 
	{
		$m_Name_EN = $_POST['Shipper_En'];
			$Name_EN = str_replace("'","''",$m_Name_EN);
		$m_Name_TH = $_POST['Shipper_Th'];
			$Name_TH = str_replace("'","''",$m_Name_TH);
		$m_Descrip_EN = $_POST['Descrip_En'];
			$Descrip_EN = str_replace("'","''",$m_Descrip_EN);
		$m_Descrip_TH = $_POST['Descrip_Th'];
			$Descrip_TH = str_replace("'","''",$m_Descrip_TH);

		$strSQL = "UPDATE how_delivery SET 
					Name_Th='$Name_TH',
					Name_En='$Name_EN',
					Description_Th='$Descrip_TH',
					Description_En='$Descrip_EN' 
					WHERE How_ID = '$howID'";
		mysql_query($strSQL, $objCon) or die(mysql_error());
		header("Location: shipper.php");
	}
?>

<body>
	<script>
		viewTable();
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
							<h2>Edit Shipper</h2>
														<div style="height:1000px;width:800px;Serif;overflow-y:auto;overflow-x: hidden;">

						 	<form action="" method="post" enctype="multipart/form-data" name="frmAddShipper" id="frmAddShipper"	>
							<?
							while ($data=mysql_fetch_array($result))
							{?>
								<table>
									<tr>
										<td style="width:150px;">Shipper [En]</td>
										<td style="width:15px;"><img src="../images/dot.gif" /></td>
										<td style="width:300px;"><input type='text' name='Shipper_En'value="<?=$data['Name_En']?>"></td>
					
									</tr>
									 <tr><td><br></td></tr>
									<tr>
										<td>Shipper [Th]</td>
										<td><img src="../images/dot.gif" /></td>
										<td><input type='text' name='Shipper_Th' value="<?=$data['Name_Th']?>"></td>
									</tr>
									<tr>
									</table>

									<br>Description [En]     <img src="../images/dot.gif" style="padding-left:5.0em;" /><br><br>
									<table>
										
										<td>
											<textarea name="Descrip_En" id="Descrip_En" style="width:450px;height:200px;"/><?=$data['Description_En']?></textarea>
											<!--CKEDITOR-->
<script type="text/javascript">
	CKEDITOR.replace( 'Descrip_En' );
</script>
<!--CKEDITOR-->
										</td>
									</tr>
									</table>
										
									<br>Description [Th]     <img src="../images/dot.gif" style="padding-left:5.0em;" /><br><br>
									<table>
										
										<td><textarea name="Descrip_Th" id="Descrip_Th" style="width:450px;height:200px;"/><?=$data['Description_Th']?></textarea>
																					<!--CKEDITOR-->
<script type="text/javascript">
	CKEDITOR.replace( 'Descrip_Th' );
</script>
<!--CKEDITOR-->
										</td>
									</tr>
								</table>
							<?}?>
										<br>
								<input type='submit' value='Edit' style="width:60px">
								<input type="hidden" name="MM_insert" value="frmAddShipper" />
								<input type='button' value='Cancel' onclick="window.location.href='shipper.php'" style="width:60px">
							</form>		
							</div>
							<br><br>
							<div id="line"></div>

							<div id="shipper_content">
								<!-- view shipper Table -->
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
