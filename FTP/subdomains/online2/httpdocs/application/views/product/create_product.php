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
                <li><a href="<?=site_url('product/view/'.$group_detail->url)?>"><?=$group_detail->name?></a></li>
                <li class="current"><a href="<?=site_url('product/view/'.$group_detail->url.'/create')?>">Add Product</a></li>
            </ul>
        </div> 
    </div>
		<!-- messages -->
			<?=(isset($ermsg))?'<div class="nNote nFailure"><p>'.$ermsg.'</p></div>':'';?>
			<?php echo validation_errors('<div class="nNote nFailure"><p>', '</p></div>'); ?>
		<!-- end messages -->
    <!-- Main content -->
    <div class="wrapper">
    	<!-- Rounded buttons -->
		<?=$this->load->view('templates/middle_menu', 'class=main')?>
            <fieldset>
                <div class="widget fluid">
                    <div class="whead"><h6>Add Product <?=$group_detail->name?></h6>
                    <div class="clear"></div></div>
                    
					<?//=form_open_multipart('product/create_update')?>
					<form id="create_producttest" class="main" action="<?=base_url('product/create_update')?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
						<input type="hidden" name="progroup_url" value="<?=$group_detail->url?>"/>
						<input type="hidden" name="progroup_id" value="<?=$group_detail->progroup_id?>"/>
						<div class="formRow">
							<div class="grid3"><label>Image:<span class="req">*</span></label></div>
							<div class="grid3"><input type="file" name="userfile1" class="styled"></div>
							<div class="clear"></div><br>

							<div class="grid3" style="margin-left:0px;"><label><span class="req"></span></label></div>
							<div class="grid3"><input type="file" name="userfile2" class="styled"></div>
							<div class="clear"></div><br>

							<div class="grid3" style="margin-left:0px;"><label><span class="req"></span></label></div>
							<div class="grid3"><input type="file" name="userfile3" class="styled"></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Name:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="name" id="name" value="<?=set_value('name', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Property:<span class="req">*</span></label></div>
								<div class="grid3">
								<select name="prop_id" id="prop_id" >
									<option value="">------ Select Property -----</option>
									<?php foreach(get_property_list() as $value): ?>
										<option value="<?=$value->prop_id?>" <?=set_select('prop_id',$value->prop_id)?>><?=$value->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Color:<span class="req">*</span></label></div>
							<div class="grid3">
							<select name="color_id" id="color_id" >
									<option value="">------ Select Color -----</option>
								<?php foreach(get_color_list() as $value): ?>
									<option value="<?=$value->color_id?>" <?=set_select('color_id',$value->color_id)?>><?=$value->name?></option>
								<?php endforeach; ?>
							</select>
							</div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Attribute:<span class="req">*</span></label></div>
								<div class="grid3">
								<select name="attribute_id" id="attribute_id" >
									<option value="">------ Select Attribute -----</option>
									<?php foreach(get_attribute_list() as $value): ?>
										<option value="<?=$value->attribute_id?>" <?=set_select('attribute_id',$value->attribute_id)?>><?=$value->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Size:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="size" id="size" value="<?=set_value('size', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Weight:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="weight" id="weight" value="<?=set_value('weight', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Price:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="price" id="price" value="<?=set_value('price', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Discount:</label></div>
							<div class="grid3"><input type="text" name="discount" id="discount" value="<?=set_value('discount', '')?>"/></div>
							<div class="grid2"><label>Discount Type:</label></div>
							<div class="grid3" >
								<select name="discount_type" id="discount_type">
									<option value=''>------ Select Type -----</option>
									<option value="1">Percent</option>
									<option value="2">Bath</option>
								</select>
							</div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Qty:<span class="req">*</span></label></div>
							<div class="grid3"><input type="text" name="qty" id="qty" value="<?=set_value('qty', '')?>"/></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Keyword:</label></div>
							<fieldset>
								<div class="widget" style="border:0px; box-shadow:none;">
									<div class="body dualBoxes">
										<div class="leftBox">
											<input type="text" id="box1Filter" class="boxFilter" placeholder="Filter entries..." />
											<button type="button" id="box1Clear" class="dualBtn fltr">x</button><br />
											
											<select id="box1View" multiple="multiple" class="multiple" style="height:300px;">
												<?php foreach(get_keyword_list() as $value): ?>
													<option value="<?=$value->keyword_id?>"><?=$value->name?></option>
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
							<div class="grid3"><label>Description:</label></div>
							<div class="grid9"><textarea rows="8" name="description" id="description" value="<?=set_value('description', '')?>"></textarea></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Primary:</label></div>
							<div class="grid3 check"><input type="checkbox" name="primary" value="1" <?=set_checkbox('primary', '1')?>> Yes</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Public:</label></div>
							<div class="grid3 check"><input type="checkbox" name="public" value="1" <?=set_checkbox('public', '1')?>> Yes</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<div class="grid3"><label>Flag:</label></div>
							<div class="grid3">
								<select name="flag" id="flag" >
									<option value="">------ Select Flag -----</option>
									<option value="1">Hot</option>
									<option value="2">New</option>
									<option value="3">Sale</option>
								</select>
							</div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<input type="button" class="buttonS bSea formSubmit" value="CANCEL" onClick="window.location.href='<?=base_url("product/view/".$group_detail->url)?>'">
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
