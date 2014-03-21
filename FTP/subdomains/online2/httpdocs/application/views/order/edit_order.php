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
				<li class="current"><a href="<?=site_url('order/create')?>">Edit</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
		 <!-- messages -->
			<?php echo validation_errors('<div class="nNote nFailure"><p>', '</p></div>'); ?>
		<!-- end messages -->
    <!-- Main content -->
	<div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu', 'class=main')?>
			<fieldset>
				<!------------------------------------------------------>
				<!------------------ order ------------------->
				<!------------------------------------------------------>
				<div class="widget fluid">
					<div class="whead">
						<h6>Edit Order</h6>
						<div class="clear"></div>
					</div>
					<?//=form_open_multipart('customer/billing_update')?>
					<form id="edit_order" class="main" action="<?=base_url('order/edit_order_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<div class="formRow">
							<div class="grid3"><label>Order ID:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="cus_id" id="cus_id" value="<?=set_value('order_id', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Customer ID:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="cus_id" id="cus_id" value="<?=set_value('cus_id', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Price:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="price" id="price" value="<?=set_value('price', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Discount Price:</label></div>
							<div class="grid3"><input type="text" name="discount_price" id="discount_price" value="<?=set_value('discount_price', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Coupon Code:</label></div>
							<div class="grid3"><input type="text" name="coupon_code" id="coupon_code" value="<?=set_value('coupon_code', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Discount Coupon:</label></div>
							<div class="grid3"><input type="text" name="discount_coupon" id="discount_coupon" value="<?=set_value('discount_coupon', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Total Price:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="total_price" id="total_price" value="<?=set_value('total_price', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Total Weight:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="total_weight" id="total_weight" value="<?=set_value('total_weight', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Shipping Method:<span class="req">*</span></label></div>
							<div class="grid3">
							<select name="shipping_id" id="shipping_id" class="styled">
									<option value=''>------ Select Shipping -----</option>
									<?php foreach(get_shipping_list() as $value): ?>
										<option value="<?=$value->shipping_id?>" <?=set_select('shipping_id',$value->shipping_id)?>><?=$value->name?></option>
									<?php endforeach; ?>
							</select>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Shipping Price:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="shipping_price" id="shipping_price" value="<?=set_value('shipping_price', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Final Price:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="final_price" id="final_price" value="<?=set_value('final_price', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Order Status:</label></div>
							<div class="grid3">
							<!--<?=var_dump($value)?>-->
							<select name="order_status" id="order_status" class="styled">
									<option value=''>------ Select Order Status -----</option>
									<?php foreach(order_status_list() as $value): ?>
										<option value="<?=$value['status_id']?>" <?=set_select('order_status',$value['status_id'])?>><?=$value['order_status']?></option>
									<?php endforeach;?>
							</select>
							</div>
							<div class="clear"></div>
						</div>
						
						<div class="formRow">
							<div class="grid3"><label>Shipping Number:</label></div>
							<div class="grid3"><input type="text" name="shipping_number" id="shipping_number" value="<?=set_value('shipping_number', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("customer/profile/".set_value('cus_id', ''))?>'">
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