<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		
	}

	//-----------------------------------------------
	//------------------- Login ---------------------
	//-----------------------------------------------
	
	function login()
	{		
		$this->template->view('auth/login');
	}
	
	function verify()
	{
		$query = get_login_user($this->input->post('username'), $this->input->post('password'));

		if(empty($query))
		{
			$data['error_login'] = "email or password is missing!";
			$this->template->view('auth/login', $data);
			return;
		}
		else
		{
			$this->session->set_userdata('user', $query);
			$this->session->set_userdata('logged_in', TRUE);
			redirect('dashboard');
		}
	}

	//-----------------------------------------------
	//------------------- Logout --------------------
	//-----------------------------------------------
	function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
?>