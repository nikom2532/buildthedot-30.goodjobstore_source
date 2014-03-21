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
	<link rel="stylesheet" type="text/css" href="css/checkout.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script src="scripts/droplinemenu.js" type="text/javascript"></script>
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
</head>
<body>
	<div id="wrapper">
		<!-- Header Section -->
		<? include("header.php"); ?>

		<!-- Body Section -->
		<div id="title_head">
			Checkout 
		</div>
		<div id="process">
			<ul>
				<li><img src="images/step_01.png" /></li>
				<li><img src="images/step_02_active.png" /></li>
				<li><img src="images/step_03_02active.png" /></li>
				<li><img src="images/step_04.png" /></li>
			</ul>
		</div>
		<div id="payment">
			<div class="left">
				<div id="cart_title">Payment</div>
				<div id="table_payment">
				<table>
					<tbody>
						<tr>
							<td width="50;" class="tcl"><input type="checkbox" name="visa"></td>
							<td>
								Pay via credit card is provided form Krungsri Ayudhaya Bank.
								You will be redirected to Krunsri Ayudhaya bank payment system.
								We are not record any informations of your credit card, It's 100% safe.
							</td>
						</tr>
						<tr>
							<td></td>
							<td><img src="images/visa-mastercard.jpg" /></td>
						</tr>
						<tr>
							<td class="tcl"><input type="checkbox" name="kbank"></td>
							<td>ท่าจจะได้รับแบบฟอร์มการชำระงเิน ผ่านทางอิเมล์ที่ท่านลงทะเบียนไว้กับเราและ
								สามารถนำแบบฟอร์มที่ได้รับชำระค่าสินค้าผ่านหน้าเคาน์เตอร์ธนาคารทั้ง 3 แห่ง
								หรือผ่านระบบ Online ของธนาคารที่ท่านมีบัญชีอยู่
							</td>
						</tr>
						<tr>
							<td></td>
							<td><img src="images/kbank-ktb.jpg" /></td>
						</tr>
						<tr>
							<td class="tcl"><input type="checkbox" name="paypal"></td>
							<td>การชำระเงินผ่าน PayPal</td>
						</tr>
						<tr>
							<td></td>
							<td><img src="images/paypal.jpg" /></td>
						</tr>
					</tbody>
				</table>
				</div>
			</div>
			<div class="right">
				<div id="cart_title">Cart</div>
				<div id="scrollbar1">
					<div class="scrollbar">
						<div class="track">
							<div class="thumb">
								<div class="end"></div>
							</div>
						</div>
					</div>
					<div class="viewport">
						<div class="overview">
							<!-- Prodcut Item -->
							<div id="item">
								<div id="char_left">
									<img src="product/order1.jpg" />
								</div>
								<div id="char_right">
									<table width="200px">
										<tbody>
											<tr>
												<td>Spring Pee per(s)<br> COLOR Yellow<br> Size 10"x10"</td>
											</tr>
											<tr>
												<td>Qty <input type"text" name"qty" class="text">Update</td>
											</tr>
											<tr>
												<td style="	text-align: right;"><span class="price">165 ฿</span></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- End Prodcut Item -->
							<!-- Prodcut Item -->
							<div id="item">
								<div id="char_left">
									<img src="product/order1.jpg" />
								</div>
								<div id="char_right">
									<table width="200px">
										<tbody>
											<tr>
												<td>Spring Pee per(s)<br> COLOR Yellow<br> Size 10"x10"</td>
											</tr>
											<tr>
												<td>Qty <input type"text" name"qty" class="text">Update</td>
											</tr>
											<tr>
												<td style="	text-align: right;"><span class="price">165 ฿</span></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<!-- End Prodcut Item -->
						</div>
					</div>
				</div>
				<table width="400px">
					<tbody>
						<tr>
							<td width="120px">Order Total</td>
							<td width="150px"></td>
							<td width="150px"></td>
						</tr>
						<tr>
							<td>Subtotal</td>
							<td style="text-align: right; padding-right: 50px;">150.00 ฿</td>
							<td style="text-align: center;"><a href="checkout.php">Back to Detail</a></td>
						</tr>
						<tr>
							<td>Shipping</td>
							<td style="text-align: right; padding-right: 50px;">15.00 ฿</td>
							<td></td>
						</tr>
						<tr>
							<td>Services</td>
							<td style="text-align: right; padding-right: 50px;">0.00 ฿</td>
							<td></td>
						</tr>
						<tr>
							<td style="font-weight: bold;"><h4>Total</h4></td>
							<td style="text-align: right; padding-right: 50px; font-weight: bold;"><h4>165.00 ฿</h4></td>
							<td style="text-align: center;"><a href="review-order.php">Next Step</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div id="co_space">
		</div>
		<!-- Footer Section -->
		<? include("footer.php"); ?>
	</div>
</body>
</html>