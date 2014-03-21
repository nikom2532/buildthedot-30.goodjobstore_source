<?php
	$user = $this->session->userdata('user');
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
                <li><a href="<?=site_url('customer/group')?>">Groups</a></li>
                <li><a href="<?=site_url('customer/group/'.set_value('name', ''))?>"><?=set_value('name', '')?></a></li>
                <li class="current"><a href="<?=site_url('customer/group/member/edit/'.set_value('name', ''))?>">Edit Member</a></li>
            </ul>
        </div> 
    </div>
    <?php echo validation_errors('<div class="nNote nFailure"><p>', '</p></div>'); ?>
    
    <!-- Main content -->
	<div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu', 'class=main')?>
			<fieldset>
				<div class="widget fluid">
					<div class="whead">
						<h6>Edit Member</h6>
						<div class="clear"></div>
					</div>
<script>
	$(document).ready(function() {
		$('#form').submit( function() {
			var sData = $('input', oTable.fnGetNodes()).serialize();
			 $('#project').val(JSON.stringify(sData));

			//alert(sData);
			return true;
		
		} );
	} );
</script>
						<form id="form" action="<?=base_url('customer/groupMember_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<?//=form_open_multipart('customer/groupMember_update')?>
						<input type="hidden" name="cusgroup_id" value="<?=set_value('cusgroup_id', '')?>"/>
						<input type="hidden" name="name" value="<?=set_value('name', '')?>"/>
						<input type="text" id="project" name="project" value="" style="display:none;"/>
						<div id="dyn" class="hiddenpars">
							<a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
							<table cellpadding="0" cellspacing="0" border="0" class="dTable3" id="dynamic">
								<thead>
									<tr>
										<th class="th2">Select</th>
										<th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Telephone</th>
										<th>Postcode</th>
										<th>Country</th>
										<th>State/Province</th>
										<th>Customer Since</th>
									</tr>
								</thead>
							<tbody id="field_id">
									<?php foreach(get_customer_list() as $value): ?>
										<tr>
											<td>
												<input type="checkbox" name="<?=$value->cus_id?>" 
												<?=(check_in_group($value->cus_id, set_value('cusgroup_id', ''))==TRUE)?'checked=checked':''?> value="1">
											</td>
											<td><?=$value->cus_id?></td>
											<td><?=$value->firstname?>&nbsp;<?=$value->lastname?></td>
											<td><?=$value->email?></td>
											<td><?=$value->phone?></td>
											<td><?=$value->postcode?></td>
											<td><?=get_country_name($value->country_id, '1')?></td>
											<td><?=get_city_name($value->city_id, '1')?></td>
											<td><?=set_dateTime($value->create_at)?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<div class="formRow">
							<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url('customer/group/'.set_value('name', ''))?>'">
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

