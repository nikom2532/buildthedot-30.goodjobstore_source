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
	<link rel="stylesheet" type="text/css" href="css/product.css" media="screen" />

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
</head>
<body>
	<div id="wrapper">
		<!-- Header Section -->
		<? include("header.php"); ?>

		<!-- Body Section -->
		<div id="product_content">
			<!-- Product Zoom-->
			<div id="productZoom">
				<div class="clearfix" id="content">
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
						</ul>
					</div>
				</div>
			</div>
			<!-- Product Detail -->
			<div id="productDetail">
				<div id="product_head">
					<div class="left">
						<h1>Stingray</h1>
						<div id="product_id">6356</div>
						<div id="product_line"></div>
						<div id="product_price">
						4,990 ฿<br />
						instead of <span style="text-decoration: line-through;">4,271 ฿</span><br />
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
					<p><h1>"Simplicity is the ultimate sophistication"  Leonardo da Vinci﻿</h1>
					The original case series "Stingray" is made of two circular sheets of tissue. And in order to create a functional amount of inside the front part of the designers affixed a triangular aluminum clip. 
					The reverse side is designed to minimize the distance between the bag and its owner honored.</p>
				</div>
				<div id="product_comment">Stingray - Winner of 2010 Design Excellence Award </div>
				<div id="product_buy">
					<form name="" type="" method="">
						<table>
							<tbody>
								<tr>
									<td width="400px" height="60px"><img src="images/color.jpg" /></td>
									<td>
										<div class="right">
											<label>Leather :</label>
											<select>
	                                                <option value="42" title="Black">Black</option>
	                                                <option value="36" selected="selected" title="Tan">Tan</option>
	                                        </select>
                                    	</div>
									</td>
								</tr>
								<tr>
									<td>
										<a href="#" class="wishlist_button">Add to wishlists</a>
										<a href="#" class="add_button">+ Add to cart</a>
									</td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</form>
				</div>
				<div id="product_like">
					<div class="like_title">
						<div class="backgroundText">PRODUCT YOU MAY LIKE</div>
					</div>
					<div class="img_prod">
						<ul>
							<li><img src="product/likeProd/01.jpg" /></li>
							<li><img src="product/likeProd/02.jpg" /></li>
							<li><img src="product/likeProd/03.jpg" /></li>
							<li><img src="product/likeProd/04.jpg" /></li>
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
