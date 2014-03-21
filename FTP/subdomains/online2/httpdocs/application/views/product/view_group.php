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
				<li class="current"><a href="<?=base_url("product/view/".$group_detail->url)?>"><?=$group_detail->name?></a></li>
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
		<!-- product group details -->
		<div class="fluid">
					<div class="widget grid12">
						<div class="whead">
							<h6>Product Group Detials</h6>
							<h6 style=" float:right;"><a href="<?=base_url('product/group/edit/'.$group_detail->url)?>" class="buttonS bRed" style="color:white;">Edit</a></h6>
							<div class="clear"></div>
						</div>
						<div class="body">
							<div class="grid3" style="display:none;"></div>
							<div class="grid3" style="font-weight:bold;">Product Code:</div>
								<div class="grid3"><?=$group_detail->progroup_id?></div><br>
							<div class="grid3" style="font-weight:bold;">Name:</div>
								<div class="grid3"><?=$group_detail->name?></div><br>
							<div class="grid3" style="font-weight:bold;">Public:</div>
							<?if ($group_detail->public == 1):?>	
								<div class="grid3">Yes</div><br>
							<? else: ?>
								<div class="grid3">NO</div><br>
							<?endif;?>
							<div class="grid3" style="font-weight:bold;">Url:</div>
								<div class="grid3"><?=$group_detail->url?></div><br>
							<div class="grid3" style="font-weight:bold;">Title:</div>
								<div class="grid3"><?=$group_detail->title?></div><br>
							<div class="grid3" style="font-weight:bold;">Meta Keyword:</div>
								<div class="grid3"><?=$group_detail->meta_keyword?></div><br>
							<div class="grid3" style="font-weight:bold;">Meta Description:</div>
								<div class="grid3"><?=$group_detail->meta_description?></div><br>
						</div>
					</div>
				</div>
	
    	<!-- Table with hidden toolbar -->
        <div class="widget">
            <div class="whead"><h6><?=$group_detail->name?></h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>ID</th>
							<th>Image</th>
							<th>Name</th>
							<th>Attribute</th>
							<th>Price</th>
							<th>Qty</th>
							<th>Public</th>
							<th>Property</th>
							<th>Color</th>
							<th>Primary</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?php foreach(get_product_from_group_name($group_detail->url) as $value): ?>	
							<tr>
								<td><?=$value->product_id?></td>
								<td align="center">
									<? if (get_primary_img_from_id($value->product_id) == ''): ?>
										<img style="height:25; width:25px;" src=""/>
									<? else: ?>
										<img style="height:50; width:50px;" src="<?=base_url()?><?=get_primary_img_from_id($value->product_id)?>"/>
									<? endif;?>
								</td>
								<td><?=$value->name?></td>
								<td><?=get_attribute_name($value->attribute_id)?></td>
								<td><?=$value->price?></td>
								<td><?=$value->qty?></td>
								<td><?=($value->public==1)?'Yes':'No';?></td>
								<td><?=get_property_name($value->prop_id)?></td>
								<td><?=get_color_name($value->color_id)?></td>
								<td><?=($value->primary==1)?'Yes':'No';?></td>
								<td>
									
									<a href="<?=base_url("product/view/".$group_detail->url."/".$value->product_id)?>" class="tablectrl_small bDefault tipS" title="list"><span class="iconb" data-icon="&#xe015;"></span></a>
									<a href="<?=base_url("product/remove_product/$value->product_id/$group_detail->url")?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove <?=$value->name?>?');">
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