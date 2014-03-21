<?php
	$login = 'Log in';
	$logout = 'Register';
	$customer_url = site_url("login");
	$logout_url = site_url("register");
	
	if($this->session->userdata('logged_in'))
	{
		$customer = $this->session->userdata('customer');
		$login = "{$customer->FirstName} {$customer->LastName}";
		$logout = 'Log out';
		$customer_url = site_url("my");
		$logout_url = site_url("logout");
		
		if(trim($customer->FirstName)=='' && trim($customer->LastName)=='')
		{
			$login = $customer->Email;
		}
	}
	
	$cart_data = get_cart_data();
?>

 <script>
		$(document).ready(function(){
		   $("#search_query_top").focusin(function(event){
			   	var keyword = $(this).val();
		   		if(keyword==='Enter Keyword')
		   		{
			   		$(this).val('');	
		   		}
		   		$('#searching').attr('style',"background: black !important;");
		   });
		   
		   $("#search_query_top").focusout(function(event){
		   		var keyword = $(this).val();
		   		if(keyword==='')
		   		{
			   		$(this).val('Enter Keyword');	
		   		}
		   		$('#searching').attr('style','');
		   });
		 });   
	</script>

<!-- Header Section -->
<div id="header" class="clearfix">
	<div class="logo">
		<a href="<?=site_url()?>"><img src="<?=base_url()?>public/images/logo.jpg" /></a>
	</div>  <!-- logo -->
	<div class="right">
		<table>
			<tbody>
				<tr>
					<td style="vertical-align:middle">
						<div id="member">
							<ul class="member_style">
								<li class="line"><a href="<?=$customer_url?>"><?=$login?></a></li> 
								<li><a href="<?=$logout_url?>"><?=$logout?></a></li>
							</ul>
						</div>
					</td>
					<td>
						<div id="search">
							<form method="post" action="<?=site_url('shops/searching')?>" id="searchbox">
								<input type="hidden" name="orderby" value="position">
								<input type="hidden" name="orderway" value="desc">
					            <input type="submit" name="submit_search" value="Search" class="submit_search" id="searching">
					            <input class="search_query ac_input" type="text" id="search_query_top" name="search_query" value="Enter Keyword" autocomplete="off">
							</form>
						</div>
					</td>
				</tr>
			</tbody>
		</table>	
		<div id="language">
			<span class="guide"><a href="<?=site_url('guide')?>">Shopping Guide</a></span>
				<ul>
				<?php if(LANG=='TH'): ?>
					<li class="select first">TH</li>
					<li><a href="<?=site_url('shops/lang/EN')?>">EN</a></li>
				<?php else: ?>
					<li class="first"><a href="<?=site_url('shops/lang/TH')?>">TH</a></li>
					<li class="select">EN</li>
				<?php endif; ?>
				</ul>
		</div>  <!-- language -->
	</div>  <!-- right -->
</div>  <!-- header -->

<div id="nav" class="clearfix">
	<!-- START Nav Section -->
	<div id="smoothmenu1" class="ddsmoothmenu">
	<? $main_navigation = get_all_main_navigation(); ?>
		<ul>
			<?php foreach($main_navigation as $key_main => $main_navigations): ?>
				<li>
				<?php if(LANG=='TH'): ?>
					<a href="<?=site_url("{$this->config->item('cat')}/{$main_navigations->main_url}")?>" title=""><?=$main_navigations->Name_Th?></a>
				<?php else: ?>
					<a href="<?=site_url("{$this->config->item('cat')}/{$main_navigations->main_url}")?>" title=""><?=$main_navigations->Name_En?></a>
				<?php endif; ?>
					
					<?php $sub_navigation = get_all_sub_menu_navigation($main_navigations->main_ID);  ?>
					<?php if(!empty($sub_navigation)): ?>
						<ul>
						<?php foreach($sub_navigation as $key => $value): ?>
							<?php if(LANG=='TH'): ?>
								<li><a href="<?=site_url("{$this->config->item('cat')}/{$main_navigations->main_url}/{$value->sub_url}")?>"><?=$value->Name_Th?></a>
							<?php else: ?>
								<li><a href="<?=site_url("{$this->config->item('cat')}/{$main_navigations->main_url}/{$value->sub_url}")?>"><?=$value->Name_En?></a>
							<?php endif; ?>

							<?php $son_navigation = get_all_son_menu_navigation($value->Sub_ID);  ?>
							
							<?php if(!empty($son_navigation)): ?>
								<ul>
								<?php foreach($son_navigation as $key => $value1): ?>
									<?php if(LANG=='TH'): ?>
										<li><a href="<?=site_url("{$this->config->item('cat')}/{$main_navigations->main_url}/{$value->sub_url}/{$value1->son_url}")?>"><?=$value1->Name_Th?></a></li>
									<?php else: ?>
										<li><a href="<?=site_url("{$this->config->item('cat')}/{$main_navigations->main_url}/{$value->sub_url}/{$value1->son_url}")?>"><?=$value1->Name_En?></a></li>
									<?php endif; ?>
								<?php endforeach; ?>
								</ul>
							<?php endif; ?>
							</li>
						<?php endforeach; ?>
						</ul>
					<?php endif; ?>
				</li>
			<?php endforeach; ?>
		</ul>
		<br style="clear: left" />
		</div> <!-- smoothmenu1 -->
		<!-- END Nav Section -->

	<!-- EXAMPLE -->
	<!-- <div id="smoothmenu1" class="ddsmoothmenu">
	<ul>
		<li><a href="#">NEW ARRIVALS</a>
			<ul>
				<li><a href="#">SPECIAL</a></li>
				<li><a href="#">CORPERATE GIFT</a>
				<ul>
					<li><a href="#">TEDDY BEAR</a></li>
					<li><a href="#">CARTOON'S GAME CARD</a></li>
					<li><a href="#">WRISTBAND</a></li>
					<li><a href="#">PAPERS & PENCILS</a></li>
					<li><a href="#">SAND CLOCK</a></li>
					<li><a href="#">SMART A.O.E.</a></li>
				</ul>
				</li>
				<li><a href="#">SKIRT</a></li>
				<li><a href="#">NOTEBOOK</a></li>
			</ul>
		</li>
		<li><a href="#">STATIONERY </a></li>
		<li><a href="#">BAG & ACCESSORIES</a>
			<ul>
				<li><a href="#">DOCUMENT BAG</a></li>
				<li><a href="#">PRESENTATION BAG</a></li>
				<li><a href="#">LAPTOP BAG</a></li>
				<li><a href="#">WINE HOLDER</a></li>
				<li><a href="#">TISSUE HOLDER</a></li>
			</ul>
		</li>
		<li><a href="#">AWESOME</a>
			<ul>
				<li><a href="#">SUNGLASSES & GLASSES</a></li>
				<li><a href="#">BELTS & BRACES</a></li>
				<li><a href="#">HATS</a></li>
				<li><a href="#">SCARVES NECKERS</a></li>
				<li><a href="#">WALLETS</a></li>
				<li><a href="#">BAGS</a></li>
				<li><a href="#">POCKET SQURES</a></li>
				<li><a href="#">TIES AND BOW TIES</a></li>
				<li><a href="#">MEN JEWELLY  & WATCH</a></li>
				<li><a href="#">BRANDED ACCESSORIES</a>
				<ul>
					<li><a href="#">MEN T-SHIRT & VEST</a></li>
					<li><a href="#">WAIST COATS</a></li>
				</ul>
				</li>
			</ul>
		</li>
		<li><a href="#">DESIGNERS'TOOLS</a></li>
		<li><a href="#">SALES</a></li>
	</ul>
	<br style="clear: left" />
	</div>  --> <!-- smoothmenu1 -->

	<!-- END Nav Section -->

	<div id="shopping_info">
		<a id="displayText" href="#"><img src="<?=base_url()?>public/images/cart.jpg" align="absmiddle" />Shopping Cart</a>
		<a href="<?=site_url('shops/locator')?>"><img src="<?=base_url()?>public/images/location.jpg" align="absmiddle" />Store Locator</a>
		
		<div id="toggleText" class="toggleText" style="display: none">
		<?php foreach($cart_data as $result): ?>
			<div class="left">
				<img class="imgToggle" src="<?=base_url()?>public/<?=$result->images_Thumbnail_path?>" />
			</div>
			<div class="right">
				<?=(LANG=='TH')?$result->products_Pro_Name_Th:$result->products_Pro_Name_En?><br>
				<?=(LANG=='TH')?$result->color_Name_TH:$result->color_Name_EN;?>
				<table width="125px">
					<tbody>
						<?php if($result->products_Size): ?>
						<tr>
							<td>SIZE</td>
							<td class="tr"><?=$result->products_Size?></td>
						</tr>
						<?php endif; ?>
						<tr>
							<td>Qty</td>
							<td class="tr">
								<?=$result->cart_Qty?> x 
								<?
									if($result->products_Price_sale!=0)
										$exHPrice = number_format($result->products_Price_sale);
									else
										$exHPrice = number_format($result->products_Price_Buy);
									if(LANG=='EN')
										echo "US$ ".google_finance_convert("THB", "USD", $result->products_Price_Buy);
									else
										echo $exHPrice." ฿";
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="price_total">TOTAL  
				<span class="textRight">
					<?
						if($result->products_Price_sale!=0)
							$exHTotal = number_format($price_arr[] = $result->products_Price_sale*$result->cart_Qty);
						else
							$exHTotal = number_format($price_arr[] = $result->products_Price_Buy*$result->cart_Qty);
						if(LANG=='EN')
							echo "US$ ".google_finance_convert("THB", "USD", $exHTotal);
						else
							echo $exHTotal." ฿";
					?>
				</span>
			</div>
		<?php endforeach; ?>
			<a href="<?=site_url('cart')?>">VIEW SHOPPING CART</a>
		</div>
	</div>
</div>

<div id="breadcrumbs">
<?php if(isset($nav_arr)): ?>
	<?php foreach($nav_arr as $key => $value): ?>
		<?php if($value['current']==TRUE && $value['name'] != $this->config->item('cat')): ?>
			<li class="current"><?=$value['name']?></li>
		<?php elseif($value['name'] != $this->config->item('cat')): ?>
			<li><a href="<?=$value['link']?>"><?=$value['name']?></a></li>
		<?php elseif($value['name'] == $this->config->item('cat')): ?>
			<li><a href="<?=site_url()?>">HOME</a></li>
		<?php endif; ?>
	<?php endforeach; ?>
<?php else: ?>
	<?php if(isset($nav_1)): ?>
	<ul>
		<li><a href="<?=site_url()?>">Home</a></li>
		<?php if($nav_1['current']==TRUE): ?>
			<li class="current"><?=$nav_1['name']?></li>
		<?php else: ?>
			<li><a href="<?=$nav_1['link']?>"><?=$nav_1['name']?></a></li>
		<?php endif; ?>
		
		<?php if(isset($nav_2)): ?>
			<?php if($nav_2['current']==TRUE): ?>
				<li class="current"><?=$nav_2['name']?></li>
			<?php else: ?>
				<li><a href="<?=$nav_2['link']?>"><?=$nav_2['name']?></a></li>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if(isset($nav_3)): ?>
			<?php if($nav_3['current']==TRUE): ?>
				<li class="current"><?=$nav_3['name']?></li>
			<?php else: ?>
				<li><a href="<?=$nav_3['link']?>"><?=$nav_3['name']?></a></li>
			<?php endif; ?>
		<?php endif; ?>
	</ul>
	<?php endif; ?>
<?php endif; ?>
</div>
