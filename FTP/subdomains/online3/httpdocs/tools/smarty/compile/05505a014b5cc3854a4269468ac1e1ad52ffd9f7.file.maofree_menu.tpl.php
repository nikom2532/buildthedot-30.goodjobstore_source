<?php /* Smarty version Smarty-3.0.7, created on 2012-04-16 21:05:32
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/maofree_menu/maofree_menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10832540774f8c272c333107-37695322%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '05505a014b5cc3854a4269468ac1e1ad52ffd9f7' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/maofree_menu/maofree_menu.tpl',
      1 => 1334584847,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10832540774f8c272c333107-37695322',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/tools/smarty/plugins/modifier.escape.php';
?></div>

<?php if ($_smarty_tpl->getVariable('mao_instantsearch')->value){?>
	<script type="text/javascript">
	// <![CDATA[
		
		function tryToCloseInstantSearch() {
			if ($('#old_center_column').length > 0)
			{
				$('#center_column').remove();
				$('#old_center_column').attr('id', 'center_column');
				$('#center_column').show();
				return false;
			}
		}
		
		instantSearchQueries = new Array();
		function stopInstantSearchQueries(){
			for(i=0;i<instantSearchQueries.length;i++) {
				instantSearchQueries[i].abort();
			}
			instantSearchQueries = new Array();
		}
		
		$("#mao_search_query_top").keyup(function(){
			if($(this).val().length > 0){
				stopInstantSearchQueries();
				instantSearchQuery = $.ajax({
				url: '<?php if ($_smarty_tpl->getVariable('mao_search_ssl')->value==1){?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php',true);?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php');?>
<?php }?>',
				data: 'instantSearch=1&id_lang=<?php echo $_smarty_tpl->getVariable('cookie')->value->id_lang;?>
&q='+$(this).val(),
				dataType: 'html',
				success: function(data){
					if($("#mao_search_query_top").val().length > 0)
					{
						tryToCloseInstantSearch();
						$('#center_column').attr('id', 'old_center_column');
						$('#old_center_column').after('<div id="center_column">'+data+'</div>');
						$('#old_center_column').hide();
						$("#instant_search_results a.close").click(function() {
							$("#mao_search_query_top").val('');
							return tryToCloseInstantSearch();
						});
						return false;
					}
					else
						tryToCloseInstantSearch();
					}
				});
				instantSearchQueries.push(instantSearchQuery);
			}
			else
				tryToCloseInstantSearch();
		});
	// ]]>
	
	</script>
<?php }?>

<?php if ($_smarty_tpl->getVariable('mao_ajaxsearch')->value){?>
	<script type="text/javascript">
	// <![CDATA[
	
		$('document').ready( function() {
			$("#mao_search_query_top")
				.autocomplete(
					'<?php if ($_smarty_tpl->getVariable('mao_search_ssl')->value==1){?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php',true);?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php');?>
<?php }?>', {
						minChars: 3,
						max: 10,
						width: 500,
						selectFirst: false,
						scroll: false,
						dataType: "json",
						formatItem: function(data, i, max, value, term) {
							return value;
						},
						parse: function(data) {
							var mytab = new Array();
							for (var i = 0; i < data.length; i++)
								mytab[mytab.length] = { data: data[i], value: data[i].cname + ' > ' + data[i].pname };
							return mytab;
						},
						extraParams: {
							ajaxSearch: 1,
							id_lang: <?php echo $_smarty_tpl->getVariable('cookie')->value->id_lang;?>

						}
					}
				)
				.result(function(event, data, formatted) {
					$('#mao_search_query_top').val(data.pname);
					document.location.href = data.product_link;
				})
		});
	
	// ]]>
	</script>
<?php }?>

<div id="maomenucontainer">
   <?php if ($_smarty_tpl->getVariable('mao_theme')->value){?>
	   <div class="maomenu-left"></div>
		<div class="maomenu-right"></div>
	<?php }?>	
	<ul class="maomenu-horizontal">
	   <?php if ($_smarty_tpl->getVariable('maomenuhome')->value){?>
		   <li class="maomenu-home"><a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
">&nbsp;</a></li>
	   <?php }?>
	   <?php if ($_smarty_tpl->getVariable('maomenumodecatview')->value){?>
			<li><a href="<?php echo $_smarty_tpl->getVariable('maomenuCategTree')->value['link'];?>
"><?php echo smartyTranslate(array('s'=>'Categories','mod'=>'maofree_menu'),$_smarty_tpl);?>
<?php if ($_smarty_tpl->getVariable('maomenurootarrow')->value){?><span class="arrow-maomenu"></span><?php }?></a>
				<ul>
	   <?php }?>
		<?php  $_smarty_tpl->tpl_vars['child'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('maomenuCategTree')->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['child']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['child']->iteration=0;
if ($_smarty_tpl->tpl_vars['child']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value){
 $_smarty_tpl->tpl_vars['child']->iteration++;
 $_smarty_tpl->tpl_vars['child']->last = $_smarty_tpl->tpl_vars['child']->iteration === $_smarty_tpl->tpl_vars['child']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['maomenuCategTree']['last'] = $_smarty_tpl->tpl_vars['child']->last;
?>
			<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['maomenuCategTree']['last']){?>
				<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('maomenu_branch_tpl_path')->value), $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('node',$_smarty_tpl->tpl_vars['child']->value);$_template->assign('last','true'); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
			<?php }else{ ?>
				<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('maomenu_branch_tpl_path')->value), $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('node',$_smarty_tpl->tpl_vars['child']->value); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
			<?php }?>
		<?php }} ?>
	   <?php if ($_smarty_tpl->getVariable('maomenumodecatview')->value){?>
				</ul>
			</li>
	   <?php }?>
	   <?php if ($_smarty_tpl->getVariable('maomenumanufacturers')->value){?>
			<li><?php if ($_smarty_tpl->getVariable('menu_display_link_manufacturer')->value){?><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('manufacturer.php');?>
" title="<?php echo smartyTranslate(array('s'=>'Manufacturers','mod'=>'maofree_menu'),$_smarty_tpl);?>
"><?php }?><?php echo smartyTranslate(array('s'=>'Manufacturers','mod'=>'maofree_menu'),$_smarty_tpl);?>
<?php if ($_smarty_tpl->getVariable('maomenurootarrow')->value){?><span class="arrow-maomenu"></span><?php }?><?php if ($_smarty_tpl->getVariable('menu_display_link_manufacturer')->value){?></a><?php }?>
				<ul>
				<?php  $_smarty_tpl->tpl_vars['manufacturer'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menu_manufacturers')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['manufacturer']->key => $_smarty_tpl->tpl_vars['manufacturer']->value){
?>
					<li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getmanufacturerLink($_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer'],$_smarty_tpl->tpl_vars['manufacturer']->value['link_rewrite']);?>
" title="<?php echo smartyTranslate(array('s'=>'More about','mod'=>'maofree_menu'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['manufacturer']->value['name'];?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['manufacturer']->value['name'],'htmlall','UTF-8');?>
</a></li>
				<?php }} ?>
				</ul>
			</li>
	   <?php }?>
	   <?php if ($_smarty_tpl->getVariable('maomenusuppliers')->value){?>
			<li><?php if ($_smarty_tpl->getVariable('menu_display_link_manufacturer')->value){?><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('supplier.php');?>
" title="<?php echo smartyTranslate(array('s'=>'Suppliers','mod'=>'maofree_menu'),$_smarty_tpl);?>
"><?php }?><?php echo smartyTranslate(array('s'=>'Suppliers','mod'=>'maofree_menu'),$_smarty_tpl);?>
<?php if ($_smarty_tpl->getVariable('maomenurootarrow')->value){?><span class="arrow-maomenu"></span><?php }?><?php if ($_smarty_tpl->getVariable('menu_display_link_manufacturer')->value){?></a><?php }?>
				<ul>
				<?php  $_smarty_tpl->tpl_vars['supplier'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menu_suppliers')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['supplier']->key => $_smarty_tpl->tpl_vars['supplier']->value){
?>
					<li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getsupplierLink($_smarty_tpl->tpl_vars['supplier']->value['id_supplier'],$_smarty_tpl->tpl_vars['supplier']->value['link_rewrite']);?>
" title="<?php echo smartyTranslate(array('s'=>'More about','mod'=>'maofree_menu'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['supplier']->value['name'];?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['supplier']->value['name'],'htmlall','UTF-8');?>
</a></li>
				<?php }} ?>
				</ul>
			</li>
		<?php }?>
	   <?php if ($_smarty_tpl->getVariable('maomenunewproducts')->value){?>
			<li class="noarrow-maomenu"><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('new-products.php');?>
" title="<?php echo smartyTranslate(array('s'=>'All new products','mod'=>'maofree_menu'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'All new products','mod'=>'maofree_menu'),$_smarty_tpl);?>
</a></li>
		<?php }?>
	   <?php if ($_smarty_tpl->getVariable('maomenupricesdrop')->value&&!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?>
			<li class="noarrow-maomenu"><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('prices-drop.php');?>
" title="<?php echo smartyTranslate(array('s'=>'Specials','mod'=>'maofree_menu'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Specials','mod'=>'maofree_menu'),$_smarty_tpl);?>
</a></li>
		<?php }?>
	   <?php if ($_smarty_tpl->getVariable('maomenubestsales')->value&&!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?>
			<li class="noarrow-maomenu"><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('best-sales.php');?>
" title="<?php echo smartyTranslate(array('s'=>'All best sellers','mod'=>'maofree_menu'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Top sellers','mod'=>'maofree_menu'),$_smarty_tpl);?>
</a></li>
		<?php }?>
	   <?php if ($_smarty_tpl->getVariable('maomenuinformation')->value){?>
			<li><a title="<?php echo smartyTranslate(array('s'=>'Information','mod'=>'maofree_menu'),$_smarty_tpl);?>
" href="<?php echo $_smarty_tpl->getVariable('menu_cmslinks')->value[3]['link'];?>
"><?php echo smartyTranslate(array('s'=>'Information','mod'=>'maofree_menu'),$_smarty_tpl);?>
<?php if ($_smarty_tpl->getVariable('maomenurootarrow')->value){?><span class="arrow-maomenu"></span><?php }?></a>
				<ul>
				<?php  $_smarty_tpl->tpl_vars['cmslink'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menu_cmslinks')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cmslink']->key => $_smarty_tpl->tpl_vars['cmslink']->value){
?>
					<?php if ($_smarty_tpl->tpl_vars['cmslink']->value['meta_title']!=''){?>
						<li><a href="<?php echo addslashes($_smarty_tpl->tpl_vars['cmslink']->value['link']);?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['cmslink']->value['meta_title'],'htmlall','UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['cmslink']->value['meta_title'],'htmlall','UTF-8');?>
</a></li>
					<?php }?>
				<?php }} ?>
				<?php if ($_smarty_tpl->getVariable('menu_display_stores')->value){?><li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('stores.php');?>
" title="<?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'maofree_menu'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'maofree_menu'),$_smarty_tpl);?>
</a></li><?php }?>
	         <?php if ($_smarty_tpl->getVariable('menu_display_sitemap')->value){?><li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('sitemap.php');?>
" title="<?php echo smartyTranslate(array('s'=>'sitemap','mod'=>'maofree_menu'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'sitemap','mod'=>'maofree_menu'),$_smarty_tpl);?>
</a></li><?php }?>
		      <?php if ($_smarty_tpl->getVariable('menu_display_contactus')->value){?><li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('contact-form.php',true);?>
" title="<?php echo smartyTranslate(array('s'=>'Contact us','mod'=>'maofree_menu'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Contact us','mod'=>'maofree_menu'),$_smarty_tpl);?>
</a></li><?php }?>
				</ul>
			</li>
		<?php }?>		
		<?php if ($_smarty_tpl->getVariable('maomenusearch')->value){?>
			<li class="maosearch">
				<form method="get" action="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php');?>
" id="searchbox">
					<label for="mao_search_query_top"><!-- image on background --></label>
					<input type="hidden" name="orderby" value="position" />
					<input type="hidden" name="orderway" value="desc" />
					<input class="mao_search_query" type="text" id="mao_search_query_top" name="search_query" value="<?php if (isset($_GET['search_query'])){?><?php echo stripslashes(htmlentities($_GET['search_query'],$_smarty_tpl->getVariable('MENU_ENT_QUOTES')->value,'utf-8'));?>
<?php }?>" />
					<input class="mao_search_image" type="image" name="submit_search" value="<?php echo smartyTranslate(array('s'=>'Search','mod'=>'maofree_menu'),$_smarty_tpl);?>
" src="<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
modules/maofree_menu/img/menu/search.png" alt="<?php echo smartyTranslate(array('s'=>'Search','mod'=>'maofree_menu'),$_smarty_tpl);?>
" title="<?php echo smartyTranslate(array('s'=>'Search','mod'=>'maofree_menu'),$_smarty_tpl);?>
" />
				</form>
			</li>
		<?php }?>
	</ul>
</div>
<div>