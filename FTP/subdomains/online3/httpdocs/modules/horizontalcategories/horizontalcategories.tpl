
<!-- Horizontal categories module -->
<div id="goodjobmenu" class="droplinetabs">
	<ul>
	{foreach from=$blockCategTree.children item=child name=blockCategTree}
		{if $smarty.foreach.blockCategTree.last}
		
					{include file=$branche_tpl_path node=$child last='true'}
		
		{else}
					{include file=$branche_tpl_path node=$child}
		{/if}
	{/foreach}
	</ul>
</div>
<!-- /Horizontal categories module -->
