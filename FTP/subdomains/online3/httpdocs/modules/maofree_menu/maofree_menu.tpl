</div>

{if $mao_instantsearch}
	<script type="text/javascript">
	// <![CDATA[
		{literal}
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
				url: '{/literal}{if $mao_search_ssl == 1}{$link->getPageLink('search.php', true)}{else}{$link->getPageLink('search.php')}{/if}{literal}',
				data: 'instantSearch=1&id_lang={/literal}{$cookie->id_lang}{literal}&q='+$(this).val(),
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
	{/literal}
	</script>
{/if}

{if $mao_ajaxsearch}
	<script type="text/javascript">
	// <![CDATA[
	{literal}
		$('document').ready( function() {
			$("#mao_search_query_top")
				.autocomplete(
					'{/literal}{if $mao_search_ssl == 1}{$link->getPageLink('search.php', true)}{else}{$link->getPageLink('search.php')}{/if}{literal}', {
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
							id_lang: {/literal}{$cookie->id_lang}{literal}
						}
					}
				)
				.result(function(event, data, formatted) {
					$('#mao_search_query_top').val(data.pname);
					document.location.href = data.product_link;
				})
		});
	{/literal}
	// ]]>
	</script>
{/if}

<div id="maomenucontainer">
   {if $mao_theme}
	   <div class="maomenu-left"></div>
		<div class="maomenu-right"></div>
	{/if}	
	<ul class="maomenu-horizontal">
	   {if $maomenuhome}
		   <li class="maomenu-home"><a href="{$base_dir}">&nbsp;</a></li>
	   {/if}
	   {if $maomenumodecatview}
			<li><a href="{$maomenuCategTree.link}">{l s='Categories' mod='maofree_menu'}{if $maomenurootarrow}<span class="arrow-maomenu"></span>{/if}</a>
				<ul>
	   {/if}
		{foreach from=$maomenuCategTree.children item=child name=maomenuCategTree}
			{if $smarty.foreach.maomenuCategTree.last}
				{include file="$maomenu_branch_tpl_path" node=$child last='true'}
			{else}
				{include file="$maomenu_branch_tpl_path" node=$child}
			{/if}
		{/foreach}
	   {if $maomenumodecatview}
				</ul>
			</li>
	   {/if}
	   {if $maomenumanufacturers}
			<li>{if $menu_display_link_manufacturer}<a href="{$link->getPageLink('manufacturer.php')}" title="{l s='Manufacturers' mod='maofree_menu'}">{/if}{l s='Manufacturers' mod='maofree_menu'}{if $maomenurootarrow}<span class="arrow-maomenu"></span>{/if}{if $menu_display_link_manufacturer}</a>{/if}
				<ul>
				{foreach from=$menu_manufacturers item=manufacturer}
					<li><a href="{$link->getmanufacturerLink($manufacturer.id_manufacturer, $manufacturer.link_rewrite)}" title="{l s='More about' mod='maofree_menu'} {$manufacturer.name}">{$manufacturer.name|escape:'htmlall':'UTF-8'}</a></li>
				{/foreach}
				</ul>
			</li>
	   {/if}
	   {if $maomenusuppliers}
			<li>{if $menu_display_link_manufacturer}<a href="{$link->getPageLink('supplier.php')}" title="{l s='Suppliers' mod='maofree_menu'}">{/if}{l s='Suppliers' mod='maofree_menu'}{if $maomenurootarrow}<span class="arrow-maomenu"></span>{/if}{if $menu_display_link_manufacturer}</a>{/if}
				<ul>
				{foreach from=$menu_suppliers item=supplier}
					<li><a href="{$link->getsupplierLink($supplier.id_supplier, $supplier.link_rewrite)}" title="{l s='More about' mod='maofree_menu'} {$supplier.name}">{$supplier.name|escape:'htmlall':'UTF-8'}</a></li>
				{/foreach}
				</ul>
			</li>
		{/if}
	   {if $maomenunewproducts}
			<li class="noarrow-maomenu"><a href="{$link->getPageLink('new-products.php')}" title="{l s='All new products' mod='maofree_menu'}">{l s='All new products' mod='maofree_menu'}</a></li>
		{/if}
	   {if $maomenupricesdrop AND !$PS_CATALOG_MODE}
			<li class="noarrow-maomenu"><a href="{$link->getPageLink('prices-drop.php')}" title="{l s='Specials' mod='maofree_menu'}">{l s='Specials' mod='maofree_menu'}</a></li>
		{/if}
	   {if $maomenubestsales AND !$PS_CATALOG_MODE}
			<li class="noarrow-maomenu"><a href="{$link->getPageLink('best-sales.php')}" title="{l s='All best sellers' mod='maofree_menu'}">{l s='Top sellers' mod='maofree_menu'}</a></li>
		{/if}
	   {if $maomenuinformation}
			<li><a title="{l s='Information' mod='maofree_menu'}" href="{$menu_cmslinks.3.link}">{l s='Information' mod='maofree_menu'}{if $maomenurootarrow}<span class="arrow-maomenu"></span>{/if}</a>
				<ul>
				{foreach from=$menu_cmslinks item=cmslink}
					{if $cmslink.meta_title != ''}
						<li><a href="{$cmslink.link|addslashes}" title="{$cmslink.meta_title|escape:'htmlall':'UTF-8'}">{$cmslink.meta_title|escape:'htmlall':'UTF-8'}</a></li>
					{/if}
				{/foreach}
				{if $menu_display_stores}<li><a href="{$link->getPageLink('stores.php')}" title="{l s='Our stores' mod='maofree_menu'}">{l s='Our stores' mod='maofree_menu'}</a></li>{/if}
	         {if $menu_display_sitemap}<li><a href="{$link->getPageLink('sitemap.php')}" title="{l s='sitemap' mod='maofree_menu'}">{l s='sitemap' mod='maofree_menu'}</a></li>{/if}
		      {if $menu_display_contactus}<li><a href="{$link->getPageLink('contact-form.php', true)}" title="{l s='Contact us' mod='maofree_menu'}">{l s='Contact us' mod='maofree_menu'}</a></li>{/if}
				</ul>
			</li>
		{/if}		
		{if $maomenusearch}
			<li class="maosearch">
				<form method="get" action="{$link->getPageLink('search.php')}" id="searchbox">
					<label for="mao_search_query_top"><!-- image on background --></label>
					<input type="hidden" name="orderby" value="position" />
					<input type="hidden" name="orderway" value="desc" />
					<input class="mao_search_query" type="text" id="mao_search_query_top" name="search_query" value="{if isset($smarty.get.search_query)}{$smarty.get.search_query|htmlentities:$MENU_ENT_QUOTES:'utf-8'|stripslashes}{/if}" />
					<input class="mao_search_image" type="image" name="submit_search" value="{l s='Search' mod='maofree_menu'}" src="{$content_dir}modules/maofree_menu/img/menu/search.png" alt="{l s='Search' mod='maofree_menu'}" title="{l s='Search' mod='maofree_menu'}" />
				</form>
			</li>
		{/if}
	</ul>
</div>
<div>