<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller 
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
		$this->template->view('admin/index');
	}

	function admin_delete($admin_id)
	{
		$get_admin = get_select_admin($admin_id);
		$log_data = array(
						'lang_id' => '1',
						'admin_id' => $get_admin->admin_id,
						'firstname' => $get_admin->firstname,
						'lastname' => $get_admin->lastname,
						'position' => get_position_name($get_admin->position_id, 2),
						'pic' => $get_admin->pic,
						'address' => $get_admin->address,
						'phone' => $get_admin->phone,
						'email' => $get_admin->email,
						'status' => '3',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);

		$this->db->insert('log_admins', $log_data);
		//---- delete admin ----
			//---- default ----
			$this->db->where('admin_id', $admin_id);
			$this->db->delete('admins');
			//---- other language ----
			$this->db->where('admin_id', $admin_id);
			$this->db->delete('admins_lang');

		@unlink($get_admin->pic);
		$this->session->set_flashdata('message',array('message' => 'Delete Successful'));
		redirect('admin/index');
	}

	//-------------------------------------------------
	//--------------- Create New Admin ----------------
	//-------------------------------------------------
	function create()
	{
		$this->template->view('admin/create');
	}

	function create_update()
	{
		$this->form_validation->set_message('required' , 'The %s is missing.');
		if($this->form_validation->run('admin_create') == FALSE)
		{
			$this->template->view('admin/create');
			return;
		}
		
		//---- Gen Admin ID ----
		$this->db->order_by('admin_id', 'desc');
		$query = $this->db->get('admins')->row();
		if(!empty($query))
		{
			$admin_id = $query->admin_id;
			$admin_id = substr($admin_id,1);
			$admin_id = "E".sprintf("%05d",$admin_id+1);
		}
		else
			$admin_id = "E00001";

		//---- insert new admin ----
			$data_user = array(
							'admin_id' => $admin_id,
							'firstname' => $this->input->post('firstname'),
							'lastname' => $this->input->post('lastname'),
							'position_id' => $this->input->post('position_id'),
							'address' => $this->input->post('address'),
							'phone' => $this->input->post('phone'),
							'email' => $this->input->post('email'),
							'password' => $this->input->post('new_pass')
						);
			//---- image ----
			$img_path = './public/images/users/';
			$config['upload_path'] = $img_path;
			$config['allowed_types'] = '*';
			$config['max_size'] = '5120';
			$this->load->library('upload', $config);
			$log_img = NULL;
			if($this->upload->do_upload())
			{
				$img_detail = $this->upload->data();
				$data_user += array('pic' => 'public/images/users/'.$img_detail['file_name']);
				$log_img = 'public/images/users/'.$img_detail['file_name'];
			}
			$this->db->insert('admins', $data_user);
		
		//---- insert log new admin ----
			$log_data = array(
							'lang_id' => '1',
							'admin_id' => $admin_id,
							'firstname' => $this->input->post('firstname'),
							'lastname' => $this->input->post('lastname'),
							'pic' => $log_img,
							'email' => $this->input->post('email'),
							'position' => get_position_name($this->input->post('position_id'), 2),
							'address' => $this->input->post('address'),
							'phone' => $this->input->post('phone'),
							'status' => '1',
							'update_at' => date("Y-m-d H:i:s"),
							'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
							'update_id' => $this->session->userdata('user')->admin_id
						);
			$this->db->insert('log_admins', $log_data);
		$this->session->set_flashdata('message',array('message' => 'Create Successful'));
		redirect('admin/index');
	}

	//-------------------------------------------------
	//-------------- Edit Profile Admin ---------------
	//-------------------------------------------------
	function profile()
	{	
		
		$user_id = $this->session->userdata('user')->admin_id;
		$_POST = get_select_admin_array($user_id);
		$_POST['cur_pass'] = $_POST['password'];	
		$this->form_validation->run('user_edit');
		$this->template->view('admin/edit_profile');
	}

	function profile_update()
	{
		$this->form_validation->set_message('required' ,'The %s is missing.');
		$this->form_validation->set_message('less_than' ,'Password is to short, 6 characters min!');
		if($this->form_validation->run('user_edit') == FALSE)
		{
			$this->template->view('admin/edit_profile');
			return;
		}
		$user_id = $this->session->userdata('user')->admin_id;
		

		//------ update password ------
		if($this->form_validation->run('user_edit') == FALSE AND $this->input->post('new_pass') != NULL)
		{
			//---- password ----
			$data_password = array('password' => $this->input->post('new_pass'));
			$this->db->where('id', $user_id);
			$this->db->update('admins', $data_password);
		}

		//------ update profile ------
		$data_user = array(
							'firstname' => $this->input->post('firstname'),
							'lastname' => $this->input->post('lastname'),
							'position_id' => $this->input->post('position_id'),
							'address' => $this->input->post('address'),
							'phone' => $this->input->post('phone'),
							'email' => $this->input->post('email')
						);
		
		$this->db->where('admin_id', $user_id);
		$this->db->update('admins', $data_user);
			
		//------ update image ------
		if($this->input->post('remove_pic'))
		{
			$log_img = get_select_admin($user_id)->pic;
			@unlink($log_img);
			
			$data_user = array('pic' => NULL);
			$this->db->where('admin_id', $user_id);
			$this->db->update('admins', $data_user);
			$log_img = NULL;
		}
		else
		{
			$img_path = './public/images/users/';
			$config['upload_path'] = $img_path;
			$config['allowed_types'] = '*';
			$config['max_size'] = '5120';
			$this->load->library('upload', $config);
			$log_img = get_select_admin($user_id)->pic;
			if($this->upload->do_upload())
			{
				$img_detail = $this->upload->data();
				$data_user = array('pic' => 'public/images/users/'.$img_detail['file_name']);
				$this->db->where('admin_id', $user_id);
				$this->db->update('admins', $data_user);
				@unlink($log_img);
				$log_img = 'public/images/users/'.$img_detail['file_name'];
			}
		}
				
		//---- insert log new admin ----
		$log_data = array(
						'lang_id' => '1',
						'admin_id' => $user_id,
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'pic' => $log_img,
						'email' => $this->input->post('email'),
						'position' => get_position_name($this->input->post('position_id'), 2),
						'address' => $this->input->post('address'),
						'phone' => $this->input->post('phone'),
						'status' => '2',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_admins', $log_data);

		//---- reset proflie user ----
		$query = get_update_user($user_id);
		$this->session->set_userdata('user', $query);
		$this->session->set_userdata('logged_in', TRUE);
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('admin/index');
	}

	//-------------------------------------------------
	//--------------- Edit Other Admin ----------------
	//-------------------------------------------------
	function edit($edit_id)
	{
		$_POST = get_select_admin_array($edit_id);
		$this->form_validation->run('edit_other_admin');

		$this->template->view('admin/edit');
	}

	function edit_update()
	{
		//$this->form_validation->set_message('less_than' , 'Password is to short, 6 characters min!');
		if($this->form_validation->run('edit_other_admin') == FALSE )
		{
			$this->template->view('admin/edit');
			return;
		}	

		$user_id = $this->session->userdata('user')->admin_id;
		$edit_id = $this->input->post('admin_id');

		if($this->form_validation->run('edit_other_admin') == TRUE AND $this->input->post('new_pass') != NULL)
		{
			//---- password ----
			$data_password = array('password' => $this->input->post('new_pass'));
			$this->db->where('admin_id', $edit_id);
			$this->db->update('admins', $data_password);
		}
			
		$data_user = array(
							'firstname' => $this->input->post('firstname'),
							'lastname' => $this->input->post('lastname'),
							'position_id' => $this->input->post('position_id'),
							'address' => $this->input->post('address'),
							'phone' => $this->input->post('phone'),
							'email' => $this->input->post('email')
						);
			
		$this->db->where('admin_id', $edit_id);
		$this->db->update('admins', $data_user);
			
		//------ update image ------
		if($this->input->post('remove_pic'))
		{
			$log_img = get_select_admin($edit_id)->pic;
			@unlink($log_img);
			
			$data_user = array('pic' => NULL);
			$this->db->where('admin_id', $edit_id);
			$this->db->update('admins', $data_user);
			$log_img = NULL;
		}
		else
		{
			$img_path = './public/images/users/';
			$config['upload_path'] = $img_path;
			$config['allowed_types'] = '*';
			$config['max_size'] = '5120';
			$this->load->library('upload', $config);
			$log_img = get_select_admin($edit_id)->pic;
			if($this->upload->do_upload())
			{
				$img_detail = $this->upload->data();
				$data_user = array('pic' => 'public/images/users/'.$img_detail['file_name']);
				$this->db->where('admin_id', $edit_id);
				$this->db->update('admins', $data_user);
				@unlink($log_img);
				$log_img = 'public/images/users/'.$img_detail['file_name'];
			}
		}

		//---- insert log edit other admin ----
		$log_data = array(
						'lang_id' => '1',
						'admin_id' => $edit_id,
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'pic' => $log_img,
						'email' => $this->input->post('email'),
						'position' => get_position_name($this->input->post('position_id'), 2),
						'address' => $this->input->post('address'),
						'phone' => $this->input->post('phone'),
						'status' => '2',
						'update_at' => date("Y-m-d H:i:s"),
						'update_by' => $this->session->userdata('user')->firstname.' '.$this->session->userdata('user')->lastname,
						'update_id' => $this->session->userdata('user')->admin_id
					);
		$this->db->insert('log_admins', $log_data);

		//---- reset proflie user ----
		if($user_id == $edit_id)
		{
			$query = get_update_user($user_id);
			$this->session->set_userdata('user', $query);
			$this->session->set_userdata('logged_in', TRUE);
		}
		$this->session->set_flashdata('message',array('message' => 'Edit Successful'));
		redirect('admin/index');
	}
	
	public function view($admin_id)
	{
			$data['admin_detail'] = get_select_admin($admin_id);
			$this->template->view('admin/view_admin' , $data);
	}
	
	
	//---- check validate ----
	
	public function check_email_admin($email)
	{
		$ci =& get_instance();
		
		$query = $this->db->get_where('admins', array('email'=>$this->input->post('email')))->row();
		if(!empty($query))
		{
			
			$this->form_validation->set_message('check_email_admin', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
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
	
	public function check_edit_email_admin()
	{
		$admin_id = $this->input->post('admin_id');
		$email = $this->input->post('email');
		
		$ci =& get_instance();

		$ci->db->where('admin_id !=', $admin_id);
		$query = $ci->db->get_where('admins', array('email'=>$email))->row();
		
		
		if(!empty($query))
		{
			$this->form_validation->set_message('check_edit_email_admin', 'The %s is already used');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	public function check_current_password()
	{
		$cur_pass = $this->input->post('cur_pass');
		$password = $this->session->userdata('user')->password;
		
		if($cur_pass != $password)
		{
			$this->form_validation->set_message('check_current_password', 'Password is incorrect');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
		
	}
	//---- end check vakidate ----
}