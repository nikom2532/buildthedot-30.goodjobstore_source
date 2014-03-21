<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged_in'))
		{
			redirect('login');
		}
	}

	function index()
	{
		$this->template->view('customer/index');
	}

	function customer_delete($cus_id)
	{
		$get_customer = get_select_customer($cus_id);
		$get_cus_address = get_select_customer_address($cus_id);
		
		//---- Insert Log Customer ----
		$log_customer = array(
						'lang_id' => '1',
						'cus_id' => $get_customer->cus_id,
						'firstname' => $get_customer->firstname,
						'lastname' => $get_customer->lastname,
						'address' => $get_customer->address,
						'city' => get_city_name($get_customer->city_id, '2'),
						'postcode' => $get_customer->postcode,
						'country' => get_country_name($get_customer->country_id, '2'),
						'phone' => $get_customer->phone,
						'username' => $get_customer->username,
						'email' => $get_customer->email,
						'newsletter' => $get_customer->newsletter,
						'birth_date' => $get_customer->birth_date,
						'create_at' => $get_customer->create_at,
						'status' => '4',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_customers', $log_customer);
		//---- delete customer ----
			//---- default ----
			$this->db->where('cus_id', $cus_id);
			$this->db->delete('customers');
			//---- other language ----
			$this->db->where('cus_id', $cus_id);
			$this->db->delete('customers_lang');

		//---- Insert Log Cus_Address ----
		$log_cus_address = array(
							'lang_id' => '1',
							'cus_id' => $get_cus_address->cus_id,
							'b_firstname' => $get_cus_address->b_firstname,
							'b_lastname' => $get_cus_address->b_lastname,
							'b_address' => $get_cus_address->b_address,
							'b_city' => get_city_name($get_cus_address->b_city_id, '2'),
							'b_postcode' => $get_cus_address->b_postcode,
							'b_country' => get_country_name($get_cus_address->b_country_id, '2'),
							'b_phone' => $get_cus_address->b_phone,
							's_firstname' => $get_cus_address->s_firstname,
							's_lastname' => $get_cus_address->s_lastname,
							's_address' => $get_cus_address->s_address,
							's_city' => get_city_name($get_cus_address->s_city_id, '2'),
							's_postcode' => $get_cus_address->s_postcode,
							's_country' => get_country_name($get_cus_address->s_country_id, '2'),
							's_phone' => $get_cus_address->s_phone,
							'status' => '4',
							'update_at' => date("Y-m-d H:i:s"),
							'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
							'update_id' => $this->session->userdata('user')->admin_id
						);
		$this->db->insert('log_cus_address', $log_cus_address);
		//---- delete cus_address ----
			//---- default ----
			$this->db->where('cus_id', $cus_id);
			$this->db->delete('cus_address');
			//---- other language ----
			$this->db->where('cus_id', $cus_id);
			$this->db->delete('cus_address_lang');

		//---- Insert Log Customer Group ----
		$this->db->where('cus_id', $cus_id);
		$query = $this->db->get('cus_group_list')->result();
		if(!empty($query))
		{
			foreach($query as $value)
			{
				$log_cus_member = array(
								'cusgroup_id' => $value->cusgroup_id,
								'cus_id' => $cus_id,
								'status' => '2',
								'update_at' => date("Y-m-d H:i:s"),
								'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
								'update_id' => $this->session->userdata('user')->admin_id
								);
				$this->db->insert('log_cus_group_list', $log_cus_member);
			}
			//---- remove from customer group ----
			$this->db->where('cus_id', $cus_id);
			$this->db->delete('cus_group_list');
		}
		$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
		redirect('customer/index');
	}

	function group_delete($cusgroup_id)
	{
		//---- Insert Log Member Group ----
		$this->db->where('cusgroup_id', $cusgroup_id);
		$query = $this->db->get('cus_group_list')->result();
		if(!empty($query))
		{
			foreach($query as $value)
			{
				$log_cus_member = array(
								'cusgroup_id' => $cusgroup_id,
								'cus_id' => $value->cus_id,
								'status' => '2',
								'update_at' => date("Y-m-d H:i:s"),
								'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
								'update_id' => $this->session->userdata('user')->admin_id
								);
				$this->db->insert('log_cus_group_list', $log_cus_member);
			}
			//---- remove member group ----
			$this->db->where('cusgroup_id', $cusgroup_id);
			$this->db->delete('cus_group_list');
		}

		//---- remove customer group ----
			//-- default --
			$this->db->where('cusgroup_id', $cusgroup_id);
			$this->db->delete('cus_group');
			//-- other language --
			$this->db->where('cusgroup_id', $cusgroup_id);
			$this->db->delete('cus_group_lang');
		$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
		redirect('customer/group');
	}

	//-------------------------------------------------
	//----------------- Add Customer ------------------
	//-------------------------------------------------
	function create()
	{
		$this->template->view('customer/create');
	}

	function create_update()
	{
		
		if($this->form_validation->run('customer_create') == FALSE )
		{
		  $this->template->view('customer/create');
		  return;
		}
		
		$user_id = $this->session->userdata('user')->admin_id;
		
		//---- Gen Customers ID ----
		$this->db->order_by('cus_id', 'desc');
		$query = $this->db->get('customers')->row();
		if(!empty($query))
		{
			$cus_id = $query->cus_id;
			$cus_id = substr($cus_id,1);
			$cus_id = "C".sprintf("%06d",$cus_id+1);
		}
		else
			$cus_id = "C000001";

		//---- insert new customer ----
			$data_user = array(			
								'cus_id' => $cus_id,
								'firstname' => $this->input->post('firstname'),
								'lastname' => $this->input->post('lastname'),
								'address' => $this->input->post('address'),
								'city_id' => $this->input->post('city_id'),
								'postcode' => $this->input->post('postcode'),
								'country_id' => $this->input->post('country_id'),
								'phone' => $this->input->post('phone'),
								'email' => $this->input->post('email'),
								'password' => $this->input->post('new_pass'),
								'newsletter' => $this->input->post('newsletter'),
								'birth_date' => $this->input->post('birth_date'),
								'create_at' => date("Y-m-d H:i:s")
						);
			
			
			$this->db->insert('customers', $data_user);

		//---- insert log new customer ----
			$log_data = array(
							'lang_id' => '1',
							'cus_id' => $cus_id,
							'firstname' => $this->input->post('firstname'),
							'lastname' => $this->input->post('lastname'),
							'address' => $this->input->post('address'),
							'city' => get_city_name($this->input->post('city_id'), '2'),
							'postcode' => $this->input->post('postcode'),
							'country' => get_country_name($this->input->post('country_id'), '2'),
							'phone' => $this->input->post('phone'),
							'email' => $this->input->post('email'),
							'newsletter' => $this->input->post('newsletter'),
							'birth_date' => $this->input->post('birth_date'),
							'create_at' => date("Y-m-d H:i:s"),
							'status' => '1',
							'update_at' => date("Y-m-d H:i:s"),
							'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
							'update_id' => $this->session->userdata('user')->admin_id
						);
			$this->db->insert('log_customers', $log_data);
			
		//---- insert Address -----
			$data_address = array(
								'cus_id' => $cus_id,
								'b_firstname' => $this->input->post('b_firstname'),
								'b_lastname' => $this->input->post('b_lastname'),
								'b_address' => $this->input->post('b_address'),
								'b_city_id' => $this->input->post('b_city_id'),
								'b_postcode' => $this->input->post('b_postcode'),
								'b_country_id' => $this->input->post('b_country_id'),
								'b_phone' => $this->input->post('b_phone'),
								's_firstname' => $this->input->post('s_firstname'),
								's_lastname' => $this->input->post('s_lastname'),
								's_address' => $this->input->post('s_address'),
								's_city_id' => $this->input->post('s_city_id'),
								's_postcode' => $this->input->post('s_postcode'),
								's_country_id' => $this->input->post('s_country_id'),
								's_phone' => $this->input->post('s_phone')
							);
							
			$this->db->insert('cus_address' , $data_address);
		
		//---- insert log Address ----
			$log_data = array(
							'lang_id' => '1',
							'cus_id' => $cus_id,
							'b_firstname' => $this->input->post('b_firstname'),
							'b_lastname' => $this->input->post('b_lastname'),
							'b_address' => $this->input->post('b_address'),
							'b_city' => get_city_name($this->input->post('b_city_id'), '2'),
							'b_postcode' => $this->input->post('b_postcode'),
							'b_country' => get_country_name($this->input->post('b_country_id'), '2'),
							'b_phone' => $this->input->post('b_phone'),
							's_firstname' => $this->input->post('s_firstname'),
							's_lastname' => $this->input->post('s_lastname'),
							's_address' => $this->input->post('s_address'),
							's_city' => get_city_name($this->input->post('s_city_id'), '2'),
							's_postcode' => $this->input->post('s_postcode'),
							's_country' => get_country_name($this->input->post('s_country_id'), '2'),
							's_phone' => $this->input->post('s_phone'),
							'status' => '1',
							'update_at' => date("Y-m-d H:i:s"),
							'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
							'update_id' => $this->session->userdata('user')->admin_id
						);
			$this->db->insert('log_cus_address', $log_data);

		redirect('customer');
	}


	//-------------------------------------------------
	//--------------- Profie Customer -----------------
	//-------------------------------------------------
	function profile($cus_id)
	{
		$data['cus_detail'] = get_select_customer($cus_id);
		$data['cus_address'] = get_select_customer_address($cus_id);
		$this->template->view('customer/profile', $data);
	}

	//-------------------------------------------------
	//---------------- Edit Customer ------------------
	//-------------------------------------------------
		//------------------------
		//------- Contact --------
		//------------------------
		function edit_contact($cus_id)
		{
			//$data['cus_detail'] = get_select_customer($cus_id);
			$_POST = get_select_customer_array($cus_id);
			$this->form_validation->run('edit_customer_contact');

			$this->template->view('customer/edit_contact');
		}

		function contact_update()
		{
			
			$cus_id = $this->input->post('cus_id');
			$this->form_validation->set_message('required' ,  'The %s is missing.');
			$this->form_validation->set_message('less_than' , 'Password is to short, 6 characters min!');
			if($this->form_validation->run('edit_customer_contact') == FALSE )
			{
			$this->template->view('customer/edit_contact');
			return;
			}	


			if($this->form_validation->run('edit_customer_contact') == TRUE AND $this->input->post('new_pass') != NULL)
			{
			//---- password ----
				$data_password = array('password' => $this->input->post('new_pass'));
				$this->db->where('cus_id', $cus_id);
				$this->db->update('customers', $data_password);
			}

			$data_user = array(
								'firstname' => $this->input->post('firstname'),
								'lastname' => $this->input->post('lastname'),
								'address' => $this->input->post('address'),
								'city_id' => $this->input->post('city_id'),
								'postcode' => $this->input->post('postcode'),
								'country_id' => $this->input->post('country_id'),
								'phone' => $this->input->post('phone'),
								'email' => $this->input->post('email'),
								'newsletter' => $this->input->post('newsletter'),
								'birth_date' => $this->input->post('birth_date')
							);
				
			$this->db->where('cus_id', $cus_id);
			$this->db->update('customers', $data_user);

			//---- insert log edit customer ----
			$log_data = array(
							'lang_id' => '1',
							'cus_id' => $cus_id,
							'firstname' => $this->input->post('firstname'),
							'lastname' => $this->input->post('lastname'),
							'address' => $this->input->post('address'),
							'city' => get_city_name($this->input->post('city_id'), 2),
							'postcode' => $this->input->post('postcode'),
							'country' => get_country_name($this->input->post('country_id'), 2),
							'phone' => $this->input->post('phone'),
							'email' => $this->input->post('email'),
							'newsletter' => $this->input->post('newsletter'),
							'birth_date' => $this->input->post('birth_date'),
							'create_at' => $this->input->post('create_at'),
							'status' => '3',
							'update_at' => date("Y-m-d H:i:s"),
							'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
							'update_id' => $this->session->userdata('user')->admin_id
						);
			$this->db->insert('log_customers', $log_data);
			$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
			redirect('customer/profile/'.$cus_id);
		}

		//------------------------
		//------- Billing --------
		//------------------------
		function edit_billing($cus_id)
		{
			$_POST = get_select_billing_address($cus_id);
			$this->form_validation->run('edit_customer_billing');
			$this->template->view('customer/edit_billing');
		}

		function billing_update()
		{
			$cus_id = $this->input->post('cus_id');
			$this->form_validation->set_message('required' , 'The %s is missing.');
			if($this->form_validation->run('edit_customer_billing') == FALSE )
			{
				$this->template->view('customer/edit_billing');
				return;
			
			}
		
			$data_user = array(
								'b_firstname' => $this->input->post('b_firstname'),
								'b_lastname' => $this->input->post('b_lastname'),
								'b_address' => $this->input->post('b_address'),
								'b_city_id' => $this->input->post('b_city_id'),
								'b_postcode' => $this->input->post('b_postcode'),
								'b_country_id' => $this->input->post('b_country_id'),
								'b_phone' => $this->input->post('b_phone')
							);
				
			$this->db->where('cus_id', $cus_id);
			$this->db->update('cus_address', $data_user);

			//---- insert log edit shipping ----
			$shipping_address = get_select_shipping_address($cus_id);
			$log_data = array(
							'lang_id' => '1',
							'cus_id' => $cus_id,
							'b_firstname' => $this->input->post('b_firstname'),
							'b_lastname' => $this->input->post('b_lastname'),
							'b_address' => $this->input->post('b_address'),
							'b_city' => get_city_name($this->input->post('b_city_id'), 2),
							'b_postcode' => $this->input->post('b_postcode'),
							'b_country' => get_country_name($this->input->post('b_country_id'), 2),
							'b_phone' => $this->input->post('b_phone'),
							's_firstname' => $shipping_address['s_firstname'],
							's_lastname' => $shipping_address['s_lastname'],
							's_address' => $shipping_address['s_address'],
							's_city' => get_city_name($shipping_address['s_city_id'], 2),
							's_postcode' => $shipping_address['s_postcode'],
							's_country' => get_country_name($shipping_address['s_country_id'], 2),
							's_phone' => $shipping_address['s_phone'],
							'status' => '3',
							'update_at' => date("Y-m-d H:i:s"),
							'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
							'update_id' => $this->session->userdata('user')->admin_id
						);
			$this->db->insert('log_cus_address', $log_data);
			$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
			redirect('customer/profile/'.$cus_id);
		}

		//------------------------
		//------- Shipping -------
		//------------------------
		function edit_shipping($cus_id)
		{
			$_POST = get_select_shipping_address($cus_id);
			$this->form_validation->run('edit_customer_shipping');
			$this->template->view('customer/edit_shipping');
		}
		
		function shipping_update()
		{
			$cus_id = $this->input->post('cus_id');
			$this->form_validation->set_message('required' , 'The %s is missing.');
			if($this->form_validation->run('edit_customer_shipping') == FALSE )
			{
				$this->template->view('customer/edit_shipping');
				return;
			
			}
	
			$data_user = array(
								's_firstname' => $this->input->post('s_firstname'),
								's_lastname' => $this->input->post('s_lastname'),
								's_address' => $this->input->post('s_address'),
								's_city_id' => $this->input->post('s_city_id'),
								's_postcode' => $this->input->post('s_postcode'),
								's_country_id' => $this->input->post('s_country_id'),
								's_phone' => $this->input->post('s_phone')
							);
				
			$this->db->where('cus_id', $cus_id);
			$this->db->update('cus_address', $data_user);

			//---- insert log edit shipping ----
			$billing_address = get_select_billing_address($cus_id);
			$log_data = array(
							'lang_id' => '1',
							'cus_id' => $cus_id,
							'b_firstname' => $billing_address['b_firstname'],
							'b_lastname' => $billing_address['b_lastname'],
							'b_address' => $billing_address['b_address'],
							'b_city' => get_city_name($billing_address['b_city_id'], 2),
							'b_postcode' => $billing_address['b_postcode'],
							'b_country' => get_country_name($billing_address['b_country_id'], 2),
							'b_phone' => $billing_address['b_phone'],
							's_firstname' => $this->input->post('s_firstname'),
							's_lastname' => $this->input->post('s_lastname'),
							's_address' => $this->input->post('s_address'),
							's_city' => get_city_name($this->input->post('s_city_id'), 2),
							's_postcode' => $this->input->post('s_postcode'),
							's_country' => get_country_name($this->input->post('s_country_id'), 2),
							's_phone' => $this->input->post('s_phone'),
							'status' => '3',
							'update_at' => date("Y-m-d H:i:s"),
							'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
							'update_id' => $this->session->userdata('user')->admin_id
						);
			$this->db->insert('log_cus_address', $log_data);
			$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
			redirect('customer/profile/'.$cus_id);
		}

	//-------------------------------------------------
	//---------------- Customer Group -----------------
	//-------------------------------------------------
	function group()
	{
		$this->template->view('customer/group');
	}

	function group_view($cusgroup_name)
	{
		$data['cusgroup_detail'] = get_cusgroup_fromName($cusgroup_name);
		$this->template->view('customer/group_view', $data);
	}

	function group_create()
	{
		$this->template->view('customer/group_create');
	}
	function group_create_update()
	{
	
		if($this->form_validation->run('create_customer_group') == FALSE )
		{
			$this->template->view('customer/group_create');
			return;
		}
		$check_validate = TRUE;
		//---- shipping ----
		if(strlen($this->input->post('name'))==0 OR check_name_cus_group($this->input->post('name')))
		{
			//$error['er_name'] = "Group name is missing!";
			$check_validate = FALSE;
		}
		if(!$check_validate)
		{
			$this->template->view('customer/group_create');
			return;
		}
/*
		if(isset($error))
		{
			$this->template->view('customer/group_edit', $error);
			return;
		}
*/
		$data_group = array(
							'name' => $this->input->post('name'),
							'description' => $this->input->post('description')
						);
		$this->db->insert('cus_group', $data_group);
		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect('customer/group');
	}

	function group_edit($cusgroup_name)
	{
		$_POST = get_cusgroup_fromName_array($cusgroup_name);
		$this->form_validation->run('edit_customer_group');

		$this->template->view('customer/group_edit');
	}

	function group_update()
	{
		$this->form_validation->set_message('required' , 'The %s is missing.');
		if($this->form_validation->run('edit_customer_group') == FALSE )
		{
			$this->template->view('customer/group_edit');
			return;
		}
		$cusgroup_id = $this->input->post('cusgroup_id');
		$check_validate = TRUE;

		//---- shipping ----
		if(strlen($this->input->post('name'))==0 OR check_edit_name_cus_group($cusgroup_id, $this->input->post('name')))
		{
			//$error['er_name'] = "Group name is missing!";
			$check_validate = FALSE;
		}
		if(!$check_validate)
		{
			$this->template->view('customer/group_edit');
			return;
		}
/*
		if(isset($error))
		{
			$this->template->view('customer/group_edit', $error);
			return;
		}
*/
		$data_group = array(
							'name' => $this->input->post('name'),
							'description' => $this->input->post('description')
						);
				
		$this->db->where('cusgroup_id', $cusgroup_id);
		$this->db->update('cus_group', $data_group);

		$cusgroup_name = $this->input->post('name');
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('customer/group/'.$cusgroup_name);
	}

	function groupMember_edit($cusgroup_name)
	{
		$_POST = get_cusgroup_fromName_array($cusgroup_name);
		$this->form_validation->run('edit_groupMember');

		$this->template->view('customer/groupMember_edit');

		//$data['cusgroup_detail'] = get_cusgroup_fromName($cusgroup_name);

		//$this->template->view('customer/groupMember_edit', $data);

	}

	function groupMember_update($select=NULL)
	{
		$this->form_validation->run('edit_groupMember');
		$select_customer = $this->input->post('select_customer');

		//--- substring to array ---
		$str     = $this->input->post('project');
		$order   = array("=1&");
		$replace = ' ';
		$newstr = str_replace($order, $replace, $str);

		$str     = $newstr;
		$order   = array("=1", "\"");
		$replace = '';
		$newstr = str_replace($order, $replace, $str);

		if(!empty($newstr))
			$select_customer = explode(" ", $newstr);
		//--- end substring ---

		foreach(get_customer_list() as $value):
			$check = FALSE;
			if(!empty($select_customer))			
			{
				foreach($select_customer as $member):
					if($value->cus_id == $member)
						$check = TRUE;
				endforeach;
			}

			if($check)
			{
				if(!check_in_group($value->cus_id, $this->input->post('cusgroup_id')))
				{
					$add_member = array(
										'cusgroup_id' => $this->input->post('cusgroup_id'),
										'cus_id' => $value->cus_id
									);
					$this->db->insert('cus_group_list', $add_member);

					//---- insert log add member ----
					$log_data = array(
									'cusgroup_id' => $this->input->post('cusgroup_id'),
									'cus_id' => $value->cus_id,
									'status' => '1',
									'update_at' => date("Y-m-d H:i:s"),
									'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
									'update_id' => $this->session->userdata('user')->admin_id
								);
					$this->db->insert('log_cus_group_list', $log_data);
				}
			}
			else
			{
				if(check_in_group($value->cus_id, $this->input->post('cusgroup_id')))
				{
					$this->db->delete('cus_group_list', array('cus_id'=>$value->cus_id, 'cusgroup_id'=>$this->input->post('cusgroup_id')));

					//---- insert log remove member ----
					$log_data = array(
									'cusgroup_id' => $this->input->post('cusgroup_id'),
									'cus_id' => $value->cus_id,
									'status' => '2',
									'update_at' => date("Y-m-d H:i:s"),
									'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
									'update_id' => $this->session->userdata('user')->admin_id
								);
					$this->db->insert('log_cus_group_list', $log_data);
				}
			}
		endforeach;
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('customer/group/'.$this->input->post('name'));
	}
	
	
	// ---- Check validate ----
	
	public function check_confirmation_pass()
	{
		$new_pass = $this->input->post('new_pass');
		$conf_pass = $this->input->post('conf_pass');
		
		if($new_pass != $conf_pass)
		{	
			$this->form_validation->set_message('check_confirmation_pass', 'The password is not match');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	
	}
	
	public function check_name_cus_group($name)
	{
		$ci =& get_instance();

		$query = $ci->db->get_where('cus_group', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_name_cus_group' , 'The name is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	
	}
	
	public function check_edit_name_cus_group()
	{
		$cusgroup_id = $this->input->post('cusgroup_id');
		$name = $this->input->post('name');
		$ci =& get_instance();

		$ci->db->where('cusgroup_id !=', $cusgroup_id);
		$query = $ci->db->get_where('cus_group', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_edit_name_cus_group' , 'The name is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function check_email_customer($email)
	{
		$ci =& get_instance();
		
		$query = $this->db->get_where('customers', array('email'=>$this->input->post('email')))->row();
		if(!empty($query))
		{
			
			$this->form_validation->set_message('check_email_customer', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
		
	public function check_edit_email_customer()
	{
		$cus_id = $this->input->post('cus_id');
		$email = $this->input->post('email');
		
		$ci =& get_instance();

		$ci->db->where('cus_id !=', $cus_id);
		$query = $ci->db->get_where('customers', array('email'=>$email))->row();
		
		
		if(!empty($query))
		{
			$this->form_validation->set_message('check_edit_email_customer', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	// ---- End Check validate ----
}