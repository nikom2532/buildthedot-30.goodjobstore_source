<?php 
//	echo($cat_arr."<br>");
//	var_dump($cat_arr);
//	echo("<br>");
//	var_dump($cat_arr[2]);
//	echo("<br>");	

//	echo(count($cat_arr));
//	echo("<br>");
//	$aa = $this->uri->total_segments();

//	$bb = str_replace("%20"," ",$cat_arr[2]);
//	echo $aa."<br>".$bb;
//	echo $cat_arr;

	$cat_url = uri_string();

	$cat_en[2]='';
	$cat_en[3]='';
	$cat_en[4]='';
	$cat_en[5]='';
	$countArr = count($cat_arr);
	for($i=2;$i<=$countArr;$i++)
	{
		$sub_cat[$i] = str_replace("%20"," ",$cat_arr[$i]);
		$cat_en[$i] = base64_encode($sub_cat[$i]);
	}
//	echo("1, $sub_cat[2], $sub_cat[3], $sub_cat[4], $sub_cat[5], $min_value, $max_value");
?>

<!-- jqZoom -->
	<base href="<?=base_url()?>public/" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/category.css" media="screen" />
    <link rel="stylesheet" href="<?=base_url()?>public/css/jquery.jqzoom.css" type="text/css">	
	<script src="<?=base_url()?>public/scripts/jquery-1.6.js" type="text/javascript"></script>
	<script src="<?=base_url()?>public/scripts/jquery.jqzoom-core.js" type="text/javascript"></script>
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
	<!-- bin/jquery.slider.min.css -->
	<link rel="stylesheet" href="<?=base_url()?>public/css/jslider.css" type="text/css">


	<link rel="stylesheet" href="<?=base_url()?>public/css/jslider.round.css" type="text/css">
	
	
	<!-- bin/jquery.slider.min.js -->
	<script type="text/javascript" src="<?=base_url()?>public/scripts/jshashtable-2.1_src.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/scripts/jquery.numberformatter-1.2.3.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/scripts/tmpl.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/scripts/jquery.dependClass-0.1.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/scripts/draggable-0.1.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/scripts/jquery.slider.js"></script>

  
	<!-- connect database-->
	<script type="text/javascript" src='<?=base_url()?>public/scripts/ajax.category.java'></script>

		<!-- Body Section -->
		<script>		
		     viewList('1', '<?=$cat_en[2]?>', '<?=$cat_en[3]?>', '<?=$cat_en[4]?>', '<?=$cat_en[5]?>', '<?=$min_value?>', '<?=$max_value?>','<?=$cat_url?>','<?=LANG?>');
			 viewNav('1', '<?=$cat_en[2]?>', '<?=$cat_en[3]?>', '<?=$cat_en[4]?>', '<?=$cat_en[5]?>', '<?=$min_value?>', '<?=$max_value?>','<?=$cat_url?>');
		</script>
		<div id="category_contents">
			<div id="category_images">

			<!-------------- call ajax -------------->

<!--		<table>
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
-->
			</div> <!-- category_images -->
			<table width="100%">
				<tbody>
					<tr>
						<td width="45%"></td>
						<td>
							<div id="categoryNav"></div>
						</td>
						<td width="17%">
							<div class="layout">
								<div class="layout-slider" style="width: 100%">
									<span style="display: inline-block; width: 150px; padding: 0 5px;">
										<input id="Slider1" type="slider" name="price" value="0;10000" />
									</span>
								 </div><!-- layout-slider -->
								<script type="text/javascript" charset="utf-8">
								  jQuery("#Slider1").slider
								  ({ 
										from: 0, to: 10000, 
										step: 100, 
										smooth: true, 
										round: 0, 
										dimension: "&nbsp;฿", 
										skin: "round",
										callback: function(value) 
										{
											var myPair = null;  
											 myPair = $("#Slider1").slider("value");
											 var split = myPair.split(';');
											 viewList('1', '<?=$cat_en[2]?>', '<?=$cat_en[3]?>', '<?=$cat_en[4]?>', '<?=$cat_en[5]?>', split[0], split[1],'<?=$cat_url?>','<?=LANG?>');
											 viewNav('1', '<?=$cat_en[2]?>', '<?=$cat_en[3]?>', '<?=$cat_en[4]?>', '<?=$cat_en[5]?>', split[0], split[1],'<?=$cat_url?>');
										}
								 });
								</script>
							</div>  <!-- layout -->
						</td>
					</tr>
				</tbody>
			</table>
		</div> <!--category_content  -->