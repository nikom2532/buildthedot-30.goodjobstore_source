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
	<?
		$btn_menu[] = array('btn_menu'=>'AUTHORIZE ANALYTICS', 'link_menu'=>base_url(''), 'btn_id'=>'authorize-button', 'btn_style'=>'visibility: hidden');

		$data['sec_menu'] = array('btn_menu'=>$btn_menu);
		echo $this->load->view('templates/second_menu', $data);
	?>
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
   <!-- Add Google Analytics authorization button -->
<a title="" class="sideB bBlue mt10" id="authorize-button" style="visibility: hidden">Authorize Analytics</a>


  <!-- Div element where the Line Chart will be placed -->

  <!-- Load all Google JS libraries -->
  <script src="https://apis.google.com/js/client.js?onload=gadashInit"></script>
  <script>
    // Configure these parameters before you start.
    var API_KEY = 'AIzaSyC1wxoxcGwqQGQr8lXkUfvL-ZZqKxmPlzg';
    var CLIENT_ID = '1061875279943-ohlvv952u9tt2d4ct98g5kok20sordfh.apps.googleusercontent.com';
    var TABLE_ID = 'ga:20551386';
    // Format of table ID is ga:xxx where xxx is the profile ID.

    gadash.configKeys({
      'apiKey': API_KEY,
      'clientId': CLIENT_ID
    });

    // Create a new Chart that queries visitors for the last 30 days and plots
    // visualizes in a line chart.
    var chart1 = new gadash.Chart({
      'type': 'LineChart',
      'divContainer': 'line-chart-example',
      'last-n-days':45,
      'query': {
        'ids': TABLE_ID,
        'metrics': 'ga:visitors',
        'dimensions': 'ga:date'
      },
      'chartOptions': {
        title: 'Visits in June 2013',
        hAxis: {title:'Date'},
        vAxis: {title:'Visits'},
        curveType: 'none'
      }
    }).render();
  </script>		
<!--##########################################  TRAFFIC DAY  ##########################################-->

                        <div id="tabs-10" style="background-color:white;">
                           <div class="body"><div id="line-chart-example"></div></div>      
                        </div>
                        
<!--##########################################  TRAFFIC MONTH  ##########################################-->
                        
			
<!--##########################################  TRAFFIC MONTH  ##########################################-->  
                     
                        <div id="tabs-11" style="background-color:white;">
                           <div class="body"><div id="traffic_month"></div></div>      
                        </div>
                        
<!--##########################################  TRAFFIC YEAR  ##########################################-->
                        

		
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
</div>
<!-- Content ends -->