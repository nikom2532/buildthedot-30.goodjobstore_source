<?php
session_start();
include_once 'classes/Customers.php';
$_SESSION['Cus']= null;
if(!empty($_POST['sign_up']))
{
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$Email = $_POST['Email'];
		$Password = $_POST['Password'];
		$Password2 = $_POST['Password2'];
		

		if ( empty( $Email ) )
		{
			$error = "Email is missing!";
		}
		else if ( empty( $Password ) )
		{
			$error = "Password is missing!";
		}
		else if ( empty( $Password2 ) )
		{
			$error = "Please repeat your password!";
		}
		else if ( $Password != $Password2 )
		{
			$error = "Your passwords do not match!";
		}
		else if ( strlen( $Password ) < 4 && strlen( $Password2 ) < 4)
		{
			$error = "Password is to short, 4 characters min!";
		}
		else
		{
			
			$register = new Customers();
			$cus_id = $register->createCus_ID();
			$check = new Customers();
			$ch = $check->check($Email,$Password);
			if($ch == 0)
			{
			$_SESSION['Cus']= $check->getCus_ID();
			$error = "This Email is already exist.";
			}		
			else
			{
			$re = $register->register($cus_id,$Email,$Password);
			$create = $register->createCus_ID();
			$error = "Register was succesful.";
			$subject = "Welcome to Goodjob.";
			$content = "Test";
			$header = "From: admin@goodjob.com";
			mail($Email,$subject,$content,$header);
				$error .= "success.";
			}
		}
	}
}
if(!empty($_POST['sign_in']))
{
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		$check = new Customers();
		$ch = $check->check($email,$password);
		
		if($ch == 0)
		{
			$_SESSION['Cus']= $check->getCus_ID();
			$get_cusid=$_SESSION['Cus'];
			echo "<script>alert('ok')</script>";
			//$_SESSION['Cus'] = $_GET['id'];
			//$getcus = new Customers();
			//$get = $getcus->cus($get_cusid);
		}	
		
	}
	else
	{
		echo "<script>alert('error')</script>";
	}

	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<title>GOODJOB - Login </title>
	<meta name="description" content="Shop powered by PrestaShop">
	<meta name="keywords" content="shop, prestashop">
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8">
	<meta name="generator" content="GoodJobStore">
	<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="css/slidestyle.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/default.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/nivo-slider.css" media="screen" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="scripts/droplinemenu.js" type="text/javascript"></script>
	<script type="text/javascript">
		//build menu with DIV ID="myslidemenu" on page:
		droplinemenu.buildmenu("droplinetabs1")
	</script>

	<script type="text/javascript" src="scripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="scripts/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
	
</head>
<body>
	<div id="wrapper">
		<!-- Header Section -->
		<? include("header.php"); ?>

		<!-- Welcom Section-->
		<div id="welcome">
			Welcome to Goodjob
		</div>
		<!-- Body Section -->
		<div id="content">
			<div id="signin">
				<span class="headerblock">
					Sign in
					<div class="smalltext">Please sign in to view or updates your Shopping Gag and Wishlist</div>
					<form name="signin"action="login.php" method="POST">
						<div id="textbox_name">Email</div>
						<input type="text" name="email" />
						<div id="textbox_name">Password</div>
						<input type="password" name="password" />
						<div class="forgetpassword"><a href="#">Forget your password?</a></div>
						<input type="submit" name="sign_in" value="SIGN IN" class="button"/>
					</form>
				</span>
			</div>
			<div id="signup">
				<span class="headerblock">
					Create an account
					<div class="smalltext">Register here to create your personal Shopping Bag and Wishlist</div>
					<font color="red"><?=$error;?></font>
					<form name="signup"action="login.php" method="POST">
						<div id="textbox_name">Email</div>
						<input type="text" name="Email" />
						<div id="textbox_name">Password</div>
						<input type="password" name="Password" /> 
						<div class="notice">(Must be at least 4 character long)</div>
						<div id="textbox_name">Confirm Password</div>
						<input type="password" name="Password2" /> 

						<div class="newsletter">
							<input type="checkbox" name="newslatter" value="check" /> Sign me up for newsletter.
							<div class="register_button"><input type="submit" name="sign_up" value="Rigister Now" class="button"/></div>
						</div>
					</form>
				</span>
			</div>
		</div>
	
		<!-- Footer Section -->
		<? include("footer.php"); ?>
		
	</div>
</body>
</html>
