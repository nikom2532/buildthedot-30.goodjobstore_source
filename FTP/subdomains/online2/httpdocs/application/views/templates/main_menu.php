<?php
	$user = $this->session->userdata('user');
	if(LANG==1)
		$user_lang = $user;
	else
		$user_lang = get_user_lang($user->admin_id);
?>

	<div class="mainNav">
        <div class="user">
            <a href=""><img src="<?=base_url()?><?=($user_lang->pic=='')?'public/images/users/userLogin2.png':$user_lang->pic;?>" alt="" style="width:72px;"/></a>
			<span><?=$user_lang->firstname." ".$user_lang->lastname?></span>
        </div>
        
        <!-- Sidebar menu nav -->

		<ul class="nav">
			<?php foreach(get_menu() as $value):?>
				<li><a href="<?=site_url($value->url)?>" <?=($active_menu==$value->menu_id)?'class="active"':'';?>><img src="<?=base_url($value->pic)?>" /><span><?=$value->name?></span></a></li>
			<?php endforeach; ?>
		</ul>
    </div>
		