<?php
	if(LANG==1)
		$user = $this->session->userdata('user');
	else
		$user = get_user_lang($this->session->userdata('user')->admin_id);
?>

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
                <li class="current"><a href="<?=base_url("category/view/".$main_url)?>"><?=get_main_category_name($main_url)?></a></li>
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
            <div class="whead">
				<h6><?=get_main_category_name($main_url)?></h6>
				<div class="clear"></div>
			</div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>Rank</th>
							<th>Name</th>
							<th>Public</th>
							<th>Url</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?php foreach(get_category_sub_list_from_name($main_url) as $value): ?>
							<tr>
								<td><?=$value->rank?></td>
								<td><?=$value->name?></td>
								<td><?=($value->public==1)?'Yes':'No';?></td>
								<td><?=$value->url?></td>
								<td>
									<a href="<?=base_url("category/view/".$main_url."/".$value->url)?>" class="tablectrl_small bDefault tipS" title="View Sub">
										<span class="iconb" data-icon="&#xe015;"></span>
									</a>
									<a href="<?=base_url("category/edit/".$main_url."/".$value->url)?>" class="tablectrl_small bDefault tipS" title="Edit Sub">
										<span class="iconb" data-icon="&#xe004;"></span>
									</a>
										<a href="<?=base_url("category/sublv1_delete/$value->cat_id")?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove category name <?=$value->name?>?');">
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
