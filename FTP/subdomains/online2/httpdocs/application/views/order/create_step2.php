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
				<li class="current"><a href="<?=site_url('order/create/'.$cus_id)?>"><?=$cus_id?></a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
		<!-- messages -->
			<?php echo validation_errors('<div class="nNote nFailure"><p>', '</p></div>'); ?>
		<!-- end messages -->
    <!-- Main content -->
    <div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu', 'class=main')?>
				<div class="widget fluid">
					<div class="whead">
						<h6><?=$cus_id?> Add Order</h6>
						<div class="clear"></div>
					</div>
					<form id="create_cus" class="main" action="<?=base_url('order/create/'.$cus_id.'/check')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<!--//////////////////////////////////////////////////////////////-->
					<!--//////////////////////  Coupon /////////////////////////-->
					<!--//////////////////////////////////////////////////////////////-->
					<fieldset class="step" id="w2first">
					<h1 style="color:#3C74AD; text-decoration:underline;">Coupon Code</h1>
					<div class="formRow">
							<div class="grid3"><label>Coupon Code:</label></div>
							<div class="grid3"><input type="text" name="coupon" id="coupon" value="<?=(isset($coupon_code))?$coupon_code:'';?>"/></div>
							<div class="clear"></div>
					</div>
                    </fieldset>
					
					
					<!--//////////////////////////////////////////////////////////////-->
					<!--//////////////////////  Choose Product /////////////////////////-->
					<!--//////////////////////////////////////////////////////////////-->
					<fieldset id="w1confirmation" class="step">
                     <h1 style="color:#3C74AD; text-decoration:underline;">Choose Product</h1>
                     <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
					<thead>
						<tr>
							<th class="th2">Select</th>
							<th>ID</th>
							<th>Image</th>
							<th>Name</th>
							<th>Property</th>
							<th>Color</th>
							<th>Attribute</th>
							<th>Unit Price</th>
							<th>Qty</th>
							<!--<th>Public</th>-->
							<th>Item Qty</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?php foreach(get_product_list() as $value): ?>	
							<tr>
								<td>
									<input type="checkbox" name="check[]" value="<?=$value->product_id?>" <?=(isset($order_item_list[$value->product_id]))?'checked':'';?>>
								</td>
								<td><?=$value->product_id?></td>
								<td align="center">
									<? if (get_primary_img_from_id($value->product_id) == ''): ?>
										<img style="height:25; width:25px;" src=""/>
									<? else: ?>
										<img style="height:50; width:50px;" src="<?=base_url()?><?=get_primary_img_from_id($value->product_id)?>"/>
									<? endif;?>
								</td>
								<td><?=$value->name?></td>
								<td><?=get_property_name($value->prop_id)?></td>
								<td><?=get_color_name($value->color_id)?></td>
								<td><?=get_attribute_name($value->attribute_id)?></td>
								<td>
									<?
										if($value->discount_type==1)
											$unit_price = $value->price - (($value->price * $value->discount)/100);
										else if($value->discount_type==2)
											$unit_price = $value->price - $value->discount;
										else
											$unit_price = $value->price;
									?>
									<?=$unit_price?>
								</td>
								<td><?=$value->qty?></td>
								<!--<td><?=($value->public==1)?'Yes':'No';?></td>-->
								<td align="center">
									<input class="grid2" type="text" id="<?=$value->product_id?>" name="<?=$value->product_id?>" value="<?=(isset($order_item_list[$value->product_id]))?$order_item_list[$value->product_id]:'0';?>"/>
								</td>
								
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
                    </fieldset>
                    
					<!--//////////////////////////////////////////////////////////////-->
					<!--//////////////////////  Billing form /////////////////////////-->
					<!--//////////////////////////////////////////////////////////////-->                
                    
                    <fieldset id="w2confirmation" class="step">
                        <h1 style="color:#3C74AD; text-decoration:underline;">Billing Information</h1>
						<div class="formRow">	
							<div class="grid3"><label>First Name:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="b_firstname" id="b_firstname" value="<?=$billing['b_firstname']?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_b_firstname))?$er_b_firstname:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Last Name:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="b_lastname" id="b_lastname" value="<?=$billing['b_lastname']?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_b_lastname))?$er_b_lastname:'';?></font></div>
							<div class="clear"></div>
						</div>
							
						<div class="formRow">
							<div class="grid3"><label>Address:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="b_address" id="b_address" value="<?=$billing['b_lastname']?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_b_address))?$er_b_address:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>City/Province:<span class="req">*</span></label></div>
							<div class="grid3">
								<select name="b_city_id" id="b_city_id" class="styled">
									<option value=''>------ Select City/Province -----</option>
									<?php foreach(get_dropdown_city() as $value): ?>
										<option value="<?=$value->city_id?>" <?=($billing['b_city_id']==$value->city_id)?'selected':'';?>><?=$value->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="grid3"><font color='red'><?=(isset($er_s_city_id))?$er_s_city_id:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Postcode:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="b_postcode" id="b_postcode" value="<?=$billing['b_postcode']?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_b_postcode))?$er_b_postcode:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Country:<span class="req">*</span></label></div>
							<div class="grid3">
								<select name="b_country_id" id="b_country_id" class="styled">
									<option value=''>------ Select Country -----</option>
									<?php foreach(get_dropdown_country() as $value): ?>
										<option value="<?=$value->country_id?>" <?=($billing['b_country_id']==$value->country_id)?'selected':'';?>><?=$value->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="grid3"><font color='red'><?=(isset($er_b_country_id))?$er_b_country_id:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Phone Number:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="b_phone" id="b_phone" value="<?=$billing['b_phone']?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_b_phone))?$er_b_phone:'';?></font></div>
							<div class="clear"></div>
						</div>
                    </fieldset>


					<!--//////////////////////////////////////////////////////////////-->
					<!--/////////////////////  Shipping form /////////////////////////-->
					<!--//////////////////////////////////////////////////////////////-->                            
                   
                    <fieldset id="w3confirmation" class="step">
                        <h1 style="color:#3C74AD; text-decoration:underline;">Shipping Information</h1>
						<div class="formRow">
							<div class="grid3"><label>First Name:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="s_firstname" id="s_firstname" value="<?=$shipping['s_firstname']?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_s_firstname))?$er_s_firstname:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Last Name:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="s_lastname" id="s_lastname" value="<?=$shipping['s_firstname']?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_s_lastname))?$er_s_lastname:'';?></font></div>
							<div class="clear"></div>
						</div>
							
						<div class="formRow">
							<div class="grid3"><label>Address:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="s_address" id="s_address" value="<?=$shipping['s_firstname']?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_s_address))?$er_s_address:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>City/Province:<span class="req">*</span></label></div>
							<div class="grid3">
								<select name="s_city_id" id="s_city_id" class="styled">
									<option value=''>------ Select City/Province -----</option>
									<?php foreach(get_dropdown_city() as $value): ?>
										<option value="<?=$value->city_id?>" <?=($shipping['s_city_id']==$value->city_id)?'selected':'';?>><?=$value->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="grid3"><font color='red'><?=(isset($er_s_city_id))?$er_s_city_id:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Postcode:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="s_postcode" id="s_postcode" value="<?=$shipping['s_postcode']?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_s_postcode))?$er_s_postcode:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Country:<span class="req">*</span></label></div>
							<div class="grid3">
								<select name="s_country_id" id="s_country_id" class="styled">
									<option value=''>------ Select Country -----</option>
									<?php foreach(get_dropdown_country() as $value): ?>
										<option value="<?=$value->country_id?>" <?=($shipping['s_country_id']==$value->country_id)?'selected':'';?>><?=$value->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="grid3"><font color='red'><?=(isset($er_s_country_id))?$er_s_country_id:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Phone Number:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="s_phone" id="s_phone" value="<?=$shipping['s_phone']?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_s_phone))?$er_s_phone:'';?></font></div>
							<div class="clear"></div>
						</div>
                    </fieldset>   
					<!--//////////////////////////////////////////////////////////////-->
					<!--/////////////////////  Payment form /////////////////////////-->
					<!--//////////////////////////////////////////////////////////////-->
					
					<fieldset id="w4confirmation" class="step">
                        <h1 style="color:#3C74AD; text-decoration:underline;">Payment Information</h1>
						<div class="formRow">
							<div class="grid3"><label>Shipping:<span class="req">*</span></label></div>
							<div class="grid3">
								<select name="shipping_id" id="shipping_id" class="styled">
									<option value=''>------ Select Shipping -----</option>
									<?php foreach(get_shipping_list() as $value): ?>
										<option value="<?=$value->shipping_id?>" <?=($shipping_id==$value->shipping_id)?'selected':'';?>><?=$value->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Payment Method:<span class="req">*</span></label></div>
							<div class="grid3">
								<select name="payment_id" id="payment_id" class="styled">
									<option value=''>------ Select Payment Method -----</option>
									<?php foreach(get_payment_list() as $value): ?>
										<option value="<?=$value->payment_id?>" <?=($payment_id==$value->payment_id)?'selected':'';?>><?=$value->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="clear"></div>
						</div>
                    </fieldset>   
					
					<!--//////////////////////////////////////////////////////////////-->
					<!--///////////////////////// Submit /////////////////////////////-->
					<!--//////////////////////////////////////////////////////////////-->          
         
                    <div class="formRow">
						<!--<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?//=base_url("customer")?>'">
						<input type="submit" name ="submit" class="buttonS bLightBlue formSubmit" style="margin-right:10px" value="SUBMIT">-->
                        <div class="status" id="status2"></div>
                        <div class="formSubmit">
                            <input class="buttonM bDefault" id="back2" value="Back" type="reset" />
                            <input class="buttonM bRed ml10" id="next2" name="submit" value="Next" type="submit" />
                            <div class="data" id="w2"></div>
                        <div class="clear"></div>
                    </div>					
					<?//=form_close()?>
					</form>	
				</div>
		
	</div>
	    <!-- Main content ends -->
    
</div>
<!-- Content ends -->