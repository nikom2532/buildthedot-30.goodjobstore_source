<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
include_once '../classes/Products.php';
include_once '../classes/Images.php';
include_once '../classes/Color.php';
include_once '../classes/Main_Menu.php';
include_once '../classes/Cross_Sale.php';
//Initialization
include_once '../classes/Employees.php';
include_once '../classes/property.php';
include_once '../classes/Cross_Property.php';
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
		
	//Cross
	$cross = new Cross_Sale();
	$get_cross = $cross->selectcross();
		
//Product Page
	if(!empty($_POST['UPDATE']))
{
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$product = new Products();
		$pro_code = $_GET['Product_code'];
		$select_id = $product->selectcode($pro_code);
		$pro_id = $product->getProduct_ID();
		//echo $pro_code.'9999999'.$pro_id;
		//$pro_id = '99999';
		
		$Product_Code = $pro_code;
		$Product_Name_Th = $_POST['Product_Name_Th'];
		$Product_Name_En = $_POST['Product_Name_En'];
		$Description_Th = $_POST['Description_Th'];
		$Description_En = $_POST['Description_En'];
		$Size = $_POST['Size'];
		$Property_Th = $_POST['Property_Th'];
		$Property_En = $_POST['Property_En'];
		$Price_Buy = $_POST['Price_Buy'];
		$Price_sale = $_POST['Price_sale'];
		$Discount_PC = null;
		$Discount_Num = null;
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
		
		$Discount = $_POST['Discount'];
		$operator = $_POST['operator'];
		
		if($operator == "Discount_num")
		$Price_sale = ($Price_sale - $Discount);
		
		elseif($operator == "Discount_PC")
		$Price_sale = ($Price_sale-($Price_sale*($Discount/100)));

		
		
		$pro = $product->Updateproduct($pro_id,$Product_Name_En);
		if($pro == 0)
		{		
			$_SESSION['PRODUCT']= $product;
			//echo "<script>alert('INSERT')</script>";
		}
	}
}		
		$pro = new Products();
		$Product_code = $_GET['Product_code'];
		
		$select_id = $pro->selectcode($Product_code);
		$pro_id = $pro->getProduct_ID();
		$get_code = $pro->getProduct_Code();
		$get_en = $pro->getPro_Name_En();
		$get_th = $pro->getPro_Name_TH();
		$get_desth = $pro->getDescription_TH();
		$get_desen = $pro->getDescription_EN();
		$get_size = $pro->getSize();
		$get_propth = $pro->getProperty_Th();
		$get_propen = $pro->getProperty_En();
		$get_priceb = $pro->getPrice_Buy();
		//$get_prices = $pro->getPrice_sale();
		$get_shortth = $pro->getShort_msg_Th();
		$get_shorten = $pro->getProperty_En();
		//$get_qty = $pro->getQty();
		$get_sale_min = $pro->getSale_min();
		$get_sale_max = $pro->getSale_max();
		$get_key = $pro->getKeyWord();
		$get_weight = $pro->getWeight();
		$get_url_th = $pro->getUrl_Th();
		$get_url_en = $pro->getUrl_En();
		$get_dis_stat = $pro->getDiscount_Status();
		$get_stat = $pro->getProduct_Status();
		$get_discount_num = $pro->getDiscount_Num();
		$get_discount_pc = $pro->getDiscount_PC();
		//echo '55555'.$Product_code.$get_en ;
//Property
		$prod = new Products();
		$pro_code = $_GET['Product_code'];
		$select_id = $prod->selectcode($pro_code);
		$product_id = $prod->getProduct_ID();

		$property = new Property();
		$get_id = $property->selectAll($product_id);

		//--------------------------------------//

	   //--------------------------------------//
		
//color
		$pro_code = new Products();
		$get_pro = $pro_code->selectPro_code();	
		
		$color = new Color();
		$get_color = $color->selectcolor();

//property
		$property = new property();
		$get_property = $property->selectproperty();
		
//Add Product Color	
if(!empty($_POST['ADD']))
{
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$Product_Code = $_POST['Product_Code'];
		$Product_Name_Th = $_POST['Product_Name_Th'];
		$Product_Name_En = $_POST['Product_Name_En'];
		$Description_Th = $_POST['Description_Th'];
		$Description_En = $_POST['Description_En'];
		$Size = $_POST['Size'];
		$Property_Th = $_POST['Property_Th'];
		$Property_En = $_POST['Property_En'];
		$Price_Buy = $_POST['Price_Buy'];
		$Price_sale = null;
		$Discount_PC = null;
		$Discount_Num = null;
		$Short_msg_Th = $_POST['Short_msg_Th'];
		$Short_msg_En = $_POST['Short_msg_En'];
		$Qty = null;
		$Sale_min = $_POST['Sale_min'];
		$Sale_max = $_POST['Sale_max'];
		$KeyWord = $_POST['KeyWord'];
		$Weight = $_POST['Weight'];
		$Url_Th = $_POST['Url_Th'];
		$Url_En = $_POST['Url_En'];
		$Discount_Status = $_POST['Discount_Status'];
		$Product_Status = $_POST['Product_Status'];
		
		//Discount
		$Discount = $_POST['Discount'];
		$operator = $_POST['operator'];

		if($operator == "Discount_num")
		{
		//$Price_sale = ($Price_sale - $Discount);
		$Discount_Num = $_POST['Discount'];
		$Discount_Status = 0;
		}
		elseif($operator == "Discount_PC")
		{
		//$Price_sale = ($Price_sale-($Price_sale*($Discount/100)));
		$Discount_PC = $_POST['Discount'];
		$Discount_Status = 1;
		}
		
		//Color ID
		$Color_ID = $_POST['color'];
		
		//Property ID
		$Property_ID = $_POST['property'];
		
		//Price & Qty
		$price = $_POST['Price'];
		$qty = $_POST['qty'];
		
		//Product ID
		$product = new Products();
		$pro_code = $_GET['Product_code'];
		$select_id = $product->selectcode($pro_code);
		$pro_id = $product->getProduct_ID();
		
		
		//Upload Picture
		
		for($i=0;$i<count($_FILES["filUpload"]["name"]);$i++)
		{
		if($_FILES["filUpload"]["name"][0] != "")
		{
		if(move_uploaded_file($_FILES["filUpload"]["tmp_name"][0],"../product/Full/".$_FILES["filUpload"]["name"][0]))
		{
			$file = $_FILES["filUpload"]["name"][0];
			$picture = 'product/Full/'.$file;
			$img = new Images();
			$status = $_POST['Status'];
			$sequence = '1';
			$mode = 'Normal';
			$images = $img->uploadfull($pro_id,$picture,$status,$mode,$sequence,$Color_ID,$Property_ID);
			echo "Copy/Upload Complete<br>";
		}
		}
		if ($_FILES["filUpload"]["name"][1] != "")
		{
		if(move_uploaded_file($_FILES["filUpload"]["tmp_name"][1],"../product/Small/".$_FILES["filUpload"]["name"][1]))
		{
			$file = $_FILES["filUpload"]["name"][1];
			$picture = 'product/Small/'.$file;
			$img = new Images();
			$status1 = $_POST['Status'];
			$sequence1 = '1';
			$mode1 = 'Normal';
			$Color_ID = $_POST['color'];
			$images = $img->uploadsmall($pro_id,$picture,$status1,$mode1,$sequence1,$Color_ID,$Property_ID);	
			echo "Copy/Upload Complete<br>";
		}
		}
		if($_FILES["filUpload"]["name"][2] != "")
		{
		if(move_uploaded_file($_FILES["filUpload"]["tmp_name"][2],"../product/Tumbs/".$_FILES["filUpload"]["name"][2]))
		{
			$file = $_FILES["filUpload"]["name"][2];
			$picture = 'product/Tumbs/'.$file;
			$status1 = $_POST['Status'];
			$sequence1 = '1';
			$mode1 = 'Normal';
			$img = new Images();
			$Color_ID = $_POST['color'];
			$images = $img->uploadtumb($pro_id,$picture,$status,$mode,$sequence,$Color_ID,$Property_ID);
			echo "Copy/Uploads Complete<br>";
		}
		}
		}
		if($pro == 0)
		{		
			$_SESSION['PRODUCT']= $product;
			echo "<script>alert('INSERT')</script>";
		}
		
		/*$color = new Color();
		$cross = $color->insert_crosscolor($Color_ID,$pro_id);	*/
		$property = new property();
		$cross = $property->insert_crossproperty($Property_ID,$pro_id,$Color_ID,$price,$qty);
	}
	header("location:Products.php");
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
	<link rel="stylesheet" type="text/css" href="css/mainstyle.css">
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
						 	<form action="Product_Change.php?Product_code=<?=$Product_code?>" method="POST" name="product">
					<table>
						<tbody>
							</tr>
								<tr>
								<td>Cross Product</td>
								<td><img src="../images/dot.gif" /></td>
								<td>
									<select name="cross1">
									<option value=""><-- Please Select Cross Product 1--></option>
									<? echo $cross->getcross();?>
									</select>
									
								</td>
							</tr>
							
							</tr>
								<tr>
								<td>Cross Product 1</td>
								<td><img src="../images/dot.gif" /></td>
								<td>
									<select name="cross2">
									<option value=""><-- Please Select Cross Product 2--></option>
									<? echo $cross->getcross();?>
									</select>
									
								</td>
							</tr>
							
							</tr>
								<tr>
								<td>Cross Product 3</td>
								<td><img src="../images/dot.gif" /></td>
								<td>
									<select name="cross3">
									<option value=""><-- Please Select Cross Product 3--></option>
									<? echo $cross->getcross();?>
									</select>
									
								</td>
							</tr>
							
							</tr>
								<tr>
								<td>Cross Product 4</td>
								<td><img src="../images/dot.gif" /></td>
								<td>
									<select name="cross4">
									<option value=""><-- Please Select Cross Product 4--></option>
									<? echo $cross->getcross();?>
									</select>
									
								</td>
							</tr>
							<tr>
								<td>Product Code</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Product_Code" value="<?=$Product_code?>"/></td>
							</tr>
							<tr>
								<td>Product Name Thai</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Product_Name_Th" value="<?=$get_th?>"/></td>
								<td>Product Name English</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Product_Name_En" value="<?=$get_en?>" /></td>
							</tr>
							<tr>
								<td>Description Thai</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Description_Th" value="<?=$get_desth?>"/></td>
								<td>Description English</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Description_En" value="<?=$get_desen?>"/></td>
							</tr>
							<tr>
								<td width="200px">Size</td>
								<td width="30px"><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Size" value="<?=$get_size?>"/></td>
							</tr>
							<!--	<tr>
								<td>Property Thai</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Property_Th"/></td>
								<td>Property English</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="Property_En"/></td>
							</tr>-->
							<tr>
									<!--<td>Price Buy</td>
									<td><img src="../images/dot.gif" /></td>-->
									<input type="hidden" name="Price_Buy"/>
									<td>Price Sale</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Price"/></td>
							
							<td><input type="checkbox" name="modtype"  value="value1" onclick="showMe('div1', this)" />Discount
								<img src="../images/dot.gif" />

								<div class="row" id="div1" style="display:none">
									<input type="text" name="Discount">
									<select name="operator">
									<option value="Discount_num" >Discount num</option>
									<option value="Discount_PC" >Discount PC</option>
									</select>
								</div>
								
							<td>
							</tr>
						<!--	<tr>
									<td>Discount PC</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Discount_PC"/></td>
							</tr>
							<tr>
									<td>Discount Num</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Discount_Num"/></td>
							</tr>-->
					
							
							<!--<tr>	
								<td>
								<input type="checkbox" name="modtype"  value="value1" onclick="showMe('div1', this)" /> &nbsp;Discount
								<img src="../images/dot.gif" />
								<div id="div1">
								<input type="text" name="Discount">
									<select name="operator">
									<option value="Discount_num">Discount num</option>
									<option value="Discount_PC">Discount PC</option>
									</select>
								</div>
								</td>
							</tr>-->
							
							
							<tr>
									<td>Short message Thai</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Short_msg_Th" value="<?=$get_shortth?>"/></td>
							</tr>
							<tr>
									<td>Short message English</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Short_msg_En" value="<?=$get_shorten?>"/></td>
							</tr>
							<tr>
									<td>Qty</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Qty" value="<?=$get_qty?>"/></td>
							</tr>
							<tr>
									<td>Sale min</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Sale_min" value="<?=$get_sale_min?>"/></td>
							</tr>
							<tr>
									<td>Sale max</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Sale_max" value="<?=$get_sale_max?>"/></td>
							</tr>
							<tr>
									<td>KeyWord </td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="KeyWord" value="<?=$get_key?>"/></td>
							</tr>
							<tr>
									<td>Weight</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Weight" value="<?=$get_weight?>"/></td>
							</tr>
							<tr>
									<!--<td>Url Thai</td>
									<td><img src="../images/dot.gif" /></td>-->
									<input type="hidden" name="Url_Th" value="<?=$get_url_th?>"/>
									<td>Url English</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Url_En" value="<?=$get_url_en?>"/></td>
							</tr>
							<tr>
									<td>Discount Status </td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Discount_Status" value="<?=$get_dis_stat?>"/></td>
							</tr>
							<tr>
									<td>Product Status</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="Product_Status" value="<?=$get_stat?>"/></td>
							</tr>
							<tr>
							
								<td>
							
									<input type="submit" id="submit1" name="UPDATE" value="UPDATE">
								</td>
							</tr>
						</tbody>
					</table>
				</form>
						 	<div id="line"></div>
						<h2>Add Product <?=$product_id?><?=$get_name?></h2>	
						<form action="Product_Change.php?Product_code=<?=$Product_code?>" method="POST" name="color_product" enctype="multipart/form-data">
								Full Picture<input type="file" name="filUpload[]"><br>
								Normal Picture<input type="file" name="filUpload[]"><br>
								Small Picture<input type="file" name="filUpload[]"><br>
								<select name="Status" id="Status">
								<option value="Active">Active</option>
								<option value="UnActive">UnActive</option>
							<tr>
								<td>Color</td>
								<td><img src="../images/dot.gif" /></td>
								<td>
									<select name="color">
									<option value=""><-- Please Select Color --></option>
									<? echo $color->getcolor();?>
									</select>
								</td>
							</tr>	
							
							<tr>
								<td>Property</td>
								<td><img src="../images/dot.gif" /></td>
								<td>
									<select name="property">
									<option value=""><-- Please Select Property --></option>
									<? echo $property->getproperty();?>
									</select>
								</td>
							</tr>
							
						<input type="submit" id="submit2" name="ADD" value="ADD">
					</form>
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
<script type="text/javascript"> 
	<!-- 
	function showMe (it, box) { 
	  var vis = (box.checked) ? "block" : "none"; 
	  document.getElementById(it).style.display = vis;
	} 
	//--> 
</script>	
</body>
</html>
