<?php
	if(LANG==1)
		$user = $this->session->userdata('user');
	else
		$user = get_user_lang($this->session->userdata('user')->admin_id);
?>

<!-- Sidebar begins -->
<div id="sidebar">
    <!-- Left nav -->
	<?=$this->load->view('product/left_menu');?>
</div>
<!-- Sidebar ends -->

<!-- Content begins -->
<div id="content">
	<!-- Top bar -->
	<?=$this->load->view('product/top_menu');?>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="<?=site_url('dashboard')?>">Dashboard</a></li>
                <li><a href="<?=site_url('product')?>">Product</a></li>
                <li class="current"><a href="<?=site_url('product/group/create')?>">Add Product Group</a></li>
            </ul>
        </div> 
    </div>
		<!-- messages -->
			<?php echo validation_errors('<div class="nNote nFailure"><p>', '</p></div>'); ?>
		<!-- end messages -->
    <!-- Main content -->
    <div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu', 'class=main')?>
            <fieldset>
                <div class="widget fluid">
                    <div class="whead"><h6>Add Product Group</h6>
                    <div class="clear"></div></div>
					<?//=form_open_multipart('product/create_product_group_update')?>
                    <form id="create_product_group" class="main" action="<?=base_url('product/create_product_group_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
					<div class="formRow">
                        <div class="grid3"><label>Product Code:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="progroup_id" id="progroup_id" value="<?=set_value('progroup_id', '')?>"/></div>
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
                        <div class="grid3"><label>Url:<span class="req">*</span></label></div>
                        <div class="grid3"><input type="text" name="url" id="url" value="<?=set_value('url', '')?>"/></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <div class="grid3"><label>Title:</label></div>
                        <div class="grid3"><input type="text" name="title" id="title" value="<?=set_value('title', '')?>"/></div>
                        <div class="clear"></div>
                    </div>

					<div class="formRow">
                        <div class="grid3"><label>Meta Keyword:</label></div>
                        <fieldset>
							<div class="widget" style="border:0px; box-shadow:none;">
								<div class="body dualBoxes">
									<div class="leftBox">
										<input type="text" id="box1Filter" class="boxFilter" placeholder="Filter entries..." />
										<button type="button" id="box1Clear" class="dualBtn fltr">x</button><br />
										
										<select id="box1View" multiple="multiple" class="multiple" style="height:300px;">
											<?php foreach(get_keygroup_list() as $value): ?>
												<option value="<?=$value->keygroup_id?>"><?=$value->name?></option>
											<?php endforeach; ?>
										</select>
										<br/>
										<span id="box1Counter" class="countLabel"></span>
										
										<div class="displayNone"><select id="box1Storage"></select></div>
									</div>
											
									<div class="dualControl">
										<button id="to2" type="button" class="dualBtn mr5 mb15">&nbsp;&gt;&nbsp;</button>
										<button id="allTo2" type="button" class="dualBtn">&nbsp;&gt;&gt;&nbsp;</button><br />
										<button id="to1" type="button" class="dualBtn mr5">&nbsp;&lt;&nbsp;</button>
										<button id="allTo1" type="button" class="dualBtn">&nbsp;&lt;&lt;&nbsp;</button>
									</div>
											
									<div class="rightBox">
										<input type="text" id="box2Filter" class="boxFilter" placeholder="Filter entries..." />
										<button type="button" id="box2Clear" class="dualBtn fltr">x</button><br />

										<select name="meta_keyword[]" id="box2View" multiple="multiple" class="multiple" style="height:300px;">
										</select><br/>

										<span id="box2Counter" class="countLabel"></span>
										
										<div class="displayNone"><select id="box2Storage"></select></div>
									</div>
								</div>
							</div>
						</fieldset>
                    </div>

					<div class="formRow">
                        <div class="grid3"><label>Meta Description:</label></div>
                        <div class="grid9"><textarea rows="8" name="meta_description" id="meta_description" value="<?=set_value('meta_description', '')?>"></textarea></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
						<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("product")?>'">
						<input type="submit" name ="submit" class="buttonS bLightBlue formSubmit" style="margin-right:10px" value="SUBMIT">
                        <div class="clear"></div>
                    </div>
					</form>	
					<?//=form_close()?>
               </div>
            </fieldset>
	</div>
	<!-- Main content ends -->
    
</div>
<!-- Content ends -->    
