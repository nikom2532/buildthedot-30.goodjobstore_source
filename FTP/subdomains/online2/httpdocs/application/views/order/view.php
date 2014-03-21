<!-- Sidebar begins -->
<div id="sidebar">
    <!-- Left nav -->
	<?=$this->load->view('order/left_menu');?>
</div>
<!-- Sidebar ends -->

<!-- Content begins -->    
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('order/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
                <li class="current"><a href="<?=site_url('order')?>">Order</a></li>
            </ul>
            <div class="clear"></div>
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
            <div class="whead"><h6>Orders</h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>Order</th>
							<th>Billing Name</th>
							<th>Shipping Name</th>
							<th>Final price</th>
							<th>status</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?php foreach(get_order_list() as $value): ?>
							<tr>
								<td><?=$value->order_id?></td>
								<td><?=get_bill_name_from_order_id($value->order_id)?></td>
								<td><?=get_ship_name_from_order_id($value->order_id)?></td>
								<td><?=$value->final_price?></td>
								<td><?=get_order_status($value->order_status)?></td>
								<td>
									
									<a href="<?=base_url("order/view/".$value->order_id)?>" class="tablectrl_small bDefault tipS" title="View"><span class="iconb" data-icon="&#xe015;"></span></a>
									<!--
									<a href="<?=base_url("")?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove customer id <?=$value->order_id?>?');">
										<span class="iconb" data-icon="&#xe096;"></span>
									</a>-->
									<a href="<?=base_url("order/order_delete/".$value->order_id)?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove order id <?=$value->order_id?>?');">
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