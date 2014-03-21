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


<html>
<head>
	<title>GOODJOB - Administration</title>

	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">


	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="ajax/ajax.categoryMain.java"></script>

</head>

<!-- add main category -->
<?
	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmAddCategoryMain")) 
	{
		$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
		$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
		mysql_query("SET NAMES utf8",$objCon);

		//----- set sort ----
		$sqlSort = "SELECT main_sort FROM main_menu ORDER BY main_sort DESC LIMIT 1";
		$resultSort = mysql_query($sqlSort, $objCon) or die(mysql_error());
		$mainSort = 1;
		while($dataSort=mysql_fetch_array($resultSort))
		{
			$mainSort = $dataSort['main_sort']+1;
		}

		$m_NameEN = $_POST['nameEN'];
			$nameEN = str_replace("'","''",$m_NameEN);
		$m_NameTH = $_POST['nameTH'];
			$nameTH = str_replace("'","''",$m_NameTH);
		$mainUrl = $_POST['mainUrl'];

		$strSQL = "INSERT INTO main_menu (Name_En,Name_Th,main_url,main_sort) 
					VALUES ('".$nameEN."','".$nameTH."','".$mainUrl."','".$mainSort."')";
		mysql_query($strSQL, $objCon) or die(mysql_error());
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
							<h2>Add Main Category</h2>
						 	<form action="" method="post" enctype="multipart/form-data" name="frmAddCategoryMain" id="frmAddCategoryMain">
								<table>
									<tbody>
										<tr style="height:30px;">
											<td style="width:70px;">Main [En]</td>
											<td style="width:15px;"><img src="../images/dot.gif" /></td>
											<td><input type='text' name='nameEN'></td>
										</tr>
										<tr style="height:30px;">
											<td style="width:70px;">Main [Th]</td>
											<td style="width:15px;"><img src="../images/dot.gif" /></td>
											<td><input type='text' name='nameTH'></td>
										</tr>
										<tr style="height:30px;">
											<td style="width:70px;">Url</td>
											<td style="width:15px;"><img src="../images/dot.gif" /></td>
											<td><input type='text' name='mainUrl'></td>
										</tr>
										<tr>
											<td><br></td>
										</tr>
									</tbody>
								</table>
								<input type='submit' value='Add' style="width:60px"><br>
								<input type="hidden" name="MM_insert" value="frmAddCategoryMain" />

								<!--<input type='button' value='Cancel' onclick="window.location.href='mainBO.php'" style="width:60px">-->
							</form>		
<br>
							<div id="line"></div>
							<div style="width: 800px; height: 350px; overflow: auto; padding: 5px">

							<div id="Main_content">
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
