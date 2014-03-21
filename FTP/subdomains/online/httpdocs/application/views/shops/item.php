<base href="<?=base_url()?>public/" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/product.css" media="screen" />
	
	<!-- imageSlide jQuery -->
	<link href="<?=base_url()?>public/css/imageSlide.css" type="text/css" rel="stylesheet">
    <script src="<?=base_url()?>public/scripts/imageSlide.js"></script>

	<!-- jqZoom -->
    <link rel="stylesheet" href="<?=base_url()?>public/css/jquery.jqzoom.css" type="text/css">	
	<script src="<?=base_url()?>public/scripts/jquery-1.6.js" type="text/javascript"></script>
	<script src="<?=base_url()?>public/scripts/jquery.jqzoom-core.js" type="text/javascript"></script>

	<!-- tinyscrollbar -->
	<script type="text/javascript" src="<?=base_url()?>public/scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
		});
	</script>
	<!-- tinyscrollbar -->
	
	<script type="text/javascript">
		function testtest()
		{
			$('.jqzoom').jqzoom({
	            zoomType: 'standard',
	            lens:true,
	            preloadImages: true,
	            alwaysOn:false
	        });
		}
		
		function demo()
		{
			$(".zoomWrapperImage").remove();
		}

		function testtest1(id)
		{
			$('.testtest'+id).attr('dir', function(i, val) {
				$('#testjqzoom').attr('href', val);
				
				$('.testtest'+id).attr('title', function(i, val1) {
					$('#input_pic').attr('src', val1);
				
					$(".jqZoomWindow").remove();
					$(".jqZoomPup").remove();
					$(".jqzoom").remove();
						  
					$("#new_data").remove();
					$("#testbeta").html('<div class="clearfix" id="new_data"></div>');
					$('#new_data').append('<a href="'+val+'" class="hoverproduct"><img id="input_pic" src="'+val1+'" id="main-product-image" /></a>');
						 
					// reload jQZoom after switching image
					$(".hoverproduct").jqzoom({
						zoomWidth: 510,
						zoomHeight: 380,
						title: false
					});
				});			  
			});
		}
	</script>

	<!-- connect Database -->
	<script src="<?=base_url()?>public/scripts/ajax.item.java" type="text/javascript"></script>
	<?
		$objCon = mysql_connect("localhost","dev","0823248713") or die(mysql_error());
		$objDB = mysql_select_db("goodjob") or die("Can't connect Database");
		mysql_query("SET NAMES utf8",$objCon);

		//------ Product Description -----------
		$sql = "SELECT *
				FROM product_groups
				JOIN products ON product_groups.Product_Code = products.Product_Code
				JOIN images ON products.Product_ID = images.Product_ID
				WHERE product_groups.Product_Code = '$product_code'
				AND primary_product = 1
				GROUP BY product_groups.Product_Code";
		$result = mysql_query($sql, $objCon) or die(mysql_error());

		//------ Thumbnail images -----
		$sqlLevel = "SELECT * from images
					WHERE Product_Code = '$product_code' 
					ORDER BY Product_ID,Level";
		$resultLevel = mysql_query($sqlLevel, $objCon) or die(mysql_error());

		//------ Property Type ---------
		$sqlPropType = "SELECT products.Product_ID,products.Property_ID,name_en,Color_ID FROM products 
						JOIN property ON products.Property_ID = property.prop_id
						JOIN images ON products.Product_ID = images.Product_ID
						WHERE products.Product_Code = '$product_code'
						GROUP BY products.Product_ID";
		$resultPropType = mysql_query($sqlPropType, $objCon) or die(mysql_error());

/*
		//------- Image Color -------
		$sqlImgColor = "SELECT color.Color_ID, Name_EN, Name_TH, color.path
						FROM color JOIN images
						ON color.Color_ID = images.Color_ID
						WHERE images.Product_Code = '$product_code'
						GROUP BY color.Color_ID";
		$resultImgColor = mysql_query($sqlImgColor, $objCon) or die(mysql_error());

		//------- Image Property ------
		$sqlImgProp = "SELECT Product_ID,Property_Name,Property_path 
						FROM products 
						WHERE Product_Code = '$product_code'
						GROUP BY Product_ID";
		$resultImgProp = mysql_query($sqlImgProp, $objCon) or die(mysql_error());
*/
	?>
		
		<!-- Body Section -->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		 var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<div id="product_content" class="clearfix">
			<div id="productZoom">

				<div  id="content" class="clearfix" style="height:380px;">
					<script>viewItem('<?=$product_code?>','','');</script>
					<!-- view Item -->
				</div>

				<!-- Thumbnail Images Start -->
				<div class="clearfix" id="itemSelect" >
					<div id="thumblist" class="clearfix">
						<span id="slide_box_sp">  
							<div class="go_l_nav" title="Back"></div>  
							<div class="content_slide">
								<div id="content_slide_in"> 
								<?
								while ($dataLevel=mysql_fetch_array($resultLevel))
								{?>
									<a title="../../public/<?=$dataLevel["Path_Small"]?>"
										dir = "../../public/<?=$dataLevel["Path"]?>"
										class="zoomThumbActive testtest<?=$dataLevel["Image_ID"]?>" 
										href='javascript:void(0);' 
										rel="{gallery: 'gal1', smallimage:'../../public/<?=$dataLevel["Path_Small"]?>', largeimage:'../../public/<?=$dataLevel["Path"]?>'}"
										onclick="javascript:testtest1(<?=$dataLevel["Image_ID"]?>);
										changeImage('<?=$dataLevel["Product_ID"]?>',<?=$dataLevel["Color_ID"]?>);
										viewHeadDetail('<?=$dataLevel['Product_ID']?>','','','<?=LANG?>');">
												<?
												//------ Show shot msg title -----
												$sqlMsg = "SELECT Group_msg_En,Group_msg_Th FROM product_groups
															WHERE Product_Code = '$product_code'";
												$resultMsg = mysql_query($sqlMsg, $objCon) or die(mysql_error());
												while ($dataMsg=mysql_fetch_array($resultMsg)){?>
													<img src="../../public/<?=$dataLevel['Thumbnail_path'] ?>" 
													title="<?=(LANG=='TH')?$dataMsg['Group_msg_Th']:$dataMsg['Group_msg_En'];?>" width="100px">
												<?}?>
									</a>
									<span class="zoomThum<?=$dataLevel["Image_ID"]?>" style='display:none;'>
									<?=$dataLevel["Thumbnail_path"]?></span>
								<?}?>
									</div>  <!-- content_slide_in -->
								</div>  <!-- content_slide -->
							<div class="go_r_nav" title="Next"></div>  
						</span>
					</div>  <!-- thumblist -->
				</div>  <!-- itemSelect -->
				<!-- Thumbnail Images End -->
			</div>  <!-- productZoom -->

			<div id="productDetail">
			
			<?php
			function curPageURL() {
			$pageURL = 'http://';

			if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			}
			return $pageURL;
			}
			?>

			<?php
			$url= curPageURL();
			$this->session->set_userdata('last_page', $_SERVER["REQUEST_URI"]);
			?>
			<div class="fb-like" data-href=<?=$url?> data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
			<div id="product_head" class="clearfix">
					<div class="left">
						<?
						while ($data=mysql_fetch_array($result))
						{?>
						<h1><?=(LANG=='TH')?$data['Group_Name_Th']:$data['Group_Name_En'];?></h1>
						<div id="head_detail">
							<script>viewHeadDetail('<?=$data['Product_ID']?>','','','<?=LANG?>');</script>
							<!-- view Head Detail -->
						</div>
					</div>  <!-- left -->
					
					<div class="right">
						<ul id="social">
							<li><a href="http://www.facebook.com/GOODJOBSTORE"><img src="../../../../dashboard/images/facebook.png" /></a></li>
							<li><a href="http://www.pinterest.com/goodjobstore"><img src="../../../../dashboard/images/pinterest.png" /></a></li>
							<li><img src="../../../../dashboard/images/mail.png" /></li>
						</ul>
					</div>   <!-- right --> 
				</div>  <!-- product_head -->

				<div id="scrollbar1" class="clearfix">
					<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
						<div class="viewport">
							<div class="overview">
								<?=(LANG=='TH')?$data['Group_Description_Th']:$data['Group_Description_En'];?>
							</div>  <!-- overview -->
						</div>  <!-- viewport -->
				</div>  <!-- scrollbar1 -->

				<div id="product_comment"><?=(LANG=='TH')?$data['Group_msg_Th']:$data['Group_msg_En'];?></div>

			<? $QtyProduct = $data['Qty']; ?>
			<?}?> <!-- End while -->
			
				<div id="wrapperColor">
				<? while($dataPropType=mysql_fetch_array($resultPropType))
					{
						$propTypeID = $dataPropType['Product_ID'];
				?>
						<div class="colorItem">
							<?if($dataPropType['Color_ID']!=33)
							{?>
								<h2 style="font: inherit;"><?=$dataPropType['name_en']?></h2>
									<?//------- Image Color -------
									$sqlImgColor = "SELECT color.Color_ID, Name_EN, Name_TH, color.path
													FROM color JOIN images
													ON color.Color_ID = images.Color_ID
													WHERE images.Product_ID = '$propTypeID'
													GROUP BY color.Color_ID";
									$resultImgColor = mysql_query($sqlImgColor, $objCon) or die(mysql_error());
									while($dataImgColor=mysql_fetch_array($resultImgColor))
									{
										if($dataImgColor['Color_ID']!=33)
										{
									?>
											<a href="javascript:void(0);" onclick="filterColor(<?=$dataImgColor['Color_ID']?>,'<?=$propTypeID?>');" style="text-decoration:none;">
												<img src="../../../../public/<?=$dataImgColor['path']?>" title="<?=(LANG=='TH')?$dataImgColor['Name_TH']:$dataImgColor['Name_EN'];?>"/>
											</a>
										<?}
									}?>
							<?}?>
						</div>  <!-- colorItem -->
				<?}?>
				</div> <!-- wrapperColor -->

				<div id="product_BuyAndCrossPrice">
					<script>viewDescrip('','<?=$product_code?>','','<?=$QtyProduct?>');</script>
					<!-- goto: connect.item.description.php -->
				</div>  <!-- product_BuyAndCrossPrice -->

			</div>  <!-- productDetail -->
		</div>  <!-- product_content -->


			<script>

				function changeImage(proID,select_color)
				{
					viewDescrip(proID,'<?=$product_code?>',select_color,'<?=$QtyProduct?>');
				}

				function filterColor(filter_Color,propType)
				{
					viewItem('<?=$product_code?>',filter_Color,propType);
					viewHeadDetail(propType,filter_Color,'<?=$product_code?>','<?=LANG?>');
					viewDescrip(propType,'<?=$product_code?>',filter_Color,'<?=$QtyProduct?>');
				}

				function filterProperty(filter_Property)
				{
					viewItem('','',filter_Property);
					viewHeadDetail(filter_Property,'','<?=$product_code?>','<?=LANG?>');
					viewDescrip(filter_Property,'<?=$product_code?>','','<?=$QtyProduct?>');
				}

			</script>