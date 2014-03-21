<?php
class MY_Controller extends CI_Controller {
	
	function __construct() 
	{	
		parent::__construct();
		/*if( ! $this->session->userdata('select_language'))
	    {
	    	
	    }*/
	    
	    //define('LANG', NULL);
	    
	    date_default_timezone_set('Asia/Bangkok');
	    
	    if($this->session->userdata('lang'))
	    {
		   define('LANG', $this->session->userdata('lang'));
	    }
	    else
	    {
		    define('LANG', NULL);
	    }
	    
	    if (isset($_SERVER['HTTP_REFERER']))
		{
		    $this->session->set_userdata('prev_url', $_SERVER['HTTP_REFERER']);
		}
		else
		{
		    $this->session->set_userdata('prev_url', base_url());
		}
	}
	
}

/*class ADMIN_Controller extends CI_Controller {
	
	function __construct() 
	{	
		parent::__construct();
		if( ! $this->session->userdata('logged_in_admin'))
	    {
	    	$this->load->helper('admin');
			$this->template->set_template('admin');	
	   		$this->session->set_flashdata('message',array('message' => 'Just click login to dashboard.','type'=>'info'));	
	   		redirect('auth/admin');
			return;
	    }	
		$this->load->helper('admin');
		$this->template->set_template('admin');	
	}
	
}*/