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
                <li><a href="<?=site_url('preference')?>">Preference</a></li>
				<li class="current"><a href="<?=site_url('preference/property')?>">Property</a></li>
            </ul>
        </div> 
    </div>
		<!-- messages -->
			<?php
           		if($this->session->flashdata('message'))
               	{
                	$msg = $this->session->flashdata('message');
              	}
			?>
			<?php if(isset($msg)): ?>
				<div class="nNote nSuccess"><p><?=$msg['message']?></p></div>
			<?php endif;?>
			<?=(isset($ermsg))?'<div class="nNote nFailure"><p>'.$ermsg.'</p></div>':'';?>
			<?php echo validation_errors('<div class="nNote nFailure"><p>', '</p></div>'); ?>
		<!-- end messages -->
    <!-- Main content -->
	<div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu', 'class=main')?>
			<fieldset>
                <div class="widget fluid">
                    <div class="whead"><h6>Add Property</h6>
                    <div class="clear"></div></div>
                    
					<?//=form_open_multipart('preference/create_property_update')?>
					<form id="create_propertytest" class="main" action="<?=base_url('preference/create_property_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<div class="formRow">
                        <div class="grid3"><label>Image:<span class="req">*</span></label></div>
						<div class="grid3"><input type="file" name="userfile" class="styled"></div>
                        <div class="clear"></div>
                    </div>  
                    <div class="formRow">
                        <div class="grid3"><label>Name:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="name" id="name" value="<?=set_value('name', '')?>"/></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <div class="grid3"><label>Public:</label></div>
                        <div class="grid3 check"><input type="checkbox" name="public" value="1" <?=set_checkbox('public', '1')?>> Yes</div>
                        <div class="clear"></div>
                    </div>
					
                    <div class="formRow">
						<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("preference")?>'">
						<input type="submit" name ="submit" class="buttonS bLightBlue formSubmit" style="margin-right:10px" value="SUBMIT">
                        <div class="clear"></div>
                    </div>
                    </form>
					<?//=form_close()?>
               </div>
            </fieldset>
	</div>
	
	
	 <div class="wrapper">
    	<!-- Table with hidden toolbar -->
        <div class="widget">
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
		</fieldset>
	</div>
	<!-- Main content ends -->
    
</div>
<!-- Content ends -->    

