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
                <li class="current"><a href="<?=site_url('admin')?>">Admin</a></li>
            </ul>
        </div> 
    </div>
		<!-- messages -->
			<?php
           		if($this->session->flashdata('message'))
               	{
                	$msg = $this->session->flashdata('message');
              	}
			?>
			<?php if(isset($msg)): ?>
				<div class="nNote nSuccess"><p><?=$msg['message']?></p></div>
			<?php endif;?>
			<!-- end messages -->
    <!-- Main content -->
    <div class="wrapper">
    	<!-- Rounded buttons -->
        <fieldset>
			<div class="widget fluid">
				<div class="whead">
					<h6>Profile</h6>
					<span class="edit"><a href="<?=base_url('admin/profile')?>" class="buttonS bRed" style="color:white;">Edit</a></span>
                    <div class="clear"></div>
				</div>
                    
                <div class="formRow">
					<div class="grid3"><img style="height:200px; width:196px;" src="<?=base_url()?><?=($user->pic=='')?'public/images/users/userLogin2.png':$user->pic;?>" /></div>
                    <div class="clear"></div>
				</div>
                <div class="formRow">
					<div class="grid3"><label>First Name:</label></div>
                    <div class="grid3"><?=$user->firstname?></div>
                    <div class="clear"></div>
				</div>
                <div class="formRow">
					<div class="grid3"><label>Last Name:</label></div>
                    <div class="grid3"><?=$user->lastname?></div>
                    <div class="clear"></div>
				</div>
				
                <div class="formRow">
					<div class="grid3"><label>Position:</label></div>
                    <div class="grid3"><?=get_position_name($user->position_id, 1)?></div>
                    <div class="clear"></div>
				</div>
					
                <div class="formRow">
					<div class="grid3"><label>Address:</label></div>
                    <div class="grid3"><?=$user->address?></div>
                    <div class="clear"></div>
				</div>
					
                <div class="formRow">
					<div class="grid3"><label>Phone Number:</label></div>
                    <div class="grid3"><?=$user->phone?></div>
                    <div class="clear"></div>
				</div>

                <div class="formRow">
					<div class="grid3"><label>Email:</label></div>
                    <div class="grid3"><?=$user->email?></div>
                    <div class="clear"></div>
				</div>
			</div>
		</fieldset>
            
        <div class="widget">
            <div class="whead"><h6>Manage Admins</h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Position</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">
			 			<?php foreach(get_admin_list() as $value): ?>
							<tr>
								<td><?=$value->admin_id?></td>
								<td><?=$value->firstname?> <?=$value->lastname?></td>
								<td><?=$value->email?></td>
								<td><?=get_position_name($value->position_id, 1)?></td>
								<td>
									<a href="<?=base_url("admin/view/$value->admin_id")?>" class="tablectrl_small bDefault tipS" title="View">
										<span class="iconb" data-icon="&#xe015;"></span>
									</a>
									<a href="<?=base_url("admin/edit/$value->admin_id")?>" class="tablectrl_small bDefault tipS" title="Edit">
										<span class="iconb" data-icon="&#xe004;"></span>
									</a>
									<a href="<?=base_url("admin/admin_delete/$value->admin_id")?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove admin id <?=$value->admin_id?>?');">
										<span class="iconb" data-icon="&#xe096;"></span>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- Main content ends -->
</div>
<!-- Content ends -->    
