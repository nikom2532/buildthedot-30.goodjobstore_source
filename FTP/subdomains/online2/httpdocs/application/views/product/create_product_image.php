<?php
	if(LANG==1)
		$user = $this->session->userdata('user');
	else
		$user = get_user_lang($this->session->userdata('user')->admin_id);
?>

<!-- Sidebar begins -->
<div id="sidebar">
    <!-- Left nav -->
	<?=$this->load->view('product/left_menu');?>
</div>
<!-- Sidebar ends -->

<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('product/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?=site_url('product')?>">Product</a></li>
				<li><a href="<?=base_url("product/view/".$group_detail->url)?>"><?=$group_detail->name?></a></li>
				<li><a href="<?=base_url("product/view/".$group_detail->url."/".$product_detail->product_id)?>"><?=$product_detail->name?></a></li>
                <li class="current"><a href="<?=site_url('product/view/'.$group_detail->url."/".$product_detail->product_id.'/create')?>">Add Images</a></li>
            </ul>
        </div> 
    </div>
		<?=(isset($ermsg))?'<div class="nNote nFailure"><p>'.$ermsg.'</p></div>':'';?>
		<?=(isset($ermsg2))?'<div class="nNote nFailure"><p>'.$ermsg2.'</p></div>':'';?>
		<?=(isset($ermsg3))?'<div class="nNote nFailure"><p>'.$ermsg3.'</p></div>':'';?>
    <!-- Main content -->
    <div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu', 'class=main')?>
            <fieldset>
                <div class="widget fluid">
                    <div class="whead"><h6>Add Image <?=$product_detail->name?></h6>
                    <div class="clear"></div></div>
                    
					<?//=form_open_multipart('product/create_update')?>
                    <form id="create_product_test" class="main" action="<?=base_url('product/create_product_image_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<input type="hidden" name="progroup_url" value="<?=$group_detail->url?>"/>
					<input type="hidden" name="product_id" value="<?=$product_detail->product_id?>"/>
					<div class="formRow">
                        <div class="grid3"><label>Image:</label></div>
						<div class="grid3"><input type="file" name="userfile1" class="styled"></div>
                        <div class="clear"></div><br>
						
                        <div class="grid3" style="margin-left:0px;"><label><span class="req"></span></label></div>
						<div class="grid3"><input type="file" name="userfile2" class="styled"></div>
						<div class="clear"></div><br>
						
                        <div class="grid3" style="margin-left:0px;"><label><span class="req"></span></label></div>
						<div class="grid3"><input type="file" name="userfile3" class="styled"></div>
						<div class="clear"></div>
                    </div>
                    <div class="formRow">
						<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("product/view/".$group_detail->url."/".$product_detail->product_id)?>'">
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
