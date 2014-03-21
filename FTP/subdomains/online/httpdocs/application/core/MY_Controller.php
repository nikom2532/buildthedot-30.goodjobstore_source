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
		    define('LANG', 'EN');
	    }
	    
	    if (isset($_SERVER['HTTP_REFERER']))
		{
		    $this->session->set_userdata('prev_url', $_SERVER['HTTP_REFERER']);
		}
		else
		{
		    $this->session->set_userdata('prev_url', base_url());
		}

		$ci =& get_instance();
		$ci->db->select('rate');
		$ci->db->from('usd_rate');
		$ci->db->where('id', 1);
		$options = $ci->db->get()->result();
		foreach ($options as $key => $value)
		{
			$rate = $value->rate;
		}

		define('RATE', $rate);
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