<?php /* Smarty version Smarty-3.0.7, created on 2012-05-14 00:48:04
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/themes/goodjob/cms.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10972345324faff3d4da2305-39901898%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '63b2064c7c36653e659fca5492cefceaaf4f277d' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/themes/goodjob/cms.tpl',
      1 => 1335006022,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10972345324faff3d4da2305-39901898',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/tools/smarty/plugins/modifier.escape.php';
?>
<?php if (isset($_smarty_tpl->getVariable('cms',null,true,false)->value)&&$_smarty_tpl->getVariable('cms')->value->id!=$_smarty_tpl->getVariable('cgv_id')->value){?>
	<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./breadcrumb.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<?php }?>


<div id="shoppingGuide">
 
<?php if (isset($_smarty_tpl->getVariable('cms',null,true,false)->value)&&!isset($_smarty_tpl->getVariable('category',null,true,false)->value)){?>
	<?php if (!$_smarty_tpl->getVariable('cms')->value->active){?>
		<br />
		<div id="admin-action-cms">
			<p><?php echo smartyTranslate(array('s'=>'This CMS page is not visible to your customers.'),$_smarty_tpl);?>

			<input type="hidden" id="admin-action-cms-id" value="<?php echo $_smarty_tpl->getVariable('cms')->value->id;?>
" />
			<input type="submit" value="<?php echo smartyTranslate(array('s'=>'Publish'),$_smarty_tpl);?>
" class="exclusive" onclick="submitPublishCMS('<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
<?php echo $_GET['ad'];?>
', 0)"/>			
			<input type="submit" value="<?php echo smartyTranslate(array('s'=>'Back'),$_smarty_tpl);?>
" class="exclusive" onclick="submitPublishCMS('<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
<?php echo $_GET['ad'];?>
', 1)"/>			
			</p>
			<div class="clear" ></div>
			<p id="admin-action-result"></p>
			</p>
		</div>
	<?php }?>
    
    
    <?php if ($_smarty_tpl->getVariable('content_only')->value){?>
    
    <div style="text-align: left">
    <?php echo $_smarty_tpl->getVariable('cms')->value->content;?>
 
    </div>
    
	<?php }elseif($_smarty_tpl->getVariable('cms')->value->id==12){?>
    
    <h1 class="store_locator"><?php echo $_smarty_tpl->getVariable('cms')->value->meta_title;?>
</h1>
    <?php echo $_smarty_tpl->getVariable('cms')->value->content;?>
 
    
    <?php }else{ ?>
    <h1><?php echo $_smarty_tpl->getVariable('cms')->value->meta_title;?>
</h1>
    
     <div id="shoppingGuideLeft">
        <ul>
            <li><a <?php if ($_smarty_tpl->getVariable('cms')->value->id==4){?> class="active" <?php }?> href="http://online.goodjobstore.com/cms.php?id_cms=4"><?php echo smartyTranslate(array('s'=>'About Us'),$_smarty_tpl);?>
</a></li>
            <li><a <?php if ($_smarty_tpl->getVariable('cms')->value->id==1){?> class="active" <?php }?> href="http://online.goodjobstore.com/cms.php?id_cms=1"><?php echo smartyTranslate(array('s'=>'Payment'),$_smarty_tpl);?>
</a></li>
            <li><a <?php if ($_smarty_tpl->getVariable('cms')->value->id==8){?> class="active" <?php }?>  href="http://online.goodjobstore.com/cms.php?id_cms=8"><?php echo smartyTranslate(array('s'=>'Delivery'),$_smarty_tpl);?>
</a></li>
			<li><a <?php if ($_smarty_tpl->getVariable('cms')->value->id==9){?> class="active" <?php }?> href="http://online.goodjobstore.com/cms.php?id_cms=9"><?php echo smartyTranslate(array('s'=>'Return & Exchange'),$_smarty_tpl);?>
</a></li>
        </ul>
    </div>
	
	<div id="shoppingGuideRight" class="rte<?php if ($_smarty_tpl->getVariable('content_only')->value){?> content_only<?php }?>">

    	<?php if ($_smarty_tpl->getVariable('cms')->value->id==4){?>
        <div id="shoppingGuideRightSub">
        	 <script type='text/javascript' src='/lib/mediaplayer-5.8-viral/jwplayer.js'></script>
              <div id='mediaspace'>Player Loading...</div>
              <script type='text/javascript'>
                jwplayer('mediaspace').setup({
                   'flashplayer': '/lib/mediaplayer-5.8-viral/player.swf',
                   'file': '/lib/about-us.mp4',
                   'width': '350',
                   'height': '230',
                   'autostart': 'false',
				   'image': '<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
video-about-us.jpg',
                   'skin': '/lib/mediaplayer-5.8-viral/skins/glow.zip'
                });
              </script>
              
              <div id="blockContact">
              <h2><?php echo smartyTranslate(array('s'=>'GET IN TOUCH'),$_smarty_tpl);?>
</h2>
              <script type="text/javascript">
			  $(document).ready(function(){
					$('#contactForm #btnSend').click(function(){
						if($('#contactForm #email').val() == ''){
							alert('Please fill e-mail');
						}else if($('#contactForm #name').val() == ''){
							alert('Please fill name');
						}else if($('#contactForm #message').val() == ''){
							alert('Please fill message');
						}else{
							alert('Send complete');
							$('#contactForm #email').val('');
							$('#contactForm #country').val('');
							$('#contactForm #name').val('');
							$('#contactForm #message').val('');
						}					 
					});
			  });
			  </script>
              <form id="contactForm" name="contactForm" method="post" action="">
              <table id="tblContact" width="360" border="0" cellspacing="0" cellpadding="2" style="border: none;">
                  <tr>
                    <td width="168"><?php echo smartyTranslate(array('s'=>'E-mail'),$_smarty_tpl);?>
</td>
                    <td width="178" style="padding-left: 10px;"><?php echo smartyTranslate(array('s'=>'Country'),$_smarty_tpl);?>
</td>
                  </tr>
                  <tr>
                    <td><input name="email" type="text" id="email" maxlength="255" /></td>
                    <td align="right"><input name="country" type="text" id="country" maxlength="50" /></td>
                  </tr>
                  <tr>
                    <td colspan="2"><?php echo smartyTranslate(array('s'=>'Name'),$_smarty_tpl);?>
 - <?php echo smartyTranslate(array('s'=>'Last Name'),$_smarty_tpl);?>
</td>
                  </tr>
                  <tr>
                    <td colspan="2"><input name="name" type="text" id="name" maxlength="255" /></td>
                  </tr>
                  <tr>
                    <td colspan="2"><?php echo smartyTranslate(array('s'=>'Message'),$_smarty_tpl);?>
</td>
                  </tr>
                  <tr>
                    <td colspan="2"><textarea name="message" rows="5" id="message"></textarea></td>
                  </tr>
                  <tr>
                    <td colspan="2"><input type="button" name="btnSend" id="btnSend" value="SEND" /></td>
                  </tr>
                </table>
              </form>
              </div>
              
        </div>
        <div id="shoppingGuideRightSub2">
        	<?php echo $_smarty_tpl->getVariable('cms')->value->content;?>
        
        </div>
        <?php }else{ ?>
        	<div id="shoppingGuideRightSub3">
        	<?php echo $_smarty_tpl->getVariable('cms')->value->content;?>
        
            </div>
        <?php }?>
        
	</div>
    
    <?php }?>
    
<?php }elseif(isset($_smarty_tpl->getVariable('category',null,true,false)->value)){?>

	<div class="block-cms">
        
        <h1><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('category')->value->name,'htmlall','UTF-8');?>
</h1>
        
		<?php if (isset($_smarty_tpl->getVariable('sub_category',null,true,false)->value)&!empty($_smarty_tpl->getVariable('sub_category',null,true,false)->value)){?>
            
			<ul class="bullet">
				<?php  $_smarty_tpl->tpl_vars['subcategory'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('sub_category')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['subcategory']->key => $_smarty_tpl->tpl_vars['subcategory']->value){
?>
					<li>
						<a href="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('link')->value->getCMSCategoryLink($_smarty_tpl->tpl_vars['subcategory']->value['id_cms_category'],$_smarty_tpl->tpl_vars['subcategory']->value['link_rewrite']),'htmlall','UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['subcategory']->value['name'],'htmlall','UTF-8');?>
</a>
					</li>
				<?php }} ?>
			</ul>
		<?php }?>
		<?php if (isset($_smarty_tpl->getVariable('cms_pages',null,true,false)->value)&!empty($_smarty_tpl->getVariable('cms_pages',null,true,false)->value)){?>
        
        <div id="shoppingGuideLeft2">
			<ul>
				<?php  $_smarty_tpl->tpl_vars['cmspages'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cms_pages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cmspages']->key => $_smarty_tpl->tpl_vars['cmspages']->value){
?>
					<li>
						<a href="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('link')->value->getCMSLink($_smarty_tpl->tpl_vars['cmspages']->value['id_cms'],$_smarty_tpl->tpl_vars['cmspages']->value['link_rewrite']),'htmlall','UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['cmspages']->value['meta_title'],'htmlall','UTF-8');?>
</a>
					</li>
				<?php }} ?>
			</ul>
          </div>
		<?php }?>
	</div>
    
<?php }else{ ?>
	<?php echo smartyTranslate(array('s'=>'This page does not exist.'),$_smarty_tpl);?>

<?php }?>
</div>