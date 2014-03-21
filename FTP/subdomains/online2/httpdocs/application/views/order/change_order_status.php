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
				<li><a href="<?=site_url('order/view/'.$order_status_detail->order_id)?>"><?=$order_status_detail->order_id?></a></li>
				<li class="current"><a href="<?=site_url('order/status/'.$order_status_detail->order_id)?>">Change Status</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    
    <!-- Main content -->
	<div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu', 'class=main')?>
		<fieldset>
	        <div class="widget fluid">
				<div class="whead">
					<h6><?=$order_status_detail->order_id?> Change Status</h6>
					<div class="clear"></div>
				</div>
						
				<?//=form_open_multipart('preference/create_keyword_update')?>
				<form id="change_order_status" class="main" action="<?=base_url('order/change_order_status_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<input type="hidden" name="order_id" value="<?=$order_status_detail->order_id?>"/>
					<div class="formRow">
						<div class="grid3"><label>Status:<span class="req">*</span></label></div>
                        <div class="grid3">
							<select name="order_status" id="order_status">
								<option value=''>------ Select Status -----</option>
								<option value="1" <?=($order_status_detail->order_status==1)?'selected':'';?>>Pending</option>
								<option value="2" <?=($order_status_detail->order_status==2)?'selected':'';?>>Payment Received</option>
								<option value="3" <?=($order_status_detail->order_status==3)?'selected':'';?>>Shipped</option>
								<option value="4" <?=($order_status_detail->order_status==4)?'selected':'';?>>Refund</option>
								<option value="5" <?=($order_status_detail->order_status==5)?'selected':'';?>>Cancel</option>
							</select>
						</div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<div class="grid3"><label>Shipping Number</label></div>
						<div class="grid3"><input type="text" name="shipping_number" id="shipping_number" value="<?=$order_status_detail->shipping_number?>"/></div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
						<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("order/view/".$order_status_detail->order_id)?>'">
						<input type="submit" name ="submit" class="buttonS bLightBlue formSubmit" style="margin-right:10px" value="SUBMIT">
						<div class="clear"></div>
					</div>
				</form>
				<?//=form_close()?>
            </div>
		</fieldset>
	</div>
    <!-- Main content ends -->
    
</div>
<!-- Content ends -->