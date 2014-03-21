<?php
	$user = $this->session->userdata('user');
?>

<!-- Sidebar begins -->
<div id="sidebar">
    <!-- Left nav -->
	<?=$this->load->view('content/left_menu');?>
</div>
<!-- Sidebar ends -->
	
    
<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('content/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('content')?>">Content</a></li>
                <li class="current"><a href="<?=site_url('content/edit/'.set_value('content_id', ''))?>"><?=set_value('subject', '')?></a></li>
            </ul>
        </div> 
    </div>
		<?php echo validation_errors('<div class="nNote nFailure"><p>', '</p></div>'); ?>
    <!-- Main content -->
	<div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu', 'class=main')?>
			<form id="edit_content" class="main" action="<?=base_url('content/edit_content_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				<input type="hidden" name="content_id" value="<?=set_value('content_id', '')?>"/>
				<div class="formRow">
					<div class="grid3"><label>Subject:<span class="req">*</span></label></div>
					<div class="grid3"><input type="text" name="subject" id="subject" value="<?=set_value('subject', '')?>"/></div>
					<div class="clear"></div>
				</div>  
				<div class="formRow">
					<div class="whead">
						<textarea id="editor" name="description" cols="16"><?=set_value('description', '')?></textarea>
						<div class="clear"></div>
					</div>
				</div>  
				<div class="formRow">
					<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("preference")?>'">
					<input type="submit" name ="submit" class="buttonS bLightBlue formSubmit" style="margin-right:10px" value="SUBMIT">
					<div class="clear"></div>
				</div>
			</form>
	</div>
	<!-- Main content ends -->
    
</div>
<!-- Content ends -->    

