<?php /* Smarty version Smarty-3.0.7, created on 2012-04-30 10:12:34
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/blocksearch/blocksearch-top.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15531739024f9e0322d7ddf8-85793186%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57a22506c17a88af0cadbee94ad72683797b2bc8' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online/httpdocs/modules/blocksearch/blocksearch-top.tpl',
      1 => 1334916724,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15531739024f9e0322d7ddf8-85793186',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<!-- Block search module TOP -->
<div id="search_block_top">
	<!-- Block Login | Register Link module HEADER -->
    <p id="link_register">
		<?php if ($_smarty_tpl->getVariable('cookie')->value->isLogged()){?>
			<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order-slip.php');?>
" title="<?php echo smartyTranslate(array('s'=>'Welcome','mod'=>'blockuserinfo'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->getVariable('cookie')->value->customer_firstname;?>
 <?php echo $_smarty_tpl->getVariable('cookie')->value->customer_lastname;?>
 </a>
			| <a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('index.php');?>
?mylogout" title="<?php echo smartyTranslate(array('s'=>'Log me out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Log out','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
		<?php }else{ ?>
			<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order-slip.php',true);?>
"><?php echo smartyTranslate(array('s'=>'Log in','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a> | 
            <a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order-slip.php',true);?>
"><?php echo smartyTranslate(array('s'=>'Register','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</a>
		<?php }?>
     </p>
    <!-- /Block Login | Register Link module HEADER -->
	<form method="get" action="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php');?>
" id="searchbox">
			<input type="hidden" name="orderby" value="position" />
			<input type="hidden" name="orderway" value="desc" />
            <input type="submit" name="submit_search" value="<?php echo smartyTranslate(array('s'=>'Search','mod'=>'blocksearch'),$_smarty_tpl);?>
" class="submit_search" /><input class="search_query" type="text" id="search_query_top" name="search_query" value="<?php if (isset($_GET['search_query'])){?><?php echo stripslashes(htmlentities($_GET['search_query'],$_smarty_tpl->getVariable('ENT_QUOTES')->value,'utf-8'));?>
<?php }?>" />
	</form>
</div>
<?php if ($_smarty_tpl->getVariable('instantsearch')->value){?>
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
		
		$("#search_query_top").keyup(function(){
			if($(this).val().length > 0){
				stopInstantSearchQueries();
				instantSearchQuery = $.ajax({
				url: '<?php if ($_smarty_tpl->getVariable('search_ssl')->value==1){?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php',true);?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php');?>
<?php }?>',
				data: 'instantSearch=1&id_lang=<?php echo $_smarty_tpl->getVariable('cookie')->value->id_lang;?>
&q='+$(this).val(),
				dataType: 'html',
				success: function(data){
					if($("#search_query_top").val().length > 0)
					{
						tryToCloseInstantSearch();
						$('#center_column').attr('id', 'old_center_column');
						$('#old_center_column').after('<div id="center_column">'+data+'</div>');
						$('#old_center_column').hide();
						$("#instant_search_results a.close").click(function() {
							$("#search_query_top").val('');
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

<?php if ($_smarty_tpl->getVariable('ajaxsearch')->value){?>
	<script type="text/javascript">
	// <![CDATA[
	var var_keywords = 'Enter Keywords';
	$("#search_query_top").val(var_keywords);
	$("#search_query_top").focus(function(){
		$("#search_query_top").val('');									  
	});
	$("#search_query_top").blur(function(){
		if($("#search_query_top").val() != ''){
			$("#search_query_top").val($("#search_query_top").val());	
		}else{
			$("#search_query_top").val(var_keywords);	
		}									 
	});
	
	
	
		$('document').ready( function() {
			$("#search_query_top")
				.autocomplete(
					'<?php if ($_smarty_tpl->getVariable('search_ssl')->value==1){?><?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php',true);?>
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
					$('#search_query_top').val(data.pname);
					document.location.href = data.product_link;
				})
		});
	
	// ]]>
	</script>
<?php }?>
<!-- /Block search module TOP -->