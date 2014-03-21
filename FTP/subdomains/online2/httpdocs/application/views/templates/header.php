<?php	
	$logout_url = '#';
	if($this->session->userdata('logged_in'))
		$logout_url = site_url("logout");
?>

<!-- Top line begins -->
<div id="top">
	<div class="wrapper">
    	<a href="#" title="" class="logo"><img src="<?=base_url()?>public/images/logo.png" alt="" /></a>
        
        <!-- Right top nav -->
        <div class="topNav">
            <ul class="userNav">
		
				<li><a href="<?=site_url('dashboard/lang/1')?>" title="" class="en"></a></li>
				<li><a href="<?=site_url('dashboard/lang/2')?>" title="" class="th"></a></li>
				<li><a href="<?=site_url('dashboard/lang/3')?>" title="" class="ru"></a></li>
                <li><a href="<?=$logout_url?>" title="" class="logout"></a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- Top line ends -->