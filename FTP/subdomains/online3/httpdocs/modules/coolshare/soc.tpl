<SCRIPT type="text/javascript">
$().ready(function() 

{ldelim} 
		$("#example2").jsocial({ldelim}highlight: true,
							buttons: "", 
							imagedir: "modules/coolshare/files/", 
							imageextension: "png", 
							inline:true,
							blanktarget: true{rdelim});
{rdelim});

</SCRIPT>

<div id="example2" style=" position:relative; {$float}; width:{$width}px; height:{$height}; margin-left:{$margin}px; float:left" > 
 {if $c1 eq "yes"}

<a target="_blank" href="http://www.technorati.com/faves?add=http://{$servername}{$requesturi}" class="jsocial_button" title="technorati" style="opacity: 1; {$float} "><img border="0" src="{$module_dir}files/technoratib{$formatcs}.png" alt="technorati" width="{$widthcs}" /></a>
{else}{/if}

{if $c2 eq "yes"}
<a target="_blank" href="http://del.icio.us/post?url=http://{$servername}{$requesturi}" class="jsocial_button" title="delicious" style="opacity: 1; {$float} "><img border="0" src="{$module_dir}files/deliciousb{$formatcs}.png" alt="delicious" width="{$widthcs}" /></a>
{else}{/if}

{if $c3 eq "yes"}
<a target="_blank" href="http://reddit.com/submit?url=http://{$servername}{$requesturi};title={$meta_title|truncate:19:'...'|escape:'htmlall':'UTF-8'}" class="jsocial_button" title="reddit" style="opacity: 1;  {$float}"><img border="0" src="{$module_dir}files/redditb{$formatcs}.png" alt="reddit" width="{$widthcs}" /></a>
{else}{/if}

{if $c4 eq "yes"}
<a target="_blank" href="http://www.facebook.com/share.php?u=http://{$servername}{$requesturi} " class="jsocial_button" title="facebook" style="opacity: 1; {$float} "><img border="0" src="{$module_dir}files/facebookb{$formatcs}.png" alt="facebook" width="{$widthcs}" /></a>
{else}{/if}

{if $c5 eq "yes"}
<a target="_blank" href="http://twitter.com?status={$meta_title|truncate:19:'...'|escape:'htmlall':'UTF-8'}-http://{$servername}{$requesturi} " class="jsocial_button" title="twitter" style="opacity: 1; {$float} "><img border="0" src="{$module_dir}files/twitterb{$formatcs}.png" alt="twitter" width="{$widthcs}" /></a>
{else}{/if}

{if $c6 eq "yes"}
<a target="_blank" href="http://www.stumbleupon.com/submit?url=http://{$servername}{$requesturi} &amp;title={$meta_title|truncate:19:'...'|escape:'htmlall':'UTF-8'}" class="jsocial_button" title="stumbleupon" style="opacity: 1;  {$float}"><img border="0" src="{$module_dir}files/stumbleuponb{$formatcs}.png" alt="stumbleupon" width="{$widthcs}" /></a>
{else}{/if}

{if $c7 eq "yes"}
<a target="_blank" href="http://myweb2.search.yahoo.com/myresults/bookmarklet?u=http://{$servername}{$requesturi}?ref=http://{$servername}{$requesturi}&amp;t=http://{$servername}{$requesturi}&amp;title={$meta_title|truncate:19:'...'|escape:'htmlall':'UTF-8'}" class="jsocial_button" title="yahoo" style="opacity: 1; {$float} "><img border="0" src="{$module_dir}files/yahoob{$formatcs}.png" alt="yahoo" width="{$widthcs}" /></a>
{else}{/if}

{if $c8 eq "yes"}
<a target="_blank" href="http://digg.com/submit?phase=2&amp;url=http://{$servername}{$requesturi}?ref=http://{$servername}{$requesturi}&amp;title={$meta_title|truncate:19:'...'|escape:'htmlall':'UTF-8'}" class="jsocial_button" title="digg" style="opacity: 1; {$float} "><img border="0" src="{$module_dir}files/diggb{$formatcs}.png" alt="digg" width="{$widthcs}" /></a>
{else}{/if}


{if $c10 eq "yes"}
<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=http://{$servername}{$requesturi}&amp;title={$meta_title|truncate:19:'...'|escape:'htmlall':'UTF-8'}&amp;summary=&amp;source=" class="jsocial_button" title="linkedin" style="opacity: 1; {$float} "><img border="0" src="{$module_dir}files/linkedinb{$formatcs}.png" alt="flickr" width="{$widthcs}" /></a>
{else}{/if}
{if $c11 eq "yes"}
<a target="_blank" href="mailto:friend@email.com?SUBJECT=http://{$servername}{$requesturi}&amp;BODY=http://{$servername}{$requesturi}" class="jsocial_button" title="mail" style="opacity: 1; {$float} "><img border="0" src="{$module_dir}files/mailb{$formatcs}.png" alt="flickr" width="{$widthcs}" /></a>
{else}{/if}
{if $c12 eq "yes"}
<a href="https://m.google.com/app/plus/x/?v=compose&content=http://{$servername}{$requesturi}" target="_blank" onclick="window.open('https://m.google.com/app/plus/x/?v=compose&content=http://{$servername}{$requesturi}','gplusshare','width=450,height=300,left='+(screen.availWidth/2-225)+',top='+(screen.availHeight/2-150)+'');return false;" class="jsocial_button" title="google+1" style="opacity: 1; {$float} "><img src="{$module_dir}files/google{$formatcs}.png" alt="google" width="{$widthcs}"/></a>


{else}{/if}

</div>