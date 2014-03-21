<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

<?
	$genProID = $_GET["genProID"];
	$proCode = $_GET["proCode"];
	$propertyName = $_GET["propertyName"];
	
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

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);		
	
	//----- Color -----
	$sqlColor = "SELECT * FROM color ORDER BY Name_EN";
	$resultColor1 = mysql_query($sqlColor, $objCon) or die(mysql_error());
//	$resultColor2 = mysql_query($sqlColor, $objCon) or die(mysql_error());
//	$resultColor3 = mysql_query($sqlColor, $objCon) or die(mysql_error());
//	$resultColor4 = mysql_query($sqlColor, $objCon) or die(mysql_error());
//	$resultColor5 = mysql_query($sqlColor, $objCon) or die(mysql_error());
//	$resultColor6 = mysql_query($sqlColor, $objCon) or die(mysql_error());

	//----- Image Level ----
	$sqlLevel = "SELECT Level FROM images WHERE Product_ID = '$genProID' ORDER BY Level DESC LIMIT 1";
	$resultLevel = mysql_query($sqlLevel, $objCon) or die(mysql_error());
	$imgLevel = '1';
	while($dataLevel=mysql_fetch_array($resultLevel))
	{
		$imgLevel = $dataLevel['Level']+1;
	}
	//----- Primary product ----
	$sqlPrimPro = "SELECT Image_ID FROM images WHERE Product_Code='$proCode' AND primary_product=1";
	$resultPrimPro = mysql_query($sqlPrimPro, $objCon) or die(mysql_error());
	$setPrimPro = mysql_fetch_row($resultPrimPro);
	if(!$setPrimPro){
		$setPrim = 1;}
	else{
		$setPrim = 0;}
?>


<!-------------------------------- Upload Images (php) ------------------------>						
<?
	// Include คลาส class.upload.php เข้ามา เพื่อจัดการรูปภาพ
	require_once('classes/class.upload.php') ;
	 
	// ส่วนกำหนดการเชื่อมต่อฐานข้อมูล
	$hostname_connection = "localhost";
	$database_connection = "goodjob";
	$username_connection = "dev";
	$password_connection = "0823248713";
	$connection = mysql_pconnect($hostname_connection, $username_connection, $password_connection)
			or trigger_error(mysql_error(),E_USER_ERROR); 
	mysql_query( "SET NAMES UTF8" ) ;
	 
	 
	//  ถ้าหากหน้านี้ถูกเรียก เพราะการ submit form  
	//  ประโยคนี้จะเป็นจริงกรณีเดียวก็ด้วยการ submit form 
//	die(document.form1.selectColor1.value);
	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
		$image_color1 = $_POST['selectColor1'];
		if($image_color1!=NULL)
		{
			// เริ่มต้นใช้งาน class.upload.php ด้วยการสร้าง instant จากคลาส
			$upload_image1 = new upload($_FILES['image_name1']) ; // $_FILES['image_name'] ชื่อของช่องที่ให้เลือกไฟล์เพื่ออัปโหลด
			$upload_image_small1 = new upload($_FILES['image_name1']) ;
			$upload_image_thumb1 = new upload($_FILES['image_name1']) ;
		 
			//  ถ้าหากมีภาพถูกอัปโหลดมาจริง
			if ( $upload_image1->uploaded) {

				// ย่อขนาดภาพให้เล็กลงหน่อย  โดยยึดขนาดภาพตามความกว้าง  ความสูงให้คำณวนอัตโนมัติ
				// ถ้าหากไม่ต้องการย่อขนาดภาพ ก็ลบ 3 บรรทัดด้านล่างทิ้งไปได้เลย
				$upload_image1->image_resize         = true; // อนุญาติให้ย่อภาพได้
				$upload_image1->image_x              = 1280; // กำหนดความกว้างภาพเท่ากับ 400 pixel 
				$upload_image1->image_y				 = 1024; // ให้คำณวนความสูงอัตโนมัติ

				$upload_image_small1->image_resize         = true ; // อนุญาติให้ย่อภาพได้
				$upload_image_small1->image_x              = 480 ; // กำหนดความกว้างภาพเท่ากับ 400 pixel 
				$upload_image_small1->image_y				= 380; // ให้คำณวนความสูงอัตโนมัติ

				$upload_image_thumb1->image_resize         = true ; // อนุญาติให้ย่อภาพได้
				$upload_image_thumb1->image_x              = 100 ; // กำหนดความกว้างภาพเท่ากับ 400 pixel 
				$upload_image_thumb1->image_y				= 80; // ให้คำณวนความสูงอัตโนมั
		 
				$upload_image1->process( "../../public/product/Full" ); // เก็บภาพไว้ในโฟลเดอร์ที่ต้องการ  *** โฟลเดอร์ต้องมี permission 0777
				$upload_image_small1->process( "../../public/product/Small" );
				$upload_image_thumb1->process( "../../public/product/Tumbs" );

				// ถ้าหากว่าการจัดเก็บรูปภาพไม่มีปัญหา  เก็บชื่อภาพไว้ในตัวแปร เพื่อเอาไปเก็บในฐานข้อมูลต่อไป
				if ( $upload_image1->processed ) {
		 
					$image_name1 =  $upload_image1->file_dst_name ; // ชื่อไฟล์หลังกระบวนการเก็บ จะอยู่ที่ file_dst_name
					$upload_image1->clean(); // คืนค่าหน่วยความจำ
					
					$image_name_small1 =  $upload_image_small1->file_dst_name ; // ชื่อไฟล์หลังกระบวนการเก็บ จะอยู่ที่ file_dst_name
					$upload_image_small1->clean(); // คืนค่าหน่วยความจำ

					$image_name_thumb1 =  $upload_image_thumb1->file_dst_name ; // ชื่อไฟล์หลังกระบวนการเก็บ จะอยู่ที่ file_dst_name
					$upload_image_thumb1->clean(); // คืนค่าหน่วยความจำ
					// เก็บชื่อภาพลงฐานข้อมูล
					
					$insertSQL = sprintf("INSERT INTO images (Product_ID,primary_product,Product_Code,Path,Path_Small,Thumbnail_path,Level,Color_ID) VALUES ( '%s','%d','%s','%s','%s','%s','%d','%d' )",$genProID,$setPrim,$proCode, "product/Full/".$image_name1,"product/Small/".$image_name_small1,"product/Tumbs/".$image_name_thumb1,$imgLevel,$image_color1 );
				   
					mysql_select_db($database_connection, $connection);
					$Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
		 
				}// END if ( $upload_image->processed )

				$upload_image1->process( "../../public/product/Full" ); // เก็บภาพไว้ในโฟลเดอร์ที่ต้องการ  *** โฟลเดอร์ต้องมี permission 0777
				$upload_image_small1->process( "../../public/product/Small" );
				$upload_image_thumb1->process( "../../public/product/Tumbs" );
			}//End alert Color
		}//END if ( $upload_image->uploaded )

/*
		//************************* Images [2] ***********************

		$upload_image2 = new upload($_FILES['image_name2']) ;
		$upload_image_small2 = new upload($_FILES['image_name2']) ;
		$upload_image_thumb2 = new upload($_FILES['image_name2']) ;
	 
		if ( $upload_image2->uploaded) 
		{
			$image_color2 = $_POST['selectColor2'];

	        $upload_image2->image_resize         = true ;
	        $upload_image2->image_x              = 1024 ;  
	        $upload_image2->image_ratio_y        = true; 

			$upload_image_small2->image_resize         = true ; 
	        $upload_image_small2->image_x              = 480 ;
	        $upload_image_small2->image_ratio_y        = true;

			$upload_image_thumb2->image_resize         = true ;
	        $upload_image_thumb2->image_x              = 80 ;
	        $upload_image_thumb2->image_ratio_y        = true;
	 
			$upload_image2->process( "../../public/product/Full" );
			$upload_image_small2->process( "../../public/product/Small" );
			$upload_image_thumb2->process( "../../public/product/Tumbs" );

			if ( $upload_image2->processed )
			{
				$image_name2 =  $upload_image2->file_dst_name ;
				$upload_image2->clean();
				
				$image_name_small2 =  $upload_image_small2->file_dst_name ;
				$upload_image_small2->clean(); 

				$image_name_thumb2 =  $upload_image_thumb2->file_dst_name ;
				$upload_image_thumb2->clean();

				$insertSQL = sprintf("INSERT INTO images (Product_ID,Path,Path_Small,Thumbnail_path,Level,Color_ID) VALUES ( '%s','%s','%s','%s','%d','%d' )",$genProID, "product/Full/".$image_name2,"product/Small/".$image_name_small2,"product/Tumbs/".$image_name_thumb2,2,$image_color2 );
			   
				mysql_select_db($database_connection, $connection);
				$Result2 = mysql_query($insertSQL, $connection) or die(mysql_error());
			}
			$upload_image2->process( "../../public/product/Full" );
			$upload_image_small2->process( "../../public/product/Small" );
			$upload_image_thumb2->process( "../../public/product/Tumbs" );
		}
*/
	}
?>
<!----------------------- End Upload Image (php) ----------------->


<html>
<head>
	<title>GOODJOB - Administration</title>

	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/admin.css">

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="ajax/ajax.productImage.java"></script>
</head>
<body>
	<script>
		viewTable('<?=$genProID?>');
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
							<h2>Add -- <?=$proCode?><?=$propertyName?> -- images</h2>

<!------------------------- Upload Image (form) ----------------->

		<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
			<table>
				<tr>
					<td style="width:75px;">Image </td>
					<td style="width:15px;"><img src="../images/dot.gif" /></td>
					<td><input name="image_name1" type="file" id="image_name1" size="40"/></td>
				</tr>
				<tr>
					<td style="width:70px;">Color </td>
					<td style="width:15px;"><img src="../images/dot.gif" /></td>
					<td>
						<select name="selectColor1"\>
							<?
							while ($data=mysql_fetch_array($resultColor1))
							{?>
								<option value="<?=$data['Color_ID']?>"><?=$data['Name_EN']?></option>
							<?}?>
						</select>
					</td>
				</tr>
<script>/*
				<tr>
					<td style="width:75px;">Image [2] </td>
					<td style="width:15px;"><img src="../images/dot.gif" /></td>
					<td><input name="image_name2" type="file" id="image_name2" size="40"/></td>
					<td style="width:70px;">Color [2] </td>
					<td style="width:15px;"><img src="../images/dot.gif" /></td>
					<td>
						<select name="selectColor2"\>
							<option value=""><-- Please Select Color --></option>
							<?
							while ($data=mysql_fetch_array($resultColor2))
							{?>
								<option value="<?=$data['Color_ID']?>"><?=$data['Name_EN']?></option>
							<?}?>
						</select>
					</td>
				</tr>
*/</script>
			</table>
			<input type="submit" value="Upload"  style="width:60px;"/>
			<input type="hidden" name="MM_insert" value="form1" />
		</form>
<!--		<input type="button" onclick="window.location.href='product.php'" value="back" style="width:60px;">	-->
<!----------------------- End Upload Image (form) ------------------>


							<div id="line"></div>
							<div id="image_content"></div>
							<div style="width: 800px; height: 400px; overflow: auto; padding: 5px">
							<div id="promotion_content">
								<!-- table show Promotion -->
							</div>
							
		
		<div id="line"></div>
		<input type="button" value="Submit" style="width:60px;" onclick="window.location.href='viewProduct.php?proCode=<?=$proCode?>'">
					
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
