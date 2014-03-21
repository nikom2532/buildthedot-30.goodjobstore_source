<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends MY_Controller 
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
		$this->template->view('payment/index');
	}
	
	public function create()
	{
		$this->template->view('payment/create_payment');
	}
	
	public function create_payment_update()
	{	
		
		$this->form_validation->set_message('required', '%s is missing.');
		if($this->form_validation->run('create_payment') == FALSE )
		{
			$this->load->library('upload');
			if(!$this->upload->do_upload())
			{
				$data['msg'] = "Image is missing.";
			}
			$this->template->view('payment/create_payment' , $data);
			return ;
		}
		//---- image ----
		$img_path = './public/images/payment/';
		$config['upload_path'] = $img_path;
		$config['allowed_types'] = '*';
		$config['max_size'] = '5120';
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
			$img_detail = $this->upload->data();
			$data_payment = array(
								'name' => $this->input->post('name'),
								'description' => $this->input->post('description'),
								'path' => 'public/images/payment/'.$img_detail['file_name'],
								'public' => $this->input->post('public')
							);
		}
		else
		{
			
			$this->template->view('payment/create_payment', $data);
			return ;
		}
		$this->db->insert('payment', $data_payment);
		
		//---- insert log file ----
		$payment_id = get_last_payment_id();
		$log_payment = array(
						'lang_id' => '1',
						'payment_id' => $payment_id,
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description'),
						'path' => 'public/images/payment/'.$img_detail['file_name'],
						'public' => $this->input->post('public'),
						'status' => '1',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_payment', $log_payment);

		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect('payment');
	}
	
	public function edit($payment_id)
	{
		$data['payment_id'] = $payment_id;
		$_POST = get_select_payment_array($payment_id);
		$this->form_validation->run('edit_payment');
		
		$this->template->view('payment/edit_payment' , $data);
	}
	
	public function edit_payment_update()
	{
		$this->form_validation->set_message('required', '%s is missing.');
		if($this->form_validation->run('edit_payment') == FALSE )
		{	
			$data['payment_id'] = $this->input->post('payment_id');
			$this->template->view('payment/edit_payment' , $data);
			return ;
		}

		//---- edit payment ----
		$data_payment = array(
							'name' => $this->input->post('name'),
							'description' => $this->input->post('description'),
							'public' => $this->input->post('public')
						);

		$img_path = './public/images/payment/';
		$config['upload_path'] = $img_path;
		$config['allowed_types'] = '*';
		$config['max_size'] = '5120';
		$this->load->library('upload', $config);
		$log_img = get_select_payment($this->input->post('payment_id'))->path;
		if($this->upload->do_upload())
		{
			$img_detail = $this->upload->data();
			$data_payment += array('path' => 'public/images/payment/'.$img_detail['file_name']);
			@unlink($log_img);
			$log_img = 'public/images/payment/'.$img_detail['file_name'];
		}
		
		$this->db->where('payment_id', $this->input->post('payment_id'));
		$this->db->update('payment', $data_payment);
		
		//---- log edit payment ----
		$log_data = array(
						'lang_id' => '1',
						'payment_id' => $this->input->post('payment_id'),
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description'),
						'path' => $log_img,
						'public' => $this->input->post('public'),
						'status' => '2',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);					
		$this->db->insert('log_payment', $log_data);

		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('payment/view/'.$this->input->post('payment_id'));
	}
	
	public function delete($payment_id)
	{
		$get_select_payment = get_select_payment($payment_id);
		
		//--- log delete shipping ---
		$log_data = array(
						'lang_id' => '1',
						'payment_id' => $payment_id,
						'name' => $get_select_payment->name,
						'description' => $get_select_payment->description,
						'path' => $get_select_payment->path,
						'public' => $get_select_payment->public,
						'status' => '3',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_payment', $log_data);
		

		//---  delete payment ---
		$this->db->where('payment_id', $payment_id);
		$this->db->delete('payment');
		$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
		redirect('payment');
	}
	
	function view($payment_id)
	{
		$data['payment_detail'] = get_select_payment($payment_id);
		$this->template->view('payment/view_payment' , $data);
	}
	
	
	//----- Check validate -------//
	
	public function check_name_payment($name)
	{
		$ci =& get_instance();
		
		$query = $ci->db->get_where('payment', array('name'=>$name))->row();
		if(!empty($query))
		{
			
			$this->form_validation->set_message('check_name_payment', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function check_edit_name_payment()
	{
		$payment_id = $this->input->post('payment_id');
		$name = $this->input->post('name');
		
		$ci =& get_instance();

		$ci->db->where('payment_id !=', $payment_id);
		$query = $ci->db->get_where('payment', array('name'=>$name))->row();
		if(!empty($query))
		{
			$this->form_validation->set_message('check_edit_name_payment', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;	
		}
	}
	
	//----- end Check validate -----//
}