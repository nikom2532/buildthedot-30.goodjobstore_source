	<base href="<?=base_url()?>public/" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/checkout.css">
	<script type='text/javascript' charset='utf-8' src='<?=base_url()?>public/js/jquery.js'></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/apprise-1.5.full.js"></script>
	<link rel="stylesheet" href="<?=base_url()?>public/css/apprise.css" type="text/css" />
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
				<li><img src="images/step_02_active.png" /></li>
				<li><img src="images/step_03_02active.png" /></li>
				<li><img src="images/step_04.png" /></li>
			</ul>
		</div>
<?=form_open('checkout/payment_update')?>
		<div id="payment">
			<div class="left">
				<div id="cart_title">Payment</div>
				<div id="table_payment">
				<table>
					<tbody>
					<?php foreach(get_payments() as $payment): ?>
						<?if($users->Country_ID=='222' OR $payment->id!='2')
						{?>
							<tr>
								<td width="50;" class="tcl">
									<input type="radio" name="payment" <?=($payment->id==$order->payment_id)?'checked=checked':'';?> value="<?=$payment->id?>">
								</td>
								<td>
									<span style="font-weight:bold;"><?=(LANG=='TH')?$payment->name_th:$payment->name_en;?></span> <br/>
									<?=(LANG=='TH')?$payment->description_th:$payment->description_en;?>
								</td>
							</tr>
							<tr>
								<td></td>
								<td><img src="<?=$payment->picture_path?>" /></td>
							</tr>
						<?}?>
					<?php endforeach; ?>
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
													<td>
														<?php
															$where_arr = array(
																'Order_ID'		=>	$order->Order_ID,
																'Product_ID'	=>	$result->order_item_Product_ID
															);
															$order_gift = get_order_gifts($where_arr);
														?>
														<!--
														<input type="checkbox" name="gift_type[<?=$result->order_item_Product_ID?>]" value="<?=$result->gift_box?>" <?=(!empty($order_gift))?'checked=checked':'';?> />
														<?=($result->gift_box==1)?'Gift Box':'Gift Bag';?>
														-->
													</td>
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
						<tr>
							<td height="30px">Subtotal</td>
							<td style="text-align: right; padding-right: 50px;">
								<?
									$exSubtotal = number_format($order->Total_Price, 2);
									if(LANG=='EN')
										echo "US$ ".google_finance_convert("THB", "USD", $exSubtotal);
									else
										echo $exSubtotal." ฿";
								?>
								<!--
								<?
									$exSubtotal = number_format($order->Total_Price, 2);
									$exSubDiscount = number_format($order->Discount_Price, 2);
									if(LANG=='EN')
										echo "US$ ".google_finance_convert("THB", "USD", $exSubtotal)."<font color='red'> -US$ ".google_finance_convert("THB", "USD", $exSubDiscount)."</font>";
									else
										echo $exSubtotal." ฿<font color='red'> -".$exSubDiscount." ฿</font>";
								?>
								-->
							</td>
							<td style="text-align: center;"><a href="<?=site_url('checkout/billing')?>">Back to Detail</a></td>
						</tr>
						<tr>
							<td height="30px">Shipping</td>
							<td style="text-align: right; padding-right: 50px;">
								<?
									//$exShipping = number_format(cal_range_weight($order->How_ID, $order->Total_Weight), 2);
									//$exShipping = number_format($order->shipping_price, 2);

						$FuelSurcharge = 1.21;
						$TotalWeightDimension = 0;
						foreach($order_items as $result):
							$sqlDimension = "SELECT Weight, Group_width, Group_length, Group_height, gift_box FROM product_groups
											JOIN products ON product_groups.Product_Code = products.Product_Code
											WHERE products.Product_ID = '$result->order_item_Product_ID'";
							$queryDimension = $this->db->query($sqlDimension)->result();
							foreach($queryDimension as $valueDimension)
							{
								if($valueDimension->Group_width==NULL OR $valueDimension->Group_width==0 OR $valueDimension->Group_length==NULL OR $valueDimension->Group_length==0 OR $valueDimension->Group_height==NULL OR $valueDimension->Group_height==0 OR $valueDimension->gift_box==0)
									$TotalWeightDimension += $valueDimension->Weight * $result->order_item_Qty;
								else
								{
									$newWeight = ($valueDimension->Group_width * $valueDimension->Group_length * $valueDimension->Group_height * 120 )/ 500000;
									if($valueDimension->Weight < $newWeight)
										$TotalWeightDimension += $newWeight * $result->order_item_Qty;
									else
										$TotalWeightDimension += $valueDimension->Weight * $result->order_item_Qty;
								}
							}
						endforeach;
//if($disQTY >= 3 AND ($order->How_ID==3 OR $order->How_ID==4))
//	$discountShipping = cal_range_weight($order->How_ID, $TotalWeightDimension)*(90/100) * $FuelSurcharge;
//else 
if($order->How_ID==3 OR $order->How_ID==4)
	$discountShipping = cal_range_weight($order->How_ID, $TotalWeightDimension) * $FuelSurcharge;
else
	$discountShipping = cal_range_weight($order->How_ID, $order->Total_Weight);
$exShipping = number_format($discountShipping, 2);
									if(LANG=='EN')
										echo "US$ ".google_finance_convert("THB", "USD", $exShipping);
									else
										echo $exShipping." ฿";
								?>
							</td>
							<td></td>
						</tr>
						<tr>
							<td height="30px">Services</td>
							<td style="text-align: right; padding-right: 50px;">
								<?
									$exService = number_format(cal_price_option($order->Order_ID,$disQTY), 2);
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
									//$exTotal = number_format($order->Total_Price + cal_range_weight($order->How_ID, $order->Total_Weight) + cal_price_option($order->Order_ID), 2);
									//$exTotal = number_format($order->Final_Price, 2);
										$finalPrice = $order->Total_Price + $discountShipping + cal_price_option($order->Order_ID,$disQTY);
										$exTotal = number_format($finalPrice, 2);
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
								<input type="hidden" name="Order_ID" value="<?=$order->Order_ID?>" />
								<input type="submit" value="NEXT" />
							</td>
						</tr>
					</tbody>
				</table>
<?=form_close()?>
			</div>
		</div>
		<div id="co_space">
		</div>
<?php set_final_price($order->Total_Price + $discountShipping + cal_price_option($order->Order_ID,$disQTY), $order->Order_ID, cal_price_option($order->Order_ID,$disQTY), $discountShipping); ?>

	<script>
		if(<?=$checkPayment?>==1)
			apprise('Please select payment method.');
	</script>