<?php /* Smarty version Smarty-3.0.7, created on 2012-06-28 20:46:51
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/modules/blockfblike/fblike.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18375208954fec604b52e448-27184585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee39dfec0e24f5c4d2803bb8385a0b4a1a125f0b' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/modules/blockfblike/fblike.tpl',
      1 => 1334066556,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18375208954fec604b52e448-27184585',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<fb:like href="http://<?php echo $_SERVER['SERVER_NAME'];?>
<?php echo $_SERVER['REQUEST_URI'];?>
" send="false" width="450" show_faces="true" layout="button_count" show_faces="false"></fb:like>
