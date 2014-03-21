<meta property="og:title" content="{$product->name}"/> 
<meta property="og:image " content="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'large')}"/> 
<meta property="og:url" content="{$productLink}"/>
<meta property="og:description" content="{strip_tags($product->description)}"/>
<meta property="og:site_name" content="{$shop_name}"/> 
