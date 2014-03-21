<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>


</head>

<body>
<p><img src="http://online.goodjobstore.com/public/images/order_confirmation.jpg" alt="logo" />
</p>
<p>&nbsp;</p>
<p style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">Hi <?=$customer->FirstName?> <?=$customer->LastName?></p>
<p style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">Thank you for your order. We're pretty sure you can remember what you ordered but just in case, here are some details to remind you<br />

</p>
<p style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;"> You have chosen to pay by Credit Card, please keep your payment evidence that issued by Credit Card Bank for recognition until goods has been received.<br /> Your 
order will be shipped out to you upon confirmation of your payment. </p>
<table width="73%" border="0" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td colspan="2"><strong style="font-size:14px; font-family: Tahoma, Geneva, sans-serif;">PRODUCT DETAILS</strong></td>
    </tr>
    <tr>
      <td width="81%"> <strong>Order Number</strong>: <?=$order->Order_ID?> </td>
      <td width="17%"><div align="left" style="text-align: right"><?=date('d/m/Y')?></div></td>
    </tr>
    <tr>
      <td colspan="2"><table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <tr>
            <td height="19" valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td align="right" valign="top">&nbsp;</td>
            <td align="right" valign="top">&nbsp;</td>
            </tr>
          <tr>
            <td width="221" valign="top">Item</td>
            <td valign="top" width="182">Description</td>
            <td valign="top" width="163">Available Color<br /></td>
            <td align="right" valign="top" width="108">Unit Price</td>
            <td align="right" valign="top" width="120">Total Price<br /></td>
            </tr>
          <tr style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td valign="top">&nbsp;</td>
            <td align="right" valign="top">&nbsp;</td>
            <td align="right" valign="top">&nbsp;</td>
            </tr>
            <?php $order_item_total_price = 0; ?>
			<?php //$count_item = count($order_items) ?>
			<?php foreach($order_items as $result): ?>
          <tr style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">
            <td valign="top"><img src="http://online.goodjobstore.com/public/<?=$result->images_Thumbnail_path?>" alt="" /><br/><br/></td>
            <td valign="top"><?=$result->products_Pro_Name_En?> x <?=$result->order_item_Qty?></td>
            <td valign="top"><?=$result->color_Name_EN?></td>
            <td align="right" valign="top">
				<?
					$exPrice = number_format(($result->order_item_Total_Price/$result->order_item_Qty), 2);
					if(LANG=='EN')
						echo "US$ ".google_finance_convert("THB", "USD", $exPrice);
					else
						echo $exPrice." ฿";
				?>
			</td>
            <td align="right" valign="top">
				<?
					$exPrice = number_format($result->order_item_Total_Price, 2);
					if(LANG=='EN')
						echo "US$ ".google_finance_convert("THB", "USD", $exPrice);
					else
						echo $exPrice." ฿";
				?>
			</td>
            </tr>
            <?php $order_item_total_price = $order_item_total_price + $result->order_item_Total_Price ?>
            <?php endforeach; ?>
          <tr>
            <td colspan="5"><br /></td>
            </tr>
          <tr>
            <td colspan="3"> </td>
            <td align="right" width="108" style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">Subtotal<br /></td>
            <td align="right" width="120" style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">
				<?
					$exSubTotal = number_format($order->Total_Price, 2);
					if(LANG=='EN')
						echo "US$ ".google_finance_convert("THB", "USD", $exSubTotal);
					else
						echo $exSubTotal." ฿";
				?>
				<br />
			</td>
            </tr>
          <tr>
            <td colspan="3"> </td>
            <td align="right" width="108" style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">Shipping<br /></td>
            <td align="right" width="120" style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">
				<?
					$exShipping = number_format($order->shipping_price, 2);
					if(LANG=='EN')
						echo "US$ ".google_finance_convert("THB", "USD", $exShipping);
					else
						echo $exShipping." ฿";
				?>
				<br />
			</td>
            </tr>
          <tr>
            <td colspan="3"> </td>
            <td align="right" width="108" style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">Services<br /></td>
            <td align="right" width="120" style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">
				<?
					$exService = number_format($order->service_price, 2);
					if(LANG=='EN')
						echo "US$ ".google_finance_convert("THB", "USD", $exService);
					else
						echo $exService." ฿";
				?>
				<br />
			</td>
            </tr>
          <tr>
            <td colspan="3"> </td>
            <td align="right" width="108" style="font-size: 12px;  font-family: Tahoma, Geneva, sans-serif;"><strong>Total <br />
              </strong></td>
            <td align="right" width="120" style="font-size: 12px;  font-family: Tahoma, Geneva, sans-serif;"><strong>
				<?
					$exTotalPrice = number_format($order->Final_Price, 2);
					if(LANG=='EN')
						echo "US$ ".google_finance_convert("THB", "USD", $exTotalPrice);
					else
						echo $exTotalPrice." ฿";
				?>
				<br />
              </strong></td>
            </tr>
          </tbody>
      </table></td>
    </tr>
  </tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="73%">
  <tbody>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td style="font-size: 14px;  font-family: Tahoma, Geneva, sans-serif;"><strong>SHIPPING DETAILS</strong></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <?php 
		if($order->How_ID==1 OR $order->How_ID==2)
		{
			$shipping_method = get_shipping_method($order->How_ID);?>
			<td style="font-size: 14px; font-family: Tahoma, Geneva, sans-serif;">
				<strong>Shipping Method</strong>: <?=(LANG=='TH')?$shipping_method->Name_Th:$shipping_method->Name_En;?>
			</td>
	  <?}
		else
		{
			$shippingUPS_method = get_shippingUPS_method($order->How_ID);?>
			<td style="font-size: 14px; font-family: Tahoma, Geneva, sans-serif;">
				<strong>Shipping Method</strong>: <?=$shippingUPS_method->type_name?>
			</td>
		<?}?>
      <td align="right" style="font-size: 14px;  font-family: Tahoma, Geneva, sans-serif;"><strong>Est. Delivery Time: 5 - 7 day delivery </strong><br /></td>
    </tr>
    <tr>
      <td width="52%" style="font-size: 12px; font-family: Tahoma, Geneva, sans-serif;"><strong>Ship To</strong></td>
      <td width="46%" style="font-size: 12px;  font-family: Tahoma, Geneva, sans-serif;"><strong>Bill To</strong></td>
    </tr>
    <tr>
      <td style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">
	  <!------ shipping address ------>
        <?=$shipping->s_Address?><br />
        <?
			if($shipping->s_Country_ID==222)
				echo show_city_from_id($shipping->s_City_ID);
			else
				echo $shipping->s_City_Name;
		?>
		<br />
        <br />
        <?=$shipping->s_Postal_Code?><br />
        <br />
		<?
			if($shipping->s_Country_ID==222)
				echo "Thailand";
			else
			{
				$sqlCountry = "SELECT country_name FROM country WHERE Country_ID=$shipping->s_Country_ID";
				$queryCountry = $this->db->query($sqlCountry)->result();
				foreach($queryCountry as $valueCountry)
				{
					echo $valueCountry->country_name;
				}
			}
		?>
        <br /></td>
      <td style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">
	  <!------ customer address ------>
        <?=$customer->Address?><br />
        <?
			if($customer->Country_ID==222)
				echo show_city_from_id($customer->City_ID);
			else
				echo $customer->City_Name;
		?><br />
        <br />
        <?=$customer->Postal_Code?><br />
        <br />
		<?
			if($customer->Country_ID==222)
				echo "Thailand";
			else
			{
				$sqlCountry = "SELECT country_name FROM country WHERE Country_ID=$customer->Country_ID";
				$queryCountry = $this->db->query($sqlCountry)->result();
				foreach($queryCountry as $valueCountry)
				{
					echo $valueCountry->country_name;
				}
			}
		?>
		<br /></td>
    </tr>
  </tbody>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="73%">
  <tbody>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td style="font-size: 14px;  font-family: Tahoma, Geneva, sans-serif;"><strong>PAYMENT DETAILS</strong></td>
    </tr>
    <tr>
      <td style="font-size: 14px; font-family: Tahoma, Geneva, sans-serif;"><strong>Payment Method: </strong>Credit Card <strong><br />
      </strong></td>
    </tr>
    <tr>
      <td style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;"><br />
        <p>Upon receiving your payment, your order will be shipped - usually within 48 hours.<br/>If we do not receive payment within 4 business days we will send you a reminder email.<br/> After 7 days and no payment has been received we will attempt to call you before cancelling your order.</p></td>
    </tr>
  </tbody>
</table>
<table width="719" cellpadding="0" cellspacing="0">
  <tr>
    <td width="717"><table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tbody>
      <tr>
        <td><table border="0" cellpadding="0" cellspacing="0" width="86%">
          <tbody>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            </tbody>
        </table></td>
      </tr>
      </tbody>
    </table></td>
  </tr>
  <tr>
    <td>--------------------------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tbody>
        <tr>
          <td valign="top" width="381" style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;"><p>Additional Information<br />
            To cancel or amend any details of this order please call us on: <br />
            02 683 5660 during normal business hours 9am - 5pm <br />
            Monday to Friday.</p>
            <p>At all other times please email us at:<br />
              <a href="mailto:au_orders@crumpler.com" target="_blank">contact@goodjobstore.com</a> stating your order number.</p>
            <p><br />
            </p></td>
          <td align="right" valign="top" width="424"><div>
            <p style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">GOOODJOB<br />
              729/16-17<br />
              Ratchadapisek Rd.<br />
              Yanawa Bangkok<br />
              10120 Thailand<br />
              </p>
            <p style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">T 02 683 5660<br />
              </p>
            <p style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;"><a href="mailto:contact@goodjobstore.com" target="_blank" >contact@goodjobstore.com</a></p>
            </div>
            <p style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;"><a href="http://www.goodjobstore.com/" target="_blank">www.goodjobstore.com</a></p></td>
          </tr>
      </tbody>
    </table></td>
  </tr>
  <br />
</table>
</body>
</html>
