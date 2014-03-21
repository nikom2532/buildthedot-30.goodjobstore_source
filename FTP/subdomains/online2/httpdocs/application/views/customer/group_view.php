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
		echo $this->load->view('customer/left_menu');
	?>
</div>
<!-- Sidebar ends -->

<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('customer/top_menu');?>
    
    <!-- Breadcrumbs line -->
	<div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?=site_url('customer')?>">Customer</a></li>
                <li><a href="<?=site_url('customer/group')?>">Groups</a></li>
                <li class="current"><a href="<?=site_url('customer/group/'.$cusgroup_detail->name)?>"><?=$cusgroup_detail->name?></a></li>
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
		<!-- customer view -->
                    
            <div class="tab_content">
				<!-- contact address -->
        		<div class="fluid">
					<div class="widget grid12">
						<div class="whead">
							<h6>Detail</h6>
							<h6 style=" float:right;">
								<a href="<?=base_url('customer/group/edit/'.$cusgroup_detail->name)?>" class="buttonS bRed" style="color:white;">Edit</a>
							</h6>
							<div class="clear"></div>
						</div>
						<div class="body">
							<table class="tableDetail">
								<tbody>
									<tr>
										<td class="firstColumn">Group:</td>
										<td><?=$cusgroup_detail->name?></td>
									</tr>
									<tr>
										<td class="firstColumn">Description:</td>
										<td><?=$cusgroup_detail->description?>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
                    
                <!-- member list -->
				<!-- Table with hidden toolbar -->
				<div class="widget">
					<div class="whead">
						<h6>Member List</h6>
						<h6 style=" float:right;"><a href="<?=base_url('customer/group/member/edit/'.$cusgroup_detail->name)?>" class="buttonS bRed" style="color:white;  margin-right:40px;">Edit</a></h6>
						<div class="clear"></div></div>
						<div id="dyn" class="hiddenpars">
							<a class="tOptions1" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
							<table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th class="th2">Actions</th>
									</tr>
								</thead>
								<tbody id="field_id">
									<?php foreach(get_group_member_list($cusgroup_detail->cusgroup_id) as $value): ?>
										<tr>
											<td><?=$value->cus_id?></td>
											<td><?=$value->firstname?>&nbsp;<?=$value->lastname?></td>
											<td><?=$value->email?></td>
											<td>
												<a href="<?=base_url("customer/profile/$value->cus_id")?>" class="tablectrl_small bDefault tipS" title="View"><span class="iconb" data-icon="&#xe015;"></span></a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
				</div>
				
			</div>
	</div>
	<!-- Main content ends -->
    
</div>
<!-- Content ends -->    