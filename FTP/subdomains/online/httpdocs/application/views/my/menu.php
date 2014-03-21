	<div id="leftcolum">
	    <ul>
	        <li><a class="<?=($this->uri->segment(2)=='notification')?'active':''?>" href="<?=site_url('my/notification')?>">Notification</a></li>
	        <li><a class="<?=($this->uri->segment(2)=='info')?'active':''?>" href="<?=site_url('my/info')?>">My info</a></li>
	        <li><a class="<?=($this->uri->segment(2)=='history')?'active':''?>" href="<?=site_url('my/history')?>">Order History</a></li>
			<li><a class="<?=($this->uri->segment(2)=='wishlist')?'active':''?>" href="<?=site_url('my/wishlist')?>">Wishlist</a></li>
			<li><a class="<?=($this->uri->segment(1)=='cart')?'active':''?>" href="<?=site_url('cart')?>">My cart</a></li>
	    </ul>
	</div>