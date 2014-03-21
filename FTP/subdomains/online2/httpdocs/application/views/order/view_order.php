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
                <li ><a href="<?=site_url('order')?>">Order</a></li>
				<li class="current"><a href="<?=site_url('order/view/'.$order_detail->order_id)?>"><?=$order_detail->order_id?></a></li>
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
		<!-- order view -->                    
            <div class="tab_content">
				<!-- order detial -->
        		<div class="fluid">
					<div class="widget grid12">
						<div class="whead">
							<h6>Order</h6>
							<!--<h6 style=" float:right;"><a href="<?=base_url('order/edit/order/'.$order_detail->order_id)?>" class="buttonS bRed" style="color:white;">Edit</a></h6>-->
							<div class="clear"></div>
						</div>
						<div class="body">
							<div class="grid3" style="display:none;"></div>
							<div class="grid3" style="font-weight:bold;">Order ID:</div>
								<div class="grid3"><?=$order_detail->order_id?></div><br>
							<div class="grid3" style="font-weight:bold;">Customer ID:</div>
								<div class="grid3"><?=$order_detail->cus_id?></div><br>
							<div class="grid3" style="font-weight:bold;">Items Price:</div>
								<div class="grid3"><?=($order_detail->price - $order_detail->discount_price)?></div><br>
								<!--
							<div class="grid3" style="font-weight:bold;">Discount Price:</div>
								<div class="grid3" ><?=$order_detail->discount_price?></div><br>
								-->
							<div class="grid3" style="font-weight:bold;">Coupon Code:</div>
								<div class="grid3"><?=($order_detail->coupon_code==NULL)?'-':$order_detail->coupon_code;?></div><br>
							<div class="grid3" style="font-weight:bold;">Discount_coupon:</div>
								<div class="grid3"><?=$order_detail->discount_coupon?></div><br>
							<div class="grid3" style="font-weight:bold;">Total Price:</div>
								<div class="grid3"><?=$order_detail->total_price?></div><br>
							<div class="grid3" style="font-weight:bold;">Total Weight:</div>
								<div class="grid3"><?=$order_detail->total_weight?></div><br>
							<div class="grid3" style="font-weight:bold;">Shipping Price:</div>
								<div class="grid3"><?=$order_detail->shipping_price?></div><br>
							<div class="grid3" style="font-weight:bold;">Final Price:</div>
								<div class="grid3"><?=$order_detail->final_price?></div><br>
							<div class="grid3" style="font-weight:bold;">Order Status:</div>
								<div class="grid3"><?=get_order_status($order_detail->order_status)?></div><br>
							<div class="grid3" style="font-weight:bold;">Shipping Number:</div>
								<div class="grid3"><?=($order_detail->shipping_number==NULL)?'-':$order_detail->shipping_number;?></div><br>
							<div class="grid3" style="font-weight:bold;">Create at:</div>
								<div class="grid3"><?=set_dateTime($order_detail->create_at)?></div><br>
							<div class="grid3" style="font-weight:bold;">Update at:</div>
								<div class="grid3">
									<?=($order_detail->order_update_at > $order_detail->address_update_at)?set_dateTime($order_detail->order_update_at):set_dateTime($order_detail->address_update_at);?>
								</div>
							<br>
							<div class="grid3" style="font-weight:bold;">Update by:</div>
								<div class="grid3">
									<?=($order_detail->order_update_at > $order_detail->address_update_at)?$order_detail->order_update_by:$order_detail->address_update_by;?>
								</div>
							<br>
						</div>
					</div>
				</div>

			<!-- billing&shipping address -->
        		<div class="fluid">
            		<div class="widget grid6">
                		<div class="whead">
							<h6>Payment Information</h6>
							<h6 style=" float:right;"><a href="<?=base_url('order/edit/billing/'.$order_detail->order_id)?>" class="buttonS bRed" style="color:white;">Edit</a></h6>
                   			<div class="clear"></div>
                   		</div>
                		<div class="body">
                			<div class="grid3" style="display:none;"></div>
							<div class="grid3" style="font-weight:bold;">Name:</div>
								<?=$order_address->b_firstname?> <?=$order_address->b_lastname?><br>
							<div class="grid3" style="font-weight:bold;">Address:</div>
								<?=$order_address->b_address?><br>
							<div class="grid3" style="font-weight:bold;">City/Province:</div>
								<?=get_city_name($order_address->b_city_id, '1')?><br>
							<div class="grid3" style="font-weight:bold;">Postcode:</div>
								<?=$order_address->b_postcode?><br>
							<div class="grid3" style="font-weight:bold;">Country:</div>
								<?=get_country_name($order_address->b_country_id, '1')?><br>
							<div class="grid3" style="font-weight:bold;">Phone:</div>
								<?=$order_address->b_phone?><br>
							<div class="grid3" style="font-weight:bold;">Payment Method:</div>
								<?=get_payment_name($order_detail->payment_id);?><br>
						</div>
            		</div>
            		<div class="widget grid6">
                		<div class="whead">
							<h6>Shipping Information</h6>
							<h6 style=" float:right;"><a href="<?=base_url('order/edit/shipping/'.$order_detail->order_id)?>" class="buttonS bRed" style="color:white;">Edit</a></h6>
                       		<div class="clear"></div>
                       	</div>
                		<div class="body">
                		    <div class="grid3" style="display:none;"></div>
							<div class="grid3" style="font-weight:bold;">Name:</div>
								<?=$order_address->s_firstname?> <?=$order_address->s_lastname?><br>
							<div class="grid3" style="font-weight:bold;">Address:</div>
								<?=$order_address->s_address?><br>
							<div class="grid3" style="font-weight:bold;">City/Province:</div>
								<?=get_city_name($order_address->s_city_id, '1')?><br>
							<div class="grid3" style="font-weight:bold;">Postcode:</div>
								<?=$order_address->s_postcode?><br>
							<div class="grid3" style="font-weight:bold;">Country:</div>
								<?=get_country_name($order_address->s_country_id, '1')?><br>
							<div class="grid3" style="font-weight:bold;">Phone:</div>
								<?=$order_address->s_phone?><br>
							<div class="grid3" style="font-weight:bold;">Shipping Method:</div>
								<?=get_select_shipping_name($order_detail->shipping_id);?><br>
						</div>
            		</div>
        		</div>
                    	
			<div class="widget">
            <div class="whead"><h6>Items Ordered</h6>
			<h6 style=" float:right;"><a href="<?=base_url('order/edit/item/'.$order_detail->order_id)?>" class="buttonS bRed" style="color:white;  margin-right:40px;">Edit</a></h6>
			<div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions1" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="dynamic">
					<thead>
						<tr>
							<th>Product id</th>
							<th>Image</th>
							<th>Name</th>
							<th>Property</th>
							<th>Color</th>
							<th>Qty</th>
							<th>Service</th>
							<th>Unit Price</th>
							<th>Total Price</th>
							<!--<th class="th2">Actions</th>-->
						</tr>
					</thead>
					<tbody id="field_id">
						<?php foreach(get_order_item_from_id($order_detail->order_id) as $value): ?>
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
								<td><?=get_property_name($value->prop_id)?></td>
								<td><?=get_color_name($value->color_id)?></td>
								<td><?=$value->qty?></td>
								<td><!--service--></td>
								<td><?=$value->unit_price?></td>
								<td><?=$value->total_price?></td>
								<!--
								<td>
									
									<a href="<?=base_url("")?>" class="tablectrl_small bDefault tipS" title="list"><span class="iconb" data-icon="&#xe015;"></span></a>
									<a href="<?=base_url("")?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove customer id <?=$value->order_item_id?>?');">
										<span class="iconb" data-icon="&#xe096;"></span>
									</a>
								</td>
								-->
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