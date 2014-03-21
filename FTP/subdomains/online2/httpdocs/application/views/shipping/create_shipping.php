<?php
	if(LANG==1)
		$user = $this->session->userdata('user');
	else
		$user = get_user_lang($this->session->userdata('user')->admin_id);
?>

<!-- Sidebar begins -->
<div id="sidebar">
    <!-- Left nav -->
	<?
		echo $this->load->view('shipping/left_menu');
	?>
</div>
<!-- Sidebar ends -->

<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('shipping/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('shipping')?>">Shipping</a></li>
				<li class="current"><a href="<?=site_url('shipping/create')?>">Add Shipping</a></li>
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
                    <div class="whead"><h6>Add Shipping</h6>
                    <div class="clear"></div></div>
                    
					<?//=form_open_multipart('preference/create_keyword_update')?>
					<form id="create_shipping" class="main" action="<?=base_url('shipping/create_shipping_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                
					<div class="formRow">
                        <div class="grid3"><label>Name:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="name" id="name" value="<?=set_value('name', '')?>"/></div>
                        <div class="clear"></div>
                    </div>
					 <div class="formRow">
                        <div class="grid3"><label>Description:</label></div>
                        <div class="grid9"><textarea rows="8" name="description" id="description" <?=set_value('description', '')?>></textarea></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
						<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("shipping")?>'">
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
