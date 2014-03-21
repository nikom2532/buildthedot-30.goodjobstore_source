<?php
	$user = $this->session->userdata('user');
?>

<!-- Sidebar begins -->
<div id="sidebar">
    <!-- Left nav -->
	<?=$this->load->view('payment/left_menu');?>
</div>
<!-- Sidebar ends -->
	
    
<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('payment/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?=site_url('payment')?>">Payment</a></li>
				<li><a href="<?=base_url("payment/view/".$payment_id)?>"><?=get_payment_name($payment_id)?></a></li>
				<li class="current"><a href="<?=site_url('payment/edit/'.$payment_id)?>">Edit</a></li>
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
                    <div class="whead"><h6>Edit <?=get_payment_name($payment_id)?></h6>
                    <div class="clear"></div></div>
                    
					<?//=form_open_multipart('preference/create_keyword_update')?>
					<form id="edit_payment" class="main" action="<?=base_url('payment/edit_payment_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<input type="hidden" name="payment_id" value="<?=$payment_id?>"/>
					<input type="hidden" name="path" value="<?=set_value('path', '')?>" />
					<div class="formRow">
                        <div class="grid3"><img style="height:200px; width:196px;" src="<?=base_url()?><?=set_value('path', '')?>" /></div>
						<div class="grid3"><input type="file" name="userfile" class="styled"></div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
                        <div class="grid3"><label>Name:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="name" id="name" value="<?=set_value('name', '')?>"/></div>
                        <div class="clear"></div>
                    </div>
					 <div class="formRow">
                        <div class="grid3"><label>Description:</label></div>
                        <div class="grid9"><textarea rows="8" name="description" id="description"><?=set_value('description', '')?></textarea></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <div class="grid3"><label>Public:</label></div>
                        <div class="grid3 check"><input type="checkbox" name="public" value="1" <?=set_checkbox('public', '1')?>> Yes</div>
                        <div class="clear"></div>
                    </div>
					
                    <div class="formRow">
						<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("payment")?>'">
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
