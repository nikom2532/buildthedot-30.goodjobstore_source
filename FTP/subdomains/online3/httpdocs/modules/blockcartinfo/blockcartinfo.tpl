<!-- Block cart information module HEADER -->
<script type="text/javascript">
        $(document).ready(function() {

            $("#shopping_cart_info .btn_cart_info").click(function(e) {
                $("#shopping_cart_info #block_cart_info").toggle();
            });

            $("#shopping_cart_info #block_cart_info").mouseup(function() {
                return false
            });
			
            $(document).mouseup(function(e) {
                if($(e.target).parent("a.btn_cart_info").length==0) {
                    $("#shopping_cart_info #block_cart_info").hide();
                }
            });
        });
		
		{if $ajax_allowed}
		var CUSTOMIZE_TEXTFIELD = {$CUSTOMIZE_TEXTFIELD};
		var customizationIdMessage = '{l s='Customization #' mod='blockcart' js=1}';
		{/if}
</script>

<div id="shopping_cart_info">
	<a class="btn_cart_info" href="#" title="{l s='Your Shopping Cart' mod='blockuserinfo'}"><img src="{$img_ps_dir}cart.jpg" border="0" align="absmiddle" /><span style="color:black"> {l s='Shopping Cart' mod='blockuserinfo'}</span></a>
	<a class="btn_store" href="http://online.goodjobstore.com/cms.php?id_cms=12" title="{l s='Store Locator' mod='blockuserinfo'}"><img src="{$img_ps_dir}location.jpg" border="0" align="absmiddle" /><span style="color:black; padding-left: 2px;">{l s='Store Locator' mod='blockuserinfo'}</span></a>
    
	<div id="block_cart_info">
    <!-- MODULE Block cart -->
        <div id="cart_block">
            <!-- block summary -->
            <div id="cart_block_summary" class="{if isset($colapseExpandStatus) && $colapseExpandStatus eq 'expanded' || !$ajax_allowed || !isset($colapseExpandStatus)}collapsed{else}expanded{/if}">
                <span class="ajax_cart_quantity" {if $cart_qties <= 0}style="display:none;"{/if}>{$cart_qties}</span>
                <span class="ajax_cart_product_txt_s" {if $cart_qties <= 1}style="display:none"{/if}>{l s='products' mod='blockcart'}</span>
                <span class="ajax_cart_product_txt" {if $cart_qties > 1}style="display:none"{/if}>{l s='product' mod='blockcart'}</span>
                <span class="ajax_cart_total" {if $cart_qties <= 0}style="display:none"{/if}>{if $priceDisplay == 1}{convertPrice price=$cart->getOrderTotal(false)}{else}{convertPrice price=$cart->getOrderTotal(true)}{/if}</span>
                <span class="ajax_cart_no_product" {if $cart_qties != 0}style="display:none"{/if}>{l s='(empty)' mod='blockcart'}</span>
            </div>
            <!-- block list of products -->
            <div id="cart_block_list" class="{if isset($colapseExpandStatus) && $colapseExpandStatus eq 'expanded' || !$ajax_allowed || !isset($colapseExpandStatus)}expanded{else}collapsed{/if}">
            {if $products}
                <dl class="products">
                {foreach from=$products item='product' name='myLoop'}
                    {assign var='productId' value=$product.id_product}
                    {assign var='productAttributeId' value=$product.id_product_attribute}
                    <dt id="cart_block_product_{$product.id_product}{if $product.id_product_attribute}_{$product.id_product_attribute}{/if}" class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if}">
                    	  
                         <dl style="text-align: left">
                         <a class="cart_block_product_name" href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category)}" title="{$product.name|escape:html:'UTF-8'}"><img align="left" src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'small')}" alt="{$product.name|escape:html:'UTF-8'}" width="50" height="50" style="margin-right: 5px; border: none" /></a>
                                    <a class="cart_block_product_name" href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category)}" title="{$product.name|escape:html:'UTF-8'}">
                        {$product.name|truncate:18:'...'|escape:html:'UTF-8'}</a></br>
                         </dl>
							
                    </dt>
 
                     {if isset($product.attributes_small)}
                        <div>
                            <a href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category)}" title="{l s='Product detail'}">{$product.attributes_small}</a></br>
                        {/if}
					<div>
							SIZE
							<a href="{$link->getProductLink($product.id_product, $product.link_rewrite, $product.category)}" title="{l s='Product detail'}">{$product.attributes_small}</a>		
						</div>
						<div>
							QTY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="quantity-formated"><span class="quantity" style="font-weight: normal">{$product.cart_quantity}x</span></span>
							<span class="price">{*{if $priceDisplay == $smarty.const.PS_TAX_EXC}{displayWtPrice p="`$product.price`"}{else}*}{displayWtPrice p="`$product.price`"}{*{/if}*}</span>	
							
						</div></br><br>
						<hr width="100%" size="1" color="ffffff">
						
						<!-- Customizable datas -->
                        {if isset($customizedDatas.$productId.$productAttributeId)}
                            {if !isset($product.attributes_small)}<div>{/if}
                            <ul class="cart_block_customizations" id="customization_{$productId}_{$productAttributeId}">
                                {foreach from=$customizedDatas.$productId.$productAttributeId key='id_customization' item='customization' name='customizations'}
                                    <li name="customization">
                                        <div class="deleteCustomizableProduct" id="deleteCustomizableProduct_{$id_customization|intval}_{$product.id_product|intval}_{$product.id_product_attribute|intval}"><a class="ajax_cart_block_remove_link" href="{$link->getPageLink('cart.php')}?delete&amp;id_product={$product.id_product|intval}&amp;ipa={$product.id_product_attribute|intval}&amp;id_customization={$id_customization}&amp;token={$static_token}"> </a></div>
                                        <span class="quantity-formated"><span class="quantity">{$customization.quantity}</span>x</span>{if isset($customization.datas.$CUSTOMIZE_TEXTFIELD.0)}
                                        {$customization.datas.$CUSTOMIZE_TEXTFIELD.0.value|escape:html:'UTF-8'|replace:"<br />":" "|truncate:28}
                                        {else}
                                        {l s='Customization #' mod='blockcart'}{$id_customization|intval}{l s=':' mod='blockcart'}
                                        {/if}
                                    </li>
                                {/foreach}
                            </ul>
                            {if !isset($product.attributes_small)}</div>{/if}
                        {/if}
            
                        {if isset($product.attributes_small)}</div>
                        {/if}
                                
                {/foreach}
                </dl>
            {/if}
                <p {if $products}class="hidden"{/if} id="cart_block_no_products" style="color:#FFF">{l s='No products' mod='blockcart'}</p>
        
                {if $discounts|@count > 0}<table id="vouchers">
                    <tbody>
                    {foreach from=$discounts item=discount}
                        <tr class="bloc_cart_voucher" id="bloc_cart_voucher_{$discount.id_discount}">
                            <td class="name" title="{$discount.description}">{$discount.name|cat:' : '|cat:$discount.description|truncate:18:'...'|escape:'htmlall':'UTF-8'}</td>
                            <td class="price">-{if $discount.value_real != '!'}{if $priceDisplay == 1}{convertPrice price=$discount.value_tax_exc}{else}{convertPrice price=$discount.value_real}{/if}{/if}</td>
                        </tr>
                    {/foreach}
                    </tbody>
                </table>
                {/if}
        		<br />
                <a id="cart-prices">
                    {if $show_wrapping}
                        {assign var='blockcart_cart_flag' value='Cart::ONLY_WRAPPING'|constant}
                        <span style="color:#FFF">{l s='Wrapping' mod='blockcart'}</span>
                        <span style="color:#FFF" id="cart_block_wrapping_cost" class="price cart_block_wrapping_cost">{if $priceDisplay == 1}{convertPrice price=$cart->getOrderTotal(false, $blockcart_cart_flag)}{else}{convertPrice price=$cart->getOrderTotal(true, $blockcart_cart_flag)}{/if}</span>
                        <br/>
                    {/if}
                  {*  {if $show_tax && isset($tax_cost)}
                        <span style="color:#FFF">{l s='Tax' mod='blockcart'}</span>
                        <span style="color:#FFF" id="cart_block_tax_cost" class="price ajax_cart_tax_cost">{$tax_cost}</span>
                        <br/>
                    {/if}*}
                    <span style="color:#FFF">{l s='TOTAL' mod='blockcart'}</span>
                    <span style="color:#FFF" id="cart_block_total" class="price ajax_block_cart_total">{$product_total}</span>
					
					<hr width="100%" size="1" color="ffffff"></br>
                </a>
                {if $use_taxes && $display_tax_label == 1 && $show_tax}
                    {if $priceDisplay == 0}
                        <p id="cart-price-precisions">
                            {l s='Prices are tax included' mod='blockcart'}
                        </p>
                    {/if}
                    {if $priceDisplay == 1}
                        <p id="cart-price-precisions">
                            {l s='Prices are tax excluded' mod='blockcart'}
                        </p>
                    {/if}
                {/if}
                <a id="cart-buttons">
                    {if $order_process == 'order'}<center><a href="{$link->getPageLink("$order_process.php", true)}" class="button" title="{l s='VIEW SHOPPING CART' mod='blockcart'}">{l s='VIEW SHOPPING CART' mod='blockcart'}</a></center>{/if}
            </div>
    	</div>
    <!-- /MODULE Block cart -->
     </div>
</div>
<!-- /Block cart information module HEADER -->