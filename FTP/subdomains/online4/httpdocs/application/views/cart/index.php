	<base href="<?=base_url()?>public/" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/css/shopping-cart.css"> 
	<script type="text/javascript" src="<?=base_url()?>/public/scripts/jquery.tinyscrollbar.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#scrollbar1').tinyscrollbar();	
		});
	</script>	

		<!-- Body Section -->
		<div id="sc_title_head">
		Shopping Cart
		</div>
		<div id="content">
			<div id="sc_table_header">
			    <table>
			    	<tr>
			    		<td width="100px">Items</td>
			    		<td width="2px"><img src="../../../../public/images/line.png" /></td>
			    		<td width="140px">Name</td>
			    		<td width="2px"><img src="../../../../public/images/line.png" /></td>
			    		<td width="140px">Description</td>
			    		<td width="20px"><img src="../../../../public/images/line.png" /></td>
			    		<td width="100px">Qty</td>
			    		<td width="2px"><img src="../../../../public/images/line.png" /></td>
			    		<td width="120px">Price</td>
			    		<td width="2px"><img src="../../../../public/images/line.png" /></td>
			    		<td width="120px">Move to Wishlist</td>
			    		<td width="2px"><img src="../../../../public/images/line.png" /></td>
			    		<td width="100px">Subtotal</td>
			    		<td width="2px"><img src="../../../../public/images/line.png" /></td>
			    		<td width="40px"></td>
			    	</tr>
			    </table>
			    <div class="shopping_icon"><img src="../../../../public/images/shopping-icon.jpg" /></div>
			</div>
			<div id="sc_table_body">
			<div id="scrollbar1">
			<div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
			<div class="viewport">
				 <div class="overview">
				 	<table>
				 		<tbody>
						<? $attributes= array('name'=>'cartForm', 'class'=>'cartForm',  'id'=>'cartForm'); ?>
				 		<?=form_open('cart/move_wishlist', $attributes)?>
				 			<?php foreach($results as $result): ?>
				 			<tr>
					    		<td width="100px"><img src="<?="../../../../public/".$result->images_Thumbnail_path?>" /></td>
					    		<td class="tl" width="120px"><?=(LANG=='TH')?$result->products_Pro_Name_Th:$result->products_Pro_Name_En?></td>
					    		<td class="tl" width="130px"><?=(LANG=='TH')?$result->color_Name_TH:$result->color_Name_EN?> Color <br /><?=$result->products_Size?></td>
					    		<td width="110px">
									<div id="qt_left"><?=$result->cart_Qty?></div>
						    		<div id="qt_right">
						    		<ul>
						    			<li><a href="<?=site_url("cart/up/{$result->cart_Cart_ID}")?>"><img src="../../../../public/images/up.jpg" /></a></li>
						    			<li><a href="<?=site_url("cart/down/{$result->cart_Cart_ID}")?>"><img src="../../../../public/images/down.jpg" /></a></li>
						    		</ul>
				    				</div>
					    		</td>
					    		<td width="121px"><?=($result->products_Price_sale!=0)?number_format($result->products_Price_sale):number_format($result->products_Price_Buy);?> ฿</td>
					    		<td width="122px"><input type="checkbox" value="<?=$result->cart_Cart_ID?>" <?=($this->session->userdata('logged_in'))?'':'disabled="disabled"'?> name="move_wishlist[]"></td>
					    		<td width="100px"><?=($result->products_Price_sale!=0)?number_format($price_arr[] = $result->products_Price_sale*$result->cart_Qty):number_format($price_arr[] = $result->products_Price_Buy*$result->cart_Qty);?> ฿</td>
					    		<td width="135px"><input type="button" name="rmItem" value="REMOVE ITEM" onClick="parent.location='<?=site_url("cart/delete/{$result->cart_Cart_ID}")?>'"></td>
					    	</tr>
					    	<?php endforeach; ?>
					    
				 		</tbody>
				 	</table>
				</div>
			</div>	
			</div>
			</div>
		</div> 
		<div id="sc_coupon">
			<div class="right">
					<a href="<?=site_url()?>" class="continue"> <!--onclick="javascript:window.history.back();return false;"-->CONTINUE SHOPPING</a>
					<a href="#" class="updateCartButton" onclick="javascript:document.cartForm.submit();return false;">UPDATE CART</a>
					<!-- <input type="submit" value="UPDATE CART"> --> <br />
					<?=form_close()?>
					<?php 
						$price = 0;
						if(!empty($price_arr))
						{
							foreach ($price_arr as $value) 
							{
								$price = $price + $value;
							}
						}
					?>
					<div class="total">TOTAL &nbsp;&nbsp;&nbsp;&nbsp; <?=number_format(cal_price_from_coupon($price))?> ฿</div><br />
					<div id="sc_checkout"><a href="<?=site_url('checkout')?>">CHECK OUT</a></div>
				</form>
			</div>
			<div class="left">
				<h3>COUPON CODE</h3>
				Please enter your coupon code.
				<br /><br />
				<?=form_open('cart/add_coupon')?>
					<input type="text" <?=($this->session->userdata('logged_in'))?'':'readonly="readonly"'?> name="couponcode"><br />
					<input type="submit" <?=($this->session->userdata('logged_in'))?'':'disabled="disabled"'?> name="applycode" value="APPLY CODE">
					<?php if($this->session->flashdata('message')): ?>
					<?php  $message = $this->session->flashdata('message'); ?>
					<span style="margin-left:20px;color:red;">
							<?=$message['message']?>
					</span>
					<?php endif; ?>
				<?=form_close()?>
			</div>
		</div>
		<div id="sc_space">               
		</div>