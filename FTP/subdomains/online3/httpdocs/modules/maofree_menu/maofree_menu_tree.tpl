{assign var=faa value='eee'}
{foreach from=$homecategoriesID item=number}{if $node.id eq $number}{assign var=faa value='aaa'}{/if}{/foreach}
<li class="{if isset($last) && $last eq 'true'}last {/if}{if isset($maomenucurrentCategoryId) && ($node.id eq $maomenucurrentCategoryId)}{if !$maomenumodecatview && ($faa eq 'aaa')}root{/if}selected-maomenu{/if}{if !$maomenumodecatview && ($node.children|@count eq 0) && ($faa eq 'aaa')} noarrow-maomenu{/if}">
	<a href="{$node.link}" {if isset($maomenucurrentCategoryId) && ($node.id eq $maomenucurrentCategoryId)}class="selected-a-maomenu"{/if} title="{$node.desc|escape:html:'UTF-8'}">{$node.name|escape:html:'UTF-8'}{if $maomenumodecatview && ($node.children|@count > 0)}<span class="arrow-maomenu"></span>{elseif !$maomenumodecatview && ($node.children|@count > 0)}{if ($faa eq 'aaa') && !$maomenurootarrow}{else}<span class="arrow-maomenu"></span>{/if}{/if}</a>
	{if $node.children|@count > 0}
		<ul>
		{foreach from=$node.children item=child name=maomenucategoryTreeBranch}
			{if isset($smarty.foreach.maomenucategoryTreeBranch) && $smarty.foreach.maomenucategoryTreeBranch.last}
				{include file="$maomenu_branch_tpl_path" node=$child last='true'}
			{else}
				{include file="$maomenu_branch_tpl_path" node=$child last='false'}
			{/if}
		{/foreach}
		</ul>
	{/if}
</li>