<?php
class MY_Controller extends CI_Controller {
	
	function __construct() 
	{	
		parent::__construct();
	    
	    date_default_timezone_set('Asia/Bangkok');
		
		if($this->session->userdata('lang'))
	    {
		   define('LANG', $this->session->userdata('lang'));
	    }
	    else
	    {
		    define('LANG', '1');
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