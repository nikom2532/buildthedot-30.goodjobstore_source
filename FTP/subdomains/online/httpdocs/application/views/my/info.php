<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/dashboard.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="<?=base_url()?>public/scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
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
				}
				else
				{
					document.getElementById('s_City_ID_cb').style.display = "none";
					document.getElementById('s_City_Name_txt').style.display = "block";
					$('#s_City_ID').val('88');
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
		MY INFO 
		</div>
		<div id="content">
		    <?=$this->load->view('my/menu')?>
		    <?php if(validation_errors()!=''):?>
	<div class="message warning"><?php echo validation_errors(); ?></div>
<?php endif;?>
		   	<?=form_open('my/info_update')?>
		   	<input type="hidden" name="Cus_ID" value="<?=set_value('Cus_ID', '')?>"/>
		   	<input type="hidden" name="Shipping_ID" value="<?=set_value('Shipping_ID', '')?>"/>
			<!-- Billing Address -->
			<div id="content_billing">
				<div id="line"></div>
				<div id="scrollbar1">
					<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
					<div class="viewport">
						<div class="overview">
							<div id="billing">
							<h4><?=(LANG=='TH')?'ที่อยู่ในการออกใบเสร็จ':"Billing Address";?></h4>
							<?php  
							if(isset($error))
							{
								echo "<font color={$error['color']}>";
								foreach ($error['data'] as $key => $value) 
								{
									echo "<p style='line-height:115%;'>{$value}</p>";
								}
								echo '</font>';
							}
						?>
								<table>
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
								<div id="line2"></div>
								
								<div id="div1">
								<table>
									<tbody>
									<tr>
										<td width="78%"><h4><?=(LANG=='TH')?'ที่อยู่ในการจัดส่งสินค้า':"Shipping Address";?></h4></td>
										<td><div id="checkbox">
								<input type="checkbox" name="c1" id="c1" onclick="javascript:same_data()" value="1" > &nbsp;<?=(LANG=='TH')?'ใช้ที่อยู่เดียวกับการออกใบเสร็จ':"Same as Billing Address";?>
								</div></td>
									</tr>
									</tbody>
								</table>
							
								
								<table>
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
													<select name="s_Country_ID" id="s_Country_ID" onchange="change_country('s_Country_ID', 's_City_ID_cb', 's_City_Name_txt', 's_city_prov_th', 's_city_prov_en');">
									                    <option value=" ">------ Select Country -----</option>
									                   	<? 
														$sqlCountry = "SELECT country.Country_ID, country.country_name, country.country_name_th 
																		FROM country JOIN ups_service ON country.Country_ID = ups_service.Country_ID
																		GROUP BY country.Country_ID
																		ORDER BY country.country_name";
														$queryCountry = $this->db->query($sqlCountry)->result();
														foreach($queryCountry as $valueCountry)
														{?>
															<option value="<?=$valueCountry->Country_ID?>" <?=set_select('s_Country_ID',$valueCountry->Country_ID)?>>
																<?=(LANG=='TH')?"{$valueCountry->country_name_th}":"{$valueCountry->country_name}";?>
															</option>
														<?}?>
								                    </select>
								                </div>
											</td>
										</tr>
										<tr>
											<td style="text-align: right; padding-right: 20px;">
												<div id="s_city_prov_th" style="display:<?=(set_value('s_Country_ID', '')=='222')?'block':'none';?>;">
													<?=(LANG=='TH')?'จังหวัด':"Province";?>
												</div>
												<div id="s_city_prov_en" style="display:<?=(set_value('s_Country_ID', '')=='222')?'none':'block';?>;">
													<?=(LANG=='TH')?'เมือง':"City";?>
												</div>
											</td>
											<td><img src="<?=base_url()?>public/images/dot.gif" /></td>
											<td>
												<div class="styled-select" id="s_City_ID_cb" style="display:<?=(set_value('s_Country_ID', '')=='222')?'block':'none';?>;">
													<select name="s_City_ID" id="s_City_ID">
									                    <option value=" ">------ Select Province -----</option>
									                    <?php foreach(get_select_city() as $value): ?>
															<option value="<?=$value->City_ID?>" <?=set_select('s_City_ID',$value->City_ID)?>><?=(LANG=='TH')?"{$value->Name_Th}":"{$value->Name_En}";?></option>
														<?php endforeach; ?>
								                    </select>
								                </div>
												<div id="s_City_Name_txt" style="display:<?=(set_value('s_Country_ID', '')=='222')?'none':'block';?>;">
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
								</div> <!-- end div1 -->
								
						</div><!-- end div billing -->
					</div>
				</div><!-- end div scrollbar -->
				<div id="form_button">
					<input type="button" name="cancel" value="CANCEL">
					<input type="submit" name ="update" value="UPDATE">
				</div>	
			</div> <!-- end div content_billing -->
			<?=form_close()?>
		</div>  <!-- end div content -->