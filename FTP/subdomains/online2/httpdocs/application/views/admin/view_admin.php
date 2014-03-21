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
		echo $this->load->view('admin/left_menu');
	?>
</div>
<!-- Sidebar ends -->
	

<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('admin/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?=site_url('admin')?>">Admin</a></li>
				<li class="current"><a href="<?=site_url('admin/view/'.$admin_detail->admin_id)?>">Profile <?=$admin_detail->admin_id?> </a></li>
            </ul>
        </div> 
    </div>  
    <!-- Main content -->
    <div class="wrapper">
		<!-- product group details -->
		<div class="wrapper">
    	<!-- Rounded buttons -->
        <fieldset>
			<div class="widget fluid">
				<div class="whead">
					<h6>Profile <?=$admin_detail->admin_id?></h6>
					<!--<span class="edit"><a href="<?//=base_url('admin/profile')?>" class="buttonS bRed" style="color:white;">Edit</a></span>-->
                    <div class="clear"></div>
				</div>
                    
                <div class="formRow">
					<div class="grid3"><img style="height:200px; width:196px;" src="<?=base_url()?><?=($admin_detail->pic=='')?'public/images/users/userLogin2.png':$admin_detail->pic;?>" /></div>
                    <div class="clear"></div>
				</div>
                <div class="formRow">
					<div class="grid3"><label>First Name:</label></div>
                    <div class="grid3"><?=$admin_detail->firstname?></div>
                    <div class="clear"></div>
				</div>
                <div class="formRow">
					<div class="grid3"><label>Last Name:</label></div>
                    <div class="grid3"><?=$admin_detail->lastname?></div>
                    <div class="clear"></div>
				</div>
				
                <div class="formRow">
					<div class="grid3"><label>Position:</label></div>
                    <div class="grid3"><?=get_position_name($admin_detail->position_id, 1)?></div>
                    <div class="clear"></div>
				</div>
					
                <div class="formRow">
					<div class="grid3"><label>Address:</label></div>
                    <div class="grid3"><?=$admin_detail->address?></div>
                    <div class="clear"></div>
				</div>
					
                <div class="formRow">
					<div class="grid3"><label>Phone Number:</label></div>
                    <div class="grid3"><?=$admin_detail->phone?></div>
                    <div class="clear"></div>
				</div>

                <div class="formRow">
					<div class="grid3"><label>Email:</label></div>
                    <div class="grid3"><?=$admin_detail->email?></div>
                    <div class="clear"></div>
				</div>
			</div>
		</fieldset>
	<!-- Main content ends -->
</div>
<!-- Content ends -->    
