<?php
	$user = $this->session->userdata('user');
?>

<!-- Sidebar begins -->
<div id="sidebar">
    <!-- Left nav -->
	<?=$this->load->view('preference/left_menu');?>
</div>
<!-- Sidebar ends -->
	
    
<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('preference/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
                <li class="current"><a href="<?=site_url('preference')?>">Preference</a></li>
            </ul>
        </div> 
    </div>
  
    <!-- Main content -->
	  <div class="wrapper">
    	<!-- Rounded buttons -->
		  <?=$this->load->view('templates/middle_menu', 'class=main')?>
				<!--<div class="widget fluid">
					<div class="whead">
						<h6>Index</h6>
						<div class="clear"></div>
					</div>
				</div>
	
	<!-- Color -->
<div class="fluid">	
      <div class="widget grid6">    
            <div class="whead"><h6>Colors</h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>Rank</th>
							<th>Name</th>
							<th>Public</th>
							<th>Image</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?php foreach(get_color_list() as $value): ?>
							<tr>
								<td><?=$value->rank?></td>
								<td><?=$value->name?></td>
								<td><?=($value->public==1)?'Yes':'No';?></td>
								<td align="center">
								<? if ($value->path == NULL): ?>
								<img style="height:25; width:25px;" src=""/>
								<? else: ?>
								<img style="height:25; width:25px;" src="<?=base_url()?><?=$value->path?>"/>
								<? endif;?>
								</td>
								<td>
									<a href="<?=base_url("preference/color/edit/".$value->name)?>" class="tablectrl_small bDefault tipS" title="Edit">
										<span class="iconb" data-icon="&#xe004;"></span>
									</a>
									<a href="<?=base_url("preference/delete_color/".$value->color_id)?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove color <?=$value->name?>?');">
										<span class="iconb" data-icon="&#xe096;"></span>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
	</div>
	<!-- Color end -->
	
	<!-- Property -->
    <div class="widget grid6">    
            <div class="whead"><h6>Properties</h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>Rank</th>
							<th>Name</th>
							<th>Public</th>
							<th>Path</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?php foreach(get_property_list() as $value): ?>
							<tr>
								<td><?=$value->rank?></td>
								<td><?=$value->name?></td>
								<td><?=($value->public==1)?'Yes':'No';?></td>
								<td align="center">
								<? if ($value->path == NULL): ?>
								<img style="height:25; width:25px;" src=""/>
								<? else: ?>
								<img style="height:25; width:25px;" src="<?=base_url()?><?=$value->path?>"/>
								<? endif;?>
								</td>
								<td>
									<a href="<?=base_url("preference/property/edit/".$value->name)?>" class="tablectrl_small bDefault tipS" title="Edit">
										<span class="iconb" data-icon="&#xe004;"></span>
									</a>
									<a href="<?=base_url("preference/delete_property/".$value->prop_id)?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove property <?=$value->name?>?');">
										<span class="iconb" data-icon="&#xe096;"></span>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
	</div>
	<!-- Property end -->
</div>
<div class="fluid">
	
	<!-- Keyword Group -->
	<div class="widget grid6">
            <div class="whead"><h6>Groups Keywords</h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>No.</th>
							<th>Name</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?$i=1;?>
						<?php foreach(get_keygroup_list() as $value): ?>
							<tr>
								<td><?=$i?> </td>
								<td><?=$value->name?></td>
								<td>
									<a href="<?=base_url("preference/keyword_group/edit/".$value->name)?>" class="tablectrl_small bDefault tipS" title="Edit">
										<span class="iconb" data-icon="&#xe004;"></span>
									</a>
									<a href="<?=base_url("preference/delete_keyword_group/".$value->keygroup_id)?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove keyword group <?=$value->name?>?');">
										<span class="iconb" data-icon="&#xe096;"></span>
									</a>
								</td>
							</tr>
							<? $i++;?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
	</div>
	<!-- Keyword Group end -->
	
	<!-- Keyword -->
	
	<div class="widget grid6">
            <div class="whead"><h6>Keywords</h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>No.</th>
							<th>Name</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?$i=1;?>
						<?php foreach(get_keyword_list() as $value): ?>
							<tr>
								<td><?=$i?></td>
								<td><?=$value->name?></td>
								<td>
									<a href="<?=base_url("preference/keyword/edit/".$value->name)?>" class="tablectrl_small bDefault tipS" title="Edit">
										<span class="iconb" data-icon="&#xe004;"></span>
									</a>
									<a href="<?=base_url("preference/delete_keyword/".$value->keyword_id)?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove keyword <?=$value->name?>?');">
										<span class="iconb" data-icon="&#xe096;"></span>
									</a>
								</td>
							</tr>
							<? $i++;?>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
	</div>
	<!-- Keyword end -->
</div>	
	
	<!-- Attribute -->
	<div class="widget grid6">
            <div class="whead"><h6>Attributes</h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>No.</th>
							<th>Name</th>
							<th>Public</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?$i=1;?>
						<?php foreach(get_attribute_list() as $value): ?>
							<tr>
							<td><?=$i?></td>
								<td><?=$value->name?></td>
								<td><?=($value->public==1)?'Yes':'No';?></td>
								<td>
									<a href="<?=base_url("preference/attribute/edit/".$value->name)?>" class="tablectrl_small bDefault tipS" title="Edit">
										<span class="iconb" data-icon="&#xe004;"></span>
									</a>
									<a href="<?=base_url("preference/delete_attribute/".$value->attribute_id)?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove attribute <?=$value->name	?>?');">
										<span class="iconb" data-icon="&#xe096;"></span>
									</a>
								</td>
							</tr>
							<? $i++;?>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
	</div>
	<!-- Attribute -->
	<!-- Main content ends -->
    
</div>

<!-- Content ends -->    

