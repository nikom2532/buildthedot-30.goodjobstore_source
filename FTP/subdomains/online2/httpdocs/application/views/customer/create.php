<?php
	$user = $this->session->userdata('user');
?>

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
                <li class="current"><a href="<?=site_url('customer/create')?>">Add Customer</a></li>
            </ul>
        </div> 
    </div>
    <?php echo validation_errors('<div class="nNote nFailure"><p>', '</p></div>'); ?>
    <!-- Main content -->
	<div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu', 'class=main')?>
				<div class="widget fluid">
					<div class="whead">
						<h6><?=set_value('cus_id', '')?> Create Customer</h6>
						<div class="clear"></div>
					</div>
					<form id="create_cus" class="main" action="<?=base_url('customer/create_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<!--//////////////////////////////////////////////////////////////-->
					<!--//////////////////////  Contact form /////////////////////////-->
					<!--//////////////////////////////////////////////////////////////-->
					<fieldset class="step" id="w2first">
                     <h1 style="color:#3C74AD; text-decoration:underline;">Contact Information</h1>					
                     <input type="hidden" name="cus_id" value="<?=set_value('cus_id', '')?>"/>
					<input type="hidden" name="create_at" value="<?=set_value('create_at', '')?>"/>
                    <div class="formRow">
                        <div class="grid3"><label>First Name:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="firstname" id="firstname" value="<?=set_value('firstname', '')?>"/></div>
						<div class="grid3"><font color='red'><?=(isset($er_firstname))?$er_firstname:'';?></font></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>Last Name:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="lastname" id="lastname" value="<?=set_value('lastname', '')?>"/></div>
						<div class="grid3"><font color='red'><?=(isset($er_lastname))?$er_lastname:'';?></font></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>Address:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="address" id="address" value="<?=set_value('address', '')?>"/></div>
						<div class="grid3"><font color='red'><?=(isset($er_address))?$er_address:'';?></font></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <div class="grid3"><label>City/Province:<span class="req">*</span></label></div>
                        <div class="grid3">
							<select name="city_id" id="city_id">
								<option value=''>------ Select City/Province -----</option>
								<?php foreach(get_dropdown_city() as $value): ?>
									<option value="<?=$value->city_id?>" <?=set_select('city_id',$value->city_id)?>><?=$value->name?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="grid3"><font color='red'><?=(isset($er_city_id))?$er_city_id:'';?></font></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>Postcode:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="postcode" id="postcode" value="<?=set_value('postcode', '')?>"/></div>
						<div class="grid3"><font color='red'><?=(isset($er_postcode))?$er_postcode:'';?></font></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <div class="grid3"><label>Country:<span class="req">*</span></label></div>
                        <div class="grid3">
							<select name="country_id" id="country_id" >
								<option value=''>------ Select Country -----</option>
								<?php foreach(get_dropdown_country() as $value): ?>
									<option value="<?=$value->country_id?>" <?=set_select('country_id',$value->country_id)?>><?=$value->name?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="grid3"><font color='red'><?=(isset($er_country_id))?$er_country_id:'';?></font></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>Phone Number:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="phone" id="phone" value="<?=set_value('phone', '')?>"/></div>
						<div class="grid3"><font color='red'><?=(isset($er_phone))?$er_phone:'';?></font></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>Email:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="email" id="email" value="<?=set_value('email', '')?>"/></div>
						<div class="grid3"><font color='red'><?=(isset($er_email))?$er_email:'';?></font></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>Newsletter:</label></div>
						<div class="grid3 check"><input type="checkbox" name="newsletter" value="1" <?=set_checkbox('newsletter', '1')?>> Yes</div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>Birth Date:</label></div>
                        <div class="grid3"><input type="text" name="birth_date" id="birth_date" value="<?=set_value('birth_date', '')?>"/></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>Password:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="password" name="new_pass" id="new_pass" value="<?=set_value('new_pass', '')?>"/></div>
						<div class="grid3"><font color='red'><?=(isset($er_newPass))?$er_newPass:'';?></font></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>Confirm Password:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="password" name="conf_pass" id="conf_pass" value="<?=set_value('conf_pass', '')?>"/></div>
						<div class="grid3"><font color='red'><?=(isset($er_confPass))?$er_confPass:'';?></font></div>
                        <div class="clear"></div>
                    </div>
                    </fieldset>
                    
					<!--//////////////////////////////////////////////////////////////-->
					<!--//////////////////////  Billing form /////////////////////////-->
					<!--//////////////////////////////////////////////////////////////-->                
                    
                    <fieldset id="w2confirmation" class="step">
                        <h1 style="color:#3C74AD; text-decoration:underline;">Billing Information</h1>
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
								<select name="b_city_id" id="b_city_id" class="styled">
									<option value=" ">------ Select City/Province -----</option>
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
							<div class="grid3"><label>Country:<span class="req">*</span> <?=set_value('b_country_id','')?></label></div>
							<div class="grid3">
								<select name="b_country_id" id="b_country_id" class="styled">
									<option value=" ">------ Select Country -----</option>
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
                    </fieldset>

					<!--//////////////////////////////////////////////////////////////-->
					<!--/////////////////////  Shipping form /////////////////////////-->
					<!--//////////////////////////////////////////////////////////////-->                            
                   
                    <fieldset id="w3confirmation" class="step">
                        <h1 style="color:#3C74AD; text-decoration:underline;">Shipping Information</h1>
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
								<select name="s_city_id" id="s_city_id" class="styled">
									<option value=" ">------ Select City/Province -----</option>
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
							<div class="grid3"><label>Country:<span class="req">*</span> <?=set_value('s_country_id','')?></label></div>
							<div class="grid3">
								<select name="s_country_id" id="s_country_id" class="styled">
									<option value=" ">------ Select Country -----</option>
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
