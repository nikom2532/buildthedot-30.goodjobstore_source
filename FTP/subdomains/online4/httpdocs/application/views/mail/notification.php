<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>


</head>-->

<body>
<p><img src="http://online.goodjobstore.com/public/images/logo.jpg" alt="logo" width="635" height="82" /></p>
<?php if($customer): ?>
<p style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">Hi <?=$customer->FirstName?> <?=$customer->LastName?></p>
<?php endif; ?>
<p style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">This item is now ready to ship right to your door.  <br />
</p>
<p style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">End the waiting now, what you want it now available and don't let this be the one that got away again. <br />
If you arrive at the site and the item is already sold out, we're sorry. But, at least you know you have a great taste.</p>
<table cellspacing="0" cellpadding="0">
  <tr>
    <td width="641"><table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tbody>
        <tr>
          <td><strong style="font-size:14px; font-family: Tahoma, Geneva, sans-serif;">PRODUCT DETAILS</strong></td>
        </tr>
        <tr>
          <td><strong style="font-size:14px; font-family: Tahoma, Geneva, sans-serif;">Product SKU</strong>: <span style="font-size:14px;"><?=$product->Product_ID?></span><br /></td>
          </tr>
        <tr>
          <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tbody>
              <tr>
                <td height="19" valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td align="right" valign="top">&nbsp;</td>
                <td align="right" valign="top">&nbsp;</td>
                </tr>
              <tr>
                <td width="193" valign="top">Item</td>
                <td valign="top" width="181">Description</td>
                <td valign="top" width="162">Available Color<br /></td>
                <td align="right" valign="top" width="88">Unit Price</td>
                <td align="right" valign="top" width="126"><br /></td>
                </tr>
              <tr style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
                <td align="right" valign="top">&nbsp;</td>
                <td align="right" valign="top">&nbsp;</td>
                </tr>
              <tr style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">
                <td valign="top"><img src="http://online.goodjobstore.com/public/<?=$product->Thumbnail_path?>" alt="" /><br/><br/>
	                <?=$product->Pro_Name_En?>
                </td>
                <td valign="top"><?=$product->Description_En?></td>
                <td valign="top">
                	<?php $colors = get_product_color($product->Product_ID) ?>
                	<?php foreach($colors as $color): ?>
                		<?=$color->Name_EN?><br />
                	<?php endforeach; ?>
                	Red<br />
                	Yellow<br />
                  <br /></td>
                <td align="right" valign="top"><?=($product->Price_sale!=0)?number_format($product->Price_sale):number_format($product->Price_Buy)?></td>
                <td align="right" valign="top"><br /></td>
                </tr>
              <tr>
                <td colspan="5"><br /></td>
                </tr>
              <tr>
                <td colspan="3"> </td>
                <td align="right" width="88"><br /></td>
                <td align="right" width="126"><br /></td>
                </tr>
              <tr>
                <td colspan="3"> </td>
                <td align="right" width="88"><br /></td>
                <td align="right" width="126"><br /></td>
                </tr>
              <tr>
                <td colspan="3"> </td>
                <td align="right" width="88"><br /></td>
                <td align="right" width="126"><br /></td>
                </tr>
              <tr>
                <td colspan="3"> </td>
                <td align="right" width="88"><br /></td>
                <td align="right" width="126"><br /></td>
                </tr>
              </tbody>
          </table></td>
        </tr>
      </tbody>
    </table></td>
  </tr>
  <tr>
    <td>--------------------------------------------------------------------------------------------------------<br /></td>
  </tr>
  <tr>
    <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tbody>
        <tr>
          <td valign="top" width="279" style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;"><p>Additional Information<br />
            To cancel or amend any details of this order please call us on: <br />
            02 683 5660 during normal business hours 9am - 5pm <br />
            Monday to Friday.</p>
            <p>At all other times please email us at:<br />
              <a href="mailto:au_orders@crumpler.com" target="_blank">contact@goodjobstore.com</a> stating your order number.</p>
            <p><br />
            </p></td>
          <td align="right" valign="top" width="342"><div>
            <p style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">GOOODJOB<br />
              729/16-17<br />
              Ratchadapisek Rd.<br />
              Yanawa Bangkok<br />
              10900 Thailand<br />
            </p>
            <p style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">T 02 683 5660<br />
            </p>
            <p style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;"><a href="mailto:contact@goodjobstore.com" target="_blank" >contact@goodjobstore.com</a></p>
          </div>
            <p style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;"><a href="http://www.goodjobstore.com/" target="_blank">www.goodjobstore.com</a></p></td>
          <td align="right" valign="top" width="129"><div>
            <p>&nbsp;</p>
          </div>
<p><br />
          </p></td>
        </tr>
      </tbody>
    </table></td>
  </tr>
  <br />
</table>
</body>
<!--</html>-->
