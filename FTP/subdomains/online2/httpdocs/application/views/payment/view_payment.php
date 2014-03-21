<?php
	$user = $this->session->userdata('user');
?>

<!-- Sidebar begins -->
<div id="sidebar">
    <!-- Left nav -->
	<?=$this->load->view('payment/left_menu');?>
</div>
<!-- Sidebar ends -->
	
    
<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('payment/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?=site_url('payment')?>">Payment</a></li>
				<li class="current"><a href="<?=base_url("payment/view/".$payment_detail->payment_id)?>"><?=$payment_detail->name?></a></li>
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
							<h6>Payment Details</h6>
							<h6 style=" float:right;"><a href="<?=base_url("payment/edit/".$payment_detail->payment_id)?>" class="buttonS bRed" style="color:white;">Edit</a></h6>
							<div class="clear"></div>
						</div>
						<div class="body">
							<div class="grid3" style="display:none;"></div>
							<div class="grid3" style="font-weight:bold;">Image:</div>
								<? if ($payment_detail->path == NULL): ?>
								<img style="height:50; width:50px; margin-left:15px;" src=""/>
								<? else: ?>
								<img style="height:50; width:50px; margin-left:15px;" src="<?=base_url()?><?=$payment_detail->path?>"/>
								<? endif;?></br>
							<div class="grid3" style="font-weight:bold;">Payment ID:</div>
								<div class="grid3"><?=$payment_detail->payment_id?></div><br>
							<div class="grid3" style="font-weight:bold;">Name:</div>
								<div class="grid3"><?=$payment_detail->name?></div><br>
							<div class="grid3" style="font-weight:bold;">Description:</div>
								<div class="grid3"><?=$payment_detail->description?></div><br>	
						</div>
					</div>
				</div>
	</div>
	<!-- Main content ends -->
    
</div>
<!-- Content ends -->    

