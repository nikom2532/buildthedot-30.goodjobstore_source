<?php /* Smarty version Smarty-3.0.7, created on 2012-04-21 22:27:06
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/coolshare/soc.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8228184974f92d1ca06eb49-85268082%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f3a1bf4128f0e34196b945287f8dd421b79f394' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/coolshare/soc.tpl',
      1 => 1335021266,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8228184974f92d1ca06eb49-85268082',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/modifier.escape.php';
?><SCRIPT type="text/javascript">
$().ready(function() 

{ 
		$("#example2").jsocial({highlight: true,
							buttons: "", 
							imagedir: "modules/coolshare/files/", 
							imageextension: "png", 
							inline:true,
							blanktarget: true});
});

</SCRIPT>

<div id="example2" style=" position:relative; <?php echo $_smarty_tpl->getVariable('float')->value;?>
; width:<?php echo $_smarty_tpl->getVariable('width')->value;?>
px; height:<?php echo $_smarty_tpl->getVariable('height')->value;?>
; margin-left:<?php echo $_smarty_tpl->getVariable('margin')->value;?>
px; float:left" > 
 <?php if ($_smarty_tpl->getVariable('c1')->value=="yes"){?>

<a target="_blank" href="http://www.technorati.com/faves?add=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
" class="jsocial_button" title="technorati" style="opacity: 1; <?php echo $_smarty_tpl->getVariable('float')->value;?>
 "><img border="0" src="<?php echo $_smarty_tpl->getVariable('module_dir')->value;?>
files/technoratib<?php echo $_smarty_tpl->getVariable('formatcs')->value;?>
.png" alt="technorati" width="<?php echo $_smarty_tpl->getVariable('widthcs')->value;?>
" /></a>
<?php }else{ ?><?php }?>

<?php if ($_smarty_tpl->getVariable('c2')->value=="yes"){?>
<a target="_blank" href="http://del.icio.us/post?url=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
" class="jsocial_button" title="delicious" style="opacity: 1; <?php echo $_smarty_tpl->getVariable('float')->value;?>
 "><img border="0" src="<?php echo $_smarty_tpl->getVariable('module_dir')->value;?>
files/deliciousb<?php echo $_smarty_tpl->getVariable('formatcs')->value;?>
.png" alt="delicious" width="<?php echo $_smarty_tpl->getVariable('widthcs')->value;?>
" /></a>
<?php }else{ ?><?php }?>

<?php if ($_smarty_tpl->getVariable('c3')->value=="yes"){?>
<a target="_blank" href="http://reddit.com/submit?url=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
;title=<?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->getVariable('meta_title')->value,19,'...'),'htmlall','UTF-8');?>
" class="jsocial_button" title="reddit" style="opacity: 1;  <?php echo $_smarty_tpl->getVariable('float')->value;?>
"><img border="0" src="<?php echo $_smarty_tpl->getVariable('module_dir')->value;?>
files/redditb<?php echo $_smarty_tpl->getVariable('formatcs')->value;?>
.png" alt="reddit" width="<?php echo $_smarty_tpl->getVariable('widthcs')->value;?>
" /></a>
<?php }else{ ?><?php }?>

<?php if ($_smarty_tpl->getVariable('c4')->value=="yes"){?>
<a target="_blank" href="http://www.facebook.com/share.php?u=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
 " class="jsocial_button" title="facebook" style="opacity: 1; <?php echo $_smarty_tpl->getVariable('float')->value;?>
 "><img border="0" src="<?php echo $_smarty_tpl->getVariable('module_dir')->value;?>
files/facebookb<?php echo $_smarty_tpl->getVariable('formatcs')->value;?>
.png" alt="facebook" width="<?php echo $_smarty_tpl->getVariable('widthcs')->value;?>
" /></a>
<?php }else{ ?><?php }?>

<?php if ($_smarty_tpl->getVariable('c5')->value=="yes"){?>
<a target="_blank" href="http://twitter.com?status=<?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->getVariable('meta_title')->value,19,'...'),'htmlall','UTF-8');?>
-http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
 " class="jsocial_button" title="twitter" style="opacity: 1; <?php echo $_smarty_tpl->getVariable('float')->value;?>
 "><img border="0" src="<?php echo $_smarty_tpl->getVariable('module_dir')->value;?>
files/twitterb<?php echo $_smarty_tpl->getVariable('formatcs')->value;?>
.png" alt="twitter" width="<?php echo $_smarty_tpl->getVariable('widthcs')->value;?>
" /></a>
<?php }else{ ?><?php }?>

<?php if ($_smarty_tpl->getVariable('c6')->value=="yes"){?>
<a target="_blank" href="http://www.stumbleupon.com/submit?url=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
 &amp;title=<?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->getVariable('meta_title')->value,19,'...'),'htmlall','UTF-8');?>
" class="jsocial_button" title="stumbleupon" style="opacity: 1;  <?php echo $_smarty_tpl->getVariable('float')->value;?>
"><img border="0" src="<?php echo $_smarty_tpl->getVariable('module_dir')->value;?>
files/stumbleuponb<?php echo $_smarty_tpl->getVariable('formatcs')->value;?>
.png" alt="stumbleupon" width="<?php echo $_smarty_tpl->getVariable('widthcs')->value;?>
" /></a>
<?php }else{ ?><?php }?>

<?php if ($_smarty_tpl->getVariable('c7')->value=="yes"){?>
<a target="_blank" href="http://myweb2.search.yahoo.com/myresults/bookmarklet?u=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
?ref=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
&amp;t=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
&amp;title=<?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->getVariable('meta_title')->value,19,'...'),'htmlall','UTF-8');?>
" class="jsocial_button" title="yahoo" style="opacity: 1; <?php echo $_smarty_tpl->getVariable('float')->value;?>
 "><img border="0" src="<?php echo $_smarty_tpl->getVariable('module_dir')->value;?>
files/yahoob<?php echo $_smarty_tpl->getVariable('formatcs')->value;?>
.png" alt="yahoo" width="<?php echo $_smarty_tpl->getVariable('widthcs')->value;?>
" /></a>
<?php }else{ ?><?php }?>

<?php if ($_smarty_tpl->getVariable('c8')->value=="yes"){?>
<a target="_blank" href="http://digg.com/submit?phase=2&amp;url=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
?ref=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
&amp;title=<?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->getVariable('meta_title')->value,19,'...'),'htmlall','UTF-8');?>
" class="jsocial_button" title="digg" style="opacity: 1; <?php echo $_smarty_tpl->getVariable('float')->value;?>
 "><img border="0" src="<?php echo $_smarty_tpl->getVariable('module_dir')->value;?>
files/diggb<?php echo $_smarty_tpl->getVariable('formatcs')->value;?>
.png" alt="digg" width="<?php echo $_smarty_tpl->getVariable('widthcs')->value;?>
" /></a>
<?php }else{ ?><?php }?>


<?php if ($_smarty_tpl->getVariable('c10')->value=="yes"){?>
<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
&amp;title=<?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->getVariable('meta_title')->value,19,'...'),'htmlall','UTF-8');?>
&amp;summary=&amp;source=" class="jsocial_button" title="linkedin" style="opacity: 1; <?php echo $_smarty_tpl->getVariable('float')->value;?>
 "><img border="0" src="<?php echo $_smarty_tpl->getVariable('module_dir')->value;?>
files/linkedinb<?php echo $_smarty_tpl->getVariable('formatcs')->value;?>
.png" alt="flickr" width="<?php echo $_smarty_tpl->getVariable('widthcs')->value;?>
" /></a>
<?php }else{ ?><?php }?>
<?php if ($_smarty_tpl->getVariable('c11')->value=="yes"){?>
<a target="_blank" href="mailto:friend@email.com?SUBJECT=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
&amp;BODY=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
" class="jsocial_button" title="mail" style="opacity: 1; <?php echo $_smarty_tpl->getVariable('float')->value;?>
 "><img border="0" src="<?php echo $_smarty_tpl->getVariable('module_dir')->value;?>
files/mailb<?php echo $_smarty_tpl->getVariable('formatcs')->value;?>
.png" alt="flickr" width="<?php echo $_smarty_tpl->getVariable('widthcs')->value;?>
" /></a>
<?php }else{ ?><?php }?>
<?php if ($_smarty_tpl->getVariable('c12')->value=="yes"){?>
<a href="https://m.google.com/app/plus/x/?v=compose&content=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
" target="_blank" onclick="window.open('https://m.google.com/app/plus/x/?v=compose&content=http://<?php echo $_smarty_tpl->getVariable('servername')->value;?>
<?php echo $_smarty_tpl->getVariable('requesturi')->value;?>
','gplusshare','width=450,height=300,left='+(screen.availWidth/2-225)+',top='+(screen.availHeight/2-150)+'');return false;" class="jsocial_button" title="google+1" style="opacity: 1; <?php echo $_smarty_tpl->getVariable('float')->value;?>
 "><img src="<?php echo $_smarty_tpl->getVariable('module_dir')->value;?>
files/google<?php echo $_smarty_tpl->getVariable('formatcs')->value;?>
.png" alt="google" width="<?php echo $_smarty_tpl->getVariable('widthcs')->value;?>
"/></a>


<?php }else{ ?><?php }?>

</div>