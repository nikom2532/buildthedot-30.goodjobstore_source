<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
include_once '../classes/Products.php';
//Initialization
include_once '../classes/Employees.php';
$login = 'Log in';
$logout = 'Register';
$link = 'profile.php';
	//$get_empid = $_GET['id'];
	$getemp = new Employees();
	//$get = $getemp->emp($get_empid);
	$getlastname = $getemp->getLastName();
	$getemail = $getemp->getEmail();
	$login = $getemp->getFirstName()." ".$getemp->getLastName();
	$logout = 'Log out';
	if(isset($getfirstname)==0&&isset($getlastname)==0)
		{
			$login = $getemp->getEmail();
		} 
//Product Page
	if(!empty($_POST['UPDATE']))
{
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		//$Product_Code = $_POST['Product_Code'];
		$Product_Name_Th = $_POST['Product_Name_Th'];
		$Product_Name_En = $_POST['Product_Name_En'];
		$Description_Th = $_POST['Description_Th'];
		$Description_En = $_POST['Description_En'];
		$Size = $_POST['Size'];
		$Property_Th = $_POST['Property_Th'];
		$Property_En = $_POST['Property_En'];
		$Price_Buy = $_POST['Price_Buy'];
		$Price_sale = $_POST['Price_sale'];
		$Discount_PC = $_POST['Discount_PC'];
		$Discount_Num = $_POST['Discount_Num'];
		$Short_msg_Th = $_POST['Short_msg_Th'];
		$Short_msg_En = $_POST['Short_msg_En'];
		$Qty = $_POST['Qty'];
		$Sale_min = $_POST['Sale_min'];
		$Sale_max = $_POST['Sale_max'];
		$KeyWord = $_POST['KeyWord'];
		$Weight = $_POST['Weight'];
		$Url_Th = $_POST['Url_Th'];
		$Url_En = $_POST['Url_En'];
		$Discount_Status = $_POST['Discount_Status'];
		$Product_Status = $_POST['Product_Status'];
		
		$product = new Products();
		$pro_id = "";
		$Product_Code = "";
		
		$pro = $product->product($pro_id,$Product_Code,$Product_Name_Th,$Product_Name_En,$Description_Th
		,$Description_En,$Size,$Property_Th,$Property_En,$Price_Buy,$Price_sale,$Discount_PC,$Discount_Num
		,$Short_msg_Th,$Short_msg_En,$Qty,$Sale_min,$Sale_max,$KeyWord,$Weight,$Url_Th,$Url_En,$Discount_Status,$Product_Status);
		if($pro == 0)
		{		
			$_SESSION['PRODUCT']= $product;
			echo "<script>alert('INSERT')</script>";
		}
	}

}
	$pro_code = new Products();
	$get_pro = $pro_code->selectPro_code();

		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$get_id = $_POST['lmName1'];
			$select_code = $pro_code->selectcode($get_id);
			$get_en = $pro_code->getPro_Name_En();
			$get_id = $pro_code->getProduct_ID();
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
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div class="logo"><a href ="../"><img src="../images/logo.jpg" /></a></div>
			<div class="right">
				<ul class="member_style">
					<li class="line"><a href="<?=$link?>?id=<?=$id?>"><?=$login?></a></li> 
					<li><a href="../admin/"><?=$logout?></a></li>
				</ul>
			</div>
		</div>
		
		<!-- Body Section -->
		<div id="title_head">
		Back Office
		</div>
		<div id="content">
		    <div id="leftcolum">
			    <ul>
			        <li><a href="profile.php?id=<?=$get_empid?>">Profile</a></li>
			        <li><a href="category.php?id=<?=$get_empid?>">Category</a></li>
			        <li><a href="sub-category.php?id=<?=$get_empid?>">Sub Category</a></li>
					<li><a class="active" href="product.php?id=<?=$get_empid?>">Product</a></li>
					<li><a href="employee.php?id=<?=$get_empid?>">Employee</a></li>
					<li><a href="customer.php?id=<?=$get_empid?>">Customer</a></li>
					<li><a href="Shopping Guide.php?id=<?=$get_empid?>">Shopping Guide</a></li>
			    </ul>
		   	</div>
			<div id="dashboard"> 
				<div id="scrollbar1">
					<div class="scrollbar">
						<div class="track">
							<div class="thumb">
								<div class="end">
								</div>
							</div>
						</div>
					</div>
					<div class="viewport">
						 <div class="overview">
						 	<h2>Product</h2>
							<form action="Product_type.php" method="post">
									Product Code <!--<echo $_POST["lmName1"];?>.<=$get_id?>.--><?=$get_id?><br>
								<select name="lmName1">
								<option value=""><-- Please Select Item --></option>
								<option value="<? echo $pro_code->getpro_code();?>" ><? echo $pro_code->getpro_code();?></option>
								</select>
								<input name="btnSubmit" type="submit" value="Submit">
								<input name="cancel" type="button" value="Cancel" onclick="window.location.href='Product_type.php'">
							</form>
						 	<form action="product_type.php" method="POST" name="product">
					<table>
						<tbody>
							<tr>
								<td width="200px">Product_Name_Th</td>
								<td width="30px"><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Product_Name_Th" /></td>
							</tr>
							<tr>
								<td>Product_Name_En </td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Product_Name_En" value="<?=$get_en?>"/></td>
							</tr>
							<tr>
								<td>Description_Th</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Description_Th" /></td>
							</tr>
							<tr>
								<td>Description_En</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Description_En" /></td>
							</tr>
							<tr>
								<td width="200px">Size</td>
								<td width="30px"><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Size" /></td>
							</tr>
							<tr>
								<td>Property_Th</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Property_Th"/></td>
							</tr>
							<tr>
								<td>Property_En</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Property_En"/></td>
							</tr>
							<tr>
									<td>Price_Buy</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Price_Buy"/></td>
							</tr>
							<tr>
									<td>Price_sale</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Price_sale"/></td>
							</tr>
							<tr>
									<td>Discount_PC</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Discount_PC"/></td>
							</tr>
							<tr>
									<td>Discount_Num</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Discount_Num"/></td>
							</tr>
							<tr>
									<td>Short_msg_Th</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Short_msg_Th"/></td>
							</tr>
							<tr>
									<td>Short_msg_En</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Short_msg_En"/></td>
							</tr>
							<tr>
									<td>Qty</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Qty"/></td>
							</tr>
							<tr>
									<td>Sale_min</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Sale_min"/></td>
							</tr>
							<tr>
									<td>Sale_max</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Sale_max"/></td>
							</tr>
							<tr>
									<td>KeyWord </td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="KeyWord"/></td>
							</tr>
							<tr>
									<td>Weight</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Weight"/></td>
							</tr>
							<tr>
									<td>Url_Th</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Url_Th"/></td>
							</tr>
							<tr>
									<td>Url_En</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Url_En"/></td>
							</tr>
							<tr>
									<td>Discount_Status </td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Discount_Status"/></td>
							</tr>
							<tr>
									<td>Product_Status</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Product_Status"/></td>
							</tr>
							<tr>
							
								<td>
							
									<input type="submit" id="submit1" name="UPDATE" value=" Submit ">
								</td>
							</tr>
						</tbody>
					</table>
				</form>
						 	<div id="line"></div>
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
