<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">


<?php
session_start(); //เปิด seesion เพื่อทำงาน

if(!empty($_POST['sign_in']))
{
if($_SERVER['REQUEST_METHOD']=='POST')
{
$username = $_POST[email];
//ประกาศซตัวแปรชื่อ username โดยการรับค่ามาจากกล่อง username ที่หน้า Login
$password = $_POST[password];
//ประกาศซตัวแปรชื่อ password โดยการรับค่ามาจากกล่อง password ที่หน้า Login
if ( empty( $username ) )
{
	$incorrectLogin = "Email is missing!";
}
else if ( empty( $password ) )
{
	$incorrectLogin = "Password is missing!";
}
else
{                                               //ถ้ากรอกข้อมูลทั้งหมดแล้วให้ทำงานดังนี้
	$con	=	mysql_connect("localhost","dev","0823248713");
	if(!$con) {	echo "Not connect"; }
	mysql_select_db("goodjob",$con);
	$check_log = mysql_query("select * from employees where Email ='$username' and Password ='$password' ");                           //ใช้ภาษา SQL ตรวจสอบข้อมูลในฐานข้อมูล
	$num = mysql_num_rows($check_log);
	//ให้เอาค่าที่ได้ออกมาประกาศเป็นตัวแปรชื่อ $num

	if($num <=0)
	{                                                           //ถ้าหากค่าที่ได้ออกมามีค่าต่ำกว่า 1
	}
	else
	{
		while ($data = mysql_fetch_array($check_log) )
		{
//ถ้าค่ามีมากกว่า 0 ขึ้นไป ให้ดึงข้อมูลออกมาทั้งหมด
			if($data[Position_ID]==1)
			{                          //ตรวจสอบสถานะของผู้ใช้ว่าเป็น Admin
				$_SESSION[ses_userid] = session_id();            //สร้าง session สำหรับเก็บค่า ID
				$_SESSION[ses_username] = $username;      //สร้าง session สำหรับเก็บค่า Username
				$_SESSION[ses_status] = "Super Admin";                      //สร้าง session สำหรับเก็บค่า สถานะความเป็น Admin
				echo "<meta http-equiv='refresh' content='1;URL=order.php'>";
				//ส่งค่าจากหน้านี้ไปหน้า index_admin.php
			}

			else
			{                       //ตรวจสอบสถานะของผู้ใช้งานว่าเป็น user
				$_SESSION[ses_userid] = session_id();                      //สร้าง session สำหรับให้ User นำไปใช้งาน
				$_SESSION[ses_username] = $username;
				$_SESSION[ses_status] = "Admin";
				echo "<meta http-equiv='refresh' content='1;URL=order.php'>";
				//ส่งค่าจากหน้านี้ไปหน้า index_user.php
			}

		}
	}
}
}
}
?>

<html>
<head>
	<title>GOODJOB - Login</title>

	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/login.css">




</head>
<body>
	<div id="wrapper">
		<!-- Header Section -->
		<div id="header">
			<div class="logo"><a href="http://online.goodjobstore.com"><img src="../images/logo.jpg" /></a></div>
			<div class="right">

				<div id="language">

					<ul>

					</ul>
				</div>
			</div>
		</div>
		<!-- Navigation Section -->
		<div id="nav">

			<div id="shopping_info">

			</div>
		</div>
		<!-- Welcom Section-->
		<div id="welcome">
			Welcome to BACKOFFICE
		</div>
		<!-- Body Section -->
		<div id="content">
			<div id="signin">
				<span class="headerblock">

			<!--Login-->
					Log in
					<div class="smalltext">Please sign in to view or updates your Backoffice</div>
					<font color="red"><?=$incorrectLogin;?></font>
					<form name="signin"action="index.php" method="POST">
						<div id="textbox_name">Email</div>
						<input type="text" name="email" />
						<div id="textbox_name">Password</div>
						<input type="password" name="password" />
						<div class="forgetpassword"><a href="#"></a></div>
						<input type="submit" name ="sign_in" value="Sign in" class="button" />
					</form>
			<!--Login-->
				</span>
			</div>
			<div id="signup">

			</div>
		</div>

		<!-- Footer Section -->
		<div id="footer">
			<div class="payment_logo"><img src="../images/payment_logo.jpg" /></div>
			<div class="copyright">© 2011 - 2015 GOODJOB CO., LTD</div>
		</div>
	</div>
</body>

</html>
