<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
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
include_once '../classes/Images.php';
	
	if(!empty($_POST['btnSubmit']))
	{
		if($_SERVER['REQUEST_METHOD']=='POST')
		{
			$img = new Images();
			$image_id = $_GET['id'];
			$status = $_POST['Status'];
			$sequence = $_POST['Sequence'];
			$images = $img->update_data($image_id,$status,$sequence);		
		}
	}

	if(!empty($_POST['btnSubmit1']))
	{
		if(move_uploaded_file($_FILES["filUpload"]["tmp_name"],"../images/slide/".$_FILES["filUpload"]["name"]))
		{
		echo "Copy/Upload Complete<br>";
		$file = $_FILES["filUpload"]["name"];
		$picture = 'images/slide/'.$file;
		$img = new Images();
		$status = $_POST['Status'];
		$sequence = $_POST['Sequence'];
		$mode = 'SlideShow';
		$image_id = $_GET['id'];
		$images = $img->updateslide($picture,$image_id);				
		}
	}
	
	$image_id = $_GET['id'];
	$images = new Images();
	$select = $images->selectAll($image_id)
		
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
						 	<h2>Edit Images <?php echo $images->getstatus();?> <?php echo $images->getLevel();?></h2>
						 	<form action="Edit.php?id=<?=$image_id?>" method="POST" name="product" enctype="multipart/form-data">
					<table>
						<tbody>
							<tr>

							</tr>
								  <select name="Status" id="Status">
								  <option value="">--<?php echo $images->getstatus();?>--</option>
								  <option value="Active">Active</option>
								  <option value="UnActive">UnActive</option>
								  </select>
								  
								  <select name="Sequence" id="Sequence">
								  <option value="">--Sequence <?php echo $images->getLevel();?>--</option>
								  <option value="1">Sequence 1</option>
								  <option value="2">Sequence 2</option>
								  <option value="3">Sequence 3</option>
								  <option value="4">Sequence 4</option>
								  <option value="5">Sequence 5</option>
								  </select>
								
									<input name="btnSubmit" type="submit" value="Submit">
									<input name="cancel" type="button" value="Cancel" onclick="window.location.href='Upload.php'">
									
								</td>
							</tr>
						</tbody>
					</table>
					
					</form>
					
					<form action="Edit.php?id=<?=$image_id?>" method="POST" name="image" enctype="multipart/form-data">
					<table>
						<tbody>
							<tr>

							</tr>
									Update Picture<input type="file" name="filUpload[]"><br>
								
									<input name="btnSubmit1" type="submit" value="Submit">
									<input name="cancel" type="button" value="Cancel" onclick="window.location.href='Upload.php'">
									
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
