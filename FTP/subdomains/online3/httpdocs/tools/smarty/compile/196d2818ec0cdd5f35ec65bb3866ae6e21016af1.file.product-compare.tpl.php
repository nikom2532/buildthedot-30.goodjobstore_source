<?php /* Smarty version Smarty-3.0.7, created on 2012-06-28 20:46:46
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/themes/goodjob/./product-compare.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9271924834fec604697d888-86228234%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '196d2818ec0cdd5f35ec65bb3866ae6e21016af1' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/themes/goodjob/./product-compare.tpl',
      1 => 1334069946,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9271924834fec604697d888-86228234',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php if ($_smarty_tpl->getVariable('comparator_max_item')->value){?>
<script type="text/javascript">
// <![CDATA[
	var min_item = '<?php echo smartyTranslate(array('s'=>'Please select at least one product.','js'=>1),$_smarty_tpl);?>
';
	var max_item = "<?php echo smartyTranslate(array('s'=>'You cannot add more than','js'=>1),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->getVariable('comparator_max_item')->value;?>
 <?php echo smartyTranslate(array('s'=>'product(s) in the product comparator','js'=>1),$_smarty_tpl);?>
";
//]]>
</script>
	<form method="get" action="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('products-comparison.php');?>
" onsubmit="true">
		<p>
		<input type="submit" class="button" value="<?php echo smartyTranslate(array('s'=>'Compare'),$_smarty_tpl);?>
" style="float:right" />
		<input type="hidden" name="compare_product_list" class="compare_product_list" value="" />
		</p>
	</form>
<?php }?>

