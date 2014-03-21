
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/reset.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/admin.css">

	<script src="<?=base_url()?>public/scripts/jquery-1.6.js" type="text/javascript"></script>
		<!-- tinyscrollbar -->
	<script type="text/javascript" src="<?=base_url()?>public/scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
		});
	</script>
	<!-- tinyscrollbar -->


<?
	$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
	$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
	mysql_query("SET NAMES utf8",$objCon);

	$sql = "SELECT Payment_Th,Payment_En,Delivery_Th,Delivery_En FROM shopping_guide";
	$result = mysql_query($sql, $objCon) or die(mysql_error());
?>

		
		<!-- Body Section -->
		<div id="title_head">
		SHOPPING GUIDE
		</div>
		<div id="content">
		     <div id="leftcolum">
			<ul>
				<a href="about">About Us</a>
				<br><br><a href="payment">Payment & Delivery</a>
				<br><br><a href="exchange">Return & Exchange</a>
				<!--<br><br><a href="technology">Technology</a>
				<br><br><a href="faq">FAQ</a>-->
		   	</ul>
			</div>

			<div id="centercolum">
			
				
						<div class="viewport">
							<div class="overview" style="width:750px">
			<h2><?=(LANG=='TH')?'วิธีการชำระเงิน':"Payment";?></h2>
				
				<span style="line-height:18px; font-size:12px">
				<?
				while ($data=mysql_fetch_array($result))
				{
					if(LANG=='TH')
						echo $data['Payment_Th'];
					else
						echo $data['Payment_En'];
				?>
				</span>
				<br><br>
				<div id="line"></div><br><br>
				<span style="line-height:18px; font-size:12px">

			<h2><?=(LANG=='TH')?'การส่งสินค้า':"Delivery";?></h2>
				<?
					if(LANG=='TH')
						echo $data['Delivery_Th'];
					else
						echo $data['Delivery_En'];
				}?>
				</span>


						</div>  <!-- overview -->
						</div>  <!-- viewport -->
				
		    </div>
		</div> <!-- End Content -->