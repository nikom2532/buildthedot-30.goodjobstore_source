<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
session_start();
include_once '../classes/Employees.php';
$login = 'Log in';
$logout = 'Register';
$link = 'index.php';
$check = new Employees();

if(!empty($_POST['sign_in']))
{
	session_destroy();
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		$check = new Employees();
		$ch = $check->check($email,$password);
		if($ch == 0)
		{
			$_SESSION['login']=$check->getEmp_ID();
			$get_empid = $_SESSION['login'];
			$_SESSION['USER']= $check;
			echo "<script>alert('ok')</script>";
			$login = $check->getFirstName()." ".$check->getLastName();
			$first = $check->getFirstName();
			$last = $check->getLastName();
			$logout = 'Log out';

			if($login)
			{
				$link = 'profile.php';
			}
			$get_empid = $_SESSION['login'];
			if(isset($first)==0&&isset($last)==0)
			{
				$login = $check->getEmail();
			}
		}
		else
		{
			//echo "<script>alert('Error')</script>";
			//echo "<script>alert('$email')</script>";
			//echo "<script>alert('$password')</script>";
		}
	}
	header("location:profile.php?id=$get_empid");
}
?>
<html>
<head>
	<title>GOODJOB - Login</title>
	<meta name="description" content="Shop powered by PrestaShop">
	<meta name="keywords" content="shop, prestashop">
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8">
	<meta name="generator" content="GoodJobStore">
	<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="../css/reset.css">
	<link rel="stylesheet" type="text/css" href="../css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="../css/login.css">
	<link rel="stylesheet" type="text/css" href="../css/slidestyle.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/default.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css/nivo-slider.css" media="screen" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="../scripts/droplinemenu.js" type="text/javascript"></script>
	<script type="text/javascript">
		//build menu with DIV ID="myslidemenu" on page:
		droplinemenu.buildmenu("droplinetabs1")
	</script>

	<script type="text/javascript" src="../scripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="../scripts/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
	
</head>
<body>
	<div id="wrapper">
		<!-- Header Section -->
		<div id="header">
			<div class="logo"><a href="../"><img src="../images/logo.jpg" /></a></div>
			<div class="right">
			<table>
					<tbody>
						<tr>
							<td style="vertical-align:middle">
								<div id="member">
									<ul class="member_style">
										<li class="line"><a href="<?=$link?>?id=<?=$get_empid?>"><?=$login?></a></li> 
										<li><a href="index.php"><?=$logout?></a></li>
									</ul>
								</div>
							</td>
							<td>
								<div id="search">
								<form method="get" action="#" id="searchbox">
									<input type="hidden" name="orderby" value="position">
									<input type="hidden" name="orderway" value="desc">
					            	<input type="submit" name="submit_search" value="Search" class="submit_search"><input class="search_query ac_input" type="text" id="search_query_top" name="search_query" value="" autocomplete="off">
								</form>
								</div>
							</td>
						</tr>
					</tbody>
				</table>	
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
					Log in
					<div class="smalltext">Please sign in to view or updates your Backoffice</div>
					<form name="signin"action="index.php?id=<?=$get_empid?>" method="POST">
						<div id="textbox_name">Email</div>
						<input type="text" name="email" />
						<div id="textbox_name">Password</div>
						<input type="password" name="password" />
						<div class="forgetpassword"><a href="#">Forget your password?</a></div>
						<input type="submit" name ="sign_in" value="Sign in" class="button" />
					</form>
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
