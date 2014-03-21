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
				<li><a href="<?=base_url("product/view/".$group_detail->url)?>"><?=$group_detail->name?></a></li>
				<li class="current"><a href="<?=base_url("product/view/".$group_detail->url."/".$product_detail->product_id)?>"><?=$product_detail->name?></a></li>
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
							<h6>Product Detials</h6>
							<h6 style=" float:right;"><a href="<?=base_url('product/view/'.$group_detail->url.'/'.$product_detail->product_id.'/edit')?>" class="buttonS bRed" style="color:white;">Edit</a></h6>
							<div class="clear"></div>
						</div>
						<div class="body">
							<div class="grid3" style="display:none;"></div>
							<div class="grid3" style="font-weight:bold;">Product ID:</div>
								<div class="grid3"><?=$product_detail->product_id?></div><br>
							<div class="grid3" style="font-weight:bold;">Property:</div>
								<div class="grid3"><?=get_property_name($product_detail->prop_id)?></div><br>
							<div class="grid3" style="font-weight:bold;">Color:</div>
								<div class="grid3"><?=get_color_name($product_detail->color_id)?></div><br>
							<div class="grid3" style="font-weight:bold;">Attribute:</div>
								<div class="grid3"><?=get_attribute_name($product_detail->attribute_id)?></div><br>
							<div class="grid3" style="font-weight:bold;">Name:</div>
								<div class="grid3"><?=$product_detail->name?></div><br>
							<div class="grid3" style="font-weight:bold;">Size:</div>
								<div class="grid3"><?=$product_detail->size?></div><br>
							<div class="grid3" style="font-weight:bold;">Weight:</div>
								<div class="grid3"><?=$product_detail->weight?> Kg.</div><br>
							<div class="grid3" style="font-weight:bold;">Price:</div>
								<div class="grid3"><?=$product_detail->price?> Bath</div><br>	
							<div class="grid3" style="font-weight:bold;">Discount:</div>
								<div class="grid3">
									<?=$product_detail->discount?> &nbsp;
									<?=($product_detail->discount_type==1)?'Percent':'Bath';?>
								</div><br>
							<div class="grid3" style="font-weight:bold;">Qty:</div>
								<div class="grid3"><?=$product_detail->qty?></div><br>
							<div class="grid3" style="font-weight:bold;">Description:</div>
								<div class="grid3"><?=$product_detail->description?></div><br>
							<div class="grid3" style="font-weight:bold;">Flag:</div>
								<?if ($product_detail->flag == 1):?>	
									<div class="grid3">Hot</div><br>
								<? elseif ($product_detail->flag == 2): ?>
									<div class="grid3">New</div><br>
								<? else: ?>
									<div class="grid3">Sale</div><br>
								<?endif;?>
							<div class="grid3" style="font-weight:bold;">Public:</div>
							<?if ($product_detail->public == 1):?>	
								<div class="grid3">Yes</div><br>
							<? else: ?>
								<div class="grid3">NO</div><br>
							<?endif;?>
							
						</div>
					</div>
				</div>
	
    	<!-- Table with hidden toolbar -->
        <div class="widget">
            <div class="whead"><h6><?=$product_detail->name?></h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>rank</th>
							<th>Image</th>
							<th>Primary</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?php foreach(get_product_img_from_id($product_detail->product_id) as $value): ?>
							<tr>
								<td><?=$value->rank?></td>
								<td align="center">
									<? if ($value->path == NULL): ?>
										<img style="height:25; width:25px;" src=""/>
									<? else: ?>
										<img style="height:50; width:50px;" src="<?=base_url()?><?=$value->path?>"/>
									<? endif;?>
								</td>
								<td><?=($value->primary==1)?'Yes':'No';?></td>
								<td>
									<a href="<?=base_url("product/remove_image/$value->id/$group_detail->url/$product_detail->product_id")?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove this image?');">
										<span class="iconb" data-icon="&#xe096;"></span>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
	</div>
	<!-- Main content ends -->
</div>
<!-- Content ends --> 