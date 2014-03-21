<? 
	session_start();
	include_once 'classes/Products.php';
	include_once 'classes/Cross_Sale.php';
	//include_once 'classes/Images.php';
	$product = new Products();
	$Product_ID = 'PR000004';
	$color_id=1;
	//$_SESSION["Cus"]="P00001";
	$pro = $product->selectAll($Product_ID);
	$getproduct_name = $product->getPro_Name_En();
	$getproduct_code = $product->getProduct_Code();
	$getproduct_price = $product->getPrice_sale();
	$getProduct_description = $product->getDescription_En();
	//$get_cusid = $_GET['id'];
	//$image = new Images();
	$img = $product->selectimage($Product_ID);
	//Cross sale
	$Cross_sale = new Cross_Sale();
	$img = $Cross_sale->selectQuery($Product_ID);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
	<title>GOODJOB</title>
	<meta name="description" content="Shop powered by PrestaShop">
	<meta name="keywords" content="shop, prestashop">
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8">
	<meta name="generator" content="GoodJobStore">
	<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.png">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/mainstyle.css">
	<link rel="stylesheet" type="text/css" href="css/product.css" media="screen" />
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
    <link rel="stylesheet" href="css/jquery.jqzoom.css" type="text/css">	
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
	<script type="text/javascript" src="scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
		});
	</script>	
	<?include("script-menu.php");?>
</head>
<body>
	<div id="fb-root"></div>
	<div id="fb-root"></div>
		<script>(function(d, s, id) {
		 	var js, fjs = d.getElementsByTagName(s)[0];
		  	if (d.getElementById(id)) return;
		  	js = d.createElement(s); js.id = id;
		  	js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=192641684159967";
		  	fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	<div id="wrapper">
		<!-- Header Section -->
		<? include("header.php"); ?>

		<!-- Body Section -->
		<div id="product_content">
			<!-- Product Zoom-->
			<div id="productZoom">
				<div id="content">
				
					<?php
						//echo $product->getProduct_image();
					?>
	    			<div class="clearfix">
	        			<a href="product/imgProd/triumph_big1.jpg" class="jqzoom" rel='gal1'  title="" >
	            		<img src="product/imgProd/triumph_small1.jpg"  title="">
	        			</a>
	    			</div>
					<br/>
		 			<div class="clearfix" >
						<ul id="thumblist" class="clearfix" >
							<li><a class="zoomThumbActive" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: './product/imgProd/triumph_small1.jpg',largeimage: './product/imgProd/triumph_big1.jpg'}"><img src='product/imgProd/thumbs/triumph_thumb1.jpg'></a></li>
							<li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: './product/imgProd/triumph_small2.jpg',largeimage: './product/imgProd/triumph_big2.jpg'}"><img src='product/imgProd/thumbs/triumph_thumb2.jpg'></a></li>
							<li><a  href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: './product/imgProd/triumph_small3.jpg',largeimage: './product/imgProd/triumph_big3.jpg'}"><img src='product/imgProd/thumbs/triumph_thumb3.jpg'></a></li>
							<li><a href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: './product/imgProd/triumph_small2.jpg',largeimage: './product/imgProd/triumph_big2.jpg'}"><img src='product/imgProd/thumbs/triumph_thumb2.jpg'></a></li>
						</ul>
						
					</div>
				</div>
			</div>
			<!-- Product Detail -->
			<div id="productDetail">
				<div id="product_head">
					<div class="left">
						<div class="fb-like" data-href="http://online.goodjobstore.com/product.php" data-send="false" data-layout="button_count" data-width="200" data-show-faces="false"></div>						
						<h1 class="product_name"><?=$getproduct_name?></h1>
						<div id="product_id"><?=$getproduct_code?></div>
						<div id="product_line"></div>
						<div id="product_price">
						<?=$getproduct_price?> ฿<br />
						<!--instead of <span style="text-decoration: line-through;">4,271 ฿</span><br />-->
						</div>
					</div>
					<!-- AddThis Button BEGIN -->
					<div class="right">
						<ul id="social">
							<li><a href="#"><img src="images/facebook.png" /></a></li>
							<li><a href="#"><img src="images/twitter.png" /></a></li>
							<li><a href="#"><img src="images/mail.png" /></a></li>
						</ul>
					</div>
					<!-- AddThis Button END -->
					
				</div>
				<div id="product_info">
					<div id="scrollbar1">
						<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
						<div class="viewport">
						 	<div class="overview">
							<?=$getProduct_description?>
							<!--<h1>"Simplicity is the ultimate sophistication"  Leonardo da Vinci﻿</h1>
							<p>The original case series "Stingray" is made of two circular sheets of tissue. And in order to create a functional amount of inside the front part of the designers affixed a triangular aluminum clip. 
							The reverse side is designed to minimize the distance between the bag and its owner honored.
							<br /><br />The original case series "Stingray" is made of two circular sheets of tissue. And in order to create a functional amount of inside the front part of the designers affixed a triangular aluminum clip. 
							The reverse side is designed to minimize the distance between the bag and its owner honored.</p>-->
							<div id="product_comment">Stingray - Winner of 2010 Design Excellence Award </div>
							<br /><br />
							</div>
						</div>
					</div>
				</div>
				
				<div id="product_buy">
					<form name="" type="" method="">
						<table>
							<tbody>
								<tr>
									<td width="160px" height="60px">SYNTHETIC LEATHER<br/><img src="images/color.jpg" /></td>
									<td>LEATHER<br/><img src="images/color2.png" /></td>
									<td>
									</td>
								</tr>
								<tr>
									<td height="10px"></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table>
							<tbody>
								<tr>
									<td>
										<a href='wishlist.php?product_id=<?php echo $product->getProduct_ID();?>&color_id=<?= $color_id ?>' class="wishlist_button">ADD TO WISHLIST</a>
										<a href="#" class="add_button">+ ADD TO CART</a>
									</td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
				<div id="product_like">
					<div class="like_title">
						<div class="backgroundText">PRODUCTS YOU MAY LIKE</div>
					</div>
					<div class="img_prod">
						<ul>
							<?php
								echo $Cross_sale->getQuery();
							?>
							<!--<li><a href='#'><img src="product/likeProd/01.jpg" /></a></li>
							<li><img src="product/likeProd/02.jpg" /></li>
							<li><img src="product/likeProd/03.jpg" /></li>
							<li><img src="product/likeProd/04.jpg" /></li>-->
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer Section -->
		<? include("footer.php"); ?>
	</div>


</body>
</html>
