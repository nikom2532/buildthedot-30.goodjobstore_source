<?php /* Smarty version Smarty-3.0.7, created on 2012-04-30 10:12:35
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/homehighlight/homehighlight.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12139333194f9e0323e03c43-25758694%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9f05c3a61fdb3106740a899f37e6a8db6fca0f48' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/homehighlight/homehighlight.tpl',
      1 => 1334066926,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12139333194f9e0323e03c43-25758694',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- Block home module -->
<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('modules_dir')->value;?>
homehighlight/nivo-slider/themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('modules_dir')->value;?>
homehighlight/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
 <script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('modules_dir')->value;?>
homehighlight/nivo-slider/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#slider').nivoSlider({ effect:'fade' });
	});
</script>
	    
    <div class="homehighlight">
        <div class="slider-wrapper theme-default">
            <div class="ribbon"></div>
            <div id="slider" class="nivoSlider">
            <?php  $_smarty_tpl->tpl_vars['banner'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('banners')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['banner']->key => $_smarty_tpl->tpl_vars['banner']->value){
?>
            <?php if ($_smarty_tpl->tpl_vars['banner']->value['url']!=''){?>
            <a href="<?php echo $_smarty_tpl->tpl_vars['banner']->value['url'];?>
" target="_blank">
            <?php }?>
                <img src="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
module_hl/<?php echo $_smarty_tpl->tpl_vars['banner']->value['id_banner_highlight'];?>
.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['banner']->value['title'];?>
" border="0"  />
             <?php if ($_smarty_tpl->tpl_vars['banner']->value['url']!=''){?></a><?php }?>
            <?php }} ?>
            </div>
            
        </div>
	</div>
<!-- /Block home module -->
