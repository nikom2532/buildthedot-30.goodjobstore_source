
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

	$sql = "SELECT Technologie_Th,Technologie_En FROM shopping_guide";
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
				<br><br><a href="technology">Technology</a>
				<br><br><a href="faq">FAQ</a>
		   	</ul>
			</div>

			<div id="centercolum">
						<div id="scrollbar1" class="clearfix">
					<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
						<div class="viewport">
							<div class="overview">
				<h2>Technology</h2>
				<br>
				<?
				while ($data=mysql_fetch_array($result))
				{
					if(LANG=='TH')
						echo $data['Technologie_Th'];
					else
						echo $data['Technologie_En'];
				}?>
				</div>  <!-- overview -->
						</div>  <!-- viewport -->
				</div>  <!-- scrollbar1 -->
				</div>
		</div> <!-- End Content -->  