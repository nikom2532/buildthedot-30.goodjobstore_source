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
                <li><a href="<?=site_url('order')?>">Order</a></li>
                <li><a href="<?=site_url('order/view/'.$order_id)?>"><?=$order_id?></a></li>
				<li class="current"><a href="<?=site_url('order/edit/item/'.$order_id)?>">Edit Order Items</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
		 <!-- messages -->
			<?=(isset($er_str))?'<div class="nNote nFailure"><p>'.$er_str.'</p></div>':'';?>
		<!-- end messages -->
    <!-- Main content -->
    <div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu', 'class=main')?>
			<fieldset>
				<div class="widget fluid">
					<div class="whead">
						<h6>Edit Order Items</h6>
						<div class="clear"></div>
					</div>

					<form id="form" action="<?=base_url('order/edit_order_item_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<?//=form_open_multipart('customer/groupMember_update')?>
						<input type="hidden" name="order_id" value="<?=$order_id?>"/>
						<input type="hidden" name="name" value="<?=set_value('name', '')?>"/>
						<div id="dyn" class="hiddenpars">
							<a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
							<table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
							<thead>
							<tr>
							<th class="th2">Select</th>
							<th>ID</th>
							<th>Image</th>
							<th>Name</th>
							<th>Property</th>
							<th>Color</th>
							<th>Attribute</th>
							<th>Unit Price</th>
							<th>Qty</th>
							<!--<th>Public</th>-->
							<th>Item Qty</th>
							</tr>
					</thead>
					<tbody id="field_id">
					<?
						//---- check item list in order ----
						foreach($item_list as $value)
						{
							$order_item = array($value->product_id => $value->qty);
							if(!isset($order_item_list))
								$order_item_list = $order_item;
							else
								$order_item_list = array_merge($order_item_list, $order_item);
						}
					?>
						<?php foreach(get_product_list() as $value): ?>	
							<tr>
								<td>
									<input type="checkbox" name="check[]" value="<?=$value->product_id?>" <?=(isset($order_item_list[$value->product_id]))?'checked':'';?>>
								</td>
								<td><?=$value->product_id?></td>
								<td align="center">
									<? if (get_primary_img_from_id($value->product_id) == ''): ?>
										<img style="height:25; width:25px;" src=""/>
									<? else: ?>
										<img style="height:50; width:50px;" src="<?=base_url()?><?=get_primary_img_from_id($value->product_id)?>"/>
									<? endif;?>
								</td>
								<td><?=$value->name?></td>
								<td><?=get_property_name($value->prop_id)?></td>
								<td><?=get_color_name($value->color_id)?></td>
								<td><?=get_attribute_name($value->attribute_id)?></td>
								<td>
									<?
										if($value->discount_type==1)
											$unit_price = $value->price - (($value->price * $value->discount)/100);
										else if($value->discount_type==2)
											$unit_price = $value->price - $value->discount;
										else
											$unit_price = $value->price;
									?>
									<?=$unit_price?>
								</td>
								<td><?=$value->qty?></td>
								<!--<td><?=($value->public==1)?'Yes':'No';?></td>-->
								<td align="center">
									<input class="grid2" type="text" id="<?=$value->product_id?>" name="<?=$value->product_id?>"
									value="<?=(isset($order_item_list[$value->product_id]))?$order_item_list[$value->product_id]:'0';?>"/>
								</td>	
							</tr>
							<?php endforeach; ?>
							</tbody>
							</table>
						<div class="formRow">
							<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url('order/view/'.$order_id)?>'">
							<input type="submit" name ="submit" class="buttonS bLightBlue formSubmit" style="margin-right:10px" value="SUBMIT">
							<div class="clear"></div>
						</div>
					<?//=form_close()?>
						</form>
				</div>
		</fieldset>
	</div>
	<!-- Main content ends -->
    
</div>
<!-- Content ends -->