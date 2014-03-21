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
				<li class="current"><a href="<?=site_url('order/edit/billing/'.set_value('order_id', ''))?>">Edit Billing Order</a></li>
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
				<!------------------ Billing Address ------------------->
				<!------------------------------------------------------>
				<div class="widget fluid">
					<div class="whead">
						<h6>Edit Billing Order Adress</h6>
						<div class="clear"></div>
					</div>
					<?//=form_open_multipart('customer/billing_update')?>
					<form id="edit_billing_order" class="main" action="<?=base_url('order/edit_billing_order_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<input type="hidden" name="order_id" value="<?=set_value('order_id', '')?>">
						<div class="formRow">
							<div class="grid3"><label>First Name:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="b_firstname" id="b_firstname" value="<?=set_value('b_firstname', '')?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_b_firstname))?$er_b_firstname:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Last Name:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="b_lastname" id="b_lastname" value="<?=set_value('b_lastname', '')?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_b_lastname))?$er_b_lastname:'';?></font></div>
							<div class="clear"></div>
						</div>
							
						<div class="formRow">
							<div class="grid3"><label>Address:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="b_address" id="b_address" value="<?=set_value('b_address', '')?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_b_address))?$er_b_address:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>City/Province:<span class="req">*</span></label></div>
							<div class="grid3">
								<select name="b_city_id" id="b_city_id" >
									<option value=''>------ Select City/Province -----</option>
									<?php foreach(get_dropdown_city() as $value): ?>
										<option value="<?=$value->city_id?>" <?=set_select('b_city_id',$value->city_id)?>><?=$value->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="grid3"><font color='red'><?=(isset($er_b_city_id))?$er_b_city_id:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Postcode:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="b_postcode" id="b_postcode" value="<?=set_value('b_postcode', '')?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_b_postcode))?$er_b_postcode:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Country:<span class="req">*</span></label></div>
							<div class="grid3">
								<select name="b_country_id" id="b_country_id" >
									<option value=''>------ Select Country -----</option>
									<?php foreach(get_dropdown_country() as $value): ?>
										<option value="<?=$value->country_id?>" <?=set_select('b_country_id',$value->country_id)?>><?=$value->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="grid3"><font color='red'><?=(isset($er_b_country_id))?$er_b_country_id:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Phone Number:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="b_phone" id="b_phone" value="<?=set_value('b_phone', '')?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_b_phone))?$er_b_phone:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Payment Method:<span class="req">*</span></label></div>
							<div class="grid3">
								<select name="payment_id" id="payment_id" >
									<option value=''>------ Select Payment Method -----</option>
									<?php foreach(get_payment_list() as $value): ?>
										<option value="<?=$value->payment_id?>" <?=set_select('payment_id',$value->payment_id)?>><?=$value->name?></option>
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