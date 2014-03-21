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

<!--Permission-->
<html>
<head>
	<title>GOODJOB - Administration</title>

	<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="ajax/ajax.productGroup.java"></script>
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
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
		$proSize_w = $_POST['size_w'];
		$proSize_l = $_POST['size_l'];
		$proSize_h = $_POST['size_h'];
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

		$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
		$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
		mysql_query("SET NAMES utf8",$objCon);

		//********************** check product_code **************************
		$sqlCheckProCode = "SELECT Product_Code FROM product_groups WHERE Product_Code = '$productCode'";
		$resultCheckProCode = mysql_query($sqlCheckProCode, $objCon) or die(mysql_error());
		$CheckProCode = mysql_fetch_row($resultCheckProCode);
		if(!$CheckProCode AND $productCode!='' AND $proNameEN!='')
		{
			//----- set sort ----
			$sqlSort = "SELECT sort FROM product_groups ORDER BY sort DESC LIMIT 1";
			$resultSort = mysql_query($sqlSort, $objCon) or die(mysql_error());
			$groupSort = '1';
			while($dataSort=mysql_fetch_array($resultSort))
			{
				$groupSort = $dataSort['sort']+1;
			}
			//--- end set sort ---

			$sqlAddPro = "INSERT INTO product_groups (Product_Code,Group_Name_En,Group_Name_Th,Group_Description_En,Group_Description_Th,Group_width,Group_length,Group_height,price_default,Group_msg_En,Group_msg_Th,Group_KeyWord,Group_Url_En,Group_Url_Th,Group_Status,Group_attribute_id,sort,Group_gift_box) 
						VALUES ('".$productCode."','".$proNameEN."','".$proNameTH."','".$descripEN."','".$descripTH."','".$proSize_w."','".$proSize_l."','".$proSize_h."','".$groupPrice."','".$proMsgEN."','".$proMsgTH."','".$proKeyWord."','".$proUrlEN."','".$proUrlTH."','".$proStatus."','".$proAtt."','".$groupSort."','".$proBox."')";

			mysql_query($sqlAddPro, $objCon) or die(mysql_error());

			$next_pmeters = '?';
			$next_pmeters .= 'proCode='.$productCode;
			$next_pmeters .= '&proNameEN='.$proNameEN;
			$next_pmeters .= '&step=1';
			header("Location: productGroup_viewCatAndCross.php".$next_pmeters);
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
							<h2>Add Product Group</h2>
							
						 	<form action="" method="post" enctype="multipart/form-data" name="frmAddProduct" id="frmAddProduct">
														<div style="width: 800px; height: 400px; overflow: auto; padding: 5px">

								<table style="width:400px">
									<tbody>
										<!----------- Description ----------->
										<tr>
										<td><br></td>
										</tr>
<!--
										<tr>
											<td width="150px">Size(Cm)</td>
											<td width="30px"><img src="../images/dot.gif" /></td>
											<td><input type="text" name="Size" /></td>
										</tr>
-->
										<tr>
											<td>Product Code</td>
											<td><img src="../images/dot.gif" /></td>
											<td><input type="text" name="Product_Code" /></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>
										<tr>
											<td>Product Name [En]</td>
											<td><img src="../images/dot.gif" /><PRE>          </pre></td>
											<td><input type="text" name="Product_Name_En" /></td>
										</tr>
										<tr>
											<td>Product Name [Th] </td>
											<td><img src="../images/dot.gif" /></td>
											<td><input type="text" name="Product_Name_Th" /></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>
										</table>
										<table>
										<tr>
											<td style="width:96px">Description [En]</td>
											<td><img src="../images/dot.gif" style="padding-left:4.2em;" /></td>
										</tr>
										</table>
										<br>
										<table>
										<tr>
										<td>
										    <textarea name="Description_En" id="Description_En" style="width:450px;height:200px;"/></textarea>
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
											<td><textarea name="Description_Th" id="Description_Th" style="width:450px;height:200px;"/></textarea></td>
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
										<tr>
											<td width="150px">Width(Cm)</td>
											<td width="30px"><img src="../images/dot.gif" /></td>
											<td><input type="text" name="size_w" /></td>
										</tr>
										<tr>
											<td width="150px">Length(Cm)</td>
											<td width="30px"><img src="../images/dot.gif" /></td>
											<td><input type="text" name="size_l" /></td>
										</tr>
										<tr>
											<td width="150px">Height(Cm)</td>
											<td width="30px"><img src="../images/dot.gif" /></td>
											<td><input type="text" name="size_h" /></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>
										<tr style="display:none;">
											<td width="150px">Main Price</td>
											<td width="30px"><img src="../images/dot.gif" /></td>
											<td><input type="text" name="price" /></td>
										</tr>
										<tr>
										<td><br></td>
										</tr>

										<!---------- Description --------->
										<tr>
												<td>Short message [En]</td>
												<td><img src="../images/dot.gif" /></td>
												<td><input type="text" name="Short_msg_En"/></td>
										</tr>
										<tr>
												<td>Short message [Th]</td>
												<td><img src="../images/dot.gif" /></td>
												<td><input type="text" name="Short_msg_Th"/></td>
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
												<td><input type="text" name="KeyWord"/></td>
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
												<td><input type="text" name="Url_En"/></td>
										</tr>
										
										<tr style="display:none;">
												<td>Url [Th]</td>
												<td><img src="../images/dot.gif" /></td>
												<td><input type="text" name="Url_Th"/></td>
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
														<option value="0">Unpublish</option>
														<option value="1">Publish</option>
													</select>
												</td>
										</tr>

										<!-------- Product attribute ------->
										<tr>
											<td>Attribute</td>
											<td><img src="../images/dot.gif" /></td>
											<td>
												<select name="Product_Attribute">
													<option value="0">none</option>
													<option value="1">New</option>
													<option value="2">Hot</option>
													<option value="3">Sale</option>
												</select>
											</td>
										<tr>

										<!-------- Product Bag ------>
										<tr>
												<td>Product Envelope/Box</td>
												<td><img src="../images/dot.gif" /></td>
												<td>
													<select name="Product_Box">
														<option value="1">Box</option>
														<option value="0">Envelope</option>
													</select>
												</td>
										</tr>
									</tbody>
								</table>
								</div>
								<div id="line"></div>
								
				
					</div>
				</div>	
				<input type='submit' value='Next' style="width:60px;">
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