<?php /* Smarty version Smarty-3.0.7, created on 2012-04-30 10:12:34
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/blockfblike/metadata.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13298652984f9e0322d305f2-74751929%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '82e2e18c215af6f25d7142ccc34d48d047cb7244' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/blockfblike/metadata.tpl',
      1 => 1334066558,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13298652984f9e0322d305f2-74751929',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<meta property="og:title" content="<?php echo $_smarty_tpl->getVariable('product')->value->name;?>
"/> 
<meta property="og:image " content="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->getVariable('product')->value->link_rewrite,$_smarty_tpl->getVariable('cover')->value['id_image'],'large');?>
"/> 
<meta property="og:url" content="<?php echo $_smarty_tpl->getVariable('productLink')->value;?>
"/>
<meta property="og:description" content="<?php echo strip_tags($_smarty_tpl->getVariable('product')->value->description);?>
"/>
<meta property="og:site_name" content="<?php echo $_smarty_tpl->getVariable('shop_name')->value;?>
"/> 
