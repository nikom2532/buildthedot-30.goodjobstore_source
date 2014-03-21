<?
  include_once 'classes/Customers.php';
  $login = 'Log in';
  $logout = 'Register';
  $link = 'login.php';
  $cus_id = $_SESSION['Cus'];
  if(isset($cus_id))
  {
            $cus = new Customers();
			$cus->selectAll($cus_id);
			$login = $cus->getFirstName()." ".$cus->getLastName();
			$first = $cus->getFirstName();
			$last = $cus->getLastName();
			$logout = 'Log out';
			if($login)
			{
				$link = "notification.php?id=$cus_id";
			}			
			$get_cusid = $cus->getCus_ID();
			if(isset($first)==0&&isset($last)==0)
			{
				$login = $cus->getEmail();
			}
  }
  include_once 'classes/Main_Menu.php';
	$getmenu = new Main_Menu();
	$all = $getmenu->allMainmenu();
?>
<!-- Header Section -->
<div id="header">
	<div class="logo"><a href="index.php"><img src="images/logo.jpg" /></a></div>
	<div class="right">
		<table>
			<tbody>
				<tr>
					<td style="vertical-align:middle">
						<div id="member">
							<ul class="member_style">
								<li class="line"><a href="<?=$link?>"><?=$login?></a></li> 
								<li><a href="login.php"><?=$logout?></a></li>
							</ul>
						</div>
					</td>
					<td>
						<div id="search">
							<form method="get" action="#" id="searchbox">
								<input type="hidden" name="orderby" value="position">
								<input type="hidden" name="orderway" value="desc">
					            <input type="submit" name="submit_search" value="Search" class="submit_search"><input class="search_query ac_input" type="text" id="search_query_top" name="search_query" value="" autocomplete="off">
							</form>
						</div>
					</td>
				</tr>
			</tbody>
		</table>	
		<div id="language">
			<span class="guide"><a href="payment-guide.php ">Shopping Guide</a></span>
				<ul>
					<li class="first"><a href="#">TH</a></li>
					<li class="select">EN</li>
				</ul>
		</div>
	</div>
</div>
<!-- Navigation Section -->
<div id="nav">
	<div id="droplinetabs1" class="droplinetabs">
		<ul>
		<?php
			//	echo $getmenu->getAllMainmenu();
				
				?>
			<li class="first">
				
				<a href="#" title="">New Arrivals</a>
					<ul>
						<li><a href="#">Spacial</a></li>
						<li><a href="#">Corporate Gift</a></li>
						<li><a href="#">Skirt</a></li>
						<li><a href="#">Notebook case</a></li>
					</ul>
			</li>
			<li><a href="#" title="">Stationery</a></li>
			<li>
				<a href="#" title="">Bags & Accessories</a>
					<ul>
						<li><a href="#">Document Bag </a></li>
						<li><a href="#">Presentation Bag </a></li>
						<li><a href="#">Laptop Bag</a></li>
						<li><a href="#">Wine Holder</a></li>
						<li><a href="#">Tissue Holder</a></li>
					</ul>
			</li>
			<li><a href="#" title="">Awesome</a></li>
			<li><a href="#" title="">Designers' tools</a></li>
			<li><a href="#" title="" class="last">Sales</a></li>
		</ul>
		
	</div>
	<div id="shopping_info">
		<a id="displayText" href="javascript:toggle();"><img src="images/cart.jpg" align="absmiddle" />Shopping Cart</a>
			<a href="#"><img src="images/location.jpg" align="absmiddle" />Store Locator</a>
		
		<div id="toggleText" style="display: none">
				<div class="left"><img class="imgToggle" src="product/shopping-img.jpg" /></div>
				<div class="right">
					Spring Pee per (s)<br>dk purplr / oatmeal
					<table width="150px">
						<tbody>
							<tr>
								<td>SIZE</td>
								<td class="tr">10"x10"</td>
							</tr>
							<tr>
								<td>Qty</td>
								<td class="tr">1 x 350 ฿</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="price_total">TOTAL  <span class="textRight">350 ฿</span></div>
				<a href="#">VIEW SHOPPING CART</a>
			</div>
	</div>
</div>
<div id="breadcrumbs">
				<ul>
					<li><a href="#">Home</a></li>
					<li><a href="#">Bag & Accessories</a></li>
					<li class="current">2 in 1 Presentation</li>
				</ul>
</div>