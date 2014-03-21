<?php
	if(LANG==1)
		$user = $this->session->userdata('user');
	else
		$user = get_user_lang($this->session->userdata('user')->admin_id);
?>

<!--############################################################-->
<!--############################################################-->
<!--############################################################-->
  <script src="<?=base_url()?>public/js/plugins/draganddrop/jquery.tablednd.js"></script>
  <script src="<?=base_url()?>public/js/plugins/draganddrop/jqueryTableDnDArticle.js"></script>

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
                debugStr += rows[i].id+" ";
				//alert(debugStr);
            }
			//alert(debugStr);
        },
        onDragStart: function(table, row) {
        }
    });
	
	$("#button").click(function (event) {
                alert(debugStr);
            });
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
				<li><a href="<?=base_url("product/view/".$group_detail->url)?>"><?=$group_detail->name?></a></li>
				<li><a href="<?=base_url("product/view/".$group_detail->url."/".$product_detail->product_id)?>"><?=$product_detail->name?></a></li>
				<li class="current"><a href="<?=base_url("product/view/".$group_detail->url."/".$product_detail->product_id."/images")?>">Images</a></li>
            </ul>
        </div> 
    </div>
    <!-- Main content -->
    <div class="wrapper">
		<!-- product group details -->
		<div class="widget">
            <div class="whead"><h6><?=$product_detail->name?></h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable" id="table-2">
					<thead>
						<tr>
							<th>rank</th>
							<th>Image</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<tr id="1"><td>1</td><td>One</td></tr>
						<tr id="2"><td>2</td><td>Two</td></tr>
						<tr id="3"><td>3</td><td>Three</td></tr>
						<tr id="4"><td>4</td><td>Four</td></tr>
						<tr id="5"><td>5</td><td>Five</td></tr>
						<tr id="6"><td>6</td><td>Six</td></tr>
					</tbody>
				</table>
				<input type="button" id="button" class="buttonS bLightBlue formSubmit" style="margin-right:10px" value="Submit">
			</div>
		</div>
	</div>
	<!-- Main content ends -->
</div>
<!-- Content ends --> 