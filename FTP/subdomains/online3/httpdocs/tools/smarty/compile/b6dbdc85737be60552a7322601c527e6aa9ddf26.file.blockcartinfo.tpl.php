<?php /* Smarty version Smarty-3.0.7, created on 2012-06-28 20:49:08
         compiled from "/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/modules/blockcartinfo/blockcartinfo.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2852850284fec60d41776a4-25148828%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b6dbdc85737be60552a7322601c527e6aa9ddf26' => 
    array (
      0 => '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/modules/blockcartinfo/blockcartinfo.tpl',
      1 => 1335107051,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2852850284fec60d41776a4-25148828',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/tools/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_replace')) include '/var/www/vhosts/goodjobstore.com/subdomains/online3/httpdocs/tools/smarty/plugins/modifier.replace.php';
?><!-- Block cart information module HEADER -->
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
		
		<?php if ($_smarty_tpl->getVariable('ajax_allowed')->value){?>
		var CUSTOMIZE_TEXTFIELD = <?php echo $_smarty_tpl->getVariable('CUSTOMIZE_TEXTFIELD')->value;?>
;
		var customizationIdMessage = '<?php echo smartyTranslate(array('s'=>'Customization #','mod'=>'blockcart','js'=>1),$_smarty_tpl);?>
';
		<?php }?>
</script>

<div id="shopping_cart_info">
	<a class="btn_cart_info" href="#" title="<?php echo smartyTranslate(array('s'=>'Your Shopping Cart','mod'=>'blockuserinfo'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
cart.jpg" border="0" align="absmiddle" /><span style="color:black"> <?php echo smartyTranslate(array('s'=>'Shopping Cart','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</span></a>
	<a class="btn_store" href="http://online.goodjobstore.com/cms.php?id_cms=12" title="<?php echo smartyTranslate(array('s'=>'Store Locator','mod'=>'blockuserinfo'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
location.jpg" border="0" align="absmiddle" /><span style="color:black; padding-left: 2px;"><?php echo smartyTranslate(array('s'=>'Store Locator','mod'=>'blockuserinfo'),$_smarty_tpl);?>
</span></a>
    
	<div id="block_cart_info">
    <!-- MODULE Block cart -->
        <div id="cart_block">
            <!-- block summary -->
            <div id="cart_block_summary" class="<?php if (isset($_smarty_tpl->getVariable('colapseExpandStatus',null,true,false)->value)&&$_smarty_tpl->getVariable('colapseExpandStatus')->value=='expanded'||!$_smarty_tpl->getVariable('ajax_allowed')->value||!isset($_smarty_tpl->getVariable('colapseExpandStatus',null,true,false)->value)){?>collapsed<?php }else{ ?>expanded<?php }?>">
                <span class="ajax_cart_quantity" <?php if ($_smarty_tpl->getVariable('cart_qties')->value<=0){?>style="display:none;"<?php }?>><?php echo $_smarty_tpl->getVariable('cart_qties')->value;?>
</span>
                <span class="ajax_cart_product_txt_s" <?php if ($_smarty_tpl->getVariable('cart_qties')->value<=1){?>style="display:none"<?php }?>><?php echo smartyTranslate(array('s'=>'products','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
                <span class="ajax_cart_product_txt" <?php if ($_smarty_tpl->getVariable('cart_qties')->value>1){?>style="display:none"<?php }?>><?php echo smartyTranslate(array('s'=>'product','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
                <span class="ajax_cart_total" <?php if ($_smarty_tpl->getVariable('cart_qties')->value<=0){?>style="display:none"<?php }?>><?php if ($_smarty_tpl->getVariable('priceDisplay')->value==1){?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('cart')->value->getOrderTotal(false)),$_smarty_tpl);?>
<?php }else{ ?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('cart')->value->getOrderTotal(true)),$_smarty_tpl);?>
<?php }?></span>
                <span class="ajax_cart_no_product" <?php if ($_smarty_tpl->getVariable('cart_qties')->value!=0){?>style="display:none"<?php }?>><?php echo smartyTranslate(array('s'=>'(empty)','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
            </div>
            <!-- block list of products -->
            <div id="cart_block_list" class="<?php if (isset($_smarty_tpl->getVariable('colapseExpandStatus',null,true,false)->value)&&$_smarty_tpl->getVariable('colapseExpandStatus')->value=='expanded'||!$_smarty_tpl->getVariable('ajax_allowed')->value||!isset($_smarty_tpl->getVariable('colapseExpandStatus',null,true,false)->value)){?>expanded<?php }else{ ?>collapsed<?php }?>">
            <?php if ($_smarty_tpl->getVariable('products')->value){?>
                <dl class="products">
                <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
if ($_smarty_tpl->tpl_vars['product']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['first'] = $_smarty_tpl->tpl_vars['product']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['myLoop']['last'] = $_smarty_tpl->tpl_vars['product']->last;
?>
                    <?php $_smarty_tpl->tpl_vars['productId'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['id_product'], null, null);?>
                    <?php $_smarty_tpl->tpl_vars['productAttributeId'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['id_product_attribute'], null, null);?>
                    <dt id="cart_block_product_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
<?php if ($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']){?>_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
<?php }?>" class="<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['myLoop']['last']){?>last_item<?php }else{ ?>item<?php }?>">
                    	  
                         <dl style="text-align: left">
                         <a class="cart_block_product_name" href="<?php echo $_smarty_tpl->getVariable('link')->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category']);?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8');?>
"><img align="left" src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'small');?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8');?>
" width="50" height="50" style="margin-right: 5px; border: none" /></a>
                                    <a class="cart_block_product_name" href="<?php echo $_smarty_tpl->getVariable('link')->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category']);?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8');?>
">
                        <?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],18,'...'),'html','UTF-8');?>
</a></br>
                         </dl>
							
                    </dt>
 
                     <?php if (isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])){?>
                        <div>
                            <a href="<?php echo $_smarty_tpl->getVariable('link')->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category']);?>
" title="<?php echo smartyTranslate(array('s'=>'Product detail'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['attributes_small'];?>
</a></br>
                        <?php }?>
					<div>
							SIZE
							<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category']);?>
" title="<?php echo smartyTranslate(array('s'=>'Product detail'),$_smarty_tpl);?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['attributes_small'];?>
</a>		
						</div>
						<div>
							QTY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="quantity-formated"><span class="quantity" style="font-weight: normal"><?php echo $_smarty_tpl->tpl_vars['product']->value['cart_quantity'];?>
x</span></span>
							<span class="price"><?php echo Product::displayWtPrice(array('p'=>($_smarty_tpl->tpl_vars['product']->value['price'])),$_smarty_tpl);?>
</span>	
							
						</div></br><br>
						<hr width="100%" size="1" color="ffffff">
						
						<!-- Customizable datas -->
                        <?php if (isset($_smarty_tpl->getVariable('customizedDatas',null,true,false)->value[$_smarty_tpl->getVariable('productId',null,true,false)->value][$_smarty_tpl->getVariable('productAttributeId',null,true,false)->value])){?>
                            <?php if (!isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])){?><div><?php }?>
                            <ul class="cart_block_customizations" id="customization_<?php echo $_smarty_tpl->getVariable('productId')->value;?>
_<?php echo $_smarty_tpl->getVariable('productAttributeId')->value;?>
">
                                <?php  $_smarty_tpl->tpl_vars['customization'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id_customization'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('customizedDatas')->value[$_smarty_tpl->getVariable('productId')->value][$_smarty_tpl->getVariable('productAttributeId')->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['customization']->key => $_smarty_tpl->tpl_vars['customization']->value){
 $_smarty_tpl->tpl_vars['id_customization']->value = $_smarty_tpl->tpl_vars['customization']->key;
?>
                                    <li name="customization">
                                        <div class="deleteCustomizableProduct" id="deleteCustomizableProduct_<?php echo intval($_smarty_tpl->tpl_vars['id_customization']->value);?>
_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
"><a class="ajax_cart_block_remove_link" href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('cart.php');?>
?delete&amp;id_product=<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
&amp;ipa=<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
&amp;id_customization=<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
&amp;token=<?php echo $_smarty_tpl->getVariable('static_token')->value;?>
"> </a></div>
                                        <span class="quantity-formated"><span class="quantity"><?php echo $_smarty_tpl->tpl_vars['customization']->value['quantity'];?>
</span>x</span><?php if (isset($_smarty_tpl->tpl_vars['customization']->value['datas'][$_smarty_tpl->getVariable('CUSTOMIZE_TEXTFIELD',null,true,false)->value][0])){?>
                                        <?php echo smarty_modifier_truncate(smarty_modifier_replace(smarty_modifier_escape($_smarty_tpl->tpl_vars['customization']->value['datas'][$_smarty_tpl->getVariable('CUSTOMIZE_TEXTFIELD')->value][0]['value'],'html','UTF-8'),"<br />"," "),28);?>

                                        <?php }else{ ?>
                                        <?php echo smartyTranslate(array('s'=>'Customization #','mod'=>'blockcart'),$_smarty_tpl);?>
<?php echo intval($_smarty_tpl->tpl_vars['id_customization']->value);?>
<?php echo smartyTranslate(array('s'=>':','mod'=>'blockcart'),$_smarty_tpl);?>

                                        <?php }?>
                                    </li>
                                <?php }} ?>
                            </ul>
                            <?php if (!isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])){?></div><?php }?>
                        <?php }?>
            
                        <?php if (isset($_smarty_tpl->tpl_vars['product']->value['attributes_small'])){?></div>
                        <?php }?>
                                
                <?php }} ?>
                </dl>
            <?php }?>
                <p <?php if ($_smarty_tpl->getVariable('products')->value){?>class="hidden"<?php }?> id="cart_block_no_products" style="color:#FFF"><?php echo smartyTranslate(array('s'=>'No products','mod'=>'blockcart'),$_smarty_tpl);?>
</p>
        
                <?php if (count($_smarty_tpl->getVariable('discounts')->value)>0){?><table id="vouchers">
                    <tbody>
                    <?php  $_smarty_tpl->tpl_vars['discount'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('discounts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['discount']->key => $_smarty_tpl->tpl_vars['discount']->value){
?>
                        <tr class="bloc_cart_voucher" id="bloc_cart_voucher_<?php echo $_smarty_tpl->tpl_vars['discount']->value['id_discount'];?>
">
                            <td class="name" title="<?php echo $_smarty_tpl->tpl_vars['discount']->value['description'];?>
"><?php echo smarty_modifier_escape(smarty_modifier_truncate((($_smarty_tpl->tpl_vars['discount']->value['name']).(' : ')).($_smarty_tpl->tpl_vars['discount']->value['description']),18,'...'),'htmlall','UTF-8');?>
</td>
                            <td class="price">-<?php if ($_smarty_tpl->tpl_vars['discount']->value['value_real']!='!'){?><?php if ($_smarty_tpl->getVariable('priceDisplay')->value==1){?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_tax_exc']),$_smarty_tpl);?>
<?php }else{ ?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_real']),$_smarty_tpl);?>
<?php }?><?php }?></td>
                        </tr>
                    <?php }} ?>
                    </tbody>
                </table>
                <?php }?>
        		<br />
                <a id="cart-prices">
                    <?php if ($_smarty_tpl->getVariable('show_wrapping')->value){?>
                        <?php $_smarty_tpl->tpl_vars['blockcart_cart_flag'] = new Smarty_variable(constant('Cart::ONLY_WRAPPING'), null, null);?>
                        <span style="color:#FFF"><?php echo smartyTranslate(array('s'=>'Wrapping','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
                        <span style="color:#FFF" id="cart_block_wrapping_cost" class="price cart_block_wrapping_cost"><?php if ($_smarty_tpl->getVariable('priceDisplay')->value==1){?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('cart')->value->getOrderTotal(false,$_smarty_tpl->getVariable('blockcart_cart_flag')->value)),$_smarty_tpl);?>
<?php }else{ ?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('cart')->value->getOrderTotal(true,$_smarty_tpl->getVariable('blockcart_cart_flag')->value)),$_smarty_tpl);?>
<?php }?></span>
                        <br/>
                    <?php }?>
                    <span style="color:#FFF"><?php echo smartyTranslate(array('s'=>'TOTAL','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
                    <span style="color:#FFF" id="cart_block_total" class="price ajax_block_cart_total"><?php echo $_smarty_tpl->getVariable('product_total')->value;?>
</span>
					
					<hr width="100%" size="1" color="ffffff"></br>
                </a>
                <?php if ($_smarty_tpl->getVariable('use_taxes')->value&&$_smarty_tpl->getVariable('display_tax_label')->value==1&&$_smarty_tpl->getVariable('show_tax')->value){?>
                    <?php if ($_smarty_tpl->getVariable('priceDisplay')->value==0){?>
                        <p id="cart-price-precisions">
                            <?php echo smartyTranslate(array('s'=>'Prices are tax included','mod'=>'blockcart'),$_smarty_tpl);?>

                        </p>
                    <?php }?>
                    <?php if ($_smarty_tpl->getVariable('priceDisplay')->value==1){?>
                        <p id="cart-price-precisions">
                            <?php echo smartyTranslate(array('s'=>'Prices are tax excluded','mod'=>'blockcart'),$_smarty_tpl);?>

                        </p>
                    <?php }?>
                <?php }?>
                <a id="cart-buttons">
                    <?php if ($_smarty_tpl->getVariable('order_process')->value=='order'){?><center><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink(($_smarty_tpl->getVariable('order_process')->value).".php",true);?>
" class="button" title="<?php echo smartyTranslate(array('s'=>'VIEW SHOPPING CART','mod'=>'blockcart'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'VIEW SHOPPING CART','mod'=>'blockcart'),$_smarty_tpl);?>
</a></center><?php }?>
            </div>
    	</div>
    <!-- /MODULE Block cart -->
     </div>
</div>
<!-- /Block cart information module HEADER -->