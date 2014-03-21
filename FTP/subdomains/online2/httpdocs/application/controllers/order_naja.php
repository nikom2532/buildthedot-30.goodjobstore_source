<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged_in'))
		{
			redirect('login');
		}
	}

	public function index()
	{
		
	}
	
	public function view($order_id=NULL)
	{
		//------ clear session add order ------
		$this->session->set_userdata('order_cus_id', NULL);
		$this->session->set_userdata('order_coupon', NULL);
		$this->session->set_userdata('order_item_list', NULL);
		$this->session->set_userdata('order_billing_address', NULL);
		$this->session->set_userdata('order_shipping_address', NULL);
		$this->session->set_userdata('order_shipping_id', NULL);
		//---- end clear session add order ----

		if($order_id == NULL)
		{
			$this->template->view('order/view');
		}
		else
		{		
			$data['order_detail'] = get_select_order($order_id);
			$data['order_address'] = get_select_order_address($order_id);
			$this->template->view('order/view_order' , $data);
		}
	}	
	
	public function create()
	{
		$this->template->view('order/create_step1');
	}
	
	public function create_step1_update()
	{
		//--- substring to array ---
		$str     = $this->input->post('select_value');
		$order   = array(",");
		$replace = ' ';
		$newstr = str_replace($order, $replace, $str);

		if(!empty($newstr))
		{
			$select_value = explode(" ", $newstr);
			$cus_id = $select_value[0];
		}
		else
		{
			$this->template->view('order/create_step1');
			return;
		}
		
		redirect('order/create/'.$cus_id);
	}
	
	public function create_step2($cus_id)
	{
		$data['cus_id'] = $cus_id;

		if($this->session->userdata('order_cus_id')!=$cus_id)
		{
			$this->session->set_userdata('order_billing_address', NULL);
			$this->session->set_userdata('order_shipping_address', NULL);
			$this->session->set_userdata('order_shipping_id', NULL);
		}
		if($this->session->userdata('order_coupon')!=NULL)
			$data['coupon_code'] = $this->session->userdata('order_coupon');

		if($this->session->userdata('order_item_list')!=NULL)
			$data['order_item_list'] = $this->session->userdata('order_item_list');
		
		if($this->session->userdata('order_billing_address')!=NULL)
			$data['billing'] = $this->session->userdata('order_billing_address');
		else
			$data['billing'] = get_select_billing_address($cus_id);
		
		if($this->session->userdata('order_shipping_address')!=NULL)
			$data['shipping'] = $this->session->userdata('order_shipping_address');
		else
			$data['shipping'] = get_select_shipping_address($cus_id);

		if($this->session->userdata('order_shipping_id')!=NULL)
			$data['shipping_id'] = $this->session->userdata('order_shipping_id');
		else
			$data['shipping_id'] = '0';
		
		$this->template->view('order/create_step2', $data);
	}
	
	public function create_step3($cus_id)
	{	
		$check_validate = TRUE;
		$er_str = "";

		$data['cus_id'] = $cus_id;
		//---- check coupon code ----
		if(strlen($this->input->post('coupon'))!=0)
		{
			if(!check_coupon_can_use($this->input->post('coupon')))
			{
				$er_str .= "Can't use this coupon code.<BR>";
				$check_validate = FALSE;
			}
			else
				$data['coupon'] = get_coupon_from_code($this->input->post('coupon'));
		}
		else
			$data['coupon'] = get_coupon_from_code($this->input->post('coupon'));

		//---- check select product ----
		$data['check'] = $this->input->post('check');
		if(!$data['check'])
		{
			$er_str .= "Please select product.<BR>";
			$check_validate = FALSE;
		}
		//---- check stock product ----
		foreach($this->input->post('check') as $product_id)
		{
			if($this->input->post($product_id)=='' OR $this->input->post($product_id)=='0')
			{
				$data[$product_id] = 1;
				$order_item = array($product_id => 1);
			}
			else
			{
				$data[$product_id] = $this->input->post($product_id);
				$order_item = array($product_id => $this->input->post($product_id));
			}

			if(!check_order_product_qty($product_id, $this->input->post($product_id)))
			{
				$er_str .= $product_id.' over stock<BR>';
				$check_validate = FALSE;
			}
			//--set for session--
			if(!isset($order_item_list))
				$order_item_list = $order_item;
			else
				$order_item_list = array_merge($order_item_list, $order_item);
		}

		//---- check how shipping ----		
		if(!check_shipping_method($this->input->post('shipping_id'), $this->input->post('s_country_id')))
		{
			$er_str .= 'Please select new shipping method.<BR>';
			$check_validate = FALSE;
		}
		else
			$data['shipping_id'] = $this->input->post('shipping_id');

		if(!$check_validate)
		{
			echo $er_str;
			exit;
		}


		//---- order address ----
		$data['billing'] = array(
								'b_firstname' => $this->input->post('b_firstname'),
								'b_lastname' => $this->input->post('b_lastname'),
								'b_address' => $this->input->post('b_address'),
								'b_city_id' => $this->input->post('b_city_id'),
								'b_postcode' => $this->input->post('b_postcode'),
								'b_country_id' => $this->input->post('b_country_id'),
								'b_phone' => $this->input->post('b_phone')
								);
		$data['shipping'] = array(
								's_firstname' => $this->input->post('s_firstname'),
								's_lastname' => $this->input->post('s_lastname'),
								's_address' => $this->input->post('s_address'),
								's_city_id' => $this->input->post('s_city_id'),
								's_postcode' => $this->input->post('s_postcode'),
								's_country_id' => $this->input->post('s_country_id'),
								's_phone' => $this->input->post('s_phone')
							);

		$this->session->set_userdata('order_cus_id', $data['cus_id']);
		$this->session->set_userdata('order_coupon', $this->input->post('coupon'));
		$this->session->set_userdata('order_item_list', $order_item_list);
		$this->session->set_userdata('order_billing_address', $data['billing']);
		$this->session->set_userdata('order_shipping_address', $data['shipping']);
		$this->session->set_userdata('order_shipping_id', $data['shipping_id']);
								
		$this->template->view('order/create_step3', $data);
	}

	public function create_step3_update()
	{
		$order_id = substr($this->input->post('cus_id'), 1);
		$order_id .= date("ymdHi");

		//----------------------------------
		//------------- order --------------
		//----------------------------------
		$order_cus_id = $this->input->post('cus_id');
		$order_price = $this->input->post('order_price');
		$order_discount_price = $this->input->post('order_discount_price');
		$order_coupon_code = $this->input->post('coupon_code');
		$order_discount_coupon = $this->input->post('discount_coupon');
		$order_total_price = $this->input->post('total_price');
		$order_total_weight = $this->input->post('total_weight');
		$order_shipping_id = $this->input->post('shipping_id');
		$order_shipping_price = $this->input->post('shipping_price');
		$order_final_price = $this->input->post('final_price');
		$order_service_price = $this->input->post('service_price');
		
			//--- insert order ---
			$data_order = array(
								'order_id' => $order_id,
								'cus_id' => $order_cus_id,
								'price' => $order_price,
								'discount_price' => $order_discount_price,
								'coupon_code' => $order_coupon_code,
								'discount_coupon' => $order_discount_coupon,
								'total_price' => $order_total_price,
								'total_weight' => $order_total_weight,
								'shipping_id' => $order_shipping_id,
								'shipping_price' => $order_shipping_price,
								'final_price' => $order_final_price,
								'order_status' => '1',
								'create_at' => date("Y-m-d H:i:s")
							);
			$this->db->insert('orders', $data_order);
			//--- insert log order ---
			$data_log_order = array(
								'order_id' => $order_id,
								'cus_id' => $order_cus_id,
								'price' => $order_price,
								'discount_price' => $order_discount_price,
								'coupon_code' => $order_coupon_code,
								'discount_coupon' => $order_discount_coupon,
								'total_price' => $order_total_price,
								'total_weight' => $order_total_weight,
								'shipping_method' => get_select_shipping($order_shipping_id)->name,
								'shipping_price' => $order_shipping_price,
								'final_price' => $order_final_price,
								'order_status' => '1',
								'create_at' => date("Y-m-d H:i:s"),
								'status' => '1',
								'update_at' => date("Y-m-d H:i:s"),
								'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
								'update_id' => $this->session->userdata('user')->admin_id
							);
			$this->db->insert('log_orders', $data_log_order);
		
		//----------------------------------
		//------- update coupon used -------
		//----------------------------------
		if($order_coupon_code!=NULL)
		{
			//--- update coupon status ---
			$this->db->where('coupon_code', $order_coupon_code);
			$this->db->update('coupon', array('coupon_status' => '2'));
			//--- insert log coupon ---
			$get_coupon = get_coupon_from_code($order_coupon_code);
			$data_log_coupon = array(
									'coupon_code' => $order_coupon_code,
									'discount_price' => $get_coupon->discount_price,
									'discount_type' => $get_coupon->discount_type,
									'start_date' => $get_coupon->start_date,
									'end_date' => $get_coupon->end_date,
									'coupon_status' => '2',
									'create_at' => $get_coupon->create_at,
									'status' => '4',
									'update_at' => date("Y-m-d H:i:s"),
									'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
									'update_id' => $this->session->userdata('user')->admin_id
							);
			$this->db->insert('log_coupon', $data_log_coupon);
		}
		
		//----------------------------------
		//----------- order items ----------
		//----------------------------------
		foreach($this->input->post('product_id') as $product_id)
		{
			//----- insert order item -----
			$data_order_item = array(
									'order_id' => $order_id,
									'product_id' => $product_id,
									'name' => $this->input->post('name_'.$product_id),
									'prop_id' => $this->input->post('prop_id_'.$product_id),
									'color_id' => $this->input->post('color_id_'.$product_id),
									'unit_price' => $this->input->post('unit_price_'.$product_id),
									'discount_price' => $this->input->post('discount_price_'.$product_id),
									'unit_weight' => $this->input->post('unit_weight_'.$product_id),
									'qty' => $this->input->post('qty_'.$product_id),
									'total_price' => $this->input->post('total_price_'.$product_id),
									'total_weight' => $this->input->post('total_weight_'.$product_id),
									'item_status' => '1'
								);
			$this->db->insert('order_items', $data_order_item);
			//----- insert log order item -----
			$order_item_id = get_order_item_id($order_id);
			$data_log_order_item = array(
									'order_item_id' => $order_item_id,
									'order_id' => $order_id,
									'product_id' => $product_id,
									'name' => $this->input->post('name_'.$product_id),
									'property' => get_property_name($this->input->post('prop_id_'.$product_id)),
									'color' => get_color_name($this->input->post('color_id_'.$product_id)),
									'unit_price' => $this->input->post('unit_price_'.$product_id),
									'discount_price' => $this->input->post('discount_price_'.$product_id),
									'unit_weight' => $this->input->post('unit_weight_'.$product_id),
									'qty' => $this->input->post('qty_'.$product_id),
									'total_price' => $this->input->post('total_price_'.$product_id),
									'total_weight' => $this->input->post('total_weight_'.$product_id),
									'item_status' => '1',
									'status' => '1',
									'update_at' => date("Y-m-d H:i:s"),
									'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
									'update_id' => $this->session->userdata('user')->admin_id
								);
			$this->db->insert('log_order_items', $data_log_order_item);

			//------- update product stock qty -------			
			$new_qty = get_product_stock($product_id) - $this->input->post('qty_'.$product_id);
			$this->db->where('product_id', $product_id);
			$this->db->update('products', array('qty' => $new_qty));
			//------ insert log products(qty) ------
			$get_product = get_select_product($product_id);
			$log_product_qty = array(
								'lang_id' => '1',
								'product_id' => $product_id,
								'progroup_id' => $get_product->progroup_id,
								'name' => $get_product->name,
								'description' => $get_product->description,
								'price' => $get_product->price,
								'color' => get_color_name($get_product->color_id),
								'property' => get_property_name($get_product->prop_id),
								'attribute' => get_attribute_name($get_product->attribute_id),
								'size' => $get_product->size,
								'weight' => $get_product->weight,
								'qty' => $new_qty,
								'flag' => $get_product->flag,
								'discount' => $get_product->discount,
								'discount_type' => $get_product->discount_type,
								'public' => $get_product->public,
								'rank' => $get_product->rank,
								'primary' => $get_product->primary,
								'status' => '4',
								'update_at' => date("Y-m-d H:i:s"),
								'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
								'update_id' => $this->session->userdata('user')->admin_id
							);
			$this->db->insert('log_products', $log_product_qty);
		}

		//----------------------------------
		//--------- order address ----------
		//----------------------------------
			//----- billing -----
			$b_firstname = $this->input->post('b_firstname');
			$b_lastname = $this->input->post('b_lastname');
			$b_address = $this->input->post('b_address');
			$b_city_id = $this->input->post('b_city_id');
			$b_postcode = $this->input->post('b_postcode');
			$b_country_id = $this->input->post('b_country_id');
			$b_phone = $this->input->post('b_phone');
			//---- shipping ----
			$s_firstname = $this->input->post('s_firstname');
			$s_lastname = $this->input->post('s_lastname');
			$s_address = $this->input->post('s_address');
			$s_city_id = $this->input->post('s_city_id');
			$s_postcode = $this->input->post('s_postcode');
			$s_country_id = $this->input->post('s_country_id');
			$s_phone = $this->input->post('s_phone');
			
			//----- insert order address -----
			$data_order_address = array(
									'order_id' => $order_id,
									'b_firstname' => $b_firstname,
									'b_lastname' => $b_lastname,
									'b_address' => $b_address,
									'b_city_id' => $b_city_id,
									'b_postcode' => $b_postcode,
									'b_country_id' => $b_country_id,
									'b_phone' => $b_phone,
									's_firstname' => $s_firstname,
									's_lastname' => $s_lastname,
									's_address' => $s_address,
									's_city_id' => $s_city_id,
									's_postcode' => $s_postcode,
									's_country_id' => $s_country_id,
									's_phone' => $s_phone
								);
			$this->db->insert('order_address', $data_order_address);
			//----- insert log order address -----
			$data_log_order_address = array(
									'lang_id' => '1',
									'order_id' => $order_id,
									'b_firstname' => $b_firstname,
									'b_lastname' => $b_lastname,
									'b_address' => $b_address,
									'b_city' => get_city_name($b_city_id,'1'),
									'b_postcode' => $b_postcode,
									'b_country' => get_country_name($b_country_id,'1'),
									'b_phone' => $b_phone,
									's_firstname' => $s_firstname,
									's_lastname' => $s_lastname,
									's_address' => $s_address,
									's_city' => get_city_name($s_city_id,'1'),
									's_postcode' => $s_postcode,
									's_country' => get_country_name($s_country_id,'1'),
									's_phone' => $s_phone,
									'status' => '1',
									'update_at' => date("Y-m-d H:i:s"),
									'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
									'update_id' => $this->session->userdata('user')->admin_id
								);
			$this->db->insert('log_order_address', $data_log_order_address);

		redirect('order/view/'.$order_id);
	}

	//-----------------------------------------------------------------------------------------------------------------------------------
	//---------------------------------------------------------- Edit Order -------------------------------------------------------------
	//-----------------------------------------------------------------------------------------------------------------------------------
	public function change_order_status($order_id)
	{
		$data['order_status_detail'] = get_order_status_from_order_id($order_id);
		$this->template->view('order/change_order_status', $data);
	}
	public function change_order_status_update()
	{
		$order_id = $this->input->post('order_id');
		$order_status = $this->input->post('order_status');
		$data_status_order = array(
								'order_id' => $order_id,
								'order_status' => $order_status
							);		
		$this->db->where('order_id', $order_id);
		$this->db->update('orders', $data_status_order);

		$order_detail = get_order_from_id($order_id);
		//--- insert log order ---
		$data_log_order = array(
							'order_id' => $order_id,
							'cus_id' => $order_detail->cus_id,
							'price' => $order_detail->price,
							'discount_price' => $order_detail->discount_price,
							'coupon_code' => $order_detail->coupon_code,
							'discount_coupon' => $order_detail->discount_coupon,
							'total_price' => $order_detail->total_price,
							'total_weight' => $order_detail->total_weight,
							'shipping_method' => get_select_shipping($order_detail->shipping_id)->name,
							'shipping_price' => $order_detail->shipping_price,
							'final_price' => $order_detail->final_price,
							'order_status' => $order_status,
							'create_at' => date("Y-m-d H:i:s"),
							'status' => '3',
							'update_at' => date("Y-m-d H:i:s"),
							'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
							'update_id' => $this->session->userdata('user')->admin_id
						);
			$this->db->insert('log_orders', $data_log_order);

		redirect('order/view/'.$order_id);
	}

	public function edit_order($order_id)
	{
		$_POST = get_select_order_array($order_id);
		$this->form_validation->run('edit_order');
		$this->template->view('order/edit_order');
	}

	public function edit_order_update()
	{
	
	}
	
	public function edit_order_billing($order_id)
	{
		$_POST = get_select_order_address_array($order_id);
		$this->form_validation->run('edit_order_billing');
		$this->template->view('order/edit_billing_order');
	}
	
	public function edit_billing_order_update()
	{
		$order_id = $this->input->post('order_id');
		$this->form_validation->set_message('required'  , 'The %s is missing.');
		if($this->form_validation->run('edit_order_billing') == FALSE)
		{
			$this->template->view('order/edit_billing_order');
			return;
		}
	
		$data_billing_order = array(
								'b_firstname' => $this->input->post('b_firstname'),
								'b_lastname' => $this->input->post('b_lastname'),
								'b_address' => $this->input->post('b_address'),
								'b_city_id' => $this->input->post('b_city_id'),
								'b_postcode' => $this->input->post('b_postcode'),
								'b_country_id' => $this->input->post('b_country_id'),
								'b_phone' => $this->input->post('b_phone')
							);
				
		$this->db->where('order_id', $order_id);
		$this->db->update('order_address', $data_billing_order);

		//---- insert log edit shipping ----
		$order_address = get_select_order_address($order_id);
		$log_billing_order = array(
								'lang_id' => '1',
								'order_id' => $order_id,
								'b_firstname' => $this->input->post('b_firstname'),
								'b_lastname' => $this->input->post('b_lastname'),
								'b_address' => $this->input->post('b_address'),
								'b_city' => get_city_name($this->input->post('b_city_id'), 2),
								'b_postcode' => $this->input->post('b_postcode'),
								'b_country' => get_country_name($this->input->post('b_country_id'), 2),
								'b_phone' => $this->input->post('b_phone'),
								's_firstname' => $order_address->s_firstname,
								's_lastname' => $order_address->s_lastname,
								's_address' => $order_address->s_address,
								's_city' => get_city_name($order_address->s_city_id, 2),
								's_postcode' => $order_address->s_postcode,
								's_country' => get_country_name($order_address->s_country_id, 2),
								's_phone' => $order_address->s_phone,
								'status' => '2',
								'update_at' => date("Y-m-d H:i:s"),
								'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
								'update_id' => $this->session->userdata('user')->admin_id
							);
		$this->db->insert('log_order_address', $log_billing_order);
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('order/view/'.$order_id);
	}
	
	public function edit_order_shipping($order_id)
	{
		$_POST  = get_select_order_address_array($order_id);
		$this->form_validation->run('edit_order_shipping');
		$this->template->view('order/edit_shipping_order');
	}
	
	public function edit_shipping_order_update()
	{	
	
		$order_id = $this->input->post('order_id');
		$this->form_validation->set_message('required'  , 'The %s is missing.');
		if($this->form_validation->run('edit_order_shipping') == FALSE)
		{
			$this->template->view('order/edit_shipping_order');
			return;
		}
	
		$data_shipping_order = array(
								's_firstname' => $this->input->post('s_firstname'),
								's_lastname' => $this->input->post('s_lastname'),
								's_address' => $this->input->post('s_address'),
								's_city_id' => $this->input->post('s_city_id'),
								's_postcode' => $this->input->post('s_postcode'),
								's_country_id' => $this->input->post('s_country_id'),
								's_phone' => $this->input->post('s_phone')
							);
				
		$this->db->where('order_id', $order_id);
		$this->db->update('order_address', $data_shipping_order);

		//---- insert log edit shipping ----
		$order_address = get_select_order_address($order_id);
		$log_billing_order = array(
							'lang_id' => '1',
							'order_id' => $order_id,
							'b_firstname' => $order_address->b_firstname,
							'b_lastname' => $order_address->b_lastname,
							'b_address' => $order_address->b_address,
							'b_city' => get_city_name($order_address->b_city_id, 2),
							'b_postcode' => $order_address->b_postcode,
							'b_country' => get_country_name($order_address->b_country_id, 2),
							'b_phone' => $order_address->b_phone,
							's_firstname' => $this->input->post('s_firstname'),
							's_lastname' => $this->input->post('s_lastname'),
							's_address' => $this->input->post('s_address'),
							's_city' => get_city_name($this->input->post('s_city_id'), 2),
							's_postcode' => $this->input->post('s_postcode'),
							's_country' => get_country_name($this->input->post('s_country_id'), 2),
							's_phone' => $this->input->post('s_phone'),
							'status' => '2',
							'update_at' => date("Y-m-d H:i:s"),
							'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
							'update_id' => $this->session->userdata('user')->admin_id
						);
		$this->db->insert('log_order_address', $log_billing_order);
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('order/view/'.$order_id);
	}
	
	public function edit_order_item($order_id)
	{
		$data['item_list'] = get_edit_order_item_from_id($order_id);
		$data['order_id'] = $order_id;

		$this->template->view('order/edit_order_item', $data);
	}

	public function edit_order_item_update()
	{
		$order_id = $this->input->post('order_id');
		$check_validate = TRUE;
		$er_str = "";
		$new_order_price = '0';

		//---- check select product ----
		$data['check'] = $this->input->post('check');
		if(!$data['check'])
		{
			$er_str .= "Please select product.<BR>";
			$check_validate = FALSE;
		}
		//---- check stock product ----
		else
		{
			foreach($this->input->post('check') as $product_id)
			{
				if($this->input->post($product_id)=='' OR $this->input->post($product_id)=='0')
				{
					$data[$product_id] = 1;
					$order_item = array($product_id => 1);
				}
				else
				{
					$data[$product_id] = $this->input->post($product_id);
					$order_item = array($product_id => $this->input->post($product_id));
				}

				if(!check_order_product_qty($product_id, $this->input->post($product_id)))
				{
					$er_str .= $product_id.' over stock<BR>';
					$check_validate = FALSE;
				}
				//--set for session--
				if(!isset($order_item_list))
					$order_item_list = $order_item;
				else
					$order_item_list = array_merge($order_item_list, $order_item);
			}
		}
		if(!$check_validate)
		{
			//echo $er_str;
			//exit;
			$data['order_id'] = $this->input->post('order_id');
			$data['item_list'] = get_edit_order_item_from_id($order_id);
			$data['check'] = $this->input->post('check');
			$data['er_str'] = $er_str ;
			$this->template->view('order/edit_order_item' , $data);
			return;
		}
		
		//---- declare new order price ----
		$new_order_price = '0';
		$new_order_discount_price = '0';
		$new_order_discount_coupon = '0';
		$new_order_total_price = '0';
		$new_order_total_weight = '0';
		$new_order_shipping_price = '0';
		$new_order_final_price = '0';

		//---- loop old order item ----
		foreach(get_edit_order_item_from_id($order_id) as $value)
		{
			$item_detail = get_order_item_detail($value->order_item_id);
			$stock_qty = get_product_stock($item_detail->product_id);
			//$new_qty = $order_item_list[$value->product_id];

			//----- remove item -----
			if(empty($order_item_list[$value->product_id]))
			{
				$this->db->delete('order_items', array('order_item_id'=>$value->order_item_id));

				//---- insert log remove item ----
				$log_data = array(
									'order_item_id' => $value->order_item_id,
									'order_id' => $item_detail->order_id,
									'product_id' => $item_detail->product_id,
									'name' => $item_detail->name,
									'property' => get_property_name($item_detail->prop_id),
									'color' => get_color_name($item_detail->color_id),
									'unit_price' => $item_detail->unit_price,
									'discount_price' => $item_detail->discount_price,
									'unit_weight' => $item_detail->unit_weight,
									'qty' => $item_detail->qty,
									'total_price' => $item_detail->total_price,
									'total_weight' => $item_detail->total_weight,
									'item_status' => $item_detail->item_status,
									'status' => '4',
									'update_at' => date("Y-m-d H:i:s"),
									'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
									'update_id' => $this->session->userdata('user')->admin_id
							);
				$this->db->insert('log_order_items', $log_data);

				//------- update product stock qty -------
				$new_stock_qty = $stock_qty + $item_detail->qty;
				$this->db->where('product_id', $item_detail->product_id);
				$this->db->update('products', array('qty' => $new_stock_qty));
				//------ insert log products(qty) ------
				$get_product = get_select_product($item_detail->product_id);
				$log_product_qty = array(
									'lang_id' => '1',
									'product_id' => $item_detail->product_id,
									'progroup_id' => $get_product->progroup_id,
									'name' => $get_product->name,
									'description' => $get_product->description,
									'price' => $get_product->price,
									'color' => get_color_name($get_product->color_id),
									'property' => get_property_name($get_product->prop_id),
									'attribute' => get_attribute_name($get_product->attribute_id),
									'size' => $get_product->size,
									'weight' => $get_product->weight,
									'qty' => $new_stock_qty,
									'flag' => $get_product->flag,
									'discount' => $get_product->discount,
									'discount_type' => $get_product->discount_type,
									'public' => $get_product->public,
									'rank' => $get_product->rank,
									'primary' => $get_product->primary,
									'status' => '4',
									'update_at' => date("Y-m-d H:i:s"),
									'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
									'update_id' => $this->session->userdata('user')->admin_id
								);
				$this->db->insert('log_products', $log_product_qty);
			}
			//----- old item not match qty -----
			else if($value->qty != $order_item_list[$value->product_id])
			{
				$new_total_price = $order_item_list[$value->product_id] * $item_detail->unit_price;
				$new_total_weight = $order_item_list[$value->product_id] * $item_detail->unit_weight;

				$data_item = array(
							'qty' => $order_item_list[$value->product_id],
							'total_price' => $new_total_price,
							'total_weight' => $new_total_weight
						);
				$this->db->where('order_item_id', $value->order_item_id);
				$this->db->update('order_items', $data_item);

				//---- insert log update qty item ----
				$log_data = array(
									'order_item_id' => $value->order_item_id,
									'order_id' => $item_detail->order_id,
									'product_id' => $item_detail->product_id,
									'name' => $item_detail->name,
									'property' => get_property_name($item_detail->prop_id),
									'color' => get_color_name($item_detail->color_id),
									'unit_price' => $item_detail->unit_price,
									'discount_price' => $item_detail->discount_price,
									'unit_weight' => $item_detail->unit_weight,
									'qty' => $order_item_list[$value->product_id],
									'total_price' => $new_total_price,
									'total_weight' => $new_total_weight,
									'item_status' => $item_detail->item_status,
									'status' => '2',
									'update_at' => date("Y-m-d H:i:s"),
									'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
									'update_id' => $this->session->userdata('user')->admin_id
							);
				$this->db->insert('log_order_items', $log_data);

				//------- update product stock qty -------
				if($value->qty < $order_item_list[$value->product_id])
				{
					$new_stock_qty = $stock_qty - ($order_item_list[$value->product_id] - $value->qty);
				}
				else
				{
					$new_stock_qty = $stock_qty + ($value->qty - $order_item_list[$value->product_id]);
				}
				$this->db->where('product_id', $item_detail->product_id);
				$this->db->update('products', array('qty' => $new_stock_qty));
				//------ insert log products(qty) ------
				$get_product = get_select_product($item_detail->product_id);
				$log_product_qty = array(
									'lang_id' => '1',
									'product_id' => $item_detail->product_id,
									'progroup_id' => $get_product->progroup_id,
									'name' => $get_product->name,
									'description' => $get_product->description,
									'price' => $get_product->price,
									'color' => get_color_name($get_product->color_id),
									'property' => get_property_name($get_product->prop_id),
									'attribute' => get_attribute_name($get_product->attribute_id),
									'size' => $get_product->size,
									'weight' => $get_product->weight,
									'qty' => $new_stock_qty,
									'flag' => $get_product->flag,
									'discount' => $get_product->discount,
									'discount_type' => $get_product->discount_type,
									'public' => $get_product->public,
									'rank' => $get_product->rank,
									'primary' => $get_product->primary,
									'status' => '4',
									'update_at' => date("Y-m-d H:i:s"),
									'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
									'update_id' => $this->session->userdata('user')->admin_id
								);
				$this->db->insert('log_products', $log_product_qty);
			}
		}
		//---- end old loop ----

		//---- loop new order item ----
		while (list($product_id, $qty) = each($order_item_list)) 
		{
			$new_item = TRUE;
			foreach(get_edit_order_item_from_id($order_id) as $value)
			{
				if($value->product_id == $product_id)
					$new_item = FALSE;
			}
			if($new_item == TRUE)
			{				
				//----- insert order item -----
				$get_product = get_select_product($product_id);
				
				if($get_product->discount_type==1)
				{
					$discount_price = ($get_product->price * $get_product->discount)/100;
					$unit_price = $get_product->price - $discount_price;
				}
				else if($get_product->discount_type==2)
				{
					$discount_price = $get_product->discount;
					$unit_price = $get_product->price - $discount_price;
				}
				else
				{
					$discount_price = 0;
					$unit_price = $get_product->price;
				}
				
				$data_order_item = array(
										'order_id' => $order_id,
										'product_id' => $product_id,
										'name' => $get_product->name,
										'prop_id' => $get_product->prop_id,
										'color_id' => $get_product->color_id,
										'unit_price' => $get_product->price,
										'discount_price' => $discount_price,
										'unit_weight' => $get_product->weight,
										'qty' => $qty,
										'total_price' => $unit_price * $qty,
										'total_weight' => $get_product->weight * $qty,
										'item_status' => '1'
									);
				$this->db->insert('order_items', $data_order_item);
				
				//----- insert log order item -----
				$order_item_id = get_order_item_id($order_id);
				$data_log_order_item = array(
										'order_item_id' => $order_item_id,
										'order_id' => $order_id,
										'product_id' => $product_id,
										'name' => $get_product->name,
										'property' => get_property_name($get_product->prop_id),
										'color' => get_color_name($get_product->color_id),
										'unit_price' => $get_product->price,
										'discount_price' => $discount_price,
										'unit_weight' => $get_product->weight,
										'qty' => $qty,
										'total_price' => $unit_price * $qty,
										'total_weight' => $get_product->weight * $qty,
										'item_status' => '1',
										'status' => '1',
										'update_at' => date("Y-m-d H:i:s"),
										'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
										'update_id' => $this->session->userdata('user')->admin_id
									);
				$this->db->insert('log_order_items', $data_log_order_item);

				//------- update product stock qty -------			
				$new_qty = get_product_stock($product_id) - $qty;
				$this->db->where('product_id', $product_id);
				$this->db->update('products', array('qty' => $new_qty));
				//------ insert log products(qty) ------
				$get_product = get_select_product($product_id);
				$log_product_qty = array(
									'lang_id' => '1',
									'product_id' => $product_id,
									'progroup_id' => $get_product->progroup_id,
									'name' => $get_product->name,
									'description' => $get_product->description,
									'price' => $get_product->price,
									'color' => get_color_name($get_product->color_id),
									'property' => get_property_name($get_product->prop_id),
									'attribute' => get_attribute_name($get_product->attribute_id),
									'size' => $get_product->size,
									'weight' => $get_product->weight,
									'qty' => $new_qty,
									'flag' => $get_product->flag,
									'discount' => $get_product->discount,
									'discount_type' => $get_product->discount_type,
									'public' => $get_product->public,
									'rank' => $get_product->rank,
									'primary' => $get_product->primary,
									'status' => '4',
									'update_at' => date("Y-m-d H:i:s"),
									'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
									'update_id' => $this->session->userdata('user')->admin_id
								);
				$this->db->insert('log_products', $log_product_qty);
			}
		}
		//---- end new loop ----
		$order_detail = get_order_from_id($order_id);
		$order_price = '0';
		$order_discount_price = '0';
		$order_discount_coupon = '0';
		$order_total_weight = '0';
		foreach(get_order_item_from_id($order_id) as $value)
		{
			$order_price += ($value->unit_price * $value->qty);
			$order_discount_price += ($value->discount_price * $value->qty);
			$order_total_weight += $value->total_weight;
		}
		if($order_detail->coupon_code != NULL)
			$order_discount_coupon = discount_coupon_code($order_detail->coupon_code, $order_price, $order_discount_price);
		$order_total_price = $order_price-($order_discount_price+$order_discount_coupon);
		$order_shipping_price = cal_shipping_price($order_detail->shipping_id, $order_total_weight);
		$order_final_price = $order_total_price + $order_shipping_price;

		$data_order = array(
							'price' => $order_price,
							'discount_price' => $order_discount_price,
							'discount_coupon' => $order_discount_coupon,
							'total_price' => $order_total_price,
							'total_weight' => $order_total_weight,
							'shipping_price' => $order_shipping_price,
							'final_price' => $order_final_price
						);
		$this->db->where('order_id', $order_id);
		$this->db->update('orders', $data_order);

			//--- insert log order ---
			$data_log_order = array(
								'order_id' => $order_id,
								'cus_id' => $order_detail->cus_id,
								'price' => $order_price,
								'discount_price' => $order_discount_price,
								'coupon_code' => $order_detail->coupon_code,
								'discount_coupon' => $order_discount_coupon,
								'total_price' => $order_total_price,
								'total_weight' => $order_total_weight,
								'shipping_method' => get_select_shipping($order_detail->shipping_id)->name,
								'shipping_price' => $order_shipping_price,
								'final_price' => $order_final_price,
								'order_status' => $order_detail->order_status,
								'create_at' => date("Y-m-d H:i:s"),
								'status' => '2',
								'update_at' => date("Y-m-d H:i:s"),
								'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
								'update_id' => $this->session->userdata('user')->admin_id
							);
			$this->db->insert('log_orders', $data_log_order);

		redirect('order/view/'.$order_id);
	}
}