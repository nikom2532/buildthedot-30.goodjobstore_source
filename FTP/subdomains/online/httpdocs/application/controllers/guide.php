<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Guide extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		redirect('guide/about');
	}
	
	function about()
	{
		$data['nav_1'] = array('name'=>'SHOPPING GUIDE', 'link'=>site_url('guide'), 'current'=>FALSE);
		$data['nav_2'] = array('name'=>'about us', 'link'=>site_url('guide/about'), 'current'=>TRUE);
		$this->template->view('guide/about', $data);
	}
	
	function faq()
	{
		$data['nav_1'] = array('name'=>'SHOPPING GUIDE', 'link'=>site_url('guide'), 'current'=>FALSE);
		$data['nav_2'] = array('name'=>'FAQ', 'link'=>site_url('guide/faq'), 'current'=>TRUE);
		$this->template->view('guide/faq', $data);
	}
	
	function payment()
	{
		$data['nav_1'] = array('name'=>'SHOPPING GUIDE', 'link'=>site_url('guide'), 'current'=>FALSE);
		$data['nav_2'] = array('name'=>'Payment & Delivery', 'link'=>site_url('guide/payment'), 'current'=>TRUE);
		$this->template->view('guide/payment', $data);
	}
	
	function exchange()
	{
		$data['nav_1'] = array('name'=>'SHOPPING GUIDE', 'link'=>site_url('guide'), 'current'=>FALSE);
		$data['nav_2'] = array('name'=>'Return & Exchange', 'link'=>site_url('guide/exchange'), 'current'=>TRUE);
		$this->template->view('guide/exchange', $data);
	}

	function technology()
	{
		$data['nav_1'] = array('name'=>'SHOPPING GUIDE', 'link'=>site_url('guide'), 'current'=>FALSE);
		$data['nav_2'] = array('name'=>'Technology', 'link'=>site_url('guide/technology'), 'current'=>TRUE);
		$this->template->view('guide/technology', $data);
	}
	

}
