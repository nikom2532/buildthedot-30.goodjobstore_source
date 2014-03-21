<?php
	$user = $this->session->userdata('user');
?>

<!-- Sidebar begins -->
<div id="sidebar">
    <!-- Left nav -->
	<?=$this->load->view('preference/left_menu');?>
</div>
<!-- Sidebar ends -->
	
    
<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('preference/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?=site_url('preference')?>">Preference</a></li>
                <li><a href="<?=site_url('preference/color')?>">Color</a></li>
                <li class="current"><a href="<?=site_url('preference/color/edit/'.get_color_name(set_value('color_id','')))?>">Edit <?=get_color_name(set_value('color_id',''))?></a></li>
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
                    <div class="whead"><h6>Edit <?=get_color_name(set_value('color_id',''))?></h6>
                    <div class="clear"></div></div>
                    
					<?//=form_open_multipart('preference/edit_color_update')?>
					<form id="edit_colortest" class="main" action="<?=base_url('preference/edit_color_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<input type="hidden" name="color_id" value="<?=set_value('color_id', '')?>"/>
						 <div class="formRow">
							<div class="grid3"><label>Image:</label></div>
							<div class="grid3"><input type="file" name="userfile" class="styled"></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Name:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="name" id="name" value="<?=set_value('name', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Public:</label></div>
							<div class="grid3 check"><input type="checkbox" name="public" value="1" <?=set_checkbox('public', '1')?>> Yes</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("preference")?>'">
							<input type="submit" name ="submit" class="buttonS bLightBlue formSubmit" style="margin-right:10px" value="SUBMIT">
							<div class="clear"></div>
						</div>
                    </form>
					<?//=form_close()?>
               </div>
            </fieldset>
	</div>
	<!-- Main content ends -->
    
</div>
<!-- Content ends -->    

