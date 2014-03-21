<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Checkout extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged_in'))
		{
			redirect('login');
		}

		$this->_get_pdf();
	}

	function index()
	{
		redirect('checkout/billing');
	}

	function billing($alert=NULL)
	{
		$data['has_alert'] = '0';
		if($alert=='alert')
			$data['has_alert'] = '1';

		$Order_ID = $this->_update_order();

		$Cus_ID = $this->session->userdata('customer')->Cus_ID;

		$this->db->select('*');
		$this->db->from('customers');
		$this->db->join('shipping', 'shipping.Cus_ID = customers.Cus_ID');
		$this->db->where('customers.Cus_ID', $Cus_ID);

		$query = $this->db->get();
		$data['users'] = $query->row();
		$_POST = $query->row_array();
		$data['has_ship'] = '1';

		if(!$_POST)
		{
			$query = $this->db->get_where('customers', array('Cus_ID'=>$Cus_ID));
			$_POST = $query->row_array();
			$data['has_ship'] = '0';
		}

		$this->form_validation->run('customer_shipping');

		$data['gift_price'] =  $this->db->get_where('shipping_option', array('Option_ID'=>1))->row();

		$data['order_items'] = $this->_get_order_item_data($Order_ID);

		$data['order'] = $this->db->get_where('orders', array('Order_ID'=>$Order_ID))->row();

		$data['nav_1'] = array('name'=>'Checkout', 'link'=>site_url("checkout"), 'current'=>FALSE);
		$data['nav_2'] = array('name'=>'Billing', 'link'=>site_url("checkout/billing"), 'current'=>TRUE);

		$this->template->view('checkout/billing', $data);

	}

	function payment($checkPayment=NULL)
	{
		$data['checkPayment'] = $checkPayment;

		$Order_ID = $this->_update_order();

		$Cus_ID = $this->session->userdata('customer')->Cus_ID;

		$data['shipping'] = $this->db->get_where('shipping', array('Cus_ID'=>$Cus_ID))->row();
		$data['users'] = $this->db->get_where('customers', array('Cus_ID'=>$Cus_ID))->row();

		if(!$data['shipping'])
		{
			redirect('checkout/billing/alert');
		}
		else
		{
			if($data['shipping']->s_FirstName=='' OR $data['shipping']->s_LastName=='' OR $data['shipping']->s_Phone_Number=='' OR $data['shipping']->s_Address=='' OR $data['shipping']->s_Postal_Code=='')
			{
				redirect('checkout/billing/alert');
			}
		}

		$data['order_items'] = $this->_get_order_item_data($Order_ID);

		$data['order'] = $this->db->get_where('orders', array('Order_ID'=>$Order_ID))->row();

		if($data['order']->How_ID==0)
		{
			redirect('checkout/billing/alert');
		}

		if($data['shipping']->s_Country_ID==222)
		{
			if($data['order']->How_ID==3 OR $data['order']->How_ID==4 OR $data['shipping']->s_City_ID==0)
			{
				redirect('checkout/billing/alert');
			}
		}
		else
		{
			if($data['order']->How_ID==1 OR $data['order']->How_ID==2 OR $data['shipping']->s_City_Name=='')
			{
				redirect('checkout/billing/alert');
			}
		}

		$data['nav_1'] = array('name'=>'Checkout', 'link'=>site_url("checkout"), 'current'=>FALSE);
		$data['nav_2'] = array('name'=>'Payment', 'link'=>site_url("checkout/payment"), 'current'=>TRUE);
		$this->template->view('checkout/payment', $data);
	}

	function payment_update()
	{
		$this->Order_gifts_model->set_data($_POST['Order_ID'], $_POST['gift_type']);
		if(!$this->input->post('payment'))
		{
			$checkPayment = 1;
			redirect("checkout/payment/{$checkPayment}");
		}
		else
		{
			$this->db->where('Order_ID',$this->input->post('Order_ID'));
			$this->db->update('orders', array('payment_id'=>$this->input->post('payment')));

			redirect('checkout/review');
		}
	}

	function review()
	{
		$Order_ID = $this->_update_order();

		$Cus_ID = $this->session->userdata('customer')->Cus_ID;

		$data['order_items'] = $this->_get_order_item_data($Order_ID);

		$data['order'] = $this->db->get_where('orders', array('Order_ID'=>$Order_ID))->row();

		$data['shipping'] = $this->db->get_where('shipping', array('Cus_ID'=>$Cus_ID))->row();

		$data['customer'] = $this->db->get_where('customers', array('Cus_ID'=>$Cus_ID))->row();

		$data['nav_1'] = array('name'=>'Checkout', 'link'=>site_url("checkout"), 'current'=>FALSE);
		$data['nav_2'] = array('name'=>'Review Order', 'link'=>site_url("checkout/review"), 'current'=>TRUE);
		$this->template->view('checkout/review', $data);
	}

	function redirect_payment($Order_ID=NULL)
	{
		$data['order'] = $this->db->get_where('orders', array('Order_ID'=>$Order_ID))->row();
		//var_dump($order);
		$this->template->view('checkout/redirect_payment');
	}

	function confirmation()
	{

		$order = $this->_get_order_id();

		if($order->payment_id == 1)
		{
			if($_GET['RESPCODE'] == '00' && $_GET['REF1'] == $order->Order_ID && $_GET['STATUS'] == 'COMPLETE')
			{
				$this->db->where('Order_ID', $order->Order_ID);
				$this->db->update('orders', array('Order_Status' => 1, 'created_at'=>date("Y-m-d H:i:s")));

				$this->_update_product_qty($order->Cus_ID);

				$this->db->delete('cart', array('Cus_ID' => $order->Cus_ID));

				$this->db->where('Cus_ID', $order->Cus_ID);
				$this->db->where('status', 1);
				$this->db->update('coupon_customers', array('status'=>0));

				$data['order'] = $order;

				$this->_order_confirmation_credit_card($order);
			}
			else
			{
				redirect('checkout/review');
			}
		}
		elseif($order->payment_id == 2)
		{
			$this->db->where('Order_ID', $order->Order_ID);
			$this->db->update('orders', array('Order_Status' => 1, 'created_at'=>date("Y-m-d H:i:s")));

			$this->_update_product_qty($order->Cus_ID);

			$this->db->delete('cart', array('Cus_ID' => $order->Cus_ID));

			$this->db->where('Cus_ID', $order->Cus_ID);
			$this->db->where('status', 1);
			$this->db->update('coupon_customers', array('status'=>0));

			$data['order'] = $order;

			//$this->load->view('mail/pdf', $data);

			$this->_order_confirmation_direct_deposit($order);
			//redirect('checkout/review');
		}
		elseif($order->payment_id == 3)
		{

			if($_GET['order_id'] == $order->Order_ID && $_GET['status'] == 'complate')
			{
				$this->db->where('Order_ID', $order->Order_ID);
				$this->db->update('orders', array('Order_Status' => 1, 'created_at'=>date("Y-m-d H:i:s")));

				$this->_update_product_qty($order->Cus_ID);

				$this->db->delete('cart', array('Cus_ID' => $order->Cus_ID));

				$this->db->where('Cus_ID', $order->Cus_ID);
				$this->db->where('status', 1);
				$this->db->update('coupon_customers', array('status'=>0));

				$data['order'] = $order;

				$this->_order_confirmation_paypal($order);
				/*var_dump($_GET);
				echo "<br><br>";
				var_dump($order);
				exit();*/
			}
			else
			{
				redirect('checkout/review');
			}
		}
		else
		{
			redirect('checkout/review');
		}

		$data['nav_1'] = array('name'=>'Checkout', 'link'=>site_url("checkout"), 'current'=>FALSE);
		$data['nav_2'] = array('name'=>'Confirmation', 'link'=>site_url("checkout/confirmation"), 'current'=>TRUE);
		$this->template->view('checkout/confirmation', $data);
	}

	function _get_order_id()
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		$carts = $this->_get_cart_data_to_order();
		$order = $this->db->get_where('orders', array('Cus_ID'=>$Cus_ID, 'Order_Status'=>0))->row();

		return $order;
	}

	function _get_cart_data()
	{
		$this->db->select('cart.Cart_ID as cart_Cart_ID, cart.Color_ID as cart_Color_ID, cart.Product_ID as cart_Product_ID, cart.Create_Date as cart_Create_Date, cart.Qty as cart_Qty, products.Pro_Name_Th as products_Pro_Name_Th, products.Pro_Name_En as products_Pro_Name_En, products.Size as products_Size, products.Price_sale as products_Price_sale, products.Price_Buy as products_Price_Buy, images.Thumbnail_path as images_Thumbnail_path, color.Name_TH as color_Name_TH, color.Name_EN as color_Name_EN');
		$this->db->order_by('cart.Create_Date', 'desc');
		$this->db->order_by('cart.Cart_ID', 'desc');
		$this->db->from('cart');
		$this->db->join('products', 'products.Product_ID = cart.Product_ID');

		if($this->session->userdata('logged_in'))
		{
			$Cus_ID = $this->session->userdata('customer')->Cus_ID;
			$this->db->where('cart.Cus_ID', $Cus_ID);
		}
		else
		{
			$Session_ID = $this->session->userdata('session_id');
			$this->db->where('cart.Session_ID', $Session_ID);
			//echo $Session_ID;
		}

		$this->db->join('images', 'images.Product_ID = cart.Product_ID AND images.Color_ID = cart.Color_ID');
		$this->db->join('color', 'color.Color_ID = cart.Color_ID');
		$this->db->group_by(array("images.Product_ID", "images.Color_ID"));
		return $this->db->get()->result();
	}

	function _get_cart_data_to_order()
	{
		$this->db->select('cart.Cart_ID as cart_Cart_ID, cart.Color_ID as cart_Color_ID, cart.Product_ID as cart_Product_ID, cart.Create_Date as cart_Create_Date, cart.Qty as cart_Qty, products.Pro_Name_Th as products_Pro_Name_Th, products.Pro_Name_En as products_Pro_Name_En, products.Size as products_Size, products.Weight as products_Weight, products.Price_sale as products_Price_sale, products.Price_Buy as products_Price_Buy, images.Thumbnail_path as images_Thumbnail_path, color.Name_TH as color_Name_TH, color.Name_EN as color_Name_EN');
		$this->db->order_by('cart.Create_Date', 'desc');
		$this->db->order_by('cart.Cart_ID', 'desc');
		$this->db->from('cart');
		$this->db->join('products', 'products.Product_ID = cart.Product_ID');

		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		$this->db->where('cart.Cus_ID', $Cus_ID);

		$this->db->join('images', 'images.Product_ID = cart.Product_ID AND images.Color_ID = cart.Color_ID');
		$this->db->join('color', 'color.Color_ID = cart.Color_ID');
		$this->db->group_by(array("images.Product_ID", "images.Color_ID"));
		return $this->db->get()->result();
	}

	function _update_order()
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		$carts = $this->_get_cart_data_to_order();
		$order = $this->db->get_where('orders', array('Cus_ID'=>$Cus_ID, 'Order_Status'=>0))->row();

		if(empty($order))
		{
			$coupon = $this->_check_coupon();

			if(empty($coupon))
			{
				$Total_Price = 0;
				$Total_Weight = 0;

				foreach ($carts as $key => $value)
				{
					if($value->products_Price_sale==0)
					{
						$total = $value->products_Price_Buy * $value->cart_Qty;
						$Total_Price = $Total_Price + $total;
					}
					else
					{
						$total = $value->products_Price_sale * $value->cart_Qty;
						$Total_Price = $Total_Price + $total;
					}

					$Weight = $value->products_Weight * $value->cart_Qty;
					$Total_Weight = $Total_Weight + $Weight;
				}

				$Order_ID = $this->_gen_order_code();

				$this->db->insert('orders', array('Order_ID'=>$Order_ID, 'Cus_ID'=>$Cus_ID, 'Total_Price'=>$Total_Price, 'Total_Weight'=>$Total_Weight));

				$this->_update_order_item($Order_ID, $carts);
			}
			else
			{
				$Total_Price = 0;
				$Total_Weight = 0;

				foreach ($carts as $key => $value)
				{
					if($value->products_Price_sale==0)
					{
						$total = $value->products_Price_Buy * $value->cart_Qty;
						$Total_Price = $Total_Price + $total;
					}
					else
					{
						$total = $value->products_Price_sale * $value->cart_Qty;
						$Total_Price = $Total_Price + $total;
					}
					$Weight = $value->products_Weight * $value->cart_Qty;
					$Total_Weight = $Total_Weight + $Weight;
				}

				$old_price = $Total_Price;

				if($coupon->coupon_Discount_Status==1)
				{
					$Total_Price = $Total_Price - ( ($Total_Price/100)*$coupon->coupon_Discount_PC );
				}
				elseif($coupon->coupon_Discount_Status==2)
				{
					$Total_Price = $Total_Price - $coupon->coupon_Discount_Cash;
				}

				$Discount_Price = $old_price - $Total_Price;
				$Order_ID = $this->_gen_order_code();

				$this->db->insert('orders', array('Order_ID'=>$Order_ID, 'Cus_ID'=>$Cus_ID, 'Coupon_ID'=>$coupon->coupon_Coupon_ID, 'Total_Price'=>$Total_Price, 'Discount_Price'=>$Discount_Price, 'Total_Weight'=>$Total_Weight));

				$this->_update_order_item($Order_ID, $carts);
			}
		}
		else
		{
			$Order_ID = $order->Order_ID;

			$coupon = $this->_check_coupon();

			if(empty($coupon))
			{
				$Total_Price = 0;
				$Total_Weight = 0;

				foreach ($carts as $key => $value)
				{
					if($value->products_Price_sale==0)
					{
						$total = $value->products_Price_Buy * $value->cart_Qty;
						$Total_Price = $Total_Price + $total;
					}
					else
					{
						$total = $value->products_Price_sale * $value->cart_Qty;
						$Total_Price = $Total_Price + $total;
					}
					$Weight = $value->products_Weight * $value->cart_Qty;
					$Total_Weight = $Total_Weight + $Weight;
				}
				$this->db->where('Order_ID', $Order_ID);
				$this->db->update('orders', array('Total_Price'=>$Total_Price, 'Total_Weight'=>$Total_Weight));

				$this->_update_order_item($Order_ID, $carts);
			}
			else
			{
				$Total_Price = 0;
				$Total_Weight = 0;

				foreach ($carts as $key => $value)
				{
					if($value->products_Price_sale==0)
					{
						$total = $value->products_Price_Buy * $value->cart_Qty;
						$Total_Price = $Total_Price + $total;
					}
					else
					{
						$total = $value->products_Price_sale * $value->cart_Qty;
						$Total_Price = $Total_Price + $total;
					}

					$Weight = $value->products_Weight * $value->cart_Qty;
					$Total_Weight = $Total_Weight + $Weight;
				}

				$old_price = $Total_Price;

				if($coupon->coupon_Discount_Status==1)
				{
					$Total_Price = $Total_Price - ( ($Total_Price/100)*$coupon->coupon_Discount_PC );
				}
				elseif($coupon->coupon_Discount_Status==2)
				{
					$Total_Price = $Total_Price - $coupon->coupon_Discount_Cash;
				}

				$Discount_Price = $old_price - $Total_Price;

				$this->db->where('Order_ID', $Order_ID);
				$this->db->update('orders', array('Coupon_ID'=>$coupon->coupon_Coupon_ID, 'Total_Price'=>$Total_Price, 'Discount_Price'=>$Discount_Price, 'Total_Weight'=>$Total_Weight));

				$this->_update_order_item($Order_ID, $carts);
			}
		}

		return $Order_ID;
	}

	function _update_order_item($Order_ID=NULL, $carts=NULL)
	{

		if(!empty($Order_ID))
		{
			$this->db->delete('order_item', array('Order_ID'=>$Order_ID));
			//$thai->db->delete('order_item_gift', array('Order_ID'=>$Order_ID));

			foreach ($carts as $key => $value)
			{
				if($value->products_Price_sale==0)
				{
					$Total_Price_item = $value->products_Price_Buy * $value->cart_Qty;
				}
				else
				{
					$Total_Price_item = $value->products_Price_sale * $value->cart_Qty;
				}

				$item = array(
					'Order_ID' => $Order_ID,
					'Product_ID' => $value->cart_Product_ID,
					'Qty' => $value->cart_Qty,
					'Color_ID' => $value->cart_Color_ID,
					'Total_Price' => $Total_Price_item,
					'Create_Date' =>  date("Y-m-d"),
					'Status' => 'Pending'
				);

				$this->db->insert('order_item', $item);
			}
		}

		if(empty($carts))
		{
			redirect('cart');
		}
	}

	function _gen_order_code()
	{
		/*$this->db->order_by('Order_ID', 'desc');
		$query = $this->db->get('orders')->row()->Order_ID;

		$id = str_replace('WAU','',$query);
		return 'WAU'.sprintf("%06d",$id+1);*/

		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		//echo date("Y-m-d");
		return $Cus_ID.date("d").date("m").date("y").date("H").date("i");
	}

	function _check_coupon()
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		$now = date("Y-m-d");

		$this->db->select('coupon.Coupon_ID as coupon_Coupon_ID, coupon.Discount_PC as coupon_Discount_PC, coupon.Discount_Cash as coupon_Discount_Cash, coupon.Start_Date as coupon_Start_Date, coupon.Expired_Date as coupon_Expired_Date, coupon.Db_Min as coupon_Db_Min, coupon.Db_Max as coupon_Db_Max, coupon.Discount_Status as coupon_Discount_Status, coupon_customers.id as coupon_customers_id, coupon_customers.Cus_ID as coupon_customers_Cus_ID, coupon_customers.Coupon_ID as coupon_customers_Coupon_ID, coupon_customers.created_at as coupon_customers_created_at, coupon_customers.status as coupon_customers_status');
		$this->db->from('coupon_customers');
		$this->db->join('coupon', 'coupon.Coupon_ID = coupon_customers.Coupon_ID');
		$this->db->where('coupon_customers.Cus_ID', $Cus_ID);
		$this->db->where('coupon_customers.status', 1);
		$this->db->where('coupon.Discount_Status !=', 0);
		$this->db->where('coupon.Start_Date <=', $now);
		$this->db->where('coupon.Expired_Date >=', $now);

		return $this->db->get()->row();
	}

	function _get_order_item_data($Order_ID=NULL)
	{
		$this->db->select('order_item.Item_ID as order_item_Item_ID, order_item.Color_ID as order_item_Color_ID, order_item.Product_ID as order_item_Product_ID, order_item.Create_Date as order_item_Create_Date, order_item.Qty as order_item_Qty, order_item.Total_Price as order_item_Total_Price, products.Pro_Name_Th as products_Pro_Name_Th, products.Pro_Name_En as products_Pro_Name_En, products.Size as products_Size, products.Price_sale as products_Price_sale, products.Price_Buy as products_Price_Buy, products.Product_Code as products_Product_Code,images.Thumbnail_path as images_Thumbnail_path, color.Name_TH as color_Name_TH, color.Name_EN as color_Name_EN, products.gift_box as gift_box, order_item.gift as has_gift');
		$this->db->order_by('order_item.Product_ID', 'asc');
		$this->db->from('order_item');
		$this->db->join('products', 'products.Product_ID = order_item.Product_ID');
		$this->db->where('order_item.Order_ID', $Order_ID);

		$this->db->join('images', 'images.Product_ID = order_item.Product_ID AND images.Color_ID = order_item.Color_ID');
		$this->db->join('color', 'color.Color_ID = order_item.Color_ID');
		$this->db->group_by(array("images.Product_ID", "images.Color_ID"));
		return $this->db->get()->result();

		/*foreach ($this->db->get()->result() as $key => $value)
		{
			var_dump($value);
			echo '<br><br>';
		}*/
	}

	function update()
	{
		/*if ($this->form_validation->run('customer') == FALSE)
		{
			redirect('checkout/billing');
			return FALSE;
		}

		if ($this->form_validation->run('shipping') == FALSE)
		{
			redirect('checkout/billing');
			return FALSE;
		}*/

		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		$this->db->where('Cus_ID !=', $Cus_ID);
		$query = $this->db->get_where('customers', array('Email'=>$this->input->post('Email')))->row();
		if(!empty($query))
		{
			$error[] = "This Email is already exist.";
			$data['error'] = array('data'=>$error, 'color'=>'red');
			redirect('checkout/billing');
			return;
		}
		else
		{
			if($this->input->post('Country_ID')=='222')
			{
				$data_customer = array(
								'FirstName' => $this->input->post('FirstName'),
								'LastName' => $this->input->post('LastName'),
								'Address' => $this->input->post('Address'),
								'Country_ID' => $this->input->post('Country_ID'),
								'City_ID' => $this->input->post('City_ID'),
								'Postal_Code' => $this->input->post('Postal_Code'),
								'Phone_Number' => $this->input->post('Phone_Number'),
								'Email' => $this->input->post('Email')
							);
			}
			else
			{
				$data_customer = array(
								'FirstName' => $this->input->post('FirstName'),
								'LastName' => $this->input->post('LastName'),
								'Address' => $this->input->post('Address'),
								'Country_ID' => $this->input->post('Country_ID'),
								'City_ID' => '88',
								'City_Name' => $this->input->post('City_Name'),
								'Postal_Code' => $this->input->post('Postal_Code'),
								'Phone_Number' => $this->input->post('Phone_Number'),
								'Email' => $this->input->post('Email')
							);
			}

			$this->db->where('Cus_ID', $Cus_ID);
			$this->db->update('customers', $data_customer);
		}

		$query_shipping = $this->db->get_where('shipping', array('Cus_ID' => $Cus_ID))->row();
		if(!empty($query_shipping))
		{
			if($this->input->post('s_Country_ID')=='222')
			{
				$data_shipping = array(
					's_FirstName' => $this->input->post('s_FirstName'),
					's_LastName' => $this->input->post('s_LastName'),
					's_Address' => $this->input->post('s_Address'),
					's_Country_ID' => $this->input->post('s_Country_ID'),
					's_City_ID' => $this->input->post('s_City_ID'),
					's_Postal_Code' => $this->input->post('s_Postal_Code'),
					's_Phone_Number' => $this->input->post('s_Phone_Number')
				);
			}
			else
			{
				$data_shipping = array(
					's_FirstName' => $this->input->post('s_FirstName'),
					's_LastName' => $this->input->post('s_LastName'),
					's_Address' => $this->input->post('s_Address'),
					's_Country_ID' => $this->input->post('s_Country_ID'),
					's_City_ID' => '88',
					's_City_Name' => $this->input->post('s_City_Name'),
					's_Postal_Code' => $this->input->post('s_Postal_Code'),
					's_Phone_Number' => $this->input->post('s_Phone_Number')
				);
			}

			$this->db->where('Cus_ID', $Cus_ID);
			$this->db->update('shipping', $data_shipping);
		}
		else
		{
			if($this->input->post('s_Country_ID')=='222')
			{
				$data_shipping = array(
					'Cus_ID' => $Cus_ID,
					's_FirstName' => $this->input->post('s_FirstName'),
					's_LastName' => $this->input->post('s_LastName'),
					's_Address' => $this->input->post('s_Address'),
					's_Country_ID' => $this->input->post('s_Country_ID'),
					's_City_ID' => $this->input->post('s_City_ID'),
					's_Postal_Code' => $this->input->post('s_Postal_Code'),
					's_Phone_Number' => $this->input->post('s_Phone_Number')
				);
			}
			else
			{
				$data_shipping = array(
					'Cus_ID' => $Cus_ID,
					's_FirstName' => $this->input->post('s_FirstName'),
					's_LastName' => $this->input->post('s_LastName'),
					's_Address' => $this->input->post('s_Address'),
					's_Country_ID' => $this->input->post('s_Country_ID'),
					's_City_ID' => '88',
					's_City_Name' => $this->input->post('s_City_Name'),
					's_Postal_Code' => $this->input->post('s_Postal_Code'),
					's_Phone_Number' => $this->input->post('s_Phone_Number')
				);
			}

			$this->db->insert('shipping', $data_shipping);
		}

		$this->db->where('Order_ID', $this->input->post('Order_ID'));
		$this->db->update('orders', array('How_ID'=>$this->input->post('how_delivery')));

		$this->_update_have_option($this->input->post('Order_ID'), $this->input->post('shipping_option'));
		$this->Order_gifts_model->set_data($_POST['Order_ID'], $_POST['gift_type']);

		//$this->_update_gift($this->input->post('Order_ID'), $this->input->post('product_gift'));

		if($this->input->post('update_value')!='')
		{
			redirect('checkout/payment');
		}
		else
		{
			redirect('checkout/billing');
		}
	}

	function _update_gift($Order_ID=NULL, $product_gift=NULL)
	{
		$result = $this->db->get_where('order_item', array('Order_ID' => $this->input->post('Order_ID')))->result();
		foreach ($result as $key_gift)
		{
			if(!empty($product_gift[$key_gift->Product_ID]))
			{
				$this->db->where('Product_ID', $key_gift->Product_ID);
				$this->db->where('Order_ID', $Order_ID);
				$this->db->update('order_item', array('gift' => $product_gift[$key_gift->Product_ID]));
			}
		}
	}

	function _update_have_option($Order_ID=NULL, $Option_ID=NULL)
	{
		$this->db->delete('have_option', array('Order_ID'=>$Order_ID));

		if(!empty($Option_ID))
		{
			foreach ($Option_ID as $key => $value)
			{
				$this->db->insert('have_option', array('Order_ID'=>$Order_ID, 'Option_ID'=>$value));
			}
		}

	}

	function _update_product_qty($Cus_ID=NULL)
	{
		$result = $this->db->get_where('cart', array('Cus_ID' => $Cus_ID))->result();

		foreach ($result as $key => $value)
		{
			$query = $this->db->get_where('products', array('Product_ID' => $value->Product_ID))->row();

			$qty = $query->Qty - $value->Qty;

			$this->db->where('Product_ID', $value->Product_ID);
			$this->db->update('products', array('Qty' => $qty));
		}
	}



	function _order_confirmation_credit_card($order=NULL)
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		//$Order_ID = $this->_update_order();
		$Order_ID = $order->Order_ID;


		if($Order_ID!=NULL)
		{
			$data['order'] = $this->db->get_where('orders', array('Order_ID'=>$Order_ID))->row();
			$data['order_items'] = $this->_get_order_item_data($Order_ID);
			$data['shipping'] = $this->db->get_where('shipping', array('Cus_ID'=>$Cus_ID))->row();
			$data['customer'] = $this->db->get_where('customers', array('Cus_ID'=>$Cus_ID))->row();

			//$this->load->view('mail/order_confirmation_credit_card', $data);

			$msg = $this->load->view('mail/order_confirmation_credit_card', $data, TRUE);

			$email_arr = array(
				'from' => 'contact@goodjobstore.com',
				'to' => $data['customer']->Email,
				'subject' => 'GOODJOB Order Confirmation',
				'message' => $msg
			);

			send_mail_helper($email_arr);

			$email_arr1 = array(
				'from' => 'contact@goodjobstore.com',
				'to' => 'contact@goodjobstore.com',
				'subject' => 'GOODJOB Order Confirmation',
				'message' => $msg
			);

			send_mail_helper($email_arr1);
		}
	}

	function _order_confirmation_paypal($order=NULL)
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		//$Order_ID = $this->_update_order();
		$Order_ID = $order->Order_ID;


		if($Order_ID!=NULL)
		{
			$data['order'] = $this->db->get_where('orders', array('Order_ID'=>$Order_ID))->row();
			$data['order_items'] = $this->_get_order_item_data($Order_ID);
			$data['shipping'] = $this->db->get_where('shipping', array('Cus_ID'=>$Cus_ID))->row();
			$data['customer'] = $this->db->get_where('customers', array('Cus_ID'=>$Cus_ID))->row();

			//$this->load->view('mail/order_confirmation_credit_card', $data);

			$msg = $this->load->view('mail/order_confirmation_paypal', $data, TRUE);

			$email_arr = array(
				'from' => 'contact@goodjobstore.com',
				'to' => $data['customer']->Email,
				'subject' => 'GOODJOB Order Confirmation',
				'message' => $msg
			);

			send_mail_helper($email_arr);

			$email_arr1 = array(
				'from' => 'contact@goodjobstore.com',
				'to' => 'contact@goodjobstore.com',
				'subject' => 'GOODJOB Order Confirmation',
				'message' => $msg
			);

			send_mail_helper($email_arr1);
		}
	}

	function _get_pdf()
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		$Order_ID = $this->_update_order();


		if($Order_ID!=NULL)
		{
			$data['order'] = $this->db->get_where('orders', array('Order_ID'=>$Order_ID))->row();
			$data['order_items'] = $this->_get_order_item_data($Order_ID);
			$data['shipping'] = $this->db->get_where('shipping', array('Cus_ID'=>$Cus_ID))->row();
			$data['customer'] = $this->db->get_where('customers', array('Cus_ID'=>$Cus_ID))->row();

			$this->load->view('mail/pdf', $data);
		}

		return;
	}

	function _order_confirmation_direct_deposit($order=NULL)
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		//$Order_ID = $this->_update_order();
		$Order_ID = $order->Order_ID;


		if($Order_ID!=NULL)
		{
			$data['order'] = $this->db->get_where('orders', array('Order_ID'=>$Order_ID))->row();
			$data['order_items'] = $this->_get_order_item_data($Order_ID);
			$data['shipping'] = $this->db->get_where('shipping', array('Cus_ID'=>$Cus_ID))->row();
			$data['customer'] = $this->db->get_where('customers', array('Cus_ID'=>$Cus_ID))->row();

			//$this->load->view('mail/pdf', $data);

			$msg = $this->load->view('mail/order_confirmation_direct_deposit', $data, TRUE);

			$email_arr = array(
				'from' => 'contact@goodjobstore.com',
				'to' => $data['customer']->Email,
				'subject' => 'GOODJOB Order Confirmation',
				'message' => $msg,
				'attach' => $Order_ID
			);

			send_mail_helper($email_arr);
			
			/*$config = Array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'smtpweb.netdesignhost.com',
			  'mailtype' => 'html',
			  'wordwrap' => TRUE
			);

			$this->email->initialize($config);

			$this->email->set_newline("\r\n");
			$this->email->from($email_arr['from']);
			$this->email->to($email_arr['to']);
			$this->email->subject($email_arr['subject']);
			$this->email->message($email_arr['message']);

			$attach = $email_arr['attach'];
			$this->email->attach("public/pdf/{$attach}.pdf");

			$this->email->send();*/

			$email_arr1 = array(
				'from' => 'contact@goodjobstore.com',
				'to' => 'contact@goodjobstore.com',
				'subject' => 'GOODJOB Order Confirmation',
				'message' => $msg
			);

			send_mail_helper($email_arr1);
		}
	}

	/*function testtest($order=NULL)
	{
		$Cus_ID = $this->session->userdata('customer')->Cus_ID;
		$Order_ID = $this->_update_order();
		//$Order_ID = $order->Order_ID;


		if($Order_ID!=NULL)
		{
			$data['order'] = $this->db->get_where('orders', array('Order_ID'=>$Order_ID))->row();
			$data['order_items'] = $this->_get_order_item_data($Order_ID);
			$data['shipping'] = $this->db->get_where('shipping', array('Cus_ID'=>$Cus_ID))->row();
			$data['customer'] = $this->db->get_where('customers', array('Cus_ID'=>$Cus_ID))->row();

			//$this->load->view('mail/order_confirmation_credit_card', $data);

			$msg = $this->load->view('mail/order_confirmation_direct_deposit', $data, TRUE);

			$email_arr = array(
				'from' => 'contact@goodjobstore.com',
				'to' => $data['customer']->Email,
				'subject' => 'GOODJOB Order Confirmation',
				'attach' => $Order_ID,
				'message' => $msg
			);

			$config = Array(
			  'protocol' => 'smtp',
			  'smtp_host' => 'smtpweb.netdesignhost.com',
			  'mailtype' => 'html',
			  'wordwrap' => TRUE
			);

			$this->email->initialize($config);

			$this->email->set_newline("\r\n");
			$this->email->from($email_arr['from']);
			$this->email->to($email_arr['to']);
			$this->email->subject($email_arr['subject']);
			$this->email->message($email_arr['message']);

			$attach = $email_arr['attach'];
			$this->email->attach("public/pdf/{$attach}.pdf");

			$this->email->send();

			echo $this->email->print_debugger();
		}
	}*/


}

/* End of file checkout.php */
/* Location: ./application/controllers/checkout.php */