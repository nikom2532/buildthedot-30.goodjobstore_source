<!-- Sidebar begins -->
<div id="sidebar">
    <!-- Left nav -->
	<?=$this->load->view('order/left_menu');?>
</div>
<!-- Sidebar ends -->

<!-- Content begins -->    
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('order/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?=site_url('order')?>">Order</a></li>
				<li><a href="<?=site_url('order/create')?>">Add Order</a></li>
				<li><a href="<?=site_url('order/create')?>">Select Customer</a></li>
				<li><a href="<?=site_url('order/create/'.$cus_id)?>"><?=$cus_id?></a></li>
				<li class="current"><a href="<?=site_url('order/create/'.$cus_id.'/check')?>">Order Detail</a></li>
				
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <!-- Main content -->
	<div class="wrapper">
<form id="check_create_order" class="main" action="<?=base_url('order/create_step3_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	<input type="hidden" name="cus_id" value="<?=$cus_id?>">	<!--<<<<<<<<<<<<<<<<<<<<<<<<<< input-->
		<div class="widget">
            <div class="whead"><h6>Order Items</h6><div class="clear"></div></div>
			<div id="dyn" class="hiddenpars">
                <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
					<thead>							
						<tr>
							<th>Code</th>
							<th>Image</th>
							<th>Name</th>
							<th>Property</th>
							<th>Color</th>
							<th>Qty</th>
							<th>Unit Price</th>
							<th>Total Price</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?
							$order_price = 0;
							$order_discount_price = 0;
							$total_price = 0;
							$total_weight = 0;
						?>
						<?php foreach($check as $product_id):?>
							<tr>
								<?php $get_product = get_select_product($product_id);?>
								<td>
									<?=$get_product->product_id?>
									<input type="hidden" name="product_id[]" value="<?=$get_product->product_id?>">	<!--<<<<<<<<<<<<<<<<<<<<<<<<<< input-->
								</td>
								<td align="center">
									<? if (get_primary_img_from_id($get_product->product_id) == ''): ?>
										<img style="height:25; width:25px;" src=""/>
									<? else: ?>
										<img style="height:50; width:50px;" src="<?=base_url()?><?=get_primary_img_from_id($get_product->product_id)?>"/>
									<? endif;?>
								</td>
								<td>
									<?=$get_product->name?>
									<input type="hidden" name="name_<?=$get_product->product_id?>" value="<?=$get_product->name?>">	<!--<<<<<<<<<<<<<<<<<<<<<<<<<< input-->
								</td>
								<td>
									<?=get_property_name($get_product->prop_id)?>
									<input type="hidden" name="prop_id_<?=$get_product->product_id?>" value="<?=$get_product->prop_id?>">	<!--<<<<<<<<<<<<<<<<<<<<<<<<<< input-->
								</td>
								<td>
									<?=get_color_name($get_product->color_id)?>
									<input type="hidden" name="color_id_<?=$get_product->product_id?>" value="<?=$get_product->color_id?>">	<!--<<<<<<<<<<<<<<<<<<<<<<<<<< input-->
								</td>
								<td>
									<?=$$product_id?>
									<input type="hidden" name="qty_<?=$get_product->product_id?>" value="<?=$$product_id?>">	<!--<<<<<<<<<<<<<<<<<<<<<<<<<< input-->
								</td>
								<td>
									<?
										if($get_product->discount_type==1)
										{
											$discount_price = ($get_product->price * $get_product->discount)/100;
											$unit_price = $get_product->price - $discount_price;
										}
										else if($get_product->discount_type==2)
										{
											$discount_price = $get_product->discount;
											$unit_price = $get_product->price - $discount_price;
										}
										else
										{
											$discount_price = 0;
											$unit_price = $get_product->price;
										}
									?>
									<?=$unit_price?>
									<input type="hidden" name="unit_price_<?=$get_product->product_id?>" value="<?=$get_product->price?>">	<!--<<<<<<<<<<<<<<<<<<<<<<<<<< input-->
									<input type="hidden" name="discount_price_<?=$get_product->product_id?>" value="<?=$discount_price?>">	<!--<<<<<<<<<<<<<<<<<<<<<<<<<< input-->
								</td>
								<td>
									<?$order_price += $get_product->price * $$product_id;?>
									<?$order_discount_price += $discount_price * $$product_id;?>
									<?=($unit_price * $$product_id)?>
									<?
										//--- cal total product price ---
										$product_total_price = $unit_price * $$product_id;
										$total_price += $product_total_price;
										//--- cal total weight ---
										$product_total_weight = $get_product->weight * $$product_id;
										$total_weight += $product_total_weight;
									?>
									<input type="hidden" name="total_price_<?=$get_product->product_id?>" value="<?=$product_total_price?>">	<!--<<<<<<<<<<<<<<<<<<<<<<<<<< input-->
									<input type="hidden" name="unit_weight_<?=$get_product->product_id?>" value="<?=$get_product->weight?>">	<!--<<<<<<<<<<<<<<<<<<<<<<<<<< input-->
									<input type="hidden" name="total_weight_<?=$get_product->product_id?>" value="<?=$product_total_weight?>">	<!--<<<<<<<<<<<<<<<<<<<<<<<<<< input-->
								</td>
							</tr>
						<?php endforeach; ?>
							<tr>
								<td colspan='5' rowspan='5'></td>
								<td colspan='2'><b>PRODUCTS TOTAL</b></td>
								<td><?=$total_price?></td>
								<input type="hidden" name="total_price" value="<?=$total_price?>">
							</tr>
							<tr>
								<td colspan='2'><b>COUPON DISCOUNT</b></td>
								<td>
									<?
										$coupon_code = NULL;
										if(!empty($coupon))
										{
											$coupon_code = $coupon->coupon_code;
											if($coupon->discount_type==1)
												$discount_coupon = ($total_price * $coupon->discount_price)/100;
											else if($coupon->discount_type==2)
												$discount_coupon = $coupon->discount_price;
											else
												$discount_coupon = 0;
										}
										else
											$discount_coupon = 0;
									?>
									<?=$discount_coupon?>
								</td>
							</tr>
							<tr>
								<td colspan='2'><b>SERVICE</b></td>
								<td>
									<?
										$service_price = 0;
									?>
									<?=$service_price?>
								</td>
							</tr>
							<tr>
								<td colspan='2'><b>SHIPPING PRICE</b></td>
								<td>
									<?
										$shipping_price = cal_shipping_price($shipping_id, $total_weight);
									?>
									<?=$shipping_price?>
								</td>
							</tr>
							<tr>
								<td colspan='2'><b>FINAL PRICE</b></td>
								<td>
									<?
										$final_price = ($total_price - $discount_coupon) + $service_price + $shipping_price;
									?>
									<?=$final_price?>
								</td>
							</tr>
							<!--#################################################-->
							<!--#################################################-->
							<input type="hidden" name="order_price" value="<?=$order_price?>">
							<input type="hidden" name="order_discount_price" value="<?=$order_discount_price?>">
							<input type="hidden" name="coupon_code" value="<?=$coupon_code?>">
							<input type="hidden" name="discount_coupon" value="<?=$discount_coupon?>">
							<input type="hidden" name="total_price" value="<?=$total_price?>">
							<input type="hidden" name="total_weight" value="<?=$total_weight?>">
							<input type="hidden" name="shipping_id" value="<?=$shipping_id?>">
							<input type="hidden" name="shipping_price" value="<?=$shipping_price?>">
							<input type="hidden" name="final_price" value="<?=$final_price?>">
							<input type="hidden" name="payment_id" value="<?=$payment_id?>">
							<input type="hidden" name="service_price" value="<?=$service_price?>">
							<!--#################################################-->
							<!--#################################################-->
					</tbody>		
				</table>
			</div>
		</div>
		
		<!-- billing&shipping address -->
		<div class="fluid">
            		<div class="widget grid6">
                		<div class="whead">
							<h6>Billing Information</h6>
                   			<div class="clear"></div>
                   		</div>
                		<div class="body">
                			<div class="grid3" style="display:none;"></div>
							<div class="grid3" style="font-weight:bold;">Name:</div>
								<?=$billing['b_firstname']?> &nbsp; <?=$billing['b_lastname']?><br>
							<div class="grid3" style="font-weight:bold;">Address:</div>
								<?=$billing['b_address']?><br>
							<div class="grid3" style="font-weight:bold;">City/Province:</div>
								<?=get_city_name($billing['b_city_id'] , '1')?><br>
							<div class="grid3" style="font-weight:bold;">Postcode:</div>
								<?=$billing['b_postcode']?><br>
							<div class="grid3" style="font-weight:bold;">Country:</div>
								<?=get_country_name($billing['b_country_id'] , '1')?><br>
							<div class="grid3" style="font-weight:bold;">Phone:</div>
								<?=$billing['b_phone']?><br>
							<div class="grid3" style="font-weight:bold;">Payment Method:</div>
								<?=get_payment_name($payment_id)?><br>
							<!--#################################################-->
							<!--#################################################-->
							<input type="hidden" name="b_firstname" value="<?=$billing['b_firstname']?>">
							<input type="hidden" name="b_lastname" value="<?=$billing['b_lastname']?>">
							<input type="hidden" name="b_address" value="<?=$billing['b_address']?>">
							<input type="hidden" name="b_city_id" value="<?=$billing['b_city_id']?>">
							<input type="hidden" name="b_postcode" value="<?=$billing['b_postcode']?>">
							<input type="hidden" name="b_country_id" value="<?=$billing['b_country_id']?>">
							<input type="hidden" name="b_phone" value="<?=$billing['b_phone']?>">
							<!--#################################################-->
							<!--#################################################-->
						</div>
            		</div>
            		<div class="widget grid6">
                		<div class="whead">
							<h6>Shipping Information</h6>
                       		<div class="clear"></div>
                       	</div>
                		<div class="body">
                		    <div class="grid3" style="display:none;"></div>
							<div class="grid3" style="font-weight:bold;">Name:</div>
								<?=$shipping['s_firstname']?> &nbsp; <?=$shipping['s_lastname']?><br>
							<div class="grid3" style="font-weight:bold;">Address:</div>
								<?=$shipping['s_address']?><br>
							<div class="grid3" style="font-weight:bold;">City/Province:</div>
								<?=get_city_name($shipping['s_city_id'] , '1')?><br>
							<div class="grid3" style="font-weight:bold;">Postcode:</div>
								<?=$shipping['s_postcode']?><br>
							<div class="grid3" style="font-weight:bold;">Country:</div>
								<?=get_country_name($shipping['s_country_id'] , '1')?><br>
							<div class="grid3" style="font-weight:bold;">Phone:</div>
								<?=$shipping['s_phone']?><br>
							<div class="grid3" style="font-weight:bold;">Shipping Method:</div>
								<?=get_select_shipping($shipping_id)->name?><br>
							<!--#################################################-->
							<!--#################################################-->
							<input type="hidden" name="s_firstname" value="<?=$shipping['s_firstname']?>">
							<input type="hidden" name="s_lastname" value="<?=$shipping['s_lastname']?>">
							<input type="hidden" name="s_address" value="<?=$shipping['s_address']?>">
							<input type="hidden" name="s_city_id" value="<?=$shipping['s_city_id']?>">
							<input type="hidden" name="s_postcode" value="<?=$shipping['s_postcode']?>">
							<input type="hidden" name="s_country_id" value="<?=$shipping['s_country_id']?>">
							<input type="hidden" name="s_phone" value="<?=$shipping['s_phone']?>">
							<!--#################################################-->
							<!--#################################################-->
						</div>
            		</div>
        		</div>
	<div class="formRow">
		<input type="button" class="buttonS bSea formSubmit" value="BACK" onClick="window.location.href='<?=base_url("order/create")?>'">
		<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("order")?>'">
		<input type="submit" name ="submit" class="buttonS bLightBlue formSubmit" style="margin-right:10px" value="SUBMIT">		
	</div>
</form>
    <!-- Main content ends -->
    
</div>
<!-- Content ends -->