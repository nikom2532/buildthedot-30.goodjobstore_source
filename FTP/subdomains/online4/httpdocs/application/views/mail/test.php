<?
$orderID = $order->Order_ID;
$finalPrice = $order->Final_Price;
$orderItem = $order_items;
$getShipMethod = get_shipping_method($order->How_ID);
$shipPrice = $order->shipping_price;
$servicePrice = $order->service_price;
$fName = $customer->FirstName;
$lName = $customer->LastName;
$sAddress = $shipping->s_Address;
$sCityID = show_city_from_id($shipping->s_City_ID);
$sPostCode = $shipping->s_Postal_Code;
$cusID = $customer->Cus_ID;

echo $orderID;
echo "<br>";
echo $finalPrice;
echo "<br>";
echo $orderItem;
echo "<br>";
echo $getShipMethod;
echo "<br>";
echo $shipPrice;
echo "<br>";
echo $servicePrice;
echo "<br>";
echo $fName;
echo "<br>";
echo $lName;
echo "<br>";
echo $sAddress;
echo "<br>";
echo $sCityID;
echo "<br>";
echo $sPostCode;
echo "<br>";
echo $cusID;
echo "<br>";
?>