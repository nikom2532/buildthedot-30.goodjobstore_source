<?php
	$user = $this->session->userdata('user');	
?>

<!-- Sidebar begins -->
<div id="sidebar">
    <!-- Left nav -->
	<?
		echo $this->load->view('admin/left_menu');
	?>
</div>
<!-- Sidebar ends -->
	
    
<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('admin/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?=site_url('admin')?>">Admin</a></li>
                <li class="current"><a href="<?=site_url('admin/create')?>">Add Admin</a></li>
            </ul>
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
                <div class="widget fluid">
                    <div class="whead"><h6>Create Admin</h6>
                    <div class="clear"></div></div>
                   

					<form id="create_admin" class="main" action="<?=base_url('admin/create_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="formRow">
                        <div class="grid3">Image</div>
						<div class="grid3"><input type="file" name="userfile" class="styled"></div>
                        <div class="clear"></div>
                    </div>
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
                        <div class="grid3"><label>Position:<span class="req">*</span></label></div>
                        <div class="grid3">
							<select name="position_id" id="position_id" >
									<option value="">------ Select Position -----</option>
								<?php foreach(get_dropdown_positions() as $value): ?>
									<option value="<?=$value->position_id?>" <?=set_select('position_id',$value->position_id)?>><?=$value->name?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="grid3"><font color='red'><?=(isset($er_position_id))?$er_position_id:'';?></font></div>
                        <div class="clear"></div>
                    </div>
					
                    <div class="formRow">
                        <div class="grid3"><label>Address:</label></div>
						<div class="grid5"><textarea name="address" id="address" rows="5"><?=set_value('address', '')?></textarea></div>
						<!--
                        <div class="grid3"><input type="text" name="address" id="address" value="<?=set_value('address', '')?>"/></div>
						-->
						<div class="grid3"><font color='red'><?=(isset($er_address))?$er_address:'';?></font></div>
                        <div class="clear"></div>
                    </div>
					
                    <div class="formRow">
                        <div class="grid3"><label>Phone Number:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="phone" id="phone" value="<?=set_value('phone', '')?>"/></div>
                        <div class="clear"></div>
                    </div>
					
                    <div class="formRow">
                        <div class="grid3"><label>Email:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="email" id="email" value="<?=set_value('email', '')?>"/></div>
						<div class="grid3"><font color='red'><?=(isset($er_email))?$er_email:'';?></font></div>
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
                    <div class="formRow">
						<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("admin")?>'">
						<input type="submit" name ="update" class="buttonS bLightBlue formSubmit" style="margin-right:10px" value="SUBMIT">
                        <div class="clear"></div>
                    </div>
					<form>
               </div>
            </fieldset>
	</div>
	<!-- Main content ends -->
    
</div>
<!-- Content ends -->    
