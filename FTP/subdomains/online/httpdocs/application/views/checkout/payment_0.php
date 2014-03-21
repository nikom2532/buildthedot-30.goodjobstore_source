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
												</tr>
												<tr>
													<td style="	text-align: right;"><span class="price"><?=number_format($result->order_item_Total_Price)?> ฿</span></td>
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
				<table width="400px" id="payment_order_total">
					<tbody>
						<tr>
							<td width="120px">Order Total</td>
							<td width="150px"></td>
							<td width="150px"></td>
						</tr>
						<tr>
							<td height="30px">Subtotal</td>
							<td style="text-align: right; padding-right: 50px;"><?=number_format($order->Total_Price)?> ฿</td>
							<td style="text-align: center;"><a href="<?=site_url('checkout/billing')?>">Back to Detail</a></td>
						</tr>
						<tr>
							<td height="30px">Shipping</td>
							<td style="text-align: right; padding-right: 50px;"><?=number_format(cal_range_weight($order->How_ID, $order->Total_Weight))?> ฿</td>
							<td></td>
						</tr>
						<tr>
							<td height="30px">Services</td>
							<td style="text-align: right; padding-right: 50px;"><?=number_format(cal_price_option($order->Order_ID))?> ฿</td>
							<td></td>
						</tr>
						<tr>
							<td style="font-weight: bold;"><h4>Total</h4></td>
							<td style="text-align: right; padding-right: 50px; font-weight: bold;"><h4><?=number_format($order->Total_Price + cal_range_weight($order->How_ID, $order->Total_Weight) + cal_price_option($order->Order_ID))?> ฿</h4></td>
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
<?php set_final_price($order->Total_Price + cal_range_weight($order->How_ID, $order->Total_Weight) + cal_price_option($order->Order_ID), $order->Order_ID, cal_price_option($order->Order_ID), cal_range_weight($order->How_ID, $order->Total_Weight)); ?>