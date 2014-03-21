
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
				<li><a href="<?=site_url('order/create')?>">Add Order</a></li>
				<li class="current"><a href="<?=site_url('order/create')?>">Select Customer</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
 <script>
var oTable;
 
$(document).ready(function() {
    /* Add a click handler to the rows - this could be used as a callback */
    var sData;
    
    $("#example tbody tr").click( function( e ) {
	    sData = oTable.fnGetData( this );
        if ( $(this).hasClass('row_selected') ) {
            $(this).removeClass('row_selected');
        }
        else {
            oTable.$('tr.row_selected').removeClass('row_selected');
            $(this).addClass('row_selected');
        }
    });
     
    /* Add a click handler for the delete row */
    $('#delete').click( function() {
        var anSelected = fnGetSelected( oTable );
        if ( anSelected.length !== 0 ) {
            oTable.fnDeleteRow( anSelected[0] );
        }
    } );
    
      
    $('#create_order').submit( function() {
		$('#select_value').val(sData);
		//alert( "The following data would have been submitted to the server: \n\n"+sData );
		return true;
	} );
    /* Init the table */
    oTable = $('#example').dataTable( );
} );
 
 
/* Get the rows which are currently selected */
function fnGetSelected( oTableLocal )
{
    return oTableLocal.$('tr.row_selected');
}
</script>  
<style>
.row_selected{
    color:white;
    background-color: #2F477A !important;
}

</style>  
	<!-- messages -->
			<?php
           		if($this->session->flashdata('message'))
               	{
                	$msg = $this->session->flashdata('message');
              	}
			?>
			<?php if(isset($msg)): ?>
				<div class="nNote nFailure"><p><?=$msg['message']?></p></div>
			<?php endif;?>
		<!-- end messages -->
    <!-- Main content -->
		<div class="wrapper">
    	<!-- Table with hidden toolbar -->
        <div class="widget">
            <div class="whead"><h6>Select Customers	</h6><div class="clear"></div></div>
			<form id="create_order" class="main" action="<?=base_url('order/create_step1_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				<input type="text" id="select_value" name="select_value" value="" style="display:none;"/>
				<div id="dyn" class="hiddenpars">
					<a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
					<table cellpadding="0" cellspacing="0" border="0" class="dTable" id="example">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Telephone</th>
								<th>Country</th>
								<th>State/Province</th>
							</tr>
						</thead>
						<tbody id="field_id">
							<?php foreach(get_customer_list() as $value): ?>
							<tr>
								<td><?=$value->cus_id?></td>
								<td><?=$value->firstname?>&nbsp;<?=$value->lastname?></td>
								<td><?=$value->email?></td>
								<td><?=$value->phone?></td>
								<td><?=get_country_name($value->country_id, '1')?></td>
								<td><?=get_city_name($value->city_id, '1')?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			
	
					<!--//////////////////////////////////////////////////////////////-->
					<!--///////////////////////// Submit /////////////////////////////-->
					<!--//////////////////////////////////////////////////////////////-->          
         
                    <div class="formRow">
						<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("order")?>'">
						<input type="submit" name ="submit" class="buttonS bLightBlue formSubmit" style="margin-right:10px" value="SUBMIT">		
					<?//=form_close()?>
					</form>	
				</div>
		</form>
		</div>
	</div>
    <!-- Main content ends -->
    
</div>
<!-- Content ends -->