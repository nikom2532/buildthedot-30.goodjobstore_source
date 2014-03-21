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
				<li><a href="<?=site_url('shipping/view/'.$shipping_id)?>"><?=get_shipping_name($shipping_id)?>	</a></li>
				<li class="current"><a href="<?=site_url("shipping/range/".$range_id."/edit")?>"><?=get_select_shipping_range($range_id)->weight_min?> - <?=get_select_shipping_range($range_id)->weight_max?></a></li>
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
                    <div class="whead"><h6>Edit Shipping Range</h6>
                    <div class="clear"></div></div>
                    
					<?//=form_open_multipart('preference/create_keyword_update')?>
					<form id="edit_shipping_range" class="main" action="<?=base_url('shipping/edit_shipping_range_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <input type="hidden" name="range_id" value="<?=$range_id?>"/>
					<div class="formRow">
                            <div class="grid3"><label>Weight Min:<span class="req">*</span></label></div>
                            <div class="grid9">
                                <div class="floatL mr10"><input type="text" id="weight_min" name="weight_min" value="<?=set_value('weight_min', '')?>" /></div>
                            </div>
                     </div>
					<div class="formRow">
                            <div class="grid3"><label>Weight Max:<span class="req">*</span></label></div>
                            <div class="grid9">
                                <div class="floatL mr10"><input type="text" id="weight_max" name="weight_max" value="<?=set_value('weight_max', '')?>" /></div>
                            </div>
                    </div>
					<div class="formRow">
                        <div class="grid3">
                        	<label>Price:<span class="req">*</span></label>
                        </div>
                         <div class="grid9">
                                <div class="floatL mr10">
                                <input type="text" id="price" name="price" value="<?=set_value('price', '')?>" />
                                </div>					
                         </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
						<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("shipping/view/".$shipping_id)?>'">
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
