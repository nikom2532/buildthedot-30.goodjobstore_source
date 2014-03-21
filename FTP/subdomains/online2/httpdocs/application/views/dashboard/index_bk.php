<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Plat-BO</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

	<link href="<?=base_url()?>public/css/styles.css" rel="stylesheet" type="text/css" />
	<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/min/jquery-1.8.3.min.js"></script> 
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/min/jquery-ui-1.9.2.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/charts/excanvas.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/charts/jquery.sparkline.min.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/tables/jquery.sortable.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/tables/jquery.resizable.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.autosize.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.uniform.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.inputlimiter.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.tagsinput.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.maskedinput.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.autotab.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.select2.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.dualListBox.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.cleditor.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.ibutton.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.validationEngine-en.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.validationEngine.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/uploader/plupload.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/uploader/plupload.html4.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/uploader/plupload.html5.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/uploader/jquery.plupload.queue.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/wizards/jquery.form.wizard.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/wizards/jquery.validate.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/wizards/jquery.form.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.collapsible.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.breadcrumbs.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.tipsy.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.progress.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.timeentry.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.colorpicker.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.jgrowl.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.fancybox.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.fileTree.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.sourcerer.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/others/jquery.fullcalendar.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/others/jquery.elfinder.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/forms/jquery.mousewheel.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/ui/jquery.easytabs.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/files/bootstrap.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/files/functions.js"></script>

	<script type="text/javascript" src="<?=base_url()?>public/js/charts/jsapi.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/charts/oocharts.js"></script>
	
	<script type="text/javascript" src="<?=base_url()?>public/js/plugins/others/jquery.confirm.js"></script>
	
</head>

<body>
	<div id="wrapper">
		<!-- Header Section -->
		<?=$this->load->view('templates/header')?>
		
		<!-- Body Section -->



<!--###############################################################################-->
<!--###############################################################################-->
<!--###############################################################################-->
<!--###############################################################################-->
<!--###############################################################################-->


<?php
	$user = $this->session->userdata('user');	
?>

<!-- Sidebar begins -->
<div id="sidebar">
	
	<!-- Main nav -->
	<?
		$data['active_menu'] = '1';
		echo $this->load->view('templates/main_menu', $data);
	?>
    
    <!-- Secondary nav -->
    <?=$this->load->view('templates/second_menu')?>
   
</div>
<!-- Sidebar ends -->
    
    
<!-- Content begins -->
<div id="content">
    <div class="contentTop">
        <span class="pageTitle"><span class="icon-screen"></span>Dashboard</span>

		<!-- Quick Stats -->
		<?=$this->load->view('templates/quick_stats')?>

        <div class="clear"></div>
    </div>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc"> 
            <ul id="breadcrumbs" class="breadcrumbs">
                <li class="current"><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu')?>
    
    	<!-- Chart -->
       
         <div class="fluid">
                <div class="widget grid6 rightTabs chartWrapper">   
                    <div class="whead"><h6>Sale Report</h6></div>     
                    <div class="tabs">
                        <ul>
                            <li><a href="#tabs-7">Day</a></li>
                            <li><a href="#tabs-8">Month</a></li>
                            <li><a href="#tabs-9">Year</a></li>
                        </ul>
<!--##########################################  INCOME DAY  ##########################################-->

    <script type='text/javascript'>
      google.load('visualization', '1', {'packages':['annotatedtimeline']});
      google.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Date');
        data.addColumn('number', 'Sales');
        data.addRows([
          [new Date(2008, 1 ,1), 30000],
          [new Date(2008, 1 ,2), 14045],
          [new Date(2008, 1 ,3), 55022],
          [new Date(2008, 1 ,4), 75284],
          [new Date(2008, 1 ,5), 41476],
          [new Date(2008, 1 ,6), 33322]
        ]);
        
        var options = {
          backgroundColor: 'transparent'
        };
        var chart = new google.visualization.LineChart(document.getElementById('sales_day'));
        chart.draw(data, {
        hAxis: {
            format: 'MMM dd, yyyy'
        }
        });
      }
    </script>

<!--##########################################  INCOME DAY  ##########################################-->

                        <div id="tabs-7" style="background-color:white;">
                           <div class="body"><div id='sales_day' styled="width:300px; height:450px;"></div>
</div>      
                        </div>
                  
<!--##########################################  INCOME MONTH  ##########################################-->

    <script type='text/javascript'>
       google.load('visualization', '1', {'packages':['annotatedtimeline']});
      google.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Date');
        data.addColumn('number', 'Sales');
        data.addRows([
          [new Date(2008, 1 ,1), 30000],
          [new Date(2008, 1 ,2), 14045],
          [new Date(2008, 1 ,3), 55022],
          [new Date(2008, 1 ,4), 75284],
          [new Date(2008, 1 ,5), 41476],
          [new Date(2008, 1 ,6), 33322]
        ]);
        
        var options = {
          backgroundColor: 'transparent'
        };
        var chart = new google.visualization.LineChart(document.getElementById('sales_month'));
        chart.draw(data, {
        hAxis: {
            format: 'MMM dd, yyyy'
        }
        });
      }
    </script>
    
<!--##########################################  INCOME MONTH  ##########################################-->

                        <div id="tabs-8" style="background-color:white;">
                           <div class="body"><div id="sales_month" styled="width:300px; height:450px;"></div></div>      
                        </div>
                        
<!--##########################################  INCOME YEAR  ##########################################-->

    <script type='text/javascript'>
      google.load('visualization', '1', {'packages':['annotatedtimeline']});
      google.setOnLoadCallback(drawChart);
      
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('date', 'Date');
        data.addColumn('number', 'Sales');
        data.addRows([
          [new Date(2008, 1 ,1), 30000],
          [new Date(2008, 1 ,2), 14045],
          [new Date(2008, 1 ,3), 55022],
          [new Date(2008, 1 ,4), 75284],
          [new Date(2008, 1 ,5), 41476],
          [new Date(2008, 1 ,6), 33322]
        ]);
        
        var options = {
          backgroundColor: 'transparent'
        };
        var chart = new google.visualization.LineChart(document.getElementById('sales_year'));
        chart.draw(data, {
        hAxis: {
            format: 'MMM dd, yyyy'
        }
        });
      }
    </script>
    
<!--##########################################  INCOME YEAR  ##########################################-->
                       
                        <div id="tabs-9" style="background-color:white;">
                           <div class="body"><div id="sales_year" styled="width:300px; height:450px;"></div></div>      
                        </div>
                    </div>
                </div>

				<div class="widget grid6 rightTabs">   
                    <div class="whead"><h6>Traffic Report</h6></div>     
                    <div class="tabs">
                        <ul>
                            <li><a href="#tabs-10">Day</a></li>
                            <li><a href="#tabs-11">Month</a></li>
                            <li><a href="#tabs-12">Year</a></li>
                        </ul>
                        
<!--##########################################  TRAFFIC DAY  ##########################################-->
                        
	<script type="text/javascript">
		
			//Set your ooid
			oo.setOOId("4a98bf0d53124d76a0b4fde51c8711fd");
			
			//load reqs
			oo.load(function()
			{
				//Create a new timeline (aid, startDate, endDate)
				var tl = new oo.Timeline("20551386", new Date("05/01/2013"), new Date("05/31/2013"));
				
				//Add the metric to pull from the visitor count
				tl.addMetric('ga:visitors', 'Visits');
								
				//Set Google visualization options for line colors
				tl.setOption('colors', ['#3366CC', 'orange', 'yellow', 'green']);

				
				//draw in the div element with id 'timeline'
				tl.draw('traffic_day');
			});
		</script>
		
<!--##########################################  TRAFFIC DAY  ##########################################-->

                        <div id="tabs-10" style="background-color:white;">
                           <div class="body"><div id="traffic_day"></div></div>      
                        </div>
                        
<!--##########################################  TRAFFIC MONTH  ##########################################-->
                        
	<script type="text/javascript">
		
			//Set your ooid
			oo.setOOId("4a98bf0d53124d76a0b4fde51c8711fd");
			
			//load reqs
			oo.load(function()
			{
				//Create a new timeline (aid, startDate, endDate)
				var tl = new oo.Timeline("20551386", new Date("05/01/2013"), new Date("05/31/2013"));
				
				//Add the metric to pull from the visitor count
				tl.addMetric('ga:visitors', 'Visits');
								
				//Set Google visualization options for line colors
				tl.setOption('colors', ['#3366CC', 'orange', 'yellow', 'green']);

				
				//draw in the div element with id 'timeline'
				tl.draw('traffic_month');
			});
		</script>
		
<!--##########################################  TRAFFIC MONTH  ##########################################-->  
                     
                        <div id="tabs-11" style="background-color:white;">
                           <div class="body"><div id="traffic_month"></div></div>      
                        </div>
                        
<!--##########################################  TRAFFIC YEAR  ##########################################-->
                        
	<script type="text/javascript">
		
			//Set your ooid
			oo.setOOId("4a98bf0d53124d76a0b4fde51c8711fd");
			
			//load reqs
			oo.load(function()
			{
				//Create a new timeline (aid, startDate, endDate)
				var tl = new oo.Timeline("20551386", new Date("05/01/2013"), new Date("05/31/2013"));
				
				//Add the metric to pull from the visitor count
				tl.addMetric('ga:visitors', 'Visits');
								
				//Set Google visualization options for line colors
				tl.setOption('colors', ['#3366CC', 'orange', 'yellow', 'green']);
				
				//draw in the div element with id 'timeline'
				tl.draw('traffic_year');
			});
		</script>
		
<!--##########################################  TRAFFIC YEAR  ##########################################--> 
                       
                        <div id="tabs-12" style="background-color:white;">
                           <div class="body"><div id="traffic_year"></div></div>      
                        </div>
                    </div>
                </div>
                    
              
        </div>
    	
    
    	<!-- table -->
        <div class="fluid">
            
            <!-- last 5 orders -->
            <div class="widget grid6">
            <div class="whead"><h6>Last 5 Orders</h6><div class="clear"></div></div>
            
           <table cellpadding="0" cellspacing="0" width="100%" class="tDefault">
                <thead>
                    <tr>
                        <td>Order ID</td>
                        <td>Final Price</td>
                        <td>Status</td>
                        <td>Create at</td>
						
                    </tr>
                </thead>
                 <tbody id="field_id">
						<?php foreach(dashboard_get_order_list() as $value): ?>
							<tr>
								<td><?=$value->order_id?></td>
								<td><?=$value->final_price?></td>
								<td><?=$value->order_status?></td>
								<td><?=$value->create_at?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
            </table>
        </div>

			<!-- best seller -->
            <div class="widget grid6">
            <div class="whead"><h6>Best Seller</h6><div class="clear"></div></div>
            
            <table cellpadding="0" cellspacing="0" width="100%" class="tDefault">
                <thead>
                    <tr>
                        <td>Product ID</td>
                        <td>Name</td>
                        <td>Qty</td>
						<td>Property</td>
						<td>Color</td>
                    </tr>
                </thead>
               <tbody id="field_id">
						<?php foreach(dashboard_get_order_item() as $value): ?>
							<tr>
								<td><?=$value->order_items_product_id?></td>
								<td><?=$value->order_items_name?></td>
								<td><?=$value->order_items_sumqty?></td>
								<td><?=get_property_name($value->products_prop_id)?></td>
								<td><?=get_color_name($value->products_color_id)?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
            </table>
        </div>
        </div>    
        
        <!-- table -->
        <div class="fluid">
        	
            <!-- new customers -->
            <div class="widget grid6">    
            	<div class="whead"><h6>New Customers</h6>
                	<div class="clear"></div>
                </div>
            	<table cellpadding="0" cellspacing="0" width="100%" class="tDefault">
                <thead>
                    <tr>
                        <td>Customer ID</td>
                        <td>Customer Name</td>
                        <td>Customer Since</td>
                    </tr>
                </thead>
               <tbody id="field_id">
						<?php foreach(dashboard_get_customer_list() as $value): ?>
							<tr>
								<td><?=$value->cus_id?></td>
								<td><?=$value->firstname?>&nbsp;<?=$value->lastname?></td>
								<td><?=set_dateTime($value->create_at)?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
            	</table>
        	</div>                    
 
			<!-- stock -->
			<div class="widget grid6">
          		<div class="whead"><h6>Stock</h6>
          		<div class="clear"></div>
            	</div>
            
            	<table cellpadding="0" cellspacing="0" width="100%" class="tDefault">
                <thead>
                    <tr>
                        <td>Product ID</td>
                        <td>Name</td>
                        <td>Property</td>
                        <td>Color</td>
						<td>Qty</td>
                    </tr>
                </thead>
                 <tbody id="field_id">
						<?php foreach(dashboard_get_product_list() as $value): ?>
							<tr>
								<td><?=$value->product_id?></td>
								<td><?=$value->name?></td>
								<td><?=get_property_name($value->prop_id)?></td>
								<td><?=get_color_name($value->color_id)?></td>
								<td><?=$value->qty?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
            </table>
        </div>   
        </div>
        <div class="fluid">
        <!-- Last Search -->
			<div class="widget grid6">
          		<div class="whead"><h6>Last 5 Search Terms</h6>
          		<div class="clear"></div>
            	</div>
            
            	<table cellpadding="0" cellspacing="0" width="100%" class="tDefault">
                <thead>
                    <tr>
                        <td>Column name</td>
                        <td>Column name</td>
                        <td>Column name</td>
                        <td>Column name</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Row 1</td>
                        <td>Row 2</td>
                        <td>Row 3</td>
                        <td>Row 4</td>
                    </tr>
                    <tr>
                        <td>Row 1</td>
                        <td>Row 2</td>
                        <td>Row 3</td>
                        <td>Row 4</td>
                    </tr>
                    <tr>
                        <td>Row 1</td>
                        <td>Row 2</td>
                        <td>Row 3</td>
                        <td>Row 4</td>
                    </tr>
                    <tr>
                        <td>Row 1</td>
                        <td>Row 2</td>
                        <td>Row 3</td>
                        <td>Row 4</td>
                    </tr>
                    <tr>
                        <td>Row 1</td>
                        <td>Row 2</td>
                        <td>Row 3</td>
                        <td>Row 4</td>
                    </tr>
                </tbody>
            </table>
        </div>               
        
        <!-- Top Search -->
			<div class="widget grid6">
          		<div class="whead"><h6>Top 5 Search Terms</h6>
          		<div class="clear"></div>
            	</div>
            
            	<table cellpadding="0" cellspacing="0" width="100%" class="tDefault">
                <thead>
                    <tr>
                        <td>Column name</td>
                        <td>Column name</td>
                        <td>Column name</td>
                        <td>Column name</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Row 1</td>
                        <td>Row 2</td>
                        <td>Row 3</td>
                        <td>Row 4</td>
                    </tr>
                    <tr>
                        <td>Row 1</td>
                        <td>Row 2</td>
                        <td>Row 3</td>
                        <td>Row 4</td>
                    </tr>
                    <tr>
                        <td>Row 1</td>
                        <td>Row 2</td>
                        <td>Row 3</td>
                        <td>Row 4</td>
                    </tr>
                    <tr>
                        <td>Row 1</td>
                        <td>Row 2</td>
                        <td>Row 3</td>
                        <td>Row 4</td>
                    </tr>
                    <tr>
                        <td>Row 1</td>
                        <td>Row 2</td>
                        <td>Row 3</td>
                        <td>Row 4</td>
                    </tr>
                </tbody>
            </table>
        </div>        
    </div>
    </div>
    <!-- Main content ends -->
    	<script type="text/javascript" src="<?=base_url()?>public/js/charts/chart.js"></script>
	<script type="text/javascript" src="<?=base_url()?>public/js/charts/hBar_side.js"></script>
</div>
<!-- Content ends -->



<!--###############################################################################-->
<!--###############################################################################-->
<!--###############################################################################-->
<!--###############################################################################-->
<!--###############################################################################-->




		<!-- Footer Section -->
		<?=$this->load->view('templates/footer')?>
	</div>
</body>
</html>

