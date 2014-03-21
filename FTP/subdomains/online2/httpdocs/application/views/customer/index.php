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
                <li class="current"><a href="<?=site_url('customer')?>">Customer</a></li>
            </ul>
        </div> 
    </div>
    <!--<?=($success=='')?'':'<div class="nNote nSuccess"><p>'.$success.'</p></div>';?>-->
    <!-- Main content -->
    <div class="wrapper">
    	<!-- Table with hidden toolbar -->
        <div class="widget">
            <div class="whead"><h6>Customers</h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Telephone</th>
							<th>Postcode</th>
							<th>Country</th>
							<th>State/Province</th>
							<th>Customer Since</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?php foreach(get_customer_list() as $value): ?>
							<tr>
								<td><?=$value->cus_id?></td>
								<td><?=$value->firstname?>&nbsp;<?=$value->lastname?></td>
								<td><?=$value->email?></td>
								<td><?=$value->phone?></td>
								<td><?=$value->postcode?></td>
								<td><?=get_country_name($value->country_id, '1')?></td>
								<td><?=get_city_name($value->city_id, '1')?></td>
								<td><?=set_dateTime($value->create_at)?></td>
								<td>
									<a href="<?=base_url("customer/profile/$value->cus_id")?>" class="tablectrl_small bDefault tipS" title="View"><span class="iconb" data-icon="&#xe015;"></span></a>
									<a href="<?=base_url("customer/customer_delete/$value->cus_id")?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove customer id <?=$value->cus_id?>?');">
										<span class="iconb" data-icon="&#xe096;"></span>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</fieldset>
	</div>
	<!-- Main content ends -->
    
</div>
<!-- Content ends -->    
