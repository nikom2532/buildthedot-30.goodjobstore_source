<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Refund extends MY_Controller 
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
		$this->template->view('refund/index');
	}
}