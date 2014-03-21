<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<p><span style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">Hi,<?=$customer->FirstName?> <?=$customer->LastName?>.</span></p>
<p><span style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">Thank you for your order. We're pretty sure you can remember what you ordered but just in case, here are your shipping number.</span></p>
<strong><?=$order->shipping_number?></Strong>

<p><span style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">You can track your order 24/7 on <a href="http://track.thailandpost.co.th/trackinternet/Default.aspx?lang=t">TRACK &amp; TRACE</a> system, just&nbsp;input &nbsp;number which show on above,  then click the &quot;Track&quot; button.</span></p>
<?
if($order->How_ID==3 or $order->How_ID==4)
{?>
<p><span style="font-size: 12px; color: #999; font-family: Tahoma, Geneva, sans-serif;">You can track your order 24/7 on <a href="http://www.ups.com/WebTracking/track?loc=en_TH&WT.svl=PriNav">TRACK &amp; TRACE</a> system, just&nbsp;input &nbsp;number which show on above,  then click the &quot;Track&quot; button.</span></p>
<?}?>
<table border="0" cellspacing="0" cellpadding="0" width="73%">
  <tr>
    <td></td>
  </tr>
</table>
<table width="719" cellpadding="0" cellspacing="0">
  <tr>
    <td width="717">-----------------------------------------------------------------------------------------------------------------------</td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="0" width="100%">
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

