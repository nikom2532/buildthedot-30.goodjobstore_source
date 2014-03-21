	<base href="<?=base_url()?>public/" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/checkout.css">
	<script type="text/javascript" src="<?=base_url()?>public/scripts/jquery.tinyscrollbar.min.js"></script>
		<!-- Body Section -->
		<div id="title_head">
			Checkout 
		</div>
		<div id="process">
			<ul>
				<li><img src="images/step_01.png" /></li>
				<li><img src="images/step_02.png" /></li>
				<li><img src="images/step_03.png" /></li>
				<li><img src="images/step_04_active.png" /></li>
			</ul>
		</div>
		<div id="confirmation">
			<div id="confirmation_title">Thank you <br>for your purchase</div>
			<div class="left">
				<div class="back_button"><a href="<?=site_url()?>">Back to Shopping</a></div>
<!--				<div class="item">
					<h3>This is item you bougth :</h3>
					200 Bath. Home<br>
					beech /black
				</div>-->
				<br/>
				<h3>Your order number is</h3>
				<div class="code"><?=$order->Order_ID?></div>
				<p>Please keep this order number for tracking letter.</p>
			</div>
			<div class="right">
				<p>An email will be sent to you shortly containing all the details of your order. If you do not recieive this email
				please phone or email us asap. You will receive another email when your order has been processed and goods dispatched.</p>

				<p>if you have any queries regarding your order you can get hold of us during normal business hours at the following contact details.</p>
				<h3>T: 02-683-5660-1</h3>
				<h3>E: contact@goodjobstore.com</h3>
			</div>
		</div>
		<div id="co_space">
		</div>