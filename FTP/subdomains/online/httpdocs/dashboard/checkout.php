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
	<script type="text/javascript" src="../scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();
			$('#scrollbar2').tinyscrollbar();	
		});
	</script>
</head>
<body>
	<div id="checkout">
		<!-- Header Section -->
		<? include("header.php"); ?>

		<!-- Body Section -->
		<div id="title_head">
			Checkout 
		</div>
		<div id="process">
			<ul>
				<li><img src="images/step_01_active.png" /></li>
				<li><img src="images/step_02_01active.png" /></li>
				<li><img src="images/step_03.png" /></li>
				<li><img src="images/step_04.png" /></li>
			</ul>
		</div>
		<div id="billing">
			<div class="left">
			<div id="scrollbar2">
					<div class="scrollbar">
						<div class="track">
							<div class="thumb">
								<div class="end"></div>
							</div>
						</div>
					</div>
					<div class="viewport">
						<div class="overview">
			<form action="" method="" name="">
				<h4>Billing Address</h4>
					<table>
						<tbody>
							<tr>
								<td width="130px"><span class="star">*</span> E-mail</td>
								<td width="30px"><img src="images/dot.gif" /></td>
								<td><input type="text" name="email" /></td>
							</tr>
							<tr>
								<td><span class="star">*</span> First name</td>
								<td><img src="images/dot.gif" /></td>
								<td><input type="text" name="fistName" /></td>
							</tr>
							<tr>
								<td><span class="star">*</span> Last name</td>
								<td><img src="images/dot.gif" /></td>
								<td><input type="text" name="lastName" /></td>
							</tr>
							<tr>
								<td><span class="star">*</span> Phone number</td>
								<td><img src="images/dot.gif" /></td>
								<td><input type="text" name="phonNumber" /></td>
							</tr>
							<tr>
								<td><span class="star">*</span> Address</td>
								<td><img src="images/dot.gif" /></td>
								<td><input type="text" name="address" /></td>
							</tr>
							<tr>
								<td><span class="star">*</span> Province</td>
								<td><img src="images/dot.gif" /></td>
								<td>
									<div class="styled-select">
										<select name="province">
						                    <option value=" ">------ Select Province -----</option>
						                   	<option value="กระบี่">กระบี่ </option>
						                   	<option value="กำแพงเพชร">กำแพงเพชร </option>
						                    <option value="กรุงเทพมหานคร">กรุงเทพมหานคร </option>
					                    </select>
					                </div>
								</td>
							</tr>
							<tr>
									<td><span class="star">*</span> Postal code</td>
									<td><img src="images/dot.gif" /></td>
									<td><input type="text" name="postCode" /></td>
							</tr>
						</tbody>
					</table>
				<div id="lineCheckout"></div>
				<div id="same_address">
					<input type="checkbox" name="c1" onclick="showMe('div1', this)" > &nbsp;Same as Billing Address
				</div>
				<!-- Shipping Address -->
				<div id="div1">
				<div id="shipping_address">
				<h4>Shipping Address</h4>
					<table>
						<tbody>
							<tr>
								<td width="130px"><span class="star">*</span> First name</td>
								<td width="30px"><img src="../images/dot.gif" /></td>
								<td><input type="text" name="fistName" /></td>
							</tr>
							<tr>
								<td><span class="star">*</span> Last name</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="lastName" /></td>
							</tr>
							<tr>
								<td><span class="star">*</span> Address</td>
								<td><img src="../images/dot.gif" /></td>
								<td><input type="text" name="address" /></td>
							</tr>
							<tr>
								<td><span class="star">*</span> Province</td>
								<td><img src="../images/dot.gif" /></td>
								<td>
									<div class="styled-select">
										<select name="province">
						                    <option value=" ">------ Select Province -----</option>
						                   	<option value="กระบี่">กระบี่ </option>
						                   	<option value="กำแพงเพชร">กำแพงเพชร </option>
						                    <option value="กรุงเทพมหานคร">กรุงเทพมหานคร </option>
						                    <option value="กาญจนบุรี">กาญจนบุรี </option>
						                    <option value="กาฬสินธุ์">กาฬสินธุ์ </option>
						                    <option value="ขอนแก่น">ขอนแก่น </option>
						                    <option value="จันทบุรี">จันทบุรี </option>
						                    <option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>
						                    <option value="เชียงใหม่">เชียงใหม่ </option>
						                    <option value="เชียงราย">เชียงราย </option>
					                    </select>
					                </div>
								</td>
							</tr>
							<tr>
									<td><span class="star">*</span> Postal code</td>
									<td><img src="../images/dot.gif" /></td>
									<td><input type="text" name="postCode" /></td>
							</tr>
						</tbody>
					</table>
				</div>
				</div>
			</form>
			</div>
			</div>
			</div>
				<div id="shipping">
					<table>
						<tbody>
							<tr>
								<td width="50px">
									<input type="checkbox" name="">
								</td>
								<td width="320px">Gift Wrap (HOW?)</td>
								<td width="80px">30 ฿</td>
							</tr>
							<tr class="tr_line">
								<td><input type="checkbox" name=""></td>
								<td>Put Print - out invoice in package</td>
								<td>FREE</td>
							</tr>
							<tr class="tcl">
								<td><input type="checkbox" name=""></td>
								<td>Standard Dilivery<br />Aussie Post delivery with 3-7 business days</td>
								<td>50 ฿</td>
							</tr>
							<tr class="tcl">
								<td><input type="checkbox" name=""></td>
								<td>Express Post <br />Aussie Post delivery with in 1-2 business days</td>
								<td>150 ฿</td>
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
									<table width="180px">
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
							<td style="text-align: center;"><a href="#">Back to Shipping</a></td>
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
							<td style="text-align: center;"><a href="payment.php">Next Step</a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<!-- Footer Section -->
		<? include("footer.php"); ?>
	</div>
<script>
function showMe (it, box) {
  var vis = (box.checked) ? "hidden" : "visible";
  document.getElementById(it).style.visibility = vis;
}
</script>
</body>
</html>