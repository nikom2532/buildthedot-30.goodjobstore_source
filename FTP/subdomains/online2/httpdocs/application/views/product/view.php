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
                <li class="current"><a href="<?=site_url('product')?>">Product</a></li>
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
    	<!-- Table with hidden toolbar -->
        <div class="widget">
            <div class="whead"><h6>Product Groups</h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>Rank</th>
							<th>Code</td>
							<th>Image</th>
							<th>Name</th>
							<th>Public</th>
							<th>Url</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">

						<?php foreach(get_pro_group_list() as $value): ?>
							<tr>
								<td><?=$value->rank?></td>
								<td><?=$value->progroup_id?></td>
								<td align="center">
								<? if (get_primary_img_group($value->progroup_id) == ''): ?>
										<img style="height:25; width:25px;" src=""/>
									<? else: ?>
										<img style="height:50; width:50px;" src="<?=base_url()?><?=get_primary_img_group($value->progroup_id)?>"/>
									<? endif;?>
								</td>
								<td><?=$value->name?></td>
								<td><?=($value->public==1)?'Yes':'No';?></td>
								<td><?=$value->url?></td>
								<td>
									<a href="<?=base_url("product/view/".$value->url)?>" class="tablectrl_small bDefault tipS" title="View">
										<span class="iconb" data-icon="&#xe015;"></span>
									</a>
									<!--
									<a href="<?=base_url("product/group/edit/".$value->url)?>" class="tablectrl_small bDefault tipS" title="Edit">
										<span class="iconb" data-icon="&#xe004;"></span>
									</a>
									-->
									<a href="<?=base_url("product/remove_product_group/$value->url")?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove <?=$value->name?>?');">
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