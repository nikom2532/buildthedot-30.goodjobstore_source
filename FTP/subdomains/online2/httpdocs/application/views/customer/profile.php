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
		echo $this->load->view('customer/left_menu');
	?>
</div>
<!-- Sidebar ends -->

<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('customer/top_menu');?>
    
    <!-- Breadcrumbs line -->
	<div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?=site_url('customer')?>">Customer</a></li>
                <li class="current"><a href="<?=site_url('customer/profile/'.$cus_detail->cus_id)?>"><?=$cus_detail->cus_id?></a></li>
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
		<!-- customer view -->                    
            <div class="tab_content">
				<!-- contact address -->
        		<div class="fluid">
					<div class="widget grid12">
						<div class="whead">
							<h6>Contact</h6>
							<h6 style=" float:right;"><a href="<?=base_url('customer/profile/edit/contact/'.$cus_detail->cus_id)?>" class="buttonS bRed" style="color:white;">Edit</a></h6>
							<div class="clear"></div>
						</div>
						<div class="body">
							<div class="grid3" style="display:none;"></div>
							<div class="grid3" style="font-weight:bold;">Customer ID:</div>
								<div class="grid3"><?=$cus_detail->cus_id?></div><br>
							<div class="grid3" style="font-weight:bold;">Name:</div>
								<div class="grid3"><?=$cus_detail->firstname?> <?=$cus_detail->lastname?></div><br>
							<div class="grid3" style="font-weight:bold;">Address:</div>
								<div class="grid3"><?=$cus_detail->address?></div><br>
							<div class="grid3" style="font-weight:bold;">City/Province:</div>
								<div class="grid3" ><?=get_city_name($cus_detail->city_id, '1')?></div><br>
							<div class="grid3" style="font-weight:bold;">Postcode:</div>
								<div class="grid3"><?=$cus_detail->postcode?></div><br>
							<div class="grid3" style="font-weight:bold;">Country:</div>
								<div class="grid3"><?=get_country_name($cus_detail->country_id, '1')?></div><br>
							<div class="grid3" style="font-weight:bold;">Phone:</div>
								<div class="grid3"><?=$cus_detail->phone?></div><br>
							<div class="grid3" style="font-weight:bold;">Email:</div>
								<div class="grid3"><?=$cus_detail->email?></div><br>
							<div class="grid3" style="font-weight:bold;">Newsletter:</div>
								<div class="grid3"><?=($cus_detail->newsletter=='0')?'No':'Yes';?></div><br>
							<div class="grid3" style="font-weight:bold;">Birth Day:</div>
								<div class="grid3"><?=set_date($cus_detail->birth_date)?></div><br>
							<div class="grid3" style="font-weight:bold;">Register Since:</div>
								<div class="grid3"><?=set_dateTime($cus_detail->create_at)?></div><br>
						</div>
					</div>
				</div>
				<!-- billing&shipping address -->
        		<div class="fluid">
            		<div class="widget grid6">
                		<div class="whead">
							<h6>Billing Address</h6>
							<h6 style=" float:right;"><a href="<?=base_url('customer/profile/edit/billing/'.$cus_detail->cus_id)?>" class="buttonS bRed" style="color:white;">Edit</a></h6>
                   			<div class="clear"></div>
                   		</div>
                		<div class="body">
                			<div class="grid3" style="display:none;"></div>
							<div class="grid3" style="font-weight:bold;">Name:</div>
								<?=$cus_address->b_firstname?> <?=$cus_address->b_lastname?><br>
							<div class="grid3" style="font-weight:bold;">Address:</div>
								<?=$cus_address->b_address?><br>
							<div class="grid3" style="font-weight:bold;">City/Province:</div>
								<?=get_city_name($cus_address->b_city_id, '1')?><br>
							<div class="grid3" style="font-weight:bold;">Postcode:</div>
								<?=$cus_address->b_postcode?><br>
							<div class="grid3" style="font-weight:bold;">Country:</div>
								<?=get_country_name($cus_address->b_country_id, '1')?><br>
							<div class="grid3" style="font-weight:bold;">Phone:</div>
								<?=$cus_address->b_phone?><br>
						</div>
            		</div>
            		<div class="widget grid6">
                		<div class="whead">
							<h6>Shipping Address</h6>
							<h6 style=" float:right;"><a href="<?=base_url('customer/profile/edit/shipping/'.$cus_detail->cus_id)?>" class="buttonS bRed" style="color:white;">Edit</a></h6>
                       		<div class="clear"></div>
                       	</div>
                		<div class="body">
                		    <div class="grid3" style="display:none;"></div>
							<div class="grid3" style="font-weight:bold;">Name:</div>
								<?=$cus_address->s_firstname?> <?=$cus_address->s_lastname?><br>
							<div class="grid3" style="font-weight:bold;">Address:</div>
								<?=$cus_address->s_address?><br>
							<div class="grid3" style="font-weight:bold;">City/Province:</div>
								<?=get_city_name($cus_address->s_city_id, '1')?><br>
							<div class="grid3" style="font-weight:bold;">Postcode:</div>
								<?=$cus_address->s_postcode?><br>
							<div class="grid3" style="font-weight:bold;">Country:</div>
								<?=get_country_name($cus_address->s_country_id, '1')?><br>
							<div class="grid3" style="font-weight:bold;">Phone:</div>
								<?=$cus_address->s_phone?><br>
						</div>
            		</div>
        		</div>
                    
                <!-- customer wishlist -->
        		<div class="fluid">
            		<div class="widget grid12">
                		<div class="whead"><h6>Wishlist</h6>
                       		<div class="clear"></div>
                       	</div>
                	<div class="body">detail</div>
            		</div>
        		</div>
                <!-- customer ordered -->
        		<div class="fluid">
            		<div class="widget grid12">
                		<div class="whead"><h6>Ordered</h6>
                       		<div class="clear"></div>
                       	</div>
                	<div class="body">detail</div>
            		</div>
        		</div>
			</div>
	</div>
	<!-- Main content ends -->
    
</div>
<!-- Content ends -->    