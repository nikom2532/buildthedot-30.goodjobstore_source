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

	function index($success=NULL)
	{
		if($success=='edit_success')
			$data['success'] = "Successfully updated.";
		else if($success=='create_success')
			$data['success'] = "Successfully created admin.";
		else
			$data['success'] = "";

		$this->template->view('admin/index', $data);
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
		$this->form_validation->run('admin_create');
		
		if(!$this->input->post('firstname'))
		{
			$error['er_firstname'] = "First Name is missing!";
		}
		if(!$this->input->post('lastname'))
		{
			$error['er_lastname'] = "Last Name is missing!";
		}
		if(strlen($this->input->post('position_id')) == 0)
		{
			$error['er_position_id'] = "Position is missing!";
		}
		if(strlen($this->input->post('email')) == 0)
		{
			$error['er_email'] = "Email is missing!";
		}

		if(strlen($this->input->post('new_pass')) < 6)
			$error['er_newPass'] = "Password is to short, 6 characters min!";
		else if($this->input->post('new_pass') != $this->input->post('conf_pass'))
			$error['er_confPass'] = "Your new passwords do not match!";
		else
			$check_pass = TRUE;

		if(isset($error))
		{
			$this->template->view('admin/create', $error);
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
			$id = "E00001";

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

		redirect('admin/index/create_success');
	}

	//-------------------------------------------------
	//-------------- Edit Profile Admin ---------------
	//-------------------------------------------------
	function profile()
	{
		$user_id = $this->session->userdata('user')->admin_id;
		$_POST = get_select_admin_array($user_id);
		$this->form_validation->run('user_edit');

		$this->template->view('admin/profile');
	}

	function profile_update()
	{
		$data['success'] = "";
		$this->form_validation->run('user_edit');
		$user_id = $this->session->userdata('user')->admin_id;

		$check_pass = FALSE;

		//check current password
		if($this->input->post('cur_pass') != $this->session->userdata('user')->password)
		{
			$error['er_curPass'] = "Current password is incorrect!";
		}

		$this->db->where('admin_id !=', $user_id);
		$query = $this->db->get_where('admins', array('email'=>$this->input->post('email')))->row();
		if(!empty($query))
		{
			$error['er_email'] = "This Email is already exist.";
		}

		if(strlen($this->input->post('firstname')) == 0)
		{
			$error['er_firstname'] = "First Name is missing!";
		}
		if(strlen($this->input->post('lastname')) == 0)
		{
			$error['er_lastname'] = "Last Name is missing!";
		}
		if(strlen($this->input->post('position_id')) == 0)
		{
			$error['er_position_id'] = "Position is missing!";
		}
		if(strlen($this->input->post('email')) == 0)
		{
			$error['er_email'] = "Email is missing!";
		}
		if($this->input->post('new_pass')!="")
		{
			if(strlen($this->input->post('new_pass')) < 6)
			{
				$error['er_newPass'] = "Password is to short, 6 characters min!";
			}
			else if($this->input->post('new_pass') != $this->input->post('conf_pass'))
			{
				$error['er_confPass'] = "Your new passwords do not match!";
			}
			else
			{
				$check_pass = TRUE;
			}
		}

		if(isset($error))
		{
			$this->template->view('admin/profile', $error);
			return;
		}

		//------ update password ------
		if($check_pass)
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

		redirect('admin/index/edit_success');
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
		$data['success'] = "";
		$this->form_validation->run('edit_other_admin');

		$user_id = $this->session->userdata('user')->admin_id;
		$edit_id = $this->input->post('admin_id');

		$check_pass = FALSE;

		$this->db->where('admin_id !=', $edit_id);
		$query = $this->db->get_where('admins', array('email'=>$this->input->post('email')))->row();
		if(!empty($query))
		{
			$error['er_email'] = "This Email is already exist.";
		}

		if(strlen($this->input->post('firstname')) == 0)
		{
			$error['er_firstname'] = "First Name is missing!";
		}
		if(strlen($this->input->post('lastname')) == 0)
		{
			$error['er_lastname'] = "Last Name is missing!";
		}
		if(strlen($this->input->post('position_id')) == 0)
		{
			$error['er_position_id'] = "Position is missing!";
		}
		if(strlen($this->input->post('email')) == 0)
		{
			$error['er_email'] = "Email is missing!";
		}

		if($this->input->post('new_pass')!="")
		{
			if(strlen($this->input->post('new_pass')) < 6)
			{
				$error['er_newPass'] = "Password is to short, 6 characters min!";
			}

			else if($this->input->post('new_pass') != $this->input->post('conf_pass'))
			{
				$error['er_confPass'] = "Your new passwords do not match!";
			}
			else
			{
				$check_pass = TRUE;
			}
		}

		if(isset($error))
		{
			$this->template->view('admin/edit', $error);
			//redirect('admin/edit/'.$edit_id, $error);
			return;
		}

		if($check_pass)
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

		redirect('admin/index/edit_success');
	}
}