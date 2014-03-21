<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller 
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
		$this->template->view('dashboard/index');
	}

	function lang($lang=NULL)
	{
		$this->session->set_userdata('lang', $lang);
		redirect($this->session->userdata('prev_url'));
	}
}