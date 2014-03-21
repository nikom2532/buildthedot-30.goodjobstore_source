<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
include_once '../classes/Employees.php';
$login = 'Log in';
$logout = 'Register';
$link = 'profile.php';
	$get_empid = $_GET['id'];
	$getemp = new Employees();
	$get = $getemp->emp($get_empid);
	$getemail = $getemp->getemail();
	$getfirstname = $getemp->getFirstName();
	$getlastname = $getemp->getLastName();
	$login = $getemp->getFirstName()." ".$getemp->getLastName();
	$logout = 'Log out';
	if(isset($getfirstname)==0&&isset($getlastname)==0)
		{
			$login = $getemp->getEmail();
		} 
	$all = $getemp->allEmployee();
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
					<li><a href="product.php?id=<?=$get_empid?>">Product</a></li>
					<li><a class="active" href="employee.php?id=<?=$get_empid?>">Employee</a></li>
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

						 	<div id="line"></div>
						 	<?php 
							
							echo $getemp->getAllEmployee();
					/*	mysql_connect("localhost", "dev", "0823248713");
						mysql_select_db("goodjob");
						
						$result = mysql_query("select * from employees e,positions p where e.Position_ID = p.Position_ID");

						echo "<table border='10' cellpadding='10'>";
                                        
                                        // set table headers
                        echo "<tr>
							  <th width=\"100px\"><h3>Emp_ID</h3></th>
							  <th width=\"100px\"><h3>First Name</h3></th>
							  <th width=\"100px\"><h3>Last Name</h3></th>
							  <th width=\"120px\"><h3>Position Name</h3></th>
							  <th width=\"200px\"><h3>Email</h3></th>
							  </tr>";
                                        
						while ($row = mysql_fetch_object($result)) {
								echo "<tr >";
                                echo "<td align=\"center\" height=\"25px\">" . $row->Emp_ID . "</td>";
                                echo "<td height=\"25px\">" . $row->FirstName . "</td>";
                                echo "<td height=\"25px\">" . $row->LastName . "</td>";
								echo "<td height=\"25px\">" . $row->Position_name ."</td>";
								echo "<td align=\"center\" height=\"25px\">" . $row->Email ."</td>";
                                echo "<td width=\"30px\" height=\"25px\"><a href='records.php?id=" . $row->Emp_ID . "'>Edit</a></td>";
                                echo "<td width=\"30px\" height=\"25px\"><a href='delete.php?id=" . $row->Emp_ID . "'>Delete</a></td>";
                                echo "</tr>";
						}
						echo "</table>";
						mysql_free_result($result);
					*/?>
						</div>
					</div>
				</div>

				
			</div>
			
		</div> <!-- End Content -->               
		<!-- Footer Section -->
		<div id="footer">
			<div class="payment_logo"><img src="../images/payment_logo.jpg" /></div>
			<div class="copyright">? 2011 - 2015 GOODJOB CO., LTD </div>
		</div>
	</div>
	
</body>
</html>
