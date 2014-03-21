
        
	<!-- Main nav -->
	<?
		$data['active_menu'] = '5';
		echo $this->load->view('templates/main_menu', $data);
	?>

	<div class="secNav">
		<div class="secWrapper">
			<div class="secTop">
                <div class="balance">
                    <div class="balInfo">Balance:<span>Apr 21 2012</span></div>
                    <div class="balAmount"><span class="balBars"><!--5,10,15,20,18,16,14,20,15,16,12,10--></span><span>$58,990</span></div>
                </div>
            </div>
			<!-- Tabs container -->
			<div id="tab-container" class="tab-container">
				<ul class="iconsLine ic2 etabs">
					<li><a href="#tabs1" title=""><span class="icos-dcalendar"></span></a></li>
					<li><a href="#tabs2" title=""><!--<span class="icos-user"></span>--></a></li>
				</ul> 
                <div class="divider"><span></span></div>

                <div id="tabs1">
                	<div class="sidePad">
						<a href="<?=base_url('category/create')?>" title="" class="sideB bBlue mt10"><span class="icon-plus-2"></span>ADD CATEGORY</a>
					</div>
					<div class="divider"><span></span></div>	
					<!-- Category list -->
					<ul class="subNav">
						<?php foreach(get_category_main_list() as $value): ?>
							<li>
								<a href="#" title="" class="exp"><span class="icos-folder"></span><?=$value->name?></a>
								<ul>
									<?php foreach(get_category_sub_list($value->cat_id) as $value2): ?>
										<li>
											<a href="#" title="" class="exp"><?=$value2->name?></a>
											<ul>
												<?php foreach(get_category_sub2_list($value2->cat_id) as $value3): ?>
													<li style="margin-left:20px;"><a href="#" title=""><?=$value3->name?></a></li>
												<?php endforeach; ?>
											</ul>
										</li>
									<?php endforeach; ?>
								</ul>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
                <div class="divider"><span></span></div>			                    
			</div>
		</div> 
		<div class="clear"></div>
	</div>