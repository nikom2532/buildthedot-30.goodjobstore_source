<?php
	$user = $this->session->userdata('user');
	$bill_address = get_select_billing_address(set_value('cus_id', ''));
?>

<script type="text/javascript">
	function same_data()
	{
		var c1 = $('#c1').attr('checked');
		if(c1 == 'checked')
		{
			$('#s_firstname').val("<?=$bill_address['b_firstname']?>");
			$('#s_lastname').val("<?=$bill_address['b_lastname']?>");
			$('#s_address').val("<?=$bill_address['b_address']?>");
			$('#s_city_id').val("<?=$bill_address['b_city_id']?>");
			$('#s_postcode').val("<?=$bill_address['b_postcode']?>");
			$('#s_country_id').val("<?=$bill_address['b_country_id']?>");
			$('#s_phone').val("<?=$bill_address['b_phone']?>");
		}
		else
		{
			$('#s_firstname').val("<?=set_value('s_firstname', '')?>");
			$('#s_lastname').val("<?=set_value('s_lastname', '')?>");
			$('#s_address').val("<?=set_value('s_address', '')?>");
			$('#s_city_id').val("<?=set_value('s_city_id', '')?>");
			$('#s_postcode').val("<?=set_value('s_postcode', '')?>");
			$('#s_country_id').val("<?=set_value('s_country_id', '')?>");
			$('#s_phone').val("<?=set_value('s_phone', '')?>");
		}
	}
</script>

<!-- Sidebar begins -->
<div id="sidebar">
    <!-- Left nav -->
	<?
		echo $this->load->view('customer/left_menu');
	?>
</div>
<!-- Sidebar ends -->
	
    
<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('customer/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?=site_url('customer')?>">Customer</a></li>
                <li><a href="<?=site_url('customer/profile/'.set_value('cus_id', ''))?>"><?=set_value('cus_id', '')?></a></li>
                <li class="current"><a href="<?=site_url('customer/profile/edit/shipping/'.set_value('cus_id', ''))?>">Edit Address</a></li>
            </ul>
        </div> 
    </div>
    <?php echo validation_errors('<div class="nNote nFailure"><p>', '</p></div>'); ?>
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
						<h6><?=set_value('cus_id', '')?> Edit Shipping Address</h6>
						<div class="clear"></div>
					</div>
					<?//=form_open_multipart('customer/shipping_update')?>
					<form id="edit_cus" class="main" action="<?=base_url('customer/shipping_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

						<input type="hidden" name="cus_id" value="<?=set_value('cus_id', '')?>"/>
						<div class="formRow">
							<div class="grid3"><label></label></div>
							<div class="grid3 check"><input type="checkbox" name="c1" id="c1" onclick="javascript:same_data()" value="1"> Same as billing address</div>
							<div class="clear"></div>
						</div>
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
						<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("customer/profile/".set_value('cus_id', ''))?>'">
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
