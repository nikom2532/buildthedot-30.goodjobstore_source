<base href="<?=base_url()?>public/" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/dashboard.css">
<script type="text/javascript" src="<?=base_url()?>public/scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar_order').tinyscrollbar();	
		});
	</script>
		<!-- Body Section -->
		<div id="title_head">
		Wish List
		</div>
		<div id="content">
		    <?=$this->load->view('my/menu')?>
			<div id="withlist"> 
				<div id="scrollbar_order">
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
						 	<table id="tabble_withlist">
						 		<tbody>
						 			<tr class="header">
						 				<td width="50px">Product</td>
						 				<td width="2px"><img src="images/line.png" /></td>
						 				<td width="160px">Comment</td>
						 				<td width="2px"><img src="images/line.png" /></td>
						 				<td width="50px">Data Added</td>
						 				<td width="2px"><img src="images/line.png" /></td>
						 				<td width="160px">Action</td>
									</tr>
									
									
									<!-- Item 1 -->
									<?php foreach($results as $result): ?>
									<?=form_open('wishlist/update')?>
									<tr class="body">
						 				<td><img src="<?=$result->images_Thumbnail_path?>" /></td>
						 				<td></td>
						 				<td>
						 					<textarea name="comment" style="font-size:14px;" row="3" colum="5"><?=$result->wish_list_Comment?></textarea>
						 					<input type="hidden" name="WL_ID" value="<?=$result->wish_list_WL_ID?>" />
						 				</td>
						 				<td></td>
						 				<td><?=date("d M Y", strtotime($result->wish_list_Create_Date))?></td>
						 				<td></td>
						 				<td>
						 					<!-- Action Field -->
						 					<table id="action">
						 						<tbody>
						 							<tr>
						 								<td width="100px"></td>
						 								<td width="80px"></td>
						 								<td width="150px"><input type="button" value="ADD TO CART" name="add" class="button" onClick="parent.location='<?=site_url("cart/wishlist/{$result->wish_list_WL_ID}")?>'"></td>
						 							</tr>
						 							<tr>
						 								<td><input type="text" name="qty" class="qty" value="<?=$result->wish_list_Qty?>"></td>
						 								<td>QTY</td>
						 								<td><input type="submit" value="EDIT" name="edit" class="button"></td>
						 							</tr>
						 							<tr>
						 								<td></td>
						 								<td></td>
						 								<td><input type="button" value="ROMOVE ITEM" name="rm" class="button"  onClick="parent.location='<?=site_url("wishlist/delete/{$result->wish_list_WL_ID}")?>'"></td>
						 							</tr>
						 						</tbody>
						 					</table>
						 				</td>
									</tr>
									<tr class="tableline">
						 				<td><?=(LANG=='TH')?$result->products_Pro_Name_Th:$result->products_Pro_Name_En?></td>
						 				<td></td>
						 				<td><div id="left"><?=(LANG=='TH')?$result->color_Name_TH:$result->color_Name_EN?> Yellow</div> <div id="right">Size <?=$result->products_Size?></div></td>
						 				<td></td>
						 				<td></td>
						 				<td></td>
						 				<td><div id="left">Price <?=($result->products_Price_sale!=0)?number_format($result->products_Price_sale):number_format($result->products_Price_Buy);?> ฿</div> <div id="right">Subtotal <?=($result->products_Price_sale!=0)?number_format($result->products_Price_sale*$result->wish_list_Qty):number_format($result->products_Price_Buy*$result->wish_list_Qty);?> ฿</div></td>
									</tr>
									<?=form_close()?>
									<?php endforeach; ?>
						 		</tbody>
						 	</table>
						</div>
					</div>
				</div>
				<div id="wl_button">
				<a href="<?=current_url()?>">Update Wishlist</a>
				<a href="<?=site_url('cart/all_wishlist')?>">Add All to cart</a>
				</div>
			</div>
		</div>      
