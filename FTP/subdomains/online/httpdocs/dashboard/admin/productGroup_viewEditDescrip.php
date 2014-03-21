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

	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sqlProGroup = "SELECT * FROM product_groups
					WHERE Product_Code = '$proCode'";
	$resultProGroup = mysql_query($sqlProGroup, $objCon) or die(mysql_error());
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
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="ajax/ajax.productGroup.java"></script>
</head>

<!-- add product -->
<?
	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "frmAddProduct")) 
	{
		$productCode = $_POST['Product_Code'];
		$m_proNameEN = $_POST['Product_Name_En'];
			$proNameEN = str_replace("'","''",$m_proNameEN);
		$m_proNameTH = $_POST['Product_Name_Th'];
			$proNameTH = str_replace("'","''",$m_proNameTH);
		$m_descripEN = $_POST['Description_En'];
			$descripEN = str_replace("'","''",$m_descripEN);
		$m_descripTH = $_POST['Description_Th'];
			$descripTH = str_replace("'","''",$m_descripTH);
		$proSize = $_POST['Size'];
		$proWidth = $_POST['s_width'];
		$proLength = $_POST['s_length'];
		$proHeight = $_POST['s_height'];
		$groupPrice = $_POST['price'];
		$m_proMsgEN = $_POST['Short_msg_En'];
			$proMsgEN = str_replace("'","''",$m_proMsgEN);
		$m_proMsgTH = $_POST['Short_msg_Th'];
			$proMsgTH = str_replace("'","''",$m_proMsgTH);
		$proKeyWord = $_POST['KeyWord'];
		$proUrlEN = $_POST['Url_En'];
		$proStatus = $_POST['Product_Status'];
		$proAtt = $_POST['Product_Attribute'];
		$proBox = $_POST['Product_Box'];

		//********************** check product_code **************************
		if($productCode!=$proCode)
		{
			$sqlCheckProCode = "SELECT Product_Code FROM product_groups WHERE Product_Code = '$productCode'";
			$resultCheckProCode = mysql_query($sqlCheckProCode, $objCon) or die(mysql_error());
			$CheckProCode = mysql_fetch_row($resultCheckProCode);
		}
		if(!$CheckProCode AND $productCode!='' AND $proNameEN!='')
		{
			//************************ sql Edit Product Groups ***************************
				$sqlEditProGroup = "UPDATE product_groups SET
									Product_Code='$productCode',Group_Name_En='$proNameEN',Group_Name_Th='$proNameTH',Group_Description_En='$descripEN',Group_Description_Th='$descripTH',Group_Size='$proSize',Group_width='$proWidth',Group_length='$proLength',Group_height='$proHeight',price_default='$groupPrice',Group_msg_En='$proMsgEN',Group_msg_Th='$proMsgTH',Group_KeyWord='$proKeyWord',Group_Url_En='$proUrlEN',Group_Url_Th='$proUrlTH',Group_Status='$proStatus',Group_attribute_id='$proAtt',Group_gift_box='$proBox'
									WHERE Product_Code='$proCode'";
				mysql_query($sqlEditProGroup, $objCon) or die(mysql_error());

			//************************ sql Edit Products ****************************
				$sqlEditProduct = "UPDATE products SET
									Product_Code='$productCode',Pro_Name_En='$proNameEN',Pro_Name_Th='$proNameTH',Description_En='$descripEN',Description_Th='$descripTH',Size='$proSize',Short_msg_En='$proMsgEN',Short_msg_Th='$proMsgTH',KeyWord='$proKeyWord',Url_En='$proUrlEN',Url_Th='$proUrlTH',Product_Status='$proStatus',attribute_id='$proAtt',gift_box='$proBox'
									WHERE Product_Code = '$proCode'";
				mysql_query($sqlEditProduct, $objCon) or die(mysql_error());

			//*************** sql Edit other table about product_code **************
				$sqlEditImage = "UPDATE images SET Product_Code='$productCode' WHERE Product_Code='$proCode'";
				mysql_query($sqlEditImage, $objCon) or die(mysql_error());

				$sqlEditCross = "UPDATE cross_sale SET Product_Code='$productCode' WHERE Product_Code='$proCode'";
				mysql_query($sqlEditCross, $objCon) or die(mysql_error());

				$sqlEditCrossCode = "UPDATE cross_sale SET Product_Cross_Code='$productCode' WHERE Product_Cross_Code='$proCode'";
				mysql_query($sqlEditCrossCode, $objCon) or die(mysql_error());

			header("Location: productGroup.php");
		}
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
							<h2>Edit -- <?=$proCode?> -- Group</h2>
						 	<form action="" method="post" enctype="multipart/form-data" name="frmAddProduct" id="frmAddProduct">
						<div style="width: 800px; height: 400px; overflow: auto; padding: 5px">
								<table style="width:400px">
									<?while ($dataProGroup=mysql_fetch_array($resultProGroup))
									{?>
										<!----------- Description ----------->
										<tr>
										<td><br></td>
										</tr>
										<tr>
											<td>Product Code</td>
											<td><img src="../images/dot.gif" /></td>
											<td><input type="text" name="Product_Code" value="<?=$dataProGroup['Product_Code']?>"/></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>
										<tr>
											<td>Product Name [En]</td>
											<td><img src="../images/dot.gif" /><PRE>          </pre></td>
											<td><input type="text" name="Product_Name_En" value="<?=$dataProGroup['Group_Name_En']?>"/></td>
										</tr>
										<tr>
											<td>Product Name [Th] </td>
											<td><img src="../images/dot.gif" /></td>
											<td><input type="text" name="Product_Name_Th" value="<?=$dataProGroup['Group_Name_Th']?>"/></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>
										</table>
										<table>
										<tr>
											<td>Description [En]</td>
											<td><img src="../images/dot.gif" style="padding-left:4.2em;" /></td>
										</tr>
										</table>
										<br>
										<table>
										<tr>
											<td>
												<textarea name="Description_En" id="Description_En" style="width:450px;height:200px;"/><?=$dataProGroup['Group_Description_En']?></textarea>
											</td>
											<!--CKEDITOR-->
											<script type="text/javascript">
												CKEDITOR.replace( 'Description_En' );
											</script>
											<!--CKEDITOR-->
										</tr>
										</table>
										<br>
										<table>
										<tr>
											<td>Description [Th]</td>
											<td><img src="../images/dot.gif" style="padding-left:4.2em; " /></td>	
										</tr>
										</table>
										<br>
										<table>
										<tr>
											<td>
												<textarea name="Description_Th" id="Description_Th" style="width:450px;height:200px;"/><?=$dataProGroup['Group_Description_Th']?></textarea>
											</td>
										</tr>
										<!--CKEDITOR-->
											<script type="text/javascript">
												CKEDITOR.replace( 'Description_Th' );
											</script>
											<!--CKEDITOR-->
										</tr>
										</table>
										<br>
										<table>
										<tr>
										<td><br></td>
										</tr>
<!--
										<tr>
											<td width="150px">Size(Cm)</td>
											<td width="30px"><img src="../images/dot.gif" /></td>
											<td><input type="text" name="Size" value="<?=$dataProGroup['Group_Size']?>"/></td>
										</tr>
-->
											<td width="150px">Width(Cm)</td>
											<td width="30px"><img src="../images/dot.gif" /></td>
											<td><input type="text" name="s_width" value="<?=$dataProGroup['Group_width']?>"/></td>
										</tr>
										<tr>
											<td width="150px">Length(Cm)</td>
											<td width="30px"><img src="../images/dot.gif" /></td>
											<td><input type="text" name="s_length" value="<?=$dataProGroup['Group_length']?>"/></td>
										</tr>
										<tr>
											<td width="150px">Height(Cm)</td>
											<td width="30px"><img src="../images/dot.gif" /></td>
											<td><input type="text" name="s_height" value="<?=$dataProGroup['Group_height']?>"/></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>
										<tr style="display:none;">
											<td width="150px">Main Price</td>
											<td width="30px"><img src="../images/dot.gif" /></td>
											<td><input type="text" name="price" value="<?=$dataProGroup['price_default']?>"/></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>

										<!---------- Description --------->
										<tr>
												<td>Short message [En]</td>
												<td><img src="../images/dot.gif" /></td>
												<td><input type="text" name="Short_msg_En" value="<?=$dataProGroup['Group_msg_En']?>"/></td>
										</tr>
										<tr>
												<td>Short message [Th]</td>
												<td><img src="../images/dot.gif" /></td>
												<td><input type="text" name="Short_msg_Th" value="<?=$dataProGroup['Group_msg_Th']?>"/></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>
										<tr>
												<td>Tag </td>
												<td><img src="../images/dot.gif" /></td>
												<td><input type="text" name="KeyWord" value="<?=$dataProGroup['Group_KeyWord']?>"/></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>
										<tr>
												<td>Url [En]</td>
												<td><img src="../images/dot.gif" /></td>
												<td><input type="text" name="Url_En" value="<?=$dataProGroup['Group_Url_En']?>"/></td>
										</tr>
										
										<tr style="display:none;">
												<td>Url [Th]</td>
												<td><img src="../images/dot.gif" /></td>
												<td><input type="text" name="Url_Th" value="<?=$dataProGroup['Group_Url_Th']?>"/></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>

										<tr>
										<td><br></td>
										</tr>

										<!-------- Product Status ------>
										<tr>
												<td>Product Status</td>
												<td><img src="../images/dot.gif" /></td>
												<td>
													<select name="Product_Status">
														<option value="0" <?if($dataProGroup['Group_Status']==0){?>selected<?}?>>Unpublish</option>
														<option value="1" <?if($dataProGroup['Group_Status']==1){?>selected<?}?>>Publish</option>
													</select>
												</td>
										</tr>

										<!-------- Product attribute ------->
										<tr>
											<td>Attribute</td>
											<td><img src="../images/dot.gif" /></td>
											<td>
												<select name="Product_Attribute">
													<option value="0" <?if($dataProGroup['Group_attribute_id']==0){?>selected<?}?>>none</option>
													<option value="1" <?if($dataProGroup['Group_attribute_id']==1){?>selected<?}?>>New</option>
													<option value="2" <?if($dataProGroup['Group_attribute_id']==2){?>selected<?}?>>Hot</option>
													<option value="3" <?if($dataProGroup['Group_attribute_id']==3){?>selected<?}?>>Sale</option>
												</select>
											</td>
										<tr>

										<!-------- Product Bag ------>
										<tr>
												<td>Product Envelope/Box</td>
												<td><img src="../images/dot.gif" /></td>
												<td>
													<select name="Product_Box">
														<option value="1" <?if($dataProGroup['Group_gift_box']==1){?>selected<?}?>>Box</option>
														<option value="0" <?if($dataProGroup['Group_gift_box']==0){?>selected<?}?>>Envelope</option>
													</select>
												</td>
										</tr>
									<?}?>
								</table>
								</div>
								<div id="line"></div>
								
						
					</div>
				</div>	
				<input type='submit' value='Edit' style="width:60px;">
				<input type="hidden" name="MM_insert" value="frmAddProduct" />
								<input type='button' value='Cancel' onclick="window.location.href='productGroup.php'" style="width:60px;">
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