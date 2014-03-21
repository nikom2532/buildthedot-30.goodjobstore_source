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
                <li><a href="<?=site_url('preference/keyword_group')?>">Keyword Group</a></li>
                <li class="current"><a href="<?=site_url('preference/keyword_group/edit/'.get_select_keyword_group_name(set_value('keygroup_id','')))?>">Edit <?=get_select_keyword_group_name(set_value('keygroup_id',''))?></a></li>
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
                    <div class="whead"><h6>Edit <?=get_select_keyword_group_name(set_value('keygroup_id',''))?></h6>
                    <div class="clear"></div></div>
                    
					<?//=form_open_multipart('preference/edit_keyword_group_update')?>
					<form id="edit_keywordgp" class="main" action="<?=base_url('preference/edit_keyword_group_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<input type="hidden" name="keygroup_id" value="<?=set_value('keygroup_id', '')?>"/>
						<input name="redirect" type="hidden" value="<?= $this->uri->uri_string() ?>" />
						<div class="formRow">
							<div class="grid3"><label>Name:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="name" id="name" value="<?=set_value('name', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("preference/keyword_group")?>'">
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

