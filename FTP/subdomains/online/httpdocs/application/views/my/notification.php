<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/dashboard_2.php">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/dashboard.css">

<script type="text/javascript" src="<?=base_url()?>public/scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
		});
	</script>
		<!-- Body Section -->
		<div id="title_head">
		Notification 
		</div>
		<div id="content">
		    <?=$this->load->view('my/menu')?>
			<div id="dashboard"> 
				<div id="scrollbar1">
					<div class="scrollbar">
						<div class="track">
							<div class="thumb">
								<div class="end">
								</div>
							</div>
						</div>
					</div>
					<div class="viewport">
						 <div class="overview">
						 	<h2>ORDER STATUS</h2>
						 	<table id="table_notification">
						 		<tbody>
						 			<tr class="header">
						 				<td width="320px">Discription</td>
						 				<td width="2px"><img src="<?=base_url()?>public/images/line.png" /></td>
						 				<td width="230px">Order Number</td>
						 				<td width="2px"><img src="<?=base_url()?>public/images/line.png" /></td>
						 				<td width="230px">Order Status</td>
									</tr>
								<?
									$i = 0;
									$numberOfItem = count($results);
								?>
								<? foreach($results as $result): ?>
									<? $i++; ?>
									<tr class="body <? if($i == $numberOfItem) echo 'bodyLast';?>" >
						 				<td>
						 					<table width="310">
						 						<tbody>
						 							<tr>
						 								<td id="product_image"><img src="<?=base_url().'public/'.$result->images_Thumbnail_path?>" /></td>
						 								<td id="product_detail"><?=(LANG=='TH')?$result->products_Pro_Name_Th:$result->products_Pro_Name_En;?> <br />Color <?=(LANG=='TH')?get_check_color($result->order_item_Color_ID)->Name_TH:get_check_color($result->order_item_Color_ID)->Name_EN?> x <?=$result->order_item_Qty?> <br /><?=$result->products_Product_ID?></td>
						 							</tr>
						 						</tbody>
						 					</table>
						 				</td>
						 				<td><img src="<?=base_url()?>public/images/greyline.png" /></td>
						 				<td><?=$result->order_item_Order_ID?></td>
						 				<td><img src="<?=base_url()?>public/images/greyline.png" /></td>
						 				<td><?=$result->order_item_Status?></td>
						 				<td></td>
									</tr>
								<? endforeach; ?>
						 		</tbody>
						 	</table>
						 	<div id="line"></div>
						 	<h2>RESTOCK NOTIFICATION</h2>
						 	<table id="table_notification">
						 		<tbody>
						 			<tr class="header">
						 				<td width="320px">Discription</td>
						 				<td width="2px"><img src="<?=base_url()?>public/images/line.png" /></td>
						 				<td width="230px"> Price</td>
						 				<td width="2px"><img src="<?=base_url()?>public/images/line.png" /></td>
						 				<td width="230px"></td>
									</tr>
									<?php if(!empty($notifications)): ?>
									<?php foreach($notifications as $notification): ?>
									<tr class="body">
						 				<td>
						 					<table width="310">
						 						<tbody>
						 							<tr>
						 								<td id="product_image"><img src="<?=base_url()?>public/<?=$notification->Thumbnail_path?>" /></td>
						 								<td id="product_detail"><?=(LANG=='TH')?$notification->Pro_Name_Th:$notification->Pro_Name_En?> <br />Color <?=(LANG=='TH')?$notification->Name_TH:$notification->Name_EN?> <?=$notification->Size?> <br /><?=$notification->Product_ID?></td>
						 							</tr>
						 						</tbody>
						 					</table>
						 				</td>
						 				<td><img src="<?=base_url()?>public/images/greyline.png" /></td>
						 				<td>
											<?
												if($notification->Price_sale!=0)
													$exPrice = number_format($notification->Price_sale);
												else
													$exPrice = number_format($notification->Price_Buy);
												if(LANG=='EN')
													echo "US$ ".google_finance_convert("THB", "USD", $exPrice);
												else
													echo $exPrice." ฿";
											?>
										</td>
						 				<td><img src="<?=base_url()?>public/images/greyline.png" /></td>
						 				<td>is now aviable<br /><a href="<?=site_url("{$this->config->item('cat')}/{$notification->Pro_Name_En}")?>">GO TO PRODUCT PAGE</a></td>
						 				<td></td>
									</tr>
									<?php endforeach; ?>
									<?php endif; ?>
						 		</tbody>
						 	</table>
						</div>
					</div>
				</div>
			</div>
			
		</div> <!-- End Content --> 