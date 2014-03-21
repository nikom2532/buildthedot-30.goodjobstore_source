	<base href="<?=base_url()?>public/" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/checkout.css">

	<!------------------------------------->
	<!-------- alert not shipping --------->
	<!------------------------------------->
	<!--	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
		<script src="/resources/demos/external/jquery.bgiframe-2.1.2.js"></script>
		<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
		<link rel="stylesheet" href="/resources/demos/style.css" />
		<script>
		$(function() {
			$( "#dialog" ).dialog();
		});
		</script>-->
	<!------------------------------------->
	<!---------- end not shipping --------->
	<!------------------------------------->

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
				var Country_ID = $('#Country_ID').val();
				var City_ID = $('#City_ID').val();
				var City_Name = $('#City_Name').val();
				var Postal_Code = $('#Postal_Code').val();
				var Phone_Number = $('#Phone_Number').val();

				$('#s_FirstName').val(FirstName);
				$('#s_LastName').val(LastName);
				$('#s_Address').val(Address);
				$('#s_Country_ID').val(Country_ID);
				if(Country_ID==222) 
				{
					document.getElementById('s_City_ID_cb').style.display = "block";
					document.getElementById('s_City_Name_txt').style.display = "none";
					$('#s_City_ID').val(City_ID);
					document.getElementById('thai_delivery').style.display = "block";
					document.getElementById('ups_delivery').style.display = "none";
				}
				else
				{
					document.getElementById('s_City_ID_cb').style.display = "none";
					document.getElementById('s_City_Name_txt').style.display = "block";
					$('#s_City_ID').val('88');
					document.getElementById('thai_delivery').style.display = "none";
					document.getElementById('ups_delivery').style.display = "block";
				}
				$('#s_City_Name').val(City_Name);
				$('#s_Postal_Code').val(Postal_Code);
				$('#s_Phone_Number').val(Phone_Number);
			}
			else
			{
				document.getElementById('s_City_ID_cb').style.display = "block";
				document.getElementById('s_City_Name_txt').style.display = "none";
				$('#s_FirstName').val('');
				$('#s_LastName').val('');
				$('#s_Address').val('');
				$('#s_Country_ID').val('');
				$('#s_City_ID').val('');
				$('#s_City_Name').val('');
				$('#s_Postal_Code').val('');
				$('#s_Phone_Number').val('');
			}
		}

		function change_country(cbCountry, cbCity, txtCity, cbProvTH, cbProvEN)
		{
			var sel_country = $('#'+cbCountry).val();
			if(sel_country==222)
			{
				document.getElementById(cbCity).style.display = "block";
				document.getElementById(cbProvTH).style.display = "block";
				document.getElementById(txtCity).style.display = "none";
				document.getElementById(cbProvEN).style.display = "none";
			}
			else
			{
				document.getElementById(cbCity).style.display = "none";
				document.getElementById(cbProvTH).style.display = "none";
				document.getElementById(txtCity).style.display = "block";
				document.getElementById(cbProvEN).style.display = "block";
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
								<td style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'ประเทศ':"Country";?></td>
								<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td>
									<div class="styled-select">
										<select name="Country_ID" id="Country_ID" onchange="change_country('Country_ID', 'City_ID_cb', 'City_Name_txt', 'city_prov_th', 'city_prov_en');">
						                    <option value=" ">------ Select Country -----</option>
						                   	<? 
											$sqlCountry = "SELECT country.Country_ID, country.country_name, country.country_name_th 
															FROM country JOIN ups_service ON country.Country_ID = ups_service.Country_ID
															GROUP BY country.Country_ID
															ORDER BY country.country_name";
											$queryCountry = $this->db->query($sqlCountry)->result();
											foreach($queryCountry as $valueCountry)
											{?>
												<option value="<?=$valueCountry->Country_ID?>" <?=set_select('Country_ID',$valueCountry->Country_ID)?>>
													<?=(LANG=='TH')?"{$valueCountry->country_name_th}":"{$valueCountry->country_name}";?>
												</option>
											<?}?>
					                    </select>
					                </div>
								</td>
							</tr>
							<tr>
								<td style="text-align: right; padding-right: 20px;">
									<div id="city_prov_th" style="display:<?=(set_value('Country_ID', '')=='222')?'block':'none';?>;">
										<?=(LANG=='TH')?'จังหวัด':"Province";?>
									</div>
									<div id="city_prov_en" style="display:<?=(set_value('Country_ID', '')=='222')?'none':'block';?>;">
										<?=(LANG=='TH')?'เมือง':"City";?>
									</div>
								</td>
								<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td>
									<div class="styled-select" id="City_ID_cb" style="display:<?=(set_value('Country_ID', '')=='222')?'block':'none';?>;">
										<select name="City_ID" id="City_ID">
						                    <option value=" ">------ Select Province -----</option>
						                   	<?php foreach(get_select_city() as $value): ?>
												<option value="<?=$value->City_ID?>" <?=set_select('City_ID',$value->City_ID)?>><?=(LANG=='TH')?"{$value->Name_Th}":"{$value->Name_En}";?></option>
											<?php endforeach; ?>
					                    </select>
					                </div>
									<div id="City_Name_txt" style="display:<?=(set_value('Country_ID', '')=='222')?'none':'block';?>;">
										<input type="text" name="City_Name" id="City_Name" value="<?=set_value('City_Name', '')?>" />
									</div>
								</td>
							</tr>
							<tr>
									<td style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'รหัสไปรษณีย์':"Postal code";?></td>
									<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
									<td>
										<input type="text" name="Postal_Code" id="Postal_Code" value="<?=set_value('Postal_Code', '')?>"/>
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
								<td style="text-align: right; padding-right: 20px;"><?=(LANG=='TH')?'ประเทศ':"Country";?></td>
								<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td>
									<div class="styled-select">
										<select name="s_Country_ID" id="s_Country_ID" onchange="change_country('s_Country_ID', 's_City_ID_cb', 's_City_Name_txt', 's_city_prov_th', 's_city_prov_en'); this.form.submit();">
						                    <option value=" ">------ Select Country -----</option>
						                   	<? 
											$sqlCountry = "SELECT country.Country_ID, country.country_name, country.country_name_th 
															FROM country JOIN ups_service ON country.Country_ID = ups_service.Country_ID
															GROUP BY country.Country_ID
															ORDER BY country.country_name";
											$queryCountry = $this->db->query($sqlCountry)->result();
											foreach($queryCountry as $valueCountry)
											{?>
												<option value="<?=$valueCountry->Country_ID?>" 
													<?=($has_ship==1)?set_select('s_Country_ID',$valueCountry->Country_ID):'';?>
												>
													<?=(LANG=='TH')?"{$valueCountry->country_name_th}":"{$valueCountry->country_name}";?>
												</option>
											<?}?>
					                    </select>
					                </div>
								</td>
							</tr>
							<tr>
								<td style="text-align: right; padding-right: 20px;">
									<div id="s_city_prov_th" style="display:<?=(set_value('Country_ID', '')=='222')?'block':'none';?>;">
										<?=(LANG=='TH')?'จังหวัด':"Province";?>
									</div>
									<div id="s_city_prov_en" style="display:<?=(set_value('Country_ID', '')=='222')?'none':'block';?>;">
										<?=(LANG=='TH')?'เมือง':"City";?>
									</div>
								</td>
								<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
								<td>
									<div class="styled-select" id="s_City_ID_cb" style="display:<?=(set_value('s_Country_ID', '')=='222' OR $has_ship==0)?'block':'none';?>;">
										<select name="s_City_ID" id="s_City_ID">
						                    <option value=" ">------ Select Province -----</option>
						                    <?php foreach(get_select_city() as $value): ?>
												<option value="<?=$value->City_ID?>" <?=set_select('s_City_ID',$value->City_ID)?>><?=(LANG=='TH')?"{$value->Name_Th}":"{$value->Name_En}";?></option>
											<?php endforeach; ?>
						                 </select>
									</div>
									<div id="s_City_Name_txt" style="display:<?=(set_value('s_Country_ID', '')=='222' OR $has_ship==0)?'none':'block';?>;">
										<input type="text" name="s_City_Name" id="s_City_Name" value="<?=set_value('s_City_Name', '')?>" />
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
				<?if(set_value('s_Country_ID', '') == '62' or set_value('s_Country_ID', '') == '106' or set_value('s_Country_ID', '') == '114' or set_value('s_Country_ID', '') == '121' or set_value('s_Country_ID', '') == '144' or set_value('s_Country_ID', '') == '186' or set_value('s_Country_ID', '') == '201' or set_value('s_Country_ID', '') == '218')
				{?>
				<div style="color:red; margin-left:150px; font-size:13px;">
					Shipping is not available in this territory.<br>
					Please contact our 
					<a style="color:blue; background-color:white; padding:0; font-size=100%; display:inline; width:100%; margin:0;" href="http://online.goodjobstore.com/shops/locator"><u>local distributors</u></a> in your country.
				</div>
				<?}?>
				<div id="shipping">
					<table>
						<tbody>
							<?php foreach(get_shipping_option() as $value): ?>
							<tr>
								<td width="50px">
									<input type="checkbox" name="shipping_option[]" <?=(check_have_option($value->Option_ID, $order->Order_ID)==TRUE)?'checked=checked':''?> value="<?=$value->Option_ID?>">
								</td>
								<td width="320px"><?=(LANG=='TH')?$value->Name_Th:$value->Name_En;?></td>
								<td width="80px">
									<?
										$giftPrice = number_format($value->Price, 2);
										if($giftPrice==0)
											echo "FREE";
										else
										{
											if(LANG=='EN')
												echo "US$ ".google_finance_convert("THB", "USD", $giftPrice);
											else
												echo $giftPrice." ฿";
										}
									?>
								</td>
							</tr>
							<?php endforeach; ?>
							<tr>
								<td colspan="3" width="100%"><hr/></td>
							</tr>
						</tbody>
					</table>
				
				<!------------------------------------->
				<!-------- alert not shipping --------->
				<!------------------------------------->
				<!--
					<?if(set_value('s_Country_ID', '') == '62')
					{?>
						<div id="dialog" title="Basic dialog">
							<p>Shipping is not avaiable in your Country.<br>
							   <a href="http://online.goodjobstore.com/shops/locator">Plese see our distibutor in your country.</a>
							   </p>
						</div>
					<?}?>
				-->
				<!------------------------------------->
				<!---------- end not shipping --------->
				<!------------------------------------->

					<div id="thai_delivery" style="display:<?=(set_value('s_Country_ID', '')=='222' OR $has_ship==0 OR ($has_ship==1 AND set_value('s_Country_ID','')=='0'))?'block':'none';?>;">
						<table>
							<tbody>
								<?php foreach(get_how_delivery() as $value): ?>
								<tr class="tcl">
									<?if(set_value('s_Country_ID', '')=='222' OR $has_ship==0 OR ($has_ship==1 AND set_value('s_Country_ID','')=='0'))
									{
										if($order->How_ID==1 OR $order->How_ID==2)
										{?>
											<td width="50px"><input type="radio" name="how_delivery" <?=($value->How_ID==$order->How_ID)?'checked=checked':''?> value="<?=$value->How_ID?>" ></td>
										<?}
										else
										{?>
											<td width="50px"><input type="radio" name="how_delivery" <?=($value->How_ID==1)?'checked=checked':''?> value="<?=$value->How_ID?>" ></td>
										<?}
									}?>
									<td width="320px"><?=(LANG=='TH')?$value->Name_Th:$value->Name_En;?><br /><?=(LANG=='TH')?$value->Description_Th:$value->Description_En;?></td>
									<td width="80px"><?=(number_format(cal_range_weight($value->How_ID, $order->Total_Weight))==0)?'FREE':number_format(cal_range_weight($value->How_ID, $order->Total_Weight)).' ฿';?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
					<div id="ups_delivery" style="display:<?=(set_value('s_Country_ID', '')=='222' OR $has_ship==0 OR ($has_ship==1 AND set_value('s_Country_ID','')=='0'))?'none':'block';?>;">
						<table>
							<tbody>

								<?
									$FuelSurcharge = 1.21;
									$TotalWeightDimension = 0;
								?>
								<?php foreach($order_items as $result): ?>
									<?
										$sqlDimension = "SELECT Weight, Group_width, Group_length, Group_height FROM product_groups 
														JOIN products ON product_groups.Product_Code = products.Product_Code
														WHERE products.Product_ID = '$result->order_item_Product_ID'";
										$queryDimension = $this->db->query($sqlDimension)->result();
										foreach($queryDimension as $valueDimension)
										{
											if($valueDimension->Group_width==NULL OR $valueDimension->Group_width==0 OR $valueDimension->Group_length==NULL OR $valueDimension->Group_length==0 OR $valueDimension->Group_height==NULL OR $valueDimension->Group_height==0)
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
									?>
								<?php endforeach; ?>

								<?	
									$sqlUPS = "SELECT ups_type.Type_ID, type_name, price, price_saver
												FROM ups_rate JOIN ups_service ON ups_rate.Zone_ID=ups_service.Zone_ID
												JOIN ups_type ON ups_service.Type_ID=ups_type.Type_ID";
									if($has_ship==1)
										$sqlUPS .= " WHERE (weight_min < $TotalWeightDimension AND $TotalWeightDimension <= weight_max)
													AND ups_service.Country_ID=$users->s_Country_ID";
									else
										$sqlUPS .= " WHERE (weight_min < $order->Total_Weight AND $order->Total_Weight <= weight_max)
													AND ups_service.Country_ID='222'";
/*
									$sqlUPS = "SELECT ups_type.Type_ID, type_name, price, price_saver
												FROM ups_rate JOIN ups_service ON ups_rate.Zone_ID=ups_service.Zone_ID
												JOIN ups_type ON ups_service.Type_ID=ups_type.Type_ID
												WHERE (weight_min < $order->Total_Weight AND $order->Total_Weight <= weight_max)";
									if($has_ship==1)
										$sqlUPS .= " AND ups_service.Country_ID=$users->s_Country_ID";
									else
										$sqlUPS .= " AND ups_service.Country_ID='222'";
*/
									$queryUPS = $this->db->query($sqlUPS)->result();
									$upsRows = 0;
									foreach($queryUPS as $valueUPS)
									{
										$upsRows += 1;
									?>
									<tr class="tcl">
										<?if(set_value('s_Country_ID', '')!='222' OR $has_ship==0 OR ($has_ship==1 AND set_value('s_Country_ID','')=='0'))
										{
											if($order->How_ID==3 OR $order->How_ID==4)
											{?>
												<td width="50px"><input type="radio" name="how_delivery" <?=($valueUPS->Type_ID==$order->How_ID)?'checked=checked':''?> value="<?=$valueUPS->Type_ID?>" ></td>
											<?}
											else
											{?>
												<td width="50px"><input type="radio" name="how_delivery" <?=($valueUPS->Type_ID==4)?'checked=checked':''?> value="<?=$valueUPS->Type_ID?>" ></td>
											<?}
										}?>
										<td width="320px"><?=$valueUPS->type_name?></td>
										<td width="80px">
											<?
												if($valueUPS->Type_ID==3)
												{
													$expressPrice = number_format($valueUPS->price * $FuelSurcharge, 2);
													if(LANG=='EN')
														echo "US$ ".google_finance_convert("THB", "USD", $expressPrice);
													else
														echo $expressPrice." ฿";
												}
												else if($valueUPS->Type_ID==4)
												{
													$saverPrice = number_format($valueUPS->price_saver * $FuelSurcharge, 2);
													if(LANG=='EN')
														echo "US$ ".google_finance_convert("THB", "USD", $saverPrice);
													else
														echo $saverPrice." ฿";
												}
											?>
										</td>
									</tr>
									<?}?>
									<?if($upsRows==0){?><tr><td colspan='3'><!--<font color='red'>not available</font>--></td></tr><?}?>
							</tbody>
						</table>
					</div>
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
															$exRprice = number_format($result->order_item_Total_Price);
															if(LANG=='EN')
																echo "US$ ".google_finance_convert("THB", "USD", $exRprice);
															else
																echo $exRprice." ฿";
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
							<td width="110px" height="20px">Order Total</td>
							<td width="140px"></td>
							<td></td>
						</tr>
						<tr>
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
							<td style="text-align: center;"><a href="http://online.goodjobstore.com/cart">Back to Shopping</a></td>
						</tr>
						<tr>
							<td>Shipping</td>
							<td style="text-align: right; padding-right: 50px;">
								<?
									//$exShipping = number_format(cal_range_weight($order->How_ID, $order->Total_Weight), 2);
									//$exShipping = number_format($order->shipping_price, 2);						

if($disQTY >= 3 AND ($order->How_ID==3 OR $order->How_ID==4))
	$discountShipping = cal_range_weight($order->How_ID, $TotalWeightDimension)*(90/100) * $FuelSurcharge;
else if($order->How_ID==3 OR $order->How_ID==4)
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
										if(LANG=='EN')
											echo "US$ ".google_finance_convert("THB", "USD", $exTotal);
										else
											echo $exTotal." ฿";
									?>
								</h4>
							</td>
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
<?php set_final_price($order->Total_Price + cal_range_weight($order->How_ID, $order->Total_Weight) + cal_price_option($order->Order_ID), $order->Order_ID, cal_price_option($order->Order_ID), $discountShipping); ?>
<script>
function showMe (it, box) {
  var vis = (box.checked) ? "hidden" : "visible";
  document.getElementById(it).style.visibility = vis;
}
</script>