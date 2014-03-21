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
                <li><a href="<?=site_url('customer/group')?>">Groups</a></li>
                <li class="current"><a href="<?=site_url('customer/group/create')?>">Add Group</a></li>
            </ul>
        </div> 
    </div>
    <?php echo validation_errors('<div class="nNote nFailure"><p>', '</p></div>'); ?>
    <!-- Main content -->
	<div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu', 'class=main')?>
			<fieldset>
				<div class="widget fluid">
					<div class="whead">
						<h6>Add Customer Group</h6>
						<div class="clear"></div>
					</div>

					<?//=form_open_multipart('customer/group_update')?>
					<form id="create_group" class="main" action="<?=base_url('customer/group_create_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">

						<input type="hidden" name="cusgroup_id" value="<?=set_value('cusgroup_id', '')?>"/>
						<div class="formRow">
							<div class="grid3"><label>Name:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="name" id="name" value="<?=set_value('name', '')?>"/></div>
							<div class="grid3"><font color='red'><?=(isset($er_name))?$er_name:'';?></font></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Description:</label></div>
							<div class="grid9"><textarea rows="8" name="description" id="description"><?=set_value('description', '')?></textarea></div>
							<div class="clear"></div>
						</div>

						<div class="formRow">
							<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=site_url("customer/group")?>'">
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
