<?php

function get_all_main_navigation()
{
	$ci =& get_instance();
	$ci->db->order_by('main_sort', 'asc');
	return $ci->db->get('main_menu')->result();
}

function get_all_sub_menu_navigation($main_ID)
{
	$ci =& get_instance();
	$ci->db->order_by('sub_sort', 'asc');
	return $ci->db->get_where('sub_menu', array('Main_ID' => $main_ID))->result();
}

function get_all_son_menu_navigation($main_ID)
{
	$ci =& get_instance();
	return $ci->db->get_where('son_menu', array('Sub_ID' => $main_ID))->result();
}

function get_select_city()
{
	$ci =& get_instance();
	$ci->db->order_by('City_ID', 'asc');
	$query = $ci->db->get('city');
	return $query->result();
}

function get_check_color($color)
{
	$ci =& get_instance();
	$query = $ci->db->get_where('color', array('Color_ID'=>$color));
	return $query->row();
}

function get_cart_data()
{
	$ci =& get_instance();
	$ci->db->select('cart.Cart_ID as cart_Cart_ID, cart.Color_ID, cart.Product_ID, cart.Create_Date as cart_Create_Date, cart.Qty as cart_Qty, products.Pro_Name_Th as products_Pro_Name_Th, products.Pro_Name_En as products_Pro_Name_En, products.Size as products_Size, products.Price_sale as products_Price_sale, products.Price_Buy as products_Price_Buy, images.Thumbnail_path as images_Thumbnail_path, color.Name_TH as color_Name_TH, color.Name_EN as color_Name_EN');
	$ci->db->order_by('cart.Create_Date', 'desc');
	$ci->db->order_by('cart.Cart_ID', 'desc');
	$ci->db->from('cart');
	$ci->db->join('products', 'products.Product_ID = cart.Product_ID');

	if($ci->session->userdata('logged_in'))
	{
		$Cus_ID = $ci->session->userdata('customer')->Cus_ID;
		$ci->db->where('cart.Cus_ID', $Cus_ID);
	}
	else
	{
		$Session_ID = $ci->session->userdata('session_id');
		$ci->db->where('cart.Session_ID', $Session_ID);
		//echo $Session_ID;
	}

	$ci->db->join('images', 'images.Product_ID = cart.Product_ID AND images.Color_ID = cart.Color_ID');
	$ci->db->join('color', 'color.Color_ID = cart.Color_ID');
	$ci->db->group_by(array("images.Product_ID", "images.Color_ID"));
	return $ci->db->get()->result();

}

function cal_price_from_coupon($price)
{
	$ci =& get_instance();

	if($ci->session->userdata('logged_in') && $price!=0)
	{

		$Cus_ID = $ci->session->userdata('customer')->Cus_ID;
		$now = date("Y-m-d");

		$ci->db->select('coupon.Coupon_ID as coupon_Coupon_ID, coupon.Discount_PC as coupon_Discount_PC, coupon.Discount_Cash as coupon_Discount_Cash, coupon.Start_Date as coupon_Start_Date, coupon.Expired_Date as coupon_Expired_Date, coupon.Db_Min as coupon_Db_Min, coupon.Db_Max as coupon_Db_Max, coupon.Discount_Status as coupon_Discount_Status, coupon_customers.id as coupon_customers_id, coupon_customers.Cus_ID as coupon_customers_Cus_ID, coupon_customers.Coupon_ID as coupon_customers_Coupon_ID, coupon_customers.created_at as coupon_customers_created_at, coupon_customers.status as coupon_customers_status');
		$ci->db->from('coupon_customers');
		$ci->db->join('coupon', 'coupon.Coupon_ID = coupon_customers.Coupon_ID');
		$ci->db->where('coupon_customers.Cus_ID', $Cus_ID);
		$ci->db->where('coupon_customers.status', 1);
		$ci->db->where('coupon.Discount_Status !=', 0);
		$ci->db->where('coupon.Start_Date <=', $now);
		$ci->db->where('coupon.Expired_Date >=', $now);

		$coupon_customers = $ci->db->get()->row();

		//return $coupon_customers->coupon_customers_id;

		if(isset($coupon_customers->coupon_customers_id))
		{
			if($coupon_customers->coupon_Discount_Status==1)
			{
				$new_price = $price - ( ($price/100)*$coupon_customers->coupon_Discount_PC );
			}
			elseif($coupon_customers->coupon_Discount_Status==2)
			{
				$new_price = $price - $coupon_customers->coupon_Discount_Cash;
			}
			else
			{
				$new_price = $price;
			}

			return $new_price;
		}
		else
		{
			return $price;
		}
	}
	else
	{
		return $price;
	}

}


function get_how_delivery()
{
	$ci =& get_instance();
	return $ci->db->get('how_delivery')->result();
}

function cal_range_weight($How_ID , $Total_Weight)
{
	$ci =& get_instance();
	$Cus_ID = $ci->session->userdata('customer')->Cus_ID;
	$order = $ci->db->get_where('orders', array('Cus_ID'=>$Cus_ID, 'Order_Status'=>0))->row();

	$free_shipping = $ci->db->order_by('min_price', 'asc')->get_where('free_shipping', array('status'=>1))->row();
	if($free_shipping && $How_ID == 1)
	{
		if($order->Total_Price < $free_shipping->min_price)
		{
			$ci->db->where('How_ID', $How_ID);
			$ci->db->where('Weight_Start <=', $Total_Weight);
			$ci->db->where('Weight_End >=', $Total_Weight);
			$query = $ci->db->get('range_weight')->row();

			if(!empty($query->Price))
			{
				return $query->Price;
			}
		}
		else
		{
			return 0;
		}
	}
	else
	{
		$ci->db->where('How_ID', $How_ID);
		$ci->db->where('Weight_Start <=', $Total_Weight);
		$ci->db->where('Weight_End >=', $Total_Weight);
		$query = $ci->db->get('range_weight')->row();

		if(!empty($query->Price))
		{
			return $query->Price;
		}
	}
}

function get_shipping_option()
{
	$ci =& get_instance();
	return $ci->db->get('shipping_option')->result();
}

function cal_price_option($Order_ID)
{
	$ci =& get_instance();

	$ci->db->select('*');
	$ci->db->from('have_option');
	$ci->db->join('shipping_option', 'shipping_option.Option_ID = have_option.Option_ID');
	$ci->db->where('have_option.Order_ID', $Order_ID);
	$options = $ci->db->get()->result();

	$total_price = 0;

	foreach ($options as $key => $value)
	{
		$total_price = $total_price + $value->Price;
	}

	return $total_price;
}

function check_have_option($Option_ID=NULL, $Order_ID=NULL)
{
	$ci =& get_instance();
	$query = $ci->db->get_where('have_option', array('Option_ID'=>$Option_ID, 'Order_ID'=>$Order_ID))->row();
	if(!empty($query))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function get_payments()
{
	$ci =& get_instance();
	return $ci->db->get('payments')->result();
}

function show_city_from_id($id)
{
	$ci =& get_instance();
	$query = $ci->db->get_where('city', array('City_ID'=>$id))->row();

	if(!empty($query->City_ID))
	{
		if(LANG=='TH')
		{
			return $query->Name_Th;
		}
		else
		{
			if(!empty($query->Name_En))
			{
				return $query->Name_En;
			}
			else
			{
				return $query->Name_Th;
			}
		}
	}

}

function set_final_price($price=NULL, $Order_ID=NULL, $service_price=NULL, $shipping_price=NULL)
{
	$ci =& get_instance();
	$ci->db->where('Order_ID', $Order_ID);
	$ci->db->update('orders', array('Final_Price'=>$price, 'service_price'=>$service_price, 'shipping_price'=>$shipping_price));
}

function send_mail_helper($email_arr=NULL)
{
	$ci =& get_instance();

	/*$config = Array(
	  'protocol' => 'smtp',
	  'smtp_host' => 'ssl://smtp.googlemail.com',
	  'smtp_port' => 465,
	  'smtp_user' => 'iphatphong@gmail.com',
	  'smtp_pass' => '',
	  'mailtype' => 'html',
	  'wordwrap' => TRUE
	);*/

	$config = Array(
	  'protocol' => 'smtp',
	  'smtp_host' => 'smtpweb.netdesignhost.com',
	  'mailtype' => 'html',
	  'wordwrap' => TRUE
	);

	$ci->email->initialize($config);

	$ci->email->set_newline("\r\n");
	$ci->email->from($email_arr['from']);
	$ci->email->to($email_arr['to']);
	$ci->email->subject($email_arr['subject']);
	$ci->email->message($email_arr['message']);

	$ci->email->send();

	//echo $ci->email->print_debugger();
}

function get_product_color($Product_ID)
{
	$ci =& get_instance();
	$ci->db->select('*');
	$ci->db->from('products');
	$ci->db->where_in('products.Product_ID', $Product_ID);
	$ci->db->join('images', 'images.Product_ID = products.Product_ID');
	$ci->db->join('color', 'color.Color_ID = images.Color_ID');
	return $ci->db->get()->result();
}

function get_shipping_method($How_ID)
{
	if($How_ID)
	{
		$ci =& get_instance();
		return $ci->db->get_where('how_delivery', array('How_ID'=>$How_ID))->row();
	}
	else
	{
		return FALSE;
	}

}
