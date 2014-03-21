{*
* 2007-2011 PrestaShop 
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 8193 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if isset($cms) && $cms->id != $cgv_id}
	{include file="$tpl_dir./breadcrumb.tpl"}
{/if}


<div id="shoppingGuide">
 
{if isset($cms) && !isset($category)}
	{if !$cms->active}
		<br />
		<div id="admin-action-cms">
			<p>{l s='This CMS page is not visible to your customers.'}
			<input type="hidden" id="admin-action-cms-id" value="{$cms->id}" />
			<input type="submit" value="{l s='Publish'}" class="exclusive" onclick="submitPublishCMS('{$base_dir}{$smarty.get.ad}', 0)"/>			
			<input type="submit" value="{l s='Back'}" class="exclusive" onclick="submitPublishCMS('{$base_dir}{$smarty.get.ad}', 1)"/>			
			</p>
			<div class="clear" ></div>
			<p id="admin-action-result"></p>
			</p>
		</div>
	{/if}
    
	{* for store locator *}
    
    {if $content_only}
    
    <div style="text-align: left">
    {$cms->content} 
    </div>
    
	{else if $cms->id == 12}
    
    <h1 class="store_locator">{$cms->meta_title}</h1>
    {$cms->content} 
    
    {else}
    <h1>{$cms->meta_title}</h1>
    
     <div id="shoppingGuideLeft">
        <ul>
            {*<li><a {if $cms->id == 8} class="active" {/if}  href="http://online.goodjobstore.com/cms.php?id_cms=8">{l s='How to Buy'}</a></li>*}
            <li><a {if $cms->id == 4} class="active" {/if} href="http://online.goodjobstore.com/cms.php?id_cms=4">{l s='About Us'}</a></li>
            <li><a {if $cms->id == 1} class="active" {/if} href="http://online.goodjobstore.com/cms.php?id_cms=1">{l s='Payment'}</a></li>
            <li><a {if $cms->id == 8} class="active" {/if}  href="http://online.goodjobstore.com/cms.php?id_cms=8">{l s='Delivery'}</a></li>
			<li><a {if $cms->id == 9} class="active" {/if} href="http://online.goodjobstore.com/cms.php?id_cms=9">{l s='Return & Exchange'}</a></li>
            {*<li><a {if $cms->id == 10} class="active" {/if} href="http://online.goodjobstore.com/cms.php?id_cms=10">{l s='Technology'}</a></li>
            <li><a {if $cms->id == 11} class="active" {/if} href="http://online.goodjobstore.com/cms.php?id_cms=11">{l s='FAQ'}</a></li>*}
        </ul>
    </div>
	
	<div id="shoppingGuideRight" class="rte{if $content_only} content_only{/if}">

    	{if $cms->id == 4}
        <div id="shoppingGuideRightSub">
        	 <script type='text/javascript' src='/lib/mediaplayer-5.8-viral/jwplayer.js'></script>
              <div id='mediaspace'>Player Loading...</div>
              <script type='text/javascript'>
                jwplayer('mediaspace').setup({
                   'flashplayer': '/lib/mediaplayer-5.8-viral/player.swf',
                   'file': '/lib/about-us.mp4',
                   'width': '350',
                   'height': '230',
                   'autostart': 'false',
				   'image': '{$img_dir}video-about-us.jpg',
                   'skin': '/lib/mediaplayer-5.8-viral/skins/glow.zip'
                });
              </script>
              
              <div id="blockContact">
              <h2>{l s='GET IN TOUCH'}</h2>
              <script type="text/javascript">
			  $(document).ready(function(){
					$('#contactForm #btnSend').click(function(){
						if($('#contactForm #email').val() == ''){
							alert('Please fill e-mail');
						}else if($('#contactForm #name').val() == ''){
							alert('Please fill name');
						}else if($('#contactForm #message').val() == ''){
							alert('Please fill message');
						}else{
							alert('Send complete');
							$('#contactForm #email').val('');
							$('#contactForm #country').val('');
							$('#contactForm #name').val('');
							$('#contactForm #message').val('');
						}					 
					});
			  });
			  </script>
              <form id="contactForm" name="contactForm" method="post" action="">
              <table id="tblContact" width="360" border="0" cellspacing="0" cellpadding="2" style="border: none;">
                  <tr>
                    <td width="168">{l s='E-mail'}</td>
                    <td width="178" style="padding-left: 10px;">{l s='Country'}</td>
                  </tr>
                  <tr>
                    <td><input name="email" type="text" id="email" maxlength="255" /></td>
                    <td align="right"><input name="country" type="text" id="country" maxlength="50" /></td>
                  </tr>
                  <tr>
                    <td colspan="2">{l s='Name'} - {l s='Last Name'}</td>
                  </tr>
                  <tr>
                    <td colspan="2"><input name="name" type="text" id="name" maxlength="255" /></td>
                  </tr>
                  <tr>
                    <td colspan="2">{l s='Message'}</td>
                  </tr>
                  <tr>
                    <td colspan="2"><textarea name="message" rows="5" id="message"></textarea></td>
                  </tr>
                  <tr>
                    <td colspan="2"><input type="button" name="btnSend" id="btnSend" value="SEND" /></td>
                  </tr>
                </table>
              </form>
              </div>
              
        </div>
        <div id="shoppingGuideRightSub2">
        	{$cms->content}        
        </div>
        {else}
        	<div id="shoppingGuideRightSub3">
        	{$cms->content}        
            </div>
        {/if}
        
	</div>
    
    {/if}
    
{elseif isset($category)}

	<div class="block-cms">
		{*<h1><a href="{if $category->id eq 1}{$base_dir}{else}{$link->getCategoryLink($category->id, $category->link_rewrite)}{/if}">{$category->name|escape:'htmlall':'UTF-8'}</a></h1>*}
        
        <h1>{$category->name|escape:'htmlall':'UTF-8'}</h1>
        
		{if isset($sub_category) & !empty($sub_category)}	
			{*<h4>{l s='List of sub categories in '}{$category->name}{l s=':'}</h4>*}
            
			<ul class="bullet">
				{foreach from=$sub_category item=subcategory}
					<li>
						<a href="{$link->getCMSCategoryLink($subcategory.id_cms_category, $subcategory.link_rewrite)|escape:'htmlall':'UTF-8'}">{$subcategory.name|escape:'htmlall':'UTF-8'}</a>
					</li>
				{/foreach}
			</ul>
		{/if}
		{if isset($cms_pages) & !empty($cms_pages)}
        
		{*<h4>{l s='List of pages in '} {$category->name}{l s=':'}</h4>*}
        <div id="shoppingGuideLeft2">
			<ul>
				{foreach from=$cms_pages item=cmspages}
					<li>
						<a href="{$link->getCMSLink($cmspages.id_cms, $cmspages.link_rewrite)|escape:'htmlall':'UTF-8'}">{$cmspages.meta_title|escape:'htmlall':'UTF-8'}</a>
					</li>
				{/foreach}
			</ul>
          </div>
		{/if}
	</div>
    
{else}
	{l s='This page does not exist.'}
{/if}
</div>