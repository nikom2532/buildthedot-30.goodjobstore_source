<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function get_order_gifts($where=array())
{
	$ci =& get_instance();
	return $ci->Order_gifts_model->get_data($where)->row();
}

function cal_order_gifts($Order_ID=NULL)
{
	$ci =& get_instance();
	$order_item = $ci->db->get_where('order_item', array('Order_ID'=>$Order_ID))->result();

	$gift_price_obj = $ci->db->get('shipping_option', array('Option_ID'=>1))->row();
	if(!empty($gift_price_obj))
	{
		$gift_price = $gift_price_obj->Price;
	}
	else
	{
		$gift_price = 0;
	}
	$total_price = 0;
	foreach($order_item as $value)
	{
		$order_gift = $ci->Order_gifts_model->get_data(array('Order_ID'=>$Order_ID, 'Product_ID'=>$value->Product_ID))->row();
		if(!empty($order_gift))
		{
			$total_price = $total_price + ($gift_price * $value->Qty);
			//var_dump($total_price);
		}
	}

	return $total_price;
}