<?
	//----- Main nav -----
	$data['active_menu'] = '10';
	echo $this->load->view('templates/main_menu', $data);
	
	//----- Secondary nav -----
	$btn_menu[] = array('btn_menu'=>'ADD CUSTOMERS', 'link_menu'=>base_url('customer/create'), 'icon'=>'icon-plus-2');
	//$btn_menu[] = array('btn_menu'=>'MANAGE CUSTOMERS', 'link_menu'=>base_url('customer'));
	$btn_menu[] = array('btn_menu'=>'ADD CUSTOMERS GROUP', 'link_menu'=>base_url('customer/group/create'), 'icon'=>'icon-plus-2');
	$btn_menu[] = array('btn_menu'=>'CUSTOMER GROUPS', 'link_menu'=>base_url('customer/group'));
	$data['sec_menu'] = array('btn_menu'=>$btn_menu);

	echo $this->load->view('templates/second_menu', $data);
?>