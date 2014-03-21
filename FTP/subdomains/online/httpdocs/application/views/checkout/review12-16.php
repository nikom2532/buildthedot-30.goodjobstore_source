	<base href="<?=base_url()?>public/" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/checkout.css">

	<script type="text/javascript" src="<?=base_url()?>public/scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();
		});
	</script>
		<!-- Body Section -->
		<div id="title_head">
			Checkout
		</div>
		<div id="process">
			<ul>
				<li><img src="images/step_01.png" /></li>
				<li><img src="images/step_02.png" /></li>
				<li><img src="images/step_03_active.png" /></li>
				<li><img src="images/step_04_03active.png" /></li>
			</ul>
		</div>
		<div id="review_order">
			<div class="left">
				<div id="review_order_title">Order Details</div>
				<div id="order_detail">
					<div class="detail_left">
						<div class="title">
						<h3>Shipping Address</h3>
						<span id="changeBt"><a href="<?=site_url('checkout/billing')?>">Change</a></span>
						</div>
						<table width="270px">
							<tbody>
								<tr>
									<td width="90px">Name</td>
									<td width="20px"><img src="images/dot.gif" /></td>
									<td width="130px"><?=$shipping->s_FirstName?></td>
								</tr>
								<tr>
									<td>Last Name</td>
									<td width="5"><img src="images/dot.gif" /></td>
									<td><?=$shipping->s_LastName?></td>
								</tr>
								<tr>
									<td>Address</td>
									<td width="5"><img src="images/dot.gif" /></td>
									<td><?=$shipping->s_Address?></td>
								</tr>
								<?if($shipping->s_Country_ID==222)
								{?>
									<tr>
										<td>Province</td>
										<td width="5"><img src="images/dot.gif" /></td>
										<td><?=show_city_from_id($shipping->s_City_ID)?></td>
									</tr>
								<?}
								else
								{?>
									<tr>
										<td>City</td>
										<td width="5"><img src="images/dot.gif" /></td>
										<td><?=$shipping->s_City_Name?></td>
									</tr>
								<?}?>
								<tr>
									<td>Country</td>
									<td width="5"><img src="images/dot.gif" /></td>
									<td><?=show_country_from_id($shipping->s_Country_ID)?></td>
								</tr>
								<tr>
									<td>Post Code</td>
									<td width="5"><img src="images/dot.gif" /></td>
									<td><?=$shipping->s_Postal_Code?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="detail_right">
						<div class="title">
						<h3>Email Address</h3>
						<span id="changeBt"><a href="<?=site_url('checkout/billing')?>">Change</a></span>
						</div>
						Email <img style="margin-left:10px; margin-right:10px;" src="images/dot.gif" /> <?=$customer->Email?>
						<div class="email">
							Order confirmation will to be send registered e-mail.
						</div>
						<!--<div class="title">
						<h3>Email Address</h3>
						<span id="changeBt"><a href="#">Change</a></span>
						</div>
						Direct Deposit<br />
						Direct deposit detail will be emailed to you.-->
					</div>
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
							<?php $order_item_total_price = 0; ?>
							<?php $disQTY = 0; ?>
							<?php $count_item = count($order_items) ?>
							<?php foreach($order_items as $result): ?>
							<?php
							if($count_item  == 1)
							{
								echo '<div id="item">';
							}
							else
							{
								echo '<div id="item" style="border-bottom: 1px solid #ddd">';
								$count_item--;
							}
							?>
									<div id="char_left">
										<img src="<?=$result->images_Thumbnail_path?>" />
									</div>
									<div id="char_right">
										<table width="200px">
											<tbody>
												<tr>
													<td>
														<?=(LANG=='TH')?$result->products_Pro_Name_Th:$result->products_Pro_Name_En?><br>
														COLOR <?=(LANG=='TH')?$result->color_Name_TH:$result->color_Name_EN?><br>
														<?=($result->products_Size)?"Size {$result->products_Size}":'';?>
													</td>
												</tr>
												<tr>
													<td>Qty <?=$result->order_item_Qty?></td>
													<? $disQTY += $result->order_item_Qty; ?>
												</tr>
												<tr>
													<td style="	text-align: right;">
														<span class="price">
															<?
																$exPrice = number_format($result->order_item_Total_Price);
																if(LANG=='EN')
																	echo "US$ ".google_finance_convert("THB", "USD", $exPrice);
																else
																	echo $exPrice." ฿";
															?>
														</span>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<?php $order_item_total_price = $order_item_total_price + $result->order_item_Total_Price ?>
							<?php endforeach; ?>
							<!-- End Prodcut Item -->

						</div>
					</div>
				</div>
				<table width="400px" id="price_total">
					<tbody>
						<tr>
							<td>&nbsp</td>
						</tr>
						<tr>
							<td width="110px">Order Total</td>
							<td width="140px"></td>
							<td></td>
						</tr>
						<tr>
							<td>&nbsp</td>
						</tr>
						<tr height="30px">
							<td>Subtotal</td>
							<td style="text-align: right; padding-right: 50px;">
								<?
									$exSubtotal = number_format($order->Total_Price, 2);
									if(LANG=='EN')
										echo "US$ ".google_finance_convert("THB", "USD", $exSubtotal);
									else
										echo $exSubtotal." ฿";
									
								?>
							</td>
							<td style="text-align: center;"><a href="<?=site_url('checkout/payment')?>">Back to Detail</a></td>
						</tr>
						<tr height="30px">
							<td>Shipping</td>
							<td style="text-align: right; padding-right: 50px;">
								<?
									//$exShipping = number_format(cal_range_weight($order->How_ID, $order->Total_Weight), 2);
									$exShipping = number_format($order->shipping_price, 2);
									if(LANG=='EN')
										echo "US$ ".google_finance_convert("THB", "USD", $exShipping);
									else
										echo $exShipping." ฿";
								?>
							</td>
							<td></td>
						</tr>
						<tr height="30px">
							<td>Services</td>
							<td style="text-align: right; padding-right: 50px;">
								<?
									$exService = number_format(cal_price_option($order->Order_ID), 2);
									if(LANG=='EN')
										echo "US$ ".google_finance_convert("THB", "USD", $exService);
									else
										echo $exService." ฿";
								?>
							</td>
							<td></td>
						</tr>
						<tr>
							<td style="font-weight: bold;"><h4>Total</h4></td>
							<td style="text-align: right; padding-right: 50px; font-weight: bold;">
								<h4>
									<?
									$exTotal = number_format($order->Total_Price + cal_range_weight($order->How_ID, $order->Total_Weight) + cal_price_option($order->Order_ID), 2);
/*
										$exTotal = $order->Total_Price + cal_range_weight($order->How_ID, $order->Total_Weight) + cal_price_option($order->Order_ID);
										if($disQTY>=3)
											$exTotal = number_format($exTotal*(90/100), 2);
*/
										if(LANG=='EN')
											echo "US$ ".google_finance_convert("THB", "USD", $exTotal);
										else
											echo $exTotal." ฿";
									?>
								</h4>
							</td>
							<td style="text-align: center;">
							<?php if($order->payment_id == 1): ?>
								<?=$this->load->view('checkout/payment_1')?>
							<?php elseif($order->payment_id == 2): ?>
								<?=$this->load->view('checkout/payment_2')?>
							<?php elseif($order->payment_id == 3): ?>
								<?=$this->load->view('checkout/payment_3')?>
							<?php endif; ?>
								<!--<a href="<?=site_url("checkout/redirect_payment/{$order->Order_ID}")?>">DONE</a>-->
							</td>
						</tr>

					</tbody>
				</table>
				<?php set_final_price($order->Total_Price + cal_range_weight($order->How_ID, $order->Total_Weight) + cal_price_option($order->Order_ID), $order->Order_ID, cal_price_option($order->Order_ID), $order->shipping_price); ?>
			</div>
		</div>
		<div id="co_space">
		</div>