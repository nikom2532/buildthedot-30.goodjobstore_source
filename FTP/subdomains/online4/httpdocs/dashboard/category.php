<?
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<title>GOODJOB</title>
	<meta name="description" content="Shop powered by PrestaShop">
	<meta name="keywords" content="shop, prestashop">
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8">
	<meta name="generator" content="GoodJobStore">
	<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="css/category.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="css/menu.css">

	<!-- Dropdown Menu -->
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
    <!-- jqZoom -->
    <link rel="stylesheet" href="../css/jquery.jqzoom.css" type="text/css">	
	<script src="scripts/jquery-1.6.js" type="text/javascript"></script>
	<script src="scripts/jquery.jqzoom-core.js" type="text/javascript"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('.jqzoom').jqzoom({
	            zoomType: 'standard',
	            lens:true,
	            preloadImages: false,
	            alwaysOn:false
	        });
	});
	</script>
	<? include("script-menu.php");?> 
	
	<!-- bin/jquery.slider.min.css -->
	<link rel="stylesheet" href="css/jslider.css" type="text/css">


	<link rel="stylesheet" href="css/jslider.round.css" type="text/css">

  <!-- end -->


	
	<!-- bin/jquery.slider.min.js -->
	<script type="text/javascript" src="scripts/jshashtable-2.1_src.js"></script>
	<script type="text/javascript" src="scripts/jquery.numberformatter-1.2.3.js"></script>
	<script type="text/javascript" src="scripts/tmpl.js"></script>
	<script type="text/javascript" src="scripts/jquery.dependClass-0.1.js"></script>
	<script type="text/javascript" src="scripts/draggable-0.1.js"></script>
	<script type="text/javascript" src="scripts/jquery.slider.js"></script>
  <!-- end -->
  
</head>
<body>
	<div id="wrapper">
		<!-- Header Section -->
		<? include("header.php"); ?>

		<!-- Body Section -->
		<div id="category_content">
			<table>
				<tbody>
					<tr>
						<td><img src="product/product-item0.jpg" /></td>
						<td><img src="product/product-item1.jpg" /></td>
						<td><img src="product/product-item2.jpg" /></td>
						<td><img src="product/product-item3.jpg" /></td>
					</tr>
					<tr>
						<td><div class="product_name">Presentation Bag A4</div></td>
						<td><div class="product_name">2 in 1 Presentation Bag</div></td>
						<td><div class="product_name">Labtop Bag Rising Sun</div></td>
						<td><div class="product_name">Hand Bag Stingray</div></td>
					</tr>
					<tr>
						<td><div class="price">450 ฿</div></td>
						<td><div class="price">450 ฿</div></td>
						<td><div class="price">450 ฿</div></td>
						<td><div class="price">450 ฿</div></td>
					</tr>
					<tr>
						<td><img src="product/product-item4.jpg" /></td>
						<td><img src="product/product-item5.jpg" /></td>
						<td><img src="product/product-item6.jpg" /></td>
						<td><img src="product/product-item7.jpg" /></td>
					</tr>
					<tr>
						<td><div class="product_name">Presentation Bag A4</div></td>
						<td><div class="product_name">2 in 1 Presentation Bag</div></td>
						<td><div class="product_name">Labtop Bag Rising Sun</div></td>
						<td><div class="product_name">Hand Bag Stingray</div></td>
					</tr>
					<tr>
						<td><div class="price">450 ฿</div></td>
						<td><div class="price">450 ฿</div></td>
						<td><div class="price">450 ฿</div></td>
						<td><div class="price">450 ฿</div></td>
					</tr>
				</tbody>
			</table>
			<table width="100%">
				<tbody>
					<tr>
						<td width="45%"></td>
						<td>
							<div id="categoryNav">
								<a href="#">1</a>
								<a href="#" class="active">2</a>
								<a href="#">3</a>
								<a href="#">4</a>
							</div>
						</td>
						<td width="17%">
							<div class="layout">

    <div class="layout-slider" style="width: 100%">
      <span style="display: inline-block; width: 150px; padding: 0 5px;"><input id="Slider1" type="slider" name="price" value="2000;6000" /></span>
    </div>
    <script type="text/javascript" charset="utf-8">
      jQuery("#Slider1").slider({ from: 1000, to: 10000, step: 100, smooth: true, round: 0, dimension: "&nbsp;฿", skin: "round" });
    </script>


    
  </div>
						</td>
					</tr>
					
				</tbody>
			</table>


		</div>

		<!-- Footer Section -->
		<? include("footer.php"); ?>
	</div>
</body>
</html>
