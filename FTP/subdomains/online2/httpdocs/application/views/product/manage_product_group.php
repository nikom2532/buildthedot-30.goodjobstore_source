<?php
	if(LANG==1)
		$user = $this->session->userdata('user');
	else
		$user = get_user_lang($this->session->userdata('user')->admin_id);
?>

<!--############################################################-->
<!--##################### DRAG AND DROP ########################-->
<!--############################################################-->
	<script type="text/javascript">
		$(document).ready(function() {	
			var debugStr;
			$("#table-2").addClass('alt');
		 
			// Initialise the second table specifying a dragClass and an onDrop function that will display an alert
			$("#table-2").tableDnD({
				onDragClass: "myDragClass",
				onDrop: function(table, row) {
					debugStr = "";
					var rows = table.tBodies[0].rows;
					for (var i=0; i<rows.length; i++) {
						debugStr += rows[i].id;
						if(i!=(rows.length - 1))
							debugStr += " ";
						//alert(debugStr);
					}
					//alert(debugStr);
				},
				onDragStart: function(table, row) {
				}
			});
			
			//$("#button").click(function (event) {
			//			alert(debugStr);
			//		});
			 $('#manage_product_group').submit( function() {
				$('#manage_rank').val(debugStr);
				return true;
			} );
		});
	</script>
<!--############################################################-->
<!--############################################################-->
<!--############################################################-->

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
				<li class="current"><a href="<?=base_url("product/view/manage")?>">Manage</a></li>
            </ul>
        </div> 
    </div>
    <!-- Main content -->
    <div class="wrapper">
		<!-- product group details -->
		<div class="widget">
            <div class="whead"><h6>Manage Product Group</h6><div class="clear"></div></div>
			<form id="manage_product_group" class="main" action="<?=base_url('product/manage_product_group_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				<input type="text" id="manage_rank" name="manage_rank" value="" style="display:none;"/>
				<div id="dyn" class="hiddenpars">
					<a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
					<table cellpadding="0" cellspacing="0" border="0" class="dTable" id="table-2">
						<thead>
							<tr>
								<th>rank</th>
								<th>Product Code</th>
								<th>Image</th>
								<th>Name</th>
								<th>Public</th>
								<th>Url</th>
							</tr>
						</thead>
						<tbody id="field_id">
							<?php foreach(get_pro_group_list() as $value): ?>
								<tr id="<?=$value->progroup_id?>">
									<td><?=$value->rank?></td>
									<td><?=$value->progroup_id?></td>
									<td align="center">
										<? if (get_primary_img_group($value->progroup_id) == ''): ?>
											<img style="height:25; width:25px;" src=""/>
										<? else: ?>
											<img style="height:50; width:50px;" src="<?=base_url()?><?=get_primary_img_group($value->progroup_id)?>"/>
										<? endif;?>
									</td>
									<td><?=$value->name?></td>
									<td><?=($value->public==1)?'Yes':'No';?></td>
									<td><?=$value->url?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
<!--					<input type="button" id="button" class="buttonS bLightBlue formSubmit" style="margin-right:10px" value="Submit">-->
                    <div class="formRow">
						<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("product")?>'">
						<input type="submit" name ="submit" class="buttonS bLightBlue formSubmit" style="margin-right:10px" value="SUBMIT">		
					</div>
				</div>
			</form>
		</div>
	</div>
	<!-- Main content ends -->
</div>
<!-- Content ends --> 