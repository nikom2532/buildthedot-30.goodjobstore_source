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
				<?
				$current_url = get_cat_url_from_id(set_value('cat_id', ''));
				if(set_value('level', '')==2 OR set_value('level', '')==3)
				{
					$current_url = get_cat_url_from_id(set_value('main_id', '')).'/'.get_cat_url_from_id(set_value('cat_id', ''));
				?>
					<li>
						<a href="<?=site_url('category/view/'.get_cat_url_from_id(set_value('main_id', '')))?>">
							<?=get_cat_name(set_value('main_id', ''))?>
						</a>
					</li>
				<?}
				if(set_value('level', '')==3)
				{
					$current_url = get_cat_url_from_id(set_value('main_id', '')).'/'.get_cat_url_from_id(set_value('sub_id', '')).'/'.get_cat_url_from_id(set_value('cat_id', ''));
				?>
					<li>
						<a href="<?=site_url('category/view/'.get_cat_url_from_id(set_value('main_id', '')).'/'.get_cat_url_from_id(set_value('sub_id', '')))?>">
							<?=get_cat_name(set_value('sub_id', ''))?>
						</a>
					</li>
				<?}?>
                <li class="current"><a href="<?=site_url('category/edit/'.$current_url)?>">Edit <?=get_cat_name(set_value('cat_id', ''))?></a></li>
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
                    <div class="whead"><h6>Edit <?=get_cat_name(set_value('cat_id', ''))?></h6>
                    <div class="clear"></div></div>
                    
					<?//=form_open_multipart('category/create_update')?>
					<form id="edit_cat" class="main" action="<?=base_url('category/edit_cat_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<input type="hidden" name="cat_id" value="<?=set_value('cat_id', '')?>"/>
					<input type="hidden" name="level" value="<?=set_value('level', '')?>"/>
					<input type="hidden" name="main_id" value="<?=set_value('main_id', '')?>"/>
					<input type="hidden" name="sub_id" value="<?=set_value('sub_id', '')?>"/>
					<input type="hidden" name="rank" value="<?=set_value('rank', '')?>"/>
                    <div class="formRow">
                        <div class="grid3"><label>Name:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="name" id="name" value="<?=set_value('name', '')?>"/></div>
                        <div class="clear"></div>
                    </div>
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
						<?
							$back_url = 'category';
							if(isset($sublv1_url))
								$back_url .= '/view/'.$main_url;
							if(isset($sublv2_url))
								$back_url .= '/'.$sublv1_url;
						?>
						<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url($back_url)?>'">
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
