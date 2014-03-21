<!-- Block home banner module -->
    <div class="homebanner">
        <ul>
              {foreach from=$banners item=banner name=homeBanner}
              <li>
              {if $banner.url != ''}
              <a href="{$banner.url}" target="_blank">
              {/if}
                  <img src="{$img_ps_dir}module_br/{$banner.id_banner_right}.jpg" alt="{$banner.title}" border="0"  />
               {if $banner.url != ''}</a>{/if}
               </li>
              {/foreach}
        </ul>
	</div>
<!-- /Block home banner module -->
