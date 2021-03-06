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
                <li class="current"><a href="<?=site_url('shipping')?>">Shipping</a></li>
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
            <div class="whead"><h6>Shipping</h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?php foreach(get_shipping_list() as $value): ?>
							<tr>
								<td><?=$value->shipping_id?></td>
								<td><?=$value->name?></td>
								<td>
									<a href="<?=base_url("shipping/view/".$value->shipping_id)?>" class="tablectrl_small bDefault tipS" title="View"><span class="iconb" data-icon="&#xe015;"></span></a>
									<a href="<?=base_url("shipping/delete/".$value->shipping_id)?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove shipping name <?=$value->name?>?');">
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
