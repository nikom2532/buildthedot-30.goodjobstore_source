<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<meta http-equiv=Content-Type content="text/html; charset=utf-8">

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
	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	 
		// เริ่มต้นใช้งาน class.upload.php ด้วยการสร้าง instant จากคลาส
		$upload_image = new upload($_FILES['image_name']) ; // $_FILES['image_name'] ชื่อของช่องที่ให้เลือกไฟล์เพื่ออัปโหลด
	 
		//  ถ้าหากมีภาพถูกอัปโหลดมาจริง
		if ( $upload_image->uploaded ) {
	 
			// ย่อขนาดภาพให้เล็กลงหน่อย  โดยยึดขนาดภาพตามความกว้าง  ความสูงให้คำณวนอัตโนมัติ
			// ถ้าหากไม่ต้องการย่อขนาดภาพ ก็ลบ 3 บรรทัดด้านล่างทิ้งไปได้เลย
	//      $upload_image->image_resize         = true ; // อนุญาติให้ย่อภาพได้
	//      $upload_image->image_x              = 400 ; // กำหนดความกว้างภาพเท่ากับ 400 pixel 
	//      $upload_image->image_ratio_y        = true; // ให้คำณวนความสูงอัตโนมัติ
	 
			$upload_image->process( "../../public/images/background/" ); // เก็บภาพไว้ในโฟลเดอร์ที่ต้องการ  *** โฟลเดอร์ต้องมี permission 0777
	 
			// ถ้าหากว่าการจัดเก็บรูปภาพไม่มีปัญหา  เก็บชื่อภาพไว้ในตัวแปร เพื่อเอาไปเก็บในฐานข้อมูลต่อไป
			if ( $upload_image->processed ) {
	 
				$image_name =  $upload_image->file_dst_name ; // ชื่อไฟล์หลังกระบวนการเก็บ จะอยู่ที่ file_dst_name
				$upload_image->clean(); // คืนค่าหน่วยความจำ
	 
				// เก็บชื่อภาพลงฐานข้อมูล
				$insertSQL = sprintf("INSERT INTO background (path) VALUES ( '%s' )", "images/background/".$image_name );
			   
				mysql_select_db($database_connection, $connection);
				$Result1 = mysql_query($insertSQL, $connection) or die(mysql_error());
	 
	 
			}// END if ( $upload_image->processed )
	 
		}//END if ( $upload_image->uploaded )
	 
	 
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
	<script src="ajax/ajax.background.java"></script>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div class="logo"><a href ="http://online.goodjobstore.com"><img src="../images/logo.jpg" /></a></div>
			<div class="right">
				<ul class="member_style">
					
					<li><a href="logout.php">log out</a></li>
				</ul>
			</div>
		</div>
		
		<!-- Body Section -->
		<div id="title_head">
		Back Office
		</div>
		<div id="content">
		    <div id="leftcolum">
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

		   	</div>

					
							<h2>Background</h2>


<!------------------------- Upload Image (form) ----------------->

		<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
		  <p><b>Add Background</b><br><br><br> 
			<input name="image_name" type="file" id="image_name" size="40"/>
		  </p>
		  <br>
		  <p>
			<input type="submit" value="Upload" style="width:60px;"/>
			<input type="hidden" name="MM_insert" value="form1" />
		  </p>
		</form>

<!----------------------- End Upload Image (form) ------------------>




							<div id="testt"></div>
							<div id="line"></div>
							<div style="width: 800px; height: 350px; overflow: auto; padding: 5px">
								<div id="background_content">
									<div class="viewport">
										<div class="overview">
											<!-- table show Banner -->
											<script>viewTable();</script>
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


</body>
</html>
