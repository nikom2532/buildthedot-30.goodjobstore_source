<!-- Block home module -->
<link rel="stylesheet" href="{$modules_dir}homehighlight/nivo-slider/themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="{$modules_dir}homehighlight/nivo-slider/nivo-slider.css" type="text/css" media="screen" />
 <script type="text/javascript" src="{$modules_dir}homehighlight/nivo-slider/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#slider').nivoSlider({ effect:'fade' });
	});
</script>
	    
    <div class="homehighlight">
        <div class="slider-wrapper theme-default">
            <div class="ribbon"></div>
            <div id="slider" class="nivoSlider">
            {foreach from=$banners item=banner name=homeBanner}
            {if $banner.url != ''}
            <a href="{$banner.url}" target="_blank">
            {/if}
                <img src="{$img_ps_dir}module_hl/{$banner.id_banner_highlight}.jpg" alt="{$banner.title}" border="0"  />
             {if $banner.url != ''}</a>{/if}
            {/foreach}
            </div>
            
        </div>
	</div>
<!-- /Block home module -->
