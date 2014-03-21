<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<title>GOODJOB - Administration</title>
	<meta name="description" content="Shop powered by PrestaShop">
	<meta name="keywords" content="shop, prestashop">
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8">
	<meta name="generator" content="GoodJobStore">
	<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="../scripts/droplinemenu.js" type="text/javascript"></script>
	<script type="text/javascript">
		//build menu with DIV ID="myslidemenu" on page:
		droplinemenu.buildmenu("droplinetabs1")
	</script>
	<script type="text/javascript" src="scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
		});
	</script>

<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT About_Us_En,About_Us_Th FROM shopping_guide";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>


</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div class="logo"><a href ="../"><img src="images/logo.jpg" /></a></div>
			<div class="right">
				<ul class="member_style">
					<li class="line"><a href="<?=$link?>?id=<?=$id?>"><?=$login?></a></li> 
					<li><a href="../admin/"><?=$logout?></a></li>
				</ul>
			</div>
		</div>
		
		<!-- Body Section -->
		<div id="title_head">
		SHOPPING GUIDE
		</div>
		<div id="content">
		    <div id="leftcolum">
				<a href="shopGuide-aboutUs.php">About Us</a>
				<br><br><a href="shopGuide-paymentDelivery.php">Payment & Delivery</a>
				<br><br><a href="shopGuide-returnExchange.php">Return & Exchange</a>
				<br><br><a href="shopGuide-technology.php">Technology</a>
				<br><br><a href="shopGuide-faq.php">FAQ</a>
		   	</div>

			<div id="centercolum">
				<h2>About Us</h2>
				<br>
				<?
				while ($data=mysql_fetch_array($result))
				{
					echo $data['About_Us_En'];
				}?>
		    </div>
		        
			<div id="rightcolum">
				<iframe width="350" height="240" src="http://www.youtube.com/embed/k89QE4G5fqw" frameborder="0" allowfullscreen></iframe>
				<div id="blockContact">
					<h2>GET IN TOUCH</h2>
					<form id="contactForm" name="contactForm" method="post" action="">
	              		<table id="tblContact" width="360" border="0" cellspacing="0" cellpadding="2" style="border: none;">
	                  		<tbody>
	                  			<tr>
	                    			<td width="168">E-mail</td>
	                   				 <td width="178" style="padding-left: 10px;">Country</td>
	                  			</tr>
	                  			<tr>
	                    			<td><input name="email" type="text" id="email" maxlength="255"></td>
	                   				<td align="right"><input name="country" type="text" id="country" maxlength="50"></td>
	                  			</tr>
	                  			<tr>
	                    			<td colspan="2">Name - Last Name</td>
	                  			</tr>
	                  			<tr>
	                    			<td colspan="2"><input name="name" type="text" id="name" maxlength="255"></td>
	                  			</tr>
	                  			<tr>
	                    			<td colspan="2">Message</td>
	                  			</tr>
	                  			<tr>
	                    			<td colspan="2"><textarea name="message" rows="5" id="message"></textarea></td>
	                  			</tr>
	                  			<tr>
	                    			<td colspan="2"><input type="button" name="btnSend" id="btnSend" value="SEND"></td>
	                  			</tr>
	                			</tbody>
	                	</table>
	              	</form>
	            </div>
			</div>
		</div> <!-- End Content -->       
		
	<!-- Footer Section -->
		<div id="footer">
			<div class="payment_logo"><img src="images/payment_logo.jpg" /></div>
			<div class="copyright">? 2011 - 2015 GOODJOB CO., LTD</div>
		</div>
	
	</div>
</body>
</html>