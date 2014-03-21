<?php
	if(LANG==1)
		$user = $this->session->userdata('user');
	else
		$user = get_user_lang($this->session->userdata('user')->admin_id);
?>
<script type="text/javascript" src="<?=base_url()?>public/js/js_function/category_function.js"></script>

<!-- Sidebar begins -->
<div id="sidebar">
    <!-- Left nav -->
	<?=$this->load->view('category/left_menu');?>
</div>
<!-- Sidebar ends -->

<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('category/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?=site_url('category')?>">Category</a></li>
                <li class="current"><a href="<?=site_url('category/create')?>">Add Category</a></li>
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
                    <div class="whead"><h6>Create Category</h6>
                    <div class="clear"></div></div>
                    
					<?//=form_open_multipart('category/create_update')?>
					<form id="create_cat" class="main" action="<?=base_url('category/create_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="formRow">
                        <div class="grid3"><label>Name:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="name" id="name" value="<?=set_value('name', '')?>"/></div>
                        <div class="clear"></div>
                    </div>
                    
					<!-- level -->
					<div class="formRow">
                        <div class="grid3"><label>Level:<span class="req">*</span></label></div>
                        <div class="grid3">
							<select name="sel_lv" id="sel_lv" onChange="select_level('<?=base_url();?>', ''); select_main('<?=base_url();?>', '', '');">
								<option value=''>------ Select Level -----</option>
								<option value="1" <?=set_select('sel_lv', '1')?>>Main Category</option>
								<option value="2" <?=set_select('sel_lv', '2')?>>Sub Lv1</option>
								<option value="3" <?=set_select('sel_lv', '3')?>>Sub Lv2</option>
							</select><br><br>
							<div id="field_main"><script>select_level('<?=base_url()?>', '<?=set_value("sel_lv1","");?>');</script></div><br>
							<div id="field_sub"><script>select_main('<?=base_url()?>', '<?=set_value("sel_lv1","")?>', '<?=set_value("sel_lv2","")?>');</script></div>
						</div>
                        <div class="clear"></div>
                    </div>
                    <!-- level end -->

					<div class="formRow">
                        <div class="grid3"><label>Url:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="url" id="url" value="<?=set_value('url', '')?>"/></div>
                        <div class="clear"></div>
                    </div>
					 <div class="formRow">
                        <div class="grid3"><label>Public:</label></div>
						<div class="grid3 check"><input type="checkbox" name="public" value="1" <?=set_checkbox('public', '1')?>> Yes</div>
                        <div class="clear"></div>
                    </div>		
                    <div class="formRow">
                        <div class="grid3"><label>Title:</label></div>
                        <div class="grid3"><input type="text" name="title" id="title" value="<?=set_value('title', '')?>"/></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>Meta Keywords:</label></div>
                        <div class="grid9"><textarea rows="8" name="meta_keyword" id="meta_keyword" value="<?=set_value('meta_keyword', '')?>"></textarea></div>
						
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>Meta Description:</label></div>
                        <div class="grid9"><textarea rows="8" name="meta_description" id="meta_description" value="<?=set_value('meta_description', '')?>"></textarea></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
						<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("category")?>'">
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
