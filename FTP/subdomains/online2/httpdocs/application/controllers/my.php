<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My extends MY_Controller
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
		redirect('my/info');
	}

	function info($success=NULL)
	{
		if($success=='success')
			$data['success'] = "Successfully updated.";
		else
			$data['success'] = "";

		$user_id = $this->session->userdata('user')->id;
		$data['nav_1'] = array('name'=>'My Info', 'link'=>site_url('my/info'), 'current'=>TRUE);
		
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->join('users', 'customers.id = users.id');
		$this->db->where('customers.id', $user_id);
		
		$query = $this->db->get();
		$_POST = $query->row_array();

		$this->form_validation->run('user_customer');

		$this->template->view('my/info', $data);
	}

	function info_update()
	{
		$data['success'] = "";
		$data['nav_1'] = array('name'=>'My Info', 'link'=>site_url("my/info"), 'current'=>TRUE);
		$this->form_validation->run('user_customer');

		$user_id = $this->session->userdata('user')->id;

		$this->db->where('id !=', $user_id);
		$query = $this->db->get_where('customers', array('email'=>$this->input->post('email')))->row();
		if(!empty($query))
		{
			$error[] = "This Email is already exist.";
			$data['error'] = array('data'=>$error, 'color'=>'red');
			$this->template->view('my/info', $data);
			return;
		}
		
		$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
		if(!preg_match($email_exp,$this->input->post('email')))
		{
			$error[] = "Email is incorrect!";
			$data['error'] = array('data'=>$error, 'color'=>'red');
			$this->template->view('my/info', $data);
			return;
		}

		if($this->input->post('password')!="")
		{
			if(strlen($this->input->post('password')) < 6)
			{
				$error[] = "Password is to short, 6 characters min!";
				$data['error'] = array('data'=>$error, 'color'=>'red');
				$this->template->view('my/info', $data);
				return;
			}

			if($this->input->post('password') != $this->input->post('password2'))
			{
				$error[] = "Your new passwords do not match!";
				$data['error'] = array('data'=>$error, 'color'=>'red');
				$this->template->view('my/info', $data);
				return;
			}
			else
			{
				$data_password = array('password' => $this->input->post('password'));
				$this->db->where('id', $user_id);
				$this->db->update('users', $data_password);
			}
		}

		$data_customer = array(
							'fname' => $this->input->post('fname'),
							'lname' => $this->input->post('lname'),
							'address' => $this->input->post('address'),
							'city' => $this->input->post('city'),
							'country_id' => $this->input->post('country_id'),
							'post_code' => $this->input->post('post_code'),
							'phone' => $this->input->post('phone'),
							'email' => $this->input->post('email'),
							'newsletter' => $this->input->post('newsletter'),
						);
			
		$this->db->where('id', $user_id);
		$this->db->update('customers', $data_customer);
		
		redirect('my/info/success');
	}
}