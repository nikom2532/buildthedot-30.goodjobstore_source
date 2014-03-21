<?php /* Smarty version Smarty-3.0.7, created on 2012-04-29 23:28:02
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/blockfblike/fblike.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11453938424f9d6c126b3853-57552661%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01fb5aed7ad45e8673ceac64540166b7290c6599' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/blockfblike/fblike.tpl',
      1 => 1334066556,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11453938424f9d6c126b3853-57552661',
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
