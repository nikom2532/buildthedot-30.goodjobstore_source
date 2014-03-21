<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shipping extends MY_Controller 
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
		$this->template->view('shipping/index');
	}
	
	
	public function create()
	{
		$this->template->view('shipping/create_shipping');
	}
	
	public function create_shipping_update()
	{
		$this->form_validation->set_message('required', '%s is missing.');
		if($this->form_validation->run('create_shipping') == FALSE )
		{
			$this->template->view('shipping/create_shipping');
			return;
		}
		
		//--- insert new shipping ---
		$data_shipping = array(
							'name' => $this->input->post('name'),
							'description' => $this->input->post('description')
						);
		$this->db->insert('shipping', $data_shipping);
		//--- insert new log ---
		$shipping_id = get_shipping_id();
		$log_data = array(
						'lang_id' => '1',
						'shipping_id' => $shipping_id,
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description'),
						'status' => '1',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_shipping', $log_data);
		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect('shipping/index');
			
	}
	
	public function edit($shipping_id)
	{	
		$data['shipping_id'] = $shipping_id;
		$_POST = get_select_shipping_array($shipping_id);
		$this->form_validation->run('edit_shipping');
		
		$this->template->view('shipping/edit_shipping' , $data);
	}
	
	public function edit_shipping_update()
	{
		$this->form_validation->set_message('required', '%s is missing.');
		if($this->form_validation->run('edit_shipping') == FALSE)
		{
			$data['shipping_id'] = $this->input->post('shipping_id');
			$this->template->view('shipping/edit_shipping' , $data);
			return;
		}
		
		//---- edit shipping ----
		$data_shipping = array(
							'name' => $this->input->post('name'),
							'description' => $this->input->post('description')
						);

		$this->db->where('shipping_id', $this->input->post('shipping_id'));
		$this->db->update('shipping', $data_shipping);
		
		//---- log edit shipping ----
		$log_data = array(
						'lang_id' => '1',
						'shipping_id' => $this->input->post('shipping_id'),
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description'),
						'status' => '2',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_shipping', $log_data);
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('shipping/view/'.$this->input->post('shipping_id'));
	}
	
	public function delete($shipping_id)
	{	
		$get_select_shipping = get_select_shipping($shipping_id);
		
		//--- log delete shipping ---
		$log_data = array(
						'lang_id' => '1',
						'shipping_id' => $get_select_shipping->shipping_id,
						'name' => $get_select_shipping->name,
						'description' => $get_select_shipping->description,
						'status' => '3',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_shipping', $log_data);
		

		//---  delete shipping ---
		$this->db->where('shipping_id', $shipping_id);
		$this->db->delete('shipping');
		
		//---- Insert Log shipping range ----
		$this->db->where('shipping_id', $shipping_id);
		$query = $this->db->get('shipping_range')->result();
		if(!empty($query))
		{
			foreach($query as $value)
			{
				$log_shipping_range = array(
								'lang_id' => '1',
								'range_id' => $value->range_id,
								'shipping_id' => $value->shipping_id,
								'weight_min' => $value->weight_min,
								'weight_max' => $value->weight_max,
								'price' => $value->price,	
								'status' => '3',
								'update_at' => date("Y-m-d H:i:s"),
								'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
								'update_id' => $this->session->userdata('user')->admin_id
								);
				$this->db->insert('log_shipping_range', $log_shipping_range);
			}
		//---- remove from shipping range ----
			$this->db->where('shipping_id', $shipping_id);
			$this->db->delete('shipping_range');
		}
		$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
		redirect('shipping');
	}
	
	function create_shipping_range($shipping_id)
	{	
		$data['shipping_id'] = $shipping_id;
		$this->template->view('shipping/create_shipping_range' , $data);
	}
	
	
	function create_shipping_range_update()
	{
		$this->form_validation->set_message('required', '%s is missing.');
		if($this->form_validation->run('create_shipping_range') == FALSE )
		{
			$data['shipping_id'] = $this->input->post('shipping_id');
			$this->template->view('shipping/create_shipping_range', $data);
			return ;
		}
		//--- insert new shipping ---
		$data_shipping_range = array(
							'shipping_id' => $this->input->post('shipping_id'),	
							'weight_min' => $this->input->post('weight_min'),
							'weight_max' => $this->input->post('weight_max'),
							'price' => $this->input->post('price')	
						);
		$this->db->insert('shipping_range', $data_shipping_range);
		//--- insert new log ---
		$range_id = get_shipping_range_id();
		$log_data = array(
						'lang_id' => '1',
						'range_id' => $range_id,
						'shipping_id' => $this->input->post('shipping_id'),	
						'weight_min' => $this->input->post('weight_min'),
						'weight_max' => $this->input->post('weight_max'),
						'price' => $this->input->post('price'),
						'status' => '1',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_shipping_range', $log_data);
		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect('shipping/view/'.$this->input->post('shipping_id'));
	}
	
	public function edit_shipping_range($range_id)
	{	
		$data['range_id'] = $range_id;
		$_POST = get_select_shipping_range_array($range_id);

		$data['shipping_id'] = get_shipping_id_from_range($range_id);
		$data['name'] = get_select_shipping_name($data['shipping_id']);
		$this->form_validation->run('edit_shipping_range');
		
		$this->template->view('shipping/edit_shipping_range' , $data);
	}
	
	public function edit_shipping_range_update()
	{
		$shipping_id = get_shipping_id_from_range($this->input->post('range_id'));
		$this->form_validation->set_message('required', '%s is missing.');
		
		if($this->form_validation->run('edit_shipping_range') == FALSE )
		{
			$data['range_id'] = $this->input->post('range_id');
			$data['shipping_id'] = $shipping_id;
			$this->template->view('shipping/edit_shipping_range', $data);
			return ;
		}
		//$name = get_select_shipping_name($shipping_id);
		//---- edit shipping range ----
		$data_shipping_range = array(
							'shipping_id' => $shipping_id,	
							'weight_min' => $this->input->post('weight_min'),
							'weight_max' => $this->input->post('weight_max'),
							'price' => $this->input->post('price')	
						);
		$this->db->where('range_id', $this->input->post('range_id'));
		$this->db->update('shipping_range', $data_shipping_range);
		
		//---- log edit shipping range ----
		 $log_data = array(
						'lang_id' => '1',
						'range_id' =>  $this->input->post('range_id'),
						'shipping_id' => $shipping_id,	
						'weight_min' => $this->input->post('weight_min'),
						'weight_max' => $this->input->post('weight_max'),
						'price' => $this->input->post('price'),	
						'status' => '2',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		 $this->db->insert('log_shipping_range', $log_data);
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('shipping/view/'.$shipping_id);
	}
	
	public function delete_shipping_range($range_id)
	{	
		
		$get_shipping_range = get_select_shipping_range($range_id);
		
		//---- log delete shipping range ----
		 $log_data = array(
						'lang_id' => '1',
						'range_id' =>  $get_shipping_range->range_id,
						'shipping_id' => $get_shipping_range->shipping_id,	
						'weight_min' => $get_shipping_range->weight_min,
						'weight_max' => $get_shipping_range->weight_max,
						'price' => $get_shipping_range->price,	
						'status' => '3',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
							
		$this->db->insert('log_shipping_range', $log_data);
		
		//---- log delete shipping range ----
		$this->db->where('range_id', $range_id);
		$this->db->delete('shipping_range');
		$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
		redirect('shipping/view/'.$get_shipping_range->shipping_id);
	}
	
	function view($shipping_id)
	{
		$data['shipping_detail'] = get_select_shipping($shipping_id);
		$this->template->view('shipping/view_shipping' , $data);
	}
	
	
	
	// ---- Check Validate ----//
	
public function check_name_shipping($name)
	{
		$ci =& get_instance();

		$query = $ci->db->get_where('shipping', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_name_shipping', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

public function check_edit_name_shipping()
	{
		$shipping_id = $this->input->post('shipping_id');
		$name = $this->input->post('name');
	
		$ci =& get_instance();

		$ci->db->where('shipping_id !=', $shipping_id);
		$query = $ci->db->get_where('shipping', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_edit_name_shipping', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	
	// ---- Check Validate ----//
}