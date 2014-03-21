<?php
	if(LANG==1)
		$user = $this->session->userdata('user');
	else
		$user = get_user_lang($this->session->userdata('user')->admin_id);
?>

<!-- Sidebar begins -->
<div id="sidebar">
    <!-- Left nav -->
	<?
		echo $this->load->view('content/left_menu');
	?>
</div>
<!-- Sidebar ends -->

<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('content/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li class="current"><a href="<?=site_url('content')?>">Content</a></li>
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
			<?php echo validation_errors('<div class="nNote nFailure"><p>', '</p></div>'); ?>
		<!-- end messages -->
    <!-- Main content -->
	<div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu', 'class=main')?>
			<fieldset>
                <div class="widget fluid">
                    <div class="whead"><h6>Add Content</h6>
                    <div class="clear"></div></div>
                    
					<form id="create_content" class="main" action="<?=base_url('content/create_content_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<div class="formRow">
							<div class="grid3"><label>Subject:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="subject" id="subject"/></div>
							<div class="clear"></div>
						</div>  
						<div class="formRow">
							<div class="whead">
								<textarea id="editor" name="editor" rows="" cols="16"></textarea>
								<div class="clear"></div>
							</div>
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
            <div class="whead"><h6>Content</h6><div class="clear"></div></div>
            <div id="dyn" class="hiddenpars">
                <a class="tOptions" title="Options"><img src="<?=base_url()?>public/images/icons/options.png" alt="" /></a>
                <table cellpadding="0" cellspacing="0" border="0" class="dTable2" id="dynamic">
					<thead>
						<tr>
							<th>ID</th>
							<th>Subject</th>
							<th>Date</th>
							<th class="th2">Actions</th>
						</tr>
					</thead>
					<tbody id="field_id">
						<?php foreach(get_content_list() as $value): ?>
							<tr>
								<td><?=$value->content_id?></td>
								<td><?=$value->subject?></td>
								<td><?=set_dateTime($value->last_update)?></td>
								<td>
									<a href="<?=base_url("content/edit/".$value->content_id)?>" class="tablectrl_small bDefault tipS" title="Edit"><span class="iconb" data-icon="&#xe004;"></span></a>
									<a href="<?=base_url("content/delect_content/".$value->content_id)?>" class="tablectrl_small bDefault tipS" title="Remove" onClick="return conf('Are you sure you want to remove content id <?=$value->content_id?>?');">
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
