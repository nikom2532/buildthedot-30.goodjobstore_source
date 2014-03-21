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
				 <li class="current"><a href="<?=site_url('shipping/view/'.$shipping_detail->shipping_id)?>"><?=$shipping_detail->name?></a></li>
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
		<div class="fluid">
					<div class="widget grid12">
						<div class="whead">
							<h6>Shipping Detials</h6>
							<h6 style=" float:right;"><a href="<?=base_url("shipping/edit/".$shipping_detail->shipping_id)?>" class="buttonS bRed" style="color:white;">Edit</a></h6>
							<div class="clear"></div>
						</div>
						<div class="body">
							<div class="grid3" style="display:none;"></div>
							<div class="grid3" style="font-weight:bold;">Shipping ID:</div>
								<div class="grid3"><?=$shipping_detail->shipping_id?></div><br>
							<div class="grid3" style="font-weight:bold;">Name:</div>
								<div class="grid3"><?=$shipping_detail->name?></div><br>
							<div class="grid3" style="font-weight:bold;">Description:</div>
								<div class="grid3"><?=$shipping_detail->description?></div><br>	
						</div>
					</div>
				</div>
	</div>
	
	<!-- Table with hidden toolbar -->
	<div class="wrapper">
	   <div class="widget">
            <div class="whead"><h6><?=$shipping_detail->name?></h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>Range id </th>
							<th>Shipping id</th>
							<th>Weight Min</th>
							<th>Weight Max</th>
							<th>Price</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?php foreach(get_shipping_range_from_id($shipping_detail->shipping_id) as $value): ?>
							<tr>
								<td><?=$value->range_id?></td>
								<td><?=$value->shipping_id?></td>
								<td><?=$value->weight_min?></td>
								<td><?=$value->weight_max?></td>
								<td><?=$value->price?></td>
								<td>
									<a href="<?=base_url("shipping/range/".$value->range_id."/edit")?>" class="tablectrl_small bDefault tipS" title="Edit"><span class="iconb" data-icon="&#xe004;"></span></a>
									<a href="<?=base_url("shipping/delete_shipping_range/".$value->range_id)?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove range id <?=$value->range_id?>?');">
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
