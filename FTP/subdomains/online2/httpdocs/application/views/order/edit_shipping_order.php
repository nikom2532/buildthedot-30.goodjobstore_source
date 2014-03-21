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
				<li><a href="<?=site_url('order/view/'.set_value('order_id', ''))?>"><?=set_value('order_id', '')?></a></li>
				<li class="current"><a href="<?=site_url('order/edit/shipping/'.set_value('order_id', ''))?>">Edit Shipping Order</a></li>
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
			<fieldset>
				<!------------------------------------------------------>
				<!------------------ Shipping Address ------------------>
				<!------------------------------------------------------>
				<div class="widget fluid">
					<div class="whead">
						<h6>Edit Shipping Order Address</h6>
						<div class="clear"></div>
					</div>
					<?//=form_open_multipart('customer/shipping_update')?>
					<form id="edit_order_shipping" class="main" action="<?=base_url('order/edit_shipping_order_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<input type="hidden" name="order_id" value="<?=set_value('order_id', '')?>"/>
						<div class="formRow">
							<div class="grid3"><label>First Name:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="s_firstname" id="s_firstname" value="<?=set_value('s_firstname', '')?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_s_firstname))?$er_s_firstname:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Last Name:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="s_lastname" id="s_lastname" value="<?=set_value('s_lastname', '')?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_s_lastname))?$er_s_lastname:'';?></font></div>
							<div class="clear"></div>
						</div>
							
						<div class="formRow">
							<div class="grid3"><label>Address:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="s_address" id="s_address" value="<?=set_value('s_address', '')?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_s_address))?$er_s_address:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>City/Province:<span class="req">*</span></label></div>
							<div class="grid3">
								<select name="s_city_id" id="s_city_id">
									<option value=''>------ Select City/Province -----</option>
									<?php foreach(get_dropdown_city() as $value): ?>
										<option value="<?=$value->city_id?>" <?=set_select('s_city_id',$value->city_id)?>><?=$value->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="grid3"><font color='red'><?=(isset($er_s_city_id))?$er_s_city_id:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Postcode:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="s_postcode" id="s_postcode" value="<?=set_value('s_postcode', '')?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_s_postcode))?$er_s_postcode:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Country:<span class="req">*</span></label></div>
							<div class="grid3">
								<select name="s_country_id" id="s_country_id">
									<option value=''>------ Select Country -----</option>
									<?php foreach(get_dropdown_country() as $value): ?>
										<option value="<?=$value->country_id?>" <?=set_select('s_country_id',$value->country_id)?>><?=$value->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="grid3"><font color='red'><?=(isset($er_s_country_id))?$er_s_country_id:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Phone Number:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="s_phone" id="s_phone" value="<?=set_value('s_phone', '')?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_s_phone))?$er_s_phone:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Shipping Method:<span class="req">*</span></label></div>
							<div class="grid3">
								<select name="shipping_id" id="shipping_id" >
									<option value=''>------ Select Shipping Method -----</option>
									<?php foreach(get_shipping_list() as $value): ?>
										<option value="<?=$value->shipping_id?>" <?=set_select('shipping_id',$value->shipping_id)?>><?=$value->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="grid3"><font color='red'><?=(isset($er_b_country_id))?$er_b_country_id:'';?></font></div>
							<div class="clear"></div>
						</div>
                    <div class="formRow">
						<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("order/view/".set_value('order_id', ''))?>'">
						<input type="submit" name ="submit" class="buttonS bLightBlue formSubmit" style="margin-right:10px" value="SUBMIT">
                        <div class="clear"></div>
                    </div>
					<?//=form_close()?>
					</form>
				</div>
		</fieldset>
	</div>
	<!-- Main content ends -->
    
</div>
<!-- Content ends -->