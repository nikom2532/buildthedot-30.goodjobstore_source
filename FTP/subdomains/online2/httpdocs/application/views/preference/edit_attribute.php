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
                <li><a href="<?=site_url('preference/attribute')?>">Attribute</a></li>
                <li class="current"><a href="<?=site_url('preference/attribute/edit/'.get_select_attribute_name(set_value('attribute_id','')))?>">Edit <?=get_select_attribute_name(set_value('attribute_id',''))?></a></li>
            </ul>
        </div> 
    </div>
		<!--  Message -->
			<?php echo validation_errors('<div class="nNote nFailure"><p>', '</p></div>'); ?>
		<!-- End Message -->
    
    <!-- Main content -->
	
	<div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu', 'class=main')?>
			<fieldset>
                <div class="widget fluid">
                    <div class="whead"><h6>Edit <?=get_select_attribute_name(set_value('attribute_id',''))?></h6>
                    <div class="clear"></div></div>
                    
					<?//=form_open_multipart('preference/edit_attribute_update')?>
					<form id="edit_attr" class="main" action="<?=base_url('preference/edit_attribute_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<input type="hidden" name="attribute_id" value="<?=set_value('attribute_id', '')?>"/>
						<input name="redirect" type="hidden" value="<?= $this->uri->uri_string() ?>" />
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
							<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("preference/attribute")?>'">
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

