	<base href="<?=base_url()?>public/" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/checkout.css">
	<script type="text/javascript" src="<?=base_url()?>public/scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();
			$('#scrollbar2').tinyscrollbar();
		});
	</script>
	<script type="text/javascript">
		function same_data()
		{
			var c1 = $('#c1').attr('checked');
			if(c1 == 'checked')
			{
				var FirstName = $('#FirstName').val();
				var LastName = $('#LastName').val();
				var Address = $('#Address').val();
				var City_ID = $('#City_ID').val();
				var Postal_Code = $('#Postal_Code').val();
				var Phone_Number = $('#Phone_Number').val();

				$('#s_FirstName').val(FirstName);
				$('#s_LastName').val(LastName);
				$('#s_Address').val(Address);
				$('#s_City_ID').val(City_ID);
				$('#s_Postal_Code').val(Postal_Code);
				$('#s_Phone_Number').val(Phone_Number);
			}
			else
			{
				$('#s_FirstName').val('');
				$('#s_LastName').val('');
				$('#s_Address').val('');
				$('#s_City_ID').val('');
				$('#s_Postal_Code').val('');
				$('#s_Phone_Number').val('');
			}
		}
	</script>

		<!-- Body Section -->
		<div id="title_head">
			Checkout
		</div>
		<div id="process">
			<ul>
				<li><img src="../../public/images/step_01_active.png" /></li>
				<li><img src="../../public/images/step_02_01active.png" /></li>
				<li><img src="../../public/images/step_03.png" /></li>
				<li><img src="../../public/images/step_04.png" /></li>
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
<?=form_open('checkout/update')?>
				<h4><?=(LANG=='TH')?'ที่อยู่ในการออกใบเสร็จ':"Billing Address";?></h4>
					<table id="address">
						<tbody>
							<tr>
								<td width="100px" style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'อีเมลล์':"E-mail";?></td>
								<td width="30px"><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td><input type="text" name="Email" id="Email" value="<?=set_value('Email', '')?>"/></td>
							</tr>
							<tr>
								<td style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'ชื่อ':"First name";?></td>
								<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td><input type="text" name="FirstName" id="FirstName" value="<?=set_value('FirstName', '')?>"/></td>
							</tr>
							<tr>
								<td style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'นามสกุล':"Last name";?></td>
								<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td><input type="text" name="LastName" id="LastName" value="<?=set_value('LastName', '')?>"/></td>
							</tr>
							<tr>
								<td style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'เบอร์โทรศัพท์':"Phone number";?></td>
								<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td><input type="text" name="Phone_Number" id="Phone_Number" value="<?=set_value('Phone_Number', '')?>"/></td>
							</tr>
							<tr>
								<td style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'ที่อยู่':"Address";?></td>
								<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td><input type="text" name="Address" id="Address" value="<?=set_value('Address', '')?>"/></td>
							</tr>
							<tr>
								<td style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'จังหวัด':"Province";?></td>
								<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td>
									<div class="styled-select">
										<select name="City_ID" id="City_ID">
						                    <option value=" ">------ Select Province -----</option>
						                   	<?php foreach(get_select_city() as $value): ?>
												<option value="<?=$value->City_ID?>" <?=set_select('City_ID',$value->City_ID)?>><?=(LANG=='TH')?"{$value->Name_Th}":"{$value->Name_En}";?></option>
											<?php endforeach; ?>
					                    </select>
					                </div>
								</td>
							</tr>
							<tr>
									<td style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'รหัสไปรษณีย์':"Postal code";?></td>
									<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
									<td>
										<input type="text" name="Postal_Code" id="Postal_Code" value="<?=set_value('Postal_Code', '')?>"/
									</td>

							</tr>
						</tbody>
					</table>
				<div id="lineCheckout"></div>
				<div id="same_address">
					<input type="checkbox" name="c1" id="c1" onclick="javascript:same_data()" value="1" >&nbsp;<?=(LANG=='TH')?'ใช้ที่อยู่เดียวกับการออกใบเสร็จ':"Same as Billing Address";?></div>
				<!-- Shipping Address -->
				<div id="div1">
				<div id="shipping_address">
				<h4><?=(LANG=='TH')?'ที่อยู่ในการจัดส่งสินค้า':"Shipping Address";?></h4>
					<table id="address">
						<tbody>
							<tr>
								<td width="100px" style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'ชื่อ':"First name";?></td>
								<td width="30px"><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td><input type="text" name="s_FirstName" id="s_FirstName" value="<?=set_value('s_FirstName', '')?>" /></td>
							</tr>
							<tr>
								<td style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'นามสกุล':"Last name";?></td>
								<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td><input type="text" name="s_LastName" id="s_LastName" value="<?=set_value('s_LastName', '')?>" /></td>
							</tr>
							<tr>
								<td style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'เบอร์โทรศัพท์':"Phone number";?></td>
								<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td><input type="text" name="s_Phone_Number" id="s_Phone_Number" value="<?=set_value('s_Phone_Number', '')?>"/></td>
							</tr>
							<tr>
								<td style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'ที่อยู่':"Address";?></td>
								<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td><input type="text" name="s_Address" id="s_Address" value="<?=set_value('s_Address', '')?>" /></td>
							</tr>

							<tr>
								<td style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'จังหวัด':"Province";?></td>
								<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td>
									<div class="styled-select">
										<select name="s_City_ID" id="s_City_ID">
						                    <option value=" ">------ Select Province -----</option>
						                    <?php foreach(get_select_city() as $value): ?>
												<option value="<?=$value->City_ID?>" <?=set_select('s_City_ID',$value->City_ID)?>><?=(LANG=='TH')?"{$value->Name_Th}":"{$value->Name_En}";?></option>
											<?php endforeach; ?>
					                    </select>
					                </div>
								</td>
							</tr>
							<tr>
									<td style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'รหัสไปรษณีย์':"Postal code";?></td>
									<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
									<td><input type="text" name="s_Postal_Code" id="s_Postal_Code" value="<?=set_value('s_Postal_Code', '')?>" /></td>
							</tr>
						</tbody>

					</table>
				</div>
				</div>
			</div>
			</div>
			</div>
				<div id="shipping">
					<table>
						<tbody>
							<?php foreach(get_shipping_option() as $value): ?>
							<tr>
								<td width="50px">
									<input type="checkbox" name="shipping_option[]" <?=(check_have_option($value->Option_ID, $order->Order_ID)==TRUE)?'checked=checked':''?> value="<?=$value->Option_ID?>">
								</td>
								<td width="320px"><?=(LANG=='TH')?$value->Name_Th:$value->Name_En;?></td>
								<td width="80px"><?=($value->Price!=0)?"{$value->Price} ฿":'FREE';?></td>
							</tr>
							<?php endforeach; ?>
							<tr>
								<td colspan="3" width="100%"><hr/></td>
							</tr>
							<?php foreach(get_how_delivery() as $value): ?>
							<tr class="tcl">
								<td><input type="radio" name="how_delivery" <?=($value->How_ID==$order->How_ID)?'checked=checked':''?> value="<?=$value->How_ID?>" ></td>
								<td><?=(LANG=='TH')?$value->Name_Th:$value->Name_En;?><br /><?=(LANG=='TH')?$value->Description_Th:$value->Description_En;?></td>
								<td><?=(number_format(cal_range_weight($value->How_ID, $order->Total_Weight))==0)?'FREE':number_format(cal_range_weight($value->How_ID, $order->Total_Weight)).' ฿';?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<input type="hidden" name="Order_ID" value="<?=$order->Order_ID?>" />
					<input id="update" type="submit" name="updateTotal" value="Update Total">
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
				<table width="400px" id="price_total">
					<tbody>
						<tr>
							<td width="120px" height="20px">Order Total</td>
							<td width="150px"></td>
							<td width="150px"></td>
						</tr>
						<tr>
							<td>Subtotal</td>
							<td style="text-align: right; padding-right: 50px;"><?=number_format($order->Total_Price)?> ฿</td>
							<td style="text-align: center;"><a href="<?=$this->session->userdata('prev_url')?>">Back to Shopping</a></td>
						</tr>
						<tr>
							<td>Shipping</td>
							<td style="text-align: right; padding-right: 50px;"><?=number_format(cal_range_weight($order->How_ID, $order->Total_Weight))?> ฿</td>
							<td></td>
						</tr>
						<tr>
							<td>Services</td>
							<td style="text-align: right; padding-right: 50px;"><?=number_format(cal_price_option($order->Order_ID))?> ฿</td>
							<td></td>
						</tr>
						<tr>
							<td style="font-weight: bold;"><h4>Total</h4></td>
							<td style="text-align: right; padding-right: 50px; font-weight: bold;"><h4><?=number_format($order->Total_Price + cal_range_weight($order->How_ID, $order->Total_Weight) + cal_price_option($order->Order_ID))?> ฿</h4></td>
							<td style="text-align: center;">
								<!--<a href="<?=site_url('checkout/payment')?>">NEXT</a>-->
								<input id="update" type="submit" name="update_value" value="NEXT">
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
<?=form_close()?>
<?php set_final_price($order->Total_Price + cal_range_weight($order->How_ID, $order->Total_Weight) + cal_price_option($order->Order_ID), $order->Order_ID, cal_price_option($order->Order_ID), cal_range_weight($order->How_ID, $order->Total_Weight)); ?>
<script>
function showMe (it, box) {
  var vis = (box.checked) ? "hidden" : "visible";
  document.getElementById(it).style.visibility = vis;
}
</script>